

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📸 Gestionnaire d'images par catégorie</h1>
        <div class="flex items-center gap-2">
            <a href="<?php echo e(route('admin.product-sheets.images-manager', ['show_all' => '1'])); ?>" 
               class="px-4 py-2 rounded <?php echo e(request('show_all') == '1' ? 'bg-indigo-600 text-white' : 'bg-gray-200 hover:bg-gray-300'); ?>">
                🖼️ Toutes les images
            </a>
            <a href="<?php echo e(route('admin.product-sheets.index')); ?>" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour</a>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Sélectionner une catégorie</h2>
        
        <form method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
            
            <div>
                <label class="block text-sm font-medium mb-1">Catégorie</label>
                <select id="category_select" name="category_temp" class="w-full rounded-md border-gray-300">
                    <option value="">-- Sélectionner --</option>
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($category->id); ?>" <?php if($selectedType && $selectedType->subCategory->brand->category->id == $category->id): echo 'selected'; endif; ?>>
                            <?php echo e($category->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>

            
            <div>
                <label class="block text-sm font-medium mb-1">Marque</label>
                <select id="brand_select" name="brand_temp" class="w-full rounded-md border-gray-300" disabled>
                    <option value="">-- Sélectionner une catégorie d'abord --</option>
                </select>
            </div>

            
            <div>
                <label class="block text-sm font-medium mb-1">Sous-catégorie</label>
                <select id="sub_category_select" name="sub_category_temp" class="w-full rounded-md border-gray-300" disabled>
                    <option value="">-- Sélectionner une marque d'abord --</option>
                    <?php if($selectedType): ?>
                        <?php $__currentLoopData = $selectedType->subCategory->category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($sub->id); ?>" <?php if($selectedType->subCategory->id == $sub->id): echo 'selected'; endif; ?>>
                                <?php echo e($sub->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>

            
            <div>
                <label class="block text-sm font-medium mb-1">Type</label>
                <select id="type_select" name="article_type_id" class="w-full rounded-md border-gray-300" disabled>
                    <option value="">-- Sélectionner une sous-catégorie d'abord --</option>
                    <?php if($selectedType): ?>
                        <?php $__currentLoopData = $selectedType->subCategory->types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($type->id); ?>" <?php if($selectedType->id == $type->id): echo 'selected'; endif; ?>>
                                <?php echo e($type->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
                </select>
            </div>

            
            <div class="flex items-end">
                <button type="submit" class="w-full px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    🔍 Afficher les images
                </button>
            </div>
        </form>
    </div>

    <?php if($selectedType || $showAll ?? false): ?>
        
        <?php if($selectedType): ?>
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">Ajouter une image</h2>
            
            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                <input type="file" id="image_upload" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/avif" class="hidden">
                <label for="image_upload" class="cursor-pointer">
                    <div class="text-gray-600">
                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        <p class="mt-2 text-sm font-medium">Cliquez pour sélectionner une image</p>
                        <p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF, WEBP, AVIF jusqu'à 5 Mo</p>
                    </div>
                </label>
            </div>

            <div id="upload_status" class="mt-4 hidden text-sm"></div>
        </div>
        <?php endif; ?>

        
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                <?php echo e($showAll ?? false ? 'Toutes les images' : 'Images existantes'); ?> (<?php echo e(count($images)); ?>)
            </h2>
            
            <?php if(count($images) > 0): ?>
                <div id="images_grid" class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                    <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="relative group" data-image-url="<?php echo e($image['url']); ?>" data-source="<?php echo e($image['source'] ?? 'product_sheet'); ?>" data-sheet-id="<?php echo e($image['sheet_id'] ?? ''); ?>" data-type-id="<?php echo e($image['type_id'] ?? ''); ?>">
                            <img src="<?php echo e($image['url']); ?>" 
                                 alt="Image <?php echo e($image['source'] === 'article_type' ? 'de type' : 'de fiche'); ?> <?php echo e($image['type_name'] ?? $image['sheet_name'] ?? ''); ?>"
                                 class="w-full h-32 object-cover rounded border border-gray-300 cursor-pointer hover:opacity-90 transition"
                                 onclick="openLightbox('<?php echo e($image['url']); ?>', '<?php echo e(addslashes($image['type_name'] ?? $image['sheet_name'] ?? '')); ?>', <?php if($showAll ?? false): ?>'<?php echo e($image['category_name'] ?? ''); ?> › <?php echo e($image['sub_category_name'] ?? ''); ?> › <?php echo e($image['type_name'] ?? ''); ?>'<?php else: ?> null <?php endif; ?>, '<?php echo e($image['source'] ?? 'product_sheet'); ?>', <?php echo e($image['sheet_id'] ?? 'null'); ?>, <?php echo e($image['type_id'] ?? 'null'); ?>)">
                            
                            
                            <?php if(isset($image['label'])): ?>
                                <div class="absolute top-1 left-1 bg-gradient-to-r from-green-500 to-green-600 text-white text-[10px] font-bold px-2 py-1 rounded-full shadow-lg">
                                    <?php echo e($image['label']); ?>

                                </div>
                            <?php endif; ?>
                            
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white text-[10px] px-1 py-0.5">
                                <div class="truncate">
                                    <?php if(str_contains($image['source'] ?? 'product_sheet', 'article_type')): ?>
                                        <span class="bg-purple-600 px-1 rounded text-[9px]">Type</span> <?php echo e($image['type_name'] ?? ''); ?>

                                    <?php else: ?>
                                        <span class="bg-blue-600 px-1 rounded text-[9px]">Fiche</span> <?php echo e($image['sheet_name'] ?? ''); ?>

                                    <?php endif; ?>
                                </div>
                                <?php if($showAll ?? false): ?>
                                    <div class="text-gray-300 text-[10px] truncate">
                                        <?php echo e($image['category_name'] ?? ''); ?> › <?php echo e($image['sub_category_name'] ?? ''); ?> › <?php echo e($image['type_name'] ?? ''); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <button type="button" 
                                    onclick="deleteImage('<?php echo e($image['url']); ?>', <?php echo e($image['sheet_id'] ?? 'null'); ?>, <?php echo e($image['type_id'] ?? 'null'); ?>, '<?php echo e($image['source'] ?? 'product_sheet'); ?>')"
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-2 opacity-0 group-hover:opacity-100 transition"
                                    title="Supprimer cette image">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php else: ?>
                <div class="text-center py-12 text-gray-500">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p class="mt-4">Aucune image pour cette catégorie</p>
                    <p class="mt-1 text-sm">Ajoutez-en une ci-dessus !</p>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="bg-white shadow rounded-lg p-12 text-center text-gray-500">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <p class="mt-4 text-lg font-medium">Sélectionnez une catégorie pour gérer ses images</p>
        </div>
    <?php endif; ?>
</div>


<div id="lightbox" class="hidden fixed inset-0 z-50 bg-black bg-opacity-90 flex items-center justify-center p-4" onclick="closeLightbox()">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-4xl font-bold hover:text-gray-300 z-10">
        &times;
    </button>
    
    
    <div class="absolute top-4 left-1/2 transform -translate-x-1/2 bg-white rounded-lg shadow-xl p-3 flex gap-2 z-10" onclick="event.stopPropagation()">
        <button onclick="rotateImage(-90)" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded flex items-center gap-2 transition" title="Rotation gauche">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"/>
            </svg>
            <span class="text-sm">↶ Gauche</span>
        </button>
        
        <button onclick="rotateImage(90)" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded flex items-center gap-2 transition" title="Rotation droite">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10H11a8 8 0 00-8 8v2M21 10l-6 6m6-6l-6-6"/>
            </svg>
            <span class="text-sm">↷ Droite</span>
        </button>
        
        <button onclick="flipImage('horizontal')" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded flex items-center gap-2 transition" title="Retournement horizontal">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
            </svg>
            <span class="text-sm">⟷</span>
        </button>
        
        <button onclick="flipImage('vertical')" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded flex items-center gap-2 transition" title="Retournement vertical">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m0 0L3 8m4-4l4 4m6 0v12m0 0l4-4m-4 4l-4-4"/>
            </svg>
            <span class="text-sm">⟷</span>
        </button>
        
        <div class="border-l border-gray-300 mx-2"></div>
        
        <button onclick="toggleCropMode()" id="crop-btn" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded flex items-center gap-2 transition" title="Rogner l'image">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.121 14.121L19 19m-7-7l7-7m-7 7l-2.879 2.879M12 12L9.121 9.121m0 5.758a3 3 0 10-4.243 4.243 3 3 0 004.243-4.243zm0-5.758a3 3 0 10-4.243-4.243 3 3 0 004.243 4.243z"/>
            </svg>
            <span class="text-sm">Rogner</span>
        </button>
        
        <div class="border-l border-gray-300 mx-2"></div>
        
        <button onclick="saveEditedImage()" id="save-btn" class="px-3 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded flex items-center gap-2 transition disabled:opacity-50 disabled:cursor-not-allowed" disabled title="Sauvegarder les modifications">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
            </svg>
            <span class="text-sm">Sauvegarder</span>
        </button>
        
        <button onclick="resetImage()" class="px-3 py-2 bg-gray-100 hover:bg-gray-200 rounded flex items-center gap-2 transition" title="Annuler les modifications">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
            </svg>
            <span class="text-sm">Reset</span>
        </button>
    </div>
    
    <div id="image-container" class="relative" onclick="event.stopPropagation()">
        <canvas id="lightbox-canvas" class="max-w-full max-h-[80vh] object-contain"></canvas>
        <img id="lightbox-image" src="" alt="" class="max-w-full max-h-[80vh] object-contain hidden">
    </div>
    
    <div id="lightbox-caption" class="absolute bottom-4 left-0 right-0 text-center text-white text-lg bg-black bg-opacity-50 py-2"></div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
let currentImageUrl = '';
let currentImageData = null;
let currentSource = 'product_sheet';
let currentSheetId = null;
let currentTypeId = null;
let canvas = null;
let ctx = null;
let rotation = 0;
let flipH = 1;
let flipV = 1;
let cropMode = false;
let hasChanges = false;
let originalImage = null;

function openLightbox(url, caption, taxonomy = null, source = 'product_sheet', sheetId = null, typeId = null) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCaption = document.getElementById('lightbox-caption');
    canvas = document.getElementById('lightbox-canvas');
    ctx = canvas.getContext('2d');
    
    currentImageUrl = url;
    currentSource = source;
    currentSheetId = sheetId;
    currentTypeId = typeId;
    rotation = 0;
    flipH = 1;
    flipV = 1;
    cropMode = false;
    hasChanges = false;
    
    console.log('Opening lightbox:', { url, source, sheetId, typeId });
    
    // Charger l'image
    const img = new Image();
    img.crossOrigin = 'anonymous';
    img.onload = function() {
        originalImage = img;
        canvas.width = img.width;
        canvas.height = img.height;
        redrawCanvas();
        updateSaveButton();
    };
    img.onerror = function() {
        console.error('Erreur chargement image CORS, tentative sans crossOrigin');
        const img2 = new Image();
        img2.onload = function() {
            originalImage = img2;
            canvas.width = img2.width;
            canvas.height = img2.height;
            redrawCanvas();
            updateSaveButton();
        };
        img2.src = url;
    };
    img.src = url;
    
    let captionText = caption;
    if (taxonomy) {
        captionText += '<br><span class="text-sm text-gray-300">' + taxonomy + '</span>';
    }
    lightboxCaption.innerHTML = captionText;
    
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    document.body.style.overflow = 'auto';
    
    // Reset crop mode
    if (cropMode) {
        toggleCropMode();
    }
}

function redrawCanvas() {
    if (!originalImage) return;
    
    const img = originalImage;
    
    // Calculer les dimensions en fonction de la rotation
    const isRotated = Math.abs(rotation) % 180 !== 0;
    const w = isRotated ? img.height : img.width;
    const h = isRotated ? img.width : img.height;
    
    canvas.width = w;
    canvas.height = h;
    
    ctx.clearRect(0, 0, w, h);
    ctx.save();
    
    // Centre de transformation
    ctx.translate(w / 2, h / 2);
    
    // Appliquer rotation
    ctx.rotate((rotation * Math.PI) / 180);
    
    // Appliquer retournements
    ctx.scale(flipH, flipV);
    
    // Dessiner l'image centrée
    ctx.drawImage(img, -img.width / 2, -img.height / 2, img.width, img.height);
    
    ctx.restore();
}

function rotateImage(degrees) {
    rotation = (rotation + degrees) % 360;
    redrawCanvas();
    hasChanges = true;
    updateSaveButton();
}

function flipImage(direction) {
    if (direction === 'horizontal') {
        flipH *= -1;
    } else if (direction === 'vertical') {
        flipV *= -1;
    }
    redrawCanvas();
    hasChanges = true;
    updateSaveButton();
}

function resetImage() {
    rotation = 0;
    flipH = 1;
    flipV = 1;
    hasChanges = false;
    redrawCanvas();
    updateSaveButton();
}

function updateSaveButton() {
    const saveBtn = document.getElementById('save-btn');
    saveBtn.disabled = !hasChanges;
}

// Variables pour le crop
let cropRect = null;
let isDragging = false;
let isResizing = false;
let resizeHandle = null; // 'nw', 'ne', 'sw', 'se', 'n', 's', 'e', 'w'
let dragStart = { x: 0, y: 0 };
let initialCropRect = null;

function toggleCropMode() {
    cropMode = !cropMode;
    const cropBtn = document.getElementById('crop-btn');
    
    if (cropMode) {
        cropBtn.classList.add('bg-indigo-600', 'text-white');
        cropBtn.classList.remove('bg-gray-100');
        canvas.style.cursor = 'crosshair';
        
        // Reset crop rect
        cropRect = {
            x: canvas.width * 0.1,
            y: canvas.height * 0.1,
            width: canvas.width * 0.8,
            height: canvas.height * 0.8
        };
        
        drawCropOverlay();
        attachCropEvents();
    } else {
        cropBtn.classList.remove('bg-indigo-600', 'text-white');
        cropBtn.classList.add('bg-gray-100');
        canvas.style.cursor = 'default';
        detachCropEvents();
        redrawCanvas();
    }
}

function drawCropOverlay() {
    redrawCanvas();
    
    if (!cropRect) return;
    
    // Assombrir l'extérieur
    ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
    ctx.fillRect(0, 0, canvas.width, cropRect.y); // Top
    ctx.fillRect(0, cropRect.y, cropRect.x, cropRect.height); // Left
    ctx.fillRect(cropRect.x + cropRect.width, cropRect.y, canvas.width - cropRect.x - cropRect.width, cropRect.height); // Right
    ctx.fillRect(0, cropRect.y + cropRect.height, canvas.width, canvas.height - cropRect.y - cropRect.height); // Bottom
    
    // Bordure de sélection
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    ctx.setLineDash([5, 5]);
    ctx.strokeRect(cropRect.x, cropRect.y, cropRect.width, cropRect.height);
    ctx.setLineDash([]);
    
    // Poignées de redimensionnement
    const handleSize = 12;
    ctx.fillStyle = '#4F46E5'; // Indigo
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    
    // Coins
    drawHandle(cropRect.x, cropRect.y, handleSize); // NW
    drawHandle(cropRect.x + cropRect.width, cropRect.y, handleSize); // NE
    drawHandle(cropRect.x, cropRect.y + cropRect.height, handleSize); // SW
    drawHandle(cropRect.x + cropRect.width, cropRect.y + cropRect.height, handleSize); // SE
    
    // Bords
    drawHandle(cropRect.x + cropRect.width / 2, cropRect.y, handleSize); // N
    drawHandle(cropRect.x + cropRect.width / 2, cropRect.y + cropRect.height, handleSize); // S
    drawHandle(cropRect.x, cropRect.y + cropRect.height / 2, handleSize); // W
    drawHandle(cropRect.x + cropRect.width, cropRect.y + cropRect.height / 2, handleSize); // E
}

function drawHandle(x, y, size) {
    // Poignées plus grandes sur mobile pour faciliter la manipulation
    const isMobile = window.innerWidth < 768;
    const actualSize = isMobile ? size * 1.5 : size;
    
    ctx.fillRect(x - actualSize/2, y - actualSize/2, actualSize, actualSize);
    ctx.strokeRect(x - actualSize/2, y - actualSize/2, actualSize, actualSize);
}

function attachCropEvents() {
    // Événements souris
    canvas.addEventListener('mousedown', onCropMouseDown);
    canvas.addEventListener('mousemove', onCropMouseMove);
    canvas.addEventListener('mouseup', onCropMouseUp);
    
    // Événements tactiles (mobile)
    canvas.addEventListener('touchstart', onCropTouchStart, { passive: false });
    canvas.addEventListener('touchmove', onCropTouchMove, { passive: false });
    canvas.addEventListener('touchend', onCropTouchEnd);
}

function detachCropEvents() {
    // Événements souris
    canvas.removeEventListener('mousedown', onCropMouseDown);
    canvas.removeEventListener('mousemove', onCropMouseMove);
    canvas.removeEventListener('mouseup', onCropMouseUp);
    
    // Événements tactiles
    canvas.removeEventListener('touchstart', onCropTouchStart);
    canvas.removeEventListener('touchmove', onCropTouchMove);
    canvas.removeEventListener('touchend', onCropTouchEnd);
}

function getHandleAtPosition(x, y) {
    const handleSize = 12;
    const threshold = window.innerWidth < 768 ? handleSize * 2 : handleSize; // Zone plus large sur mobile
    
    // Vérifier les coins
    if (Math.abs(x - cropRect.x) < threshold && Math.abs(y - cropRect.y) < threshold) return 'nw';
    if (Math.abs(x - (cropRect.x + cropRect.width)) < threshold && Math.abs(y - cropRect.y) < threshold) return 'ne';
    if (Math.abs(x - cropRect.x) < threshold && Math.abs(y - (cropRect.y + cropRect.height)) < threshold) return 'sw';
    if (Math.abs(x - (cropRect.x + cropRect.width)) < threshold && Math.abs(y - (cropRect.y + cropRect.height)) < threshold) return 'se';
    
    // Vérifier les bords
    if (Math.abs(x - (cropRect.x + cropRect.width / 2)) < threshold && Math.abs(y - cropRect.y) < threshold) return 'n';
    if (Math.abs(x - (cropRect.x + cropRect.width / 2)) < threshold && Math.abs(y - (cropRect.y + cropRect.height)) < threshold) return 's';
    if (Math.abs(x - cropRect.x) < threshold && Math.abs(y - (cropRect.y + cropRect.height / 2)) < threshold) return 'w';
    if (Math.abs(x - (cropRect.x + cropRect.width)) < threshold && Math.abs(y - (cropRect.y + cropRect.height / 2)) < threshold) return 'e';
    
    return null;
}

function getCursorForHandle(handle) {
    const cursors = {
        'nw': 'nw-resize',
        'ne': 'ne-resize',
        'sw': 'sw-resize',
        'se': 'se-resize',
        'n': 'n-resize',
        's': 's-resize',
        'e': 'e-resize',
        'w': 'w-resize'
    };
    return cursors[handle] || 'move';
}

function onCropMouseDown(e) {
    const rect = canvas.getBoundingClientRect();
    const x = (e.clientX - rect.left) * (canvas.width / rect.width);
    const y = (e.clientY - rect.top) * (canvas.height / rect.height);
    
    // Vérifier si on clique sur une poignée
    const handle = getHandleAtPosition(x, y);
    
    if (handle) {
        isResizing = true;
        resizeHandle = handle;
        initialCropRect = { ...cropRect };
        dragStart = { x, y };
    } else if (x >= cropRect.x && x <= cropRect.x + cropRect.width &&
               y >= cropRect.y && y <= cropRect.y + cropRect.height) {
        isDragging = true;
        dragStart = { x: x - cropRect.x, y: y - cropRect.y };
    }
}

function onCropMouseMove(e) {
    const rect = canvas.getBoundingClientRect();
    const x = (e.clientX - rect.left) * (canvas.width / rect.width);
    const y = (e.clientY - rect.top) * (canvas.height / rect.height);
    
    if (isResizing) {
        // Redimensionnement
        const dx = x - dragStart.x;
        const dy = y - dragStart.y;
        
        switch (resizeHandle) {
            case 'nw': // Coin Nord-Ouest
                cropRect.x = Math.max(0, initialCropRect.x + dx);
                cropRect.y = Math.max(0, initialCropRect.y + dy);
                cropRect.width = Math.max(20, initialCropRect.width - dx);
                cropRect.height = Math.max(20, initialCropRect.height - dy);
                break;
            case 'ne': // Coin Nord-Est
                cropRect.y = Math.max(0, initialCropRect.y + dy);
                cropRect.width = Math.max(20, initialCropRect.width + dx);
                cropRect.height = Math.max(20, initialCropRect.height - dy);
                break;
            case 'sw': // Coin Sud-Ouest
                cropRect.x = Math.max(0, initialCropRect.x + dx);
                cropRect.width = Math.max(20, initialCropRect.width - dx);
                cropRect.height = Math.max(20, initialCropRect.height + dy);
                break;
            case 'se': // Coin Sud-Est
                cropRect.width = Math.max(20, initialCropRect.width + dx);
                cropRect.height = Math.max(20, initialCropRect.height + dy);
                break;
            case 'n': // Bord Nord
                cropRect.y = Math.max(0, initialCropRect.y + dy);
                cropRect.height = Math.max(20, initialCropRect.height - dy);
                break;
            case 's': // Bord Sud
                cropRect.height = Math.max(20, initialCropRect.height + dy);
                break;
            case 'w': // Bord Ouest
                cropRect.x = Math.max(0, initialCropRect.x + dx);
                cropRect.width = Math.max(20, initialCropRect.width - dx);
                break;
            case 'e': // Bord Est
                cropRect.width = Math.max(20, initialCropRect.width + dx);
                break;
        }
        
        // Limiter aux dimensions du canvas
        if (cropRect.x + cropRect.width > canvas.width) {
            cropRect.width = canvas.width - cropRect.x;
        }
        if (cropRect.y + cropRect.height > canvas.height) {
            cropRect.height = canvas.height - cropRect.y;
        }
        
        drawCropOverlay();
        hasChanges = true;
        updateSaveButton();
    } else if (isDragging) {
        // Déplacement
        cropRect.x = Math.max(0, Math.min(x - dragStart.x, canvas.width - cropRect.width));
        cropRect.y = Math.max(0, Math.min(y - dragStart.y, canvas.height - cropRect.height));
        
        drawCropOverlay();
    } else {
        // Changer le curseur selon la position
        const handle = getHandleAtPosition(x, y);
        if (handle) {
            canvas.style.cursor = getCursorForHandle(handle);
        } else if (x >= cropRect.x && x <= cropRect.x + cropRect.width &&
                   y >= cropRect.y && y <= cropRect.y + cropRect.height) {
            canvas.style.cursor = 'move';
        } else {
            canvas.style.cursor = 'crosshair';
        }
    }
}

function onCropMouseUp() {
    isDragging = false;
    isResizing = false;
    resizeHandle = null;
    initialCropRect = null;
}

// ========================================
// SUPPORT TACTILE (MOBILE)
// ========================================
function getCoordinatesFromTouch(e) {
    const touch = e.touches[0];
    const rect = canvas.getBoundingClientRect();
    const x = (touch.clientX - rect.left) * (canvas.width / rect.width);
    const y = (touch.clientY - rect.top) * (canvas.height / rect.height);
    return { x, y };
}

function onCropTouchStart(e) {
    e.preventDefault(); // Empêcher le scroll
    const { x, y } = getCoordinatesFromTouch(e);
    
    // Vérifier si on touche une poignée (zone plus large sur mobile)
    const handle = getHandleAtPosition(x, y);
    
    if (handle) {
        isResizing = true;
        resizeHandle = handle;
        initialCropRect = { ...cropRect };
        dragStart = { x, y };
    } else if (x >= cropRect.x && x <= cropRect.x + cropRect.width &&
               y >= cropRect.y && y <= cropRect.y + cropRect.height) {
        isDragging = true;
        dragStart = { x: x - cropRect.x, y: y - cropRect.y };
    }
}

function onCropTouchMove(e) {
    e.preventDefault(); // Empêcher le scroll
    
    if (!isDragging && !isResizing) return;
    
    const { x, y } = getCoordinatesFromTouch(e);
    
    if (isResizing) {
        // Même logique de redimensionnement que pour la souris
        const dx = x - dragStart.x;
        const dy = y - dragStart.y;
        
        switch (resizeHandle) {
            case 'nw':
                cropRect.x = Math.max(0, initialCropRect.x + dx);
                cropRect.y = Math.max(0, initialCropRect.y + dy);
                cropRect.width = Math.max(20, initialCropRect.width - dx);
                cropRect.height = Math.max(20, initialCropRect.height - dy);
                break;
            case 'ne':
                cropRect.y = Math.max(0, initialCropRect.y + dy);
                cropRect.width = Math.max(20, initialCropRect.width + dx);
                cropRect.height = Math.max(20, initialCropRect.height - dy);
                break;
            case 'sw':
                cropRect.x = Math.max(0, initialCropRect.x + dx);
                cropRect.width = Math.max(20, initialCropRect.width - dx);
                cropRect.height = Math.max(20, initialCropRect.height + dy);
                break;
            case 'se':
                cropRect.width = Math.max(20, initialCropRect.width + dx);
                cropRect.height = Math.max(20, initialCropRect.height + dy);
                break;
            case 'n':
                cropRect.y = Math.max(0, initialCropRect.y + dy);
                cropRect.height = Math.max(20, initialCropRect.height - dy);
                break;
            case 's':
                cropRect.height = Math.max(20, initialCropRect.height + dy);
                break;
            case 'w':
                cropRect.x = Math.max(0, initialCropRect.x + dx);
                cropRect.width = Math.max(20, initialCropRect.width - dx);
                break;
            case 'e':
                cropRect.width = Math.max(20, initialCropRect.width + dx);
                break;
        }
        
        // Limiter aux dimensions du canvas
        if (cropRect.x + cropRect.width > canvas.width) {
            cropRect.width = canvas.width - cropRect.x;
        }
        if (cropRect.y + cropRect.height > canvas.height) {
            cropRect.height = canvas.height - cropRect.y;
        }
        
        drawCropOverlay();
        hasChanges = true;
        updateSaveButton();
    } else if (isDragging) {
        // Déplacement
        cropRect.x = Math.max(0, Math.min(x - dragStart.x, canvas.width - cropRect.width));
        cropRect.y = Math.max(0, Math.min(y - dragStart.y, canvas.height - cropRect.height));
        
        drawCropOverlay();
    }
}

function onCropTouchEnd(e) {
    isDragging = false;
    isResizing = false;
    resizeHandle = null;
    initialCropRect = null;
}

async function saveEditedImage() {
    if (!hasChanges && !cropMode) {
        alert('Aucune modification à sauvegarder');
        return;
    }
    
    const saveBtn = document.getElementById('save-btn');
    saveBtn.disabled = true;
    saveBtn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span class="ml-2">Enregistrement...</span>';
    
    try {
        let finalCanvas = canvas;
        
        // Si en mode crop, créer un nouveau canvas avec la zone rognée
        if (cropMode && cropRect) {
            console.log('Applying crop:', cropRect);
            const croppedCanvas = document.createElement('canvas');
            croppedCanvas.width = cropRect.width;
            croppedCanvas.height = cropRect.height;
            const croppedCtx = croppedCanvas.getContext('2d');
            
            // Copier la zone rognée
            croppedCtx.drawImage(
                canvas,
                cropRect.x, cropRect.y, cropRect.width, cropRect.height,
                0, 0, cropRect.width, cropRect.height
            );
            
            finalCanvas = croppedCanvas;
            hasChanges = true; // Marquer comme modifié
        }
        
        // Convertir en blob
        const blob = await new Promise(resolve => finalCanvas.toBlob(resolve, 'image/png', 0.95));
        console.log('Blob created:', blob.size, 'bytes');
        
        // Créer FormData
        const formData = new FormData();
        formData.append('image', blob, 'edited-' + Date.now() + '.png');
        
        let uploadUrl;
        
        if (currentSource === 'article_type') {
            // Upload vers article_type
            if (!currentTypeId) {
                throw new Error('Type ID manquant');
            }
            formData.append('article_type_id', currentTypeId);
            uploadUrl = '<?php echo e(route("admin.articles.upload-image")); ?>';
            
            // Supprimer l'ancienne image
            console.log('Deleting old image from article_type:', currentImageUrl);
            await fetch('<?php echo e(route("admin.articles.delete-image")); ?>', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    image_url: currentImageUrl,
                    article_type_id: currentTypeId
                })
            });
        } else {
            // Upload vers product_sheet (pas encore implémenté dans ce contexte)
            alert('La modification d\'images de fiches produits n\'est pas encore supportée. Seules les images de type peuvent être éditées.');
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm">Sauvegarder</span>';
            return;
        }
        
        // Upload la nouvelle image
        console.log('Uploading new image to:', uploadUrl);
        const response = await fetch(uploadUrl, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: formData
        });
        
        const data = await response.json();
        console.log('Upload response:', data);
        
        if (data.success) {
            alert('✅ Image modifiée avec succès ! Rechargement de la page...');
            window.location.reload();
        } else {
            alert('❌ Erreur: ' + (data.message || 'Erreur inconnue'));
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm">Sauvegarder</span>';
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('❌ Erreur lors de la sauvegarde: ' + error.message);
        saveBtn.disabled = false;
        saveBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg><span class="text-sm">Sauvegarder</span>';
    }
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    
    // Réactiver le scroll du body
    document.body.style.overflow = 'auto';
}

