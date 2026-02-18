<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║         APPLICATION RÉORDONNANCEMENT - COLONNES                    ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

$sqlFile = 'reorder-game-tables-columns.sql';

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

echo "🔄 Application des modifications...\n";
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
            echo "   ⚙️  Réordonnancement de {$table}...\n";
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
        }
    }
    
    echo "\n✅ Réordonnancement terminé avec succès!\n";
    echo "   Statements exécutés: {$executed}\n";
    
    if ($failed > 0) {
        echo "   ⚠️  Statements échoués: {$failed}\n";
    }
    
} catch (\Exception $e) {
    echo "\n❌ ERREUR CRITIQUE: " . $e->getMessage() . "\n";
    exit(1);
}

// Vérification finale
echo "\n" . str_repeat("═", 72) . "\n";
echo "🔍 VÉRIFICATION FINALE\n";
echo str_repeat("═", 72) . "\n\n";

$tables = ['nes_games', 'mega_drive_games'];

foreach ($tables as $table) {
    $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
    $columnNames = array_map(fn($col) => $col->Field, $columns);
    
    echo "📋 {$table}:\n";
    echo "   Ordre: " . implode(', ', $columnNames) . "\n\n";
}

echo str_repeat("═", 72) . "\n";
echo "✅ Vérification terminée!\n";
echo str_repeat("═", 72) . "\n";
