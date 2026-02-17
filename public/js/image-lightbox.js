/**
 * Image Lightbox Manager
 * Gestion des images en plein écran avec zoom, rotation, recadrage
 * Version: 1.0.0
 */

// État du lightbox
let currentZoom = 1;
let currentX = 0;
let currentY = 0;
let currentRotation = 0;
let isDragging = false;
let startX = 0;
let startY = 0;
let isCropMode = false;
let cropData = { x: 0, y: 0, width: 0, height: 0 };
let touchStartDistance = 0;
let cropScale = 1;
let cropOffsetX = 0;
let cropOffsetY = 0;
let lightboxContext = {};

/**
 * Ouvrir le lightbox avec une image
 * @param {string} imageUrl - URL de l'image à afficher
 * @param {object} context - Contexte (isArticleImage, isPrimary, article_type_id, etc.)
 */
window.openImageLightbox = function(imageUrl, context = {}) {
  const lightbox = document.getElementById('image-lightbox');
  const lightboxImage = document.getElementById('lightbox-image');
  if (lightbox && lightboxImage) {
    lightboxImage.src = imageUrl;
    lightboxImage.dataset.originalUrl = imageUrl;
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    resetZoom();
    initZoomControls();
    
    // Stocker le contexte pour utilisation ultérieure (recadrage, etc.)
    lightboxContext = context;
    
    // Mettre à jour le nom du fichier
    const filenameEl = document.getElementById('lightbox-filename');
    if (filenameEl) {
      const filename = imageUrl.split('/').pop().split('?')[0];
      filenameEl.textContent = filename;
    }
    
    // Actions contextuelles pour les photos d'articles
    const actionsEl = document.getElementById('lightbox-actions');
    if (actionsEl) {
      actionsEl.innerHTML = '';
      
      if (context.isArticleImage) {
        // Bouton définir comme principale
        if (!context.isPrimary) {
          const setPrimaryBtn = document.createElement('button');
          setPrimaryBtn.type = 'button';
          setPrimaryBtn.className = 'bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors';
          setPrimaryBtn.innerHTML = '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg> Définir comme principale';
          setPrimaryBtn.onclick = (e) => {
            e.stopPropagation();
            if (typeof window.setPrimaryImage === 'function') {
              window.setPrimaryImage(imageUrl);
            }
            closeImageLightbox();
          };
          actionsEl.appendChild(setPrimaryBtn);
        }
        
        // Bouton supprimer
        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors';
        deleteBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Supprimer';
        deleteBtn.onclick = (e) => {
          e.stopPropagation();
          if (typeof window.deleteArticleImage === 'function') {
            window.deleteArticleImage(imageUrl);
          }
          closeImageLightbox();
        };
        actionsEl.appendChild(deleteBtn);
      }
    }
  }
};

/**
 * Fermer le lightbox
 */
window.closeImageLightbox = function() {
  const lightbox = document.getElementById('image-lightbox');
  if (lightbox) {
    lightbox.classList.add('hidden');
    document.body.style.overflow = '';
    currentZoom = 1;
    currentX = 0;
    currentY = 0;
    currentRotation = 0;
    updateTransform();
  }
};

/**
 * Zoom in (+0.5)
 */
window.zoomIn = function() {
  currentZoom = Math.min(currentZoom + 0.5, 5);
  updateTransform();
};

/**
 * Zoom out (-0.5)
 */
window.zoomOut = function() {
  currentZoom = Math.max(currentZoom - 0.5, 0.5);
  updateTransform();
};

/**
 * Réinitialiser le zoom et la position
 */
window.resetZoom = function() {
  currentZoom = 1;
  currentX = 0;
  currentY = 0;
  updateTransform();
};

/**
 * Rotation -90°
 */
window.rotateLeft = function() {
  currentRotation = (currentRotation - 90) % 360;
  updateTransform();
};

/**
 * Rotation +90°
 */
window.rotateRight = function() {
  currentRotation = (currentRotation + 90) % 360;
  updateTransform();
};

/**
 * Télécharger l'image affichée
 */
