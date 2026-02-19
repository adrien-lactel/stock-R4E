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
    echo "║      ANALYSE FINE - 69 IMAGES MANQUANTES (GAME GEAR)                        ║\n";
    echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

    // Récupérer tous les ROM_ID et NAME
    $stmt = $pdo->query("SELECT DISTINCT name, ROM_ID FROM game_gear_games ORDER BY ROM_ID");
    $games = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $games[] = ['name' => $row['name'], 'romid' => $row['ROM_ID']];
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

    // Trouver les images sans correspondance
    $romIds = array_column($games, 'romid');
    $missing = [];
    foreach ($imagesByBase as $imageId => $files) {
        if (!in_array($imageId, $romIds)) {
            $missing[$imageId] = $files;
        }
    }

    echo "📊 Total images manquantes: " . count($missing) . "\n\n";

    // Catégoriser
    $toRename = [];  // Images à renommer pour correspondre à un ROM_ID existant
    $toAdd = [];     // Nouveaux jeux à ajouter en base

    foreach ($missing as $imageId => $files) {
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
            $toRename[$imageId] = [
                'files' => $files,
                'target' => $bestMatch,
                'similarity' => round($bestSimilarity, 1)
            ];
        } else {
            $toAdd[$imageId] = $files;
        }
    }

    echo "🔄 À RENOMMER (≥90% similaires): " . count($toRename) . "\n";
    echo "➕ À AJOUTER EN BASE (<90%): " . count($toAdd) . "\n\n";

    if (count($toRename) > 0) {
        echo "🔄 IMAGES À RENOMMER:\n";
        echo "════════════════════════════════════════════════════════════════════════════════\n\n";
        
        $count = 1;
        foreach ($toRename as $imageId => $info) {
            echo sprintf("%2d. %s (%.1f%%)\n", $count, $imageId, $info['similarity']);
            echo "    → {$info['target']}\n";
            echo "    Fichiers: " . count($info['files']) . "\n\n";
            $count++;
        }
    }

    if (count($toAdd) > 0) {
        echo "\n➕ NOUVEAUX JEUX À AJOUTER:\n";
        echo "════════════════════════════════════════════════════════════════════════════════\n\n";
        
        $count = 1;
        foreach ($toAdd as $imageId => $files) {
            echo sprintf("%2d. %s\n", $count, $imageId);
            echo "    Fichiers: " . count($files) . "\n\n";
            $count++;
        }
    }

    // Générer scripts
    if (count($toRename) > 0) {
        $script = "<?php\n\n";
        $script .= "\$imageDir = __DIR__ . '/public/images/taxonomy/gamegear';\n";
        $script .= "\$renamed = 0;\n\n";

        foreach ($toRename as $imageId => $info) {
            foreach ($info['files'] as $file) {
                preg_match('/(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $file, $m);
                $type = $m[1];
                $ext = $m[2];
                $newFile = $info['target'] . '-' . $type . '.' . $ext;
                
                $fileEsc = addslashes($file);
                $newFileEsc = addslashes($newFile);
                
                $script .= "if (file_exists(\$imageDir.'/$fileEsc') && !file_exists(\$imageDir.'/$newFileEsc')) {\n";
                $script .= "    rename(\$imageDir.'/$fileEsc', \$imageDir.'/$newFileEsc');\n";
                $script .= "    echo \"✓ $fileEsc\\n\";  \$renamed++;\n";
                $script .= "}\n";
            }
        }
        
        $script .= "\necho \"\\n✅ Renommés: \$renamed\\n\";\n";
        
        file_put_contents('fix-game-gear-final-images.php', $script);
        echo "✅ Script renommage: fix-game-gear-final-images.php\n";
    }

    if (count($toAdd) > 0) {
        $sql = "-- Nouveaux jeux Game Gear à ajouter\n\n";
        foreach ($toAdd as $imageId => $files) {
            $nameEsc = str_replace("'", "''", $imageId);
            $sql .= "INSERT INTO game_gear_games (name, ROM_ID) VALUES ('$nameEsc', '$nameEsc');\n";
        }
        file_put_contents('add-new-game-gear-games.sql', $sql);
        echo "✅ Script insertion: add-new-game-gear-games.sql\n\n";
    }

} catch (PDOException $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
    exit(1);
}