// Fermer avec la touche Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});

document.addEventListener('DOMContentLoaded', function() {
    const categorySelect = document.getElementById('category_select');
    const brandSelect = document.getElementById('brand_select');
    const subCategorySelect = document.getElementById('sub_category_select');
    const typeSelect = document.getElementById('type_select');

    async function loadBrands(categoryId) {
        brandSelect.disabled = true;
        subCategorySelect.disabled = true;
        typeSelect.disabled = true;
        brandSelect.innerHTML = '<option value="">Chargement...</option>';
        subCategorySelect.innerHTML = '<option value="">-- Sélectionner une marque d\'abord --</option>';
        typeSelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie --</option>';

        if (!categoryId) {
            brandSelect.innerHTML = '<option value="">-- Sélectionner une catégorie d\'abord --</option>';
            return;
        }

        try {
            const url = `<?php echo e(url('admin/ajax/brands')); ?>/${categoryId}`;
            const response = await fetch(url);
            const html = await response.text();
            brandSelect.innerHTML = html;
            brandSelect.disabled = false;
        } catch (error) {
            console.error('Erreur:', error);
            brandSelect.innerHTML = '<option value="">Erreur de chargement</option>';
        }
    }

    async function loadSubCategories(brandId) {
        subCategorySelect.disabled = true;
        typeSelect.disabled = true;
        subCategorySelect.innerHTML = '<option value="">Chargement...</option>';
        typeSelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie --</option>';

        if (!brandId) {
            subCategorySelect.innerHTML = '<option value="">-- Sélectionner une marque d\'abord --</option>';
            return;
        }

        try {
            const url = `<?php echo e(url('admin/ajax/sub-categories')); ?>/${brandId}`;
            const response = await fetch(url);
            const html = await response.text();
            subCategorySelect.innerHTML = html;
            subCategorySelect.disabled = false;
        } catch (error) {
            console.error('Erreur:', error);
            subCategorySelect.innerHTML = '<option value="">Erreur de chargement</option>';
        }
    }

    async function loadTypes(subCategoryId) {
        typeSelect.disabled = true;
        typeSelect.innerHTML = '<option value="">Chargement...</option>';

        if (!subCategoryId) {
            typeSelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie d\'abord --</option>';
            return;
        }

        try {
            const url = `<?php echo e(url('admin/ajax/types')); ?>/${subCategoryId}`;
            const response = await fetch(url);
            const html = await response.text();
            typeSelect.innerHTML = html;
            typeSelect.disabled = false;
        } catch (error) {
            console.error('Erreur:', error);
            typeSelect.innerHTML = '<option value="">Erreur de chargement</option>';
        }
    }

    categorySelect.addEventListener('change', () => loadBrands(categorySelect.value));
    brandSelect.addEventListener('change', () => loadSubCategories(brandSelect.value));
    subCategorySelect.addEventListener('change', () => loadTypes(subCategorySelect.value));

    // Upload d'image
    const imageUpload = document.getElementById('image_upload');
    const uploadStatus = document.getElementById('upload_status');

    if (imageUpload) {
        imageUpload.addEventListener('change', async function(e) {
            const file = e.target.files[0];
            if (!file) return;

            const typeId = typeSelect.value;
            if (!typeId) {
                alert('Veuillez d\'abord sélectionner une catégorie');
                return;
            }

            uploadStatus.className = 'mt-4 text-sm text-blue-600';
            uploadStatus.textContent = 'Upload en cours...';
            uploadStatus.classList.remove('hidden');

            try {
                const formData = new FormData();
                formData.append('image', file);
                formData.append('article_type_id', typeId);

                const response = await fetch('<?php echo e(route("admin.product-sheets.images-manager.upload")); ?>', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: formData
                });

                const data = await response.json();

                if (data.success) {
                    uploadStatus.className = 'mt-4 text-sm text-green-600';
                    uploadStatus.textContent = '✅ Image uploadée avec succès ! Rechargement...';
                    
                    // Recharger la page pour afficher la nouvelle image
                    setTimeout(() => {
                        window.location.reload();
                    }, 1000);
                } else {
                    uploadStatus.className = 'mt-4 text-sm text-red-600';
                    uploadStatus.textContent = '❌ ' + data.message;
                }
            } catch (error) {
                console.error('Erreur:', error);
                uploadStatus.className = 'mt-4 text-sm text-red-600';
                uploadStatus.textContent = '❌ Erreur lors de l\'upload';
            }

            e.target.value = '';
        });
    }
});

