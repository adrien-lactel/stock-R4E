<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║       RECHERCHE GAME BOY COLOR / ADVANCE DANS game_boy_games      ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

// Vérifier si des colonnes peuvent indiquer le type de console
$columns = DB::select("SHOW COLUMNS FROM game_boy_games");
$columnNames = array_map(fn($col) => $col->Field, $columns);

echo "📋 Colonnes de game_boy_games:\n";
echo "   " . implode(', ', $columnNames) . "\n\n";

// Chercher des indices dans les noms ou autres champs
$sampleGames = DB::table('game_boy_games')
    ->select('id', 'name', 'rom_id', 'alternate_names', 'region')
    ->limit(20)
    ->get();

echo "📋 Échantillon de jeux (20 premiers):\n";
foreach ($sampleGames as $game) {
    $indicators = [];
    
    // Chercher des indices de GBC/GBA dans les données
    $text = strtolower($game->name . ' ' . ($game->rom_id ?? '') . ' ' . ($game->alternate_names ?? ''));
    
    if (str_contains($text, 'color') || str_contains($text, 'gbc') || str_contains($text, 'cgb')) {
        $indicators[] = 'GBC?';
    }
    if (str_contains($text, 'advance') || str_contains($text, 'gba') || str_contains($text, 'agb')) {
        $indicators[] = 'GBA?';
    }
    
    $indicator = !empty($indicators) ? ' [' . implode(', ', $indicators) . ']' : '';
    echo "   • {$game->name}{$indicator}\n";
}

echo "\n═══════════════════════════════════════════════════════════════════════\n";
echo "🔍 RECHERCHE PAR MOTS-CLÉS\n";
echo "═══════════════════════════════════════════════════════════════════════\n\n";

// Compter les occurrences de mots-clés
$keywords = [
    'Game Boy Color' => ['color', 'gbc', 'cgb'],
    'Game Boy Advance' => ['advance', 'gba', 'agb'],
];

foreach ($keywords as $platform => $terms) {
    echo "🔍 {$platform}:\n";
    
    foreach ($terms as $term) {
        $count = DB::table('game_boy_games')
            ->where(function($query) use ($term) {
                $query->where('name', 'like', "%{$term}%")
                      ->orWhere('rom_id', 'like', "%{$term}%")
                      ->orWhere('alternate_names', 'like', "%{$term}%");
            })
            ->count();
        
        echo "   '{$term}': {$count} jeux trouvés\n";
    }
    echo "\n";
}

// Chercher des tables avec des noms alternatifs
echo "═══════════════════════════════════════════════════════════════════════\n";
echo "🔍 RECHERCHE TABLES ALTERNATIVES\n";
echo "═══════════════════════════════════════════════════════════════════════\n\n";

$allTables = DB::select('SHOW TABLES');
$gbTables = [];

foreach ($allTables as $table) {
    $tableName = array_values((array)$table)[0];
    $lower = strtolower($tableName);
    
    if (str_contains($lower, 'gb') || 
        str_contains($lower, 'boy') || 
        str_contains($lower, 'color') || 
        str_contains($lower, 'advance')) {
        $gbTables[] = $tableName;
    }
}

if (empty($gbTables)) {
    echo "❌ Aucune table trouvée avec 'gb', 'boy', 'color' ou 'advance'\n";
} else {
    echo "📋 Tables trouvées:\n";
    foreach ($gbTables as $table) {
        try {
            $count = DB::table($table)->count();
            echo "   • {$table} ({$count} entrées)\n";
        } catch (\Exception $e) {
            echo "   • {$table} (erreur: {$e->getMessage()})\n";
        }
    }
}

echo "\n═══════════════════════════════════════════════════════════════════════\n";
echo "📊 CONCLUSION:\n";
echo "═══════════════════════════════════════════════════════════════════════\n\n";

$totalGB = DB::table('game_boy_games')->count();
echo "Total jeux dans game_boy_games: {$totalGB}\n";
echo "\n⚠️  Si game_boy_games contient GB + GBC + GBA mélangés,\n";
echo "   il faudrait peut-être une colonne pour distinguer les plateformes.\n";
echo "\n✅ Ou bien GB, GBC et GBA sont tous considérés comme 'Game Boy'\n";
echo "   et peuvent rester dans une seule table uniforme.\n";
echo "═══════════════════════════════════════════════════════════════════════\n";
