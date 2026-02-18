-- ═══════════════════════════════════════════════════════════════════════
-- RÉORDONNANCEMENT DES COLONNES - nes_games & mega_drive_games
-- ═══════════════════════════════════════════════════════════════════════
-- Généré le: 2026-02-18 20:36:26
-- ═══════════════════════════════════════════════════════════════════════

SET FOREIGN_KEY_CHECKS = 0;

-- ─────────────────────────────────────────────────────────────────────
-- Réordonnancement: nes_games
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `nes_games`
  MODIFY COLUMN `id` bigint unsigned AUTO_INCREMENT FIRST,
  MODIFY COLUMN `rom_id` varchar(255) NULL AFTER `id`,
  MODIFY COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  MODIFY COLUMN `name` varchar(255) NOT NULL AFTER `cartridge_id`,
  MODIFY COLUMN `name_jp` varchar(255) NULL AFTER `name`,
  MODIFY COLUMN `alternate_names` text NULL AFTER `name_jp`,
  MODIFY COLUMN `year` int NULL AFTER `alternate_names`,
  MODIFY COLUMN `publisher` varchar(255) NULL AFTER `year`,
  MODIFY COLUMN `developer` varchar(255) NULL AFTER `publisher`,
  MODIFY COLUMN `region` varchar(50) NULL AFTER `developer`,
  MODIFY COLUMN `slug` varchar(255) NULL AFTER `region`,
  MODIFY COLUMN `image_url` varchar(255) NULL COMMENT 'External image URL' AFTER `slug`,
  MODIFY COLUMN `image_path` varchar(255) NULL AFTER `image_url`,
  MODIFY COLUMN `cloudinary_url` varchar(255) NULL AFTER `image_path`,
  MODIFY COLUMN `libretro_name` varchar(255) NULL AFTER `cloudinary_url`,
  MODIFY COLUMN `match_type` varchar(255) NULL AFTER `libretro_name`,
  MODIFY COLUMN `match_score` decimal(5,2) NULL AFTER `match_type`,
  MODIFY COLUMN `source` varchar(50) NULL COMMENT 'Data source origin' AFTER `match_score`,
  MODIFY COLUMN `price` decimal(10,2) NULL AFTER `source`,
  MODIFY COLUMN `created_at` timestamp NULL AFTER `price`,
  MODIFY COLUMN `updated_at` timestamp NULL AFTER `created_at`;

-- ─────────────────────────────────────────────────────────────────────
-- Réordonnancement: mega_drive_games
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `mega_drive_games`
  MODIFY COLUMN `id` bigint unsigned AUTO_INCREMENT FIRST,
  MODIFY COLUMN `rom_id` varchar(255) NULL AFTER `id`,
  MODIFY COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  MODIFY COLUMN `name` varchar(255) NOT NULL AFTER `cartridge_id`,
  MODIFY COLUMN `name_jp` varchar(255) NULL COMMENT 'Japanese name' AFTER `name`,
  MODIFY COLUMN `alternate_names` text NULL AFTER `name_jp`,
  MODIFY COLUMN `year` varchar(255) NULL AFTER `alternate_names`,
  MODIFY COLUMN `publisher` varchar(255) NULL AFTER `year`,
  MODIFY COLUMN `developer` varchar(255) NULL AFTER `publisher`,
  MODIFY COLUMN `region` varchar(255) NULL AFTER `developer`,
  MODIFY COLUMN `slug` varchar(255) NULL AFTER `region`,
  MODIFY COLUMN `image_url` varchar(255) NULL AFTER `slug`,
  MODIFY COLUMN `image_path` varchar(255) NULL COMMENT 'Local path' AFTER `image_url`,
  MODIFY COLUMN `cloudinary_url` varchar(255) NULL COMMENT 'Cloudinary CDN' AFTER `image_path`,
  MODIFY COLUMN `libretro_name` varchar(255) NULL AFTER `cloudinary_url`,
  MODIFY COLUMN `match_type` varchar(255) NULL AFTER `libretro_name`,
  MODIFY COLUMN `match_score` decimal(5,2) NULL AFTER `match_type`,
  MODIFY COLUMN `source` enum('libretro','manual') NOT NULL DEFAULT 'libretro' AFTER `match_score`,
  MODIFY COLUMN `price` varchar(255) NULL AFTER `source`,
  MODIFY COLUMN `created_at` timestamp NULL AFTER `price`,
  MODIFY COLUMN `updated_at` timestamp NULL AFTER `created_at`;

