<?php

echo "=== VÉRIFICATION TABLE SNES_GAMES LOCALE ===\n\n";

$localDb = [
    'host' => '127.0.0.1',
    'port' => '3306',
    'database' => 'stock_r4e',
    'username' => 'root',
    'password' => ''
];

try {
    $pdo = new PDO(
        "mysql:host={$localDb['host']};port={$localDb['port']};dbname={$localDb['database']};charset=utf8mb4",
        $localDb['username'],
        $localDb['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    echo "✅ Connecté à la base locale\n\n";
    
    // 1. Structure de la table
    echo "1️⃣ Structure de la table snes_games:\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM snes_games");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "   Colonnes:\n";
    foreach ($columns as $col) {
        echo "     - {$col['Field']} ({$col['Type']})\n";
    }
    echo "\n";
    
    // 2. Compter les jeux
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games");
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "2️⃣ Total de jeux: {$total}\n\n";
    
    // 3. Vérifier les ROM IDs
    echo "3️⃣ Analyse des ROM IDs:\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games WHERE rom_id IS NOT NULL AND rom_id != ''");
    $withRomId = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games WHERE rom_id IS NULL OR rom_id = ''");
    $withoutRomId = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "   Avec ROM ID rempli: {$withRomId} (" . round(($withRomId/$total)*100, 2) . "%)\n";
    echo "   Sans ROM ID: {$withoutRomId} (" . round(($withoutRomId/$total)*100, 2) . "%)\n\n";
    
    // 4. Exemples avec ROM ID
    if ($withRomId > 0) {
        echo "4️⃣ Exemples de jeux AVEC ROM ID (20 premiers):\n";
        $stmt = $pdo->query("SELECT id, rom_id, name FROM snes_games WHERE rom_id IS NOT NULL AND rom_id != '' LIMIT 20");
        $gamesWithRomId = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($gamesWithRomId as $game) {
            echo "   ID {$game['id']}: rom_id='{$game['rom_id']}', name='{$game['name']}'\n";
        }
        echo "\n";
    }
    
    // 5. Exemples sans ROM ID
    echo "5️⃣ Exemples de jeux SANS ROM ID (20 premiers):\n";
    $stmt = $pdo->query("SELECT id, rom_id, name FROM snes_games WHERE rom_id IS NULL OR rom_id = '' LIMIT 20");
    $gamesWithoutRomId = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($gamesWithoutRomId as $game) {
        $romIdValue = is_null($game['rom_id']) ? 'NULL' : "'{$game['rom_id']}'";
        echo "   ID {$game['id']}: rom_id={$romIdValue}, name='{$game['name']}'\n";
    }
    echo "\n";
    
    // 6. Vérifier si ROM IDs sont dans les noms
    echo "6️⃣ Analyse du format des noms:\n";
    $stmt = $pdo->query("SELECT name FROM snes_games");
    $allNames = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    $namesWithPattern = 0;
    $examplesWithPattern = [];
    
    foreach ($allNames as $name) {
        if (preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $name, $matches)) {
            $namesWithPattern++;
            if (count($examplesWithPattern) < 10) {
                $examplesWithPattern[] = [
                    'name' => $name,
                    'rom_id' => $matches[1],
                    'title' => $matches[2]
                ];
            }
        }
    }
    
    echo "   Noms avec pattern 'ROM_ID - Titre': {$namesWithPattern}\n\n";
    
    if (count($examplesWithPattern) > 0) {
        echo "   Exemples:\n";
        foreach ($examplesWithPattern as $ex) {
            echo "     • Nom complet: {$ex['name']}\n";
            echo "       → ROM ID: {$ex['rom_id']}\n";
            echo "       → Titre: {$ex['title']}\n\n";
        }
    }
    
    echo str_repeat('=', 70) . "\n";
    echo "📝 DIAGNOSTIC:\n";
    echo str_repeat('=', 70) . "\n\n";
    
    if ($withRomId > 0) {
        echo "✅ La table locale contient {$withRomId} jeux avec ROM ID dans la colonne rom_id\n";
        echo "   Ces données DEVRAIENT avoir été importées sur Railway\n\n";
    } else {
        echo "⚠️ AUCUN ROM ID dans la colonne rom_id en local!\n";
        echo "   Cela explique pourquoi Railway n'a pas de ROM IDs\n\n";
    }
    
    if ($namesWithPattern > 0) {
        echo "⚠️ {$namesWithPattern} jeux ont le ROM ID dans le nom au format 'ROM_ID - Titre'\n";
        echo "   Il faudrait extraire ces ROM IDs vers la colonne rom_id\n\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
    exit(1);
}
