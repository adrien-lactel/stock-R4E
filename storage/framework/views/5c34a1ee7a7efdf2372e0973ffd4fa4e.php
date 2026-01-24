

<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📦 Accessoires</h1>
        <div class="flex gap-2">
            <a href="<?php echo e(route('admin.accessories.create')); ?>" 
               class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                ➕ Nouvel accessoire
            </a>
            <a href="<?php echo e(route('admin.dashboard')); ?>" class="px-4 py-2 rounded border hover:bg-gray-50">
                ← Retour dashboard
            </a>
        </div>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <?php if(session('error')): ?>
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded border border-red-300">
            <?php echo e(session('error')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-pink-50 shadow rounded-lg overflow-hidden border border-pink-100">
        <?php if($accessories->count()): ?>
            <table class="min-w-full divide-y divide-pink-100">
                <thead class="bg-pink-100">
                    <tr>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Nom</th>
                        <th class="px-4 py-3 text-left text-sm font-semibold text-gray-700">Description</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Prix achat</th>
                        <th class="px-4 py-3 text-center text-sm font-semibold text-gray-700">Utilisations</th>
                        <th class="px-4 py-3 text-right text-sm font-semibold text-gray-700">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-pink-100">
                    <?php $__currentLoopData = $accessories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accessory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr class="hover:bg-yellow-50 bg-white">
                            <td class="px-4 py-3 bg-blue-50">
                                <div class="font-medium text-gray-900"><?php echo e($accessory->name); ?></div>
                            </td>
                            <td class="px-4 py-3 text-sm text-gray-600 bg-purple-50">
                                <?php echo e(Str::limit($accessory->description, 60) ?? '—'); ?>

                            </td>
                            <td class="px-4 py-3 text-center text-sm bg-yellow-50">
                                <?php echo e(number_format($accessory->purchase_price, 2)); ?> €
                            </td>
                            <td class="px-4 py-3 text-center text-sm bg-green-50">
                                <?php echo e($accessory->appliedConsoles()->count()); ?>

                            </td>
                            <td class="px-4 py-3 text-right bg-pink-50">
                                <div class="flex justify-end gap-2">
                                    <a href="<?php echo e(route('admin.accessories.edit', $accessory)); ?>" 
                                       class="bg-indigo-100 text-indigo-800 border border-indigo-200 px-3 py-1 rounded hover:bg-indigo-200 text-sm font-semibold">
                                        ✏️ Modifier
                                    </a>
                                    <form action="<?php echo e(route('admin.accessories.destroy', $accessory)); ?>" 
                                          method="POST"
                                          onsubmit="return confirm('Supprimer cet accessoire ?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="bg-red-100 text-red-800 border border-red-200 px-3 py-1 rounded hover:bg-red-200 text-sm font-semibold">
                                            🗑️ Supprimer
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="p-8 text-center text-gray-500 bg-pink-50 border border-pink-100 rounded-lg">
                <p class="text-lg mb-4">Aucun accessoire créé</p>
                <p class="text-sm">Les accessoires sont des éléments comme les boîtes, coques, câbles, etc.</p>
                <a href="<?php echo e(route('admin.accessories.create')); ?>" 
                   class="inline-block mt-4 px-4 py-2 bg-indigo-100 text-indigo-800 border border-indigo-200 rounded hover:bg-indigo-200 font-semibold">
                    ➕ Créer un accessoire
                </a>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="mt-6 p-4 bg-purple-50 border border-purple-200 rounded-lg">
        <h3 class="font-semibold text-purple-800 mb-2">📦 À propos des accessoires</h3>
        <ul class="text-sm text-purple-700 space-y-1">
            <li>• Les accessoires sont des éléments physiques (boîtes, coques, câbles, manettes...)</li>
            <li>• Ils ont un prix d'achat qui s'ajoute au coût de revient de l'article</li>
            <li>• Ils peuvent être affectés aux réparateurs (stock) et associés aux articles</li>
            <li>• Contrairement aux opérations, ils représentent un coût matériel</li>
        </ul>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/accessories/index.blade.php ENDPATH**/ ?>