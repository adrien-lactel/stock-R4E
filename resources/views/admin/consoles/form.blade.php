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



    {{-- MODAL LIGHTBOX POUR AFFICHER LES IMAGES EN GRAND --}}
    <div id="image-lightbox" class="hidden fixed inset-0 bg-black bg-opacity-90 z-50" onclick="closeImageLightbox()">
        <button type="button" onclick="closeImageLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
        {{-- Contrôles de zoom --}}
        <div class="absolute bottom-4 left-1/2 transform -translate-x-1/2 flex gap-2 z-10">
            <button type="button" onclick="zoomOut(); event.stopPropagation();" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path>
                </svg>
            </button>
            <button type="button" onclick="resetZoom(); event.stopPropagation();" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded transition-colors text-sm font-medium">
                100%
            </button>
            <button type="button" onclick="zoomIn(); event.stopPropagation();" class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-4 py-2 rounded transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                </svg>
            </button>
        </div>
        
        <div id="lightbox-container" class="w-full h-full flex items-center justify-center p-16" onclick="event.stopPropagation()">
            <img id="lightbox-image" src="" class="max-w-full max-h-full object-contain cursor-grab active:cursor-grabbing" style="transform-origin: center center;">
        </div>
    </div>

    {{-- TOAST NOTIFICATIONS --}}
    <div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>

    {{-- FORMULAIRE --}}
    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST"
              action="{{ $console->exists ? route('admin.articles.update', $console) : route('admin.articles.store') }}">
            @csrf
            @if($console->exists)
                @method('PUT')
            @endif

            {{-- =====================
     RECHERCHE DE JEUX
===================== --}}
<div class="bg-gradient-to-r from-blue-50 to-indigo-50 border border-blue-200 rounded-lg p-6 mb-6">
    <h2 class="text-lg font-semibold text-gray-800 mb-4">🎮 Recherche de jeux</h2>
    
    {{-- Recherche unifiée --}}
    <div class="relative">
        <label class="block text-sm font-medium text-gray-700 mb-2">Recherche par ROM ID ou nom de jeu</label>
        <div class="flex gap-2">
            <select id="game-platform" class="rounded border-gray-300 w-32">
                <option value="gameboy">Game Boy</option>
                <option value="n64">N64</option>
                <option value="nes">NES</option>
                <option value="snes">SNES</option>
                <option value="gamegear">Game Gear</option>
                <option value="wonderswan">WonderSwan</option>
                <option value="segasaturn">Sega Saturn</option>
                <option value="megadrive">Mega Drive</option>
            </select>
            <div class="flex-1 relative">
                <input type="text" 
                       id="game-search" 
                       placeholder="Ex: DMG-A1J-0 ou Pokémon Red"
                       class="w-full rounded border-gray-300"
                       ondblclick="this.select()"
                       autocomplete="off">
                <div id="game-suggestions" class="absolute z-10 w-full bg-white border border-gray-300 rounded-b shadow-lg mt-1 max-h-60 overflow-y-auto hidden"></div>
            </div>
        </div>
    </div>

    {{-- Résultats de recherche --}}
    <div id="game-search-results" class="mt-4 hidden">
        <div class="bg-white rounded border border-gray-200 p-4">
            <div class="flex items-start justify-between mb-2">
                <h3 class="font-semibold text-gray-800">Résultats de recherche</h3>
                <button type="button" onclick="closeGameResults()" class="text-gray-400 hover:text-gray-600">✕</button>
            </div>
            <div id="game-results-content"></div>
        </div>
    </div>
</div>

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
         MARQUE / COMPATIBILITÉ
    ===================== --}}
    <div>
        <div class="flex items-center justify-between mb-1">
            <label id="brand_label" class="block text-sm font-medium">Marque *</label>

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

    {{-- =====================
         ROM ID (jeux vidéo)
    ===================== --}}
    <div id="rom_id_field" style="display: none;">
        <label class="block text-sm font-medium">ROM ID</label>
        <input type="text" id="rom_id" name="rom_id"
               value="{{ old('rom_id', $console->rom_id ?? '') }}"
               class="w-full rounded border-gray-300"
               placeholder="Ex: DMG-APBJ-JPN" readonly>
        <p class="text-xs text-gray-500 mt-1">📀 Identifiant du jeu (rempli automatiquement)</p>
    </div>

    {{-- =====================
         ANNÉE (jeux vidéo)
    ===================== --}}
    <div id="year_field" style="display: none;">
        <label class="block text-sm font-medium">Année de sortie</label>
        <input type="text" id="year" name="year"
               value="{{ old('year', $console->year ?? '') }}"
               class="w-full rounded border-gray-300"
               placeholder="Ex: 1989">
        <p class="text-xs text-gray-500 mt-1">📅 Année de sortie du jeu</p>
    </div>

    {{-- =====================
         RÉGION (jeux vidéo)
    ===================== --}}
    <div id="region_field" style="display: none;">
        <label class="block text-sm font-medium mb-1">Région</label>
        <select id="region" name="region" class="w-full rounded border-gray-300">
            <option value="">— Non spécifiée —</option>
            <option value="PAL" @selected(old('region', $console->region) === 'PAL')>🇪🇺 PAL (Europe)</option>
            <option value="NTSC-U" @selected(old('region', $console->region) === 'NTSC-U')>🇺🇸 NTSC-U (USA)</option>
            <option value="NTSC-J" @selected(old('region', $console->region) === 'NTSC-J')>🇯🇵 NTSC-J (Japon)</option>
            <option value="Région libre" @selected(old('region', $console->region) === 'Région libre')>🌍 Région libre</option>
        </select>
        <p class="text-xs text-gray-500 mt-1">Important pour N64, SNES, GameCube, etc.</p>
    </div>

    {{-- =====================
         ÉDITEUR (jeux vidéo)
    ===================== --}}
    <div id="publisher_field" style="display: none;">
        <label class="block text-sm font-medium mb-1">Éditeur</label>
        <select id="publisher" name="publisher" class="w-full rounded border-gray-300">
          <option value="">— Aucun —</option>
        </select>
        <p class="text-xs text-gray-500 mt-1">Éditeur du jeu vidéo (sélection via recherche ou autocomplete)</p>
    </div>

    {{-- =====================
         DESCRIPTION DU TYPE
    ===================== --}}
    <div class="md:col-span-3" id="description_field" style="display: none;">
        <label class="block text-sm font-medium mb-1">Description du produit</label>
        <textarea id="article_type_description"
                  name="article_type_description"
                  rows="4"
                  class="w-full rounded border-gray-300"
                  placeholder="Décrivez les caractéristiques, les meilleurs jeux, les détails techniques..."></textarea>
        <p class="text-xs text-gray-500 mt-1">
            ℹ️ Cette description sera partagée par tous les articles de ce type. 
            Modifier cette description mettra à jour tous les articles existants.
        </p>
    </div>

</div>

            {{-- =====================
                 COMPLÉTUDE & LANGUE
            ===================== --}}
            <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">État de complétude</label>
                        
                        <!-- Pour les consoles et accessoires -->
                        <select name="completeness" id="completeness_console" class="w-full rounded border-gray-300">
                            <option value="">— Non spécifié —</option>
                            <option value="Console seule" @selected(old('completeness', $console->completeness) === 'Console seule')>📦 Console seule</option>
                            <option value="Avec boîte" @selected(old('completeness', $console->completeness) === 'Avec boîte')>📦📄 Avec boîte</option>
                            <option value="Complète en boîte" @selected(old('completeness', $console->completeness) === 'Complète en boîte')>📦📄🎮 Complète en boîte</option>
                        </select>
                        
                        <!-- Pour les jeux vidéo -->
                        <select name="completeness" id="completeness_game" class="w-full rounded border-gray-300" style="display: none;">
                            <option value="">— Non spécifié —</option>
                            <option value="Loose" @selected(old('completeness', $console->completeness) === 'Loose')>🎮 Loose (jeu seul)</option>
                            <option value="Avec boîte" @selected(old('completeness', $console->completeness) === 'Avec boîte')>📦 Avec boîte</option>
                            <option value="Avec boîte et notice" @selected(old('completeness', $console->completeness) === 'Avec boîte et notice')>📦📄 Avec boîte et notice</option>
                        </select>
                        
                        <p class="text-xs text-gray-500 mt-1" id="completeness_hint_console">Console seule, avec sa boîte, ou complète avec accessoires</p>
                        <p class="text-xs text-gray-500 mt-1" id="completeness_hint_game" style="display: none;">Jeu seul (loose), avec boîte, ou complet avec notice</p>
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
                 IMAGES DE L'ARTICLE (DRAG & DROP)
            ===================== --}}
            <div class="mt-6">
                <div id="article_images_field" style="display: block !important;">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">📷 Images de l'article</h3>
                    
                    <!-- Pour les jeux vidéo : bouton pour ouvrir la modal -->
                    <div id="game_images_section" style="display: none;">
                        <button type="button" 
                                onclick="openArticleImagesModal()"
                                class="w-full border-2 border-dashed border-indigo-300 rounded-lg p-8 text-center cursor-pointer hover:border-indigo-500 transition-colors bg-indigo-50 mb-4">
                            <div class="mb-3">
                                <svg class="w-12 h-12 text-indigo-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-semibold text-indigo-600 mb-1">
                                📸 Gérer les photos de l'article
                            </p>
                            <p class="text-sm text-gray-600">
                                Cliquez pour ouvrir la galerie et prendre/ajouter des photos
                            </p>
                        </button>
                        
                        <!-- Prévisualisation des photos de l'article -->
                        <div id="game-images-preview" class="grid grid-cols-4 gap-4 mb-4"></div>
                        
                        <p class="text-xs text-gray-500 italic">
                            💡 Ces photos sont spécifiques à cet article et seront reprises dans la fiche produit.
                        </p>
                    </div>
                            💡 Ces photos sont spécifiques à cet article et seront reprises dans la fiche produit.
                        </p>
                    </div>

                    <!-- Pour les autres catégories : upload multiple d'images -->
                    <div id="generic_images_section">
                        <div id="dropzone"
                             class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center cursor-pointer hover:border-indigo-500 transition-colors bg-gray-50">
                            <div class="mb-3">
                                <svg class="w-12 h-12 text-gray-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                </svg>
                            </div>
                            <p class="text-sm text-gray-600 mb-1">
                                <span class="font-semibold text-indigo-600">Cliquez pour sélectionner</span>
                                ou glissez-déposez vos images
                            </p>
                            <p class="text-xs text-gray-500">PNG, JPG, GIF, WEBP jusqu'à 10 MB • 📱 Appareil photo ou galerie sur mobile</p>
                        </div>

                        <input type="file" id="file-input" accept="image/*" multiple class="hidden">

                        <!-- Prévisualisation des images -->
                        <div id="preview-container" class="grid grid-cols-3 gap-4 mt-4"></div>

                        <p class="text-xs text-gray-500 mt-2">
                            💾 Les images sont automatiquement enregistrées dans la taxonomie de l'article
                        </p>
                    </div>
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

            

            {{-- =====================
                 CHAMPS CACHÉS IMAGES
            ===================== --}}
            <input type="hidden" id="article_images_input" name="article_images" value="">
            <input type="hidden" id="primary_image_url_input" name="primary_image_url" value="">
            <input type="hidden" id="image_captions_input" name="image_captions" value="">

            {{-- ACTIONS --}}
            <div class="mt-6 flex gap-3">
                <button type="submit" class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
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
// ✅ Base URLs pour les images (défini en PREMIER avant tout code)
window.gameboyImageBaseUrl = '{{ asset('images/taxonomy/gameboy') }}';
window.laravelAssetBase = '{{ asset('') }}';

// ✅ Lightbox avec zoom et pan
let currentZoom = 1;
let currentX = 0;
let currentY = 0;
let isDragging = false;
let startX = 0;
let startY = 0;

window.openImageLightbox = function(imageUrl) {
  const lightbox = document.getElementById('image-lightbox');
  const lightboxImage = document.getElementById('lightbox-image');
  if (lightbox && lightboxImage) {
    lightboxImage.src = imageUrl;
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    resetZoom();
    initZoomControls();
  }
};

window.closeImageLightbox = function() {
  const lightbox = document.getElementById('image-lightbox');
  if (lightbox) {
    lightbox.classList.add('hidden');
    document.body.style.overflow = '';
    currentZoom = 1;
    currentX = 0;
    currentY = 0;
  }
};

window.zoomIn = function() {
  currentZoom = Math.min(currentZoom + 0.5, 5);
  updateTransform();
};

window.zoomOut = function() {
  currentZoom = Math.max(currentZoom - 0.5, 0.5);
  updateTransform();
};

window.resetZoom = function() {
  currentZoom = 1;
  currentX = 0;
  currentY = 0;
  updateTransform();
};

function updateTransform() {
  const img = document.getElementById('lightbox-image');
  if (img) {
    img.style.transform = `translate(${currentX}px, ${currentY}px) scale(${currentZoom})`;
  }
}

function initZoomControls() {
  const img = document.getElementById('lightbox-image');
  const container = document.getElementById('lightbox-container');
  if (!img || !container) return;

  // Zoom molette souris
  container.onwheel = function(e) {
    e.preventDefault();
    if (e.deltaY < 0) {
      zoomIn();
    } else {
      zoomOut();
    }
  };

  // Pan avec souris
  img.onmousedown = function(e) {
    if (currentZoom > 1) {
      isDragging = true;
      startX = e.clientX - currentX;
      startY = e.clientY - currentY;
      img.style.cursor = 'grabbing';
    }
  };

  document.onmousemove = function(e) {
    if (isDragging) {
      currentX = e.clientX - startX;
      currentY = e.clientY - startY;
      updateTransform();
    }
  };

  document.onmouseup = function() {
    isDragging = false;
    const img = document.getElementById('lightbox-image');
    if (img && currentZoom > 1) {
      img.style.cursor = 'grab';
    }
  };

  // Support tactile (pinch-to-zoom)
  let initialDistance = 0;
  let initialZoom = 1;

  container.ontouchstart = function(e) {
    if (e.touches.length === 2) {
      e.preventDefault();
      const touch1 = e.touches[0];
      const touch2 = e.touches[1];
      initialDistance = Math.hypot(
        touch2.clientX - touch1.clientX,
        touch2.clientY - touch1.clientY
      );
      initialZoom = currentZoom;
    } else if (e.touches.length === 1 && currentZoom > 1) {
      isDragging = true;
      startX = e.touches[0].clientX - currentX;
      startY = e.touches[0].clientY - currentY;
    }
  };

  container.ontouchmove = function(e) {
    if (e.touches.length === 2) {
      e.preventDefault();
      const touch1 = e.touches[0];
      const touch2 = e.touches[1];
      const distance = Math.hypot(
        touch2.clientX - touch1.clientX,
        touch2.clientY - touch1.clientY
      );
      currentZoom = Math.max(0.5, Math.min(5, initialZoom * (distance / initialDistance)));
      updateTransform();
    } else if (e.touches.length === 1 && isDragging) {
      e.preventDefault();
      currentX = e.touches[0].clientX - startX;
      currentY = e.touches[0].clientY - startY;
      updateTransform();
    }
  };

  container.ontouchend = function() {
    isDragging = false;
  };
}

// Fermer avec la touche Échap
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape') {
    closeImageLightbox();
  }
});

