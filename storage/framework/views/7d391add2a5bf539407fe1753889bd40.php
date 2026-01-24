<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <?php echo e($console->exists ? "✏️ Modifier l'article #{$console->id}" : "➕ Créer un article"); ?>

        </h1>

        <div class="flex items-center gap-2">
            <?php if($console->exists): ?>
                <a href="<?php echo e(route('admin.articles.edit_full', $console)); ?>" class="px-3 py-2 rounded bg-gray-100 hover:bg-gray-200 text-sm">
                    ✍️ Édition complète
                </a>
            <?php endif; ?>

            <a href="<?php echo e(route('admin.consoles.index')); ?>" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour stock</a>
        </div>
    </div>


    
    <?php if($errors->any()): ?>
        <div class="mb-6 p-4 bg-red-50 text-red-800 rounded border border-red-200">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $err): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($err); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        </div>
    <?php endif; ?>

    
    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST"
              action="<?php echo e($console->exists ? route('admin.articles.update', $console) : route('admin.articles.store')); ?>">
            <?php echo csrf_field(); ?>
            <?php if($console->exists): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            
<div class="flex items-center justify-between mb-4">
    <h2 class="text-lg font-semibold text-gray-800">Taxonomie</h2>

    
    <a href="<?php echo e(route('admin.taxonomy.index')); ?>"
       target="_blank"
       class="inline-flex items-center gap-2 px-3 py-2 rounded bg-gray-900 text-white text-sm hover:bg-black"
       title="Gérer catégories, sous-catégories et types">
        <span class="text-lg leading-none">+</span>
        Gérer
        </a>
        <button type="button"
        onclick="window.location.reload()"
        class="ml-2 px-3 py-2 rounded border text-sm hover:bg-gray-50"
        title="Recharger pour récupérer la nouvelle taxonomie">
        ↻ Rafraîchir
        </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-3 gap-4">

    
    <div>
        <div class="flex items-center justify-between mb-1">
            <label class="block text-sm font-medium">Catégorie *</label>

            <a href="<?php echo e(route('admin.taxonomy.index')); ?>#categories"
               target="_blank"
               class="text-indigo-600 hover:underline text-sm"
               title="Ajouter / éditer une catégorie">
                +
            </a>
        </div>

        <select id="article_category_id"
                name="article_category_id"
                class="w-full rounded border-gray-300"
                required>
            <option value="">— Choisir —</option>
            <?php $__currentLoopData = $articleCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo e($cat->id); ?>"
                    <?php if(old('article_category_id', $console->article_category_id) == $cat->id): echo 'selected'; endif; ?>>
                    <?php echo e($cat->name); ?>

                </option>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </select>
    </div>

    
    <div>
        <div class="flex items-center justify-between mb-1">
            <label class="block text-sm font-medium">Sous-catégorie *</label>

            <a href="<?php echo e(route('admin.taxonomy.index')); ?>#subcategories"
               target="_blank"
               class="text-indigo-600 hover:underline text-sm"
               title="Ajouter / éditer une sous-catégorie">
                +
            </a>
        </div>

        <select id="article_sub_category_id"
                name="article_sub_category_id"
                class="w-full rounded border-gray-300"
                required>
            <option value="">— Choisir —</option>
        </select>
    </div>

    
    <div>
        <div class="flex items-center justify-between mb-1">
            <label class="block text-sm font-medium">Type *</label>

            <a href="<?php echo e(route('admin.taxonomy.index')); ?>#types"
               target="_blank"
               class="text-indigo-600 hover:underline text-sm"
               title="Ajouter / éditer un type">
                +
            </a>
        </div>

        <select id="article_type_id"
                name="article_type_id"
                class="w-full rounded border-gray-300"
                required>
            <option value="">— Choisir —</option>
        </select>
    </div>

