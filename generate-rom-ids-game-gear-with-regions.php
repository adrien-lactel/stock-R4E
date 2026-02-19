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
    echo "║         RÉGÉNÉRATION ROM_ID - GAME GEAR (ROM_ID = NAME)                     ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Récupérer tous les jeux
    $stmt = $pdo->query("SELECT id, name FROM game_gear_games ORDER BY id");
    $games = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo "📊 Jeux à traiter: " . count($games) . "\n\n";
    echo "⚙️  Génération du SQL...\n\n";

    // Générer le fichier SQL
    $sql = "-- ══════════════════════════════════════════════════════════════════════════════\n";
    $sql .= "-- RÉGÉNÉRATION ROM_ID - GAME GEAR\n";
    $sql .= "-- ROM_ID = NAME (conservation des versions régionales)\n";
    $sql .= "-- ══════════════════════════════════════════════════════════════════════════════\n\n";

    foreach ($games as $game) {
        $id = $game['id'];
        $name = $game['name'];
        $romId = $name; // ROM_ID = NAME exactement
        
        // Échapper les apostrophes pour SQL
        $romIdEscaped = str_replace("'", "''", $romId);
        
        $sql .= "UPDATE game_gear_games SET ROM_ID = '$romIdEscaped' WHERE id = $id; -- $name\n";
    }

    file_put_contents('regenerate-rom-ids-game-gear-with-regions.sql', $sql);

    echo "✅ Fichier généré: regenerate-rom-ids-game-gear-with-regions.sql\n";
    echo "📊 Total updates: " . count($games) . "\n\n";

    // Exemples
    echo "📋 EXEMPLES DE CHANGEMENTS:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    
    $examples = [
        ['id' => 17, 'name' => 'Aladdin (Japan) (En)'],
        ['id' => 22, 'name' => 'Aladdin (USA, Europe, Brazil) (En)'],
        ['id' => 23, 'name' => 'Aladdin (USA, Europe, Brazil)'],
        ['id' => 26, 'name' => 'Alien 3 (Japan) (En)'],
        ['id' => 27, 'name' => 'Alien 3 (USA, Europe)'],
    ];

    foreach ($examples as $ex) {
        echo "   ID {$ex['id']}: ROM_ID = '{$ex['name']}'\n";
    }

    echo "\n🚀 PROCHAINE ÉTAPE:\n";
    echo "   php apply-rom-ids-game-gear-with-regions.php\n\n";

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
