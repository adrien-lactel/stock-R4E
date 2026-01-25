

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
    <h2 class="text-lg font-semibold text-gray-800">Classification</h2>

    
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
        title="Recharger pour récupérer la nouvelle classification">
        ↻ Rafraîchir
        </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4">

    
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
            <label id="brand_label" class="block text-sm font-medium">Marque *</label>

            <a href="<?php echo e(route('admin.taxonomy.index')); ?>#brands"
               target="_blank"
               class="text-indigo-600 hover:underline text-sm"
               title="Ajouter / éditer une marque">
                +
            </a>
        </div>

        <select id="article_brand_id"
                name="article_brand_id"
                class="w-full rounded border-gray-300"
                required>
            <option value="">— Choisir —</option>
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

    
    <div class="md:col-span-3" id="description_field" style="display: none;">
        <label class="block text-sm font-medium mb-1">Description du produit</label>
        <textarea id="article_type_description"
                  name="article_type_description"
                  rows="4"
                  class="w-full rounded border-gray-300"
                  placeholder="Décrivez les caractéristiques, les meilleurs jeux, les détails techniques..."></textarea>
        <p class="text-xs text-gray-500 mt-1">
            ℹ️ Cette description sera partagée par tous les articles de ce type. 
            Modifier cette description mettra à jour tous les articles existants.
        </p>
    </div>

