<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("ANALYSE DÉTAILLÉE - GAME GEAR", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

$imageFolder = 'public/images/taxonomy/gamegear';

if (!file_exists($imageFolder)) {
    echo "❌ Dossier d'images introuvable: {$imageFolder}\n";
    exit(1);
}

// Récupérer les jeux en base
$gamesInDb = DB::table('game_gear_games')
    ->select('id', 'rom_id', 'name')
    ->orderBy('name')
    ->get();

echo "📊 Jeux en base: " . count($gamesInDb) . "\n";

// Récupérer les images
$allImages = glob($imageFolder . '/*.{png,jpg,jpeg}', GLOB_BRACE);
echo "📁 Images trouvées: " . count($allImages) . "\n\n";

// Extraire les identifiants uniques des images
$imageIdentifiers = [];
foreach ($allImages as $imagePath) {
    $filename = basename($imagePath);
    
    // Format: Nom (Region)-type.png
    if (preg_match('/^(.+?)-(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
        $identifier = trim($matches[1]);
        
        // Nettoyer les régions
        $cleanIdentifier = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $identifier);
        $cleanIdentifier = trim($cleanIdentifier);
        
        if (!isset($imageIdentifiers[$cleanIdentifier])) {
            $imageIdentifiers[$cleanIdentifier] = [
                'files' => [],
                'raw_identifiers' => []
            ];
        }
        $imageIdentifiers[$cleanIdentifier]['files'][] = $filename;
        if (!in_array($identifier, $imageIdentifiers[$cleanIdentifier]['raw_identifiers'])) {
            $imageIdentifiers[$cleanIdentifier]['raw_identifiers'][] = $identifier;
        }
    }
}

echo "🔍 Identifiants uniques (noms de jeux): " . count($imageIdentifiers) . "\n\n";

// Indexer les jeux par nom nettoyé
$dbIndex = [];
foreach ($gamesInDb as $game) {
    $cleanName = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $game->name);
    $cleanName = trim($cleanName);
    
    if (!isset($dbIndex[$cleanName])) {
        $dbIndex[$cleanName] = [];
    }
    $dbIndex[$cleanName][] = $game;
}

// Analyser les différences
$imagesWithoutDb = [];
$perfectMatches = 0;

foreach ($imageIdentifiers as $identifier => $data) {
    if (isset($dbIndex[$identifier])) {
        $perfectMatches++;
    } else {
        $imagesWithoutDb[] = $identifier;
    }
}

echo "✅ Correspondances parfaites: {$perfectMatches}\n";
echo "📷 Images sans entrée en base: " . count($imagesWithoutDb) . "\n\n";

// Analyser les 94 jeux à ajouter
echo str_repeat("═", 80) . "\n";
echo "📋 JEUX À AJOUTER (94 premiers)\n";
echo str_repeat("─", 80) . "\n\n";

$count = 0;
foreach ($imagesWithoutDb as $identifier) {
    if ($count >= 20) {
        echo "... et " . (count($imagesWithoutDb) - 20) . " autres\n";
        break;
    }
    
    echo ($count + 1) . ". '{$identifier}'\n";
    echo "   Exemples d'images:\n";
    
    $examples = array_slice($imageIdentifiers[$identifier]['files'], 0, 3);
    foreach ($examples as $file) {
        echo "      • {$file}\n";
    }
    echo "\n";
    
    $count++;
}

// Vérifier s'il y a des patterns de normalisation nécessaires
echo "\n" . str_repeat("═", 80) . "\n";
echo "🔍 ANALYSE DES PATTERNS\n";
echo str_repeat("─", 80) . "\n\n";

// Chercher les jeux en base sans correspondance
$dbWithoutImages = [];
foreach ($dbIndex as $cleanName => $games) {
    if (!isset($imageIdentifiers[$cleanName])) {
        foreach ($games as $game) {
            $dbWithoutImages[] = $game;
        }
    }
}

echo "🗃️  Jeux en base sans images: " . count($dbWithoutImages) . "\n\n";

if (count($dbWithoutImages) > 0) {
    echo "Exemples de jeux sans images (20 premiers):\n";
    $count = 0;
    foreach ($dbWithoutImages as $game) {
        if ($count >= 20) {
            echo "... et " . (count($dbWithoutImages) - 20) . " autres\n";
            break;
        }
        echo ($count + 1) . ". ID {$game->id}: '{$game->name}'\n";
        
        // Chercher des matchs proches
        $cleanName = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It)[^\)]*\)\s*$/i', '', $game->name);
        $cleanName = trim($cleanName);
        
        $possibleMatches = [];
        foreach ($imageIdentifiers as $imgId => $data) {
            similar_text(strtolower($cleanName), strtolower($imgId), $percent);
            if ($percent > 80) {
                $possibleMatches[] = ['name' => $imgId, 'percent' => $percent];
            }
        }
        
        if (!empty($possibleMatches)) {
            usort($possibleMatches, fn($a, $b) => $b['percent'] <=> $a['percent']);
            echo "   Possibles matchs:\n";
            foreach (array_slice($possibleMatches, 0, 2) as $match) {
                echo "      • '{$match['name']}' (" . round($match['percent'], 1) . "% similarité)\n";
            }
        }
        echo "\n";
        
        $count++;
    }
}

echo "\n" . str_repeat("═", 80) . "\n";
echo "💡 RECOMMANDATIONS\n";
echo str_repeat("─", 80) . "\n\n";

echo "1. Ajouter les " . count($imagesWithoutDb) . " jeux manquants en base\n";
echo "2. Vérifier/corriger les " . count($dbWithoutImages) . " jeux sans images\n";
echo "3. Analyser les causes:\n";
echo "   - Noms différents entre DB et images?\n";
echo "   - Caractères spéciaux différents?\n";
echo "   - Tags de région différents?\n\n";

echo str_repeat("═", 80) . "\n";
