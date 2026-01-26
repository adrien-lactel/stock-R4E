<?php

/**
 * Test Google Cloud Vision API
 * 
 * Ce script teste la connexion à Google Cloud Vision et effectue une analyse simple.
 * 
 * Usage: php test-google-vision.php
 */

require 'vendor/autoload.php';

use Google\Cloud\Vision\V1\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Image;
use Google\Cloud\Vision\V1\Feature\Type;

echo "🧪 TEST GOOGLE CLOUD VISION API\n";
echo "================================\n\n";

// Charger les credentials depuis .env
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$credentials = $_ENV['GOOGLE_VISION_CREDENTIALS'] ?? null;
$projectId = $_ENV['GOOGLE_VISION_PROJECT_ID'] ?? null;

if (!$credentials) {
    echo "❌ ERREUR: Variable GOOGLE_VISION_CREDENTIALS non définie dans .env\n";
    echo "📖 Consultez GOOGLE_VISION_SETUP.md pour la configuration\n";
    exit(1);
}

if (!$projectId) {
    echo "⚠️ ATTENTION: GOOGLE_VISION_PROJECT_ID non défini (optionnel)\n\n";
}

echo "✅ Credentials trouvées\n";
echo "📦 Project ID: " . ($projectId ?: 'Non défini') . "\n\n";

try {
    // Initialiser le client
    $client = new ImageAnnotatorClient([
        'credentials' => json_decode($credentials, true)
    ]);
    
    echo "✅ Client Google Vision initialisé\n\n";

    // Tester avec une image simple (URL publique)
    $testImageUrl = 'https://upload.wikimedia.org/wikipedia/commons/thumb/f/f9/Gameboy.jpg/800px-Gameboy.jpg';
    
    echo "🖼️ Test avec une image publique:\n";
    echo "   URL: $testImageUrl\n\n";
    
    echo "📥 Téléchargement de l'image...\n";
    $imageContent = file_get_contents($testImageUrl);
    
    if (!$imageContent) {
        throw new Exception("Impossible de télécharger l'image de test");
    }
    
    echo "✅ Image téléchargée (" . strlen($imageContent) . " bytes)\n\n";

    $image = new Image();
    $image->setContent($imageContent);

    echo "🔍 Analyse en cours...\n";
    
    $response = $client->annotateImage($image, [
        Type::LABEL_DETECTION,
        Type::TEXT_DETECTION,
        Type::LOGO_DETECTION,
    ]);

    echo "✅ Analyse terminée!\n\n";

    // Afficher les labels
    echo "🏷️ LABELS DÉTECTÉS:\n";
    echo "-------------------\n";
    $labels = $response->getLabelAnnotations();
    if (count($labels) > 0) {
        foreach ($labels as $label) {
            $confidence = round($label->getScore() * 100, 2);
            echo "  • " . $label->getDescription() . " ({$confidence}%)\n";
        }
    } else {
        echo "  (Aucun label détecté)\n";
    }
    
    echo "\n";

    // Afficher les logos
    echo "🎨 LOGOS DÉTECTÉS:\n";
    echo "-----------------\n";
    $logos = $response->getLogoAnnotations();
    if (count($logos) > 0) {
        foreach ($logos as $logo) {
            $confidence = round($logo->getScore() * 100, 2);
            echo "  • " . $logo->getDescription() . " ({$confidence}%)\n";
        }
    } else {
        echo "  (Aucun logo détecté)\n";
    }
    
    echo "\n";

    // Afficher le texte
    echo "📝 TEXTE DÉTECTÉ (OCR):\n";
    echo "----------------------\n";
    $texts = $response->getTextAnnotations();
    if (count($texts) > 0) {
        // Le premier élément contient tout le texte
        $fullText = $texts[0]->getDescription();
        echo substr($fullText, 0, 200) . (strlen($fullText) > 200 ? '...' : '') . "\n";
    } else {
        echo "  (Aucun texte détecté)\n";
    }

    echo "\n";
    echo "✅ TEST RÉUSSI!\n";
    echo "🎉 Google Cloud Vision fonctionne correctement!\n";
    echo "\n";
    echo "📌 Prochaine étape:\n";
    echo "   Testez l'analyse dans l'application Laravel en créant un article\n";
    echo "   et en cliquant sur '🤖 Analyser avec l'IA'\n";

    $client->close();

} catch (Exception $e) {
    echo "\n";
    echo "❌ ERREUR: " . $e->getMessage() . "\n";
    echo "\n";
    echo "🔧 Vérifications:\n";
    echo "  1. Le fichier .env contient GOOGLE_VISION_CREDENTIALS\n";
    echo "  2. Les credentials JSON sont valides\n";
    echo "  3. L'API Cloud Vision est activée dans votre projet Google Cloud\n";
    echo "  4. Consultez GOOGLE_VISION_SETUP.md pour plus d'infos\n";
    exit(1);
}
