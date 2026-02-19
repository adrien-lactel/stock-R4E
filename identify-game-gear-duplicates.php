<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("IDENTIFICATION DES DOUBLONS - GAME GEAR", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

$imageFolder = 'public/images/taxonomy/gamegear';
$allImages = glob($imageFolder . '/*.{png,jpg,jpeg}', GLOB_BRACE);

// Fonction pour normaliser un nom de jeu (enlever les variations)
function normalizeGameTitle($title) {
    // Enlever l'extension
    $title = preg_replace('/\.(png|jpg|jpeg)$/i', '', $title);
    
    // Enlever le type d'image
    $title = preg_replace('/-?(cover|logo|artwork|gameplay|display\d+)$/i', '', $title);
    $title = trim($title);
    
    // Convertir en minuscules
    $title = strtolower($title);
    
    // Remplacer les tirets/underscores par des espaces
    $title = str_replace(['-', '_'], ' ', $title);
    
    // Normaliser les espaces multiples
    $title = preg_replace('/\s+/', ' ', $title);
    
    // Enlever parenthèses et leur contenu pour comparaison
    $title = preg_replace('/\([^)]*\)/', '', $title);
    
    // Enlever crochets et contenu
    $title = preg_replace('/\[[^\]]*\]/', '',  $title);
    
    // Nettoyer espaces multiples
    $title = preg_replace('/\s+/', ' ', $title);
    $title = trim($title);
    
    return $title;
}

// Grouper les images par titre normalisé
$imageGroups = [];

foreach ($allImages as $imagePath) {
    $filename = basename($imagePath);
    $normalized = normalizeGameTitle($filename);
    
    if (!isset($imageGroups[$normalized])) {
        $imageGroups[$normalized] = [
            'classique' => [],
            'kebab' => []
        ];
    }
    
    // Déterminer le format
    if (preg_match('/^[a-z]/', $filename)) {
        $imageGroups[$normalized]['kebab'][] = $filename;
    } else {
        $imageGroups[$normalized]['classique'][] = $filename;
    }
}

// Trouver les doublons (même jeu dans les deux formats)
$doublons = [];
$uniquesKebab = [];

foreach ($imageGroups as $normalized => $files) {
    if (!empty($files['classique']) && !empty($files['kebab'])) {
        // C'est un doublon!
        $doublons[$normalized] = $files;
    } elseif (empty($files['classique']) && !empty($files['kebab'])) {
        // Jeu uniquement en format kebab
        $uniquesKebab[$normalized] = $files['kebab'];
    }
}

echo "📊 RÉSULTATS\n";
echo str_repeat("─", 80) . "\n\n";

echo "✅ Jeux avec images classiques ET kebab (DOUBLONS): " . count($doublons) . "\n";
echo "📁 Jeux uniquement en format kebab (À RENOMMER): " . count($uniquesKebab) . "\n";
echo "📷 Total images kebab en doublon: " . array_sum(array_map(fn($d) => count($d['kebab']), $doublons)) . "\n";
echo "📷 Total images kebab uniques: " . array_sum(array_map(fn($u) => count($u), $uniquesKebab)) . "\n\n";

// Afficher les doublons
if (count($doublons) > 0) {
    echo str_repeat("═", 80) . "\n";
    echo "🗑️  DOUBLONS À SUPPRIMER (10 premiers)\n";
    echo str_repeat("─", 80) . "\n\n";
    
    $count = 0;
    foreach ($doublons as $normalized => $files) {
        if ($count >= 10) {
            echo "... et " . (count($doublons) - 10) . " autres doublons\n";
            break;
        }
        
        echo ($count + 1) . ". Jeu: " . ucwords($normalized) . "\n";
        echo "   Format classique ({$files['classique'][0]}{$files['classique'][1]})\n";
        echo "      • " . $files['classique'][0] . "\n";
        if (count($files['classique']) > 1) {
            echo "      • ... et " . (count($files['classique']) - 1) . " autres\n";
        }
        echo "   Format kebab (À SUPPRIMER):\n";
        foreach ($files['kebab'] as $kebabFile) {
            echo "      ❌ {$kebabFile}\n";
        }
        echo "\n";
        
        $count++;
    }
}

// Afficher les uniques kebab
if (count($uniquesKebab) > 0) {
    echo "\n" . str_repeat("═", 80) . "\n";
    echo "🔄 JEUX UNIQUEMENT EN KEBAB - À RENOMMER (10 premiers)\n";
    echo str_repeat("─", 80) . "\n\n";
    
    $count = 0;
    foreach ($uniquesKebab as $normalized => $files) {
        if ($count >= 10) {
            echo "... et " . (count($uniquesKebab) - 10) . " autres\n";
            break;
        }
        
        echo ($count + 1) . ". Jeu: " . ucwords($normalized) . "\n";
        echo "   Fichiers:\n";
        foreach ($files as $file) {
            echo "      • {$file}\n";
        }
        echo "\n";
        
        $count++;
    }
}

echo "\n" . str_repeat("═", 80) . "\n";
echo "💡 PLAN D'ACTION\n";
echo str_repeat("─", 80) . "\n\n";

$totalDoublonsKebab = array_sum(array_map(fn($d) => count($d['kebab']), $doublons));
$totalUniquesKebab = array_sum(array_map(fn($u) => count($u), $uniquesKebab));
$totalClassiqueUniques = count($allImages) - array_sum(array_map(fn($d) => count($d['kebab']), $imageGroups));

echo "1. SUPPRIMER {$totalDoublonsKebab} images kebab en doublon\n";
echo "   → Ces jeux ont déjà des images en format classique\n\n";

echo "2. RENOMMER {$totalUniquesKebab} images kebab uniques en format classique\n";
echo "   → Ces jeux n'ont pas d'images en format classique\n\n";

echo "3. RÉSULTAT ATTENDU:\n";
echo "   → " . (1262 + $totalUniquesKebab) . " images en format classique unique\n";
echo "   → 0 image en format kebab\n";
echo "   → Correspondance devrait passer à ~" . (428 + count($uniquesKebab)) . " jeux\n\n";

echo str_repeat("═", 80) . "\n";
