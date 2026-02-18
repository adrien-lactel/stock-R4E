<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║         ANALYSE N64 & SEGA SATURN - COLONNES MANQUANTES           ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

$referenceOrder = [
    'id', 'rom_id', 'cartridge_id', 'name', 'name_jp', 'alternate_names',
    'year', 'publisher', 'developer', 'region', 'slug', 'image_url',
    'image_path', 'cloudinary_url', 'libretro_name', 'match_type',
    'match_score', 'source', 'price', 'created_at', 'updated_at'
];

$tablesToAnalyze = ['n64_games', 'sega_saturn_games'];

foreach ($tablesToAnalyze as $table) {
    echo "═══════════════════════════════════════════════════════════════════════\n";
    echo "📋 {$table}\n";
    echo "═══════════════════════════════════════════════════════════════════════\n\n";
    
    $columns = DB::select("SHOW FULL COLUMNS FROM `{$table}`");
    $currentColumns = array_map(fn($col) => $col->Field, $columns);
    $totalGames = DB::table($table)->count();
    $romIdFilled = DB::table($table)->whereNotNull('rom_id')->where('rom_id', '!=', '')->count();
    
    echo "📊 ÉTAT ACTUEL:\n";
    echo "   Total jeux: {$totalGames}\n";
    echo "   ROM_ID remplis: {$romIdFilled}/{$totalGames} (" . 
         ($totalGames > 0 ? round(($romIdFilled / $totalGames) * 100, 1) : 0) . "%)\n";
    echo "   Colonnes actuelles: " . count($currentColumns) . "/21\n\n";
    
    echo "📋 Colonnes actuelles:\n   " . implode(', ', $currentColumns) . "\n\n";
    
    // Trouver les colonnes manquantes
    $missingColumns = array_diff($referenceOrder, $currentColumns);
    
    if (empty($missingColumns)) {
        echo "✅ Aucune colonne manquante!\n\n";
    } else {
        echo "❌ Colonnes manquantes (" . count($missingColumns) . "):\n";
        foreach ($missingColumns as $col) {
            echo "   • {$col}\n";
        }
        echo "\n";
    }
    
    // Vérifier si rom_id est vide
    if ($totalGames > 0 && $romIdFilled === 0) {
        echo "⚠️  ATTENTION: Aucun jeu n'a de rom_id!\n";
        echo "   → Action requise: Copier name → rom_id\n\n";
    }
}

echo "═══════════════════════════════════════════════════════════════════════\n";
echo "📋 RÉSUMÉ:\n";
echo "   Tables à uniformiser: 2 (n64_games, sega_saturn_games)\n";
echo "   Schéma cible: 21 colonnes dans l'ordre de référence\n";
echo "═══════════════════════════════════════════════════════════════════════\n";
