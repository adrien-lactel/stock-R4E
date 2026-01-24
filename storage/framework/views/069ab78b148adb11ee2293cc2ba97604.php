

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">📦 Bilan des accessoires / pièces détachées</h1>
            <p class="text-sm text-gray-600 mt-1">Vue d'ensemble des stocks et valorisation</p>
        </div>

        <a href="<?php echo e(route('admin.dashboard')); ?>"
           class="inline-flex items-center px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour au dashboard
        </a>
    </div>

    
    <div class="grid grid-cols-1 md:grid-cols-5 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Références</div>
            <div class="text-2xl font-bold text-indigo-600"><?php echo e($stats['total_items']); ?></div>
            <div class="text-xs text-gray-400 mt-1">Différents types</div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Quantité totale</div>
            <div class="text-2xl font-bold text-blue-600"><?php echo e(number_format($stats['total_quantity'], 0, ',', ' ')); ?></div>
            <div class="text-xs text-gray-400 mt-1">Pièces en stock</div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Valeur du stock</div>
            <div class="text-2xl font-bold text-green-600"><?php echo e(number_format($stats['total_value'], 2, ',', ' ')); ?> €</div>
            <div class="text-xs text-gray-400 mt-1">Prix d'achat total</div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Rupture de stock</div>
            <div class="text-2xl font-bold text-red-600"><?php echo e($stats['out_of_stock']); ?></div>
            <div class="text-xs text-gray-400 mt-1">Quantité = 0</div>
        </div>
        
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Stock faible</div>
            <div class="text-2xl font-bold text-orange-600"><?php echo e($stats['low_stock']); ?></div>
            <div class="text-xs text-gray-400 mt-1">Quantité ≤ 5</div>
        </div>
    </div>

    
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Description</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Stock</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Prix unitaire</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Valorisation</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Valeur totale</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">État</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $accessories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accessory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="font-medium text-gray-900"><?php echo e($accessory->name); ?></div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <?php echo e(Str::limit($accessory->description ?? '—', 50)); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <span class="font-semibold 
                                <?php if($accessory->quantity <= 0): ?> text-red-600
                                <?php elseif($accessory->quantity <= 5): ?> text-orange-600
                                <?php else: ?> text-gray-900
                                <?php endif; ?>">
                                <?php echo e(number_format($accessory->quantity, 0, ',', ' ')); ?>

                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm text-gray-900">
                            <?php echo e(number_format($accessory->purchase_price, 2, ',', ' ')); ?> €
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <form action="<?php echo e(route('admin.accessories.update-valorisation', $accessory)); ?>" method="POST" class="flex items-center justify-center gap-2">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <input type="number" 
                                       name="valorisation" 
                                       step="0.01" 
                                       min="0" 
                                       value="<?php echo e($accessory->valorisation ?? 0); ?>" 
                                       class="w-24 text-sm rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                                       onchange="this.form.submit()">
                                <span class="text-sm text-gray-500">€</span>
                            </form>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium text-gray-900">
                            <?php echo e(number_format($accessory->quantity * $accessory->purchase_price, 2, ',', ' ')); ?> €
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <?php if($accessory->quantity <= 0): ?>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                    🔴 Rupture
                                </span>
                            <?php elseif($accessory->quantity <= 5): ?>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">
                                    ⚠️ Stock faible
                                </span>
                            <?php else: ?>
                                <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                    ✓ Disponible
                                </span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center">
                            <a href="<?php echo e(route('admin.accessories.edit', $accessory)); ?>" 
                               class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                ✏️ Éditer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                            Aucun accessoire trouvé
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <div class="mt-6 flex gap-4">
        <a href="<?php echo e(route('admin.accessories.index')); ?>" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            📋 Gérer les accessoires
        </a>
        <a href="<?php echo e(route('admin.accessories.create')); ?>" class="px-4 py-2 border rounded hover:bg-gray-50">
            ➕ Créer un accessoire
        </a>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/accessories/report.blade.php ENDPATH**/ ?>