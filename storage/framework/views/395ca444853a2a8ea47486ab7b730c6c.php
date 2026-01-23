<?php $__env->startSection('content'); ?>
<div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">⚙️ Gérer les prix</h1>
            <p class="text-sm text-gray-600 mt-1">
                Article #<?php echo e($console->id); ?>

                — <?php echo e($console->articleType?->name ?? 'Type non défini'); ?>

            </p>
        </div>

        <a href="<?php echo e(route('admin.consoles.index')); ?>"
           class="px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour au stock
        </a>
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

    
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">📦 Informations de l'article</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
            <div>
                <span class="text-gray-500">Catégorie :</span>
                <div class="font-medium"><?php echo e($console->articleCategory?->name ?? '—'); ?></div>
            </div>
            <div>
                <span class="text-gray-500">Sous-catégorie :</span>
                <div class="font-medium"><?php echo e($console->articleSubCategory?->name ?? '—'); ?></div>
            </div>
            <div>
                <span class="text-gray-500">Type :</span>
                <div class="font-medium"><?php echo e($console->articleType?->name ?? '—'); ?></div>
            </div>
            <div>
                <span class="text-gray-500">Statut :</span>
                <div class="font-medium">
                    <span class="px-2 py-1 rounded text-white text-xs
                        <?php if($console->status === 'stock'): ?> bg-green-600
                        <?php elseif($console->status === 'defective'): ?> bg-orange-600
                        <?php elseif($console->status === 'repair'): ?> bg-indigo-600
                        <?php else: ?> bg-gray-600
                        <?php endif; ?>">
                        <?php echo e(ucfirst($console->status)); ?>

                    </span>
                </div>
            </div>
        </div>

        
        <?php
            // Calculer la quote-part des consoles disabled
            $disabledQuotePart = 0;
            if ($console->article_type_id && !in_array($console->status, ['disabled', 'parted_out'])) {
                // Consoles disabled : coût complet
                $disabledTotalCost = \App\Models\Console::where('article_type_id', $console->article_type_id)
                    ->where('status', 'disabled')
                    ->sum('prix_achat');
                
                // Consoles parted_out : prix_achat - valorisation
                $partedOutConsoles = \App\Models\Console::where('article_type_id', $console->article_type_id)
                    ->where('status', 'parted_out')
                    ->get();
                
                foreach ($partedOutConsoles as $partedOut) {
                    $netCost = ($partedOut->prix_achat ?? 0) - ($partedOut->valorisation ?? 0);
                    $disabledTotalCost += max(0, $netCost);
                }
                
                $sellableCount = \App\Models\Console::where('article_type_id', $console->article_type_id)
                    ->whereIn('status', ['stock', 'defective', 'repair', 'vendue'])
                    ->count();
                
                if ($sellableCount > 0 && $disabledTotalCost > 0) {
                    $disabledQuotePart = $disabledTotalCost / $sellableCount;
                }
            }
        ?>
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-sm border-t pt-4 mb-4">
            <div>
                <span class="text-gray-500">Prix d'achat :</span>
                <div class="font-medium"><?php echo e(number_format($console->prix_achat ?? 0, 2, ',', ' ')); ?> €</div>
            </div>
            <div>
                <span class="text-gray-500">Coût mods :</span>
                <div class="font-medium text-blue-600"><?php echo e(number_format($console->mods_cost ?? 0, 2, ',', ' ')); ?> €</div>
            </div>
            <div>
                <span class="text-gray-500">Main d'œuvre :</span>
                <div class="font-medium text-orange-600"><?php echo e(number_format($console->labor_cost ?? 0, 2, ',', ' ')); ?> €</div>
            </div>
            <div>
                <span class="text-gray-500">Quote-part HS :</span>
                <div class="font-medium text-red-600"><?php echo e(number_format($disabledQuotePart, 2, ',', ' ')); ?> €</div>
                <?php if($disabledQuotePart > 0): ?>
                    <div class="text-xs text-gray-500 mt-1">
                        Consoles disabled réparties
                    </div>
                <?php endif; ?>
            </div>
            <div>
                <span class="text-gray-500">Prix de revient :</span>
                <div class="font-semibold text-gray-900 text-lg"><?php echo e(number_format($console->total_cost ?? 0, 2, ',', ' ')); ?> €</div>
            </div>
        </div>

        
        <div class="border-t pt-4 mb-4">
            <div class="flex items-start gap-4">
                <div class="flex-1">
                    <span class="text-gray-500 text-sm">Prix R4E :</span>
                    <form method="POST" action="<?php echo e(route('admin.consoles.update-valorisation', $console)); ?>" class="flex items-center gap-2 mt-1">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('PATCH'); ?>
                        <input type="number" 
                               step="0.01" 
                               min="0" 
                               name="valorisation" 
                               value="<?php echo e(old('valorisation', $console->valorisation)); ?>" 
                               class="w-40 border rounded px-3 py-2 text-sm"
                               placeholder="Prix R4E">
                        <button type="submit" class="px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                            💾 Enregistrer
                        </button>
                    </form>
                    <?php if($console->valorisation): ?>
                        <div class="text-xs text-gray-500 mt-1">Actuel : <?php echo e(number_format($console->valorisation, 2, ',', ' ')); ?> €</div>
                        <?php
                            $totalCost = $console->total_cost ?? 0;
                            $margin = ($console->valorisation ?? 0) - $totalCost;
                            $marginPercent = $totalCost > 0 ? ($margin / $totalCost * 100) : 0;
                        ?>
                        <div class="text-xs mt-1 font-medium
                            <?php if($margin > 0): ?> text-green-600
                            <?php elseif($margin < 0): ?> text-red-600
                            <?php else: ?> text-gray-500
                            <?php endif; ?>">
                            <?php if($margin > 0): ?>
                                ✓ Marge : +<?php echo e(number_format($margin, 2, ',', ' ')); ?> € (+<?php echo e(number_format($marginPercent, 1)); ?>%)
                            <?php elseif($margin < 0): ?>
                                ✗ Perte : <?php echo e(number_format($margin, 2, ',', ' ')); ?> € (<?php echo e(number_format($marginPercent, 1)); ?>%)
                            <?php else: ?>
                                = Prix de revient
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        
        <?php if($console->mods->count() > 0): ?>
        <div class="border-t pt-4">
            <h3 class="font-medium text-gray-700 mb-3">🔧 Mods & Opérations appliqués</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                <?php $__currentLoopData = $console->mods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="flex items-center gap-2 p-2 rounded border
                        <?php if($mod->is_operation): ?> bg-orange-50 border-orange-200
                        <?php elseif($mod->is_accessory): ?> bg-purple-50 border-purple-200
                        <?php else: ?> bg-blue-50 border-blue-200
                        <?php endif; ?>">
                        <?php if($mod->is_operation): ?>
                            <span class="text-orange-500">⚙️</span>
                        <?php elseif($mod->is_accessory): ?>
                            <span class="text-purple-500">📦</span>
                        <?php else: ?>
                            <span class="text-blue-500">🔩</span>
                        <?php endif; ?>
                        <div class="flex-1">
                            <div class="font-medium text-sm"><?php echo e($mod->name); ?></div>
                            <div class="text-xs text-gray-500">
                                <?php if(!$mod->is_operation): ?>
                                    <?php echo e(number_format($mod->pivot->price_applied ?? 0, 2)); ?> €
                                <?php endif; ?>
                                <?php if($mod->pivot->work_time_minutes): ?>
                                    <?php if(!$mod->is_operation): ?> — <?php endif; ?>
                                    <?php echo e($mod->pivot->work_time_minutes); ?> min
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            
            
            <?php
                $totalMinutes = $console->mods->sum('pivot.work_time_minutes');
                $hours = floor($totalMinutes / 60);
                $minutes = $totalMinutes % 60;
            ?>
            <?php if($totalMinutes > 0): ?>
            <div class="mt-3 text-sm text-gray-600">
                ⏱️ Temps de travail total : 
                <span class="font-medium">
                    <?php if($hours > 0): ?><?php echo e($hours); ?>h <?php endif; ?><?php echo e($minutes); ?>min
                </span>
            </div>
            <?php endif; ?>
        </div>
        <?php else: ?>
        <div class="border-t pt-4 text-center text-gray-500 text-sm">
            Aucun mod ou opération appliqué à cet article.
        </div>
        <?php endif; ?>
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Magasin</th>
                    <th class="px-4 py-3 text-center">Prix vente (€)</th>
                    <th class="px-4 py-3 text-center">Prix dépôt (€)</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $store): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        // Récupérer l'offre pour ce magasin
                        $offer = $console->offers->firstWhere('store_id', $store->id);
                        $salePrice = $offer?->sale_price;
                        $consignmentPrice = $offer?->consignment_price;
                        $r4ePrice = $console->valorisation ?? 0;
                        $totalCost = $console->total_cost ?? 0;
                        
                        // Calculer les réductions par rapport au prix R4E
                        $saleDiscount = $salePrice && $r4ePrice > 0 ? $r4ePrice - $salePrice : null;
                        $saleDiscountPercent = $salePrice && $r4ePrice > 0 ? (($r4ePrice - $salePrice) / $r4ePrice * 100) : null;
                        
                        $consignmentDiscount = $consignmentPrice && $r4ePrice > 0 ? $r4ePrice - $consignmentPrice : null;
                        $consignmentDiscountPercent = $consignmentPrice && $r4ePrice > 0 ? (($r4ePrice - $consignmentPrice) / $r4ePrice * 100) : null;
                        
                        // Calculer les marges par rapport au prix de revient
                        $saleMargin = $salePrice && $totalCost > 0 ? $salePrice - $totalCost : null;
                        $saleMarginPercent = $salePrice && $totalCost > 0 ? ($saleMargin / $totalCost * 100) : null;
                        
                        $consignmentMargin = $consignmentPrice && $totalCost > 0 ? $consignmentPrice - $totalCost : null;
                        $consignmentMarginPercent = $consignmentPrice && $totalCost > 0 ? ($consignmentMargin / $totalCost * 100) : null;
                    ?>

                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800"><?php echo e($store->name); ?></div>
                        </td>

                        <form method="POST"
                              action="<?php echo e(route('admin.consoles.prices.store', $console)); ?>"
                              class="contents">
                            <?php echo csrf_field(); ?>
                            <input type="hidden" name="store_id" value="<?php echo e($store->id); ?>">

                            <td class="px-4 py-3 text-center">
                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="sale_price"
                                       value="<?php echo e(old('sale_price', $salePrice)); ?>"
                                       placeholder="Prix vente"
                                       class="w-32 border rounded px-3 py-2 text-sm text-center"
                                       <?php if($console->status !== 'stock'): ?> disabled <?php endif; ?>>
                                <?php if(!is_null($salePrice)): ?>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Actuel : <?php echo e(number_format($salePrice, 2, ',', ' ')); ?> €
                                    </div>
                                    <?php if($saleDiscount !== null && $r4ePrice > 0): ?>
                                        <div class="text-xs mt-1 
                                            <?php if($saleDiscount > 0): ?> text-red-600 
                                            <?php elseif($saleDiscount < 0): ?> text-green-600
                                            <?php else: ?> text-gray-500
                                            <?php endif; ?>">
                                            <?php if($saleDiscount > 0): ?>
                                                ↓ Réduction : <?php echo e(number_format($saleDiscount, 2, ',', ' ')); ?> € (<?php echo e(number_format($saleDiscountPercent, 1)); ?>%)
                                            <?php elseif($saleDiscount < 0): ?>
                                                ↑ Majoration : <?php echo e(number_format(abs($saleDiscount), 2, ',', ' ')); ?> € (+<?php echo e(number_format(abs($saleDiscountPercent), 1)); ?>%)
                                            <?php else: ?>
                                                = Prix R4E
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($saleMargin !== null && $totalCost > 0): ?>
                                        <div class="text-xs mt-1 font-medium
                                            <?php if($saleMargin > 0): ?> text-green-600
                                            <?php elseif($saleMargin < 0): ?> text-red-600
                                            <?php else: ?> text-gray-500
                                            <?php endif; ?>">
                                            <?php if($saleMargin > 0): ?>
                                                ✓ Marge : +<?php echo e(number_format($saleMargin, 2, ',', ' ')); ?> € (+<?php echo e(number_format($saleMarginPercent, 1)); ?>%)
                                            <?php elseif($saleMargin < 0): ?>
                                                ✗ Perte : <?php echo e(number_format($saleMargin, 2, ',', ' ')); ?> € (<?php echo e(number_format($saleMarginPercent, 1)); ?>%)
                                            <?php else: ?>
                                                = Prix de revient
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>

                            <td class="px-4 py-3 text-center">
                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="consignment_price"
                                       value="<?php echo e(old('consignment_price', $consignmentPrice)); ?>"
                                       placeholder="Prix dépôt"
                                       class="w-32 border rounded px-3 py-2 text-sm text-center"
                                       <?php if($console->status !== 'stock'): ?> disabled <?php endif; ?>>
                                <?php if(!is_null($consignmentPrice)): ?>
                                    <div class="text-xs text-gray-500 mt-1">
                                        Actuel : <?php echo e(number_format($consignmentPrice, 2, ',', ' ')); ?> €
                                    </div>
                                    <?php if($consignmentDiscount !== null && $r4ePrice > 0): ?>
                                        <div class="text-xs mt-1 
                                            <?php if($consignmentDiscount > 0): ?> text-red-600 
                                            <?php elseif($consignmentDiscount < 0): ?> text-green-600
                                            <?php else: ?> text-gray-500
                                            <?php endif; ?>">
                                            <?php if($consignmentDiscount > 0): ?>
                                                ↓ Réduction : <?php echo e(number_format($consignmentDiscount, 2, ',', ' ')); ?> € (<?php echo e(number_format($consignmentDiscountPercent, 1)); ?>%)
                                            <?php elseif($consignmentDiscount < 0): ?>
                                                ↑ Majoration : <?php echo e(number_format(abs($consignmentDiscount), 2, ',', ' ')); ?> € (+<?php echo e(number_format(abs($consignmentDiscountPercent), 1)); ?>%)
                                            <?php else: ?>
                                                = Prix R4E
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($consignmentMargin !== null && $totalCost > 0): ?>
                                        <div class="text-xs mt-1 font-medium
                                            <?php if($consignmentMargin > 0): ?> text-green-600
                                            <?php elseif($consignmentMargin < 0): ?> text-red-600
                                            <?php else: ?> text-gray-500
                                            <?php endif; ?>">
                                            <?php if($consignmentMargin > 0): ?>
                                                ✓ Marge : +<?php echo e(number_format($consignmentMargin, 2, ',', ' ')); ?> € (+<?php echo e(number_format($consignmentMarginPercent, 1)); ?>%)
                                            <?php elseif($consignmentMargin < 0): ?>
                                                ✗ Perte : <?php echo e(number_format($consignmentMargin, 2, ',', ' ')); ?> € (<?php echo e(number_format($consignmentMarginPercent, 1)); ?>%)
                                            <?php else: ?>
                                                = Prix de revient
                                            <?php endif; ?>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            </td>

                            <td class="px-4 py-3 text-center">
                                <button
                                    class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700
                                           disabled:opacity-50 disabled:cursor-not-allowed"
                                    <?php if($console->status !== 'stock'): ?> disabled <?php endif; ?>
                                >
                                    💾 Enregistrer
                                </button>
                            </td>
                        </form>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>

        <?php if($console->status !== 'stock'): ?>
            <div class="p-4 bg-yellow-50 text-yellow-800 text-sm">
                ⚠️ Les prix ne peuvent être modifiés que si l’article est en statut <b>stock</b>.
            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/consoles/edit.blade.php ENDPATH**/ ?>