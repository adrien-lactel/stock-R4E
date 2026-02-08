<?php
/**
 * Script pour uploader TOUTES les images de taxonomy vers R2
 * Scanne récursivement public/images/taxonomy/ et uploade tout
 * 
 * Usage: php upload-all-images-r2.php
 */

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Storage;

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "🚀 Upload de TOUTES les images taxonomy vers R2\n";
echo "================================================\n\n";

$taxonomyPath = public_path('images/taxonomy');

if (!is_dir($taxonomyPath)) {
    die("❌ Dossier taxonomy introuvable: {$taxonomyPath}\n");
}

$totalUploaded = 0;
$totalSkipped = 0;
$totalErrors = 0;

// Scanner récursivement tous les fichiers
$iterator = new RecursiveIteratorIterator(
    new RecursiveDirectoryIterator($taxonomyPath, RecursiveDirectoryIterator::SKIP_DOTS),
    RecursiveIteratorIterator::SELF_FIRST
);

$files = [];
foreach ($iterator as $file) {
    if ($file->isFile() && strtolower($file->getExtension()) === 'png') {
        $files[] = $file->getPathname();
    }
}

echo "📁 Fichiers PNG trouvés: " . count($files) . "\n\n";

foreach ($files as $localPath) {
    // Construire le chemin relatif pour R2
    $relativePath = str_replace($taxonomyPath . DIRECTORY_SEPARATOR, '', $localPath);
    $relativePath = str_replace('\\', '/', $relativePath); // Normaliser les slashes
    $r2Path = "taxonomy/{$relativePath}";
    
    // Extraire le nom de dossier pour l'affichage
    $folder = dirname($relativePath);
    $filename = basename($localPath);
    
    // Vérifier si déjà sur R2
    try {
        if (Storage::disk('r2')->exists($r2Path)) {
            $totalSkipped++;
            continue;
        }
    } catch (\Exception $e) {
        // Ignorer les erreurs de vérification, on uploade quand même
    }
    
    // Upload vers R2
    try {
        $contents = file_get_contents($localPath);
        Storage::disk('r2')->put($r2Path, $contents, 'public');
        
        echo "✅ {$folder}/{$filename}\n";
        $totalUploaded++;
        
        // Pause toutes les 50 images pour éviter rate limiting
        if ($totalUploaded % 50 === 0) {
            echo "   ⏸️  Pause (50 images uploadées)...\n";
            sleep(2);
        }
    } catch (\Exception $e) {
        echo "❌ {$folder}/{$filename}: {$e->getMessage()}\n";
        $totalErrors++;
    }
}

echo "\n✅ Terminé!\n";
echo "================================================\n";
echo "   Uploadées: {$totalUploaded}\n";
echo "   Ignorées (déjà sur R2): {$totalSkipped}\n";
echo "   Erreurs: {$totalErrors}\n";
