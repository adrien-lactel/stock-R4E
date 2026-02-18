<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("APPLICATION UNIFORMISATION - TABLES DE JEUX", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

$sqlFile = 'uniformize-all-game-tables.sql';

if (!file_exists($sqlFile)) {
    die("❌ Fichier {$sqlFile} introuvable!\n");
}

echo "📄 Lecture du fichier SQL...\n";
$sql = file_get_contents($sqlFile);

echo "⚠️  AVERTISSEMENT:\n";
echo "   Ce script va modifier la structure de 6 tables de jeux.\n";
echo "   Il va ajouter des colonnes et copier name → rom_id pour Mega Drive.\n\n";

echo "✅ Démarrage de l'application des migrations...\n";

echo "\n🔄 Application des migrations...\n";
echo str_repeat("-", 80) . "\n";

// Séparer les statements SQL
$statements = [];
$lines = explode("\n", $sql);
$currentStatement = '';

foreach ($lines as $line) {
    $line = trim($line);
    
    // Ignorer les commentaires
    if (empty($line) || str_starts_with($line, '--')) {
        continue;
    }
    
    $currentStatement .= ' ' . $line;
    
    // Si la ligne se termine par un point-virgule, c'est la fin d'un statement
    if (str_ends_with($line, ';')) {
        $stmt = trim($currentStatement);
        
        // Ne garder que les ALTER TABLE, UPDATE, et SET
        if (str_starts_with($stmt, 'ALTER TABLE') || 
            str_starts_with($stmt, 'UPDATE') ||
            str_starts_with($stmt, 'SET FOREIGN_KEY')) {
            $statements[] = $stmt;
        }
        
        $currentStatement = '';
    }
}

echo "   Statements à exécuter: " . count($statements) . "\n\n";

$executed = 0;
$failed = 0;

try {
    foreach ($statements as $statement) {
        $statement = trim($statement);
        
        if (empty($statement)) {
            continue;
        }
        
        // Afficher le type d'opération
        if (str_starts_with($statement, 'ALTER TABLE')) {
            preg_match('/ALTER TABLE `?(\w+)`?/', $statement, $matches);
            $table = $matches[1] ?? 'unknown';
            echo "   ⚙️  Modification de {$table}...\n";
        } elseif (str_starts_with($statement, 'UPDATE')) {
            preg_match('/UPDATE (\w+)/', $statement, $matches);
            $table = $matches[1] ?? 'unknown';
            echo "   🔄 UPDATE sur {$table}...\n";
        } elseif (str_starts_with($statement, 'SET')) {
            echo "   ⚙️  Configuration: " . substr($statement, 0, 50) . "...\n";
        }
        
        try {
            DB::statement($statement);
            $executed++;
        } catch (\Exception $e) {
            $failed++;
            echo "   ❌ ERREUR: " . $e->getMessage() . "\n";
            echo "   Statement: " . substr($statement, 0, 100) . "...\n";
            
            // Ne pas arrêter pour les erreurs de colonnes déjà existantes
            if (str_contains($e->getMessage(), 'Duplicate column name')) {
                echo "   ℹ️  Colonne déjà existante, on continue...\n";
            }
        }
    }
    
    echo "\n✅ Migration terminée avec succès!\n";
    echo "   Statements exécutés: {$executed}\n";
    
    if ($failed > 0) {
        echo "   ⚠️  Statements échoués: {$failed}\n";
    }
    
} catch (\Exception $e) {
    echo "\n❌ ERREUR CRITIQUE: " . $e->getMessage() . "\n";
    exit(1);
}

echo "\n" . str_repeat("═", 80) . "\n";
echo "🔍 VÉRIFICATIONS POST-MIGRATION\n";
echo str_repeat("═", 80) . "\n\n";

$tables = [
    'game_boy_games',
    'snes_games',
    'nes_games',
    'wonderswan_games',
    'game_gear_games',
    'mega_drive_games',
];

foreach ($tables as $table) {
    $columns = DB::select("SHOW COLUMNS FROM {$table}");
    $count = DB::table($table)->count();
    
    echo "📊 {$table}:\n";
    echo "   Total colonnes: " . count($columns) . "\n";
    echo "   Total lignes: {$count}\n";
    
    // Vérifier ROM_ID
    if ($table === 'mega_drive_games') {
        $withRomId = DB::table($table)->whereNotNull('rom_id')->where('rom_id', '!=', '')->count();
        echo "   ROM_ID remplis: {$withRomId}/{$count}\n";
        
        if ($withRomId === $count) {
            echo "   ✅ Tous les jeux ont un ROM_ID\n";
        } else {
            echo "   ⚠️  " . ($count - $withRomId) . " jeux sans ROM_ID\n";
        }
    } elseif ($table === 'game_gear_games') {
        $withRomId = DB::table($table)->whereNotNull('rom_id')->where('rom_id', '!=', '')->count();
        echo "   ROM_ID remplis: {$withRomId}/{$count}\n";
    }
    
    echo "\n";
}

// Vérifier que toutes les tables ont le même nombre de colonnes
echo "═" . str_repeat("═", 79) . "\n";
echo "🎯 RÉSUMÉ UNIFORMISATION\n";
echo "═" . str_repeat("═", 79) . "\n\n";

$columnCounts = [];
foreach ($tables as $table) {
    $columns = DB::select("SHOW COLUMNS FROM {$table}");
    $columnCounts[$table] = count($columns);
}

$allSame = count(array_unique($columnCounts)) === 1;

if ($allSame) {
    echo "✅ SUCCÈS: Toutes les tables ont le même nombre de colonnes (" . reset($columnCounts) . ")\n\n";
} else {
    echo "⚠️  ATTENTION: Nombre de colonnes différent:\n";
    foreach ($columnCounts as $table => $count) {
        echo "   - {$table}: {$count} colonnes\n";
    }
    echo "\n";
}

echo "📋 Colonnes attendues: 21\n";
echo "   1. id, 2. rom_id, 3. cartridge_id, 4. name, 5. name_jp\n";
echo "   6. alternate_names, 7. year, 8. publisher, 9. developer, 10. region\n";
echo "   11. slug, 12. image_url, 13. image_path, 14. cloudinary_url\n";
echo "   15. libretro_name, 16. match_type, 17. match_score, 18. source\n";
echo "   19. price, 20. created_at, 21. updated_at\n\n";

echo str_repeat("═", 80) . "\n";
echo "✅ Uniformisation terminée!\n";
echo str_repeat("═", 80) . "\n";
