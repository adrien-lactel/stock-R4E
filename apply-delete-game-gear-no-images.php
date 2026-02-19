<?php

require __DIR__ . '/vendor/autoload.php';

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
    echo "║          SUPPRESSION JEUX SANS IMAGES - GAME GEAR → 100%                    ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Lire le fichier SQL
    $lines = file('delete-game-gear-no-images.sql', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    $commands = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '--') === 0) {
            continue;
        }
        if (strpos($line, 'DELETE') === 0) {
            $commands[] = $line;
        }
    }

    echo "📊 Suppressions à effectuer: " . count($commands) . "\n\n";
    
    // Compter avant
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM game_gear_games");
    $beforeCount = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    echo "   Avant: $beforeCount jeux\n";
    echo "   Après: " . ($beforeCount - count($commands)) . " jeux (attendu)\n\n";
    echo "⏳ Exécution...\n\n";

    $pdo->beginTransaction();
    
    $count = 0;
    foreach ($commands as $command) {
        $pdo->exec($command);
        $count++;
        
        if ($count % 50 == 0) {
            echo "   ✓ $count suppressions...\n";
        }
    }

    $pdo->commit();

    echo "\n✅ Suppressions effectuées: $count\n\n";

    // Compter après
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM game_gear_games");
    $afterCount = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    echo "📊 RÉSULTAT:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n";
    echo "   Avant: $beforeCount jeux\n";
    echo "   Après: $afterCount jeux\n";
    echo "   Supprimés: " . ($beforeCount - $afterCount) . "\n\n";

    echo "🚀 VÉRIFICATION:\n";
    echo "   php final-stats-game-gear.php\n\n";

} catch (PDOException $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
