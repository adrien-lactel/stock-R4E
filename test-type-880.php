<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$typeId = 880;

echo "=== Diagnostic Type $typeId ===\n\n";

$articleType = \App\Models\ArticleType::find($typeId);
if (!$articleType) {
    echo "Type $typeId non trouvé\n";
    exit;
}

echo "Type: {$articleType->id} - {$articleType->rom_id} - {$articleType->name}\n\n";

// Images de la taxonomie
echo "--- Images de la TAXONOMIE (ArticleType) ---\n";
$taxonomyImages = [];

function getFolder($img) {
    if (str_contains($img, '/taxonomie/')) return '[taxonomie]';
    if (str_contains($img, '/articles/')) return '[articles]';
    return '[autre]';
}

if (!empty($articleType->images) && is_array($articleType->images)) {
    $taxonomyImages = array_merge($taxonomyImages, $articleType->images);
    foreach ($articleType->images as $idx => $img) {
        echo "  images[$idx] " . getFolder($img) . ": " . substr($img, -50) . "\n";
    }
}
if (!empty($articleType->cover_image)) {
    $taxonomyImages[] = $articleType->cover_image;
    echo "  cover_image " . getFolder($articleType->cover_image) . ": " . substr($articleType->cover_image, -50) . "\n";
}
if (!empty($articleType->artwork_image)) {
    $taxonomyImages[] = $articleType->artwork_image;
    echo "  artwork_image " . getFolder($articleType->artwork_image) . ": " . substr($articleType->artwork_image, -50) . "\n";
}
if (!empty($articleType->gameplay_image)) {
    $taxonomyImages[] = $articleType->gameplay_image;
    echo "  gameplay_image " . getFolder($articleType->gameplay_image) . ": " . substr($articleType->gameplay_image, -50) . "\n";
}
echo "Total images taxonomie: " . count($taxonomyImages) . "\n\n";

// Images des consoles
echo "--- Images des CONSOLES ---\n";
$consoles = \App\Models\Console::where('article_type_id', $typeId)->get();
echo "Total consoles avec ce type: " . $consoles->count() . "\n";

$consolesWithImages = $consoles->filter(function($c) {
    return !empty($c->article_images) && is_array($c->article_images);
});
echo "Consoles avec article_images: " . $consolesWithImages->count() . "\n";

foreach ($consolesWithImages as $console) {
    echo "\nConsole #{$console->id}:\n";
    foreach ($console->article_images as $idx => $img) {
        $isExcluded = in_array($img, $taxonomyImages) ? '[EXCLUE]' : '[OK]';
        echo "  [$idx] $isExcluded " . getFolder($img) . ": " . substr($img, -50) . "\n";
    }
}

// Images des fiches produits
echo "\n--- Images des FICHES PRODUITS ---\n";
$sheets = \App\Models\ProductSheet::where('article_type_id', $typeId)->get();
echo "Total fiches avec ce type: " . $sheets->count() . "\n";

$sheetsWithImages = $sheets->filter(function($s) {
    return !empty($s->images) && is_array($s->images);
});
echo "Fiches avec images: " . $sheetsWithImages->count() . "\n";

foreach ($sheetsWithImages as $sheet) {
    echo "\nFiche #{$sheet->id}:\n";
    foreach ($sheet->images as $idx => $img) {
        $isExcluded = in_array($img, $taxonomyImages) ? '[EXCLUE]' : '[OK]';
        echo "  [$idx] $isExcluded " . getFolder($img) . ": " . substr($img, -50) . "\n";
    }
}

// Résultat final
echo "\n=== RESULTAT API getArticlesImagesByType($typeId) ===\n";
$allImages = [];
foreach ($consoles as $console) {
    if (!empty($console->article_images) && is_array($console->article_images)) {
        foreach ($console->article_images as $imageUrl) {
            if (!in_array($imageUrl, $taxonomyImages) && !in_array($imageUrl, $allImages)) {
                $allImages[] = $imageUrl;
            }
        }
    }
}
foreach ($sheets as $sheet) {
    if (!empty($sheet->images) && is_array($sheet->images)) {
        foreach ($sheet->images as $imageUrl) {
            if (!in_array($imageUrl, $taxonomyImages) && !in_array($imageUrl, $allImages)) {
                $allImages[] = $imageUrl;
            }
        }
    }
}

echo "Images qui seront retournées: " . count($allImages) . "\n";
if (count($allImages) > 0) {
    foreach ($allImages as $idx => $img) {
        echo "  [$idx] " . substr($img, -60) . "\n";
    }
} else {
    echo "✓ Aucune image (normal si aucune image d'article n'a été uploadée)\n";
}
