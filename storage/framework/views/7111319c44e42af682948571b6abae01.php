<?php $__env->startSection('content'); ?>
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white">Dashboard Admin</h1>
        <p class="text-sm text-gray-400 mt-1">Stock R4E - Vue d'ensemble</p>
    </div>

    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4 hover:bg-gray-800/70 hover:border-gray-600 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 uppercase">Nombre total articles</p>
                    <p class="text-2xl font-bold text-white"><?php echo e($totalArticles); ?></p>
                </div>
                <span class="text-2xl">📊</span>
            </div>
        </div>
        <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4 hover:bg-gray-800/70 hover:border-gray-600 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 uppercase">État stock</p>
                    <p class="text-2xl font-bold text-white"><?php echo e($articlesStock); ?></p>
                </div>
                <span class="text-2xl">✅</span>
            </div>
        </div>
        <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4 hover:bg-gray-800/70 hover:border-gray-600 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 uppercase">Défectueux</p>
                    <p class="text-2xl font-bold text-white"><?php echo e($articlesDefectueux); ?></p>
                </div>
                <span class="text-2xl">🔴</span>
            </div>
        </div>
        <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4 hover:bg-gray-800/70 hover:border-gray-600 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 uppercase">Modés</p>
                    <p class="text-2xl font-bold text-white"><?php echo e($articlesModes); ?></p>
                </div>
                <span class="text-2xl">⚙️</span>
            </div>
        </div>
    </div>

    
    <?php if(!empty($sections)): ?>
    <div class="space-y-6">
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-gray-800/30 backdrop-blur border border-gray-700/50 rounded-lg p-4">
                <h2 class="text-sm font-semibold text-gray-300 uppercase tracking-wide mb-3"><?php echo e($section['title']); ?></h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-2">
                    <?php $__currentLoopData = $section['cards']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isDisabled = !empty($card['disabled']) || empty($card['route']);
                        ?>
                        <?php if($isDisabled): ?>
                            <div class="relative group bg-gray-900/40 border border-gray-700/30 rounded-lg p-3 opacity-40 cursor-not-allowed">
                        <?php else: ?>
                            <a href="<?php echo e(route($card['route'], $card['params'] ?? [])); ?>" 
                               class="relative group bg-gray-800/40 border border-gray-700/50 hover:border-indigo-500/50 hover:bg-gray-700/50 hover:shadow-lg hover:shadow-indigo-500/10 rounded-lg p-3 transition duration-150 block"
                               title="<?php echo e($card['description'] ?? ''); ?>">
                        <?php endif; ?>
                                <div class="flex flex-col items-center text-center">
                                    <span class="text-4xl mb-2"><?php echo e($card['icon'] ?? '📌'); ?></span>
                                    <p class="text-base font-semibold text-gray-100 leading-tight"><?php echo e($card['title']); ?></p>
                                    <?php if(!empty($card['subtitle'])): ?>
                                        <p class="text-sm text-gray-500 mt-1"><?php echo e($card['subtitle']); ?></p>
                                    <?php endif; ?>
                                </div>
                                <?php if(!empty($card['badge'])): ?>
                                    <span class="absolute -top-1 -right-1 text-[9px] font-bold px-1.5 py-0.5 rounded-full <?php echo e($card['badge_style'] ?? 'bg-red-500 text-white'); ?>">
                                        <?php echo e($card['badge']); ?>

                                    </span>
                                <?php endif; ?>
                        <?php if($isDisabled): ?>
                            </div>
                        <?php else: ?>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
    <?php endif; ?>


    <div class="mt-6 grid grid-cols-1 gap-6">
        
        
        <div class="bg-gray-800/30 backdrop-blur border border-gray-700/50 rounded-lg overflow-hidden">
            <div class="flex items-center justify-between p-4 border-b border-gray-700/50 bg-gray-800/50">
                <h3 class="text-sm font-semibold text-gray-200">📦 Stock Mods (<?php echo e($mods->count()); ?>)</h3>
                <a href="<?php echo e(route('admin.mods.index')); ?>" class="text-xs text-indigo-400 hover:text-indigo-300">
                    Voir tout →
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-gray-900/50">
                        <tr class="text-gray-400">
                            <th class="px-3 py-2 text-left font-medium">Nom</th>
                            <th class="px-3 py-2 text-left font-medium">Type</th>
                            <th class="px-3 py-2 text-center font-medium">Stock</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        <?php $__empty_1 = true; $__currentLoopData = $mods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-700/30 transition">
                                <td class="px-3 py-2 font-medium text-gray-200">
                                    <?php if($mod->icon && str_starts_with($mod->icon, 'data:image/')): ?>
                                        <img src="<?php echo e($mod->icon); ?>" alt="" class="inline w-4 h-4 mr-1" style="image-rendering: pixelated;">
                                    <?php else: ?>
                                        <span class="mr-1"><?php echo e($mod->icon ?? '🔧'); ?></span>
                                    <?php endif; ?>
                                    <?php echo e(Str::limit($mod->name, 25)); ?>

                                </td>
                                <td class="px-3 py-2 text-gray-400">
                                    <?php if($mod->is_accessory): ?>
                                        <span class="px-1.5 py-0.5 bg-purple-900/50 text-purple-300 rounded text-[10px]">📦</span>
                                    <?php else: ?>
                                        <span class="px-1.5 py-0.5 bg-blue-900/50 text-blue-300 rounded text-[10px]">🔧</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-3 py-2 text-center">
                                    <?php if($mod->quantity == 0): ?>
                                        <span class="px-2 py-0.5 bg-red-900/50 text-red-300 rounded text-[10px] font-semibold">0</span>
                                    <?php elseif($mod->quantity < 5): ?>
                                        <span class="px-2 py-0.5 bg-orange-900/50 text-orange-300 rounded text-[10px] font-semibold"><?php echo e($mod->quantity); ?></span>
                                    <?php else: ?>
                                        <span class="px-2 py-0.5 bg-green-900/50 text-green-300 rounded text-[10px] font-semibold"><?php echo e($mod->quantity); ?></span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="3" class="px-3 py-4 text-center text-gray-500">
                                    Aucun mod. <a href="<?php echo e(route('admin.mods.create')); ?>" class="text-indigo-400 hover:underline">Créer</a>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

</div>
</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>