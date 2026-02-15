<?php

echo "=== ANALYSE DES FICHIERS IMAGES SNES INVALIDES ===\n\n";

$localImagePath = 'C:/laragon/www/stock-R4E/public/images/taxonomy/snes';

// Lister toutes les images
$localImages = glob($localImagePath . '/*.png');

$validImages = [];
$invalidImages = [];

foreach ($localImages as $imagePath) {
    $filename = basename($imagePath);
    
    // Pattern attendu: SHVC-23-cover.png, DMG-XX-logo.png, etc.
    if (preg_match('/^([A-Z0-9\-]+)-(cover|logo|artwork|gameplay)\.png$/i', $filename, $matches)) {
        $validImages[] = $filename;
    } else {
        $invalidImages[] = $filename;
    }
}

echo "📊 Total: " . count($localImages) . " images\n";
echo "✅ Valides: " . count($validImages) . "\n";
echo "❌ Invalides: " . count($invalidImages) . "\n\n";

echo str_repeat('=', 80) . "\n";
echo "EXEMPLES DE FICHIERS INVALIDES (50 premiers)\n";
echo str_repeat('=', 80) . "\n\n";

// Grouper par pattern pour comprendre la structure
$patterns = [];

foreach (array_slice($invalidImages, 0, 100) as $filename) {
    // Analyser la structure
    if (preg_match('/-(cover|logo|artwork|gameplay)\.png$/i', $filename, $matches)) {
        $type = strtolower($matches[1]);
        $nameWithoutType = str_replace('-' . $matches[1] . '.png', '', $filename);
        
        if (!isset($patterns['with_type'])) {
            $patterns['with_type'] = [];
        }
        $patterns['with_type'][] = [
            'full' => $filename,
            'name' => $nameWithoutType,
            'type' => $type,
            'length' => strlen($nameWithoutType)
        ];
    } else {
        if (!isset($patterns['without_type'])) {
            $patterns['without_type'] = [];
        }
        $patterns['without_type'][] = [
            'full' => $filename,
            'length' => strlen($filename)
        ];
    }
}

// Afficher les fichiers avec type mais nom invalide
if (isset($patterns['with_type'])) {
    echo "🔍 CATÉGORIE 1: Fichiers avec suffixe type (-cover, -artwork, etc.) mais nom invalide\n";
    echo "   Total dans cette catégorie: " . count($patterns['with_type']) . "\n\n";
    
    // Grouper par longueur pour identifier les patterns
    $byLength = [];
    foreach ($patterns['with_type'] as $img) {
        $len = $img['length'];
        if (!isset($byLength[$len])) {
            $byLength[$len] = [];
        }
        $byLength[$len][] = $img;
    }
    
    echo "   Distribution par longueur de nom:\n";
    foreach ($byLength as $len => $items) {
        echo "     - {$len} caractères: " . count($items) . " fichiers\n";
    }
    echo "\n";
    
    echo "   Exemples (20 premiers):\n";
    foreach (array_slice($patterns['with_type'], 0, 20) as $img) {
        $truncated = strlen($img['name']) > 60 ? substr($img['name'], 0, 60) . '...' : $img['name'];
        echo "     📄 {$img['full']}\n";
        echo "        └─ Nom: '{$truncated}' ({$img['length']} char)\n";
        echo "        └─ Type: {$img['type']}\n";
    }
    echo "\n";
}

// Afficher les fichiers sans type
if (isset($patterns['without_type'])) {
    echo "🔍 CATÉGORIE 2: Fichiers sans suffixe type standard\n";
    echo "   Total dans cette catégorie: " . count($patterns['without_type']) . "\n\n";
    
    echo "   Exemples (20 premiers):\n";
    foreach (array_slice($patterns['without_type'], 0, 20) as $img) {
        $truncated = strlen($img['full']) > 70 ? substr($img['full'], 0, 70) . '...' : $img['full'];
        echo "     📄 {$truncated}\n";
    }
    echo "\n";
}

// Rechercher des patterns communs dans les noms invalides
echo str_repeat('=', 80) . "\n";
echo "ANALYSE DES PATTERNS COMMUNS\n";
echo str_repeat('=', 80) . "\n\n";

$hasJapaneseChars = 0;
$hasSpaces = 0;
$hasParentheses = 0;
$hasCommas = 0;
$veryLong = 0; // > 50 chars
$startsWithRomId = 0;

foreach ($invalidImages as $filename) {
    // Retirer .png pour analyser le nom
    $name = str_replace('.png', '', $filename);
    
    if (preg_match('/[\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{4E00}-\x{9FFF}]/u', $name)) {
        $hasJapaneseChars++;
    }
    if (strpos($name, ' ') !== false) {
        $hasSpaces++;
    }
    if (preg_match('/[()]/', $name)) {
        $hasParentheses++;
    }
    if (strpos($name, ',') !== false) {
        $hasCommas++;
    }
    if (strlen($name) > 50) {
        $veryLong++;
    }
    // Commence par un pattern ROM ID mais nom trop long
    if (preg_match('/^[A-Z]{2,4}-[A-Z0-9\-]+\s+/i', $name)) {
        $startsWithRomId++;
    }
}

echo "Caractéristiques des fichiers invalides:\n\n";
echo "  • Contiennent des caractères japonais: {$hasJapaneseChars}\n";
echo "  • Contiennent des espaces: {$hasSpaces}\n";
echo "  • Contiennent des parenthèses: {$hasParentheses}\n";
echo "  • Contiennent des virgules: {$hasCommas}\n";
echo "  • Très longs (>50 char): {$veryLong}\n";
echo "  • Commencent par un ROM ID: {$startsWithRomId}\n\n";

// Tenter d'extraire le ROM ID des fichiers qui commencent par un pattern valide
echo str_repeat('=', 80) . "\n";
echo "TENTATIVE D'EXTRACTION ROM ID (fichiers commençant par pattern valide)\n";
echo str_repeat('=', 80) . "\n\n";

$extractable = [];
foreach ($invalidImages as $filename) {
    // Tenter d'extraire ROM ID du début
    if (preg_match('/^([A-Z]{2,4}-[A-Z0-9\-]+?)\s+-\s+(.+)-(cover|logo|artwork|gameplay)\.png$/i', $filename, $matches)) {
        $extractable[] = [
            'filename' => $filename,
            'rom_id' => $matches[1],
            'game_name' => $matches[2],
            'type' => $matches[3]
        ];
    }
}

if (count($extractable) > 0) {
    echo "✅ {count($extractable)} fichiers peuvent être renommés automatiquement!\n\n";
    echo "Exemples (20 premiers):\n";
    foreach (array_slice($extractable, 0, 20) as $file) {
        echo "  📄 Actuel: {$file['filename']}\n";
        echo "     └─ ROM ID: {$file['rom_id']}\n";
        echo "     └─ Jeu: {$file['game_name']}\n";
        echo "     └─ Type: {$file['type']}\n";
        echo "     └─ Nouveau: {$file['rom_id']}-{$file['type']}.png\n\n";
    }
} else {
    echo "❌ Aucun fichier ne peut être renommé avec le pattern standard\n\n";
}

echo "\n💡 CONCLUSION:\n";
echo "  • {count($validImages)} fichiers sont déjà au bon format\n";
echo "  • {count($invalidImages)} fichiers ont un format invalide\n";
if (count($extractable) > 0) {
    echo "  • {count($extractable)} peuvent être renommés automatiquement (pattern ROM ID détecté)\n";
    echo "  • " . (count($invalidImages) - count($extractable)) . " nécessitent un traitement manuel\n";
}
