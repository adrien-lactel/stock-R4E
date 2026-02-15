@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $console->exists ? "✏️ Édition complète article #{$console->id}" : "➕ Nouvelle fiche article" }}
        </h1>
        <div class="flex items-center gap-2">
            @if($console->exists && $console->product_sheet_id)
                <a href="{{ route('admin.product-sheets.edit', $console->product_sheet_id) }}" 
                   class="px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                    🖼️ Fiche produit
                </a>
            @endif
            <a href="{{ route('admin.consoles.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour stock</a>
        </div>
    </div>

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

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ $console->exists ? route('admin.articles.update', $console) : route('admin.articles.store') }}">
            @csrf
            @if($console->exists)
                @method('PUT')
            @endif

            <h2 class="text-lg font-semibold text-gray-800">Classification</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-3">
                <div>
                    <label class="block text-sm font-medium">Catégorie *</label>
                    <select id="article_category_id" name="article_category_id" class="w-full rounded border-gray-300" required>
                        <option value="">— Choisir —</option>
                        @foreach($articleCategories as $cat)
                            <option value="{{ $cat->id }}" @selected(old('article_category_id', $console->article_category_id) == $cat->id)>{{ $cat->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Marque *</label>
                    <select id="article_brand_id" name="article_brand_id" class="w-full rounded border-gray-300" required>
                        <option value="">— Choisir —</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Sous-catégorie *</label>
                    <select id="article_sub_category_id" name="article_sub_category_id" class="w-full rounded border-gray-300" required>
                        <option value="">— Choisir —</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Type *</label>
                    <select id="article_type_id" name="article_type_id" class="w-full rounded border-gray-300" required>
                        <option value="">— Choisir —</option>
                    </select>
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Identité & détails</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                <div>
                    <label class="block text-sm font-medium">Numéro de série</label>
                    <input name="serial_number" class="w-full rounded border-gray-300" value="{{ old('serial_number', $console->serial_number) }}">
                </div>
                <div>
                    <label class="block text-sm font-medium">Catégorie interne</label>
                    <input name="category" class="w-full rounded border-gray-300" value="{{ old('category', $console->category) }}">
                </div>
                <div>
                    <label class="block text-sm font-medium">Provenance</label>
                    <input name="provenance_article" list="provenances-list" class="w-full rounded border-gray-300" value="{{ old('provenance_article', $console->provenance_article) }}">
                    <datalist id="provenances-list">@foreach($provenances as $p)<option value="{{ $p }}">@endforeach</datalist>
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Stock / Réparation</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-3">
                <div>
                    <label class="block text-sm font-medium">Statut *</label>
                    @php $st = old('status', $console->status); @endphp
                    <select name="status" class="w-full rounded border-gray-300" required>
                        <option value="stock" @selected($st==='stock')>Stock</option>
                        <option value="defective" @selected($st==='defective')>Défectueuse</option>
                        <option value="repair" @selected($st==='repair')>En réparation</option>
                        <option value="disabled" @selected($st==='disabled')>Désactivée</option>
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Réparateur</label>
                    <select name="repairer_id" class="w-full rounded border-gray-300">
                        <option value="">— Aucun —</option>
                        @foreach($repairers as $rep)
                            <option value="{{ $rep->id }}" @selected(old('repairer_id', $console->repairer_id) == $rep->id)>{{ $rep->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium">Prix d’achat (€)</label>
                    <input type="number" step="0.01" min="0" name="prix_achat" value="{{ old('prix_achat', $console->prix_achat) }}" class="w-full rounded border-gray-300">
                </div>

                <div>
                    <label class="block text-sm font-medium">Valorisation (€)</label>
                    <input type="number" step="0.01" min="0" name="valorisation" value="{{ old('valorisation', $console->valorisation) }}" class="w-full rounded border-gray-300">
                </div>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Modifications (Mods & Accessoires)</h2>
            
            {{-- Mods actuellement associés + Coût de réparation --}}
            @if($console->mods->count())
                @php
                    $totalMinutes = $console->mods->sum('pivot.work_time_minutes');
                    $hours = floor($totalMinutes / 60);
                    $minutes = $totalMinutes % 60;
                    $coutMods = $console->mods->sum('pivot.price_applied');
                    $coutMainOeuvre = ($totalMinutes / 60) * 20; // 20€/heure
                    $coutTotalReparation = $coutMods + $coutMainOeuvre;
                    $prixAchat = $console->prix_achat ?? 0;
                    $coutRevient = $prixAchat + $coutTotalReparation;
                @endphp
                
                {{-- Bloc coût de réparation + coût de revient --}}
                <div class="mt-3 mb-4 p-4 bg-indigo-50 border border-indigo-200 rounded-lg">
                    <h4 class="text-sm font-semibold text-indigo-800 mb-3">💰 Coûts</h4>
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                        <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                            <div class="text-xs text-gray-500 uppercase">Prix d'achat</div>
                            <div class="text-xl font-bold text-gray-700">{{ number_format($prixAchat, 2) }} €</div>
                        </div>
                        <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                            <div class="text-xs text-gray-500 uppercase">Coût Mods</div>
                            <div class="text-xl font-bold text-blue-600">{{ number_format($coutMods, 2) }} €</div>
                        </div>
                        <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                            <div class="text-xs text-gray-500 uppercase">Temps travail</div>
                            <div class="text-xl font-bold text-orange-600">
                                {{ $hours > 0 ? $hours.'h ' : '' }}{{ $minutes }}min
                            </div>
                        </div>
                        <div class="text-center p-3 bg-white rounded-lg shadow-sm">
                            <div class="text-xs text-gray-500 uppercase">Main d'œuvre (20€/h)</div>
                            <div class="text-xl font-bold text-orange-600">{{ number_format($coutMainOeuvre, 2) }} €</div>
                        </div>
                        <div class="text-center p-3 bg-indigo-100 rounded-lg shadow-sm border border-indigo-300">
                            <div class="text-xs text-indigo-700 uppercase font-semibold">Coût Réparation</div>
                            <div class="text-xl font-bold text-indigo-700">{{ number_format($coutTotalReparation, 2) }} €</div>
                        </div>
                        <div class="text-center p-3 bg-green-100 rounded-lg shadow-sm border-2 border-green-400">
                            <div class="text-xs text-green-700 uppercase font-semibold">Coût de Revient</div>
                            <div class="text-2xl font-bold text-green-700">{{ number_format($coutRevient, 2) }} €</div>
                        </div>
                    </div>
                </div>

                {{-- Liste des mods associés --}}
                <div class="mb-4 p-4 bg-gray-50 rounded-lg">
                    <h4 class="text-sm font-medium text-gray-700 mb-2">Mods, Accessoires & Opérations associés :</h4>
                    <div class="flex flex-wrap gap-2">
                        @foreach($console->mods as $mod)
                            @php
                                $badgeClass = $mod->is_operation 
                                    ? 'bg-orange-100 text-orange-800 hover:bg-orange-200' 
                                    : ($mod->is_accessory ? 'bg-purple-100 text-purple-800 hover:bg-purple-200' : 'bg-blue-100 text-blue-800 hover:bg-blue-200');
                                $icon = $mod->is_operation ? '🔧' : ($mod->is_accessory ? '📦' : '🔩');
                            @endphp
                            <form method="POST" action="{{ route('admin.consoles.remove-mod', [$console, $mod]) }}" class="inline" onsubmit="return confirm('Retirer ce mod ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="inline-flex items-center px-3 py-1 rounded-full text-sm {{ $badgeClass }} cursor-pointer transition-all group">
                                    <span class="group-hover:hidden">{{ $icon }} {{ $mod->name }}</span>
                                    <span class="hidden group-hover:inline text-red-600">🗑️ Retirer</span>
                                    @if($mod->pivot->price_applied && !$mod->is_operation)
                                        <span class="ml-1 text-xs opacity-75 group-hover:hidden">({{ number_format($mod->pivot->price_applied, 2) }}€)</span>
                                    @endif
                                    @if($mod->pivot->work_time_minutes)
                                        <span class="ml-1 text-xs opacity-75 group-hover:hidden">· {{ $mod->pivot->work_time_minutes }}min</span>
                                    @endif
                                </button>
                            </form>
                        @endforeach
                    </div>
                </div>
            @else
                <div class="mt-3 mb-4 p-4 bg-gray-50 rounded-lg text-center text-gray-500">
                    Aucun mod associé — Coût de réparation: <strong>0,00 €</strong>
                </div>
            @endif

            <form method="POST" action="{{ route('admin.consoles.add-mod', $console) }}" class="mt-3 max-w-md">
                @csrf
                <div class="p-4 border rounded-lg bg-white">
                    <label class="block text-sm font-medium text-gray-700 mb-2">➕ Ajouter un Mod / Opération</label>
                    <select name="mod_id" class="w-full rounded border-gray-300 text-sm" required>
                        <option value="">— Aucun —</option>
                        <optgroup label="🔧 Opérations (temps uniquement)">
                            @foreach($allMods->where('is_operation', true) as $mod)
                                <option value="{{ $mod->id }}" data-price="0">
                                    {{ $mod->name }}
                                </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="🔩 Mods (pièces)">
                            @foreach($allMods->where('is_accessory', false)->where('is_operation', false) as $mod)
                                <option value="{{ $mod->id }}" data-price="{{ $mod->purchase_price }}">
                                    {{ $mod->name }} ({{ number_format($mod->purchase_price, 2) }}€)
                                </option>
                            @endforeach
                        </optgroup>
                        <optgroup label="📦 Accessoires">
                            @foreach($allMods->where('is_accessory', true)->where('is_operation', false) as $mod)
                                <option value="{{ $mod->id }}" data-price="{{ $mod->purchase_price }}">
                                    {{ $mod->name }} ({{ number_format($mod->purchase_price, 2) }}€)
                                </option>
                            @endforeach
                        </optgroup>
                    </select>
                    <div class="grid grid-cols-2 gap-2 mt-3">
                        <div>
                            <label class="block text-xs text-gray-500">Prix (€)</label>
                            <input type="number" step="0.01" min="0" name="price_applied" 
                                   class="w-full rounded border-gray-300 text-sm" placeholder="Auto">
                        </div>
                        <div>
                            <label class="block text-xs text-gray-500">Temps (min)</label>
                            <input type="number" min="0" name="work_time_minutes" 
                                   class="w-full rounded border-gray-300 text-sm" placeholder="0">
                        </div>
                    </div>
                    <div class="mt-2">
                        <label class="block text-xs text-gray-500">Notes</label>
                        <input type="text" name="notes" 
                               class="w-full rounded border-gray-300 text-sm" placeholder="Notes...">
                    </div>
                    <button type="submit" class="mt-3 w-full px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition text-sm font-medium">
                        ✓ Ajouter ce mod
                    </button>
                </div>
            </form>
            <div class="flex items-center gap-4 mt-2">
                <p class="text-xs text-gray-500">💡 Le mod sera ajouté aux mods existants. Pour retirer un mod, cliquez dessus dans la liste ci-dessus.</p>
                <a href="{{ route('admin.mods.create') }}" target="_blank" class="text-xs text-indigo-600 hover:underline whitespace-nowrap">➕ Créer un nouveau mod</a>
            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Logistique & magasin</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
                <div>
                    <label class="block text-sm font-medium">Lieu de stockage</label>
                    <input name="lieu_stockage" list="lieux-list" class="w-full rounded border-gray-300" value="{{ old('lieu_stockage', $console->lieu_stockage) }}">
                    <datalist id="lieux-list">@foreach($lieux as $l)<option value="{{ $l }}">@endforeach</datalist>
                </div>

                <div>
                    <label class="block text-sm font-medium">Magasin</label>
                    <select name="store_id" class="w-full rounded border-gray-300">
                        <option value="">— Choisir —</option>
                        @foreach($stores as $s)
                            <option value="{{ $s->id }}" @selected(old('store_id', $console->store_id) == $s->id)>{{ $s->name }}</option>
                        @endforeach
                    </select>
                </div>


            </div>

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Commentaires</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-3">
                <div>
                    <label class="block text-sm font-medium">Commentaire produit</label>
                    <textarea name="product_comment" rows="4" class="w-full rounded border-gray-300">{{ old('product_comment', $console->product_comment) }}</textarea>
                </div>
                <div>
                    <label class="block text-sm font-medium">Commentaire réparateur</label>
                    <textarea name="commentaire_reparateur" rows="4" class="w-full rounded border-gray-300">{{ old('commentaire_reparateur', $console->commentaire_reparateur) }}</textarea>
                </div>
            </div>

            <div class="mt-4">
                <label class="block text-sm font-medium">Commentaire admin</label>
                <textarea name="admin_comment" rows="4" class="w-full rounded border-gray-300">{{ old('admin_comment', $console->admin_comment) }}</textarea>
            </div>

            <div class="mt-6 flex gap-3">
                <button class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">💾 Enregistrer</button>
                <a href="{{ route('admin.consoles.index') }}" class="px-6 py-2 rounded border hover:bg-gray-50">Annuler</a>
            </div>
        </form>
    </div>

</div>

<script>
// Cascade taxonomy: Category → Brand → SubCategory → Type
document.addEventListener('DOMContentLoaded', () => {
  const catSelect   = document.getElementById('article_category_id');
  const brandSelect = document.getElementById('article_brand_id');
  const subSelect   = document.getElementById('article_sub_category_id');
  const typeSelect  = document.getElementById('article_type_id');
  if (!catSelect || !brandSelect || !subSelect || !typeSelect) return;

  const oldBrand = @json(old('article_brand_id', $console->article_brand_id));
  const oldSub   = @json(old('article_sub_category_id', $console->article_sub_category_id));
  const oldType  = @json(old('article_type_id', $console->article_type_id));

  function clearSelect(sel, placeholder = '— Choisir —') {
    sel.innerHTML = '';
    const opt = document.createElement('option'); 
    opt.value = ''; 
    opt.textContent = placeholder; 
    sel.appendChild(opt);
  }

  async function fetchJson(url) { 
    const res = await fetch(url, { headers: { 'Accept': 'application/json' }}); 
    if (!res.ok) throw new Error(`HTTP ${res.status}`); 
    return await res.json(); 
  }

  async function loadBrands(categoryId, applyOld = false) {
    clearSelect(brandSelect); 
    clearSelect(subSelect); 
    clearSelect(typeSelect);
    if (!categoryId) return;
    
    const url = `{{ route('admin.ajax.brands', ['category' => '__ID__']) }}`.replace('__ID__', categoryId);
    const data = await fetchJson(url);
    const list = data.brands || [];
    list.forEach(brand => { 
      const opt = document.createElement('option'); 
      opt.value = brand.id; 
      opt.textContent = brand.name; 
      brandSelect.appendChild(opt); 
    });
    
    if (applyOld && oldBrand) { 
      brandSelect.value = String(oldBrand); 
      if (brandSelect.value) {
        await loadSubCategories(brandSelect.value, true); 
      }
    }
  }

  async function loadSubCategories(brandId, applyOld = false) {
    clearSelect(subSelect); 
    clearSelect(typeSelect);
    if (!brandId) return;
    
    const url = `{{ route('admin.ajax.sub-categories', ['brand' => '__ID__']) }}`.replace('__ID__', brandId);
    const data = await fetchJson(url);
    const list = data.subcategories || [];
    list.forEach(sc => { 
      const opt = document.createElement('option'); 
      opt.value = sc.id; 
      opt.textContent = sc.name; 
      subSelect.appendChild(opt); 
    });
    
    if (applyOld && oldSub) { 
      subSelect.value = String(oldSub); 
      if (subSelect.value) {
        await loadTypes(subSelect.value, true); 
      }
    }
  }

  async function loadTypes(subCategoryId, applyOld = false) {
    clearSelect(typeSelect);
    if (!subCategoryId) return;
    
    const url = `{{ route('admin.ajax.types', ['subCategory' => '__ID__']) }}`.replace('__ID__', subCategoryId);
    const data = await fetchJson(url);
    const list = Array.isArray(data) ? data : [];
    list.forEach(t => { 
      const opt = document.createElement('option'); 
      opt.value = t.id; 
      opt.textContent = t.name; 
      typeSelect.appendChild(opt); 
    });
    
    if (applyOld && oldType) { 
      typeSelect.value = String(oldType); 
    }
  }

  catSelect.addEventListener('change', async () => { 
    try { await loadBrands(catSelect.value, false); } catch(e) { console.error(e); } 
  });
  
  brandSelect.addEventListener('change', async () => { 
    try { await loadSubCategories(brandSelect.value, false); } catch(e) { console.error(e); } 
  });
  
  subSelect.addEventListener('change', async () => { 
    try { await loadTypes(subSelect.value, false); } catch(e) { console.error(e); } 
  });

  // Charger les données initiales au chargement de la page
  (async () => { 
    const initialCategoryId = catSelect.value;
    if (initialCategoryId) { 
      try { 
        await loadBrands(initialCategoryId, true); 
      } catch(e) {
        console.error('Erreur lors du chargement des marques:', e);
      } 
    }
  })();
});
</script>
@endsection