</div>

            
            <h2 class="text-lg font-semibold text-gray-800 mt-8 mb-4">Stock & Réparation</h2>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                
                <?php if(!$console->exists): ?>
                <div>
                    <label class="block text-sm font-medium mb-1">Quantité</label>
                    <input type="number" min="1" max="100" name="quantity"
                           value="<?php echo e(old('quantity', 1)); ?>"
                           class="w-full rounded border-gray-300">
                    <p class="text-xs text-gray-500 mt-1">Créer plusieurs articles identiques (max 100)</p>
                </div>
                <?php endif; ?>

                
                <div>
                    <label class="block text-sm font-medium mb-1">Statut *</label>
                    <select name="status" class="w-full rounded border-gray-300" required>
                        <?php $st = old('status', $console->status); ?>
                        <option value="stock" <?php if($st==='stock'): echo 'selected'; endif; ?>>Stock</option>
                        <option value="defective" <?php if($st==='defective'): echo 'selected'; endif; ?>>Défectueuse</option>
                        <option value="repair" <?php if($st==='repair'): echo 'selected'; endif; ?>>En réparation</option>
                        <option value="disabled" <?php if($st==='disabled'): echo 'selected'; endif; ?>>Désactivée</option>
                    </select>
                </div>

                
                <div>
                    <label class="block text-sm font-medium mb-1">Réparateur</label>
                    <select name="repairer_id" class="w-full rounded border-gray-300">
                        <option value="">— Aucun —</option>
                        <?php $__currentLoopData = $repairers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($rep->id); ?>"
                                <?php if(old('repairer_id', $console->repairer_id) == $rep->id): echo 'selected'; endif; ?>>
                                <?php echo e($rep->name); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">
                        Obligatoire si statut = <strong>repair</strong>
                    </p>
                </div>

                
                <div>
                    <label class="block text-sm font-medium mb-1">Prix d’achat (€)</label>
                    <input type="number" step="0.01" min="0" name="prix_achat"
                           value="<?php echo e(old('prix_achat', $console->prix_achat)); ?>"
                           class="w-full rounded border-gray-300">
                </div>

                
                <div>
                    <label class="block text-sm font-medium mb-1">Valorisation (€)</label>
                    <input type="number" step="0.01" min="0" name="valorisation"
                           value="<?php echo e(old('valorisation', $console->valorisation)); ?>"
                           class="w-full rounded border-gray-300">
                </div>
            </div>

            
            <h2 class="text-lg font-semibold text-gray-800 mt-8 mb-4">Commentaires</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Commentaire produit</label>
                    <textarea name="product_comment" rows="3"
                              class="w-full rounded border-gray-300"><?php echo e(old('product_comment', $console->product_comment)); ?></textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Commentaire réparateur</label>
                    <textarea name="commentaire_reparateur" rows="3"
                              class="w-full rounded border-gray-300"><?php echo e(old('commentaire_reparateur', $console->commentaire_reparateur)); ?></textarea>
                </div>
            </div>

            

            
            <div class="mt-6 flex gap-3">
                <button class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    💾 Enregistrer
                </button>

                <a href="<?php echo e(route('admin.consoles.index')); ?>"
                   class="px-6 py-2 rounded border hover:bg-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>

    
    <div class="mt-10 bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">
            🕒 15 dernières entrées en stock
        </h2>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 text-left">ID</th>
                        <th class="px-3 py-2 text-left">Catégorie</th>
                        <th class="px-3 py-2 text-left">Type</th>
                        <th class="px-3 py-2 text-left">Statut</th>
                        <th class="px-3 py-2 text-left">Réparateur</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__empty_1 = true; $__currentLoopData = $lastConsoles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-3 py-2">#<?php echo e($c->id); ?></td>
                            <td class="px-3 py-2"><?php echo e($c->articleCategory?->name ?? '—'); ?></td>
                            <td class="px-3 py-2"><?php echo e($c->articleType?->name ?? '—'); ?></td>
                            <td class="px-3 py-2"><?php echo e(ucfirst($c->status)); ?></td>
                            <td class="px-3 py-2">
                                <?php echo e($c->repairer?->name ?? '—'); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-gray-500">
                                Aucune entrée récente
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>


