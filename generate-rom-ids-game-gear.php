<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $pdo = new PDO(
        "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};charset=utf8mb4",
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
    echo "║              GÉNÉRATION ROM_ID POUR GAME GEAR (v1)                           ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Récupérer tous les jeux
    $stmt = $pdo->query("SELECT id, name FROM game_gear_games ORDER BY id");
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "📊 Jeux à traiter: " . count($games) . "\n\n";

    $sql = "-- ══════════════════════════════════════════════════════════════════════════════\n";
    $sql .= "-- MISE À JOUR ROM_ID - GAME GEAR\n";
    $sql .= "-- Génère les ROM_ID en retirant la région du nom\n";
    $sql .= "-- ══════════════════════════════════════════════════════════════════════════════\n\n";
    $sql .= "USE `stock-R4E`;\n\n";

    function generateRomId($name) {
        // Retirer les régions entre parenthèses à la fin
        // Exemple: "Aladdin (USA, Europe, Brazil) (En)" → "Aladdin"
        $romId = $name;
        
        // Retirer les tags de traduction [tr ...] en fin de chaîne
        $romId = preg_replace('/\s*\[tr[^\]]*\]\s*$/i', '', $romId);
        $romId = preg_replace('/\s*\[tr[^\]]*\]\([^)]*\)\s*$/i', '', $romId);
        $romId = preg_replace('/\s*\(Alt\s+\d+\)\s*$/i', '', $romId);
        
        // Retirer toutes les parenthèses à la fin (régions et langues)
        while (preg_match('/^(.+?)\s*\([^)]*\)\s*$/', $romId, $matches)) {
            $romId = trim($matches[1]);
        }
        
        return trim($romId);
    }

    $updates = [];
    $duplicates = [];
    $romIdCount = [];

    foreach ($games as $game) {
        $romId = generateRomId($game['name']);
        
        // Compter les doublons
        if (!isset($romIdCount[$romId])) {
            $romIdCount[$romId] = [];
        }
        $romIdCount[$romId][] = $game;
        
        $updates[] = [
            'id' => $game['id'],
            'name' => $game['name'],
            'rom_id' => $romId
        ];
    }

    // Trouver les doublons
    foreach ($romIdCount as $romId => $games) {
        if (count($games) > 1) {
            $duplicates[$romId] = $games;
        }
    }

    echo "⚠️  ROM_ID en doublon: " . count($duplicates) . "\n\n";

    if (count($duplicates) > 0) {
        echo "🔍 DOUBLONS DÉTECTÉS (20 premiers):\n";
        echo "════════════════════════════════════════════════════════════════════════════════\n";
        $count = 0;
        foreach ($duplicates as $romId => $games) {
            if ($count >=  20) break;
            echo "\n   ROM_ID: $romId (" . count($games) . " jeux)\n";
            foreach ($games as $game) {
                echo "      • ID " . $game['id'] . ": " . $game['name'] . "\n";
            }
            $count++;
        }
        echo "\n";
    }

    // Générer le SQL
    echo "📝 Génération du fichier SQL...\n";
    
    foreach ($updates as $update) {
        $escapedRomId = addslashes($update['rom_id']);
        $sql .= "UPDATE game_gear_games SET ROM_ID = '{$escapedRomId}' WHERE id = {$update['id']}; -- {$update['name']}\n";
    }

    // Sauvegarder
    $filename = 'generate-rom-ids-game-gear.sql';
    file_put_contents($filename, $sql);

    echo "✅ Fichier généré: $filename\n";
    echo "📊 Total updates: " . count($updates) . "\n\n";

    echo "🚀 PROCHAINES ÉTAPES:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n";
    echo "   1. Vérifiez les doublons ci-dessus\n";
    echo "   2. Si OK, exécutez: mysql -u root -p stock-R4E < $filename\n";
    echo "         OU: php artisan db:seed DatabaseSeeder (si vous l'avez intégré)\n";
    echo "         OU: Copiez-collez dans phpMyAdmin\n";
    echo "   3. Ensuite: php verify-all-platforms-images.php\n\n";

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
