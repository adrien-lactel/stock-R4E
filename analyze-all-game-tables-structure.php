<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("ANALYSE STRUCTURE - TOUTES TABLES DE JEUX", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

$tables = [
    'game_boy_games',
    'game_boy_color_games',
    'game_boy_advance_games',
    'snes_games',
    'nes_games',
    'nintendo_64_games',
    'wonderswan_games',
    'game_gear_games',
    'mega_drive_games',
];

$allColumns = [];
$tableStructures = [];

foreach ($tables as $table) {
    if (!Schema::hasTable($table)) {
        echo "⚠️  Table '{$table}' n'existe pas\n\n";
        continue;
    }
    
    echo "📊 Table: {$table}\n";
    echo str_repeat("-", 80) . "\n";
    
    $columns = DB::select("DESCRIBE {$table}");
    $tableStructures[$table] = [];
    
    echo sprintf("%-25s %-20s %-10s %-10s %-10s\n", "Colonne", "Type", "Null", "Key", "Default");
    echo str_repeat("-", 80) . "\n";
    
    foreach ($columns as $column) {
        $columnName = $column->Field;
        $columnType = $column->Type;
        $nullable = $column->Null;
        $key = $column->Key;
        $default = $column->Default;
        
        echo sprintf("%-25s %-20s %-10s %-10s %-10s\n", 
            $columnName, 
            $columnType, 
            $nullable, 
            $key ?: '-', 
            $default ?: 'NULL'
        );
        
        // Stocker info colonne
        $tableStructures[$table][$columnName] = [
            'type' => $columnType,
            'nullable' => $nullable === 'YES',
            'key' => $key,
            'default' => $default
        ];
        
        // Ajouter à la liste globale
        if (!in_array($columnName, $allColumns)) {
            $allColumns[] = $columnName;
        }
    }
    
    echo "\n   Total colonnes: " . count($columns) . "\n\n";
}

echo "═" . str_repeat("═", 79) . "\n";
echo "📋 RÉSUMÉ GLOBAL\n";
echo "═" . str_repeat("═", 79) . "\n\n";

echo "📊 Tables analysées: " . count($tableStructures) . "\n";
echo "📊 Colonnes uniques trouvées: " . count($allColumns) . "\n\n";

echo "🔤 Liste de toutes les colonnes uniques:\n";
echo str_repeat("-", 80) . "\n";
sort($allColumns);
foreach ($allColumns as $index => $col) {
    echo ($index + 1) . ". {$col}\n";
}
echo "\n";

// Analyser quelles colonnes manquent à chaque table
echo "═" . str_repeat("═", 79) . "\n";
echo "⚠️  COLONNES MANQUANTES PAR TABLE\n";
echo "═" . str_repeat("═", 79) . "\n\n";

foreach ($tableStructures as $table => $columns) {
    $missingColumns = array_diff($allColumns, array_keys($columns));
    
    if (count($missingColumns) > 0) {
        echo "📋 {$table}:\n";
        echo "   Colonnes manquantes: " . count($missingColumns) . "\n";
        foreach ($missingColumns as $missing) {
            // Chercher dans quelle(s) table(s) cette colonne existe
            $existsIn = [];
            foreach ($tableStructures as $otherTable => $otherCols) {
                if (isset($otherCols[$missing])) {
                    $existsIn[] = $otherTable;
                }
            }
            echo "   - {$missing} (existe dans: " . implode(', ', $existsIn) . ")\n";
        }
        echo "\n";
    } else {
        echo "✅ {$table}: Aucune colonne manquante\n\n";
    }
}

// Identifier les tables Sega sans ROM_ID
echo "═" . str_repeat("═", 79) . "\n";
echo "🎮 TABLES SEGA - Vérification ROM_ID\n";
echo "═" . str_repeat("═", 79) . "\n\n";

$segaTables = ['game_gear_games', 'mega_drive_games'];

foreach ($segaTables as $table) {
    if (!isset($tableStructures[$table])) {
        echo "⚠️  {$table}: Table non trouvée\n\n";
        continue;
    }
    
    $hasRomId = isset($tableStructures[$table]['rom_id']) || isset($tableStructures[$table]['ROM_ID']);
    
    if ($hasRomId) {
        // Vérifier combien ont ROM_ID
        $total = DB::table($table)->count();
        $withRomId = DB::table($table)->whereNotNull('rom_id')->orWhereNotNull('ROM_ID')->count();
        
        echo "✅ {$table}:\n";
        echo "   - Colonne ROM_ID existe\n";
        echo "   - Jeux avec ROM_ID: {$withRomId}/{$total}\n";
        
        if ($withRomId < $total) {
            echo "   ⚠️  Besoin de copier name → rom_id pour " . ($total - $withRomId) . " jeux\n";
        }
    } else {
        echo "❌ {$table}:\n";
        echo "   - Colonne ROM_ID MANQUANTE\n";
        echo "   - Besoin de créer la colonne et copier name → rom_id\n";
    }
    echo "\n";
}

echo str_repeat("═", 80) . "\n";
