# 🎥 Webcam Feature - Récapitulatif Technique

## Vue d'ensemble

Intégration complète de la capture photo par webcam pour l'analyse IA d'articles, utilisant l'API MediaDevices (getUserMedia).

## Architecture

### Composants Frontend

```
┌─────────────────────────────────────────┐
│ Button "📷 Utiliser la webcam"          │
│ (Trigger)                               │
└────────────┬────────────────────────────┘
             │ click
             ▼
┌─────────────────────────────────────────┐
│ Modal Webcam (Overlay)                  │
│ ┌─────────────────────────────────────┐ │
│ │ <video> Flux en direct              │ │
│ │ (getUserMedia stream)               │ │
│ └─────────────────────────────────────┘ │
│ ┌─────────────────────────────────────┐ │
│ │ <canvas> (hidden)                   │ │
│ │ Pour capture frame                  │ │
│ └─────────────────────────────────────┘ │
│ ┌─────────────────────────────────────┐ │
│ │ <img> Preview photo capturée        │ │
│ └─────────────────────────────────────┘ │
│                                         │
│ [Capturer] [Reprendre] [Utiliser]      │
└─────────────────────────────────────────┘
             │ useWebcamPhotoBtn.click
             ▼
┌─────────────────────────────────────────┐
│ handleAIImageUpload(file)               │
│ (Fonction partagée avec upload normal)  │
└─────────────────────────────────────────┘
```

### Flux de données

```
1. getUserMedia()
   ↓
2. MediaStream → <video>.srcObject
   ↓
3. User clicks "Capturer"
   ↓
4. drawImage(video) → <canvas>
   ↓
5. canvas.toBlob(callback, 'image/jpeg', 0.95)
   ↓
6. Blob → File('webcam-capture.jpg')
   ↓
7. handleAIImageUpload(file)
   ↓
8. Preview + Enable analyze button
   ↓
9. stopWebcam() → stream.getTracks().stop()
```

## Code JavaScript

### Variables principales

```javascript
const webcamBtn = document.getElementById('webcam-btn');
const webcamModal = document.getElementById('webcam-modal');
const closeWebcamBtn = document.getElementById('close-webcam');
const webcamVideo = document.getElementById('webcam-video');
const webcamCanvas = document.getElementById('webcam-canvas');
const captureBtn = document.getElementById('capture-btn');
const retakeBtn = document.getElementById('retake-btn');
const useWebcamPhotoBtn = document.getElementById('use-webcam-photo');
const webcamCaptured = document.getElementById('webcam-captured');
const webcamCapturedImg = document.getElementById('webcam-captured-img');

let webcamStream = null;
let capturedBlob = null;
```

### Fonction 1 : Ouvrir webcam

```javascript
webcamBtn.addEventListener('click', async () => {
  try {
    // Demander accès webcam
    webcamStream = await navigator.mediaDevices.getUserMedia({ 
      video: { 
        width: { ideal: 1280 },
        height: { ideal: 720 },
        facingMode: 'environment' // Mobile: caméra arrière
      } 
    });
    
    // Affecter stream à l'élément vidéo
    webcamVideo.srcObject = webcamStream;
    
    // Afficher modal
    webcamModal.classList.remove('hidden');
    
    // Reset UI
    webcamCaptured.classList.add('hidden');
    captureBtn.classList.remove('hidden');
    retakeBtn.classList.add('hidden');
    useWebcamPhotoBtn.classList.add('hidden');
    webcamVideo.classList.remove('hidden');
    
  } catch (error) {
    // Gestion erreurs
    if (error.name === 'NotAllowedError') {
      alert('❌ Accès webcam refusé. Autorisez dans les paramètres.');
    } else if (error.name === 'NotFoundError') {
      alert('❌ Aucune webcam détectée.');
    } else {
      alert('❌ Erreur webcam: ' + error.message);
    }
  }
});
```

### Fonction 2 : Capturer photo

```javascript
captureBtn.addEventListener('click', () => {
  // Dimensions canvas = dimensions vidéo
  webcamCanvas.width = webcamVideo.videoWidth;
  webcamCanvas.height = webcamVideo.videoHeight;
  
  // Dessiner frame actuelle sur canvas
  const ctx = webcamCanvas.getContext('2d');
  ctx.drawImage(webcamVideo, 0, 0);
  
  // Convertir canvas en blob JPEG
  webcamCanvas.toBlob((blob) => {
    capturedBlob = blob;
    
    // Créer URL temporaire pour preview
    const url = URL.createObjectURL(blob);
    webcamCapturedImg.src = url;
    
    // Afficher preview + masquer vidéo
    webcamCaptured.classList.remove('hidden');
    webcamVideo.classList.add('hidden');
    captureBtn.classList.add('hidden');
    retakeBtn.classList.remove('hidden');
    useWebcamPhotoBtn.classList.remove('hidden');
  }, 'image/jpeg', 0.95); // Qualité 95%
});
```

