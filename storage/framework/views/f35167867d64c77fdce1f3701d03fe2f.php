<?php $__env->startSection('content'); ?>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            <?php echo e($console->exists ? "✏️ Édition complète article #{$console->id}" : "➕ Nouvelle fiche article"); ?>

        </h1>
        <a href="<?php echo e(route('admin.consoles.index')); ?>" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour stock</a>
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
        <form method="POST" action="<?php echo e($console->exists ? route('admin.articles.update', $console) : route('admin.articles.store')); ?>">
            <?php echo csrf_field(); ?>
            <?php if($console->exists): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <h2 class="text-lg font-semibold text-gray-800">Taxonomie</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                <div>
                    <label class="block text-sm font-medium">Catégorie *</label>
                    <select id="article_category_id" name="article_category_id" class="w-full rounded border-gray-300" required>
                        <option value="">— Choisir —</option>
                        <?php $__currentLoopData = $articleCategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($cat->id); ?>" <?php if(old('article_category_id', $console->article_category_id) == $cat->id): echo 'selected'; endif; ?>><?php echo e($cat->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Sous-catégorie *</label>
                    <select id="article_sub_category_id" name="article_sub_category_id" class="w-full rounded border-gray-300" required>
                        <option value="">— Choisir —</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Type *</label>
                    <select id="article_type_id" name="article_type_id" class="w-full rounded border-gray-300" required>
                        <option value="">— Choisir —</option>
                    </select>
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Identité & détails</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                <div>
                    <label class="block text-sm font-medium">Numéro de série</label>
                    <input name="serial_number" class="w-full rounded border-gray-300" value="<?php echo e(old('serial_number', $console->serial_number)); ?>">
                </div>
                <div>
                    <label class="block text-sm font-medium">Catégorie interne</label>
                    <input name="category" class="w-full rounded border-gray-300" value="<?php echo e(old('category', $console->category)); ?>">
                </div>
                <div>
                    <label class="block text-sm font-medium">Provenance</label>
                    <input name="provenance_article" list="provenances-list" class="w-full rounded border-gray-300" value="<?php echo e(old('provenance_article', $console->provenance_article)); ?>">
                    <datalist id="provenances-list"><?php $__currentLoopData = $provenances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($p); ?>"><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></datalist>
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Stock / Réparation</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-3">
                <div>
                    <label class="block text-sm font-medium">Statut *</label>
                    <?php $st = old('status', $console->status); ?>
                    <select name="status" class="w-full rounded border-gray-300" required>
                        <option value="stock" <?php if($st==='stock'): echo 'selected'; endif; ?>>Stock</option>
                        <option value="defective" <?php if($st==='defective'): echo 'selected'; endif; ?>>Défectueuse</option>
                        <option value="repair" <?php if($st==='repair'): echo 'selected'; endif; ?>>En réparation</option>
                        <option value="disabled" <?php if($st==='disabled'): echo 'selected'; endif; ?>>Désactivée</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Réparateur</label>
                    <select name="repairer_id" class="w-full rounded border-gray-300">
                        <option value="">— Aucun —</option>
                        <?php $__currentLoopData = $repairers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rep): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($rep->id); ?>" <?php if(old('repairer_id', $console->repairer_id) == $rep->id): echo 'selected'; endif; ?>><?php echo e($rep->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Prix d’achat (€)</label>
                    <input type="number" step="0.01" min="0" name="prix_achat" value="<?php echo e(old('prix_achat', $console->prix_achat)); ?>" class="w-full rounded border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium">Valorisation (€)</label>
                    <input type="number" step="0.01" min="0" name="valorisation" value="<?php echo e(old('valorisation', $console->valorisation)); ?>" class="w-full rounded border-gray-300">
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Modifications (Mods & Accessoires)</h2>
            
            
            <?php if($console->mods->count()): ?>
                <?php
                    $totalMinutes = $console->mods->sum('pivot.work_time_minutes');
                    $hours = floor($totalMinutes / 60);
                    $minutes = $totalMinutes % 60;
                    $coutMods = $console->mods->sum('pivot.price_applied');
                    $coutMainOeuvre = ($totalMinutes / 60) * 20; // 20€/heure
                    $coutTotalReparation = $coutMods + $coutMainOeuvre;
                    $prixAchat = $console->prix_achat ?? 0;
                    $coutRevient = $prixAchat + $coutTotalReparation;
                ?>
                
                
                <div class="mt-3 mb-4 p-4 bg-indigo-50 border border-indigo-200 rounded-lg">
                    <h4 class="text-sm font-semibold text-indigo-800 mb-3">💰 Coûts</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                            <div class="text-xs text-gray-500 uppercase">Prix d'achat</div>
                            <div class="text-xl font-bold text-gray-700"><?php echo e(number_format($prixAchat, 2)); ?> €</div>
                        </div>
                        <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                            <div class="text-xs text-gray-500 uppercase">Coût Mods</div>
                            <div class="text-xl font-bold text-blue-600"><?php echo e(number_format($coutMods, 2)); ?> €</div>
                        </div>
                        <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                            <div class="text-xs text-gray-500 uppercase">Temps travail</div>
                            <div class="text-xl font-bold text-orange-600">
                                <?php echo e($hours > 0 ? $hours.'h ' : ''); ?><?php echo e($minutes); ?>min
                            </div>
                        </div>
                        <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                            <div class="text-xs text-gray-500 uppercase">Main d'œuvre (20€/h)</div>
                            <div class="text-xl font-bold text-orange-600"><?php echo e(number_format($coutMainOeuvre, 2)); ?> €</div>
                        </div>
                        <div class="text-center p-3 bg-indigo-100 rounded-lg shadow-sm border border-indigo-300">
                            <div class="text-xs text-indigo-700 uppercase font-semibold">Coût Réparation</div>
                            <div class="text-xl font-bold text-indigo-700"><?php echo e(number_format($coutTotalReparation, 2)); ?> €</div>
                        </div>
                        <div class="text-center p-3 bg-green-100 rounded-lg shadow-sm border-2 border-green-400">
                            <div class="text-xs text-green-700 uppercase font-semibold">Coût de Revient</div>
                            <div class="text-2xl font-bold text-green-700"><?php echo e(number_format($coutRevient, 2)); ?> €</div>
                        </div>
                    </div>
                </div>

                
                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Mods, Accessoires & Opérations associés :</h4>
                    <div class="flex flex-wrap gap-2">
                        <?php $__currentLoopData = $console->mods; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $badgeClass = $mod->is_operation 
                                    ? 'bg-orange-100 text-orange-800' 
                                    : ($mod->is_accessory ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800');
                                $icon = $mod->is_operation ? '🔧' : ($mod->is_accessory ? '📦' : '🔩');
                            ?>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm <?php echo e($badgeClass); ?>">
                                <?php echo e($icon); ?> <?php echo e($mod->name); ?>

                                <?php if($mod->pivot->price_applied && !$mod->is_operation): ?>
                                    <span class="ml-1 text-xs opacity-75">(<?php echo e(number_format($mod->pivot->price_applied, 2)); ?>€)</span>
                                <?php endif; ?>
                                <?php if($mod->pivot->work_time_minutes): ?>
                                    <span class="ml-1 text-xs opacity-75">· <?php echo e($mod->pivot->work_time_minutes); ?>min</span>
                                <?php endif; ?>
                            </span>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php else: ?>
                <div class="mt-3 mb-4 p-4 bg-gray-50 rounded-lg text-center text-gray-500">
                    Aucun mod associé — Coût de réparation: <strong>0,00 €</strong>
                </div>
            <?php endif; ?>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-3" x-data="{ modSlots: [
                { mod_id: '', price: '', time: '', notes: '' },
                { mod_id: '', price: '', time: '', notes: '' },
                { mod_id: '', price: '', time: '', notes: '' },
                { mod_id: '', price: '', time: '', notes: '' }
            ]}">
                <?php for($i = 0; $i < 4; $i++): ?>
                    <div class="p-3 border rounded-lg bg-white">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mod / Opération <?php echo e($i + 1); ?></label>
                        <select name="console_mods[<?php echo e($i); ?>][mod_id]" class="w-full rounded border-gray-300 text-sm">
                            <option value="">— Aucun —</option>
                            <optgroup label="🔧 Opérations (temps uniquement)">
                                <?php $__currentLoopData = $allMods->where('is_operation', true); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($mod->id); ?>" data-price="0">
                                        <?php echo e($mod->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                            <optgroup label="🔩 Mods (pièces)">
                                <?php $__currentLoopData = $allMods->where('is_accessory', false)->where('is_operation', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($mod->id); ?>" data-price="<?php echo e($mod->purchase_price); ?>">
                                        <?php echo e($mod->name); ?> (<?php echo e(number_format($mod->purchase_price, 2)); ?>€)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                            <optgroup label="📦 Accessoires">
                                <?php $__currentLoopData = $allMods->where('is_accessory', true)->where('is_operation', false); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $mod): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($mod->id); ?>" data-price="<?php echo e($mod->purchase_price); ?>">
                                        <?php echo e($mod->name); ?> (<?php echo e(number_format($mod->purchase_price, 2)); ?>€)
                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </optgroup>
                        </select>
                        <div class="grid grid-cols-2 gap-2 mt-2">
                            <div>
                                <label class="block text-xs text-gray-500">Prix (€)</label>
                                <input type="number" step="0.01" min="0" name="console_mods[<?php echo e($i); ?>][price_applied]" 
                                       class="w-full rounded border-gray-300 text-sm" placeholder="Auto">
                            </div>
                            <div>
                                <label class="block text-xs text-gray-500">Temps (min)</label>
                                <input type="number" min="0" name="console_mods[<?php echo e($i); ?>][work_time_minutes]" 
                                       class="w-full rounded border-gray-300 text-sm" placeholder="0">
                            </div>
                        </div>
                        <div class="mt-2">
                            <label class="block text-xs text-gray-500">Notes</label>
                            <input type="text" name="console_mods[<?php echo e($i); ?>][notes]" 
                                   class="w-full rounded border-gray-300 text-sm" placeholder="Notes..."">
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
            <p class="text-xs text-gray-500 mt-2">💡 Les nouveaux mods seront ajoutés aux mods existants. Pour retirer un mod, utilisez la vue réparateur.</p>

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Logistique & magasin</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                <div>
                    <label class="block text-sm font-medium">Lieu de stockage</label>
                    <input name="lieu_stockage" list="lieux-list" class="w-full rounded border-gray-300" value="<?php echo e(old('lieu_stockage', $console->lieu_stockage)); ?>">
                    <datalist id="lieux-list"><?php $__currentLoopData = $lieux; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $l): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?><option value="<?php echo e($l); ?>"><?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?></datalist>
                </div>

                <div>
                    <label class="block text-sm font-medium">Magasin</label>
                    <select name="store_id" class="w-full rounded border-gray-300">
                        <option value="">— Choisir —</option>
                        <?php $__currentLoopData = $stores; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($s->id); ?>" <?php if(old('store_id', $console->store_id) == $s->id): echo 'selected'; endif; ?>><?php echo e($s->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>


            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Commentaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                <div>
                    <label class="block text-sm font-medium">Commentaire produit</label>
                    <textarea name="product_comment" rows="4" class="w-full rounded border-gray-300"><?php echo e(old('product_comment', $console->product_comment)); ?></textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Commentaire réparateur</label>
                    <textarea name="commentaire_reparateur" rows="4" class="w-full rounded border-gray-300"><?php echo e(old('commentaire_reparateur', $console->commentaire_reparateur)); ?></textarea>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium">Commentaire admin</label>
                <textarea name="admin_comment" rows="4" class="w-full rounded border-gray-300"><?php echo e(old('admin_comment', $console->admin_comment)); ?></textarea>
            </div>

            <div class="mt-6 flex gap-3">
                <button class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">💾 Enregistrer</button>
                <a href="<?php echo e(route('admin.consoles.index')); ?>" class="px-6 py-2 rounded border hover:bg-gray-50">Annuler</a>
            </div>
        </form>
    </div>

</div>

<script>
// Cascade taxonomy (same logic as quick form)
document.addEventListener('DOMContentLoaded', () => {
  const catSelect  = document.getElementById('article_category_id');
  const subSelect  = document.getElementById('article_sub_category_id');
  const typeSelect = document.getElementById('article_type_id');
  if (!catSelect || !subSelect || !typeSelect) return;

  const oldSub  = <?php echo json_encode(old('article_sub_category_id', $console->article_sub_category_id), 512) ?>;
  const oldType = <?php echo json_encode(old('article_type_id', $console->article_type_id), 512) ?>;

  function clearSelect(sel, placeholder = '— Choisir —') {
    sel.innerHTML = '';
    const opt = document.createElement('option'); opt.value = ''; opt.textContent = placeholder; sel.appendChild(opt);
  }

  async function fetchJson(url) { const res = await fetch(url, { headers: { 'Accept': 'application/json' }}); if (!res.ok) throw new Error(`HTTP ${res.status}`); return await res.json(); }

  async function loadSubCategories(categoryId, applyOld = false) {
    clearSelect(subSelect); clearSelect(typeSelect);
    if (!categoryId) return;
    const url = `<?php echo e(route('admin.ajax.sub-categories', ['category' => '__ID__'])); ?>`.replace('__ID__', categoryId);
    const data = await fetchJson(url);
    const list = Array.isArray(data) ? data : (data.data ?? []);
    list.forEach(sc => { const opt = document.createElement('option'); opt.value = sc.id; opt.textContent = sc.name; subSelect.appendChild(opt); });
    if (applyOld && oldSub) { subSelect.value = String(oldSub); if (subSelect.value) await loadTypes(subSelect.value, true); }
  }

  async function loadTypes(subCategoryId, applyOld = false) {
    clearSelect(typeSelect);
    if (!subCategoryId) return;
    const url = `<?php echo e(route('admin.ajax.types', ['subCategory' => '__ID__'])); ?>`.replace('__ID__', subCategoryId);
    const data = await fetchJson(url);
    const list = Array.isArray(data) ? data : (data.data ?? []);
    list.forEach(t => { const opt = document.createElement('option'); opt.value = t.id; opt.textContent = t.name; typeSelect.appendChild(opt); });
    if (applyOld && oldType) { typeSelect.value = String(oldType); }
  }

  catSelect.addEventListener('change', async () => { try { await loadSubCategories(catSelect.value, false); } catch(e){console.error(e);} });
  subSelect.addEventListener('change', async () => { try { await loadTypes(subSelect.value, false); } catch(e){console.error(e);} });

  (async () => { clearSelect(subSelect); clearSelect(typeSelect); if (catSelect.value) { try{ await loadSubCategories(catSelect.value, true); } catch(e){console.error(e);} } })();
});
</script>

<script>

</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/consoles/edit_full.blade.php ENDPATH**/ ?>