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

            {{-- TAXONOMIE --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Type de produit</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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

                    {{-- Sous-catégorie --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Sous-catégorie *</label>
                        <select name="sub_category_temp" id="sub_category_select"
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                required {{ isset($selectedCategory) ? '' : 'disabled' }}>
                            <option value="">-- Sélectionner une catégorie d'abord --</option>
                            @if(isset($selectedCategory) && isset($selectedCategory->subCategories))
                                @foreach($selectedCategory->subCategories as $sub)
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
                    {{-- ROM ID Game Boy (optionnel) --}}
                    <div class="p-4 bg-green-50 border border-green-200 rounded-md">
                        <label class="block text-sm font-medium text-green-800 mb-1">
                            🎮 ROM ID Game Boy (optionnel)
                        </label>
                        <div class="flex gap-2 items-start">
                            <div class="flex-1 relative">
                                <input type="text" id="rom_id_input" autocomplete="off"
                                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                       placeholder="Ex: DMG-APEE-0, DMG-MLA-1"
                                       pattern="DMG-[A-Z0-9]+-[0-9]">
                                <p class="text-xs text-green-700 mt-1">
                                    Tapez pour voir les suggestions (ex: DMG-A)
                                </p>
                                
                                {{-- Dropdown suggestions --}}
                                <div id="rom_suggestions" class="hidden absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                                </div>
                            </div>
                            <button type="button" id="lookup_rom_btn" 
                                    class="px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 disabled:opacity-50"
                                    disabled>
                                Rechercher
                            </button>
                        </div>
                        <div id="rom_lookup_result" class="mt-2 hidden">
                            <div class="text-sm text-green-700">
                                <span id="rom_lookup_message"></span>
                            </div>
                        </div>
                    </div>

                    {{-- Nom --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Nom de la fiche *</label>
                        <input type="text" name="name" id="product_name"
                               value="{{ old('name') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Ex: PlayStation 5 Standard Edition"
                               required>
                    </div>

                    {{-- Année de sortie --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Année de sortie</label>
                        <input type="number" name="release_year" id="product_year"
                               value="{{ old('release_year') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Ex: 1989"
                               min="1970" max="2099">
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
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    {{-- Boîte --}}
                    <div class="border rounded-lg p-4">
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
                    <div class="border rounded-lg p-4">
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
                    <div class="border rounded-lg p-4">
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
                    <div class="border rounded-lg p-4">
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
                    <div class="border rounded-lg p-4">
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
                    <div class="border rounded-lg p-4">
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

    // Cascading selects pour taxonomie
    (function initTaxonomy() {
        const categorySelect = document.getElementById('category_select');
        const subCategorySelect = document.getElementById('sub_category_select');
        const typeSelect = document.getElementById('type_select');

        if (!categorySelect || !subCategorySelect || !typeSelect) {
            console.error('❌ Selects de taxonomie non trouvés');
            return;
        }

        console.log('✅ Taxonomie initialisée');

        categorySelect.addEventListener('change', async function() {
            const categoryId = this.value;
            console.log('📋 Catégorie sélectionnée:', categoryId);

            subCategorySelect.disabled = true;
            typeSelect.disabled = true;
            subCategorySelect.innerHTML = '<option value="">Chargement...</option>';
            typeSelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie d\'abord --</option>';

            if (!categoryId) {
                subCategorySelect.innerHTML = '<option value="">-- Sélectionner une catégorie d\'abord --</option>';
                subCategorySelect.disabled = true;
                return;
            }

            try {
                const url = '{{ url("admin/ajax/sub-categories") }}/' + categoryId;
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
                const url = '{{ url("admin/ajax/types") }}/' + subCategoryId;
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
                        suggestionsDiv.innerHTML = suggestions.map(s => `
                            <div class="px-4 py-2 hover:bg-gray-100 cursor-pointer border-b border-gray-100 last:border-0"
                                 data-rom-id="${s.rom_id}"
                                 data-name="${s.name}"
                                 data-year="${s.year || ''}">
                                <div class="font-medium text-sm text-gray-900">${s.rom_id}</div>
                                <div class="text-xs text-gray-600">${s.name}</div>
                            </div>
                        `).join('');
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
                        try {
                            const imgResponse = await fetch('{{ route("admin.product-sheets.upload-from-url") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({ url: data.image_url })
                            });

                            const imgData = await imgResponse.json();
                            if (imgData.success) {
                                selectedImages.push({
                                    url: imgData.url,
                                    path: imgData.path
                                });
                                
                                if (!mainImage) {
                                    mainImage = imgData.url;
                                }
                                updateSelectedImages();
                            }
                        } catch (imgError) {
                            console.error('Image download failed:', imgError);
                        }
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