### Fonction 3 : Reprendre photo

```javascript
retakeBtn.addEventListener('click', () => {
  // Afficher vidéo + masquer preview
  webcamCaptured.classList.add('hidden');
  webcamVideo.classList.remove('hidden');
  captureBtn.classList.remove('hidden');
  retakeBtn.classList.add('hidden');
  useWebcamPhotoBtn.classList.add('hidden');
  
  // Libérer blob
  capturedBlob = null;
});
```

### Fonction 4 : Utiliser photo

```javascript
useWebcamPhotoBtn.addEventListener('click', () => {
  if (capturedBlob) {
    // Convertir blob en File
    const file = new File([capturedBlob], 'webcam-capture.jpg', { 
      type: 'image/jpeg' 
    });
    
    // Utiliser fonction commune upload
    handleAIImageUpload(file);
    
    // Fermer modal
    stopWebcam();
    webcamModal.classList.add('hidden');
  }
});
```

### Fonction 5 : Arrêter webcam

```javascript
function stopWebcam() {
  if (webcamStream) {
    // Arrêter tous les tracks (vidéo + audio si présent)
    webcamStream.getTracks().forEach(track => track.stop());
    webcamStream = null;
  }
}
```

### Fonction 6 : Fermer modal

```javascript
// Bouton X
closeWebcamBtn.addEventListener('click', () => {
  stopWebcam();
  webcamModal.classList.add('hidden');
});

// Clic extérieur
webcamModal.addEventListener('click', (e) => {
  if (e.target === webcamModal) {
    stopWebcam();
    webcamModal.classList.add('hidden');
  }
});
```

## HTML Structure

### Modal complète

```html
<div id="webcam-modal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4">
  <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full">
    <!-- Header -->
    <div class="p-4 border-b border-gray-200 flex items-center justify-between">
      <h3 class="text-lg font-bold text-gray-900">📷 Capture photo avec webcam</h3>
      <button type="button" id="close-webcam" class="text-gray-400 hover:text-gray-600">
        <svg>...</svg>
      </button>
    </div>
    
    <!-- Content -->
    <div class="p-6">
      <!-- Vidéo webcam -->
      <div class="relative bg-gray-900 rounded-lg overflow-hidden mb-4">
        <video id="webcam-video" autoplay playsinline class="w-full max-h-96"></video>
        <canvas id="webcam-canvas" class="hidden"></canvas>
      </div>
      
      <!-- Preview photo capturée -->
      <div id="webcam-captured" class="hidden mb-4">
        <p class="text-sm font-semibold text-gray-700 mb-2">Photo capturée :</p>
        <img id="webcam-captured-img" class="w-full rounded-lg border-2 border-green-400">
      </div>
      
      <!-- Actions -->
      <div class="flex gap-3">
        <button id="capture-btn" class="flex-1 px-6 py-3 bg-green-600...">
          <svg>...</svg> Capturer
        </button>
        <button id="retake-btn" class="hidden flex-1 px-6 py-3 bg-yellow-600...">
          <svg>...</svg> Reprendre
        </button>
        <button id="use-webcam-photo" class="hidden flex-1 px-6 py-3 bg-purple-600...">
          <svg>...</svg> Utiliser cette photo
        </button>
      </div>
    </div>
  </div>
</div>
```

## Paramètres MediaDevices

### Contraintes vidéo

```javascript
{
  video: {
    // Résolution idéale (browser choisit la plus proche disponible)
    width: { ideal: 1280 },
    height: { ideal: 720 },
    
    // Caméra arrière sur mobile, webcam sur desktop
    facingMode: 'environment',
    
    // Alternatives possibles:
    // facingMode: 'user' → Caméra frontale
    // facingMode: { exact: 'environment' } → Force caméra arrière (erreur si indispo)
    
    // Framerate (optionnel)
    // frameRate: { ideal: 30, max: 60 }
  }
}
```

### Formats de sortie

```javascript
// JPEG (recommandé pour photos)
canvas.toBlob(callback, 'image/jpeg', 0.95); // 95% qualité

// PNG (sans perte, plus lourd)
canvas.toBlob(callback, 'image/png');

// WebP (meilleure compression, support limité)
canvas.toBlob(callback, 'image/webp', 0.9);
```

## Gestion d'erreurs

### Types d'erreurs getUserMedia

