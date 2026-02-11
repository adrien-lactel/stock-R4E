/**
 * Article Images Manager - Gestionnaire réutilisable d'images d'articles
 * 
 * Ce fichier contient toutes les fonctions pour gérer les images d'articles
 * et éviter la duplication de code entre consoles/form et product-sheets/edit
 * 
 * @version 1.0.0
 * @date 2026-02-10
 */

// ========================================
// VARIABLES GLOBALES
// ========================================

// Ces variables seront initialisées par le composant Blade ou existent déjà dans la page
// Utilisation de window pour éviter les conflits de déclaration
if (typeof window.currentArticleTypeId === 'undefined') {
    window.currentArticleTypeId = null;
}
if (typeof window.uploadedGameImages === 'undefined') {
    window.uploadedGameImages = [];
}
if (typeof window.primaryImageUrl === 'undefined') {
    window.primaryImageUrl = null;
}
if (typeof window.genericArticleImages === 'undefined') {
    window.genericArticleImages = [];
}

// Routes (seront définies par les pages qui incluent ce script)
if (typeof window.UPLOAD_ROUTE === 'undefined') {
    window.UPLOAD_ROUTE = null;
}
if (typeof window.DELETE_IMAGE_ROUTE === 'undefined') {
    window.DELETE_IMAGE_ROUTE = null;
}
if (typeof window.AJAX_ARTICLE_IMAGES_ROUTE === 'undefined') {
    window.AJAX_ARTICLE_IMAGES_ROUTE = null;
}

// ========================================
// INITIALISATION
// ========================================

/**
 * Initialise le gestionnaire d'images avec la configuration fournie
 */
window.initializeArticleImagesManager = function() {
    console.log('🚀 Initialisation du gestionnaire d\'images d\'articles');
    
    // Récupérer la configuration depuis le composant Blade
    if (window.articleImagesConfig) {
        window.currentArticleTypeId = window.articleImagesConfig.articleTypeId;
        
        // Ne PAS écraser window.uploadedGameImages s'il contient déjà des images uploadées
        if (!window.uploadedGameImages || window.uploadedGameImages.length === 0) {
            window.uploadedGameImages = window.articleImagesConfig.uploadedImages || [];
            console.log('📥 Images chargées depuis la config:', window.uploadedGameImages.length);
        } else {
            console.log('⚠️  Images déjà présentes, conservation:', window.uploadedGameImages.length);
        }
        
        // Ne PAS écraser window.primaryImageUrl s'il existe déjà
        if (!window.primaryImageUrl) {
            window.primaryImageUrl = window.articleImagesConfig.primaryImage || '';
        }
        
        console.log('✅ Configuration chargée:', {
            typeId: window.currentArticleTypeId,
            imagesCount: window.uploadedGameImages.length,
            primaryImage: window.primaryImageUrl
        });
        
        // Rafraîchir l'aperçu
        refreshArticleImagesPreview();
    } else {
        console.warn('⚠️ Aucune configuration trouvée pour articleImagesConfig');
    }
};

// ===============================================
// MODAL DES IMAGES DE TAXONOMIE (GÉNÉRIQUES)
// ===============================================

/**
 * Ouvre la modal pour voir les images génériques de la taxonomie
 */
