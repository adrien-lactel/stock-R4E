<?php

$path = "C:/laragon/www/stock-R4E/public/images/taxonomy/snes";

if (!is_dir($path)) {
    die("Dossier introuvable: $path\n");
}

$files = glob($path . "/*.png");
$total = count($files);

$stats = [
    'cover' => 0,
    'cover-2' => 0,
    'artwork' => 0,
    'logo' => 0,
    'gameplay' => 0,
];

$romIds = [];

foreach ($files as $file) {
    $filename = basename($file);
    
    // Extraire ROM ID et type
    if (preg_match('/^([A-Z0-9\-]+?)-(cover|artwork|logo|gameplay)(-\d+)?\.png$/i', $filename, $matches)) {
        $romId = $matches[1];
        $type = $matches[2];
        $variant = $matches[3] ?? '';
        
        // Compter par type
        $key = $type . $variant;
        if (isset($stats[$key])) {
            $stats[$key]++;
        } else {
            $stats[$type]++;
        }
        
        // Compter ROM IDs uniques
        if (!isset($romIds[$romId])) {
            $romIds[$romId] = [];
        }
        $romIds[$romId][] = $type . $variant;
    }
}

$uniqueRoms = count($romIds);

echo "=== IMAGES SNES EN LOCAL ===\n\n";
echo "📂 Chemin: $path\n";
echo "📊 Total d'images PNG: $total\n\n";

echo "Répartition par type:\n";
echo "  • Covers (principale): " . ($stats['cover'] - $stats['cover-2']) . "\n";
echo "  • Covers (alternative -2): {$stats['cover-2']}\n";
echo "  • Artworks: {$stats['artwork']}\n";
echo "  • Logos: {$stats['logo']}\n";
echo "  • Gameplay: {$stats['gameplay']}\n\n";

echo "ROM IDs uniques avec images: $uniqueRoms\n\n";

// Exemples
echo "Exemples (10 premiers ROM IDs):\n";
$count = 0;
foreach ($romIds as $romId => $types) {
    if ($count >= 10) break;
    $typesList = implode(', ', $types);
    echo "  • $romId: $typesList\n";
    $count++;
}

echo "\n" . str_repeat("=", 70) . "\n";
echo "📊 COMPARAISON LOCAL vs R2\n";
echo str_repeat("=", 70) . "\n\n";

echo "EN LOCAL:\n";
echo "  • Total d'images: $total\n";
echo "  • ROM IDs uniques: $uniqueRoms\n\n";

echo "SUR R2 (d'après la dernière vérification):\n";
echo "  • Total d'images: 749 (495 covers + 254 artworks)\n";
echo "  • ROM IDs uniques: 495\n\n";

$diffImages = $total - 749;
$diffRoms = $uniqueRoms - 495;

echo "💡 DIFFÉRENCE:\n";
echo "  • +$diffImages images supplémentaires en local\n";
echo "  • +$diffRoms ROM IDs supplémentaires en local\n\n";

if ($diffImages > 0) {
    $percent = round(($diffImages / $total) * 100, 2);
    echo "⚠️ Le dossier local contient " . $percent . "% d'images EN PLUS que R2!\n";
    echo "   → Envisagez de synchroniser les images locales vers R2\n";
}
