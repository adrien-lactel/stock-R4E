<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$sheet = App\Models\ProductSheet::find(1);

if (!$sheet) {
    echo "ProductSheet 1 not found\n";
    exit;
}

echo "ProductSheet ID: {$sheet->id}\n";
echo "ProductSheet Name: {$sheet->name}\n";
echo "Article Type ID: {$sheet->article_type_id}\n\n";

if ($sheet->article_type_id) {
    $type = App\Models\ArticleType::with('subCategory')->find($sheet->article_type_id);
    
    echo "ArticleType ID: {$type->id}\n";
    echo "ArticleType Name: {$type->name}\n";
    echo "ROM ID: " . ($type->rom_id ?? 'null') . "\n";
    echo "SubCategory: " . ($type->subCategory ? $type->subCategory->name : 'null') . "\n\n";
    
    echo "Cover Image URL: " . ($type->cover_image_url ?? 'null') . "\n";
    echo "Logo URL: " . ($type->logo_url ?? 'null') . "\n";
    echo "Screenshot 1 URL: " . ($type->screenshot1_url ?? 'null') . "\n";
    echo "Screenshot 2 URL: " . ($type->screenshot2_url ?? 'null') . "\n";
} else {
    echo "No article_type_id\n";
}
