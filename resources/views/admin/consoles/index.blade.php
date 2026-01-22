@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📦 Liste stock</h1>

        <div class="flex items-center gap-3">
            <a href="{{ route('admin.product-sheets.index') }}"
               class="inline-flex items-center px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                🖼️ Fiches produits
            </a>
            <a href="{{ route('admin.articles.create') }}"
               class="inline-flex items-center px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                ➕ Ajouter un article
            </a>
        </div>
    </div>

    {{-- MESSAGE SUCCÈS --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- FILTRES --}}
    <form method="GET" class="mb-6 flex flex-wrap gap-3 items-end">
        {{-- Recherche --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Serial, provenance, stockage…"
                   class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        {{-- Catégorie --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
            <select id="filter_category" name="category" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Toutes</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected((string)request('category') === (string)$cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Sous-catégorie --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Sous-catégorie</label>
            <select id="filter_subcategory" name="sub_category" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Toutes</option>
            </select>
        </div>

        {{-- Type --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
            <select id="filter_type" name="type" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Tous</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" @selected((string)request('type') === (string)$type->id)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Statut --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
            <select name="status"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Tous</option>
                <option value="stock" @selected(request('status')==='stock')>stock</option>
                <option value="defective" @selected(request('status')==='defective')>defective</option>
                <option value="repair" @selected(request('status')==='repair')>repair</option>
                <option value="disabled" @selected(request('status')==='disabled')>disabled</option>
            </select>
        </div>

        {{-- Magasin (optionnel si tu passes $stores depuis le controller) --}}
        @isset($stores)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Magasin</label>
            <select name="store_id"
                    class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Tous</option>
                @foreach($stores as $s)
                    <option value="{{ $s->id }}" @selected((string)request('store_id') === (string)$s->id)>
                        {{ $s->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @endisset

        <div class="flex gap-2">
            <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                Filtrer
            </button>
            <a href="{{ route('admin.consoles.index') }}" class="px-4 py-2 rounded border">
                Reset
            </a>
        </div>
    </form>

    <script>
    document.addEventListener('DOMContentLoaded', () => {
      const cat = document.getElementById('filter_category');
      const sub = document.getElementById('filter_subcategory');
      const type = document.getElementById('filter_type');
      if (!cat || !sub || !type) return;

      async function fetchJson(url) {
        try {
          const r = await fetch(url, { headers: { 'Accept': 'application/json' } });
          if (!r.ok) throw new Error(`HTTP ${r.status}`);
          return await r.json();
        } catch (e) {
          console.error('fetchJson error', e);
          return [];
        }
      }

      const SUBS_URL_TEMPLATE = `{{ route('admin.ajax.sub-categories', ['category' => '__ID__']) }}`;
      const TYPES_URL_TEMPLATE = `{{ route('admin.ajax.types', ['subCategory' => '__ID__']) }}`;

      async function loadSubs(catId, applyOld = false) {
        sub.innerHTML = '<option value="">Toutes</option>';
        type.innerHTML = '<option value="">Tous</option>';
        if (!catId) return;
        const url = SUBS_URL_TEMPLATE.replace('__ID__', catId);
        const data = await fetchJson(url);
        const list = Array.isArray(data) ? data : (data.data ?? []);
        list.forEach(s => {
          const opt = document.createElement('option'); opt.value = s.id; opt.textContent = s.name; sub.appendChild(opt);
        });
        if (applyOld && @json(request('sub_category'))) {
          try { sub.value = String(@json(request('sub_category'))); } catch(e){}
        }
      }

      async function loadTypes(subId, applyOld = false) {
        type.innerHTML = '<option value="">Tous</option>';
        if (!subId) return;
        const url = TYPES_URL_TEMPLATE.replace('__ID__', subId);
        const data = await fetchJson(url);
        const list = Array.isArray(data) ? data : (data.data ?? []);
        list.forEach(t => { const opt = document.createElement('option'); opt.value = t.id; opt.textContent = t.name; type.appendChild(opt); });
        if (applyOld && @json(request('type'))) { try { type.value = String(@json(request('type'))); } catch(e){} }
      }

      cat.addEventListener('change', async () => { await loadSubs(cat.value, false); });
      sub.addEventListener('change', async () => { await loadTypes(sub.value, false); });

      // Init
      (async () => {
        if (cat.value) {
          await loadSubs(cat.value, true);
          if (sub.value) { await loadTypes(sub.value, true); }
        }
      })();
    });
    </script>
    </form>

    {{-- TABLE --}}
    <div class="bg-pink-50 shadow rounded-lg overflow-hidden border border-pink-100 overflow-x-auto">
        <table class="min-w-full text-sm">
            <thead class="bg-pink-100">
                <tr>
                    <th class="px-4 py-3 text-center">ID</th>
                    <th class="px-4 py-3 text-left">Catégorie / Sous-cat. / Type</th>
                    <th class="px-4 py-3 text-left">Localisation</th>
                    <th class="px-4 py-3 text-center">Statut</th>
                    <th class="px-4 py-3 text-right">Prix achat</th>
                    <th class="px-4 py-3 text-right">Coût répa.</th>
                    <th class="px-4 py-3 text-right">Prix revient</th>
                    <th class="px-4 py-3 text-right">Prix R4E</th>
                    <th class="px-4 py-3 text-center">Modifier statut</th>
                    <th class="px-4 py-3 text-center w-[180px] whitespace-nowrap">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-pink-100">
            <tbody class="divide-y divide-gray-200">
                @forelse($consoles as $console)
                    @php $hasMods = $console->mods_count > 0; @endphp
                    <tr class="align-top {{ $hasMods ? 'bg-amber-100 border-l-4 border-l-amber-300' : 'bg-white' }}">
                        <td class="px-4 py-3 text-center font-medium text-gray-800">
                            {{ $console->id }}
                            @if($hasMods)
                                <span class="block text-xs text-amber-600 font-normal">modé</span>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            <div>
                                <span class="font-semibold">{{ $console->articleCategory?->name ?? '—' }}</span>
                                <span class="text-gray-400"> / </span>
                                <span>{{ $console->articleSubCategory?->name ?? '—' }}</span>
                                <span class="text-gray-400"> / </span>
                                <span>{{ $console->articleType?->name ?? '—' }}</span>
                            </div>
                        </td>
                        <td class="px-4 py-3">
                            @if($console->repairer)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-purple-100 text-purple-800 border border-purple-200">
                                    🔧 {{ $console->repairer->name }}
                                </span>
                            @elseif($console->store)
                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800 border border-blue-200">
                                    🏪 {{ $console->store->name }}
                                </span>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold
                                @if($console->status === 'stock') bg-green-100 text-green-800 border border-green-200
                                @elseif($console->status === 'defective') bg-orange-100 text-orange-800 border border-orange-200
                                @elseif($console->status === 'repair') bg-indigo-100 text-indigo-800 border border-indigo-200
                                @elseif($console->status === 'disabled') bg-red-100 text-red-800 border border-red-200
                                @else bg-gray-100 text-gray-800 border border-gray-200
                                @endif">
                                {{ $console->status ? ucfirst($console->status) : '—' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-right">
                            @if(!is_null($console->prix_achat))
                                {{ number_format($console->prix_achat, 2, ',', ' ') }} €
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            @php $repairCost = $console->repair_cost ?? 0; @endphp
                            @if($repairCost > 0)
                                <span class="text-orange-600 font-medium">{{ number_format($repairCost, 2, ',', ' ') }} €</span>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            @php $totalCost = $console->total_cost ?? 0; @endphp
                            @if($totalCost > 0)
                                <span class="font-semibold text-gray-900">{{ number_format($totalCost, 2, ',', ' ') }} €</span>
                            @else
                                <span class="text-gray-400">—</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-right">
                            <span class="font-semibold text-gray-900">{{ number_format($console->valorisation, 2, ',', ' ') }} €</span>
                        </td>
                        <td class="px-4 py-3 text-center align-top">
                            <form method="POST"
                                action="{{ route('admin.consoles.update-status', $console) }}"
                                class="flex flex-col space-y-2 items-center">
                                @csrf
                                @method('PATCH')
                                <select name="status" class="w-full max-w-[160px] border border-gray-300 rounded p-2 text-sm">
                                    <option value="stock" @selected($console->status === 'stock')>🟢 En stock</option>
                                    <option value="defective" @selected($console->status === 'defective')>🟠 Défectueuse</option>
                                    <option value="repair" @selected($console->status === 'repair')>🔧 En réparation</option>
                                    <option value="disabled" @selected($console->status === 'disabled')>⛔ Désactivée</option>
                                </select>
                                <button type="submit" class="w-full max-w-[160px] bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700 text-sm font-medium">
                                    💾 Enregistrer
                                </button>
                            </form>
                        </td>
                        <td class="px-4 py-3 text-center w-[180px] whitespace-nowrap align-top">
                            <div class="flex flex-col gap-2 items-center">
                                <a href="{{ route('admin.articles.edit', $console) }}"
                                   class="bg-yellow-100 text-yellow-800 px-3 py-1 rounded hover:bg-yellow-200 border border-yellow-200 font-medium">
                                    ✏️ Éditer
                                </a>
                                @if($console->article_type_id)
                                    @if($console->productSheet)
                                        {{-- Article déjà lié à une fiche --}}
                                        <a href="{{ route('admin.product-sheets.edit', $console->productSheet) }}"
                                           class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded hover:bg-emerald-200 border border-emerald-200 font-medium"
                                           title="Voir la fiche '{{ $console->productSheet->name }}'">
                                            🖼️ Voir fiche
                                        </a>
                                    @else
                                        @php
                                            $existingSheet = $productSheets->get($console->article_type_id)?->first();
                                        @endphp
                                        @if($existingSheet)
                                            {{-- Dupliquer une fiche existante --}}
                                            <form method="POST" action="{{ route('admin.product-sheets.duplicate', $existingSheet) }}" class="w-full">
                                                @csrf
                                                <input type="hidden" name="console_id" value="{{ $console->id }}">
                                                <button type="submit"
                                                        class="w-full bg-blue-100 text-blue-800 px-3 py-1 rounded hover:bg-blue-200 border border-blue-200 font-medium"
                                                        title="Dupliquer la fiche '{{ $existingSheet->name }}'">
                                                    📋 Dupliquer fiche
                                                </button>
                                            </form>
                                        @else
                                            {{-- Créer une nouvelle fiche --}}
                                            <a href="{{ route('admin.product-sheets.create', ['article_type_id' => $console->article_type_id, 'console_id' => $console->id]) }}"
                                               class="bg-emerald-100 text-emerald-800 px-3 py-1 rounded hover:bg-emerald-200 border border-emerald-200 font-medium">
                                                🖼️ Créer fiche
                                            </a>
                                        @endif
                                    @endif
                                @endif
                                @if($console->status === 'stock')
                                    <a href="{{ route('admin.consoles.edit', $console) }}"
                                       class="bg-indigo-100 text-indigo-800 px-3 py-1 rounded hover:bg-indigo-200 border border-indigo-200 font-medium">
                                        ⚙️ Gérer les prix
                                    </a>
                                @else
                                    <span class="bg-gray-100 text-gray-400 px-3 py-1 rounded border border-gray-200 cursor-not-allowed"
                                          title="Les prix ne peuvent être définis que si l'article est en stock">
                                        🚫 Prix indisponibles
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="11" class="px-4 py-8 text-center text-gray-500">
                            Aucun article trouvé
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination safe --}}
    @if (method_exists($consoles, 'links'))
        <div class="mt-4">
            {{ $consoles->links() }}
        </div>
    @endif

</div>
@endsection
