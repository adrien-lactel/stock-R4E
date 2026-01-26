# Configuration Google Cloud Vision API

## 📝 Instructions de configuration

### 1. Créer un projet Google Cloud
1. Allez sur https://console.cloud.google.com/
2. Créez un nouveau projet (ou sélectionnez-en un existant)
3. Activez l'API Cloud Vision :
   - Dans le menu, allez à "APIs & Services" > "Library"
   - Cherchez "Cloud Vision API"
   - Cliquez sur "Enable"

### 2. Créer une clé de service
1. Dans "APIs & Services" > "Credentials"
2. Cliquez sur "Create Credentials" > "Service Account"
3. Donnez un nom au compte de service (ex: "vision-api-reader")
4. Dans "Role", sélectionnez "Cloud Vision" > "Cloud Vision API User"
5. Cliquez sur "Done"
6. Cliquez sur le compte de service créé
7. Dans l'onglet "Keys", cliquez sur "Add Key" > "Create new key"
8. Choisissez "JSON" et téléchargez le fichier

### 3. Configurer Laravel

#### Option A : Fichier JSON (Recommandé pour développement local)
1. Placez le fichier JSON téléchargé dans `storage/app/google-vision-credentials.json`
2. Dans votre `.env`, ajoutez :
```env
GOOGLE_VISION_CREDENTIALS='{"type":"service_account","project_id":"votre-projet-id",...}'
GOOGLE_VISION_PROJECT_ID=votre-projet-id
```

#### Option B : Variable d'environnement JSON (Pour production/Railway)
Copiez tout le contenu du fichier JSON et mettez-le dans une variable d'environnement :
```env
GOOGLE_VISION_CREDENTIALS='{"type":"service_account","project_id":"...","private_key_id":"...","private_key":"-----BEGIN PRIVATE KEY-----\n...","client_email":"...","client_id":"...","auth_uri":"...","token_uri":"...","auth_provider_x509_cert_url":"...","client_x509_cert_url":"..."}'
GOOGLE_VISION_PROJECT_ID=votre-projet-id
```

### 4. Sur Railway
1. Allez dans votre projet Railway
2. Variables > Add Variable
3. Ajoutez `GOOGLE_VISION_CREDENTIALS` avec le JSON complet
4. Ajoutez `GOOGLE_VISION_PROJECT_ID` avec l'ID de votre projet

## 💰 Coûts
- Gratuit jusqu'à 1000 analyses/mois
- Au-delà : ~0.0015€ par image
- Plus d'infos : https://cloud.google.com/vision/pricing

## 🧪 Test
Une fois configuré, uploadez une image d'une console dans la création d'article et cliquez sur le bouton "🤖 Analyser avec l'IA".
