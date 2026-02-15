<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== TEST AVEC UN JEU SNES QUI EXISTE ===\n\n";

// Prendre les 5 premiers jeux SHVC sur R2
echo "🔍 Recherche de jeux SNES avec images sur R2...\n\n";

try {
    $r2Files = Storage::disk('r2')->files('taxonomy/snes');
    
    // Extraire les ROM IDs uniques des fichiers cover
    $romIdsWithImages = [];
    foreach ($r2Files as $file) {
        $basename = basename($file);
        if (preg_match('/^(SHVC-[A-Z0-9]+)-cover\.png$/i', $basename, $matches)) {
            $romId = $matches[1];
            if (!in_array($romId, $romIdsWithImages)) {
                $romIdsWithImages[] = $romId;
            }
        }
    }
    
    echo "✅ Trouvé " . count($romIdsWithImages) . " ROMs SHVC avec cover sur R2\n\n";
    
    // Prendre les 5 premiers
    $testRomIds = array_slice($romIdsWithImages, 0, 5);
    
    echo "📋 ROMs pour test:\n";
    foreach ($testRomIds as $romId) {
        echo "  - {$romId}\n";
        
        // Vérifier quelles images existent
        $imageTypes = ['cover', 'logo', 'artwork', 'gameplay'];
        $found = [];
        
        foreach ($imageTypes as $type) {
            $path = "taxonomy/snes/{$romId}-{$type}.png";
            if (Storage::disk('r2')->exists($path)) {
                $found[] = $type;
            }
        }
        
        if (!empty($found)) {
            echo "    Images: " . implode(', ', $found) . "\n";
        }
    }
    
    echo "\n" . str_repeat('=', 60) . "\n";
    echo "📝 Code de test JavaScript:\n";
    echo str_repeat('=', 60) . "\n";
    echo "// Copier ce code dans la console de admin/articles/create\n\n";
    
    foreach ($testRomIds as $romId) {
        echo "// Test {$romId}\n";
        echo "const img{$romId} = new Image();\n";
        echo "img{$romId}.onload = () => console.log('✅ {$romId}-cover chargé');\n";
        echo "img{$romId}.onerror = () => console.log('❌ {$romId}-cover ERREUR');\n";
        echo "img{$romId}.src = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/snes/{$romId}-cover.png';\n\n";
    }
    
    echo "\n" . str_repeat('=', 60) . "\n";
    echo "🧪 Test extraction ROM ID depuis le nom:\n";
    echo str_repeat('=', 60) . "\n\n";
    
    // Créer des noms de jeux typiques
    foreach ($testRomIds as $romId) {
        $testName = "{$romId} - Test Game";
        
        // Simuler la fonction extractRomIdFromName
        preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $testName, $matches);
        $extracted = isset($matches[1]) ? strtoupper($matches[1]) : null;
        
        echo "Nom: \"{$testName}\"\n";
        echo "  → ROM ID extrait: " . ($extracted ?? 'null') . "\n";
        echo "  → Match attendu: {$romId}\n";
        echo "  → " . ($extracted === $romId ? "✅ OK" : "❌ ERREUR") . "\n\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