// ✅ Détecter la région depuis un ROM ID Game Boy
window.detectRegionFromRomId = function(romId) {
  if (!romId) return null;
  
  const romIdUpper = romId.toUpperCase();
  let region = null;
  
  // Extraire la partie du code jeu (entre DMG- et le suffixe final)
  const match = romIdUpper.match(/^[A-Z]+-([A-Z0-9]+)-([\w]+)$/i);
  if (match) {
    const gameCode = match[1]; // Ex: "A1J", "OBE", "K4J"
    const suffix = match[2];    // Ex: "0", "USA", "JPN"
    
    // Cas spéciaux avec suffixe explicite
    if (['USA', 'CAN'].includes(suffix)) {
      region = 'NTSC-U';
    } else if (['JPN', 'JAP'].includes(suffix)) {
      region = 'NTSC-J';
    } else if (['EUR', 'PAL', 'FRA', 'GER', 'ITA', 'SPA', 'UK', 'NOE'].includes(suffix)) {
      region = 'PAL';
    }
    // Sinon, détecter par la dernière lettre du code du jeu
    else {
      const lastLetter = gameCode.slice(-1);
      
      if (lastLetter === 'J') {
        region = 'NTSC-J'; // Japon
      } else if (lastLetter === 'E') {
        region = 'PAL'; // Europe
      } else if (lastLetter === 'P') {
        region = 'PAL'; // PAL/Europe
      } else if (lastLetter === 'U' || lastLetter === 'A') {
        region = 'NTSC-U'; // USA
      }
    }
  }
  
  return region;
};

// ✅ Fonctions utilitaires pour détecter la sous-catégorie, région et marque depuis le ROM ID
function guessSubCategoryFromRomId(romId) {
  if (!romId) return null;
  if (romId.startsWith('DMG-')) return 'Game Boy';
  if (romId.startsWith('CGB-')) return 'Game Boy Color';
  if (romId.startsWith('AGB-')) return 'Game Boy Advance';
  if (romId.startsWith('HVC-')) return 'NES';
  if (romId.startsWith('NES-')) return 'NES';
  if (romId.startsWith('SHVC-')) return 'SNES';
  if (romId.startsWith('SNS-')) return 'SNES';
  if (/^N[A-Z0-9]{3,4}$/i.test(romId)) return 'N64';
  return null;
}

function guessRegionFromRomId(romId) {
  if (!romId) return null;
  if (/(?:-(JPN|JAP))$/i.test(romId)) return 'NTSC-J';
  if (/(?:-(USA|CAN))$/i.test(romId)) return 'NTSC-U';
  if (/(?:-(EUR|PAL|FRA|GER|ITA|SPA|UK))$/i.test(romId)) return 'PAL';
  return null;
}

function guessBrandFromRomId(romId) {
  if (!romId) return null;
  if (romId.startsWith('DMG-') || romId.startsWith('CGB-') || romId.startsWith('AGB-') || 
      romId.startsWith('HVC-') || romId.startsWith('NES-') || 
      romId.startsWith('SHVC-') || romId.startsWith('SNS-') ||
      /^N[A-Z0-9]{3,4}$/i.test(romId)) {
    return 'Nintendo';
  }
  return null;
}

// ========================================
// RECHERCHE DE JEUX
// ========================================

// Construire l'URL de l'image locale depuis le ROM ID ou slug
function getLocalGameImage(game, platform) {
  if (!game) return null;
  
  // Utiliser le proxy Laravel pour éviter les problèmes CORS avec R2
  const useProxy = '{{ config("filesystems.disks.r2.url") ? "true" : "false" }}' === 'true';
  const baseUrl = useProxy ? '/proxy/images/taxonomy' : '{{ url("/images/taxonomy") }}';
  
  // Pour WonderSwan, Mega Drive, Sega Saturn et Game Gear : utiliser le nom nettoyé
  const nameBasedPlatforms = ['wonderswan', 'megadrive', 'segasaturn', 'gamegear'];
  let identifier;
  
  if (nameBasedPlatforms.includes(platform)) {
    // Pour toutes ces plateformes, garder le nom tel quel (juste retirer l'extension)
    identifier = game.name
      .replace(/\.ws$/i, '')
      .replace(/\.md$/i, '')
      .replace(/\.gg$/i, '')
      .replace(/\.bin$/i, '')
      .trim();
  } else {
    // Utiliser le ROM ID ou slug pour autres plateformes
    identifier = game.rom_id || game.slug;
  }
  
  if (!identifier) return null;
  
  // Détecter le dossier selon la plateforme
  let folder;
  if (platform === 'gameboy') {
    // Détecter le sous-dossier selon le préfixe du ROM ID
    if (identifier.startsWith('CGB-')) {
      folder = 'game boy color';
    } else if (identifier.startsWith('AGB-')) {
      folder = 'game boy advance';
    } else {
      folder = 'gameboy'; // DMG- et autres
    }
  } else {
    const platformFolders = {
      'n64': 'n64',
      'nes': 'nes',
      'snes': 'snes',
      'gamegear': 'gamegear',
      'wonderswan': 'wonderswan',
      'segasaturn': 'segasaturn',
      'megadrive': 'megadrive'
    };
    folder = platformFolders[platform];
  }
  
  if (!folder) return null;
  
  // Construire le chemin complet d'abord, puis encoder avec encodeURI
  // encodeURI préserve les caractères valides dans une URL (-, _, etc.)
  const fullPath = `${baseUrl}/${folder}/${identifier}-cover.png`;
  const encodedPath = encodeURI(fullPath);
  
  return encodedPath;
}

// Fonction pour obtenir l'image de jeu avec fallback (cover > logo > artwork)
async function getGameImageWithFallback(game, platform) {
  // Utiliser le proxy Laravel pour éviter les problèmes CORS avec R2
  const useProxy = '{{ config("filesystems.disks.r2.url") ? "true" : "false" }}' === 'true';
  const baseUrl = useProxy ? '/proxy/images/taxonomy' : '{{ url("/images/taxonomy") }}';
  const nameBasedPlatforms = ['wonderswan', 'megadrive', 'segasaturn', 'gamegear'];
  let identifier;
  
  if (nameBasedPlatforms.includes(platform)) {
    // Pour toutes ces plateformes, garder le nom tel quel (juste retirer l'extension)
    identifier = game.name
      .replace(/\.ws$/i, '')
      .replace(/\.md$/i, '')
      .replace(/\.gg$/i, '')
      .replace(/\.bin$/i, '')
      .trim();
  } else {
    identifier = game.rom_id || game.slug;
  }
  
  if (!identifier) return null;
  
  // Détecter le dossier
  let folder;
  if (platform === 'gameboy') {
    if (identifier.startsWith('CGB-')) {
      folder = 'game boy color';
    } else if (identifier.startsWith('AGB-')) {
      folder = 'game boy advance';
    } else {
      folder = 'gameboy';
    }
  } else {
    const platformFolders = {
      'n64': 'n64',
      'nes': 'nes',
      'snes': 'snes',
      'gamegear': 'gamegear',
      'wonderswan': 'wonderswan',
      'segasaturn': 'segasaturn',
      'megadrive': 'megadrive'
    };
    folder = platformFolders[platform] || platform;
  }
  
  if (!folder) return null;
  
  // Essayer cover, logo, puis artwork
  const imageTypes = ['cover', 'logo', 'artwork'];
  
  for (const type of imageTypes) {
    const fullPath = `${baseUrl}/${folder}/${identifier}-${type}.png`;
    const encodedPath = encodeURI(fullPath);
    
    try {
      // Utiliser HEAD pour vérifier l'existence sans télécharger
      const response = await fetch(encodedPath, { 
        method: 'HEAD',
        cache: 'no-cache'
      });
      
      if (response.ok) {
        return encodedPath;
      }
      // Ne pas loguer les 404, c'est normal qu'une image n'existe pas
    } catch (e) {
      // Erreur réseau ou autre, continuer silencieusement
    }
  }
  
  // Aucune image trouvée, retourner null sans erreur
  return null;
}

// ========================================
// FONCTIONS LOGO ÉDITEUR
// ========================================

// Fonction pour charger le logo d'un éditeur (affichage sous la cover)
window.loadPublisherLogoDisplay = async function(publisherName, gameId) {
  console.log('🖼️ loadPublisherLogoDisplay appelé:', { publisherName, gameId });
  const logoContainer = document.getElementById('publisher-logo-display-' + gameId);
  console.log('logoContainer trouvé:', logoContainer);
  
  if (!logoContainer || !publisherName) {
    console.log('❌ Pas de container ou pas de publisher name');
    return;
  }
  
  try {
    const url = `{{ url('admin/ajax/search-publishers') }}?q=${encodeURIComponent(publisherName)}`;
    console.log('🔍 Fetch URL:', url);
    const response = await fetch(url);
    const data = await response.json();
    console.log('📦 Données reçues:', data);
    
    if (data.publishers && data.publishers.length > 0) {
      const publisher = data.publishers.find(p => p.name.toLowerCase() === publisherName.toLowerCase());
      console.log('✅ Publisher trouvé:', publisher);
      
      if (publisher && publisher.logo) {
        // Le logo peut être soit un chemin local soit une URL Cloudinary
        let logoUrl = publisher.logo;
        
        // Si c'est un chemin local (ne contient pas http), construire l'URL
        if (!logoUrl.startsWith('http')) {
          // Si le logo ne contient pas déjà le chemin, l'ajouter
          if (!logoUrl.includes('images/')) {
            logoUrl = 'images/taxonomy/editeurs/' + logoUrl;
          }
          logoUrl = `{{ asset('') }}${logoUrl}`;
        }
        
        console.log('🎨 Logo URL:', logoUrl);
        console.log('Publisher ID:', publisher.id);
        logoContainer.innerHTML = `<img src="${logoUrl}" alt="${publisher.name}" class="max-w-full max-h-full object-contain cursor-pointer hover:opacity-80 transition-opacity" title="Cliquer pour éditer l'éditeur" onerror="this.parentElement.innerHTML='<span class=\\'text-xl text-gray-300\\'>📚</span>'">`;
        
        // Rendre le logo cliquable pour ouvrir la page d'édition
        logoContainer.onclick = () => {
          console.log('🖱️ Clic sur le logo, ouverture modale pour publisher:', publisher.id, publisher.name);
          openPublisherEditModal(publisher.id, publisher.name);
        };
      } else {
        console.log('⚠️ Pas de logo pour cet éditeur');
        logoContainer.innerHTML = '<span class="text-xl text-gray-300">📚</span>';
        
        // Même sans logo, permettre d'ouvrir l'édition
        if (publisher) {
          console.log('Publisher sans logo, ID:', publisher.id);
          logoContainer.classList.add('cursor-pointer', 'hover:bg-gray-100', 'transition-colors');
          logoContainer.title = "Cliquer pour ajouter un logo";
          logoContainer.onclick = () => {
            console.log('🖱️ Clic sur placeholder, ouverture modale pour publisher:', publisher.id, publisher.name);
            openPublisherEditModal(publisher.id, publisher.name);
          };
        }
      }
    } else {
      console.log('⚠️ Aucun éditeur trouvé');
      logoContainer.innerHTML = '<span class="text-xl text-gray-300">📚</span>';
    }
  } catch (error) {
    console.error('❌ Erreur chargement logo éditeur display:', error);
    logoContainer.innerHTML = '<span class="text-xl text-gray-300">📚</span>';
  }
};

// Fonction pour ouvrir la modale d'édition de l'éditeur
window.openPublisherEditModal = function(publisherId, publisherName) {
  console.log('🚀 openPublisherEditModal appelé:', { publisherId, publisherName });
  
  const modal = document.createElement('div');
  modal.className = 'fixed inset-0 bg-black bg-opacity-50 z-50';
  modal.id = 'publisher-edit-modal';
  modal.style.cssText = 'padding: 20px;';
  
  const modalContent = document.createElement('div');
  modalContent.className = 'bg-white rounded-lg shadow-xl flex flex-col';
  modalContent.style.cssText = 'width: 100%; height: 100%;';
  
  const modalHeader = document.createElement('div');
  modalHeader.className = 'flex items-center justify-between p-4 border-b bg-gray-50 flex-shrink-0';
  modalHeader.innerHTML = `
    <h3 class="text-xl font-semibold text-gray-900">📝 Éditer l'éditeur: ${publisherName}</h3>
    <button onclick="closePublisherEditModal()" class="text-gray-400 hover:text-gray-600 hover:bg-gray-200 rounded p-2 transition-colors">
      <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
      </svg>
    </button>
  `;
  
  const iframeContainer = document.createElement('div');
  iframeContainer.className = 'overflow-hidden';
  iframeContainer.style.cssText = 'flex: 1;';
  
  const iframe = document.createElement('iframe');
  const iframeUrl = `{{ url('admin/publishers') }}/${publisherId}/edit`;
  console.log('📄 URL iframe:', iframeUrl);
  iframe.src = iframeUrl;
  iframe.className = 'border-0';
  iframe.style.cssText = 'width: 100%; height: 100%;';
  
  iframeContainer.appendChild(iframe);
  modalContent.appendChild(modalHeader);
  modalContent.appendChild(iframeContainer);
  modal.appendChild(modalContent);
  document.body.appendChild(modal);
  
  console.log('✅ Modale ajoutée au DOM');
  console.log('Dimensions modal:', modal.offsetWidth, 'x', modal.offsetHeight);
  console.log('Dimensions modalContent:', modalContent.offsetWidth, 'x', modalContent.offsetHeight);
  
  // Fermer la modale en cliquant sur le fond
  modal.onclick = (e) => {
    if (e.target === modal) {
      closePublisherEditModal();
    }
  };
  
  // Fermer avec Échap
  const handleEscape = (e) => {
    if (e.key === 'Escape') {
      closePublisherEditModal();
      document.removeEventListener('keydown', handleEscape);
    }
  };
  document.addEventListener('keydown', handleEscape);
};

window.closePublisherEditModal = function() {
  const modal = document.getElementById('publisher-edit-modal');
  if (modal) {
    modal.remove();
    // Recharger le logo après fermeture de la modale
    location.reload();
  }
};

// Fonction pour charger le logo d'un éditeur (formulaire d'édition)
window.loadPublisherLogo = async function(publisherName, gameId) {
  const logoContainer = document.getElementById('publisher-logo-' + gameId);
  if (!logoContainer || !publisherName) return;
  
  try {
    const response = await fetch(`{{ url('admin/ajax/search-publishers') }}?q=${encodeURIComponent(publisherName)}`);
    const data = await response.json();
    
    if (data.publishers && data.publishers.length > 0) {
      const publisher = data.publishers.find(p => p.name.toLowerCase() === publisherName.toLowerCase());
      
      if (publisher && publisher.logo) {
        logoContainer.innerHTML = `<img src="{{ asset('') }}${publisher.logo}" alt="${publisher.name}" class="max-w-full max-h-full object-contain">`;
      } else {
        logoContainer.innerHTML = '<span class="text-2xl text-gray-300">📚</span>';
      }
    } else {
      logoContainer.innerHTML = '<span class="text-2xl text-gray-300">📚</span>';
    }
  } catch (error) {
    console.error('Erreur chargement logo éditeur edit:', error);
    logoContainer.innerHTML = '<span class="text-2xl text-gray-300">📚</span>';
  }
};

