<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║      NORMALISATION WONDERSWAN V2 - PATCH POUR 'for WonderSwan'            ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Récupérer tous les jeux WonderSwan actuels
$games = DB::table('wonderswan_games')
    ->select('id', 'name')
    ->get();

// Lister les fichiers images pour identifier les jeux qui ont "for WonderSwan" dans leur nom officiel
$imageFolder = 'public/images/taxonomy/wonderswan';
$allImages = glob($imageFolder . '/*.{png,jpg,jpeg}', GLOB_BRACE);

$imageIdentifiers = [];
foreach ($allImages as $imagePath) {
    $filename = basename($imagePath);
    
    if (preg_match('/^(.+?)-(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
        $identifier = trim($matches[1]);
        // Nettoyer la région
        $cleanIdentifier = preg_replace('/\s*\((USA|Europe|Japan|World|Hong Kong|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $identifier);
        
        if (!isset($imageIdentifiers[$cleanIdentifier])) {
            $imageIdentifiers[$cleanIdentifier] = $identifier; // Garder l'original avec région
        }
    }
}

echo "📊 Images analysées: " . count($allImages) . "\n";
echo "📊 Identifiants uniques: " . count($imageIdentifiers) . "\n\n";

// Identifier les jeux qui doivent être corrigés
$corrections = [];

foreach ($games as $game) {
    $currentName = $game->name;
    
    // Vérifier si une image existe avec "for WonderSwan" ajouté au nom actuel
    $potentialNameWithFor = str_replace(' (Japan)', ' for WonderSwan (Japan)', $currentName);
    $potentialNameWithFor = preg_replace('/\s*\(Japan\)/', ' for WonderSwan (Japan)', $currentName);
    
    // Essayer différentes combinaisons
    $variations = [
        $currentName . ' for WonderSwan',
        str_replace(' (Japan)', ' for WonderSwan (Japan)', $currentName),
        str_replace(' (World)', ' for WonderSwan (World)', $currentName),
        str_replace(' (Hong Kong)', ' for WonderSwan (Hong Kong)', $currentName),
    ];
    
    foreach ($variations as $variation) {
        // Retirer la région finale pour comparaison
        $variationClean = preg_replace('/\s*\((USA|Europe|Japan|World|Hong Kong)\)\s*$/i', '', $variation);
        
        if (isset($imageIdentifiers[$variationClean])) {
            // On a trouvé une correspondance !
            $corrections[] = [
                'id' => $game->id,
                'current' => $currentName,
                'corrected' => $variation,
                'image_match' => $imageIdentifiers[$variationClean]
            ];
            break;
        }
    }
}

echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "📋 CORRECTIONS IDENTIFIÉES\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";
echo "Jeux à corriger: " . count($corrections) . "\n\n";

if (count($corrections) === 0) {
    echo "✅ Aucune correction nécessaire!\n\n";
    exit(0);
}

// Afficher les 20 premiers
foreach (array_slice($corrections, 0, 20) as $correction) {
    echo "ID {$correction['id']}:\n";
    echo "  ACTUEL: '" . $correction['current'] . "'\n";
    echo "  CORRIGÉ: '" . $correction['corrected'] . "'\n";
    echo "  IMAGE: '" . $correction['image_match'] . "'\n\n";
}

if (count($corrections) > 20) {
    echo "... et " . (count($corrections) - 20) . " autres\n\n";
}

// Générer le SQL de correction
$sqlFile = 'fix-wonderswan-for-wonderswan.sql';
$sql = "-- ============================================================================\n";
$sql .= "-- CORRECTION WONDERSWAN - Ajouter 'for WonderSwan' aux noms officiels\n";
$sql .= "-- Généré le: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- Total de corrections: " . count($corrections) . "\n";
$sql .= "-- ============================================================================\n\n";

$sql .= "START TRANSACTION;\n\n";

foreach ($corrections as $correction) {
    $current = str_replace("'", "''", $correction['current']);
    $corrected = str_replace("'", "''", $correction['corrected']);
    
    $sql .= "-- ID {$correction['id']}\n";
    $sql .= "UPDATE wonderswan_games SET name = '{$corrected}' WHERE id = {$correction['id']};\n";
    $sql .= "-- (était: '{$current}')\n\n";
}

$sql .= "COMMIT;\n";

file_put_contents($sqlFile, $sql);

echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "✅ FICHIER SQL GÉNÉRÉ\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";
echo "📁 Fichier: {$sqlFile}\n";
echo "📊 Corrections: " . count($corrections) . "\n\n";
echo "💡 APPLIQUER LES CORRECTIONS:\n";
echo "   php apply-wonderswan-fix.php\n\n";
