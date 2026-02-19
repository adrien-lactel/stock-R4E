<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔══════════════════════════════════════════════════════════════════╗\n";
echo "║         TEST: CORRESPONDANCE IMAGES AVEC NOUVELLE LOGIQUE        ║\n";
echo "╚══════════════════════════════════════════════════════════════════╝\n\n";

$testCases = [
    // Game Boy - ROM ID
    [
        'platform' => 'gameboy',
        'folder' => 'gameboy',
        'rom_id' => 'DMG-AFX',
        'name' => 'Tetris',
        'expected_identifier' => 'DMG-AFX',
        'expected_match' => 'ROM ID'
    ],
    // SNES - ROM ID
    [
        'platform' => 'snes',
        'folder' => 'snes',
        'rom_id' => 'SHVC-MW',
        'name' => 'Super Mario World',
        'expected_identifier' => 'SHVC-MW',
        'expected_match' => 'ROM ID'
    ],
    // WonderSwan - NOM
    [
        'platform' => 'wonderswan',
        'folder' => 'wonderswan',
        'rom_id' => null,
        'name' => 'Digimon Ver. WonderSwan (Hong Kong) (En)',
        'expected_identifier' => 'Digimon Ver. WonderSwan (Hong Kong) (En)',
        'expected_match' => 'NOM'
    ],
    // Game Gear - NOM
    [
        'platform' => 'gamegear',
        'folder' => 'gamegear',
        'rom_id' => null,
        'name' => 'Ariel The Little Mermaid (USA, Europe, Brazil) (En)',
        'expected_identifier' => 'Ariel The Little Mermaid (USA, Europe, Brazil) (En)',
        'expected_match' => 'NOM'
    ],
    // Mega Drive - NOM
    [
        'platform' => 'megadrive',
        'folder' => 'megadrive',
        'rom_id' => null,
        'name' => 'Castlevania Bloodlines USA',
        'expected_identifier' => 'Castlevania Bloodlines USA',
        'expected_match' => 'NOM'
    ],
];

foreach ($testCases as $index => $test) {
    echo str_repeat('─', 70) . "\n";
    echo "TEST " . ($index + 1) . ": {$test['platform']} - {$test['name']}\n";
    echo str_repeat('─', 70) . "\n";
    
    // Simuler l'appel à getTaxonomyImages
    $identifier = $test['rom_id'] ?: $test['name'];
    $folder = $test['folder'];
    
    echo "📝 Identifier utilisé: {$identifier}\n";
    echo "📁 Dossier: {$folder}\n";
    echo "🎯 Type attendu: {$test['expected_match']}\n\n";
    
    // Vérifier les fichiers
    $basePath = "public/images/taxonomy/{$folder}";
    
    if (!file_exists($basePath)) {
        echo "⚠️  Dossier inexistant: {$basePath}\n\n";
        continue;
    }
    
    $allFiles = glob("{$basePath}/*.png");
    $matchingFiles = [];
    
    // Plateformes utilisant le nom
    $nameBasedPlatforms = ['wonderswan', 'gamegear', 'megadrive', 'saturn'];
    $useNameMatching = in_array($test['platform'], $nameBasedPlatforms);
    
    if ($useNameMatching) {
        echo "🔍 Recherche par NOM (flexible)...\n";
        $normalizedIdentifier = strtolower(trim($identifier));
        
        foreach ($allFiles as $file) {
            $filename = basename($file);
            if (preg_match('/^(.+?)-(cover|logo|artwork|gameplay)\.png$/i', $filename, $matches)) {
                $gameName = $matches[1];
                $normalizedGameName = strtolower(trim($gameName));
                
                if (strpos($normalizedGameName, $normalizedIdentifier) !== false || 
                    strpos($normalizedIdentifier, $normalizedGameName) !== false) {
                    $matchingFiles[] = $filename;
                }
            }
        }
    } else {
        echo "🔍 Recherche par ROM ID (exact)...\n";
        $pattern = "{$basePath}/{$identifier}-*.png";
        $matchingFiles = array_map('basename', glob($pattern));
    }
    
    if (count($matchingFiles) > 0) {
        echo "✅ " . count($matchingFiles) . " fichier(s) trouvé(s):\n";
        foreach (array_slice($matchingFiles, 0, 5) as $file) {
            echo "   • {$file}\n";
        }
        if (count($matchingFiles) > 5) {
            echo "   ... et " . (count($matchingFiles) - 5) . " autre(s)\n";
        }
    } else {
        echo "❌ Aucun fichier trouvé\n";
        echo "   Fichiers disponibles dans {$folder} (5 premiers):\n";
        foreach (array_slice($allFiles, 0, 5) as $file) {
            echo "   • " . basename($file) . "\n";
        }
    }
    
    echo "\n";
}

echo str_repeat('═', 70) . "\n";
echo "✨ Tests terminés!\n\n";

echo "💡 RÉSUMÉ:\n";
echo "   • Game Boy, SNES, NES, N64: Recherche par ROM ID (pattern exact)\n";
echo "   • WonderSwan, GameGear, MegaDrive, Saturn: Recherche par nom (pattern flexible)\n";
echo "   • Le contrôleur PHP adapte automatiquement la stratégie selon le dossier\n\n";
