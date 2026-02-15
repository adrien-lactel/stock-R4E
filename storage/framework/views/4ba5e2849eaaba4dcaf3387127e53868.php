<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">
            💰 Historique des ventes
        </h1>
        <a href="<?php echo e(route('store.dashboard', $store)); ?>" class="px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour stock
        </a>
    </div>

    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Article</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Serial</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date de vente</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SAV</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Facture</th>
                    <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $soldDate = \Carbon\Carbon::parse($sale->sold_at);
                        $daysSinceSale = $soldDate->diffInDays(now());
                        $savPeriod = 365; // 1 an
                        $inSavPeriod = $daysSinceSale <= $savPeriod;
                        $hasSavRequest = $sale->returnRequest !== null;
                    ?>
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">
                                <?php echo e($sale->articleType?->name ?? 'N/A'); ?>

                            </div>
                            <div class="text-xs text-gray-500">
                                <?php echo e($sale->articleCategory?->name); ?>

                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                            <?php echo e($sale->serial_number ?: '—'); ?>

                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-900">
                                <?php echo e($soldDate->format('d/m/Y')); ?>

                            </div>
                            <div class="text-xs text-gray-500">
                                il y a <?php echo e($soldDate->diffForHumans(null, true)); ?>

                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($inSavPeriod): ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                    ✅ Sous garantie (<?php echo e($savPeriod - $daysSinceSale); ?>j restants)
                                </span>
                            <?php else: ?>
                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                    ❌ Hors garantie
                                </span>
                            <?php endif; ?>

                            <?php if($hasSavRequest): ?>
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-800">
                                        SAV en cours
                                    </span>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <?php if($sale->invoice_id): ?>
                                <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                    📄 Télécharger
                                </a>
                            <?php else: ?>
                                <span class="text-xs text-gray-400">Aucune facture</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                            <?php if($inSavPeriod && !$hasSavRequest): ?>
                                <button
                                    type="button"
                                    onclick="toggleSavForm<?php echo e($sale->id); ?>()"
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                    🔧 Demande SAV
                                </button>

                                <form id="sav-form-<?php echo e($sale->id); ?>"
                                      method="POST"
                                      action="<?php echo e(route('store.console.defective', $sale)); ?>"
                                      class="hidden mt-3 bg-red-50 border border-red-200 rounded p-3">
                                    <?php echo csrf_field(); ?>

                                    <label class="block text-xs font-medium text-gray-700 mb-1">
                                        Motif du retour SAV
                                    </label>
                                    <textarea name="comment" required rows="2"
                                              class="w-full border rounded p-2 text-sm mb-2"
                                              placeholder="Décrivez le problème..."></textarea>

                                    <div class="flex gap-2">
                                        <button type="submit" class="flex-1 bg-red-600 text-white px-3 py-1.5 rounded text-xs hover:bg-red-700">
                                            Envoyer
                                        </button>
                                        <button type="button" onclick="toggleSavForm<?php echo e($sale->id); ?>()" class="flex-1 border px-3 py-1.5 rounded text-xs hover:bg-gray-50">
                                            Annuler
                                        </button>
                                    </div>
                                </form>

                                <script>
                                function toggleSavForm<?php echo e($sale->id); ?>() {
                                    const form = document.getElementById('sav-form-<?php echo e($sale->id); ?>');
                                    form.classList.toggle('hidden');
                                }
                                </script>
                            <?php else: ?>
                                <span class="text-xs text-gray-400">—</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="6" class="px-6 py-8 text-center text-gray-500">
                            Aucune vente enregistrée
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/store/sales/index.blade.php ENDPATH**/ ?>