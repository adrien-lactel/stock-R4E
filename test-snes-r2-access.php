<?php

echo "=== TEST IMAGES SNES SUR R2 ===\n\n";

// ROM IDs à tester (mix simple et complexe)
$testRomIds = [
    'SHVC-23',          // Simple - Super Family Circuit
    'SHVC-A20J-JPN',    // Complexe - Bakumatsu Kourinden Oni
    'SHVC-A27J-JPN',    // Complexe - Super Famista 5
    'SFT-0112-JPN',     // Complexe - Sailor Moon SuperS
    'SHVC-26',          // Simple
    'SHVC-A2DJ-JPN',    // Complexe - Derby Jockey 2
];

$r2BaseUrl = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/snes';

echo "Vérification de l'accessibilité des images sur R2...\n\n";

$foundCount = 0;
$notFoundCount = 0;

foreach ($testRomIds as $romId) {
    echo "📦 Testing ROM ID: {$romId}\n";
    
    $types = ['cover', 'artwork', 'logo', 'gameplay'];
    $found = false;
    
    foreach ($types as $type) {
        $url = "{$r2BaseUrl}/{$romId}-{$type}.png";
        
        // Vérifier avec HEAD request
        $headers = @get_headers($url);
        $exists = $headers && strpos($headers[0], '200') !== false;
        
        if ($exists) {
            echo "   ✅ {$type}: {$url}\n";
            $found = true;
        }
    }
    
    if ($found) {
        $foundCount++;
    } else {
        echo "   ❌ Aucune image trouvée\n";
        $notFoundCount++;
    }
    
    echo "\n";
}

echo str_repeat('=', 80) . "\n";
echo "RÉSUMÉ\n";
echo str_repeat('=', 80) . "\n\n";

echo "ROM IDs testés: " . count($testRomIds) . "\n";
echo "✅ Avec images: {$foundCount}\n";
echo "❌ Sans images: {$notFoundCount}\n\n";

if ($foundCount === count($testRomIds)) {
    echo "🎉 SUCCÈS! Toutes les images de test sont accessibles sur R2!\n";
    echo "Le système devrait fonctionner correctement en production.\n\n";
} else {
    echo "⚠️ Quelques images ne sont pas trouvées.\n";
    echo "Cela peut être normal si ces ROM IDs n'ont pas d'images.\n\n";
}

echo "💡 PROCHAINE ÉTAPE:\n";
echo "   Testez sur production: https://web-production-f3333.up.railway.app/admin/articles/create\n";
echo "   Recherchez un des ROM IDs suivants:\n";
foreach (array_slice($testRomIds, 0, 3) as $romId) {
    echo "   - {$romId}\n";
}
