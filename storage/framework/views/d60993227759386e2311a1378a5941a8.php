

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-10 px-6">

    
    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="<?php echo e(route('admin.repairers.index')); ?>" class="text-indigo-600 hover:underline text-sm mb-2 inline-block">
                ← Retour à la liste
            </a>
            <h1 class="text-3xl font-bold flex items-center gap-3">
                🔧 <?php echo e($repairer->name); ?>

                <?php if($repairer->is_active): ?>
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full font-medium">Actif</span>
                <?php else: ?>
                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full font-medium">Inactif</span>
                <?php endif; ?>
            </h1>
        </div>
        <a href="<?php echo e(route('admin.repairers.edit', $repairer)); ?>" 
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            ✏️ Modifier
        </a>
    </div>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Contact</h3>
                <?php if($repairer->email): ?>
                    <p class="text-gray-900">✉️ <?php echo e($repairer->email); ?></p>
                <?php endif; ?>
                <?php if($repairer->phone): ?>
                    <p class="text-gray-900">📞 <?php echo e($repairer->phone); ?></p>
                <?php endif; ?>
                <?php if(!$repairer->email && !$repairer->phone): ?>
                    <p class="text-gray-400 italic">Non renseigné</p>
                <?php endif; ?>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Adresse</h3>
                <?php if($repairer->city || $repairer->address): ?>
                    <p class="text-gray-900">📍 <?php echo e($repairer->address); ?></p>
                    <p class="text-gray-900"><?php echo e($repairer->city); ?></p>
                <?php else: ?>
                    <p class="text-gray-400 italic">Non renseignée</p>
                <?php endif; ?>
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Infos</h3>
                <?php if($repairer->delay_days_default): ?>
                    <p class="text-gray-700">⏱️ Délai moyen: <?php echo e($repairer->delay_days_default); ?> jours</p>
                <?php endif; ?>
                <?php if($repairer->shipping_method): ?>
                    <p class="text-gray-700">📦 <?php echo e($repairer->shipping_method); ?></p>
                <?php endif; ?>
                <?php if($repairer->siret): ?>
                    <p class="text-gray-500 text-sm">SIRET: <?php echo e($repairer->siret); ?></p>
                <?php endif; ?>
            </div>
        </div>
        <?php if($repairer->notes): ?>
            <div class="mt-4 pt-4 border-t border-gray-100">
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Notes</h3>
                <p class="text-gray-700"><?php echo e($repairer->notes); ?></p>
            </div>
        <?php endif; ?>
    </div>

    
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 text-center">
            <p class="text-3xl font-bold text-gray-900"><?php echo e($stats['total']); ?></p>
            <p class="text-sm text-gray-500 mt-1">Consoles affectées</p>
        </div>
        <div class="bg-orange-50 rounded-xl border border-orange-100 p-5 text-center">
            <p class="text-3xl font-bold text-orange-600"><?php echo e($stats['repair']); ?></p>
            <p class="text-sm text-orange-600 mt-1">En réparation</p>
        </div>
        <div class="bg-green-50 rounded-xl border border-green-100 p-5 text-center">
            <p class="text-3xl font-bold text-green-600"><?php echo e($stats['stock']); ?></p>
            <p class="text-sm text-green-600 mt-1">Réparées (stock)</p>
        </div>
        <div class="bg-red-50 rounded-xl border border-red-100 p-5 text-center">
            <p class="text-3xl font-bold text-red-600"><?php echo e($stats['defective']); ?></p>
            <p class="text-sm text-red-600 mt-1">Défectueuses</p>
        </div>
    </div>

    
    <?php if($repairer->mods->count() > 0): ?>
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">🧰 Mods en stock chez ce réparateur</h2>
        <div class="flex flex-wrap gap-2">
            <?php $__currentLoopData = $repairer->mods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm">
                    <?php echo e($mod->name); ?> 
                    <span class="font-bold">(<?php echo e($mod->pivot->quantity); ?>)</span>
                </span>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    </div>
    <?php endif; ?>

    
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">📦 Consoles affectées</h2>
        </div>

        <?php if($consoles->count() > 0): ?>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">ID</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">Type</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">Statut</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">Magasin</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">Commentaire</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">Date</th>
                            <th class="px-4 py-3 text-right font-medium text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__currentLoopData = $consoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-mono text-gray-900">#<?php echo e($console->id); ?></td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900"><?php echo e($console->articleType->name ?? '—'); ?></div>
                                    <div class="text-xs text-gray-500"><?php echo e($console->articleCategory->name ?? ''); ?></div>
                                </td>
                                <td class="px-4 py-3">
                                    <?php
                                        $statusColors = [
                                            'stock' => 'bg-green-100 text-green-800',
                                            'repair' => 'bg-orange-100 text-orange-800',
                                            'defective' => 'bg-red-100 text-red-800',
                                            'disabled' => 'bg-gray-100 text-gray-600',
                                        ];
                                        $statusLabels = [
                                            'stock' => 'Stock',
                                            'repair' => 'Réparation',
                                            'defective' => 'Défectueuse',
                                            'disabled' => 'Désactivée',
                                        ];
                                    ?>
                                    <span class="px-2 py-1 rounded-full text-xs font-medium <?php echo e($statusColors[$console->status] ?? 'bg-gray-100 text-gray-600'); ?>">
                                        <?php echo e($statusLabels[$console->status] ?? $console->status); ?>

                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    <?php echo e($console->store->name ?? '—'); ?>

                                </td>
                                <td class="px-4 py-3 text-gray-600 max-w-xs truncate" title="<?php echo e($console->commentaire_reparateur); ?>">
                                    <?php echo e(Str::limit($console->commentaire_reparateur, 40) ?? '—'); ?>

                                </td>
                                <td class="px-4 py-3 text-gray-500 text-xs">
                                    <?php echo e($console->created_at->format('d/m/Y')); ?>

                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="<?php echo e(route('admin.articles.edit_full', $console)); ?>" 
                                       class="text-indigo-600 hover:text-indigo-800 text-sm">
                                        Éditer →
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                </table>
            </div>

            
            <?php if($consoles->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-100">
                    <?php echo e($consoles->links()); ?>

                </div>
            <?php endif; ?>
        <?php else: ?>
            <div class="px-6 py-12 text-center text-gray-500">
                Aucune console affectée à ce réparateur.
            </div>
        <?php endif; ?>
    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/repairers/show.blade.php ENDPATH**/ ?>