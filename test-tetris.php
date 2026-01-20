<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Recherche Tetris
$games = App\Models\GameBoyGame::where('rom_id', 'like', 'DMG-TRA%')->get();

if ($games->isEmpty()) {
    echo "❌ Aucun jeu trouvé avec DMG-TRA\n";
    
    // Recherche par nom
    echo "\nRecherche par nom 'Tetris':\n";
    $tetrisGames = App\Models\GameBoyGame::where('name', 'like', '%Tetris%')->get();
    foreach ($tetrisGames as $game) {
        echo "- {$game->rom_id}: {$game->name}\n";
        echo "  Année: {$game->year}\n";
        echo "  Image: {$game->image_url}\n";
        echo "  Prix: {$game->price}\n\n";
    }
} else {
    echo "✅ Jeux trouvés:\n";
    foreach ($games as $game) {
        echo "- {$game->rom_id}: {$game->name} ({$game->year})\n";
        echo "  Image: {$game->image_url}\n";
        echo "  Prix: {$game->price}\n\n";
    }
}
