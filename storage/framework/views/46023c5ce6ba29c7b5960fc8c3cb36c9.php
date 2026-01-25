<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-8">🧩 Gestion des catégories articles</h1>

    
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

    
    <section id="categories" class="bg-white shadow rounded-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <h2 class="text-xl font-semibold">📦 Catégories</h2>

            <div class="flex items-center gap-2">
                <input id="filter-categories"
                       type="text"
                       placeholder="Filtrer les catégories…"
                       class="w-full md:w-80 rounded border-gray-300" />
                <button type="button"
                        class="px-3 py-2 rounded border hover:bg-gray-50"
                        onclick="document.getElementById('filter-categories').value=''; document.getElementById('filter-categories').dispatchEvent(new Event('input'));">
                    ✕
                </button>
            </div>
        </div>

        
        <form method="POST" action="<?php echo e(route('admin.taxonomy.category.store')); ?>" class="mb-6 flex flex-col md:flex-row gap-2">
            <?php echo csrf_field(); ?>
            <input name="name"
                   placeholder="Ex : Console, Jeu vidéo, Accessoire…"
                   class="flex-1 border rounded p-2"
                   required>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">➕ Ajouter</button>
        </form>

        
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200" data-filter-table="categories">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 text-left">Nom</th>
                        <th class="px-3 py-2 text-center w-32">Sous-cat.</th>
                        <th class="px-3 py-2 text-center w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr data-filter-row data-filter-text="<?php echo e(strtolower($category->name)); ?>">
                            <td class="px-3 py-2">
                                <form method="POST" action="<?php echo e(route('admin.taxonomy.category.update', $category)); ?>" class="flex gap-2">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('PUT'); ?>
                                    <input name="name"
                                           value="<?php echo e($category->name); ?>"
                                           class="w-full rounded border-gray-300"
                                           required>
                                    <button class="px-3 py-2 rounded bg-indigo-600 text-white whitespace-nowrap">
                                        💾
                                    </button>
                                </form>
                            </td>

                            <td class="px-3 py-2 text-center text-gray-600">
                                <?php echo e($category->subCategories->count()); ?>

                            </td>

                            <td class="px-3 py-2">
                                <div class="flex items-center justify-center gap-2">
                                    <?php if($category->subCategories->count() > 0): ?>
                                        <span class="text-gray-400 cursor-not-allowed"
                                              title="Suppression impossible : contient des sous-catégories">
                                            🗑️ Supprimer
                                        </span>
                                    <?php else: ?>
                                        <form method="POST"
                                              action="<?php echo e(route('admin.taxonomy.category.destroy', $category)); ?>"
                                              onsubmit="return confirm('Supprimer cette catégorie ?');">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="px-3 py-2 rounded bg-red-600 text-white whitespace-nowrap">
                                                🗑️ Supprimer
                                            </button>
                                        </form>
                                    <?php endif; ?>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($categories->count() === 0): ?>
                        <tr>
                            <td colspan="3" class="px-3 py-6 text-center text-gray-500">
                                Aucune catégorie
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    
    <section id="brands" class="bg-white shadow rounded-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <h2 class="text-xl font-semibold">🏷️ Marques</h2>

            <div class="flex items-center gap-2">
                <input id="filter-brands"
                       type="text"
                       placeholder="Filtrer les marques…"
                       class="w-full md:w-80 rounded border-gray-300" />
                <button type="button"
                        class="px-3 py-2 rounded border hover:bg-gray-50"
                        onclick="document.getElementById('filter-brands').value=''; document.getElementById('filter-brands').dispatchEvent(new Event('input'));">
                    ✕
                </button>
            </div>
        </div>

        
        <form method="POST" action="<?php echo e(route('admin.taxonomy.brand.store')); ?>" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-2">
            <?php echo csrf_field(); ?>
            <select name="article_category_id" class="w-full border rounded p-2" required>
                <option value="">— Catégorie —</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <input name="name" placeholder="Ex : Nintendo, Sony…"
                   class="w-full border rounded p-2" required>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">➕ Ajouter</button>
        </form>

        
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200" data-filter-table="brands">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 text-left">Nom</th>
                        <th class="px-3 py-2 text-left">Catégorie</th>
                        <th class="px-3 py-2 text-center w-20">Sous-cat.</th>
                        <th class="px-3 py-2 text-center w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $category->brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $filterText = strtolower($brand->name.' '.$category->name);
                            ?>
                            <tr data-filter-row data-filter-text="<?php echo e($filterText); ?>">
                                <td class="px-3 py-2">
                                    <form method="POST" action="<?php echo e(route('admin.taxonomy.brand.update', $brand)); ?>" class="flex gap-2">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('PUT'); ?>
                                        <input name="name"
                                               value="<?php echo e($brand->name); ?>"
                                               class="w-full rounded border-gray-300"
                                               required>
                                        <input type="hidden" name="article_category_id" value="<?php echo e($brand->article_category_id); ?>">
                                        <button class="px-3 py-2 rounded bg-indigo-600 text-white whitespace-nowrap">
                                            💾
                                        </button>
                                    </form>
                                </td>

                                <td class="px-3 py-2 text-gray-600">
                                    <?php echo e($category->name); ?>

                                </td>

                                <td class="px-3 py-2 text-center text-gray-600">
                                    <?php echo e($brand->subCategories->count()); ?>

                                </td>

                                <td class="px-3 py-2">
                                    <div class="flex items-center justify-center gap-2">
                                        <?php if($brand->subCategories->count() > 0): ?>
                                            <span class="text-gray-400 cursor-not-allowed"
                                                  title="Suppression impossible : contient des sous-catégories">
                                                🗑️ Supprimer
                                            </span>
                                        <?php else: ?>
                                            <form method="POST"
                                                  action="<?php echo e(route('admin.taxonomy.brand.destroy', $brand)); ?>"
                                                  onsubmit="return confirm('Supprimer cette marque ?');">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button class="text-red-600 hover:text-red-700">
                                                    🗑️ Supprimer
                                                </button>
                                            </form>
                                        <?php endif; ?>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        </div>
    </section>

    
    <section id="subcategories" class="bg-white shadow rounded-lg p-6 mb-8">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <h2 class="text-xl font-semibold">📂 Sous-catégories</h2>

            <div class="flex items-center gap-2">
                <input id="filter-subcategories"
                       type="text"
                       placeholder="Filtrer (nom ou catégorie)…"
                       class="w-full md:w-80 rounded border-gray-300" />
                <button type="button"
                        class="px-3 py-2 rounded border hover:bg-gray-50"
                        onclick="document.getElementById('filter-subcategories').value=''; document.getElementById('filter-subcategories').dispatchEvent(new Event('input'));">
                    ✕
                </button>
            </div>
        </div>

        
        <form method="POST" action="<?php echo e(route('admin.taxonomy.sub-category.store')); ?>" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-2">
            <?php echo csrf_field(); ?>
            <select name="article_brand_id" id="subcat-brand-select" class="w-full border rounded p-2" required>
                <option value="">— Marque —</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <optgroup label="<?php echo e($category->name); ?>">
                        <?php $__currentLoopData = $category->brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($brand->id); ?>"><?php echo e($brand->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </optgroup>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <input name="name" placeholder="Ex : Console portable"
                   class="w-full border rounded p-2" required>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">➕ Ajouter</button>
        </form>

        
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200" data-filter-table="subcategories">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 text-left">Catégorie</th>
                        <th class="px-3 py-2 text-left">Marque</th>
                        <th class="px-3 py-2 text-left">Nom</th>
                        <th class="px-3 py-2 text-center w-20">Types</th>
                        <th class="px-3 py-2 text-center w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $category->brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $brand): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $brand->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $filterText = strtolower($sub->name.' '.$category->name.' '.($brand->name ?? ''));
                                ?>
                                <tr data-filter-row data-filter-text="<?php echo e($filterText); ?>">
                                    <td class="px-3 py-2">
                                        <form method="POST" action="<?php echo e(route('admin.taxonomy.sub-category.update', $sub)); ?>" class="flex gap-2">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <select name="article_category_id" class="w-full rounded border-gray-300" required>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($c2->id); ?>" <?php if($sub->article_category_id == $c2->id): echo 'selected'; endif; ?>>
                                                        <?php echo e($c2->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                    </td>

                                    <td class="px-3 py-2 text-gray-600">                                            <input name="name"
                                                   value="<?php echo e($sub->name); ?>"
                                                   class="w-full rounded border-gray-300"
                                                   required>
                                    </td>

                                    <td class="px-3 py-2">                                            <select name="article_brand_id" class="w-full rounded border-gray-300">
                                                <option value="">— Aucune —</option>
                                                <?php $__currentLoopData = $category->brands; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $b): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <option value="<?php echo e($b->id); ?>" <?php if($sub->article_brand_id == $b->id): echo 'selected'; endif; ?>>
                                                        <?php echo e($b->name); ?>

                                                    </option>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                    </td>

                                    <td class="px-3 py-2 text-center text-gray-600">
                                        <?php echo e($sub->types->count()); ?>

                                    </td>

                                    <td class="px-3 py-2">
                                            <div class="flex items-center justify-center gap-2">
                                                <button class="px-3 py-2 rounded bg-indigo-600 text-white whitespace-nowrap">
                                                    💾
                                                </button>
                                        </form>

                                                <?php if($sub->types->count() > 0): ?>
                                                    <span class="text-gray-400 cursor-not-allowed"
                                                          title="Suppression impossible : contient des types">
                                                        🗑️ Supprimer
                                                    </span>
                                                <?php else: ?>
                                                    <form method="POST"
                                                          action="<?php echo e(route('admin.taxonomy.sub-category.destroy', $sub)); ?>"
                                                          onsubmit="return confirm('Supprimer cette sous-catégorie ?');">
                                                        <?php echo csrf_field(); ?>
                                                        <?php echo method_field('DELETE'); ?>
                                                        <button class="px-3 py-2 rounded bg-red-600 text-white whitespace-nowrap">
                                                            🗑️ Supprimer
                                                        </button>
                                                    </form>
                                                <?php endif; ?>
                                            </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php if($categories->sum(fn($c) => $c->brands->sum(fn($b) => $b->subCategories->count())) === 0): ?>
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-gray-500">
                                Aucune sous-catégorie
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

    
    <section id="types" class="bg-white shadow rounded-lg p-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-3 mb-4">
            <h2 class="text-xl font-semibold">🎮 Types</h2>

            <div class="flex items-center gap-2">
                <input id="filter-types"
                       type="text"
                       placeholder="Filtrer (type / sous-cat / catégorie)…"
                       class="w-full md:w-80 rounded border-gray-300" />
                <button type="button"
                        class="px-3 py-2 rounded border hover:bg-gray-50"
                        onclick="document.getElementById('filter-types').value=''; document.getElementById('filter-types').dispatchEvent(new Event('input'));">
                    ✕
                </button>
            </div>
        </div>

        
        <form method="POST" action="<?php echo e(route('admin.taxonomy.type.store')); ?>" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-2">
            <?php echo csrf_field(); ?>
            <select name="article_sub_category_id" class="w-full border rounded p-2" required>
                <option value="">— Sous-catégorie —</option>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($sub->id); ?>">
                            <?php echo e($category->name); ?> › <?php echo e($sub->name); ?>

                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>

            <input name="name" placeholder="Ex : Game Boy, Game Gear…"
                   class="w-full border rounded p-2" required>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">➕ Ajouter</button>
        </form>

        
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200" data-filter-table="types">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 text-left">Nom</th>
                        <th class="px-3 py-2 text-left">Sous-catégorie</th>
                        <th class="px-3 py-2 text-left">Catégorie</th>
                        <th class="px-3 py-2 text-center w-40">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php $__currentLoopData = $category->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php $__currentLoopData = $sub->types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $filterText = strtolower($type->name.' '.$sub->name.' '.$category->name);
                                ?>
                                <tr data-filter-row data-filter-text="<?php echo e($filterText); ?>">
                                    <td class="px-3 py-2">
                                        <form method="POST" action="<?php echo e(route('admin.taxonomy.type.update', $type)); ?>" class="flex gap-2">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('PUT'); ?>
                                            <input name="name"
                                                   value="<?php echo e($type->name); ?>"
                                                   class="w-full rounded border-gray-300"
                                                   required>
                                    </td>

                                    <td class="px-3 py-2">
                                            <select name="article_sub_category_id" class="w-full rounded border-gray-300" required>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $c2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <?php $__currentLoopData = $c2->subCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                        <option value="<?php echo e($s2->id); ?>" <?php if($type->article_sub_category_id == $s2->id): echo 'selected'; endif; ?>>
                                                            <?php echo e($c2->name); ?> › <?php echo e($s2->name); ?>

                                                        </option>
                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </select>
                                    </td>

                                    <td class="px-3 py-2 text-gray-600">
                                        <?php echo e($category->name); ?>

                                    </td>

                                    <td class="px-3 py-2">
                                            <div class="flex items-center justify-center gap-2">
                                                <button class="px-3 py-2 rounded bg-indigo-600 text-white whitespace-nowrap">
                                                    💾
                                                </button>
                                        </form>

                                                <form method="POST"
                                                      action="<?php echo e(route('admin.taxonomy.type.destroy', $type)); ?>"
                                                      onsubmit="return confirm('Supprimer ce type ?');">
                                                    <?php echo csrf_field(); ?>
                                                    <?php echo method_field('DELETE'); ?>
                                                    <button class="px-3 py-2 rounded bg-red-600 text-white whitespace-nowrap">
                                                        🗑️ Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    <?php
                        $typesCount = 0;
                        foreach($categories as $c){ foreach($c->subCategories as $s){ $typesCount += $s->types->count(); } }
                    ?>
                    <?php if($typesCount === 0): ?>
                        <tr>
                            <td colspan="4" class="px-3 py-6 text-center text-gray-500">
                                Aucun type
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </section>

