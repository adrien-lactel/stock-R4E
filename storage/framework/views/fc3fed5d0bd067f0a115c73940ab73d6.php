

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'articleTypeId' => null,
    'articleTypeName' => null,
    'romId' => null,
    'uploadedImages' => [],
    'primaryImage' => ''
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'articleTypeId' => null,
    'articleTypeName' => null,
    'romId' => null,
    'uploadedImages' => [],
    'primaryImage' => ''
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<div class="mb-6">
    <h3 class="text-lg font-semibold text-gray-800 mb-4">📷 Images de l'article</h3>
    
    <!-- Bouton pour voir les photos génériques de la taxonomie -->
    <?php if($romId || $articleTypeId): ?>
    <button type="button" 
            onclick="openTaxonomyImagesModal()"
            class="w-full border-2 border-blue-500 rounded-lg p-4 text-center cursor-pointer hover:bg-blue-50 transition-colors bg-white mb-4">
        <div class="flex items-center justify-center gap-3">
            <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            <div class="text-left">
                <p class="text-sm font-semibold text-blue-600">
                    🖼️ Voir les photos génériques (<?php echo e($romId ?? $articleTypeName ?? 'Type'); ?>)
                </p>
                <p class="text-xs text-gray-500">
                    Photos de la taxonomie partagées avec tous les exemplaires de ce type
                </p>
            </div>
        </div>
    </button>
    <?php endif; ?>
    
    <button type="button" 
            onclick="openArticleImagesModal()"
            class="w-full border-2 border-dashed border-indigo-300 rounded-lg p-8 text-center cursor-pointer hover:border-indigo-500 transition-colors bg-indigo-50 mb-4">
        <div class="mb-3">
            <svg class="w-12 h-12 text-indigo-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
        </div>
        <p class="text-lg font-semibold text-indigo-600 mb-1">
            📸 Gérer les photos de l'article
        </p>
        <p class="text-sm text-gray-600">
            Cliquez pour ouvrir la galerie et prendre/ajouter des photos
        </p>
    </button>
    
    <!-- Prévisualisation des photos de l'article -->
    <div id="game-images-preview" class="grid grid-cols-4 gap-4 mb-4"></div>
    
    <p class="text-xs text-gray-500 italic">
        💡 Ces photos sont spécifiques à cet article et seront affichées sur la fiche produit.
    </p>
</div>

<!-- Champs cachés pour les données -->
<input type="hidden" id="article-type-id-value" value="<?php echo e($articleTypeId); ?>">
<input type="hidden" id="uploaded-images-value" value="<?php echo e(json_encode($uploadedImages)); ?>">
<input type="hidden" id="primary-image-value" value="<?php echo e($primaryImage); ?>">

<script>
// Initialiser les variables globales lors du chargement du composant
document.addEventListener('DOMContentLoaded', function() {
    // Ces variables seront disponibles pour article-images-manager.js
    window.articleImagesConfig = {
        articleTypeId: document.getElementById('article-type-id-value')?.value || null,
        uploadedImages: JSON.parse(document.getElementById('uploaded-images-value')?.value || '[]'),
        primaryImage: document.getElementById('primary-image-value')?.value || ''
    };
    
    console.log('📦 Configuration images article chargée:', window.articleImagesConfig);
    
    // Initialiser les variables globales si article-images-manager.js est chargé
    if (typeof initializeArticleImagesManager === 'function') {
        initializeArticleImagesManager();
    }
});
</script>
<?php /**PATH C:\laragon\www\stock-R4E\resources\views/components/article-images-manager.blade.php ENDPATH**/ ?>