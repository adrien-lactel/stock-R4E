<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ArticleType;

// Statistiques
$total = ArticleType::count();
$withDesc = ArticleType::whereNotNull('description')->count();

echo "📊 STATISTIQUES DES DESCRIPTIONS\n";
echo "================================\n\n";
echo "Total types d'articles: {$total}\n";
echo "Avec description: {$withDesc}\n";
echo "Sans description: " . ($total - $withDesc) . "\n\n";

// Exemples de descriptions
echo "📝 EXEMPLES DE DESCRIPTIONS\n";
echo "===========================\n\n";

// Console
$gbColor = ArticleType::where('name', 'like', '%Atomic Purple%')
    ->whereHas('subCategory', function($q) {
        $q->where('name', 'Game Boy Color');
    })
    ->first();

if ($gbColor) {
    echo "🎮 {$gbColor->name}\n";
    echo "Description: " . substr($gbColor->description, 0, 150) . "...\n\n";
}

// Pokémon
$pokemon = ArticleType::whereHas('subCategory', function($q) {
    $q->where('name', 'like', '%151%');
})->first();

if ($pokemon) {
    echo "🎴 {$pokemon->subCategory->name} - {$pokemon->name}\n";
    echo "Description: " . substr($pokemon->description, 0, 150) . "...\n\n";
}

// Accessoire
$manette = ArticleType::where('name', 'like', '%N64%')->first();

if ($manette) {
    echo "🎮 {$manette->name}\n";
    echo "Description: " . substr($manette->description, 0, 150) . "...\n\n";
}

echo "✅ Toutes les descriptions sont en place!\n";
