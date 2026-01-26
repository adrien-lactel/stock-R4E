<?php

$texts = [
    "DMG-APBJ TING",
    "DMG-APB-J TING",
    "DMG APBJ",
    "DMGAPBJ",
];

$pattern = '/\b(DMG|CGB|AGB)[\s\-]+([A-Z0-9]{4})\b/i';

foreach ($texts as $text) {
    echo "Texte: '$text'\n";
    if (preg_match($pattern, $text, $m)) {
        echo "  ✅ MATCH! Prefix={$m[1]}, Code={$m[2]}\n";
    } else {
        echo "  ❌ Pas de match\n";
    }
    echo "\n";
}