</div>

            
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div id="region_field">
                    <label class="block text-sm font-medium mb-1">Région</label>
                    <select name="region" class="w-full rounded border-gray-300">
                        <option value="">— Non spécifiée —</option>
                        <option value="PAL" <?php if(old('region', $console->region) === 'PAL'): echo 'selected'; endif; ?>>🇪🇺 PAL (Europe)</option>
                        <option value="NTSC-U" <?php if(old('region', $console->region) === 'NTSC-U'): echo 'selected'; endif; ?>>🇺🇸 NTSC-U (USA)</option>
                        <option value="NTSC-J" <?php if(old('region', $console->region) === 'NTSC-J'): echo 'selected'; endif; ?>>🇯🇵 NTSC-J (Japon)</option>
                        <option value="Région libre" <?php if(old('region', $console->region) === 'Région libre'): echo 'selected'; endif; ?>>🌍 Région libre</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Important pour N64, SNES, GameCube, etc.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">État de complétude</label>
                        
                        <!-- Pour les consoles et accessoires -->
                        <select name="completeness" id="completeness_console" class="w-full rounded border-gray-300">
                            <option value="">— Non spécifié —</option>
                            <option value="Console seule" <?php if(old('completeness', $console->completeness) === 'Console seule'): echo 'selected'; endif; ?>>📦 Console seule</option>
                            <option value="Avec boîte" <?php if(old('completeness', $console->completeness) === 'Avec boîte'): echo 'selected'; endif; ?>>📦📄 Avec boîte</option>
                            <option value="Complète en boîte" <?php if(old('completeness', $console->completeness) === 'Complète en boîte'): echo 'selected'; endif; ?>>📦📄🎮 Complète en boîte</option>
                        </select>
                        
                        <!-- Pour les jeux vidéo -->
                        <select name="completeness" id="completeness_game" class="w-full rounded border-gray-300" style="display: none;">
                            <option value="">— Non spécifié —</option>
                            <option value="Loose" <?php if(old('completeness', $console->completeness) === 'Loose'): echo 'selected'; endif; ?>>🎮 Loose (jeu seul)</option>
                            <option value="Avec boîte" <?php if(old('completeness', $console->completeness) === 'Avec boîte'): echo 'selected'; endif; ?>>📦 Avec boîte</option>
                            <option value="Avec boîte et notice" <?php if(old('completeness', $console->completeness) === 'Avec boîte et notice'): echo 'selected'; endif; ?>>📦📄 Avec boîte et notice</option>
                        </select>
                        
                        <p class="text-xs text-gray-500 mt-1" id="completeness_hint_console">Console seule, avec sa boîte, ou complète avec accessoires</p>
                        <p class="text-xs text-gray-500 mt-1" id="completeness_hint_game" style="display: none;">Jeu seul (loose), avec boîte, ou complet avec notice</p>
                    </div>

                    <div id="publisher_field" style="display: none;">
                        <label class="block text-sm font-medium mb-1">Éditeur</label>
                        <select name="publisher" class="w-full rounded border-gray-300">
                            <option value="">— Aucun —</option>
                            <optgroup label="🎮 Éditeurs Principaux">
                                <option value="Nintendo" <?php if(old('publisher', $console->publisher) === 'Nintendo'): echo 'selected'; endif; ?>>Nintendo</option>
                                <option value="Sony" <?php if(old('publisher', $console->publisher) === 'Sony'): echo 'selected'; endif; ?>>Sony</option>
                                <option value="Microsoft" <?php if(old('publisher', $console->publisher) === 'Microsoft'): echo 'selected'; endif; ?>>Microsoft</option>
                                <option value="Sega" <?php if(old('publisher', $console->publisher) === 'Sega'): echo 'selected'; endif; ?>>Sega</option>
                            </optgroup>
                            <optgroup label="🇯🇵 Éditeurs Japonais">
                                <option value="Square Enix" <?php if(old('publisher', $console->publisher) === 'Square Enix'): echo 'selected'; endif; ?>>Square Enix</option>
                                <option value="Capcom" <?php if(old('publisher', $console->publisher) === 'Capcom'): echo 'selected'; endif; ?>>Capcom</option>
                                <option value="Konami" <?php if(old('publisher', $console->publisher) === 'Konami'): echo 'selected'; endif; ?>>Konami</option>
                                <option value="Bandai Namco" <?php if(old('publisher', $console->publisher) === 'Bandai Namco'): echo 'selected'; endif; ?>>Bandai Namco</option>
                                <option value="Atlus" <?php if(old('publisher', $console->publisher) === 'Atlus'): echo 'selected'; endif; ?>>Atlus</option>
                                <option value="FromSoftware" <?php if(old('publisher', $console->publisher) === 'FromSoftware'): echo 'selected'; endif; ?>>FromSoftware</option>
                                <option value="Game Freak" <?php if(old('publisher', $console->publisher) === 'Game Freak'): echo 'selected'; endif; ?>>Game Freak</option>
                            </optgroup>
                            <optgroup label="🌍 Éditeurs Occidentaux">
                                <option value="Electronic Arts" <?php if(old('publisher', $console->publisher) === 'Electronic Arts'): echo 'selected'; endif; ?>>Electronic Arts</option>
                                <option value="Activision" <?php if(old('publisher', $console->publisher) === 'Activision'): echo 'selected'; endif; ?>>Activision</option>
                                <option value="Ubisoft" <?php if(old('publisher', $console->publisher) === 'Ubisoft'): echo 'selected'; endif; ?>>Ubisoft</option>
                                <option value="Rockstar Games" <?php if(old('publisher', $console->publisher) === 'Rockstar Games'): echo 'selected'; endif; ?>>Rockstar Games</option>
                                <option value="Bethesda" <?php if(old('publisher', $console->publisher) === 'Bethesda'): echo 'selected'; endif; ?>>Bethesda</option>
                                <option value="2K Games" <?php if(old('publisher', $console->publisher) === '2K Games'): echo 'selected'; endif; ?>>2K Games</option>
                            </optgroup>
                            <optgroup label="🎨 Autres">
                                <option value="THQ" <?php if(old('publisher', $console->publisher) === 'THQ'): echo 'selected'; endif; ?>>THQ</option>
                                <option value="SNK" <?php if(old('publisher', $console->publisher) === 'SNK'): echo 'selected'; endif; ?>>SNK</option>
                                <option value="Arc System Works" <?php if(old('publisher', $console->publisher) === 'Arc System Works'): echo 'selected'; endif; ?>>Arc System Works</option>
                                <option value="Autre" <?php if(old('publisher', $console->publisher) === 'Autre'): echo 'selected'; endif; ?>>Autre</option>
                            </optgroup>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Éditeur du jeu vidéo</p>
                    </div>
                </div>

                <div id="language_field" style="display: none;">
                    <label class="block text-sm font-medium mb-1">Langue</label>
                    <select name="language" class="w-full rounded border-gray-300">
                        <option value="">— Non spécifiée —</option>
                        <option value="Français" <?php if(old('language', $console->language) === 'Français'): echo 'selected'; endif; ?>>🇫🇷 Français</option>
                        <option value="Anglais" <?php if(old('language', $console->language) === 'Anglais'): echo 'selected'; endif; ?>>🇬🇧 Anglais</option>
                        <option value="Japonais" <?php if(old('language', $console->language) === 'Japonais'): echo 'selected'; endif; ?>>🇯🇵 Japonais</option>
                        <option value="Allemand" <?php if(old('language', $console->language) === 'Allemand'): echo 'selected'; endif; ?>>🇩🇪 Allemand</option>
                        <option value="Italien" <?php if(old('language', $console->language) === 'Italien'): echo 'selected'; endif; ?>>🇮🇹 Italien</option>
                        <option value="Espagnol" <?php if(old('language', $console->language) === 'Espagnol'): echo 'selected'; endif; ?>>🇪🇸 Espagnol</option>
                        <option value="Coréen" <?php if(old('language', $console->language) === 'Coréen'): echo 'selected'; endif; ?>>🇰🇷 Coréen</option>
                        <option value="Chinois" <?php if(old('language', $console->language) === 'Chinois'): echo 'selected'; endif; ?>>🇨🇳 Chinois</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Pour les cartes à collectionner uniquement</p>
                </div>

                
                <div id="article_images_field" style="display: none;">
                    <label class="block text-sm font-medium mb-2">📷 Images de l'article</label>
                    
                    <!-- Zone de drag & drop -->
                    <div id="dropzone"
                         class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-indigo-500 transition-colors bg-gray-50">
                        <div class="mb-3">
                            <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                        </div>
                        <p class="text-sm text-gray-600 mb-1">
                            <span class="font-semibold text-indigo-600">Cliquez pour sélectionner</span>
                            ou glissez-déposez vos images
                        </p>
                        <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP jusqu'à 10 MB • 📱 Appareil photo ou galerie sur mobile</p>
                    </div>

                    <input type="file" id="file-input" accept="image/*" multiple class="hidden">

                    <!-- Prévisualisation des images -->
                    <div id="preview-container" class="grid grid-cols-3 gap-4 mt-4"></div>

                    <p class="text-xs text-gray-500 mt-2">
                        💾 Les images sont automatiquement enregistrées dans la taxonomie de l'article
                    </p>
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
  const brand = document.getElementById('article_brand_id');
  const sub = document.getElementById('article_sub_category_id');
  const type = document.getElementById('article_type_id');

  if (!cat || !brand || !sub || !type) return;

  const oldBrand = <?php echo json_encode(old('article_brand_id', $console->article_brand_id ?? null), 512) ?>;
  const oldSub = <?php echo json_encode(old('article_sub_category_id', $console->article_sub_category_id), 512) ?>;
  const oldType = <?php echo json_encode(old('article_type_id', $console->article_type_id), 512) ?>;

  function clear(sel, placeholder = '— Choisir —') {
    sel.innerHTML = `<option value="">${placeholder}</option>`;
  }

  async function loadBrands(catId) {
    clear(brand); clear(sub); clear(type);
    if (!catId) return;
    
    // Afficher/masquer les champs selon la catégorie
    const languageField = document.getElementById('language_field');
    const regionField = document.getElementById('region_field');
    const publisherField = document.getElementById('publisher_field');
    const articleImagesField = document.getElementById('article_images_field');
    const completenessConsole = document.getElementById('completeness_console');
    const completenessGame = document.getElementById('completeness_game');
    const completenessHintConsole = document.getElementById('completeness_hint_console');
    const completenessHintGame = document.getElementById('completeness_hint_game');
    const brandLabel = document.getElementById('brand_label');
    const selectedCategory = cat.options[cat.selectedIndex].text;
    
    if (selectedCategory.includes('Cartes à collectionner')) {
      if (languageField) languageField.style.display = 'block';
      if (regionField) regionField.style.display = 'none';
      if (publisherField) publisherField.style.display = 'none';
      if (articleImagesField) articleImagesField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    } else if (selectedCategory.includes('Accessoires')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'none';
      if (articleImagesField) articleImagesField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Compatibilité *';
    } else if (selectedCategory.includes('Jeux vidéo')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'block';
      // Le champ images sera affiché par le listener du type
      if (completenessConsole) completenessConsole.style.display = 'none';
      if (completenessGame) completenessGame.style.display = 'block';
      if (completenessHintConsole) completenessHintConsole.style.display = 'none';
      if (completenessHintGame) completenessHintGame.style.display = 'block';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    } else {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'none';
      // Le champ images sera affiché par le listener du type
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    }
    
    try {
      const url = `<?php echo e(url('admin/ajax/brands')); ?>/${catId}`;
      const response = await fetch(url);
      const html = await response.text();
      brand.innerHTML = html;
      if (oldBrand) { brand.value = oldBrand; loadSubs(oldBrand); }
    } catch (e) {
      console.error('Erreur chargement marques:', e);
    }
  }

  async function loadSubs(brandId) {
    clear(sub); clear(type);
    if (!brandId) return;
    try {
      const url = `<?php echo e(url('admin/ajax/sub-categories')); ?>/${brandId}`;
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

  // Charger la description du type sélectionné
  async function loadTypeDescription(typeId) {
    const descField = document.getElementById('description_field');
    const descTextarea = document.getElementById('article_type_description');
    
    if (!typeId) {
      descField.style.display = 'none';
      descTextarea.value = '';
      return;
    }
    
    try {
      const response = await fetch(`<?php echo e(url('admin/ajax/type-description')); ?>/${typeId}`);
      const data = await response.json();
      descTextarea.value = data.description || '';
      descField.style.display = 'block';
    } catch (e) {
      console.error('Erreur chargement description:', e);
      descField.style.display = 'block';
    }
  }

  cat.addEventListener('change', e => loadBrands(e.target.value));
  brand.addEventListener('change', e => loadSubs(e.target.value));
  sub.addEventListener('change', e => loadTypes(e.target.value));
  type.addEventListener('change', e => loadTypeDescription(e.target.value));

  if (cat.value) loadBrands(cat.value);
  
  // ✅ Charger la description si un type est déjà sélectionné (mode édition)
  if (type.value) {
    loadTypeDescription(type.value);
  }
  
  // Afficher/masquer les champs selon la catégorie en mode édition
  window.addEventListener('DOMContentLoaded', () => {
    const languageField = document.getElementById('language_field');
    const regionField = document.getElementById('region_field');
    const publisherField = document.getElementById('publisher_field');
    const completenessConsole = document.getElementById('completeness_console');
    const completenessGame = document.getElementById('completeness_game');
    const completenessHintConsole = document.getElementById('completeness_hint_console');
    const completenessHintGame = document.getElementById('completeness_hint_game');
    const brandLabel = document.getElementById('brand_label');
    const selectedCategory = cat.options[cat.selectedIndex]?.text || '';
    
    if (selectedCategory.includes('Cartes à collectionner')) {
      if (languageField) languageField.style.display = 'block';
      if (regionField) regionField.style.display = 'none';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    } else if (selectedCategory.includes('Accessoires')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Compatibilité *';
    } else if (selectedCategory.includes('Jeux vidéo')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'block';
      if (completenessConsole) completenessConsole.style.display = 'none';
      if (completenessGame) completenessGame.style.display = 'block';
      if (completenessHintConsole) completenessHintConsole.style.display = 'none';
      if (completenessHintGame) completenessHintGame.style.display = 'block';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    } else {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    }
  });
})();

