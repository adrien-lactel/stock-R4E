<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

$typeId = 880;

echo "Type ID {$typeId}:\n";
$type = \App\Models\ArticleType::find($typeId);
echo $type ? "  - {$type->name}\n" : "  - Not found\n";

echo "\n=== TOUS les articles de ce type ===\n";
$allConsoles = \App\Models\Console::where('article_type_id', $typeId)->get();
echo "Total articles: {$allConsoles->count()}\n\n";

foreach ($allConsoles as $console) {
    echo "Console ID {$console->id} (status: {$console->status}):\n";
    echo "  - article_images: " . ($console->article_images ? json_encode($console->article_images) : 'NULL') . "\n";
    echo "  - primary_image_url: " . ($console->primary_image_url ?? 'NULL') . "\n";
    
    // Vérifier si d'autres champs images existent
    $attributes = $console->getAttributes();
    foreach ($attributes as $key => $value) {
        if (stripos($key, 'image') !== false || stripos($key, 'photo') !== false || stripos($key, 'picture') !== false) {
            if ($value && $key !== 'article_images' && $key !== 'primary_image_url') {
                echo "  - {$key}: " . substr($value, 0, 100) . "\n";
            }
        }
    }
    echo "\n";
}

echo "\n=== Articles avec article_images non vide ===\n";
$withImages = \App\Models\Console::where('article_type_id', $typeId)
    ->whereNotNull('article_images')
    ->where('article_images', '!=', '[]')
    ->where('article_images', '!=', '')
    ->get();
    
echo "Count: {$withImages->count()}\n";

foreach ($withImages as $console) {
    $images = is_string($console->article_images) 
        ? json_decode($console->article_images, true) 
        : $console->article_images;
    
    echo "Console ID {$console->id}:\n";
    if (is_array($images)) {
        echo "  - " . count($images) . " images\n";
        foreach ($images as $img) {
            echo "    * {$img}\n";
        }
    }
}

