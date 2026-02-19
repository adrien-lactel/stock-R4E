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
    echo "║           VÉRIFICATION STRUCTURE - GAME GEAR (NAME vs ROM_ID)                ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Exemples de noms en base
    echo "📊 EXEMPLES DE NOMS EN BASE (30 premiers):\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    
    $stmt = $pdo->query("SELECT id, name, ROM_ID FROM game_gear_games ORDER BY id LIMIT 30");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo sprintf("ID %-4d | Name: %-70s | ROM_ID: %s\n", 
            $row['id'], 
            substr($row['name'], 0, 70),
            $row['ROM_ID']
        );
    }

    // Chercher des exemples d'Aladdin
    echo "\n\n🔍 EXEMPLES: Tous les Aladdin en base:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    
    $stmt = $pdo->query("SELECT id, name, ROM_ID FROM game_gear_games WHERE name LIKE '%Aladdin%' ORDER BY name");
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo sprintf("ID %-4d | Name: %-70s | ROM_ID: %s\n", 
            $row['id'], 
            substr($row['name'], 0, 70),
            $row['ROM_ID']
        );
    }

    // Images Aladdin
    echo "\n\n📁 IMAGES Aladdin dans le dossier:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    
    $imageDir = __DIR__ . '/public/images/taxonomy/gamegear';
    $images = glob($imageDir . '/Aladdin*.{png,jpg,jpeg}', GLOB_BRACE);
    
    foreach ($images as $image) {
        echo "   • " . basename($image) . "\n";
    }

    // Vérifier si les NAME incluent déjà les régions
    echo "\n\n🔍 ANALYSE: Les NAME incluent-ils les régions?\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM game_gear_games WHERE name LIKE '%(__)%'");
    $withRegion = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    $stmt = $pdo->query("SELECT COUNT(*) as total FROM game_gear_games");
    $total = $stmt->fetch(PDO::FETCH_ASSOC)['total'];
    
    echo "   Jeux avec région dans NAME (contient parenthèses): $withRegion / $total\n";
    echo "   Pourcentage: " . round(($withRegion / $total) * 100, 1) . "%\n\n";

    // Conclusion
    if ($withRegion > ($total * 0.8)) {
        echo "✅ CONCLUSION: Les NAME originaux INCLUENT les régions.\n";
        echo "   Les ROM_ID doivent être IDENTIQUES aux NAME (avec régions).\n\n";
    } else {
        echo "⚠️  CONCLUSION: Les NAME originaux N'INCLUENT PAS systématiquement les régions.\n\n";
    }

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
