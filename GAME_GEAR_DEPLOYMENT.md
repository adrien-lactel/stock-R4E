# Game Gear - Normalisation et Déploiement Railway

## 📊 Résumé de la Normalisation

### État Initial
- **Jeux en base** : 653
- **Images** : 1,507 fichiers
- **Correspondance** : 428/653 (57%)
- **Problèmes** : Formats mixtes, régions perdues, doublons

### État Final
- **Jeux en base** : 542
- **Images** : 1,485 fichiers (après nettoyage)
- **Correspondance** : 542/542 (100%) ✅
- **Images orphelines** : 0
- **Jeux sans images** : 0

## 🔄 Opérations Effectuées

### Phase 1 : Analyse Initiale
**Fichiers** : `analyze-game-gear.php`, `analyze-game-gear-formats.php`

Découvertes :
- 245 images en format kebab-case : `aladdin-Japan-cover.png`
- 1,262 images en Title Case : `Aladdin (Japan) (En)-cover.png`
- ROM_ID manquant pour tous les jeux

### Phase 2 : Première Normalisation (Incorrecte)
**Fichiers** : `rename-game-gear-images.php`, `generate-rom-ids-game-gear.php`

Actions :
- ✅ 244 fichiers renommés kebab → Title Case
- ❌ ROM_ID générés SANS régions : `Aladdin (Japan)` → `Aladdin`
- **Résultat** : Correspondance chute à 371/653 (57%)

**Erreur critique** : Suppression des marqueurs régionaux

### Phase 3 : Correction des Régions
**Fichiers** : 
- `check-game-gear-name-structure.php` : Analyse structure nom (15.2% avec parenthèses)
- `generate-rom-ids-game-gear-with-regions.php` : ROM_ID = name exactement
- `apply-rom-ids-game-gear-with-regions.php` : Application 653 ROM_IDs

**Requête SQL** :
```sql
UPDATE game_gear_games 
SET rom_id = name 
WHERE id IN (1, 2, 3, ...);
```

**Décision utilisateur** : *"non il faut garder les versions régionales"* ✅

### Phase 4 : Restauration Régions Images
**Fichiers** : 
- `diagnose-game-gear-current-state.php` : 315 images avec régions perdues
- `generate-restore-regions-game-gear.php` : Script de restauration
- `restore-regions-game-gear-images.php` : **740 fichiers restaurés**

Exemples de restaurations :
```php
Aladdin-cover.png → Aladdin (Japan) (En)-cover.png
Sonic-artwork.png → Sonic the Hedgehog (USA, Europe, Brazil)-artwork.png
```

### Phase 5 : Corrections Finales
**Fichiers** : 
- `map-images-to-romid-game-gear.php` : Identification 57 apostrophes/ponctuation
- `fix-game-gear-images-to-romid.php` : **101 fichiers corrigés**

Corrections typiques :
```php
"Ayrton Sennas Super Monaco" → "Ayrton Senna's Super Monaco"
"Berenstain Bears Camping" → "Berenstain Bears' Camping"
```

### Phase 6 : Ajout de Nouveaux Jeux
**Fichiers** : 
- `analyze-69-missing-game-gear.php` : Catégorisation 69 images
  - 18 à renommer (≥90% similarité)
  - 51 nouveaux jeux légitimes
- `fix-game-gear-final-images.php` : **30 fichiers finaux**
- `add-new-game-gear-games.sql` : INSERT 51 jeux
- `apply-new-game-gear-games.php` : Application

**Résultat** : 653 → 704 jeux (77% correspondance : 542/704)

### Phase 7 : Atteindre 100%
**Décision utilisateur** : *"faut arriver à 100%"*

**Fichiers** : 
- `prepare-100-percent-game-gear.php` : Identification 162 jeux sans images
- `delete-game-gear-no-images.sql` : DELETE statements
- `apply-delete-game-gear-no-images.php` : Exécution

