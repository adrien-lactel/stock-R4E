<?php
require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$count = App\Models\GameBoyGame::count();
echo "Total games scraped: {$count}\n";

if ($count > 0) {
    $sample = App\Models\GameBoyGame::where('rom_id', 'like', 'DMG%')->take(5)->get();
    echo "\nSample games:\n";
    foreach ($sample as $game) {
        echo "- {$game->rom_id}: {$game->name} ({$game->year})\n";
    }
}
