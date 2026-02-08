@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6" x-data="taxonomyManager()">

    <h1 class="text-3xl font-bold mb-8">🧩 Gestion de la taxonomie</h1>

    {{-- MESSAGES --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    {{-- NAVIGATION PAR ONGLETS --}}
    <div class="bg-white shadow rounded-lg mb-6">
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-4 px-6" aria-label="Tabs">
                <button @click="activeTab = 'categories'" 
                        :class="activeTab === 'categories' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    📦 Catégories
                </button>
                <button @click="activeTab = 'brands'" 
                        :class="activeTab === 'brands' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    🏷️ Marques
                </button>
                <button @click="activeTab = 'tree'" 
                        :class="activeTab === 'tree' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    🌳 Vue hiérarchique
                </button>
                <button @click="activeTab = 'types'" 
                        :class="activeTab === 'types' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    🎮 Types
                </button>
            </nav>
        </div>

        {{-- ONGLET CATÉGORIES --}}
        <div x-show="activeTab === 'categories'" class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">📦 Catégories</h2>
                <input x-model="searchCategory" 
                       type="text" 
                       placeholder="Filtrer..." 
                       class="w-64 rounded border-gray-300 text-sm">
            </div>

            {{-- CREATE --}}
            <form method="POST" action="{{ route('admin.taxonomy.category.store') }}" class="mb-6 flex gap-2">
                @csrf
                <input name="name" placeholder="Nom de la catégorie" class="flex-1 border rounded p-2" required>
                <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">➕ Ajouter</button>
            </form>

            {{-- LIST --}}
            <div class="space-y-2">
                @foreach($categories as $category)
                    <div x-show="!searchCategory || '{{ strtolower($category->name) }}'.includes(searchCategory.toLowerCase())"
                         class="border rounded-lg p-3 hover:bg-gray-50 transition">
                        <div class="flex items-center justify-between">
                            <div class="flex-1">
                                <form method="POST" action="{{ route('admin.taxonomy.category.update', $category) }}" class="flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input name="name" value="{{ $category->name }}" 
                                           class="flex-1 rounded border-gray-300" required>
                                    <button class="px-3 py-1 rounded bg-indigo-600 text-white text-sm hover:bg-indigo-700">💾</button>
                                </form>
                            </div>
                            <div class="flex items-center gap-4 ml-4">
                                <span class="text-sm text-gray-500">{{ $category->sub_categories_count ?? 0 }} sous-cat.</span>
                                @if(($category->sub_categories_count ?? 0) === 0)
                                    <form method="POST" action="{{ route('admin.taxonomy.category.destroy', $category) }}"
                                          onsubmit="return confirm('Supprimer cette catégorie ?');">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-700 text-sm">🗑️</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ONGLET MARQUES --}}
        <div x-show="activeTab === 'brands'" class="p-6">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">🏷️ Marques</h2>
                <input x-model="searchBrand" 
                       type="text" 
                       placeholder="Filtrer..." 
                       class="w-64 rounded border-gray-300 text-sm">
            </div>

            {{-- CREATE --}}
            <form method="POST" action="{{ route('admin.taxonomy.brand.store') }}" class="mb-6 flex gap-2">
                @csrf
                <select name="article_category_id" class="flex-1 border rounded p-2" required>
                    <option value="">— Catégorie —</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                    @endforeach
                </select>
                <input name="name" placeholder="Nom de la marque" class="flex-1 border rounded p-2" required>
                <button class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">➕ Ajouter</button>
            </form>

            {{-- LIST --}}
            <div class="space-y-2">
                @foreach($categories as $category)
                    @foreach($category->brands as $brand)
                        <div x-show="!searchBrand || ('{{ strtolower($brand->name) }} {{ strtolower($category->name) }}').includes(searchBrand.toLowerCase())"
                             class="border rounded-lg p-3 hover:bg-gray-50 transition">
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <form method="POST" action="{{ route('admin.taxonomy.brand.update', $brand) }}" class="flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input name="name" value="{{ $brand->name }}" 
                                               class="flex-1 rounded border-gray-300" required>
                                        <input type="hidden" name="article_category_id" value="{{ $brand->article_category_id }}">
                                        <span class="text-sm text-gray-500 self-center">{{ $category->name }}</span>
                                        <button class="px-3 py-1 rounded bg-indigo-600 text-white text-sm hover:bg-indigo-700">💾</button>
                                    </form>
                                </div>
                                <div class="flex items-center gap-4 ml-4">
                                    <span class="text-sm text-gray-500">{{ $brand->sub_categories_count ?? 0 }} sous-cat.</span>
                                    @if(($brand->sub_categories_count ?? 0) === 0)
                                        <form method="POST" action="{{ route('admin.taxonomy.brand.destroy', $brand) }}"
                                              onsubmit="return confirm('Supprimer cette marque ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600 hover:text-red-700 text-sm">🗑️</button>
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>

        {{-- ONGLET VUE HIÉRARCHIQUE --}}
        <div x-show="activeTab === 'tree'" class="p-6">
            <h2 class="text-xl font-semibold mb-4">🌳 Vue hiérarchique</h2>
            <p class="text-sm text-gray-600 mb-4">Navigation et gestion de la taxonomie complète<br>
            <span class="text-xs text-gray-500">Catégorie → Marque → Sous-catégorie → Types</span></p>
            
            <div class="space-y-2">
                @foreach($categories as $category)
                    <div class="border rounded-lg" x-data="{ openCat: false }">
                        {{-- NIVEAU 1 : CATÉGORIE --}}
                        <div @click="openCat = !openCat; if(openCat && !$el.dataset.loaded) loadBrandsTree({{ $category->id }}, $el)"
                             class="p-3 cursor-pointer hover:bg-gray-50 flex items-center justify-between">
                            <div class="flex items-center gap-2">
                                <span x-show="!openCat">▶</span>
                                <span x-show="openCat">▼</span>
                                <span class="font-medium">📦 {{ $category->name }}</span>
                                <span class="text-sm text-gray-500">({{ $category->brands->count() }} marques)</span>
                            </div>
                        </div>
                        
                        <div x-show="openCat" class="pl-6 pb-3 pr-3">
                            <div class="loading-brands">
                                <div class="flex items-center gap-2 text-gray-500 text-sm p-2">
                                    <svg class="animate-spin h-4 w-4" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 0 1 4 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Chargement...
                                </div>
                            </div>
                            <div class="brands-container space-y-2"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ONGLET TYPES --}}
        <div x-show="activeTab === 'types'" class="p-6" x-init="if(activeTab === 'types') loadTypes()">
            <div class="flex justify-between items-center mb-4">
                <h2 class="text-xl font-semibold">🎮 Types</h2>
                <div class="flex gap-2">
                    <input x-model="searchType" 
                           @input="loadTypes()"
                           type="text" 
                           placeholder="Rechercher..." 
                           class="w-64 rounded border-gray-300 text-sm">
                    <select x-model="typesPerPage" @change="loadTypes()" class="rounded border-gray-300 text-sm">
                        <option value="20">20/page</option>
                        <option value="50">50/page</option>
                        <option value="100">100/page</option>
                    </select>
                </div>
            </div>

            <div x-show="loadingTypes" class="text-center py-8 text-gray-500">
                <svg class="animate-spin h-8 w-8 mx-auto mb-2" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 0 1 4 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                Chargement...
            </div>

            <div x-show="!loadingTypes">
                <div class="space-y-2 mb-4" x-html="typesHtml"></div>
                
                {{-- Pagination --}}
                <div x-show="typesPagination.total > 0" class="flex items-center justify-between border-t pt-4">
                    <div class="text-sm text-gray-700">
                        Affichage de <span x-text="typesPagination.from"></span> à <span x-text="typesPagination.to"></span>
                        sur <span x-text="typesPagination.total"></span> types
                    </div>
                    <div class="flex gap-2">
                        <button @click="loadTypes(typesPagination.current_page - 1)" 
                                :disabled="typesPagination.current_page === 1"
                                :class="typesPagination.current_page === 1 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-100'"
                                class="px-3 py-1 border rounded text-sm">
                            ← Précédent
                        </button>
                        <span class="px-3 py-1 text-sm">
                            Page <span x-text="typesPagination.current_page"></span> / <span x-text="typesPagination.last_page"></span>
                        </span>
                        <button @click="loadTypes(typesPagination.current_page + 1)" 
                                :disabled="typesPagination.current_page === typesPagination.last_page"
                                :class="typesPagination.current_page === typesPagination.last_page ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-100'"
                                class="px-3 py-1 border rounded text-sm">
                            Suivant →
                        </button>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function taxonomyManager() {
    return {
        activeTab: 'categories',
        searchCategory: '',
        searchBrand: '',
        searchType: '',
        typesPerPage: 50,
        loadingTypes: false,
        typesHtml: '',
        typesPagination: {
            current_page: 1,
            last_page: 1,
            from: 0,
            to: 0,
            total: 0
        },

        async loadSubcategories(brandId, categoryId, element) {
            if (element.dataset.loaded) return;
            
            const parent = element.closest('.border');
            const container = parent.querySelector('.subcats-container');
            const loading = parent.querySelector('.loading');
            
            try {
                const response = await fetch(`/admin/ajax/taxonomy/subcategories/${brandId}`, {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await response.json();
                
                loading.style.display = 'none';
                
                if (data.subcategories && data.subcategories.length > 0) {
                    container.innerHTML = data.subcategories.map(sub => `
                        <div class="border rounded p-3 hover:bg-gray-50 transition">
                            <form method="POST" action="/admin/taxonomy/sub-category/${sub.id}" class="flex items-center gap-2" onsubmit="event.preventDefault(); updateSubcategory(${sub.id}, this)">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'}">
                                <input type="hidden" name="_method" value="PUT">
                                <input name="name" value="${sub.name}" class="flex-1 text-sm border rounded p-1">
                                <input type="hidden" name="article_brand_id" value="${brandId}">
                                <input type="hidden" name="article_category_id" value="${categoryId}">
                                <button type="submit" class="text-indigo-600 hover:text-indigo-700 text-sm px-2">💾</button>
                                <span class="text-xs text-gray-500">${sub.types_count || 0} types</span>
                                ${sub.types_count === 0 ? `
                                    <button type="button" onclick="deleteSubcategory(${sub.id})" class="text-red-600 hover:text-red-700 text-sm">🗑️</button>
                                ` : ''}
                            </form>
                        </div>
                    `).join('');
                } else {
                    container.innerHTML = '<div class="text-sm text-gray-500 p-2">Aucune sous-catégorie</div>';
                }
                
                element.dataset.loaded = 'true';
            } catch (error) {
                loading.innerHTML = '<div class="text-sm text-red-500">Erreur de chargement</div>';
                console.error('Error loading subcategories:', error);
            }
        },

        async loadBrandsTree(categoryId, element) {
            if (element.dataset.loaded) return;
            
            const parent = element.closest('.border');
            const container = parent.querySelector('.brands-container');
            const loading = parent.querySelector('.loading-brands');
            
            try {
                const response = await fetch(`/admin/ajax/brands/${categoryId}`, {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await response.json();
                
                loading.style.display = 'none';
                
                if (data.brands && data.brands.length > 0) {
                    container.innerHTML = data.brands.map(brand => `
                        <div class="border rounded-lg ml-4 mb-2" data-brand-id="${brand.id}">
                            <div onclick="toggleBrandSubcats(this, ${brand.id}, ${categoryId})"
                                 class="p-2 cursor-pointer hover:bg-gray-50 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="toggle-icon">▶</span>
                                    <span class="text-sm font-medium">🏷️ ${brand.name}</span>
                                    <span class="text-xs text-gray-500">(${brand.sub_categories_count || 0} sous-cat.)</span>
                                </div>
                            </div>
                            <div class="subcats-wrapper" style="display: none;">
                                <div class="pl-6 pb-2 pr-2">
                                    <form method="POST" action="/admin/taxonomy/sub-category" class="flex gap-2 mb-2 bg-blue-50 p-2 rounded">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="hidden" name="article_brand_id" value="${brand.id}">
                                        <input type="hidden" name="article_category_id" value="${categoryId}">
                                        <input name="name" placeholder="Nouvelle sous-catégorie" class="flex-1 text-xs border rounded p-1" required>
                                        <button type="submit" class="bg-blue-600 text-white px-2 py-1 rounded text-xs hover:bg-blue-700">➕</button>
                                    </form>
                                    
                                    <div class="loading-subcats">
                                        <div class="text-xs text-gray-500 flex items-center gap-1">
                                            <svg class="animate-spin h-3 w-3" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 0 1 4 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Chargement...
                                        </div>
                                    </div>
                                    <div class="subcats-tree-container space-y-1"></div>
                                </div>
                            </div>
                        </div>
                    `).join('');
                } else {
                    container.innerHTML = '<div class="text-sm text-gray-500 p-2 ml-4">Aucune marque</div>';
                }
                
                element.dataset.loaded = 'true';
            } catch (error) {
                loading.innerHTML = '<div class="text-sm text-red-500">Erreur de chargement</div>';
                console.error('Error loading brands:', error);
            }
        },

        async loadTypes(page = 1) {
            this.loadingTypes = true;
            
            try {
                const params = new URLSearchParams({
                    page: page,
                    per_page: this.typesPerPage,
                    search: this.searchType
                });
                
                const response = await fetch(`/admin/ajax/taxonomy/types?${params}`, {
                    headers: { 'Accept': 'application/json' }
                });
                const data = await response.json();
                
                this.typesPagination = {
                    current_page: data.current_page,
                    last_page: data.last_page,
                    from: data.from,
                    to: data.to,
                    total: data.total
                };
                
                if (data.types && data.types.length > 0) {
                    this.typesHtml = data.types.map(type => `
                        <div class="border rounded-lg p-3 hover:bg-gray-50 transition">
                            <div class="flex items-center justify-between gap-2">
                                <span class="font-medium">${type.name}</span>
                                <span class="text-sm text-gray-500">${type.sub_category_name || ''}</span>
                            </div>
                        </div>
                    `).join('');
                } else {
                    this.typesHtml = '<div class="text-center py-8 text-gray-500">Aucun type trouvé</div>';
                }
            } catch (error) {
                this.typesHtml = '<div class="text-center py-8 text-red-500">Erreur de chargement</div>';
                console.error('Error loading types:', error);
            } finally {
                this.loadingTypes = false;
            }
        }
    }
}

async function toggleSubcatTypes(clickedElement, subcatId) {
    const subcatContainer = clickedElement.closest('[data-subcat-id]');
    const wrapper = subcatContainer.querySelector('.types-wrapper');
    const toggleIcon = subcatContainer.querySelector('.toggle-types-icon');
    const loading = subcatContainer.querySelector('.loading-types');
    const container = subcatContainer.querySelector('.types-list');
    
    // Toggle visibilité
    const isVisible = wrapper.style.display !== 'none';
    wrapper.style.display = isVisible ? 'none' : 'block';
    toggleIcon.textContent = isVisible ? '▶' : '▼';
    
    // Si déjà chargé, ne pas recharger
    if (isVisible || subcatContainer.dataset.typesLoaded) return;
    
    try {
        const response = await fetch(`/admin/ajax/types/${subcatId}`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await response.json();
        
        loading.style.display = 'none';
        
        if (data && data.length > 0) {
            container.innerHTML = data.map(type => `
                <div class="border rounded p-2 bg-gray-50 hover:bg-gray-100 ml-2 mb-1">
                    <form method="POST" action="/admin/taxonomy/type/${type.id}" class="flex items-center gap-2" onsubmit="event.preventDefault(); updateType(${type.id}, this)">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'}">
                        <input type="hidden" name="_method" value="PUT">
                        <span class="text-xs text-gray-400">🎮</span>
                        <input name="name" value="${type.name}" class="flex-1 text-xs border rounded p-1">
                        <input type="hidden" name="article_sub_category_id" value="${subcatId}">
                        <button type="submit" class="text-indigo-600 hover:text-indigo-700 text-xs px-1">💾</button>
                        <span class="text-xs text-gray-500">${type.consoles_count || 0} articles</span>
                        ${type.consoles_count === 0 ? `
                            <button type="button" onclick="deleteType(${type.id}, this)" class="text-red-600 hover:text-red-700 text-xs">🗑️</button>
                        ` : ''}
                    </form>
                </div>
            `).join('');
        } else {
            container.innerHTML = '<div class="text-xs text-gray-500 p-2 ml-2">Aucun type</div>';
        }
        
        subcatContainer.dataset.typesLoaded = 'true';
    } catch (error) {
        loading.innerHTML = '<div class="text-xs text-red-500">Erreur de chargement</div>';
        console.error('Error loading types:', error);
    }
}

async function toggleBrandSubcats(clickedElement, brandId, categoryId) {
    const brandContainer = clickedElement.closest('.border');
    const wrapper = brandContainer.querySelector('.subcats-wrapper');
    const toggleIcon = brandContainer.querySelector('.toggle-icon');
    const loading = brandContainer.querySelector('.loading-subcats');
    const container = brandContainer.querySelector('.subcats-tree-container');
    
    // Toggle visibilité
    const isVisible = wrapper.style.display !== 'none';
    wrapper.style.display = isVisible ? 'none' : 'block';
    toggleIcon.textContent = isVisible ? '▶' : '▼';
    
    // Si déjà chargé, ne pas recharger
    if (isVisible || brandContainer.dataset.loaded) return;
    
    try {
        const response = await fetch(`/admin/ajax/taxonomy/subcategories/${brandId}`, {
            headers: { 'Accept': 'application/json' }
        });
        const data = await response.json();
        
        loading.style.display = 'none';
        
        if (data.subcategories && data.subcategories.length > 0) {
            container.innerHTML = data.subcategories.map(sub => `
                <div class="border rounded ml-2 mb-1" data-subcat-id="${sub.id}">
                    <div class="p-2 bg-white hover:bg-gray-50">
                        <div class="flex items-center gap-2">
                            <span class="cursor-pointer hover:text-indigo-600" onclick="toggleSubcatTypes(this, ${sub.id})">
                                <span class="toggle-types-icon">▶</span>
                            </span>
                            <form method="POST" action="/admin/taxonomy/sub-category/${sub.id}" class="flex items-center gap-2 flex-1" onsubmit="event.preventDefault(); updateSubcategory(${sub.id}, this)">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'}">
                                <input type="hidden" name="_method" value="PUT">
                                <input name="name" value="${sub.name}" class="flex-1 text-xs border rounded p-1">
                                <input type="hidden" name="article_brand_id" value="${brandId}">
                                <input type="hidden" name="article_category_id" value="${categoryId}">
                                <button type="submit" class="text-indigo-600 hover:text-indigo-700 text-xs px-1">💾</button>
                                <span class="text-xs text-gray-500">${sub.types_count || 0} types</span>
                                ${sub.types_count === 0 ? `
                                    <button type="button" onclick="deleteSubcategory(${sub.id}, this)" class="text-red-600 hover:text-red-700 text-xs">🗑️</button>
                                ` : ''}
                            </form>
                        </div>
                    </div>
                    <div class="types-wrapper" style="display: none;">
                        <div class="pl-6 pb-2 pr-2">
                            <form method="POST" action="/admin/taxonomy/type" class="flex gap-2 mb-2 bg-green-50 p-2 rounded" onsubmit="event.preventDefault(); createType(this, ${sub.id})">
                                <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'}">
                                <input type="hidden" name="article_sub_category_id" value="${sub.id}">
                                <input name="name" placeholder="Nouveau type" class="flex-1 text-xs border rounded p-1" required>
                                <button type="submit" class="bg-green-600 text-white px-2 py-1 rounded text-xs hover:bg-green-700">➕</button>
                            </form>
                            
                            <div class="loading-types">
                                <div class="text-xs text-gray-500 flex items-center gap-1">
                                    <svg class="animate-spin h-3 w-3" viewBox="0 0 24 24">
                                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 0 1 4 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Chargement types...
                                </div>
                            </div>
                            <div class="types-list space-y-1"></div>
                        </div>
                    </div>
                </div>
            `).join('');
        } else {
            container.innerHTML = '<div class="text-xs text-gray-500 p-2 ml-2">Aucune sous-catégorie</div>';
        }
        
        brandContainer.dataset.loaded = 'true';
    } catch (error) {
        loading.innerHTML = '<div class="text-xs text-red-500">Erreur de chargement</div>';
        console.error('Error loading subcategories:', error);
    }
}

async function updateSubcategory(id, form) {
    const formData = new FormData(form);
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
        });
        
        if (response.ok) {
            const result = await response.json();
            form.closest('.border').classList.add('bg-green-50');
            setTimeout(() => form.closest('.border').classList.remove('bg-green-50'), 1000);
        }
    } catch (error) {
        console.error('Error updating subcategory:', error);
        alert('Erreur lors de la mise à jour');
    }
}

async function deleteSubcategory(id, button) {
    if (!confirm('Supprimer cette sous-catégorie ?')) return;
    
    try {
        const response = await fetch(`/admin/taxonomy/sub-category/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ _method: 'DELETE' })
        });
        
        if (response.ok) {
            // Trouver et supprimer l'élément avec animation
            const subcatElement = button.closest('[data-subcat-id]');
            if (subcatElement) {
                subcatElement.style.transition = 'opacity 0.3s, transform 0.3s';
                subcatElement.style.opacity = '0';
                subcatElement.style.transform = 'translateX(-10px)';
                setTimeout(() => subcatElement.remove(), 300);
            }
        }
    } catch (error) {
        console.error('Error deleting subcategory:', error);
        alert('Erreur lors de la suppression');
    }
}

async function updateType(id, form) {
    const formData = new FormData(form);
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
        });
        
        if (response.ok) {
            form.closest('.border').classList.add('bg-green-100');
            setTimeout(() => form.closest('.border').classList.remove('bg-green-100'), 1000);
        }
    } catch (error) {
        console.error('Error updating type:', error);
        alert('Erreur lors de la mise à jour');
    }
}

async function deleteType(id, button) {
    if (!confirm('Supprimer ce type ?')) return;
    
    try {
        const response = await fetch(`/admin/taxonomy/type/${id}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ _method: 'DELETE' })
        });
        
        const result = await response.json();
        
        if (response.ok) {
            // Trouver et supprimer l'élément avec animation
            const typeElement = button.closest('.border');
            if (typeElement) {
                typeElement.style.transition = 'opacity 0.3s, transform 0.3s';
                typeElement.style.opacity = '0';
                typeElement.style.transform = 'translateX(-10px)';
                setTimeout(() => typeElement.remove(), 300);
            }
        } else {
            alert(result.error || 'Erreur lors de la suppression');
        }
    } catch (error) {
        console.error('Error deleting type:', error);
        alert('Erreur lors de la suppression');
    }
}

