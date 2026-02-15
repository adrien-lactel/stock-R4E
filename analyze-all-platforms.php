<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Analyse structure des jeux par plateforme ===" . PHP_EOL . PHP_EOL;

$platforms = [
    'Game Boy' => ['subcategory' => 'Game Boy', 'limit' => 5],
    'Game Boy Color' => ['subcategory' => 'Game Boy Color', 'limit' => 5],
    'Game Boy Advance' => ['subcategory' => 'Game Boy Advance', 'limit' => 5],
    'Game Gear' => ['subcategory' => 'Game Gear', 'limit' => 5],
    'SNES' => ['subcategory' => 'Super Nintendo', 'limit' => 5],
    'NES' => ['subcategory' => 'NES', 'limit' => 5],
    'WonderSwan' => ['subcategory' => 'WonderSwan', 'limit' => 5],
    'WonderSwan Color' => ['subcategory' => 'WonderSwan Color', 'limit' => 5],
    'Mega Drive' => ['subcategory' => 'Mega Drive', 'limit' => 5],
];

foreach ($platforms as $platform => $config) {
    echo "=== {$platform} ===" . PHP_EOL;
    
    $games = \App\Models\ArticleType::whereHas('subCategory', function($q) use ($config) {
        $q->where('name', 'LIKE', '%' . $config['subcategory'] . '%');
    })
    ->with('subCategory')
    ->take($config['limit'])
    ->get(['id', 'name', 'rom_id', 'article_sub_category_id']);
    
    if ($games->isEmpty()) {
        echo "  Aucun jeu trouvé" . PHP_EOL . PHP_EOL;
        continue;
    }
    
    $hasRomId = 0;
    $noRomId = 0;
    $withDash = 0;
    
    foreach ($games as $game) {
        if ($game->rom_id) {
            $hasRomId++;
            echo "  ✅ ROM: {$game->rom_id} | {$game->name}" . PHP_EOL;
        } else {
            $noRomId++;
            if (str_contains($game->name, ' - ')) {
                $withDash++;
                $parts = explode(' - ', $game->name, 2);
                echo "  📝 SLUG+NOM: [{$parts[0]}] → [{$parts[1]}]" . PHP_EOL;
            } else {
                echo "  ⚠️  NOM SEUL: {$game->name}" . PHP_EOL;
            }
        }
    }
    
    echo "  Stats: ROM ID={$hasRomId}, Sans ROM={$noRomId}, Format 'slug - nom'={$withDash}" . PHP_EOL;
    echo PHP_EOL;
}
