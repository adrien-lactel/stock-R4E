-- ============================================================================
-- UNIFORMISATION DE TOUTES LES TABLES DE JEUX
-- Date: 2026-02-18 20:22:58
-- Objectif: Mêmes colonnes, même ordre, mêmes noms dans toutes les tables
-- ============================================================================

-- AVERTISSEMENT: Testez d'abord sur une copie de la base de données!
-- Créez un backup avant d'exécuter:
-- mysqldump -u root stock_r4e > backup_before_uniformisation.sql

SET FOREIGN_KEY_CHECKS = 0;

-- ============================================================================
-- TABLE: game_boy_games
-- ============================================================================

ALTER TABLE `game_boy_games`
  ADD COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  ADD COLUMN `name_jp` varchar(255) NULL COMMENT 'Japanese name' AFTER `name`,
  ADD COLUMN `slug` varchar(255) NULL AFTER `region`,
  ADD COLUMN `image_url` varchar(255) NULL COMMENT 'External image URL' AFTER `slug`,
  ADD COLUMN `image_path` varchar(255) NULL COMMENT 'Local path' AFTER `image_url`,
  ADD COLUMN `cloudinary_url` varchar(255) NULL COMMENT 'Cloudinary CDN' AFTER `image_path`,
  ADD COLUMN `libretro_name` varchar(255) NULL AFTER `cloudinary_url`,
  ADD COLUMN `match_type` varchar(255) NULL AFTER `libretro_name`,
  ADD COLUMN `match_score` decimal(5,2) NULL AFTER `match_type`,
  ADD COLUMN `source` varchar(50) NULL COMMENT 'Data source origin' AFTER `match_score`;

-- ============================================================================
-- TABLE: snes_games
-- ============================================================================

ALTER TABLE `snes_games`
  ADD COLUMN `name_jp` varchar(255) NULL COMMENT 'Japanese name' AFTER `name`,
  ADD COLUMN `slug` varchar(255) NULL AFTER `region`,
  ADD COLUMN `image_url` varchar(255) NULL COMMENT 'External image URL' AFTER `slug`,
  ADD COLUMN `image_path` varchar(255) NULL COMMENT 'Local path' AFTER `image_url`,
  ADD COLUMN `cloudinary_url` varchar(255) NULL COMMENT 'Cloudinary CDN' AFTER `image_path`,
  ADD COLUMN `libretro_name` varchar(255) NULL AFTER `cloudinary_url`,
  ADD COLUMN `match_type` varchar(255) NULL AFTER `libretro_name`,
  ADD COLUMN `match_score` decimal(5,2) NULL AFTER `match_type`,
  ADD COLUMN `source` varchar(50) NULL COMMENT 'Data source origin' AFTER `match_score`;

-- ============================================================================
-- TABLE: nes_games
-- ============================================================================

ALTER TABLE `nes_games`
  ADD COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  ADD COLUMN `slug` varchar(255) NULL AFTER `region`,
  ADD COLUMN `image_url` varchar(255) NULL COMMENT 'External image URL' AFTER `slug`,
  ADD COLUMN `source` varchar(50) NULL COMMENT 'Data source origin' AFTER `match_score`;

-- ============================================================================
-- TABLE: wonderswan_games
-- ============================================================================

ALTER TABLE `wonderswan_games`
  ADD COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  ADD COLUMN `name_jp` varchar(255) NULL COMMENT 'Japanese name' AFTER `name`,
  ADD COLUMN `slug` varchar(255) NULL AFTER `region`,
  ADD COLUMN `image_url` varchar(255) NULL COMMENT 'External image URL' AFTER `slug`,
  ADD COLUMN `image_path` varchar(255) NULL COMMENT 'Local path' AFTER `image_url`,
  ADD COLUMN `cloudinary_url` varchar(255) NULL COMMENT 'Cloudinary CDN' AFTER `image_path`,
  ADD COLUMN `libretro_name` varchar(255) NULL AFTER `cloudinary_url`,
  ADD COLUMN `match_type` varchar(255) NULL AFTER `libretro_name`,
  ADD COLUMN `match_score` decimal(5,2) NULL AFTER `match_type`,
  ADD COLUMN `source` varchar(50) NULL COMMENT 'Data source origin' AFTER `match_score`;

-- ============================================================================
-- TABLE: game_gear_games
-- ============================================================================

