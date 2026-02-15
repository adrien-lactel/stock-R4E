<?php

echo "=== VÉRIFICATION ROM IDs COMPLEXES vs BASE DE DONNÉES ===\n\n";

$localImagePath = 'C:/laragon/www/stock-R4E/public/images/taxonomy/snes';
$railwayDb = [
    'host' => 'mainline.proxy.rlwy.net',
    'port' => '22957',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'lTdgTHUScZteHZQXdVNbmQWsTSaHbxYv'
];

try {
    // 1. Extraire ROM IDs complexes des images
    $localImages = glob($localImagePath . '/*.png');
    $complexRomIds = [];
    
    foreach ($localImages as $imagePath) {
        $filename = basename($imagePath);
        
        // Pattern: ROM ID complexe (avec suffixes comme -JPN, -USA, etc.)
        if (preg_match('/^([A-Z0-9]{2,4}-.+?)-(cover|logo|artwork|gameplay)\.png$/i', $filename, $matches)) {
            $romId = $matches[1];
            $type = $matches[2];
            
            // Exclure les formats standards simples
            if (!preg_match('/^[A-Z0-9]{2,4}-[A-Z0-9]+$/', $romId)) {
                if (!isset($complexRomIds[$romId])) {
                    $complexRomIds[$romId] = [];
                }
                $complexRomIds[$romId][] = $type;
            }
        }
    }
    
    echo "1️⃣ ROM IDs complexes trouvés dans les images: " . count($complexRomIds) . "\n\n";
    
    // 2. Connexion base de données
    echo "2️⃣ Connexion à Railway...\n";
    $pdo = new PDO(
        "mysql:host={$railwayDb['host']};port={$railwayDb['port']};dbname={$railwayDb['database']};charset=utf8mb4",
        $railwayDb['username'],
        $railwayDb['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_TIMEOUT => 30]
    );
    
    $stmt = $pdo->query("SELECT rom_id, name FROM snes_games WHERE rom_id IS NOT NULL AND rom_id != ''");
    $dbGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dbRomIdMap = [];
    
    foreach ($dbGames as $game) {
        $dbRomIdMap[$game['rom_id']] = $game['name'];
    }
    
    echo "   ✅ " . count($dbRomIdMap) . " ROM IDs en base\n\n";
    
    // 3. Analyse des ROM IDs complexes
    echo "3️⃣ Analyse des ROM IDs complexes:\n\n";
    
    $exactMatch = [];
    $canBeSimplified = [];
    $noMatch = [];
    
    foreach ($complexRomIds as $complexRomId => $types) {
        // Vérifier correspondance exacte
        if (isset($dbRomIdMap[$complexRomId])) {
            $exactMatch[$complexRomId] = [
                'types' => $types,
                'game' => $dbRomIdMap[$complexRomId]
            ];
        } else {
            // Tenter de simplifier en retirant le suffixe régional
            $simplified = preg_replace('/-(JPN|USA|EUR|FRA|GER|ITA|SPA|NLD|SWE|NOR|DAN|FIN|KOR|CHN|BRA|AUS)$/i', '', $complexRomId);
            
            if ($simplified !== $complexRomId && isset($dbRomIdMap[$simplified])) {
                $canBeSimplified[$complexRomId] = [
                    'simplified' => $simplified,
                    'types' => $types,
                    'game' => $dbRomIdMap[$simplified]
                ];
            } else {
                $noMatch[$complexRomId] = $types;
            }
        }
    }
    
    echo "   ✅ ROM IDs complexes existant exactement en base: " . count($exactMatch) . "\n";
    echo "   🔧 ROM IDs simplifiables: " . count($canBeSimplified) . "\n";
    echo "   ❌ ROM IDs sans correspondance: " . count($noMatch) . "\n\n";
    
    // 4. Détails des ROM IDs simplifiables
    if (count($canBeSimplified) > 0) {
        echo "4️⃣ ROM IDs qui peuvent être simplifiés (exemples):\n\n";
        
        $examples = array_slice($canBeSimplified, 0, 20, true);
        foreach ($examples as $complex => $data) {
            echo "   📄 Fichier actuel: {$complex}-cover.png\n";
            echo "      ├─ ROM ID simplifié: {$data['simplified']}\n";
            echo "      ├─ Jeu: {$data['game']}\n";
            echo "      ├─ Types: " . implode(', ', $data['types']) . "\n";
            echo "      └─ Action: Renommer en {$data['simplified']}-cover.png\n\n";
        }
        
        // Statistiques sur les suffixes
        echo "   Suffixes trouvés:\n";
        $suffixCount = [];
        
        foreach ($canBeSimplified as $complex => $data) {
            if (preg_match('/-(JPN|USA|EUR|FRA|GER|ITA|SPA|NLD|SWE|NOR|DAN|FIN|KOR|CHN|BRA|AUS)$/i', $complex, $matches)) {
                $suffix = strtoupper($matches[1]);
                if (!isset($suffixCount[$suffix])) {
                    $suffixCount[$suffix] = 0;
                }
                $suffixCount[$suffix]++;
            }
        }
        
        arsort($suffixCount);
        foreach ($suffixCount as $suffix => $count) {
            echo "     • -{$suffix}: {$count} fichiers\n";
        }
        echo "\n";
    }
    
    // 5. ROM IDs sans correspondance
    if (count($noMatch) > 0) {
        echo "5️⃣ ROM IDs sans correspondance en base (exemples):\n\n";
        
        $examples = array_slice($noMatch, 0, 20, true);
        foreach ($examples as $romId => $types) {
            echo "   ❌ {$romId} → Types: " . implode(', ', $types) . "\n";
        }
        echo "\n";
    }
    
    // 6. ROM IDs avec correspondance exacte
    if (count($exactMatch) > 0) {
        echo "6️⃣ ROM IDs complexes existant exactement en base (exemples):\n\n";
        
        $examples = array_slice($exactMatch, 0, 10, true);
        foreach ($examples as $romId => $data) {
            echo "   ✅ {$romId}: {$data['game']}\n";
            echo "      └─ Types: " . implode(', ', $data['types']) . "\n";
        }
        echo "\n";
    }
    
    // 7. Résumé et action recommandée
    echo str_repeat('=', 80) . "\n";
    echo "💡 RECOMMANDATION\n";
    echo str_repeat('=', 80) . "\n\n";
    
    if (count($canBeSimplified) > 0) {
        $totalFilesToRename = count($canBeSimplified) * 2; // Moyenne de 2 types par ROM ID
        
        echo "📌 ACTION PRINCIPALE: Renommer les fichiers avec suffixes régionaux\n\n";
        echo "   • {count($canBeSimplified)} ROM IDs différents\n";
        echo "   • ~{$totalFilesToRename} fichiers à renommer\n\n";
        
        echo "   Exemple de renommage:\n";
        echo "     Avant: SHVC-A20J-JPN-cover.png\n";
        echo "     Après: SHVC-A20J-cover.png\n\n";
        
        echo "   Cela permettra d'augmenter le taux de correspondance de " . 
             round((count($exactMatch) / count($complexRomIds)) * 100, 1) . "% à " .
             round(((count($exactMatch) + count($canBeSimplified)) / count($complexRomIds)) * 100, 1) . "%\n\n";
    }
    
    if (count($noMatch) > 0) {
        echo "⚠️ " . count($noMatch) . " ROM IDs n'ont aucune correspondance en base\n";
        echo "   → Ces images ne seront jamais affichées\n";
        echo "   → Options: ajouter les ROM IDs en base OU supprimer les images\n\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
    exit(1);
}
