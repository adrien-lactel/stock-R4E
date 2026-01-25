@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $console->exists ? "✏️ Modifier l'article #{$console->id}" : "➕ Créer un article" }}
        </h1>

        <div class="flex items-center gap-2">
            @if($console->exists)
                <a href="{{ route('admin.articles.edit_full', $console) }}" class="px-3 py-2 rounded bg-gray-100 hover:bg-gray-200 text-sm">
                    ✍️ Édition complète
                </a>
            @endif

            <a href="{{ route('admin.consoles.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour stock</a>
        </div>
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
        <form method="POST"
              action="{{ $console->exists ? route('admin.articles.update', $console) : route('admin.articles.store') }}">
            @csrf
            @if($console->exists)
                @method('PUT')
            @endif

            {{-- =====================
     CLASSIFICATION
===================== --}}
<div class="flex items-center justify-between mb-4">
    <h2 class="text-lg font-semibold text-gray-800">Classification</h2>

    {{-- Bouton global gestion taxonomie --}}
    <a href="{{ route('admin.taxonomy.index') }}"
       target="_blank"
       class="inline-flex items-center gap-2 px-3 py-2 rounded bg-gray-900 text-white text-sm hover:bg-black"
       title="Gérer catégories, sous-catégories et types">
        <span class="text-lg leading-none">+</span>
        Gérer
        </a>
        <button type="button"
        onclick="window.location.reload()"
        class="ml-2 px-3 py-2 rounded border text-sm hover:bg-gray-50"
        title="Recharger pour récupérer la nouvelle classification">
        ↻ Rafraîchir
        </button>
</div>

<div class="grid grid-cols-1 md:grid-cols-4 gap-4">

    {{-- =====================
         CATÉGORIE
    ===================== --}}
    <div>
        <div class="flex items-center justify-between mb-1">
            <label class="block text-sm font-medium">Catégorie *</label>

            <a href="{{ route('admin.taxonomy.index') }}#categories"
               target="_blank"
               class="text-indigo-600 hover:underline text-sm"
               title="Ajouter / éditer une catégorie">
                +
            </a>
        </div>

        <select id="article_category_id"
                name="article_category_id"
                class="w-full rounded border-gray-300"
                required>
            <option value="">— Choisir —</option>
            @foreach($articleCategories as $cat)
                <option value="{{ $cat->id }}"
                    @selected(old('article_category_id', $console->article_category_id) == $cat->id)>
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>
    </div>

    {{-- =====================
         MARQUE
    ===================== --}}
    <div>
        <div class="flex items-center justify-between mb-1">
            <label class="block text-sm font-medium">Marque *</label>

            <a href="{{ route('admin.taxonomy.index') }}#brands"
               target="_blank"
               class="text-indigo-600 hover:underline text-sm"
               title="Ajouter / éditer une marque">
                +
            </a>
        </div>

        <select id="article_brand_id"
                name="article_brand_id"
                class="w-full rounded border-gray-300"
                required>
            <option value="">— Choisir —</option>
        </select>
    </div>

    {{-- =====================
         SOUS-CATÉGORIE
    ===================== --}}
    <div>
        <div class="flex items-center justify-between mb-1">
            <label class="block text-sm font-medium">Sous-catégorie *</label>

            <a href="{{ route('admin.taxonomy.index') }}#subcategories"
               target="_blank"
               class="text-indigo-600 hover:underline text-sm"
               title="Ajouter / éditer une sous-catégorie">
                +
            </a>
        </div>

        <select id="article_sub_category_id"
                name="article_sub_category_id"
                class="w-full rounded border-gray-300"
                required>
            <option value="">— Choisir —</option>
        </select>
    </div>

    {{-- =====================
         TYPE
    ===================== --}}
    <div>
        <div class="flex items-center justify-between mb-1">
            <label class="block text-sm font-medium">Type *</label>

            <a href="{{ route('admin.taxonomy.index') }}#types"
               target="_blank"
               class="text-indigo-600 hover:underline text-sm"
               title="Ajouter / éditer un type">
                +
            </a>
        </div>

        <select id="article_type_id"
                name="article_type_id"
                class="w-full rounded border-gray-300"
                required>
            <option value="">— Choisir —</option>
        </select>
    </div>

