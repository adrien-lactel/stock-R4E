@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">📦 Liste stock</h1>

        <a href="{{ route('admin.articles.create') }}"
           class="inline-flex items-center px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
            ➕ Ajouter un article
        </a>
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
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-center">ID</th>
                    <th class="px-4 py-3 text-left">Catégorie</th>
                    <th class="px-4 py-3 text-left">Sous-cat.</th>
                    <th class="px-4 py-3 text-left">Type</th>
                    <th class="px-4 py-3 text-left">Magasin</th>
                    <th class="px-4 py-3 text-center">Statut</th>
                    <th class="px-4 py-3 text-center">Valorisation</th>
                    <th class="px-4 py-3 text-center">Prix définis</th>
                    <th class="px-4 py-3 text-center">Contrôle admin</th>
                    <th class="px-4 py-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @forelse($consoles as $console)
                    <tr class="align-top">
                        {{-- ID --}}
                        <td class="px-4 py-3 text-center font-medium text-gray-800">
                            {{ $console->id }}
                        </td>

                        {{-- Catégorie --}}
                        <td class="px-4 py-3">
                            {{ $console->articleCategory?->name ?? '—' }}
                        </td>

                        {{-- Sous-cat --}}
                        <td class="px-4 py-3">
                            {{ $console->articleSubCategory?->name ?? '—' }}
                        </td>

                        {{-- Type --}}
                        <td class="px-4 py-3">
                            {{ $console->articleType?->name ?? '—' }}
                        </td>

                        {{-- Magasin --}}
                        <td class="px-4 py-3">
                            {{ $console->store?->name ?? '—' }}
                        </td>

                        {{-- Statut badge --}}
                        <td class="px-4 py-3 text-center">
                            <span class="inline-flex items-center px-2 py-1 rounded text-white text-xs
                                @if($console->status === 'stock') bg-green-600
                                @elseif($console->status === 'defective') bg-orange-600
                                @elseif($console->status === 'repair') bg-indigo-600
                                @elseif($console->status === 'disabled') bg-red-700
                                @else bg-gray-600
                                @endif">
                                {{ $console->status ? ucfirst($console->status) : '—' }}
                            </span>
                        </td>

                        {{-- Valorisation --}}
                        <td class="px-4 py-3 text-center">
                            @if(!is_null($console->valorisation))
                                {{ number_format($console->valorisation, 2, ',', ' ') }} €
                            @else
                                —
                            @endif
                        </td>

                        {{-- Prix définis --}}
                        <td class="px-4 py-3 text-center">
                            {{ $console->stores_count ?? 0 }} magasin(s)
                        </td>

                        {{-- CONTROLE ADMIN --}}
                        <td class="px-4 py-3 w-[280px]">
                            <form method="POST"
                                  action="{{ route('admin.consoles.update-status', $console) }}"
                                  class="space-y-2">
                                @csrf
                                @method('PATCH')

                                <select name="status" class="w-full border rounded p-2 text-sm">
                                    <option value="stock" @selected($console->status === 'stock')>🟢 En stock</option>
                                    <option value="defective" @selected($console->status === 'defective')>🟠 Défectueuse</option>
                                    <option value="repair" @selected($console->status === 'repair')>🔧 En réparation</option>
                                    <option value="disabled" @selected($console->status === 'disabled')>⛔ Désactivée</option>
                                </select>

                                <textarea name="admin_comment" rows="2"
                                          class="w-full border rounded p-2 text-sm"
                                          placeholder="Commentaire interne admin…">{{ $console->admin_comment }}</textarea>

                                <button class="w-full bg-blue-600 text-white px-3 py-2 rounded hover:bg-blue-700">
                                    💾 Enregistrer
                                </button>
                            </form>
                        </td>

                        {{-- ACTIONS --}}
                        <td class="px-4 py-3 text-center whitespace-nowrap">
                            <div class="flex flex-col gap-2 items-center">
                                <a href="{{ route('admin.articles.edit', $console) }}"
                                   class="text-gray-700 hover:underline">
                                    ✏️ Éditer
                                </a>

                                @if($console->status === 'stock')
                                    <a href="{{ route('admin.consoles.edit', $console) }}"
                                       class="text-indigo-600 hover:underline font-medium">
                                        ⚙️ Gérer les prix
                                    </a>
                                @else
                                    <span class="text-gray-400 cursor-not-allowed"
                                          title="Les prix ne peuvent être définis que si l'article est en stock">
                                        🚫 Prix indisponibles
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="px-4 py-8 text-center text-gray-500">
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
