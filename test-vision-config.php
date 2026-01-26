<?php

/**
 * Script de test de configuration Google Cloud Vision
 * 
 * Usage: php test-vision-config.php
 */

require 'vendor/autoload.php';

echo "🔍 TEST DE CONFIGURATION GOOGLE CLOUD VISION\n";
echo "============================================\n\n";

// Charger .env
if (file_exists(__DIR__ . '/.env')) {
    $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();
}

// 1. Vérifier variable d'environnement
echo "1️⃣ Vérification variable GOOGLE_VISION_CREDENTIALS...\n";
$credentials = $_ENV['GOOGLE_VISION_CREDENTIALS'] ?? null;

if (!$credentials) {
    echo "   ❌ ERREUR: Variable GOOGLE_VISION_CREDENTIALS non définie\n";
    echo "   📝 Solution: Ajoutez GOOGLE_VISION_CREDENTIALS dans .env\n";
    echo "   📖 Voir: GOOGLE_VISION_SETUP.md\n\n";
    exit(1);
}

echo "   ✅ Variable définie (" . strlen($credentials) . " caractères)\n\n";

// 2. Vérifier format JSON
echo "2️⃣ Vérification format JSON...\n";
$credentialsArray = json_decode($credentials, true);

if (!$credentialsArray) {
    echo "   ❌ ERREUR: Le contenu n'est pas du JSON valide\n";
    echo "   🔧 JSON Error: " . json_last_error_msg() . "\n";
    echo "   📝 Solution: Vérifiez que vous avez bien copié tout le JSON\n\n";
    exit(1);
}

echo "   ✅ JSON valide\n\n";

// 3. Vérifier champs obligatoires
echo "3️⃣ Vérification champs obligatoires...\n";
$requiredFields = ['type', 'project_id', 'private_key_id', 'private_key', 'client_email'];
$missing = [];

foreach ($requiredFields as $field) {
    if (!isset($credentialsArray[$field])) {
        $missing[] = $field;
    }
}

if (!empty($missing)) {
    echo "   ❌ ERREUR: Champs manquants: " . implode(', ', $missing) . "\n";
    echo "   📝 Solution: Téléchargez à nouveau le fichier JSON depuis Google Cloud\n\n";
    exit(1);
}

echo "   ✅ Tous les champs présents\n";
echo "   • Type: " . $credentialsArray['type'] . "\n";
echo "   • Project ID: " . $credentialsArray['project_id'] . "\n";
echo "   • Client Email: " . $credentialsArray['client_email'] . "\n\n";

// 4. Vérifier que c'est un service account
echo "4️⃣ Vérification type de compte...\n";
if ($credentialsArray['type'] !== 'service_account') {
    echo "   ⚠️ ATTENTION: Type attendu 'service_account', obtenu '" . $credentialsArray['type'] . "'\n\n";
} else {
    echo "   ✅ Service account correct\n\n";
}

// 5. Tester initialisation client
echo "5️⃣ Test initialisation client Google Vision...\n";
try {
    $client = new \Google\Cloud\Vision\V1\ImageAnnotatorClient([
        'credentials' => $credentialsArray
    ]);
    
    echo "   ✅ Client initialisé avec succès!\n\n";
    
    $client->close();
    
} catch (\Exception $e) {
    echo "   ❌ ERREUR lors de l'initialisation: " . $e->getMessage() . "\n";
    echo "   🔧 Vérifiez:\n";
    echo "      1. Que l'API Cloud Vision est activée dans Google Cloud Console\n";
    echo "      2. Que le service account a les permissions nécessaires\n";
    echo "      3. Que la clé n'a pas été révoquée\n\n";
    exit(1);
}

// 6. Vérifier config Laravel
echo "6️⃣ Vérification config Laravel (services.php)...\n";

// Simuler la config Laravel
$laravelConfig = [
    'credentials' => json_decode($credentials, true),
    'project_id' => $_ENV['GOOGLE_VISION_PROJECT_ID'] ?? $credentialsArray['project_id']
];

if ($laravelConfig['credentials']) {
    echo "   ✅ Config Laravel OK\n";
    echo "   • Project ID: " . $laravelConfig['project_id'] . "\n\n";
} else {
    echo "   ❌ ERREUR: Config Laravel invalide\n\n";
    exit(1);
}

// RÉSUMÉ
echo "═══════════════════════════════════════════\n";
echo "✅ CONFIGURATION COMPLÈTE ET FONCTIONNELLE!\n";
echo "═══════════════════════════════════════════\n\n";

echo "📋 Informations:\n";
echo "   • Project ID: " . $credentialsArray['project_id'] . "\n";
echo "   • Service Account: " . $credentialsArray['client_email'] . "\n";
echo "   • Private Key ID: " . substr($credentialsArray['private_key_id'], 0, 20) . "...\n\n";

echo "🎯 Prochaine étape:\n";
echo "   Testez l'analyse IA en uploadant une image dans l'application!\n";
echo "   Route: /admin/articles/create\n\n";

echo "💡 Astuce:\n";
echo "   Si l'analyse échoue, vérifiez:\n";
echo "   - Que vous êtes en HTTPS (ou localhost)\n";
echo "   - Les logs Laravel: storage/logs/laravel.log\n";
echo "   - La console navigateur (F12)\n\n";