window.openTaxonomyImagesModal = function() {
    console.log('🖼️ Ouverture modal taxonomie');
    console.log('🔍 window.currentArticleTypeId actuel:', window.currentArticleTypeId);
    
    // Vérifier si window.currentArticleTypeId existe, sinon récupérer depuis le select
    if (!window.currentArticleTypeId) {
        const typeSelect = document.getElementById('article_type_id');
        if (typeSelect && typeSelect.value) {
            window.currentArticleTypeId = typeSelect.value;
            console.log('✅ article_type_id récupéré depuis le select:', window.currentArticleTypeId);
        } else {
            console.error('❌ Aucun article_type_id disponible');
            alert('Type d\'article non défini');
            return;
        }
    }
    
    const modal = document.createElement('div');
    modal.id = 'taxonomy-images-modal';
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto';
    
    const modalContent = document.createElement('div');
    modalContent.className = 'bg-white rounded-lg shadow-xl max-w-6xl w-full my-8';
    modalContent.style.maxHeight = '90vh';
    modalContent.style.overflowY = 'auto';
    
    const header = document.createElement('div');
    header.className = 'bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-t-lg flex justify-between items-center sticky top-0 z-10';
    header.innerHTML = `
        <h3 class="text-xl font-bold">🖼️ Photos génériques du type</h3>
        <button onclick="document.getElementById('taxonomy-images-modal').remove()" 
                class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
    `;
    
    const body = document.createElement('div');
    body.className = 'p-6 space-y-6';
    body.innerHTML = `
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
            <p class="text-sm text-blue-800">
                <strong>ℹ️ Ces images sont génériques</strong> pour tous les exemplaires de ce type.
                Elles sont issues de la taxonomie et partagées automatiquement.
            </p>
        </div>
        <div id="taxonomy-images-grid" class="grid grid-cols-2 md:grid-cols-3 gap-6">
            <div class="col-span-full text-center text-gray-400 py-6">
                <div class="animate-pulse">⏳ Chargement des photos...</div>
            </div>
        </div>
    `;
    
    modalContent.appendChild(header);
    modalContent.appendChild(body);
    modal.appendChild(modalContent);
    
    modal.onclick = (e) => {
        if (e.target === modal) {
            modal.remove();
        }
    };
    
    document.body.appendChild(modal);
    
    // Charger les images de taxonomie
    loadTaxonomyImages();
};

/**
 * Charge les images de la taxonomie (cover, artwork, gameplay, logo)
 */
async function loadTaxonomyImages() {
    const grid = document.getElementById('taxonomy-images-grid');
    if (!grid || !window.currentArticleTypeId) {
        console.error('❌ loadTaxonomyImages: grid ou currentArticleTypeId manquant', { grid: !!grid, typeId: window.currentArticleTypeId });
        return;
    }
    
    try {
        // Utiliser la route AJAX pour récupérer les images du type
        const url = `/admin/ajax/type-description/${window.currentArticleTypeId}`;
        console.log('📡 Fetching taxonomy images from:', url);
        
        const response = await fetch(url);
        console.log('📡 Response status:', response.status, response.statusText);
        
        const data = await response.json();
        console.log('📡 API response data:', data);
        
        grid.innerHTML = '';
        
        const imageTypes = [
            { key: 'cover_image', label: '📖 Cover' },
            { key: 'artwork_image', label: '🎨 Artwork' },
            { key: 'gameplay_image', label: '🎮 Gameplay' },
            { key: 'logo_image', label: '🏷️ Logo' }
        ];
        
        let hasImages = false;
        
        imageTypes.forEach(type => {
            console.log(`🖼️ Checking ${type.key}:`, data[type.key]);
            if (data[type.key]) {
                hasImages = true;
                const imageCard = document.createElement('div');
                imageCard.className = 'border border-gray-300 rounded-lg p-4 bg-white hover:shadow-lg transition';
                imageCard.innerHTML = `
                    <img src="${data[type.key]}" 
                         alt="${type.label}" 
                         class="w-full aspect-square object-contain rounded mb-2 cursor-pointer"
                         onclick="window.open('${data[type.key]}', '_blank')"
                         onerror="console.error('❌ Image failed to load:', '${data[type.key]}'); this.src='data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 100 100%22><text y=%22.9em%22 font-size=%2280%22>❌</text></svg>'">
                    <p class="text-sm font-medium text-gray-700 text-center">${type.label}</p>
                `;
                grid.appendChild(imageCard);
            }
        });
        
        console.log('🖼️ Total images found:', hasImages ? 'yes' : 'no');
        
        if (!hasImages) {
            grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6">📭 Aucune image générique trouvée</div>';
        }
    } catch (error) {
        console.error('❌ Erreur chargement images taxonomie:', error);
        grid.innerHTML = '<div class="col-span-full text-center text-red-400 py-6">❌ Erreur de chargement</div>';
    }
}

// ===============================================
// MODAL PRINCIPALE DE GESTION DES IMAGES
// ===============================================

/**
 * Ouvre la modal de gestion des images de l'article
 */
