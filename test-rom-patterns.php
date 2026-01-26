#!/usr/bin/env php
<?php

echo "\n🔍 Test des patterns de détection ROM ID\n";
echo "=" . str_repeat("=", 60) . "\n\n";

// Patterns améliorés (identiques au service)
$patterns = [
    // Format avec révision numérique (DMG-APAJ-0, DMG-APSJ-1, etc.)
    '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([0-3])\b/i',
    
    // Format standard avec code région (DMG-APSJ-JPN, etc.)
    '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([A-Z]{3})\b/i',
    
    // Format sans séparateurs (DMG APSJ JPN ou DMGAPSJJPN)
    '/\b(DMG|CGB|AGB)([A-Z0-9]{3,4})([0-9A-Z]{3})\b/i',
    
    // Format générique pour autres consoles (XXX-XXXX-XXX)
    '/\b([A-Z]{3})[\s\-]?([A-Z0-9]{3,4})[\s\-]?([A-Z0-9]{3})\b/i',
];

// Tests avec différents formats d'OCR
$testCases = [
    'DMG-APSJ-JPN',           // Format standard avec tirets
    'DMG APSJ JPN',           // Format avec espaces
    'DMGAPSJJPN',             // Format collé
    'DMG-APSJ JPN',           // Format mixte (tiret + espace)
    'DMG APSJ-JPN',           // Format mixte (espace + tiret)
    'CGB-BXTJ-JPN',           // Game Boy Color
    'AGB-AXVE-USA',           // Game Boy Advance
    'DMG APAJ 0',             // Format avec révision numérique
    'DMG-APAJ-0',             // Format standard avec révision
    'Some text DMG-APSJ-JPN more text',  // ROM ID au milieu de texte
    'DMGAPSJ',                // Format trop court (ne devrait pas matcher)
    'Nintendo Game Boy',      // Pas un ROM ID
];

foreach ($testCases as $index => $text) {
    echo sprintf("Test #%d: %s\n", $index + 1, $text);
    echo str_repeat("-", 60) . "\n";
    
    $found = false;
    foreach ($patterns as $patternIndex => $pattern) {
        if (preg_match($pattern, $text, $matches)) {
            $prefix = strtoupper($matches[1] ?? '');
            $gameCode = strtoupper($matches[2] ?? '');
            $region = strtoupper($matches[3] ?? '');
            $romId = "$prefix-$gameCode-$region";
            
            echo "  ✅ MATCH avec pattern #" . ($patternIndex + 1) . "\n";
            echo "     Texte capturé: {$matches[0]}\n";
            echo "     ROM ID normalisé: $romId\n";
            echo "     Détails: Préfixe=$prefix, Code=$gameCode, Région=$region\n";
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        echo "  ❌ AUCUN MATCH\n";
    }
    
    echo "\n";
}

echo "\n📊 RÉSUMÉ DES PATTERNS\n";
echo "=" . str_repeat("=", 60) . "\n";
echo "Pattern 1: DMG/CGB/AGB avec révision numérique 0-3\n";
echo "Pattern 2: DMG/CGB/AGB avec code région (JPN, USA, EUR, etc.)\n";
echo "Pattern 3: DMG/CGB/AGB collés sans séparateurs\n";
echo "Pattern 4: Format générique XXX-XXX-XXX\n";
echo "\n";
