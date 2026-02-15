<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            🏬 Magasins — <?php echo e($store->exists ? "Éditer #{$store->id}" : "Créer"); ?>

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
                <?php echo e($store->exists ? "✏️ Modifier le magasin" : "➕ Créer un magasin"); ?>

            </h2>

            <form method="POST"
                  action="<?php echo e($store->exists ? route('admin.stores.update', $store) : route('admin.stores.store')); ?>"
                  class="space-y-5">
                <?php echo csrf_field(); ?>
                <?php if($store->exists): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom *</label>
                        <input name="name" required
                               value="<?php echo e(old('name', $store->name)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                        <input name="email" type="email" required
                               value="<?php echo e(old('email', $store->email)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                        <input name="phone"
                               value="<?php echo e(old('phone', $store->phone)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ville *</label>
                        <input name="city" required
                               value="<?php echo e(old('city', $store->city)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Code postal</label>
                        <input name="postal_code"
                               value="<?php echo e(old('postal_code', $store->postal_code)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                        <input name="address"
                               value="<?php echo e(old('address', $store->address)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">SIRET</label>
                        <input name="siret" maxlength="14"
                               value="<?php echo e(old('siret', $store->siret)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">N° TVA</label>
                        <input name="vat_number"
                               value="<?php echo e(old('vat_number', $store->vat_number)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Responsable</label>
                        <input name="manager_name"
                               value="<?php echo e(old('manager_name', $store->manager_name)); ?>"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Actif</label>
                        <select name="is_active" class="w-full rounded border-gray-300">
                            <option value="1" <?php if(old('is_active', $store->is_active ?? true)): echo 'selected'; endif; ?>>Oui</option>
                            <option value="0" <?php if(old('is_active', $store->is_active) === false): echo 'selected'; endif; ?>>Non</option>
                        </select>
                    </div>

                    <?php if (! ($store->exists)): ?>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe initial *</label>
                            <input name="password" type="password" required class="w-full rounded border-gray-300" />
                            <p class="text-xs text-gray-500 mt-1">Le magasin pourra le modifier après connexion</p>
                        </div>
                    <?php endif; ?>
                </div>

                <div class="grid grid-cols-1 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Horaires d'ouverture</label>
                        <textarea name="opening_hours" rows="2" class="w-full rounded border-gray-300"><?php echo e(old('opening_hours', $store->opening_hours)); ?></textarea>
                        <p class="text-xs text-gray-500 mt-1">Ex: Lun-Ven 9h-18h, Sam 10h-17h</p>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Notes internes</label>
                        <textarea name="notes" rows="3" class="w-full rounded border-gray-300"><?php echo e(old('notes', $store->notes)); ?></textarea>
                    </div>
                </div>

                <div class="flex gap-2">
                    <button class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                        <?php echo e($store->exists ? '💾 Mettre à jour' : '💾 Créer'); ?>

                    </button>

                    <?php if($store->exists): ?>
                        <a href="<?php echo e(route('admin.stores.create')); ?>"
                           class="px-6 py-2 rounded border hover:bg-gray-50">
                            + Nouveau
                        </a>
                    <?php endif; ?>
                </div>
            </form>
        </div>

        
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">📋 Tous les magasins</h2>
                    <p class="text-sm text-gray-500">
                        <?php echo e($stores->count()); ?> affiché(s)
                    </p>
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 text-left">Nom</th>
                            <th class="px-3 py-2 text-left">Ville</th>
                            <th class="px-3 py-2 text-left">Email</th>
                            <th class="px-3 py-2 text-center">Consoles</th>
                            <th class="px-3 py-2 text-center">Factures</th>
                            <th class="px-3 py-2 text-center">Éditer</th>
                            <th class="px-3 py-2 text-center">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        <?php $__empty_1 = true; $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-3 py-2 font-medium"><?php echo e($s->name); ?></td>
                                <td class="px-3 py-2"><?php echo e($s->city ?? '—'); ?></td>
                                <td class="px-3 py-2"><?php echo e($s->email ?? '—'); ?></td>

                                <td class="px-3 py-2 text-center"><?php echo e($s->consoles_count ?? 0); ?></td>
                                <td class="px-3 py-2 text-center"><?php echo e($s->invoices_count ?? 0); ?></td>

                                <td class="px-3 py-2 text-center">
                                    <a href="<?php echo e(route('admin.stores.edit', $s)); ?>" class="text-indigo-600 hover:underline font-medium">✏️</a>
                                </td>

                                <td class="px-3 py-2 text-center">
                                    <?php if(($s->consoles_count ?? 0) > 0 || ($s->invoices_count ?? 0) > 0): ?>
                                        <span class="text-gray-400 cursor-not-allowed" title="Suppression impossible : données associées">🗑️</span>
                                    <?php else: ?>
                                        <form method="POST" action="<?php echo e(route('admin.stores.destroy', $s)); ?>" onsubmit="return confirm('Supprimer ce magasin ?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="text-red-600 hover:underline font-medium">🗑️</button>
                                        </form>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="7" class="px-3 py-6 text-center text-gray-500">Aucun magasin</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <p class="text-xs text-gray-500 mt-4">ℹ️ La suppression est désactivée si le magasin a des consoles ou factures associées.</p>
        </div>

    </div>
</div>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/stores/create.blade.php ENDPATH**/ ?>