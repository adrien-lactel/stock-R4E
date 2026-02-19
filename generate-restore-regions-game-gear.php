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
    echo "║         RESTAURATION RÉGIONS - GAME GEAR IMAGES                             ║\n";
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
        $baseId = preg_replace('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', '', $filename);
        
        if (!isset($imagesByBase[$baseId])) {
            $imagesByBase[$baseId] = [];
        }
        $imagesByBase[$baseId][] = $filename;
    }

    // Trouver les correspondances à restaurer
    $toRestore = [];
    $alreadyMatched = 0;
    $noMatch = 0;

    foreach ($imagesByBase as $imageId => $files) {
        // Vérifier correspondance exacte
        if (in_array($imageId, $romIds)) {
            $alreadyMatched++;
            continue;
        }
        
        // Chercher un ROM_ID qui commence par l'ID image
        $matches = array_filter($romIds, function($romId) use ($imageId) {
            // Le ROM_ID doit commencer exactement par l'ID image
            return stripos($romId, $imageId) === 0 && 
                   (strlen($romId) === strlen($imageId) || 
                    $romId[strlen($imageId)] === ' ' || 
                    $romId[strlen($imageId)] === '(');
        });
        
        if (count($matches) === 1) {
            // Une seule correspondance = renommage sûr
            $toRestore[$imageId] = [
                'files' => $files,
                'target' => reset($matches),
                'confidence' => 'high'
            ];
        } elseif (count($matches) > 1) {
            // Plusieurs correspondances = prendre la première (ou la plus courte)
            $shortest = null;
            foreach ($matches as $match) {
                if ($shortest === null || strlen($match) < strlen($shortest)) {
                    $shortest = $match;
                }
            }
            $toRestore[$imageId] = [
                'files' => $files,
                'target' => $shortest,
                'confidence' => 'medium',
                'alternatives' => array_values($matches)
            ];
        } else {
            $noMatch++;
        }
    }

    echo "📊 STATISTIQUES:\n";
    echo "════════════════════════════════════════════════════════════════════════════════\n\n";
    echo "   ✅ Correspondance exacte: $alreadyMatched\n";
    echo "   🔄 À restaurer: " . count($toRestore) . "\n";
    echo "   ❌ Sans correspondance: $noMatch\n\n";

    if (count($toRestore) > 0) {
        echo "🔄 GÉNÉRATION DU SCRIPT DE RESTAURATION...\n\n";
        
        $script = "<?php\n\n";
        $script .= "echo \"╔══════════════════════════════════════════════════════════════════════════════╗\\n\";\n";
        $script .= "echo \"║        RESTAURATION RÉGIONS - GAME GEAR IMAGES                               ║\\n\";\n";
        $script .= "echo \"╚══════════════════════════════════════════════════════════════════════════════╝\\n\\n\";\n\n";
        $script .= "\$imageDir = __DIR__ . '/public/images/taxonomy/gamegear';\n";
        $script .= "\$renamed = 0;\n";
        $script .= "\$skipped = 0;\n\n";

        $count = 0;
        foreach ($toRestore as $currentId => $info) {
            $targetId = $info['target'];
            
            foreach ($info['files'] as $file) {
                preg_match('/-?(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $file, $matches);
                $type = $matches[1];
                $ext = $matches[2];
                
                $newFile = $targetId . '-' . $type . '.' . $ext;
                
                $fileEscaped = addslashes($file);
                $newFileEscaped = addslashes($newFile);
                
                $script .= "// $currentId → $targetId\n";
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
            
            $count++;
            if ($count <= 10) {
                echo sprintf("%2d. %s\n", $count, $currentId);
                echo "    → $targetId\n";
                if ($info['confidence'] === 'medium') {
                    echo "    ⚠️  Plusieurs ROM_ID possibles, choix: le plus court\n";
                }
                echo "\n";
            }
        }

        if ($count > 10) {
            echo "   ... et " . ($count - 10) . " autres\n\n";
        }

        $script .= "echo \"\\n═══════════════════════════════════════════════════════════════════════════════\\n\";\n";
        $script .= "echo \"✅ Renommés: \$renamed | ⚠️ Ignorés: \$skipped\\n\";\n";
        $script .= "echo \"═══════════════════════════════════════════════════════════════════════════════\\n\";\n";

        file_put_contents('restore-regions-game-gear-images.php', $script);

        echo "✅ Script généré: restore-regions-game-gear-images.php\n";
        echo "🚀 Pour exécuter: php restore-regions-game-gear-images.php\n\n";
    }

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
