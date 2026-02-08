<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\ArticleCategory;
use App\Models\ArticleBrand;
use App\Models\ArticleSubCategory;

echo "🔍 Recherche de la catégorie 'Jeux vidéo'...\n";
$jeuxCategory = ArticleCategory::where('name', 'LIKE', '%jeux vidéo%')
    ->orWhere('name', 'LIKE', '%Jeux vidéo%')
    ->first();

if (!$jeuxCategory) {
    echo "❌ Catégorie 'Jeux vidéo' introuvable!\n";
    exit(1);
}

echo "✓ Catégorie trouvée: {$jeuxCategory->name} (ID: {$jeuxCategory->id})\n";

echo "\n🔍 Recherche de la marque 'Bandai'...\n";
$bandaiBrand = ArticleBrand::where('name', 'Bandai')
    ->where('article_category_id', $jeuxCategory->id)
    ->first();

if (!$bandaiBrand) {
    echo "⚠️ Marque 'Bandai' introuvable. Création...\n";
    $bandaiBrand = ArticleBrand::create([
        'name' => 'Bandai',
        'article_category_id' => $jeuxCategory->id,
    ]);
    echo "✓ Marque créée: {$bandaiBrand->name} (ID: {$bandaiBrand->id})\n";
} else {
    echo "✓ Marque trouvée: {$bandaiBrand->name} (ID: {$bandaiBrand->id})\n";
}

echo "\n🔨 Création des sous-catégories WonderSwan...\n";

// Créer WonderSwan
$wonderswan = ArticleSubCategory::updateOrCreate([
    'name' => 'WonderSwan',
    'article_category_id' => $jeuxCategory->id,
], [
    'article_brand_id' => $bandaiBrand->id
]);

echo "✓ Sous-catégorie créée/mise à jour: {$wonderswan->name} (ID: {$wonderswan->id})\n";

// Créer WonderSwan Color
$wonderswanColor = ArticleSubCategory::updateOrCreate([
    'name' => 'WonderSwan Color',
    'article_category_id' => $jeuxCategory->id,
], [
    'article_brand_id' => $bandaiBrand->id
]);

echo "✓ Sous-catégorie créée/mise à jour: {$wonderswanColor->name} (ID: {$wonderswanColor->id})\n";

echo "\n✅ TERMINÉ!\n";
echo "━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━\n";
echo "Marque Bandai (ID: {$bandaiBrand->id})\n";
echo "  ├─ WonderSwan (ID: {$wonderswan->id})\n";
echo "  └─ WonderSwan Color (ID: {$wonderswanColor->id})\n";
