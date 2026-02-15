# Script pour importer snes_games vers Railway
# Avec récupération des credentials depuis Railway

Write-Host "=== IMPORT SNES_GAMES VERS RAILWAY ===" -ForegroundColor Cyan
Write-Host ""

Write-Host "📋 ÉTAPES POUR OBTENIR LES CREDENTIALS RAILWAY:" -ForegroundColor Yellow
Write-Host ""
Write-Host "1. Ouvrez https://railway.app" -ForegroundColor White
Write-Host "2. Sélectionnez votre projet Stock-R4E" -ForegroundColor White
Write-Host "3. Cliquez sur le service MySQL" -ForegroundColor White
Write-Host "4. Allez dans l'onglet 'Variables'" -ForegroundColor White
Write-Host "5. Notez les valeurs de:" -ForegroundColor White
Write-Host "   - MYSQLHOST" -ForegroundColor Gray
Write-Host "   - MYSQLPORT" -ForegroundColor Gray
Write-Host "   - MYSQLDATABASE" -ForegroundColor Gray
Write-Host "   - MYSQLUSER" -ForegroundColor Gray
Write-Host "   - MYSQLPASSWORD" -ForegroundColor Gray
Write-Host ""

# Demander les credentials
Write-Host "📝 Entrez les credentials Railway:" -ForegroundColor Cyan
Write-Host ""

$MYSQL_HOST = Read-Host "MYSQLHOST (ex: autorack.proxy.rlwy.net)"
$MYSQL_PORT = Read-Host "MYSQLPORT (ex: 52972)"
$MYSQL_DATABASE = Read-Host "MYSQLDATABASE (ex: railway)"
$MYSQL_USER = Read-Host "MYSQLUSER (ex: root)"
$MYSQL_PASSWORD = Read-Host "MYSQLPASSWORD" -AsSecureString
$MYSQL_PASSWORD_PLAIN = [Runtime.InteropServices.Marshal]::PtrToStringAuto(
    [Runtime.InteropServices.Marshal]::SecureStringToBSTR($MYSQL_PASSWORD)
)

Write-Host ""
Write-Host "✅ Credentials enregistrées" -ForegroundColor Green
Write-Host ""

# Créer un fichier PHP temporaire avec les credentials
$phpScript = @"
<?php

echo "=== IMPORT SNES_GAMES VERS RAILWAY ===" . PHP_EOL . PHP_EOL;

// Configuration base locale
`$localDb = [
    'host' => '127.0.0.1',
    'port' => '3306',
    'database' => 'stock_r4e',
    'username' => 'root',
    'password' => ''
];

// Configuration Railway (depuis ligne de commande)
`$railwayDb = [
    'host' => '$MYSQL_HOST',
    'port' => '$MYSQL_PORT',
    'database' => '$MYSQL_DATABASE',
    'username' => '$MYSQL_USER',
    'password' => '$MYSQL_PASSWORD_PLAIN'
];

