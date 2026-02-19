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
    echo "║         NETTOYAGE POUR 100% - GAME GEAR (JEUX SANS IMAGES)                  ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Récupérer tous les ROM_ID
    $stmt = $pdo->query("SELECT id, name, ROM_ID FROM game_gear_games WHERE ROM_ID IS NOT NULL ORDER BY ROM_ID");
    $allGames = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $allGames[$row['ROM_ID']] = $row;
    }

    // Scanner les images
    $imageDir = __DIR__ . '/public/images/taxonomy/gamegear';
    $images = glob($imageDir . '/*.{png,jpg,jpeg}', GLOB_BRACE);
    
    $imagesIds = [];
    foreach ($images as $imagePath) {
        $filename = basename($imagePath);
        $baseId = preg_replace('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', '', $filename);
        $imagesIds[$baseId] = true;
    }

    // Jeux sans images
    $gamesWithoutImages = [];
    foreach ($allGames as $romId => $game) {
        if (!isset($imagesIds[$romId])) {
            $gamesWithoutImages[] = $game;
        }
    }

    echo "📊 STATISTIQUES:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    echo "   Total jeux en base: " . count($allGames) . "\n";
    echo "   Jeux avec images: " . count($imagesIds) . "\n";
    echo "   Jeux SANS images: " . count($gamesWithoutImages) . "\n\n";

    if (count($gamesWithoutImages) > 0) {
        echo "🗑️  JEUX À SUPPRIMER (20 premiers):\n";
        echo "════════════════════════════════════════════════════════════════════════════════\n\n";
        
        foreach (array_slice($gamesWithoutImages, 0, 20) as $game) {
            echo sprintf("   ID %-4d | %s\n", $game['id'], $game['name']);
        }
        
        if (count($gamesWithoutImages) > 20) {
            echo "\n   ... et " . (count($gamesWithoutImages) - 20) . " autres\n";
        }

        echo "\n\n📝 GÉNÉRATION DU SCRIPT DE SUPPRESSION...\n\n";

        // Générer le SQL
        $sql = "-- ══════════════════════════════════════════════════════════════════════════════\n";
        $sql .= "-- SUPPRESSION JEUX SANS IMAGES - GAME GEAR\n";
        $sql .= "-- Pour atteindre 100% de correspondance\n";
        $sql .= "-- Total suppressions: " . count($gamesWithoutImages) . "\n";
        $sql .= "-- ══════════════════════════════════════════════════════════════════════════════\n\n";

        foreach ($gamesWithoutImages as $game) {
            $nameEscaped = str_replace("'", "''", $game['name']);
            $sql .= "DELETE FROM game_gear_games WHERE id = {$game['id']}; -- {$nameEscaped}\n";
        }

        file_put_contents('delete-game-gear-no-images.sql', $sql);

        echo "✅ Fichier SQL généré: delete-game-gear-no-images.sql\n";
        echo "📊 Total suppressions: " . count($gamesWithoutImages) . "\n\n";

        echo "⚠️  ATTENTION:\n";
        echo "   Cette opération va supprimer " . count($gamesWithoutImages) . " jeux de la base.\n";
        echo "   Après suppression: " . count($imagesIds) . " jeux = 100% de correspondance\n\n";

        echo "🚀 POUR EXÉCUTER:\n";
        echo "   php apply-delete-game-gear-no-images.php\n\n";
    } else {
        echo "✅ Aucun jeu sans image! Déjà à 100%.\n\n";
    }

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
