<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-10 px-6">

    
    <h1 class="text-3xl font-bold mb-8">
        Tableau de bord administrateur
    </h1>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Bienvenue sur Stock R4E</h2>
        <p class="text-gray-600 mb-4">
            Vous êtes connecté en tant qu'administrateur.
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-500">
                <h3 class="font-semibold text-blue-900 text-lg">📦 Mods & Accessoires</h3>
                <p class="text-blue-700 mt-3 text-2xl font-bold"><?php echo e($mods->count()); ?></p>
                <p class="text-blue-600 text-sm mt-2">Articles en stock</p>
            </div>
            <div class="bg-green-50 p-6 rounded-lg border-l-4 border-green-500">
                <h3 class="font-semibold text-green-900 text-lg">🔧 Réparateurs</h3>
                <p class="text-green-700 mt-3 text-2xl font-bold"><?php echo e($repairers->count()); ?></p>
                <p class="text-green-600 text-sm mt-2">Réparateurs actifs</p>
            </div>
        </div>
    </div>

    
    <?php if(!empty($sections)): ?>
    <div class="mt-10 space-y-8">
        <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div>
                <div class="flex items-center justify-between mb-3">
                    <h2 class="text-2xl font-bold"><?php echo e($section['title']); ?></h2>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5">
                    <?php $__currentLoopData = $section['cards']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $card): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $isDisabled = !empty($card['disabled']) || empty($card['route']);
                            $cardClasses = 'relative group bg-white border border-gray-100 rounded-2xl p-5 shadow-sm transition duration-200 h-full flex flex-col';
                            $cardClasses .= $isDisabled ? ' opacity-60 cursor-not-allowed' : ' hover:shadow-lg';
                        ?>
                        <?php if($isDisabled): ?>
                            <div class="<?php echo e($cardClasses); ?>">
                        <?php else: ?>
                            <a href="<?php echo e(route($card['route'], $card['params'] ?? [])); ?>" class="<?php echo e($cardClasses); ?>">
                        <?php endif; ?>
                                <div class="flex items-start justify-between">
                                    <div>
                                        <p class="text-xs font-semibold uppercase tracking-wide text-gray-400"><?php echo e($card['subtitle'] ?? 'Administration'); ?></p>
                                        <p class="text-xl font-semibold text-gray-900 mt-1"><?php echo e($card['title']); ?></p>
                                    </div>
                                    <span class="text-3xl" aria-hidden="true"><?php echo e($card['icon'] ?? '📌'); ?></span>
                                </div>
                                <p class="text-sm text-gray-500 mt-4 leading-relaxed flex-1"><?php echo e($card['description'] ?? ''); ?></p>
                                <?php if(!$isDisabled): ?>
                                <div class="mt-5 flex items-center text-indigo-600 font-semibold text-sm">
                                    <span>Accéder</span>
                                    <svg class="w-4 h-4 ms-1 transition transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                                    </svg>
                                </div>
                                <?php endif; ?>
                                <?php if(!empty($card['badge'])): ?>
                                    <span class="absolute top-4 right-4 text-[10px] font-semibold px-2 py-0.5 rounded-full <?php echo e($card['badge_style'] ?? 'bg-gray-100 text-gray-700'); ?>">
                                        <?php echo e($card['badge']); ?>

                                    </span>
                                <?php endif; ?>
                                <?php if(!empty($card['tag'])): ?>
                                    <span class="absolute top-4 right-4 text-[10px] font-semibold px-2 py-0.5 rounded-full bg-yellow-100 text-yellow-800">
                                        <?php echo e($card['tag']); ?>

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

    
    <div class="mt-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">📦 Stock Mods/Accessoires</h2>
            <a href="<?php echo e(route('admin.mods.index')); ?>" class="text-blue-600 hover:underline">
                Voir tout le catalogue →
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Nom</th>
                        <th class="p-3 text-left">Type</th>
                        <th class="p-3 text-left">Prix achat</th>
                        <th class="p-3 text-left">Stock</th>
                        <th class="p-3 text-left">Compatibilité</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $mods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t">
                            <td class="p-3 font-semibold"><?php echo e($mod->name); ?></td>
                            <td class="p-3">
                                <?php if($mod->is_accessory): ?>
                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs">📦 Accessoire</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">🔧 Modification</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3">
                                <?php if(!is_null($mod->purchase_price)): ?>
                                    <?php echo e(number_format($mod->purchase_price, 2, ',', ' ')); ?> €
                                <?php else: ?>
                                    <span class="text-gray-400">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3">
                                <?php if($mod->quantity == 0): ?>
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm font-semibold">⚠️ Rupture</span>
                                <?php elseif($mod->quantity < 5): ?>
                                    <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-sm font-semibold">⚡ Stock bas (<?php echo e($mod->quantity); ?>)</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm font-semibold">✅ <?php echo e($mod->quantity); ?></span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 text-xs text-gray-600">
                                <?php
                                    $compatibilities = $mod->compatibleTypes->pluck('name');
                                ?>
                                <?php if($compatibilities->isNotEmpty()): ?>
                                    <?php echo e($compatibilities->take(2)->join(', ')); ?>

                                    <?php if($compatibilities->count() > 2): ?>
                                        <span class="text-gray-400">+<?php echo e($compatibilities->count() - 2); ?></span>
                                    <?php endif; ?>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">Universel</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Aucun mod enregistré. <a href="<?php echo e(route('admin.mods.create')); ?>" class="text-blue-600 hover:underline">Créez-en un</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="mt-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">🔧 Réparateurs actifs</h2>
            <a href="<?php echo e(route('admin.repairers.index')); ?>" class="text-blue-600 hover:underline">
                Voir tous les réparateurs →
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Nom</th>
                        <th class="p-3 text-left">Ville</th>
                        <th class="p-3 text-left">Contact</th>
                        <th class="p-3 text-center">Consoles en cours</th>
                        <th class="p-3 text-center">Actif</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $repairers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repairer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="border-t">
                            <td class="p-3 font-semibold"><?php echo e($repairer->name); ?></td>
                            <td class="p-3"><?php echo e($repairer->city ?? '—'); ?></td>
                            <td class="p-3 text-sm text-gray-600">
                                <?php if($repairer->phone): ?>
                                    <div>☎ <?php echo e($repairer->phone); ?></div>
                                <?php endif; ?>
                                <?php if($repairer->email): ?>
                                    <div class="text-xs">✉ <?php echo e($repairer->email); ?></div>
                                <?php endif; ?>
                                <?php if(!$repairer->phone && !$repairer->email): ?>
                                    <span class="text-gray-400">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 text-center">
                                <?php if($repairer->consoles_count > 0): ?>
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded font-semibold"><?php echo e($repairer->consoles_count); ?></span>
                                <?php else: ?>
                                    <span class="text-gray-400">0</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 text-center">
                                <?php if($repairer->is_active): ?>
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">✅ Oui</span>
                                <?php else: ?>
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">❌ Non</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Aucun réparateur enregistré. <a href="<?php echo e(route('admin.repairers.create')); ?>" class="text-blue-600 hover:underline">Créez-en un</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    
    <div class="mt-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">📦 Demandes de lots en attente</h2>
            <a href="<?php echo e(route('admin.lot-requests.index')); ?>" class="text-blue-600 hover:underline">
                Voir toutes les demandes →
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Magasin</th>
                        <th class="p-3 text-left">Console</th>
                        <th class="p-3 text-left">Quantité</th>
                        <th class="p-3 text-left">Prix unitaire</th>
                        <th class="p-3 text-left">Demandé</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__empty_1 = true; $__currentLoopData = $lotRequests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $request): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <?php
                            $offer = $request->consoleOffer;
                            $console = $offer?->console;
                        ?>
                        <tr class="border-t">
                            <td class="p-3 font-semibold">
                                <?php echo e($request->store->name); ?>

                                <div class="text-xs text-gray-500"><?php echo e($request->store->city ?? 'Ville inconnue'); ?></div>
                            </td>
                            <td class="p-3 text-sm text-gray-700">
                                <?php if($console): ?>
                                    <div class="font-mono text-sm">#<?php echo e($console->id); ?> <?php echo e($console->serial_number ?? ''); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo e($console->articleType->name ?? 'Type non défini'); ?></div>
                                <?php else: ?>
                                    <span class="text-gray-400 italic">Console indisponible</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3">
                                <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded font-semibold">
                                    <?php echo e($request->quantity); ?>

                                </span>
                            </td>
                            <td class="p-3">
                                <?php if($offer): ?>
                                    <?php echo e(number_format($offer->sale_price, 2, ',', ' ')); ?> €
                                <?php else: ?>
                                    <span class="text-gray-400">—</span>
                                <?php endif; ?>
                            </td>
                            <td class="p-3 text-sm text-gray-600">
                                <?php echo e($request->created_at->diffForHumans()); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Aucune demande en attente. <a href="<?php echo e(route('admin.lot-requests.index')); ?>" class="text-blue-600 hover:underline">Voir l'historique complet</a>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<?php $__env->stopSection(); ?>




<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>