window.openArticleImagesModal = function() {
    console.log('🖼️ Ouverture modal images article');
    console.log('🔍 window.currentArticleTypeId actuel:', window.currentArticleTypeId);
    
    // Vérifier si window.currentArticleTypeId existe, sinon récupérer depuis le select
    if (!window.currentArticleTypeId) {
        const typeSelect = document.getElementById('article_type_id');
        if (typeSelect && typeSelect.value) {
            window.currentArticleTypeId = typeSelect.value;
            console.log('✅ article_type_id récupéré depuis le select:', window.currentArticleTypeId);
        } else {
            console.error('❌ Aucun article_type_id disponible');
            alert('Veuillez d\'abord sélectionner un type d\'article');
            return;
        }
    }
    
    const modal = document.createElement('div');
    modal.id = 'article-images-modal';
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto';
    
    const modalContent = document.createElement('div');
    modalContent.className = 'bg-white rounded-lg shadow-xl max-w-4xl w-full my-8';
    modalContent.style.maxHeight = '90vh';
    modalContent.style.overflowY = 'auto';
    
    // Header
    const header = document.createElement('div');
    header.className = 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-4 rounded-t-lg flex justify-between items-center sticky top-0 z-10';
    header.innerHTML = `
      <h3 class="text-xl font-bold">📸 Photos de l'article</h3>
      <button onclick="closeArticleImagesModal()" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
    `;
    
    // Body
    const body = document.createElement('div');
    body.className = 'p-6 space-y-6';
    
    // Section Upload
    const uploadSection = createUploadSection();
    
    // Section Images existantes
    const existingSection = createExistingImagesSection();
    
    // Section Photos génériques (autres articles du même type)
    const genericSection = createGenericImagesSection();
    
    // Assembler la modal
    body.appendChild(uploadSection);
    body.appendChild(existingSection);
    body.appendChild(genericSection);
    
    modalContent.appendChild(header);
    modalContent.appendChild(body);
    modal.appendChild(modalContent);
    
    // Clic en dehors pour fermer
    modal.onclick = (e) => {
        if (e.target === modal) {
            closeArticleImagesModal();
        }
    };
    
    document.body.appendChild(modal);
    
    // Charger les images
    loadArticleImages();
    loadGenericArticleImages();
};

/**
 * Crée la section d'upload
 */
function createUploadSection() {
    const section = document.createElement('div');
    section.className = 'border-2 border-dashed border-indigo-300 rounded-lg p-6 bg-indigo-50 hover:bg-indigo-100 transition-colors';
    section.innerHTML = `
      <div class="text-center">
        <div class="text-4xl mb-2">📸</div>
        <h4 class="font-semibold text-gray-700 mb-2">Prendre/Ajouter des photos</h4>
        <p class="text-sm text-gray-500 mb-4">Utilisez l'appareil photo de votre smartphone ou sélectionnez des fichiers</p>
        
        <input type="file" id="article-image-camera" accept="image/*" capture="environment" multiple class="hidden">
        <input type="file" id="article-image-file" accept="image/*" multiple class="hidden">
        
        <div class="flex gap-3 justify-center">
          <button type="button" onclick="document.getElementById('article-image-camera').click()" 
                  class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            📱 Appareil photo
          </button>
          <button type="button" onclick="document.getElementById('article-image-file').click()" 
                  class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            🖼️ Galerie
          </button>
        </div>
      </div>
    `;
    
    // Event listeners
    setupUploadListeners(section);
    
    return section;
}

/**
 * Configure les event listeners pour l'upload
 */
function setupUploadListeners(uploadSection) {
    // Drag & Drop
    uploadSection.ondragover = (e) => {
        e.preventDefault();
        uploadSection.classList.add('border-indigo-500', 'bg-indigo-200');
    };
    
    uploadSection.ondragleave = () => {
        uploadSection.classList.remove('border-indigo-500', 'bg-indigo-200');
    };
    
    uploadSection.ondrop = (e) => {
        e.preventDefault();
        uploadSection.classList.remove('border-indigo-500', 'bg-indigo-200');
        handleArticleImagesUpload(e.dataTransfer.files);
    };
    
    // Event listeners pour les inputs
    const cameraInput = uploadSection.querySelector('#article-image-camera');
    const fileInput = uploadSection.querySelector('#article-image-file');
    
    if (cameraInput) {
        cameraInput.onchange = async (e) => {
            await handleArticleImagesUpload(e.target.files);
            e.target.value = '';
        };
    }
    
    if (fileInput) {
        fileInput.onchange = async (e) => {
            await handleArticleImagesUpload(e.target.files);
            e.target.value = '';
        };
    }
}

/**
 * Crée la section des images existantes
 */
