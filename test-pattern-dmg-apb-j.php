<?php

$text = "DMG-APB-J TING IS | I ~#- $2 ZO,";

$patterns = [
    '/\b(DMG|CGB|AGB)[\s\-]+([A-Z0-9]{4})[\s\-]+([0-3A-Z])\b/i',
    '/\b(DMG|CGB|AGB)[\s\-]+([A-Z0-9]{4})\b/i',
    '/\b(DMG|CGB|AGB)([A-Z0-9]{4})([0-3A-Z])\b/i',
    '/\b(DMG|CGB|AGB)([A-Z0-9]{4})\b/i',
];

echo "Texte : $text\n\n";

foreach ($patterns as $i => $pattern) {
    echo "Pattern " . ($i + 1) . ": $pattern\n";
    if (preg_match($pattern, $text, $matches)) {
        echo "  ✅ MATCH!\n";
        echo "  Prefix: {$matches[1]}, Code: {$matches[2]}, Region: " . ($matches[3] ?? 'N/A') . "\n";
    } else {
        echo "  ❌ Pas de match\n";
    }
    echo "\n";
}