-- ─────────────────────────────────────────────────────────────────────
-- Réordonnancement: n64_games
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `n64_games`
  MODIFY COLUMN `id` int AUTO_INCREMENT FIRST,
  MODIFY COLUMN `rom_id` varchar(50) NULL COMMENT 'Extracted ROM ID (e.g., NSME, NZLE)' AFTER `id`,
  MODIFY COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  MODIFY COLUMN `name` varchar(512) NOT NULL AFTER `cartridge_id`,
  MODIFY COLUMN `name_jp` varchar(255) NULL COMMENT 'Japanese name' AFTER `name`,
  MODIFY COLUMN `alternate_names` text NULL AFTER `name_jp`,
  MODIFY COLUMN `year` int NULL AFTER `alternate_names`,
  MODIFY COLUMN `publisher` varchar(255) NULL AFTER `year`,
  MODIFY COLUMN `developer` varchar(255) NULL AFTER `publisher`,
  MODIFY COLUMN `region` varchar(50) NULL COMMENT 'Region code (USA, EUR, JPN, etc.)' AFTER `developer`,
  MODIFY COLUMN `slug` varchar(255) NULL AFTER `region`,
  MODIFY COLUMN `image_url` varchar(255) NULL COMMENT 'External image URL' AFTER `slug`,
  MODIFY COLUMN `image_path` varchar(255) NULL AFTER `image_url`,
  MODIFY COLUMN `cloudinary_url` varchar(255) NULL AFTER `image_path`,
  MODIFY COLUMN `libretro_name` varchar(255) NULL AFTER `cloudinary_url`,
  MODIFY COLUMN `match_type` varchar(255) NULL AFTER `libretro_name`,
  MODIFY COLUMN `match_score` decimal(5,2) NULL AFTER `match_type`,
  MODIFY COLUMN `source` varchar(50) NULL COMMENT 'Data source origin' AFTER `match_score`,
  MODIFY COLUMN `price` decimal(10,2) NULL AFTER `source`,
  MODIFY COLUMN `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP AFTER `price`,
  MODIFY COLUMN `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP AFTER `created_at`;

-- ─────────────────────────────────────────────────────────────────────
-- Réordonnancement: sega_saturn_games
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `sega_saturn_games`
  MODIFY COLUMN `id` bigint unsigned AUTO_INCREMENT FIRST,
  MODIFY COLUMN `rom_id` varchar(255) NULL AFTER `id`,
  MODIFY COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  MODIFY COLUMN `name` varchar(255) NOT NULL AFTER `cartridge_id`,
  MODIFY COLUMN `name_jp` varchar(255) NULL COMMENT 'Japanese name' AFTER `name`,
  MODIFY COLUMN `alternate_names` text NULL AFTER `name_jp`,
  MODIFY COLUMN `year` varchar(255) NULL AFTER `alternate_names`,
  MODIFY COLUMN `publisher` varchar(255) NULL AFTER `year`,
  MODIFY COLUMN `developer` varchar(255) NULL AFTER `publisher`,
  MODIFY COLUMN `region` varchar(255) NULL AFTER `developer`,
  MODIFY COLUMN `slug` varchar(255) NULL AFTER `region`,
  MODIFY COLUMN `image_url` varchar(255) NULL AFTER `slug`,
  MODIFY COLUMN `image_path` varchar(255) NULL COMMENT 'Local path' AFTER `image_url`,
  MODIFY COLUMN `cloudinary_url` varchar(255) NULL COMMENT 'Cloudinary CDN' AFTER `image_path`,
  MODIFY COLUMN `libretro_name` varchar(255) NULL AFTER `cloudinary_url`,
  MODIFY COLUMN `match_type` varchar(255) NULL AFTER `libretro_name`,
  MODIFY COLUMN `match_score` decimal(5,2) NULL AFTER `match_type`,
  MODIFY COLUMN `source` enum('libretro','manual') NOT NULL DEFAULT 'libretro' AFTER `match_score`,
  MODIFY COLUMN `price` varchar(255) NULL AFTER `source`,
  MODIFY COLUMN `created_at` timestamp NULL AFTER `price`,
  MODIFY COLUMN `updated_at` timestamp NULL AFTER `created_at`;

SET FOREIGN_KEY_CHECKS = 1;

-- ═══════════════════════════════════════════════════════════════════════
-- VÉRIFICATIONS
-- ═══════════════════════════════════════════════════════════════════════

SHOW COLUMNS FROM `nes_games`;
SHOW COLUMNS FROM `mega_drive_games`;
SHOW COLUMNS FROM `n64_games`;
SHOW COLUMNS FROM `sega_saturn_games`;

-- ═══════════════════════════════════════════════════════════════════════
