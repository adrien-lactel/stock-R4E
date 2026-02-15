<?php

echo "=== TEST CONNEXION RAILWAY ===\n\n";

$railwayDb = [
    'host' => 'autorack.proxy.rlwy.net',
    'port' => '52972',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'nUUEFrRvjBuIpUBrHhTmfNcafgikfNQB'
];

echo "Configuration:\n";
echo "  Host: {$railwayDb['host']}\n";
echo "  Port: {$railwayDb['port']}\n";
echo "  Database: {$railwayDb['database']}\n";
echo "  Username: {$railwayDb['username']}\n\n";

// Test 1: Connexion basique
echo "1️⃣ Test connexion basique...\n";
try {
    $pdo = new PDO(
        "mysql:host={$railwayDb['host']};port={$railwayDb['port']};dbname={$railwayDb['database']};charset=utf8mb4",
        $railwayDb['username'],
        $railwayDb['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 30
        ]
    );
    echo "   ✅ Connexion réussie!\n\n";
    
    // Test 2: Query simple
    echo "2️⃣ Test query simple...\n";
    $stmt = $pdo->query("SELECT VERSION() as version");
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "   MySQL Version: {$result['version']}\n\n";
    
    // Test 3: Lister les tables
    echo "3️⃣ Tables existantes:\n";
    $stmt = $pdo->query("SHOW TABLES");
    $tables = $stmt->fetchAll(PDO::FETCH_COLUMN);
    
    foreach ($tables as $table) {
        echo "   - {$table}\n";
    }
    echo "\n";
    
    // Test 4: Vérifier snes_games
    echo "4️⃣ Vérification table snes_games:\n";
    $stmt = $pdo->query("SHOW TABLES LIKE 'snes_games'");
    if ($stmt->rowCount() > 0) {
        echo "   ✅ Table snes_games existe\n";
        
        $stmt = $pdo->query("SELECT COUNT(*) as count FROM snes_games");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "   📊 Nombre d'enregistrements: {$count}\n";
        
        if ($count > 0) {
            echo "\n   Aperçu (5 premiers):\n";
            $stmt = $pdo->query("SELECT id, rom_id, name FROM snes_games LIMIT 5");
            $games = $stmt->fetchAll(PDO::FETCH_ASSOC);
            foreach ($games as $game) {
                echo "   - ID {$game['id']}: rom_id='{$game['rom_id']}', name='{$game['name']}'\n";
            }
        }
    } else {
        echo "   ℹ️ Table snes_games n'existe pas encore\n";
    }
    
    echo "\n✅ TOUS LES TESTS RÉUSSIS!\n";
    
} catch (Exception $e) {
    echo "   ❌ ERREUR: " . $e->getMessage() . "\n";
    echo "   Code: " . $e->getCode() . "\n";
    echo "\n";
    
    // Diagnostics supplémentaires
    echo "💡 DIAGNOSTICS:\n";
    
    if (strpos($e->getMessage(), 'gone away') !== false) {
        echo "   • 'MySQL server has gone away' peut indiquer:\n";
        echo "     - Credentials Railway expirés ou invalides\n";
        echo "     - Service Railway en maintenance\n";
        echo "     - Timeout de connexion trop court\n";
        echo "     - Problème réseau\n\n";
        echo "   Solutions:\n";
        echo "   1. Vérifier les credentials Railway dans .env\n";
        echo "   2. Vérifier l'état du service sur railway.app\n";
        echo "   3. Tester avec mysql CLI:\n";
        echo "      mysql -h {$railwayDb['host']} -P {$railwayDb['port']} -u {$railwayDb['username']} -p\n";
    } elseif (strpos($e->getMessage(), 'Access denied') !== false) {
        echo "   • Credentials incorrects\n";
        echo "   • Vérifier DB_HOST, DB_PORT, DB_USERNAME, DB_PASSWORD\n";
    } elseif (strpos($e->getMessage(), 'timeout') !== false) {
        echo "   • Timeout de connexion\n";
        echo "   • Le serveur Railway est peut-être lent ou inaccessible\n";
    }
    
    exit(1);
}
