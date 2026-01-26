# 📷 Guide Webcam - Capture d'articles

## Fonctionnalité

Vous pouvez maintenant utiliser votre **webcam PC** pour photographier directement les articles dans l'interface, sans passer par un fichier externe.

## 🎯 Comment utiliser la webcam

### Étape 1 : Accéder à la création d'article
```
/admin/articles/create
```

### Étape 2 : Cliquer sur "📷 Utiliser la webcam"

Le bouton indigo se trouve juste sous la zone de drop violette.

### Étape 3 : Autoriser l'accès à la webcam

Une popup de votre navigateur demande l'autorisation :
- Chrome : "Autoriser stock-r4e.test à utiliser votre caméra ?"
- Firefox : "Partager la caméra avec stock-r4e.test ?"
- Edge : "Autoriser stock-r4e.test à accéder à votre caméra ?"

**→ Cliquez sur "Autoriser" / "Allow"**

### Étape 4 : Cadrer votre article

Une fenêtre modale s'ouvre avec :
- 📹 **Flux vidéo en direct** de votre webcam
- 🖼️ **Cadre de prévisualisation** pour positionner l'article

**Conseils de cadrage :**
- Placez l'article sur un fond uni (blanc idéal)
- Centrez l'article dans le cadre
- L'article doit occuper 60-80% de l'écran
- Assurez-vous que le logo/code est net
- Bonne lumière (pas de reflets)

### Étape 5 : Capturer la photo

Cliquez sur le bouton vert **"Capturer"**

### Étape 6 : Vérifier le résultat

- ✅ **Photo nette ?** → Cliquez sur **"Utiliser cette photo"**
- ❌ **Photo floue/mal cadrée ?** → Cliquez sur **"Reprendre"**

### Étape 7 : La photo est prête !

- La modal se ferme automatiquement
- La photo s'affiche en prévisualisation
- Le bouton "Analyser avec l'IA" devient actif
- Cliquez pour lancer l'analyse

## 🎨 Interface de la modal webcam

```
╔════════════════════════════════════════╗
║ 📷 Capture photo avec webcam       ✖  ║
╠════════════════════════════════════════╣
║                                        ║
║   ┌──────────────────────────────┐    ║
║   │                              │    ║
║   │  📹 FLUX VIDÉO EN DIRECT     │    ║
║   │                              │    ║
║   │  [Votre article ici]         │    ║
║   │                              │    ║
║   └──────────────────────────────┘    ║
║                                        ║
║   ┌──────────────────────────────┐    ║
║   │ 🟢 Capturer                  │    ║
║   └──────────────────────────────┘    ║
║                                        ║
╚════════════════════════════════════════╝

Après capture :

╔════════════════════════════════════════╗
║ 📷 Capture photo avec webcam       ✖  ║
╠════════════════════════════════════════╣
║                                        ║
║   Photo capturée :                    ║
║   ┌──────────────────────────────┐    ║
║   │                              │    ║
║   │  📸 PHOTO CAPTURÉE           │    ║
║   │                              │    ║
║   └──────────────────────────────┘    ║
║                                        ║
║   ┌──────┬──────────────────────┐    ║
║   │ 🟡   │ 🟣 Utiliser cette    │    ║
║   │Repre │    photo             │    ║
║   │ndre  │                      │    ║
║   └──────┴──────────────────────┘    ║
║                                        ║
╚════════════════════════════════════════╝
```

## ⚙️ Paramètres techniques

### Résolution vidéo
- **Largeur idéale** : 1280 pixels
- **Hauteur idéale** : 720 pixels
- **Ratio** : 16:9 (format HD)

### Caméra utilisée
- **PC/Laptop** : Webcam intégrée ou externe
- **Mobile** : Caméra arrière (`facingMode: 'environment'`)

### Format de sortie
- **Type** : JPEG
- **Qualité** : 95% (compression optimale)
- **Nom fichier** : `webcam-capture.jpg`

## 🔧 Dépannage

### ❌ Erreur "Accès à la webcam refusé"

**Cause** : Vous avez cliqué sur "Bloquer" dans la popup d'autorisation.

**Solution** :
1. Cliquez sur l'icône 🔒 (cadenas) dans la barre d'adresse
2. Cherchez "Caméra" ou "Camera"
3. Changez de "Bloquer" à "Autoriser"
4. Rafraîchissez la page (F5)
5. Recliquez sur "📷 Utiliser la webcam"

