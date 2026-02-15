<?php

echo "=== IMPORT SNES_GAMES VERS RAILWAY ===\n\n";

echo "📋 OBTENIR LES CREDENTIALS RAILWAY:\n";
echo "1. Ouvrez https://railway.app\n";
echo "2. Sélectionnez votre projet Stock-R4E\n";
echo "3. Cliquez sur le service MySQL\n";
echo "4. Allez dans 'Variables'\n";
echo "5. Entrez les valeurs ci-dessous\n\n";

// Demander les credentials
echo "📝 Entrez les credentials Railway:\n\n";

function readInput($prompt) {
    echo $prompt . ": ";
    $handle = fopen("php://stdin", "r");
    $line = trim(fgets($handle));
    fclose($handle);
    return $line;
}

$railwayHost = readInput("MYSQLHOST (ex: autorack.proxy.rlwy.net)");
$railwayPort = readInput("MYSQLPORT (ex: 52972)");
$railwayDatabase = readInput("MYSQLDATABASE (ex: railway)");
$railwayUser = readInput("MYSQLUSER (ex: root)");
$railwayPassword = readInput("MYSQLPASSWORD");

echo "\n✅ Credentials enregistrées\n\n";

// Configuration base locale
$localDb = [
    'host' => '127.0.0.1',
    'port' => '3306',
    'database' => 'stock_r4e',
    'username' => 'root',
    'password' => ''
];

// Configuration Railway
$railwayDb = [
    'host' => $railwayHost,
    'port' => $railwayPort,
    'database' => $railwayDatabase,
    'username' => $railwayUser,
    'password' => $railwayPassword
];