function createExistingImagesSection() {
    const section = document.createElement('div');
    section.className = 'space-y-4';
    section.innerHTML = `
      <div class="flex items-center justify-between">
        <h4 class="font-semibold text-gray-700">Photos de cet article (<span id="article-images-count">0</span>)</h4>
        <button type="button" onclick="document.getElementById('article-image-camera').click()" 
                class="text-sm bg-indigo-100 hover:bg-indigo-200 text-indigo-700 px-3 py-1.5 rounded-lg font-medium flex items-center gap-1 transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Ajouter
        </button>
      </div>
      <div id="article-images-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div class="col-span-full text-center text-gray-500 py-8">
          📭 Aucune photo pour le moment
        </div>
      </div>
    `;
    
    return section;
}

/**
 * Crée la section des images génériques
 */
function createGenericImagesSection() {
    const section = document.createElement('div');
    section.className = 'space-y-4 border-t pt-6';
    section.innerHTML = `
      <div class="flex items-center justify-between">
        <div>
          <h4 class="font-semibold text-gray-700">📚 Photos d'autres articles du même type</h4>
          <p class="text-xs text-gray-500 mt-1">Cliquez sur une photo pour la réutiliser sur cet article</p>
        </div>
        <span id="generic-images-count" class="text-sm text-gray-500">Chargement...</span>
      </div>
      <div id="generic-images-grid" class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <div class="col-span-full text-center text-gray-400 py-6">
          <div class="animate-pulse">⏳ Chargement des photos...</div>
        </div>
      </div>
    `;
    
    return section;
}

// ===============================================
// GESTION DES UPLOADS
// ===============================================

/**
 * Gère l'upload des images
 */
async function handleArticleImagesUpload(files) {
    for (const file of Array.from(files)) {
        if (!file.type.startsWith('image/')) {
            console.warn('Fichier ignoré (pas une image):', file.name);
            continue;
        }
        
        const originalSize = (file.size / 1024 / 1024).toFixed(2);
        console.log(`📁 Fichier original: ${file.name} (${originalSize}MB)`);
        
        let processedFile = file;
        if (file.size > 2 * 1024 * 1024) {
            console.log('🔄 Compression en cours...');
            processedFile = await compressImage(file);
        }
        
        const reader = new FileReader();
        reader.onload = (e) => {
            addArticleImageCard(e.target.result, file.name, 'uploading');
        };
        reader.readAsDataURL(processedFile);
        
        uploadArticleImage(processedFile, file.name);
    }
}

/**
 * Compresse une image avant l'upload
 */
async function compressImage(file, maxWidth = 1920, quality = 0.85) {
    return new Promise((resolve) => {
        const reader = new FileReader();
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                let width = img.width;
                let height = img.height;
                
                if (width > maxWidth) {
                    height = (height * maxWidth) / width;
                    width = maxWidth;
                }
                
                const canvas = document.createElement('canvas');
                canvas.width = width;
                canvas.height = height;
                
                const ctx = canvas.getContext('2d');
                ctx.drawImage(img, 0, 0, width, height);
                
                canvas.toBlob((blob) => {
                    const compressedFile = new File([blob], file.name, {
                        type: 'image/jpeg',
                        lastModified: Date.now()
                    });
                    
                    const originalSize = (file.size / 1024 / 1024).toFixed(2);
                    const compressedSize = (compressedFile.size / 1024 / 1024).toFixed(2);
                    console.log(`🗜️ Compression: ${originalSize}MB → ${compressedSize}MB`);
                    
                    resolve(compressedFile);
                }, 'image/jpeg', quality);
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);
    });
}

/**
 * Upload une image vers le serveur
 */
