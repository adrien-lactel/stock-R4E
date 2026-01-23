<?php $__env->startSection('content'); ?>
<div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🛠️ Réparateurs</h1>
        <a href="<?php echo e(route('admin.repairers.create')); ?>" class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
            ➕ Nouveau réparateur
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Nom</th>
                    <th class="px-4 py-3 text-left">Contact</th>
                    <th class="px-4 py-3 text-left">Ville</th>
                    <th class="px-4 py-3 text-center">Consoles</th>
                    <th class="px-4 py-3 text-center">Actif</th>
                    <th class="px-4 py-3 text-center">Délai</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $repairers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">
                            <a href="<?php echo e(route('admin.repairers.show', $r)); ?>" class="text-indigo-600 hover:underline">
                                <?php echo e($r->name); ?>

                            </a>
                        </td>
                        <td class="px-4 py-3">
                            <div><?php echo e($r->email ?? '—'); ?></div>
                            <div class="text-gray-500"><?php echo e($r->phone ?? ''); ?></div>
                        </td>
                        <td class="px-4 py-3"><?php echo e($r->city ?? '—'); ?></td>
                        <td class="px-4 py-3 text-center">
                            <?php if($r->consoles_count > 0): ?>
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-semibold">
                                    <?php echo e($r->consoles_count); ?>

                                </span>
                            <?php else: ?>
                                <span class="text-gray-400">0</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 rounded text-white text-xs <?php echo e($r->is_active ? 'bg-green-600' : 'bg-gray-500'); ?>">
                                <?php echo e($r->is_active ? 'Oui' : 'Non'); ?>

                            </span>
                        </td>
                        <td class="px-4 py-3 text-center"><?php echo e($r->delay_days_default ?? '—'); ?> j</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="<?php echo e(route('admin.repairers.show', $r)); ?>" class="text-indigo-600 hover:underline text-sm">
                                Voir
                            </a>
                            <a href="<?php echo e(route('admin.repairers.edit', $r)); ?>" class="text-gray-600 hover:underline text-sm">
                                Éditer
                            </a>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            Aucun réparateur.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <?php echo e($repairers->links()); ?>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/repairers/index.blade.php ENDPATH**/ ?>