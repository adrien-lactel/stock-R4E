<?php

require __dir__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $pdo = new PDO(
        "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};charset=utf8mb4",
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
    echo "║                  EXÉCUTION - ROM_ID GAME GEAR                                ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Lire le fichier SQL ligne par ligne
    $lines = file('generate-rom-ids-game-gear.sql', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    $commands = [];
    foreach ($lines as $line) {
        $line = trim($line);
        // Ignorer les commentaires et la ligne USE
        if (empty($line) || strpos($line, '--') === 0 || stripos($line, 'USE ') === 0) {
            continue;
        }
        // Enlever le commentaire en fin de ligne
        if (strpos($line, ' --') !== false) {
            $line = trim(substr($line, 0, strpos($line, ' --')));
        }
        if (!empty($line)) {
            $commands[] = $line;
        }
    }

    echo "📊 Commandes SQL à exécuter: " . count($commands) . "\n\n";
    echo "⏳ Exécution en cours...\n";

    $pdo->beginTransaction();
    
    $count = 0;
    foreach ($commands as $command) {
        $pdo->exec($command);
        $count++;
        
        if ($count % 100 == 0) {
            echo "   ✓ $count commandes exécutées...\n";
        }
    }

    $pdo->commit();

    echo "\n✅ Succès! $count ROM_ID mis à jour.\n\n";

    // Vérifier
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM game_gear_games WHERE ROM_ID IS NOT NULL AND ROM_ID != ''");
    $withRomId = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM game_gear_games");
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    echo "📊 VÉRIFICATION:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n";
    echo "   Total jeux: $total\n";
    echo "   Avec ROM_ID: $withRomId\n";
    echo "   Sans ROM_ID: " . ($total - $withRomId) . "\n\n";

    if ($withRomId == $total) {
        echo "✅ Tous les jeux ont maintenant un ROM_ID!\n\n";
        echo "🚀 PROCHAINE ÉTAPE:\n";
        echo "   php verify-all-platforms-images.php\n\n";
    } else {
        echo "⚠️  Certains jeux n'ont pas de ROM_ID.\n\n";
    }

} catch (PDOException $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
