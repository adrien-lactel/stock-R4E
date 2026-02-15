<?php

echo "=== VÉRIFICATION ROM ID: SHVC-ADFJ-JPN ===\n\n";

$romId = 'SHVC-ADFJ-JPN';
$localImagePath = 'C:/laragon/www/stock-R4E/public/images/taxonomy/snes';
$r2BaseUrl = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/snes';

$railwayDb = [
    'host' => 'mainline.proxy.rlwy.net',
    'port' => '22957',
    'database' => 'railway',
    'username' => 'root',
    'password' => 'lTdgTHUScZteHZQXdVNbmQWsTSaHbxYv'
];

// 1. Vérifier dans la base de données
echo "1️⃣ VÉRIFICATION EN BASE DE DONNÉES\n";
echo str_repeat('=', 80) . "\n";

try {
    $pdo = new PDO(
        "mysql:host={$railwayDb['host']};port={$railwayDb['port']};dbname={$railwayDb['database']};charset=utf8mb4",
        $railwayDb['username'],
        $railwayDb['password'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_TIMEOUT => 30]
    );
    
    $stmt = $pdo->prepare("SELECT * FROM snes_games WHERE rom_id = ?");
    $stmt->execute([$romId]);
    $game = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if ($game) {
        echo "✅ ROM ID trouvé en base de données!\n\n";
        echo "Détails:\n";
        foreach ($game as $key => $value) {
            if ($value !== null) {
                echo "  • {$key}: {$value}\n";
            }
        }
        echo "\n";
    } else {
        echo "❌ ROM ID NON TROUVÉ en base de données\n\n";
        
        // Rechercher des variantes
        echo "Recherche de variantes...\n";
        $variants = [
            'SHVC-ADFJ',
            'SHVC-ADF',
            'ADFJ-JPN',
        ];
        
        foreach ($variants as $variant) {
            $stmt = $pdo->prepare("SELECT rom_id, name FROM snes_games WHERE rom_id LIKE ?");
            $stmt->execute(['%' . $variant . '%']);
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if (count($results) > 0) {
                echo "  Variantes trouvées avec '{$variant}':\n";
                foreach ($results as $r) {
                    echo "    • {$r['rom_id']}: {$r['name']}\n";
                }
            }
        }
        echo "\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERREUR DATABASE: " . $e->getMessage() . "\n\n";
}

// 2. Vérifier les images locales
echo "2️⃣ VÉRIFICATION IMAGES LOCALES\n";
echo str_repeat('=', 80) . "\n";

$types = ['cover', 'artwork', 'logo', 'gameplay'];
$localFound = [];

foreach ($types as $type) {
    $filename = "{$romId}-{$type}.png";
    $fullPath = "{$localImagePath}/{$filename}";
    
    if (file_exists($fullPath)) {
        $size = filesize($fullPath);
        $sizeKb = round($size / 1024, 2);
        echo "✅ {$type}: {$filename} ({$sizeKb} KB)\n";
        $localFound[] = $type;
    }
}

if (empty($localFound)) {
    echo "❌ Aucune image locale trouvée pour {$romId}\n\n";
    
    // Chercher des variantes dans les fichiers
    echo "Recherche de fichiers similaires...\n";
    $pattern = "{$localImagePath}/*ADF*.png";
    $matches = glob($pattern);
    
    if (count($matches) > 0) {
        echo "Fichiers trouvés avec 'ADF':\n";
        foreach (array_slice($matches, 0, 10) as $match) {
            echo "  • " . basename($match) . "\n";
        }
    } else {
        echo "  Aucun fichier similaire trouvé\n";
    }
} else {
    echo "\nTypes trouvés localement: " . implode(', ', $localFound) . "\n";
}

echo "\n";

// 3. Vérifier sur R2
echo "3️⃣ VÉRIFICATION IMAGES R2\n";
echo str_repeat('=', 80) . "\n";

$r2Found = [];

foreach ($types as $type) {
    $url = "{$r2BaseUrl}/{$romId}-{$type}.png";
    
    // Test avec HEAD request
    $headers = @get_headers($url, 1);
    $exists = $headers && strpos($headers[0], '200') !== false;
    
    if ($exists) {
        $contentLength = isset($headers['Content-Length']) ? $headers['Content-Length'] : 'unknown';
        $sizeKb = is_numeric($contentLength) ? round($contentLength / 1024, 2) . ' KB' : 'unknown';
        echo "✅ {$type}: {$url} ({$sizeKb})\n";
        $r2Found[] = $type;
    }
}

if (empty($r2Found)) {
    echo "❌ Aucune image R2 trouvée pour {$romId}\n";
} else {
    echo "\nTypes trouvés sur R2: " . implode(', ', $r2Found) . "\n";
}

echo "\n";

// 4. Résumé et diagnostic
echo str_repeat('=', 80) . "\n";
echo "📊 DIAGNOSTIC\n";
echo str_repeat('=', 80) . "\n\n";

$inDatabase = isset($game);
$hasLocalImages = !empty($localFound);
$hasR2Images = !empty($r2Found);

echo "ROM ID: {$romId}\n";
echo "  • En base de données: " . ($inDatabase ? '✅ OUI' : '❌ NON') . "\n";
echo "  • Images locales: " . ($hasLocalImages ? '✅ OUI (' . implode(', ', $localFound) . ')' : '❌ NON') . "\n";
echo "  • Images R2: " . ($hasR2Images ? '✅ OUI (' . implode(', ', $r2Found) . ')' : '❌ NON') . "\n\n";

// Diagnostic du problème
echo "💡 DIAGNOSTIC DU PROBLÈME:\n\n";

if (!$inDatabase) {
    echo "❌ PROBLÈME: ROM ID absent de la base de données\n";
    echo "   → Le jeu ne peut pas être trouvé par l'autocomplete\n";
    echo "   → Solution: Ajouter ce ROM ID à la table snes_games\n\n";
} elseif (!$hasR2Images) {
    echo "❌ PROBLÈME: Images non présentes sur R2\n";
    echo "   → En production, le système cherche sur R2\n";
    
    if ($hasLocalImages) {
        echo "   → Images présentes localement, besoin de sync vers R2\n";
        echo "   → Solution: Upload les images locales vers R2\n\n";
    } else {
        echo "   → Images absentes localement aussi\n";
        echo "   → Solution: Obtenir/créer les images puis upload vers R2\n\n";
    }
} else {
    echo "✅ Tout semble OK!\n";
    echo "   → ROM ID en base: OUI\n";
    echo "   → Images sur R2: OUI\n";
    echo "   → Le problème peut être:\n";
    echo "      - Cache du navigateur\n";
    echo "      - Erreur JavaScript dans la console\n";
    echo "      - Mauvais mapping du ROM ID\n\n";
}

// URLs de test
echo "🔗 URLs À TESTER:\n\n";
foreach ($r2Found as $type) {
    echo "  {$r2BaseUrl}/{$romId}-{$type}.png\n";
}
