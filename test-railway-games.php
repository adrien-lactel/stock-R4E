<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🚂 Test de la base Railway\n\n";

// Test connexion
try {
    $count = DB::table('game_boy_games')->count();
    echo "✅ game_boy_games: $count jeux\n";
    
    $sonic = DB::table('game_boy_games')
        ->where('name', 'LIKE', '%sonic%')
        ->count();
    echo "🎮 Jeux Sonic: $sonic\n\n";
    
    if ($sonic > 0) {
        echo "📋 Exemples:\n";
        $games = DB::table('game_boy_games')
            ->where('name', 'LIKE', '%sonic%')
            ->limit(5)
            ->get(['name', 'rom_id']);
        
        foreach ($games as $game) {
            echo "   - {$game->name} ({$game->rom_id})\n";
        }
    }
    
} catch (\Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
}
