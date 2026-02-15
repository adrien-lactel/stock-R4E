<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== ANALYSE DES ROM IDS SNES ET IMAGES ===\n\n";

// 1. Vérifier les ROM IDs dans la table snes_games
echo "📋 ROM IDs SNES en base de données:\n";
$snesGames = DB::table('snes_games')
    ->whereNotNull('rom_id')
    ->orderBy('rom_id')
    ->take(20)
    ->get(['id', 'rom_id', 'name']);

foreach ($snesGames as $game) {
    echo "  {$game->id}: {$game->rom_id} - {$game->name}\n";
}

// 2. Vérifier les fichiers images locaux pour SNES  
echo "\n📁 Fichiers images locaux dans public/images/taxonomy/snes:\n";
$snesImagesPath = public_path('images/taxonomy/snes');
if (file_exists($snesImagesPath)) {
    $files = scandir($snesImagesPath);
    $imageFiles = array_filter($files, function($f) {
        return !in_array($f, ['.', '..']) && preg_match('/\.(png|jpg|jpeg)$/i', $f);
    });
    
    $count = 0;
    foreach ($imageFiles as $file) {
        if ($count < 20) {
            echo "  $file\n";
        }
        $count++;
    }
    echo "  ... Total: $count fichiers\n";
} else {
    echo "  ❌ Dossier n'existe pas\n";
}

// 3. Vérifier les fichiers sur R2
echo "\n☁️ Fichiers images sur R2 dans taxonomy/snes:\n";
try {
    $r2Files = Storage::disk('r2')->files('taxonomy/snes');
    $count = 0;
    foreach ($r2Files as $file) {
        if ($count < 20) {
            $basename = basename($file);
            echo "  $basename\n";
        }
        $count++;
    }
    echo "  ... Total: $count fichiers\n";
} catch (Exception $e) {
    echo "  ❌ Erreur: " . $e->getMessage() . "\n";
}

// 4. Analyser les patterns de nommage
echo "\n🔍 Analyse des patterns de nommage:\n";
if (isset($r2Files)) {
    $patterns = [];
    foreach ($r2Files as $file) {
        $basename = basename($file);
        // Extraire le pattern (ex: SHVC-*, SNS-*, etc.)
        if (preg_match('/^([A-Z]+-[A-Z0-9]+)-/', $basename, $matches)) {
            $romIdPart = $matches[1];
            if (!isset($patterns[$romIdPart])) {
                $patterns[$romIdPart] = 0;
            }
            $patterns[$romIdPart]++;
        } elseif (preg_match('/^([^-]+)-/', $basename, $matches)) {
            $prefix = $matches[1];
            if (!isset($patterns[$prefix])) {
                $patterns[$prefix] = 0;
            }
            $patterns[$prefix]++;
        }
    }
    
    arsort($patterns);
    $shown = 0;
    foreach ($patterns as $pattern => $count) {
        if ($shown < 15) {
            echo "  $pattern: $count fichiers\n";
        }
        $shown++;
    }
}

// 5. Comparer un ROM ID spécifique avec les fichiers
echo "\n🔍 Test de correspondance pour un ROM ID spécifique:\n";
if (count($snesGames) > 0) {
    $testGame = $snesGames[0];
    echo "  ROM ID: {$testGame->rom_id}\n";
    echo "  Nom: {$testGame->name}\n";
    
    // Chercher les fichiers correspondants
    $identifier = $testGame->rom_id;
    $found = [];
    
    if (isset($r2Files)) {
        foreach ($r2Files as $file) {
            $basename = basename($file);
            if (stripos($basename, $identifier) === 0) {
                $found[] = $basename;
            }
        }
    }
    
    if (count($found) > 0) {
        echo "  ✅ Fichiers trouvés sur R2:\n";
        foreach ($found as $f) {
            echo "    - $f\n";
        }
    } else {
        echo "  ❌ Aucun fichier trouvé avec le ROM ID $identifier\n";
        echo "  🔍 Recherche de fichiers similaires...\n";
        
        // Chercher des fichiers avec des noms similaires
        if (isset($r2Files)) {
            $similar = [];
            foreach ($r2Files as $file) {
                $basename = basename($file);
                // Enlever les préfixes et comparer les noms de jeux
                $gameName = strtolower(preg_replace('/[^a-z0-9]/i', '', $testGame->name));
                $fileName = strtolower(preg_replace('/[^a-z0-9]/i', '', $basename));
                
                if (strlen($gameName) > 5 && stripos($fileName, substr($gameName, 0, 10)) !== false) {
                    $similar[] = $basename;
                }
            }
            
            if (count($similar) > 0) {
                echo "  Fichiers potentiellement similaires:\n";
                foreach (array_slice($similar, 0, 5) as $s) {
                    echo "    - $s\n";
                }
            }
        }
    }
}

echo "\n=== FIN DE L'ANALYSE ===\n";
