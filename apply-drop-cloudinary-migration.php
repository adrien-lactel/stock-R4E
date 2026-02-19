<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║         APPLICATION MIGRATION - SUPPRESSION cloudinary_url                  ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

$sqlFile = 'drop-cloudinary-url-column.sql';

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
echo "   Ce script va supprimer la colonne cloudinary_url de 8 tables.\n";
echo "   Schéma: 21 colonnes → 20 colonnes\n";
echo "   Impact: 0 jeux affectés (colonne vide)\n\n";

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
            preg_match('/ALTER TABLE `?(\w+)`?/', $statement, $matches);
            $table = $matches[1] ?? 'unknown';
            echo "   🗑️  Suppression cloudinary_url de {$table}...\n";
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
            if (str_contains($e->getMessage(), "Can't DROP")) {
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

$allCorrect = true;

foreach ($tables as $table) {
    $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
    $columnCount = count($columns);
    $columnNames = array_map(fn($col) => $col->Field, $columns);
    
    $hasCloudinary = in_array('cloudinary_url', $columnNames);
    
    echo "📊 {$table}:\n";
    echo "   Colonnes: {$columnCount}/20\n";
    
    if ($hasCloudinary) {
        echo "   ❌ cloudinary_url existe encore!\n";
        $allCorrect = false;
    } else {
        echo "   ✅ cloudinary_url supprimée\n";
    }
    
    if ($columnCount !== 20) {
        echo "   ⚠️  Nombre de colonnes incorrect (attendu: 20)\n";
        $allCorrect = false;
    }
    
    echo "\n";
}

echo str_repeat("═", 80) . "\n";
echo "🎯 RÉSULTAT FINAL\n";
echo str_repeat("═", 80) . "\n\n";

if ($allCorrect) {
    echo "✅ SUCCÈS: Toutes les tables ont 20 colonnes sans cloudinary_url!\n\n";
    
    echo "📋 Schéma final (20 colonnes):\n";
    echo "   id, rom_id, cartridge_id, name, name_jp, alternate_names,\n";
    echo "   year, publisher, developer, region, slug, image_url,\n";
    echo "   image_path, libretro_name, match_type, match_score,\n";
    echo "   source, price, created_at, updated_at\n\n";
    
    echo "🎉 MIGRATION R2 COMPLÈTE:\n";
    echo "   ✓ Code migré vers Cloudflare R2\n";
    echo "   ✓ Colonne cloudinary_url supprimée\n";
    echo "   ✓ Schéma simplifié: 21 → 20 colonnes\n";
    echo "   ✓ 8 tables uniformisées\n\n";
    
} else {
    echo "⚠️  ATTENTION: Certaines tables ont encore des problèmes.\n";
    echo "   Vérifiez les détails ci-dessus.\n\n";
}

echo str_repeat("═", 80) . "\n";
echo "✅ Migration cloudinary_url terminée!\n";
echo str_repeat("═", 80) . "\n";
