<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== TAXONOMIE ===\n\n";

$categories = \App\Models\ArticleCategory::with('subCategories.types')->get();

foreach ($categories as $cat) {
    echo "📁 {$cat->name} (ID: {$cat->id})\n";
    foreach ($cat->subCategories as $sub) {
        echo "  └─ {$sub->name} (ID: {$sub->id})\n";
        foreach ($sub->types as $type) {
            echo "      └─ {$type->name} (ID: {$type->id})\n";
        }
    }
    echo "\n";
}
