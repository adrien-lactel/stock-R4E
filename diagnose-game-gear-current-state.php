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
    echo "║        DIAGNOSTIC - GAME GEAR (Images vs ROM_ID avec régions)               ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Récupérer tous les ROM_ID
    $stmt = $pdo->query("SELECT DISTINCT ROM_ID FROM game_gear_games WHERE ROM_ID IS NOT NULL AND ROM_ID != '' ORDER BY ROM_ID");
    $romIds = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $romIds[] = $row['ROM_ID'];
    }

    // Scanner les images
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

    echo "📊 ROM_ID en base: " . count($romIds) . "\n";
    echo "📊 Identifiants d'images: " . count($imagesByBase) . "\n\n";

    // Correspondances exactes
    $matched = 0;
    $mismatched = [];

    foreach ($imagesByBase as $imageId => $files) {
        if (in_array($imageId, $romIds)) {
            $matched++;
        } else {
            $mismatched[$imageId] = $files;
        }
    }

    echo "✅ Correspondances exactes: $matched\n";
    echo "❌ Non-correspondances: " . count($mismatched) . "\n\n";

    // Analyser les non-correspondances
    echo "🔍 EXEMPLES DE NON-CORRESPONDANCES (20 premiers):\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";

    $count = 0;
    foreach ($mismatched as $imageId => $files) {
        if ($count >= 20) break;
        
        // Chercher si un ROM_ID commence par cet ID image
        $possibleMatches = array_filter($romIds, function($romId) use ($imageId) {
            return stripos($romId, $imageId) === 0;
        });
        
        echo sprintf("%2d. Image: %s\n", $count + 1, $imageId);
        echo "    Fichiers: " . count($files) . "\n";
        
        if (count($possibleMatches) > 0) {
            echo "    🔍 ROM_ID possibles:\n";
            foreach (array_slice($possibleMatches, 0, 3) as $match) {
                echo "       • $match\n";
            }
        } else {
            echo "    ⚠️  Aucun ROM_ID correspondant trouvé\n";
        }
        echo "\n";
        
        $count++;
    }

    // Vérifier quelques exemples Aladdin
    echo "\n📋 EXEMPLES ALADDIN:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    
    echo "Images Aladdin:\n";
    foreach ($imagesByBase as $id => $files) {
        if (stripos($id, 'Aladdin') !== false) {
            echo "   • $id (" . count($files) . " fichiers)\n";
        }
    }
    
    echo "\nROM_ID Aladdin en base:\n";
    foreach ($romIds as $romId) {
        if (stripos($romId, 'Aladdin') !== false && stripos($romId, 'tr') === false) {
            echo "   • $romId\n";
        }
    }

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
