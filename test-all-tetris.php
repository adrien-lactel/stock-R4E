<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Recherche tous les Tetris
$tetrisGames = App\Models\GameBoyGame::where('name', 'like', '%Tetris%')->get();

echo "Tous les jeux Tetris trouvés (" . $tetrisGames->count() . "):\n\n";

foreach ($tetrisGames as $game) {
    echo "ROM ID: {$game->rom_id}\n";
    echo "Nom: {$game->name}\n";
    echo "Année: {$game->year}\n";
    echo "Image: " . ($game->image_url ?: 'N/A') . "\n";
    echo "Prix: " . ($game->price ?: 'N/A') . "\n";
    echo "Source: {$game->source}\n";
    echo "---\n\n";
}
