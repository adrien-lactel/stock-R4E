<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\ArticleType;

echo "=== WonderSwan Taxonomy Check ===" . PHP_EOL . PHP_EOL;

// Find all WonderSwan types
$types = ArticleType::where('name', 'LIKE', '%wonder%')->get();

if ($types->count() > 0) {
    foreach ($types as $type) {
        echo "ID: {$type->id}" . PHP_EOL;
        echo "Name: {$type->name}" . PHP_EOL;
        
        // Check folder name (lowercase name is usually used)
        $folderName = strtolower($type->name);
        echo "Likely folder: {$folderName}" . PHP_EOL;
        
        // Show all attributes
        echo "All attributes: " . json_encode($type->getAttributes()) . PHP_EOL . PHP_EOL;
    }
} else {
    echo "No WonderSwan types found!" . PHP_EOL;
}

// Also check wonderswan_games table
try {
    $gameCount = DB::table('wonderswan_games')->count();
    echo "WonderSwan games in database: {$gameCount}" . PHP_EOL;
    
    if ($gameCount > 0) {
        $sample = DB::table('wonderswan_games')->first();
        echo "Sample game: {$sample->name}" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "Error checking games: " . $e->getMessage() . PHP_EOL;
}
