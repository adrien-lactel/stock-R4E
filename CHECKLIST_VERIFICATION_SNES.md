# ✅ Checklist de Vérification - Correction SNES

## Avant déploiement

- [ ] Vérifier que le fichier [resources/views/admin/consoles/form.blade.php](resources/views/admin/consoles/form.blade.php) a bien été modifié
- [ ] Ouvrir [test-snes-rom-id-extraction.html](test-snes-rom-id-extraction.html) dans un navigateur pour vérifier que tous les tests passent
- [ ] Vider le cache des vues Blade : `php artisan view:clear`

## Après déploiement sur Railway

### 1. Tester avec un JEUX SNES existant

Aller sur : `https://web-production-f3333.up.railway.app/admin/articles/create`

1. **Rechercher un jeu SNES** (ex: rechercher "Super Mario World" ou un ROM ID comme "SHVC-MW")
2. **Sélectionner le jeu** dans les résultats
3. **Vérifier que les images s'affichent** :
   - ✅ Cover image
   - ✅ Logo du jeu
   - ✅ Artwork
   - ✅ Gameplay

### 2. Vérifier le modal d'images de taxonomie

1. **Créer ou éditer un article SNES**
2. **Cliquer sur "📷 Voir les photos génériques de la taxonomie"**
3. **Vérifier que les 4 types d'images apparaissent** :
   - 📖 Cover
   - 🏷️ Logo
   - 🎨 Artwork
   - 🎮 Gameplay

### 3. Vérifier la console du navigateur

Ouvrir les DevTools (F12) et regarder la console :
- ✅ Aucune erreur 404 pour les images SNES
- ✅ Les URLs générées utilisent le ROM ID et non le nom complet
- ✅ Exemple d'URL correcte : `https://.../taxonomy/snes/SHVC-MW-cover.png`
- ❌ URL incorrecte (avant correction) : `https://.../taxonomy/snes/SHVC-MW - Super Mario World-cover.png`

## Vérifications complémentaires

### Autres plateformes (ne doivent PAS être affectées)

Tester avec au moins un jeu de chaque plateforme pour s'assurer qu'aucune régression :

- [ ] **Game Boy** (ROM ID : DMG-XXX)
- [ ] **Game Boy Color** (ROM ID : CGB-XXX)
- [ ] **Game Boy Advance** (ROM ID : AGB-XXX)
- [ ] **NES** (ROM ID : HVC-XXX ou NES-XXX)
- [ ] **N64** (ROM ID : NXXX)
- [ ] **WonderSwan** (basé sur le nom)
- [ ] **Mega Drive** (basé sur le nom)
- [ ] **Game Gear** (basé sur le nom)

## URLs de test rapides

```
https://web-production-f3333.up.railway.app/admin/articles/create
https://web-production-f3333.up.railway.app/admin/consoles
```

## En cas de problème

### Les images SNES ne s'affichent toujours pas

1. **Vérifier que le cache a été vidé** : `php artisan view:clear`
2. **Vérifier les logs Laravel** pour voir les URLs générées
3. **Vérifier la console du navigateur** pour les erreurs JavaScript
4. **Vérifier que les fichiers existent réellement sur R2** :
   - Dossier : `taxonomy/snes/`
   - Format : `{ROM_ID}-{type}.png` (ex: `SHVC-MW-cover.png`)

### Les images d'autres consoles ne s'affichent plus

1. **Vérifier la console du navigateur** pour identifier quelle plateforme
2. **Vérifier que le mapping du dossier est correct** dans `platformMapping`
3. **Vérifier que la logique de détection du ROM ID** ne s'applique pas aux plateformes basées sur le nom

## Contacts

En cas de problème, référez-vous à :
- [FIX_SNES_TAXONOMY_IMAGES.md](FIX_SNES_TAXONOMY_IMAGES.md) - Documentation complète
- [test-snes-rom-id-extraction.html](test-snes-rom-id-extraction.html) - Tests unitaires

---

**Date:** 15 février 2026  
**Correction:** Images de taxonomie SNES non trouvées  
**Fichiers modifiés:** resources/views/admin/consoles/form.blade.php
