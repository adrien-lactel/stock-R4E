<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║         NORMALISATION WONDERSWAN - GÉNÉRATION DES UPDATES                 ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Récupérer tous les jeux WonderSwan
$games = DB::table('wonderswan_games')
    ->select('id', 'rom_id', 'name')
    ->orderBy('name')
    ->get();

echo "📊 Total de jeux en base: " . count($games) . "\n\n";

$updates = [];
$duplicates = [];
$normalizedIndex = [];

foreach ($games as $game) {
    $original = $game->name;
    $normalized = $original;
    
    // 1. Retirer "for WonderSwan"
    $normalized = str_replace(' for WonderSwan', '', $normalized);
    $normalized = str_replace(' For WonderSwan', '', $normalized);
    
    // 2. Retirer l'extension .ws
    $normalized = preg_replace('/\.ws$/i', '', $normalized);
    
    // 3. Retirer tous les tags entre parenthèses SAUF la région finale
    // Garder uniquement: (Japan), (World), (USA), (Europe), (Hong Kong)
    // Retirer: (Rev X), (En), (En,Ja), (WonderWitch), (Unl), (Proto), (vX.XX), etc.
    
    // Extraire la région finale si présente
    $regionPattern = '/\s*\((Japan|World|USA|Europe|Hong Kong)\)\s*$/i';
    $hasRegion = preg_match($regionPattern, $normalized, $regionMatch);
    $region = $hasRegion ? ' ' . $regionMatch[0] : '';
    
    // Retirer TOUS les tags entre parenthèses
    $normalized = preg_replace('/\s*\([^)]+\)/', '', $normalized);
    
    // Remettre la région à la fin
    $normalized = trim($normalized) . $region;
    
    // 4. Nettoyer les espaces multiples
    $normalized = preg_replace('/\s+/', ' ', $normalized);
    $normalized = trim($normalized);
    
    // Vérifier si une modification est nécessaire
    if ($original !== $normalized) {
        // Vérifier les doublons
        if (isset($normalizedIndex[$normalized])) {
            $duplicates[] = [
                'normalized' => $normalized,
                'id1' => $normalizedIndex[$normalized],
                'name1' => $games->firstWhere('id', $normalizedIndex[$normalized])->name,
                'id2' => $game->id,
                'name2' => $original
            ];
        } else {
            $normalizedIndex[$normalized] = $game->id;
        }
        
        $updates[] = [
            'id' => $game->id,
            'original' => $original,
            'normalized' => $normalized
        ];
    } else {
        // Même si pas de modification, indexer pour détecter les doublons existants
        if (isset($normalizedIndex[$normalized])) {
            $duplicates[] = [
                'normalized' => $normalized,
                'id1' => $normalizedIndex[$normalized],
                'name1' => $games->firstWhere('id', $normalizedIndex[$normalized])->name,
                'id2' => $game->id,
                'name2' => $original
            ];
        } else {
            $normalizedIndex[$normalized] = $game->id;
        }
    }
}

echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "📋 STATISTIQUES\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";
echo "  • Jeux nécessitant une mise à jour: " . count($updates) . "\n";
echo "  • Doublons détectés: " . count($duplicates) . "\n\n";

// Afficher quelques exemples
echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "📝 EXEMPLES DE TRANSFORMATIONS (20 premiers)\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";

foreach (array_slice($updates, 0, 20) as $update) {
    echo "ID {$update['id']}:\n";
    echo "  AVANT: '{$update['original']}'\n";
    echo "  APRÈS: '{$update['normalized']}'\n\n";
}

// Afficher les doublons
if (count($duplicates) > 0) {
    echo "══════════════════════════════════════════════════════════════════════════════\n";
    echo "⚠️  DOUBLONS DÉTECTÉS\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    
    foreach ($duplicates as $dup) {
        echo "Nom normalisé: '{$dup['normalized']}'\n";
        echo "  • ID {$dup['id1']}: '{$dup['name1']}'\n";
        echo "  • ID {$dup['id2']}: '{$dup['name2']}'\n";
        echo "  → ACTION: Garder ID {$dup['id1']}, supprimer ID {$dup['id2']}\n\n";
    }
}