// Fonction de suppression d'image
async function deleteImage(url, sheetId, typeId, source) {
    if (!confirm('Supprimer cette image ?')) return;

    try {
        let deleteUrl, body;
        
        if (source === 'article_type') {
            // Supprimer depuis article_type
            deleteUrl = '<?php echo e(route("admin.articles.delete-image")); ?>';
            body = JSON.stringify({ 
                image_url: url, 
                article_type_id: typeId 
            });
        } else {
            // Supprimer depuis product_sheet
            deleteUrl = '<?php echo e(route("admin.product-sheets.images-manager.delete")); ?>';
            body = JSON.stringify({ 
                url: url, 
                sheet_id: sheetId 
            });
        }

        const response = await fetch(deleteUrl, {
            method: source === 'article_type' ? 'POST' : 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: body
        });

        const data = await response.json();

        if (data.success) {
            // Retirer l'élément du DOM
            const selector = source === 'article_type' 
                ? `[data-image-url="${url}"][data-type-id="${typeId}"]`
                : `[data-image-url="${url}"][data-sheet-id="${sheetId}"]`;
            const element = document.querySelector(selector);
            if (element) {
                element.remove();
            }
            
            // Vérifier s'il reste des images
            const grid = document.getElementById('images_grid');
            if (grid && grid.children.length === 0) {
                window.location.reload();
            }
        } else {
            alert('Erreur : ' + data.message);
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de la suppression');
    }
}
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/product-sheets/images-manager.blade.php ENDPATH**/ ?>