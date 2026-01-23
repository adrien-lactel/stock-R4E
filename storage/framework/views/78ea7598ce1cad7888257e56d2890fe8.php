<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="mb-6">
        <a href="<?php echo e(route('admin.mods.index')); ?>" class="text-blue-600 hover:underline">
            ← Retour au catalogue
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-6">📤 Distribuer les Mods aux Réparateurs</h1>

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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Mod</th>
                            <th class="p-3 text-left">Type</th>
                            <th class="p-3 text-center">Stock Central</th>
                            <th class="p-3 text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__empty_1 = true; $__currentLoopData = $mods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="border-t">
                                <td class="p-3 font-semibold"><?php echo e($mod->name); ?></td>
                                <td class="p-3">
                                    <?php if($mod->is_accessory): ?>
                                        <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs">
                                            📦 Accessoire
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                            🔧 Modification
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-3 text-center">
                                    <?php if($mod->quantity == 0): ?>
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">
                                            Rupture (0)
                                        </span>
                                    <?php elseif($mod->quantity < 5): ?>
                                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-xs font-semibold">
                                            Stock bas (<?php echo e($mod->quantity); ?>)
                                        </span>
                                    <?php else: ?>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">
                                            ✅ <?php echo e($mod->quantity); ?>

                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="p-3 text-center">
                                    <?php if($mod->quantity > 0): ?>
                                        <button type="button" 
                                                onclick="document.getElementById('form-<?php echo e($mod->id); ?>').classList.toggle('hidden')"
                                                class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                            Envoyer
                                        </button>
                                    <?php else: ?>
                                        <span class="text-gray-400 text-sm">Stock épuisé</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            
                            <tr id="form-<?php echo e($mod->id); ?>" class="hidden bg-blue-50">
                                <td colspan="4" class="p-4">
                                    <form method="POST" action="<?php echo e(route('admin.mods.send-to-repairer', $mod)); ?>" class="space-y-3">
                                        <?php echo csrf_field(); ?>
                                        
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-sm font-medium mb-1">Réparateur *</label>
                                                <select name="repairer_id" required class="w-full border rounded p-2">
                                                    <option value="">-- Choisir un réparateur --</option>
                                                    <?php $__currentLoopData = $repairers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repairer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($repairer->id); ?>">
                                                            <?php echo e($repairer->name); ?> 
                                                            <?php if($repairer->city): ?> (<?php echo e($repairer->city); ?>) <?php endif; ?>
                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium mb-1">
                                                    Quantité * (Max: <?php echo e($mod->quantity); ?>)
                                                </label>
                                                <input type="number" 
                                                       name="quantity" 
                                                       min="1"
                                                       max="<?php echo e($mod->quantity); ?>"
                                                       required
                                                       class="w-full border rounded p-2">
                                            </div>
                                        </div>

                                        <div class="flex gap-2">
                                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                                ✅ Envoyer
                                            </button>
                                            <button type="button"
                                                    onclick="document.getElementById('form-<?php echo e($mod->id); ?>').classList.add('hidden')"
                                                    class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                                                Annuler
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="p-6 text-center text-gray-500">
                                    Aucun mod enregistré.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

        
        <div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">📊 Stock par Réparateur</h2>
                
                <?php $__empty_1 = true; $__currentLoopData = $repairers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $repairer): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php
                        $totalMods = $repairer->mods()->sum('mod_repairer.quantity');
                    ?>
                    <div class="mb-4 p-3 border rounded bg-gray-50">
                        <div class="font-semibold text-sm"><?php echo e($repairer->name); ?></div>
                        <div class="text-xs text-gray-600 mb-2"><?php echo e($repairer->city ?? '—'); ?></div>
                        
                        <?php if($totalMods > 0): ?>
                            <div class="text-sm">
                                <span class="font-semibold text-blue-600"><?php echo e($totalMods); ?></span> mod(s)
                            </div>
                            <div class="mt-2 text-xs space-y-1">
                                <?php $__currentLoopData = $repairer->mods()->get(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex justify-between">
                                        <span class="truncate"><?php echo e($mod->name); ?></span>
                                        <span class="font-semibold">×<?php echo e($mod->pivot->quantity); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php else: ?>
                            <div class="text-xs text-gray-400 italic">
                                Aucun mod fourni
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <p class="text-sm text-gray-500">Aucun réparateur enregistré.</p>
                <?php endif; ?>
            </div>
        </div>

    </div>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/mods/distribute.blade.php ENDPATH**/ ?>