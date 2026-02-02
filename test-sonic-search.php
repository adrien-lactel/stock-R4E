<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🔍 Test recherche Sonic dans Game Boy\n\n";

// Test 1: Compter les jeux Game Boy
$totalGames = DB::table('game_boy_games')->count();
echo "📊 Total jeux Game Boy: {$totalGames}\n\n";

// Test 2: Rechercher "sonic"
$sonicGames = DB::table('game_boy_games')
    ->where('name', 'LIKE', '%sonic%')
    ->orWhere('rom_id', 'LIKE', '%sonic%')
    ->get();

echo "🎮 Jeux contenant 'sonic': " . $sonicGames->count() . "\n";

if ($sonicGames->count() > 0) {
    foreach ($sonicGames as $game) {
        echo "  - {$game->name} ({$game->rom_id})\n";
    }
} else {
    echo "  ❌ Aucun jeu Sonic trouvé\n\n";
    
    // Afficher quelques exemples de jeux
    echo "📝 Exemples de jeux dans la base:\n";
    $examples = DB::table('game_boy_games')->limit(5)->get(['name', 'rom_id']);
    foreach ($examples as $example) {
        echo "  - {$example->name} ({$example->rom_id})\n";
    }
}
