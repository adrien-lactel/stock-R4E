-- ═══════════════════════════════════════════════════════════════════════
-- SUPPRESSION COLONNE cloudinary_url - MIGRATION R2
-- ═══════════════════════════════════════════════════════════════════════
-- Généré le: 2026-02-18 20:41:45
-- Raison: Migration complète vers Cloudflare R2
-- État: 0/12,798 jeux utilisent cloudinary_url (colonne vide)
-- ═══════════════════════════════════════════════════════════════════════

SET FOREIGN_KEY_CHECKS = 0;

-- ─────────────────────────────────────────────────────────────────────
-- game_boy_games: DROP cloudinary_url (col 14)
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `game_boy_games`
DROP COLUMN `cloudinary_url`;

-- ─────────────────────────────────────────────────────────────────────
-- snes_games: DROP cloudinary_url (col 14)
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `snes_games`
DROP COLUMN `cloudinary_url`;

-- ─────────────────────────────────────────────────────────────────────
-- nes_games: DROP cloudinary_url (col 14)
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `nes_games`
DROP COLUMN `cloudinary_url`;

-- ─────────────────────────────────────────────────────────────────────
-- wonderswan_games: DROP cloudinary_url (col 14)
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `wonderswan_games`
DROP COLUMN `cloudinary_url`;

-- ─────────────────────────────────────────────────────────────────────
-- game_gear_games: DROP cloudinary_url (col 14)
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `game_gear_games`
DROP COLUMN `cloudinary_url`;

-- ─────────────────────────────────────────────────────────────────────
-- mega_drive_games: DROP cloudinary_url (col 14)
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `mega_drive_games`
DROP COLUMN `cloudinary_url`;

-- ─────────────────────────────────────────────────────────────────────
-- n64_games: DROP cloudinary_url (col 14)
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `n64_games`
DROP COLUMN `cloudinary_url`;

-- ─────────────────────────────────────────────────────────────────────
-- sega_saturn_games: DROP cloudinary_url (col 14)
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE `sega_saturn_games`
DROP COLUMN `cloudinary_url`;

SET FOREIGN_KEY_CHECKS = 1;

-- ═══════════════════════════════════════════════════════════════════════
-- VÉRIFICATIONS POST-MIGRATION
-- ═══════════════════════════════════════════════════════════════════════

-- Compter les colonnes de game_boy_games (doit être 20)
SELECT COUNT(*) as columns 
FROM information_schema.columns 
WHERE table_schema = DATABASE() 
AND table_name = 'game_boy_games';

-- Compter les colonnes de snes_games (doit être 20)
SELECT COUNT(*) as columns 
FROM information_schema.columns 
WHERE table_schema = DATABASE() 
AND table_name = 'snes_games';

-- Compter les colonnes de nes_games (doit être 20)
SELECT COUNT(*) as columns 
FROM information_schema.columns 
WHERE table_schema = DATABASE() 
AND table_name = 'nes_games';

-- Compter les colonnes de wonderswan_games (doit être 20)
SELECT COUNT(*) as columns 
FROM information_schema.columns 
WHERE table_schema = DATABASE() 
AND table_name = 'wonderswan_games';

-- Compter les colonnes de game_gear_games (doit être 20)
SELECT COUNT(*) as columns 
FROM information_schema.columns 
WHERE table_schema = DATABASE() 
AND table_name = 'game_gear_games';

-- Compter les colonnes de mega_drive_games (doit être 20)
SELECT COUNT(*) as columns 
FROM information_schema.columns 
WHERE table_schema = DATABASE() 
AND table_name = 'mega_drive_games';

-- Compter les colonnes de n64_games (doit être 20)
SELECT COUNT(*) as columns 
FROM information_schema.columns 
WHERE table_schema = DATABASE() 
AND table_name = 'n64_games';

-- Compter les colonnes de sega_saturn_games (doit être 20)
SELECT COUNT(*) as columns 
FROM information_schema.columns 
WHERE table_schema = DATABASE() 
AND table_name = 'sega_saturn_games';

-- Afficher toutes les colonnes restantes (ordre de référence sans cloudinary_url)
-- Ordre attendu (20 colonnes):
-- id, rom_id, cartridge_id, name, name_jp, alternate_names, year,
-- publisher, developer, region, slug, image_url, image_path,
-- libretro_name, match_type, match_score, source, price,
-- created_at, updated_at