// Fonction pour charger le logo du jeu depuis la taxonomie
async function loadGameLogo(game, platform) {
  const logoContainer = document.getElementById('game-logo-' + game.id);
  if (!logoContainer) return;
  
  // Déterminer l'identifier et le folder
  let identifier = game.rom_id || game.slug;
  
  // Pour Game Boy, nettoyer l'identifier
  if (platform === 'gameboy') {
    identifier = identifier
      .replace(/\.gb$/i, '')
      .replace(/\.gbc$/i, '')
      .replace(/\.gba$/i, '')
      .trim();
  }
  
  // Déterminer le dossier
  let folder;
  if (platform === 'gameboy') {
    if (identifier.startsWith('CGB-')) {
      folder = 'game boy color';
    } else if (identifier.startsWith('AGB-')) {
      folder = 'game boy advance';
    } else {
      folder = 'gameboy';
    }
  } else {
    const platformFolders = {
      'n64': 'n64',
      'nes': 'nes',
      'snes': 'snes',
      'gamegear': 'gamegear',
      'wonderswan': 'wonderswan',
      'segasaturn': 'segasaturn',
      'megadrive': 'megadrive'
    };
    folder = platformFolders[platform] || platform;
  }
  
  // Construire l'URL du logo
  const logoFilename = `${identifier}-logo.png`;
  
  // Mode R2 (Production) : charger depuis le mapping
  const mappingUrl = '{{ asset("storage/app/taxonomy-r2-mapping.json") }}';
  
  try {
    const response = await fetch(mappingUrl);
    const mapping = await response.json();
    
    if (mapping[folder] && mapping[folder][logoFilename]) {
      const r2Url = mapping[folder][logoFilename];
      const img = document.createElement('img');
      img.src = r2Url;
      img.alt = game.name + ' logo';
      img.className = 'w-full h-full object-contain';
      img.onerror = function() {
        logoContainer.innerHTML = '<span class="text-gray-300 text-4xl">✕</span>';
      };
      logoContainer.innerHTML = '';
      logoContainer.appendChild(img);
      return;
    }
  } catch (error) {
    console.log('Mapping R2 non disponible, essai en local');
  }
  
  // Fallback avec proxy Laravel
  const useProxy = '{{ config("filesystems.disks.r2.url") ? "true" : "false" }}' === 'true';
  const localLogoUrl = useProxy 
    ? `/proxy/images/taxonomy/${folder}/${logoFilename}`
    : `/stock-R4E/public/images/taxonomy/${folder}/${logoFilename}`;
  const img = document.createElement('img');
  img.src = localLogoUrl;
  img.alt = game.name + ' logo';
  img.className = 'w-full h-full object-contain';
  img.onerror = function() {
    logoContainer.innerHTML = '<span class="text-gray-300 text-4xl">✕</span>';
  };
  logoContainer.innerHTML = '';
  logoContainer.appendChild(img);
}

// =====================================================
// FONCTION APPLIQUER LA TAXONOMIE DU JEU AU FORMULAIRE
// =====================================================
let applyTaxonomyTimeout = null;

window.applyGameTaxonomy = function(game, platform) {
  // Debounce pour éviter les doubles exécutions
  if (applyTaxonomyTimeout) {
    console.log('⏸️ Exécution annulée (debounce)');
    clearTimeout(applyTaxonomyTimeout);
  }
  
  applyTaxonomyTimeout = setTimeout(() => {
    console.log('✓ Application taxonomie:', { game, platform });
    
    // Mapping plateforme → marque et sous-catégorie
    const platformMapping = {
      'gameboy': { brand: 'Nintendo', subCategory: 'Game Boy' },
      'n64': { brand: 'Nintendo', subCategory: 'Nintendo 64' },
      'nes': { brand: 'Nintendo', subCategory: 'NES' },
      'snes': { brand: 'Nintendo', subCategory: 'SNES' },
      'megadrive': { brand: 'SEGA', subCategory: 'Mega Drive' },
      'gamegear': { brand: 'SEGA', subCategory: 'Game Gear' },
      'wonderswan': { brand: 'Bandai', subCategory: 'WonderSwan' },
      'segasaturn': { brand: 'SEGA', subCategory: 'Sega Saturn' }
    };
    
    const mapping = platformMapping[platform];
    
    if (!mapping) {
      console.error('⚠️ Plateforme non reconnue pour la taxonomie automatique:', platform);
      return;
    }
    
    // 0. Remplir ROM ID et année de sortie
    const romIdField = document.getElementById('rom_id_field');
    const romIdInput = document.getElementById('rom_id');
    if (romIdField && romIdInput) {
      romIdField.style.display = 'block';
      if (game.rom_id) {
        romIdInput.value = game.rom_id;
        console.log('✓ ROM ID rempli:', game.rom_id);
      }
    }
    
    const yearField = document.getElementById('year_field');
    const yearInput = document.getElementById('year');
    if (yearField && yearInput) {
      yearField.style.display = 'block';
      if (game.year) {
        yearInput.value = game.year;
        console.log('✓ Année remplie:', game.year);
      }
    }
    
    // Remplir région
    const regionField = document.getElementById('region_field');
    const regionSelect = document.getElementById('region');
    if (regionField && regionSelect) {
      regionField.style.display = 'block';
      if (game.region) {
        regionSelect.value = game.region;
        console.log('✓ Région remplie:', game.region);
      } else {
        console.warn('⚠️ Pas de région dans les données du jeu');
      }
    }
    
    // Remplir éditeur
    const publisherField = document.getElementById('publisher_field');
    const publisherSelect = document.getElementById('publisher');
    if (publisherField && publisherSelect) {
      publisherField.style.display = 'block';
      if (game.publisher) {
        // Vérifier si l'option existe
        const publisherOption = Array.from(publisherSelect.options).find(opt => 
          opt.value.toLowerCase() === game.publisher.toLowerCase()
        );
        
        if (publisherOption) {
          // L'option existe, la sélectionner
          publisherSelect.value = publisherOption.value;
          console.log('✓ Éditeur rempli:', game.publisher);
        } else {
          // L'option n'existe pas, la créer
          const newOption = new Option(game.publisher, game.publisher, true, true);
          // Insérer dans le groupe "Autres"
          const autresGroup = Array.from(publisherSelect.querySelectorAll('optgroup')).find(g => 
            g.label.includes('Autres')
          );
          if (autresGroup) {
            autresGroup.appendChild(newOption);
          } else {
            publisherSelect.add(newOption);
          }
          console.log('✓ Éditeur créé et rempli:', game.publisher);
        }
      } else {
        console.warn('⚠️ Pas d\'éditeur dans les données du jeu');
      }
    }
    
    // 1. Sélectionner la catégorie "jeu vidéo"
    const categorySelect = document.getElementById('article_category_id');
    if (categorySelect) {
      const videoGameOption = Array.from(categorySelect.options).find(opt => 
        opt.text.toLowerCase().includes('jeu vidéo') || opt.text.toLowerCase().includes('jeux vidéo')
      );
      if (videoGameOption) {
        categorySelect.value = videoGameOption.value;
        categorySelect.dispatchEvent(new Event('change'));
        console.log('✓ Catégorie sélectionnée:', videoGameOption.text);
      }
    }
    
    // Attendre que les marques se chargent
    setTimeout(() => {
      // 2. Sélectionner la marque
      const brandSelect = document.getElementById('article_brand_id');
      if (brandSelect) {
        const brandOption = Array.from(brandSelect.options).find(opt => 
          opt.text.toLowerCase().includes(mapping.brand.toLowerCase())
        );
        if (brandOption) {
          brandSelect.value = brandOption.value;
          brandSelect.dispatchEvent(new Event('change'));
          console.log('✓ Marque sélectionnée:', brandOption.text);
        } else {
          console.warn('⚠️ Marque non trouvée dans les options:', mapping.brand, Array.from(brandSelect.options).map(o => o.text));
        }
      }
      
      // Attendre que les sous-catégories se chargent
      setTimeout(() => {
        // 3. Sélectionner la sous-catégorie
        const subCategorySelect = document.getElementById('article_sub_category_id');
        if (subCategorySelect) {
          const subCatOption = Array.from(subCategorySelect.options).find(opt => 
            opt.text.toLowerCase().includes(mapping.subCategory.toLowerCase())
          );
          if (subCatOption) {
            subCategorySelect.value = subCatOption.value;
            subCategorySelect.dispatchEvent(new Event('change'));
            console.log('✓ Sous-catégorie sélectionnée:', subCatOption.text);
          } else {
            console.warn('⚠️ Sous-catégorie non trouvée dans les options:', mapping.subCategory, Array.from(subCategorySelect.options).map(o => o.text));
          }
        }
        
        // Attendre que les types se chargent
        setTimeout(() => {
          // 4. Créer automatiquement le type (ROM-ID + nom)
          const romId = game.rom_id || game.slug || '';
          const typeName = romId ? `${romId} - ${game.name}` : game.name;
          
          // Récupérer le sub_category_id sélectionné
          const subCategorySelect = document.getElementById('article_sub_category_id');
          const subCategoryId = subCategorySelect ? subCategorySelect.value : null;
          
          if (subCategoryId && typeName) {
            console.log('🔨 Création du type:', { subCategoryId, typeName });
            
            // Créer le type via l'API
            fetch('{{ route("admin.taxonomy.type.auto-create") }}', {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                article_sub_category_id: subCategoryId,
                name: typeName,
                publisher: game.publisher || null
              })
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                console.log('✓ Type créé ou trouvé:', data.type);
                
                // Sélectionner le type créé/trouvé dans le dropdown
                const typeSelect = document.getElementById('article_type_id');
                if (typeSelect) {
                  // Ajouter l'option si elle n'existe pas
                  let typeOption = Array.from(typeSelect.options).find(opt => opt.value == data.type.id);
                  if (!typeOption) {
                    const newOption = new Option(data.type.name, data.type.id, true, true);
                    typeSelect.add(newOption);
                  } else {
                    typeSelect.value = data.type.id;
                  }
                  typeSelect.dispatchEvent(new Event('change'));
                  console.log('✓ Type appliqué:', data.type.name);
                }
              } else {
                console.error('⚠️ Type non créé:', data.message || 'Erreur inconnue');
              }
            })
            .catch(error => {
              console.error('Erreur création type:', error);
            });
          } else {
            console.warn('⚠️ Sub-catégorie ou nom de type manquant:', { subCategoryId, typeName });
          }
        }, 400);
      }, 400);
    }, 400);
    
    applyTaxonomyTimeout = null;
  }, 100); // Debounce de 100ms
};

// =====================================================
// MODAL D'ÉDITION DES IMAGES DE JEU (TAXONOMIE)
// =====================================================
window.openImageEditorModal = function(game, platform, identifier, folder, initialType) {
  console.log('🖼️ Ouverture modal édition images:', { game, platform, identifier, folder, initialType });
  
  // Créer la modal
  const modal = document.createElement('div');
  modal.id = 'image-editor-modal';
  modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto';
  
  // Stocker les infos du jeu pour recharger après fermeture
  modal.dataset.game = JSON.stringify(game);
  modal.dataset.platform = platform;
  modal.dataset.identifier = identifier;
  modal.dataset.folder = folder;
  
  const modalContent = document.createElement('div');
  modalContent.className = 'bg-white rounded-lg shadow-xl max-w-4xl w-full my-8';
  modalContent.style.maxHeight = '90vh';
  modalContent.style.overflowY = 'auto';
  
  // Header (sticky en haut)
  const header = document.createElement('div');
  header.className = 'bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-t-lg flex justify-between items-center sticky top-0 z-10';
  header.innerHTML = `
    <h3 class="text-xl font-bold">🖼️ Gestion des images - ${game.name}</h3>
    <button onclick="closeImageEditorModal()" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
  `;
  
  // Body
  const body = document.createElement('div');
  body.className = 'p-6 space-y-6';
  
  // Info ROM ID
  const infoBar = document.createElement('div');
  infoBar.className = 'bg-blue-50 border border-blue-200 rounded-lg p-4';
  infoBar.innerHTML = `
    <div class="text-sm text-gray-700">
      <strong>ROM ID:</strong> ${identifier} | 
      <strong>Plateforme:</strong> ${platform} | 
      <strong>Dossier:</strong> ${folder}
    </div>
  `;
  
  // Section Upload
  const uploadSection = document.createElement('div');
  uploadSection.className = 'border-2 border-dashed border-gray-300 rounded-lg p-6 bg-gray-50 hover:bg-gray-100 transition-colors';
  uploadSection.innerHTML = `
    <div class="text-center">
      <div class="text-4xl mb-2">📤</div>
      <h4 class="font-semibold text-gray-700 mb-2">Ajouter des images</h4>
      <p class="text-sm text-gray-500 mb-3">Sélectionnez le type d'image puis choisissez le(s) fichier(s)</p>
      
      <div class="flex items-center justify-center gap-3 mb-4">
        <label class="text-sm font-medium text-gray-700">Type d'image :</label>
        <select id="taxonomy-upload-type" class="border border-gray-300 rounded px-3 py-2 text-sm font-medium">
          <option value="cover">📖 Cover</option>
          <option value="artwork">🎨 Artwork</option>
          <option value="gameplay">🎮 Gameplay</option>
        </select>
      </div>
      
      <input type="file" id="taxonomy-image-upload" accept="image/*" multiple class="hidden">
      <button onclick="document.getElementById('taxonomy-image-upload').click()" 
              class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
        Parcourir
      </button>
    </div>
  `;
  
  // Drag & Drop handlers
  uploadSection.ondragover = (e) => {
    e.preventDefault();
    uploadSection.classList.add('border-blue-500', 'bg-blue-100');
  };
  
  uploadSection.ondragleave = () => {
    uploadSection.classList.remove('border-blue-500', 'bg-blue-100');
  };
  
  uploadSection.ondrop = (e) => {
    e.preventDefault();
    uploadSection.classList.remove('border-blue-500', 'bg-blue-100');
    const files = e.dataTransfer.files;
    const selectedType = document.getElementById('taxonomy-upload-type')?.value || 'cover';
    handleTaxonomyImageUpload(files, identifier, folder, platform, selectedType);
  };
  
  const fileInput = uploadSection.querySelector('#taxonomy-image-upload');
  fileInput.onchange = (e) => {
    const selectedType = document.getElementById('taxonomy-upload-type')?.value || 'cover';
    handleTaxonomyImageUpload(e.target.files, identifier, folder, platform, selectedType);
  };
  
  // Section Images existantes
  const existingSection = document.createElement('div');
  existingSection.className = 'space-y-4';
  existingSection.innerHTML = `
    <h4 class="font-semibold text-gray-700">Images existantes</h4>
    <div id="taxonomy-images-grid" class="grid grid-cols-3 gap-4">
      <div class="col-span-3 text-center text-gray-500">
        <div class="animate-pulse">Chargement des images...</div>
      </div>
    </div>
  `;
  
  // Assembler la modal
  body.appendChild(infoBar);
  body.appendChild(uploadSection);
  body.appendChild(existingSection);
  
  modalContent.appendChild(header);
  modalContent.appendChild(body);
  modal.appendChild(modalContent);
  
  // Clic en dehors pour fermer
  modal.onclick = (e) => {
    if (e.target === modal) {
      closeImageEditorModal();
    }
  };
  
  document.body.appendChild(modal);
  
  // Charger les images via AJAX
  loadTaxonomyImages(identifier, folder);
};

