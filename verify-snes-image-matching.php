<?php

echo "=== VÉRIFICATION CORRESPONDANCE IMAGES SNES ↔ BASE DE DONNÉES ===\n\n";

$localImagePath = 'C:/laragon/www/stock-R4E/public/images/taxonomy/snes';
$railwayDb = [
    'host' => 'mainline.proxy.rlwy.net',
    'port' => '22957',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'lTdgTHUScZteHZQXdVNbmQWsTSaHbxYv'
];

try {
    // 1. Lister les images locales
    echo "1️⃣ Scan des images locales...\n";
    $localImages = glob($localImagePath . '/*.png');
    $totalLocalImages = count($localImages);
    echo "   📁 {$totalLocalImages} images PNG trouvées\n\n";
    
    // Analyser les noms de fichiers
    $imagesByRomId = [];
    $invalidFileNames = [];
    
    foreach ($localImages as $imagePath) {
        $filename = basename($imagePath);
        
        // Pattern attendu: SHVC-23-cover.png, DMG-XX-logo.png, etc.
        if (preg_match('/^([A-Z0-9\-]+)-(cover|logo|artwork|gameplay)\.png$/i', $filename, $matches)) {
            $romId = $matches[1];
            $type = strtolower($matches[2]);
            
            if (!isset($imagesByRomId[$romId])) {
                $imagesByRomId[$romId] = [];
            }
            $imagesByRomId[$romId][] = $type;
        } else {
            $invalidFileNames[] = $filename;
        }
    }
    
    $uniqueRomIdsInImages = count($imagesByRomId);
    echo "2️⃣ Analyse des noms de fichiers:\n";
    echo "   ✅ ROM IDs uniques trouvés dans les images: {$uniqueRomIdsInImages}\n";
    echo "   ❌ Fichiers avec nom invalide: " . count($invalidFileNames) . "\n\n";
    
    if (count($invalidFileNames) > 0 && count($invalidFileNames) <= 20) {
        echo "   Exemples de noms invalides:\n";
        foreach (array_slice($invalidFileNames, 0, 20) as $name) {
            echo "     ⚠️ {$name}\n";
        }
        echo "\n";
    }
    
    // 2. Connexion Railway
    echo "3️⃣ Connexion à Railway...\n";
    $pdo = new PDO(
        "mysql:host={$railwayDb['host']};port={$railwayDb['port']};dbname={$railwayDb['database']};charset=utf8mb4",
        $railwayDb['username'],
        $railwayDb['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 30
        ]
    );
    
    $stmt = $pdo->query("SELECT rom_id, name FROM snes_games WHERE rom_id IS NOT NULL AND rom_id != ''");
    $dbGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $dbRomIds = array_column($dbGames, 'rom_id');
    $dbRomIdsSet = array_flip($dbRomIds);
    
    echo "   ✅ " . count($dbRomIds) . " ROM IDs dans la base de données\n\n";
    
    // 3. Correspondance
    echo "4️⃣ Analyse de la correspondance:\n\n";
    
    $matching = [];
    $imagesWithoutDb = [];
    $dbWithoutImages = [];
    
    // Images qui ont un ROM ID en base
    foreach ($imagesByRomId as $romId => $types) {
        if (isset($dbRomIdsSet[$romId])) {
            $matching[$romId] = $types;
        } else {
            $imagesWithoutDb[$romId] = $types;
        }
    }
    
    // ROM IDs en base sans images
    foreach ($dbRomIds as $romId) {
        if (!isset($imagesByRomId[$romId])) {
            // Rechercher le nom du jeu
            foreach ($dbGames as $game) {
                if ($game['rom_id'] === $romId) {
                    $dbWithoutImages[$romId] = $game['name'];
                    break;
                }
            }
        }
    }
    
    $matchingCount = count($matching);
    $imagesWithoutDbCount = count($imagesWithoutDb);
    $dbWithoutImagesCount = count($dbWithoutImages);
    
    echo "   ✅ ROM IDs avec correspondance: {$matchingCount}\n";
    echo "   ⚠️ Images sans ROM ID en base: {$imagesWithoutDbCount}\n";
    echo "   ❌ ROM IDs en base sans images: {$dbWithoutImagesCount}\n\n";
    
    // 4. Détails
    if ($imagesWithoutDbCount > 0) {
        echo "5️⃣ Images sans correspondance en base (exemples):\n";
        $examples = array_slice(array_keys($imagesWithoutDb), 0, 20);
        foreach ($examples as $romId) {
            $types = implode(', ', $imagesWithoutDb[$romId]);
            echo "   ⚠️ {$romId} → Images: {$types}\n";
        }
        echo "\n";
    }
    
    if ($dbWithoutImagesCount > 0) {
        echo "6️⃣ ROM IDs en base sans images (exemples):\n";
        $examples = array_slice($dbWithoutImages, 0, 20, true);
        foreach ($examples as $romId => $name) {
            echo "   ❌ {$romId}: {$name}\n";
        }
        echo "\n";
    }
    
    // 5. Statistiques par type d'image pour les matchs
    echo "7️⃣ Répartition par type d'image (ROM IDs valides):\n";
    $typeCounts = ['cover' => 0, 'logo' => 0, 'artwork' => 0, 'gameplay' => 0];
    
    foreach ($matching as $romId => $types) {
        foreach ($types as $type) {
            if (isset($typeCounts[$type])) {
                $typeCounts[$type]++;
            }
        }
    }
    
    foreach ($typeCounts as $type => $count) {
        echo "   - {$type}: {$count} images\n";
    }
    echo "\n";
    
    // 6. Résumé final
    echo str_repeat('=', 70) . "\n";
    echo "📊 RÉSUMÉ FINAL\n";
    echo str_repeat('=', 70) . "\n\n";
    
    echo "Images locales:\n";
    echo "  • Total de fichiers PNG: {$totalLocalImages}\n";
    echo "  • ROM IDs uniques extraits: {$uniqueRomIdsInImages}\n";
    echo "  • Fichiers avec nom invalide: " . count($invalidFileNames) . "\n\n";
    
    echo "Base de données Railway:\n";
    echo "  • Total ROM IDs SNES: " . count($dbRomIds) . "\n\n";
    
    echo "Correspondance:\n";
    echo "  • ✅ ROM IDs valides avec images: {$matchingCount}\n";
    echo "  • ⚠️ Images sans ROM ID en base: {$imagesWithoutDbCount}\n";
    echo "  • ❌ ROM IDs sans images: {$dbWithoutImagesCount}\n\n";
    
    $matchPercentage = round(($matchingCount / count($dbRomIds)) * 100, 2);
    echo "Taux de couverture: {$matchPercentage}%\n\n";
    
    echo "💡 CONCLUSION:\n";
    if ($imagesWithoutDbCount > 0) {
        echo "  ⚠️ {$imagesWithoutDbCount} images locales ont des ROM IDs qui n'existent pas en base\n";
        echo "     → Ces images sont sur R2 mais ne seront jamais affichées\n";
        echo "     → Vérifiez si ces ROM IDs doivent être ajoutés à la base\n\n";
    }
    
    if ($dbWithoutImagesCount > 0) {
        echo "  ❌ {$dbWithoutImagesCount} ROM IDs en base n'ont pas d'images\n";
        echo "     → Ces jeux n'afficheront pas de miniatures\n";
        echo "     → Il faut trouver et ajouter les images manquantes\n\n";
    }
    
    if ($matchingCount > 0) {
        echo "  ✅ {$matchingCount} jeux SNES sont prêts avec images sur R2!\n";
        echo "     → Ces jeux afficheront correctement leurs miniatures\n\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
    exit(1);
}
