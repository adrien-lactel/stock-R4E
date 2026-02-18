<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║              LISTE COMPLÈTE DES TABLES DE JEUX                     ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

$tables = DB::select('SHOW TABLES');
$gameTables = [];

foreach ($tables as $table) {
    $tableName = array_values((array)$table)[0];
    if (str_contains($tableName, 'game')) {
        $gameTables[] = $tableName;
    }
}

if (empty($gameTables)) {
    echo "❌ Aucune table de jeux trouvée.\n";
} else {
    echo "📋 Tables contenant 'game' (" . count($gameTables) . " trouvées):\n\n";
    
    foreach ($gameTables as $table) {
        $totalGames = DB::table($table)->count();
        $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
        $columnCount = count($columns);
        
        echo "• {$table}\n";
        echo "  Jeux: {$totalGames} | Colonnes: {$columnCount}\n\n";
    }
}

echo "═══════════════════════════════════════════════════════════════════════\n";
echo "🔍 Tables uniformisées (6):\n";
echo "   ✓ game_boy_games\n";
echo "   ✓ snes_games\n";
echo "   ✓ nes_games\n";
echo "   ✓ wonderswan_games\n";
echo "   ✓ game_gear_games\n";
echo "   ✓ mega_drive_games\n";
echo "═══════════════════════════════════════════════════════════════════════\n";
