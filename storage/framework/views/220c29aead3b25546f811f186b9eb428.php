<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-6">
        📦 Demandes de lots
    </h1>

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

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Console</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Magasin demandeur</th>
                    <th class="p-3">Quantité</th>
                    <th class="p-3">Prix unitaire</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php
                    $console = $request->consoleOffer->console;
                    $offer = $request->consoleOffer;
                ?>

                <tr class="border-t align-top">

                    
                    <td class="p-3 font-mono">
                        #<?php echo e($console->id); ?> - <?php echo e($console->serial_number); ?>

                    </td>

                    
                    <td class="p-3">
                        <?php echo e($console->articleType?->name ?? 'N/A'); ?>

                    </td>

                    
                    <td class="p-3">
                        <span class="font-semibold"><?php echo e($request->store->name); ?></span>
                    </td>

                    
                    <td class="p-3">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded">
                            <?php echo e($request->quantity); ?>

                        </span>
                    </td>

                    
                    <td class="p-3">
                        <?php echo e(number_format($offer->sale_price, 2, ',', ' ')); ?> €
                    </td>

                    
                    <td class="p-3 text-center space-y-2">

                        
                        <form method="POST" action="<?php echo e(route('admin.lot-requests.validate', $request)); ?>">
                            <?php echo csrf_field(); ?>
                            <button class="w-full bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                ✅ Valider
                            </button>
                        </form>

                        
                        <button
                            class="w-full bg-red-200 text-red-800 px-3 py-1 rounded hover:bg-red-300"
                            onclick="document.getElementById('reject-form-<?php echo e($request->id); ?>').classList.toggle('hidden')">
                            ❌ Rejeter
                        </button>

                        <form
                            method="POST"
                            action="<?php echo e(route('admin.lot-requests.reject', $request)); ?>"
                            id="reject-form-<?php echo e($request->id); ?>"
                            class="hidden space-y-2 bg-red-50 p-2 rounded">
                            <?php echo csrf_field(); ?>

                            <textarea
                                name="admin_comment"
                                required
                                rows="2"
                                class="w-full border rounded p-2 text-sm"
                                placeholder="Motif du refus…"></textarea>

                            <button class="w-full bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-sm">
                                Confirmer refus
                            </button>
                        </form>

                    </td>

                </tr>

            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">
                        Aucune demande en attente
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/lot-requests/index.blade.php ENDPATH**/ ?>