// Fonction pour charger toutes les images d'un jeu
async function loadTaxonomyImages(identifier, folder) {
  const gridContainer = document.getElementById('taxonomy-images-grid');
  
  if (!gridContainer) return;
  
  try {
    const response = await fetch(`{{ route("admin.taxonomy.get-images") }}?identifier=${encodeURIComponent(identifier)}&folder=${encodeURIComponent(folder)}`);
    const data = await response.json();
    
    if (data.success && data.images.length > 0) {
      gridContainer.innerHTML = '';
      
      const timestamp = Date.now();
      
      data.images.forEach(image => {
        const imageCard = document.createElement('div');
        imageCard.className = 'border-2 border-gray-200 rounded-lg p-3 bg-white hover:border-blue-400 transition-colors';
        
        const img = document.createElement('img');
        // Ajouter timestamp pour éviter le cache
        img.src = `${image.url}?t=${timestamp}`;
        img.className = 'w-full h-40 object-cover rounded mb-2';
        img.onerror = function() {
          this.src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="200" height="200"%3E%3Crect fill="%23f0f0f0" width="200" height="200"/%3E%3Ctext x="50%25" y="50%25" font-size="16" fill="%23999" text-anchor="middle" dy=".3em"%3EErreur%3C/text%3E%3C/svg%3E';
        };
        
        // Label avec dropdown de changement de catégorie
        const labelRow = document.createElement('div');
        labelRow.className = 'flex items-center justify-between mb-2';
        
        const select = document.createElement('select');
        select.className = 'text-sm border border-gray-300 rounded px-2 py-1 font-medium flex-1';
        select.innerHTML = `
          <option value="cover" ${image.type === 'cover' ? 'selected' : ''}>📖 Cover</option>
          <option value="artwork" ${image.type === 'artwork' ? 'selected' : ''}>🎨 Artwork</option>
          <option value="gameplay" ${image.type === 'gameplay' ? 'selected' : ''}>🎮 Gameplay</option>
        `;
        select.onchange = () => renameTaxonomyImage(identifier, folder, image.full_type, select.value);
        
        labelRow.appendChild(select);
        
        // Badge d'index si > 1
        if (image.index > 1) {
          const badge = document.createElement('span');
          badge.className = 'text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded font-semibold ml-2';
          badge.textContent = '#' + image.index;
          labelRow.appendChild(badge);
        }
        
        // Bouton suppression
        const deleteBtn = document.createElement('button');
        deleteBtn.className = 'text-red-600 hover:text-red-800 text-xl leading-none ml-2';
        deleteBtn.innerHTML = '🗑️';
        deleteBtn.title = 'Supprimer cette image';
        deleteBtn.onclick = () => deleteTaxonomyImage(identifier, folder, image.full_type);
        
        labelRow.appendChild(deleteBtn);
        
        // Taille du fichier
        const sizeInfo = document.createElement('div');
        sizeInfo.className = 'text-xs text-gray-500 text-center mt-1';
        const sizeKb = (image.size / 1024).toFixed(1);
        sizeInfo.textContent = `${sizeKb} Ko`;
        
        // Ajouter les éléments dans le bon ordre
        imageCard.appendChild(img);
        imageCard.appendChild(labelRow);
        
        // Bouton "Définir comme principale" pour les images indexées (index > 1)
        if (image.index > 1) {
          const setPrimaryBtn = document.createElement('button');
          setPrimaryBtn.className = 'w-full text-xs bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded font-medium flex items-center justify-center gap-1 mt-2';
          setPrimaryBtn.innerHTML = '⭐ Définir comme principale';
          setPrimaryBtn.title = 'Remplacer l\'image principale par celle-ci';
          setPrimaryBtn.onclick = () => setAsPrimaryImage(identifier, folder, image.full_type, image.type);
          imageCard.appendChild(setPrimaryBtn);
        }
        
        imageCard.appendChild(sizeInfo);
        gridContainer.appendChild(imageCard);
      });
      
      // Ajouter un compteur
      const countInfo = document.createElement('div');
      countInfo.className = 'col-span-3 text-center text-sm text-gray-600 mt-2 pt-2 border-t';
      countInfo.textContent = `Total : ${data.total} image${data.total > 1 ? 's' : ''}`;
      gridContainer.appendChild(countInfo);
      
    } else {
      gridContainer.innerHTML = `
        <div class="col-span-3 text-center text-gray-400 py-8">
          <div class="text-4xl mb-2">📭</div>
          <div>Aucune image trouvée pour ce jeu</div>
        </div>
      `;
    }
  } catch (e) {
    console.error('Erreur chargement images:', e);
    gridContainer.innerHTML = `
      <div class="col-span-3 text-center text-red-500 py-8">
        <div class="text-4xl mb-2">⚠️</div>
        <div>Erreur lors du chargement des images</div>
      </div>
    `;
  }
}

window.closeImageEditorModal = function() {
  const modal = document.getElementById('image-editor-modal');
  if (modal) {
    // Récupérer les infos du jeu pour recharger les images
    try {
      const game = JSON.parse(modal.dataset.game);
      const platform = modal.dataset.platform;
      const identifier = modal.dataset.identifier;
      const folder = modal.dataset.folder;
      
      // Supprimer la modal
      modal.remove();
      
      // Recharger UNIQUEMENT les images dans la page principale
      const searchResults = document.getElementById('game-search-results');
      if (searchResults && !searchResults.classList.contains('hidden')) {
        console.log('🔄 Rechargement des images du jeu...');
        refreshGameImages(game, platform, identifier, folder);
      }
    } catch (e) {
      console.error('Erreur lors de la fermeture de la modal:', e);
      modal.remove();
    }
  }
};

// Fonction pour rafraîchir uniquement les images sans reconstruire toute la page
window.refreshGameImages = function(game, platform, identifier, folder) {
  // Trouver la grille d'images existante
  const contentDiv = document.getElementById('game-results-content');
  if (!contentDiv) return;
  
  // Trouver la grille d'images (class 'grid grid-cols-3 gap-3')
  const imagesGrid = contentDiv.querySelector('.grid.grid-cols-3');
  if (!imagesGrid) {
    console.warn('⚠️ Grille d\'images non trouvée');
    return;
  }
  
  // Vider la grille
  imagesGrid.innerHTML = '';
  
  const imageTypes = [
    { type: 'cover', label: '📖 Cover', icon: '📖' },
    { type: 'artwork', label: '🎨 Artwork', icon: '🎨' },
    { type: 'gameplay', label: '🎮 Gameplay', icon: '🎮' }
  ];
  
  // Recréer les images avec cache-busting
  const timestamp = Date.now();
  const useProxy = '{{ config("filesystems.disks.r2.url") ? "true" : "false" }}' === 'true';
  const baseUrl = useProxy ? '/proxy/images/taxonomy' : '/stock-R4E/public/images/taxonomy';
  imageTypes.forEach(imgType => {
    const imageCard = document.createElement('div');
    imageCard.className = 'relative group';
    
    const fullPath = `${baseUrl}/${folder}/${identifier}-${imgType.type}.png?t=${timestamp}`;
    const encodedPath = encodeURI(fullPath);
    
    // Container pour l'image
    const imageWrapper = document.createElement('div');
    imageWrapper.className = 'relative';
    
    const img = document.createElement('img');
    img.src = encodedPath;
    img.alt = imgType.label;
    img.className = 'w-32 h-32 object-cover rounded border-2 border-gray-200 cursor-pointer hover:border-blue-500 transition-all';
    img.title = 'Cliquer pour agrandir';
    
    // Clic pour agrandir dans le lightbox
    img.onclick = () => openImageLightbox(encodedPath);
    
    // Si l'image n'existe pas, afficher un placeholder
    img.onerror = function() {
      const placeholder = document.createElement('div');
      placeholder.className = 'w-32 h-32 bg-gray-100 rounded border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400 text-xs';
      placeholder.innerHTML = `<div class="text-center"><div class="text-3xl">🖼️</div><div class="text-xs mt-1">Non disponible</div></div>`;
      this.replaceWith(placeholder);
    };
    
    imageWrapper.appendChild(img);
    
    const label = document.createElement('div');
    label.className = 'text-xs text-center mt-1 text-gray-600 font-medium';
    label.textContent = imgType.label;
    
    imageCard.appendChild(imageWrapper);
    imageCard.appendChild(label);
    imagesGrid.appendChild(imageCard);
  });
  
  console.log('✅ Images rechargées');
};

// Fonction upload des images de taxonomie
async function handleTaxonomyImageUpload(files, identifier, folder, platform, selectedType) {
  if (files.length === 0) return;
  
  console.log('📤 Upload de', files.length, 'fichier(s) de type:', selectedType);
  
  const formData = new FormData();
  for (let file of files) {
    formData.append('images[]', file);
  }
  formData.append('identifier', identifier);
  formData.append('folder', folder);
  formData.append('platform', platform);
  formData.append('type', selectedType); // Envoyer le type sélectionné
  
  try {
    const response = await fetch('{{ route("admin.taxonomy.upload-image") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
      },
      body: formData
    });
    
    const data = await response.json();
    
    if (data.success) {
      alert('✅ ' + data.message);
      // Recharger les images dans la modal au lieu de fermer
      loadTaxonomyImages(identifier, folder);
      // Réinitialiser l'input file
      const fileInput = document.getElementById('taxonomy-image-upload');
      if (fileInput) fileInput.value = '';
    } else {
      alert('❌ Erreur: ' + data.message);
    }
  } catch (e) {
    console.error('Erreur upload:', e);
    alert('❌ Erreur lors de l\'upload');
  }
}

// Fonction renommage d'image de taxonomie
async function renameTaxonomyImage(identifier, folder, oldType, newType) {
  if (oldType === newType) return;
  
  if (!confirm(`Renommer l'image de "${oldType}" vers "${newType}" ?`)) return;
  
  console.log('🔄 Renommage:', { identifier, folder, oldType, newType });
  
  try {
    const response = await fetch('{{ route("admin.taxonomy.rename-image") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        identifier: identifier,
        folder: folder,
        old_type: oldType,
        new_type: newType
      })
    });
    
    const data = await response.json();
    
    if (data.success) {
      alert('✅ ' + data.message);
      // Recharger les images dans la modal au lieu de fermer
      loadTaxonomyImages(identifier, folder);
    } else {
      alert('❌ Erreur: ' + data.message);
    }
  } catch (e) {
    console.error('Erreur renommage:', e);
    alert('❌ Erreur lors du renommage');
  }
}

// Fonction pour définir une image indexée comme image principale
async function setAsPrimaryImage(identifier, folder, currentFullType, baseType) {
  if (!confirm(`Définir "${currentFullType}" comme image principale "${baseType}" ?\n\nL'image actuelle "${baseType}" sera renommée en "${baseType}-2" si elle existe.`)) return;
  
  console.log('⭐ Définir comme principale:', { identifier, folder, currentFullType, baseType });
  
  try {
    const response = await fetch('{{ route("admin.taxonomy.set-primary-image") }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        identifier: identifier,
        folder: folder,
        current_type: currentFullType,
        base_type: baseType
      })
    });
    
    const data = await response.json();
    
    if (data.success) {
      alert('✅ ' + data.message);
      loadTaxonomyImages(identifier, folder);
    } else {
      alert('❌ ' + data.message);
    }
  } catch (e) {
    console.error('Erreur:', e);
    alert('❌ Erreur lors de l\'opération');
  }
}

// Fonction suppression d'image de taxonomie
async function deleteTaxonomyImage(identifier, folder, type) {
  if (!confirm(`Supprimer définitivement l'image "${type}" ?`)) return;
  
  console.log('🗑️ Suppression:', { identifier, folder, type });
  
  try {
    const response = await fetch('{{ route("admin.taxonomy.delete-image") }}', {
      method: 'DELETE',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        identifier: identifier,
        folder: folder,
        type: type
      })
    });
    
    const data = await response.json();
    
    if (data.success) {
      alert('✅ ' + data.message);
      // Recharger les images dans la modal au lieu de fermer
      loadTaxonomyImages(identifier, folder);
    } else {
      alert('❌ Erreur: ' + data.message);
    }
  } catch (e) {
    console.error('Erreur suppression:', e);
    alert('❌ Erreur lors de la suppression');
  }
}

