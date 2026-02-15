<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== DIAGNOSTIC SHVC-YI ===\n\n";

$romId = 'SHVC-YI';

// 1. Vérifier si le jeu existe en base de données
echo "1️⃣ Recherche dans snes_games:\n";
$snesGame = DB::table('snes_games')->where('rom_id', 'like', $romId . '%')->first();
if ($snesGame) {
    echo "  ✅ Trouvé: {$snesGame->rom_id} - {$snesGame->name}\n";
} else {
    echo "  ❌ Pas trouvé dans snes_games\n";
}

// 2. Vérifier dans article_types
echo "\n2️⃣ Recherche dans article_types:\n";
$articleTypes = App\Models\ArticleType::where('name', 'like', "%{$romId}%")
    ->orWhere('rom_id', $romId)
    ->get();

if ($articleTypes->count() > 0) {
    foreach ($articleTypes as $type) {
        echo "  ✅ ID {$type->id}: {$type->name}\n";
        echo "     rom_id (champ): " . ($type->rom_id ?? 'null') . "\n";
        echo "     rom_id effectif: " . ($type->getEffectiveRomId() ?? 'null') . "\n";
    }
} else {
    echo "  ❌ Pas trouvé dans article_types\n";
}

// 3. Vérifier les fichiers sur R2
echo "\n3️⃣ Fichiers SHVC-YI sur R2 dans taxonomy/snes/:\n";
try {
    $r2Files = Storage::disk('r2')->files('taxonomy/snes');
    $matchingFiles = array_filter($r2Files, function($file) use ($romId) {
        return stripos(basename($file), $romId) === 0;
    });
    
    if (count($matchingFiles) > 0) {
        foreach ($matchingFiles as $file) {
            $basename = basename($file);
            echo "  ✅ {$basename}\n";
        }
    } else {
        echo "  ❌ Aucun fichier trouvé pour {$romId}\n";
        
        // Chercher des variations possibles
        echo "\n  🔍 Recherche de variations possibles:\n";
        $variations = ['SHVC-YI', 'SNS-YI', 'SHVC-YI-', 'SNS-YI-', 'yoshi'];
        
        foreach ($variations as $variation) {
            $matches = array_filter($r2Files, function($file) use ($variation) {
                return stripos(basename($file), $variation) !== false;
            });
            
            if (count($matches) > 0) {
                echo "    Variation '{$variation}':\n";
                foreach (array_slice($matches, 0, 5) as $file) {
                    echo "      - " . basename($file) . "\n";
                }
            }
        }
    }
} catch (Exception $e) {
    echo "  ❌ Erreur: " . $e->getMessage() . "\n";
}

// 4. Test de la fonction extractRomIdFromName
echo "\n4️⃣ Test d'extraction du ROM ID:\n";
$testNames = [
    "SHVC-YI - Yoshi's Island",
    "SHVC-YI-USA - Yoshi's Island",
    "SNS-YI - Yoshi's Island",
    "Yoshi's Island",
];

foreach ($testNames as $name) {
    preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $name, $matches);
    $extracted = isset($matches[1]) ? strtoupper($matches[1]) : null;
    echo "  '{$name}'\n";
    echo "    → ROM ID extrait: " . ($extracted ?? 'null') . "\n";
}

echo "\n=== FIN DU DIAGNOSTIC ===\n";
