<?php

require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

try {
    $pdo = new PDO(
        "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_DATABASE']};charset=utf8mb4",
        $_ENV['DB_USERNAME'],
        $_ENV['DB_PASSWORD'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );

    echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
    echo "║          ANALYSE FINE - 44 IMAGES \"MANQUANTES\" (GAME GEAR)                  ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Récupérer tous les ROM_ID
    $stmt = $pdo->query("SELECT DISTINCT ROM_ID FROM game_gear_games WHERE ROM_ID IS NOT NULL AND ROM_ID != '' ORDER BY ROM_ID");
    $romIds = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $romIds[] = $row['ROM_ID'];
    }

    // Scanner les images
    $imageDir = __DIR__ . '/public/images/taxonomy/gamegear';
    $images = glob($imageDir . '/*.{png,jpg,jpeg}', GLOB_BRACE);
    
    $imagesByBase = [];
    foreach ($images as $imagePath) {
        $filename = basename($imagePath);
        
        // Extraire l'identifiant de base
        $baseId = preg_replace('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', '', $filename);
        
        if (!isset($imagesByBase[$baseId])) {
            $imagesByBase[$baseId] = [];
        }
        $imagesByBase[$baseId][] = $filename;
    }

    // Trouver les non-correspondances
    $mismatches = [];
    foreach ($imagesByBase as $imageId => $files) {
        if (!in_array($imageId, $romIds)) {
            $mismatches[$imageId] = $files;
        }
    }

    echo "📊 Total identifiants d'images: " . count($imagesByBase) . "\n";
    echo "📊 Identifiants ROM_ID en base: " . count($romIds) . "\n";
    echo "📊 Images sans correspondance exacte: " . count($mismatches) . "\n\n";

    echo "🔍 ANALYSE DES IMAGES \"MANQUANTES\":\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";

    $reallyMissing = [];
    $needRename = [];

    foreach ($mismatches as $imageId => $files) {
        // Chercher une correspondance très proche
        $bestMatch = null;
        $bestSimilarity = 0;
        
        foreach ($romIds as $romId) {
            similar_text(strtolower($imageId), strtolower($romId), $similarity);
            if ($similarity > $bestSimilarity) {
                $bestSimilarity = $similarity;
                $bestMatch = $romId;
            }
        }
        
        if ($bestSimilarity >= 90) {
            $needRename[$imageId] = [
                'files' => $files,
                'match' => $bestMatch,
                'similarity' => round($bestSimilarity, 1)
            ];
        } else if ($bestSimilarity >= 70) {
            // Peut-être un vrai match mais moins sûr
            $needRename[$imageId] = [
                'files' => $files,
                'match' => $bestMatch,
                'similarity' => round($bestSimilarity, 1)
            ];
        } else {
            $reallyMissing[$imageId] = $files;
        }
    }

    echo "📊 RÉSULTATS:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    echo "   🔄 À renommer (≥70% similaire): " . count($needRename) . "\n";
    echo "   ➕ Vraiment manquants (<70%): " . count($reallyMissing) . "\n\n";

    if (count($needRename) > 0) {
        echo "🔄 IMAGES À RENOMMER:\n";
        echo "════════════════════════════════════════════════════════════════════════════════\n\n";
        
        $count = 0;
        foreach ($needRename as $imageId => $info) {
            $count++;
            echo sprintf("%2d. %s (%.1f%% similaire)\n", $count, $imageId, $info['similarity']);
            echo "    → ROM_ID: {$info['match']}\n";
            echo "    Fichiers: " . count($info['files']) . "\n\n";
        }
    }

    if (count($reallyMissing) > 0) {
        echo "\n➕ IMAGES VRAIMENT MANQUANTES EN BASE:\n";
        echo "════════════════════════════════════════════════════════════════════════════════\n\n";
        
        foreach ($reallyMissing as $imageId => $files) {
            echo "   • $imageId\n";
            echo "     Fichiers: " . count($files) . "\n\n";
        }
    }

    // Générer script de renommage si nécessaire
    if (count($needRename) > 0) {
        echo "\n🚀 GÉNÉRATION DU SCRIPT DE RENOMMAGE...\n";
        
        $script = "<?php\n\n";
        $script .= "echo \"╔══════════════════════════════════════════════════════════════════════════════╗\\n\";\n";
        $script .= "echo \"║        RENOMMAGE FINAL - GAME GEAR IMAGES → ROM_ID                          ║\\n\";\n";
        $script .= "echo \"╚══════════════════════════════════════════════════════════════════════════════╝\\n\\n\";\n\n";
        $script .= "\$imageDir = __DIR__ . '/public/images/taxonomy/gamegear';\n";
        $script .= "\$renamed = 0;\n";
        $script .= "\$skipped = 0;\n\n";

        foreach ($needRename as $imageId => $info) {
            $targetId = $info['match'];
            
            foreach ($info['files'] as $file) {
                preg_match('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $file, $matches);
                $type = $matches[1];
                $ext = $matches[2];
                
                $newFile = $targetId . '-' . $type . '.' . $ext;
                
                $fileEscaped = addslashes($file);
                $newFileEscaped = addslashes($newFile);
                
                $script .= "// $imageId → $targetId\n";
                $script .= "if (file_exists(\$imageDir . '/$fileEscaped')) {\n";
                $script .= "    if (!file_exists(\$imageDir . '/$newFileEscaped')) {\n";
                $script .= "        if (rename(\$imageDir . '/$fileEscaped', \$imageDir . '/$newFileEscaped')) {\n";
                $script .= "            echo \"✓ $fileEscaped\\n\";\n";
                $script .= "            \$renamed++;\n";
                $script .= "        }\n";
                $script .= "    } else {\n";
                $script .= "        echo \"⚠️ EXISTE: $newFileEscaped\\n\";\n";
                $script .= "        \$skipped++;\n";
                $script .= "    }\n";
                $script .= "}\n\n";
            }
        }

        $script .= "echo \"\\n═══════════════════════════════════════════════════════════════════════════════\\n\";\n";
        $script .= "echo \"✅ Renommés: \$renamed | ⚠️ Ignorés: \$skipped\\n\";\n";
        $script .= "echo \"═══════════════════════════════════════════════════════════════════════════════\\n\";\n";

        file_put_contents('fix-game-gear-final-rename.php', $script);
        
        echo "✅ Script généré: fix-game-gear-final-rename.php\n";
        echo "🚀 Pour exécuter: php fix-game-gear-final-rename.php\n\n";
    }

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
