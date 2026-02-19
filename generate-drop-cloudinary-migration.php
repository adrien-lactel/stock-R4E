<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║         GÉNÉRATION MIGRATION - SUPPRESSION cloudinary_url (col 14)          ║\n";
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

$sql = "-- ═══════════════════════════════════════════════════════════════════════\n";
$sql .= "-- SUPPRESSION COLONNE cloudinary_url - MIGRATION R2\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n";
$sql .= "-- Généré le: " . date('Y-m-d H:i:s') . "\n";
$sql .= "-- Raison: Migration complète vers Cloudflare R2\n";
$sql .= "-- État: 0/12,798 jeux utilisent cloudinary_url (colonne vide)\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n\n";

$sql .= "SET FOREIGN_KEY_CHECKS = 0;\n\n";

foreach ($tables as $table) {
    $sql .= "-- ─────────────────────────────────────────────────────────────────────\n";
    $sql .= "-- {$table}: DROP cloudinary_url (col 14)\n";
    $sql .= "-- ─────────────────────────────────────────────────────────────────────\n\n";
    
    $sql .= "ALTER TABLE `{$table}`\n";
    $sql .= "DROP COLUMN `cloudinary_url`;\n\n";
}

$sql .= "SET FOREIGN_KEY_CHECKS = 1;\n\n";

$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n";
$sql .= "-- VÉRIFICATIONS POST-MIGRATION\n";
$sql .= "-- ═══════════════════════════════════════════════════════════════════════\n\n";

foreach ($tables as $table) {
    $sql .= "-- Compter les colonnes de {$table} (doit être 20)\n";
    $sql .= "SELECT COUNT(*) as columns \n";
    $sql .= "FROM information_schema.columns \n";
    $sql .= "WHERE table_schema = DATABASE() \n";
    $sql .= "AND table_name = '{$table}';\n\n";
}

$sql .= "-- Afficher toutes les colonnes restantes (ordre de référence sans cloudinary_url)\n";
$sql .= "-- Ordre attendu (20 colonnes):\n";
$sql .= "-- id, rom_id, cartridge_id, name, name_jp, alternate_names, year,\n";
$sql .= "-- publisher, developer, region, slug, image_url, image_path,\n";
$sql .= "-- libretro_name, match_type, match_score, source, price,\n";
$sql .= "-- created_at, updated_at\n\n";

$filename = 'drop-cloudinary-url-column.sql';
file_put_contents($filename, $sql);

echo "✅ Fichier SQL généré: {$filename}\n";
echo "   Taille: " . number_format(filesize($filename) / 1024, 2) . " KB\n\n";

echo "📋 CONTENU:\n";
echo "   • Suppression de cloudinary_url sur 8 tables\n";
echo "   • Schéma final: 21 → 20 colonnes\n";
echo "   • Vérifications post-migration incluses\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n";
