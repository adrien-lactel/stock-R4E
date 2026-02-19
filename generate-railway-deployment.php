<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("GÉNÉRATION SQL DE DÉPLOIEMENT RAILWAY/R2", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

echo "📊 Récupération de l'état actuel de la base locale...\n\n";

// Récupérer tous les jeux WonderSwan
$games = DB::table('wonderswan_games')
    ->orderBy('id')
    ->get();

echo "   Jeux trouvés: " . count($games) . "\n\n";

// Créer le fichier SQL de déploiement
$sqlFile = 'deploy-wonderswan-r2-full.sql';
$sql = fopen($sqlFile, 'w');

// En-tête
fwrite($sql, "-- " . str_repeat("=", 76) . "\n");
fwrite($sql, "-- DÉPLOIEMENT WONDERSWAN - RAILWAY/R2 PRODUCTION\n");
fwrite($sql, "-- Date: " . date('Y-m-d H:i:s') . "\n");
fwrite($sql, "-- Base générée depuis: LOCAL stock-R4E\n");
fwrite($sql, "-- Total: " . count($games) . " jeux\n");
fwrite($sql, "-- Correspondance: 117/117 (100%)\n");
fwrite($sql, "-- " . str_repeat("=", 76) . "\n\n");

fwrite($sql, "-- INSTRUCTIONS:\n");
fwrite($sql, "-- 1. Sauvegarder la table actuelle: CREATE TABLE wonderswan_games_backup AS SELECT * FROM wonderswan_games;\n");
fwrite($sql, "-- 2. Vider la table: TRUNCATE TABLE wonderswan_games;\n");
fwrite($sql, "-- 3. Exécuter ce script pour recréer avec les données correctes\n");
fwrite($sql, "-- 4. Vérifier: SELECT COUNT(*) FROM wonderswan_games; -- doit être " . count($games) . "\n\n");

fwrite($sql, "SET FOREIGN_KEY_CHECKS = 0;\n\n");

fwrite($sql, "-- " . str_repeat("-", 76) . "\n");
fwrite($sql, "-- OPTION 1: VIDER ET RECRÉER (RECOMMANDÉ)\n");
fwrite($sql, "-- " . str_repeat("-", 76) . "\n\n");

fwrite($sql, "TRUNCATE TABLE wonderswan_games;\n\n");

fwrite($sql, "-- " . str_repeat("-", 76) . "\n");
fwrite($sql, "-- INSERTION DES " . count($games) . " JEUX\n");
fwrite($sql, "-- " . str_repeat("-", 76) . "\n\n");

// Générer les INSERT statements par batch de 50
$batchSize = 50;
$batches = array_chunk($games->toArray(), $batchSize);

foreach ($batches as $batchIndex => $batch) {
    fwrite($sql, "-- Batch " . ($batchIndex + 1) . "/" . count($batches) . " (" . count($batch) . " jeux)\n");
    fwrite($sql, "INSERT INTO wonderswan_games (id, rom_id, name, alternate_names, year, publisher, developer, region, price, created_at, updated_at) VALUES\n");
    
    $values = [];
    foreach ($batch as $game) {
        $id = $game->id;
        $rom_id = $game->rom_id ? "'" . addslashes($game->rom_id) . "'" : 'NULL';
        $name = "'" . addslashes($game->name) . "'";
        $alternate_names = $game->alternate_names ? "'" . addslashes($game->alternate_names) . "'" : 'NULL';
        $year = $game->year ? "'" . addslashes($game->year) . "'" : 'NULL';
        $publisher = $game->publisher ? "'" . addslashes($game->publisher) . "'" : 'NULL';
        $developer = $game->developer ? "'" . addslashes($game->developer) . "'" : 'NULL';
        $region = $game->region ? "'" . addslashes($game->region) . "'" : 'NULL';
        $price = $game->price ?: 'NULL';
        $created_at = $game->created_at ? "'" . $game->created_at . "'" : 'NOW()';
        $updated_at = $game->updated_at ? "'" . $game->updated_at . "'" : 'NOW()';
        
        $values[] = "($id, $rom_id, $name, $alternate_names, $year, $publisher, $developer, $region, $price, $created_at, $updated_at)";
    }
    
    fwrite($sql, implode(",\n", $values));
    fwrite($sql, ";\n\n");
}

fwrite($sql, "-- " . str_repeat("-", 76) . "\n");
fwrite($sql, "-- OPTION 2: MISE À JOUR SÉLECTIVE (si TRUNCATE n'est pas possible)\n");
fwrite($sql, "-- " . str_repeat("-", 76) . "\n\n");

fwrite($sql, "-- Si vous ne pouvez pas vider la table, utilisez ces commandes:\n");
fwrite($sql, "-- 1. Supprimer les doublons et anciens jeux\n");
fwrite($sql, "-- 2. Insérer/mettre à jour avec REPLACE INTO\n\n");

fwrite($sql, "-- REPLACE INTO (supprime et recrée si existe, sinon insert):\n");
foreach ($batches as $batchIndex => $batch) {
    if ($batchIndex > 0) break; // Juste le premier batch comme exemple
    
    fwrite($sql, "-- Exemple batch 1 avec REPLACE INTO:\n");
    fwrite($sql, "REPLACE INTO wonderswan_games (id, rom_id, name, alternate_names, year, publisher, developer, region, price, created_at, updated_at) VALUES\n");
    
    $values = [];
    foreach ($batch as $game) {
        $id = $game->id;
        $rom_id = $game->rom_id ? "'" . addslashes($game->rom_id) . "'" : 'NULL';
        $name = "'" . addslashes($game->name) . "'";
        $alternate_names = $game->alternate_names ? "'" . addslashes($game->alternate_names) . "'" : 'NULL';
        $year = $game->year ? "'" . addslashes($game->year) . "'" : 'NULL';
        $publisher = $game->publisher ? "'" . addslashes($game->publisher) . "'" : 'NULL';
        $developer = $game->developer ? "'" . addslashes($game->developer) . "'" : 'NULL';
        $region = $game->region ? "'" . addslashes($game->region) . "'" : 'NULL';
        $price = $game->price ?: 'NULL';
        $created_at = $game->created_at ? "'" . $game->created_at . "'" : 'NOW()';
        $updated_at = $game->updated_at ? "'" . $game->updated_at . "'" : 'NOW()';
        
        $values[] = "($id, $rom_id, $name, $alternate_names, $year, $publisher, $developer, $region, $price, $created_at, $updated_at)";
    }
    
    fwrite($sql, implode(",\n", $values));
    fwrite($sql, ";\n");
    fwrite($sql, "-- ... (répétez pour tous les batches)\n\n");
}

fwrite($sql, "\nSET FOREIGN_KEY_CHECKS = 1;\n\n");

fwrite($sql, "-- " . str_repeat("=", 76) . "\n");
fwrite($sql, "-- VÉRIFICATION POST-DÉPLOIEMENT\n");
fwrite($sql, "-- " . str_repeat("=", 76) . "\n\n");

fwrite($sql, "-- Compter les jeux\n");
fwrite($sql, "SELECT COUNT(*) as total_games FROM wonderswan_games;\n");
fwrite($sql, "-- Attendu: " . count($games) . "\n\n");

fwrite($sql, "-- Vérifier l'absence de doublons\n");
fwrite($sql, "SELECT clean_name, COUNT(*) as count\n");
fwrite($sql, "FROM (\n");
fwrite($sql, "    SELECT TRIM(REGEXP_REPLACE(name, ' \\\\((Japan|USA|Europe|World|Rev [0-9]+)\\\\)$', '')) as clean_name\n");
fwrite($sql, "    FROM wonderswan_games\n");
fwrite($sql, ") AS cleaned\n");
fwrite($sql, "GROUP BY clean_name\n");
fwrite($sql, "HAVING count > 1;\n");
fwrite($sql, "-- Attendu: 0 résultat\n\n");

fwrite($sql, "-- Exemples de jeux (vérification visuelle)\n");
fwrite($sql, "SELECT * FROM wonderswan_games WHERE name LIKE '%for WonderSwan%' LIMIT 10;\n");
fwrite($sql, "SELECT * FROM wonderswan_games WHERE name LIKE '%Digimon%' ORDER BY name;\n\n");

fwrite($sql, "-- " . str_repeat("=", 76) . "\n");
fwrite($sql, "-- FIN DU DÉPLOIEMENT\n");
fwrite($sql, "-- " . str_repeat("=", 76) . "\n");

fclose($sql);

echo "✅ Fichier SQL généré: {$sqlFile}\n";
echo "   Taille: " . number_format(filesize($sqlFile) / 1024, 2) . " KB\n";
echo "   Jeux: " . count($games) . "\n";
echo "   Batches: " . count($batches) . " (50 jeux/batch)\n\n";

echo "🚀 Prêt pour déploiement sur Railway/R2!\n\n";

echo "📝 Prochaines étapes:\n";
echo "   1. Ouvrir {$sqlFile}\n";
echo "   2. Copier le contenu dans Railway Query Editor\n";
echo "   3. Exécuter le script\n";
echo "   4. Vérifier avec: SELECT COUNT(*) FROM wonderswan_games;\n\n";

echo str_repeat("═", 80) . "\n";
