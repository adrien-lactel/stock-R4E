<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📦 Liste stock</h1>

        <div class="flex items-center gap-3">
            <a href="<?php echo e(route('admin.product-sheets.index')); ?>"
               class="inline-flex items-center px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                🖼️ Fiches produits
            </a>
            <a href="<?php echo e(route('admin.articles.create')); ?>"
               class="inline-flex items-center px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                ➕ Ajouter un article
            </a>
        </div>
    </div>

    
    <?php if(session('success')): ?>
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            <?php echo e(session('success')); ?>

        </div>
    <?php endif; ?>

    
    <form method="GET" class="mb-6 flex flex-wrap gap-3 items-end">
        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
            <input type="text" name="q" value="<?php echo e(request('q')); ?>"
                   placeholder="Serial, provenance, stockage…"
                   class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
            <select id="filter_category" name="category" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Toutes</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php if((string)request('category') === (string)$cat->id): echo 'selected'; endif; ?>><?php echo e($cat->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sous-catégorie</label>
            <select id="filter_subcategory" name="sub_category" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Toutes</option>
            </select>
        </div>

        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
            <select id="filter_type" name="type" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Tous</option>
                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($type->id); ?>" <?php if((string)request('type') === (string)$type->id): echo 'selected'; endif; ?>>
                        <?php echo e($type->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
            <select name="status"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Tous</option>
                <option value="stock" <?php if(request('status')==='stock'): echo 'selected'; endif; ?>>stock</option>
                <option value="defective" <?php if(request('status')==='defective'): echo 'selected'; endif; ?>>defective</option>
                <option value="repair" <?php if(request('status')==='repair'): echo 'selected'; endif; ?>>repair</option>
                <option value="disabled" <?php if(request('status')==='disabled'): echo 'selected'; endif; ?>>disabled</option>
            </select>
        </div>

        
        <?php if(isset($stores)): ?>
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Magasin</label>
            <select name="store_id"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Tous</option>
                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($s->id); ?>" <?php if((string)request('store_id') === (string)$s->id): echo 'selected'; endif; ?>>
                        <?php echo e($s->name); ?>

                    </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <?php endif; ?>

        <div class="flex gap-2">
            <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                Filtrer
            </button>
            <a href="<?php echo e(route('admin.consoles.index')); ?>" class="px-4 py-2 rounded border">
                Reset
            </a>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
      const cat = document.getElementById('filter_category');
      const sub = document.getElementById('filter_subcategory');
      const type = document.getElementById('filter_type');
      if (!cat || !sub || !type) return;

      async function fetchJson(url) {
        try {
          const r = await fetch(url, { headers: { 'Accept': 'application/json' } });
          if (!r.ok) throw new Error(`HTTP ${r.status}`);
          return await r.json();
        } catch (e) {
          console.error('fetchJson error', e);
          return [];
        }
      }

      const SUBS_URL_TEMPLATE = `<?php echo e(route('admin.ajax.sub-categories', ['category' => '__ID__'])); ?>`;
      const TYPES_URL_TEMPLATE = `<?php echo e(route('admin.ajax.types', ['subCategory' => '__ID__'])); ?>`;

      async function loadSubs(catId, applyOld = false) {
        sub.innerHTML = '<option value="">Toutes</option>';
        type.innerHTML = '<option value="">Tous</option>';
        if (!catId) return;
        const url = SUBS_URL_TEMPLATE.replace('__ID__', catId);
        const data = await fetchJson(url);
        const list = Array.isArray(data) ? data : (data.data ?? []);
        list.forEach(s => {
          const opt = document.createElement('option'); opt.value = s.id; opt.textContent = s.name; sub.appendChild(opt);
        });
        if (applyOld && <?php echo json_encode(request('sub_category'), 15, 512) ?>) {
          try { sub.value = String(<?php echo json_encode(request('sub_category'), 15, 512) ?>); } catch(e){}
        }
      }

      async function loadTypes(subId, applyOld = false) {
        type.innerHTML = '<option value="">Tous</option>';
        if (!subId) return;
        const url = TYPES_URL_TEMPLATE.replace('__ID__', subId);
        const data = await fetchJson(url);
        const list = Array.isArray(data) ? data : (data.data ?? []);
        list.forEach(t => { const opt = document.createElement('option'); opt.value = t.id; opt.textContent = t.name; type.appendChild(opt); });
        if (applyOld && <?php echo json_encode(request('type'), 15, 512) ?>) { try { type.value = String(<?php echo json_encode(request('type'), 15, 512) ?>); } catch(e){} }
      }

      cat.addEventListener('change', async () => { await loadSubs(cat.value, false); });
      sub.addEventListener('change', async () => { await loadTypes(sub.value, false); });

      // Init
      (async () => {
        if (cat.value) {
          await loadSubs(cat.value, true);
          if (sub.value) { await loadTypes(sub.value, true); }
        }
      })();
    });
    </script>
    </form>

    
    <div class="bg-pink-50 shadow rounded-lg overflow-hidden border border-pink-100 overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-pink-100">
                <tr>
                    <th class="px-4 py-3 text-center">ID</th>
                    <th class="px-4 py-3 text-left">Catégorie / Sous-cat. / Type</th>
                    <th class="px-4 py-3 text-left">Localisation</th>
                    <th class="px-4 py-3 text-center">Statut</th>
                    <th class="px-4 py-3 text-right">Prix achat</th>
                    <th class="px-4 py-3 text-right">Coût répa.</th>
                    <th class="px-4 py-3 text-right">Prix revient</th>
                    <th class="px-4 py-3 text-right">Prix R4E</th>
                    <th class="px-4 py-3 text-center">Modifier statut</th>
                    <th class="px-4 py-3 text-center w-[180px] whitespace-nowrap">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-pink-100">
            <tbody class="divide-y divide-gray-200">
                <?php $__empty_1 = true; $__currentLoopData = $consoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <?php $hasMods = $console->mods_count > 0; ?>
                    <tr class="align-top <?php echo e($hasMods ? 'bg-amber-100 border-l-4 border-l-amber-300' : 'bg-white'); ?>">
                        <td class="px-4 py-3 text-center font-medium text-gray-800">
                            <?php echo e($console->id); ?>

                            <?php if($hasMods): ?>
                                <span class="block text-xs text-amber-600 font-normal">modé</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3">
                            <div>
                                <span class="font-semibold"><?php echo e($console->articleCategory?->name ?? '—'); ?></span>
                                <span class="text-gray-400"> / </span>
                                <span><?php echo e($console->articleSubCategory?->name ?? '—'); ?></span>
                                <span class="text-gray-400"> / </span>
                                <span><?php echo e($console->articleType?->name ?? '—'); ?></span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            <?php if($console->repairer): ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
                                    🔧 <?php echo e($console->repairer->name); ?>

                                </span>
                            <?php elseif($console->store): ?>
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    🏪 <?php echo e($console->store->name); ?>

                                </span>
                            <?php else: ?>
                                <span class="text-gray-400">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold
                                <?php if($console->status === 'stock'): ?> bg-green-100 text-green-800 border border-green-200
                                <?php elseif($console->status === 'defective'): ?> bg-orange-100 text-orange-800 border border-orange-200
                                <?php elseif($console->status === 'repair'): ?> bg-indigo-100 text-indigo-800 border border-indigo-200
                                <?php elseif($console->status === 'disabled'): ?> bg-red-100 text-red-800 border border-red-200
                                <?php else: ?> bg-gray-100 text-gray-800 border border-gray-200
                                <?php endif; ?>">
                                <?php echo e($console->status ? ucfirst($console->status) : '—'); ?>

                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <?php if(!is_null($console->prix_achat)): ?>
                                <?php echo e(number_format($console->prix_achat, 2, ',', ' ')); ?> €
                            <?php else: ?>
                                <span class="text-gray-400">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <?php $repairCost = $console->repair_cost ?? 0; ?>
                            <?php if($repairCost > 0): ?>
                                <span class="text-orange-600 font-medium"><?php echo e(number_format($repairCost, 2, ',', ' ')); ?> €</span>
                            <?php else: ?>
                                <span class="text-gray-400">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <?php $totalCost = $console->total_cost ?? 0; ?>
                            <?php if($totalCost > 0): ?>
                                <span class="font-semibold text-gray-900"><?php echo e(number_format($totalCost, 2, ',', ' ')); ?> €</span>
                            <?php else: ?>
                                <span class="text-gray-400">—</span>
                            <?php endif; ?>
                        </td>
                        <td class="px-4 py-3 text-right">
                            <span class="font-semibold text-gray-900"><?php echo e(number_format($console->valorisation, 2, ',', ' ')); ?> €</span>
                        </td>
                        <td class="px-4 py-3 text-center align-top">
                            <form method="POST"
                                action="<?php echo e(route('admin.consoles.update-status', $console)); ?>"
                                class="flex flex-col space-y-2 items-center">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('PATCH'); ?>
                                <select name="status" class="w-full max-w-[160px] border border-gray-300 rounded p-2 text-sm">
                                    <option value="stock" <?php if($console->status === 'stock'): echo 'selected'; endif; ?>>🟢 En stock</option>
                                    <option value="defective" <?php if($console->status === 'defective'): echo 'selected'; endif; ?>>🟠 Défectueuse</option>
                                    <option value="repair" <?php if($console->status === 'repair'): echo 'selected'; endif; ?>>🔧 En réparation</option>
                                    <option value="disabled" <?php if($console->status === 'disabled'): echo 'selected'; endif; ?>>⛔ Désactivée</option>
                                </select>
                                <button type="submit" class="w-full max-w-[160px] bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700 text-sm font-medium">
                                    💾 Enregistrer
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-center w-[180px] whitespace-nowrap align-top">
                            <div class="flex flex-col gap-2 items-center">
                                <a href="<?php echo e(route('admin.articles.edit', $console)); ?>"
                                   class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded hover:bg-yellow-200 border border-yellow-200 font-medium">
                                    ✏️ Éditer
                                </a>
                                <?php if($console->article_type_id): ?>
                                    <?php if($console->productSheet): ?>
                                        
                                        <a href="<?php echo e(route('admin.product-sheets.edit', $console->productSheet)); ?>"
                                           class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded hover:bg-emerald-200 border border-emerald-200 font-medium"
                                           title="Voir la fiche '<?php echo e($console->productSheet->name); ?>'">
                                            🖼️ Voir fiche
                                        </a>
                                    <?php else: ?>
                                        <?php
                                            $existingSheet = $productSheets->get($console->article_type_id)?->first();
                                        ?>
                                        <?php if($existingSheet): ?>
                                            
                                            <form method="POST" action="<?php echo e(route('admin.product-sheets.duplicate', $existingSheet)); ?>" class="w-full">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="console_id" value="<?php echo e($console->id); ?>">
                                                <button type="submit"
                                                        class="w-full bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 border border-blue-200 font-medium"
                                                        title="Dupliquer la fiche '<?php echo e($existingSheet->name); ?>'">
                                                    📋 Dupliquer fiche
                                                </button>
                                            </form>
                                        <?php else: ?>
                                            
                                            <a href="<?php echo e(route('admin.product-sheets.create', ['article_type_id' => $console->article_type_id, 'console_id' => $console->id])); ?>"
                                               class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded hover:bg-emerald-200 border border-emerald-200 font-medium">
                                                🖼️ Créer fiche
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if($console->status === 'stock'): ?>
                                    <a href="<?php echo e(route('admin.consoles.edit', $console)); ?>"
                                       class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded hover:bg-indigo-200 border border-indigo-200 font-medium">
                                        ⚙️ Gérer les prix
                                    </a>
                                <?php else: ?>
                                    <span class="bg-gray-100 text-gray-400 px-3 py-1 rounded border border-gray-200 cursor-not-allowed"
                                          title="Les prix ne peuvent être définis que si l'article est en stock">
                                        🚫 Prix indisponibles
                                    </span>
                                <?php endif; ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr>
                        <td colspan="11" class="px-4 py-8 text-center text-gray-500">
                            Aucun article trouvé
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    
    <?php if(method_exists($consoles, 'links')): ?>
        <div class="mt-4">
            <?php echo e($consoles->links()); ?>

        </div>
    <?php endif; ?>

</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/consoles/index.blade.php ENDPATH**/ ?>