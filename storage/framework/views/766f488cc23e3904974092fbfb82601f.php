<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-10 px-6">

    
    <h1 class="text-3xl font-bold mb-6">
        🏪 Stock du magasin : <?php echo e($store->name); ?>

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

    
    <?php if($errors->any()): ?>
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded border border-red-300">
            <ul class="list-disc pl-5">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($error); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <h2 class="text-2xl font-semibold mb-4">
        📦 Articles disponibles
    </h2>

    <div class="bg-white shadow rounded-lg overflow-hidden mb-10">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Valeur réelle</th>
                    <th class="p-3">Prix de vente</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $consoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr class="border-t align-top">
                    <td class="p-3 font-mono text-sm">#<?php echo e($console->id); ?></td>
                    <td class="p-3">
                        <div class="text-sm">
                            <div class="font-semibold"><?php echo e($console->articleCategory?->name ?? 'N/A'); ?></div>
                            <div class="text-gray-600"><?php echo e($console->articleSubCategory?->name ?? '-'); ?></div>
                            <div class="text-gray-500"><?php echo e($console->articleType?->name ?? '-'); ?></div>
                        </div>
                    </td>
                    <td class="p-3"><?php echo e($console->real_value); ?> €</td>
                    <td class="p-3 font-semibold text-indigo-600">
                        <?php echo e($console->pivot?->sale_price ?? 'N/A'); ?> €
                    </td>

                    <td class="p-3">
                        <div class="flex flex-col gap-3">

                            
                            <a href="<?php echo e(route('store.product-sheet', ['store' => $store->id, 'console' => $console->id])); ?>" 
                               class="w-full bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700 text-center">
                                📄 Fiche produit
                            </a>

                            
                            <form method="POST" action="<?php echo e(route('store.console.sell', $console)); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="w-full bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    ✔ Article vendu
                                </button>
                            </form>

                            
                            <button
                                type="button"
                                id="sav-btn-<?php echo e($console->id); ?>"
                                onclick="toggleSavForm(<?php echo e($console->id); ?>)"
                                class="w-full bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-600">
                                🛠️ Déclarer un problème
                            </button>

                            <form id="sav-form-<?php echo e($console->id); ?>"
                                  method="POST"
                                  action="<?php echo e(route('store.console.defective', $console)); ?>"
                                  class="hidden bg-amber-50 border border-amber-200 rounded p-3">
                                <?php echo csrf_field(); ?>

                                <textarea name="comment" required rows="2"
                                          class="w-full border rounded p-2 text-sm"
                                          placeholder="Ex : écran HS, lecteur défectueux…"></textarea>

                                <div class="flex gap-2 mt-3">
                                    <button type="submit" class="flex-1 bg-amber-600 text-white px-3 py-1 rounded">
                                        Envoyer
                                    </button>
                                    <button type="button"
                                            onclick="cancelSavForm(<?php echo e($console->id); ?>)"
                                            class="flex-1 bg-gray-300 text-gray-700 px-3 py-1 rounded">
                                        Annuler
                                    </button>
                                </div>
                            </form>

                        </div>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">
                        Aucune console disponible
                    </td>
                </tr>
            <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <h2 class="text-2xl font-semibold mb-4">
        🛠️ SAV & réparations en cours
    </h2>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Console</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Devis accepté</th>
                    <th class="p-3">Statut</th>
                </tr>
            </thead>

            <tbody>