<script>
(function() {
  const cat = document.getElementById('article_category_id');
  const sub = document.getElementById('article_sub_category_id');
  const type = document.getElementById('article_type_id');

  if (!cat || !sub || !type) return;

  const oldSub = <?php echo json_encode(old('article_sub_category_id', $console->article_sub_category_id), 512) ?>;
  const oldType = <?php echo json_encode(old('article_type_id', $console->article_type_id), 512) ?>;

  function clear(sel) {
    sel.innerHTML = '<option value="">— Choisir —</option>';
  }

  async function loadSubs(catId) {
    clear(sub); clear(type);
    if (!catId) return;
    try {
      const url = `<?php echo e(url('admin/ajax/sub-categories')); ?>/${catId}`;
      const response = await fetch(url);
      const html = await response.text();
      sub.innerHTML = html;
      if (oldSub) { sub.value = oldSub; loadTypes(oldSub); }
    } catch (e) {
      console.error('Erreur chargement sous-catégories:', e);
    }
  }

  async function loadTypes(subId) {
    clear(type);
    if (!subId) return;
    try {
      const url = `<?php echo e(url('admin/ajax/types')); ?>/${subId}`;
      const response = await fetch(url);
      const html = await response.text();
      type.innerHTML = html;
      if (oldType) type.value = oldType;
    } catch (e) {
      console.error('Erreur chargement types:', e);
    }
  }

  cat.addEventListener('change', e => loadSubs(e.target.value));
  sub.addEventListener('change', e => loadTypes(e.target.value));

  if (cat.value) loadSubs(cat.value);
})();
</script>
<?php $__env->stopSection(); ?>


<script style="display:none">
// OBSOLÈTE - gardé pour référence
(function() {
  const catSelect  = document.getElementById('article_category_id');
  const subSelect  = document.getElementById('article_sub_category_id');
  const typeSelect = document.getElementById('article_type_id');

  if (!catSelect || !subSelect || !typeSelect) return;

  // Valeurs “old” / édition
  const oldSub  = <?php echo json_encode(old('article_sub_category_id', $console->article_sub_category_id), 512) ?>;
  const oldType = <?php echo json_encode(old('article_type_id', $console->article_type_id), 512) ?>;

  function clearSelect(sel, placeholder = '— Choisir —') {
    sel.innerHTML = '';
    const opt = document.createElement('option');
    opt.value = '';
    opt.textContent = placeholder;
    sel.appendChild(opt);
  }

  async function fetchJson(url) {
    const res = await fetch(url, { headers: { 'Accept': 'application/json' }});
    if (!res.ok) throw new Error(`HTTP ${res.status} on ${url}`);
    return await res.json();
  }

  async function loadSubCategories(categoryId, applyOld = false) {
    clearSelect(subSelect);
    clearSelect(typeSelect);

    if (!categoryId) return;

    const url = `<?php echo e(route('admin.ajax.sub-categories', ['category' => '__ID__'])); ?>`.replace('__ID__', categoryId);
    const data = await fetchJson(url);

    // supporte aussi {data:[...]} si jamais
    const list = Array.isArray(data) ? data : (data.data ?? []);

    list.forEach(sc => {
      const opt = document.createElement('option');
      opt.value = sc.id;
      opt.textContent = sc.name;
      subSelect.appendChild(opt);
    });

    if (applyOld && oldSub) {
      subSelect.value = String(oldSub);
      if (subSelect.value) await loadTypes(subSelect.value, true);
    }
  }

  async function loadTypes(subCategoryId, applyOld = false) {
    clearSelect(typeSelect);

    if (!subCategoryId) return;

    const url = `<?php echo e(route('admin.ajax.types', ['subCategory' => '__ID__'])); ?>`.replace('__ID__', subCategoryId);
    const data = await fetchJson(url);

    const list = Array.isArray(data) ? data : (data.data ?? []);

    list.forEach(t => {
      const opt = document.createElement('option');
      opt.value = t.id;
      opt.textContent = t.name;
      typeSelect.appendChild(opt);
    });

    if (applyOld && oldType) {
      typeSelect.value = String(oldType);
    }
  }

  // Events
  catSelect.addEventListener('change', async () => {
    try {
      await loadSubCategories(catSelect.value, false);
    } catch (e) {
      console.error(e);
    }
  });

  subSelect.addEventListener('change', async () => {
    try {
      await loadTypes(subSelect.value, false);
    } catch (e) {
      console.error(e);
    }
  });

  // Init (édition / old input)
  (async () => {
    clearSelect(subSelect);
    clearSelect(typeSelect);

    if (catSelect.value) {
      try {
        await loadSubCategories(catSelect.value, true);
      } catch (e) {
        console.error(e);
      }
    }
  })();
})();
</script>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/consoles/form.blade.php ENDPATH**/ ?>