<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "=== Test autocomplète WonderSwan Color ===" . PHP_EOL . PHP_EOL;

// Simuler la recherche "Final Fantasy"
$searchTerm = "Final";
$tableName = 'wonderswan_games';

$games = DB::table($tableName)
    ->where('name', 'LIKE', '%' . $searchTerm . '%')
    ->limit(10)
    ->get();

echo "Recherche: '$searchTerm' dans wonderswan_games\n";
echo "Résultats trouvés: " . $games->count() . "\n\n";

if ($games->count() > 0) {
    echo "📋 Jeux trouvés:\n";
    foreach ($games as $game) {
        echo sprintf("  ID %d: %s", $game->id, $game->name);
        if ($game->publisher) {
            echo " ($game->publisher)";
        }
        echo "\n";
    }
} else {
    echo "❌ Aucun jeu trouvé\n";
}

// Vérifier le total
$total = DB::table($tableName)->count();
echo "\n📊 Total de jeux dans la base: $total\n";

// Vérifier les IDs
$minMax = DB::table($tableName)->selectRaw('MIN(id) as min_id, MAX(id) as max_id')->first();
echo "🔢 Range d'IDs: {$minMax->min_id} - {$minMax->max_id}\n";
