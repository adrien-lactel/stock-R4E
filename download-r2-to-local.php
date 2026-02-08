<?php
/**
 * Script pour télécharger TOUTES les images de R2 vers le dossier local
 * Sauvegarde complète de R2 → public/images/taxonomy/
 * 
 * Usage: php download-r2-to-local.php
 */

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Storage;

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "📥 Téléchargement des images R2 vers local\n";
echo "==========================================\n\n";

$localBasePath = public_path('images/taxonomy');
$totalDownloaded = 0;
$totalSkipped = 0;
$totalErrors = 0;

// Créer le dossier de base s'il n'existe pas
if (!is_dir($localBasePath)) {
    mkdir($localBasePath, 0755, true);
}

try {
    // Lister tous les dossiers dans taxonomy/
    $directories = Storage::disk('r2')->directories('taxonomy');
    
    echo "📁 Dossiers trouvés sur R2: " . count($directories) . "\n\n";
    
    foreach ($directories as $dir) {
        $folderName = basename($dir);
        echo "📦 Plateforme: {$folderName}\n";
        
        // Créer le dossier local
        $localFolderPath = "{$localBasePath}/{$folderName}";
        if (!is_dir($localFolderPath)) {
            mkdir($localFolderPath, 0755, true);
        }
        
        // Lister tous les fichiers dans ce dossier
        $files = Storage::disk('r2')->files($dir);
        echo "   Fichiers à télécharger: " . count($files) . "\n";
        
        $downloaded = 0;
        $skipped = 0;
        $errors = 0;
        
        foreach ($files as $r2FilePath) {
            $filename = basename($r2FilePath);
            $localFilePath = "{$localFolderPath}/{$filename}";
            
            // Si le fichier existe déjà en local, le sauter
            if (file_exists($localFilePath)) {
                $skipped++;
                continue;
            }
            
            try {
                // Télécharger depuis R2
                $contents = Storage::disk('r2')->get($r2FilePath);
                file_put_contents($localFilePath, $contents);
                
                $downloaded++;
                
                // Afficher progression toutes les 100 images
                if ($downloaded % 100 === 0) {
                    echo "   📥 {$downloaded} téléchargées...\n";
                }
                
            } catch (\Exception $e) {
                echo "   ❌ Erreur {$filename}: {$e->getMessage()}\n";
                $errors++;
            }
        }
        
        $totalDownloaded += $downloaded;
        $totalSkipped += $skipped;
        $totalErrors += $errors;
        
        echo "   ✅ Téléchargées: {$downloaded}, Ignorées: {$skipped}, Erreurs: {$errors}\n\n";
    }
    
    echo "✅ Sauvegarde terminée!\n";
    echo "================================================\n";
    echo "   Total téléchargées: {$totalDownloaded}\n";
    echo "   Total ignorées (déjà en local): {$totalSkipped}\n";
    echo "   Total erreurs: {$totalErrors}\n";
    
} catch (\Exception $e) {
    echo "❌ ERREUR FATALE:\n";
    echo $e->getMessage() . "\n";
}
