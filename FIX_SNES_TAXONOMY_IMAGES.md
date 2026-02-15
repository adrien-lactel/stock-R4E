# 🔧 Correction des Images de Taxonomie SNES

## Problème Identifié

Sur la page `https://web-production-f3333.up.railway.app/admin/articles/create`, les images de taxonomie pour les jeux SNES n'étaient pas trouvées.

### Cause Racine

Le système utilisait le **nom complet du jeu** (ex: `"SHVC-MW - Super Mario World"`) comme identifiant pour rechercher les images, alors que les fichiers sur R2 sont nommés avec uniquement le **ROM ID** (ex: `"SHVC-MW-cover.png"`).

**Exemple du problème :**
- Nom du jeu dans ArticleType : `"SHVC-MW - Super Mario World"`
- Identifier utilisé : `"SHVC-MW - Super Mario World"` (si le champ `rom_id` est vide)
- Fichier recherché : `taxonomy/snes/SHVC-MW - Super Mario World-cover.png` ❌
- Fichier réel sur R2 : `taxonomy/snes/SHVC-MW-cover.png` ✅

## Solution Implémentée

### 1. Nouvelle Fonction JavaScript : `extractRomIdFromName()`

Ajoutée dans [form.blade.php](resources/views/admin/consoles/form.blade.php#L1403-1415) :

```javascript
function extractRomIdFromName(name) {
  if (!name) return null;
  
  // Pattern pour extraire le ROM ID au début du nom (ex: "SHVC-MW - Super Mario World" -> "SHVC-MW")
  const match = name.match(/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i);
  if (match) {
    return match[1].toUpperCase();
  }
  
  return null;
}
```

Cette fonction extrait le ROM ID du nom du jeu, compatible avec les préfixes :
- `SHVC-` (Super Famicom - Japon)
- `SNS-` (Super Nintendo - International)
- `DMG-`, `CGB-`, `AGB-` (Game Boy)
- `HVC-`, `NES-` (NES)
- etc.

### 2. Correction de l'Extraction de l'Identifier

Modifié dans **5 endroits** du fichier [form.blade.php](resources/views/admin/consoles/form.blade.php) :

#### A. `openTaxonomyImagesForArticle()` (ligne ~2237)
```javascript
let identifier = romId;
if (!identifier && articleTypeName) {
  // Essayer d'extraire le ROM ID du nom (format: "SHVC-MW - Super Mario World")
  identifier = extractRomIdFromName(articleTypeName);
}
// Fallback sur le nom complet si aucun ROM ID trouvé
if (!identifier) {
  identifier = articleTypeName;
}
```

#### B. `displayGameResult()` (ligne ~3220)
```javascript
identifier = game.rom_id;
if (!identifier && game.name) {
  identifier = extractRomIdFromName(game.name);
}
if (!identifier) {
  identifier = game.slug;
}
```

#### C. `getLocalGameImage()` (ligne ~1435)
#### D. `getGameImageWithFallback()` (ligne ~1502)
#### E. `loadGameLogo()` (ligne ~1800)

Toutes ces fonctions utilisent maintenant la même logique pour extraire le ROM ID.

### 3. Amélioration du Mapping des Dossiers

Remplacé la logique simpliste :
```javascript
folder = (subCategoryName || 'gameboy').toLowerCase().replace(/\s+/g, '');
```

Par un **mapping complet** correspondant exactement aux dossiers R2 (ligne ~2232) :
```javascript
const platformMapping = {
  'game boy advance': 'game boy advance',  // Conserve les espaces
  'game boy color': 'game boy color',      // Conserve les espaces
  'game boy': 'gameboy',
  'super nintendo': 'snes',
  'snes': 'snes',
  'super famicom': 'snes',
  // ... etc.
};
```

## Résultat

✅ **Les images de taxonomie SNES sont maintenant trouvées correctement**

- Le ROM ID est correctement extrait du nom du jeu
- Le dossier `snes` est correctement mappé
- Les URLs générées correspondent aux fichiers sur R2

**Exemple corrigé :**
- Nom du jeu : `"SHVC-MW - Super Mario World"`
- ROM ID extrait : `"SHVC-MW"`
- Dossier : `"snes"`
- Fichier recherché : `taxonomy/snes/SHVC-MW-cover.png` ✅

## Compatibilité

✅ **Aucun impact sur les autres consoles**

La logique de détection des ROM IDs ne s'applique que lorsque nécessaire, et conserve le comportement existant pour :
- WonderSwan (basé sur le nom du fichier)
- Mega Drive (basé sur le nom du fichier)
- Game Gear (basé sur le nom du fichier)
- Sega Saturn (basé sur le nom du fichier)

## Fichiers Modifiés

- ✏️ [resources/views/admin/consoles/form.blade.php](resources/views/admin/consoles/form.blade.php)
  - Ajout de `extractRomIdFromName()` 
  - Correction de `openTaxonomyImagesForArticle()`
  - Correction de `displayGameResult()`
  - Correction de `getLocalGameImage()`
  - Correction de `getGameImageWithFallback()`
  - Correction de `loadGameLogo()`
  - Amélioration du mapping des dossiers

## Date de la Correction

15 février 2026
