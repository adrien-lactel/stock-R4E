<?php

$text = "DMG-APB-J TING IS | I ~#- $2 ZO,";

$patterns = [
    '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([0-3])\b/i',
    '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([A-Z]{2,3})\b/i',
    '/\b(DMG|CGB|AGB)([A-Z0-9]{3,4})([0-9A-Z]{2,3})\b/i',
    '/\b(DMG|CGB|AGB)\s+([A-Z][A-Za-z0-9]{2,3}[A-Za-z])\b/i',
];

echo "Texte à analyser: $text\n\n";

foreach ($patterns as $i => $pattern) {
    echo "Pattern " . ($i + 1) . ": $pattern\n";
    if (preg_match($pattern, $text, $matches)) {
        echo "  ✅ MATCH!\n";
        print_r($matches);
    } else {
        echo "  ❌ Pas de match\n";
    }
    echo "\n";
}
