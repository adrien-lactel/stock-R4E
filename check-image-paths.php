<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== VÉRIFICATION DES CHEMINS D'IMAGES ===\n\n";

// Type 910
$type = \App\Models\ArticleType::find(910);
if ($type) {
    echo "Type ID: {$type->id} - {$type->name}\n";
    echo "Images de la taxonomie (ArticleType):\n";
    if (!empty($type->images) && is_array($type->images)) {
        foreach ($type->images as $i => $url) {
            echo "  [{$i}] {$url}\n";
        }
    } else {
        echo "  Aucune\n";
    }
    
    echo "\nCover image: " . ($type->cover_image ?? 'null') . "\n";
    echo "Artwork image: " . ($type->artwork_image ?? 'null') . "\n";
    echo "Gameplay image: " . ($type->gameplay_image ?? 'null') . "\n";
}

echo "\n--- Consoles avec article_images ---\n";
$consoles = \App\Models\Console::where('article_type_id', 910)
    ->whereNotNull('article_images')
    ->get();

foreach ($consoles as $console) {
    echo "\nConsole ID: {$console->id}\n";
    if (!empty($console->article_images) && is_array($console->article_images)) {
        foreach ($console->article_images as $i => $url) {
            $folder = '';
            if (str_contains($url, '/taxonomie/')) {
                $folder = ' [TAXONOMIE]';
            } elseif (str_contains($url, '/articles/')) {
                $folder = ' [ARTICLES]';
            }
            echo "  [{$i}]{$folder} {$url}\n";
        }
    }
}

echo "\n--- Fiches produits avec images ---\n";
$sheets = \App\Models\ProductSheet::where('article_type_id', 910)
    ->whereNotNull('images')
    ->get();

foreach ($sheets as $sheet) {
    echo "\nFiche ID: {$sheet->id} - {$sheet->name}\n";
    if (!empty($sheet->images) && is_array($sheet->images)) {
        foreach ($sheet->images as $i => $url) {
            $folder = '';
            if (str_contains($url, '/taxonomie/')) {
                $folder = ' [TAXONOMIE]';
            } elseif (str_contains($url, '/articles/')) {
                $folder = ' [ARTICLES]';
            } elseif (str_contains($url, '/products/')) {
                $folder = ' [PRODUCTS]';
            }
            echo "  [{$i}]{$folder} {$url}\n";
        }
    }
}
