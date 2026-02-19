<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$games = [
    'Digimon Adventure - Anode Tamer (Japan)',
    'Digimon Adventure 02 - Tag Tamers (Japan)',
    'Harobots (Japan)',
    'Super Robot Taisen Compact (Japan)'
];

echo "Vérification des 4 jeux restants:\n\n";

foreach ($games as $name) {
    $results = DB::table('wonderswan_games')
        ->where('name', $name)
        ->orWhere('name', 'LIKE', $name . '%')
        ->get(['id', 'name']);
    
    echo "'{$name}':\n";
    if ($results->count() === 0) {
        echo "  ❌ PAS EN BASE - À AJOUTER\n";
    } else {
        foreach ($results as $game) {
            echo "  ✓ ID {$game->id}: {$game->name}\n";
        }
    }
    echo "\n";
}