async function uploadArticleImage(file, originalFileName = null) {
    const fileName = originalFileName || file.name;
    const fileSize = (file.size / 1024 / 1024).toFixed(2);
    
    console.log(`📤 Upload image: ${fileName} (${fileSize}MB)`);
    console.log('🔍 window.currentArticleTypeId actuel:', window.currentArticleTypeId);
    
    // Vérifier si window.currentArticleTypeId existe, sinon récupérer depuis le select
    if (!window.currentArticleTypeId) {
        // Essayer de récupérer depuis le select article_type_id
        const typeSelect = document.getElementById('article_type_id');
        if (typeSelect && typeSelect.value) {
            window.currentArticleTypeId = typeSelect.value;
            console.log('✅ article_type_id récupéré depuis le select:', window.currentArticleTypeId);
        } else {
            console.error('❌ Aucun article_type_id disponible');
            alert('Veuillez d\'abord sélectionner un type d\'article');
            removeArticleImageCard(fileName);
            return;
        }
    }

    if (file.size > 50 * 1024 * 1024) {
        alert(`❌ Fichier trop volumineux: ${fileSize}MB (limite: 50MB)`);
        removeArticleImageCard(fileName);
        return;
    }

    const formData = new FormData();
    formData.append('image', file);
    formData.append('article_type_id', window.currentArticleTypeId);
    
    console.log('📦 FormData avec article_type_id:', window.currentArticleTypeId);

    try {
        const response = await fetch(window.UPLOAD_ROUTE, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });

        if (!response.ok) {
            const errorText = await response.text();
            console.error('❌ Erreur HTTP:', response.status, errorText);
            alert(`❌ Erreur upload: ${response.status}`);
            removeArticleImageCard(fileName);
            return;
        }

        const data = await response.json();

        if (data.success) {
            console.log('✅ Image uploadée avec succès:', data.url);
            
            updateArticleImageCard(fileName, data.url);
            window.uploadedGameImages.push(data.url);
            console.log('📊 Total images après upload:', window.uploadedGameImages.length);
            console.log('📋 Liste complète:', window.uploadedGameImages);
            
            if (!window.primaryImageUrl && window.uploadedGameImages.length === 1) {
                window.primaryImageUrl = data.url;
                console.log('⭐ Première image définie comme principale automatiquement');
            }
            
            console.log('🔄 Appel de refreshArticleImagesPreview()...');
            refreshArticleImagesPreview();
        } else {
            console.error('Erreur upload:', data.message);
            alert(`❌ Erreur: ${data.message}`);
            removeArticleImageCard(fileName);
        }
    } catch (e) {
        console.error('❌ Exception upload:', e);
        alert(`❌ Erreur lors de l'upload`);
        removeArticleImageCard(fileName);
    }
}

// ===============================================
// GESTION DES CARTES D'IMAGES
// ===============================================

/**
 * Ajoute une carte d'image dans la grille
 */
function addArticleImageCard(imageUrl, fileName, state = 'uploaded') {
    const grid = document.getElementById('article-images-grid');
    
    // Supprimer le message "aucune photo"
    const emptyMsg = grid.querySelector('.col-span-full');
    if (emptyMsg) emptyMsg.remove();
    
    const card = document.createElement('div');
    card.className = 'relative group rounded-lg overflow-hidden border-2 border-gray-200 hover:border-indigo-400 transition-all';
    card.dataset.fileName = fileName;
    card.dataset.imageUrl = imageUrl;
    
    const isUploading = state === 'uploading';
    const isPrimary = (imageUrl === window.primaryImageUrl);
    
    card.innerHTML = `
      <div class="aspect-square relative bg-gray-100">
        <img src="${imageUrl}" alt="${fileName}" 
             class="w-full h-full object-cover ${isUploading ? 'opacity-50' : ''}">
        
        ${isUploading ? `
          <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
            <div class="animate-spin rounded-full h-10 w-10 border-4 border-white border-t-transparent"></div>
          </div>
        ` : ''}
        
        ${isPrimary ? `
          <span class="absolute top-2 left-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-bold shadow-lg flex items-center gap-1">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            Principale
          </span>
        ` : ''}
        
        ${!isUploading ? `
          <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            ${!isPrimary ? `
              <button type="button" 
                      onclick="setPrimaryImage('${imageUrl}')" 
                      class="bg-yellow-500 hover:bg-yellow-600 text-white p-1.5 rounded-full shadow-lg transition-colors"
                      title="Définir comme image principale">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              </button>
            ` : ''}
            <button type="button" 
                    onclick="deleteArticleImage('${imageUrl}')" 
                    class="bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-full shadow-lg transition-colors"
                    title="Supprimer">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
              </svg>
            </button>
          </div>
        ` : ''}
      </div>
      
      ${!isUploading ? `
        <div class="p-2 bg-white">
          <input type="text" 
                 placeholder="Légende (optionnel)" 
                 value=""
                 onchange="updateArticleImageCaption('${imageUrl}', this.value)"
                 class="w-full text-xs border border-gray-200 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-indigo-500">
        </div>
      ` : `
        <div class="p-2 bg-gray-50">
          <div class="text-xs text-gray-500 truncate">⏳ Upload en cours...</div>
        </div>
      `}
    `;
    
    grid.appendChild(card);
    updateArticleImagesCount();
}

