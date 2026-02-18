<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║       GÉNÉRATION SQL - UNIFORMISATION N64 & SEGA SATURN           ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

$referenceOrder = [
    'id' => ['type' => 'bigint unsigned', 'null' => 'NOT NULL', 'extra' => 'auto_increment'],
    'rom_id' => ['type' => 'varchar(255)', 'null' => 'NULL'],
    'cartridge_id' => ['type' => 'varchar(50)', 'null' => 'NULL', 'comment' => 'SNES physical cartridge ID'],
    'name' => ['type' => 'varchar(255)', 'null' => 'NOT NULL'],
    'name_jp' => ['type' => 'varchar(255)', 'null' => 'NULL', 'comment' => 'Japanese name'],
    'alternate_names' => ['type' => 'text', 'null' => 'NULL'],
    'year' => ['type' => 'varchar(255)', 'null' => 'NULL'],
    'publisher' => ['type' => 'varchar(255)', 'null' => 'NULL'],
    'developer' => ['type' => 'varchar(255)', 'null' => 'NULL'],
    'region' => ['type' => 'varchar(50)', 'null' => 'NULL'],
    'slug' => ['type' => 'varchar(255)', 'null' => 'NULL'],
    'image_url' => ['type' => 'varchar(255)', 'null' => 'NULL', 'comment' => 'External image URL'],
    'image_path' => ['type' => 'varchar(255)', 'null' => 'NULL', 'comment' => 'Local path'],
    'cloudinary_url' => ['type' => 'varchar(255)', 'null' => 'NULL', 'comment' => 'Cloudinary CDN'],
    'libretro_name' => ['type' => 'varchar(255)', 'null' => 'NULL'],
    'match_type' => ['type' => 'varchar(255)', 'null' => 'NULL'],
    'match_score' => ['type' => 'decimal(5,2)', 'null' => 'NULL'],
    'source' => ['type' => 'varchar(50)', 'null' => 'NULL', 'comment' => 'Data source origin'],
    'price' => ['type' => 'varchar(255)', 'null' => 'NULL'],
    'created_at' => ['type' => 'timestamp', 'null' => 'NULL'],
    'updated_at' => ['type' => 'timestamp', 'null' => 'NULL'],
];

$tables = ['n64_games', 'sega_saturn_games'];

$sql = "-- ═══════════════════════════════════════════════════════════════════════\n";
$sql .= "-- UNIFORMISATION N64 & SEGA SATURN - AJOUT COLONNES MANQUANTES\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n";
$sql .= "-- Généré le: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- Cible: 21 colonnes identiques à game_boy_games, snes_games, etc.\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n\n";

$sql .= "SET FOREIGN_KEY_CHECKS = 0;\n\n";

$totalColumns = 0;

foreach ($tables as $table) {
    echo "🔍 Analyse de {$table}...\n";
    
    // Récupérer les colonnes actuelles
    $columns = DB::select("SHOW COLUMNS FROM `{$table}`");
    $existingColumns = array_map(fn($col) => $col->Field, $columns);
    
    // Trouver les colonnes manquantes
    $missingColumns = array_diff(array_keys($referenceOrder), $existingColumns);
    
    if (empty($missingColumns)) {
        echo "   ✅ Aucune colonne manquante\n\n";
        continue;
    }
    
    echo "   ❌ Colonnes manquantes: " . count($missingColumns) . "\n";
    
    $sql .= "-- ─────────────────────────────────────────────────────────────────────\n";
    $sql .= "-- {$table}: Ajout de " . count($missingColumns) . " colonnes\n";
    $sql .= "-- ─────────────────────────────────────────────────────────────────────\n\n";
    
    $alterStatements = [];
    
    // Trouver la position pour chaque colonne manquante
    foreach (array_keys($referenceOrder) as $columnName) {
        if (in_array($columnName, $missingColumns)) {
            $def = $referenceOrder[$columnName];
            
            // Construire la définition
            $columnDef = "`{$columnName}` {$def['type']} {$def['null']}";
            
            if (isset($def['comment'])) {
                $columnDef .= " COMMENT '" . addslashes($def['comment']) . "'";
            }
            
            // Trouver la colonne précédente existante
            $previousColumn = null;
            $referenceKeys = array_keys($referenceOrder);
            $currentIndex = array_search($columnName, $referenceKeys);
            
            for ($i = $currentIndex - 1; $i >= 0; $i--) {
                if (in_array($referenceKeys[$i], $existingColumns)) {
                    $previousColumn = $referenceKeys[$i];
                    break;
                }
            }
            
            $position = $previousColumn ? "AFTER `{$previousColumn}`" : "FIRST";
            
            $alterStatements[] = "  ADD COLUMN {$columnDef} {$position}";
            $totalColumns++;
        }
    }
    
    $sql .= "ALTER TABLE `{$table}`\n";
    $sql .= implode(",\n", $alterStatements);
    $sql .= ";\n\n";
    
    echo "   ✅ SQL généré: " . count($alterStatements) . " colonnes\n\n";
}

// Copier name → rom_id pour Sega Saturn (0/331 avec rom_id)
$sql .= "-- ─────────────────────────────────────────────────────────────────────\n";
$sql .= "-- Sega Saturn: Copie name → rom_id (comme pour Mega Drive)\n";
$sql .= "-- ─────────────────────────────────────────────────────────────────────\n\n";

$sql .= "UPDATE sega_saturn_games\n";
$sql .= "SET rom_id = name\n";
$sql .= "WHERE rom_id IS NULL OR rom_id = '';\n\n";

$sql .= "SET FOREIGN_KEY_CHECKS = 1;\n\n";

$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n";
$sql .= "-- VÉRIFICATIONS\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n\n";

foreach ($tables as $table) {
    $sql .= "SELECT COUNT(*) as columns FROM information_schema.columns WHERE table_schema = DATABASE() AND table_name = '{$table}';\n";
    $sql .= "SHOW COLUMNS FROM `{$table}`;\n\n";
}

$sql .= "-- Vérifier rom_id Sega Saturn\n";
$sql .= "SELECT \n";
$sql .= "  COUNT(*) as total,\n";
$sql .= "  COUNT(CASE WHEN rom_id IS NOT NULL AND rom_id != '' THEN 1 END) as with_rom_id\n";
$sql .= "FROM sega_saturn_games;\n\n";

$filename = 'uniformize-n64-sega-saturn.sql';
file_put_contents($filename, $sql);

echo "═══════════════════════════════════════════════════════════════════════\n";
echo "✅ Fichier SQL généré: {$filename}\n";
echo "   Taille: " . number_format(filesize($filename) / 1024, 2) . " KB\n";
echo "   Total colonnes à ajouter: {$totalColumns}\n";
echo "\n";
echo "📋 DÉTAILS:\n";
echo "   • n64_games: colonnes à ajouter\n";
echo "   • sega_saturn_games: colonnes à ajouter + UPDATE rom_id\n";
echo "═══════════════════════════════════════════════════════════════════════\n";
