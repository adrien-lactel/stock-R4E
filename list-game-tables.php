<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Tables contenant 'game':\n";
$tables = DB::select('SHOW TABLES');
foreach ($tables as $table) {
    $tableName = array_values((array)$table)[0];
    if (stripos($tableName, 'game') !== false) {
        echo "  - $tableName\n";
    }
}

// Vérifier si platform_id existe dans game_boy_games
if (Schema::hasColumn('game_boy_games', 'platform_id')) {
    echo "\n✓ La table game_boy_games a une colonne platform_id\n";
    
    $platforms = DB::table('game_boy_games')
        ->select('platform_id', DB::raw('COUNT(*) as count'))
        ->whereNotNull('platform_id')
        ->groupBy('platform_id')
        ->get();
    
    echo "\nRépartition par platform_id:\n";
    foreach ($platforms as $platform) {
        echo "  Platform ID {$platform->platform_id}: {$platform->count} jeux\n";
    }
} else {
    echo "\n✗ La table game_boy_games n'a pas de colonne platform_id\n";
    echo "  → Toutes les plateformes Game Boy sont dans la même table\n";
}
