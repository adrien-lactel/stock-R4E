<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DIAGNOSTIC IMAGES TAXONOMIE SNES ===\n\n";

try {
    // 1. Lister quelques fichiers SNES sur R2
    echo "📦 Fichiers sur R2 dans taxonomy/snes/ :\n";
    $r2Files = Storage::disk('r2')->files('taxonomy/snes');
    
    $sampleFiles = array_slice($r2Files, 0, 30);
    foreach ($sampleFiles as $file) {
        echo "  " . basename($file) . "\n";
    }
    echo "  ... Total: " . count($r2Files) . " fichiers\n\n";
    
    // 2. Analyser les patterns
    echo "🔍 Analyse des patterns de nommage:\n";
    $patterns = [
        'SHVC-' => 0,
        'SNS-' => 0,
        'autres' => 0
    ];
    
    foreach ($r2Files as $file) {
        $basename = basename($file);
        if (str_starts_with($basename, 'SHVC-')) {
            $patterns['SHVC-']++;
        } elseif (str_starts_with($basename, 'SNS-')) {
            $patterns['SNS-']++;
        } else {
            $patterns['autres']++;
        }
    }
    
    foreach ($patterns as $pattern => $count) {
        echo "  $pattern: $count fichiers\n";
    }
    
    // 3. Tester avec un ArticleType SNES spécifique
    echo "\n🎮 Test avec un ArticleType SNES:\n";
    $snesType = \App\Models\ArticleType::whereHas('subCategory', function($q) {
        $q->where('name', 'LIKE', '%SNES%')
          ->orWhere('name', 'LIKE', '%Super Nintendo%');
    })->first();
    
    if ($snesType) {
        echo "  ID: {$snesType->id}\n";
        echo "  Nom: {$snesType->name}\n";
        echo "  ROM ID (champ): " . ($snesType->rom_id ?? 'null') . "\n";
        echo "  ROM ID effectif: " . ($snesType->getEffectiveRomId() ?? 'null') . "\n";
        echo "  Platform folder: " . ($snesType->getPlatformFolder() ?? 'null') . "\n";
        echo "  Taxonomy folder: " . ($snesType->getTaxonomyFolder() ?? 'null') . "\n";
        echo "  Taxonomy slug: " . $snesType->getTaxonomySlug() . "\n";
        
        // Tester les URLs générées
        $romId = $snesType->getEffectiveRomId();
        if ($romId) {
            echo "\n  🔗 URLs générées:\n";
            echo "    - Cover (R2): " . ($snesType->cover_image_url ?? 'null') . "\n";
            echo "    - Logo: " . ($snesType->logo_url ?? 'null') . "\n";
            
            // Vérifier si les fichiers existent sur R2
            echo "\n  🔍 Vérification existence sur R2:\n";
            $platformFolder = $snesType->getPlatformFolder();
            $types = ['cover', 'artwork', 'gameplay', 'logo'];
            
            foreach ($types as $type) {
                $filename = "{$romId}-{$type}.png";
                $path = "taxonomy/{$platformFolder}/{$filename}";
                $exists = Storage::disk('r2')->exists($path);
                echo "    - {$filename}: " . ($exists ? '✅ EXISTE' : '❌ N\'EXISTE PAS') . "\n";
            }
        }
    } else {
        echo "  ❌ Aucun ArticleType SNES trouvé\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}

echo "\n=== FIN DU DIAGNOSTIC ===\n";
