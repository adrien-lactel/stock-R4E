<?php

// Configuration Railway
$db = [
    'host' => 'autorack.proxy.rlwy.net',
    'port' => '52972',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'nUUEFrRvjBuIpUBrHhTmfNcafgikfNQB'
];

echo "=== ANALYSE SNES_GAMES SUR RAILWAY ===\n\n";

try {
    $pdo = new PDO(
        "mysql:host={$db['host']};port={$db['port']};dbname={$db['database']};charset=utf8mb4",
        $db['username'],
        $db['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    echo "✅ Connexion à Railway réussie\n\n";
    
    // 1. Structure de la table
    echo "1️⃣ Structure de la table snes_games:\n";
    $stmt = $pdo->query("SHOW COLUMNS FROM snes_games");
    $columns = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "\n  Colonnes:\n";
    foreach ($columns as $column) {
        echo "    - {$column['Field']} ({$column['Type']}) " . 
             ($column['Null'] === 'YES' ? 'NULL' : 'NOT NULL') . "\n";
    }
    
    // 2. Exemples de données
    echo "\n2️⃣ Exemples de données (15 premiers jeux):\n\n";
    $stmt = $pdo->query("SELECT id, rom_id, name FROM snes_games LIMIT 15");
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($games as $game) {
        echo "  ID {$game['id']}:\n";
        echo "    rom_id: " . ($game['rom_id'] ?? 'NULL') . "\n";
        echo "    name: " . ($game['name'] ?? 'NULL') . "\n";
        
        // Vérifier si le nom contient le ROM ID
        if ($game['name'] && $game['rom_id']) {
            $nameContainsRomId = stripos($game['name'], $game['rom_id']) !== false;
            if ($nameContainsRomId) {
                echo "    ⚠️ Le nom contient le ROM ID!\n";
            }
        } elseif ($game['name'] && !$game['rom_id']) {
            // Le ROM ID est peut-être dans le nom
            preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $game['name'], $matches);
            if ($matches) {
                echo "    ⚠️ ROM ID détecté dans le nom: {$matches[1]}\n";
                echo "    ⚠️ Vrai nom du jeu: {$matches[2]}\n";
            }
        }
        echo "\n";
    }
    
    // 3. Statistiques globales
    echo "3️⃣ Statistiques:\n\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM snes_games");
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games WHERE rom_id IS NOT NULL AND rom_id != ''");
    $withRomId = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games WHERE rom_id IS NULL OR rom_id = ''");
    $withoutRomId = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "  Total de jeux: {$total}\n";
    echo "  Avec rom_id: {$withRomId} (" . round(($withRomId / $total) * 100, 2) . "%)\n";
    echo "  Sans rom_id: {$withoutRomId} (" . round(($withoutRomId / $total) * 100, 2) . "%)\n\n";
    
    // 4. Analyser le format des noms
    echo "4️⃣ Analyse du format des noms:\n\n";
    
    $stmt = $pdo->query("SELECT name, rom_id FROM snes_games");
    $allGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    $namesWithPattern = 0;
    $namesWithoutPattern = 0;
    $examplesWithPattern = [];
    $examplesWithoutPattern = [];
    
    foreach ($allGames as $game) {
        if ($game['name']) {
            preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $game['name'], $matches);
            if ($matches) {
                $namesWithPattern++;
                if (count($examplesWithPattern) < 5) {
                    $examplesWithPattern[] = $game;
                }
            } else {
                $namesWithoutPattern++;
                if (count($examplesWithoutPattern) < 5) {
                    $examplesWithoutPattern[] = $game;
                }
            }
        }
    }
    
    echo "  Noms avec pattern 'ROM_ID - Nom': {$namesWithPattern} (" . round(($namesWithPattern / $total) * 100, 2) . "%)\n";
    echo "  Noms sans pattern: {$namesWithoutPattern} (" . round(($namesWithoutPattern / $total) * 100, 2) . "%)\n\n";
    
    // 5. Exemples détaillés
    echo "5️⃣ Exemples détaillés:\n\n";
    
    echo "  A) Jeux avec pattern 'ROM_ID - Nom' dans la colonne name:\n";
    foreach ($examplesWithPattern as $game) {
        preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $game['name'], $matches);
        echo "    ⚠️ Colonne rom_id: " . ($game['rom_id'] ?? 'NULL') . "\n";
        echo "       Colonne name: {$game['name']}\n";
        echo "       → ROM ID extrait du nom: {$matches[1]}\n";
        echo "       → Vrai nom du jeu: {$matches[2]}\n\n";
    }
    
    echo "  B) Jeux sans pattern (nom propre uniquement):\n";
    foreach ($examplesWithoutPattern as $game) {
        echo "    Colonne rom_id: " . ($game['rom_id'] ?? 'NULL') . "\n";
        echo "    Colonne name: {$game['name']}\n\n";
    }
    
    // 6. Vérifier si rom_id et name sont cohérents
    echo "6️⃣ Cohérence rom_id vs name:\n\n";
    
    $stmt = $pdo->query("
        SELECT rom_id, name 
        FROM snes_games 
        WHERE rom_id IS NOT NULL 
          AND rom_id != '' 
          AND name LIKE CONCAT(rom_id, '%')
        LIMIT 10
    ");
    $duplicateInfo = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($duplicateInfo) > 0) {
        echo "  ⚠️ Jeux où le ROM ID est à la fois dans la colonne rom_id ET dans le nom:\n";
        foreach ($duplicateInfo as $game) {
            echo "    rom_id: {$game['rom_id']}\n";
            echo "    name: {$game['name']}\n\n";
        }
    } else {
        echo "  ✅ Pas de duplication détectée\n\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n" . str_repeat('=', 70) . "\n";
echo "💡 DIAGNOSTIC:\n";
echo str_repeat('=', 70) . "\n\n";

if ($namesWithPattern > $total * 0.8) {
    echo "🔴 PROBLÈME DÉTECTÉ:\n";
    echo "   Plus de 80% des noms contiennent le format 'ROM_ID - Nom'\n";
    echo "   Cela signifie que les ROM IDs sont stockés dans les noms au lieu\n";
    echo "   d'être séparés dans la colonne rom_id.\n\n";
    echo "   SOLUTION: Créer une migration pour:\n";
    echo "   1. Extraire le ROM ID des noms vers la colonne rom_id\n";
    echo "   2. Nettoyer la colonne name pour ne garder que le nom du jeu\n\n";
} else {
    echo "✅ Structure normale détectée\n";
    echo "   La majorité des jeux ont un format correct.\n\n";
}
