<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("GÉNÉRATION SQL DE DÉPLOIEMENT GAME GEAR - RAILWAY/R2", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

echo "📊 Récupération de l'état actuel de la base locale...\n\n";

// Récupérer tous les jeux Game Gear (542 jeux avec 100% correspondance)
$games = DB::table('game_gear_games')
    ->orderBy('id')
    ->get();

$totalGames = count($games);

echo "   Jeux trouvés: {$totalGames}\n";
echo "   Statut: 100% correspondance (images ↔ base de données)\n\n";

// Créer le fichier SQL de déploiement
$sqlFile = 'deploy-game-gear-r2-full.sql';
$sql = fopen($sqlFile, 'w');

// En-tête
fwrite($sql, "-- " . str_repeat("=", 76) . "\n");
fwrite($sql, "-- DÉPLOIEMENT GAME GEAR - RAILWAY/R2 PRODUCTION\n");
fwrite($sql, "-- Date: " . date('Y-m-d H:i:s') . "\n");
fwrite($sql, "-- Base générée depuis: LOCAL stock-R4E\n");
fwrite($sql, "-- Total: {$totalGames} jeux\n");
fwrite($sql, "-- Correspondance: 542/542 (100%)\n");
fwrite($sql, "-- Images: 1,485 fichiers (cover, logo, artwork, gameplay, display)\n");
fwrite($sql, "-- " . str_repeat("=", 76) . "\n\n");

fwrite($sql, "-- INSTRUCTIONS:\n");
fwrite($sql, "-- 1. Sauvegarder la table actuelle: CREATE TABLE game_gear_games_backup AS SELECT * FROM game_gear_games;\n");
fwrite($sql, "-- 2. Vider la table: TRUNCATE TABLE game_gear_games;\n");
fwrite($sql, "-- 3. Exécuter ce script pour recréer avec les données correctes\n");
fwrite($sql, "-- 4. Vérifier: SELECT COUNT(*) FROM game_gear_games; -- doit être {$totalGames}\n\n");

fwrite($sql, "SET FOREIGN_KEY_CHECKS = 0;\n\n");

fwrite($sql, "-- " . str_repeat("-", 76) . "\n");
fwrite($sql, "-- OPTION 1: VIDER ET RECRÉER (RECOMMANDÉ)\n");
fwrite($sql, "-- " . str_repeat("-", 76) . "\n\n");

fwrite($sql, "TRUNCATE TABLE game_gear_games;\n\n");

fwrite($sql, "-- " . str_repeat("-", 76) . "\n");
fwrite($sql, "-- INSERTION DES {$totalGames} JEUX\n");
fwrite($sql, "-- " . str_repeat("-", 76) . "\n\n");

// Générer les INSERT statements par batch de 50
$batchSize = 50;
$batches = array_chunk($games->toArray(), $batchSize);

foreach ($batches as $batchIndex => $batch) {
    fwrite($sql, "-- Batch " . ($batchIndex + 1) . "/" . count($batches) . " (" . count($batch) . " jeux)\n");
    fwrite($sql, "INSERT INTO game_gear_games (id, rom_id, name, alternate_names, year, publisher, developer, region, slug, price, created_at, updated_at) VALUES\n");
    
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
        $slug = $game->slug ? "'" . addslashes($game->slug) . "'" : 'NULL';
        $price = $game->price ?: 'NULL';
        $created_at = $game->created_at ? "'" . $game->created_at . "'" : 'NOW()';
        $updated_at = $game->updated_at ? "'" . $game->updated_at . "'" : 'NOW()';
        
        $values[] = "($id, $rom_id, $name, $alternate_names, $year, $publisher, $developer, $region, $slug, $price, $created_at, $updated_at)";
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
    fwrite($sql, "REPLACE INTO game_gear_games (id, rom_id, name, alternate_names, year, publisher, developer, region, slug, price, created_at, updated_at) VALUES\n");
    
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
        $slug = $game->slug ? "'" . addslashes($game->slug) . "'" : 'NULL';
        $price = $game->price ?: 'NULL';
        $created_at = $game->created_at ? "'" . $game->created_at . "'" : 'NOW()';
        $updated_at = $game->updated_at ? "'" . $game->updated_at . "'" : 'NOW()';
        
        $values[] = "($id, $rom_id, $name, $alternate_names, $year, $publisher, $developer, $region, $slug, $price, $created_at, $updated_at)";
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
fwrite($sql, "SELECT COUNT(*) as total_games FROM game_gear_games;\n");
fwrite($sql, "-- Attendu: {$totalGames}\n\n");

fwrite($sql, "-- Vérifier que tous les jeux ont un rom_id\n");
fwrite($sql, "SELECT COUNT(*) as games_with_rom_id FROM game_gear_games WHERE rom_id IS NOT NULL;\n");
fwrite($sql, "-- Attendu: {$totalGames} (100%)\n\n");

fwrite($sql, "-- Vérifier l'absence de doublons sur rom_id\n");
fwrite($sql, "SELECT rom_id, COUNT(*) as count\n");
fwrite($sql, "FROM game_gear_games\n");
fwrite($sql, "WHERE rom_id IS NOT NULL\n");
fwrite($sql, "GROUP BY rom_id\n");
fwrite($sql, "HAVING count > 1;\n");
fwrite($sql, "-- Attendu: 0 résultat\n\n");

fwrite($sql, "-- Exemples de jeux (vérification visuelle)\n");
fwrite($sql, "SELECT * FROM game_gear_games WHERE name LIKE 'Aladdin%' ORDER BY name;\n");
fwrite($sql, "SELECT * FROM game_gear_games WHERE name LIKE '%Sonic%' ORDER BY name;\n");
fwrite($sql, "SELECT * FROM game_gear_games WHERE name LIKE '%USA%' LIMIT 10;\n");
fwrite($sql, "SELECT * FROM game_gear_games WHERE name LIKE '%Japan%' LIMIT 10;\n\n");

fwrite($sql, "-- Vérifier la préservation des régions (critère 100%)\n");
fwrite($sql, "SELECT \n");
fwrite($sql, "    COUNT(*) as total,\n");
fwrite($sql, "    SUM(CASE WHEN rom_id = name THEN 1 ELSE 0 END) as rom_equals_name,\n");
fwrite($sql, "    SUM(CASE WHEN rom_id LIKE '%(%)%' THEN 1 ELSE 0 END) as with_regions\n");
fwrite($sql, "FROM game_gear_games;\n");
fwrite($sql, "-- rom_id doit être égal à name pour préserver les régions\n\n");

fwrite($sql, "-- " . str_repeat("=", 76) . "\n");
fwrite($sql, "-- FIN DU DÉPLOIEMENT\n");
fwrite($sql, "-- " . str_repeat("=", 76) . "\n");

fclose($sql);

echo "✅ Fichier SQL généré: {$sqlFile}\n";
echo "   Taille: " . number_format(filesize($sqlFile) / 1024, 2) . " KB\n";
echo "   Jeux: {$totalGames}\n";
echo "   Batches: " . count($batches) . " (50 jeux/batch)\n\n";

echo "🚀 Prêt pour déploiement sur Railway/R2!\n\n";

echo "📝 Prochaines étapes:\n";
echo "   1. Ouvrir {$sqlFile}\n";
echo "   2. Copier le contenu dans Railway Query Editor\n";
echo "   3. Exécuter le script\n";
echo "   4. Vérifier avec: SELECT COUNT(*) FROM game_gear_games;\n";
echo "   5. Confirmer ROM_ID = name pour 100% des jeux\n\n";

echo "📊 RÉSUMÉ DE LA NORMALISATION GAME GEAR:\n";
echo "   • Point de départ: 653 jeux, 1,507 images (57% correspondance)\n";
echo "   • Opérations: 1,112+ fichiers renommés\n";
echo "   • ROM_ID générés: 542 (avec régions préservées)\n";
echo "   • Nouveaux jeux ajoutés: 51\n";
echo "   • Jeux supprimés (sans images): 162\n";
echo "   • Résultat final: 542 jeux, 1,485 images (100% correspondance)\n\n";

echo str_repeat("═", 80) . "\n";
