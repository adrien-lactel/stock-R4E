<?php

echo "=== VÉRIFICATION ROM_ID SUR RAILWAY ===\n\n";

$railwayDb = [
    'host' => 'mainline.proxy.rlwy.net',
    'port' => '22957',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'lTdgTHUScZteHZQXdVNbmQWsTSaHbxYv'
];

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
    
    // 1. Vérifier la structure
    echo "1️⃣ Structure de la table snes_games:\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM snes_games");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "   Colonnes:\n";
    foreach ($columns as $col) {
        echo "     - {$col['Field']} ({$col['Type']})\n";
    }
    echo "\n";
    
    // 2. Total
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games");
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "2️⃣ Total de jeux: {$total}\n\n";
    
    // 3. Analyser les ROM IDs
    echo "3️⃣ Analyse des ROM IDs:\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games WHERE rom_id IS NOT NULL AND rom_id != ''");
    $withRomId = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games WHERE rom_id IS NULL OR rom_id = ''");
    $withoutRomId = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "   Avec ROM ID rempli: {$withRomId} (" . round(($withRomId/$total)*100, 2) . "%)\n";
    echo "   Sans ROM ID: {$withoutRomId} (" . round(($withoutRomId/$total)*100, 2) . "%)\n\n";
    
    // 4. Exemples avec ROM ID
    if ($withRomId > 0) {
        echo "4️⃣ Exemples de jeux AVEC ROM ID sur Railway (20 premiers):\n";
        $stmt = $pdo->query("SELECT id, rom_id, name FROM snes_games WHERE rom_id IS NOT NULL AND rom_id != '' LIMIT 20");
        $gamesWithRomId = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($gamesWithRomId as $game) {
            echo "   ID {$game['id']}: rom_id='{$game['rom_id']}', name='{$game['name']}'\n";
        }
        echo "\n";
        
        // Vérifier les SHVC spécifiquement
        echo "5️⃣ Jeux SHVC (format japonais Super Famicom):\n";
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games WHERE rom_id LIKE 'SHVC-%'");
        $shvcCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "   Nombre de jeux SHVC: {$shvcCount}\n\n";
        
        if ($shvcCount > 0) {
            echo "   Exemples:\n";
            $stmt = $pdo->query("SELECT id, rom_id, name FROM snes_games WHERE rom_id LIKE 'SHVC-%' LIMIT 10");
            $shvcGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($shvcGames as $game) {
                echo "     • {$game['rom_id']}: {$game['name']}\n";
            }
        }
        
    } else {
        echo "   ❌ AUCUN ROM ID sur Railway!\n";
        echo "   L'import n'a pas transféré les ROM IDs\n";
    }
    
    echo "\n";
    echo str_repeat('=', 70) . "\n";
    echo "📝 RÉSULTAT:\n";
    echo str_repeat('=', 70) . "\n\n";
    
    if ($withRomId > 0) {
        echo "✅ Les ROM IDs ont été importés avec succès sur Railway!\n";
        echo "   {$withRomId} jeux ont leur ROM ID renseigné\n\n";
        echo "   Les images de taxonomie devraient fonctionner pour ces jeux\n";
    } else {
        echo "❌ Les ROM IDs n'ont PAS été importés!\n";
        echo "   Il faut refaire l'import\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
    exit(1);
}
