<?php

$text = "DMG-APB-J TING IS | I ~#- $2 ZO,";

echo "Avant: $text\n";

$pattern = '/\b(DMG|CGB|AGB)-([A-Z0-9]{3})-([A-Z0-9])\b/i';
$replacement = '$1-$2$3';

$result = preg_replace($pattern, $replacement, $text);

echo "Après: $result\n";

if ($result !== $text) {
    echo "✅ Correction appliquée!\n";
} else {
    echo "❌ Aucune correction\n";
}
