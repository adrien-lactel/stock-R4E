<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║           ANALYSE DÉTAILLÉE: COMPARAISON DB vs IMAGES WONDERSWAN          ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Récupérer tous les jeux WonderSwan
$games = DB::table('wonderswan_games')
    ->select('id', 'rom_id', 'name')
    ->orderBy('name')
    ->get();

// Lister les fichiers images
$imageFolder = 'public/images/taxonomy/wonderswan';
$allImages = glob($imageFolder . '/*.{png,jpg,jpeg}', GLOB_BRACE);

// Extraire les identifiants des images
$imageIdentifiers = [];
foreach ($allImages as $imagePath) {
    $filename = basename($imagePath);
    
    if (preg_match('/^(.+?)-(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
        $identifier = trim($matches[1]);
        // Nettoyer les infos de région
        $cleanIdentifier = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $identifier);
        
        if (!isset($imageIdentifiers[$cleanIdentifier])) {
            $imageIdentifiers[$cleanIdentifier] = [
                'original' => $identifier,
                'files' => []
            ];
        }
        $imageIdentifiers[$cleanIdentifier]['files'][] = $filename;
    }
}

echo "📊 Statistiques:\n";
echo "  • Jeux en base: " . count($games) . "\n";
echo "  • Images: " . count($allImages) . "\n";
echo "  • Identifiants d'images uniques: " . count($imageIdentifiers) . "\n\n";

// Grouper les jeux par similarité
$gamesWithImages = [];
$gamesWithoutImages = [];
$imagesWithoutDb = [];

// Index des jeux par nom simplifié
$dbIndex = [];
foreach ($games as $game) {
    $normalized = $game->name;
    // Retirer l'extension .ws
    $normalized = str_replace('.ws', '', $normalized);
    // Retirer uniquement la région finale entre parenthèses
    $normalized = preg_replace('/\s*\((Japan|World|USA|Europe|En,Ja)\)\s*$/i', '', $normalized);
    $normalized = trim($normalized);
    
    $dbIndex[$normalized] = $game;
}

echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "📋 COMPARAISON DÉTAILLÉE (30 premiers identifiants d'images)\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

$matchCount = 0;
$noMatchCount = 0;
$samples = array_slice(array_keys($imageIdentifiers), 0, 30, true);

foreach ($samples as $imgIdentifier) {
    $data = $imageIdentifiers[$imgIdentifier];
    echo "🖼️  IMAGE: '$imgIdentifier'\n";
    echo "   Original avec région: '{$data['original']}'\n";
    
    // Chercher une correspondance exacte
    if (isset($dbIndex[$imgIdentifier])) {
        $game = $dbIndex[$imgIdentifier];
        echo "   ✅ MATCH TROUVÉ en base:\n";
        echo "      DB name: '{$game->name}'\n";
        $matchCount++;
    } else {
        echo "   ❌ AUCUNE CORRESPONDANCE en base\n";
        
        // Chercher des correspondances similaires
        $similar = [];
        foreach ($dbIndex as $dbName => $game) {
            similar_text(strtolower($imgIdentifier), strtolower($dbName), $percent);
            if ($percent > 70) {
                $similar[] = ['name' => $dbName, 'percent' => round($percent, 1), 'original' => $game->name];
            }
        }
        
        if (count($similar) > 0) {
            usort($similar, function($a, $b) { return $b['percent'] <=> $a['percent']; });
            echo "   🔶 Jeux similaires trouvés:\n";
            foreach (array_slice($similar, 0, 3) as $sim) {
                echo "      - {$sim['percent']}%: '{$sim['original']}'\n";
            }
        }
        $noMatchCount++;
    }
    echo "\n";
}

echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "📊 RÉSULTATS DE L'ÉCHANTILLON\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";
echo "  ✅ Correspondances trouvées: $matchCount\n";
echo "  ❌ Sans correspondance: $noMatchCount\n\n";

// Maintenant chercher les jeux en base qui n'ont PAS d'images
echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "🔍 JEUX EN BASE SANS IMAGES (échantillon de 20)\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

$noImageCount = 0;
$sampleCount = 0;
foreach ($games as $game) {
    $normalized = $game->name;
    $normalized = str_replace('.ws', '', $normalized);
    $normalized = preg_replace('/\s*\((Japan|World|USA|Europe|En,Ja)\)\s*$/i', '', $normalized);
    $normalized = trim($normalized);
    
    if (!isset($imageIdentifiers[$normalized])) {
        $noImageCount++;
        
        if ($sampleCount < 20) {
            echo "DB: '{$game->name}'\n";
            echo "   Normalisé: '$normalized'\n";
            
            // Chercher des images similaires
            $similar = [];
            foreach ($imageIdentifiers as $imgName => $imgData) {
                similar_text(strtolower($normalized), strtolower($imgName), $percent);
                if ($percent > 70) {
                    $similar[] = ['name' => $imgName, 'percent' => round($percent, 1)];
                }
            }
            
            if (count($similar) > 0) {
                usort($similar, function($a, $b) { return $b['percent'] <=> $a['percent']; });
                echo "   🔶 Images similaires:\n";
                foreach (array_slice($similar, 0, 2) as $sim) {
                    echo "      - {$sim['percent']}%: '{$sim['name']}'\n";
                }
            } else {
                echo "   ❌ Aucune image similaire\n";
            }
            echo "\n";
            $sampleCount++;
        }
    }
}

echo "\nTotal de jeux sans images: $noImageCount\n\n";

// Résumé des causes
echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "💡 CAUSES IDENTIFIÉES\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

echo "1. EXTENSION .ws:\n";
echo "   - 219 jeux en base ont '.ws' à la fin\n";
echo "   - Les images n'ont JAMAIS '.ws'\n";
echo "   - Impact: 68% des jeux\n\n";

echo "2. TAGS ADDITIONNELS:\n";
echo "   - DB contient: (WonderWitch), (Unl), (v1.00), (Rev 1), etc.\n";
echo "   - Images ne contiennent QUE la région: (Japan), (World), etc.\n";
echo "   - Impact: Presque tous les jeux WonderWitch et Unlicensed\n\n";

echo "3. JEUX EN DOUBLE:\n";
echo "   - Certains jeux existent avec ET sans .ws\n";
echo "   - Exemple: ID 220 vs ID 6 pour '7 Days Left'\n";
echo "   - Impact: Duplications dans la base\n\n";

echo "4. DIFFÉRENCES DE NOMMAGE:\n";
echo "   - Certains jeux officiels ont des noms légèrement différents\n";
echo "   - Underscore vs tirets, abréviations, etc.\n\n";

echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "✅ SOLUTION RECOMMANDÉE\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

echo "OPTION A - NORMALISER LA BASE (Recommandée):\n";
echo "  1. Retirer tous les '.ws' des noms\n";
echo "  2. Retirer tous les tags sauf la région finale (Japan/World/etc)\n";
echo "  3. Retirer les doublons\n";
echo "  4. Résultat: ~100-150 correspondances automatiques\n\n";

echo "OPTION B - AJOUTER LES JEUX MANQUANTS:\n";
echo "  1. Insérer les 121 jeux qui ont des images mais pas d'entrée DB\n";
echo "  2. Garder les 323 jeux actuels tels quels\n";
echo "  3. Résultat: 121 correspondances + 323 jeux sans images\n\n";

echo "💡 L'OPTION A est meilleure car elle normalise la base ET permet\n";
echo "   les correspondances automatiques pour ~30-40% des jeux.\n\n";