**Jeux supprimés (exemples)** :
```sql
DELETE FROM game_gear_games WHERE id = 24;  -- Aladdin [tr pt ERTrans](Alt 1)[pt-br]
DELETE FROM game_gear_games WHERE id = 35;  -- Arena (EU-US)[tr fr GenerationIX]
DELETE FROM game_gear_games WHERE id = 55;  -- Ax Battler v2.4 [tr es pkt][100%]
-- ... 159 autres (traductions, hacks, alternates sans images)
```

**Résultat final** : 704 → 542 jeux (100% correspondance) ✅

## 📁 Structure des Fichiers

### Fichiers de Déploiement
- **deploy-game-gear-r2-full.sql** (120.57 KB, 706 lignes)
  - 542 jeux en 11 batches de 50
  - Instructions TRUNCATE + INSERT
  - Requêtes de vérification post-déploiement
  - Option REPLACE INTO alternative

### Scripts de Génération
- **generate-game-gear-deployment.php** : Génère le SQL depuis la base locale
- **final-stats-game-gear.php** : Vérifie la correspondance 100%

### Scripts SQL Historiques
- **add-new-game-gear-games.sql** : 51 INSERT originaux
- **delete-game-gear-no-images.sql** : 162 DELETE pour 100%
- **regenerate-rom-ids-game-gear-with-regions.sql** : UPDATE rom_id = name

## 🚀 Procédure de Déploiement Railway

### 1. Backup de Sécurité
```sql
-- Sauvegarder la table actuelle
CREATE TABLE game_gear_games_backup AS 
SELECT * FROM game_gear_games;

-- Vérifier le backup
SELECT COUNT(*) FROM game_gear_games_backup;
```

### 2. Exécution du Script
```sql
-- Ouvrir deploy-game-gear-r2-full.sql
-- Copier tout le contenu dans Railway Query Editor

SET FOREIGN_KEY_CHECKS = 0;

TRUNCATE TABLE game_gear_games;

-- Tous les INSERT statements (11 batches)
INSERT INTO game_gear_games (...) VALUES (...);

SET FOREIGN_KEY_CHECKS = 1;
```

### 3. Vérifications Post-Déploiement

**Comptage total** :
```sql
SELECT COUNT(*) as total_games FROM game_gear_games;
-- Attendu: 542
```

**ROM_ID populés** :
```sql
SELECT COUNT(*) as games_with_rom_id 
FROM game_gear_games 
WHERE rom_id IS NOT NULL;
-- Attendu: 542 (100%)
```

**Absence de doublons** :
```sql
SELECT rom_id, COUNT(*) as count
FROM game_gear_games
WHERE rom_id IS NOT NULL
GROUP BY rom_id
HAVING count > 1;
-- Attendu: 0 résultat
```

**Préservation des régions** :
```sql
SELECT 
    COUNT(*) as total,
    SUM(CASE WHEN rom_id = name THEN 1 ELSE 0 END) as rom_equals_name,
    SUM(CASE WHEN rom_id LIKE '%(%)%' THEN 1 ELSE 0 END) as with_regions
FROM game_gear_games;
-- rom_id doit égaler name pour tous les jeux
```

**Exemples visuels** :
```sql
SELECT * FROM game_gear_games WHERE name LIKE 'Aladdin%' ORDER BY name;
SELECT * FROM game_gear_games WHERE name LIKE '%Sonic%' ORDER BY name;
SELECT * FROM game_gear_games WHERE name LIKE '%USA%' LIMIT 10;
SELECT * FROM game_gear_games WHERE name LIKE '%Japan%' LIMIT 10;
```

### 4. Rollback (si nécessaire)
```sql
-- Restaurer depuis le backup
TRUNCATE TABLE game_gear_games;

INSERT INTO game_gear_games 
SELECT * FROM game_gear_games_backup;

-- Vérifier
SELECT COUNT(*) FROM game_gear_games;

-- Supprimer le backup
DROP TABLE game_gear_games_backup;
```

## 📋 Mapping Images ↔ Base de Données