// Afficher le résultat de la recherche avec l'image (v2.1 - Structure mise à jour)
async function displayGameResult(game, platform) {
  console.log('🎮 displayGameResult v2.1 - Début', { game, platform });
  const resultsDiv = document.getElementById('game-search-results');
  const contentDiv = document.getElementById('game-results-content');
  
  if (!resultsDiv || !contentDiv) {
    console.error('❌ Éléments DOM non trouvés:', { resultsDiv, contentDiv });
    return;
  }
  
  // Nettoyer le contenu précédent
  contentDiv.innerHTML = '';
  
  // Créer la structure du résultat
  const resultContainer = document.createElement('div');
  resultContainer.className = 'flex gap-4';
  
  // Colonne gauche: Image + Logo éditeur
  const leftColumn = document.createElement('div');
  leftColumn.className = 'flex-shrink-0 flex flex-col gap-2';
  
  // Image cover (avec fallback logo/artwork)
  const imageUrl = await getGameImageWithFallback(game, platform);
  const imageContainer = document.createElement('div');
  imageContainer.className = 'w-32';
  
  if (imageUrl) {
    const img = document.createElement('img');
    // Ajouter timestamp pour forcer le rechargement
    const timestamp = Date.now();
    img.src = imageUrl.includes('?') ? `${imageUrl}&t=${timestamp}` : `${imageUrl}?t=${timestamp}`;
    img.alt = game.name;
    img.className = 'w-32 h-32 object-cover rounded border border-gray-200';
    img.onerror = function() {
      const placeholder = document.createElement('div');
      placeholder.className = 'w-32 h-32 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-2xl';
      placeholder.textContent = '?';
      this.replaceWith(placeholder);
    };
    imageContainer.appendChild(img);
  } else {
    const placeholder = document.createElement('div');
    placeholder.className = 'w-32 h-32 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-2xl';
    placeholder.textContent = '?';
    imageContainer.appendChild(placeholder);
  }
  
  // Logo éditeur sous la cover
  const publisherLogoContainer = document.createElement('div');
  publisherLogoContainer.id = 'publisher-logo-display-' + game.id;
  publisherLogoContainer.className = 'w-32 h-16 flex items-center justify-center';
  publisherLogoContainer.innerHTML = '<span class="text-xl text-gray-300">📚</span>';
  
  leftColumn.appendChild(imageContainer);
  leftColumn.appendChild(publisherLogoContainer);
  
  // Container principal pour infos + logo (2 colonnes)
  const mainInfoContainer = document.createElement('div');
  mainInfoContainer.className = 'flex-1 flex gap-4';
  
  // Première colonne: Informations de base uniquement
  const basicInfoColumn = document.createElement('div');
  basicInfoColumn.className = 'flex-1';
  
  const title = document.createElement('h4');
  title.className = 'font-bold text-lg text-gray-900 mb-2';
  title.textContent = game.name;
  
  basicInfoColumn.appendChild(title);
  
  const details = document.createElement('div');
  details.className = 'space-y-1 text-sm text-gray-600';
  
  // ROM ID ou Slug
  if (game.rom_id || game.slug) {
    const idLine = document.createElement('div');
    idLine.innerHTML = `<span class="font-semibold">ID:</span> ${game.rom_id || game.slug}`;
    details.appendChild(idLine);
  }
  
  // Année
  if (game.year) {
    const yearLine = document.createElement('div');
    yearLine.innerHTML = `<span class="font-semibold">Année:</span> ${game.year}`;
    details.appendChild(yearLine);
  }
  
  // Région
  if (game.region) {
    const regionLine = document.createElement('div');
    regionLine.innerHTML = `<span class="font-semibold">Région:</span> ${game.region}`;
    details.appendChild(regionLine);
  }
  
  // Publisher
  if (game.publisher) {
    const publisherLine = document.createElement('div');
    publisherLine.innerHTML = `<span class="font-semibold">Éditeur:</span> ${game.publisher}`;
    details.appendChild(publisherLine);
  }
  
  // Noms alternatifs
  if (game.alternate_names) {
    const alternateNames = game.alternate_names.split('|');
    if (alternateNames.length > 0) {
      const altLine = document.createElement('div');
      altLine.className = 'mt-2 pt-2 border-t border-gray-200';
      altLine.innerHTML = `<span class="font-semibold">Noms alternatifs:</span>`;
      
      alternateNames.forEach(altName => {
        const altNameDiv = document.createElement('div');
        altNameDiv.className = 'text-xs text-blue-600 ml-4 mt-1';
        altNameDiv.textContent = '→ ' + altName;
        altLine.appendChild(altNameDiv);
      });
      
      details.appendChild(altLine);
    }
  }
  
  basicInfoColumn.appendChild(details);
  
  // Deuxième colonne: Logo du jeu
  const logoColumn = document.createElement('div');
  logoColumn.className = 'flex-shrink-0 flex items-start justify-center';
  
  const gameLogo = document.createElement('div');
  gameLogo.className = 'w-48 h-36 flex items-center justify-center flex-shrink-0';
  gameLogo.id = 'game-logo-' + game.id;
  gameLogo.innerHTML = '<span class="text-gray-300 text-5xl">✕</span>';
  
  logoColumn.appendChild(gameLogo);
  
  // Assembler les deux colonnes
  mainInfoContainer.appendChild(basicInfoColumn);
  mainInfoContainer.appendChild(logoColumn);
  
  // Section de modification
  const editSection = document.createElement('div');
  editSection.className = 'mt-6 border-t pt-4';
  
  const editTitle = document.createElement('h5');
  editTitle.className = 'font-semibold text-sm text-gray-700 mb-3';
  editTitle.textContent = 'Modifier les informations';
  editSection.appendChild(editTitle);
  
  const editGrid = document.createElement('div');
  editGrid.className = 'grid grid-cols-1 gap-3';
  
  // ROM ID éditable
  const romIdContainer = document.createElement('div');
  romIdContainer.className = 'flex items-center gap-2';
  const romIdLabel = document.createElement('label');
  romIdLabel.className = 'text-sm font-medium text-gray-700 w-24';
  romIdLabel.textContent = 'ROM ID:';
  const romIdInput = document.createElement('input');
  romIdInput.type = 'text';
  romIdInput.value = game.rom_id || game.slug || '';
  romIdInput.className = 'flex-1 border border-gray-300 rounded px-3 py-2 text-sm bg-gray-100 text-gray-600 cursor-not-allowed';
  romIdInput.readOnly = true;
  romIdInput.title = 'Ce champ n\'est pas modifiable';
  romIdContainer.appendChild(romIdLabel);
  romIdContainer.appendChild(romIdInput);
  
  // Nom éditable
  const nameContainer = document.createElement('div');
  nameContainer.className = 'flex items-center gap-2';
  const nameLabel = document.createElement('label');
  nameLabel.className = 'text-sm font-medium text-gray-700 w-24';
  nameLabel.textContent = 'Nom:';
  const nameInput = document.createElement('input');
  nameInput.type = 'text';
  nameInput.value = game.name || '';
  nameInput.className = 'flex-1 border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
  nameInput.dataset.field = 'name';
  nameInput.dataset.gameId = game.id;
  nameInput.dataset.platform = platform;
  nameInput.onchange = () => updateGameField(game.id, platform, 'name', nameInput.value);
  nameContainer.appendChild(nameLabel);
  nameContainer.appendChild(nameInput);
  
  // Année éditable
  const yearContainer = document.createElement('div');
  yearContainer.className = 'flex items-center gap-2';
  const yearLabel = document.createElement('label');
  yearLabel.className = 'text-sm font-medium text-gray-700 w-24';
  yearLabel.textContent = 'Année:';
  const yearInput = document.createElement('input');
  yearInput.type = 'text';
  yearInput.value = game.year || '';
  yearInput.className = 'flex-1 border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
  yearInput.dataset.field = 'year';
  yearInput.dataset.gameId = game.id;
  yearInput.dataset.platform = platform;
  yearInput.onchange = () => updateGameField(game.id, platform, 'year', yearInput.value);
  yearContainer.appendChild(yearLabel);
  yearContainer.appendChild(yearInput);
  
  // Éditeur éditable avec autocomplete
  const publisherContainer = document.createElement('div');
  publisherContainer.className = 'flex items-center gap-2 relative';
  publisherContainer.id = 'publisher-container-' + game.id;
  
  const publisherLabel = document.createElement('label');
  publisherLabel.className = 'text-sm font-medium text-gray-700 w-24';
  publisherLabel.textContent = 'Éditeur:';
  const publisherInput = document.createElement('input');
  publisherInput.type = 'text';
  publisherInput.value = game.publisher || '';
  publisherInput.className = 'flex-1 border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
  publisherInput.id = 'publisher-input-' + game.id;
  publisherInput.dataset.field = 'publisher';
  publisherInput.dataset.gameId = game.id;
  publisherInput.dataset.platform = platform;
  publisherInput.autocomplete = 'off';
  
  // Suggestions d'éditeurs
  const publisherSuggestions = document.createElement('div');
  publisherSuggestions.id = 'publisher-suggestions-' + game.id;
  publisherSuggestions.className = 'absolute left-24 right-0 top-full mt-1 bg-white border border-gray-300 rounded shadow-lg max-h-48 overflow-y-auto z-50 hidden';
  
  // Event listeners pour l'autocomplete
  let publisherDebounce = null;
  publisherInput.oninput = () => {
    clearTimeout(publisherDebounce);
    publisherDebounce = setTimeout(() => {
      searchPublishers(publisherInput.value, game.id, platform);
    }, 300);
  };
  
  publisherInput.onfocus = () => {
    if (publisherInput.value.length >= 2) {
      searchPublishers(publisherInput.value, game.id, platform);
    }
  };
  
  publisherInput.onblur = () => {
    // Délai pour permettre le clic sur une suggestion
    setTimeout(() => {
      publisherSuggestions.classList.add('hidden');
    }, 300);
  };
  
  publisherContainer.appendChild(publisherLabel);
  publisherContainer.appendChild(publisherInput);
  publisherContainer.appendChild(publisherSuggestions);
  
  // Noms alternatifs éditables
  const alternateNamesContainer = document.createElement('div');
  alternateNamesContainer.className = 'flex items-start gap-2';
  const alternateNamesLabel = document.createElement('label');
  alternateNamesLabel.className = 'text-sm font-medium text-gray-700 w-24 pt-2';
  alternateNamesLabel.textContent = 'Noms alt.:';
  const alternateNamesTextarea = document.createElement('textarea');
  alternateNamesTextarea.value = game.alternate_names || '';
  alternateNamesTextarea.className = 'flex-1 border border-gray-300 rounded px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500';
  alternateNamesTextarea.rows = 3;
  alternateNamesTextarea.placeholder = 'Séparez les noms par | (pipe)';
  alternateNamesTextarea.dataset.field = 'alternate_names';
  alternateNamesTextarea.dataset.gameId = game.id;
  alternateNamesTextarea.dataset.platform = platform;
  alternateNamesTextarea.onchange = () => updateGameField(game.id, platform, 'alternate_names', alternateNamesTextarea.value);
  alternateNamesContainer.appendChild(alternateNamesLabel);
  alternateNamesContainer.appendChild(alternateNamesTextarea);
  
  editGrid.appendChild(romIdContainer);
  editGrid.appendChild(nameContainer);
  editGrid.appendChild(yearContainer);
  editGrid.appendChild(publisherContainer);
  editGrid.appendChild(alternateNamesContainer);
  editSection.appendChild(editGrid);
  
  // Déterminer l'identifiant et le dossier AVANT de créer les boutons
  const nameBasedPlatforms = ['wonderswan', 'megadrive', 'segasaturn', 'gamegear'];
  let identifier;
  
  if (nameBasedPlatforms.includes(platform)) {
    // Pour toutes ces plateformes, garder le nom tel quel (juste retirer l'extension)
    identifier = game.name
      .replace(/\.ws$/i, '')
      .replace(/\.md$/i, '')
      .replace(/\.gg$/i, '')
      .replace(/\.bin$/i, '')
      .trim();
  } else {
    // Utiliser le ROM ID ou slug pour autres plateformes
    identifier = game.rom_id || game.slug;
  }
  
  // Détecter le dossier selon la plateforme (même logique que getLocalGameImage)
  let folder;
  if (platform === 'gameboy') {
    // Détecter le sous-dossier selon le préfixe du ROM ID
    if (identifier.startsWith('CGB-')) {
      folder = 'game boy color';
    } else if (identifier.startsWith('AGB-')) {
      folder = 'game boy advance';
    } else {
      folder = 'gameboy'; // DMG- et autres
    }
  } else {
    const platformFolders = {
      'n64': 'n64',
      'nes': 'nes',
      'snes': 'snes',
      'gamegear': 'gamegear',
      'wonderswan': 'wonderswan',
      'segasaturn': 'segasaturn',
      'megadrive': 'megadrive'
    };
    folder = platformFolders[platform] || platform;
  }
  
  // Section des images
  const imagesSection = document.createElement('div');
  imagesSection.className = 'mt-6 border-t pt-4';
  
  const imagesTitleRow = document.createElement('div');
  imagesTitleRow.className = 'flex items-center justify-between mb-3';
  
  const imagesTitle = document.createElement('h5');
  imagesTitle.className = 'font-semibold text-sm text-gray-700';
  imagesTitle.textContent = 'Images disponibles';
  
  // Conteneur pour les boutons
  const buttonsContainer = document.createElement('div');
  buttonsContainer.className = 'flex items-center gap-2';
  
  // Bouton "Appliquer au formulaire"
  const applyToFormButton = document.createElement('button');
  applyToFormButton.className = 'bg-green-600 hover:bg-green-700 text-white px-3 py-1 rounded text-xs font-medium flex items-center gap-1';
  applyToFormButton.innerHTML = '✓ Appliquer au formulaire';
  applyToFormButton.title = 'Remplir automatiquement la taxonomie de l\'article';
  applyToFormButton.onclick = (e) => {
    e.stopPropagation();
    applyGameTaxonomy(game, platform);
  };
  
  // Bouton d'édition global pour toutes les images
  const globalEditButton = document.createElement('button');
  globalEditButton.className = 'bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded text-xs font-medium flex items-center gap-1';
  globalEditButton.innerHTML = '✏️ Gérer les images';
  globalEditButton.onclick = (e) => {
    e.stopPropagation();
    openImageEditorModal(game, platform, identifier, folder, 'cover');
  };
  
  buttonsContainer.appendChild(applyToFormButton);
  buttonsContainer.appendChild(globalEditButton);
  
  imagesTitleRow.appendChild(imagesTitle);
  imagesTitleRow.appendChild(buttonsContainer);
  imagesSection.appendChild(imagesTitleRow);
  
  const imagesGrid = document.createElement('div');
  imagesGrid.className = 'grid grid-cols-3 gap-3';
  
  // Types d'images à afficher
  const imageTypes = [
    { type: 'cover', label: 'Cover' },
    { type: 'artwork', label: 'Artwork' },
    { type: 'gameplay', label: 'Gameplay' }
  ];
  
  const useProxy = '{{ config("filesystems.disks.r2.url") ? "true" : "false" }}' === 'true';
  const baseUrl = useProxy ? '/proxy/images/taxonomy' : '/stock-R4E/public/images/taxonomy';
  imageTypes.forEach(imgType => {
    const imageCard = document.createElement('div');
    imageCard.className = 'relative group';
    
    const timestamp = Date.now();
    const fullPath = `${baseUrl}/${folder}/${identifier}-${imgType.type}.png?t=${timestamp}`;
    const encodedPath = encodeURI(fullPath);
    
    // Container pour l'image (sans bouton)
    const imageWrapper = document.createElement('div');
    imageWrapper.className = 'relative';
    
    const img = document.createElement('img');
    img.src = encodedPath;
    img.alt = imgType.label;
    img.className = 'w-32 h-32 object-cover rounded border-2 border-gray-200 cursor-pointer hover:border-blue-500 transition-all';
    img.title = 'Cliquer pour agrandir';
    
    // Clic pour agrandir dans le lightbox
    img.onclick = () => openImageLightbox(encodedPath);
    
    // Si l'image n'existe pas, afficher un placeholder
    img.onerror = function() {
      const placeholder = document.createElement('div');
      placeholder.className = 'w-32 h-32 bg-gray-100 rounded border-2 border-dashed border-gray-300 flex items-center justify-center text-gray-400 text-xs';
      placeholder.innerHTML = `<div class="text-center"><div class="text-3xl">🖼️</div><div class="text-xs mt-1">Non disponible</div></div>`;
      this.replaceWith(placeholder);
    };
    
    imageWrapper.appendChild(img);
    
    const label = document.createElement('div');
    label.className = 'text-xs text-center mt-1 text-gray-600 font-medium';
    label.textContent = imgType.label;
    
    imageCard.appendChild(imageWrapper);
    imageCard.appendChild(label);
    imagesGrid.appendChild(imageCard);
  });
  
  imagesSection.appendChild(imagesGrid);
  
  // Assembler tout
  resultContainer.appendChild(leftColumn);
  resultContainer.appendChild(mainInfoContainer);
  
  // Ajouter la section édition et images sous les infos principales
  const fullWidthContainer = document.createElement('div');
  fullWidthContainer.className = 'col-span-full mt-6';
  fullWidthContainer.appendChild(editSection);
  fullWidthContainer.appendChild(imagesSection);
  
  contentDiv.appendChild(resultContainer);
  contentDiv.appendChild(fullWidthContainer);
  
  // Charger le logo de l'éditeur maintenant que tout est dans le DOM
  if (game.publisher) {
    console.log('🔄 Appel de loadPublisherLogoDisplay pour:', game.publisher, game.id);
    loadPublisherLogoDisplay(game.publisher, game.id);
  }
  
  // Charger le logo du jeu
  loadGameLogo(game, platform);
  
  // Afficher la section des résultats
  resultsDiv.classList.remove('hidden');
}

window.closeGameResults = function() {
  document.getElementById('game-search-results').classList.add('hidden');
};

// Échapper le HTML pour éviter les injections
function escapeHtml(text) {
  if (!text) return '';
  const div = document.createElement('div');
  div.textContent = text;
  return div.innerHTML;
}

// Autocomplétion jeux (ROM ID + nom)
let gameDebounceTimer = null;
let currentGameSuggestionIndex = -1;

console.log('🎮 Script autocomplete chargé');
console.log('Element game-search:', document.getElementById('game-search'));
console.log('Element game-platform:', document.getElementById('game-platform'));
console.log('Element game-suggestions:', document.getElementById('game-suggestions'));

window.onGameInput = function() {
  console.log('onGameInput appelé');
  clearTimeout(gameDebounceTimer);
  const input = document.getElementById('game-search');
  const value = input.value.trim();
  
  console.log('Valeur:', value);
  
  if (value.length < 2) {
    clearGameSuggestions();
    return;
  }
  
  gameDebounceTimer = setTimeout(() => {
    fetchGameSuggestions(value);
  }, 300);
};

async function fetchGameSuggestions(query) {
  console.log('fetchGameSuggestions appelé avec:', query);
  const platform = document.getElementById('game-platform').value;
  
  try {
    const url = `{{ url('admin/ajax/search-game') }}?platform=${platform}&query=${encodeURIComponent(query)}`;
    console.log('URL:', url);
    const response = await fetch(url);
    console.log('Response status:', response.status);
    const data = await response.json();
    console.log('Data:', data);
    
    if (data.success && data.games && data.games.length > 0) {
      displayGameSuggestions(data.games);
    } else {
      clearGameSuggestions();
    }
  } catch (error) {
    console.error('Erreur suggestions jeux:', error);
  }
}

