

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-10 px-6">

    
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold">🏬 Magasins du réseau</h1>
        <a href="<?php echo e(route('admin.stores.create')); ?>" 
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            ➕ Créer un magasin
        </a>
    </div>

    
    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-50 text-green-800 rounded-lg border border-green-200">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        <?php $__empty_1 = true; $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                
                <div class="p-5 border-b border-gray-100">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900"><?php echo e($store->name); ?></h2>
                            <p class="text-sm text-gray-500 mt-1">📍 <?php echo e($store->city ?? 'Ville non définie'); ?></p>
                        </div>
                        <span class="text-3xl">🏪</span>
                    </div>
                </div>

                
                <div class="p-5 bg-gray-50">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-2xl font-bold text-indigo-600"><?php echo e($store->consoles_count ?? 0); ?></p>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Articles en stock</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-green-600"><?php echo e($store->invoices_count ?? 0); ?></p>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Factures</p>
                        </div>
                    </div>
                </div>

                
                <div class="px-5 py-3 border-t border-gray-100 text-sm text-gray-600">
                    <?php if($store->email): ?>
                        <p>✉️ <?php echo e($store->email); ?></p>
                    <?php endif; ?>
                    <?php if($store->user): ?>
                        <p class="text-xs text-gray-400 mt-1">Compte: <?php echo e($store->user->email); ?></p>
                    <?php endif; ?>
                </div>

                
                <div class="px-5 py-4 bg-white border-t border-gray-100 flex items-center justify-between">
                    <a href="<?php echo e(route('store.dashboard', $store)); ?>" 
                       class="text-indigo-600 hover:text-indigo-800 font-medium text-sm flex items-center gap-1">
                        👁️ Voir le dashboard
                    </a>
                    <div class="flex items-center gap-3">
                        <a href="<?php echo e(route('admin.stores.stock', $store)); ?>" 
                           class="text-gray-600 hover:text-gray-900 text-sm">
                            📦 Stock
                        </a>
                        <a href="<?php echo e(route('admin.stores.edit', $store)); ?>" 
                           class="text-gray-600 hover:text-gray-900 text-sm">
                            ✏️ Éditer
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
            <div class="col-span-full text-center py-12 bg-white rounded-lg shadow">
                <p class="text-gray-500 text-lg">Aucun magasin enregistré</p>
                <a href="<?php echo e(route('admin.stores.create')); ?>" class="text-indigo-600 hover:underline mt-2 inline-block">
                    Créer le premier magasin →
                </a>
            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/stores/index.blade.php ENDPATH**/ ?>