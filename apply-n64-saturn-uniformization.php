<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║       APPLICATION UNIFORMISATION - N64 & SEGA SATURN              ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

$sqlFile = 'uniformize-n64-sega-saturn.sql';

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
        
        // Ne garder que les ALTER TABLE, UPDATE et SET
        if (str_starts_with($statement, 'ALTER TABLE') || 
            str_starts_with($statement, 'UPDATE') ||
            str_starts_with($statement, 'SET')) {
            $statements[] = $statement;
        }
        
        $currentStatement = '';
    }
}

echo "   Statements à exécuter: " . count($statements) . "\n\n";

echo "⚠️  AVERTISSEMENT:\n";
echo "   Ce script va ajouter 16 colonnes aux tables n64_games et sega_saturn_games.\n";
echo "   Il va également copier name → rom_id pour Sega Saturn (331 jeux).\n\n";

echo "🔄 Application des migrations...\n";
echo str_repeat("─", 72) . "\n";

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

// Vérifications post-migration
echo "\n" . str_repeat("═", 72) . "\n";
echo "🔍 VÉRIFICATIONS POST-MIGRATION\n";
echo str_repeat("═", 72) . "\n\n";

foreach (['n64_games', 'sega_saturn_games'] as $table) {
    $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
    $columnCount = count($columns);
    $totalGames = DB::table($table)->count();
    $romIdFilled = DB::table($table)->whereNotNull('rom_id')->where('rom_id', '!=', '')->count();
    
    echo "📊 {$table}:\n";
    echo "   Total colonnes: {$columnCount}\n";
    echo "   Total lignes: {$totalGames}\n";
    
    if ($totalGames > 0) {
        $percentage = round(($romIdFilled / $totalGames) * 100, 1);
        echo "   ROM_ID remplis: {$romIdFilled}/{$totalGames} ({$percentage}%)\n";
        
        if ($romIdFilled === $totalGames) {
            echo "   ✅ Tous les jeux ont un ROM_ID\n";
        } elseif ($romIdFilled === 0) {
            echo "   ⚠️  Aucun jeu n'a de ROM_ID\n";
        }
    }
    
    echo "\n";
}

echo str_repeat("═", 72) . "\n";
echo "🎯 RÉSUMÉ UNIFORMISATION\n";
echo str_repeat("═", 72) . "\n\n";

// Vérifier si toutes les tables ont 21 colonnes
$allTables = [
    'game_boy_games',
    'snes_games',
    'nes_games',
    'wonderswan_games',
    'game_gear_games',
    'mega_drive_games',
    'n64_games',
    'sega_saturn_games',
];

$allUniform = true;
$targetColumns = 21;

foreach ($allTables as $table) {
    $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
    $count = count($columns);
    
    if ($count !== $targetColumns) {
        $allUniform = false;
        echo "⚠️  {$table}: {$count} colonnes (attendu: {$targetColumns})\n";
    }
}

if ($allUniform) {
    echo "✅ SUCCÈS: Toutes les 8 tables ont {$targetColumns} colonnes!\n\n";
    echo "📋 Tables uniformisées:\n";
    foreach ($allTables as $table) {
        echo "   ✓ {$table}\n";
    }
} else {
    echo "⚠️  Certaines tables n'ont pas encore 21 colonnes.\n";
}

echo "\n" . str_repeat("═", 72) . "\n";
echo "✅ Uniformisation terminée!\n";
echo str_repeat("═", 72) . "\n";