<?php $__empty_1 = true; $__currentLoopData = $savConsoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
    <?php
        $return = $console->returnRequest;
        $quote  = $return?->repairQuote;
    ?>

    <tr class="border-t align-top">
        <td class="p-3 font-mono">#<?php echo e($console->id); ?></td>
        <td class="p-3"><?php echo e($console->articleType?->name ?? 'N/A'); ?></td>

        
        <td class="p-3">
            <?php if($return): ?>
                <?php if($return->status === 'pending'): ?>
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">
                        🕒 En attente validation admin
                    </span>
                <?php elseif($return->status === 'accepted'): ?>
                    <?php if($quote): ?>
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">
                            📋 Devis: <?php echo e(number_format($quote->amount, 2, ',', ' ')); ?> €
                        </span>
                    <?php else: ?>
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">
                            ✅ SAV validé — en attente envoi magasin
                        </span>
                    <?php endif; ?>
                <?php elseif($return->status === 'sent_to_repairer'): ?>
                    <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded text-sm">
                        📦 Article SAV envoyé réparateur
                    </span>
                <?php elseif($return->status === 'rejected'): ?>
                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm">
                        ❌ SAV refusé
                    </span>
                    <?php if($return->admin_comment): ?>
                        <p class="text-xs text-red-700 mt-1 italic"><?php echo e($return->admin_comment); ?></p>
                    <?php endif; ?>
                <?php endif; ?>
            <?php else: ?>
                <span class="text-gray-400">—</span>
            <?php endif; ?>
        </td>

        
        <td class="p-3 space-y-2">

            <?php if($return && in_array($return->status, ['accepted','sent_to_repairer']) && $return->repairer): ?>
                <div class="bg-blue-50 border border-blue-200 rounded p-3 text-blue-900 text-sm">
                    <div class="font-semibold">📦 Adresse réparateur</div>
                    <div><?php echo e($return->repairer->name); ?></div>
                    <div><?php echo e($return->repairer->address); ?></div>
                    <div><?php echo e($return->repairer->city); ?></div>
                    <?php if($return->repairer->phone): ?>
                        <div class="text-xs text-gray-700 mt-1">☎ <?php echo e($return->repairer->phone); ?></div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            
            <?php if($quote && $quote->status === 'proposed'): ?>
    <div class="bg-amber-50 border border-amber-200 rounded p-3 text-amber-900">
        <div class="font-semibold text-lg mb-1">
            🧾 Devis proposé : 
            <span class="text-indigo-700">
                <?php echo e(number_format($quote->amount, 2, ',', ' ')); ?> €
            </span>
        </div>

        <?php if($quote->admin_comment): ?>
            <p class="italic text-sm mb-2">
                “<?php echo e($quote->admin_comment); ?>”
            </p>
        <?php endif; ?>

        <div class="flex gap-2 mt-2">
            <form method="POST"
                  action="<?php echo e(route('store.repair.quote.accept', $quote)); ?>"
                  class="flex-1">
                <?php echo csrf_field(); ?>
                <button
                    class="w-full bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                    ✅ Accepter ce devis
                </button>
            </form>

            <form method="POST"
                  action="<?php echo e(route('store.repair.quote.reject', $quote)); ?>"
                  class="flex-1">
                <?php echo csrf_field(); ?>
                <button
                    class="w-full bg-gray-300 text-gray-800 px-3 py-1 rounded hover:bg-gray-400">
                    ❌ Refuser
                </button>
            </form>
        </div>
    </div>

            <?php elseif($quote && $quote->status === 'accepted'): ?>
                
                <div class="space-y-2">
                    <div class="bg-green-50 border border-green-200 rounded p-3">
                        <div class="font-semibold text-green-900 mb-1">
                            ✅ Devis accepté : <?php echo e(number_format($quote->amount, 2, ',', ' ')); ?> €
                        </div>
                        <p class="text-xs text-green-700">
                            Réparation confirmée
                        </p>
                    </div>

                    <?php if($return->repairer): ?>
                        <div class="bg-indigo-50 border border-indigo-200 rounded p-3 text-indigo-900 text-sm">
                            <div class="font-semibold mb-1">📦 Expédier à :</div>
                            <div><?php echo e($return->repairer->name); ?></div>
                            <div><?php echo e($return->repairer->address); ?></div>
                            <div><?php echo e($return->repairer->city); ?></div>
                            <?php if($return->repairer->phone): ?>
                                <div class="text-xs mt-1">☎ <?php echo e($return->repairer->phone); ?></div>
                            <?php endif; ?>
                        </div>

                        <?php if($return->status !== 'sent_to_repairer'): ?>
                            <form method="POST" action="<?php echo e(route('store.console.return.send', $console)); ?>">
                                <?php echo csrf_field(); ?>
                                <button class="w-full bg-indigo-600 text-white px-3 py-1.5 rounded hover:bg-indigo-700 font-medium">
                                    📦 Article envoyé au réparateur
                                </button>
                            </form>
                        <?php else: ?>
                            <div class="bg-indigo-100 border border-indigo-300 rounded p-2 text-indigo-800 text-center text-sm">
                                ✅ Article expédié au réparateur
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <div class="bg-amber-50 border border-amber-200 rounded p-2 text-amber-800 text-xs text-center">
                            ⏳ En attente que l'admin assigne un réparateur
                        </div>
                    <?php endif; ?>
                </div>
            <?php elseif($return && $return->status === 'accepted' && !$quote): ?>
                <div class="space-y-2">
                    <span class="block px-2 py-1 bg-blue-100 text-blue-800 rounded text-center text-sm">
                        ⏳ En attente de devis admin / Envoi magasin
                    </span>
                    <form method="POST" action="<?php echo e(route('store.console.return.send', $console)); ?>">
                        <?php echo csrf_field(); ?>
                        <button class="w-full bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
                            📦 Article envoyé
                        </button>
                    </form>
                </div>
            <?php elseif($return && $return->status === 'sent_to_repairer'): ?>
                <span class="block px-2 py-1 bg-indigo-100 text-indigo-800 rounded text-center text-sm">
                    🚚 Article en transit vers réparateur
                </span>

            <?php elseif($return && $return->status === 'rejected'): ?>
                <div class="bg-red-50 border border-red-200 rounded p-2 text-red-800 text-sm">
                    <div class="font-semibold">❌ SAV refusé</div>
                    <?php if($return->admin_comment): ?>
                        <p class="mt-1 italic text-xs"><?php echo e($return->admin_comment); ?></p>
                    <?php endif; ?>
                </div>

            <?php elseif($return && $return->status === 'pending'): ?>
                <span class="block px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-center text-sm">
                    🕒 En attente validation
                </span>

            <?php else: ?>
                <span class="text-gray-400">—</span>
            <?php endif; ?>

            </td>
        </tr>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
    <tr>
        <td colspan="4" class="p-6 text-center text-gray-500">
            Aucun SAV en cours
        </td>
    </tr>
