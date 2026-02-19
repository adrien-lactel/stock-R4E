<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("DEBUG - INDEX WONDERSWAN", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

// 1. Récupérer les 4 jeux en base
$problematicGames = [
    'Digimon Adventure - Anode Tamer (Japan)',
    'Digimon Adventure 02 - Tag Tamers (Japan)',
    'Harobots (Japan)',
    'Super Robot Taisen Compact (Japan)'
];

echo "🔍 VÉRIFICATION DES NOMS EN BASE\n";
echo str_repeat("─", 80) . "\n\n";

foreach ($problematicGames as $gameName) {
    $game = DB::table('wonderswan_games')
        ->where('name', $gameName)
        ->first();
    
    if ($game) {
        echo "✅ Trouvé: {$gameName}\n";
        echo "   ID: {$game->id}\n";
        echo "   Nom stocké: '{$game->name}'\n";
        
        // Appliquer le nettoyage de la regex
        $cleanName = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $game->name);
        $cleanName = trim($cleanName);
        
        echo "   Nom nettoyé pour index: '{$cleanName}'\n";
        echo "   Type de variable: " . gettype($cleanName) . "\n";
        echo "   Longueur: " . strlen($cleanName) . "\n";
        echo "   Bytes: ";
        for ($i = 0; $i < strlen($cleanName); $i++) {
            echo ord($cleanName[$i]) . " ";
        }
        echo "\n\n";
    } else {
        echo "❌ Non trouvé: {$gameName}\n\n";
    }
}

// 2. Récupérer les images correspondantes
echo "\n" . str_repeat("═", 80) . "\n";
echo "🖼️  VÉRIFICATION DES IDENTIFIANTS IMAGES\n";
echo str_repeat("─", 80) . "\n\n";

$imageFolder = 'public/images/taxonomy/wonderswan';
$testImages = [
    'Digimon Adventure - Anode Tamer (Japan)-artwork.png',
    'Digimon Adventure 02 - Tag Tamers (Japan)-cover.png',
    'Harobots (Japan)-cover.png',
    'Super Robot Taisen Compact (Japan)-cover.png'
];

foreach ($testImages as $filename) {
    $fullPath = $imageFolder . '/' . $filename;
    
    if (file_exists($fullPath)) {
        echo "✅ Fichier existe: {$filename}\n";
        
        // Extraire l'identifiant
        if (preg_match('/^(.+?)-(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
            $identifier = trim($matches[1]);
            echo "   Identifiant brut: '{$identifier}'\n";
            
            // Nettoyer l'identifiant
            $cleanIdentifier = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $identifier);
            $cleanIdentifier = trim($cleanIdentifier);
            
            echo "   Identifiant nettoyé: '{$cleanIdentifier}'\n";
            echo "   Type de variable: " . gettype($cleanIdentifier) . "\n";
            echo "   Longueur: " . strlen($cleanIdentifier) . "\n";
            echo "   Bytes: ";
            for ($i = 0; $i < strlen($cleanIdentifier); $i++) {
                echo ord($cleanIdentifier[$i]) . " ";
            }
            echo "\n\n";
        } else {
            echo "   ❌ Pattern non reconnu\n\n";
        }
    } else {
        echo "❌ Fichier n'existe pas: {$filename}\n\n";
    }
}

// 3. Construire l'index comme le fait le script de vérification
echo "\n" . str_repeat("═", 80) . "\n";
echo "📊 CONSTRUCTION DE L'INDEX DB (comme verify script)\n";
echo str_repeat("─", 80) . "\n\n";

$gamesInDb = DB::table('wonderswan_games')->select('id', 'rom_id', 'name')->get();
$dbIndex = [];

foreach ($gamesInDb as $game) {
    $cleanName = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $game->name);
    $cleanName = trim($cleanName);
    $dbIndex[$cleanName] = $game;
}

echo "Taille de l'index: " . count($dbIndex) . " entrées\n\n";

// Afficher les entrées qui commencent par "Digimon" ou "Harobots" ou "Super Robot"
echo "Entrées dans l'index qui nous intéressent:\n";
foreach ($dbIndex as $key => $game) {
    if (str_starts_with($key, 'Digimon') || str_starts_with($key, 'Harobots') || str_starts_with($key, 'Super Robot Taisen Compact')) {
        echo "  • '{$key}' => ID {$game->id} (nom original: '{$game->name}')\n";
    }
}

// 4. Tester les correspondances
echo "\n" . str_repeat("═", 80) . "\n";
echo "🔬 TEST DE CORRESPONDANCE\n";
echo str_repeat("─", 80) . "\n\n";

$testIdentifiers = [
    'Digimon Adventure - Anode Tamer',
    'Digimon Adventure 02 - Tag Tamers',
    'Harobots',
    'Super Robot Taisen Compact'
];

foreach ($testIdentifiers as $identifier) {
    echo "Test: '{$identifier}'\n";
    
    if (isset($dbIndex[$identifier])) {
        echo "  ✅ MATCH! ID: {$dbIndex[$identifier]->id}, Nom: {$dbIndex[$identifier]->name}\n";
    } else {
        echo "  ❌ PAS DE MATCH dans l'index\n";
        
        // Chercher des clés similaires
        echo "  Clés similaires dans l'index:\n";
        foreach ($dbIndex as $key => $game) {
            similar_text($identifier, $key, $percent);
            if ($percent > 80) {
                echo "    • '{$key}' (similarité: " . round($percent, 2) . "%)\n";
            }
        }
    }
    echo "\n";
}

echo str_repeat("═", 80) . "\n";