function displayGameSuggestions(games) {
  console.log('displayGameSuggestions appelé avec', games.length, 'jeux');
  const suggestionsDiv = document.getElementById('game-suggestions');
  const platform = document.getElementById('game-platform').value;
  currentGameSuggestionIndex = -1;
  
  console.log('suggestionsDiv:', suggestionsDiv);
  
  suggestionsDiv.innerHTML = '';
  
  games.forEach((game, index) => {
    const imageUrl = getLocalGameImage(game, platform);
    const gameJson = btoa(encodeURIComponent(JSON.stringify(game)));
    
    const div = document.createElement('div');
    div.className = 'suggestion-item flex items-center gap-3 px-3 py-2 hover:bg-blue-50 cursor-pointer border-b last:border-b-0';
    div.style.cssText = 'background-color: white !important; color: black !important; min-height: 60px;';
    div.setAttribute('data-index', index);
    div.setAttribute('data-game-json', gameJson);
    div.onclick = function() { selectGameSuggestionFromData(this); };
    
    if (imageUrl) {
      const img = document.createElement('img');
      // Ajouter timestamp pour éviter le cache
      const timestamp = Date.now();
      img.src = imageUrl.includes('?') ? `${imageUrl}&t=${timestamp}` : `${imageUrl}?t=${timestamp}`;
      img.alt = '';
      img.className = 'w-12 h-12 object-cover rounded flex-shrink-0';
      
      // Fonction pour remplacer par le placeholder
      const replacePlaceholder = function() {
        const placeholder = document.createElement('div');
        placeholder.className = 'w-12 h-12 bg-gray-200 rounded flex-shrink-0 flex items-center justify-center text-gray-400 text-xs';
        placeholder.textContent = '?';
        img.replaceWith(placeholder);
      };
      
      img.onerror = replacePlaceholder;
      
      div.appendChild(img);
    } else {
      const placeholder = document.createElement('div');
      placeholder.className = 'w-12 h-12 bg-gray-200 rounded flex-shrink-0 flex items-center justify-center text-gray-400 text-xs';
      placeholder.textContent = '?';
      div.appendChild(placeholder);
    }
    
    const contentDiv = document.createElement('div');
    contentDiv.className = 'flex-1 min-w-0';
    
    const gameName = document.createElement('div');
    gameName.className = 'font-semibold text-sm text-gray-900 truncate';
    gameName.textContent = game.name;
    
    const gameId = document.createElement('div');
    gameId.className = 'text-xs text-gray-500 truncate';
    gameId.textContent = game.rom_id || game.slug || '';
    
    contentDiv.appendChild(gameName);
    contentDiv.appendChild(gameId);
    
    // Afficher les noms alternatifs si disponibles
    if (game.alternate_names) {
      const alternateNames = game.alternate_names.split('|');
      if (alternateNames.length > 0) {
        const altDiv = document.createElement('div');
        altDiv.className = 'text-xs text-blue-600 mt-1 truncate';
        altDiv.textContent = '→ ' + alternateNames.join(' • ');
        contentDiv.appendChild(altDiv);
      }
    }
    
    div.appendChild(contentDiv);
    
    suggestionsDiv.appendChild(div);
  });
  
  console.log('HTML généré:', suggestionsDiv.innerHTML.substring(0, 200));
  console.log('Classes avant remove:', suggestionsDiv.className);
  console.log('Nombre de children:', suggestionsDiv.children.length);
  suggestionsDiv.classList.remove('hidden');
  suggestionsDiv.style.display = 'block'; // Force affichage
  suggestionsDiv.style.backgroundColor = '#ffffff'; // Force fond blanc
  suggestionsDiv.style.border = '2px solid #3b82f6'; // Force bordure bleue visible
  console.log('Classes après remove:', suggestionsDiv.className);
  console.log('suggestionsDiv visible?', !suggestionsDiv.classList.contains('hidden'));
  console.log('Display:', suggestionsDiv.style.display);
}

window.selectGameSuggestionFromData = function(element) {
  const gameJson = element.getAttribute('data-game-json');
  const game = JSON.parse(decodeURIComponent(atob(gameJson)));
  const identifier = game.rom_id || game.slug || game.name || '';
  document.getElementById('game-search').value = identifier;
  clearGameSuggestions();
  
  // Afficher le résultat avec l'image
  displayGameResult(game, document.getElementById('game-platform').value);
};

window.clearGameSuggestions = function() {
  const suggestionsDiv = document.getElementById('game-suggestions');
  suggestionsDiv.innerHTML = '';
  suggestionsDiv.classList.add('hidden');
  currentGameSuggestionIndex = -1;
};

window.onGameKeydown = function(e) {
  const suggestions = document.querySelectorAll('#game-suggestions .suggestion-item');
  if (suggestions.length === 0) return;
  
  if (e.key === 'ArrowDown') {
    e.preventDefault();
    currentGameSuggestionIndex = Math.min(currentGameSuggestionIndex + 1, suggestions.length - 1);
    highlightGameSuggestion();
  } else if (e.key === 'ArrowUp') {
    e.preventDefault();
    currentGameSuggestionIndex = Math.max(currentGameSuggestionIndex - 1, 0);
    highlightGameSuggestion();
  } else if (e.key === 'Enter' && currentGameSuggestionIndex >= 0) {
    e.preventDefault();
    suggestions[currentGameSuggestionIndex].click();
  } else if (e.key === 'Escape') {
    clearGameSuggestions();
  }
};

function highlightGameSuggestion() {
  const suggestions = document.querySelectorAll('#game-suggestions .suggestion-item');
  suggestions.forEach((el, idx) => {
    if (idx === currentGameSuggestionIndex) {
      el.classList.add('bg-blue-100');
      el.scrollIntoView({ block: 'nearest' });
    } else {
      el.classList.remove('bg-blue-100');
    }
  });
}

// Fermer les suggestions en cliquant ailleurs
document.addEventListener('click', function(e) {
  if (!e.target.closest('#game-search') && !e.target.closest('#game-suggestions')) {
    clearGameSuggestions();
  }
});

// Fonction pour afficher un toast notification
window.showToast = function(message, type = 'success') {
  const container = document.getElementById('toast-container');
  const toast = document.createElement('div');
  
  const colors = {
    success: 'bg-green-500',
    error: 'bg-red-500',
    info: 'bg-blue-500'
  };
  
  const icons = {
    success: '✅',
    error: '❌',
    info: 'ℹ️'
  };
  
  toast.className = `${colors[type]} text-white px-6 py-3 rounded-lg shadow-lg flex items-center gap-2 transform transition-all duration-300 opacity-0 translate-x-8`;
  toast.innerHTML = `
    <span class="text-lg">${icons[type]}</span>
    <span class="font-medium">${message}</span>
  `;
  
  container.appendChild(toast);
  
  // Animation d'entrée
  setTimeout(() => {
    toast.classList.remove('opacity-0', 'translate-x-8');
  }, 10);
  
  // Animation de sortie et suppression
  setTimeout(() => {
    toast.classList.add('opacity-0', 'translate-x-8');
    setTimeout(() => {
      container.removeChild(toast);
    }, 300);
  }, 3000);
};

// Fonction pour mettre à jour un champ de jeu
window.updateGameField = async function(gameId, platform, field, value) {
  try {
    const response = await fetch('{{ url('admin/ajax/update-game-field') }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({
        game_id: gameId,
        platform: platform,
        field: field,
        value: value
      })
    });
    
    const data = await response.json();
    
    if (data.success) {
      showToast(`Champ "${field}" mis à jour`, 'success');
    } else {
      showToast('Erreur: ' + data.message, 'error');
    }
  } catch (error) {
    console.error('Erreur mise à jour:', error);
    showToast('Erreur lors de la mise à jour', 'error');
  }
};

// ========================================
// AUTOCOMPLETE ÉDITEURS
// ========================================

window.searchPublishers = async function(query, gameId, platform) {
  const suggestionsDiv = document.getElementById('publisher-suggestions-' + gameId);
  
  if (!query || query.length < 2) {
    suggestionsDiv.classList.add('hidden');
    return;
  }
  
  try {
    const response = await fetch('{{ url('admin/ajax/search-publishers') }}?q=' + encodeURIComponent(query));
    const data = await response.json();
    const publishers = data.publishers || [];
    
    suggestionsDiv.innerHTML = '';
    
    // Afficher les résultats trouvés
    publishers.forEach(publisher => {
      const item = document.createElement('div');
      item.className = 'px-3 py-2 hover:bg-blue-50 cursor-pointer text-sm';
      item.textContent = publisher.name;
      item.onmousedown = (e) => {
        e.preventDefault(); // Empêche le blur de l'input
        selectPublisher(gameId, platform, publisher.name);
      };
      suggestionsDiv.appendChild(item);
    });
    
    // Vérifier si le texte saisi correspond exactement à un résultat
    const exactMatch = publishers.some(p => p.name.toLowerCase() === query.toLowerCase());
    
    // Si aucun résultat exact, proposer d'ajouter
    if (!exactMatch) {
      const addItem = document.createElement('div');
      addItem.className = 'px-3 py-2 hover:bg-green-50 cursor-pointer text-sm border-t border-gray-200 text-green-700 font-medium';
      addItem.innerHTML = `<span class="text-green-600">➕</span> Ajouter "${query}"`;
      addItem.onmousedown = (e) => {
        e.preventDefault(); // Empêche le blur de l'input
        addNewPublisher(gameId, platform, query);
      };
      suggestionsDiv.appendChild(addItem);
    }
    
    suggestionsDiv.classList.remove('hidden');
  } catch (error) {
    console.error('Erreur recherche éditeurs:', error);
  }
};

window.selectPublisher = function(gameId, platform, publisherName) {
  console.log('🎯 selectPublisher appelé:', gameId, publisherName);
  const input = document.getElementById('publisher-input-' + gameId);
  const suggestionsDiv = document.getElementById('publisher-suggestions-' + gameId);
  
  console.log('📝 Input trouvé:', input);
  console.log('📋 Suggestions div:', suggestionsDiv);
  
  if (input) {
    input.value = publisherName;
    console.log('✅ Valeur mise à jour:', input.value);
  }
  
  if (suggestionsDiv) {
    suggestionsDiv.classList.add('hidden');
  }
  
  // Charger le logo de l'éditeur (formulaire + affichage)
  loadPublisherLogo(publisherName, gameId);
  loadPublisherLogoDisplay(publisherName, gameId);
  
  // Sauvegarder la modification
  updateGameField(gameId, platform, 'publisher', publisherName);
};

window.addNewPublisher = async function(gameId, platform, publisherName) {
  const input = document.getElementById('publisher-input-' + gameId);
  const suggestionsDiv = document.getElementById('publisher-suggestions-' + gameId);
  
  try {
    const response = await fetch('{{ url('admin/ajax/create-publisher') }}', {
      method: 'POST',
      headers: {
        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        'Content-Type': 'application/json'
      },
      body: JSON.stringify({ name: publisherName })
    });
    
    const data = await response.json();
    
    if (data.success) {
      showToast(`Éditeur "${publisherName}" créé`, 'success');
      input.value = publisherName;
      suggestionsDiv.classList.add('hidden');
      
      // Charger le logo de l'éditeur (formulaire + affichage)
      loadPublisherLogo(publisherName, gameId);
      loadPublisherLogoDisplay(publisherName, gameId);
      
      // Sauvegarder dans le jeu
      updateGameField(gameId, platform, 'publisher', publisherName);
    } else {
      showToast('Erreur: ' + data.message, 'error');
    }
  } catch (error) {
    console.error('Erreur création éditeur:', error);
    showToast('Erreur lors de la création', 'error');
  }
};

// Event listener pour le changement de plateforme
const platformSelect = document.getElementById('game-platform');
if (platformSelect) {
  platformSelect.addEventListener('change', function() {
    clearGameSuggestions();
  });
}

// Event listeners pour le champ de recherche (après chargement du DOM)
if (document.readyState === 'loading') {
  document.addEventListener('DOMContentLoaded', attachGameSearchListeners);
} else {
  attachGameSearchListeners();
}

function attachGameSearchListeners() {
  const gameSearchInput = document.getElementById('game-search');

  console.log('🔍 Tentative d\'ajout des event listeners');
  console.log('gameSearchInput trouvé:', gameSearchInput);
  console.log('Fonction onGameInput existe:', typeof window.onGameInput);
  console.log('Fonction onGameKeydown existe:', typeof window.onGameKeydown);

  if (gameSearchInput) {
    console.log('✅ Ajout des event listeners sur le champ de recherche');
    
    gameSearchInput.addEventListener('input', function() {
      console.log('📝 Event input déclenché');
      window.onGameInput();
    });
    
    gameSearchInput.addEventListener('keydown', function(event) {
      console.log('⌨️ Event keydown déclenché');
      window.onGameKeydown(event);
    });
    
    console.log('✅ Event listeners ajoutés avec succès');
  } else {
    console.error('❌ Element game-search introuvable!');
  }
}

// ========================================
// ANALYSE IA D'IMAGES
// ========================================

window.analyzeImageWithAI = async function(imageUrl, type) {
  
  const html = `
    <div class="space-y-3 max-h-96 overflow-y-auto">
      <p class="text-sm text-gray-600 mb-2">${games.length} résultat(s) trouvé(s)</p>
      ${games.map(game => `
        <div class="flex gap-3 items-start p-3 border rounded hover:bg-gray-50">
          ${game.cloudinary_url ? `<img src="${game.cloudinary_url}" alt="${game.name}" class="w-16 h-16 object-cover rounded">` : ''}
          <div class="flex-1 min-w-0">
            <h4 class="font-semibold truncate">${game.name}</h4>
            ${game.rom_id ? `<p class="text-xs text-gray-600">ROM ID: ${game.rom_id}</p>` : ''}
            ${game.year ? `<p class="text-xs text-gray-600">Année: ${game.year}</p>` : ''}
          </div>
          <button type="button" 
                  onclick='fillFormFromGame(${JSON.stringify(game).replace(/'/g, "\\'")},"${platform}")'
                  class="px-3 py-1 bg-green-600 text-white rounded text-sm hover:bg-green-700 whitespace-nowrap">
            ✓ Utiliser
          </button>
        </div>
      `).join('')}
    </div>
  `;
  
  contentDiv.innerHTML = html;
}

window.fillFormFromGame = function(game, platform) {
  // Remplir le ROM ID
  const romIdField = document.querySelector('input[name="rom_id"]');
  if (romIdField && game.rom_id) {
    romIdField.value = game.rom_id;
  }
  
  // Remplir l'éditeur (publisher)
  const publisherField = document.querySelector('input[name="publisher"]');
  if (publisherField && game.publisher) {
    publisherField.value = game.publisher;
  }
  
  // Remplir le prix moyen si disponible
  const priceField = document.querySelector('input[name="average_market_price"]');
  if (priceField && game.price) {
    priceField.value = game.price;
  }
  
  // Ajouter l'image si disponible
  if (game.cloudinary_url) {
    const imageInput = document.querySelector('input[name="image_urls[]"]');
    if (imageInput) {
      imageInput.value = game.cloudinary_url;
      // Déclencher l'affichage de l'aperçu si la fonction existe
      if (typeof addImagePreview === 'function') {
        addImagePreview(game.cloudinary_url);
      }
    }
  }
  
  alert('✓ Informations du jeu importées ! Complétez les autres champs.');
  closeGameResults();
};

window.closeGameResults = function() {
  const resultsDiv = document.getElementById('game-search-results');
  resultsDiv.classList.add('hidden');
};

