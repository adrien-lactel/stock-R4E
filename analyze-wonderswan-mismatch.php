<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║              ANALYSE DÉTAILLÉE: PROBLÈME WONDERSWAN                        ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Récupérer tous les jeux WonderSwan
$games = DB::table('wonderswan_games')
    ->select('id', 'rom_id', 'name')
    ->orderBy('name')
    ->get();

echo "📊 JEUX EN BASE DE DONNÉES: " . count($games) . "\n\n";

// Afficher les 20 premiers jeux pour voir le format des noms
echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "📋 ÉCHANTILLON DE LA BASE (20 premiers jeux):\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

foreach ($games->take(20) as $game) {
    echo "  ID: {$game->id}\n";
    echo "  ROM ID: " . ($game->rom_id ?: '(null)') . "\n";
    echo "  NAME: {$game->name}\n";
    echo "  " . str_repeat('-', 76) . "\n";
}

// Lister les fichiers images
$imageFolder = 'public/images/taxonomy/wonderswan';
if (!file_exists($imageFolder)) {
    echo "❌ Dossier '{$imageFolder}' introuvable!\n";
    exit;
}

$allImages = glob($imageFolder . '/*.{png,jpg,jpeg}', GLOB_BRACE);
echo "\n📁 FICHIERS IMAGES: " . count($allImages) . "\n\n";

echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "🖼️  ÉCHANTILLON DES IMAGES (20 premiers fichiers):\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

// Extraire les identifiants des images
$imageIdentifiers = [];
foreach (array_slice($allImages, 0, 20) as $imagePath) {
    $filename = basename($imagePath);
    echo "  $filename\n";
    
    // Extraire l'identifiant (tout avant -cover/-logo/-artwork/etc)
    if (preg_match('/^(.+?)-(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
        $identifier = trim($matches[1]);
        // Nettoyer les infos de région
        $cleanIdentifier = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $identifier);
        echo "    → Identifiant extrait: '$identifier'\n";
        echo "    → Identifiant nettoyé: '$cleanIdentifier'\n";
        
        if (!isset($imageIdentifiers[$cleanIdentifier])) {
            $imageIdentifiers[$cleanIdentifier] = 0;
        }
        $imageIdentifiers[$cleanIdentifier]++;
    }
    echo "\n";
}

echo "\n══════════════════════════════════════════════════════════════════════════════\n";
echo "🔍 ANALYSE DES DIFFÉRENCES\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

// Comparer quelques jeux de la DB avec les identifiants trouvés
echo "Tentative de correspondance entre DB et Images:\n\n";

foreach ($games->take(10) as $game) {
    echo "DB: '{$game->name}'\n";
    
    // Chercher des correspondances approximatives
    $found = false;
    foreach ($imageIdentifiers as $imgIdentifier => $count) {
        // Comparaison exacte
        if (strcasecmp($game->name, $imgIdentifier) === 0) {
            echo "  ✅ MATCH EXACT: '$imgIdentifier'\n";
            $found = true;
            break;
        }
        
        // Comparaison partielle
        if (stripos($imgIdentifier, $game->name) !== false || stripos($game->name, $imgIdentifier) !== false) {
            echo "  🔶 MATCH PARTIEL: '$imgIdentifier'\n";
            $found = true;
        }
    }
    
    if (!$found) {
        echo "  ❌ AUCUNE CORRESPONDANCE\n";
    }
    echo "\n";
}

// Analyser les patterns dans les noms de la DB
echo "\n══════════════════════════════════════════════════════════════════════════════\n";
echo "📊 PATTERNS DÉTECTÉS DANS LA BASE\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

$wsPatterns = 0;
$regionPatterns = 0;
$nullRomIds = 0;
$hasRomIds = 0;

foreach ($games as $game) {
    if (stripos($game->name, '.ws') !== false) {
        $wsPatterns++;
    }
    if (preg_match('/\((Japan|USA|Europe|World|En,Ja|prototype)\)/i', $game->name)) {
        $regionPatterns++;
    }
    if (empty($game->rom_id)) {
        $nullRomIds++;
    } else {
        $hasRomIds++;
    }
}

echo "  • Jeux avec '.ws' dans le nom: $wsPatterns\n";
echo "  • Jeux avec infos de région entre parenthèses: $regionPatterns\n";
echo "  • Jeux SANS ROM ID (null): $nullRomIds\n";
echo "  • Jeux AVEC ROM ID: $hasRomIds\n";

// Suggestions de normalisation
echo "\n══════════════════════════════════════════════════════════════════════════════\n";
echo "💡 SUGGESTIONS DE NORMALISATION\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

echo "PROBLÈMES IDENTIFIÉS:\n\n";

if ($wsPatterns > 0) {
    echo "  1. Extension '.ws' présente dans $wsPatterns noms de jeux en base\n";
    echo "     → Les fichiers images n'ont pas cette extension\n";
    echo "     → Solution: Retirer '.ws' des noms en base\n\n";
}

if ($regionPatterns > 0) {
    echo "  2. Infos de région dans $regionPatterns noms en base\n";
    echo "     → Les fichiers images ont aussi des régions mais peut-être différentes\n";
    echo "     → Solution: Normaliser les formats de région\n\n";
}

echo "  3. La base utilise 'name' comme identifiant (use_rom_id = false)\n";
echo "     → Les noms doivent correspondre EXACTEMENT aux préfixes des images\n";
echo "     → Différence de casse, espaces, ou caractères spéciaux = pas de match\n\n";

// Tester une normalisation sur quelques exemples
echo "\n══════════════════════════════════════════════════════════════════════════════\n";
echo "🧪 TEST DE NORMALISATION (10 premiers jeux)\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

foreach ($games->take(10) as $game) {
    $original = $game->name;
    $normalized = $original;
    
    // Retirer .ws
    $normalized = str_replace('.ws', '', $normalized);
    
    // Retirer les infos de région entre parenthèses à la fin
    $normalized = preg_replace('/\s*\((Japan|USA|Europe|World|En,Ja|prototype)\)\s*$/i', '', $normalized);
    
    // Trim
    $normalized = trim($normalized);
    
    echo "  AVANT: '$original'\n";
    echo "  APRÈS: '$normalized'\n";
    
    // Chercher une correspondance avec ce nom normalisé
    $matchFound = false;
    foreach ($imageIdentifiers as $imgIdentifier => $count) {
        if (strcasecmp($normalized, $imgIdentifier) === 0) {
            echo "  ✅ MATCH AVEC: '$imgIdentifier'\n";
            $matchFound = true;
            break;
        }
    }
    if (!$matchFound) {
        echo "  ❌ Toujours pas de match\n";
    }
    echo "\n";
}
