<?php

require 'vendor/autoload.php';
$app = require 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$type = \App\Models\ArticleType::find(905);

echo "ArticleType #905:\n";
echo "  rom_id: " . $type->rom_id . "\n";
echo "  cover_image_url: " . ($type->cover_image_url ?? 'null') . "\n";
echo "  screenshot1_url: " . ($type->screenshot1_url ?? 'null') . "\n";
echo "  screenshot2_url: " . ($type->screenshot2_url ?? 'null') . "\n";
echo "  logo_url: " . ($type->logo_url ?? 'null') . "\n";