try {
    // 1. Connexion locale
    echo "1️⃣ Connexion à la base locale..." . PHP_EOL;
    `$localPdo = new PDO(
        "mysql:host={`$localDb['host']};port={`$localDb['port']};dbname={`$localDb['database']};charset=utf8mb4",
        `$localDb['username'],
        `$localDb['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
    echo "   ✅ Connecté" . PHP_EOL . PHP_EOL;
    
    // 2. Vérifier la table
    echo "2️⃣ Vérification de la table snes_games..." . PHP_EOL;
    `$stmt = `$localPdo->query("SHOW TABLES LIKE 'snes_games'");
    if (`$stmt->rowCount() === 0) {
        throw new Exception("La table snes_games n'existe pas!");
    }
    
    `$stmt = `$localPdo->query("SELECT COUNT(*) as count FROM snes_games");
    `$localCount = `$stmt->fetch(PDO::FETCH_ASSOC)['count'];
    echo "   📊 {`$localCount} jeux SNES trouvés en local" . PHP_EOL . PHP_EOL;
    
    // 3. Aperçu
    echo "3️⃣ Aperçu des données (5 premiers):" . PHP_EOL;
    `$stmt = `$localPdo->query("SELECT id, rom_id, name FROM snes_games LIMIT 5");
    `$samples = `$stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach (`$samples as `$s) {
        echo "   - {`$s['name']}" . PHP_EOL;
    }
    echo PHP_EOL;
    
    // 4. Obtenir la structure
    echo "4️⃣ Récupération de la structure..." . PHP_EOL;
    `$stmt = `$localPdo->query("SHOW CREATE TABLE snes_games");
    `$createTable = `$stmt->fetch(PDO::FETCH_ASSOC)['Create Table'];
    echo "   ✅ Structure récupérée" . PHP_EOL . PHP_EOL;
    
    // 5. Connexion Railway
    echo "5️⃣ Connexion à Railway..." . PHP_EOL;
    `$railwayPdo = new PDO(
        "mysql:host={`$railwayDb['host']};port={`$railwayDb['port']};dbname={`$railwayDb['database']};charset=utf8mb4",
        `$railwayDb['username'],
        `$railwayDb['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 30,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
        ]
    );
    echo "   ✅ Connecté à Railway" . PHP_EOL . PHP_EOL;
    
    // 6. Vérifier si la table existe
    echo "6️⃣ Vérification de la table sur Railway..." . PHP_EOL;
    `$stmt = `$railwayPdo->query("SHOW TABLES LIKE 'snes_games'");
    if (`$stmt->rowCount() > 0) {
        `$stmt = `$railwayPdo->query("SELECT COUNT(*) as count FROM snes_games");
        `$count = `$stmt->fetch(PDO::FETCH_ASSOC)['count'];
        echo "   ⚠️ Table existe déjà avec {`$count} enregistrements" . PHP_EOL;
        echo "   🗑️ Suppression..." . PHP_EOL;
        `$railwayPdo->exec("DROP TABLE IF EXISTS snes_games");
        echo "   ✅ Table supprimée" . PHP_EOL . PHP_EOL;
    }
    
    // 7. Créer la table
    echo "7️⃣ Création de la table sur Railway..." . PHP_EOL;
    `$railwayPdo->exec(`$createTable);
    echo "   ✅ Table créée" . PHP_EOL . PHP_EOL;
    
    // 8. Export des données
    echo "8️⃣ Export des données locales..." . PHP_EOL;
    `$stmt = `$localPdo->query("SELECT * FROM snes_games");
    `$allGames = `$stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "   📦 {`$localCount} enregistrements à transférer" . PHP_EOL . PHP_EOL;
    
    // 9. Import par batch
    echo "9️⃣ Import vers Railway..." . PHP_EOL;
    `$railwayPdo->exec("SET foreign_key_checks = 0");
    `$railwayPdo->exec("SET unique_checks = 0");
    `$railwayPdo->beginTransaction();
    
    `$batchSize = 100;
    `$totalBatches = ceil(count(`$allGames) / `$batchSize);
    
    for (`$i = 0; `$i < count(`$allGames); `$i += `$batchSize) {
        `$currentBatch = floor(`$i / `$batchSize) + 1;
        `$batch = array_slice(`$allGames, `$i, `$batchSize);
        
        `$columns = array_keys(`$batch[0]);
        `$placeholders = [];
        `$values = [];
        
        foreach (`$batch as `$row) {
            `$rowPlaceholders = [];
            foreach (`$columns as `$column) {
                `$rowPlaceholders[] = '?';
                `$values[] = `$row[`$column];
            }
            `$placeholders[] = '(' . implode(',', `$rowPlaceholders) . ')';
        }
        
        `$sql = "INSERT INTO snes_games (" . implode(',', `$columns) . ") VALUES " . implode(',', `$placeholders);
        `$stmt = `$railwayPdo->prepare(`$sql);
        `$stmt->execute(`$values);
        
        echo "   ⏳ Batch {`$currentBatch}/{`$totalBatches} (" . count(`$batch) . " jeux)" . PHP_EOL;
    }
    
    `$railwayPdo->commit();
    `$railwayPdo->exec("SET foreign_key_checks = 1");
    `$railwayPdo->exec("SET unique_checks = 1");
    
    echo "   ✅ Import terminé" . PHP_EOL . PHP_EOL;
    
    // 10. Vérification
    echo "🔟 Vérification finale..." . PHP_EOL;
    `$stmt = `$railwayPdo->query("SELECT COUNT(*) as count FROM snes_games");
    `$railwayCount = `$stmt->fetch(PDO::FETCH_ASSOC)['count'];
    
    echo "   Local: {`$localCount} jeux" . PHP_EOL;
    echo "   Railway: {`$railwayCount} jeux" . PHP_EOL . PHP_EOL;
    
    if (`$localCount === `$railwayCount) {
        echo str_repeat('=', 60) . PHP_EOL;
        echo "✅ IMPORT RÉUSSI!" . PHP_EOL;
        echo str_repeat('=', 60) . PHP_EOL;
        exit(0);
    } else {
        echo "⚠️ Différence de nombre d'enregistrements!" . PHP_EOL;
        exit(1);
    }
    
} catch (Exception `$e) {
    if (isset(`$railwayPdo)) {
        `$railwayPdo->rollBack();
    }
    echo PHP_EOL . "❌ ERREUR: " . `$e->getMessage() . PHP_EOL;
    exit(1);
}
"@

# Écrire le script PHP temporaire
$phpScript | Out-File -FilePath "import-snes-temp.php" -Encoding UTF8 -NoNewline

# Exécuter le script
Write-Host "🚀 Lancement de l'import..." -ForegroundColor Cyan
Write-Host ""

php import-snes-temp.php

$exitCode = $LASTEXITCODE

# Nettoyer le fichier temporaire
Remove-Item "import-snes-temp.php" -ErrorAction SilentlyContinue

Write-Host ""
if ($exitCode -eq 0) {
    Write-Host "✅ IMPORT TERMINÉ!" -ForegroundColor Green
    Write-Host ""
    Write-Host "📝 PROCHAINES ÉTAPES:" -ForegroundColor Yellow
    Write-Host "1. Les jeux SNES sont maintenant sur Railway" -ForegroundColor White
    Write-Host "2. La colonne rom_id est vide (c'est normal)" -ForegroundColor White
    Write-Host "3. Le code JavaScript extractRomIdFromName() gère l'extraction" -ForegroundColor White
    Write-Host "4. Testez sur https://web-production-f3333.up.railway.app/admin/articles/create" -ForegroundColor White
} else {
    Write-Host "❌ ERREUR DURANT L'IMPORT" -ForegroundColor Red
}

Write-Host ""
