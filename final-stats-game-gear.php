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
    echo "║                     RÉSULTAT FINAL - GAME GEAR                               ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    //ROM_ID
    $stmt = $pdo->query("SELECT DISTINCT ROM_ID FROM game_gear_games WHERE ROM_ID IS NOT NULL AND ROM_ID != ''");
    $romIds = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $romIds[] = $row['ROM_ID'];
    }

    // Total jeux
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM game_gear_games");
    $totalGames = $stmt->fetch(PDO::FETCH_ASSOC)['total'];

    // Images
    $imageDir = __DIR__ . '/public/images/taxonomy/gamegear';
    $images = glob($imageDir . '/*.{png,jpg,jpeg}', GLOB_BRACE);
    
    $imagesByBase = [];
    foreach ($images as $imagePath) {
        $filename = basename($imagePath);
        $baseId = preg_replace('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', '', $filename);
        
        if (!isset($imagesByBase[$baseId])) {
            $imagesByBase[$baseId] = [];
        }
        $imagesByBase[$baseId][] = $filename;
    }

    // Correspondances
    $matched = 0;
    $mismatched = 0;
    
    foreach ($imagesByBase as $imageId => $files) {
        if (in_array($imageId, $romIds)) {
            $matched++;
        } else {
            $mismatched++;
        }
    }

    $jeux_sans_images = $totalGames - $matched;

    echo "📊 STATISTIQUES FINALES:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    echo "   🎮 Total jeux en base: $totalGames\n";
    echo "   🖼️  Total fichiers images: " . count($images) . "\n";
    echo "   🎯 Identifiants uniques d'images: " . count($imagesByBase) . "\n\n";
    echo "   ✅ Correspondances parfaites: $matched / $totalGames\n";
    echo "   📈 Taux de correspondance: " . round(($matched / $totalGames) * 100, 1) . "%\n\n";
    echo "   ❌ Images sans entrée en base: $mismatched\n";
    echo "   📭 Jeux sans images: $jeux_sans_images\n\n";

    if ($matched >= ($totalGames * 0.9)) {
        echo "🎉 EXCELLENT! Taux ≥ 90%\n\n";
    } elseif ($matched >= ($totalGames * 0.75)) {
        echo "✅ BON! Taux ≥ 75%\n\n";
    } elseif ($matched >= ($totalGames * 0.60)) {
        echo "👍 CORRECT! Taux ≥ 60%\n\n";
    }

    if ($mismatched > 0) {
        echo "🔍 IMAGES RESTANTES SANS CORRESPONDANCE:\n\n";
        $missing = [];
        foreach ($imagesByBase as $imageId => $files) {
            if (!in_array($imageId, $romIds)) {
                $missing[$imageId] = $files;
            }
        }
        foreach ($missing as $imageId => $files) {
            echo "   • $imageId (" . count($files) . " fichiers)\n";
        }
    }

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
