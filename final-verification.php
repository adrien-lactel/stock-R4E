<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Test final: vérification correspondance R2 ===" . PHP_EOL . PHP_EOL;

// Liste des jeux testés avec leurs URLs attendues
$tests = [
    [
        'platform' => 'Game Boy',
        'game_id' => 1106, // DMG-VUA
        'expected_file' => 'DMG-VUA-cover.png',
        'r2_folder' => 'gameboy'
    ],
    [
        'platform' => 'Game Gear',
        'game_id' => 903, // Sonic Blast
        'expected_file' => 'Sonic Blast (World)-cover.png',
        'r2_folder' => 'gamegear'
    ],
    [
        'platform' => 'SNES',
        'game_id' => null, // SHVC-MK
        'rom_id' => 'SHVC-MK',
        'expected_file' => 'SHVC-MK-cover.png',
        'r2_folder' => 'snes'
    ],
    [
        'platform' => 'N64',
        'game_id' => null, // NUS-NMFE
        'rom_id' => 'NUS-NMFE',
        'expected_file' => 'NUS-NMFE-cover.png',
        'r2_folder' => 'n64'
    ],
];

foreach ($tests as $test) {
    echo "=== {$test['platform']} ===" . PHP_EOL;
    
    // Charger le jeu
    if (isset($test['game_id'])) {
        $game = \App\Models\ArticleType::find($test['game_id']);
    } elseif (isset($test['rom_id'])) {
        $game = \App\Models\ArticleType::where('rom_id', $test['rom_id'])->first();
    }
    
    if (!$game) {
        echo "  ❌ Jeu non trouvé en base" . PHP_EOL;
    } else {
        echo "  Nom: {$game->name}" . PHP_EOL;
        echo "  URL générée: " . ($game->cover_image_url ?? 'NULL') . PHP_EOL;
    }
    
    // Vérifier l'existence sur R2
    $r2Path = "taxonomy/{$test['r2_folder']}/{$test['expected_file']}";
    $exists = \Storage::disk('r2')->exists($r2Path);
    
    echo "  Fichier R2: {$test['expected_file']}" . PHP_EOL;
    echo "  Existe: " . ($exists ? '✅ OUI' : '❌ NON') . PHP_EOL;
    echo PHP_EOL;
}

echo "=== Résumé ===" . PHP_EOL;
echo "✅ Logique implémentée:" . PHP_EOL;
echo "  1. ROM ID présent → utilise ROM ID (Game Boy, SNES, N64, etc.)" . PHP_EOL;
echo "  2. Format 'slug - nom' → extrait nom complet (Game Gear, etc.)" . PHP_EOL;
echo "  3. Nom simple → utilise nom tel quel" . PHP_EOL;
echo PHP_EOL;
echo "✅ Préfixes ROM ID supportés:" . PHP_EOL;
echo "  - Game Boy: DMG, CGB, AGB, AGS" . PHP_EOL;
echo "  - Nintendo: SNS, SHVC (SNES), NES, NUS (N64)" . PHP_EOL;
echo "  - Sega: GG (Game Gear), T-, MK-, MK (Mega Drive)" . PHP_EOL;
