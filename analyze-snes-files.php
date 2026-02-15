<?php

// Script pour analyser les fichiers SNES sur R2 sans connexion DB

echo "=== ANALYSE DES FICHIERS SNES SUR R2 ===\n\n";

// 1. Lister les fichiers locaux dans public/images/taxonomy/snes
echo "📁 Fichiers images locaux dans public/images/taxonomy/snes:\n";
$snesImagesPath = __DIR__ . '/public/images/taxonomy/snes';
if (file_exists($snesImagesPath)) {
    $files = scandir($snesImagesPath);
    $imageFiles = array_filter($files, function($f) {
        return !in_array($f, ['.', '..']) && preg_match('/\.(png|jpg|jpeg)$/i', $f);
    });
    
    // Regrouper par ROM ID
    $byRomId = [];
    $byPattern = [];
    
    foreach ($imageFiles as $file) {
        echo "  $file\n";
        
        // Analyser le pattern de nommage
        if (preg_match('/^(SHVC-[A-Z0-9]+|SNS-[A-Z0-9]+)-(.+)\.(png|jpg|jpeg)$/i', $file, $matches)) {
            $romId = $matches[1];
            $type = $matches[2];
            
            if (!isset($byRomId[$romId])) {
                $byRomId[$romId] = [];
            }
            $byRomId[$romId][] = $type;
        } elseif (preg_match('/^([^-]+)-(.+)\.(png|jpg|jpeg)$/i', $file, $matches)) {
            $identifier = $matches[1];
            $type = $matches[2];
            
            if (!isset($byPattern[$identifier])) {
                $byPattern[$identifier] = [];
            }
            $byPattern[$identifier][] = $type;
        }
    }
    
    echo "\n  Total: " . count($imageFiles) . " fichiers\n";
    
    echo "\n📊 Groupement par ROM ID (format SHVC-/SNS-):\n";
    $count = 0;
    foreach ($byRomId as $romId => $types) {
        if ($count < 10) {
            echo "  $romId: " . implode(', ', $types) . "\n";
        }
        $count++;
    }
    if ($count > 10) {
        echo "  ... et " . ($count - 10) . " autres ROM IDs\n";
    }
    
    echo "\n📊 Autres patterns de nommage:\n";
    $count = 0;
    foreach ($byPattern as $identifier => $types) {
        if ($count < 10) {
            echo "  $identifier: " . implode(', ', $types) . "\n";
        }
        $count++;
    }
    if ($count > 10) {
        echo "  ... et " . ($count - 10) . " autres identifiants\n";
    }
} else {
    echo "  ❌ Dossier n'existe pas\n";
}

// 2. Analyser la logique de recherche dans le code
echo "\n\n🔍 ANALYSE DE LA LOGIQUE DE RECHERCHE:\n";
echo "Pour les jeux SNES, le système recherche les fichiers avec le pattern:\n";
echo "  - Dossier: taxonomy/snes/\n";
echo "  - Nom de fichier: {ROM_ID}-{type}.png\n";
echo "  - Exemples de ROM ID attendus: SHVC-XXXX, SNS-XXXX\n";
echo "  - Types d'images: cover, artwork, gameplay, logo\n";

// 3. Vérifier s'il y a des fichiers avec un pattern différent
echo "\n\n🔍 DÉTECTION DE PATTERNS INHABITUELS:\n";
if (isset($imageFiles)) {
    $withoutDash = [];
    $withMultipleDash = [];
    $other = [];
    
    foreach ($imageFiles as $file) {
        if (!preg_match('/-/', $file)) {
            $withoutDash[] = $file;
        } elseif (preg_match('/^([^-]+-[^-]+)-/', $file)) {
            // Fichier avec au moins 2 tirets (normal)
        } else {
            $other[] = $file;
        }
    }
    
    if (count($withoutDash) > 0) {
        echo "  ❌ Fichiers SANS tiret (ne seront pas trouvés):\n";
        foreach (array_slice($withoutDash, 0, 5) as $f) {
            echo "    - $f\n";
        }
    }
    
    if (count($other) > 0) {
        echo "  ⚠️ Fichiers avec pattern inhabituel:\n";
        foreach (array_slice($other, 0, 5) as $f) {
            echo "    - $f\n";
        }
    }
}

echo "\n\n💡 RECOMMANDATIONS:\n";
echo "1. Les fichiers sur R2 doivent suivre le format: {ROM_ID}-{type}.png\n";
echo "2. ROM_ID pour SNES doit commencer par SHVC- ou SNS-\n";
echo "3. Si les fichiers ont un autre format, il faut adapter la logique\n";
echo "4. Exemples corrects:\n";
echo "   - SHVC-MK-cover.png\n";
echo "   - SNS-ZL-USA-artwork.png\n";

echo "\n=== FIN DE L'ANALYSE ===\n";
