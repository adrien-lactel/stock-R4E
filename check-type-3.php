<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ArticleType;

$type = ArticleType::with(['subCategory.category'])->find(3);

if ($type) {
    echo "Type: {$type->name} (ID: {$type->id})\n";
    
    if ($type->subCategory) {
        echo "SubCategory: {$type->subCategory->name} (ID: {$type->subCategory->id})\n";
        
        if ($type->subCategory->category) {
            echo "Category: {$type->subCategory->category->name} (ID: {$type->subCategory->category->id})\n";
        } else {
            echo "Category: NULL\n";
        }
    } else {
        echo "SubCategory: NULL\n";
    }
} else {
    echo "Type ID 3 non trouvé\n";
}
