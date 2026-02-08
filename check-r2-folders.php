<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\Storage;

echo "📦 Vérification des dossiers sur R2\n";
echo "====================================\n\n";

try {
    // Lister les dossiers dans taxonomy/
    $directories = Storage::disk('r2')->directories('taxonomy');
    
    echo "Dossiers trouvés sur R2:\n";
    foreach ($directories as $dir) {
        $folderName = basename($dir);
        $files = Storage::disk('r2')->files($dir);
        $count = count($files);
        
        echo "  📁 {$folderName}: {$count} fichiers\n";
    }
    
} catch (Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}