</div>

            {{-- =====================
                 RÉGION & LANGUE
            ===================== --}}
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Région</label>
                    <select name="region" class="w-full rounded border-gray-300">
                        <option value="">— Non spécifiée —</option>
                        <option value="PAL" @selected(old('region', $console->region) === 'PAL')>🇪🇺 PAL (Europe)</option>
                        <option value="NTSC-U" @selected(old('region', $console->region) === 'NTSC-U')>🇺🇸 NTSC-U (USA)</option>
                        <option value="NTSC-J" @selected(old('region', $console->region) === 'NTSC-J')>🇯🇵 NTSC-J (Japon)</option>
                        <option value="Région libre" @selected(old('region', $console->region) === 'Région libre')>🌍 Région libre</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Important pour N64, SNES, GameCube, etc.</p>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">État de complétude</label>
                    <select name="completeness" class="w-full rounded border-gray-300">
                        <option value="">— Non spécifié —</option>
                        <option value="Console seule" @selected(old('completeness', $console->completeness) === 'Console seule')>📦 Console seule</option>
                        <option value="Avec boîte" @selected(old('completeness', $console->completeness) === 'Avec boîte')>📦📄 Avec boîte</option>
                        <option value="Complète en boîte" @selected(old('completeness', $console->completeness) === 'Complète en boîte')>📦📄🎮 Complète en boîte</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Console seule, avec sa boîte, ou complète avec accessoires</p>
                </div>

                <div id="language_field" style="display: none;">
                    <label class="block text-sm font-medium mb-1">Langue</label>
                    <select name="language" class="w-full rounded border-gray-300">
                        <option value="">— Non spécifiée —</option>
                        <option value="Français" @selected(old('language', $console->language) === 'Français')>🇫🇷 Français</option>
                        <option value="Anglais" @selected(old('language', $console->language) === 'Anglais')>🇬🇧 Anglais</option>
                        <option value="Japonais" @selected(old('language', $console->language) === 'Japonais')>🇯🇵 Japonais</option>
                        <option value="Allemand" @selected(old('language', $console->language) === 'Allemand')>🇩🇪 Allemand</option>
                        <option value="Italien" @selected(old('language', $console->language) === 'Italien')>🇮🇹 Italien</option>
                        <option value="Espagnol" @selected(old('language', $console->language) === 'Espagnol')>🇪🇸 Espagnol</option>
                        <option value="Coréen" @selected(old('language', $console->language) === 'Coréen')>🇰🇷 Coréen</option>
                        <option value="Chinois" @selected(old('language', $console->language) === 'Chinois')>🇨🇳 Chinois</option>
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Pour les cartes à collectionner uniquement</p>
                </div>
            </div>

            {{-- =====================
                 STOCK / RÉPARATION
            ===================== --}}
            <h2 class="text-lg font-semibold text-gray-800 mt-8 mb-4">Stock & Réparation</h2>

            <div class="grid grid-cols-1 md:grid-cols-5 gap-4">
                {{-- Quantité (uniquement en création) --}}
                @if(!$console->exists)
                <div>
                    <label class="block text-sm font-medium mb-1">Quantité</label>
                    <input type="number" min="1" max="100" name="quantity"
                           value="{{ old('quantity', 1) }}"
                           class="w-full rounded border-gray-300">
                    <p class="text-xs text-gray-500 mt-1">Créer plusieurs articles identiques (max 100)</p>
                </div>
                @endif

                {{-- Statut --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Statut *</label>
                    <select name="status" class="w-full rounded border-gray-300" required>
                        @php $st = old('status', $console->status); @endphp
                        <option value="stock" @selected($st==='stock')>Stock</option>
                        <option value="defective" @selected($st==='defective')>Défectueuse</option>
                        <option value="repair" @selected($st==='repair')>En réparation</option>
                        <option value="disabled" @selected($st==='disabled')>Désactivée</option>
                    </select>
                </div>

                {{-- Réparateur --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Réparateur</label>
                    <select name="repairer_id" class="w-full rounded border-gray-300">
                        <option value="">— Aucun —</option>
                        @foreach($repairers as $rep)
                            <option value="{{ $rep->id }}"
                                @selected(old('repairer_id', $console->repairer_id) == $rep->id)>
                                {{ $rep->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">
                        Obligatoire si statut = <strong>repair</strong>
                    </p>
                </div>

                {{-- Prix achat --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Prix d’achat (€)</label>
                    <input type="number" step="0.01" min="0" name="prix_achat"
                           value="{{ old('prix_achat', $console->prix_achat) }}"
                           class="w-full rounded border-gray-300">
                </div>

                {{-- Valorisation --}}
                <div>
                    <label class="block text-sm font-medium mb-1">Valorisation (€)</label>
                    <input type="number" step="0.01" min="0" name="valorisation"
                           value="{{ old('valorisation', $console->valorisation) }}"
                           class="w-full rounded border-gray-300">
                </div>
            </div>

            {{-- =====================
                 COMMENTAIRES
            ===================== --}}
            <h2 class="text-lg font-semibold text-gray-800 mt-8 mb-4">Commentaires</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block text-sm font-medium mb-1">Commentaire produit</label>
                    <textarea name="product_comment" rows="3"
                              class="w-full rounded border-gray-300">{{ old('product_comment', $console->product_comment) }}</textarea>
                </div>

                <div>
                    <label class="block text-sm font-medium mb-1">Commentaire réparateur</label>
                    <textarea name="commentaire_reparateur" rows="3"
                              class="w-full rounded border-gray-300">{{ old('commentaire_reparateur', $console->commentaire_reparateur) }}</textarea>
                </div>
            </div>

            

            {{-- ACTIONS --}}
            <div class="mt-6 flex gap-3">
                <button class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    💾 Enregistrer
                </button>

                <a href="{{ route('admin.consoles.index') }}"
                   class="px-6 py-2 rounded border hover:bg-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>

    {{-- =====================
         15 DERNIÈRES ENTRÉES
    ===================== --}}
    <div class="mt-10 bg-white shadow rounded-lg p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">
            🕒 15 dernières entrées en stock
        </h2>

        <div class="overflow-x-auto">
            <table class="min-w-full text-sm divide-y divide-gray-200">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-3 py-2 text-left">ID</th>
                        <th class="px-3 py-2 text-left">Catégorie</th>
                        <th class="px-3 py-2 text-left">Type</th>
                        <th class="px-3 py-2 text-left">Statut</th>
                        <th class="px-3 py-2 text-left">Réparateur</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($lastConsoles as $c)
                        <tr>
                            <td class="px-3 py-2">#{{ $c->id }}</td>
                            <td class="px-3 py-2">{{ $c->articleCategory?->name ?? '—' }}</td>
                            <td class="px-3 py-2">{{ $c->articleType?->name ?? '—' }}</td>
                            <td class="px-3 py-2">{{ ucfirst($c->status) }}</td>
                            <td class="px-3 py-2">
                                {{ $c->repairer?->name ?? '—' }}
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-3 py-6 text-center text-gray-500">
                                Aucune entrée récente
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>

{{-- =====================
     JS CLASSIFICATION
===================== --}}
<script>
(function() {
  const cat = document.getElementById('article_category_id');
  const brand = document.getElementById('article_brand_id');
  const sub = document.getElementById('article_sub_category_id');
  const type = document.getElementById('article_type_id');

  if (!cat || !brand || !sub || !type) return;

  const oldBrand = @json(old('article_brand_id', $console->article_brand_id ?? null));
  const oldSub = @json(old('article_sub_category_id', $console->article_sub_category_id));
  const oldType = @json(old('article_type_id', $console->article_type_id));

  function clear(sel, placeholder = '— Choisir —') {
    sel.innerHTML = `<option value="">${placeholder}</option>`;
  }

  async function loadBrands(catId) {
    clear(brand); clear(sub); clear(type);
    if (!catId) return;
    
    // Afficher/masquer le champ langue selon la catégorie
    const languageField = document.getElementById('language_field');
    const selectedCategory = cat.options[cat.selectedIndex].text;
    if (selectedCategory.includes('Cartes à collectionner')) {
      languageField.style.display = 'block';
    } else {
      languageField.style.display = 'none';
    }
    
    try {
      const url = `{{ url('admin/ajax/brands') }}/${catId}`;
      const response = await fetch(url);
      const html = await response.text();
      brand.innerHTML = html;
      if (oldBrand) { brand.value = oldBrand; loadSubs(oldBrand); }
    } catch (e) {
      console.error('Erreur chargement marques:', e);
    }
  }

  async function loadSubs(brandId) {
    clear(sub); clear(type);
    if (!brandId) return;
    try {
      const url = `{{ url('admin/ajax/sub-categories') }}/${brandId}`;
      const response = await fetch(url);
      const html = await response.text();
      sub.innerHTML = html;
      if (oldSub) { sub.value = oldSub; loadTypes(oldSub); }
    } catch (e) {
      console.error('Erreur chargement sous-catégories:', e);
    }
  }

  async function loadTypes(subId) {
    clear(type);
    if (!subId) return;
    try {
      const url = `{{ url('admin/ajax/types') }}/${subId}`;
      const response = await fetch(url);
      const html = await response.text();
      type.innerHTML = html;
      if (oldType) type.value = oldType;
    } catch (e) {
      console.error('Erreur chargement types:', e);
    }
  }

  cat.addEventListener('change', e => loadBrands(e.target.value));
  brand.addEventListener('change', e => loadSubs(e.target.value));
  sub.addEventListener('change', e => loadTypes(e.target.value));

  if (cat.value) loadBrands(cat.value);
  
  // Afficher le champ langue si la catégorie est déjà "Cartes à collectionner" (édition)
  window.addEventListener('DOMContentLoaded', () => {
    const languageField = document.getElementById('language_field');
    const selectedCategory = cat.options[cat.selectedIndex]?.text || '';
    if (selectedCategory.includes('Cartes à collectionner')) {
      languageField.style.display = 'block';
    }
  });
})();
</script>
@endsection
