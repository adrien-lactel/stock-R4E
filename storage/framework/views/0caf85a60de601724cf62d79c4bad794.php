

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">✏️ Éditer la fiche produit</h1>
        <div class="flex items-center gap-2">
            <?php if(isset($associatedConsole)): ?>
                <a href="<?php echo e(route('admin.articles.edit_full', $associatedConsole)); ?>" 
                   class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    📝 Éditer l'article #<?php echo e($associatedConsole->id); ?>

                </a>
            <?php endif; ?>
            <a href="<?php echo e(route('admin.product-sheets.index')); ?>" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour</a>
        </div>
    </div>

    
    <?php if($errors->any()): ?>
        <div class="mb-6 p-4 bg-red-50 text-red-800 rounded border border-red-200">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="<?php echo e(route('admin.product-sheets.update', $sheet)); ?>">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>

            
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Type de produit</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Catégorie *</label>
                        <select name="category_temp" id="category_select" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            <option value="">-- Sélectionner --</option>
                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($cat->id); ?>" <?php echo e(isset($selectedCategory) && $selectedCategory->id == $cat->id ? 'selected' : ''); ?>>
                                    <?php echo e($cat->name); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Sous-catégorie *</label>
                        <select name="sub_category_temp" id="sub_category_select"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required <?php echo e(isset($selectedCategory) ? '' : 'disabled'); ?>>
                            <option value="">-- Sélectionner une catégorie d'abord --</option>
                            <?php if(isset($selectedCategory) && isset($selectedCategory->subCategories)): ?>
                                <?php $__currentLoopData = $selectedCategory->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($sub->id); ?>" <?php echo e(isset($selectedSubCategory) && $selectedSubCategory->id == $sub->id ? 'selected' : ''); ?>>
                                        <?php echo e($sub->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Type *</label>
                        <select name="article_type_id" id="type_select"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required <?php echo e(isset($selectedSubCategory) ? '' : 'disabled'); ?>>
                            <option value="">-- Sélectionner une sous-catégorie d'abord --</option>
                            <?php if(isset($selectedSubCategory) && isset($selectedSubCategory->types)): ?>
                                <?php $__currentLoopData = $selectedSubCategory->types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($type->id); ?>" <?php echo e(isset($selectedType) && $selectedType->id == $type->id ? 'selected' : ''); ?>>
                                        <?php echo e($type->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                        </select>
                    </div>
                </div>
            </div>

            
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informations produit</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nom de la fiche *</label>
                        <input type="text" name="name"
                               value="<?php echo e(old('name', $sheet->name)); ?>"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Description du produit</label>
                        <textarea name="description" rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"><?php echo e(old('description', $sheet->description)); ?></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Caractéristiques techniques</label>
                        <textarea name="technical_specs" rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"><?php echo e(old('technical_specs', $sheet->technical_specs)); ?></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Accessoires inclus</label>
                        <textarea name="included_items" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"><?php echo e(old('included_items', $sheet->included_items)); ?></textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Description marketing</label>
                        <textarea name="marketing_description" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"><?php echo e(old('marketing_description', $sheet->marketing_description)); ?></textarea>
                    </div>
                </div>
            </div>

            
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">⭐ Critères de collection</h2>
                <p class="text-sm text-gray-600 mb-4">Cochez les critères que vous souhaitez afficher sur cette fiche produit</p>

                <?php
                    $criteria = $sheet->condition_criteria ?? [];
                ?>

                
                <div class="mb-6 grid grid-cols-2 md:grid-cols-3 gap-3">
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="box_condition" <?php echo e(isset($criteria['box_condition']) ? 'checked' : ''); ?>>
                        <span class="ml-2 text-sm">État de la boîte</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="manual_condition" <?php echo e(isset($criteria['manual_condition']) ? 'checked' : ''); ?>>
                        <span class="ml-2 text-sm">État du manuel</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="media_condition" <?php echo e(isset($criteria['media_condition']) ? 'checked' : ''); ?>>
                        <span class="ml-2 text-sm">État du support</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="completeness" <?php echo e(isset($criteria['completeness']) ? 'checked' : ''); ?>>
                        <span class="ml-2 text-sm">Complétude</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="rarity" <?php echo e(isset($criteria['rarity']) ? 'checked' : ''); ?>>
                        <span class="ml-2 text-sm">Rareté</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="overall_condition" <?php echo e(isset($criteria['overall_condition']) ? 'checked' : ''); ?>>
                        <span class="ml-2 text-sm">État général</span>
                    </label>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    
                    <div class="border rounded-lg p-4 <?php echo e(isset($criteria['box_condition']) ? '' : 'hidden'); ?>" data-criterion-container="box_condition">
                        <label class="block text-sm font-medium mb-2">État de la boîte</label>
                        <div class="flex gap-1" data-criterion="box_condition">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <button type="button" onclick="setRating('box_condition', <?php echo e($i); ?>)" 
                                        class="star-btn text-3xl <?php echo e(isset($criteria['box_condition']) && $criteria['box_condition'] >= $i ? 'text-yellow-400' : 'text-gray-300'); ?> hover:text-yellow-400 transition"
                                        data-star="<?php echo e($i); ?>">★</button>
                            <?php endfor; ?>
                        </div>
                    </div>

                    
                    <div class="border rounded-lg p-4 <?php echo e(isset($criteria['manual_condition']) ? '' : 'hidden'); ?>" data-criterion-container="manual_condition">
                        <label class="block text-sm font-medium mb-2">État du manuel</label>
                        <div class="flex gap-1" data-criterion="manual_condition">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <button type="button" onclick="setRating('manual_condition', <?php echo e($i); ?>)" 
                                        class="star-btn text-3xl <?php echo e(isset($criteria['manual_condition']) && $criteria['manual_condition'] >= $i ? 'text-yellow-400' : 'text-gray-300'); ?> hover:text-yellow-400 transition"
                                        data-star="<?php echo e($i); ?>">★</button>
                            <?php endfor; ?>
                        </div>
                    </div>

                    
                    <div class="border rounded-lg p-4 <?php echo e(isset($criteria['media_condition']) ? '' : 'hidden'); ?>" data-criterion-container="media_condition">
                        <label class="block text-sm font-medium mb-2">État du support (jeu/console)</label>
                        <div class="flex gap-1" data-criterion="media_condition">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <button type="button" onclick="setRating('media_condition', <?php echo e($i); ?>)" 
                                        class="star-btn text-3xl <?php echo e(isset($criteria['media_condition']) && $criteria['media_condition'] >= $i ? 'text-yellow-400' : 'text-gray-300'); ?> hover:text-yellow-400 transition"
                                        data-star="<?php echo e($i); ?>">★</button>
                            <?php endfor; ?>
                        </div>
                    </div>

                    
                    <div class="border rounded-lg p-4 <?php echo e(isset($criteria['completeness']) ? '' : 'hidden'); ?>" data-criterion-container="completeness">
                        <label class="block text-sm font-medium mb-2">Complétude</label>
                        <div class="flex gap-1" data-criterion="completeness">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <button type="button" onclick="setRating('completeness', <?php echo e($i); ?>)" 
                                        class="star-btn text-3xl <?php echo e(isset($criteria['completeness']) && $criteria['completeness'] >= $i ? 'text-yellow-400' : 'text-gray-300'); ?> hover:text-yellow-400 transition"
                                        data-star="<?php echo e($i); ?>">★</button>
                            <?php endfor; ?>
                        </div>
                    </div>

                    
                    <div class="border rounded-lg p-4 <?php echo e(isset($criteria['rarity']) ? '' : 'hidden'); ?>" data-criterion-container="rarity">
                        <label class="block text-sm font-medium mb-2">Rareté</label>
                        <div class="flex gap-1" data-criterion="rarity">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <button type="button" onclick="setRating('rarity', <?php echo e($i); ?>)" 
                                        class="star-btn text-3xl <?php echo e(isset($criteria['rarity']) && $criteria['rarity'] >= $i ? 'text-yellow-400' : 'text-gray-300'); ?> hover:text-yellow-400 transition"
                                        data-star="<?php echo e($i); ?>">★</button>
                            <?php endfor; ?>
                        </div>
                    </div>

                    
                    <div class="border rounded-lg p-4 <?php echo e(isset($criteria['overall_condition']) ? '' : 'hidden'); ?>" data-criterion-container="overall_condition">
                        <label class="block text-sm font-medium mb-2">État général</label>
                        <div class="flex gap-1" data-criterion="overall_condition">
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <button type="button" onclick="setRating('overall_condition', <?php echo e($i); ?>)" 
                                        class="star-btn text-3xl <?php echo e(isset($criteria['overall_condition']) && $criteria['overall_condition'] >= $i ? 'text-yellow-400' : 'text-gray-300'); ?> hover:text-yellow-400 transition"
                                        data-star="<?php echo e($i); ?>">★</button>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="condition_criteria" id="condition_criteria_input" value="<?php echo e(json_encode($criteria)); ?>">
            </div>

            
            <div class="mb-8">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h2 class="text-lg font-semibold text-gray-800">🔧 Mods / Accessoires / Opérations</h2>
                        <p class="text-sm text-gray-600 mt-1">Cochez les mods que vous souhaitez afficher sur la miniature de cette fiche</p>
                    </div>
                    <button type="button" onclick="resetFeaturedMods()" class="px-3 py-1 text-sm rounded bg-red-100 text-red-700 hover:bg-red-200">
                        🗑️ Réinitialiser
                    </button>
                </div>

                <?php
                    $selectedMods = $sheet->featured_mods ?? [];
                    $selectedModIds = collect($selectedMods)->pluck('id')->toArray();
                ?>

                <?php if($mods->count() > 0): ?>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-4">
                        <?php $__currentLoopData = $mods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="flex items-start border rounded-lg p-3 hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="mod-checkbox rounded mt-1 mr-2" 
                                       value="<?php echo e($mod->id); ?>" 
                                       data-name="<?php echo e($mod->name); ?>"
                                       data-icon="<?php echo e($mod->icon ?? '🔧'); ?>"
                                       <?php echo e(in_array($mod->id, $selectedModIds) ? 'checked' : ''); ?>>
                                <div class="flex-1">
                                    <div class="font-medium text-sm flex items-center gap-2">
                                        <?php if($mod->icon && str_starts_with($mod->icon, 'data:image/')): ?>
                                            <img src="<?php echo e($mod->icon); ?>" alt="<?php echo e($mod->name); ?>" class="w-5 h-5" style="image-rendering: pixelated;">
                                        <?php else: ?>
                                            <span class="text-lg"><?php echo e($mod->icon ?? '🔧'); ?></span>
                                        <?php endif; ?>
                                        <span><?php echo e($mod->name); ?></span>
                                    </div>
                                    <div class="text-xs text-gray-500"><?php echo e($mod->type); ?></div>
                                </div>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <p class="text-sm text-gray-500 italic">Aucun mod disponible. <a href="<?php echo e(route('admin.mods.create')); ?>" class="text-indigo-600 hover:underline">Créer un mod</a></p>
                <?php endif; ?>

                <input type="hidden" name="featured_mods" id="featured_mods_input" value="<?php echo e(json_encode($selectedMods)); ?>">
            </div>

            
            <?php if($sheet->images && count($sheet->images) > 0): ?>
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Images actuelles</h2>
                <div class="grid grid-cols-2 md:grid-cols-6 gap-3" id="currentImages">
                    <?php $__currentLoopData = $sheet->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="relative group" data-image-url="<?php echo e($img); ?>">
                            <img src="<?php echo e($img); ?>" class="w-full h-20 object-cover rounded border <?php echo e($img === $sheet->main_image ? 'ring-2 ring-indigo-600' : ''); ?>">
                            <button type="button" onclick="removeExistingImage('<?php echo e($img); ?>')" 
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                            <?php if($img === $sheet->main_image): ?>
                                <span class="absolute bottom-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded">Principale</span>
                            <?php else: ?>
                                <button type="button" onclick="setExistingMainImage('<?php echo e($img); ?>')" 
                                        class="absolute bottom-1 left-1 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                                    Définir principale
                                </button>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
            <?php endif; ?>

            
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Ajouter des images</h2>
                
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" id="image_upload" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/avif" multiple class="hidden">
                    <label for="image_upload" class="cursor-pointer">
                        <div class="text-gray-600">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p class="mt-2 text-sm font-medium">Cliquez pour sélectionner des images</p>
                            <p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF, WEBP, AVIF jusqu'à 5 Mo</p>
                        </div>
                    </label>
                </div>

                
                <div id="upload_progress" class="mt-4 hidden">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div id="progress_bar" class="bg-indigo-600 h-2 rounded-full transition-all" style="width: 0%"></div>
                    </div>
                    <p id="upload_status" class="text-sm text-gray-600 mt-1">Upload en cours...</p>
                </div>

                
                <div id="newImages" class="mt-4 hidden">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Nouvelles images</h3>
                    <div id="newImagesList" class="grid grid-cols-2 md:grid-cols-6 gap-3"></div>
                </div>

                
                <div id="taxonomy_gallery_container" class="hidden mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-semibold text-blue-900">
                            📚 Images existantes pour cette taxonomie
                        </h3>
                        <button type="button" 
                                onclick="document.getElementById('taxonomy_gallery_container').classList.add('hidden')"
                                class="text-blue-600 hover:text-blue-800 text-sm">
                            Masquer
                        </button>
                    </div>
                    <p class="text-xs text-blue-700 mb-3">Cliquez sur une image pour l'ajouter à votre fiche</p>
                    <div id="taxonomy_gallery" class="grid grid-cols-3 md:grid-cols-8 gap-2 max-h-64 overflow-y-auto">
                        
                    </div>
                </div>
            </div>

            
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Tags</h2>
                <input type="text" id="tags_input"
                       value="<?php echo e($sheet->tags ? implode(', ', $sheet->tags) : ''); ?>"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="gaming, console, sony">
                <input type="hidden" name="tags" id="tags_hidden" value="<?php echo e(json_encode($sheet->tags ?? [])); ?>">
            </div>

            
            <div class="mb-8">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                           <?php echo e(old('is_active', $sheet->is_active) ? 'checked' : ''); ?>

                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm">Fiche active</span>
                </label>
            </div>

            
            <input type="hidden" name="images" id="images_input" value="<?php echo e(json_encode($sheet->images ?? [])); ?>">
            <input type="hidden" name="main_image" id="main_image_input" value="<?php echo e($sheet->main_image); ?>">

            
            <div class="flex items-center justify-end gap-3">
                <a href="<?php echo e(route('admin.product-sheets.index')); ?>" 
                   class="px-4 py-2 rounded border hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    💾 Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

<?php $__env->startPush('scripts'); ?>
<script>
// Gestion des mods sélectionnés (déclaré en global)
let featuredMods = <?php echo json_encode($sheet->featured_mods ?? []); ?>;

// Fonction pour réinitialiser tous les mods (en global)
function resetFeaturedMods() {
    if (!confirm('Êtes-vous sûr de vouloir réinitialiser tous les mods/accessoires/opérations de cette fiche ?')) {
        return;
    }
    
    featuredMods = [];
    document.getElementById('featured_mods_input').value = '[]';
    
    // Décocher toutes les cases
    document.querySelectorAll('.mod-checkbox').forEach(checkbox => {
        checkbox.checked = false;
    });
    
    alert('Les mods ont été réinitialisés. Cliquez sur "💾 Mettre à jour" pour sauvegarder.');
}

document.addEventListener('DOMContentLoaded', function() {
    // Critères de collection existants
    let conditionCriteria = <?php echo json_encode($sheet->condition_criteria ?? []); ?>;

    // Initialiser le champ hidden avec les critères existants
    document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);

    window.setRating = function(criterion, rating) {
        conditionCriteria[criterion] = rating;
        
        // Mettre à jour l'affichage des étoiles
        const container = document.querySelector('[data-criterion="' + criterion + '"]');
        const stars = container.querySelectorAll('.star-btn');
        
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });

        // Mettre à jour le champ hidden
        document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
    };

    // Gestion de l'affichage/masquage des critères
    document.querySelectorAll('.criterion-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const criterion = this.value;
            const container = document.querySelector(`[data-criterion-container="${criterion}"]`);
            
            if (this.checked) {
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
                // Supprimer la valeur du critère désactivé
                delete conditionCriteria[criterion];
                // Réinitialiser les étoiles
                const stars = container.querySelectorAll('.star-btn');
                stars.forEach(star => {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                });
                // Mettre à jour le champ hidden
                document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
            }
        });
    });

    // Initialiser l'input featured_mods
    document.getElementById('featured_mods_input').value = JSON.stringify(featuredMods);
    
    document.querySelectorAll('.mod-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                if (!featuredMods.find(m => m.id === parseInt(this.value))) {
                    featuredMods.push({
                        id: parseInt(this.value),
                        name: this.dataset.name,
                        icon: this.dataset.icon || '🔧'
                    });
                }
            } else {
                featuredMods = featuredMods.filter(m => m.id !== parseInt(this.value));
            }
            document.getElementById('featured_mods_input').value = JSON.stringify(featuredMods);
        });
    });

    // Mettre à jour les champs hidden avant la soumission du formulaire
    document.querySelector('form').addEventListener('submit', function(e) {
        // Mettre à jour condition_criteria
        document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
        // Mettre à jour tags
        const tagsInput = document.getElementById('tags_input').value;
        const tagsArray = tagsInput.split(',').map(tag => tag.trim()).filter(tag => tag);
        document.getElementById('tags_hidden').value = JSON.stringify(tagsArray);
    });

    // Cascading selects pour taxonomie
    document.getElementById('category_select').addEventListener('change', function() {
        loadSubCategories(this.value);
    });

    document.getElementById('sub_category_select').addEventListener('change', function() {
        loadTypes(this.value);
    });

    async function loadSubCategories(categoryId, selectedSubCategoryId = null) {
        const subCategorySelect = document.getElementById('sub_category_select');
        const typeSelect = document.getElementById('type_select');

        subCategorySelect.disabled = true;
        typeSelect.disabled = true;
        subCategorySelect.innerHTML = '<option value="">Chargement...</option>';
        typeSelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie --</option>';

        if (!categoryId) {
            subCategorySelect.innerHTML = '<option value="">-- Sélectionner une catégorie d\'abord --</option>';
            return;
        }

        try {
            const url = `<?php echo e(url('admin/ajax/sub-categories')); ?>/${categoryId}`;
            const response = await fetch(url);
            const html = await response.text();
            subCategorySelect.innerHTML = html;
            subCategorySelect.disabled = false;

            if (selectedSubCategoryId) {
                subCategorySelect.value = selectedSubCategoryId;
            }
        } catch (error) {
            console.error('Erreur chargement sous-catégories:', error);
            subCategorySelect.innerHTML = '<option value="">Erreur de chargement</option>';
        }
    }

    async function loadTypes(subCategoryId, selectedTypeId = null) {
        const typeSelect = document.getElementById('type_select');
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

            if (selectedTypeId) {
                typeSelect.value = selectedTypeId;
            }
        } catch (error) {
            console.error('Erreur chargement types:', error);
            typeSelect.innerHTML = '<option value="">Erreur de chargement</option>';
        }
    }

    // ========================================
    // GALERIE D'IMAGES DE TAXONOMIE
    // ========================================
    const typeSelect = document.getElementById('type_select');
    const galleryContainer = document.getElementById('taxonomy_gallery_container');
    const galleryDiv = document.getElementById('taxonomy_gallery');

    // Écouter les changements de taxonomie (type)
    if (typeSelect) {
        typeSelect.addEventListener('change', async function() {
            const typeId = this.value;
            
            if (!typeId) {
                galleryContainer.classList.add('hidden');
                return;
            }

            // Charger les images de taxonomie
            try {
                const response = await fetch('<?php echo e(route("admin.product-sheets.taxonomy-images")); ?>?article_type_id=' + typeId);
                const images = await response.json();

                if (images && images.length > 0) {
                    // Afficher la galerie
                    galleryDiv.innerHTML = '';
                    
                    images.forEach(img => {
                        const imgDiv = document.createElement('div');
                        imgDiv.className = 'relative group cursor-pointer hover:opacity-75 transition';
                        imgDiv.innerHTML = `
                            <img src="${img.url}" 
                                 alt="Image de ${img.sheet_name}"
                                 class="w-full h-20 object-cover rounded border border-gray-300">
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white text-[10px] px-1 py-0.5 truncate">
                                ${img.sheet_name}
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 bg-black bg-opacity-40 rounded transition">
                                <span class="text-white text-xs font-bold bg-blue-600 px-2 py-1 rounded">
                                    + Ajouter
                                </span>
                            </div>
                        `;
                        
                        imgDiv.addEventListener('click', function() {
                            // Ajouter l'image aux nouvelles images
                            newImages.push({
                                url: img.url,
                                path: img.url
                            });
                            
                            updateNewImages();
                            
                            // Notification visuelle
                            const notification = document.createElement('div');
                            notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50';
                            notification.textContent = '✅ Image ajoutée !';
                            document.body.appendChild(notification);
                            
                            setTimeout(() => {
                                notification.remove();
                            }, 2000);
                        });
                        
                        galleryDiv.appendChild(imgDiv);
                    });
                    
                    galleryContainer.classList.remove('hidden');
                } else {
                    galleryContainer.classList.add('hidden');
                }
            } catch (error) {
                console.error('Erreur chargement images taxonomie:', error);
                galleryContainer.classList.add('hidden');
            }
        });

        // Charger la galerie au chargement initial si un type est sélectionné
        if (typeSelect.value) {
            typeSelect.dispatchEvent(new Event('change'));
        }
    }

    // Tags
    const tagsInput = document.getElementById('tags_input');
    if (tagsInput) {
        tagsInput.addEventListener('input', function() {
            const tags = this.value.split(',').map(t => t.trim()).filter(t => t);
            document.getElementById('tags_hidden').value = JSON.stringify(tags);
        });
    }

    // Upload d'images
    let existingImages = <?php echo json_encode($sheet->images ?? []); ?>;
    let mainImage = '<?php echo e($sheet->main_image); ?>';
    let newImages = [];

    const imageUpload = document.getElementById('image_upload');
    if (imageUpload) {
        imageUpload.addEventListener('change', async function(e) {
            const files = Array.from(e.target.files);
            if (files.length === 0) return;

            const progressDiv = document.getElementById('upload_progress');
            const progressBar = document.getElementById('progress_bar');
            const uploadStatus = document.getElementById('upload_status');

            progressDiv.classList.remove('hidden');
            
            let uploaded = 0;
            const total = files.length;

            for (const file of files) {
                try {
                    const formData = new FormData();
                    formData.append('image', file);

                    const response = await fetch('<?php echo e(route("admin.product-sheets.upload-image")); ?>', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        newImages.push({
                            url: data.url,
                            path: data.path
                        });
                        
                        if (!mainImage) {
                            mainImage = data.url;
                        }
                    }
                } catch (error) {
                    console.error('Erreur upload:', error);
                }

                uploaded++;
                const percent = (uploaded / total) * 100;
                progressBar.style.width = percent + '%';
                uploadStatus.textContent = `Upload ${uploaded}/${total} images...`;
            }

            setTimeout(() => {
                progressDiv.classList.add('hidden');
                progressBar.style.width = '0%';
            }, 1000);

            updateNewImages();
            e.target.value = '';
        });
    }

    function updateNewImages() {
        const newDiv = document.getElementById('newImages');
        const listDiv = document.getElementById('newImagesList');

        if (newImages.length === 0) {
            newDiv.classList.add('hidden');
            return;
        }

        newDiv.classList.remove('hidden');
        listDiv.innerHTML = newImages.map((img, index) => `
            <div class="relative group">
                <img src="${img.url}" class="w-full h-20 object-cover rounded border ${img.url === mainImage ? 'ring-2 ring-indigo-600' : ''}">
                <button type="button" onclick="removeNewImage(${index})" 
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                ${img.url === mainImage ? '<span class="absolute bottom-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded">Principale</span>' : `<button type="button" onclick="setNewMainImage(${index})" class="absolute bottom-1 left-1 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Définir principale</button>`}
            </div>
        `).join('');

        updateHiddenFields();
    }

    function updateHiddenFields() {
        const allImages = [...existingImages, ...newImages.map(img => img.url)];
        document.getElementById('images_input').value = JSON.stringify(allImages);
        document.getElementById('main_image_input').value = mainImage || '';
    }

    window.removeExistingImage = async function(imageUrl) {
        existingImages = existingImages.filter(img => img !== imageUrl);
        if (mainImage === imageUrl) {
            mainImage = existingImages.length > 0 ? existingImages[0] : (newImages.length > 0 ? newImages[0].url : '');
        }
        updateCurrentImages();
        updateHiddenFields();
    }

    window.setExistingMainImage = function(imageUrl) {
        mainImage = imageUrl;
        updateCurrentImages();
        updateHiddenFields();
    }

    window.removeNewImage = async function(index) {
        const img = newImages[index];
        
        try {
            await fetch('<?php echo e(route("admin.product-sheets.delete-image")); ?>', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ path: img.path })
            });
        } catch (error) {
            console.error('Erreur suppression:', error);
        }

        newImages.splice(index, 1);
        
        if (mainImage === img.url) {
            mainImage = existingImages.length > 0 ? existingImages[0] : (newImages.length > 0 ? newImages[0].url : '');
        }
        
        updateNewImages();
        updateHiddenFields();
    }

    window.setNewMainImage = function(index) {
        mainImage = newImages[index].url;
        updateNewImages();
        updateCurrentImages();
        updateHiddenFields();
    }

    function updateCurrentImages() {
        const currentDiv = document.getElementById('currentImages');
        if (!currentDiv) return;

        currentDiv.innerHTML = existingImages.map(img => `
            <div class="relative group" data-image-url="${img}">
                <img src="${img}" class="w-full h-20 object-cover rounded border ${img === mainImage ? 'ring-2 ring-indigo-600' : ''}">
                <button type="button" onclick="removeExistingImage('${img}')" 
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                ${img === mainImage ? '<span class="absolute bottom-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded">Principale</span>' : `<button type="button" onclick="setExistingMainImage('${img}')" class="absolute bottom-1 left-1 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Définir principale</button>`}
            </div>
        `).join('');
    }
});
</script>
<?php $__env->stopPush(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/product-sheets/edit.blade.php ENDPATH**/ ?>