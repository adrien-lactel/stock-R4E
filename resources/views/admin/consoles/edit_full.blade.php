@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $console->exists ? "✏️ Édition complète article #{$console->id}" : "➕ Nouvelle fiche article" }}
        </h1>
        <a href="{{ route('admin.consoles.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour stock</a>
    </div>

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

            <h2 class="text-lg font-semibold text-gray-800">Taxonomie</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-3">
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

            <h2 class="text-lg font-semibold text-gray-800 mt-8">Modifications</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mt-3">
                @for($i=1;$i<=4;$i++)
                    <div>
                        <label class="block text-sm font-medium">Mod {{ $i }}</label>
                        <input name="mod_{{ $i }}" list="mods-list" class="w-full rounded border-gray-300" value="{{ old('mod_'.$i, $console->{'mod_'.$i}) }}">
                    </div>
                @endfor
            </div>
            <datalist id="mods-list">@foreach($mods as $m)<option value="{{ $m }}">@endforeach</datalist>

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
// Cascade taxonomy (same logic as quick form)
document.addEventListener('DOMContentLoaded', () => {
  const catSelect  = document.getElementById('article_category_id');
  const subSelect  = document.getElementById('article_sub_category_id');
  const typeSelect = document.getElementById('article_type_id');
  if (!catSelect || !subSelect || !typeSelect) return;

  const oldSub  = @json(old('article_sub_category_id', $console->article_sub_category_id));
  const oldType = @json(old('article_type_id', $console->article_type_id));

  function clearSelect(sel, placeholder = '— Choisir —') {
    sel.innerHTML = '';
    const opt = document.createElement('option'); opt.value = ''; opt.textContent = placeholder; sel.appendChild(opt);
  }

  async function fetchJson(url) { const res = await fetch(url, { headers: { 'Accept': 'application/json' }}); if (!res.ok) throw new Error(`HTTP ${res.status}`); return await res.json(); }

  async function loadSubCategories(categoryId, applyOld = false) {
    clearSelect(subSelect); clearSelect(typeSelect);
    if (!categoryId) return;
    const url = `{{ route('admin.ajax.sub-categories', ['category' => '__ID__']) }}`.replace('__ID__', categoryId);
    const data = await fetchJson(url);
    const list = Array.isArray(data) ? data : (data.data ?? []);
    list.forEach(sc => { const opt = document.createElement('option'); opt.value = sc.id; opt.textContent = sc.name; subSelect.appendChild(opt); });
    if (applyOld && oldSub) { subSelect.value = String(oldSub); if (subSelect.value) await loadTypes(subSelect.value, true); }
  }

  async function loadTypes(subCategoryId, applyOld = false) {
    clearSelect(typeSelect);
    if (!subCategoryId) return;
    const url = `{{ route('admin.ajax.types', ['subCategory' => '__ID__']) }}`.replace('__ID__', subCategoryId);
    const data = await fetchJson(url);
    const list = Array.isArray(data) ? data : (data.data ?? []);
    list.forEach(t => { const opt = document.createElement('option'); opt.value = t.id; opt.textContent = t.name; typeSelect.appendChild(opt); });
    if (applyOld && oldType) { typeSelect.value = String(oldType); }
  }

  catSelect.addEventListener('change', async () => { try { await loadSubCategories(catSelect.value, false); } catch(e){console.error(e);} });
  subSelect.addEventListener('change', async () => { try { await loadTypes(subSelect.value, false); } catch(e){console.error(e);} });

  (async () => { clearSelect(subSelect); clearSelect(typeSelect); if (catSelect.value) { try{ await loadSubCategories(catSelect.value, true); } catch(e){console.error(e);} } })();
});
</script>

<script>

</script>
@endsection
