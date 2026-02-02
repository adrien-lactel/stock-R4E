<?php

// Test direct de la connexion Railway
$host = 'mainline.proxy.rlwy.net';
$port = '22957';
$user = 'root';
$password = 'lTdgTHUScZteHZQXdVNbmQWsTSaHbxYv';
$database = 'railway';

echo "🔍 Vérification table publishers sur Railway\n\n";

try {
    $pdo = new PDO(
        "mysql:host=$host;port=$port;dbname=$database;charset=utf8mb4",
        $user,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    
    // Check if table exists
    $stmt = $pdo->query("SHOW TABLES LIKE 'publishers'");
    $exists = $stmt->fetch();
    
    if ($exists) {
        echo "✅ Table publishers existe\n";
        
        $count = $pdo->query("SELECT COUNT(*) FROM publishers")->fetchColumn();
        echo "📊 Nombre d'éditeurs: $count\n\n";
        
        // Test search
        $stmt = $pdo->prepare("SELECT name FROM publishers WHERE name LIKE ? LIMIT 5");
        $stmt->execute(['%konami%']);
        
        echo "🎮 Recherche 'konami':\n";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "  - {$row['name']}\n";
        }
    } else {
        echo "❌ Table publishers n'existe pas!\n";
        echo "Tables disponibles:\n";
        $stmt = $pdo->query("SHOW TABLES");
        while ($row = $stmt->fetch(PDO::FETCH_NUM)) {
            echo "  - {$row[0]}\n";
        }
    }
    
} catch (PDOException $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
}
