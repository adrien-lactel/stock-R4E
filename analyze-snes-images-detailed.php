<?php

echo "=== ANALYSE DÉTAILLÉE DES FICHIERS IMAGES SNES ===\n\n";

$localImagePath = 'C:/laragon/www/stock-R4E/public/images/taxonomy/snes';
$localImages = glob($localImagePath . '/*.png');

$categories = [
    'valid' => [],           // SHVC-XX-cover.png
    'duplicates' => [],      // SHVC-XX-cover-2.png, SHVC-XX-cover-3.png
    'lowercase_romid' => [], // shvc-xx-cover.png
    'complex_romid' => [],   // SHVC-CG-G725179-JPN-cover.png
    'full_name' => [],       // ROM ID - GameName - cover.png
    'other' => []
];

foreach ($localImages as $imagePath) {
    $filename = basename($imagePath);
    
    // Pattern 1: Format standard (SHVC-XX-cover.png)
    if (preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9]+)-(cover|logo|artwork|gameplay)\.png$/i', $filename)) {
        $categories['valid'][] = $filename;
    }
    // Pattern 2: Doublons avec numéro (SHVC-XX-cover-2.png)
    elseif (preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9]+)-(cover|logo|artwork|gameplay)-(\d+)\.png$/i', $filename, $matches)) {
        $categories['duplicates'][] = [
            'file' => $filename,
            'rom_id' => $matches[1],
            'type' => $matches[2],
            'number' => $matches[3]
        ];
    }
    // Pattern 3: ROM ID en minuscules (shvc-xx-cover.png)
    elseif (preg_match('/^([a-z0-9]{2,4}-[a-z0-9]+)-(cover|logo|artwork|gameplay)\.png$/', $filename, $matches)) {
        $categories['lowercase_romid'][] = [
            'file' => $filename,
            'rom_id' => strtoupper($matches[1]),
            'type' => $matches[2]
        ];
    }
    // Pattern 4: ROM ID complexe avec suffixes (SHVC-CG-G725179-JPN-cover.png)
    elseif (preg_match('/^([A-Z0-9]{2,4}-.+?)-(cover|logo|artwork|gameplay)\.png$/i', $filename, $matches)) {
        $categories['complex_romid'][] = [
            'file' => $filename,
            'rom_id' => $matches[1],
            'type' => $matches[2]
        ];
    }
    // Pattern 5: Avec nom complet du jeu (SHVC-XX - Game Name - cover.png)
    elseif (preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s+-\s+(.+?)-(cover|logo|artwork|gameplay)\.png$/i', $filename, $matches)) {
        $categories['full_name'][] = [
            'file' => $filename,
            'rom_id' => $matches[1],
            'game_name' => $matches[2],
            'type' => $matches[3]
        ];
    }
    // Autres cas
    else {
        $categories['other'][] = $filename;
    }
}

echo "📊 DISTRIBUTION PAR CATÉGORIE\n";
echo str_repeat('=', 80) . "\n\n";

echo "✅ FORMAT STANDARD (ROM_ID-type.png):\n";
echo "   Total: " . count($categories['valid']) . " fichiers\n";
echo "   Exemples: " . implode(', ', array_slice($categories['valid'], 0, 5)) . "\n\n";

echo "🔄 DOUBLONS (ROM_ID-type-2.png):\n";
echo "   Total: " . count($categories['duplicates']) . " fichiers\n";
if (count($categories['duplicates']) > 0) {
    echo "   Exemples:\n";
    foreach (array_slice($categories['duplicates'], 0, 10) as $dup) {
        echo "     • {$dup['file']} → ROM ID: {$dup['rom_id']}, Type: {$dup['type']}, Version: {$dup['number']}\n";
    }
}
echo "\n";

echo "🔡 ROM ID EN MINUSCULES (shvc-xx-type.png):\n";
echo "   Total: " . count($categories['lowercase_romid']) . " fichiers\n";
if (count($categories['lowercase_romid']) > 0) {
    echo "   Exemples:\n";
    foreach (array_slice($categories['lowercase_romid'], 0, 10) as $low) {
        echo "     • {$low['file']} → ROM ID corrigé: {$low['rom_id']}, Type: {$low['type']}\n";
    }
}
echo "\n";