window.downloadLightboxImage = function() {
  const img = document.getElementById('lightbox-image');
  if (!img || !img.dataset.originalUrl) return;
  
  const url = img.dataset.originalUrl;
  const filename = url.split('/').pop().split('?')[0];
  
  // Créer un lien de téléchargement
  const a = document.createElement('a');
  a.href = url;
  a.download = filename;
  a.target = '_blank';
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  
  console.log('💾 Téléchargement:', filename);
};

/**
 * Toggle mode recadrage
 */
window.toggleCropMode = function() {
  isCropMode = !isCropMode;
  const overlay = document.getElementById('crop-overlay');
  const toggleBtn = document.getElementById('crop-toggle-btn');
  
  if (isCropMode) {
    overlay.classList.remove('hidden');
    toggleBtn.classList.add('bg-green-600');
    initCropCanvas();
  } else {
    overlay.classList.add('hidden');
    toggleBtn.classList.remove('bg-green-600');
  }
};

/**
 * Initialiser le canvas de recadrage
 */
function initCropCanvas() {
  const img = document.getElementById('lightbox-image');
  const canvas = document.getElementById('crop-canvas');
  if (!img || !canvas) return;
  
  const ctx = canvas.getContext('2d');
  
  // Charger l'image dans le canvas
  const tempImg = new Image();
  tempImg.crossOrigin = 'anonymous';
  tempImg.onload = function() {
    // Adapter au viewport
    const maxWidth = window.innerWidth - 100;
    const maxHeight = window.innerHeight - 200;
    let width = tempImg.width;
    let height = tempImg.height;
    
    if (width > maxWidth || height > maxHeight) {
      const ratio = Math.min(maxWidth / width, maxHeight / height);
      width *= ratio;
      height *= ratio;
    }
    
    canvas.width = width;
    canvas.height = height;
    
    // Dessiner l'image
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.save();
    ctx.translate(canvas.width / 2, canvas.height / 2);
    ctx.rotate(currentRotation * Math.PI / 180);
    ctx.scale(cropScale, cropScale);
    ctx.translate(-canvas.width / 2, -canvas.height / 2);
    ctx.drawImage(tempImg, cropOffsetX, cropOffsetY, canvas.width, canvas.height);
    ctx.restore();
    
    // Zone de recadrage initiale (80% au centre)
    cropData.width = width * 0.8;
    cropData.height = height * 0.8;
    cropData.x = (width - cropData.width) / 2;
    cropData.y = (height - cropData.height) / 2;
    
    drawCropOverlay();
    initCropControls();
  };
  tempImg.src = img.dataset.originalUrl;
}

/**
 * Dessiner l'overlay de recadrage
 */
function drawCropOverlay() {
  const canvas = document.getElementById('crop-canvas');
  if (!canvas) return;
  
  const ctx = canvas.getContext('2d');
  
  // Redessiner l'image
  const img = document.getElementById('lightbox-image');
  const tempImg = new Image();
  tempImg.crossOrigin = 'anonymous';
  tempImg.onload = function() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.save();
    ctx.translate(canvas.width / 2, canvas.height / 2);
    ctx.rotate(currentRotation * Math.PI / 180);
    ctx.scale(cropScale, cropScale);
    ctx.translate(-canvas.width / 2, -canvas.height / 2);
    ctx.drawImage(tempImg, cropOffsetX, cropOffsetY, canvas.width, canvas.height);
    ctx.restore();
    
    // Assombrir les zones hors recadrage
    ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
    ctx.fillRect(0, 0, canvas.width, cropData.y);
    ctx.fillRect(0, cropData.y, cropData.x, cropData.height);
    ctx.fillRect(cropData.x + cropData.width, cropData.y, canvas.width - cropData.x - cropData.width, cropData.height);
    ctx.fillRect(0, cropData.y + cropData.height, canvas.width, canvas.height - cropData.y - cropData.height);
    
    // Bordure de sélection
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    ctx.strokeRect(cropData.x, cropData.y, cropData.width, cropData.height);
    
    // Poignées de redimensionnement
    const handleSize = 20;
    ctx.fillStyle = '#fff';
    // Coins
    ctx.fillRect(cropData.x - handleSize/2, cropData.y - handleSize/2, handleSize, handleSize);
    ctx.fillRect(cropData.x + cropData.width - handleSize/2, cropData.y - handleSize/2, handleSize, handleSize);
    ctx.fillRect(cropData.x - handleSize/2, cropData.y + cropData.height - handleSize/2, handleSize, handleSize);
    ctx.fillRect(cropData.x + cropData.width - handleSize/2, cropData.y + cropData.height - handleSize/2, handleSize, handleSize);
  };
  tempImg.src = img.dataset.originalUrl;
}

