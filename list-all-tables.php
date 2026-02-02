<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$tables = DB::select('SHOW TABLES');
$skip = ['migrations', 'password_reset_tokens', 'sessions', 'cache', 'cache_locks', 'jobs', 'job_batches', 'failed_jobs', 'personal_access_tokens'];

$gameTables = [];
$otherTables = [];

foreach ($tables as $table) {
    $name = array_values((array)$table)[0];
    
    if (in_array($name, $skip)) {
        continue;
    }
    
    if (str_contains($name, '_games')) {
        $gameTables[] = $name;
    } else {
        $otherTables[] = $name;
    }
}

echo "📊 Tables de jeux (déjà exportées):\n";
foreach ($gameTables as $table) {
    echo "   ✅ $table\n";
}

echo "\n📦 Autres tables à exporter:\n";
foreach ($otherTables as $table) {
    $count = DB::table($table)->count();
    echo "   - $table ($count lignes)\n";
}
