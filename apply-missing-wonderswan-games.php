<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║           AJOUT DES JEUX WONDERSWAN MANQUANTS - LOCAL                     ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Lire le fichier SQL
$sqlFile = 'add-missing-wonderswan-games.sql';
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

$countBefore = DB::table('wonderswan_games')->count();
echo "🎮 Jeux en base AVANT: {$countBefore}\n\n";

// Exécuter dans une transaction
DB::beginTransaction();

try {
    $inserted = 0;
    
    echo "⏳ Exécution en cours...\n\n";
    
    foreach ($commands as $i => $command) {
        DB::statement($command);
        $inserted++;
        
        if (($i + 1) % 10 === 0) {
            echo "   ✓ " . ($i + 1) . " insertions effectuées...\n";
        }
    }
    
    DB::commit();
    
    $countAfter = DB::table('wonderswan_games')->count();
    
    echo "\n══════════════════════════════════════════════════════════════════════════════\n";
    echo "✅ AJOUT TERMINÉ AVEC SUCCÈS\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    echo "📊 Résumé:\n";
    echo "  • Insertions: {$inserted}\n";
    echo "  • Jeux AVANT: {$countBefore}\n";
    echo "  • Jeux APRÈS: {$countAfter}\n";
    echo "  • Différence: " . ($countAfter - $countBefore) . "\n\n";
    
    // Afficher quelques exemples de jeux ajoutés
    echo "══════════════════════════════════════════════════════════════════════════════\n";
    echo "📋 EXEMPLES DE JEUX AJOUTÉS (10 derniers)\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    
    $samples = DB::table('wonderswan_games')
        ->select('id', 'name')
        ->orderBy('id', 'desc')
        ->limit(10)
        ->get();
    
    foreach ($samples as $game) {
        echo "  • ID {$game->id}: {$game->name}\n";
    }
    
    echo "\n💡 PROCHAINE ÉTAPE: Vérifier la correspondance 100%\n";
    echo "   → php verify-all-platforms-images.php\n\n";
    
} catch (\Exception $e) {
    DB::rollBack();
    
    echo "\n══════════════════════════════════════════════════════════════════════════════\n";
    echo "❌ ERREUR LORS DE L'AJOUT\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    echo "Message: " . $e->getMessage() . "\n\n";
    echo "💡 La transaction a été annulée.\n\n";
    
    exit(1);
}
