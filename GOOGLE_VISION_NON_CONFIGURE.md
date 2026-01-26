# ⚠️ Google Cloud Vision Non Configuré

## Problème détecté

L'analyse IA ne fonctionne pas car **Google Cloud Vision n'est pas encore configuré**.

## 🔧 Solution en 5 étapes

### 1. Créer un compte Google Cloud Platform

Allez sur [console.cloud.google.com](https://console.cloud.google.com)

### 2. Créer un projet

```
1. Cliquez sur "Sélectionner un projet" → "Nouveau projet"
2. Nom: "Stock-R4E" (ou autre)
3. Cliquez "Créer"
```

### 3. Activer l'API Cloud Vision

```
1. Menu ☰ → "API et services" → "Bibliothèque"
2. Cherchez "Cloud Vision API"
3. Cliquez "ACTIVER"
```

### 4. Créer un compte de service

```
1. Menu ☰ → "API et services" → "Identifiants"
2. "+ CRÉER DES IDENTIFIANTS" → "Compte de service"
3. Nom: "stock-r4e-vision"
4. Rôle: "Cloud Vision API User"
5. Cliquez "Terminé"
```

### 5. Télécharger la clé JSON

```
1. Cliquez sur le compte de service créé
2. Onglet "CLÉS" → "AJOUTER UNE CLÉ" → "Créer une clé"
3. Type: JSON
4. Télécharger le fichier (ex: stock-r4e-vision-xxxxx.json)
```

### 6. Configurer dans Laravel

**Option A - Variable d'environnement (RECOMMANDÉ):**

1. Ouvrez le fichier JSON téléchargé
2. Copiez TOUT le contenu (incluant les accolades)
3. Ajoutez dans `.env`:

```env
GOOGLE_VISION_CREDENTIALS='{"type":"service_account","project_id":"stock-r4e-xxxxx","private_key_id":"xxxxx",...}'
GOOGLE_VISION_PROJECT_ID=stock-r4e-xxxxx
```

⚠️ **Important** : 
- Utilisez des apostrophes simples `'...'` autour du JSON
- Copiez TOUT le JSON sur UNE SEULE ligne
- N'ajoutez PAS de retours à la ligne dans le JSON

**Option B - Fichier local:**

1. Placez le fichier JSON dans `storage/app/google-vision-credentials.json`
2. Modifiez `config/services.php`:

```php
'google_vision' => [
    'credentials' => json_decode(file_get_contents(storage_path('app/google-vision-credentials.json')), true),
    'project_id' => env('GOOGLE_VISION_PROJECT_ID'),
],
```

### 7. Tester la configuration

```bash
php test-vision-config.php
```

Si tout est OK, vous verrez :
```
✅ CONFIGURATION COMPLÈTE ET FONCTIONNELLE!
```

### 8. Tester dans l'application

1. Allez sur `/admin/articles/create`
2. Uploadez une image ou utilisez la webcam
3. Cliquez "🤖 Analyser avec l'IA"

Si ça fonctionne, vous verrez les résultats en cartes colorées ! 🎉

## 🆘 En cas de problème

### Erreur: "Variable GOOGLE_VISION_CREDENTIALS non définie"

**Solution:**
```bash
# Vérifiez que .env contient bien la ligne
cat .env | grep GOOGLE_VISION_CREDENTIALS

# Si vide, ajoutez-la
nano .env
```

### Erreur: "JSON invalide"

**Causes possibles:**
- JSON coupé (manque début ou fin)
- Retours à la ligne dans le JSON
- Guillemets mal échappés

**Solution:**
```bash
# Utilisez des apostrophes simples autour du JSON
GOOGLE_VISION_CREDENTIALS='{"type":"service_account",...}'

# PAS de guillemets doubles:
# GOOGLE_VISION_CREDENTIALS="{\"type\":\"service_account\",...}"  ❌
```

### Erreur: "API non activée"

**Solution:**
1. Google Cloud Console → API & Services → Library
2. Cherchez "Cloud Vision API"
3. Cliquez "ENABLE"
4. Attendez 1-2 minutes

### Erreur: "Permission denied"

**Solution:**
1. Google Cloud Console → IAM & Admin → Service Accounts
2. Sélectionnez votre compte de service
3. Vérifiez le rôle: doit être "Cloud Vision API User" ou "Editor"

## 💰 Coût

- **1000 analyses/mois** : GRATUIT
- **Au-delà** : $0.0015 par image (1,5€ pour 1000 images)

## 📖 Documentation complète

- **GOOGLE_VISION_SETUP.md** : Guide détaillé avec captures d'écran
- **IMAGE_RECOGNITION.md** : Documentation de la fonctionnalité IA

---

**Besoin d'aide ?** Ouvrez un ticket ou consultez la documentation officielle : 
https://cloud.google.com/vision/docs/setup