/**
 * Initialiser les contrôles de recadrage (drag & resize)
 */
function initCropControls() {
  const canvas = document.getElementById('crop-canvas');
  if (!canvas) return;
  
  let dragging = false;
  let resizing = null;
  let startMouseX = 0;
  let startMouseY = 0;
  let startCropX = 0;
  let startCropY = 0;
  let startCropWidth = 0;
  let startCropHeight = 0;
  
  const getMousePos = (e) => {
    const rect = canvas.getBoundingClientRect();
    const touch = e.touches ? e.touches[0] : e;
    return {
      x: touch.clientX - rect.left,
      y: touch.clientY - rect.top
    };
  };
  
  const onStart = (e) => {
    e.preventDefault();
    const pos = getMousePos(e);
    startMouseX = pos.x;
    startMouseY = pos.y;
    startCropX = cropData.x;
    startCropY = cropData.y;
    startCropWidth = cropData.width;
    startCropHeight = cropData.height;
    
    const handleSize = 20;
    // Vérifier si on clique sur une poignée
    if (Math.abs(pos.x - cropData.x) < handleSize && Math.abs(pos.y - cropData.y) < handleSize) {
      resizing = 'tl';
    } else if (Math.abs(pos.x - (cropData.x + cropData.width)) < handleSize && Math.abs(pos.y - cropData.y) < handleSize) {
      resizing = 'tr';
    } else if (Math.abs(pos.x - cropData.x) < handleSize && Math.abs(pos.y - (cropData.y + cropData.height)) < handleSize) {
      resizing = 'bl';
    } else if (Math.abs(pos.x - (cropData.x + cropData.width)) < handleSize && Math.abs(pos.y - (cropData.y + cropData.height)) < handleSize) {
      resizing = 'br';
    } else if (pos.x > cropData.x && pos.x < cropData.x + cropData.width &&
               pos.y > cropData.y && pos.y < cropData.y + cropData.height) {
      dragging = true;
    }
  };
  
  const onMove = (e) => {
    if (!dragging && !resizing) return;
    e.preventDefault();
    
    const pos = getMousePos(e);
    const dx = pos.x - startMouseX;
    const dy = pos.y - startMouseY;
    
    if (dragging) {
      cropData.x = Math.max(0, Math.min(canvas.width - cropData.width, startCropX + dx));
      cropData.y = Math.max(0, Math.min(canvas.height - cropData.height, startCropY + dy));
    } else if (resizing) {
      if (resizing === 'br') {
        cropData.width = Math.max(50, Math.min(canvas.width - cropData.x, startCropWidth + dx));
        cropData.height = Math.max(50, Math.min(canvas.height - cropData.y, startCropHeight + dy));
      } else if (resizing === 'tl') {
        const newX = Math.max(0, startCropX + dx);
        const newY = Math.max(0, startCropY + dy);
        cropData.width = startCropWidth + (cropData.x - newX);
        cropData.height = startCropHeight + (cropData.y - newY);
        cropData.x = newX;
        cropData.y = newY;
      } else if (resizing === 'tr') {
        cropData.width = Math.max(50, Math.min(canvas.width - cropData.x, startCropWidth + dx));
        const newY = Math.max(0, startCropY + dy);
        cropData.height = startCropHeight + (cropData.y - newY);
        cropData.y = newY;
      } else if (resizing === 'bl') {
        const newX = Math.max(0, startCropX + dx);
        cropData.width = startCropWidth + (cropData.x - newX);
        cropData.x = newX;
        cropData.height = Math.max(50, Math.min(canvas.height - cropData.y, startCropHeight + dy));
      }
    }
    
    drawCropOverlay();
  };
  
  const onEnd = () => {
    dragging = false;
    resizing = null;
  };
  
  canvas.onmousedown = onStart;
  canvas.onmousemove = onMove;
  canvas.onmouseup = onEnd;
  canvas.ontouchstart = onStart;
  canvas.ontouchmove = onMove;
  canvas.ontouchend = onEnd;
}

