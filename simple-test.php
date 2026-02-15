<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Test logique avec jeux réels ===" . PHP_EOL . PHP_EOL;

// Game Boy avec ROM ID
$gbGame = \App\Models\ArticleType::where('rom_id', 'DMG-VUA')->first();
if ($gbGame) {
    echo "Game Boy: {$gbGame->name}" . PHP_EOL;
    echo "  Platform folder: " . ($gbGame->getPlatformFolder() ?? 'NULL') . PHP_EOL;
    echo "  Cover URL: " . ($gbGame->cover_image_url ?? 'NULL') . PHP_EOL;
    echo PHP_EOL;
}

// Game Gear avec slug-nom
$ggGame = \App\Models\ArticleType::find(903);
if ($ggGame) {
    echo "Game Gear: {$ggGame->name}" . PHP_EOL;
    echo "  Platform folder: " . ($ggGame->getPlatformFolder() ?? 'NULL') . PHP_EOL;
    echo "  Cover URL: " . ($ggGame->cover_image_url ?? 'NULL') . PHP_EOL;
    echo PHP_EOL;
}

// SNES avec ROM ID
$snesGame = \App\Models\ArticleType::where('rom_id', 'SHVC-MK')->first();
if ($snesGame) {
    echo "SNES: {$snesGame->name}" . PHP_EOL;
    echo "  Platform folder: " . ($snesGame->getPlatformFolder() ?? 'NULL') . PHP_EOL;
    echo "  Cover URL: " . ($snesGame->cover_image_url ?? 'NULL') . PHP_EOL;
    echo PHP_EOL;
}

// N64 avec ROM ID
$n64Game = \App\Models\ArticleType::where('rom_id', 'NUS-NMFE')->first();
if ($n64Game) {
    echo "N64: {$n64Game->name}" . PHP_EOL;
    echo "  ROM ID: {$n64Game->rom_id}" . PHP_EOL;
    echo "  Platform folder: " . ($n64Game->getPlatformFolder() ?? 'NULL') . PHP_EOL;
    echo "  Cover URL: " . ($n64Game->cover_image_url ?? 'NULL') . PHP_EOL;
}

echo PHP_EOL . "✅ Test terminé" . PHP_EOL;
