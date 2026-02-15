<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== UPLOAD DES IMAGES SNES VERS R2 ===\n\n";

$localPath = public_path('images/taxonomy/snes');
$r2Folder = 'taxonomy/snes';

if (!file_exists($localPath)) {
    echo "❌ Le dossier local n'existe pas: {$localPath}\n";
    exit(1);
}

// 1. Lister les fichiers locaux
echo "📂 Scan du dossier local: {$localPath}\n\n";
$localFiles = glob($localPath . '/*.{png,jpg,jpeg,PNG,JPG,JPEG}', GLOB_BRACE);

if (empty($localFiles)) {
    echo "❌ Aucun fichier image trouvé en local\n";
    exit(1);
}

echo "✅ Trouvé " . count($localFiles) . " fichiers locaux\n\n";

// 2. Lister les fichiers existants sur R2
echo "☁️  Récupération de la liste des fichiers sur R2...\n";
try {
    $r2Files = Storage::disk('r2')->files($r2Folder);
    $r2Basenames = array_map('basename', $r2Files);
    echo "✅ " . count($r2Files) . " fichiers déjà sur R2\n\n";
} catch (Exception $e) {
    echo "❌ Erreur lors de la récupération des fichiers R2: " . $e->getMessage() . "\n";
    exit(1);
}

// 3. Identifier les fichiers à uploader
$toUpload = [];
$alreadyExists = [];

foreach ($localFiles as $localFile) {
    $basename = basename($localFile);
    
    if (in_array($basename, $r2Basenames)) {
        $alreadyExists[] = $basename;
    } else {
        $toUpload[] = $localFile;
    }
}

echo "📊 Résumé:\n";
echo "  - Fichiers locaux: " . count($localFiles) . "\n";
echo "  - Déjà sur R2: " . count($alreadyExists) . "\n";
echo "  - À uploader: " . count($toUpload) . "\n\n";

if (empty($toUpload)) {
    echo "✅ Tous les fichiers sont déjà sur R2!\n";
    exit(0);
}

// 4. Demander confirmation
echo "⚠️  Les fichiers suivants seront uploadés sur R2:\n\n";
foreach (array_slice($toUpload, 0, 10) as $file) {
    echo "  - " . basename($file) . " (" . round(filesize($file) / 1024, 2) . " KB)\n";
}

if (count($toUpload) > 10) {
    echo "  ... et " . (count($toUpload) - 10) . " autres\n";
}

echo "\n";
echo "Voulez-vous continuer? (y/n): ";
$handle = fopen("php://stdin", "r");
$line = trim(fgets($handle));
fclose($handle);

if (strtolower($line) !== 'y') {
    echo "\n❌ Upload annulé\n";
    exit(0);
}

// 5. Upload des fichiers
echo "\n🚀 Début de l'upload...\n\n";

$uploaded = 0;
$failed = 0;
$totalSize = 0;

foreach ($toUpload as $localFile) {
    $basename = basename($localFile);
    $r2Path = "{$r2Folder}/{$basename}";
    $fileSize = filesize($localFile);
    
    try {
        $fileContent = file_get_contents($localFile);
        
        Storage::disk('r2')->put($r2Path, $fileContent, [
            'visibility' => 'public',
            'CacheControl' => 'public, max-age=31536000',
        ]);
        
        echo "  ✅ {$basename} (" . round($fileSize / 1024, 2) . " KB)\n";
        $uploaded++;
        $totalSize += $fileSize;
        
    } catch (Exception $e) {
        echo "  ❌ {$basename} - Erreur: " . $e->getMessage() . "\n";
        $failed++;
    }
    
    // Pause pour éviter de surcharger R2
    if ($uploaded % 50 === 0) {
        echo "\n  ⏸️  Pause (50 fichiers uploadés)...\n\n";
        sleep(1);
    }
}

echo "\n";
echo "=== RÉSULTAT ===\n";
echo "✅ Uploadés: {$uploaded} fichiers (" . round($totalSize / 1024 / 1024, 2) . " MB)\n";
echo "❌ Échecs: {$failed} fichiers\n";

if ($uploaded > 0) {
    echo "\n🎉 Upload terminé avec succès!\n";
    echo "Les images sont maintenant disponibles sur R2.\n";
}