</div>


<script>
(function () {
  function wireFilter(inputId, tableKey) {
    const input = document.getElementById(inputId);
    const table = document.querySelector(`[data-filter-table="${tableKey}"]`);
    if (!input || !table) return;

    const rows = Array.from(table.querySelectorAll('[data-filter-row]'));

    input.addEventListener('input', () => {
      const q = input.value.trim().toLowerCase();
      rows.forEach(row => {
        const text = (row.getAttribute('data-filter-text') || '').toLowerCase();
        row.style.display = (!q || text.includes(q)) ? '' : 'none';
      });
    });
  }

  wireFilter('filter-categories', 'categories');
  wireFilter('filter-brands', 'brands');
  wireFilter('filter-subcategories', 'subcategories');
  wireFilter('filter-types', 'types');
})();

// Cascade dropdown pour sous-catégories : Catégorie → Marque
function loadBrandsForSubcat(categoryId) {
  const brandSelect = document.getElementById('subcat-brand-select');
  brandSelect.innerHTML = '<option value="">— Chargement… —</option>';
  brandSelect.disabled = true;
  
  if (!categoryId) {
    brandSelect.innerHTML = '<option value="">— Sélectionner une catégorie d\'abord —</option>';
    brandSelect.disabled = true;
    return;
  }

  fetch(`/admin/ajax/brands/${categoryId}`)
    .then(res => res.text())
    .then(html => {
      brandSelect.innerHTML = html;
      brandSelect.disabled = false;
    })
    .catch(() => {
      brandSelect.innerHTML = '<option value="">Erreur</option>';
      brandSelect.disabled = true;
    });
}
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/taxonomy/index.blade.php ENDPATH**/ ?>