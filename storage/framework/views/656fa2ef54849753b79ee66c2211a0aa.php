

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📸 Gestionnaire d'images par taxonomie</h1>
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
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Sélectionner une taxonomie</h2>
        
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
                        <div class="relative group" data-image-url="<?php echo e($image['url']); ?>" data-sheet-id="<?php echo e($image['sheet_id']); ?>">
                            <img src="<?php echo e($image['url']); ?>" 
                                 alt="Image de <?php echo e($image['sheet_name']); ?>"
                                 class="w-full h-32 object-cover rounded border border-gray-300 cursor-pointer hover:opacity-90 transition"
                                 onclick="openLightbox('<?php echo e($image['url']); ?>', '<?php echo e(addslashes($image['sheet_name'])); ?>', <?php if($showAll ?? false): ?>'<?php echo e($image['category_name'] ?? ''); ?> › <?php echo e($image['sub_category_name'] ?? ''); ?> › <?php echo e($image['type_name'] ?? ''); ?>'<?php else: ?> null <?php endif; ?>)">
                            
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white text-[10px] px-1 py-0.5">
                                <div class="truncate"><?php echo e($image['sheet_name']); ?></div>
                                <?php if($showAll ?? false): ?>
                                    <div class="text-gray-300 text-[10px] truncate">
                                        <?php echo e($image['category_name'] ?? ''); ?> › <?php echo e($image['sub_category_name'] ?? ''); ?> › <?php echo e($image['type_name'] ?? ''); ?>

                                    </div>
                                <?php endif; ?>
                            </div>
                            
                            <button type="button" 
                                    onclick="deleteImage('<?php echo e($image['url']); ?>', <?php echo e($image['sheet_id']); ?>)"
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
                    <p class="mt-4">Aucune image pour cette taxonomie</p>
                    <p class="mt-1 text-sm">Ajoutez-en une ci-dessus !</p>
                </div>
            <?php endif; ?>
        </div>
    <?php else: ?>
        <div class="bg-white shadow rounded-lg p-12 text-center text-gray-500">
            <svg class="mx-auto h-16 w-16 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/>
            </svg>
            <p class="mt-4 text-lg font-medium">Sélectionnez une taxonomie pour gérer ses images</p>
        </div>
    <?php endif; ?>
</div>


<div id="lightbox" class="hidden fixed inset-0 z-50 bg-black bg-opacity-90 flex items-center justify-center p-4" onclick="closeLightbox()">
    <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white text-4xl font-bold hover:text-gray-300 z-10">
        &times;
    </button>
    <img id="lightbox-image" src="" alt="" class="max-w-full max-h-full object-contain" onclick="event.stopPropagation()">
    <div id="lightbox-caption" class="absolute bottom-4 left-0 right-0 text-center text-white text-lg bg-black bg-opacity-50 py-2"></div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
function openLightbox(url, caption, taxonomy = null) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCaption = document.getElementById('lightbox-caption');
    
    lightboxImage.src = url;
    
    let captionText = caption;
    if (taxonomy) {
        captionText += '<br><span class="text-sm text-gray-300">' + taxonomy + '</span>';
    }
    lightboxCaption.innerHTML = captionText;
    
    lightbox.classList.remove('hidden');
    
    // Empêcher le scroll du body
    document.body.style.overflow = 'hidden';
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
                alert('Veuillez d\'abord sélectionner une taxonomie');
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
async function deleteImage(url, sheetId) {
    if (!confirm('Supprimer cette image ?')) return;

    try {
        const response = await fetch('<?php echo e(route("admin.product-sheets.images-manager.delete")); ?>', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
            },
            body: JSON.stringify({ url, sheet_id: sheetId })
        });

        const data = await response.json();

        if (data.success) {
            // Retirer l'élément du DOM
            const element = document.querySelector(`[data-image-url="${url}"][data-sheet-id="${sheetId}"]`);
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