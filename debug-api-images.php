<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$typeId = 880;

echo "=== DEBUG: Quelles images sont retournées par l'API? ===\n\n";

$articleType = \App\Models\ArticleType::find($typeId);

echo "Type: {$articleType->name}\n\n";

echo "--- 1. Images de la TAXONOMIE (ArticleType) ---\n";
echo "cover_image: " . ($articleType->cover_image ? '✓ ' . substr($articleType->cover_image, -60) : '✗ null') . "\n";
echo "artwork_image: " . ($articleType->artwork_image ? '✓ ' . substr($articleType->artwork_image, -60) : '✗ null') . "\n";
echo "gameplay_image: " . ($articleType->gameplay_image ? '✓ ' . substr($articleType->gameplay_image, -60) : '✗ null') . "\n";
echo "logo_url: " . ($articleType->logo_url ? '✓ ' . substr($articleType->logo_url, -60) : '✗ null') . "\n";
echo "images (array): " . (empty($articleType->images) ? '✗ vide' : '✓ ' . count($articleType->images) . ' image(s)') . "\n";

if (!empty($articleType->images) && is_array($articleType->images)) {
    foreach ($articleType->images as $idx => $img) {
        echo "  [$idx] " . substr($img, -60) . "\n";
    }
}

echo "\n--- 2. Images des CONSOLES (article_images) ---\n";
$consoles = \App\Models\Console::where('article_type_id', $typeId)
    ->whereNotNull('article_images')
    ->get();
echo "Consoles avec article_images: " . $consoles->count() . "\n";
foreach ($consoles as $console) {
    echo "Console #{$console->id}: " . count($console->article_images) . " image(s)\n";
    foreach ($console->article_images as $idx => $img) {
        echo "  [$idx] " . substr($img, -60) . "\n";
    }
}

echo "\n--- 3. Images des FICHES PRODUITS (images) ---\n";
$sheets = \App\Models\ProductSheet::where('article_type_id', $typeId)
    ->whereNotNull('images')
    ->get();
echo "Fiches produits avec images: " . $sheets->count() . "\n";
foreach ($sheets as $sheet) {
    $sheetImages = is_array($sheet->images) ? $sheet->images : [];
    echo "Fiche #{$sheet->id}: " . count($sheetImages) . " image(s)\n";
    foreach ($sheetImages as $idx => $img) {
        echo "  [$idx] " . substr($img, -60) . "\n";
    }
}

echo "\n--- 4. API SANS exclude_taxonomy ---\n";
$_GET = [];
$_REQUEST = [];
$controller1 = new \App\Http\Controllers\Admin\TaxonomyController();
$response1 = $controller1->getArticlesImagesByType($typeId);
$data1 = json_decode($response1->getContent(), true);
echo "Images retournées: " . $data1['count'] . "\n";
foreach ($data1['images'] as $idx => $img) {
    echo "  [$idx] " . substr($img, -60) . "\n";
}

echo "\n--- 5. API AVEC exclude_taxonomy=1 ---\n";
$_GET = ['exclude_taxonomy' => '1'];
$_REQUEST = $_GET;
$controller2 = new \App\Http\Controllers\Admin\TaxonomyController();
$response2 = $controller2->getArticlesImagesByType($typeId);
$data2 = json_decode($response2->getContent(), true);
echo "Images retournées: " . $data2['count'] . "\n";
if ($data2['count'] > 0) {
    foreach ($data2['images'] as $idx => $img) {
        echo "  [$idx] " . substr($img, -60) . "\n";
    }
} else {
    echo "  (aucune image)\n";
}

echo "\n=== CONCLUSION ===\n";
echo "ArticleType.images contient " . count($articleType->images ?? []) . " image(s)\n";
echo "API SANS exclude_taxonomy retourne " . $data1['count'] . " image(s)\n";
echo "API AVEC exclude_taxonomy retourne " . $data2['count'] . " image(s)\n";
echo "\nCes " . $data2['count'] . " images sont celles qui s'afficheront dans le modal\n";
echo "Section 'Photos d'autres articles du même type'\n";
