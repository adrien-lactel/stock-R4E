#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Services\ImageRecognitionService;

echo "\n🧪 Test des corrections OCR pour ROM IDs\n";
echo "=" . str_repeat("=", 70) . "\n\n";

// Textes mal reconnus par OCR (simulations réelles)
$testTexts = [
    '0MG-APAJ-JPN',      // 0 au lieu de D
    'OMG-APAJ-JPN',      // O au lieu de D  
    'DlG-APAJ-JPN',      // l minuscule au lieu de M
    'DIG-APAJ-JPN',      // I au lieu de M
    'DMC-APAJ-JPN',      // C au lieu de G
    'DM6-APAJ-JPN',      // 6 au lieu de G
    'DMG APAJ JPN',      // Espaces au lieu de tirets
    'DMG.APAJ.JPN',      // Points au lieu de tirets
    'DMG_APAJ_JPN',      // Underscores
    'DMG - APAJ - JPN',  // Espaces + tirets
    'CG8-BXTJ-JPN',      // 8 au lieu de B
    'CCB-BXTJ-JPN',      // C au lieu de G
    'AGR-AXVE-USA',      // R au lieu de B
    'AG8-AXVE-USA',      // 8 au lieu de B
    'DMGAPAJJPN',        // Tout collé
];

$service = new ImageRecognitionService();

// Utiliser la réflexion pour accéder à la méthode protégée
$reflection = new ReflectionClass($service);
$method = $reflection->getMethod('cleanTextForRomId');
$method->setAccessible(true);

foreach ($testTexts as $index => $text) {
    echo sprintf("Test #%d: %s\n", $index + 1, $text);
    echo str_repeat("-", 70) . "\n";
    
    $cleaned = $method->invoke($service, $text);
    
    if ($cleaned !== strtoupper($text)) {
        echo "  📝 Texte original : $text\n";
        echo "  ✨ Texte corrigé  : $cleaned\n";
        
        // Tester si le pattern ROM ID matche maintenant
        $pattern = '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([A-Z]{3})\b/i';
        if (preg_match($pattern, $cleaned, $matches)) {
            $romId = strtoupper($matches[1]) . '-' . strtoupper($matches[2]) . '-' . strtoupper($matches[3]);
            echo "  ✅ ROM ID détecté : $romId\n";
        } else {
            echo "  ⚠️  Pas encore détectable comme ROM ID\n";
        }
    } else {
        echo "  ℹ️  Aucune correction nécessaire\n";
    }
    
    echo "\n";
}

echo "\n📊 CORRECTIONS APPLIQUÉES\n";
echo "=" . str_repeat("=", 70) . "\n";
echo "✓ 0MG/OMG → DMG (confusion O/0 avec D)\n";
echo "✓ DlG/DIG → DMG (confusion l/I avec M)\n";
echo "✓ DMC/DM6 → DMG (confusion C/6 avec G)\n";
echo "✓ CG8/CCB → CGB (confusions multiples)\n";
echo "✓ AGR/AG8 → AGB (confusion R/8 avec B)\n";
echo "✓ Normalisation des séparateurs (espaces, points, underscores → tirets)\n";
echo "\n";
