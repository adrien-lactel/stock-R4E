<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$typeId = 910; // Type avec des images

echo "=== Test d'exclusion des images de taxonomie ===\n\n";

$articleType = \App\Models\ArticleType::find($typeId);
if (!$articleType) {
    echo "Type $typeId non trouvé\n";
    exit;
}

echo "Type ID: {$articleType->id} - {$articleType->rom_id} - {$articleType->name}\n\n";

// Images à exclure (taxonomie)
$excludedImages = [];
if (!empty($articleType->images) && is_array($articleType->images)) {
    $excludedImages = array_merge($excludedImages, $articleType->images);
}
if (!empty($articleType->cover_image)) {
    $excludedImages[] = $articleType->cover_image;
}
if (!empty($articleType->artwork_image)) {
    $excludedImages[] = $articleType->artwork_image;
}
if (!empty($articleType->gameplay_image)) {
    $excludedImages[] = $articleType->gameplay_image;
}

echo "--- Images à EXCLURE (taxonomie) ---\n";
foreach ($excludedImages as $idx => $img) {
    $parts = parse_url($img);
    $path = $parts['path'] ?? $img;
    echo "  [{$idx}] " . substr($path, strrpos($path, '/') + 1) . "\n";
}
echo "Total: " . count($excludedImages) . "\n\n";

// Images de consoles
echo "--- Images de CONSOLES (spécifiques aux articles) ---\n";
$consoles = \App\Models\Console::where('article_type_id', $typeId)
    ->whereNotNull('article_images')
    ->get();

$consoleImages = [];
foreach ($consoles as $console) {
    if (!empty($console->article_images) && is_array($console->article_images)) {
        foreach ($console->article_images as $imageUrl) {
            if (!in_array($imageUrl, $excludedImages)) {
                $consoleImages[] = $imageUrl;
            }
        }
    }
}
echo "Consoles avec article_images: " . $consoles->count() . "\n";
echo "Images non-exclues: " . count($consoleImages) . "\n\n";

// Images de fiches produits
echo "--- Images de FICHES PRODUITS (spécifiques aux articles) ---\n";
$productSheets = \App\Models\ProductSheet::where('article_type_id', $typeId)
    ->whereNotNull('images')
    ->get();

$sheetImages = [];
foreach ($productSheets as $sheet) {
    if (!empty($sheet->images) && is_array($sheet->images)) {
        foreach ($sheet->images as $imageUrl) {
            if (!in_array($imageUrl, $excludedImages)) {
                $sheetImages[] = $imageUrl;
            }
        }
    }
}
echo "Fiches produits avec images: " . $productSheets->count() . "\n";
echo "Images non-exclues: " . count($sheetImages) . "\n\n";

// Total final
$totalImages = array_unique(array_merge($consoleImages, $sheetImages));
echo "=== RESULTAT FINAL ===\n";
echo "Total images d'articles (sans taxonomie): " . count($totalImages) . "\n";
if (empty($totalImages)) {
    echo "✓ Aucune image de taxonomie ne s'affichera dans 'Photos d'autres articles du même type'\n";
} else {
    echo "Images à afficher:\n";
    foreach ($totalImages as $img) {
        $parts = parse_url($img);
        $path = $parts['path'] ?? $img;
        echo "  - " . substr($path, strrpos($path, '/') + 1) . "\n";
    }
}