// ========================================
// TAXONOMIE CASCADE
// ========================================
document.addEventListener('DOMContentLoaded', function() {
  const cat = document.getElementById('article_category_id');
  const brand = document.getElementById('article_brand_id');
  const sub = document.getElementById('article_sub_category_id');
  const type = document.getElementById('article_type_id');

  if (!cat || !brand || !sub || !type) {
    console.error('❌ Éléments de taxonomie manquants:', { cat, brand, sub, type });
    return;
  }

  const oldBrand = @json(old('article_brand_id', $console->article_brand_id ?? null));
  const oldSub = @json(old('article_sub_category_id', $console->article_sub_category_id));
  const oldType = @json(old('article_type_id', $console->article_type_id));

  function clear(sel, placeholder = '— Choisir —') {
    sel.innerHTML = `<option value="">${placeholder}</option>`;
  }

  async function loadBrands(catId) {
    clear(brand); clear(sub); clear(type);
    if (!catId) return;
    
    // Afficher/masquer les champs selon la catégorie
    const languageField = document.getElementById('language_field');
    const regionField = document.getElementById('region_field');
    const publisherField = document.getElementById('publisher_field');
    const articleImagesField = document.getElementById('article_images_field');
    const completenessConsole = document.getElementById('completeness_console');
    const completenessGame = document.getElementById('completeness_game');
    const completenessHintConsole = document.getElementById('completeness_hint_console');
    const completenessHintGame = document.getElementById('completeness_hint_game');
    const brandLabel = document.getElementById('brand_label');
    const selectedCategory = cat.options[cat.selectedIndex].text;
    
    if (selectedCategory.includes('Cartes à collectionner')) {
      if (languageField) languageField.style.display = 'block';
      if (regionField) regionField.style.display = 'none';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    } else if (selectedCategory.includes('Accessoires')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Compatibilité *';
    } else if (selectedCategory.includes('Jeux vidéo')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'block';
      // Le champ images sera affiché par le listener du type
      if (completenessConsole) completenessConsole.style.display = 'none';
      if (completenessGame) completenessGame.style.display = 'block';
      if (completenessHintConsole) completenessHintConsole.style.display = 'none';
      if (completenessHintGame) completenessHintGame.style.display = 'block';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    } else {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'none';
      // Le champ images sera affiché par le listener du type
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque *';
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

  // Charger la description du type sélectionné
  async function loadTypeDescription(typeId) {
    const descField = document.getElementById('description_field');
    const descTextarea = document.getElementById('article_type_description');
    
    if (!typeId) {
      descField.style.display = 'none';
      descTextarea.value = '';
      return;
    }
    
    try {
      const response = await fetch(`{{ url('admin/ajax/type-description') }}/${typeId}`);
      const data = await response.json();
      descTextarea.value = data.description || '';
      descField.style.display = 'block';
    } catch (e) {
      console.error('Erreur chargement description:', e);
      descField.style.display = 'block';
    }
  }

  cat.addEventListener('change', e => loadBrands(e.target.value));
  brand.addEventListener('change', e => loadSubs(e.target.value));
  sub.addEventListener('change', e => loadTypes(e.target.value));
  type.addEventListener('change', e => loadTypeDescription(e.target.value));

  if (cat.value) loadBrands(cat.value);
  
  // ✅ Charger la description si un type est déjà sélectionné (mode édition)
  if (type.value) {
    loadTypeDescription(type.value);
  }
  
  // Afficher/masquer les champs selon la catégorie en mode édition
  window.addEventListener('DOMContentLoaded', () => {
    const languageField = document.getElementById('language_field');
    const regionField = document.getElementById('region_field');
    const publisherField = document.getElementById('publisher_field');
    const completenessConsole = document.getElementById('completeness_console');
    const completenessGame = document.getElementById('completeness_game');
    const completenessHintConsole = document.getElementById('completeness_hint_console');
    const completenessHintGame = document.getElementById('completeness_hint_game');
    const brandLabel = document.getElementById('brand_label');
    const selectedCategory = cat.options[cat.selectedIndex]?.text || '';
    
    if (selectedCategory.includes('Cartes à collectionner')) {
      if (languageField) languageField.style.display = 'block';
      if (regionField) regionField.style.display = 'none';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    } else if (selectedCategory.includes('Accessoires')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Compatibilité *';
    } else if (selectedCategory.includes('Jeux vidéo')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'block';
      if (completenessConsole) completenessConsole.style.display = 'none';
      if (completenessGame) completenessGame.style.display = 'block';
      if (completenessHintConsole) completenessHintConsole.style.display = 'none';
      if (completenessHintGame) completenessHintGame.style.display = 'block';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    } else {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque *';
    }
  });
});

/* =====================================================
   DRAG & DROP UPLOAD D'IMAGES
===================================================== */
(function() {
  const dropzone = document.getElementById('dropzone');
  const fileInput = document.getElementById('file-input');
  const previewContainer = document.getElementById('preview-container');
  const articleImagesField = document.getElementById('article_images_field');
  const typeSelect = document.getElementById('article_type_id');

  if (!dropzone || !fileInput || !previewContainer) return;

  let currentArticleTypeId = null;

  // Détecter le type d'article sélectionné pour associer les images
  if (typeSelect) {
    typeSelect.addEventListener('change', function() {
      currentArticleTypeId = this.value;
      if (currentArticleTypeId) {
        loadExistingImages(currentArticleTypeId);
      } else {
        previewContainer.innerHTML = '';
      }
    });

    // Charger les images si un type est déjà sélectionné (mode édition)
    if (typeSelect.value) {
      currentArticleTypeId = typeSelect.value;
      loadExistingImages(currentArticleTypeId);
    }
  }

  // Charger les images existantes de l'article_type
  async function loadExistingImages(typeId) {
    try {
      const response = await fetch(`{{ url('admin/ajax/type-description') }}/${typeId}`);
      const data = await response.json();
      
      if (data.images && data.images.length > 0) {
        previewContainer.innerHTML = '';
        data.images.forEach(url => {
          addImagePreview(url, typeId, true);
        });
      }
    } catch (e) {
      console.error('Erreur chargement images:', e);
    }
  }

  // Clic sur la zone de dépôt
  dropzone.addEventListener('click', () => fileInput.click());

  // Drag & drop
  dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropzone.classList.add('border-indigo-500', 'bg-indigo-50');
  });

  dropzone.addEventListener('dragleave', () => {
    dropzone.classList.remove('border-indigo-500', 'bg-indigo-50');
  });

  dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropzone.classList.remove('border-indigo-500', 'bg-indigo-50');
    const files = e.dataTransfer.files;
    handleFiles(files);
  });

  // Sélection de fichiers
  fileInput.addEventListener('change', (e) => {
    handleFiles(e.target.files);
  });

  // Gérer les fichiers uploadés
  async function handleFiles(files) {
    if (!currentArticleTypeId) {
      alert('Veuillez d\'abord sélectionner un type d\'article');
      return;
    }

    for (let file of files) {
      if (!file.type.startsWith('image/')) continue;

      const formData = new FormData();
      formData.append('image', file);
      formData.append('article_type_id', currentArticleTypeId);

      try {
        const response = await fetch('{{ route('admin.articles.upload-image') }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: formData
        });

        const data = await response.json();

        if (data.success) {
          addImagePreview(data.url, currentArticleTypeId, false);
        } else {
          alert('Erreur upload: ' + data.message);
        }
      } catch (e) {
        console.error('Erreur upload:', e);
        alert('Erreur lors de l\'upload');
      }
    }

    fileInput.value = ''; // Reset input
  }

  // Ajouter une prévisualisation d'image
  function addImagePreview(url, typeId, isExisting) {
    // Si l'URL n'est pas absolue, préfixer avec asset()
    let finalUrl = url;
    if (!/^https?:\/\//.test(url) && !url.startsWith('//')) {
      if (window.gameboyImageBaseUrl && url.includes('images/taxonomy/gameboy')) {
        // Pour les images Game Boy, utiliser la base dynamique
        const fileName = url.split('/').pop();
        finalUrl = window.gameboyImageBaseUrl + '/' + fileName;
      } else {
        // Pour les autres images, utiliser asset()
        finalUrl = (window.laravelAssetBase || '') + url.replace(/^\//, '');
      }
    }
    const div = document.createElement('div');
    div.className = 'relative group cursor-pointer';
    div.onclick = () => openImageLightbox(finalUrl);
    div.innerHTML = `
      <div class="aspect-square w-full overflow-hidden rounded-lg border border-gray-200">
        <img src="${finalUrl}" class="w-full h-full object-cover hover:opacity-90 transition-opacity">
      </div>
      <button type="button" 
              class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600 z-10"
              onclick="event.stopPropagation(); deleteImage('${finalUrl}', ${typeId}, this.parentElement);">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
      ${isExisting ? '<span class="absolute bottom-2 left-2 bg-blue-500 text-white text-xs px-2 py-1 rounded">Taxonomie</span>' : ''}
      <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
        <svg class="w-8 h-8 text-white drop-shadow-lg" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
        </svg>
      </div>
    `;
    previewContainer.appendChild(div);
  }

  // Fonction globale pour supprimer une image
  window.deleteImage = async function(url, typeId, element) {
    if (!confirm('Supprimer cette image de la taxonomie ?')) return;

    try {
      const response = await fetch('{{ route('admin.articles.delete-image') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          image_url: url,
          article_type_id: typeId
        })
      });

      const data = await response.json();

      if (data.success) {
        element.remove();
      } else {
        alert('Erreur: ' + data.message);
      }
    } catch (e) {
      console.error('Erreur suppression:', e);
      alert('Erreur lors de la suppression');
    }
  };

  // ========================================
  // GESTION DES IMAGES SPÉCIFIQUES AUX JEUX (DRAG & DROP UNIFIÉ)
  // ========================================
  const gameImagesSection = document.getElementById('game_images_section');
  const genericImagesSection = document.getElementById('generic_images_section');
  const gameDropzone = document.getElementById('game-dropzone');
  const gameImagesInput = document.getElementById('game-images-input');
  const gameImagesPreview = document.getElementById('game-images-preview');

  // ✅ Charger les images existantes en mode édition
  let uploadedGameImages = @json($console->article_images ?? []);
  let primaryImageUrl = @json($console->primary_image_url ?? null);

  // Ouvrir la modal de gestion des images d'article
  window.openArticleImagesModal = function() {
    const modal = document.createElement('div');
    modal.id = 'article-images-modal';
    modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto';
    
    const modalContent = document.createElement('div');
    modalContent.className = 'bg-white rounded-lg shadow-xl max-w-4xl w-full my-8';
    modalContent.style.maxHeight = '90vh';
    modalContent.style.overflowY = 'auto';
    
    // Header
    const header = document.createElement('div');
    header.className = 'bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-4 rounded-t-lg flex justify-between items-center sticky top-0 z-10';
    header.innerHTML = `
      <h3 class="text-xl font-bold">📸 Photos de l'article</h3>
      <button onclick="closeArticleImagesModal()" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
    `;
    
    // Body
    const body = document.createElement('div');
    body.className = 'p-6 space-y-6';
    
    // Section Upload avec caméra
    const uploadSection = document.createElement('div');
    uploadSection.className = 'border-2 border-dashed border-indigo-300 rounded-lg p-6 bg-indigo-50 hover:bg-indigo-100 transition-colors';
    uploadSection.innerHTML = `
      <div class="text-center">
        <div class="text-4xl mb-2">📸</div>
        <h4 class="font-semibold text-gray-700 mb-2">Prendre/Ajouter des photos</h4>
        <p class="text-sm text-gray-500 mb-4">Utilisez l'appareil photo de votre smartphone ou sélectionnez des fichiers</p>
        
        <input type="file" id="article-image-camera" accept="image/*" capture="environment" multiple class="hidden">
        <input type="file" id="article-image-file" accept="image/*" multiple class="hidden">
        
        <div class="flex gap-3 justify-center">
          <button onclick="document.getElementById('article-image-camera').click()" 
                  class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            📱 Appareil photo
          </button>
          <button onclick="document.getElementById('article-image-file').click()" 
                  class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
            </svg>
            🖼️ Galerie
          </button>
        </div>
      </div>
    `;
    
    // Section Images existantes
    const existingSection = document.createElement('div');
    existingSection.className = 'space-y-4';
    existingSection.innerHTML = `
      <h4 class="font-semibold text-gray-700">Photos de cet article (<span id="article-images-count">0</span>)</h4>
      <div id="article-images-grid" class="grid grid-cols-2 md:grid-cols-3 gap-4">
        <div class="col-span-full text-center text-gray-500 py-8">
          📭 Aucune photo pour le moment
        </div>
      </div>
    `;
    
    // Section Photos génériques (même taxonomie)
    const genericSection = document.createElement('div');
    genericSection.className = 'space-y-4 border-t pt-6';
    genericSection.innerHTML = `
      <div class="flex items-center justify-between">
        <div>
          <h4 class="font-semibold text-gray-700">� Photos d'autres articles du même type</h4>
          <p class="text-xs text-gray-500 mt-1">Cliquez sur une photo pour la réutiliser sur cet article</p>
        </div>
        <span id="generic-images-count" class="text-sm text-gray-500">Chargement...</span>
      </div>
      <div id="generic-images-grid" class="grid grid-cols-2 md:grid-cols-4 gap-3">
        <div class="col-span-full text-center text-gray-400 py-6">
          <div class="animate-pulse">⏳ Chargement des photos...</div>
        </div>
      </div>
    `;
    
    // Drag & Drop sur toute la section upload
    uploadSection.ondragover = (e) => {
      e.preventDefault();
      uploadSection.classList.add('border-indigo-500', 'bg-indigo-200');
    };
    
    uploadSection.ondragleave = () => {
      uploadSection.classList.remove('border-indigo-500', 'bg-indigo-200');
    };
    
    uploadSection.ondrop = (e) => {
      e.preventDefault();
      uploadSection.classList.remove('border-indigo-500', 'bg-indigo-200');
      handleArticleImagesUpload(e.dataTransfer.files);
    };
    
    // Event listeners pour les inputs
    const cameraInput = uploadSection.querySelector('#article-image-camera');
    const fileInput = uploadSection.querySelector('#article-image-file');
    
    cameraInput.onchange = (e) => handleArticleImagesUpload(e.target.files);
    fileInput.onchange = (e) => handleArticleImagesUpload(e.target.files);
    
    // Assembler la modal
    body.appendChild(uploadSection);
    body.appendChild(existingSection);
    body.appendChild(genericSection);
    
    modalContent.appendChild(header);
    modalContent.appendChild(body);
    modal.appendChild(modalContent);
    
    // Clic en dehors pour fermer
    modal.onclick = (e) => {
      if (e.target === modal) {
        closeArticleImagesModal();
      }
    };
    
    document.body.appendChild(modal);
    
    // Charger les images existantes de cet article
    loadArticleImages();
    
    // Charger les photos génériques du même type
    loadGenericArticleImages();
  };

  // Fermer la modal
  window.closeArticleImagesModal = function() {
    const modal = document.getElementById('article-images-modal');
    if (modal) {
      modal.remove();
      // Recharger la prévisualisation dans le formulaire
      refreshArticleImagesPreview();
    }
  };

  // Gérer l'upload des images d'article
  function handleArticleImagesUpload(files) {
    const gridContainer = document.getElementById('article-images-grid');
    
    Array.from(files).forEach(file => {
      if (!file.type.startsWith('image/')) {
        console.warn('Fichier ignoré (pas une image):', file.name);
        return;
      }
      
      // Créer une prévisualisation immédiate avec légende
      const reader = new FileReader();
      reader.onload = (e) => {
        addArticleImageCard(e.target.result, file.name, 'uploading');
      };
      reader.readAsDataURL(file);
      
      // Upload vers le serveur
      uploadArticleImage(file);
    });
  }

  // Upload une image vers le serveur
  async function uploadArticleImage(file) {
    console.log('📤 Upload image:', file.name);
    console.log('🎯 currentArticleTypeId:', currentArticleTypeId);
    
    if (!currentArticleTypeId) {
      alert('Veuillez d\'abord sélectionner un type d\'article');
      return;
    }

    const formData = new FormData();
    formData.append('image', file);
    formData.append('article_type_id', currentArticleTypeId);

    try {
      const response = await fetch('{{ route('admin.articles.upload-image') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
      });

      const data = await response.json();
      console.log('📡 Réponse serveur:', data);

      if (data.success) {
        console.log('✅ Image uploadée:', data.url);
        console.log('📦 Avant push, uploadedGameImages:', uploadedGameImages);
        
        // Mettre à jour la carte avec l'URL finale
        updateArticleImageCard(file.name, data.url);
        uploadedGameImages.push(data.url);
        
        // Si c'est la première image, la définir comme principale automatiquement
        if (!primaryImageUrl && uploadedGameImages.length === 1) {
          primaryImageUrl = data.url;
          console.log('⭐ Première image définie comme principale automatiquement');
        }
        
        console.log('📦 Après push, uploadedGameImages:', uploadedGameImages);
        
        // Rafraîchir l'aperçu dans le formulaire immédiatement
        refreshArticleImagesPreview();
      } else {
        console.error('Erreur upload:', data.message);
        alert('Erreur upload: ' + data.message);
      }
    } catch (e) {
      console.error('Erreur upload:', e);
      alert('Erreur lors de l\'upload');
    }
  }

  // Ajouter une carte d'image dans la modal
  function addArticleImageCard(imageSrc, fileName, status = 'uploaded') {
    const gridContainer = document.getElementById('article-images-grid');
    
    // Retirer le message "Aucune photo"
    if (gridContainer.querySelector('.col-span-full')) {
      gridContainer.innerHTML = '';
    }
    
    const card = document.createElement('div');
    card.className = 'border-2 border-gray-200 rounded-lg p-3 bg-white hover:border-indigo-400 transition-colors';
    card.dataset.fileName = fileName;
    
    const isPrimary = (primaryImageUrl === imageSrc);
    
    card.innerHTML = `
      <div class="relative group">
        <img src="${imageSrc}" class="w-full aspect-square object-cover rounded cursor-pointer hover:opacity-90" onclick="window.openImageLightbox('${imageSrc}')">
        
        ${isPrimary ? `
          <div class="absolute top-2 left-2 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white text-xs px-3 py-1.5 rounded-full font-bold shadow-lg flex items-center gap-1">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
            </svg>
            Photo principale
          </div>
        ` : ''}
        
        <div class="absolute top-2 right-2 flex gap-1">
          ${status === 'uploading' ? `
            <div class="bg-yellow-500 text-white text-xs px-2 py-1 rounded">⏳</div>
          ` : `
            <button type="button" onclick="setPrimaryImage('${imageSrc}', this)" 
                    class="${isPrimary ? 'bg-indigo-600 ring-2 ring-white' : 'bg-white/80 hover:bg-white'} ${isPrimary ? 'text-white' : 'text-gray-700'} px-2 py-1 rounded text-xs font-medium opacity-0 group-hover:opacity-100 transition-all shadow-md"
                    title="Définir comme photo principale">
              ${isPrimary ? '✓ Principale' : 'Définir principale'}
            </button>
            <button type="button" onclick="deleteArticleImage('${imageSrc}', this)" 
                    class="bg-red-500 text-white p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600 shadow-md">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
            </button>
          `}
        </div>
      </div>
      <input type="text" placeholder="Légende (ex: Face avant, Boîte...)" 
             class="w-full mt-2 text-sm border border-gray-300 rounded px-2 py-1" 
             data-image-url="${imageSrc}"
             onchange="updateArticleImageCaption('${imageSrc}', this.value)">
      <p class="text-xs text-gray-400 mt-1 truncate">${fileName}</p>
    `;
    
    gridContainer.appendChild(card);
    updateArticleImagesCount();
  }

  // Mettre à jour une carte après upload
  function updateArticleImageCard(fileName, finalUrl) {
    const card = Array.from(document.querySelectorAll('[data-file-name]')).find(
      el => el.dataset.fileName === fileName
    );
    
    if (card) {
      const img = card.querySelector('img');
      if (img) {
        img.src = finalUrl;
        img.setAttribute('onclick', `window.openImageLightbox('${finalUrl}')`);
      }
      
      const badge = card.querySelector('.bg-yellow-500');
      if (badge) {
        badge.outerHTML = `
          <button type="button" onclick="deleteArticleImage('${finalUrl}', this)" 
                  class="bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
          </button>
        `;
      }
      
      const input = card.querySelector('input');
      if (input) input.dataset.imageUrl = finalUrl;
    }
  }

  // Charger les images existantes
  async function loadArticleImages() {
    // TODO: Charger depuis la base les images déjà uploadées pour cet article
    // Pour l'instant, afficher celles en mémoire
    uploadedGameImages.forEach((url, index) => {
      addArticleImageCard(url, `Image ${index + 1}`, 'uploaded');
    });
  }

  // Charger les photos génériques du même type d'article
  async function loadGenericArticleImages() {
    if (!currentArticleTypeId) {
      const grid = document.getElementById('generic-images-grid');
      if (grid) {
        grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6">Sélectionnez d\'abord un type d\'article</div>';
      }
      return;
    }

    try {
      const response = await fetch(`{{ url('admin/ajax/article-type-images') }}/${currentArticleTypeId}`);
      const data = await response.json();
      
      const grid = document.getElementById('generic-images-grid');
      const countEl = document.getElementById('generic-images-count');
      
      if (!grid) return;
      
      grid.innerHTML = '';
      
      if (data.success && data.images && data.images.length > 0) {
        // Filtrer les images déjà utilisées dans cet article
        const availableImages = data.images.filter(url => !uploadedGameImages.includes(url));
        
        if (countEl) {
          countEl.textContent = `${availableImages.length} photo${availableImages.length > 1 ? 's' : ''} disponible${availableImages.length > 1 ? 's' : ''}`;
        }
        
        if (availableImages.length === 0) {
          grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6">Toutes les photos d\'autres articles sont déjà ajoutées</div>';
          return;
        }
        
        availableImages.forEach(url => {
          const card = document.createElement('div');
          card.className = 'relative group cursor-pointer border-2 border-gray-200 rounded-lg overflow-hidden hover:border-indigo-500 transition-all hover:shadow-lg';
          card.onclick = () => addGenericImageToArticle(url);
          
          card.innerHTML = `
            <div class="aspect-square bg-gray-100">
              <img src="${url}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='<div class=\\'w-full h-full flex items-center justify-center text-gray-400\\'>❌ Image introuvable</div>'">
            </div>
            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-40 transition-all flex items-center justify-center">
              <div class="opacity-0 group-hover:opacity-100 transition-opacity bg-white text-indigo-600 px-3 py-1.5 rounded-full font-medium text-sm">
                ➕ Ajouter
              </div>
            </div>
            <div class="absolute top-2 left-2 bg-indigo-600 bg-opacity-90 text-white text-xs px-2 py-1 rounded">
              📸 Autre article
            </div>
          `;
          
          grid.appendChild(card);
        });
      } else {
        if (countEl) countEl.textContent = 'Aucune photo';
        grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6">📭 Aucune photo d\'autres articles de ce type</div>';
      }
    } catch (e) {
      console.error('Erreur chargement photos génériques:', e);
      const grid = document.getElementById('generic-images-grid');
      if (grid) {
        grid.innerHTML = '<div class="col-span-full text-center text-red-400 py-6">❌ Erreur de chargement</div>';
      }
    }
  }

  // Ajouter une photo générique à l'article
  async function addGenericImageToArticle(imageUrl) {
    if (uploadedGameImages.includes(imageUrl)) {
      alert('Cette photo est déjà ajoutée');
      return;
    }
    
    console.log('➕ Ajout photo générique:', imageUrl);
    
    // Ajouter à la liste
    uploadedGameImages.push(imageUrl);
    
    // Si c'est la première image, la définir comme principale
    if (!primaryImageUrl) {
      primaryImageUrl = imageUrl;
      console.log('⭐ Photo générique définie comme principale automatiquement');
    }
    
    // Ajouter la carte dans la section "Photos de cet article"
    const fileName = imageUrl.split('/').pop();
    addArticleImageCard(imageUrl, fileName, 'uploaded');
    
    // Rafraîchir l'aperçu
    refreshArticleImagesPreview();
    
    // Recharger les photos génériques pour retirer celle qui vient d'être ajoutée
    loadGenericArticleImages();
    
    console.log('✅ Photo générique ajoutée');
  }

  // Supprimer une image
  window.deleteArticleImage = async function(imageUrl, buttonElement) {
    if (!confirm('Supprimer cette photo ?')) return;
    
    try {
      const response = await fetch('{{ route('admin.articles.delete-image') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          article_type_id: currentArticleTypeId,
          image_url: imageUrl
        })
      });

      const data = await response.json();

      if (data.success) {
        const card = buttonElement.closest('.border-2');
        if (card) card.remove();
        
        uploadedGameImages = uploadedGameImages.filter(url => url !== imageUrl);
        
        // Si on supprime l'image principale, redéfinir une autre comme principale
        if (primaryImageUrl === imageUrl) {
          primaryImageUrl = uploadedGameImages.length > 0 ? uploadedGameImages[0] : null;
          console.log('🔄 Nouvelle image principale:', primaryImageUrl);
        }
        
        updateArticleImagesCount();
        // Rafraîchir l'aperçu dans le formulaire
        refreshArticleImagesPreview();
        
        // Recharger les photos génériques (l'image supprimée redevient disponible)
        loadGenericArticleImages();
        
        // Si plus d'images, afficher le message
        const grid = document.getElementById('article-images-grid');
        if (grid && grid.children.length === 0) {
          grid.innerHTML = '<div class="col-span-full text-center text-gray-500 py-8">📭 Aucune photo pour le moment</div>';
        }
        
        console.log('✅ Image supprimée');
      } else {
        alert('Erreur: ' + data.message);
      }
    } catch (e) {
      console.error('Erreur suppression:', e);
      alert('Erreur lors de la suppression');
    }
  };

  // Mettre à jour la légende d'une image
  window.updateArticleImageCaption = async function(imageUrl, caption) {
    console.log('Mise à jour légende:', imageUrl, caption);
    // TODO: Enregistrer la légende dans la base
  };

  // Définir l'image principale
  window.setPrimaryImage = function(imageUrl, buttonElement) {
    console.log('🌟 Définir comme principale:', imageUrl);
    primaryImageUrl = imageUrl;
    
    // Rafraîchir toutes les cartes pour mettre à jour les badges
    const grid = document.getElementById('article-images-grid');
    if (grid) {
      // Récupérer toutes les images avec leurs légendes
      const images = Array.from(grid.querySelectorAll('.border-2')).map(card => {
        const img = card.querySelector('img');
        const captionInput = card.querySelector('input[type="text"]');
        const fileName = card.dataset.fileName;
        return {
          url: img.src,
          caption: captionInput?.value || '',
          fileName: fileName
        };
      });
      
      // Recréer toutes les cartes
      grid.innerHTML = '';
      images.forEach(img => {
        addArticleImageCard(img.url, img.fileName, 'uploaded');
        // Restaurer la légende
        const card = Array.from(grid.children).find(c => c.dataset.fileName === img.fileName);
        if (card && img.caption) {
          const input = card.querySelector('input[type="text"]');
          if (input) input.value = img.caption;
        }
      });
    }
    
    // Rafraîchir l'aperçu (l'image principale sera en premier)
    refreshArticleImagesPreview();
    
    console.log('✅ Image principale définie');
  };

  // Mettre à jour le compteur
  function updateArticleImagesCount() {
    const countEl = document.getElementById('article-images-count');
    const grid = document.getElementById('article-images-grid');
    if (countEl && grid) {
      const count = grid.querySelectorAll('.border-2.rounded-lg').length;
      countEl.textContent = count;
    }
  }

  // Rafraîchir la prévisualisation dans le formulaire
  function refreshArticleImagesPreview() {
    console.log('🔄 refreshArticleImagesPreview appelé');
    console.log('📦 uploadedGameImages:', uploadedGameImages);
    
    const previewContainer = document.getElementById('game-images-preview');
    console.log('📍 previewContainer:', previewContainer);
    
    if (!previewContainer) {
      console.error('❌ game-images-preview non trouvé');
      return;
    }
    
    // Vérifier si la section parent est visible
    const parentSection = document.getElementById('game_images_section');
    console.log('👁️ game_images_section display:', parentSection?.style.display);
    
    previewContainer.innerHTML = '';
    
    // Trier les images : image principale en premier
    const sortedImages = [...uploadedGameImages];
    if (primaryImageUrl && sortedImages.includes(primaryImageUrl)) {
      sortedImages.sort((a, b) => {
        if (a === primaryImageUrl) return -1;
        if (b === primaryImageUrl) return 1;
        return 0;
      });
    }
    
    sortedImages.slice(0, 4).forEach((url, index) => {
      console.log('➕ Ajout preview pour:', url);
      const preview = document.createElement('div');
      preview.className = 'relative group';
      
      const img = document.createElement('img');
      img.src = url;
      img.className = 'w-full aspect-square object-cover rounded border-2 border-gray-300 cursor-pointer hover:border-indigo-500';
      img.onclick = () => window.openImageLightbox(url);
      
      img.onload = () => console.log('✅ Image chargée:', url);
      img.onerror = (e) => console.error('❌ Erreur chargement image:', url, e);
      
      preview.appendChild(img);
      
      // Badge "Photo principale" sur l'image principale
      if (url === primaryImageUrl) {
        const badge = document.createElement('div');
        badge.className = 'absolute top-1 left-1 bg-indigo-600 text-white text-xs px-2 py-1 rounded font-bold shadow-lg';
        badge.innerHTML = `
          <svg class="w-3 h-3 inline-block mr-0.5" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
          </svg>
          Principale
        `;
        preview.appendChild(badge);
      }
      
      previewContainer.appendChild(preview);
      console.log('📝 Element ajouté au DOM');
    });
    
    console.log('📋 Contenu final de previewContainer, enfants:', previewContainer.children.length);
    
    if (uploadedGameImages.length > 4) {
      const more = document.createElement('div');
      more.className = 'flex items-center justify-center bg-gray-100 rounded border-2 border-gray-300 aspect-square text-gray-500 font-medium';
      more.textContent = `+${uploadedGameImages.length - 4}`;
      previewContainer.appendChild(more);
    }
    
    console.log('✅ Preview rafraîchi, total images:', uploadedGameImages.length);
  }

  // Basculer entre les sections d'images selon la catégorie
  if (typeSelect) {
    const updateImageSectionsVisibility = function() {
      const selectedCategory = document.getElementById('article_category_id');
      const categoryText = selectedCategory?.options[selectedCategory.selectedIndex]?.text || '';
      const romIdField = document.getElementById('rom_id_field');
      const yearField = document.getElementById('year_field');
      
      console.log('🔄 Mise à jour visibilité sections, catégorie:', categoryText);
      
      if (categoryText.includes('Jeux vidéo')) {
        console.log('✅ Affichage section jeux');
        gameImagesSection.style.display = 'block';
        genericImagesSection.style.display = 'none';
        if (romIdField) romIdField.style.display = 'block';
        if (yearField) yearField.style.display = 'block';
      } else {
        console.log('✅ Affichage section générique');
        gameImagesSection.style.display = 'none';
        genericImagesSection.style.display = 'block';
        if (romIdField) romIdField.style.display = 'none';
        if (yearField) yearField.style.display = 'none';
      }
    };
    
    typeSelect.addEventListener('change', updateImageSectionsVisibility);
    
    // Initialiser la visibilité au chargement si une catégorie est déjà sélectionnée
    const categorySelect = document.getElementById('article_category_id');
    if (categorySelect && categorySelect.value) {
      console.log('🎬 Initialisation visibilité au chargement');
      updateImageSectionsVisibility();
    }
  }

  // =====================================================
  // SOUMISSION DU FORMULAIRE - Remplir les champs cachés
  // =====================================================
  const form = document.querySelector('form[method="POST"]');
  if (form) {
    form.addEventListener('submit', function(e) {
      console.log('📤 Soumission du formulaire, préparation des images...');
      
      // Collecter les légendes depuis les inputs
      const captions = {};
      uploadedGameImages.forEach(url => {
        const card = document.querySelector(`[data-image-url="${url}"]`);
        if (card) {
          const captionInput = card.querySelector('input[placeholder*="légende"]');
          if (captionInput && captionInput.value.trim()) {
            captions[url] = captionInput.value.trim();
          }
        }
      });
      
      // Remplir les champs cachés
      document.getElementById('article_images_input').value = JSON.stringify(uploadedGameImages);
      document.getElementById('primary_image_url_input').value = primaryImageUrl || '';
      document.getElementById('image_captions_input').value = JSON.stringify(captions);
      
      console.log('✅ Champs cachés remplis:', {
        images: uploadedGameImages.length,
        primary: primaryImageUrl,
        captions: Object.keys(captions).length
      });
    });
  }

})();
</script>
@endsection
