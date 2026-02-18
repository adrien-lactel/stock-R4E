<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║         VÉRIFICATION TABLES GAME BOY COLOR / ADVANCE              ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

$potentialTables = [
    'game_boy_color_games',
    'gbc_games',
    'gameboy_color_games',
    'game_boy_advance_games',
    'gba_games',
    'gameboy_advance_games',
];

$existingTables = [];

foreach ($potentialTables as $table) {
    if (Schema::hasTable($table)) {
        $existingTables[] = $table;
        echo "✅ Table trouvée: {$table}\n";
        
        $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
        $columnNames = array_map(fn($col) => $col->Field, $columns);
        $totalGames = DB::table($table)->count();
        $romIdFilled = DB::table($table)->whereNotNull('rom_id')->where('rom_id', '!=', '')->count();
        
        echo "   Colonnes: " . count($columnNames) . "\n";
        echo "   Total jeux: {$totalGames}\n";
        echo "   ROM_ID remplis: {$romIdFilled}/{$totalGames}\n";
        echo "   Colonnes: " . implode(', ', $columnNames) . "\n\n";
    } else {
        echo "❌ Table non trouvée: {$table}\n";
    }
}

if (empty($existingTables)) {
    echo "\n⚠️  Aucune table Game Boy Color ou Game Boy Advance trouvée.\n";
} else {
    echo "\n═══════════════════════════════════════════════════════════════════════\n";
    echo "📋 RÉSUMÉ:\n";
    echo "   Tables trouvées: " . count($existingTables) . "\n";
    foreach ($existingTables as $table) {
        echo "   • {$table}\n";
    }
}
