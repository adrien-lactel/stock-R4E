<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$types = App\Models\ArticleType::whereNull('description')
    ->with('subCategory')
    ->get();

$subs = $types->pluck('subCategory.name')->unique()->sort()->values();

echo "Sous-catégories sans description (" . $types->count() . " types):\n";
foreach ($subs as $sub) {
    $count = $types->where('subCategory.name', $sub)->count();
    echo "- {$sub} ({$count} types)\n";
}
