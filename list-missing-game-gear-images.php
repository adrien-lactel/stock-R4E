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
    echo "║           34 IMAGES À AJOUTER EN BASE - GAME GEAR                           ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Récupérer tous les ROM_ID
    $stmt = $pdo->query("SELECT DISTINCT ROM_ID FROM game_gear_games WHERE ROM_ID IS NOT NULL AND ROM_ID != ''");
    $romIds = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $romIds[] = $row['ROM_ID'];
    }

    // Scanner les images
    $imageDir = __DIR__ . '/public/images/taxonomy/gamegear';
    $images = glob($imageDir . '/*.{png,jpg,jpeg}', GLOB_BRACE);
    
    $imagesByBase = [];
    foreach ($images as $imagePath) {
        $filename = basename($imagePath);
        $baseId = preg_replace('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', '', $filename);
        
        if (!isset($imagesByBase[$baseId])) {
            $imagesByBase[$baseId] = [];
        }
        $imagesByBase[$baseId][] = $filename;
    }

    // Trouver les images sans correspondance
    $missing = [];
    foreach ($imagesByBase as $imageId => $files) {
        if (!in_array($imageId, $romIds)) {
            $missing[$imageId] = $files;
        }
    }

    echo "📊 Total images sans correspondance: " . count($missing) . "\n\n";
    echo "📋 LISTE COMPLÈTE:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";

    $count = 1;
    foreach ($missing as $imageId => $files) {
        echo sprintf("%2d. %s\n", $count, $imageId);
        echo "    Fichiers: " . count($files) . " (";
        
        $types = [];
        foreach ($files as $file) {
            if (preg_match('/(cover|logo|artwork|gameplay|display\d+)/i', $file, $m)) {
                $types[] = $m[1];
            }
        }
        echo implode(', ', $types) . ")\n\n";
        
        $count++;
    }

    // Générer le SQL d'insertion
    echo "\n🚀 GÉNÉRATION DU SQL D'INSERTION...\n\n";

    $sql = "-- ══════════════════════════════════════════════════════════════════════════════\n";
    $sql .= "-- AJOUT DES JEUX MANQUANTS - GAME GEAR\n";
    $sql .= "-- Basé sur les images présentes sans entrée en base\n";
    $sql .= "-- ══════════════════════════════════════════════════════════════════════════════\n\n";

    foreach ($missing as $imageId => $files) {
        $nameEscaped = str_replace("'", "''", $imageId);
        $romIdEscaped = $nameEscaped;
        
        $sql .= "INSERT INTO game_gear_games (name, ROM_ID) VALUES ('$nameEscaped', '$romIdEscaped');\n";
        $sql .= "-- Images: " . implode(', ', $files) . "\n\n";
    }

    file_put_contents('add-missing-game-gear-games.sql', $sql);

    echo "✅ Fichier SQL généré: add-missing-game-gear-games.sql\n";
    echo "📊 Total insertions: " . count($missing) . "\n\n";
    echo "🚀 POUR APPLIQUER:\n";
    echo "   php apply-missing-game-gear-games.php\n\n";

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