/**
 * Annuler le recadrage
 */
window.cancelCrop = function() {
  isCropMode = false;
  const overlay = document.getElementById('crop-overlay');
  const toggleBtn = document.getElementById('crop-toggle-btn');
  overlay.classList.add('hidden');
  toggleBtn.classList.remove('bg-green-600');
};

/**
 * Appliquer le recadrage et uploader l'image
 * IMPORTANT: Nécessite window.articleUploadRoute définie
 */
window.applyCrop = async function() {
  const canvas = document.getElementById('crop-canvas');
  const img = document.getElementById('lightbox-image');
  if (!canvas || !img) return;
  
  // Créer un canvas pour l'image recadrée
  const cropCanvas = document.createElement('canvas');
  cropCanvas.width = cropData.width;
  cropCanvas.height = cropData.height;
  const ctx = cropCanvas.getContext('2d');
  
  // Récupérer l'image source
  const tempImg = new Image();
  tempImg.crossOrigin = 'anonymous';
  tempImg.onload = async function() {
    // Calculer le ratio entre l'image originale et le canvas d'affichage
    const scaleX = tempImg.width / canvas.width;
    const scaleY = tempImg.height / canvas.height;
    
    // Extraire la zone recadrée à partir de l'image originale
    ctx.drawImage(
      tempImg,
      cropData.x * scaleX,
      cropData.y * scaleY,
      cropData.width * scaleX,
      cropData.height * scaleY,
      0,
      0,
      cropData.width,
      cropData.height
    );
    
    // Convertir en blob
    cropCanvas.toBlob(async (blob) => {
      const file = new File([blob], 'cropped-image.jpg', { type: 'image/jpeg' });
      
      // Upload l'image recadrée
      const formData = new FormData();
      formData.append('image', file);
      
      // Récupérer article_type_id depuis le contexte ou la variable globale
      const articleTypeId = lightboxContext.article_type_id || window.currentArticleTypeId;
      console.log('🔧 applyCrop - articleTypeId:', articleTypeId);
      
      if (!articleTypeId) {
        alert("❌ Type d'article non défini. Veuillez sélectionner un type d'article.");
        return;
      }
      formData.append('article_type_id', articleTypeId);
      
      try {
        console.log('📤 Envoi du recadrage vers serveur...', {
          articleTypeId: articleTypeId,
          fileSize: (file.size / 1024).toFixed(2) + ' KB'
        });
        
        // Utiliser la route définie globalement
        const uploadRoute = window.articleUploadRoute;
        if (!uploadRoute) {
          console.error('❌ window.articleUploadRoute non définie');
          alert('❌ Configuration upload manquante');
          return;
        }
        
        const response = await fetch(uploadRoute, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: formData
        });
        
        if (!response.ok) {
          const errorText = await response.text();
          console.error('❌ Erreur serveur:', errorText);
          alert(`❌ Erreur serveur (${response.status})`);
          return;
        }
        
        const data = await response.json();
        
        if (data.success) {
          console.log('✅ Image recadrée uploadée:', data.url);
          
          // Callbacks pour mise à jour de l'UI (définis par la page parente)
          if (typeof window.addArticleImageCard === 'function') {
            const fileName = 'recadrage-' + Date.now() + '.jpg';
            window.addArticleImageCard(data.url, fileName, 'uploaded');
          }
          
          if (typeof window.refreshArticleImagesPreview === 'function') {
            window.refreshArticleImagesPreview();
          }
          
          // Ajouter à la liste globale
          if (window.uploadedGameImages && !window.uploadedGameImages.includes(data.url)) {
            window.uploadedGameImages.push(data.url);
          }
          
          if (!window.primaryImageUrl) {
            window.primaryImageUrl = data.url;
          }
          
          // Fermer le mode recadrage et le lightbox
          cancelCrop();
          closeImageLightbox();
          
          alert('✓ Image recadrée et ajoutée!');
        } else {
          console.error('❌ Upload échoué:', data.message);
          alert(`❌ Erreur:\n${data.message || 'Upload échoué'}`);
        }
      } catch (e) {
        console.error('❌ Erreur upload recadrage:', e);
        alert(`Erreur lors de l'upload de l'image recadrée:\n${e.message}`);
      }
    }, 'image/jpeg', 0.9);
  };
  tempImg.src = img.dataset.originalUrl;
};