/**
 * Met à jour une carte après upload réussi
 */
function updateArticleImageCard(fileName, uploadedUrl) {
    const card = document.querySelector(`[data-file-name="${fileName}"]`);
    if (card) {
        card.dataset.imageUrl = uploadedUrl;
        card.querySelector('img').src= uploadedUrl;
        card.classList.remove('opacity-50');
        
        const spinner = card.querySelector('.animate-spin');
        if (spinner) spinner.parentElement.remove();
        
        const footer = card.querySelector('.bg-gray-50');
        if (footer) {
            footer.innerHTML = `
                <input type="text" 
                       placeholder="Légende (optionnel)" 
                       value=""
                       onchange="updateArticleImageCaption('${uploadedUrl}', this.value)"
                       class="w-full text-xs border border-gray-200 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-indigo-500">
            `;
            footer.className = 'p-2 bg-white';
        }
    }
}

/**
 * Supprime une carte en cas d'erreur
 */
function removeArticleImageCard(fileName) {
    const card = document.querySelector(`[data-file-name="${fileName}"]`);
    if (card) {
        card.remove();
        updateArticleImagesCount();
        
        // S'il ne reste plus d'images, afficher le message
        const grid = document.getElementById('article-images-grid');
        if (grid && grid.children.length === 0) {
            grid.innerHTML = `
                <div class="col-span-full text-center text-gray-500 py-8">
                    📭 Aucune photo pour le moment
                </div>
            `;
        }
    }
}

/**
 * Met à jour le compteur d'images
 */
function updateArticleImagesCount() {
    const count = document.getElementById('article-images-count');
    if (count) {
        count.textContent = window.uploadedGameImages.length;
    }
}

// ===============================================
// AUTRES FONCTIONS
// ===============================================

/**
 * Définit une image comme principale
 */
window.setPrimaryImage = function(imageUrl) {
    window.primaryImageUrl = imageUrl;
    console.log('⭐ Image principale définie:', imageUrl);
    
    loadArticleImages(); // Recharger pour mettre à jour les badges
    refreshArticleImagesPreview();
};

/**
 * Supprime une image
 */
window.deleteArticleImage = async function(imageUrl) {
    if (!confirm('Supprimer cette image ?')) return;
    
    try {
        const response = await fetch(window.DELETE_IMAGE_ROUTE, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ image_url: imageUrl })
        });
        
        const data = await response.json();
        
        if (data.success) {
            window.uploadedGameImages = window.uploadedGameImages.filter(img => {
                const url = typeof img === 'object' ? img.url : img;
                return url !== imageUrl;
            });
            
            if (window.primaryImageUrl === imageUrl) {
                if (window.uploadedGameImages.length > 0) {
                    const firstImg = window.uploadedGameImages[0];
                    window.primaryImageUrl = typeof firstImg === 'object' ? firstImg.url : firstImg;
                } else {
                    window.primaryImageUrl = '';
                }
            }
            
            console.log('✅ Image supprimée:', imageUrl);
            loadArticleImages();
            refreshArticleImagesPreview();
        } else {
            alert('❌ Erreur lors de la suppression: ' + data.message);
        }
    } catch (error) {
        console.error('❌ Erreur suppression:', error);
        alert('❌ Erreur lors de la suppression');
    }
};

/**
 * Met à jour la légende d'une image
 */
window.updateArticleImageCaption = function(imageUrl, caption) {
    console.log(`📝 Légende mise à jour pour ${imageUrl}:`, caption);
    // TODO: Implémenter la sauvegarde des légendes si nécessaire
};

/**
 * Charge les images existantes de l'article
 */
function loadArticleImages() {
    const grid = document.getElementById('article-images-grid');
    if (!grid) {
        console.warn('⚠️ Grid #article-images-grid introuvable');
        return;
    }
    
    console.log('🔄 loadArticleImages() - Chargement de', window.uploadedGameImages.length, 'images');
    console.log('📋 Images à charger:', window.uploadedGameImages);
    
    grid.innerHTML = '';
    
    if (window.uploadedGameImages.length === 0) {
        console.log('📭 Aucune image à afficher');
        grid.innerHTML = '<div class="col-span-full text-center text-gray-500 py-8">📭 Aucune photo pour le moment</div>';
        return;
    }
    
    window.uploadedGameImages.forEach(img => {
        const imageUrl = typeof img === 'object' ? img.url : img;
        addArticleImageCard(imageUrl, imageUrl.split('/').pop(), 'uploaded');
    });
    
    updateArticleImagesCount();
}

