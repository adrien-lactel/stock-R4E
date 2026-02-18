<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

$tables = [
    'game_boy_games',
    'snes_games',
    'nes_games',
    'wonderswan_games',
    'game_gear_games',
    'mega_drive_games',
    'n64_games',
    'sega_saturn_games',
];

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║         VÉRIFICATION ORDRE DES COLONNES - TABLES DE JEUX          ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

$tableColumns = [];

foreach ($tables as $table) {
    $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
    $columnNames = array_map(fn($col) => $col->Field, $columns);
    $tableColumns[$table] = $columnNames;
    
    echo "📋 {$table}:\n";
    echo "   Colonnes (" . count($columnNames) . "): " . implode(', ', $columnNames) . "\n\n";
}

// Comparer l'ordre
echo "═══════════════════════════════════════════════════════════════════════\n";
echo "🔍 COMPARAISON DE L'ORDRE\n";
echo "═══════════════════════════════════════════════════════════════════════\n\n";

$referenceTable = 'game_boy_games';
$referenceColumns = $tableColumns[$referenceTable];

$allMatch = true;
$differences = [];

foreach ($tables as $table) {
    if ($table === $referenceTable) continue;
    
    $columns = $tableColumns[$table];
    
    if ($columns !== $referenceColumns) {
        $allMatch = false;
        $differences[$table] = [];
        
        for ($i = 0; $i < max(count($columns), count($referenceColumns)); $i++) {
            $ref = $referenceColumns[$i] ?? '[MANQUANT]';
            $cur = $columns[$i] ?? '[MANQUANT]';
            
            if ($ref !== $cur) {
                $differences[$table][] = [
                    'position' => $i + 1,
                    'reference' => $ref,
                    'current' => $cur,
                ];
            }
        }
    }
}

if ($allMatch) {
    echo "✅ SUCCÈS: Toutes les tables ont exactement le même ordre de colonnes!\n\n";
    echo "📋 Ordre de référence (21 colonnes):\n";
    foreach ($referenceColumns as $i => $col) {
        echo sprintf("   %2d. %s\n", $i + 1, $col);
    }
} else {
    echo "⚠️  DIFFÉRENCES DÉTECTÉES:\n\n";
    
    foreach ($differences as $table => $diffs) {
        echo "❌ {$table} (différences: " . count($diffs) . "):\n";
        foreach ($diffs as $diff) {
            echo sprintf(
                "   Position %d: %s (référence) ≠ %s (actuel)\n",
                $diff['position'],
                $diff['reference'],
                $diff['current']
            );
        }
        echo "\n";
    }
    
    echo "\n🔧 ACTION REQUISE: Réordonner les colonnes pour uniformiser.\n";
}

echo "\n═══════════════════════════════════════════════════════════════════════\n";
