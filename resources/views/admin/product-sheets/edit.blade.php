@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">✏️ Éditer la fiche produit</h1>
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
        <form method="POST" action="{{ route('admin.product-sheets.update', $sheet) }}">
            @csrf
            @method('PUT')

            {{-- TAXONOMIE --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Type de produit</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
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
                    <div>
                        <label class="block text-sm font-medium mb-1">Nom de la fiche *</label>
                        <input type="text" name="name"
                               value="{{ old('name', $sheet->name) }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Description du produit</label>
                        <textarea name="description" rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $sheet->description) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Caractéristiques techniques</label>
                        <textarea name="technical_specs" rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('technical_specs', $sheet->technical_specs) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Accessoires inclus</label>
                        <textarea name="included_items" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('included_items', $sheet->included_items) }}</textarea>
                    </div>

                    <div>
                        <label class="block text-sm font-medium mb-1">Description marketing</label>
                        <textarea name="marketing_description" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('marketing_description', $sheet->marketing_description) }}</textarea>
                    </div>
                </div>
            </div>

            {{-- IMAGES ACTUELLES --}}
            @if($sheet->images && count($sheet->images) > 0)
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Images actuelles</h2>
                <div class="grid grid-cols-2 md:grid-cols-6 gap-3" id="currentImages">
                    @foreach($sheet->images as $index => $img)
                        <div class="relative group" data-image-url="{{ $img }}">
                            <img src="{{ $img }}" class="w-full h-20 object-cover rounded border {{ $img === $sheet->main_image ? 'ring-2 ring-indigo-600' : '' }}">
                            <button type="button" onclick="removeExistingImage('{{ $img }}')" 
                                    class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                            @if($img === $sheet->main_image)
                                <span class="absolute bottom-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded">Principale</span>
                            @else
                                <button type="button" onclick="setExistingMainImage('{{ $img }}')" 
                                        class="absolute bottom-1 left-1 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                                    Définir principale
                                </button>
                            @endif
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            {{-- AJOUTER DES IMAGES --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Ajouter des images</h2>
                
                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                    <input type="file" id="image_upload" accept="image/jpeg,image/png,image/jpg,image/gif,image/webp,image/avif" multiple class="hidden">
                    <label for="image_upload" class="cursor-pointer">
                        <div class="text-gray-600">
                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <p class="mt-2 text-sm font-medium">Cliquez pour sélectionner des images</p>
                            <p class="mt-1 text-xs text-gray-500">JPG, PNG, GIF, WEBP, AVIF jusqu'à 5 Mo</p>
                        </div>
                    </label>
                </div>

                {{-- Barre de progression --}}
                <div id="upload_progress" class="mt-4 hidden">
                    <div class="w-full bg-gray-200 rounded-full h-2">
                        <div id="progress_bar" class="bg-indigo-600 h-2 rounded-full transition-all" style="width: 0%"></div>
                    </div>
                    <p id="upload_status" class="text-sm text-gray-600 mt-1">Upload en cours...</p>
                </div>

                {{-- Images nouvellement ajoutées --}}
                <div id="newImages" class="mt-4 hidden">
                    <h3 class="text-sm font-medium text-gray-700 mb-2">Nouvelles images</h3>
                    <div id="newImagesList" class="grid grid-cols-2 md:grid-cols-6 gap-3"></div>
                </div>
            </div>

            {{-- TAGS --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Tags</h2>
                <input type="text" id="tags_input"
                       value="{{ $sheet->tags ? implode(', ', $sheet->tags) : '' }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="gaming, console, sony">
                <input type="hidden" name="tags" id="tags_hidden" value="{{ json_encode($sheet->tags ?? []) }}">
            </div>

            {{-- STATUT --}}
            <div class="mb-8">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                           {{ old('is_active', $sheet->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm">Fiche active</span>
                </label>
            </div>

            {{-- Hidden fields pour conserver les images --}}
            <input type="hidden" name="images" id="images_input" value="{{ json_encode($sheet->images ?? []) }}">
            <input type="hidden" name="main_image" id="main_image_input" value="{{ $sheet->main_image }}">

            {{-- ACTIONS --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.product-sheets.index') }}" 
                   class="px-4 py-2 rounded border hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    💾 Mettre à jour
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Cascading selects pour taxonomie
    document.getElementById('category_select').addEventListener('change', function() {
        loadSubCategories(this.value);
    });

    document.getElementById('sub_category_select').addEventListener('change', function() {
        loadTypes(this.value);
    });

    async function loadSubCategories(categoryId, selectedSubCategoryId = null) {
        const subCategorySelect = document.getElementById('sub_category_select');
        const typeSelect = document.getElementById('type_select');

        subCategorySelect.disabled = true;
        typeSelect.disabled = true;
        subCategorySelect.innerHTML = '<option value="">Chargement...</option>';
        typeSelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie --</option>';

        if (!categoryId) {
            subCategorySelect.innerHTML = '<option value="">-- Sélectionner une catégorie d\'abord --</option>';
            return;
        }

        try {
            const url = `{{ url('admin/ajax/sub-categories') }}/${categoryId}`;
            const response = await fetch(url);
            const html = await response.text();
            subCategorySelect.innerHTML = html;
            subCategorySelect.disabled = false;

            if (selectedSubCategoryId) {
                subCategorySelect.value = selectedSubCategoryId;
            }
        } catch (error) {
            console.error('Erreur chargement sous-catégories:', error);
            subCategorySelect.innerHTML = '<option value="">Erreur de chargement</option>';
        }
    }

    async function loadTypes(subCategoryId, selectedTypeId = null) {
        const typeSelect = document.getElementById('type_select');
        typeSelect.disabled = true;
        typeSelect.innerHTML = '<option value="">Chargement...</option>';

        if (!subCategoryId) {
            typeSelect.innerHTML = '<option value="">-- Sélectionner une sous-catégorie d\'abord --</option>';
            return;
        }

        try {
            const url = `{{ url('admin/ajax/types') }}/${subCategoryId}`;
            const response = await fetch(url);
            const html = await response.text();
            typeSelect.innerHTML = html;
            typeSelect.disabled = false;

            if (selectedTypeId) {
                typeSelect.value = selectedTypeId;
            }
        } catch (error) {
            console.error('Erreur chargement types:', error);
            typeSelect.innerHTML = '<option value="">Erreur de chargement</option>';
        }
    }

    // Tags
    const tagsInput = document.getElementById('tags_input');
    if (tagsInput) {
        tagsInput.addEventListener('input', function() {
            const tags = this.value.split(',').map(t => t.trim()).filter(t => t);
            document.getElementById('tags_hidden').value = JSON.stringify(tags);
        });
    }

    // Upload d'images
    let existingImages = {!! json_encode($sheet->images ?? []) !!};
    let mainImage = '{{ $sheet->main_image }}';
    let newImages = [];

    const imageUpload = document.getElementById('image_upload');
    if (imageUpload) {
        imageUpload.addEventListener('change', async function(e) {
            const files = Array.from(e.target.files);
            if (files.length === 0) return;

            const progressDiv = document.getElementById('upload_progress');
            const progressBar = document.getElementById('progress_bar');
            const uploadStatus = document.getElementById('upload_status');

            progressDiv.classList.remove('hidden');
            
            let uploaded = 0;
            const total = files.length;

            for (const file of files) {
                try {
                    const formData = new FormData();
                    formData.append('image', file);

                    const response = await fetch('{{ route("admin.product-sheets.upload-image") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        newImages.push({
                            url: data.url,
                            path: data.path
                        });
                        
                        if (!mainImage) {
                            mainImage = data.url;
                        }
                    }
                } catch (error) {
                    console.error('Erreur upload:', error);
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

            updateNewImages();
            e.target.value = '';
        });
    }

    function updateNewImages() {
        const newDiv = document.getElementById('newImages');
        const listDiv = document.getElementById('newImagesList');

        if (newImages.length === 0) {
            newDiv.classList.add('hidden');
            return;
        }

        newDiv.classList.remove('hidden');
        listDiv.innerHTML = newImages.map((img, index) => `
            <div class="relative group">
                <img src="${img.url}" class="w-full h-20 object-cover rounded border ${img.url === mainImage ? 'ring-2 ring-indigo-600' : ''}">
                <button type="button" onclick="removeNewImage(${index})" 
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                ${img.url === mainImage ? '<span class="absolute bottom-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded">Principale</span>' : `<button type="button" onclick="setNewMainImage(${index})" class="absolute bottom-1 left-1 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Définir principale</button>`}
            </div>
        `).join('');

        updateHiddenFields();
    }

    function updateHiddenFields() {
        const allImages = [...existingImages, ...newImages.map(img => img.url)];
        document.getElementById('images_input').value = JSON.stringify(allImages);
        document.getElementById('main_image_input').value = mainImage || '';
    }

    window.removeExistingImage = async function(imageUrl) {
        existingImages = existingImages.filter(img => img !== imageUrl);
        if (mainImage === imageUrl) {
            mainImage = existingImages.length > 0 ? existingImages[0] : (newImages.length > 0 ? newImages[0].url : '');
        }
        updateCurrentImages();
        updateHiddenFields();
    }

    window.setExistingMainImage = function(imageUrl) {
        mainImage = imageUrl;
        updateCurrentImages();
        updateHiddenFields();
    }

    window.removeNewImage = async function(index) {
        const img = newImages[index];
        
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

        newImages.splice(index, 1);
        
        if (mainImage === img.url) {
            mainImage = existingImages.length > 0 ? existingImages[0] : (newImages.length > 0 ? newImages[0].url : '');
        }
        
        updateNewImages();
        updateHiddenFields();
    }

    window.setNewMainImage = function(index) {
        mainImage = newImages[index].url;
        updateNewImages();
        updateCurrentImages();
        updateHiddenFields();
    }

    function updateCurrentImages() {
        const currentDiv = document.getElementById('currentImages');
        if (!currentDiv) return;

        currentDiv.innerHTML = existingImages.map(img => `
            <div class="relative group" data-image-url="${img}">
                <img src="${img}" class="w-full h-20 object-cover rounded border ${img === mainImage ? 'ring-2 ring-indigo-600' : ''}">
                <button type="button" onclick="removeExistingImage('${img}')" 
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                ${img === mainImage ? '<span class="absolute bottom-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded">Principale</span>' : `<button type="button" onclick="setExistingMainImage('${img}')" class="absolute bottom-1 left-1 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Définir principale</button>`}
            </div>
        `).join('');
    }
});
</script>
@endpush
@endsection
