<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║       DIAGNOSTIC FINAL - POURQUOI 4 JEUX NE MATCHENT PAS?                 ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Les 4 jeux problématiques selon le script
$problemGames = [
    'Digimon Adventure - Anode Tamer (Japan)',
    'Digimon Adventure 02 - Tag Tamers (Japan)',
    'Harobots (Japan)',
    'Super Robot Taisen Compact (Japan)'
];

// Chercher les images correspondantes
$imageFolder = 'public/images/taxonomy/wonderswan';
$allImages = glob($imageFolder . '/*.{png,jpg,jpeg}', GLOB_BRACE);

echo "📁 Images trouvées: " . count($allImages) . "\n\n";

foreach ($problemGames as $gameName) {
    echo "══════════════════════════════════════════════════════════════════════════════\n";
    echo "🎮 JEU: {$gameName}\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    
    // Vérifier en base
    $dbGame = DB::table('wonderswan_games')
        ->where('name', $gameName)
        ->first();
    
   if ($dbGame) {
        echo "✓ EXISTE EN BASE:\n";
        echo "  ID: {$dbGame->id}\n";
        echo "  Nom: {$dbGame->name}\n\n";
    } else {
        echo "❌ PAS EN BASE\n\n";
    }
    
    // Chercher les images qui correspondraient
    echo "🖼️  IMAGES CORRESPONDANTES:\n";
    $found = false;
    
    foreach ($allImages as $imagePath) {
        $filename = basename($imagePath);
        
        // Vérifier si le nom du jeu est dans le nom du fichier
        if (stripos($filename, $gameName) !== false || 
            stripos($filename, str_replace(' (Japan)', '', $gameName)) !== false) {
            echo "  • {$filename}\n";
            $found = true;
        }
    }
    
    if (!$found) {
        echo "  Aucune image trouvée avec ce nom exact\n";
        echo "\n  Recherche avec début du nom...\n";
        
        // Essayer juste le début du nom
        $shortName = explode(' -', $gameName)[0];
        echo "  Recherche: '{$shortName}'\n";
        
        foreach ($allImages as $imagePath) {
            $filename = basename($imagePath);
            if (stripos($filename, $shortName) === 0) {
                echo "    • {$filename}\n";
                $found = true;
            }
        }
    }
    
    echo "\n";
}

// Vérifier comment le script extrait les identifiants
echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "🔍 EXTRACTION DES IDENTIFIANTS DES IMAGES\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

$extractedIdentifiers = [];

foreach ($allImages as $imagePath) {
    $filename = basename($imagePath);
    
    if (preg_match('/^(.+?)-(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
        $identifier = trim($matches[1]);
        
        // Nettoyer la région (comme dans le script de vérification)
        $cleanIdentifier = preg_replace('/\s*\((USA|Europe|Japan|World|Hong Kong|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $identifier);
        
        // Chercher si c'est un des jeux problématiques
        foreach ($problemGames as $gameName) {
            if (stripos($identifier, $gameName) !== false || stripos($cleanIdentifier, $gameName) !== false) {
                echo "Fichier: {$filename}\n";
                echo "  → Identifiant brut: '{$identifier}'\n";
                echo "  → Identifiant nettoyé: '{$cleanIdentifier}'\n";
                echo "  → Cherche en base: '{$cleanIdentifier}'\n";
                
                // Vérifier si ce nom exact existe
                $exists = DB::table('wonderswan_games')
                    ->where('name', $cleanIdentifier)
                    ->exists();
                
                echo "  → Existe en base: " . ($exists ? "✅ OUI" : "❌ NON") . "\n\n";
            }
        }
    }
}
