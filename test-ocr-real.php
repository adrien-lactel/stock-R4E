#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Image;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;

echo "\n🔍 TEST OCR GOOGLE VISION - Détection brute\n";
echo "=" . str_repeat("=", 70) . "\n\n";

// Vérifier si une image est fournie en argument
if ($argc < 2) {
    echo "Usage: php test-ocr-real.php <chemin_image>\n";
    echo "Exemple: php test-ocr-real.php public/images/test-cartridge.jpg\n\n";
    exit(1);
}

$imagePath = $argv[1];

if (!file_exists($imagePath)) {
    echo "❌ Erreur: Le fichier '$imagePath' n'existe pas\n";
    exit(1);
}

echo "📸 Image: $imagePath\n";
echo "📏 Taille: " . number_format(filesize($imagePath) / 1024, 2) . " KB\n\n";

try {
    // Initialiser le client Google Vision
    $client = new ImageAnnotatorClient([
        'credentials' => config('services.google_vision.credentials')
    ]);
    
    echo "✅ Client Google Vision initialisé\n\n";
    
    // Charger l'image
    $imageContent = file_get_contents($imagePath);
    $image = new Image();
    $image->setContent($imageContent);
    
    // Feature de détection de texte
    $feature = (new Feature())->setType(Type::TEXT_DETECTION);
    
    // Créer la requête
    $request = new AnnotateImageRequest();
    $request->setImage($image);
    $request->setFeatures([$feature]);
    
    $batchRequest = new BatchAnnotateImagesRequest();
    $batchRequest->setRequests([$request]);
    
    // Effectuer l'analyse
    echo "🔄 Analyse en cours...\n\n";
    $response = $client->batchAnnotateImages($batchRequest);
    $imageResponse = $response->getResponses()[0];
    
    // Extraire le texte
    $textAnnotations = $imageResponse->getTextAnnotations();
    
    if (count($textAnnotations) === 0) {
        echo "⚠️  Aucun texte détecté dans l'image\n";
        exit(0);
    }
    
    echo "=" . str_repeat("=", 70) . "\n";
    echo "📝 TEXTE COMPLET DÉTECTÉ (première annotation)\n";
    echo "=" . str_repeat("=", 70) . "\n\n";
    
    $fullText = $textAnnotations[0]->getDescription();
    echo $fullText . "\n\n";
    
    echo "=" . str_repeat("=", 70) . "\n";
    echo "📋 TEXTES INDIVIDUELS DÉTECTÉS (" . count($textAnnotations) . " éléments)\n";
    echo "=" . str_repeat("=", 70) . "\n\n";
    
    $count = 0;
    foreach ($textAnnotations as $index => $text) {
        if ($index === 0) continue; // Skip le texte complet
        
        $description = $text->getDescription();
        echo sprintf("%3d. %s\n", ++$count, $description);
        
        // Limiter l'affichage aux 50 premiers
        if ($count >= 50) {
            echo "\n... et " . (count($textAnnotations) - 51) . " autres\n";
            break;
        }
    }
    
    echo "\n" . str_repeat("=", 70) . "\n";
    echo "🎯 RECHERCHE DE ROM IDS\n";
    echo str_repeat("=", 70) . "\n\n";
    
    // Patterns ROM ID (simples pour le test)
    $patterns = [
        '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([0-9A-Z]{1,3})\b/i',
        '/\b[A-Z0-9]{3}[\s\-][A-Z0-9]{4}[\s\-][A-Z0-9]{3}\b/i',
    ];
    
    $foundRomIds = [];
    foreach ($patterns as $pattern) {
        if (preg_match_all($pattern, $fullText, $matches, PREG_SET_ORDER)) {
            foreach ($matches as $match) {
                $foundRomIds[] = $match[0];
            }
        }
    }
    
    if (count($foundRomIds) > 0) {
        echo "✅ ROM IDs détectés:\n";
        foreach (array_unique($foundRomIds) as $romId) {
            echo "   - $romId\n";
        }
    } else {
        echo "❌ Aucun ROM ID détecté avec les patterns actuels\n";
        echo "\n💡 Texte brut à analyser manuellement:\n";
        echo "   " . str_replace("\n", "\n   ", substr($fullText, 0, 200)) . "...\n";
    }
    
    echo "\n";
    
} catch (\Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    echo "\n📋 Détails:\n";
    echo $e->getTraceAsString() . "\n";
    exit(1);
}