/* =====================================================
   DRAG & DROP UPLOAD D'IMAGES
===================================================== */
(function() {
  const dropzone = document.getElementById('dropzone');
  const fileInput = document.getElementById('file-input');
  const previewContainer = document.getElementById('preview-container');
  const articleImagesField = document.getElementById('article_images_field');
  const typeSelect = document.getElementById('article_type_id');

  if (!dropzone || !fileInput || !previewContainer) return;

  let currentArticleTypeId = null;

  // Afficher le champ images lorsqu'un type est sélectionné
  if (typeSelect) {
    typeSelect.addEventListener('change', function() {
      currentArticleTypeId = this.value;
      if (currentArticleTypeId && articleImagesField) {
        articleImagesField.style.display = 'block';
        loadExistingImages(currentArticleTypeId);
      } else if (articleImagesField) {
        articleImagesField.style.display = 'none';
        previewContainer.innerHTML = '';
      }
    });

    // Charger les images si un type est déjà sélectionné (mode édition)
    if (typeSelect.value) {
      currentArticleTypeId = typeSelect.value;
      articleImagesField.style.display = 'block';
      loadExistingImages(currentArticleTypeId);
    }
  }

  // Charger les images existantes de l'article_type
  async function loadExistingImages(typeId) {
    try {
      const response = await fetch(`<?php echo e(url('admin/ajax/type-description')); ?>/${typeId}`);
      const data = await response.json();
      
      if (data.images && data.images.length > 0) {
        previewContainer.innerHTML = '';
        data.images.forEach(url => {
          addImagePreview(url, typeId, true);
        });
      }
    } catch (e) {
      console.error('Erreur chargement images:', e);
    }
  }

  // Clic sur la zone de dépôt
  dropzone.addEventListener('click', () => fileInput.click());

  // Drag & drop
  dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('border-indigo-500', 'bg-indigo-50');
  });

  dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('border-indigo-500', 'bg-indigo-50');
  });

  dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('border-indigo-500', 'bg-indigo-50');
    const files = e.dataTransfer.files;
    handleFiles(files);
  });

  // Sélection de fichiers
  fileInput.addEventListener('change', (e) => {
    handleFiles(e.target.files);
  });

  // Gérer les fichiers uploadés
  async function handleFiles(files) {
    if (!currentArticleTypeId) {
      alert('Veuillez d\'abord sélectionner un type d\'article');
      return;
    }

    for (let file of files) {
      if (!file.type.startsWith('image/')) continue;

      const formData = new FormData();
      formData.append('image', file);
      formData.append('article_type_id', currentArticleTypeId);

      try {
        const response = await fetch('<?php echo e(route('admin.articles.upload-image')); ?>', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: formData
        });

        const data = await response.json();

        if (data.success) {
          addImagePreview(data.url, currentArticleTypeId, false);
        } else {
          alert('Erreur upload: ' + data.message);
        }
      } catch (e) {
        console.error('Erreur upload:', e);
        alert('Erreur lors de l\'upload');
      }
    }

    fileInput.value = ''; // Reset input
  }

  // Ajouter une prévisualisation d'image
  function addImagePreview(url, typeId, isExisting) {
    const div = document.createElement('div');
    div.className = 'relative group';
    
    div.innerHTML = `
      <img src="${url}" class="w-full h-32 object-cover rounded-lg border border-gray-200">
      <button type="button" 
              class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600"
              onclick="deleteImage('${url}', ${typeId}, this.parentElement)">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
      ${isExisting ? '<span class="absolute bottom-2 left-2 bg-blue-500 text-white text-xs px-2 py-1 rounded">Taxonomie</span>' : ''}
    `;
    
    previewContainer.appendChild(div);
  }

  // Fonction globale pour supprimer une image
  window.deleteImage = async function(url, typeId, element) {
    if (!confirm('Supprimer cette image de la taxonomie ?')) return;

    try {
      const response = await fetch('<?php echo e(route('admin.articles.delete-image')); ?>', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          image_url: url,
          article_type_id: typeId
        })
      });

      const data = await response.json();

      if (data.success) {
        element.remove();
      } else {
        alert('Erreur: ' + data.message);
      }
    } catch (e) {
      console.error('Erreur suppression:', e);
      alert('Erreur lors de la suppression');
    }
  };
})();
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\stock-R4E\resources\views/admin/consoles/form.blade.php ENDPATH**/ ?>