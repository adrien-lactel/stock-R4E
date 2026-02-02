<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "📊 Publishers avec logos:\n\n";

$publishers = DB::table('publishers')
    ->whereNotNull('logo')
    ->limit(10)
    ->get(['id', 'name', 'logo']);

foreach ($publishers as $p) {
    echo "  {$p->name} -> {$p->logo}\n";
}

echo "\n🔍 Konami spécifiquement:\n";
$konami = DB::table('publishers')->where('name', 'Konami')->first();
if ($konami) {
    echo "  ID: {$konami->id}\n";
    echo "  Name: {$konami->name}\n";
    echo "  Logo: " . ($konami->logo ?? 'NULL') . "\n";
}
