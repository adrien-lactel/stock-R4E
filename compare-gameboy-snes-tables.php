<?php

echo "=== COMPARAISON TABLES GAME BOY vs SNES ===\n\n";

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
    
    // Tables à comparer
    $tables = [
        'game_boy_games' => 'Game Boy',
        'snes_games' => 'SNES'
    ];
    
    $structures = [];
    
    foreach ($tables as $tableName => $label) {
        echo "📋 Table: {$label} ({$tableName})\n";
        
        // Vérifier si la table existe
        $stmt = $pdo->query("SHOW TABLES LIKE '{$tableName}'");
        if ($stmt->rowCount() === 0) {
            echo "   ❌ Table n'existe pas\n\n";
            continue;
        }
        
        // Structure
        $stmt = $pdo->query("SHOW COLUMNS FROM {$tableName}");
        $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "   Colonnes:\n";
        $structures[$tableName] = [];
        foreach ($columns as $col) {
            echo "     - {$col['Field']} ({$col['Type']}) " . 
                 ($col['Null'] === 'YES' ? 'NULL' : 'NOT NULL') . "\n";
            $structures[$tableName][] = [
                'field' => $col['Field'],
                'type' => $col['Type'],
                'null' => $col['Null']
            ];
        }
        
        // Stats
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM {$tableName}");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "   📊 Total: {$count} jeux\n";
        
        // ROM IDs
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM {$tableName} WHERE rom_id IS NOT NULL AND rom_id != ''");
        $withRomId = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "   🏷️ Avec ROM ID: {$withRomId} (" . round(($withRomId/$count)*100, 2) . "%)\n";
        
        // Exemples
        echo "   📝 Exemples (3 premiers):\n";
        $stmt = $pdo->query("SELECT id, rom_id, name FROM {$tableName} LIMIT 3");
        $examples = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($examples as $ex) {
            $romId = $ex['rom_id'] ?: '[vide]';
            echo "      • {$romId}: {$ex['name']}\n";
        }
        
        echo "\n";
    }
    
    // Comparaison
    echo str_repeat('=', 70) . "\n";
    echo "📊 COMPARAISON DES STRUCTURES\n";
    echo str_repeat('=', 70) . "\n\n";
    
    if (isset($structures['game_boy_games']) && isset($structures['snes_games'])) {
        $gbColumns = array_column($structures['game_boy_games'], 'field');
        $snesColumns = array_column($structures['snes_games'], 'field');
        
        $commonColumns = array_intersect($gbColumns, $snesColumns);
        $gbOnlyColumns = array_diff($gbColumns, $snesColumns);
        $snesOnlyColumns = array_diff($snesColumns, $gbColumns);
        
        echo "✅ Colonnes communes (" . count($commonColumns) . "):\n";
        foreach ($commonColumns as $col) {
            echo "   - {$col}\n";
        }
        echo "\n";
        
        if (count($gbOnlyColumns) > 0) {
            echo "🟡 Colonnes uniquement dans Game Boy (" . count($gbOnlyColumns) . "):\n";
            foreach ($gbOnlyColumns as $col) {
                echo "   - {$col}\n";
            }
            echo "\n";
        }
        
        if (count($snesOnlyColumns) > 0) {
            echo "🟡 Colonnes uniquement dans SNES (" . count($snesOnlyColumns) . "):\n";
            foreach ($snesOnlyColumns as $col) {
                echo "   - {$col}\n";
            }
            echo "\n";
        }
        
        // Conclusion
        echo str_repeat('=', 70) . "\n";
        echo "💡 CONCLUSION:\n";
        echo str_repeat('=', 70) . "\n\n";
        
        if (count($gbOnlyColumns) === 0 && count($snesOnlyColumns) === 0) {
            echo "✅ Les deux tables ont EXACTEMENT la même structure!\n";
            echo "   La logique est identique pour Game Boy et SNES.\n\n";
        } else {
            $similarity = (count($commonColumns) / max(count($gbColumns), count($snesColumns))) * 100;
            echo "🟡 Les tables ont une structure similaire à " . round($similarity, 2) . "%\n";
            echo "   La logique de base est la même, mais avec quelques différences.\n\n";
        }
        
        echo "🎮 Logique commune:\n";
        echo "   - Colonne rom_id pour identifier les jeux\n";
        echo "   - Colonne name pour le nom du jeu\n";
        echo "   - Même système de recherche (ROM ID + nom)\n";
        echo "   - Même système d'images de taxonomie\n";
        echo "   - Même autocomplétion dans le formulaire\n\n";
        
    } else {
        echo "❌ Impossible de comparer: une ou plusieurs tables manquantes\n\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
    exit(1);
}
