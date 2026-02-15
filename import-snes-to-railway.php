<?php

echo "=== EXPORT TABLE SNES_GAMES (LOCAL → RAILWAY) ===\n\n";

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
    'host' => 'autorack.proxy.rlwy.net',
    'port' => '52972',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'nUUEFrRvjBuIpUBrHhTmfNcafgikfNQB'
];

try {
    // 1. Connexion à la base locale
    echo "1️⃣ Connexion à la base locale...\n";
    $localPdo = new PDO(
        "mysql:host={$localDb['host']};port={$localDb['port']};dbname={$localDb['database']};charset=utf8mb4",
        $localDb['username'],
        $localDb['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "   ✅ Connecté à la base locale\n\n";
    
    // 2. Vérifier que la table existe
    echo "2️⃣ Vérification de la table snes_games...\n";
    $stmt = $localPdo->query("SHOW TABLES LIKE 'snes_games'");
    if ($stmt->rowCount() === 0) {
        throw new Exception("La table snes_games n'existe pas dans la base locale!");
    }
    echo "   ✅ Table snes_games trouvée\n\n";
    
    // 3. Obtenir la structure de la table
    echo "3️⃣ Récupération de la structure de la table...\n";
    $stmt = $localPdo->query("SHOW CREATE TABLE snes_games");
    $createTable = $stmt->fetch(PDO::FETCH_ASSOC)['Create Table'];
    echo "   ✅ Structure récupérée\n\n";
    
    // 4. Compter les enregistrements
    $stmt = $localPdo->query("SELECT COUNT(*) as count FROM snes_games");
    $localCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "   📊 Nombre d'enregistrements en local: {$localCount}\n\n";
    
    // 5. Afficher quelques exemples
    echo "4️⃣ Aperçu des données locales (5 premiers jeux):\n";
    $stmt = $localPdo->query("SELECT id, rom_id, name FROM snes_games LIMIT 5");
    $samples = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    foreach ($samples as $sample) {
        echo "   - ID {$sample['id']}: rom_id={$sample['rom_id']}, name={$sample['name']}\n";
    }
    echo "\n";
    
    // 6. Connexion à Railway
    echo "5️⃣ Connexion à Railway...\n";
    $railwayPdo = new PDO(
        "mysql:host={$railwayDb['host']};port={$railwayDb['port']};dbname={$railwayDb['database']};charset=utf8mb4",
        $railwayDb['username'],
        $railwayDb['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 30,
            PDO::ATTR_PERSISTENT => false,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4, wait_timeout=300, interactive_timeout=300"
        ]
    );
    echo "   ✅ Connecté à Railway\n\n";
    
    // 7. Vérifier si la table existe déjà sur Railway
    echo "6️⃣ Vérification de la table sur Railway...\n";
    $stmt = $railwayPdo->query("SHOW TABLES LIKE 'snes_games'");
    $tableExists = $stmt->rowCount() > 0;
    
    if ($tableExists) {
        $stmt = $railwayPdo->query("SELECT COUNT(*) as count FROM snes_games");
        $railwayCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "   ⚠️ La table existe déjà avec {$railwayCount} enregistrements\n";
        echo "   ⚠️ Elle sera supprimée et recréée\n\n";
        
        echo "7️⃣ Suppression de l'ancienne table...\n";
        $railwayPdo->exec("DROP TABLE IF EXISTS snes_games");
        echo "   ✅ Table supprimée\n\n";
    } else {
        echo "   ℹ️ La table n'existe pas encore sur Railway\n\n";
    }
    
    // 8. Créer la table sur Railway
    echo "8️⃣ Création de la table sur Railway...\n";
    $railwayPdo->exec($createTable);
    echo "   ✅ Table créée\n\n";
    
    // 9. Exporter les données
    echo "9️⃣ Export des données...\n";
    $stmt = $localPdo->query("SELECT * FROM snes_games");
    $allGames = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($allGames) === 0) {
        throw new Exception("Aucune donnée à exporter!");
    }
    
    echo "   📦 {$localCount} enregistrements à transférer\n";
    
    // 10. Importer les données par batch
    echo "\n🔟 Import des données sur Railway...\n";
    
    // Désactiver les vérifications pour accélérer l'import
    $railwayPdo->exec("SET foreign_key_checks = 0");
    $railwayPdo->exec("SET unique_checks = 0");
    $railwayPdo->exec("SET autocommit = 0");
    
    $batchSize = 100;
    $totalBatches = ceil(count($allGames) / $batchSize);
    $currentBatch = 0;
    
    for ($i = 0; $i < count($allGames); $i += $batchSize) {
        $currentBatch++;
        $batch = array_slice($allGames, $i, $batchSize);
        
        // Construire la requête INSERT
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
        
        echo "   ⏳ Batch {$currentBatch}/{$totalBatches} importé (" . count($batch) . " enregistrements)\r";
    }
    
    // Commit et réactiver les vérifications
    $railwayPdo->exec("COMMIT");
    $railwayPdo->exec("SET foreign_key_checks = 1");
    $railwayPdo->exec("SET unique_checks = 1");
    $railwayPdo->exec("SET autocommit = 1");
    
    echo "\n   ✅ Toutes les données importées\n\n";
    
    // 11. Vérification finale
    echo "1️⃣1️⃣ Vérification finale...\n";
    $stmt = $railwayPdo->query("SELECT COUNT(*) as count FROM snes_games");
    $finalCount = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "   📊 Enregistrements en local: {$localCount}\n";
    echo "   📊 Enregistrements sur Railway: {$finalCount}\n";
    
    if ($localCount === $finalCount) {
        echo "   ✅ Import réussi! Toutes les données sont synchronisées\n\n";
        
        // Afficher quelques exemples
        echo "1️⃣2️⃣ Aperçu des données sur Railway (5 premiers jeux):\n";
        $stmt = $railwayPdo->query("SELECT id, rom_id, name FROM snes_games LIMIT 5");
        $railwaySamples = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
        foreach ($railwaySamples as $sample) {
            echo "   - ID {$sample['id']}: rom_id={$sample['rom_id']}, name={$sample['name']}\n";
        }
        echo "\n";
    } else {
        echo "   ⚠️ Différence de nombre d'enregistrements!\n";
        echo "   ⚠️ Vérifiez les logs pour plus de détails\n\n";
    }
    
    echo str_repeat('=', 70) . "\n";
    echo "✅ IMPORT TERMINÉ AVEC SUCCÈS\n";
    echo str_repeat('=', 70) . "\n";
    
} catch (Exception $e) {
    echo "\n❌ ERREUR: " . $e->getMessage() . "\n";
    echo "   Trace: " . $e->getTraceAsString() . "\n";
    exit(1);
}
