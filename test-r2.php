<?php
require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Configuration R2:\n";
echo "Bucket: " . config('filesystems.disks.r2.bucket') . "\n";
echo "Endpoint: " . config('filesystems.disks.r2.endpoint') . "\n";
echo "URL: " . config('filesystems.disks.r2.url') . "\n\n";

echo "Test d'un simple fichier de test...\n";
try {
    Storage::disk('r2')->put('test/hello.txt', 'Hello World!', 'public');
    echo "✅ Upload test réussi!\n";
    Storage::disk('r2')->delete('test/hello.txt');
    echo "✅ Delete test réussi!\n";
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
