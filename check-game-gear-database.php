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
    echo "║                       ANALYSE DATABASE GAME GEAR                             ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Total
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM game_gear_games");
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    echo "📊 Total jeux en base: $total\n\n";

    // ROM_ID null
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM game_gear_games WHERE ROM_ID IS NULL OR ROM_ID = ''");
    $nullRomId = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    echo "⚠️  ROM_ID NULL ou vide: $nullRomId\n\n";

    // Exemples avec ROM_ID
    echo "✅ Exemples avec ROM_ID (20 premiers):\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n";
    $stmt = $pdo->query("SELECT id, name, ROM_ID FROM game_gear_games WHERE ROM_ID IS NOT NULL AND ROM_ID != '' ORDER BY id LIMIT 20");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo sprintf("   ID: %-4d | Name: %-50s | ROM_ID: %s\n", $row['id'], substr($row['name'], 0, 50), $row['ROM_ID']);
    }

    // Exemples sans ROM_ID
    echo "\n❌ Exemples sans ROM_ID (20 premiers):\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n";
    $stmt = $pdo->query("SELECT id, name, ROM_ID FROM game_gear_games WHERE ROM_ID IS NULL OR ROM_ID = '' ORDER BY id LIMIT 20");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo sprintf("   ID: %-4d | Name: %-70s | ROM_ID: %s\n", $row['id'], substr($row['name'], 0, 70), $row['ROM_ID'] ?: '(null)');
    }

    echo "\n";

    // Chercher quelques images spécifiques en base
    $testImages = [
        'Aladdin',
        '5 in One FunPak',
        'Adventures of Batman _ Robin, The',
        'Aerial Assault'
    ];

    echo "🔍 RECHERCHE D'EXEMPLES D'IMAGES EN BASE:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n";
    
    foreach ($testImages as $test) {
        $stmt = $pdo->prepare("SELECT id, name, ROM_ID FROM game_gear_games WHERE name LIKE ? OR ROM_ID LIKE ? LIMIT 5");
        $searchTerm = '%' . $test . '%';
        $stmt->execute([$searchTerm, $searchTerm]);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        echo "\n🔎 Recherche: \"$test\"\n";
        if (count($results) > 0) {
            foreach ($results as $row) {
                echo sprintf("   ✓ ID: %-4d | Name: %-60s | ROM_ID: %s\n", 
                    $row['id'], 
                    substr($row['name'], 0, 60), 
                    $row['ROM_ID'] ?: '(null)'
                );
            }
        } else {
            echo "   ✗ Aucun résultat\n";
        }
    }

} catch (PDOException $e) {
    echo "❌ Erreur de connexion: " . $e->getMessage() . "\n";
    exit(1);
}