async function createType(form, subcatId) {
    const formData = new FormData(form);
    
    try {
        const response = await fetch(form.action, {
            method: 'POST',
            headers: { 'X-Requested-With': 'XMLHttpRequest' },
            body: formData
        });
        
        const result = await response.json();
        
        if (response.ok && result.type) {
            // Ajouter le nouveau type à la liste
            const subcatContainer = form.closest('[data-subcat-id]');
            const typesList = subcatContainer.querySelector('.types-list');
            
            const newTypeHtml = `
                <div class="border rounded p-2 bg-gray-50 hover:bg-gray-100 ml-2 mb-1">
                    <form method="POST" action="/admin/taxonomy/type/${result.type.id}" class="flex items-center gap-2" onsubmit="event.preventDefault(); updateType(${result.type.id}, this)">
                        <input type="hidden" name="_token" value="${document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}'}">
                        <input type="hidden" name="_method" value="PUT">
                        <span class="text-xs text-gray-400">🎮</span>
                        <input name="name" value="${result.type.name}" class="flex-1 text-xs border rounded p-1">
                        <input type="hidden" name="article_sub_category_id" value="${subcatId}">
                        <button type="submit" class="text-indigo-600 hover:text-indigo-700 text-xs px-1">💾</button>
                        <span class="text-xs text-gray-500">${result.type.consoles_count} articles</span>
                        <button type="button" onclick="event.preventDefault(); deleteType(${result.type.id}, this)" class="text-red-600 hover:text-red-700 text-xs px-1">🗑️</button>
                    </form>
                </div>
            `;
            
            typesList.insertAdjacentHTML('afterbegin', newTypeHtml);
            
            // Effacer le formulaire
            form.querySelector('input[name="name"]').value = '';
            
            // Feedback visuel - animation flash
            form.classList.remove('bg-green-50');
            form.classList.add('bg-green-200');
            setTimeout(() => {
                form.classList.remove('bg-green-200');
                form.classList.add('bg-green-50');
            }, 600);
        } else {
            alert(result.message || 'Erreur lors de l\'ajout');
        }
    } catch (error) {
        console.error('Error creating type:', error);
        alert('Erreur lors de l\'ajout du type');
    }
}
</script>
@endsection
