<?php

// Configuration Railway
$db = [
    'host' => 'autorack.proxy.rlwy.net',
    'port' => '52972',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'nUUEFrRvjBuIpUBrHhTmfNcafgikfNQB'
];

echo "=== ANALYSE ARTICLE_TYPES (JEUX SNES) SUR RAILWAY ===\n\n";

try {
    $pdo = new PDO(
        "mysql:host={$db['host']};port={$db['port']};dbname={$db['database']};charset=utf8mb4",
        $db['username'],
        $db['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 10
        ]
    );
    
    echo "✅ Connexion à Railway réussie\n\n";
    
    // 1. Trouver les jeux SNES dans article_types
    echo "1️⃣ Recherche des jeux SNES dans article_types:\n\n";
    
    // D'abord, trouver l'ID de la sous-catégorie SNES
    $stmt = $pdo->query("
        SELECT id, name 
        FROM article_sub_categories 
        WHERE name LIKE '%snes%' OR name LIKE '%super nintendo%'
        LIMIT 5
    ");
    $snesSubCats = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    echo "  Sous-catégories SNES trouvées:\n";
    foreach ($snesSubCats as $cat) {
        echo "    - ID {$cat['id']}: {$cat['name']}\n";
    }
    echo "\n";
    
    // Prendre le premier ID de sous-catégorie SNES
    if (count($snesSubCats) > 0) {
        $snesSubCatId = $snesSubCats[0]['id'];
        
        // 2. Analyser les article_types pour SNES
        echo "2️⃣ Analyse des jeux SNES (article_types avec sub_category_id={$snesSubCatId}):\n\n";
        
        $stmt = $pdo->query("
            SELECT COUNT(*) as total 
            FROM article_types 
            WHERE article_sub_category_id = {$snesSubCatId}
        ");
        $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        echo "  Total de jeux SNES: {$total}\n\n";
        
        // 3. Exemples de jeux
        echo "3️⃣ Exemples de jeux SNES (15 premiers):\n\n";
        
        $stmt = $pdo->query("
            SELECT id, name, rom_id 
            FROM article_types 
            WHERE article_sub_category_id = {$snesSubCatId}
            ORDER BY id ASC
            LIMIT 15
        ");
        $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($games as $game) {
            echo "  ID {$game['id']}:\n";
            echo "    rom_id: " . ($game['rom_id'] ?? 'NULL') . "\n";
            echo "    name: " . ($game['name'] ?? 'NULL') . "\n";
            
            // Analyser le format du nom
            if ($game['name'] && $game['rom_id']) {
                $nameContainsRomId = stripos($game['name'], $game['rom_id']) !== false;
                if ($nameContainsRomId) {
                    echo "    ⚠️ Le nom contient le ROM ID (duplication)\n";
                } else {
                    echo "    ✅ ROM ID et nom sont séparés\n";
                }
            } elseif ($game['name'] && !$game['rom_id']) {
                preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $game['name'], $matches);
                if ($matches) {
                    echo "    ⚠️ ROM ID détecté dans le nom: {$matches[1]}\n";
                    echo "    ⚠️ Vrai nom du jeu: {$matches[2]}\n";
                    echo "    ❌ Colonne rom_id est vide!\n";
                }
            }
            echo "\n";
        }
        
        // 4. Statistiques sur le format
        echo "4️⃣ Statistiques sur le format des données:\n\n";
        
        $stmt = $pdo->query("
            SELECT 
                COUNT(*) as count_with_rom_id
            FROM article_types 
            WHERE article_sub_category_id = {$snesSubCatId}
              AND rom_id IS NOT NULL 
              AND rom_id != ''
        ");
        $withRomId = $stmt->fetch(PDO::FETCH_ASSOC)['count_with_rom_id'];
        
        $stmt = $pdo->query("
            SELECT 
                COUNT(*) as count_without_rom_id
            FROM article_types 
            WHERE article_sub_category_id = {$snesSubCatId}
              AND (rom_id IS NULL OR rom_id = '')
        ");
        $withoutRomId = $stmt->fetch(PDO::FETCH_ASSOC)['count_without_rom_id'];
        
        echo "  Jeux avec rom_id rempli: {$withRomId} (" . round(($withRomId / $total) * 100, 2) . "%)\n";
        echo "  Jeux sans rom_id: {$withoutRomId} (" . round(($withoutRomId / $total) * 100, 2) . "%)\n\n";
        
        // 5. Analyser le pattern dans les noms
        echo "5️⃣ Analyse du pattern 'ROM_ID - Nom' dans les noms:\n\n";
        
        $stmt = $pdo->query("
            SELECT name, rom_id
            FROM article_types 
            WHERE article_sub_category_id = {$snesSubCatId}
        ");
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
        echo "  Noms propres uniquement: {$namesWithoutPattern} (" . round(($namesWithoutPattern / $total) * 100, 2) . "%)\n\n";
        
        // 6. Exemples détaillés
        echo "6️⃣ Exemples de jeux avec pattern 'ROM_ID - Nom':\n\n";
        foreach ($examplesWithPattern as $game) {
            preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $game['name'], $matches);
            echo "  Colonne rom_id: " . ($game['rom_id'] ?? 'NULL') . "\n";
            echo "  Colonne name: {$game['name']}\n";
            echo "  → ROM ID extrait: {$matches[1]}\n";
            echo "  → Nom du jeu: {$matches[2]}\n\n";
        }
        
        echo "7️⃣ Exemples de jeux avec nom propre:\n\n";
        foreach ($examplesWithoutPattern as $game) {
            echo "  Colonne rom_id: " . ($game['rom_id'] ?? 'NULL') . "\n";
            echo "  Colonne name: {$game['name']}\n\n";
        }
        
    } else {
        echo "❌ Aucune sous-catégorie SNES trouvée\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n" . str_repeat('=', 70) . "\n";
echo "💡 DIAGNOSTIC:\n";
echo str_repeat('=', 70) . "\n\n";

if (isset($namesWithPattern) && isset($total)) {
    $percentWithPattern = round(($namesWithPattern / $total) * 100, 2);
    
    if ($percentWithPattern > 80) {
        echo "🔴 PROBLÈME MAJEUR DÉTECTÉ:\n\n";
        echo "   {$percentWithPattern}% des jeux ont le format 'ROM_ID - Nom' dans la colonne name!\n\n";
        echo "   Cela signifie que lors de l'import:\n";
        echo "   - Les ROM IDs ont été concaténés avec les noms de jeux\n";
        echo "   - La colonne rom_id est probablement vide ou mal remplie\n";
        echo "   - Le système doit extraire le ROM ID du nom pour trouver les images\n\n";
        
        echo "   C'est pourquoi le code JavaScript extractRomIdFromName() a été créé!\n\n";
        
        echo "   OPTIONS DE CORRECTION:\n";
        echo "   A) Garder le code JavaScript (solution actuelle) ✅\n";
        echo "      → Continue d'extraire le ROM ID du nom à la volée\n";
        echo "      → Pas de modification en base de données\n\n";
        
        echo "   B) Nettoyer la base de données (solution permanente)\n";
        echo "      → Créer une migration pour séparer ROM ID et nom\n";
        echo "      → Remplir la colonne rom_id avec les valeurs extraites\n";
        echo "      → Nettoyer la colonne name pour ne garder que le titre\n";
        echo "      → Retirer le code extractRomIdFromName()\n\n";
        
    } elseif ($percentWithPattern > 20) {
        echo "🟠 PROBLÈME PARTIEL DÉTECTÉ:\n\n";
        echo "   {$percentWithPattern}% des jeux ont le format 'ROM_ID - Nom'\n";
        echo "   Les données sont mixtes (certains propres, d'autres mélangés)\n\n";
        
    } else {
        echo "✅ STRUCTURE NORMALE:\n\n";
        echo "   Seulement {$percentWithPattern}% des jeux ont le pattern dans le nom\n";
        echo "   La majorité des données sont correctement séparées\n\n";
    }
}
