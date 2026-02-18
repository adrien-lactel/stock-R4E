-- ═══════════════════════════════════════════════════════════════════════
-- UNIFORMISATION N64 & SEGA SATURN - AJOUT COLONNES MANQUANTES
-- ═══════════════════════════════════════════════════════════════════════
-- Généré le: 2026-02-18 20:33:17
-- Cible: 21 colonnes identiques à game_boy_games, snes_games, etc.
-- ═══════════════════════════════════════════════════════════════════════

SET FOREIGN_KEY_CHECKS = 0;

-- ─────────────────────────────────────────────────────────────────────
-- n64_games: Ajout de 8 colonnes
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `n64_games`
  ADD COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  ADD COLUMN `name_jp` varchar(255) NULL COMMENT 'Japanese name' AFTER `name`,
  ADD COLUMN `slug` varchar(255) NULL AFTER `region`,
  ADD COLUMN `image_url` varchar(255) NULL COMMENT 'External image URL' AFTER `region`,
  ADD COLUMN `libretro_name` varchar(255) NULL AFTER `cloudinary_url`,
  ADD COLUMN `match_type` varchar(255) NULL AFTER `cloudinary_url`,
  ADD COLUMN `match_score` decimal(5,2) NULL AFTER `cloudinary_url`,
  ADD COLUMN `source` varchar(50) NULL COMMENT 'Data source origin' AFTER `cloudinary_url`;

-- ─────────────────────────────────────────────────────────────────────
-- sega_saturn_games: Ajout de 8 colonnes
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `sega_saturn_games`
  ADD COLUMN `cartridge_id` varchar(50) NULL COMMENT 'SNES physical cartridge ID' AFTER `rom_id`,
  ADD COLUMN `name_jp` varchar(255) NULL COMMENT 'Japanese name' AFTER `name`,
  ADD COLUMN `slug` varchar(255) NULL AFTER `region`,
  ADD COLUMN `image_path` varchar(255) NULL COMMENT 'Local path' AFTER `image_url`,
  ADD COLUMN `cloudinary_url` varchar(255) NULL COMMENT 'Cloudinary CDN' AFTER `image_url`,
  ADD COLUMN `libretro_name` varchar(255) NULL AFTER `image_url`,
  ADD COLUMN `match_type` varchar(255) NULL AFTER `image_url`,
  ADD COLUMN `match_score` decimal(5,2) NULL AFTER `image_url`;

-- ─────────────────────────────────────────────────────────────────────
-- Sega Saturn: Copie name → rom_id (comme pour Mega Drive)
-- ─────────────────────────────────────────────────────────────────────

UPDATE sega_saturn_games
SET rom_id = name
WHERE rom_id IS NULL OR rom_id = '';

SET FOREIGN_KEY_CHECKS = 1;

-- ═══════════════════════════════════════════════════════════════════════
-- VÉRIFICATIONS
-- ═══════════════════════════════════════════════════════════════════════

SELECT COUNT(*) as columns FROM information_schema.columns WHERE table_schema = DATABASE() AND table_name = 'n64_games';
SHOW COLUMNS FROM `n64_games`;

SELECT COUNT(*) as columns FROM information_schema.columns WHERE table_schema = DATABASE() AND table_name = 'sega_saturn_games';
SHOW COLUMNS FROM `sega_saturn_games`;

-- Vérifier rom_id Sega Saturn
SELECT 
  COUNT(*) as total,
  COUNT(CASE WHEN rom_id IS NOT NULL AND rom_id != '' THEN 1 END) as with_rom_id
FROM sega_saturn_games;