// Générer le fichier SQL
$sqlFile = 'normalize-wonderswan.sql';
$sql = "-- ============================================================================\n";
$sql .= "-- NORMALISATION DE LA BASE WONDERSWAN\n";
$sql .= "-- Généré le: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- Total de modifications: " . count($updates) . "\n";
$sql .= "-- Total de doublons à supprimer: " . count($duplicates) . "\n";
$sql .= "-- ============================================================================\n\n";

$sql .= "-- Début de la transaction\n";
$sql .= "START TRANSACTION;\n\n";

// Supprimer les doublons d'abord
if (count($duplicates) > 0) {
    $sql .= "-- ============================================================================\n";
    $sql .= "-- SUPPRESSION DES DOUBLONS\n";
    $sql .= "-- ============================================================================\n\n";
    
    foreach ($duplicates as $dup) {
        $sql .= "-- Doublon: '{$dup['normalized']}'\n";
        $sql .= "-- Garder ID {$dup['id1']}: '{$dup['name1']}'\n";
        $sql .= "-- Supprimer ID {$dup['id2']}: '{$dup['name2']}'\n";
        $sql .= "DELETE FROM wonderswan_games WHERE id = {$dup['id2']};\n\n";
    }
}

// Générer les UPDATE
$sql .= "-- ============================================================================\n";
$sql .= "-- NORMALISATION DES NOMS\n";
$sql .= "-- ============================================================================\n\n";

foreach ($updates as $update) {
    // Échapper les apostrophes pour SQL
    $original = str_replace("'", "''", $update['original']);
    $normalized = str_replace("'", "''", $update['normalized']);
    
    $sql .= "-- ID {$update['id']}\n";
    $sql .= "UPDATE wonderswan_games SET name = '{$normalized}' WHERE id = {$update['id']};\n";
    $sql .= "-- (était: '{$original}')\n\n";
}

$sql .= "-- Valider la transaction\n";
$sql .= "COMMIT;\n\n";

$sql .= "-- ============================================================================\n";
$sql .= "-- RÉSUMÉ\n";
$sql .= "-- ============================================================================\n";
$sql .= "-- Jeux mis à jour: " . count($updates) . "\n";
$sql .= "-- Doublons supprimés: " . count($duplicates) . "\n";
$sql .= "-- ============================================================================\n";

file_put_contents($sqlFile, $sql);

echo "══════════════════════════════════════════════════════════════════════════════\n";
echo "✅ FICHIER SQL GÉNÉRÉ\n";
echo "══════════════════════════════════════════════════════════════════════════════\n\n";
echo "📁 Fichier: {$sqlFile}\n";
echo "📊 Contenu:\n";
echo "  • " . count($duplicates) . " suppressions de doublons\n";
echo "  • " . count($updates) . " mises à jour de noms\n\n";

echo "💡 PROCHAINES ÉTAPES:\n\n";
echo "1. TESTER EN LOCAL:\n";
echo "   mysql -u root stock-R4E < {$sqlFile}\n\n";
echo "2. VÉRIFIER LES CORRESPONDANCES:\n";
echo "   php verify-all-platforms-images.php\n\n";
echo "3. SI OK, APPLIQUER SUR R2 (Railway):\n";
echo "   railway connect\n";
echo "   railway run php artisan db:seed --class=WonderSwanNormalizationSeeder\n\n";

// Générer aussi un fichier de rollback
$rollbackFile = 'rollback-wonderswan.sql';
$rollback = "-- ============================================================================\n";
$rollback .= "-- ROLLBACK DE LA NORMALISATION WONDERSWAN\n";
$rollback .= "-- Généré le: " . date('Y-m-d H:i:s') . "\n";
$rollback .= "-- ============================================================================\n\n";

$rollback .= "START TRANSACTION;\n\n";

foreach ($updates as $update) {
    $original = str_replace("'", "''", $update['original']);
    $normalized = str_replace("'", "''", $update['normalized']);
    
    $rollback .= "-- ID {$update['id']}\n";
    $rollback .= "UPDATE wonderswan_games SET name = '{$original}' WHERE id = {$update['id']};\n\n";
}

$rollback .= "COMMIT;\n";

file_put_contents($rollbackFile, $rollback);

echo "📁 Fichier de rollback généré: {$rollbackFile}\n";
echo "   (en cas de problème, permet de restaurer les noms originaux)\n\n";
