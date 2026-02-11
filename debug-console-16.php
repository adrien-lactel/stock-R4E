<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$consoleId = 16;
$console = \App\Models\Console::find($consoleId);

if (!$console) {
    echo "Console #$consoleId non trouvée\n";
    exit;
}

echo "=== Console #$consoleId ===\n\n";
echo "ROM ID: {$console->rom_id}\n";
echo "Type: " . ($console->articleType ? $console->articleType->name : 'N/A') . "\n";
echo "article_type_id: {$console->article_type_id}\n\n";

echo "--- article_images (images spécifiques de l'article) ---\n";
if (is_array($console->article_images) && !empty($console->article_images)) {
    echo "Nombre: " . count($console->article_images) . "\n";
    foreach ($console->article_images as $idx => $img) {
        if (is_string($img)) {
            echo "  [$idx] (string) " . substr($img, -60) . "\n";
        } elseif (is_array($img)) {
            $url = $img['url'] ?? $img['path'] ?? 'unknown';
            echo "  [$idx] (array) " . substr($url, -60) . "\n";
        }
    }
} else {
    echo "  ✗ Vide ou null\n";
}

echo "\n--- primary_image_url ---\n";
echo $console->primary_image_url ? substr($console->primary_image_url, -60) : '✗ null';
echo "\n\n";

echo "--- Ce qui sera dans \$prefilledData['images'] ---\n";
$imageUrls = [];
if (is_array($console->article_images) && !empty($console->article_images)) {
    foreach ($console->article_images as $img) {
        if (is_string($img)) {
            $imageUrls[] = $img;
        } elseif (isset($img['url'])) {
            $imageUrls[] = $img['url'];
        } elseif (isset($img['path'])) {
            $imageUrls[] = $img['path'];
        }
    }
}

echo "Nombre d'images: " . count($imageUrls) . "\n";
foreach ($imageUrls as $idx => $url) {
    echo "  [$idx] " . substr($url, -60) . "\n";
}

if (count($imageUrls) === 0) {
    echo "  ✓ Aucune image spécifique - modal montrera seulement les images d'autres articles du même type\n";
}