try {
    // 1. Connexion locale
    echo "1️⃣ Connexion à la base locale...\n";
    $localPdo = new PDO(
        "mysql:host={$localDb['host']};port={$localDb['port']};dbname={$localDb['database']};charset=utf8mb4",
        $localDb['username'],
        $localDb['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "   ✅ Connecté\n\n";
    
    // 2. Vérifier la table
    echo "2️⃣ Vérification de la table snes_games...\n";
    $stmt = $localPdo->query("SHOW TABLES LIKE 'snes_games'");
    if ($stmt->rowCount() === 0) {
        throw new Exception("La table snes_games n'existe pas!");
    }
    
    $stmt = $localPdo->query("SELECT COUNT(*) as count FROM snes_games");
    $localCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "   📊 {$localCount} jeux SNES trouvés\n\n";
    
    // 3. Aperçu
    echo "3️⃣ Aperçu des données (10 premiers):\n";
    $stmt = $localPdo->query("SELECT id, rom_id, name FROM snes_games LIMIT 10");
    $samples = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($samples as $s) {
        $romId = empty($s['rom_id']) ? '[vide]' : $s['rom_id'];
        echo "   - ID {$s['id']}: rom_id={$romId}, name={$s['name']}\n";
    }
    echo "\n";
    
    // 4. Obtenir la structure
    echo "4️⃣ Récupération de la structure...\n";
    $stmt = $localPdo->query("SHOW CREATE TABLE snes_games");
    $createTable = $stmt->fetch(PDO::FETCH_ASSOC)['Create Table'];
    echo "   ✅ Structure récupérée\n\n";
    
    // 5. Connexion Railway
    echo "5️⃣ Connexion à Railway...\n";
    echo "   Host: {$railwayDb['host']}:{$railwayDb['port']}\n";
    $railwayPdo = new PDO(
        "mysql:host={$railwayDb['host']};port={$railwayDb['port']};dbname={$railwayDb['database']};charset=utf8mb4",
        $railwayDb['username'],
        $railwayDb['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 30,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ]
    );
    echo "   ✅ Connecté à Railway\n\n";
    
    // 6. Vérifier si la table existe
    echo "6️⃣ Vérification de la table sur Railway...\n";
    $stmt = $railwayPdo->query("SHOW TABLES LIKE 'snes_games'");
    if ($stmt->rowCount() > 0) {
        $stmt = $railwayPdo->query("SELECT COUNT(*) as count FROM snes_games");
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "   ⚠️ Table existe déjà avec {$count} enregistrements\n";
        echo "   🗑️ Suppression...\n";
        $railwayPdo->exec("DROP TABLE IF EXISTS snes_games");
        echo "   ✅ Table supprimée\n\n";
    } else {
        echo "   ℹ️ Table n'existe pas encore\n\n";
    }
    
    // 7. Créer la table
    echo "7️⃣ Création de la table sur Railway...\n";
    $railwayPdo->exec($createTable);
    echo "   ✅ Table créée\n\n";
    
    // 8. Export des données
    echo "8️⃣ Export des données locales...\n";
    $stmt = $localPdo->query("SELECT * FROM snes_games");
    $allGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "   📦 {$localCount} enregistrements à transférer\n\n";
    
    // 9. Import par batch
    echo "9️⃣ Import vers Railway...\n";
    $railwayPdo->exec("SET foreign_key_checks = 0");
    $railwayPdo->exec("SET unique_checks = 0");
    $railwayPdo->beginTransaction();
    
    $batchSize = 100;
    $totalBatches = ceil(count($allGames) / $batchSize);
    
    for ($i = 0; $i < count($allGames); $i += $batchSize) {
        $currentBatch = floor($i / $batchSize) + 1;
        $batch = array_slice($allGames, $i, $batchSize);
        
        $columns = array_keys($batch[0]);
        $placeholders = [];
        $values = [];
        
        foreach ($batch as $row) {
            $rowPlaceholders = [];
            foreach ($columns as $column) {
                $rowPlaceholders[] = '?';
                $values[] = $row[$column];
            }
            $placeholders[] = '(' . implode(',', $rowPlaceholders) . ')';
        }
        
        $sql = "INSERT INTO snes_games (" . implode(',', $columns) . ") VALUES " . implode(',', $placeholders);
        $stmt = $railwayPdo->prepare($sql);
        $stmt->execute($values);
        
        echo "   ⏳ Batch {$currentBatch}/{$totalBatches} (" . count($batch) . " jeux)\n";
    }
    
    $railwayPdo->commit();
    $railwayPdo->exec("SET foreign_key_checks = 1");
    $railwayPdo->exec("SET unique_checks = 1");
    
    echo "   ✅ Import terminé\n\n";
    
    // 10. Vérification
    echo "🔟 Vérification finale...\n";
    $stmt = $railwayPdo->query("SELECT COUNT(*) as count FROM snes_games");
    $railwayCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "   Local: {$localCount} jeux\n";
    echo "   Railway: {$railwayCount} jeux\n\n";
    
    if ($localCount === $railwayCount) {
        echo str_repeat('=', 70) . "\n";
        echo "✅ IMPORT RÉUSSI!\n";
        echo str_repeat('=', 70) . "\n\n";
        
        echo "📝 INFORMATIONS IMPORTANTES:\n";
        echo "  • Les jeux SNES sont maintenant sur Railway\n";
        echo "  • La colonne rom_id peut être vide (c'est normal)\n";
        echo "  • Le code JavaScript extractRomIdFromName() extrait le ROM ID du nom\n";
        echo "  • Les images seront trouvées automatiquement\n\n";
        
        echo "🧪 PROCHAINE ÉTAPE - VÉRIFIER SUR RAILWAY:\n";
        echo "  1. Testez dans https://web-production-f3333.up.railway.app/admin/articles/create\n";
        echo "  2. Recherchez un jeu SNES (ex: 'Super Mario')\n";
        echo "  3. Vérifiez que les images de taxonomie s'affichent\n\n";
    } else {
        echo "⚠️ Différence de nombre d'enregistrements!\n";
        echo "Vérifiez les logs ci-dessus pour plus de détails\n\n";
    }
    
} catch (Exception $e) {
    if (isset($railwayPdo) && $railwayPdo->inTransaction()) {
        $railwayPdo->rollBack();
    }
    echo "\n❌ ERREUR: " . $e->getMessage() . "\n\n";
    
    if (strpos($e->getMessage(), 'gone away') !== false) {
        echo "💡 Cette erreur indique que les credentials Railway sont invalides\n";
        echo "   Vérifiez que vous avez entré les bonnes valeurs depuis Railway Dashboard\n\n";
    }
    
    exit(1);
}
