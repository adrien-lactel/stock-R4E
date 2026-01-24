@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-8">🧩 Gestion des taxonomies articles</h1>

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
    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 text-red-800 rounded border border-red-200">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- =====================
         SECTION 1 : CATÉGORIES
    ===================== --}}
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

        {{-- CREATE --}}
        <form method="POST" action="{{ route('admin.taxonomy.category.store') }}" class="mb-6 flex flex-col md:flex-row gap-2">
            @csrf
            <input name="name"
                   placeholder="Ex : Console, Jeu vidéo, Accessoire…"
                   class="flex-1 border rounded p-2"
                   required>
            <button class="bg-indigo-600 text-white px-4 py-2 rounded">➕ Ajouter</button>
        </form>

        {{-- LIST --}}
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
                    @foreach($categories as $category)
                        <tr data-filter-row data-filter-text="{{ strtolower($category->name) }}">
                            <td class="px-3 py-2">
                                <form method="POST" action="{{ route('admin.taxonomy.category.update', $category) }}" class="flex gap-2">
                                    @csrf
                                    @method('PUT')
                                    <input name="name"
                                           value="{{ $category->name }}"
                                           class="w-full rounded border-gray-300"
                                           required>
                                    <button class="px-3 py-2 rounded bg-indigo-600 text-white whitespace-nowrap">
                                        💾
                                    </button>
                                </form>
                            </td>

                            <td class="px-3 py-2 text-center text-gray-600">
                                {{ $category->subCategories->count() }}
                            </td>

                            <td class="px-3 py-2">
                                <div class="flex items-center justify-center gap-2">
                                    @if($category->subCategories->count() > 0)
                                        <span class="text-gray-400 cursor-not-allowed"
                                              title="Suppression impossible : contient des sous-catégories">
                                            🗑️ Supprimer
                                        </span>
                                    @else
                                        <form method="POST"
                                              action="{{ route('admin.taxonomy.category.destroy', $category) }}"
                                              onsubmit="return confirm('Supprimer cette catégorie ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="px-3 py-2 rounded bg-red-600 text-white whitespace-nowrap">
                                                🗑️ Supprimer
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    @if($categories->count() === 0)
                        <tr>
                            <td colspan="3" class="px-3 py-6 text-center text-gray-500">
                                Aucune catégorie
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>

    {{-- =====================
         SECTION 2 : MARQUES
    ===================== --}}
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

        {{-- CREATE --}}
        <form method="POST" action="{{ route('admin.taxonomy.brand.store') }}" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-2">
            @csrf
            <select name="article_category_id" class="w-full border rounded p-2" required>
                <option value="">— Catégorie —</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>

            <input name="name" placeholder="Ex : Nintendo, Sony…"
                   class="w-full border rounded p-2" required>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">➕ Ajouter</button>
        </form>

        {{-- LIST --}}
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
                    @foreach($categories as $category)
                        @foreach($category->brands as $brand)
                            @php
                                $filterText = strtolower($brand->name.' '.$category->name);
                            @endphp
                            <tr data-filter-row data-filter-text="{{ $filterText }}">
                                <td class="px-3 py-2">
                                    <form method="POST" action="{{ route('admin.taxonomy.brand.update', $brand) }}" class="flex gap-2">
                                        @csrf
                                        @method('PUT')
                                        <input name="name"
                                               value="{{ $brand->name }}"
                                               class="w-full rounded border-gray-300"
                                               required>
                                        <input type="hidden" name="article_category_id" value="{{ $brand->article_category_id }}">
                                        <button class="px-3 py-2 rounded bg-indigo-600 text-white whitespace-nowrap">
                                            💾
                                        </button>
                                    </form>
                                </td>

                                <td class="px-3 py-2 text-gray-600">
                                    {{ $category->name }}
                                </td>

                                <td class="px-3 py-2 text-center text-gray-600">
                                    {{ $brand->subCategories->count() }}
                                </td>

                                <td class="px-3 py-2">
                                    <div class="flex items-center justify-center gap-2">
                                        @if($brand->subCategories->count() > 0)
                                            <span class="text-gray-400 cursor-not-allowed"
                                                  title="Suppression impossible : contient des sous-catégories">
                                                🗑️ Supprimer
                                            </span>
                                        @else
                                            <form method="POST"
                                                  action="{{ route('admin.taxonomy.brand.destroy', $brand) }}"
                                                  onsubmit="return confirm('Supprimer cette marque ?');">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-red-600 hover:text-red-700">
                                                    🗑️ Supprimer
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    {{-- =====================
         SECTION 3 : SOUS-CATÉGORIES
    ===================== --}}
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

        {{-- CREATE --}}
        <form method="POST" action="{{ route('admin.taxonomy.sub-category.store') }}" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-2">
            @csrf
            <select name="article_brand_id" id="subcat-brand-select" class="w-full border rounded p-2" required>
                <option value="">— Marque —</option>
                @foreach($categories as $category)
                    <optgroup label="{{ $category->name }}">
                        @foreach($category->brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </optgroup>
                @endforeach
            </select>

            <input name="name" placeholder="Ex : Console portable"
                   class="w-full border rounded p-2" required>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">➕ Ajouter</button>
        </form>

        {{-- LIST --}}
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
                    @foreach($categories as $category)
                        @foreach($category->brands as $brand)
                            @foreach($brand->subCategories as $sub)
                                @php
                                    $filterText = strtolower($sub->name.' '.$category->name.' '.($brand->name ?? ''));
                                @endphp
                                <tr data-filter-row data-filter-text="{{ $filterText }}">
                                    <td class="px-3 py-2">
                                        <form method="POST" action="{{ route('admin.taxonomy.sub-category.update', $sub) }}" class="flex gap-2">
                                            @csrf
                                            @method('PUT')
                                            <select name="article_category_id" class="w-full rounded border-gray-300" required>
                                                @foreach($categories as $c2)
                                                    <option value="{{ $c2->id }}" @selected($sub->article_category_id == $c2->id)>
                                                        {{ $c2->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                    </td>

                                    <td class="px-3 py-2 text-gray-600">                                            <input name="name"
                                                   value="{{ $sub->name }}"
                                                   class="w-full rounded border-gray-300"
                                                   required>
                                    </td>

                                    <td class="px-3 py-2">                                            <select name="article_brand_id" class="w-full rounded border-gray-300">
                                                <option value="">— Aucune —</option>
                                                @foreach($category->brands as $b)
                                                    <option value="{{ $b->id }}" @selected($sub->article_brand_id == $b->id)>
                                                        {{ $b->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                    </td>

                                    <td class="px-3 py-2 text-center text-gray-600">
                                        {{ $sub->types->count() }}
                                    </td>

                                    <td class="px-3 py-2">
                                            <div class="flex items-center justify-center gap-2">
                                                <button class="px-3 py-2 rounded bg-indigo-600 text-white whitespace-nowrap">
                                                    💾
                                                </button>
                                        </form>

                                                @if($sub->types->count() > 0)
                                                    <span class="text-gray-400 cursor-not-allowed"
                                                          title="Suppression impossible : contient des types">
                                                        🗑️ Supprimer
                                                    </span>
                                                @else
                                                    <form method="POST"
                                                          action="{{ route('admin.taxonomy.sub-category.destroy', $sub) }}"
                                                          onsubmit="return confirm('Supprimer cette sous-catégorie ?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="px-3 py-2 rounded bg-red-600 text-white whitespace-nowrap">
                                                            🗑️ Supprimer
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach

                    @if($categories->sum(fn($c) => $c->brands->sum(fn($b) => $b->subCategories->count())) === 0)
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-gray-500">
                                Aucune sous-catégorie
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>

    {{-- =====================
         SECTION 4 : TYPES
    ===================== --}}
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

        {{-- CREATE --}}
        <form method="POST" action="{{ route('admin.taxonomy.type.store') }}" class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-2">
            @csrf
            <select name="article_sub_category_id" class="w-full border rounded p-2" required>
                <option value="">— Sous-catégorie —</option>
                @foreach($categories as $category)
                    @foreach($category->subCategories as $sub)
                        <option value="{{ $sub->id }}">
                            {{ $category->name }} › {{ $sub->name }}
                        </option>
                    @endforeach
                @endforeach
            </select>

            <input name="name" placeholder="Ex : Game Boy, Game Gear…"
                   class="w-full border rounded p-2" required>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">➕ Ajouter</button>
        </form>

        {{-- LIST --}}
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
                    @foreach($categories as $category)
                        @foreach($category->subCategories as $sub)
                            @foreach($sub->types as $type)
                                @php
                                    $filterText = strtolower($type->name.' '.$sub->name.' '.$category->name);
                                @endphp
                                <tr data-filter-row data-filter-text="{{ $filterText }}">
                                    <td class="px-3 py-2">
                                        <form method="POST" action="{{ route('admin.taxonomy.type.update', $type) }}" class="flex gap-2">
                                            @csrf
                                            @method('PUT')
                                            <input name="name"
                                                   value="{{ $type->name }}"
                                                   class="w-full rounded border-gray-300"
                                                   required>
                                    </td>

                                    <td class="px-3 py-2">
                                            <select name="article_sub_category_id" class="w-full rounded border-gray-300" required>
                                                @foreach($categories as $c2)
                                                    @foreach($c2->subCategories as $s2)
                                                        <option value="{{ $s2->id }}" @selected($type->article_sub_category_id == $s2->id)>
                                                            {{ $c2->name }} › {{ $s2->name }}
                                                        </option>
                                                    @endforeach
                                                @endforeach
                                            </select>
                                    </td>

                                    <td class="px-3 py-2 text-gray-600">
                                        {{ $category->name }}
                                    </td>

                                    <td class="px-3 py-2">
                                            <div class="flex items-center justify-center gap-2">
                                                <button class="px-3 py-2 rounded bg-indigo-600 text-white whitespace-nowrap">
                                                    💾
                                                </button>
                                        </form>

                                                <form method="POST"
                                                      action="{{ route('admin.taxonomy.type.destroy', $type) }}"
                                                      onsubmit="return confirm('Supprimer ce type ?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="px-3 py-2 rounded bg-red-600 text-white whitespace-nowrap">
                                                        🗑️ Supprimer
                                                    </button>
                                                </form>
                                            </div>
                                    </td>
                                </tr>
                            @endforeach
                        @endforeach
                    @endforeach

                    @php
                        $typesCount = 0;
                        foreach($categories as $c){ foreach($c->subCategories as $s){ $typesCount += $s->types->count(); } }
                    @endphp
                    @if($typesCount === 0)
                        <tr>
                            <td colspan="4" class="px-3 py-6 text-center text-gray-500">
                                Aucun type
                            </td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </section>

</div>

{{-- =====================
     JS filtres (client-side)
===================== --}}
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
@endsection
