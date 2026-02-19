<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

$sample = DB::table('game_gear_games')->first();

echo "Colonnes disponibles:\n";
echo "====================\n";
foreach ($sample as $key => $value) {
    echo "- $key: " . (is_null($value) ? 'NULL' : substr($value, 0, 50)) . "\n";
}
