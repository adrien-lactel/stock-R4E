<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Test complet de la logique actuelle ===" . PHP_EOL . PHP_EOL;

// Simuler la méthode getGameName() et getR2ImageUrl()
function testImageGeneration($articleType) {
    $romId = $articleType->rom_id;
    $name = $articleType->name;
    
    // Simuler getEffectiveRomId
    if (!$romId && preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9]+)\s*-/i', $name, $matches)) {
        $romId = strtoupper($matches[1]);
    }
    
    // Simuler getGameName
    $gameName = null;
    if (str_contains($name, ' - ')) {
        $parts = explode(' - ', $name, 2);
        $gameName = trim($parts[1]);
    }
    
    // Identifier final
    $identifier = $romId ?: ($gameName ?: $name);
    
    return [
        'original_name' => $name,
        'rom_id' => $articleType->rom_id,
        'effective_rom_id' => $romId,
        'game_name' => $gameName,
        'final_identifier' => $identifier
    ];
}

$testCases = [
    // Game Boy avec ROM ID
    ['id' => 1106, 'platform' => 'Game Boy'],
    // Game Gear avec slug-nom
    ['id' => 903, 'platform' => 'Game Gear'],
    // SNES avec ROM ID
    ['id' => null, 'platform' => 'SNES', 'search' => 'SHVC-MK'],
];

foreach ($testCases as $test) {
    $game = null;
    
    if (isset($test['id'])) {
        $game = \App\Models\ArticleType::find($test['id']);
    } elseif (isset($test['search'])) {
        $game = \App\Models\ArticleType::where('rom_id', $test['search'])->first();
    }
    
    if (!$game) {
        echo "❌ {$test['platform']}: Jeu non trouvé" . PHP_EOL . PHP_EOL;
        continue;
    }
    
    echo "=== {$test['platform']} ===" . PHP_EOL;
    $result = testImageGeneration($game);
    
    foreach ($result as $key => $value) {
        echo "  {$key}: " . ($value ?? 'NULL') . PHP_EOL;
    }
    
    echo PHP_EOL;
}

// Tester des cas edge
echo "=== Cas Edge Cases ===" . PHP_EOL . PHP_EOL;

$edgeCases = [
    'Anchorz Field (Japan)',
    'Black',
    'DMG-VUA - Dr. Mario',
    'sonic-blast-world - Sonic Blast (World)',
    'SHVC-MK - Super Mario Kart',
];

foreach ($edgeCases as $name) {
    $mockType = new \App\Models\ArticleType(['name' => $name, 'rom_id' => null]);
    $result = testImageGeneration($mockType);
    
    echo "Nom: {$name}" . PHP_EOL;
    echo "  → Identifier: {$result['final_identifier']}" . PHP_EOL;
    echo PHP_EOL;
}
