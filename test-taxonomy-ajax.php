<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ArticleCategory;
use App\Models\ArticleBrand;
use App\Models\ArticleSubCategory;

echo "=== TEST TAXONOMIE AJAX ===\n\n";

// Test 1: Catégories
$categories = ArticleCategory::all();
echo "📦 Catégories ({$categories->count()}):\n";
foreach ($categories as $cat) {
    echo "  - {$cat->id}: {$cat->name}\n";
}

// Test 2: Marques pour "Jeux vidéo" (ID 14)
echo "\n🏷️ Marques pour catégorie ID 14 (Jeux vidéo):\n";
$brands = ArticleBrand::where('article_category_id', 14)->get();
echo "  Total: {$brands->count()}\n";
foreach ($brands->take(10) as $brand) {
    echo "  - {$brand->id}: {$brand->name}\n";
}

// Test 3: Sous-catégories pour une marque Nintendo (ID 1 ou 10 ou 18)
echo "\n📂 Sous-catégories pour marque ID 1 (Nintendo):\n";
$subs = ArticleSubCategory::where('article_brand_id', 1)->get();
echo "  Total: {$subs->count()}\n";
foreach ($subs->take(10) as $sub) {
    echo "  - {$sub->id}: {$sub->name}\n";
}

// Test 4: Vérifier si "Game Boy" existe
echo "\n🔍 Recherche 'Game Boy' dans sous-catégories:\n";
$gameBoy = ArticleSubCategory::where('name', 'LIKE', '%Game Boy%')->get();
foreach ($gameBoy as $sub) {
    echo "  - {$sub->id}: {$sub->name} (brand_id: {$sub->article_brand_id})\n";
}
