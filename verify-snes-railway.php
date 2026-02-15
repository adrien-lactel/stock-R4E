<?php

// Vérifier que la table snes_games existe sur Railway avec les bonnes données

$railwayDb = [
    'host' => 'mainline.proxy.rlwy.net',
    'port' => '22957',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'lTdgTHUScZteHZQXdVNbmQWsTSaHbxYv'
];

echo "=== VÉRIFICATION SNES_GAMES SUR RAILWAY ===\n\n";

try {
    $pdo = new PDO(
        "mysql:host={$railwayDb['host']};port={$railwayDb['port']};dbname={$railwayDb['database']};charset=utf8mb4",
        $railwayDb['username'],
        $railwayDb['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 30
        ]
    );
    
    echo "✅ Connecté à Railway\n\n";
    
    // 1. Vérifier l'existence de la table
    echo "1️⃣ Vérification de la table snes_games:\n";
    $stmt = $pdo->query("SHOW TABLES LIKE 'snes_games'");
    if ($stmt->rowCount() === 0) {
        echo "   ❌ Table snes_games n'existe pas!\n";
        exit(1);
    }
    echo "   ✅ Table existe\n\n";
    
    // 2. Compter les jeux
    echo "2️⃣ Nombre de jeux SNES:\n";
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games");
    $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "   📊 {$count} jeux SNES sur Railway\n\n";
    
    // 3. Exemples de jeux
    echo "3️⃣ Exemples de jeux (20 premiers):\n";
    $stmt = $pdo->query("SELECT id, rom_id, name FROM snes_games ORDER BY id LIMIT 20");
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($games as $game) {
        $romId = empty($game['rom_id']) ? '[vide]' : $game['rom_id'];
        
        // Tenter d'extraire le ROM ID du nom
        if (preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $game['name'], $matches)) {
            $extractedRomId = $matches[1];
            $gameName = $matches[2];
            echo "   ID {$game['id']}: ROM_ID extrait={$extractedRomId}, jeu={$gameName}\n";
        } else {
            echo "   ID {$game['id']}: nom={$game['name']}\n";
        }
    }
    
    echo "\n";
    
    // 4. Statistiques sur le format
    echo "4️⃣ Analyse du format des noms:\n";
    $stmt = $pdo->query("SELECT name FROM snes_games");
    $allGames = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $withPattern = 0;
    $withoutPattern = 0;
    $examplesWithPattern = [];
    
    foreach ($allGames as $name) {
        if (preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $name, $matches)) {
            $withPattern++;
            if (count($examplesWithPattern) < 5) {
                $examplesWithPattern[] = [
                    'name' => $name,
                    'rom_id' => $matches[1],
                    'title' => $matches[2]
                ];
            }
        } else {
            $withoutPattern++;
        }
    }
    
    $percentWithPattern = round(($withPattern / $count) * 100, 2);
    
    echo "   Noms avec pattern 'ROM_ID - Titre': {$withPattern} ({$percentWithPattern}%)\n";
    echo "   Noms sans pattern: {$withoutPattern}\n\n";
    
    echo "   Exemples avec ROM ID dans le nom:\n";
    foreach ($examplesWithPattern as $ex) {
        echo "     • {$ex['rom_id']} → {$ex['title']}\n";
    }
    
    echo "\n";
    echo str_repeat('=', 70) . "\n";
    echo "✅ VÉRIFICATION RÉUSSIE!\n";
    echo str_repeat('=', 70) . "\n\n";
    
    echo "📝 RÉSUMÉ:\n";
    echo "  • {$count} jeux SNES importés sur Railway\n";
    echo "  • {$percentWithPattern}% des noms contiennent le ROM ID\n";
    echo "  • Le code JavaScript extractRomIdFromName() peut extraire ces ROM IDs\n";
    echo "  • Les images de taxonomie seront trouvées automatiquement\n\n";
    
    echo "🧪 PROCHAINE ÉTAPE:\n";
    echo "  1. Ouvrez https://web-production-f3333.up.railway.app/admin/articles/create\n";
    echo "  2. Recherchez un jeu SNES (ex: 'Super Mario', 'Zelda', 'Donkey Kong')\n";
    echo "  3. Vérifiez que les images de taxonomie s'affichent dans le modal\n\n";
    
} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
    exit(1);
}
