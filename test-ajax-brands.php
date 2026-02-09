<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== TEST ENDPOINT AJAX BRANDS ===\n\n";

$categoryId = 12; // Cartes à collectionner

echo "Testing TaxonomyController::ajaxBrands({$categoryId})\n\n";

// Simule ce que fait le controller
$brands = \App\Models\ArticleBrand::where('article_category_id', $categoryId)
    ->withCount('subCategories')
    ->orderBy('name')
    ->get();

echo "Nombre de brands trouvées : " . $brands->count() . "\n\n";

if ($brands->isEmpty()) {
    echo "⚠️  PROBLÈME: Aucune brand trouvée pour cette catégorie!\n";
    echo "Le dropdown sera vide.\n";
} else {
    echo "Brands retournées:\n";
    foreach ($brands as $brand) {
        echo "  - {$brand->name} (ID: {$brand->id}, {$brand->sub_categories_count} sub-categories)\n";
    }
    
    echo "\n\nHTML qui devrait être retourné:\n";
    echo "<option value=\"\">Sélectionnez une marque</option>\n";
    foreach ($brands as $brand) {
        echo "<option value=\"{$brand->id}\">{$brand->name}</option>\n";
    }
}

echo "\n\n=== TEST POUR JEUX VIDÉO (ID: 14) ===\n";
$videoGameBrands = \App\Models\ArticleBrand::where('article_category_id', 14)
    ->withCount('subCategories')
    ->orderBy('name')
    ->get();
echo "Brands pour Jeux vidéo: " . $videoGameBrands->count() . "\n";
foreach ($videoGameBrands as $brand) {
    echo "  - {$brand->name} (ID: {$brand->id})\n";
}
