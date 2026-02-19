<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("RENOMMAGE AUTOMATIQUE - GAME GEAR", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

$imageFolder = 'public/images/taxonomy/gamegear';
$allImages = glob($imageFolder . '/*.{png,jpg,jpeg}', GLOB_BRACE);

// Récupérer uniquement les images kebab
$kebabImages = array_filter($allImages, function($file) {
    $filename = basename($file);
    return preg_match('/^[a-z]/', $filename);
});

echo "📁 Images kebab à renommer: " . count($kebabImages) . "\n\n";

// Fonction pour convertir kebab-case en Title Case
function kebabToTitleCase($kebab) {
    // Enlever le type (-cover, -artwork, etc.)
    $kebab = preg_replace('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', '', $kebab);
    
    // Séparer par tirets
    $parts = explode('-', $kebab);
    
    // Capitaliser chaque mot sauf certains
    $dontCapitalize = ['of', 'and', 'the', 'a', 'an', 'in', 'on', 'at', 'to', 'for'];
    $result = [];
    
    foreach ($parts as $i => $part) {
        if ($i === 0 || !in_array(strtolower($part), $dontCapitalize)) {
            // Capitalized
            $result[] = ucfirst($part);
        } else {
            // Lowercase
            $result[] = strtolower($part);
        }
    }
    
    return implode(' ', $result);
}

// Fonction pour détecter et formater les régions
function formatRegion($text) {
    $regions = [
        'usa' => 'USA',
        'europe' => 'Europe',
        'japan' => 'Japan',
        'world' => 'World',
        'unknown' => 'World',
        'pal' => 'Europe',
        'brazil' => 'Brazil',
        'asia' => 'Asia',
        'korea' => 'Korea',
        'en' => 'En',
        'fr' => 'Fr',
        'de' => 'De',
        'es' => 'Es',
        'it' => 'It',
        'ja' => 'Ja',
        'pt' => 'Pt'
    ];
    
    // Extraire le dernier mot (probable région)
    $parts = explode(' ', $text);
    $lastPart = strtolower(array_pop($parts));
    
    if (isset($regions[$lastPart])) {
        $regionFormatted = $regions[$lastPart];
        $gameName = implode(' ', $parts);
        return $gameName . ' (' . $regionFormatted . ')';
    }
    
    // Vérifier si les derniers mots sont des langues (en-fr-de)
    $lastParts = array_slice($parts, -5);
    $languages = [];
    $gameNameParts = $parts;
    
    foreach (array_reverse($lastParts) as $part) {
        $lowerPart = strtolower($part);
        if (isset($regions[$lowerPart]) && strlen($lowerPart) <= 2) {
            $languages[] = $regions[$lowerPart];
            array_pop($gameNameParts);
        } else {
            break;
        }
    }
    
    if (!empty($languages)) {
        $languages = array_reverse($languages);
        $gameName = implode(' ', $gameNameParts);
        return $gameName . ' (' . implode(',', $languages) . ')';
    }
    
    return $text;
}

$renamed = 0;
$skipped = 0;
$errors = [];

foreach ($kebabImages as $oldPath) {
    $oldFilename = basename($oldPath);
    
    // Extraire le type
    preg_match('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $oldFilename, $matches);
    $type = $matches[1] ?? 'cover';
    $ext = $matches[2] ?? 'png';
    
    // Convertir en Title Case
    $titleCase = kebabToTitleCase($oldFilename);
    
    // Formater la région
    $formatted = formatRegion($titleCase);
    
    // Reconstruire le nom
    $newFilename = $formatted . '-' . $type . '.' . $ext;
    $newPath = $imageFolder . '/' . $newFilename;
    
    // Éviter les doublons
    if (file_exists($newPath)) {
        echo "⚠️  CONFLIT (existe déjà): {$oldFilename}\n";
        $skipped++;
        continue;
    }
    
    // Renommer
    if (rename($oldPath, $newPath)) {
        if ($renamed < 10) {
            echo "✓ {$oldFilename}\n";
            echo "  → {$newFilename}\n";
        }
        $renamed++;
    } else {
        $errors[] = $oldFilename;
    }
}

echo "\n" . str_repeat("═", 80) . "\n";
echo "📊 RÉSULTATS\n";
echo str_repeat("─", 80) . "\n\n";

echo "✅ Renommés: {$renamed} fichiers\n";
echo "⚠️  Ignorés (doublons): {$skipped} fichiers\n";
echo "❌ Erreurs: " . count($errors) . " fichiers\n\n";

if (!empty($errors)) {
    echo "Erreurs:\n";
    foreach ($errors as $error) {
        echo "   • {$error}\n";
    }
    echo "\n";
}

echo str_repeat("═", 80) . "\n";
