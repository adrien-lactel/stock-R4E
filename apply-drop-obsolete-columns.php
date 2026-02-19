<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║         APPLICATION MIGRATION - SUPPRESSION 5 COLONNES OBSOLÈTES            ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

$sqlFile = 'drop-obsolete-columns-5.sql';

if (!file_exists($sqlFile)) {
    echo "❌ Fichier SQL introuvable: {$sqlFile}\n";
    exit(1);
}

echo "📄 Lecture du fichier SQL...\n";
$sqlContent = file_get_contents($sqlFile);

// Parser les statements
$statements = [];
$lines = explode("\n", $sqlContent);
$currentStatement = '';

foreach ($lines as $line) {
    $line = trim($line);
    
    // Ignorer les commentaires et lignes vides
    if (empty($line) || str_starts_with($line, '--')) {
        continue;
    }
    
    $currentStatement .= ' ' . $line;
    
    // Si la ligne se termine par ; c'est la fin du statement
    if (str_ends_with($line, ';')) {
        $statement = trim($currentStatement);
        
        // Ne garder que les ALTER TABLE et SET
        if (str_starts_with($statement, 'ALTER TABLE') || 
            str_starts_with($statement, 'SET')) {
            $statements[] = $statement;
        }
        
        $currentStatement = '';
    }
}

echo "   Statements à exécuter: " . count($statements) . "\n\n";

echo "⚠️  AVERTISSEMENT:\n";
echo "   Ce script va supprimer 5 colonnes de 8 tables de jeux.\n";
echo "   Schéma: 20 colonnes → 15 colonnes (-25%)\n";
echo "   Impact: 40 colonnes supprimées au total\n";
echo "   \n";
echo "   Colonnes à supprimer:\n";
echo "   • slug           (3.8% utilisé - 492 Game Gear)\n";
echo "   • image_url      (0% utilisé)\n";
echo "   • image_path     (0% utilisé)\n";
echo "   • match_type     (0% utilisé)\n";
echo "   • match_score    (0% utilisé)\n\n";

echo "🔄 Application de la migration...\n";
echo str_repeat("─", 80) . "\n";

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
            preg_match('/ALTER TABLE `?(\w+)`? DROP COLUMN `?(\w+)`?/', $statement, $matches);
            if (count($matches) >= 3) {
                $table = $matches[1];
                $column = $matches[2];
                echo "   🗑️  {$table}: suppression {$column}\n";
            }
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
            
            // Ne pas arrêter si la colonne n'existe déjà plus
            if (str_contains($e->getMessage(), "Can't DROP") || 
                str_contains($e->getMessage(), "check that it exists")) {
                echo "   ℹ️  Colonne déjà supprimée, on continue...\n";
            }
        }
    }
    
    echo "\n✅ Migration terminée!\n";
    echo "   Statements exécutés: {$executed}\n";
    
    if ($failed > 0) {
        echo "   ⚠️  Statements échoués: {$failed}\n";
    }
    
} catch (\Exception $e) {
    echo "\n❌ ERREUR CRITIQUE: " . $e->getMessage() . "\n";
    exit(1);
}

// Vérifications post-migration
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
    'n64_games',
    'sega_saturn_games',
];

$columnsToCheck = ['slug', 'image_url', 'image_path', 'match_type', 'match_score'];

$allCorrect = true;

foreach ($tables as $table) {
    $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
    $columnCount = count($columns);
    $columnNames = array_map(fn($col) => $col->Field, $columns);
    
    $hasObsoleteColumns = array_intersect($columnsToCheck, $columnNames);
    
    echo "📊 {$table}:\n";
    echo "   Colonnes: {$columnCount}/15\n";
    
    if (count($hasObsoleteColumns) > 0) {
        echo "   ❌ Colonnes obsolètes restantes: " . implode(', ', $hasObsoleteColumns) . "\n";
        $allCorrect = false;
    } else {
        echo "   ✅ Toutes les colonnes obsolètes supprimées\n";
    }
    
    if ($columnCount !== 15) {
        echo "   ⚠️  Nombre de colonnes incorrect (attendu: 15, trouvé: {$columnCount})\n";
        $allCorrect = false;
    }
    
    echo "\n";
}

echo str_repeat("═", 80) . "\n";
echo "🎯 RÉSULTAT FINAL\n";
echo str_repeat("═", 80) . "\n\n";

if ($allCorrect) {
    echo "✅ SUCCÈS: Toutes les tables ont 15 colonnes sans colonnes obsolètes!\n\n";
    
    echo "📋 Schéma final (15 colonnes):\n";
    echo "   1. id                - Clé primaire\n";
    echo "   2. rom_id            - Identifiant unique\n";
    echo "   3. cartridge_id      - ID physique cartouche\n";
    echo "   4. name              - Nom du jeu\n";
    echo "   5. name_jp           - Nom japonais\n";
    echo "   6. alternate_names   - Noms alternatifs\n";
    echo "   7. year              - Année\n";
    echo "   8. publisher         - Éditeur\n";
    echo "   9. developer         - Développeur\n";
    echo "   10. region           - Région\n";
    echo "   11. libretro_name    - Nom Libretro\n";
    echo "   12. source           - Source données\n";
    echo "   13. price            - Prix moyen\n";
    echo "   14. created_at       - Date création\n";
    echo "   15. updated_at       - Date MàJ\n\n";
    
    echo "🎉 SIMPLIFICATION COMPLÈTE:\n";
    echo "   ✓ 5 colonnes obsolètes supprimées\n";
    echo "   ✓ Schéma optimisé: 20 → 15 colonnes (-25%)\n";
    echo "   ✓ 8 tables uniformisées\n";
    echo "   ✓ Base de données plus légère et maintenable\n\n";
    
    echo "📸 GESTION IMAGES:\n";
    echo "   → Pattern R2: products/games/{platform}/{rom_id}-{type}-{index}.jpg\n";
    echo "   → Types: cover, artwork, gameplay, logo\n";
    echo "   → Flexibilité: N images par type sans limite BDD\n\n";
    
} else {
    echo "⚠️  ATTENTION: Certaines tables ont encore des problèmes.\n";
    echo "   Vérifiez les détails ci-dessus.\n\n";
}

echo str_repeat("═", 80) . "\n";
echo "✅ Migration des colonnes obsolètes terminée!\n";
echo str_repeat("═", 80) . "\n";
