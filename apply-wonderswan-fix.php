<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║       EXÉCUTION CORRECTION WONDERSWAN - 'for WonderSwan' PATCH            ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Lire le fichier SQL
$sqlFile = 'fix-wonderswan-for-wonderswan.sql';
if (!file_exists($sqlFile)) {
    echo "❌ Fichier {$sqlFile} introuvable!\n";
    exit(1);
}

$sql = file_get_contents($sqlFile);

// Extraire les commandes SQL
$lines = explode("\n", $sql);
$commands = [];
$currentCommand = '';

foreach ($lines as $line) {
    $line = trim($line);
    
    if (empty($line) || strpos($line, '--') === 0) {
        continue;
    }
    
    if (in_array(strtoupper($line), ['START TRANSACTION;', 'COMMIT;'])) {
        continue;
    }
    
    $currentCommand .= ' ' . $line;
    
    if (substr($line, -1) === ';') {
        $commands[] = trim($currentCommand);
        $currentCommand = '';
    }
}

echo "📊 Commandes SQL: " . count($commands) . "\n\n";

// Exécuter dans une transaction
DB::beginTransaction();

try {
    $updated = 0;
    
    foreach ($commands as $command) {
        DB::statement($command);
        $updated++;
    }
    
    DB::commit();
    
    echo "══════════════════════════════════════════════════════════════════════════════\n";
    echo "✅ CORRECTIONS APPLIQUÉES AVEC SUCCÈS\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    echo "📊 Mises à jour: {$updated}\n\n";
    
    echo "💡 VÉRIFIER LES RÉSULTATS:\n";
    echo "   php verify-all-platforms-images.php\n\n";
    
} catch (\Exception $e) {
    DB::rollBack();
    
    echo "══════════════════════════════════════════════════════════════════════════════\n";
    echo "❌ ERREUR\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    echo "Message: " . $e->getMessage() . "\n\n";
    
    exit(1);
}
