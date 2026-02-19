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

    // ROM_ID
    $stmt = $pdo->query("SELECT DISTINCT ROM_ID FROM game_gear_games WHERE ROM_ID IS NOT NULL AND ROM_ID != ''");
    $romIds = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $romIds[] = $row['ROM_ID'];
    }

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

    // Manquants
    $missing = [];
    foreach ($imagesByBase as $imageId => $files) {
        if (!in_array($imageId, $romIds)) {
            $missing[$imageId] = $files;
        }
    }

    echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
    echo "║           DERNIÈRE IMAGE MANQUANTE - GAME GEAR                               ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";
    echo "Total images manquantes: " . count($missing) . "\n\n";

    foreach ($missing as $imageId => $files) {
        echo "❌ $imageId\n";
        echo "   Fichiers: " . implode(', ', $files) . "\n\n";
        
        // Chercher correspondance proche
        $bestMatch = null;
        $bestSim = 0;
        foreach ($romIds as $romId) {
            similar_text(strtolower($imageId), strtolower($romId), $sim);
            if ($sim > $bestSim) {
                $bestSim = $sim;
                $bestMatch = $romId;
            }
        }
        
        if ($bestSim > 70) {
            echo "   🔍 ROM_ID proche (%.1f%%): $bestMatch\n\n";
        }
    }

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
