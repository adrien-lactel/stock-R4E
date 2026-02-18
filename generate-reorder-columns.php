<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║         GÉNÉRATION SQL - RÉORDONNANCEMENT DES COLONNES            ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

// Ordre de référence (game_boy_games, snes_games, wonderswan_games, game_gear_games)
$referenceOrder = [
    'id',
    'rom_id',
    'cartridge_id',
    'name',
    'name_jp',
    'alternate_names',
    'year',
    'publisher',
    'developer',
    'region',
    'slug',
    'image_url',
    'image_path',
    'cloudinary_url',
    'libretro_name',
    'match_type',
    'match_score',
    'source',
    'price',
    'created_at',
    'updated_at',
];

$tablesToFix = ['nes_games', 'mega_drive_games'];

$sql = "-- ═══════════════════════════════════════════════════════════════════════\n";
$sql .= "-- RÉORDONNANCEMENT DES COLONNES - nes_games & mega_drive_games\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n";
$sql .= "-- Généré le: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n\n";

$sql .= "SET FOREIGN_KEY_CHECKS = 0;\n\n";

foreach ($tablesToFix as $table) {
    echo "🔍 Analyse de {$table}...\n";
    
    // Récupérer la structure actuelle
    $columns = DB::select("SHOW FULL COLUMNS FROM `{$table}`");
    $columnMap = [];
    
    foreach ($columns as $col) {
        $columnMap[$col->Field] = [
            'type' => $col->Type,
            'null' => $col->Null === 'YES' ? 'NULL' : 'NOT NULL',
            'default' => $col->Default,
            'extra' => $col->Extra,
            'comment' => $col->Comment ?? '',
        ];
    }
    
    $sql .= "-- ─────────────────────────────────────────────────────────────────────\n";
    $sql .= "-- Réordonnancement: {$table}\n";
    $sql .= "-- ─────────────────────────────────────────────────────────────────────\n\n";
    
    $modifyStatements = [];
    $previousColumn = null;
    
    foreach ($referenceOrder as $columnName) {
        if (!isset($columnMap[$columnName])) {
            echo "   ⚠️  Colonne {$columnName} manquante dans {$table}\n";
            continue;
        }
        
        $def = $columnMap[$columnName];
        
        // Construire la définition complète
        $columnDef = "`{$columnName}` {$def['type']}";
        
        // NOT NULL / NULL
        if ($def['null'] === 'NOT NULL' && $def['extra'] !== 'auto_increment') {
            $columnDef .= " NOT NULL";
        } else if ($def['null'] === 'NULL') {
            $columnDef .= " NULL";
        }
        
        // DEFAULT
        if ($def['default'] !== null && $def['extra'] !== 'auto_increment') {
            if (in_array($def['default'], ['CURRENT_TIMESTAMP', 'current_timestamp()'])) {
                $columnDef .= " DEFAULT CURRENT_TIMESTAMP";
            } else {
                $columnDef .= " DEFAULT '" . addslashes($def['default']) . "'";
            }
        }
        
        // AUTO_INCREMENT
        if ($def['extra'] === 'auto_increment') {
            $columnDef .= " AUTO_INCREMENT";
        }
        
        // ON UPDATE (pour updated_at)
        if ($columnName === 'updated_at' && str_contains($def['extra'], 'on update')) {
            $columnDef .= " ON UPDATE CURRENT_TIMESTAMP";
        }
        
        // COMMENT
        if (!empty($def['comment'])) {
            $columnDef .= " COMMENT '" . addslashes($def['comment']) . "'";
        }
        
        // Position
        if ($previousColumn === null) {
            $position = "FIRST";
        } else {
            $position = "AFTER `{$previousColumn}`";
        }
        
        $modifyStatements[] = "  MODIFY COLUMN {$columnDef} {$position}";
        $previousColumn = $columnName;
    }
    
    $sql .= "ALTER TABLE `{$table}`\n";
    $sql .= implode(",\n", $modifyStatements);
    $sql .= ";\n\n";
    
    echo "   ✅ {$table}: " . count($modifyStatements) . " colonnes à réordonner\n\n";
}

$sql .= "SET FOREIGN_KEY_CHECKS = 1;\n\n";

$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n";
$sql .= "-- VÉRIFICATIONS\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n\n";

foreach ($tablesToFix as $table) {
    $sql .= "SHOW COLUMNS FROM `{$table}`;\n";
}

$sql .= "\n-- ═══════════════════════════════════════════════════════════════════════\n";

$filename = 'reorder-game-tables-columns.sql';
file_put_contents($filename, $sql);

echo "═══════════════════════════════════════════════════════════════════════\n";
echo "✅ Fichier SQL généré: {$filename}\n";
echo "   Taille: " . number_format(filesize($filename) / 1024, 2) . " KB\n";
echo "═══════════════════════════════════════════════════════════════════════\n";