<?php endif; ?>
</tbody>

        </table>
    </div>

    
    <?php if($externalRepairs->isNotEmpty()): ?>
    <h2 class="text-2xl font-semibold mb-4 mt-10">
        🔧 Réparations externes (hors stock)
    </h2>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Article</th>
                    <th class="p-3">Description</th>
                    <th class="p-3">Statut</th>
                    <th class="p-3">Devis/Actions</th>
                </tr>
            </thead>
            <tbody>
            <?php $__currentLoopData = $externalRepairs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repair): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php
                    $quote = $repair->repairQuote;
                ?>
                <tr class="border-t align-top">
                    <td class="p-3">
                        <div class="font-semibold text-purple-900"><?php echo e($repair->external_item_name); ?></div>
                        <span class="px-2 py-0.5 bg-purple-100 text-purple-800 rounded text-xs">Externe</span>
                    </td>
                    <td class="p-3 text-sm text-gray-700">
                        <?php echo e(Str::limit($repair->external_item_description, 100)); ?>

                    </td>
                    <td class="p-3">
                        <?php if($repair->status === 'pending'): ?>
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">🕒 En attente</span>
                        <?php elseif($repair->status === 'accepted'): ?>
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">✅ Accepté</span>
                        <?php elseif($repair->status === 'rejected'): ?>
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm">❌ Refusé</span>
                        <?php elseif($repair->status === 'sent_to_repairer'): ?>
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded text-sm">🚚 En transit</span>
                        <?php endif; ?>

                        <?php if($repair->admin_comment && $repair->status === 'rejected'): ?>
                            <p class="text-xs text-red-700 mt-1 italic"><?php echo e($repair->admin_comment); ?></p>
                        <?php endif; ?>
                    </td>
                    <td class="p-3">
                        <?php if($quote && $quote->status === 'proposed'): ?>
                            <div class="bg-amber-50 border border-amber-200 rounded p-2">
                                <div class="font-semibold text-amber-900">
                                    Devis : <?php echo e(number_format($quote->amount, 2, ',', ' ')); ?> €
                                </div>
                                <div class="flex gap-2 mt-2">
                                    <form method="POST" action="<?php echo e(route('store.repair.quote.accept', $quote)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                            ✅ Accepter
                                        </button>
                                    </form>
                                    <form method="POST" action="<?php echo e(route('store.repair.quote.reject', $quote)); ?>">
                                        <?php echo csrf_field(); ?>
                                        <button class="bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm hover:bg-gray-400">
                                            ❌ Refuser
                                        </button>
                                    </form>
                                </div>
                            </div>
                        <?php elseif($quote && $quote->status === 'accepted'): ?>
                            <div class="space-y-2">
                                <?php if($repair->repairer_id): ?>
                                    <div class="bg-green-50 border border-green-200 rounded p-2">
                                        <div class="font-semibold text-green-900 text-sm mb-1">
                                            ✅ Réparateur assigné : <?php echo e($repair->repairer->name); ?>

                                        </div>
                                        <div class="text-xs text-green-800">
                                            📍 <?php echo e($repair->repairer->address); ?>

                                        </div>
                                        <?php if($repair->status !== 'sent_to_repairer'): ?>
                                            <form method="POST" action="<?php echo e(route('store.console.return.send.external', $repair)); ?>" class="mt-2">
                                                <?php echo csrf_field(); ?>
                                                <button class="w-full bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700">
                                                    📦 Article envoyé au réparateur
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                <?php else: ?>
                                    <div class="bg-amber-50 border border-amber-200 rounded p-2 text-amber-800 text-xs text-center">
                                        ⏳ En attente que l'admin assigne un réparateur
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>
                            <span class="text-sm text-gray-400">—</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>

</div>

<script>
function toggleSavForm(consoleId) {
    const form = document.getElementById('sav-form-' + consoleId);
    const btn = document.getElementById('sav-btn-' + consoleId);
    
    if (form && btn) {
        form.classList.remove('hidden');
        btn.classList.add('hidden');
    }
}

function cancelSavForm(consoleId) {
    const form = document.getElementById('sav-form-' + consoleId);
    const btn = document.getElementById('sav-btn-' + consoleId);
    
    if (form && btn) {
        form.classList.add('hidden');
        btn.classList.remove('hidden');
    }
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/store/dashboard.blade.php ENDPATH**/ ?>