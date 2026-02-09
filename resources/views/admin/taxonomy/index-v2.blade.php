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
                    <span class="ml-1 px-2 py-0.5 text-xs rounded-full bg-gray-200 text-gray-700">Pagination</span>
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

        {{-- ONGLET VUE HIÉRARCHIQUE (Chargement à la demande) --}}
        <div x-show="activeTab === 'tree'" class="p-6">
            <h2 class="text-xl font-semibold mb-4">🌳 Vue hiérarchique</h2>
            <p class="text-sm text-gray-600 mb-4">Exploration et modification de la taxonomie<br>
            <span class="text-xs text-gray-500">Catégorie → Marque → Sous-catégorie</span></p>
            
            <div class="space-y-2">
                @foreach($categories as $category)
                    <div class="border rounded-lg" x-data="{ openCat: false }">
                        <div @click="openCat = !openCat; if(openCat && !$el.dataset.loaded) loadBrands({{ $category->id }}, $el)"
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
                                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                    </svg>
                                    Chargement des marques...
                                </div>
                            </div>
                            <div class="brands-container space-y-1"></div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- ONGLET TYPES (Pagination) --}}
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
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
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

        async loadBrands(categoryId, element) {
            if (element.dataset.loaded) return;
            
            // Trouver le conteneur parent puis chercher les éléments
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
                        <div class="border rounded-lg ml-4">
                            <div onclick="toggleAndLoadSubcats(this, ${brand.id})"
                                 class="p-2 cursor-pointer hover:bg-gray-50 flex items-center justify-between">
                                <div class="flex items-center gap-2">
                                    <span class="toggle-icon">▶</span>
                                    <span class="text-sm font-medium">🏷️ ${brand.name}</span>
                                    <span class="text-xs text-gray-500">(${brand.sub_categories_count || 0} sous-cat.)</span>
                                </div>
                            </div>
                            <div class="subcats-wrapper" style="display: none;">
                                <div class="pl-6 pb-2 pr-2">
                                    <div class="loading-subcats">
                                        <div class="text-xs text-gray-500 flex items-center gap-1">
                                            <svg class="animate-spin h-3 w-3" viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4" fill="none"></circle>
                                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                            </svg>
                                            Chargement sous-catégories...
                                        </div>
                                    </div>
                                    <div class="subcats-container space-y-1"></div>
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

        async loadSubCategories(categoryId, element) {
            // Méthode conservée pour compatibilité mais redirige vers les marques
            return this.loadBrands(categoryId, element);
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
                            <div class="flex items-center justify-between">
                                <div class="flex-1">
                                    <span class="font-medium">${type.name}</span>
                                    <span class="text-sm text-gray-500 ml-2">${type.sub_category_name || ''}</span>
                                </div>
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

// Fonction globale pour charger sous-catégories (appelée depuis HTML généré dynamiquement)
// Fonction globale pour charger sous-catégories (appelée depuis HTML généré dynamiquement)
async function toggleAndLoadSubcats(clickedElement, brandId) {
    const brandContainer = clickedElement.closest('.border');
    const wrapper = brandContainer.querySelector('.subcats-wrapper');
    const toggleIcon = brandContainer.querySelector('.toggle-icon');
    const loading = brandContainer.querySelector('.loading-subcats');
    const container = brandContainer.querySelector('.subcats-container');
    
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
                <div class="border rounded p-2 bg-white hover:bg-gray-50 ml-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium">📂 ${sub.name}</span>
                        <span class="text-xs text-gray-500">${sub.types_count || 0} types</span>
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

async function loadSubCategoriesForBrand(brandId, element) {
    if (element.dataset.loaded) return;
    
    const container = element.querySelector('.subcats-container');
    const loading = element.querySelector('.loading-subcats');
    
    try {
        const response = await fetch(`/admin/ajax/taxonomy/subcategories/${brandId}`);
        const data = await response.json();
        
        loading.style.display = 'none';
        
        if (data.subcategories && data.subcategories.length > 0) {
            container.innerHTML = data.subcategories.map(sub => `
                <div class="border rounded p-2 bg-white hover:bg-gray-50 ml-2">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium">📂 ${sub.name}</span>
                        <span class="text-xs text-gray-500">${sub.types_count || 0} types</span>
                    </div>
                </div>
            `).join('');
        } else {
            container.innerHTML = '<div class="text-xs text-gray-500 p-2 ml-2">Aucune sous-catégorie</div>';
        }
        
        element.dataset.loaded = 'true';
    } catch (error) {
        loading.innerHTML = '<div class="text-xs text-red-500">Erreur de chargement</div>';
        console.error('Error loading subcategories:', error);
    }
}
</script>
@endsection
