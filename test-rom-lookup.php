<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test ROM ID lookup
$testRomIds = ['DMG-APEE-0', 'DMG-MLA-1', 'DMG-ZLE-0'];

foreach ($testRomIds as $romId) {
    $game = App\Models\GameBoyGame::findByRomId($romId);
    if ($game) {
        echo "\n✅ {$romId}:\n";
        echo "   Name: {$game->name}\n";
        echo "   Year: {$game->year}\n";
        echo "   Image: {$game->image_url}\n";
        echo "   Price: {$game->price}\n";
        echo "   Source: {$game->source}\n";
    } else {
        echo "\n❌ {$romId}: Not found\n";
    }
}
