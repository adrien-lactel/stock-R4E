<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Analyse JEUX (excluant consoles) ===" . PHP_EOL . PHP_EOL;

$platforms = [
    'Game Boy' => 'Game Boy',
    'Game Boy Color' => 'Game Boy Color',
    'Game Boy Advance' => 'Game Boy Advance',
    'Game Gear' => 'Game Gear',
    'SNES' => 'Super Nintendo',
    'NES' => 'NES',
    'WonderSwan' => 'WonderSwan',
    'Mega Drive' => 'Mega Drive',
];

foreach ($platforms as $platform => $subCatName) {
    echo "=== {$platform} ===" . PHP_EOL;
    
    // Chercher des jeux (noms longs, typiquement avec parenthèses ou ROM IDs)
    $games = \App\Models\ArticleType::whereHas('subCategory', function($q) use ($subCatName) {
        $q->where('name', 'LIKE', '%' . $subCatName . '%');
    })
    ->where(function($q) {
        // Jeux = ont un ROM ID OU nom avec parenthèses OU nom avec tirets
        $q->whereNotNull('rom_id')
          ->orWhere('name', 'LIKE', '%(%')
          ->orWhere('name', 'LIKE', '% - %');
    })
    ->with('subCategory')
    ->take(10)
    ->get(['id', 'name', 'rom_id']);
    
    if ($games->isEmpty()) {
        echo "  Aucun jeu trouvé" . PHP_EOL . PHP_EOL;
        continue;
    }
    
    $stats = ['rom_id' => 0, 'slug_name' => 0, 'name_only' => 0];
    
    foreach ($games as $game) {
        $effectiveRomId = $game->rom_id;
        
        // Tester getEffectiveRomId simulation
        if (!$effectiveRomId && preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9]+)\s*-/i', $game->name, $matches)) {
            $effectiveRomId = strtoupper($matches[1]);
        }
        
        if ($effectiveRomId) {
            $stats['rom_id']++;
            echo "  ✅ ROM: {$effectiveRomId} | {$game->name}" . PHP_EOL;
        } elseif (str_contains($game->name, ' - ')) {
            $stats['slug_name']++;
            $parts = explode(' - ', $game->name, 2);
            echo "  📝 [{$parts[0]}] → [{$parts[1]}]" . PHP_EOL;
        } else {
            $stats['name_only']++;
            echo "  ⚠️  {$game->name}" . PHP_EOL;
        }
    }
    
    echo "  ROM={$stats['rom_id']}, Slug+Nom={$stats['slug_name']}, Nom seul={$stats['name_only']}" . PHP_EOL;
    echo PHP_EOL;
}
