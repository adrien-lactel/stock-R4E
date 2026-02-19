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
    echo "║             MAPPING IMAGES → ROM_ID (GAME GEAR)                              ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Récupérer tous les ROM_ID
    $stmt = $pdo->query("SELECT ROM_ID, name FROM game_gear_games WHERE ROM_ID IS NOT NULL ORDER BY ROM_ID");
    $romIds = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $romId = $row['ROM_ID'];
        if (!isset($romIds[$romId])) {
            $romIds[$romId] = [];
        }
        $romIds[$romId][] = $row['name'];
    }

    // Scanner les images
    $imageDir = __DIR__ . '/public/images/taxonomy/gamegear';
    $images = glob($imageDir . '/*.{png,jpg,jpeg}', GLOB_BRACE);
    
    $imagesByBase = [];
    foreach ($images as $imagePath) {
        $filename = basename($imagePath);
        
        // Extraire l'identifiant de base (sans type et extension)
        $baseId = preg_replace('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', '', $filename);
        // Enlever la région
        $cleanId = preg_replace('/\s*\([^)]*\)\s*$/', '', $baseId);
        $cleanId = trim($cleanId);
        
        if (!isset($imagesByBase[$cleanId])) {
            $imagesByBase[$cleanId] = [];
        }
        $imagesByBase[$cleanId][] = $filename;
    }

    // Trouver les correspondances et non-correspondances
    $toRename = [];
    $matched = 0;
    $notMatched = 0;

    foreach ($imagesByBase as $imageId => $files) {
        if (isset($romIds[$imageId])) {
            $matched++;
        } else {
            // Chercher une correspondance proche
            $bestMatch = null;
            $bestSimilarity = 0;
            
            foreach ($romIds as $romId => $names) {
                similar_text(strtolower($imageId), strtolower($romId), $similarity);
                if ($similarity > $bestSimilarity) {
                    $bestSimilarity = $similarity;
                    $bestMatch = $romId;
                }
            }
            
            if ($bestSimilarity >= 85) {
                $toRename[$imageId] = [
                    'files' => $files,
                    'target' => $bestMatch,
                    'similarity' => round($bestSimilarity, 1)
                ];
                $notMatched++;
            } else {
                // Vraiment pas de correspondance
                $notMatched++;
            }
        }
    }

    echo "📊 STATISTIQUES:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    echo "   ✓ Correspondances exactes: $matched\n";
    echo "   ⚠ Non-correspondances: $notMatched\n";
    echo "   🔄 À renommer (similarité ≥85%): " . count($toRename) . "\n\n";

    if (count($toRename) > 0) {
        echo "🔄 RENOMMAGES PROPOSÉS:\n";
        echo "════════════════════════════════════════════════════════════════════════════════\n\n";
        
        // Générer le script de renommage
        $phpScript = "<?php\n\n";
        $phpScript .= "// Script de renommage automatique - Game Gear Images → ROM_ID\n";
        $phpScript .= "// Génére automatiquement - Ne PAS modifier manuellement\n\n";
        $phpScript .= "\$imageDir = __DIR__ . '/public/images/taxonomy/gamegear';\n";
        $phpScript .= "\$renamed = 0;\n";
        $phpScript .= "\$skipped = 0;\n";
        $phpScript .= "\$errors = 0;\n\n";

        $count = 0;
        foreach ($toRename as $currentId => $info) {
            $targetId = $info['target'];
            $similarity = $info['similarity'];
            
            if ($count < 20) {
                echo sprintf("   %d. %s (%.1f%% similaire)\n", $count + 1, $currentId, $similarity);
                echo "      → $targetId\n";
                echo "      Fichiers: " . count($info['files']) . "\n\n";
            }
            
            foreach ($info['files'] as $file) {
                // Extraire le type (cover, artwork, etc.)
                preg_match('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $file, $matches);
                $type = $matches[1];
                $ext = $matches[2];
                
                $newFile = $targetId . '-' . $type . '.' . $ext;
                
                // Échapper les apostrophes pour PHP
                $fileEscaped = addslashes($file);
                $newFileEscaped = addslashes($newFile);
                
                $phpScript .= "// {$currentId} → {$targetId}\n";
                $phpScript .= "if (file_exists(\$imageDir . '/{$fileEscaped}')) {\n";
                $phpScript .= "    if (!file_exists(\$imageDir . '/{$newFileEscaped}')) {\n";
                $phpScript .= "        if (rename(\$imageDir . '/{$fileEscaped}', \$imageDir . '/{$newFileEscaped}')) {\n";
                $phpScript .= "            echo \"✓ {$fileEscaped} → {$newFileEscaped}\\n\";\n";
                $phpScript .= "            \$renamed++;\n";
                $phpScript .= "        } else {\n";
                $phpScript .= "            echo \"❌ ERREUR: {$fileEscaped}\\n\";\n";
                $phpScript .= "            \$errors++;\n";
                $phpScript .= "        }\n";
                $phpScript .= "    } else {\n";
                $phpScript .= "        echo \"⚠️ EXISTE DÉJÀ: {$newFileEscaped}\\n\";\n";
                $phpScript .= "        \$skipped++;\n";
                $phpScript .= "    }\n";
                $phpScript .= "}\n\n";
            }
            
            $count++;
        }

        if ($count > 20) {
            echo "   ... et " . ($count - 20) . " autres\n\n";
        }

        $phpScript .= "echo \"\\n\";\n";
        $phpScript .= "echo \"═══════════════════════════════════════════════════════════════════════════════\\n\";\n";
        $phpScript .= "echo \"✅ Renommés: \$renamed fichiers\\n\";\n";
        $phpScript .= "echo \"⚠️ Ignorés: \$skipped fichiers\\n\";\n";
        $phpScript .= "echo \"❌ Erreurs: \$errors fichiers\\n\";\n";
        $phpScript .= "echo \"═══════════════════════════════════════════════════════════════════════════════\\n\";\n";

        file_put_contents('fix-game-gear-images-to-romid.php', $phpScript);

        echo "✅ Script généré: fix-game-gear-images-to-romid.php\n\n";
        echo "🚀 POUR EXÉCUTER:\n";
        echo "   php fix-game-gear-images-to-romid.php\n\n";
    } else {
        echo "✅ Aucun renommage nécessaire!\n\n";
    }

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