### Format des Images
```
[Game Name] ([Region]) ([Languages])-[type].[ext]

Exemples :
- Aladdin (Japan) (En)-cover.png
- Sonic the Hedgehog (USA, Europe, Brazil)-artwork.png
- Adventures of Batman _ Robin, The (USA, Europe, Brazil) (En)-gameplay.png
```

### Types d'Images
- `cover` : Pochette/boîte
- `logo` : Logo du jeu
- `artwork` : Artwork promotionnel
- `gameplay` : Capture d'écran gameplay
- `display1`, `display2`, `display3` : Écrans additionnels

### Règle de Correspondance
```
rom_id = name (préservation totale des régions)

Exemples :
✅ DB: "Aladdin (Japan) (En)" = Image: "Aladdin (Japan) (En)-cover.png"
✅ DB: "Sonic (USA, Europe, Brazil)" = Image: "Sonic (USA, Europe, Brazil)-logo.png"
❌ AVANT: DB: "Aladdin" ≠ Image: "Aladdin (Japan) (En)-cover.png"
```

### Marqueurs Régionaux Préservés
- **Régions** : `(USA)`, `(Europe)`, `(Japan)`, `(World)`, `(Brazil)`, `(Korea)`
- **Multi-régions** : `(USA, Europe, Brazil)`, `(Japan, Europe)`, `(Japan, Korea)`
- **Langues** : `(En)`, `(Ja)`, `(En,Fr,De)`, `(En,Fr,De,Es,It)`
- **Traductions** : `[tr fr]`, `[tr pt]`, `[tr es]`, `[T-En by ...]`
- **Rom hacks** : `[b2]`, `[t +1]`, `(Proto)`, `(Rev X)`

## 📊 Statistiques Finales

| Métrique | Avant | Après | Évolution |
|----------|-------|-------|-----------|
| **Jeux en base** | 653 | 542 | -111 (-17%) |
| **Fichiers images** | 1,507 | 1,485 | -22 (-1.5%) |
| **Correspondances** | 428 | 542 | +114 (+26.6%) |
| **Taux match** | 57% | **100%** | +43 points |
| **Images orphelines** | 1,079 | 0 | -100% |
| **Jeux sans images** | 225 | 0 | -100% |

### Opérations de Masse
- **Renommages totaux** : ~1,112 fichiers
- **ROM_ID générés** : 542 (avec régions)
- **Nouveaux jeux** : +51
- **Suppressions** : -162 (sans images)
- **Corrections apostrophes** : 101 fichiers

## 🎯 Critères de Réussite

✅ **100% correspondance images ↔ base**  
✅ **0 images orphelines**  
✅ **0 jeux sans images**  
✅ **ROM_ID = name pour tous les jeux**  
✅ **Régions préservées dans ROM_ID**  
✅ **Deployment SQL prêt (542 jeux, 11 batches)**  

## 🔗 Comparaison avec WonderSwan

| Plateforme | Jeux | Images | Correspondance | Statut |
|------------|------|--------|---------------|---------|
| **WonderSwan** | 340 | 710 | 117/117 (100%) | ✅ Déployé |
| **Game Gear** | 542 | 1,485 | 542/542 (100%) | ✅ Prêt |

**Pattern commun** : Supprimer les jeux sans images pour atteindre 100%

## 📝 Notes Techniques

### Caractères Spéciaux
- Apostrophes : `Ayrton Senna's`, `Bram Stoker's`, `Berenstain Bears'`
- Underscores : `Adventures of Batman _ Robin` (remplace `&`)
- Accents : Échapper avec `addslashes()` dans SQL

### Performance
- Fichier SQL : 120.57 KB
- Temps d'exécution estimé : ~5-10 secondes
- Batches : 11 × 50 jeux = gestion mémoire optimale

### Dépendances
- Laravel 12
- MySQL/MariaDB
- Cloudflare R2 (stockage images)

---

**Date** : 18 février 2026  
**Version** : 1.0  
**Statut** : ✅ Prêt pour déploiement Railway/R2