ALTER TABLE `game_gear_games`
  ADD COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  ADD COLUMN `name_jp` varchar(255) NULL COMMENT 'Japanese name' AFTER `name`,
  ADD COLUMN `image_url` varchar(255) NULL COMMENT 'External image URL' AFTER `slug`,
  ADD COLUMN `image_path` varchar(255) NULL COMMENT 'Local path' AFTER `image_url`,
  ADD COLUMN `cloudinary_url` varchar(255) NULL COMMENT 'Cloudinary CDN' AFTER `image_path`,
  ADD COLUMN `libretro_name` varchar(255) NULL AFTER `cloudinary_url`,
  ADD COLUMN `match_type` varchar(255) NULL AFTER `libretro_name`,
  ADD COLUMN `match_score` decimal(5,2) NULL AFTER `match_type`,
  ADD COLUMN `source` varchar(50) NULL COMMENT 'Data source origin' AFTER `match_score`;

-- ============================================================================
-- TABLE: mega_drive_games
-- ============================================================================

ALTER TABLE `mega_drive_games`
  ADD COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  ADD COLUMN `name_jp` varchar(255) NULL COMMENT 'Japanese name' AFTER `name`,
  ADD COLUMN `slug` varchar(255) NULL AFTER `region`,
  ADD COLUMN `image_path` varchar(255) NULL COMMENT 'Local path' AFTER `image_url`,
  ADD COLUMN `cloudinary_url` varchar(255) NULL COMMENT 'Cloudinary CDN' AFTER `image_path`,
  ADD COLUMN `libretro_name` varchar(255) NULL AFTER `cloudinary_url`,
  ADD COLUMN `match_type` varchar(255) NULL AFTER `libretro_name`,
  ADD COLUMN `match_score` decimal(5,2) NULL AFTER `match_type`;


-- ============================================================================
-- COPIER name → rom_id POUR LES TABLES SEGA (si rom_id NULL)
-- ============================================================================

-- Mega Drive: 26 jeux avec rom_id NULL
UPDATE mega_drive_games
SET rom_id = name
WHERE rom_id IS NULL OR rom_id = '';

-- Vérification Mega Drive
SELECT COUNT(*) as total, 
       SUM(CASE WHEN rom_id IS NOT NULL THEN 1 ELSE 0 END) as with_rom_id,
       SUM(CASE WHEN rom_id IS NULL THEN 1 ELSE 0 END) as without_rom_id
FROM mega_drive_games;
-- Attendu: total=26, with_rom_id=26, without_rom_id=0

-- Game Gear: Vérification (déjà fait - 542/542)
SELECT COUNT(*) as total,
       SUM(CASE WHEN rom_id IS NOT NULL THEN 1 ELSE 0 END) as with_rom_id
FROM game_gear_games;
-- Attendu: total=542, with_rom_id=542

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================================
-- VÉRIFICATIONS POST-MIGRATION
-- ============================================================================

-- game_boy_games
SHOW COLUMNS FROM `game_boy_games`;
SELECT COUNT(*) as total FROM `game_boy_games`;

-- snes_games
SHOW COLUMNS FROM `snes_games`;
SELECT COUNT(*) as total FROM `snes_games`;

-- nes_games
SHOW COLUMNS FROM `nes_games`;
SELECT COUNT(*) as total FROM `nes_games`;

-- wonderswan_games
SHOW COLUMNS FROM `wonderswan_games`;
SELECT COUNT(*) as total FROM `wonderswan_games`;

-- game_gear_games
SHOW COLUMNS FROM `game_gear_games`;
SELECT COUNT(*) as total FROM `game_gear_games`;

-- mega_drive_games
SHOW COLUMNS FROM `mega_drive_games`;
SELECT COUNT(*) as total FROM `mega_drive_games`;

-- Vérifier que toutes les tables ont les mêmes colonnes
SELECT 
    TABLE_NAME,
    COUNT(*) as column_count,
    GROUP_CONCAT(COLUMN_NAME ORDER BY ORDINAL_POSITION) as columns
FROM INFORMATION_SCHEMA.COLUMNS
WHERE TABLE_SCHEMA = 'stock_r4e'
  AND TABLE_NAME IN ('game_boy_games', 'snes_games', 'nes_games', 'wonderswan_games', 'game_gear_games', 'mega_drive_games')
GROUP BY TABLE_NAME
ORDER BY TABLE_NAME;
-- Toutes les tables doivent avoir 21 colonnes dans le même ordre

-- ============================================================================
-- FIN DE LA MIGRATION
-- ============================================================================
