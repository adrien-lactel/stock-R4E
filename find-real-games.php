<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Recherche jeux réels avec ROM IDs ===" . PHP_EOL . PHP_EOL;

// Chercher tous les jeux avec ROM IDs non null
$gamesWithRomId = \App\Models\ArticleType::whereNotNull('rom_id')
    ->with('subCategory.brand.category')
    ->take(30)
    ->get(['id', 'name', 'rom_id', 'article_sub_category_id']);

echo "Total jeux avec ROM ID: " . $gamesWithRomId->count() . PHP_EOL . PHP_EOL;

$platformStats = [];

foreach ($gamesWithRomId as $game) {
    $platform = $game->subCategory->name ?? 'Unknown';
    
    if (!isset($platformStats[$platform])) {
        $platformStats[$platform] = ['count' => 0, 'examples' => []];
    }
    
    $platformStats[$platform]['count']++;
    
    if (count($platformStats[$platform]['examples']) < 3) {
        $platformStats[$platform]['examples'][] = [
            'rom_id' => $game->rom_id,
            'name' => $game->name
        ];
    }
}

foreach ($platformStats as $platform => $data) {
    echo "=== {$platform} (ROM IDs: {$data['count']}) ===" . PHP_EOL;
    foreach ($data['examples'] as $ex) {
        echo "  {$ex['rom_id']} → {$ex['name']}" . PHP_EOL;
    }
    echo PHP_EOL;
}

echo PHP_EOL . "=== Recherche jeux format 'slug - nom' ===" . PHP_EOL . PHP_EOL;

$gamesWithSlugName = \App\Models\ArticleType::where('name', 'LIKE', '% - %')
    ->whereNull('rom_id')
    ->with('subCategory')
    ->take(30)
    ->get(['id', 'name', 'rom_id', 'article_sub_category_id']);

echo "Total jeux format 'slug - nom': " . $gamesWithSlugName->count() . PHP_EOL . PHP_EOL;

$platformStats2 = [];

foreach ($gamesWithSlugName as $game) {
    $platform = $game->subCategory->name ?? 'Unknown';
    
    // Vérifier si c'est un vrai jeu (nom après tiret avec parenthèses = indicateur de région)
    if (str_contains($game->name, ' - ')) {
        $parts = explode(' - ', $game->name, 2);
        $gameName = trim($parts[1]);
        
        // Si contient des parenthèses style (USA), (Europe), etc = jeu
        if (preg_match('/\([A-Za-z, ]+\)/', $gameName)) {
            if (!isset($platformStats2[$platform])) {
                $platformStats2[$platform] = ['count' => 0, 'examples' => []];
            }
            
            $platformStats2[$platform]['count']++;
            
            if (count($platformStats2[$platform]['examples']) < 3) {
                $platformStats2[$platform]['examples'][] = $game->name;
            }
        }
    }
}

foreach ($platformStats2 as $platform => $data) {
    echo "=== {$platform} (Slug-Nom: {$data['count']}) ===" . PHP_EOL;
    foreach ($data['examples'] as $name) {
        echo "  {$name}" . PHP_EOL;
    }
    echo PHP_EOL;
}
