

<?php $__env->startSection('header'); ?>
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        🐛 Bugs & Demandes d'évolution
    </h2>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-blue-400"><?php echo e($stats['total']); ?></div>
                    <div class="text-sm text-gray-400">Total</div>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-yellow-400"><?php echo e($stats['pending']); ?></div>
                    <div class="text-sm text-gray-400">En attente</div>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-indigo-400"><?php echo e($stats['in_progress']); ?></div>
                    <div class="text-sm text-gray-400">En cours</div>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-green-400"><?php echo e($stats['completed']); ?></div>
                    <div class="text-sm text-gray-400">Terminées</div>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-red-400"><?php echo e($stats['bugs']); ?></div>
                    <div class="text-sm text-gray-400">Bugs</div>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-purple-400"><?php echo e($stats['features']); ?></div>
                    <div class="text-sm text-gray-400">Évolutions</div>
                </div>
            </div>

            
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-200 mb-4">➕ Nouvelle demande</h3>
                
                <form method="POST" action="<?php echo e(route('admin.feature-requests.store')); ?>" class="space-y-4">
                    <?php echo csrf_field(); ?>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Type</label>
                            <select name="type" required class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200">
                                <option value="bug">🐛 Bug</option>
                                <option value="feature">✨ Évolution</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Priorité</label>
                            <select name="priority" required class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200">
                                <option value="low">🟢 Basse</option>
                                <option value="medium" selected>🟡 Moyenne</option>
                                <option value="high">🔴 Haute</option>
                            </select>
                        </div>
                        
                        <div class="flex items-end">
                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-medium">
                                Créer la demande
                            </button>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Titre</label>
                        <input type="text" name="title" required maxlength="255" 
                               class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200"
                               placeholder="Ex: Erreur lors de l'ajout d'un mod">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                        <textarea name="description" required rows="3" 
                                  class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200"
                                  placeholder="Décrivez le bug ou la fonctionnalité demandée..."></textarea>
                    </div>
                </form>
            </div>

            
            <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Titre</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Description</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Priorité</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Statut</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Créé par</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Date</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        <?php $__empty_1 = true; $__currentLoopData = $requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $req): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-750 transition">
                                <td class="px-4 py-3 text-center">
                                    <?php if($req->type === 'bug'): ?>
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-800">
                                            🐛 Bug
                                        </span>
                                    <?php else: ?>
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-purple-100 text-purple-800">
                                            ✨ Évolution
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-200"><?php echo e($req->title); ?></div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm text-gray-400 max-w-md truncate"><?php echo e($req->description); ?></div>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <?php if($req->priority === 'high'): ?>
                                        <span class="text-red-400">🔴 Haute</span>
                                    <?php elseif($req->priority === 'medium'): ?>
                                        <span class="text-yellow-400">🟡 Moyenne</span>
                                    <?php else: ?>
                                        <span class="text-green-400">🟢 Basse</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form method="POST" action="<?php echo e(route('admin.feature-requests.update-status', $req)); ?>" class="inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PATCH'); ?>
                                        <select name="status" onchange="this.form.submit()" 
                                                class="rounded text-xs border-0 
                                                <?php if($req->status === 'pending'): ?> bg-yellow-100 text-yellow-800
                                                <?php elseif($req->status === 'in_progress'): ?> bg-indigo-100 text-indigo-800
                                                <?php else: ?> bg-green-100 text-green-800 <?php endif; ?>">
                                            <option value="pending" <?php if($req->status === 'pending'): echo 'selected'; endif; ?>>⏳ En attente</option>
                                            <option value="in_progress" <?php if($req->status === 'in_progress'): echo 'selected'; endif; ?>>🔄 En cours</option>
                                            <option value="completed" <?php if($req->status === 'completed'): echo 'selected'; endif; ?>>✅ Terminé</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-400">
                                    <?php echo e($req->creator->name ?? 'N/A'); ?>

                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-400">
                                    <?php echo e($req->created_at->format('d/m/Y')); ?>

                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form method="POST" action="<?php echo e(route('admin.feature-requests.destroy', $req)); ?>" 
                                          onsubmit="return confirm('Supprimer cette demande ?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-400 hover:text-red-300">
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="8" class="px-4 py-8 text-center text-gray-500">
                                    Aucune demande pour le moment
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/feature-requests/index.blade.php ENDPATH**/ ?>