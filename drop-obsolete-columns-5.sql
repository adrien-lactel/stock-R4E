-- ═══════════════════════════════════════════════════════════════════════════════
-- SUPPRESSION COLONNES OBSOLÈTES - Simplification schéma uniformisé
-- ═══════════════════════════════════════════════════════════════════════════════
-- Date: 2026-02-19 18:06:09
-- Tables: 8
-- Colonnes supprimées: 5
-- Schéma: 20 colonnes → 15 colonnes
-- ═══════════════════════════════════════════════════════════════════════════════

SET FOREIGN_KEY_CHECKS = 0;

-- game_boy_games
-- ─────────────────────────────────────────────────────────────────────────────
ALTER TABLE `game_boy_games` DROP COLUMN `slug`;
ALTER TABLE `game_boy_games` DROP COLUMN `image_url`;
ALTER TABLE `game_boy_games` DROP COLUMN `image_path`;
ALTER TABLE `game_boy_games` DROP COLUMN `match_type`;
ALTER TABLE `game_boy_games` DROP COLUMN `match_score`;

-- snes_games
-- ─────────────────────────────────────────────────────────────────────────────
ALTER TABLE `snes_games` DROP COLUMN `slug`;
ALTER TABLE `snes_games` DROP COLUMN `image_url`;
ALTER TABLE `snes_games` DROP COLUMN `image_path`;
ALTER TABLE `snes_games` DROP COLUMN `match_type`;
ALTER TABLE `snes_games` DROP COLUMN `match_score`;

-- nes_games
-- ─────────────────────────────────────────────────────────────────────────────
ALTER TABLE `nes_games` DROP COLUMN `slug`;
ALTER TABLE `nes_games` DROP COLUMN `image_url`;
ALTER TABLE `nes_games` DROP COLUMN `image_path`;
ALTER TABLE `nes_games` DROP COLUMN `match_type`;
ALTER TABLE `nes_games` DROP COLUMN `match_score`;

-- wonderswan_games
-- ─────────────────────────────────────────────────────────────────────────────
ALTER TABLE `wonderswan_games` DROP COLUMN `slug`;
ALTER TABLE `wonderswan_games` DROP COLUMN `image_url`;
ALTER TABLE `wonderswan_games` DROP COLUMN `image_path`;
ALTER TABLE `wonderswan_games` DROP COLUMN `match_type`;
ALTER TABLE `wonderswan_games` DROP COLUMN `match_score`;

-- game_gear_games
-- ─────────────────────────────────────────────────────────────────────────────
ALTER TABLE `game_gear_games` DROP COLUMN `slug`;
ALTER TABLE `game_gear_games` DROP COLUMN `image_url`;
ALTER TABLE `game_gear_games` DROP COLUMN `image_path`;
ALTER TABLE `game_gear_games` DROP COLUMN `match_type`;
ALTER TABLE `game_gear_games` DROP COLUMN `match_score`;

-- mega_drive_games
-- ─────────────────────────────────────────────────────────────────────────────
ALTER TABLE `mega_drive_games` DROP COLUMN `slug`;
ALTER TABLE `mega_drive_games` DROP COLUMN `image_url`;
ALTER TABLE `mega_drive_games` DROP COLUMN `image_path`;
ALTER TABLE `mega_drive_games` DROP COLUMN `match_type`;
ALTER TABLE `mega_drive_games` DROP COLUMN `match_score`;

-- n64_games
-- ─────────────────────────────────────────────────────────────────────────────
ALTER TABLE `n64_games` DROP COLUMN `slug`;
ALTER TABLE `n64_games` DROP COLUMN `image_url`;
ALTER TABLE `n64_games` DROP COLUMN `image_path`;
ALTER TABLE `n64_games` DROP COLUMN `match_type`;
ALTER TABLE `n64_games` DROP COLUMN `match_score`;

-- sega_saturn_games
-- ─────────────────────────────────────────────────────────────────────────────
ALTER TABLE `sega_saturn_games` DROP COLUMN `slug`;
ALTER TABLE `sega_saturn_games` DROP COLUMN `image_url`;
ALTER TABLE `sega_saturn_games` DROP COLUMN `image_path`;
ALTER TABLE `sega_saturn_games` DROP COLUMN `match_type`;
ALTER TABLE `sega_saturn_games` DROP COLUMN `match_score`;

SET FOREIGN_KEY_CHECKS = 1;

-- ═══════════════════════════════════════════════════════════════════════════════
-- VÉRIFICATIONS POST-MIGRATION
-- ═══════════════════════════════════════════════════════════════════════════════

-- Vérifier game_boy_games (doit avoir 15 colonnes)
SELECT COUNT(*) as column_count 
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
  AND TABLE_NAME = 'game_boy_games';
-- Résultat attendu: 15

-- Vérifier snes_games (doit avoir 15 colonnes)
SELECT COUNT(*) as column_count 
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
  AND TABLE_NAME = 'snes_games';
-- Résultat attendu: 15

-- Vérifier nes_games (doit avoir 15 colonnes)
SELECT COUNT(*) as column_count 
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
  AND TABLE_NAME = 'nes_games';
-- Résultat attendu: 15

-- Vérifier wonderswan_games (doit avoir 15 colonnes)
SELECT COUNT(*) as column_count 
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
  AND TABLE_NAME = 'wonderswan_games';
-- Résultat attendu: 15

-- Vérifier game_gear_games (doit avoir 15 colonnes)
SELECT COUNT(*) as column_count 
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
  AND TABLE_NAME = 'game_gear_games';
-- Résultat attendu: 15

-- Vérifier mega_drive_games (doit avoir 15 colonnes)
SELECT COUNT(*) as column_count 
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
  AND TABLE_NAME = 'mega_drive_games';
-- Résultat attendu: 15

-- Vérifier n64_games (doit avoir 15 colonnes)
SELECT COUNT(*) as column_count 
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
  AND TABLE_NAME = 'n64_games';
-- Résultat attendu: 15

-- Vérifier sega_saturn_games (doit avoir 15 colonnes)
SELECT COUNT(*) as column_count 
FROM information_schema.COLUMNS 
WHERE TABLE_SCHEMA = DATABASE() 
  AND TABLE_NAME = 'sega_saturn_games';
-- Résultat attendu: 15

-- ═══════════════════════════════════════════════════════════════════════════════
-- SCHÉMA FINAL (15 colonnes)
-- ═══════════════════════════════════════════════════════════════════════════════
-- 1.  id                 - Clé primaire
-- 2.  rom_id             - Identifiant unique (requis)
-- 3.  cartridge_id       - ID physique cartouche
-- 4.  name               - Nom du jeu
-- 5.  name_jp            - Nom japonais
-- 6.  alternate_names    - Noms alternatifs
-- 7.  year               - Année de sortie
-- 8.  publisher          - Éditeur
-- 9.  developer          - Développeur
-- 10. region             - Région (NTSC/PAL)
-- 11. libretro_name      - Nom Libretro
-- 12. source             - Source des données
-- 13. price              - Prix moyen
-- 14. created_at         - Date création
-- 15. updated_at         - Date mise à jour
-- ═══════════════════════════════════════════════════════════════════════════════
-- IMAGES MULTI-TYPES: Gestion par pattern R2
-- Pattern: products/games/{platform}/{rom_id}-{type}-{index}.jpg
-- Types: cover, artwork, gameplay, logo
-- Exemple: products/games/gameboy/DMG-TRA-0-cover-1.jpg
-- ═══════════════════════════════════════════════════════════════════════════════
