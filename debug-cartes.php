<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== RECHERCHE 'CARTES' ===\n\n";

$categories = \App\Models\ArticleCategory::with(['brands.subCategories.types'])->get();

foreach ($categories as $cat) {
    if (stripos($cat->name, 'carte') !== false) {
        echo "📁 CATEGORY: {$cat->name} (ID: {$cat->id})\n";
        
        $brandCount = $cat->brands->count();
        echo "   Nombre de brands: {$brandCount}\n\n";
        
        if ($brandCount === 0) {
            echo "   ⚠️  AUCUNE BRAND ASSOCIÉE À CETTE CATÉGORIE!\n";
            echo "   C'est pourquoi le dropdown ne se remplit pas.\n\n";
        }
        
        foreach ($cat->brands as $brand) {
            echo "  🏷️  BRAND: {$brand->name} (ID: {$brand->id})\n";
            
            $subCount = $brand->subCategories->count();
            echo "      SubCategories: {$subCount}\n";
            
            foreach ($brand->subCategories as $sub) {
                echo "      └─ SUBCATEGORY: {$sub->name} (ID: {$sub->id})\n";
                
                foreach ($sub->types as $type) {
                    echo "          └─ TYPE: {$type->name} (ID: {$type->id})\n";
                }
            }
        }
        echo "\n";
    }
}

echo "\n=== TOUTES LES CATÉGORIES ===\n";
foreach ($categories as $cat) {
    echo "{$cat->id}: {$cat->name} ({$cat->brands->count()} brands)\n";
}
