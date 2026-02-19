<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║              EXÉCUTION NORMALISATION WONDERSWAN - LOCAL                    ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Lire le fichier SQL
$sqlFile = 'normalize-wonderswan.sql';
if (!file_exists($sqlFile)) {
    echo "❌ Fichier {$sqlFile} introuvable!\n";
    exit(1);
}

$sql = file_get_contents($sqlFile);

// Extraire les commandes SQL (en ignorant les commentaires)
$lines = explode("\n", $sql);
$commands = [];
$currentCommand = '';

foreach ($lines as $line) {
    $line = trim($line);
    
    // Ignorer les commentaires et lignes vides
    if (empty($line) || strpos($line, '--') === 0) {
        continue;
    }
    
    // Ignorer START TRANSACTION et COMMIT (Laravel gère ça)
    if (in_array(strtoupper($line), ['START TRANSACTION;', 'COMMIT;'])) {
        continue;
    }
    
    $currentCommand .= ' ' . $line;
    
    // Si la commande se termine par ;, l'ajouter à la liste
    if (substr($line, -1) === ';') {
        $commands[] = trim($currentCommand);
        $currentCommand = '';
    }
}

echo "📊 Commandes SQL trouvées: " . count($commands) . "\n\n";

// Compter les jeux avant
$countBefore = DB::table('wonderswan_games')->count();
echo "🎮 Jeux en base AVANT: {$countBefore}\n\n";

// Exécuter dans une transaction
DB::beginTransaction();

try {
    $deletes = 0;
    $updates = 0;
    
    echo "⏳ Exécution en cours...\n\n";
    
    foreach ($commands as $i => $command) {
        DB::statement($command);
        
        // Compter les types d'opérations
        if (stripos($command, 'DELETE') === 0) {
            $deletes++;
        } elseif (stripos($command, 'UPDATE') === 0) {
            $updates++;
        }
        
        // Afficher progression tous les 50 commandes
        if (($i + 1) % 50 === 0) {
            echo "   ✓ " . ($i + 1) . " commandes exécutées...\n";
        }
    }
    
    DB::commit();
    
    $countAfter = DB::table('wonderswan_games')->count();
    
    echo "\n══════════════════════════════════════════════════════════════════════════════\n";
    echo "✅ NORMALISATION TERMINÉE AVEC SUCCÈS\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    echo "📊 Résumé:\n";
    echo "  • Suppressions: {$deletes}\n";
    echo "  • Mises à jour: {$updates}\n";
    echo "  • Jeux AVANT: {$countBefore}\n";
    echo "  • Jeux APRÈS: {$countAfter}\n";
    echo "  • Différence: " . ($countBefore - $countAfter) . " (doublons supprimés)\n\n";
    
    // Afficher quelques exemples de jeux normalisés
    echo "══════════════════════════════════════════════════════════════════════════════\n";
    echo "📋 EXEMPLES DE JEUX NORMALISÉS (10 premiers)\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    
    $samples = DB::table('wonderswan_games')
        ->select('id', 'name')
        ->orderBy('name')
        ->limit(10)
        ->get();
    
    foreach ($samples as $game) {
        echo "  • ID {$game->id}: {$game->name}\n";
    }
    
    echo "\n💡 PROCHAINE ÉTAPE: Vérifier les correspondances avec les images\n";
    echo "   → php verify-all-platforms-images.php\n\n";
    
} catch (\Exception $e) {
    DB::rollBack();
    
    echo "\n══════════════════════════════════════════════════════════════════════════════\n";
    echo "❌ ERREUR LORS DE LA NORMALISATION\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    echo "Message: " . $e->getMessage() . "\n\n";
    echo "💡 La transaction a été annulée, la base n'a pas été modifiée.\n";
    echo "   Pour restaurer si nécessaire: Get-Content rollback-wonderswan.sql | php apply-sql.php\n\n";
    
    exit(1);
}