echo "🔧 ROM ID COMPLEXE (avec suffixes supplémentaires):\n";
echo "   Total: " . count($categories['complex_romid']) . " fichiers\n";
if (count($categories['complex_romid']) > 0) {
    echo "   Exemples:\n";
    foreach (array_slice($categories['complex_romid'], 0, 10) as $complex) {
        echo "     • {$complex['file']}\n";
        echo "       └─ ROM ID: {$complex['rom_id']}, Type: {$complex['type']}\n";
    }
}
echo "\n";

echo "📝 AVEC NOM COMPLET (ROM_ID - GameName - type.png):\n";
echo "   Total: " . count($categories['full_name']) . " fichiers\n";
if (count($categories['full_name']) > 0) {
    echo "   Exemples:\n";
    foreach (array_slice($categories['full_name'], 0, 10) as $full) {
        echo "     • {$full['file']}\n";
        echo "       └─ ROM ID: {$full['rom_id']}, Jeu: {$full['game_name']}, Type: {$full['type']}\n";
    }
}
echo "\n";

echo "❓ AUTRES FORMATS NON RECONNUS:\n";
echo "   Total: " . count($categories['other']) . " fichiers\n";
if (count($categories['other']) > 0) {
    echo "   Exemples:\n";
    foreach (array_slice($categories['other'], 0, 10) as $other) {
        echo "     • {$other}\n";
    }
}
echo "\n";

// Résumé
echo str_repeat('=', 80) . "\n";
echo "📊 RÉSUMÉ\n";
echo str_repeat('=', 80) . "\n\n";

$total = count($localImages);
$valid = count($categories['valid']);
$fixable = count($categories['duplicates']) + count($categories['lowercase_romid']) + count($categories['complex_romid']) + count($categories['full_name']);
$problematic = count($categories['other']);

echo "Total d'images: {$total}\n\n";

echo "✅ Fichiers au format correct: {$valid} (" . round($valid/$total*100, 1) . "%)\n";
echo "🔧 Fichiers corrigeables: {$fixable} (" . round($fixable/$total*100, 1) . "%)\n";
echo "   • Doublons (à décider): " . count($categories['duplicates']) . "\n";
echo "   • Minuscules (renommage): " . count($categories['lowercase_romid']) . "\n";
echo "   • ROM ID complexes (vérifier base): " . count($categories['complex_romid']) . "\n";
echo "   • Avec nom complet (renommage): " . count($categories['full_name']) . "\n";
echo "❓ Fichiers problématiques: {$problematic} (" . round($problematic/$total*100, 1) . "%)\n\n";

// Actions recommandées
echo str_repeat('=', 80) . "\n";
echo "💡 ACTIONS RECOMMANDÉES\n";
echo str_repeat('=', 80) . "\n\n";

if (count($categories['duplicates']) > 0) {
    echo "1️⃣ DOUBLONS (" . count($categories['duplicates']) . " fichiers):\n";
    echo "   → Ces fichiers ont le suffixe -2, -3, etc.\n";
    echo "   → Options:\n";
    echo "      a) Les supprimer (garder uniquement la version principale)\n";
    echo "      b) Les renommer en variantes (ex: SHVC-XX-cover-alt.png)\n";
    echo "      c) Les garder comme backup\n\n";
}

if (count($categories['lowercase_romid']) > 0) {
    echo "2️⃣ MINUSCULES (" . count($categories['lowercase_romid']) . " fichiers):\n";
    echo "   → Renommer avec ROM ID en majuscules\n";
    echo "   → Exemple: shvc-3g-JPN-cover.png → SHVC-3G-JPN-cover.png\n\n";
}

if (count($categories['complex_romid']) > 0) {
    echo "3️⃣ ROM ID COMPLEXES (" . count($categories['complex_romid']) . " fichiers):\n";
    echo "   → Vérifier si ces ROM IDs existent dans la base de données\n";
    echo "   → Si non, simplifier le ROM ID ou ajouter les entrées en base\n\n";
}

if (count($categories['full_name']) > 0) {
    echo "4️⃣ AVEC NOM COMPLET (" . count($categories['full_name']) . " fichiers):\n";
    echo "   → Renommer en format standard: ROM_ID-type.png\n";
    echo "   → Suppression automatique du nom de jeu possible\n\n";
}
