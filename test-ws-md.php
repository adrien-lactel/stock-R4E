<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Vérification WonderSwan & Mega Drive ===" . PHP_EOL . PHP_EOL;

// WonderSwan
echo "=== WonderSwan ===" . PHP_EOL;
$wsGames = \App\Models\ArticleType::whereHas('subCategory', function($q) {
    $q->where('name', 'LIKE', '%WonderSwan%');
})
->where(function($q) {
    $q->where('name', 'LIKE', '%(%')
      ->orWhereNotNull('rom_id');
})
->take(10)
->get(['id', 'name', 'rom_id']);

foreach ($wsGames as $game) {
    echo "  {$game->name} | ROM: " . ($game->rom_id ?? 'NULL') . PHP_EOL;
}

echo PHP_EOL . "=== Mega Drive ===" . PHP_EOL;
$mdGames = \App\Models\ArticleType::whereHas('subCategory', function($q) {
    $q->where('name', 'LIKE', '%Mega Drive%');
})
->where(function($q) {
    $q->where('name', 'LIKE', '%(%')
      ->orWhereNotNull('rom_id');
})
->take(10)
->get(['id', 'name', 'rom_id']);

foreach ($mdGames as $game) {
    echo "  {$game->name} | ROM: " . ($game->rom_id ?? 'NULL') . PHP_EOL;
}

echo PHP_EOL . "=== SNES ===" . PHP_EOL;
$snesGames = \App\Models\ArticleType::whereHas('subCategory', function($q) {
    $q->where('name', 'LIKE', '%Super Nintendo%');
})
->whereNotNull('rom_id')
->take(5)
->get(['id', 'name', 'rom_id']);

foreach ($snesGames as $game) {
    echo "  {$game->name} | ROM: {$game->rom_id}" . PHP_EOL;
}

echo PHP_EOL . "=== Test extraction de nom ===" . PHP_EOL;

// Tester avec Anchorz Field
$testName = "Anchorz Field (Japan)";
echo "Nom testé: {$testName}" . PHP_EOL;
echo "  Contient ' - ': " . (str_contains($testName, ' - ') ? 'Oui' : 'Non') . PHP_EOL;
echo "  Slug calculé: " . strtolower(preg_replace('/[^a-z0-9]+/i', '-', $testName)) . PHP_EOL;

$testName2 = "sonic-blast-world - Sonic Blast (World)";
echo PHP_EOL . "Nom testé: {$testName2}" . PHP_EOL;
$parts = explode(' - ', $testName2, 2);
echo "  Partie extraite: {$parts[1]}" . PHP_EOL;
