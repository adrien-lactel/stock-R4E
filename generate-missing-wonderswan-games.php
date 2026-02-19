<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║       GÉNÉRATION DES JEUX MANQUANTS - 100% CORRESPONDANCE WONDERSWAN      ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Récupérer tous les jeux existants
$existingGames = DB::table('wonderswan_games')
    ->select('name')
    ->get()
    ->pluck('name')
    ->toArray();

// Créer un index pour recherche rapide
$existingIndex = array_map('strtolower', $existingGames);

// Analyser les images
$imageFolder = 'public/images/taxonomy/wonderswan';
$allImages = glob($imageFolder . '/*.{png,jpg,jpeg}', GLOB_BRACE);

$imageIdentifiers = [];
foreach ($allImages as $imagePath) {
    $filename = basename($imagePath);
    
    if (preg_match('/^(.+?)-(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
        $identifier = trim($matches[1]);
        $type = strtolower($matches[2]);
        
        // Nettoyer la région
        $cleanIdentifier = preg_replace('/\s*\((USA|Europe|Japan|World|Hong Kong|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $identifier);
        
        if (!isset($imageIdentifiers[$cleanIdentifier])) {
            $imageIdentifiers[$cleanIdentifier] = [
                'original' => $identifier,
                'types' => [],
                'files' => []
            ];
        }
        $imageIdentifiers[$cleanIdentifier]['types'][] = $type;
        $imageIdentifiers[$cleanIdentifier]['files'][] = $filename;
    }
}

echo "📊 Images analysées: " . count($allImages) . "\n";
echo "📊 Identifiants uniques: " . count($imageIdentifiers) . "\n";
echo "📊 Jeux en base: " . count($existingGames) . "\n\n";

// Identifier les jeux à ajouter
$toAdd = [];
foreach ($imageIdentifiers as $identifier => $data) {
    // Vérifier si ce jeu existe déjà
    $found = false;
    foreach ($existingIndex as $existingName) {
        if (strtolower($existingName) === strtolower($identifier) || 
            strtolower($existingName) === strtolower($data['original'])) {
            $found = true;
            break;
        }
    }
    
    if (!$found) {
        $toAdd[] = [
            'name' => $data['original'], // Garder le nom original avec région
            'identifier' => $identifier,
            'types' => array_unique($data['types']),
            'file_count' => count($data['files'])
        ];
    }
}

echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "📋 JEUX À AJOUTER\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";
echo "Total: " . count($toAdd) . "\n\n";

// Afficher tous les jeux à ajouter
foreach ($toAdd as $i => $game) {
    echo ($i + 1) . ". {$game['name']}\n";
    echo "   Types: " . implode(', ', $game['types']) . "\n";
    echo "   Fichiers: {$game['file_count']}\n\n";
}

// Générer le SQL
$sqlFile = 'add-missing-wonderswan-games.sql';
$sql = "-- ============================================================================\n";
$sql .= "-- AJOUT DES JEUX WONDERSWAN MANQUANTS - 100% CORRESPONDANCE\n";
$sql .= "-- Généré le: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- Total de jeux à ajouter: " . count($toAdd) . "\n";
$sql .= "-- ============================================================================\n\n";

$sql .= "START TRANSACTION;\n\n";

foreach ($toAdd as $game) {
    $name = str_replace("'", "''", $game['name']);
    
    $sql .= "-- {$game['name']}\n";
    $sql .= "-- Types d'images: " . implode(', ', $game['types']) . "\n";
    $sql .= "INSERT INTO wonderswan_games (name, rom_id, created_at, updated_at) \n";
    $sql .= "VALUES ('{$name}', NULL, NOW(), NOW());\n\n";
}

$sql .= "COMMIT;\n\n";

$sql .= "-- ============================================================================\n";
$sql .= "-- RÉSUMÉ\n";
$sql .= "-- ============================================================================\n";
$sql .= "-- Jeux ajoutés: " . count($toAdd) . "\n";
$sql .= "-- Ces jeux ont des images mais n'étaient pas présents dans la base\n";
$sql .= "-- ============================================================================\n";

file_put_contents($sqlFile, $sql);

echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "✅ FICHIER SQL GÉNÉRÉ\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";
echo "📁 Fichier: {$sqlFile}\n";
echo "📊 Insertions: " . count($toAdd) . "\n\n";

echo "💡 PROCHAINES ÉTAPES:\n\n";
echo "1. APPLIQUER EN LOCAL:\n";
echo "   php apply-missing-wonderswan-games.php\n\n";
echo "2. VÉRIFIER:\n";
echo "   php verify-all-platforms-images.php\n\n";
echo "3. SI OK, DÉPLOYER SUR RAILWAY (R2):\n";
echo "   - Copier les fichiers SQL vers le serveur\n";
echo "   - Exécuter les scripts dans l'ordre\n\n";
