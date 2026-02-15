

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🖼️ Fiches produits</h1>
        <div class="flex gap-2">
            <a href="<?php echo e(route('admin.product-sheets.images-manager')); ?>"
               class="inline-flex items-center px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                📸 Gérer les images
            </a>
            <a href="<?php echo e(route('admin.product-sheets.create')); ?>"
               class="inline-flex items-center px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                ➕ Créer une fiche produit
            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <?php if($sheets->count() > 0): ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                <?php $__currentLoopData = $sheets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sheet): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                        
                        <?php
                            $displayImage = $sheet->main_image ?: ($sheet->images[0] ?? null);
                        ?>
                        <div class="relative aspect-[4/3] border border-gray-900">
                            <?php if($displayImage): ?>
                                <img src="<?php echo e($displayImage); ?>" alt="<?php echo e($sheet->name); ?>" 
                                     class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full bg-gray-200 flex items-center justify-center text-gray-400">
                                    Aucune image
                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if($sheet->is_favorite): ?>
                                <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded-full shadow-lg flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                    </svg>
                                    <span class="text-xs font-semibold">Coup de cœur</span>
                                </div>
                            <?php endif; ?>
                            
                            
                            <?php if($sheet->featured_mods && count($sheet->featured_mods) > 0): ?>
                                <div class="absolute top-2 right-2 flex flex-col gap-1 items-end max-w-[200px]">
                                    <?php $__currentLoopData = $sheet->featured_mods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            // Si l'icône n'est pas dans featured_mods, la récupérer depuis la DB
                                            $icon = $mod['icon'] ?? null;
                                            if (!$icon && isset($mod['id'])) {
                                                $modModel = \App\Models\Mod::find($mod['id']);
                                                $icon = $modModel?->icon ?? '🔧';
                                            }
                                            $icon = $icon ?: '🔧';
                                            $isBase64 = str_starts_with($icon, 'data:image');
                                        ?>
                                        <div class="bg-white/90 backdrop-blur-sm rounded-lg px-2 py-1 flex items-center gap-2 shadow-lg">
                                            <span class="text-xs font-medium text-gray-800"><?php echo e($mod['name']); ?></span>
                                            <?php if($isBase64): ?>
                                                <img src="<?php echo e($icon); ?>" alt="<?php echo e($mod['name']); ?>" class="w-5 h-5" style="image-rendering: pixelated;">
                                            <?php else: ?>
                                                <span class="text-base"><?php echo e($icon); ?></span>
                                            <?php endif; ?>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-2">
                                <div>
                                    <div class="flex items-center gap-2 mb-1">
                                        <span class="text-xs font-mono bg-indigo-100 text-indigo-800 px-1.5 py-0.5 rounded">#<?php echo e($sheet->id); ?></span>
                                        <h3 class="font-semibold text-gray-800"><?php echo e($sheet->name); ?></h3>
                                    </div>
                                    <?php if($sheet->articleType?->rom_id): ?>
                                        <span class="text-xs text-indigo-600 font-mono"><?php echo e($sheet->articleType->rom_id); ?></span>
                                    <?php endif; ?>
                                </div>
                                <div class="flex flex-col items-end gap-1">
                                    <?php if($sheet->is_active): ?>
                                        <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Actif</span>
                                    <?php else: ?>
                                        <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Inactif</span>
                                    <?php endif; ?>
                                    <?php if($sheet->prix_r4e): ?>
                                        <span class="text-xs bg-indigo-600 text-white px-2 py-1 rounded font-bold">
                                            <?php echo e(number_format($sheet->prix_r4e, 0, ',', ' ')); ?> €
                                        </span>
                                    <?php endif; ?>
                                </div>
                            </div>

                            
                            <?php if($sheet->articleType): ?>
                                <div class="text-xs text-gray-600 mb-2">
                                    <span class="font-medium">
                                        <?php echo e($sheet->articleType->subCategory?->category?->name ?? '—'); ?>

                                    </span>
                                    <span class="text-gray-400"> / </span>
                                    <span>
                                        <?php echo e($sheet->articleType->subCategory?->name ?? '—'); ?>

                                    </span>
                                    <span class="text-gray-400"> / </span>
                                    <span class="text-indigo-600 font-medium">
                                        <?php echo e($sheet->articleType->name); ?>

                                    </span>
                                </div>
                            <?php endif; ?>

                            <?php if($sheet->description): ?>
                                <p class="text-sm text-gray-600 line-clamp-2 mb-3"><?php echo e(Str::limit($sheet->description, 100)); ?></p>
                            <?php endif; ?>

                            
                            <?php if($sheet->condition_criteria && count($sheet->condition_criteria) > 0): ?>
                                <div class="mb-3 space-y-1">
                                    <?php $__currentLoopData = $sheet->condition_criteria; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $criterion => $rating): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php
                                            $defaultLabels = [
                                                'box_condition' => 'Boîte',
                                                'manual_condition' => 'Manuel',
                                                'media_condition' => 'Support',
                                                'completeness' => 'Complet',
                                                'rarity' => 'Rareté',
                                                'overall_condition' => 'État général'
                                            ];
                                            // Utiliser le label personnalisé si disponible, sinon le label par défaut
                                            $customLabels = $sheet->condition_criteria_labels ?? [];
                                            $label = $customLabels[$criterion] ?? ($defaultLabels[$criterion] ?? $criterion);
                                        ?>
                                        <div class="flex items-center text-xs">
                                            <span class="text-gray-600 w-20 flex-shrink-0"><?php echo e($label); ?>:</span>
                                            <div class="flex gap-0.5">
                                                <?php for($i = 1; $i <= 5; $i++): ?>
                                                    <span class="<?php echo e($i <= $rating ? 'text-yellow-400' : 'text-gray-300'); ?>">★</span>
                                                <?php endfor; ?>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            <?php endif; ?>

                            
                            <?php if($sheet->featured_mods && count($sheet->featured_mods) > 0): ?>
                                <div class="mb-3">
                                    <div class="text-xs font-medium text-gray-700 mb-1">🔧 Inclus:</div>
                                    <div class="flex flex-wrap gap-1">
                                        <?php $__currentLoopData = $sheet->featured_mods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                // Si l'icône n'est pas dans featured_mods, la récupérer depuis la DB
                                                $icon = $mod['icon'] ?? null;
                                                if (!$icon && isset($mod['id'])) {
                                                    $modModel = \App\Models\Mod::find($mod['id']);
                                                    $icon = $modModel?->icon ?? '🔧';
                                                }
                                                $icon = $icon ?: '🔧';
                                                $isBase64 = str_starts_with($icon, 'data:image');
                                            ?>
                                            <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded text-xs bg-blue-100 text-blue-800">
                                                <?php if($isBase64): ?>
                                                    <img src="<?php echo e($icon); ?>" alt="<?php echo e($mod['name']); ?>" class="w-4 h-4" style="image-rendering: pixelated;">
                                                <?php else: ?>
                                                    <span><?php echo e($icon); ?></span>
                                                <?php endif; ?>
                                                <span><?php echo e($mod['name']); ?></span>
                                            </span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            
                            <?php if($sheet->images && count($sheet->images) > 0): ?>
                                <p class="text-xs text-gray-500 mb-3">
                                    🖼️ <?php echo e(count($sheet->images)); ?> image(s)
                                </p>
                            <?php endif; ?>

                            
                            <div class="flex items-center gap-2">
                                <a href="<?php echo e(route('admin.product-sheets.show', $sheet)); ?>"
                                   class="flex-1 text-center px-3 py-2 rounded bg-gray-600 text-white text-sm hover:bg-gray-700">
                                    👁️ Voir
                                </a>
                                
                                <a href="<?php echo e(route('admin.product-sheets.edit', $sheet)); ?>"
                                   class="flex-1 text-center px-3 py-2 rounded bg-indigo-600 text-white text-sm hover:bg-indigo-700">
                                    ✏️ Éditer
                                </a>
                                
                                <form method="POST" action="<?php echo e(route('admin.product-sheets.destroy', $sheet)); ?>"
                                      onsubmit="return confirm('Supprimer cette fiche produit ?')"
                                      class="flex-shrink-0">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" 
                                            class="px-3 py-2 rounded bg-red-600 text-white text-sm hover:bg-red-700">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            
            <div class="p-4 border-t">
                <?php echo e($sheets->links()); ?>

            </div>
        <?php else: ?>
            <div class="p-8 text-center text-gray-500">
                <p class="mb-4">Aucune fiche produit créée</p>
                <a href="<?php echo e(route('admin.product-sheets.create')); ?>"
                   class="inline-flex items-center px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                    ➕ Créer la première fiche produit
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/product-sheets/index.blade.php ENDPATH**/ ?>