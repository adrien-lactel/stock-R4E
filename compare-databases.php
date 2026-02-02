<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🔍 Comparaison des bases de données\n\n";

// Connexion locale
config(['database.default' => 'mysql']);
$localTables = DB::select('SHOW TABLES');
$localTableNames = array_map(function($table) {
    return array_values((array)$table)[0];
}, $localTables);

echo "📊 Tables locales (" . count($localTableNames) . "):\n";
sort($localTableNames);
foreach ($localTableNames as $table) {
    $count = DB::table($table)->count();
    echo "   - $table ($count lignes)\n";
}

echo "\n";
