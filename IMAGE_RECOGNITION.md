# 🤖 Reconnaissance d'articles par IA - Google Cloud Vision

## ✨ NOUVELLE INTERFACE - Analyse IA dès l'ouverture

**L'analyse IA est maintenant la première chose visible** lorsque vous créez un article !

### 🎯 Section principale (en haut de page)

- **Grande zone violette** avec icône appareil photo 📸
- **Drag & drop** direct de l'image
- **Bouton proéminent** : "Analyser avec l'IA"
- **Résultats en cartes colorées** par catégorie d'information
- **1 clic** pour appliquer toutes les suggestions au formulaire

### Workflow simplifié

```
1. Ouvrir "Créer un article" 
   → ✨ Section IA visible immédiatement en haut
   
2. Photographier ou glisser une image
   → Prévisualisation instantanée
   
3. Cliquer "Analyser avec l'IA"
   → Résultats en 2-3 secondes
   
4. Cliquer "Appliquer ces suggestions"
   → Formulaire pré-rempli automatiquement
   
5. Compléter et enregistrer
```

## Fonctionnalité

Lorsque vous créez un nouvel article, vous pouvez maintenant **photographier** ou **uploader** une image et l'IA identifiera automatiquement :

### Ce qui est détecté

- ✅ **Type de produit** : Console, jeu, accessoire, carte
- ✅ **Marque** : Nintendo, Sony, Sega, Microsoft, Atari...
- ✅ **Modèle** : Game Boy Color, PlayStation 2, N64...
- ✅ **ROM ID** : Pour les jeux Game Boy (format DMG-XXXX-X)
- ✅ **Région** : PAL, NTSC-U, NTSC-J
- ✅ **État** : Avec boîte, console seule, complet
- ✅ **Texte visible** : Titres, codes-barres, inscriptions

### Workflow détaillé (ancienne interface dans section images)

```
1. Accéder à "Créer un article"
2. ⚠️ RECOMMANDÉ : Utiliser la section IA en haut de page
   (ou descendre jusqu'à la section "Images" pour l'ancienne interface)
3. Ajouter une photo (appareil photo ou galerie sur mobile)
4. Cliquer sur "🤖 Analyser avec l'IA"
5. L'IA affiche ses suggestions
6. Cliquer sur "✅ Appliquer les suggestions"
7. Vérifier/compléter les informations
8. Enregistrer
```

## Exemples concrets

### Photo d'une Game Boy Color
**Détection :**
- Catégorie : Consoles portables
- Marque : Nintendo
- Sous-catégorie : Game Boy Color
- Type : (selon la couleur détectée)
- État : Console seule

### Photo d'un jeu Game Boy
**Détection :**
- ROM ID : DMG-APEE-0 (lu via OCR sur la cartouche)
- Auto-remplissage via base de données Game Boy
- Nom du jeu : Pokémon Rouge
- Année : 1996

### Photo de boîte de jeu
**Détection :**
- Titre du jeu (via OCR)
- Région (PAL/NTSC via design)
- État : Avec boîte
- Éditeur (si visible)

## Précision attendue

| Type d'article | Précision |
|----------------|-----------|
| Consoles courantes | 85-95% |
| Jeux avec boîte visible | 90%+ |
| Accessoires | 70-80% |
| État/défauts | 60-70% |
| ROM ID Game Boy | 95%+ |

## Interface utilisateur

### Bouton d'analyse
Un bouton violet avec icône d'ampoule apparaît sous la zone d'upload d'images :
```
🤖 Analyser avec l'IA (Google Vision)
```

### Résultat d'analyse
Une carte bleue s'affiche avec :
- Suggestions principales (catégorie, marque, type...)
- Labels détectés avec score de confiance
- Logos identifiés
- Texte lu (OCR)
- Bouton "✅ Appliquer les suggestions"

## Technologie

- **API** : Google Cloud Vision API
- **Coût** : ~0.0015€ par analyse (1000 gratuites/mois)
- **Analyses effectuées** :
  - LABEL_DETECTION (catégorisation)
  - TEXT_DETECTION (OCR)
  - LOGO_DETECTION (marques)
  - OBJECT_LOCALIZATION (objets)

## Configuration requise

Voir [GOOGLE_VISION_SETUP.md](GOOGLE_VISION_SETUP.md) pour la configuration complète.

Variables d'environnement nécessaires :
```env
GOOGLE_VISION_CREDENTIALS='{"type":"service_account",...}'
GOOGLE_VISION_PROJECT_ID=votre-projet-id
```

## Limitations

- ❌ Ne fonctionne pas pour les articles très rares/obscurs
- ❌ Peut confondre les variantes de couleurs
- ⚠️ Nécessite une validation humaine pour confirmer
- ⚠️ Performances variables selon la qualité de la photo

## Améliorations futures possibles

- [ ] Base de données de référence pour mieux identifier les variantes
- [ ] Détection de défauts visuels (rayures, décoloration)
- [ ] Estimation automatique du prix selon l'état
- [ ] Analyse multi-images pour mieux détecter la complétude
- [ ] Support d'autres API (Azure Vision, AWS Rekognition)
