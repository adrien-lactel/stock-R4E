<?php

// Test regex de nettoyage
$testCases = [
    "Digimon Adventure - Anode Tamer (Japan)",
    "Digimon Adventure -  Anode Tamer (Japan) (Rev 1)",
    "Digimon Adventure 02 - Tag Tamers (Japan)",
    "Harobots (Japan)",
    "Super Robot Taisen Compact (Japan)"
];

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("TEST REGEX DE NETTOYAGE", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

$pattern = '/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i';

foreach ($testCases as $test) {
    echo "Original: '{$test}'\n";
    $cleaned = preg_replace($pattern, '', $test);
    $cleaned = trim($cleaned);
    echo "Nettoyé: '{$cleaned}'\n";
    echo "Changement: " . ($test !== $cleaned ? "OUI" : "NON") . "\n\n";
}

// Test sur les vrais noms de fichiers
echo str_repeat("═", 80) . "\n";
echo "TEST SUR VRAINOM DE FICHIERS\n";
echo str_repeat("─", 80) . "\n\n";

$testFiles = [
    "Digimon Adventure - Anode Tamer (Japan)-artwork.png",
    "Digimon Adventure - Anode Tamer (Japan) (cover).png",
    "Digimon Adventure - Anode Tamer (Japan) (Rev 1) (cover).png",
];

foreach ($testFiles as $filename) {
    echo "Fichier: {$filename}\n";
    
    // Pattern 1: avec tiret
    if (preg_match('/^(.+?)-(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
        echo "  ✅ Pattern 1 (tiret) matched\n";
        $identifier = trim($matches[1]);
        echo "  Identifiant brut: '{$identifier}'\n";
        
        $cleanIdentifier = preg_replace($pattern, '', $identifier);
        $cleanIdentifier = trim($cleanIdentifier);
        echo "  Identifiant nettoyé: '{$cleanIdentifier}'\n\n";
        continue;
    }
    
    // Pattern 2: avec espace et parenthèse
    if (preg_match('/^(.+?)\s+\((cover|logo|artwork|gameplay)\)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
        echo "  ✅ Pattern 2 (espace/parenthèse) matched\n";
        $identifier = trim($matches[1]);
        echo "  Identifiant brut: '{$identifier}'\n";
        
        $cleanIdentifier = preg_replace($pattern, '', $identifier);
        $cleanIdentifier = trim($cleanIdentifier);
        echo "  Identifiant nettoyé: '{$cleanIdentifier}'\n\n";
        continue;
    }
    
    echo "  ❌ Aucun pattern ne match\n\n";
}

echo str_repeat("═", 80) . "\n";