/**
 * Charge les photos génériques (autres articles du même type)
 */
async function loadGenericArticleImages() {
    const grid = document.getElementById('generic-images-grid');
    
    console.log('🔄 loadGenericArticleImages appelé');
    console.log('🔍 window.currentArticleTypeId:', window.currentArticleTypeId);
    console.log('🔍 window.AJAX_ARTICLE_IMAGES_ROUTE:', window.AJAX_ARTICLE_IMAGES_ROUTE);
    
    // Vérifier si window.currentArticleTypeId existe, sinon récupérer depuis le select
    if (!window.currentArticleTypeId) {
        const typeSelect = document.getElementById('article_type_id');
        if (typeSelect && typeSelect.value) {
            window.currentArticleTypeId = typeSelect.value;
            console.log('✅ article_type_id récupéré depuis le select pour images génériques:', window.currentArticleTypeId);
        }
    }
    
    if (!grid || !window.AJAX_ARTICLE_IMAGES_ROUTE || !window.currentArticleTypeId) {
        if (grid) {
            console.error('❌ Configuration manquante pour images génériques');
            console.log('  - grid:', !!grid);
            console.log('  - AJAX_ARTICLE_IMAGES_ROUTE:', window.AJAX_ARTICLE_IMAGES_ROUTE);
            console.log('  - currentArticleTypeId:', window.currentArticleTypeId);
            grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-4">⚠️ Configuration manquante</div>';
        }
        return;
    }
    
    grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6"><div class="animate-pulse">⏳ Chargement des photos...</div></div>';
    
    try {
        console.log(`🌐 Fetch images génériques: ${window.AJAX_ARTICLE_IMAGES_ROUTE}/${window.currentArticleTypeId}`);
        const response = await fetch(`${window.AJAX_ARTICLE_IMAGES_ROUTE}/${window.currentArticleTypeId}`);
        const data = await response.json();
        
        console.log('📦 Données reçues des images génériques:', data);
        
        if (data.success && data.images && data.images.length > 0) {
            window.genericArticleImages = data.images;
            
            grid.innerHTML = '';
            data.images.forEach((imageUrl, index) => {
                const isAlreadyAdded = window.uploadedGameImages.some(img => {
                    const url = typeof img === 'object' ? img.url : img;
                    return url === imageUrl;
                });
                
                const card = document.createElement('div');
                card.className = `relative group rounded-lg overflow-hidden border-2 transition-all cursor-pointer ${
                    isAlreadyAdded ? 'border-purple-500 bg-purple-50' : 'border-gray-200 hover:border-indigo-400'
                }`;
                card.dataset.genericImage = imageUrl;
                
                card.innerHTML = `
                    <div class="aspect-square relative bg-gray-100">
                      <img src="${imageUrl}" alt="Photo générique ${index + 1}" class="w-full h-full object-cover">
                      
                      ${isAlreadyAdded ? `
                        <div class="absolute inset-0 bg-purple-500 bg-opacity-20 flex items-center justify-center">
                          <span class="bg-purple-600 text-white px-3 py-1.5 rounded-full font-bold text-sm shadow-lg">
                            ✓ Ajoutée
                          </span>
                        </div>
                      ` : `
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all flex items-center justify-center">
                          <button type="button" 
                                  onclick="addGenericImageToArticle('${imageUrl}')"
                                  class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium opacity-0 group-hover:opacity-100 transition-opacity transform group-hover:scale-105">
                            ➕ Ajouter
                          </button>
                        </div>
                      `}
                    </div>
                `;
                
                grid.appendChild(card);
            });
            
            document.getElementById('generic-images-count').textContent = `${data.images.length} photo(s) disponible(s)`;
        } else {
            grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6">📭 Aucune autre photo trouvée pour ce type</div>';
            document.getElementById('generic-images-count').textContent = '0 photo';
        }
    } catch (error) {
        console.error('❌ Erreur lors du chargement des photos génériques:', error);
        grid.innerHTML = '<div class="col-span-full text-center text-red-400 py-6">❌ Erreur de chargement</div>';
    }
}

/**
 * Ajoute une photo générique à cet article
 */
