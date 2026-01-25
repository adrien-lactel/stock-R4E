<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Derniers articles</h1>
        <a href="<?php echo e(route('admin.consoles.index')); ?>" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour</a>
    </div>

    <form method="GET" class="mb-6 grid grid-cols-1 md:grid-cols-4 gap-4">
        <div>
            <label class="block text-sm font-medium mb-1">Recherche</label>
            <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Serial, provenance, stockage…" class="w-full rounded border-gray-300 p-2">
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Catégorie</label>
            <select id="filter_category" name="category" class="w-full rounded border-gray-300 p-2">
                <option value="">Toutes</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($cat->id); ?>" <?php if((string)request('category') === (string)$cat->id): echo 'selected'; endif; ?>><?php echo e($cat->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Sous-catégorie</label>
            <select id="filter_subcategory" name="sub_category" class="w-full rounded border-gray-300 p-2">
                <option value="">Toutes</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Type</label>
            <select id="filter_type" name="type" class="w-full rounded border-gray-300 p-2">
                <option value="">Tous</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Statut</label>
            <select name="status" class="w-full rounded border-gray-300 p-2">
                <option value="">Tous</option>
                <option value="stock" <?php if(request('status')==='stock'): echo 'selected'; endif; ?>>stock</option>
                <option value="defective" <?php if(request('status')==='defective'): echo 'selected'; endif; ?>>defective</option>
                <option value="repair" <?php if(request('status')==='repair'): echo 'selected'; endif; ?>>repair</option>
                <option value="disabled" <?php if(request('status')==='disabled'): echo 'selected'; endif; ?>>disabled</option>
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium mb-1">Magasin</label>
            <select name="store_id" class="w-full rounded border-gray-300 p-2">
                <option value="">Tous</option>
                <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($s->id); ?>" <?php if((string)request('store_id') === (string)$s->id): echo 'selected'; endif; ?>><?php echo e($s->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>

        <div class="md:col-span-4 flex gap-2">
            <button class="px-4 py-2 rounded bg-blue-600 text-white">Filtrer</button>
            <a href="<?php echo e(route('admin.articles.recent')); ?>" class="px-4 py-2 rounded border">Reset</a>
        </div>
    </form>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-center">ID</th>
                    <th class="px-4 py-3 text-left">Catégorie</th>
                    <th class="px-4 py-3 text-left">Sous-cat.</th>
                    <th class="px-4 py-3 text-left">Type</th>
                    <th class="px-4 py-3 text-left">Magasin</th>
                    <th class="px-4 py-3 text-center">Statut</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                <?php $__empty_1 = true; $__currentLoopData = $consoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $console): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <tr>
                        <td class="px-4 py-3 text-center font-medium"><?php echo e($console->id); ?></td>
                        <td class="px-4 py-3"><?php echo e($console->articleCategory?->name ?? '—'); ?></td>
                        <td class="px-4 py-3"><?php echo e($console->articleSubCategory?->name ?? '—'); ?></td>
                        <td class="px-4 py-3"><?php echo e($console->articleType?->name ?? '—'); ?></td>
                        <td class="px-4 py-3"><?php echo e($console->store?->name ?? '—'); ?></td>
                        <td class="px-4 py-3 text-center"><?php echo e(ucfirst($console->status)); ?></td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                <a href="<?php echo e(route('admin.articles.edit_full', $console)); ?>" class="px-3 py-1 rounded bg-gray-100 hover:bg-gray-200 text-sm">Édition complète</a>
                                <a href="<?php echo e(route('admin.articles.edit', $console)); ?>" class="text-indigo-600 hover:underline text-sm">Rapide</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <tr><td colspan="7" class="px-4 py-6 text-center text-gray-500">Aucun article</td></tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</div>

<script>
// Cascade filters: load sub-categories and types based on selected category
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

  const SUBS_URL_TEMPLATE = `<?php echo e(route('admin.ajax.sub-categories', ['brand' => '__ID__'])); ?>`;
  const TYPES_URL_TEMPLATE = `<?php echo e(route('admin.ajax.types', ['subCategory' => '__ID__'])); ?>`;

  async function loadSubs(catId, applyOld = false) {
    sub.innerHTML = '<option value="">Toutes</option>';
    type.innerHTML = '<option value="">Tous</option>';
    if (!catId) return;
    const url = SUBS_URL_TEMPLATE.replace('__ID__', catId);
    const data = await fetchJson(url);
    const list = Array.isArray(data) ? data : (data.data ?? []);
    list.forEach(s => {
      const opt = document.createElement('option');
      opt.value = s.id;
      opt.textContent = s.name;
      sub.appendChild(opt);
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
    list.forEach(t => {
      const opt = document.createElement('option');
      opt.value = t.id;
      opt.textContent = t.name;
      type.appendChild(opt);
    });
    if (applyOld && <?php echo json_encode(request('type'), 15, 512) ?>) {
      try { type.value = String(<?php echo json_encode(request('type'), 15, 512) ?>); } catch(e){}
    }
  }

  cat.addEventListener('change', async () => {
    await loadSubs(cat.value, false);
  });

  sub.addEventListener('change', async () => {
    await loadTypes(sub.value, false);
  });

  // Init: if a category is pre-selected, load its subs and types applying request old values
  (async () => {
    if (cat.value) {
      await loadSubs(cat.value, true);
      if (sub.value) {
        await loadTypes(sub.value, true);
      }
    }
  })();
});
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/consoles/recent.blade.php ENDPATH**/ ?>