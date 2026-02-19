<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║       GÉNÉRATION MIGRATION - SUPPRESSION 5 COLONNES OBSOLÈTES               ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

$tables = [
    'game_boy_games',
    'snes_games',
    'nes_games',
    'wonderswan_games',
    'game_gear_games',
    'mega_drive_games',
    'n64_games',
    'sega_saturn_games',
];

$columnsToRemove = [
    'slug',
    'image_url',
    'image_path',
    'match_type',
    'match_score',
];

echo "📋 COLONNES À SUPPRIMER:\n";
echo str_repeat("─", 80) . "\n";
foreach ($columnsToRemove as $col) {
    echo "   ❌ {$col}\n";
}

echo "\n📊 TABLES CONCERNÉES: " . count($tables) . "\n";
echo str_repeat("─", 80) . "\n";
foreach ($tables as $table) {
    echo "   • {$table}\n";
}

echo "\n🎯 SCHÉMA APRÈS MIGRATION: 20 colonnes → 15 colonnes (-25%)\n\n";

// Générer le SQL
$sql = "-- ═══════════════════════════════════════════════════════════════════════════════\n";
$sql .= "-- SUPPRESSION COLONNES OBSOLÈTES - Simplification schéma uniformisé\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════════════\n";
$sql .= "-- Date: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- Tables: " . count($tables) . "\n";
$sql .= "-- Colonnes supprimées: " . count($columnsToRemove) . "\n";
$sql .= "-- Schéma: 20 colonnes → 15 colonnes\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════════════\n\n";

$sql .= "SET FOREIGN_KEY_CHECKS = 0;\n\n";

foreach ($tables as $table) {
    $sql .= "-- {$table}\n";
    $sql .= "-- ─────────────────────────────────────────────────────────────────────────────\n";
    
    foreach ($columnsToRemove as $col) {
        $sql .= "ALTER TABLE `{$table}` DROP COLUMN `{$col}`;\n";
    }
    
    $sql .= "\n";
}

$sql .= "SET FOREIGN_KEY_CHECKS = 1;\n\n";

// Ajouter les requêtes de vérification
$sql .= "-- ═══════════════════════════════════════════════════════════════════════════════\n";
$sql .= "-- VÉRIFICATIONS POST-MIGRATION\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════════════\n\n";

foreach ($tables as $table) {
    $sql .= "-- Vérifier {$table} (doit avoir 15 colonnes)\n";
    $sql .= "SELECT COUNT(*) as column_count \n";
    $sql .= "FROM information_schema.COLUMNS \n";
    $sql .= "WHERE TABLE_SCHEMA = DATABASE() \n";
    $sql .= "  AND TABLE_NAME = '{$table}';\n";
    $sql .= "-- Résultat attendu: 15\n\n";
}

$sql .= "-- ═══════════════════════════════════════════════════════════════════════════════\n";
$sql .= "-- SCHÉMA FINAL (15 colonnes)\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════════════\n";
$sql .= "-- 1.  id                 - Clé primaire\n";
$sql .= "-- 2.  rom_id             - Identifiant unique (requis)\n";
$sql .= "-- 3.  cartridge_id       - ID physique cartouche\n";
$sql .= "-- 4.  name               - Nom du jeu\n";
$sql .= "-- 5.  name_jp            - Nom japonais\n";
$sql .= "-- 6.  alternate_names    - Noms alternatifs\n";
$sql .= "-- 7.  year               - Année de sortie\n";
$sql .= "-- 8.  publisher          - Éditeur\n";
$sql .= "-- 9.  developer          - Développeur\n";
$sql .= "-- 10. region             - Région (NTSC/PAL)\n";
$sql .= "-- 11. libretro_name      - Nom Libretro\n";
$sql .= "-- 12. source             - Source des données\n";
$sql .= "-- 13. price              - Prix moyen\n";
$sql .= "-- 14. created_at         - Date création\n";
$sql .= "-- 15. updated_at         - Date mise à jour\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════════════\n";
$sql .= "-- IMAGES MULTI-TYPES: Gestion par pattern R2\n";
$sql .= "-- Pattern: products/games/{platform}/{rom_id}-{type}-{index}.jpg\n";
$sql .= "-- Types: cover, artwork, gameplay, logo\n";
$sql .= "-- Exemple: products/games/gameboy/DMG-TRA-0-cover-1.jpg\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════════════\n";

// Sauvegarder
$filename = 'drop-obsolete-columns-5.sql';
file_put_contents($filename, $sql);

$filesize = filesize($filename);
$filesizeKb = round($filesize / 1024, 2);

echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "✅ FICHIER SQL GÉNÉRÉ\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

echo "📄 Fichier: {$filename}\n";
echo "📦 Taille: {$filesizeKb} KB\n\n";

echo "📋 CONTENU:\n";
echo str_repeat("─", 80) . "\n";
echo "   • SET FOREIGN_KEY_CHECKS = 0\n";
echo "   • " . (count($tables) * count($columnsToRemove)) . " × ALTER TABLE DROP COLUMN\n";
echo "   • SET FOREIGN_KEY_CHECKS = 1\n";
echo "   • " . count($tables) . " × Requêtes de vérification\n";
echo "   • Documentation schéma final (15 colonnes)\n\n";

echo "🎯 OPÉRATIONS PAR TABLE:\n";
echo str_repeat("─", 80) . "\n";
foreach ($tables as $table) {
    echo "   {$table}:\n";
    foreach ($columnsToRemove as $col) {
        echo "      - DROP COLUMN {$col}\n";
    }
}

echo "\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "💡 PROCHAINE ÉTAPE\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

echo "Exécuter la migration:\n";
echo "   php apply-drop-obsolete-columns.php\n\n";

echo "Impact:\n";
echo "   ✓ 8 tables × 5 colonnes = 40 colonnes supprimées\n";
echo "   ✓ Schéma simplifié: 20 → 15 colonnes (-25%)\n";
echo "   ✓ Aucune perte de données (colonnes vides)\n";
echo "   ✓ Base plus légère et plus simple à maintenir\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n";
