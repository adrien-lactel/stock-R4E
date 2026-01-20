<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ArticleType;

$types = ArticleType::with(['subCategory.category'])->get();

foreach ($types as $type) {
    echo "Type ID {$type->id}: {$type->name}\n";
    echo "  sub_category_id: " . ($type->sub_category_id ?? 'NULL') . "\n";
    
    if ($type->subCategory) {
        echo "  SubCategory: {$type->subCategory->name} (ID: {$type->subCategory->id})\n";
        echo "    category_id: " . ($type->subCategory->category_id ?? 'NULL') . "\n";
        
        if ($type->subCategory->category) {
            echo "    Category: {$type->subCategory->category->name}\n";
        }
    }
    echo "\n";
}
