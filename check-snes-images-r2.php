<?php

echo "=== VÉRIFICATION IMAGES SNES SUR R2 ===\n\n";

// Configuration Railway
$railwayDb = [
    'host' => 'mainline.proxy.rlwy.net',
    'port' => '22957',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'lTdgTHUScZteHZQXdVNbmQWsTSaHbxYv'
];

// Configuration R2
$r2Config = [
    'access_key' => 'f125602086c04d1d6a889d772df5b06c',
    'secret_key' => '900052fc214a3cb3233b6fcbe9171692eca0734b8c45153addd751e5f18e123a',
    'bucket' => 'stock-r4e-taxonomy',
    'endpoint' => 'https://cd7a88507187155b85572a413ce5d288.r2.cloudflarestorage.com',
    'region' => 'auto'
];

try {
    // 1. Connexion Railway
    echo "1️⃣ Connexion à Railway...\n";
    $pdo = new PDO(
        "mysql:host={$railwayDb['host']};port={$railwayDb['port']};dbname={$railwayDb['database']};charset=utf8mb4",
        $railwayDb['username'],
        $railwayDb['password'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_TIMEOUT => 30
        ]
    );
    echo "   ✅ Connecté\n\n";
    
    // 2. Récupérer les ROM IDs SNES
    echo "2️⃣ Récupération des ROM IDs SNES...\n";
    $stmt = $pdo->query("
        SELECT rom_id, name 
        FROM snes_games 
        WHERE rom_id IS NOT NULL 
          AND rom_id != ''
        ORDER BY rom_id
    ");
    $snesRoms = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $totalRoms = count($snesRoms);
    echo "   📊 {$totalRoms} ROM IDs trouvés dans la base\n\n";
    
    // 3. Vérifier les images sur R2
    echo "3️⃣ Vérification des images sur R2...\n";
    echo "   (Connexion au bucket {$r2Config['bucket']})\n\n";
    
    require_once __DIR__ . '/vendor/autoload.php';
    
    $s3Client = new \Aws\S3\S3Client([
        'version' => 'latest',
        'region' => $r2Config['region'],
        'endpoint' => $r2Config['endpoint'],
        'credentials' => [
            'key' => $r2Config['access_key'],
            'secret' => $r2Config['secret_key']
        ],
        'use_path_style_endpoint' => false
    ]);
    
    // Lister tous les fichiers dans taxonomy/snes/
    echo "   🔍 Listage des fichiers dans taxonomy/snes/...\n";
    
    $objects = $s3Client->listObjectsV2([
        'Bucket' => $r2Config['bucket'],
        'Prefix' => 'taxonomy/snes/'
    ]);
    
    $r2Files = [];
    $imageTypes = ['cover' => 0, 'logo' => 0, 'artwork' => 0, 'gameplay' => 0];
    
    if (isset($objects['Contents'])) {
        foreach ($objects['Contents'] as $object) {
            $key = $object['Key'];
            $filename = basename($key);
            
            // Extraire le ROM ID du nom de fichier (ex: SHVC-23-cover.png)
            if (preg_match('/^([A-Z0-9\-]+)-(cover|logo|artwork|gameplay)\.png$/i', $filename, $matches)) {
                $romId = $matches[1];
                $type = strtolower($matches[2]);
                
                if (!isset($r2Files[$romId])) {
                    $r2Files[$romId] = [];
                }
                $r2Files[$romId][] = $type;
                $imageTypes[$type]++;
            }
        }
    }
    
    $romsWithImages = count($r2Files);
    echo "   ✅ {$romsWithImages} ROM IDs différents avec images sur R2\n\n";
    
    // 4. Statistiques par type d'image
    echo "4️⃣ Répartition par type d'image:\n";
    foreach ($imageTypes as $type => $count) {
        echo "   - {$type}: {$count} images\n";
    }
    echo "\n";
    
    // 5. Correspondance base de données ↔ R2
    echo "5️⃣ Correspondance base de données ↔ R2:\n\n";
    
    $matchingRoms = [];
    $missingImagesRoms = [];
    $extraImagesRoms = [];
    
    // Vérifier quels ROM IDs de la BDD ont des images
    foreach ($snesRoms as $rom) {
        $romId = $rom['rom_id'];
        if (isset($r2Files[$romId])) {
            $matchingRoms[] = [
                'rom_id' => $romId,
                'name' => $rom['name'],
                'images' => $r2Files[$romId]
            ];
        } else {
            $missingImagesRoms[] = [
                'rom_id' => $romId,
                'name' => $rom['name']
            ];
        }
    }
    
    // Vérifier quels ROM IDs sur R2 ne sont pas dans la BDD
    $dbRomIds = array_column($snesRoms, 'rom_id');
    foreach ($r2Files as $romId => $images) {
        if (!in_array($romId, $dbRomIds)) {
            $extraImagesRoms[] = [
                'rom_id' => $romId,
                'images' => $images
            ];
        }
    }
    
    $matchingCount = count($matchingRoms);
    $missingCount = count($missingImagesRoms);
    $extraCount = count($extraImagesRoms);
    
    echo "   ✅ Avec images: {$matchingCount} ROM IDs (" . round(($matchingCount/$totalRoms)*100, 2) . "%)\n";
    echo "   ❌ Sans images: {$missingCount} ROM IDs (" . round(($missingCount/$totalRoms)*100, 2) . "%)\n";
    echo "   🔵 Images sans ROM ID en BDD: {$extraCount}\n\n";
    
    // 6. Exemples
    echo "6️⃣ Exemples de ROM IDs AVEC images (10 premiers):\n";
    $examples = array_slice($matchingRoms, 0, 10);
    foreach ($examples as $rom) {
        $imageList = implode(', ', $rom['images']);
        echo "   ✅ {$rom['rom_id']}: {$rom['name']}\n";
        echo "      → Images: {$imageList}\n";
    }
    echo "\n";
    
    echo "7️⃣ Exemples de ROM IDs SANS images (10 premiers):\n";
    $examplesMissing = array_slice($missingImagesRoms, 0, 10);
    foreach ($examplesMissing as $rom) {
        echo "   ❌ {$rom['rom_id']}: {$rom['name']}\n";
    }
    echo "\n";
    
    // 7. Résumé final
    echo str_repeat('=', 70) . "\n";
    echo "📊 RÉSUMÉ FINAL\n";
    echo str_repeat('=', 70) . "\n\n";
    
    echo "Base de données Railway:\n";
    echo "  • Total ROM IDs SNES: {$totalRoms}\n";
    echo "  • ROM IDs avec images sur R2: {$matchingCount} (" . round(($matchingCount/$totalRoms)*100, 2) . "%)\n";
    echo "  • ROM IDs sans images sur R2: {$missingCount} (" . round(($missingCount/$totalRoms)*100, 2) . "%)\n\n";
    
    echo "Cloudflare R2:\n";
    echo "  • ROM IDs uniques avec images: {$romsWithImages}\n";
    echo "  • Total d'images SNES:\n";
    foreach ($imageTypes as $type => $count) {
        echo "    - {$type}: {$count}\n";
    }
    echo "  • Images sans correspondance en BDD: {$extraCount}\n\n";
    
    echo "💡 CONCLUSION:\n";
    if ($matchingCount > 0) {
        echo "  ✅ {$matchingCount} jeux SNES ont leurs images et sont prêts pour la taxonomie!\n";
        echo "  📸 Ces jeux afficheront correctement leurs miniatures et images\n\n";
    }
    
    if ($missingCount > 0) {
        echo "  ⚠️ {$missingCount} jeux n'ont pas encore d'images sur R2\n";
        echo "  → Ces jeux n'afficheront pas de miniatures dans l'autocomplétion\n\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
    exit(1);
}
