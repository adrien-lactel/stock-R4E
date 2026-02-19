<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Structure de la table wonderswan_games:\n\n";

$columns = DB::select('DESCRIBE wonderswan_games');

foreach ($columns as $col) {
    echo "  • {$col->Field} ({$col->Type})";
    if ($col->Null === 'NO') echo " NOT NULL";
    if ($col->Default !== null) echo " DEFAULT '{$col->Default}'";
    if ($col->Extra) echo " {$col->Extra}";
    echo "\n";
}