window.addGenericImageToArticle = function(imageUrl) {
    const alreadyExists = window.uploadedGameImages.some(img => {
        const url = typeof img === 'object' ? img.url : img;
        return url === imageUrl;
    });
    
    if (alreadyExists) {
        console.log('⚠️ Cette image est déjà ajoutée');
        return;
    }
    
    window.uploadedGameImages.push({
        url: imageUrl,
        is_generic: true
    });
    
    console.log('✅ Photo générique ajoutée:', imageUrl);
    
    loadArticleImages();
    loadGenericArticleImages();
    refreshArticleImagesPreview();
};

/**
 * Ferme la modal
 */
window.closeArticleImagesModal = function() {
    const modal = document.getElementById('article-images-modal');
    if (modal) {
        modal.remove();
        refreshArticleImagesPreview();
    }
};

/**
 * Rafraîchit l'aperçu des images dans le formulaire principal
 */
window.refreshArticleImagesPreview = function() {
    console.log('🎨 refreshArticleImagesPreview() appelée');
    console.log('📊 window.uploadedGameImages:', window.uploadedGameImages);
    console.log('📊 Nombre d\'images:', window.uploadedGameImages ? window.uploadedGameImages.length : 0);
    
    const previewContainer = document.getElementById('game-images-preview');
    
    if (!previewContainer) {
        console.warn('⚠️ Container #game-images-preview introuvable');
        return;
    }
    
    if (!window.uploadedGameImages || window.uploadedGameImages.length === 0) {
        console.log('📭 Aucune image à prévisualiser');
        previewContainer.innerHTML = '<div class="col-span-4 text-center text-gray-400 py-6 border-2 border-dashed border-gray-300 rounded-lg">📭 Aucune photo pour le moment</div>';
        return;
    }
    
    const sortedImages = window.uploadedGameImages.map(img => typeof img === 'object' ? img.url : img);
    
    if (window.primaryImageUrl) {
        sortedImages.sort((a, b) => {
            if (a === window.primaryImageUrl) return -1;
            if (b === window.primaryImageUrl) return 1;
            return 0;
        });
    }
    
    previewContainer.innerHTML = sortedImages.slice(0, 4).map((url) => {
        const isPrimary = (url === window.primaryImageUrl);
        return `
            <div class="relative group">
              <img src="${url}" class="w-full aspect-square object-cover rounded border-2 ${isPrimary ? 'border-indigo-600' : 'border-gray-300'}">
              ${isPrimary ? '<span class="absolute top-1 left-1 bg-indigo-600 text-white text-xs px-2 py-1 rounded font-bold shadow-lg">⭐ Principale</span>' : ''}
            </div>
        `;
    }).join('');
    
    if (window.uploadedGameImages.length > 4) {
        const more = document.createElement('div');
        more.className = 'flex items-center justify-center bg-gray-100 rounded border-2 border-gray-300 aspect-square text-gray-500 font-medium';
        more.textContent = `+${window.uploadedGameImages.length - 4}`;
        previewContainer.appendChild(more);
    }

    // Mettre à jour les champs cachés du formulaire
    const imagesInput = document.getElementById('article_images_input') || document.getElementById('images_input');
    const mainImageInput = document.getElementById('primary_image_url_input') || document.getElementById('main_image_input');
    
    if (imagesInput) {
        // Normaliser : extraire seulement les URLs (strings)
        const imageUrls = window.uploadedGameImages.map(img => {
            return typeof img === 'object' ? img.url : img;
        });
        imagesInput.value = JSON.stringify(imageUrls);
        console.log('💾 Images synchronisées dans le champ caché:', imageUrls.length, 'images');
    }
    
    if (mainImageInput) {
        mainImageInput.value = window.primaryImageUrl || '';
        console.log('⭐ Image principale synchronisée:', window.primaryImageUrl || 'aucune');
    }
};

// ===============================================
// EXPORT DES ROUTES (À DÉFINIR PAR LA PAGE)
// ===============================================

/**
 * Configure les routes pour ce gestionnaire
 * À appeler depuis la page qui inclut ce script
 */
window.configureArticleImagesRoutes = function(routes) {
    window.UPLOAD_ROUTE = routes.upload;
    window.DELETE_IMAGE_ROUTE = routes.delete;
    window.AJAX_ARTICLE_IMAGES_ROUTE = routes.ajaxImages;
    
    console.log('✅ Routes configurées:', routes);
};

console.log('✅ article-images-manager.js chargé');
