# Installation Tesseract OCR (100% Gratuit, Offline)

## 🎯 Pourquoi Tesseract ?

- ✅ **100% GRATUIT** - Aucun coût, aucune limite
- ✅ **OFFLINE** - Fonctionne sans Internet
- ✅ **Open Source** - Développé par Google, communauté active
- ⚠️ **Moins précis** que Google Cloud Vision (mais suffisant pour ROM IDs)

## 📥 Installation Windows (Laragon)

### 1. Télécharger Tesseract

**Option 1 - Site officiel UB Mannheim (recommandé)** :
1. Allez sur : https://github.com/UB-Mannheim/tesseract/wiki
2. Cliquez sur "Tesseract at UB Mannheim" 
3. Téléchargez `tesseract-ocr-w64-setup-5.x.x.exe` (version 64-bit la plus récente)

**Option 2 - Releases GitHub** :
https://github.com/tesseract-ocr/tesseract/releases

**Option 3 - Chocolatey (si installé)** :
```powershell
choco install tesseract
```

**Option 4 - Winget (Windows 11)** :
```powershell
winget install UB-Mannheim.TesseractOCR
```

### 2. Installer Tesseract

1. Lancez l'installeur
2. **IMPORTANT** : Lors de l'installation, cochez :
   - ✅ English language data
   - ✅ Japanese language data (pour les cartouches japonaises)
3. Chemin d'installation par défaut : `C:\Program Files\Tesseract-OCR`
4. Terminez l'installation

### 3. Vérifier l'installation

Ouvrez PowerShell et testez :

```powershell
& "C:\Program Files\Tesseract-OCR\tesseract.exe" --version
```

Vous devriez voir :
```
tesseract 5.5.0
 leptonica-1.84.1
  libgif 5.2.2 : libjpeg 8d (libjpeg-turbo 3.0.4) : libpng 1.6.44 : libtiff 4.7.0 : zlib 1.3.1 : libwebp 1.4.0
```

### 4. Configuration Laravel (Optionnel)

Si Tesseract n'est PAS installé dans `C:\Program Files\Tesseract-OCR`, ajoutez dans `.env` :

```env
TESSERACT_PATH="C:\VotreCheminPersonnalise\tesseract.exe"
```

### 5. Tester avec une image

```powershell
cd C:\laragon\www\stock-R4E
php artisan tinker
```

Puis dans Tinker :
```php
$service = app(\App\Services\TesseractOcrService::class);
$result = $service->analyzeGamingProduct('public/images/test-cartridge.jpg');
echo json_encode($result['suggestions'], JSON_PRETTY_PRINT);
```

## 🐧 Installation Linux/Mac

### Ubuntu/Debian
```bash
sudo apt update
sudo apt install tesseract-ocr
sudo apt install tesseract-ocr-jpn  # Pour japonais
```

### macOS (Homebrew)
```bash
brew install tesseract
brew install tesseract-lang  # Toutes les langues
```

### Vérifier
```bash
tesseract --version
```

## 🔧 Dépannage

### Tesseract non trouvé

**Erreur** : `Tesseract OCR n'est pas installé`

**Solutions** :
1. Vérifiez que Tesseract est installé : `tesseract --version`
2. Vérifiez le chemin dans `.env` : `TESSERACT_PATH`
3. Sur Windows, le chemin par défaut est : `C:\Program Files\Tesseract-OCR\tesseract.exe`

### ROM ID mal détecté

Tesseract est moins précis que Google Vision. Améliorations possibles :

1. **Meilleure photo** :
   - Bien éclairée
   - ROM ID bien visible
   - Image nette (pas floue)

2. **Configuration OCR** :
   - Mode PSM (Page Segmentation Mode) dans `TesseractOcrService.php`
   - Actuellement : `psm(6)` = bloc de texte uniforme
   - Alternatives : `psm(7)` = ligne de texte unique

3. **Langues supplémentaires** :
   - Anglais + Japonais activés par défaut
   - Autres langues : réinstaller Tesseract avec langues additionnelles

## 🔄 Revenir à Google Cloud Vision

Si Tesseract ne fonctionne pas bien, vous pouvez revenir à Google Vision :

### Dans `ConsoleAdminController.php` ligne ~836 :

```php
// Tesseract (gratuit)
$recognitionService = app(\App\Services\TesseractOcrService::class);

// Google Vision (payant après 1000/mois)
// $recognitionService = app(\App\Services\ImageRecognitionService::class);
```

Décommentez la ligne Google Vision et commentez la ligne Tesseract.

## 📊 Comparaison

| Feature | Tesseract OCR | Google Cloud Vision |
|---------|---------------|---------------------|
| **Coût** | 100% GRATUIT | Gratuit jusqu'à 1000/mois, puis ~1,50€/1000 |
| **Connexion** | Offline | Internet requis |
| **Précision ROM IDs** | ~85% | ~98% |
| **Précision texte japonais** | ~70% | ~95% |
| **Vitesse** | Rapide (~1s) | Rapide (~0.5s) |
| **Installation** | Binaire requis | API key uniquement |

## ✅ Recommandation

- **Pour usage quotidien** : Tesseract (gratuit, suffisant)
- **Pour précision maximale** : Google Vision (faible volume = gratuit)
- **Pour gros volume** : Tesseract (évite les coûts)
