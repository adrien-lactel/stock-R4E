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
    echo "║             ANALYSE MISMATCH - IMAGES vs DATABASE                            ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Récupérer tous les ROM_ID de la base
    $stmt = $pdo->query("SELECT ROM_ID, name FROM game_gear_games ORDER BY ROM_ID");
    $dbGames = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $cleanId = preg_replace('/\s*\([^)]*\)\s*/', '', $row['ROM_ID']);
        $cleanId = trim($cleanId);
        $dbGames[$cleanId] = $row;
    }

    // Scanner les images
    $imageDir = __DIR__ . '/public/images/taxonomy/gamegear';
    $images = glob($imageDir . '/*.{png,jpg,jpeg}', GLOB_BRACE);
    
    $imageGames = [];
    foreach ($images as $image) {
        $basename = basename($image);
        
        // Extraire l'identifiant (enlever le type: cover, logo, artwork, etc.)
        $identifier = preg_replace('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', '', $basename);
        
        if (!isset($imageGames[$identifier])) {
            $imageGames[$identifier] = [];
        }
        $imageGames[$identifier][] = $basename;
    }

    // Trouver les correspondances et non-correspondances
    $matched = [];
    $notMatched = [];
    
    foreach ($imageGames as $imageId => $files) {
        // Enlever la région pour comparer
        $cleanImageId = preg_replace('/\s*\([^)]*\)\s*/', '', $imageId);
        $cleanImageId = trim($cleanImageId);
        
        if (isset($dbGames[$cleanImageId])) {
            $matched[$imageId] = [
                'image_id' => $imageId,
                'db_rom_id' => $dbGames[$cleanImageId]['ROM_ID'],
                'db_name' => $dbGames[$cleanImageId]['name'],
                'files' => $files
            ];
        } else {
            $notMatched[$imageId] = $files;
        }
    }

    echo "📊 STATISTIQUES:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    echo "   Jeux en base: " . count($dbGames) . "\n";
    echo "   Identifiants d'images: " . count($imageGames) . "\n";
    echo "   ✓ Correspondances: " . count($matched) . "\n";
    echo "   ✗ Images sans correspondance: " . count($notMatched) . "\n\n";

    // Afficher quelques exemples de non-correspondances
    echo "🔍 EXEMPLES DE NON-CORRESPONDANCES (15 premiers):\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    
    $count = 0;
    foreach ($notMatched as $imageId => $files) {
        if ($count >= 15) break;
        
        $cleanImageId = preg_replace('/\s*\([^)]*\)\s*/', '', $imageId);
        $cleanImageId = trim($cleanImageId);
        
        // Chercher une correspondance proche en DB
        $closeMatch = null;
        foreach ($dbGames as $dbId => $dbGame) {
            $similarity = 0;
            similar_text(strtolower($cleanImageId), strtolower($dbId), $similarity);
            if ($similarity > 85) {
                $closeMatch = $dbGame;
                break;
            }
        }
        
        echo "   ❌ Image: $imageId\n";
        echo "      Fichiers: " . count($files) . "\n";
        if ($closeMatch) {
            echo "      🔍 Correspondance proche en DB: {$closeMatch['ROM_ID']}\n";
            echo "      📝 Nom en DB: {$closeMatch['name']}\n";
        } else {
            echo "      ⚠️  Aucune correspondance proche trouvée\n";
        }
        echo "\n";
        $count++;
    }

    // Afficher quelques exemples de correspondances réussies
    echo "\n✅ EXEMPLES DE CORRESPONDANCES RÉUSSIES (10 premiers):\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    
    $count = 0;
    foreach ($matched as $match) {
        if ($count >= 10) break;
        
        echo "   ✓ Image: {$match['image_id']}\n";
        echo "     DB ROM_ID: {$match['db_rom_id']}\n";
        echo "     DB Name: {$match['db_name']}\n";
        echo "\n";
        $count++;
    }

} catch (PDOException $e) {
    echo "❌ Erreur de connexion: " . $e->getMessage() . "\n";
    exit(1);
}
