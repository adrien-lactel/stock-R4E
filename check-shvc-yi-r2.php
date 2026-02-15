<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DIAGNOSTIC SHVC-YI sur R2 ===\n\n";

$romId = 'SHVC-YI';

// Vérifier les fichiers sur R2
echo "🔍 Recherche des fichiers SHVC-YI sur R2 dans taxonomy/snes/:\n\n";

try {
    $r2Files = Storage::disk('r2')->files('taxonomy/snes');
    
    echo "Total de fichiers dans taxonomy/snes/: " . count($r2Files) . "\n\n";
    
    // 1. Recherche exacte SHVC-YI
    echo "1️⃣ Fichiers commençant par 'SHVC-YI':\n";
    $exactMatches = array_filter($r2Files, function($file) use ($romId) {
        return stripos(basename($file), $romId) === 0;
    });
    
    if (count($exactMatches) > 0) {
        foreach ($exactMatches as $file) {
            $basename = basename($file);
            $url = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/snes/' . $basename;
            echo "  ✅ {$basename}\n";
            echo "     URL: {$url}\n";
        }
    } else {
        echo "  ❌ Aucun fichier trouvé\n";
    }
    
    // 2. Recherche variations (avec tiret)
    echo "\n2️⃣ Fichiers contenant 'SHVC-YI-' (avec région):\n";
    $dashMatches = array_filter($r2Files, function($file) {
        return stripos(basename($file), 'SHVC-YI-') !== false;
    });
    
    if (count($dashMatches) > 0) {
        foreach ($dashMatches as $file) {
            $basename = basename($file);
            echo "  ✅ {$basename}\n";
        }
    } else {
        echo "  ❌ Aucun fichier trouvé\n";
    }
    
    // 3. Recherche SNS-YI (version US)
    echo "\n3️⃣ Fichiers commençant par 'SNS-YI':\n";
    $snsMatches = array_filter($r2Files, function($file) {
        return stripos(basename($file), 'SNS-YI') === 0;
    });
    
    if (count($snsMatches) > 0) {
        foreach ($snsMatches as $file) {
            $basename = basename($file);
            echo "  ✅ {$basename}\n";
        }
    } else {
        echo "  ❌ Aucun fichier trouvé\n";
    }
    
    // 4. Recherche par nom (Yoshi)
    echo "\n4️⃣ Fichiers contenant 'yoshi' (insensible à la casse):\n";
    $yoshiMatches = array_filter($r2Files, function($file) {
        return stripos(basename($file), 'yoshi') !== false;
    });
    
    if (count($yoshiMatches) > 0) {
        echo "  Trouvé " . count($yoshiMatches) . " fichier(s):\n";
        foreach (array_slice($yoshiMatches, 0, 10) as $file) {
            $basename = basename($file);
            echo "    - {$basename}\n";
        }
        if (count($yoshiMatches) > 10) {
            echo "    ... et " . (count($yoshiMatches) - 10) . " autres\n";
        }
    } else {
        echo "  ❌ Aucun fichier trouvé\n";
    }
    
    // 5. Lister quelques fichiers SHVC pour référence
    echo "\n5️⃣ Exemples de fichiers SHVC sur R2 (pour comparaison):\n";
    $shvcFiles = array_filter($r2Files, function($file) {
        return stripos(basename($file), 'SHVC-') === 0;
    });
    
    foreach (array_slice($shvcFiles, 0, 20) as $file) {
        echo "  " . basename($file) . "\n";
    }
    
    if (count($shvcFiles) > 20) {
        echo "  ... Total SHVC: " . count($shvcFiles) . " fichiers\n";
    }
    
    // 6. Test des URLs possibles
    echo "\n6️⃣ Test d'accessibilité des URLs possibles:\n";
    $possibleFiles = [
        'SHVC-YI-cover.png',
        'SHVC-YI-logo.png',
        'SHVC-YI-artwork.png',
        'SHVC-YI-gameplay.png',
        'SNS-YI-USA-cover.png',
        'SNS-YI-cover.png',
    ];
    
    foreach ($possibleFiles as $filename) {
        $path = "taxonomy/snes/{$filename}";
        $exists = Storage::disk('r2')->exists($path);
        $url = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/snes/' . $filename;
        
        echo "  " . ($exists ? "✅" : "❌") . " {$filename}\n";
        if ($exists) {
            echo "     URL: {$url}\n";
        }
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}

echo "\n=== FIN DU DIAGNOSTIC ===\n";
