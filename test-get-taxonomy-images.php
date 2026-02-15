<?php

echo "=== TEST getTaxonomyImages POUR SHVC-ADFJ-JPN ===\n\n";

// Simuler la requête
$identifier = 'SHVC-ADFJ-JPN';
$folder = 'snes';

echo "Paramètres:\n";
echo "  • identifier: {$identifier}\n";
echo "  • folder: {$folder}\n\n";

// Tester avec AWS SDK (comme Laravel Storage)
require 'vendor/autoload.php';

use Aws\S3\S3Client;
use Aws\Exception\AwsException;

echo "1️⃣ CONFIGURATION R2\n";
echo str_repeat('=', 80) . "\n";

$r2Config = [
    'version' => 'latest',
    'region' => 'auto',
    'endpoint' => 'https://cd7a88507187155b85572a413ce5d288.r2.cloudflarestorage.com',
    'credentials' => [
        'key' => 'f125602086c04d1d6a889d772df5b06c',
        'secret' => '900052fc214a3cb3233b6fcbe9171692eca0734b8c45153addd751e5f18e123a',
    ],
    'use_path_style_endpoint' => false,
    'http' => [
        'verify' => false
    ]
];

try {
    $s3 = new S3Client($r2Config);
    echo "✅ Client R2 initialisé\n\n";
    
    // 2. Lister les fichiers du dossier
    echo "2️⃣ LISTING DU DOSSIER taxonomy/{$folder}/\n";
    echo str_repeat('=', 80) . "\n";
    
    $result = $s3->listObjectsV2([
        'Bucket' => 'stock-r4e-taxonomy',
        'Prefix' => "taxonomy/{$folder}/",
        'MaxKeys' => 1000
    ]);
    
    $allFiles = [];
    if (isset($result['Contents'])) {
        foreach ($result['Contents'] as $object) {
            $allFiles[] = $object['Key'];
        }
    }
    
    echo "Nombre total de fichiers dans taxonomy/{$folder}/: " . count($allFiles) . "\n\n";
    
    // 3. Filtrer pour l'identifiant
    echo "3️⃣ FILTRAGE POUR {$identifier}\n";
    echo str_repeat('=', 80) . "\n";
    
    $matchingFiles = [];
    foreach ($allFiles as $filePath) {
        $filename = basename($filePath);
        
        if (preg_match('/^' . preg_quote($identifier, '/') . '-(.+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
            $fullType = $matches[1];
            $extension = $matches[2];
            
            $matchingFiles[] = [
                'filename' => $filename,
                'path' => $filePath,
                'full_type' => $fullType,
                'extension' => $extension
            ];
            
            echo "✅ Trouvé: {$filename} (type: {$fullType})\n";
        }
    }
    
    echo "\nNombre de fichiers correspondants: " . count($matchingFiles) . "\n\n";
    
    if (count($matchingFiles) > 0) {
        echo "4️⃣ URLs PUBLIQUES\n";
        echo str_repeat('=', 80) . "\n";
        
        $publicUrl = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev';
        
        foreach ($matchingFiles as $file) {
            $url = "{$publicUrl}/{$file['path']}";
            echo "  • {$file['filename']}\n";
            echo "    {$url}\n\n";
        }
    } else {
        echo "❌ PROBLÈME: Aucun fichier trouvé pour {$identifier}\n\n";
        
        echo "Fichiers similaires dans le dossier (10 premiers):\n";
        foreach (array_slice($allFiles, 0, 10) as $file) {
            echo "  • " . basename($file) . "\n";
        }
    }
    
    // 5. Test de simulation du code Laravel
    echo "\n5️⃣ SIMULATION CODE LARAVEL\n";
    echo str_repeat('=', 80) . "\n";
    
    $images = [];
    $seenFilenames = [];
    
    foreach ($allFiles as $filePath) {
        $filename = basename($filePath);
        
        // Même regex que dans le code Laravel
        if (preg_match('/^' . preg_quote($identifier, '/') . '-(.+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
            if (isset($seenFilenames[$filename])) {
                continue;
            }
            
            $fullType = $matches[1];
            
            // Même pattern que dans le code Laravel
            if (preg_match('/^(cover|artwork|gameplay|logo|display1|display2|display3)(-\d+)?$/i', $fullType, $typeMatches)) {
                $baseType = $typeMatches[1];
                $index = isset($typeMatches[2]) ? (int)str_replace('-', '', $typeMatches[2]) : 1;
                
                $r2PublicUrl = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev';
                $imageUrl = $r2PublicUrl . "/taxonomy/{$folder}/{$filename}";
                
                $images[] = [
                    'filename' => $filename,
                    'path' => "images/taxonomy/{$folder}/{$filename}",
                    'url' => $imageUrl,
                    'type' => $baseType,
                    'full_type' => $fullType,
                    'index' => $index,
                    'source' => 'r2'
                ];
                
                $seenFilenames[$filename] = true;
            }
        }
    }
    
    echo "Résultat simulation:\n";
    echo "  • Nombre d'images: " . count($images) . "\n\n";
    
    if (count($images) > 0) {
        echo "Images retournées:\n";
        foreach ($images as $img) {
            echo "  ✅ {$img['filename']}\n";
            echo "     └─ Type: {$img['type']} (full: {$img['full_type']})\n";
            echo "     └─ Index: {$img['index']}\n";
            echo "     └─ URL: {$img['url']}\n\n";
        }
        
        echo "💡 CONCLUSION:\n";
        echo "Le code Laravel DEVRAIT retourner ces images.\n";
        echo "Si ce n'est pas le cas en production, vérifiez:\n";
        echo "  1. La configuration R2 dans .env (FILESYSTEM_DISK, R2_*)\n";
        echo "  2. Les logs Laravel pour voir les erreurs\n";
        echo "  3. La console JavaScript du navigateur\n";
    } else {
        echo "❌ SIMULATION ÉCHEC: Aucune image trouvée\n";
    }
    
} catch (AwsException $e) {
    echo "❌ ERREUR AWS: " . $e->getMessage() . "\n";
} catch (Exception $e) {
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
}
