

<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            🛠️ Réparateurs — <?php echo e($repairer->exists ? "Éditer #{$repairer->id}" : "Créer"); ?>

        </h1>

        <a href="<?php echo e(route('admin.dashboard')); ?>" class="px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour dashboard
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

    <?php if($errors->any()): ?>
        <div class="mb-6 p-4 bg-red-50 text-red-800 rounded border border-red-200">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                <?php echo e($repairer->exists ? "✏️ Modifier le réparateur" : "➕ Créer un réparateur"); ?>

            </h2>

            <form method="POST"
                  action="<?php echo e($repairer->exists ? route('admin.repairers.update', $repairer) : route('admin.repairers.store')); ?>"
                  class="space-y-5">
                <?php echo csrf_field(); ?>
                <?php if($repairer->exists): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom / Société *</label>
                        <input name="name" required
                               value="<?php echo e(old('name', $repairer->name)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div class="flex items-center gap-3 mt-6 md:mt-0">
                        <input id="is_active" type="checkbox" name="is_active" value="1"
                               class="rounded border-gray-300"
                               <?php if(old('is_active', $repairer->exists ? $repairer->is_active : true)): echo 'checked'; endif; ?>>
                        <label for="is_active" class="text-sm text-gray-700">Actif</label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input name="email"
                               value="<?php echo e(old('email', $repairer->email)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                        <input name="phone"
                               value="<?php echo e(old('phone', $repairer->phone)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                        <input name="city"
                               value="<?php echo e(old('city', $repairer->city)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                        <input name="address"
                               value="<?php echo e(old('address', $repairer->address)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Délai moyen (jours)</label>
                        <input type="number" min="0" max="365" name="delay_days_default"
                               value="<?php echo e(old('delay_days_default', $repairer->delay_days_default)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Transport préféré</label>
                        <input name="shipping_method"
                               value="<?php echo e(old('shipping_method', $repairer->shipping_method)); ?>"
                               placeholder="Colissimo, Chronopost, DHL..."
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">TVA</label>
                        <input name="vat_number"
                               value="<?php echo e(old('vat_number', $repairer->vat_number)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">SIRET</label>
                        <input name="siret"
                               value="<?php echo e(old('siret', $repairer->siret)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea name="notes" rows="4"
                              class="w-full rounded border-gray-300"
                              placeholder="Spécialités, conditions, procédures..."><?php echo e(old('notes', $repairer->notes)); ?></textarea>
                </div>

                
                <?php if(!$repairer->exists): ?>
                <div class="border-t pt-4 mt-4 bg-blue-50 rounded p-4">
                    <h3 class="text-lg font-semibold mb-3 text-blue-900">🔐 Accès au dashboard réparateur</h3>
                    <p class="text-sm text-gray-600 mb-3">Créez un compte pour que ce réparateur puisse se connecter et gérer ses consoles</p>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email de connexion *</label>
                            <input type="email" 
                                   name="user_email" 
                                   required
                                   value="<?php echo e(old('user_email')); ?>"
                                   class="w-full rounded border-gray-300"
                                   placeholder="email@exemple.com" />
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe *</label>
                            <input type="password" 
                                   name="user_password" 
                                   required
                                   minlength="8"
                                   class="w-full rounded border-gray-300"
                                   placeholder="Min. 8 caractères" />
                        </div>
                    </div>
                    <p class="text-xs text-gray-500 mt-2">⚠️ Le réparateur pourra se connecter avec cet email et ce mot de passe</p>
                </div>
                <?php endif; ?>

                
                <?php if($repairer->exists): ?>
                <div class="border-t pt-4">
                    <h3 class="text-lg font-semibold mb-3">🔩 Mods disponibles (pièces)</h3>
                    <p class="text-sm text-gray-600 mb-3">Indiquez les quantités des mods que ce réparateur a en stock</p>
                    
                    <?php if(isset($mods) && $mods->count()): ?>
                    <div class="grid grid-cols-2 gap-3 max-h-48 overflow-y-auto border rounded p-3 bg-blue-50">
                        <?php $__currentLoopData = $mods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $currentQuantity = $repairer->mods->where('id', $mod->id)->first()?->pivot->quantity ?? 0;
                            ?>
                            <div class="flex items-center justify-between bg-white p-2 rounded border">
                                <label class="text-sm font-medium flex-1">
                                    <?php echo e($mod->name); ?>

                                    <span class="text-xs text-blue-600">🔩</span>
                                </label>
                                <input type="number" 
                                       name="mods[<?php echo e($mod->id); ?>]" 
                                       value="<?php echo e(old('mods.'.$mod->id, $currentQuantity)); ?>"
                                       min="0"
                                       class="w-20 border rounded px-2 py-1 text-sm"
                                       placeholder="0">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php else: ?>
                    <p class="text-sm text-gray-500 italic">Aucun mod créé.</p>
                    <?php endif; ?>
                </div>

                <div class="border-t pt-4 mt-4">
                    <h3 class="text-lg font-semibold mb-3">📦 Accessoires disponibles</h3>
                    <p class="text-sm text-gray-600 mb-3">Boîtes, câbles, coques, manettes...</p>
                    
                    <?php if(isset($accessories) && $accessories->count()): ?>
                    <div class="grid grid-cols-2 gap-3 max-h-48 overflow-y-auto border rounded p-3 bg-purple-50">
                        <?php $__currentLoopData = $accessories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $accessory): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $currentQuantity = $repairer->mods->where('id', $accessory->id)->first()?->pivot->quantity ?? 0;
                            ?>
                            <div class="flex items-center justify-between bg-white p-2 rounded border">
                                <label class="text-sm font-medium flex-1">
                                    <?php echo e($accessory->name); ?>

                                    <span class="text-xs text-purple-600">📦</span>
                                    <span class="text-xs text-gray-500">(<?php echo e(number_format($accessory->purchase_price, 2)); ?>€)</span>
                                </label>
                                <input type="number" 
                                       name="mods[<?php echo e($accessory->id); ?>]" 
                                       value="<?php echo e(old('mods.'.$accessory->id, $currentQuantity)); ?>"
                                       min="0"
                                       class="w-20 border rounded px-2 py-1 text-sm"
                                       placeholder="0">
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                    <?php else: ?>
                    <p class="text-sm text-gray-500 italic">Aucun accessoire créé. <a href="<?php echo e(route('admin.accessories.create')); ?>" class="text-indigo-600 hover:underline">Créer un accessoire</a></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <div class="flex gap-2">
                    <button class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                        <?php echo e($repairer->exists ? '💾 Mettre à jour' : '💾 Créer'); ?>

                    </button>

                    <?php if($repairer->exists): ?>
                        <a href="<?php echo e(route('admin.repairers.create', ($activeOnly ?? false) ? ['active' => 1] : [])); ?>"
                           class="px-6 py-2 rounded border hover:bg-gray-50">
                            + Nouveau
                        </a>
                    <?php endif; ?>
                </div>
            </form>

            
            <?php if($repairer->exists && isset($operations) && $operations->count()): ?>
            <div class="mt-6 border-t pt-6">
                <form method="POST" action="<?php echo e(route('admin.repairers.operations.update', $repairer)); ?>">
                    <?php echo csrf_field(); ?>
                    
                    <h3 class="text-lg font-semibold mb-3">🔧 Compétences (Opérations)</h3>
                    <p class="text-sm text-gray-600 mb-3">
                        Sélectionnez les opérations que ce réparateur sait effectuer.
                        Il pourra les associer aux articles qu'il répare.
                    </p>
                    
                    <div class="grid grid-cols-2 gap-3 border rounded p-3 bg-orange-50">
                        <?php $__currentLoopData = $operations; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $operation): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $hasSkill = $repairer->operations->contains('id', $operation->id);
                            ?>
                            <label class="flex items-center gap-2 bg-white p-2 rounded border cursor-pointer hover:bg-orange-100 transition">
                                <input type="checkbox" 
                                       name="operations[]" 
                                       value="<?php echo e($operation->id); ?>"
                                       class="rounded border-gray-300 text-orange-600"
                                       <?php if($hasSkill): echo 'checked'; endif; ?>>
                                <span class="text-sm font-medium"><?php echo e($operation->name); ?></span>
                            </label>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <div class="mt-4">
                        <button class="px-6 py-2 rounded bg-orange-600 text-white hover:bg-orange-700">
                            💾 Enregistrer les compétences
                        </button>
                    </div>
                </form>
            </div>
            <?php endif; ?>
        </div>

        
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">📋 Tous les réparateurs</h2>
                    <p class="text-sm text-gray-500">
                        <?php echo e($repairers->count()); ?> affiché(s)<?php echo e(($activeOnly ?? false) ? ' (actifs uniquement)' : ''); ?>

                    </p>
                </div>

                <div class="flex gap-2">
                    <?php if(!($activeOnly ?? false)): ?>
                        <a href="<?php echo e(route('admin.repairers.create', ['active' => 1])); ?>"
                           class="px-3 py-2 rounded bg-gray-900 text-white text-sm hover:bg-black">
                            Actifs uniquement
                        </a>
                    <?php else: ?>
                        <a href="<?php echo e(route('admin.repairers.create')); ?>"
                           class="px-3 py-2 rounded border text-sm hover:bg-gray-50">
                            Afficher tous
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 text-left">Nom</th>
                            <th class="px-3 py-2 text-left">Ville</th>
                            <th class="px-3 py-2 text-center">Actif</th>
                            <th class="px-3 py-2 text-center">Mods</th>
                            <th class="px-3 py-2 text-center">Consoles</th>
                            <th class="px-3 py-2 text-center">Éditer</th>
                            <th class="px-3 py-2 text-center">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $repairers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $r): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-3 py-2 font-medium"><?php echo e($r->name); ?></td>
                                <td class="px-3 py-2"><?php echo e($r->city ?? '—'); ?></td>

                                <td class="px-3 py-2 text-center">
                                    <span class="px-2 py-1 rounded text-white text-xs <?php echo e($r->is_active ? 'bg-green-600' : 'bg-gray-500'); ?>">
                                        <?php echo e($r->is_active ? 'Oui' : 'Non'); ?>

                                    </span>
                                </td>

                                <td class="px-3 py-2 text-center">
                                    <?php
                                        $modsCount = $r->mods()->count();
                                    ?>
                                    <?php if($modsCount > 0): ?>
                                        <span class="px-2 py-1 rounded bg-blue-100 text-blue-800 text-xs font-semibold">
                                            <?php echo e($modsCount); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="text-gray-400">—</span>
                                    <?php endif; ?>
                                </td>

                                <td class="px-3 py-2 text-center">
                                    <?php echo e($r->consoles_count ?? 0); ?>

                                </td>

                                <td class="px-3 py-2 text-center">
                                    <a href="<?php echo e(route('admin.repairers.edit', $r)); ?><?php echo e(($activeOnly ?? false) ? '?active=1' : ''); ?>"
                                       class="text-indigo-600 hover:underline font-medium">
                                        ✏️
                                    </a>
                                </td>

                                <td class="px-3 py-2 text-center">
                                    <?php if(($r->consoles_count ?? 0) > 0): ?>
                                        <span class="text-gray-400 cursor-not-allowed"
                                              title="Suppression impossible : consoles associées">
                                            🗑️
                                        </span>
                                    <?php else: ?>
                                        <form method="POST"
                                              action="<?php echo e(route('admin.repairers.destroy', $r)); ?>"
                                              onsubmit="return confirm('Supprimer ce réparateur ?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                    class="text-red-600 hover:underline font-medium">
                                                🗑️
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-3 py-6 text-center text-gray-500">
                                    Aucun réparateur
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <p class="text-xs text-gray-500 mt-4">
                ℹ️ La suppression est désactivée si un réparateur a des consoles associées.
            </p>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/repairers/create.blade.php ENDPATH**/ ?>