@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🖼️ Créer une fiche produit</h1>
        <a href="{{ route('admin.product-sheets.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour</a>
    </div>

    {{-- MESSAGES --}}
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 text-red-800 rounded border border-red-200">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- FORMULAIRE --}}
    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('admin.product-sheets.store') }}" id="productSheetForm">
            @csrf

            {{-- CLASSIFICATION --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Type de produit</h2>

                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    {{-- Catégorie --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Catégorie *</label>
                        <select name="category_temp" id="category_select" 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            <option value="">-- Sélectionner --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ isset($selectedCategory) && $selectedCategory->id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Marque --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Marque *</label>
                        <select name="brand_temp" id="brand_select"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required {{ isset($selectedCategory) ? '' : 'disabled' }}>
                            <option value="">-- Sélectionner une catégorie d'abord --</option>
                            @if(isset($selectedCategory) && isset($selectedCategory->brands))
                                @foreach($selectedCategory->brands as $brand)
                                    <option value="{{ $brand->id }}" {{ isset($selectedBrand) && $selectedBrand->id == $brand->id ? 'selected' : '' }}>
                                        {{ $brand->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- Sous-catégorie --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Sous-catégorie *</label>
                        <select name="sub_category_temp" id="sub_category_select"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required {{ isset($selectedBrand) ? '' : 'disabled' }}>
                            <option value="">-- Sélectionner une marque d'abord --</option>
                            @if(isset($selectedBrand) && isset($selectedBrand->subCategories))
                                @foreach($selectedBrand->subCategories as $sub)
                                    <option value="{{ $sub->id }}" {{ isset($selectedSubCategory) && $selectedSubCategory->id == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>

                    {{-- Type --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Type *</label>
                        <select name="article_type_id" id="type_select"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required {{ isset($selectedSubCategory) ? '' : 'disabled' }}>
                            <option value="">-- Sélectionner une sous-catégorie d'abord --</option>
                            @if(isset($selectedSubCategory) && isset($selectedSubCategory->types))
                                @foreach($selectedSubCategory->types as $type)
                                    <option value="{{ $type->id }}" {{ isset($selectedType) && $selectedType->id == $type->id ? 'selected' : '' }}>
                                        {{ $type->name }}
                                    </option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            {{-- INFORMATIONS PRODUIT --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informations produit</h2>

                <div class="space-y-4">
                    {{-- Complétude --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Complétude *</label>
                        <select name="completeness_type" id="completeness_type"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required>
                            <option value="">-- Sélectionner --</option>
                            <option value="Loose">Loose (jeu seul)</option>
                            <option value="CIB">CIB (complet boîte + notice)</option>
                            <option value="Sealed">Sealed (neuf scellé)</option>
                            <option value="Boîte + jeu">Boîte + jeu (sans notice)</option>
                            <option value="Console seule">Console seule</option>
                            <option value="Console complète">Console complète (avec accessoires)</option>
                        </select>
                    </div>
                    
                    {{-- Nom (généré automatiquement) --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Nom de la fiche *</label>
                        <input type="text" name="name" id="product_name"
                               value="{{ old('name') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 bg-gray-50"
                               placeholder="Sélectionnez la taxonomie et la complétude"
                               readonly required>
                        <p class="text-xs text-gray-500 mt-1">
                            💡 Le nom est généré automatiquement : Type + Complétude
                        </p>
                    </div>

                    {{-- Description produit --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Description du produit</label>
                        <textarea name="description" rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Description générale du produit...">{{ old('description') }}</textarea>
                    </div>

                    {{-- Caractéristiques techniques --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Caractéristiques techniques</label>
                        <textarea name="technical_specs" rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Processeur, RAM, stockage, connectivité...">{{ old('technical_specs') }}</textarea>
                    </div>

                    {{-- Accessoires inclus --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Accessoires inclus</label>
                        <textarea name="included_items" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Câble HDMI, manette, câble d'alimentation...">{{ old('included_items') }}</textarea>
                    </div>

                    {{-- Description marketing --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Description marketing</label>
                        <textarea name="marketing_description" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Texte commercial pour mettre en avant le produit...">{{ old('marketing_description') }}</textarea>
                    </div>
                </div>
            </div>

            {{-- CRITÈRES DE COLLECTION --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">⭐ Critères de collection</h2>
                <p class="text-sm text-gray-600 mb-4">Cochez les critères que vous souhaitez afficher sur cette fiche produit</p>

                {{-- Sélection des critères --}}
                <div class="mb-6 grid grid-cols-2 md:grid-cols-3 gap-3">
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="box_condition" checked>
                        <span class="ml-2 text-sm">État de la boîte</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="manual_condition" checked>
                        <span class="ml-2 text-sm">État du manuel</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="media_condition" checked>
                        <span class="ml-2 text-sm">État du support</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="completeness" checked>
                        <span class="ml-2 text-sm">Complétude</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="rarity" checked>
                        <span class="ml-2 text-sm">Rareté</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="criterion-toggle rounded" value="overall_condition" checked>
                        <span class="ml-2 text-sm">État général</span>
                    </label>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Boîte --}}
                    <div class="border rounded-lg p-4" data-criterion-container="box_condition">
                        <label class="block text-sm font-medium mb-2">État de la boîte</label>
                        <div class="flex gap-1" data-criterion="box_condition">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('box_condition', {{ $i }})" 
                                        class="star-btn text-3xl text-gray-300 hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>

                    {{-- Manuel --}}
                    <div class="border rounded-lg p-4" data-criterion-container="manual_condition">
                        <label class="block text-sm font-medium mb-2">État du manuel</label>
                        <div class="flex gap-1" data-criterion="manual_condition">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('manual_condition', {{ $i }})" 
                                        class="star-btn text-3xl text-gray-300 hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>

                    {{-- Support physique (jeu/console) --}}
                    <div class="border rounded-lg p-4" data-criterion-container="media_condition">
                        <label class="block text-sm font-medium mb-2">État du support (jeu/console)</label>
                        <div class="flex gap-1" data-criterion="media_condition">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('media_condition', {{ $i }})" 
                                        class="star-btn text-3xl text-gray-300 hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>

                    {{-- Complétude --}}
                    <div class="border rounded-lg p-4" data-criterion-container="completeness">
                        <label class="block text-sm font-medium mb-2">Complétude</label>
                        <div class="flex gap-1" data-criterion="completeness">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('completeness', {{ $i }})" 
                                        class="star-btn text-3xl text-gray-300 hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>

                    {{-- Rareté --}}
                    <div class="border rounded-lg p-4" data-criterion-container="rarity">
                        <label class="block text-sm font-medium mb-2">Rareté</label>
                        <div class="flex gap-1" data-criterion="rarity">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('rarity', {{ $i }})" 
                                        class="star-btn text-3xl text-gray-300 hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>

                    {{-- État général --}}
                    <div class="border rounded-lg p-4" data-criterion-container="overall_condition">
                        <label class="block text-sm font-medium mb-2">État général</label>
                        <div class="flex gap-1" data-criterion="overall_condition">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('overall_condition', {{ $i }})" 
                                        class="star-btn text-3xl text-gray-300 hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>
                </div>

                <input type="hidden" name="condition_criteria" id="condition_criteria_input" value="{}">
            </div>

            {{-- MODS DISPONIBLES --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">🔧 Mods / Accessoires / Opérations</h2>
                <p class="text-sm text-gray-600 mb-4">Cochez les mods que vous souhaitez afficher sur la miniature de cette fiche</p>

                @if($mods->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-4">
                        @foreach($mods as $mod)
                            <label class="flex items-start border rounded-lg p-3 hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="mod-checkbox rounded mt-1 mr-2" value="{{ $mod->id }}" data-name="{{ $mod->name }}" data-icon="{{ $mod->icon ?? '🔧' }}">
                                <div class="flex-1">
                                    <div class="font-medium text-sm flex items-center gap-2">
                                        @if($mod->icon && str_starts_with($mod->icon, 'data:image/'))
                                            <img src="{{ $mod->icon }}" alt="{{ $mod->name }}" class="w-5 h-5" style="image-rendering: pixelated;">
                                        @else
                                            <span class="text-lg">{{ $mod->icon ?? '🔧' }}</span>
                                        @endif
                                        <span>{{ $mod->name }}</span>
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $mod->type }}</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">Aucun mod disponible. <a href="{{ route('admin.mods.create') }}" class="text-indigo-600 hover:underline">Créer un mod</a></p>
                @endif

                <input type="hidden" name="featured_mods" id="featured_mods_input" value="[]">
            </div>

            {{-- IMAGES --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Images du produit</h2>

                {{-- Zone d'upload --}}
                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Ou uploader depuis votre ordinateur</label>
                    <div class="flex items-center gap-3">
                        <label for="image_upload" class="cursor-pointer inline-flex items-center px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                            📤 Choisir des images
                            <input type="file" id="image_upload" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/avif" multiple class="hidden">
                        </label>
                        <p class="text-xs text-gray-500">JPG, PNG, GIF, WEBP, AVIF (max 5MB par image)</p>
                    </div>
                    <div id="upload_progress" class="hidden mt-2">
                        <div class="w-full bg-gray-200 rounded-full h-2">
                            <div id="progress_bar" class="bg-indigo-600 h-2 rounded-full transition-all" style="width: 0%"></div>
                        </div>
                        <p id="upload_status" class="text-xs text-gray-600 mt-1">Upload en cours...</p>
                    </div>
                </div>

                {{-- Images sélectionnées --}}
                <div id="selectedImages" class="hidden">
                    <p class="text-sm font-medium mb-3">Images ajoutées :</p>
                    <div id="selectedImagesList" class="grid grid-cols-2 md:grid-cols-6 gap-3 mb-4">
                        {{-- Les images seront affichées ici --}}
                    </div>
                </div>

                {{-- GALERIE D'IMAGES DE CATÉGORIE --}}
                <div id="taxonomy_gallery_container" class="hidden mt-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                    <div class="flex items-center justify-between mb-3">
                        <h3 class="text-sm font-semibold text-blue-900">
                            📚 Images existantes pour cette catégorie
                        </h3>
                        <button type="button" 
                                onclick="document.getElementById('taxonomy_gallery_container').classList.add('hidden')"
                                class="text-blue-600 hover:text-blue-800 text-sm">
                            Masquer
                        </button>
                    </div>
                    <p class="text-xs text-blue-700 mb-3">Cliquez sur une image pour l'ajouter à votre fiche</p>
                    <div id="taxonomy_gallery" class="grid grid-cols-3 md:grid-cols-8 gap-2 max-h-64 overflow-y-auto">
                        {{-- Les images de catégorie seront chargées ici --}}
                    </div>
                </div>

                <input type="hidden" name="images" id="images_input">
                <input type="hidden" name="main_image" id="main_image_input">
            </div>

            {{-- TAGS --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Tags (optionnel)</h2>
                <input type="text" id="tags_input"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="Ex: gaming, console, sony (séparés par des virgules)">
                <input type="hidden" name="tags" id="tags_hidden">
            </div>

            {{-- STATUT --}}
            <div class="mb-8">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" checked
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm">Fiche active</span>
                </label>
            </div>

            {{-- ACTIONS --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.product-sheets.index') }}" 
                   class="px-4 py-2 rounded border hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    💾 Enregistrer
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gestion des étoiles pour critères de collection
    let conditionCriteria = {};

    window.setRating = function(criterion, rating) {
        conditionCriteria[criterion] = rating;
        
        // Mettre à jour l'affichage des étoiles
        const container = document.querySelector('[data-criterion="' + criterion + '"]');
        const stars = container.querySelectorAll('.star-btn');
        
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });

        // Mettre à jour le champ hidden
        document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
    };

    // Gestion de l'affichage/masquage des critères
    document.querySelectorAll('.criterion-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const criterion = this.value;
            const container = document.querySelector(`[data-criterion-container="${criterion}"]`);
            
            if (this.checked) {
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
                // Supprimer la valeur du critère désactivé
                delete conditionCriteria[criterion];
                // Réinitialiser les étoiles
                const stars = container.querySelectorAll('.star-btn');
                stars.forEach(star => {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                });
                // Mettre à jour le champ hidden
                document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
            }
        });
    });

    // Gestion des mods sélectionnés
    let featuredMods = [];
    document.querySelectorAll('.mod-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                featuredMods.push({
                    id: parseInt(this.value),
                    name: this.dataset.name,
                    icon: this.dataset.icon || '🔧'
                });
            } else {
                featuredMods = featuredMods.filter(m => m.id !== parseInt(this.value));
            }
            document.getElementById('featured_mods_input').value = JSON.stringify(featuredMods);
        });
    });

    // Mettre à jour les champs hidden avant la soumission du formulaire
    document.querySelector('form').addEventListener('submit', function(e) {
        // Mettre à jour condition_criteria
        document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
        // Mettre à jour tags
        const tagsInput = document.getElementById('tags_input').value;
        const tagsArray = tagsInput.split(',').map(tag => tag.trim()).filter(tag => tag);
        document.getElementById('tags_hidden').value = JSON.stringify(tagsArray);
    });

    // Cascading selects pour classification
    (function initTaxonomy() {
        const categorySelect = document.getElementById('category_select');
        const brandSelect = document.getElementById('brand_select');
        const subCategorySelect = document.getElementById('sub_category_select');
        const typeSelect = document.getElementById('type_select');

        if (!categorySelect || !brandSelect || !subCategorySelect || !typeSelect) {
            console.error('❌ Selects de classification non trouvés');
            return;
        }

        console.log('✅ Classification initialisée');

        categorySelect.addEventListener('change', async function() {
            const categoryId = this.value;
            console.log('📋 Catégorie sélectionnée:', categoryId);

            brandSelect.disabled = true;
            subCategorySelect.disabled = true;
            typeSelect.disabled = true;
            brandSelect.innerHTML = '<option value="">Chargement...</option>';
            subCategorySelect.innerHTML = '<option value="">-- Sélectionner une marque d\'abord --</option>';
            typeSelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie d\'abord --</option>';

            if (!categoryId) {
                brandSelect.innerHTML = '<option value="">-- Sélectionner une catégorie d\'abord --</option>';
                brandSelect.disabled = true;
                return;
            }

            try {
                const url = `{{ url('admin/ajax/brands') }}/${categoryId}`;
                console.log('🔄 Chargement marques depuis:', url);
                
                const response = await fetch(url);
                const html = await response.text();
                
                console.log('✅ Marques reçues:', html.substring(0, 100));
                
                brandSelect.innerHTML = html;
                brandSelect.disabled = false;
            } catch (error) {
                console.error('❌ Erreur chargement marques:', error);
                brandSelect.innerHTML = '<option value="">Erreur de chargement</option>';
            }
        });

        brandSelect.addEventListener('change', async function() {
            const brandId = this.value;
            console.log('🏷️ Marque sélectionnée:', brandId);

            subCategorySelect.disabled = true;
            typeSelect.disabled = true;
            subCategorySelect.innerHTML = '<option value="">Chargement...</option>';
            typeSelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie d\'abord --</option>';

            if (!brandId) {
                subCategorySelect.innerHTML = '<option value="">-- Sélectionner une marque d\'abord --</option>';
                subCategorySelect.disabled = true;
                return;
            }

            try {
                const url = `{{ url('admin/ajax/sub-categories') }}/${brandId}`;
                console.log('🔄 Chargement sous-catégories depuis:', url);
                
                const response = await fetch(url);
                const html = await response.text();
                
                console.log('✅ Sous-catégories reçues:', html.substring(0, 100));
                
                subCategorySelect.innerHTML = html;
                subCategorySelect.disabled = false;
            } catch (error) {
                console.error('❌ Erreur chargement sous-catégories:', error);
                subCategorySelect.innerHTML = '<option value="">Erreur de chargement</option>';
            }
        });

        subCategorySelect.addEventListener('change', async function() {
            const subCategoryId = this.value;
            console.log('📋 Sous-catégorie sélectionnée:', subCategoryId);

            typeSelect.disabled = true;
            typeSelect.innerHTML = '<option value="">Chargement...</option>';

            if (!subCategoryId) {
                typeSelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie d\'abord --</option>';
                typeSelect.disabled = true;
                return;
            }

            try {
                const url = `{{ url('admin/ajax/types') }}/${subCategoryId}`;
                console.log('🔄 Chargement types depuis:', url);
                
                const response = await fetch(url);
                const html = await response.text();
                
                console.log('✅ Types reçus:', html.substring(0, 100));
                
                typeSelect.innerHTML = html;
                typeSelect.disabled = false;
            } catch (error) {
                console.error('❌ Erreur chargement types:', error);
                typeSelect.innerHTML = '<option value="">Erreur de chargement</option>';
            }
        });
    })();

    // Upload d'images
    let selectedImages = [];
    let mainImage = null;

    const imageUpload = document.getElementById('image_upload');
    if (imageUpload) {
        imageUpload.addEventListener('change', async function(e) {
            const files = Array.from(e.target.files);
            if (files.length === 0) return;

            console.log('Fichiers sélectionnés:', files.length);

            const progressDiv = document.getElementById('upload_progress');
            const progressBar = document.getElementById('progress_bar');
            const uploadStatus = document.getElementById('upload_status');

            progressDiv.classList.remove('hidden');
            
            let uploaded = 0;
            const total = files.length;

            for (const file of files) {
                console.log('Upload de:', file.name);
                
                try {
                    const formData = new FormData();
                    formData.append('image', file);

                    const uploadUrl = '{{ route("admin.product-sheets.upload-image") }}';
                    console.log('Envoi vers:', uploadUrl);
                    
                    const response = await fetch(uploadUrl, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });

                    console.log('Statut réponse:', response.status);
                    console.log('Content-Type:', response.headers.get('content-type'));
                    
                    // Vérifier si c'est vraiment du JSON
                    const contentType = response.headers.get('content-type');
                    if (!contentType || !contentType.includes('application/json')) {
                        const text = await response.text();
                        console.error('Réponse HTML complète:', text);
                        
                        // Chercher le message d'erreur dans le HTML
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(text, 'text/html');
                        const errorMsg = doc.querySelector('.exception-message, h1, title');
                        const errorText = errorMsg ? errorMsg.textContent : 'Erreur inconnue';
                        
                        throw new Error('Erreur serveur: ' + errorText);
                    }
                    
                    const data = await response.json();
                    console.log('Réponse:', data);

                    if (data.success) {
                        selectedImages.push({
                            url: data.url,
                            path: data.path
                        });
                        
                        if (!mainImage) {
                            mainImage = data.url;
                        }
                    } else {
                        console.error('Erreur serveur:', data.message);
                        alert('Erreur upload ' + file.name + ': ' + data.message);
                    }
                } catch (error) {
                    console.error('Erreur upload:', error);
                    alert('Erreur upload ' + file.name + ': ' + error.message);
                }

                uploaded++;
                const percent = (uploaded / total) * 100;
                progressBar.style.width = percent + '%';
                uploadStatus.textContent = `Upload ${uploaded}/${total} images...`;
            }

            setTimeout(() => {
                progressDiv.classList.add('hidden');
                progressBar.style.width = '0%';
            }, 1000);

            updateSelectedImages();
            e.target.value = ''; // Reset input
        });
    }

    function updateSelectedImages() {
        const selectedDiv = document.getElementById('selectedImages');
        const listDiv = document.getElementById('selectedImagesList');

        if (selectedImages.length === 0) {
            selectedDiv.classList.add('hidden');
            return;
        }

        selectedDiv.classList.remove('hidden');
        listDiv.innerHTML = selectedImages.map((img, index) => `
            <div class="relative group">
                <img src="${img.url}" class="w-full h-24 object-cover rounded border ${img.url === mainImage ? 'ring-2 ring-indigo-600' : ''}">
                <button type="button" onclick="removeImage(${index})" 
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                ${img.url === mainImage ? '<span class="absolute bottom-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded">Principale</span>' : ''}
                ${img.url !== mainImage ? `<button type="button" onclick="setMainImage(${index})" class="absolute bottom-1 left-1 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Définir principale</button>` : ''}
            </div>
        `).join('');

        // Mettre à jour les champs cachés
        const urls = selectedImages.map(img => img.url);
        document.getElementById('images_input').value = JSON.stringify(urls);
        document.getElementById('main_image_input').value = mainImage || '';
    }

    window.removeImage = async function(index) {
        const img = selectedImages[index];
        
        // Supprimer du serveur
        try {
            await fetch('{{ route("admin.product-sheets.delete-image") }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ path: img.path })
            });
        } catch (error) {
            console.error('Erreur suppression:', error);
        }

        selectedImages.splice(index, 1);
        
        if (mainImage === img.url) {
            mainImage = selectedImages.length > 0 ? selectedImages[0].url : null;
        }
        
        updateSelectedImages();
    }

    window.setMainImage = function(index) {
        mainImage = selectedImages[index].url;
        updateSelectedImages();
    }

    // Tags
    const tagsInput = document.getElementById('tags_input');
    if (tagsInput) {
        tagsInput.addEventListener('input', function() {
            const tags = this.value.split(',').map(t => t.trim()).filter(t => t);
            document.getElementById('tags_hidden').value = JSON.stringify(tags);
        });
    }

    // ========================================
    // GALERIE D'IMAGES DE CATÉGORIE
    // ========================================
    const typeSelect = document.getElementById('type_select'); // ID correct du select
    const galleryContainer = document.getElementById('taxonomy_gallery_container');
    const galleryDiv = document.getElementById('taxonomy_gallery');
    const completenessSelect = document.getElementById('completeness_type');
    const productNameInput = document.getElementById('product_name');

    // Fonction pour générer le nom automatiquement
    function generateProductName() {
        const typeText = typeSelect?.options[typeSelect.selectedIndex]?.text || '';
        const completenessText = completenessSelect?.value || '';
        
        if (typeText && completenessText) {
            productNameInput.value = `${typeText} - ${completenessText}`;
        } else {
            productNameInput.value = '';
        }
    }

    // Écouter les changements de complétude
    if (completenessSelect) {
        completenessSelect.addEventListener('change', generateProductName);
    }

    // Écouter les changements de catégorie (type)
    if (typeSelect) {
        typeSelect.addEventListener('change', async function() {
            const typeId = this.value;
            
            // Générer le nom automatiquement
            generateProductName();
            
            if (!typeId) {
                galleryContainer.classList.add('hidden');
                return;
            }

            // Charger les images de catégorie
            try {
                const response = await fetch('{{ route("admin.product-sheets.taxonomy-images") }}?article_type_id=' + typeId);
                const images = await response.json();

                if (images && images.length > 0) {
                    // Afficher la galerie
                    galleryDiv.innerHTML = '';
                    
                    images.forEach(img => {
                        const imgDiv = document.createElement('div');
                        imgDiv.className = 'relative group cursor-pointer hover:opacity-75 transition';
                        imgDiv.innerHTML = `
                            <img src="${img.url}" 
                                 alt="Image de ${img.sheet_name}"
                                 class="w-full h-20 object-cover rounded border border-gray-300">
                            <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-75 text-white text-[10px] px-1 py-0.5 truncate">
                                ${img.sheet_name}
                            </div>
                            <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 bg-black bg-opacity-40 rounded transition">
                                <span class="text-white text-xs font-bold bg-blue-600 px-2 py-1 rounded">
                                    + Ajouter
                                </span>
                            </div>
                        `;
                        
                        imgDiv.addEventListener('click', function() {
                            // Ajouter l'image à la liste (réutilise la logique existante)
                            selectedImages.push({
                                url: img.url,
                                path: img.url // Cloudinary URL, pas besoin de path séparé
                            });
                            
                            if (!mainImage) {
                                mainImage = img.url;
                            }
                            
                            updateSelectedImages();
                            
                            // Notification visuelle
                            const notification = document.createElement('div');
                            notification.className = 'fixed top-4 right-4 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50';
                            notification.textContent = '✅ Image ajoutée !';
                            document.body.appendChild(notification);
                            
                            setTimeout(() => {
                                notification.remove();
                            }, 2000);
                        });
                        
                        galleryDiv.appendChild(imgDiv);
                    });
                    
                    galleryContainer.classList.remove('hidden');
                } else {
                    galleryContainer.classList.add('hidden');
                }
            } catch (error) {
                console.error('Erreur chargement images catégorie:', error);
                galleryContainer.classList.add('hidden');
            }
        });
    }

    // ========================================
    // ROM ID LOOKUP (Game Boy)
    // ========================================
    const romIdInput = document.getElementById('rom_id_input');
    const lookupBtn = document.getElementById('lookup_rom_btn');
    const lookupResult = document.getElementById('rom_lookup_result');
    const lookupMessage = document.getElementById('rom_lookup_message');
    const suggestionsDiv = document.getElementById('rom_suggestions');

    if (romIdInput) {
        let debounceTimer;

        // ========================================
        // AUTOCOMPLETE - Suggestions en temps réel
        // ========================================
        romIdInput.addEventListener('input', function() {
            const value = this.value.trim().toUpperCase();
            lookupBtn.disabled = value.length === 0;

            // Clear previous timer
            clearTimeout(debounceTimer);

            // Hide suggestions if input is too short
            if (value.length < 2) {
                suggestionsDiv.classList.add('hidden');
                suggestionsDiv.innerHTML = '';
                return;
            }

            // Debounce API call (300ms)
            debounceTimer = setTimeout(async () => {
                try {
                    const response = await fetch('{{ route("admin.product-sheets.autocomplete-rom") }}?q=' + encodeURIComponent(value));
                    const suggestions = await response.json();

                    if (suggestions.length > 0) {
                        suggestionsDiv.innerHTML = suggestions.map(s => {
                            const imageHtml = s.image_url 
                                ? '<img src="' + s.image_url + '" class="w-12 h-12 object-cover rounded" alt="' + s.name + '">'
                                : '<div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">No img</div>';
                            
                            return '<div class="px-4 py-2 hover:bg-gray-100 cursor-pointer border-b border-gray-100 last:border-0 flex items-center gap-3"' +
                                   ' data-rom-id="' + s.rom_id + '"' +
                                   ' data-name="' + s.name + '"' +
                                   ' data-year="' + (s.year || '') + '"' +
                                   ' data-image="' + (s.image_url || '') + '">' +
                                   imageHtml +
                                   '<div class="flex-1">' +
                                   '<div class="font-medium text-sm text-gray-900">' + s.rom_id + '</div>' +
                                   '<div class="text-xs text-gray-600">' + s.name + '</div>' +
                                   (s.year ? '<div class="text-xs text-gray-500">📅 ' + s.year + '</div>' : '') +
                                   '</div>' +
                                   '</div>';
                        }).join('');
                        suggestionsDiv.classList.remove('hidden');

                        // Add click handlers to suggestions
                        suggestionsDiv.querySelectorAll('[data-rom-id]').forEach(item => {
                            item.addEventListener('click', function() {
                                romIdInput.value = this.dataset.romId;
                                suggestionsDiv.classList.add('hidden');
                                suggestionsDiv.innerHTML = '';
                                lookupBtn.disabled = false;
                                lookupBtn.click(); // Auto-trigger lookup
                            });
                        });
                    } else {
                        suggestionsDiv.classList.add('hidden');
                        suggestionsDiv.innerHTML = '';
                    }
                } catch (error) {
                    console.error('Autocomplete error:', error);
                }
            }, 300);
        });

        // Close suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!romIdInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                suggestionsDiv.classList.add('hidden');
            }
        });

        // Enable/disable button based on input
        romIdInput.addEventListener('change', function() {
            const value = this.value.trim();
            lookupBtn.disabled = value.length === 0;
        });

        // ========================================
        // LOOKUP - Recherche complète
        // ========================================
        // Trigger lookup on Enter key or button click
        romIdInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                suggestionsDiv.classList.add('hidden');
                lookupBtn.click();
            } else if (e.key === 'Escape') {
                suggestionsDiv.classList.add('hidden');
            }
        });

        lookupBtn.addEventListener('click', async function() {
            const romId = romIdInput.value.trim().toUpperCase();
            
            if (!romId) return;

            // Show loading state
            lookupBtn.disabled = true;
            lookupBtn.textContent = 'Recherche...';
            lookupResult.classList.add('hidden');

            try {
                const response = await fetch('{{ url("admin/product-sheets/lookup-rom") }}/' + encodeURIComponent(romId));
                const result = await response.json();

                if (result.success) {
                    const data = result.data;

                    // Auto-fill name and year
                    document.getElementById('product_name').value = data.name;
                    if (data.year) {
                        document.getElementById('product_year').value = data.year;
                    }

                    // Download and add image if available
                    if (data.image_url) {
                        console.log('📥 Téléchargement image depuis:', data.image_url);
                        console.log('🎮 ROM ID:', data.rom_id);
                        console.log('💾 Déjà sur Cloudinary?', data.has_cloudinary);
                        
                        try {
                            const imgResponse = await fetch('{{ route("admin.product-sheets.upload-from-url") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({ 
                                    url: data.image_url,
                                    rom_id: data.rom_id
                                })
                            });

                            const imgData = await imgResponse.json();
                            console.log('📦 Réponse upload:', imgData);
                            
                            if (imgData.success) {
                                console.log('✅ Image uploadée avec succès:', imgData.url);
                                if (imgData.cached) {
                                    console.log('⚡ Image déjà en cache Cloudinary (pas de re-téléchargement)');
                                }
                                
                                selectedImages.push({
                                    url: imgData.url,
                                    path: imgData.path
                                });
                                
                                if (!mainImage) {
                                    mainImage = imgData.url;
                                }
                                
                                console.log('📊 selectedImages après ajout:', selectedImages);
                                console.log('🖼️ mainImage:', mainImage);
                                updateSelectedImages();
                            } else {
                                console.error('❌ Échec upload image:', imgData.message);
                            }
                        } catch (imgError) {
                            console.error('❌ Image download failed:', imgError);
                        }
                    } else {
                        console.log('ℹ️ Pas d\'image disponible pour ce ROM');
                    }

                    // Show success message
                    lookupMessage.innerHTML = '✅ <strong>' + data.name + '</strong> trouvé !<br><span class="text-xs">Année: ' + (data.year || 'N/A') + ' | Prix moyen: ' + (data.price || 'N/A') + '</span>';
                    lookupMessage.className = 'text-sm text-green-700';
                    lookupResult.classList.remove('hidden');
                } else {
                    lookupMessage.textContent = '❌ ' + (result.message || 'Jeu non trouvé');
                    lookupMessage.className = 'text-sm text-red-700';
                    lookupResult.classList.remove('hidden');
                }
            } catch (error) {
                console.error('ROM lookup error:', error);
                lookupMessage.textContent = '❌ Erreur lors de la recherche';
                lookupMessage.className = 'text-sm text-red-700';
                lookupResult.classList.remove('hidden');
            } finally {
                lookupBtn.disabled = false;
                lookupBtn.textContent = 'Rechercher';
            }
        });
    }
});
</script>
@endpush
@endsection
