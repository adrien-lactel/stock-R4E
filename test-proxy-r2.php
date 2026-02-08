<?php
require 'vendor/autoload.php';

use Illuminate\Support\Facades\Http;

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$folder = "wonderswan color";
$filename = "Final Lap 2000 (Japan)-cover.png";

echo "Test proxy R2\n";
echo "=============\n\n";

// Test 1: URL sans encoding
$r2ImageUrlBad = "https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/{$folder}/{$filename}";
echo "❌ URL sans encoding:\n";
echo "   {$r2ImageUrlBad}\n";
try {
    $response = Http::timeout(5)->get($r2ImageUrlBad);
    echo "   Status: " . $response->status() . "\n\n";
} catch (Exception $e) {
    echo "   Erreur: " . $e->getMessage() . "\n\n";
}

// Test 2: URL avec encoding
$encodedFolder = rawurlencode($folder);
$encodedFilename = rawurlencode($filename);
$r2ImageUrlGood = "https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/{$encodedFolder}/{$encodedFilename}";
echo "✅ URL avec encoding:\n";
echo "   {$r2ImageUrlGood}\n";
try {
    $response = Http::timeout(5)->get($r2ImageUrlGood);
    echo "   Status: " . $response->status() . "\n";
    echo "   Size: " . strlen($response->body()) . " bytes\n";
} catch (Exception $e) {
    echo "   Erreur: " . $e->getMessage() . "\n";
}
