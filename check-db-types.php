<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

$types = DB::table('article_types')->get();

echo "=== ARTICLE_TYPES TABLE ===\n\n";
foreach ($types as $type) {
    echo "ID: {$type->id}\n";
    echo "  name: {$type->name}\n";
    echo "  article_sub_category_id: " . ($type->article_sub_category_id ?? 'NULL') . "\n";
    echo "\n";
}
