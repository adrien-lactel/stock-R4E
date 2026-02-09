<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== TAXONOMIE AVEC MARQUES ===\n\n";

$categories = \App\Models\ArticleCategory::with(['brands.subCategories.types'])->get();

foreach ($categories as $cat) {
    echo "📁 CATEGORY: {$cat->name} (ID: {$cat->id})\n";
    
    $brandCount = $cat->brands->count();
    echo "   Brands: {$brandCount}\n";
    
    foreach ($cat->brands as $brand) {
        echo "  🏷️  BRAND: {$brand->name} (ID: {$brand->id})\n";
        
        foreach ($brand->subCategories as $sub) {
            echo "      └─ SUBCATEGORY: {$sub->name} (ID: {$sub->id})\n";
            
            foreach ($sub->types as $type) {
                echo "          └─ TYPE: {$type->name} (ID: {$type->id})\n";
            }
        }
    }
    echo "\n";
}
