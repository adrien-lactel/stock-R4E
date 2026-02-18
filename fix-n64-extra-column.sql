-- ═══════════════════════════════════════════════════════════════════════
-- FIX N64 - MIGRATION code → cartridge_id ET SUPPRESSION
-- ═══════════════════════════════════════════════════════════════════════
-- Généré le: <?php echo date('Y-m-d H:i:s'); ?>

-- Objectif: Passer n64_games de 22 à 21 colonnes (schéma uniforme)
-- ═══════════════════════════════════════════════════════════════════════

SET FOREIGN_KEY_CHECKS = 0;

-- ─────────────────────────────────────────────────────────────────────
-- Étape 1: Copier code → cartridge_id (818 jeux)
-- ─────────────────────────────────────────────────────────────────────

UPDATE n64_games
SET cartridge_id = code
WHERE cartridge_id IS NULL OR cartridge_id = '';

-- ─────────────────────────────────────────────────────────────────────
-- Étape 2: Supprimer la colonne 'code'
-- ─────────────────────────────────────────────────────────────────────

ALTER TABLE n64_games
DROP COLUMN `code`;

SET FOREIGN_KEY_CHECKS = 1;

-- ═══════════════════════════════════════════════════════════════════════
-- VÉRIFICATIONS
-- ═══════════════════════════════════════════════════════════════════════

-- Nombre de colonnes (doit être 21)
SELECT COUNT(*) as columns 
FROM information_schema.columns 
WHERE table_schema = DATABASE() 
AND table_name = 'n64_games';

-- Vérifier cartridge_id rempli
SELECT 
  COUNT(*) as total,
  COUNT(CASE WHEN cartridge_id IS NOT NULL AND cartridge_id != '' THEN 1 END) as with_cartridge_id,
  ROUND(COUNT(CASE WHEN cartridge_id IS NOT NULL AND cartridge_id != '' THEN 1 END) / COUNT(*) * 100, 1) as percentage
FROM n64_games;

-- Afficher l'ordre des colonnes
SHOW COLUMNS FROM n64_games;
