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
    echo "║        AJOUT 51 NOUVEAUX JEUX - GAME GEAR                                    ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Lire le fichier SQL
    $sql = file_get_contents('add-new-game-gear-games.sql');
    
    // Séparer les lignes
    $lines = explode("\n", $sql);
    $commands = [];
    
    foreach ($lines as $line) {
        $line = trim($line);
        if (empty($line) || strpos($line, '--') === 0) {
            continue;
        }
        if (strpos($line, 'INSERT') === 0) {
            $commands[] = $line;
        }
    }

    echo "📊 Insertions à effectuer: " . count($commands) . "\n\n";
    echo "⏳ Exécution...\n\n";

    $pdo->beginTransaction();
    
    $count = 0;
    foreach ($commands as $command) {
        try {
            $pdo->exec($command);
            $count++;
        } catch (PDOException $e) {
            // Ignorer les doublons
            if (strpos($e->getMessage(), 'Duplicate') !== false) {
                echo "⚠️  Existe déjà (ignoré)\n";
            } else {
                throw $e;
            }
        }
    }

    $pdo->commit();

    echo "\n✅ Jeux ajoutés: $count\n\n";

    // Vérifier
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM game_gear_games");
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    echo "📊 Total jeux en base: $total\n\n";
    echo "🚀 PROCHAINE ÉTAPE:\n";
    echo "   php verify-all-platforms-images.php\n\n";

} catch (PDOException $e) {
    if (isset($pdo) && $pdo->inTransaction()) {
        $pdo->rollBack();
    }
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