### ❌ Erreur "Aucune webcam détectée"

**Cause** : Pas de caméra connectée à votre ordinateur.

**Solutions** :
- Branchez une webcam USB
- Vérifiez que votre laptop a une webcam intégrée
- OU utilisez l'upload de fichier classique

### ❌ La webcam est noire / pas d'image

**Causes possibles** :
1. **Autre application utilise la webcam** (Zoom, Teams, Skype...)
   → Fermez ces applications
2. **Driver webcam obsolète**
   → Mettez à jour les drivers dans Gestionnaire de périphériques
3. **Webcam physiquement bloquée**
   → Vérifiez le cache de confidentialité (laptop)

### ❌ Image floue ou pixelisée

**Solutions** :
- Nettoyez la lentille de la webcam
- Rapprochez-vous de l'article
- Ajoutez de la lumière (lampe de bureau)
- Utilisez une webcam de meilleure qualité

### ❌ La modal ne se ferme pas

**Solution** :
- Cliquez sur le X en haut à droite
- Cliquez en dehors de la fenêtre (zone noire)
- Appuyez sur Échap (ESC)

## 🌐 Compatibilité navigateurs

| Navigateur | Version min. | Support |
|------------|--------------|---------|
| Chrome | 53+ | ✅ Excellent |
| Firefox | 36+ | ✅ Excellent |
| Edge | 79+ | ✅ Excellent |
| Safari | 11+ | ✅ Bon |
| Opera | 40+ | ✅ Bon |
| IE 11 | ❌ | Non supporté |

**Recommandation** : Chrome ou Edge pour meilleure compatibilité.

## 🔒 Sécurité & Confidentialité

### Vos données sont protégées

- ✅ **Flux vidéo local** : Jamais envoyé au serveur avant capture
- ✅ **Pas d'enregistrement** : Seule la photo capturée est utilisée
- ✅ **Suppression auto** : Blob temporaire libéré après usage
- ✅ **HTTPS requis** : API webcam nécessite connexion sécurisée

### Autorisations

- L'accès webcam est demandé **uniquement** quand vous cliquez sur le bouton
- Vous pouvez révoquer l'autorisation à tout moment dans les paramètres du navigateur
- Fermez la modal = arrêt automatique de la webcam (LED éteinte)

## 💡 Cas d'usage

### 📦 Inventaire en magasin
1. Placez l'article sur le comptoir
2. Ouvrez l'application sur PC
3. Utilisez la webcam USB
4. Capturez chaque article rapidement
5. L'IA remplit automatiquement les infos

**Gain de temps** : ~30 secondes par article

### 🏠 Bureau à domicile
1. Utilisez la webcam intégrée du laptop
2. Fond blanc (feuille A4)
3. Lumière de bureau
4. Capture rapide
5. Analyse immédiate

### 📸 Studio photo
1. Webcam haute qualité (Logitech C920+)
2. Éclairage professionnel
3. Fond chromakey vert/bleu
4. Capture en masse
5. Workflow optimisé

## ⚡ Raccourcis

| Action | Raccourci |
|--------|-----------|
| Ouvrir webcam | Bouton "📷 Utiliser la webcam" |
| Capturer | Bouton "Capturer" ou Entrée |
| Reprendre | Bouton "Reprendre" ou Échap |
| Utiliser photo | Bouton "Utiliser cette photo" ou Entrée |
| Fermer modal | Clic extérieur, X ou Échap |

## 📊 Comparaison méthodes

| Méthode | Rapidité | Qualité | Mobilité |
|---------|----------|---------|----------|
| 📁 Upload fichier | ⭐⭐ | ⭐⭐⭐⭐ | ⭐⭐⭐⭐ |
| 📷 Webcam PC | ⭐⭐⭐⭐ | ⭐⭐⭐ | ⭐⭐ |
| 📱 Mobile | ⭐⭐⭐⭐ | ⭐⭐⭐⭐ | ⭐⭐⭐⭐⭐ |

**Recommandation par contexte :**
- **Bureau fixe** : Webcam PC (gain de temps)
- **Déplacement** : Mobile (flexibilité)
- **Qualité max** : Upload fichier (appareil photo dédié)

---

**Date de création** : 26 janvier 2026  
**Version** : 1.0  
**Technologie** : MediaDevices API (getUserMedia)
