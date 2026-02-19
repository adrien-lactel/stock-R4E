<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("LISTE DES BASES DE JEUX VIDÉO", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

// Récupérer toutes les tables de la base
$tables = DB::select('SHOW TABLES');
$dbName = DB::getDatabaseName();
$tableKey = "Tables_in_{$dbName}";

// Filtrer les tables de jeux (celles qui se terminent par _games)
$gameTables = [];
foreach ($tables as $table) {
    $tableName = $table->$tableKey;
    if (str_ends_with($tableName, '_games')) {
        $gameTables[] = $tableName;
    }
}

echo "📊 Tables de jeux vidéo trouvées: " . count($gameTables) . "\n\n";

// Pour chaque table, récupérer des statistiques
$totalGames = 0;
$stats = [];

foreach ($gameTables as $tableName) {
    // Compter les jeux
    $count = DB::table($tableName)->count();
    $totalGames += $count;
    
    // Récupérer la structure de la table
    $columns = Schema::getColumnListing($tableName);
    
    // Vérifier si la table a un rom_id
    $hasRomId = in_array('rom_id', $columns);
    $hasImages = in_array('image', $columns) || in_array('cover_image', $columns);
    
    // Récupérer quelques exemples
    $examples = DB::table($tableName)->select('name')->limit(3)->get()->pluck('name')->toArray();
    
    $stats[] = [
        'table' => $tableName,
        'count' => $count,
        'has_rom_id' => $hasRomId,
        'has_images' => $hasImages,
        'columns' => count($columns),
        'examples' => $examples
    ];
}

// Trier par nombre de jeux (décroissant)
usort($stats, function($a, $b) {
    return $b['count'] - $a['count'];
});

// Afficher le tableau
echo str_repeat("─", 80) . "\n";
printf("%-30s | %8s | %6s | %7s | %12s\n", "TABLE", "JEUX", "ROM ID", "IMAGES", "COLONNES");
echo str_repeat("─", 80) . "\n";

foreach ($stats as $stat) {
    $platformName = str_replace('_games', '', $stat['table']);
    $platformName = ucwords(str_replace('_', ' ', $platformName));
    
    printf(
        "%-30s | %8s | %6s | %7s | %12s\n",
        $platformName,
        number_format($stat['count']),
        $stat['has_rom_id'] ? '✓' : '✗',
        $stat['has_images'] ? '✓' : '✗',
        $stat['columns']
    );
}

echo str_repeat("─", 80) . "\n";
echo "TOTAL: " . number_format($totalGames) . " jeux dans " . count($gameTables) . " plateformes\n\n";

// Détails de chaque plateforme
echo "\n" . str_repeat("═", 80) . "\n";
echo "📋 DÉTAILS PAR PLATEFORME\n";
echo str_repeat("═", 80) . "\n\n";

foreach ($stats as $stat) {
    $platformName = str_replace('_games', '', $stat['table']);
    $platformName = ucwords(str_replace('_', ' ', $platformName));
    
    echo "🎮 {$platformName}\n";
    echo "   Table: {$stat['table']}\n";
    echo "   Jeux: " . number_format($stat['count']) . "\n";
    echo "   ROM ID: " . ($stat['has_rom_id'] ? 'Oui' : 'Non') . "\n";
    echo "   Colonnes: {$stat['columns']}\n";
    
    if (!empty($stat['examples'])) {
        echo "   Exemples:\n";
        foreach ($stat['examples'] as $example) {
            echo "      • {$example}\n";
        }
    }
    echo "\n";
}

echo str_repeat("═", 80) . "\n";

// Statistiques globales
echo "\n📊 STATISTIQUES GLOBALES\n\n";
echo "   Plateformes avec ROM ID: " . count(array_filter($stats, fn($s) => $s['has_rom_id'])) . "\n";
echo "   Plateformes sans ROM ID: " . count(array_filter($stats, fn($s) => !$s['has_rom_id'])) . "\n";
echo "   Plus grande base: " . $stats[0]['table'] . " (" . number_format($stats[0]['count']) . " jeux)\n";
echo "   Plus petite base: " . end($stats)['table'] . " (" . number_format(end($stats)['count']) . " jeux)\n";
echo "   Moyenne par plateforme: " . number_format($totalGames / count($gameTables), 0) . " jeux\n\n";

echo str_repeat("═", 80) . "\n";