| Error.name | Cause | Solution |
|------------|-------|----------|
| `NotAllowedError` | User a refusé l'accès | Réautoriser dans paramètres navigateur |
| `NotFoundError` | Aucune webcam détectée | Brancher webcam ou utiliser mobile |
| `NotReadableError` | Webcam utilisée par autre app | Fermer Zoom/Teams/Skype |
| `OverconstrainedError` | Contraintes impossibles | Réduire résolution demandée |
| `SecurityError` | Pas en HTTPS | Utiliser HTTPS (requis WebRTC) |
| `AbortError` | Problème hardware | Redémarrer navigateur/PC |

### Gestion défensive

```javascript
try {
  const stream = await navigator.mediaDevices.getUserMedia({ video: true });
} catch (error) {
  console.error('Webcam error:', error);
  
  let message = '❌ Erreur webcam: ';
  
  switch(error.name) {
    case 'NotAllowedError':
      message += 'Accès refusé. Autorisez dans les paramètres.';
      break;
    case 'NotFoundError':
      message += 'Aucune webcam détectée.';
      break;
    case 'NotReadableError':
      message += 'Webcam déjà utilisée par une autre application.';
      break;
    default:
      message += error.message;
  }
  
  alert(message);
}
```

## Performance

### Memory Management

```javascript
// ✅ BON : Libération stream
function stopWebcam() {
  if (webcamStream) {
    webcamStream.getTracks().forEach(track => track.stop());
    webcamStream = null;
  }
}

// ✅ BON : Libération URL blob
const url = URL.createObjectURL(blob);
// Utiliser url...
URL.revokeObjectURL(url); // Nettoyer après usage

// ❌ MAUVAIS : Pas de nettoyage
// → Fuite mémoire, webcam reste active en arrière-plan
```

### Optimisations

1. **Canvas sizing**
   ```javascript
   // Utiliser dimensions exactes de la vidéo
   canvas.width = video.videoWidth;
   canvas.height = video.videoHeight;
   ```

2. **Blob quality**
   ```javascript
   // Équilibrer qualité/taille
   canvas.toBlob(callback, 'image/jpeg', 0.95); // 95% = bon compromis
   ```

3. **Stream cleanup**
   ```javascript
   // Toujours arrêter le stream quand modal fermée
   closeWebcamBtn.addEventListener('click', () => {
     stopWebcam(); // Important!
     webcamModal.classList.add('hidden');
   });
   ```

## Sécurité

### Requis HTTPS

L'API `getUserMedia()` nécessite **HTTPS obligatoire** (sauf localhost).

```
✅ https://stock-r4e.test
✅ http://localhost:8000
❌ http://stock-r4e.test (bloqué par navigateur)
```

### Permissions

```javascript
// Demande explicite à chaque session
navigator.mediaDevices.getUserMedia({ video: true });

// User peut:
// - Autoriser (Allow)
// - Refuser (Block)
// - Se souvenir du choix
```

### Privacy

- ✅ Flux vidéo jamais envoyé au serveur
- ✅ Seule la photo capturée (blob) est transmise
- ✅ Blob temporaire libéré après usage
- ✅ Indicateur LED webcam s'allume (natif browser)
- ✅ LED s'éteint quand stream.stop()

## Tests

### Checklist de test

- [ ] Autoriser webcam → Flux vidéo visible
- [ ] Refuser webcam → Message d'erreur clair
- [ ] Capturer → Photo dans preview
- [ ] Reprendre → Retour au flux vidéo
- [ ] Utiliser photo → Upload vers IA
- [ ] Fermer X → Stream arrêté (LED éteinte)
- [ ] Clic extérieur → Stream arrêté
- [ ] Mobile : Caméra arrière par défaut
- [ ] Desktop : Webcam intégrée/externe

### Test navigateurs

| Navigateur | Version testée | Status |
|------------|----------------|--------|
| Chrome | 131+ | ✅ |
| Firefox | 115+ | ✅ |
| Edge | 131+ | ✅ |
| Safari | 17+ | ⚠️ Tester |
| Opera | 100+ | ⚠️ Tester |

## Compatibilité

### API Support

```javascript
// Vérifier support avant utilisation
if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
  // API disponible
  webcamBtn.disabled = false;
} else {
  // API non supportée
  webcamBtn.disabled = true;
  webcamBtn.title = 'Webcam non supportée par ce navigateur';
}
```

### Fallback

Si webcam non supportée/disponible :
1. Bouton webcam désactivé
2. Upload fichier reste disponible
3. Mobile camera reste disponible (input accept="image/*")

---

**Version** : 2.1  
**Date** : 26 janvier 2026  
**API** : MediaDevices.getUserMedia()  
**Standards** : WebRTC, HTML5 Canvas
