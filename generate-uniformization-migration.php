<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("GÉNÉRATION MIGRATION - UNIFORMISATION TABLES JEUX", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

// Tables à uniformiser
$tables = [
    'game_boy_games',
    'snes_games',
    'nes_games',
    'wonderswan_games',
    'game_gear_games',
    'mega_drive_games',
];

// Schéma uniforme (toutes les colonnes dans l'ordre souhaité)
$uniformSchema = [
    // Identifiants
    ['name' => 'id', 'type' => 'bigint unsigned', 'nullable' => false, 'key' => 'PRI', 'auto_increment' => true],
    ['name' => 'rom_id', 'type' => 'varchar(255)', 'nullable' => true, 'key' => '', 'unique' => false],
    ['name' => 'cartridge_id', 'type' => 'varchar(50)', 'nullable' => true, 'key' => '', 'comment' => 'SNES physical cartridge ID'],
    
    // Noms
    ['name' => 'name', 'type' => 'varchar(255)', 'nullable' => false, 'key' => 'MUL'],
    ['name' => 'name_jp', 'type' => 'varchar(255)', 'nullable' => true, 'key' => '', 'comment' => 'Japanese name'],
    ['name' => 'alternate_names', 'type' => 'text', 'nullable' => true, 'key' => ''],
    
    // Metadata
    ['name' => 'year', 'type' => 'varchar(255)', 'nullable' => true, 'key' => '', 'comment' => 'Standardized as varchar'],
    ['name' => 'publisher', 'type' => 'varchar(255)', 'nullable' => true, 'key' => ''],
    ['name' => 'developer', 'type' => 'varchar(255)', 'nullable' => true, 'key' => ''],
    ['name' => 'region', 'type' => 'varchar(50)', 'nullable' => true, 'key' => ''],
    
    // URLs et chemins
    ['name' => 'slug', 'type' => 'varchar(255)', 'nullable' => true, 'key' => '', 'unique' => false],
    ['name' => 'image_url', 'type' => 'varchar(255)', 'nullable' => true, 'key' => '', 'comment' => 'External image URL'],
    ['name' => 'image_path', 'type' => 'varchar(255)', 'nullable' => true, 'key' => '', 'comment' => 'Local path'],
    ['name' => 'cloudinary_url', 'type' => 'varchar(255)', 'nullable' => true, 'key' => '', 'comment' => 'Cloudinary CDN'],
    
    // Libretro / matching
    ['name' => 'libretro_name', 'type' => 'varchar(255)', 'nullable' => true, 'key' => ''],
    ['name' => 'match_type', 'type' => 'varchar(255)', 'nullable' => true, 'key' => ''],
    ['name' => 'match_score', 'type' => 'decimal(5,2)', 'nullable' => true, 'key' => ''],
    
    // Source
    ['name' => 'source', 'type' => 'varchar(50)', 'nullable' => true, 'key' => '', 'comment' => 'Data source origin'],
    
    // Prix et timestamps
    ['name' => 'price', 'type' => 'varchar(255)', 'nullable' => true, 'key' => '', 'comment' => 'Standardized as varchar'],
    ['name' => 'created_at', 'type' => 'timestamp', 'nullable' => true, 'key' => ''],
    ['name' => 'updated_at', 'type' => 'timestamp', 'nullable' => true, 'key' => ''],
];

// Récupérer structure actuelle
$tableStructures = [];
foreach ($tables as $table) {
    if (!Schema::hasTable($table)) {
        continue;
    }
    $columns = DB::select("DESCRIBE {$table}");
    $tableStructures[$table] = [];
    foreach ($columns as $column) {
        $tableStructures[$table][$column->Field] = [
            'type' => $column->Type,
            'nullable' => $column->Null === 'YES',
            'key' => $column->Key,
            'default' => $column->Default
        ];
    }
}

// Générer le SQL
$sqlFile = 'uniformize-all-game-tables.sql';
$sql = fopen($sqlFile, 'w');

fwrite($sql, "-- ============================================================================\n");
fwrite($sql, "-- UNIFORMISATION DE TOUTES LES TABLES DE JEUX\n");
fwrite($sql, "-- Date: " . date('Y-m-d H:i:s') . "\n");
fwrite($sql, "-- Objectif: Mêmes colonnes, même ordre, mêmes noms dans toutes les tables\n");
fwrite($sql, "-- ============================================================================\n\n");

fwrite($sql, "-- AVERTISSEMENT: Testez d'abord sur une copie de la base de données!\n");
fwrite($sql, "-- Créez un backup avant d'exécuter:\n");
fwrite($sql, "-- mysqldump -u root stock_r4e > backup_before_uniformisation.sql\n\n");

fwrite($sql, "SET FOREIGN_KEY_CHECKS = 0;\n\n");

// Pour chaque table
foreach ($tables as $table) {
    if (!isset($tableStructures[$table])) {
        continue;
    }
    
    fwrite($sql, "-- ============================================================================\n");
    fwrite($sql, "-- TABLE: {$table}\n");
    fwrite($sql, "-- ============================================================================\n\n");
    
    $currentColumns = array_keys($tableStructures[$table]);
    $alterStatements = [];
    
    // Parcourir le schéma uniforme
    $previousColumn = null;
    foreach ($uniformSchema as $columnDef) {
        $columnName = $columnDef['name'];
        
        // Si la colonne n'existe pas, l'ajouter
        if (!in_array($columnName, $currentColumns)) {
            $nullable = $columnDef['nullable'] ? 'NULL' : 'NOT NULL';
            $default = '';
            
            // Position
            if ($previousColumn === null) {
                $position = "FIRST";
            } else {
                $position = "AFTER `{$previousColumn}`";
            }
            
            $comment = isset($columnDef['comment']) ? " COMMENT '{$columnDef['comment']}'" : '';
            
            $alterStatements[] = "ADD COLUMN `{$columnName}` {$columnDef['type']} {$nullable}{$default}{$comment} {$position}";
            
            echo "   + {$table}: Ajout de `{$columnName}` ({$columnDef['type']})\n";
        }
        
        $previousColumn = $columnName;
    }
    
    // Écrire les ALTER TABLE
    if (count($alterStatements) > 0) {
        fwrite($sql, "ALTER TABLE `{$table}`\n");
        fwrite($sql, "  " . implode(",\n  ", $alterStatements) . ";\n\n");
    } else {
        fwrite($sql, "-- Aucune colonne à ajouter pour {$table}\n\n");
    }
}

fwrite($sql, "\n-- ============================================================================\n");
fwrite($sql, "-- COPIER name → rom_id POUR LES TABLES SEGA (si rom_id NULL)\n");
fwrite($sql, "-- ============================================================================\n\n");

// Mega Drive : copier name → rom_id
fwrite($sql, "-- Mega Drive: 26 jeux avec rom_id NULL\n");
fwrite($sql, "UPDATE mega_drive_games\n");
fwrite($sql, "SET rom_id = name\n");
fwrite($sql, "WHERE rom_id IS NULL OR rom_id = '';\n\n");

fwrite($sql, "-- Vérification Mega Drive\n");
fwrite($sql, "SELECT COUNT(*) as total, \n");
fwrite($sql, "       SUM(CASE WHEN rom_id IS NOT NULL THEN 1 ELSE 0 END) as with_rom_id,\n");
fwrite($sql, "       SUM(CASE WHEN rom_id IS NULL THEN 1 ELSE 0 END) as without_rom_id\n");
fwrite($sql, "FROM mega_drive_games;\n");
fwrite($sql, "-- Attendu: total=26, with_rom_id=26, without_rom_id=0\n\n");

// Game Gear : vérifier seulement (déjà fait)
fwrite($sql, "-- Game Gear: Vérification (déjà fait - 542/542)\n");
fwrite($sql, "SELECT COUNT(*) as total,\n");
fwrite($sql, "       SUM(CASE WHEN rom_id IS NOT NULL THEN 1 ELSE 0 END) as with_rom_id\n");
fwrite($sql, "FROM game_gear_games;\n");
fwrite($sql, "-- Attendu: total=542, with_rom_id=542\n\n");

fwrite($sql, "SET FOREIGN_KEY_CHECKS = 1;\n\n");

fwrite($sql, "-- ============================================================================\n");
fwrite($sql, "-- VÉRIFICATIONS POST-MIGRATION\n");
fwrite($sql, "-- ============================================================================\n\n");

foreach ($tables as $table) {
    if (!isset($tableStructures[$table])) {
        continue;
    }
    
    fwrite($sql, "-- {$table}\n");
    fwrite($sql, "SHOW COLUMNS FROM `{$table}`;\n");
    fwrite($sql, "SELECT COUNT(*) as total FROM `{$table}`;\n\n");
}

fwrite($sql, "-- Vérifier que toutes les tables ont les mêmes colonnes\n");
fwrite($sql, "SELECT \n");
fwrite($sql, "    TABLE_NAME,\n");
fwrite($sql, "    COUNT(*) as column_count,\n");
fwrite($sql, "    GROUP_CONCAT(COLUMN_NAME ORDER BY ORDINAL_POSITION) as columns\n");
fwrite($sql, "FROM INFORMATION_SCHEMA.COLUMNS\n");
fwrite($sql, "WHERE TABLE_SCHEMA = 'stock_r4e'\n");
fwrite($sql, "  AND TABLE_NAME IN ('" . implode("', '", $tables) . "')\n");
fwrite($sql, "GROUP BY TABLE_NAME\n");
fwrite($sql, "ORDER BY TABLE_NAME;\n");
fwrite($sql, "-- Toutes les tables doivent avoir 21 colonnes dans le même ordre\n\n");

fwrite($sql, "-- ============================================================================\n");
fwrite($sql, "-- FIN DE LA MIGRATION\n");
fwrite($sql, "-- ============================================================================\n");

fclose($sql);

echo "\n✅ Fichier SQL généré: {$sqlFile}\n";
echo "   Taille: " . number_format(filesize($sqlFile) / 1024, 2) . " KB\n\n";

echo "📋 RÉSUMÉ:\n";
echo "   • Tables uniformisées: " . count($tables) . "\n";
echo "   • Colonnes au total: " . count($uniformSchema) . "\n";
echo "   • Mega Drive: name → rom_id pour 26 jeux\n\n";

echo "⚠️  IMPORTANT:\n";
echo "   1. Créez un BACKUP complet avant d'exécuter\n";
echo "   2. Testez sur une copie de la base\n";
echo "   3. Vérifiez les résultats avec les requêtes de vérification\n\n";

echo "🚀 Prochaines étapes:\n";
echo "   1. Backup: mysqldump -u root stock_r4e > backup.sql\n";
echo "   2. Exécuter: mysql -u root stock_r4e < {$sqlFile}\n";
echo "   3. Vérifier: php verify-uniformization.php\n\n";

echo str_repeat("═", 80) . "\n";