/**
 * Mettre à jour la transformation de l'image
 */
function updateTransform() {
  const img = document.getElementById('lightbox-image');
  if (img) {
    img.style.transform = `translate(${currentX}px, ${currentY}px) scale(${currentZoom}) rotate(${currentRotation}deg)`;
  }
}

/**
 * Initialiser les contrôles de zoom et pan
 */
function initZoomControls() {
  const img = document.getElementById('lightbox-image');
  const container = document.getElementById('lightbox-container');
  if (!img || !container) return;

  // Zoom molette souris
  container.onwheel = function(e) {
    e.preventDefault();
    if (e.deltaY < 0) {
      zoomIn();
    } else {
      zoomOut();
    }
  };

  // Pan avec souris
  img.onmousedown = function(e) {
    if (currentZoom > 1) {
      isDragging = true;
      startX = e.clientX - currentX;
      startY = e.clientY - currentY;
      img.style.cursor = 'grabbing';
    }
  };

  document.onmousemove = function(e) {
    if (isDragging) {
      currentX = e.clientX - startX;
      currentY = e.clientY - startY;
      updateTransform();
    }
  };

  document.onmouseup = function() {
    isDragging = false;
    const img = document.getElementById('lightbox-image');
    if (img && currentZoom > 1) {
      img.style.cursor = 'grab';
    }
  };

  // Support tactile (mobile)
  let touchStartX = 0;
  let touchStartY = 0;
  let lastTouchDistance = 0;

  container.ontouchstart = function(e) {
    if (e.touches.length === 1) {
      // Pan avec un doigt
      touchStartX = e.touches[0].clientX - currentX;
      touchStartY = e.touches[0].clientY - currentY;
    } else if (e.touches.length === 2) {
      // Zoom avec deux doigts (pinch)
      const dx = e.touches[0].clientX - e.touches[1].clientX;
      const dy = e.touches[0].clientY - e.touches[1].clientY;
      lastTouchDistance = Math.sqrt(dx * dx + dy * dy);
    }
  };

  container.ontouchmove = function(e) {
    e.preventDefault();
    
    if (e.touches.length === 1 && currentZoom > 1) {
      // Pan
      currentX = e.touches[0].clientX - touchStartX;
      currentY = e.touches[0].clientY - touchStartY;
      updateTransform();
    } else if (e.touches.length === 2) {
      // Pinch zoom
      const dx = e.touches[0].clientX - e.touches[1].clientX;
      const dy = e.touches[0].clientY - e.touches[1].clientY;
      const distance = Math.sqrt(dx * dx + dy * dy);
      
      if (lastTouchDistance > 0) {
        const delta = distance - lastTouchDistance;
        if (delta > 5) {
          zoomIn();
          lastTouchDistance = distance;
        } else if (delta < -5) {
          zoomOut();
          lastTouchDistance = distance;
        }
      }
    }
  };

  container.ontouchend = function() {
    lastTouchDistance = 0;
  };
}

// Fermer avec la touche Échap
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeImageLightbox();
  }
});

console.log('✅ Image Lightbox Manager chargé');
