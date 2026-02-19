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
    echo "║         APPLICATION ROM_ID - GAME GEAR (AVEC RÉGIONS)                       ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Lire le fichier SQL
    $lines = file('regenerate-rom-ids-game-gear-with-regions.sql', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    $commands = [];
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '--') === 0) {
            continue;
        }
        if (!empty($line)) {
            $commands[] = $line;
        }
    }

    echo "📊 Commandes SQL à exécuter: " . count($commands) . "\n\n";
    echo "⏳ Exécution en cours...\n\n";

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
    $stmt = $pdo->query("SELECT id, name, ROM_ID FROM game_gear_games WHERE name LIKE '%Aladdin%' AND name NOT LIKE '%tr%' ORDER BY name LIMIT 5");
    
    echo "📋 VÉRIFICATION (exemples Aladdin):\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $match = $row['name'] === $row['ROM_ID'] ? '✓' : '✗';
        echo sprintf("   %s ID %-4d | Name: %-50s | ROM_ID: %s\n", 
            $match,
            $row['id'], 
            substr($row['name'], 0, 50),
            $row['ROM_ID']
        );
    }

    echo "\n🚀 PROCHAINE ÉTAPE:\n";
    echo "   php verify-all-platforms-images.php\n\n";

} catch (PDOException $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
