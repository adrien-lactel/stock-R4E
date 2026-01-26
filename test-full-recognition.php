#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\ImageRecognitionService;

echo "\n🧪 TEST COMPLET - Reconnaissance Pokemon Green\n";
echo "=" . str_repeat("=", 70) . "\n\n";

$imagePath = 'public/images/test-cartridge.jpg';

if (!file_exists($imagePath)) {
    echo "❌ Image non trouvée: $imagePath\n";
    exit(1);
}

echo "📸 Analyse de: $imagePath\n\n";

$service = new ImageRecognitionService();
$result = $service->analyzeGamingProduct($imagePath);

if (!$result['success']) {
    echo "❌ Erreur: " . $result['message'] . "\n";
    exit(1);
}

echo "✅ Analyse réussie\n\n";

echo "=" . str_repeat("=", 70) . "\n";
echo "📋 SUGGESTIONS GÉNÉRÉES\n";
echo "=" . str_repeat("=", 70) . "\n\n";

foreach ($result['suggestions'] as $key => $value) {
    if (is_array($value)) {
        echo sprintf("%-20s: %s\n", $key, json_encode($value));
    } else {
        echo sprintf("%-20s: %s\n", $key, $value ?? '(vide)');
    }
}

echo "\n" . str_repeat("=", 70) . "\n";
echo "🎯 VÉRIFICATION ROM ID\n";
echo str_repeat("=", 70) . "\n\n";

if (isset($result['suggestions']['rom_id'])) {
    $romId = $result['suggestions']['rom_id'];
    echo "ROM ID détecté    : $romId\n";
    
    // Chercher dans la base
    $game = \App\Models\GameBoyGame::where('rom_id', $romId)->first();
    if ($game) {
        echo "Base de données   : ✅ Trouvé directement\n";
        echo "Nom du jeu        : {$game->name}\n";
    } else {
        echo "Base de données   : ❌ Non trouvé avec '$romId'\n";
        
        // Tester avec variantes (fallback)
        if (preg_match('/-(JPN|EUR|USA|FRA|GER|ITA|SPA)$/i', $romId)) {
            echo "\nTest des variantes avec révisions numériques...\n";
            for ($i = 0; $i <= 3; $i++) {
                $altRomId = preg_replace('/-(JPN|EUR|USA|FRA|GER|ITA|SPA)$/i', "-$i", $romId);
                $game = \App\Models\GameBoyGame::where('rom_id', $altRomId)->first();
                if ($game) {
                    echo "  ✅ Trouvé avec: $altRomId\n";
                    echo "  Nom du jeu: {$game->name}\n";
                    break;
                }
            }
        }
    }
} else {
    echo "❌ Aucun ROM ID détecté\n";
}

echo "\n";
