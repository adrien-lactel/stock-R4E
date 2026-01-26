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

    {{-- =====================
         🎮 RECHERCHE PAR ROM ID
    ===================== --}}
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 border-2 border-blue-200 shadow-lg rounded-lg p-6 mb-6">
        <div class="flex items-start gap-4">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 bg-gradient-to-br from-blue-600 to-indigo-600 rounded-full flex items-center justify-center">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
            
            <div class="flex-grow">
                <h2 class="text-xl font-bold text-gray-900 mb-2">🎮 Recherche automatique par ROM ID</h2>
                <p class="text-gray-700 mb-4">
                    Saisissez le ROM ID de votre jeu vidéo (ex: DMG-APBJ-JPN) pour remplir automatiquement le formulaire avec les informations du jeu.
                </p>
                
                <!-- Saisie manuelle ROM ID -->
                <div class="p-4 bg-white border border-blue-200 rounded-lg">
                    <label for="manual-rom-id" class="block text-sm font-semibold text-blue-900 mb-2">
                        🎮 Saisie du ROM ID (jeux vidéo uniquement)
                    </label>
                    <div class="relative">
                        <input type="text" 
                               id="manual-rom-id" 
                               placeholder="Ex: DMG-APBJ-JPN ou CGB-BXTJ-USA"
                               class="w-full px-4 py-2 border border-blue-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 text-gray-900 font-mono uppercase"
                               autocomplete="off"
                               pattern="[A-Z]{3}-[A-Z0-9]{4}-[A-Z0-9]{1,3}"
                               maxlength="15">
                        
                        {{-- Dropdown suggestions d'autocomplétion --}}
                        <div id="rom-autocomplete-suggestions" class="hidden absolute z-50 mt-1 w-full bg-white border border-gray-300 rounded-md shadow-lg max-h-60 overflow-y-auto">
                        </div>
                    </div>
                    <p class="text-xs text-blue-700 mt-2">
                        💡 Tapez quelques lettres pour voir les suggestions (ex: DMG-A)
                    </p>
                    <button type="button" id="search-manual-rom" 
                            class="mt-3 w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-all flex items-center justify-center gap-2 disabled:opacity-50"
                            disabled>
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Rechercher ce ROM ID
                    </button>
                </div>
                
                <!-- Résultat de la recherche -->
                <div id="ai-result-top" class="hidden mt-4 p-4 bg-white border-2 border-green-300 rounded-lg shadow-md">
                    <h3 class="text-lg font-bold text-green-900 mb-3 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Jeu trouvé !
                    </h3>
                    <div id="ai-result-content-top"></div>
                    <button type="button" id="apply-ai-suggestions-top" 
                            class="mt-4 w-full px-6 py-3 bg-green-600 text-white text-lg font-bold rounded-lg hover:bg-green-700 shadow-md flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        Appliquer ces suggestions au formulaire
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- Éléments cachés pour compatibilité JavaScript --}}
    <input type="file" id="ai-file-input" accept="image/*" class="hidden">
    <div id="ai-drop-zone" class="hidden"></div>
    <div id="ai-preview" class="hidden"><img id="ai-preview-img"></div>
    <button type="button" id="ai-analyze-btn-top" class="hidden"></button>
    <button type="button" id="webcam-btn" class="hidden"></button>

    <!-- Modal Webcam (conservée pour compatibilité) -->
    <div id="webcam-modal" class="hidden fixed inset-0 bg-black bg-opacity-75 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-2xl max-w-2xl w-full">
            <div class="p-4 border-b border-gray-200 flex items-center justify-between">
                <h3 class="text-lg font-bold text-gray-900">📷 Capture photo avec webcam</h3>
                <button type="button" id="close-webcam" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <div class="p-6">
                <div class="relative bg-gray-900 rounded-lg overflow-hidden mb-4">
                    <video id="webcam-video" autoplay playsinline class="w-full max-h-96"></video>
                    <canvas id="webcam-canvas" class="hidden"></canvas>
                </div>
                
                <div id="webcam-captured" class="hidden mb-4">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Photo capturée :</p>
                    <img id="webcam-captured-img" class="w-full rounded-lg border-2 border-green-400">
                </div>
                
                <div class="flex gap-3">
                    <button type="button" id="capture-btn" 
                            class="flex-1 px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 font-semibold flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4 5a2 2 0 00-2 2v8a2 2 0 002 2h12a2 2 0 002-2V7a2 2 0 00-2-2h-1.586a1 1 0 01-.707-.293l-1.121-1.121A2 2 0 0011.172 3H8.828a2 2 0 00-1.414.586L6.293 4.707A1 1 0 015.586 5H4zm6 9a3 3 0 100-6 3 3 0 000 6z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Capturer</span>
                    </button>
                    <button type="button" id="retake-btn" 
                            class="hidden flex-1 px-6 py-3 bg-yellow-600 text-white rounded-lg hover:bg-yellow-700 font-semibold flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        <span>Reprendre</span>
                    </button>
                    <button type="button" id="use-webcam-photo" 
                            class="hidden flex-1 px-6 py-3 bg-purple-600 text-white rounded-lg hover:bg-purple-700 font-semibold flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Utiliser cette photo</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

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
                 RÉGION, COMPLÉTUDE & LANGUE
            ===================== --}}
            <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <div id="region_field">
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

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
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

                    <div id="publisher_field" style="display: none;">
                        <label class="block text-sm font-medium mb-1">Éditeur</label>
                        <select name="publisher" class="w-full rounded border-gray-300">
                            <option value="">— Aucun —</option>
                            <optgroup label="🎮 Éditeurs Principaux">
                                <option value="Nintendo" @selected(old('publisher', $console->publisher) === 'Nintendo')>Nintendo</option>
                                <option value="Sony" @selected(old('publisher', $console->publisher) === 'Sony')>Sony</option>
                                <option value="Microsoft" @selected(old('publisher', $console->publisher) === 'Microsoft')>Microsoft</option>
                                <option value="Sega" @selected(old('publisher', $console->publisher) === 'Sega')>Sega</option>
                            </optgroup>
                            <optgroup label="🇯🇵 Éditeurs Japonais">
                                <option value="Square Enix" @selected(old('publisher', $console->publisher) === 'Square Enix')>Square Enix</option>
                                <option value="Capcom" @selected(old('publisher', $console->publisher) === 'Capcom')>Capcom</option>
                                <option value="Konami" @selected(old('publisher', $console->publisher) === 'Konami')>Konami</option>
                                <option value="Bandai Namco" @selected(old('publisher', $console->publisher) === 'Bandai Namco')>Bandai Namco</option>
                                <option value="Atlus" @selected(old('publisher', $console->publisher) === 'Atlus')>Atlus</option>
                                <option value="FromSoftware" @selected(old('publisher', $console->publisher) === 'FromSoftware')>FromSoftware</option>
                                <option value="Game Freak" @selected(old('publisher', $console->publisher) === 'Game Freak')>Game Freak</option>
                            </optgroup>
                            <optgroup label="🌍 Éditeurs Occidentaux">
                                <option value="Electronic Arts" @selected(old('publisher', $console->publisher) === 'Electronic Arts')>Electronic Arts</option>
                                <option value="Activision" @selected(old('publisher', $console->publisher) === 'Activision')>Activision</option>
                                <option value="Ubisoft" @selected(old('publisher', $console->publisher) === 'Ubisoft')>Ubisoft</option>
                                <option value="Rockstar Games" @selected(old('publisher', $console->publisher) === 'Rockstar Games')>Rockstar Games</option>
                                <option value="Bethesda" @selected(old('publisher', $console->publisher) === 'Bethesda')>Bethesda</option>
                                <option value="2K Games" @selected(old('publisher', $console->publisher) === '2K Games')>2K Games</option>
                            </optgroup>
                            <optgroup label="🎨 Autres">
                                <option value="THQ" @selected(old('publisher', $console->publisher) === 'THQ')>THQ</option>
                                <option value="SNK" @selected(old('publisher', $console->publisher) === 'SNK')>SNK</option>
                                <option value="Arc System Works" @selected(old('publisher', $console->publisher) === 'Arc System Works')>Arc System Works</option>
                                <option value="Autre" @selected(old('publisher', $console->publisher) === 'Autre')>Autre</option>
                            </optgroup>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Éditeur du jeu vidéo</p>
                    </div>
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
                    
                    <!-- Pour les jeux vidéo : deux types d'images -->
                    <div id="game_images_section" style="display: none;">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Photo du jeu (cartouche/boîte) -->
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-blue-900">🎮 Photo du jeu (cartouche/boîte)</label>
                                <div id="cover-dropzone"
                                     class="border-2 border-dashed border-blue-300 rounded-lg p-6 text-center cursor-pointer hover:border-blue-500 transition-colors bg-blue-50">
                                    <svg class="w-10 h-10 text-blue-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <p class="text-sm text-blue-700 font-medium">📱 Cliquez pour prendre une photo</p>
                                    <p class="text-xs text-blue-600 mt-1">Photo de la cartouche ou de la boîte</p>
                                </div>
                                <input type="file" id="cover-input" accept="image/*" capture="environment" class="hidden">
                                <div id="cover-preview" class="mt-3"></div>
                            </div>

                            <!-- Image du gameplay -->
                            <div>
                                <label class="block text-sm font-semibold mb-2 text-purple-900">🕹️ Screenshot gameplay</label>
                                <div id="gameplay-dropzone"
                                     class="border-2 border-dashed border-purple-300 rounded-lg p-6 text-center cursor-pointer hover:border-purple-500 transition-colors bg-purple-50">
                                    <svg class="w-10 h-10 text-purple-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <p class="text-sm text-purple-700 font-medium">📱 Cliquez pour prendre une photo</p>
                                    <p class="text-xs text-purple-600 mt-1">Capture d'écran du jeu en action</p>
                                </div>
                                <input type="file" id="gameplay-input" accept="image/*" capture="environment" class="hidden">
                                <div id="gameplay-preview" class="mt-3"></div>
                            </div>
                        </div>
                        <p class="text-xs text-gray-500 italic">
                            💡 Ces images sont partagées entre tous les articles du même jeu. Elles seront automatiquement chargées pour les prochains articles de ce type.
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
})();

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
    const div = document.createElement('div');
    div.className = 'relative group';
    
    div.innerHTML = `
      <img src="${url}" class="w-full h-32 object-cover rounded-lg border border-gray-200">
      <button type="button" 
              class="absolute top-2 right-2 bg-red-500 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600"
              onclick="deleteImage('${url}', ${typeId}, this.parentElement)">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
      </button>
      ${isExisting ? '<span class="absolute bottom-2 left-2 bg-blue-500 text-white text-xs px-2 py-1 rounded">Taxonomie</span>' : ''}
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
  // GESTION DES IMAGES SPÉCIFIQUES AUX JEUX (COVER + GAMEPLAY)
  // ========================================
  const gameImagesSection = document.getElementById('game_images_section');
  const genericImagesSection = document.getElementById('generic_images_section');
  const coverDropzone = document.getElementById('cover-dropzone');
  const gameplayDropzone = document.getElementById('gameplay-dropzone');
  const coverInput = document.getElementById('cover-input');
  const gameplayInput = document.getElementById('gameplay-input');
  const coverPreview = document.getElementById('cover-preview');
  const gameplayPreview = document.getElementById('gameplay-preview');

  let currentCoverImage = null;
  let currentGameplayImage = null;

  // Basculer entre les sections d'images selon la catégorie
  if (typeSelect) {
    typeSelect.addEventListener('change', function() {
      const selectedCategory = document.getElementById('article_category_id');
      const categoryText = selectedCategory?.options[selectedCategory.selectedIndex]?.text || '';
      const romIdField = document.getElementById('rom_id_field');
      const yearField = document.getElementById('year_field');
      
      if (categoryText.includes('Jeux vidéo')) {
        gameImagesSection.style.display = 'block';
        genericImagesSection.style.display = 'none';
        if (romIdField) romIdField.style.display = 'block';
        if (yearField) yearField.style.display = 'block';
        // Charger les images existantes du type
        if (this.value) {
          loadGameTypeImages(this.value);
        }
      } else {
        gameImagesSection.style.display = 'none';
        genericImagesSection.style.display = 'block';
        if (romIdField) romIdField.style.display = 'none';
        if (yearField) yearField.style.display = 'none';
      }
    });
  }

  // Charger les images existantes du type de jeu
  async function loadGameTypeImages(typeId) {
    try {
      const response = await fetch(`{{ url('admin/ajax/type-description') }}/${typeId}`);
      const data = await response.json();
      
      if (data.cover_image) {
        displayGameImage('cover', data.cover_image);
        currentCoverImage = data.cover_image;
      }
      if (data.gameplay_image) {
        displayGameImage('gameplay', data.gameplay_image);
        currentGameplayImage = data.gameplay_image;
      }
    } catch (e) {
      console.error('Erreur chargement images du jeu:', e);
    }
  }

  // Afficher une image de jeu
  function displayGameImage(type, url) {
    const container = type === 'cover' ? coverPreview : gameplayPreview;
    container.innerHTML = `
      <div class="relative group">
        <img src="${url}" class="w-full h-48 object-cover rounded-lg border-2 border-gray-300">
        <button type="button" 
                class="absolute top-2 right-2 bg-red-500 text-white p-2 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600"
                onclick="deleteGameImage('${type}', ${currentArticleTypeId})">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
        <span class="absolute bottom-2 left-2 bg-green-500 text-white text-xs px-2 py-1 rounded font-semibold">
          ${type === 'cover' ? '🎮 Photo du jeu' : '🕹️ Gameplay'}
        </span>
      </div>
    `;
  }

  // Upload d'image cover
  if (coverDropzone && coverInput) {
    coverDropzone.addEventListener('click', () => coverInput.click());
    
    coverDropzone.addEventListener('dragover', (e) => {
      e.preventDefault();
      coverDropzone.classList.add('border-blue-500', 'bg-blue-100');
    });
    
    coverDropzone.addEventListener('dragleave', () => {
      coverDropzone.classList.remove('border-blue-500', 'bg-blue-100');
    });
    
    coverDropzone.addEventListener('drop', (e) => {
      e.preventDefault();
      coverDropzone.classList.remove('border-blue-500', 'bg-blue-100');
      if (e.dataTransfer.files.length > 0) {
        uploadGameImage('cover', e.dataTransfer.files[0]);
      }
    });
    
    coverInput.addEventListener('change', (e) => {
      if (e.target.files.length > 0) {
        uploadGameImage('cover', e.target.files[0]);
      }
    });
  }

  // Upload d'image gameplay
  if (gameplayDropzone && gameplayInput) {
    gameplayDropzone.addEventListener('click', () => gameplayInput.click());
    
    gameplayDropzone.addEventListener('dragover', (e) => {
      e.preventDefault();
      gameplayDropzone.classList.add('border-purple-500', 'bg-purple-100');
    });
    
    gameplayDropzone.addEventListener('dragleave', () => {
      gameplayDropzone.classList.remove('border-purple-500', 'bg-purple-100');
    });
    
    gameplayDropzone.addEventListener('drop', (e) => {
      e.preventDefault();
      gameplayDropzone.classList.remove('border-purple-500', 'bg-purple-100');
      if (e.dataTransfer.files.length > 0) {
        uploadGameImage('gameplay', e.dataTransfer.files[0]);
      }
    });
    
    gameplayInput.addEventListener('change', (e) => {
      if (e.target.files.length > 0) {
        uploadGameImage('gameplay', e.target.files[0]);
      }
    });
  }

  // Upload une image de jeu (cover ou gameplay)
  async function uploadGameImage(type, file) {
    if (!currentArticleTypeId) {
      alert('Veuillez d\'abord sélectionner un type de jeu');
      return;
    }

    if (!file.type.startsWith('image/')) {
      alert('Le fichier doit être une image');
      return;
    }

    const formData = new FormData();
    formData.append('image', file);
    formData.append('article_type_id', currentArticleTypeId);
    formData.append('image_type', type); // 'cover' ou 'gameplay'

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
        displayGameImage(type, data.url);
        if (type === 'cover') {
          currentCoverImage = data.url;
        } else {
          currentGameplayImage = data.url;
        }
        alert(`✅ Image ${type === 'cover' ? 'de la cartouche' : 'du gameplay'} enregistrée !`);
      } else {
        alert('Erreur upload: ' + data.message);
      }
    } catch (e) {
      console.error('Erreur upload:', e);
      alert('Erreur lors de l\'upload');
    }
  }

  // Supprimer une image de jeu
  window.deleteGameImage = async function(type, typeId) {
    if (!confirm(`Supprimer cette image ${type === 'cover' ? 'du jeu' : 'du gameplay'} ?`)) return;

    try {
      const response = await fetch('{{ route('admin.articles.delete-image') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          article_type_id: typeId,
          image_type: type
        })
      });

      const data = await response.json();

      if (data.success) {
        const container = type === 'cover' ? coverPreview : gameplayPreview;
        container.innerHTML = '';
        if (type === 'cover') {
          currentCoverImage = null;
        } else {
          currentGameplayImage = null;
        }
        alert('✅ Image supprimée');
      } else {
        alert('Erreur: ' + data.message);
      }
    } catch (e) {
      console.error('Erreur suppression:', e);
      alert('Erreur lors de la suppression');
    }
  };

  // ========================================
  // ANALYSE IA (GOOGLE CLOUD VISION) - SECTION EN HAUT
  // ========================================
  const aiFileInput = document.getElementById('ai-file-input');
  const aiDropZone = document.getElementById('ai-drop-zone');
  const aiAnalyzeBtnTop = document.getElementById('ai-analyze-btn-top');
  const aiResultTop = document.getElementById('ai-result-top');
  const aiResultContentTop = document.getElementById('ai-result-content-top');
  const applyAiSuggestionsTop = document.getElementById('apply-ai-suggestions-top');
  const aiPreview = document.getElementById('ai-preview');
  const aiPreviewImg = document.getElementById('ai-preview-img');
  
  let currentAiSuggestions = null;
  let uploadedImageForAI = null;

  function updatePublisherDisplay(publisher) {
    const publisherCard = document.getElementById('ai-publisher-card');
    const publisherDisplay = document.getElementById('ai-publisher-display');
    if (!publisherCard || !publisherDisplay) return;
    if (publisher && publisher.trim()) {
      publisherDisplay.textContent = publisher;
      publisherCard.classList.remove('hidden');
    } else {
      publisherDisplay.textContent = '';
      publisherCard.classList.add('hidden');
    }
  }

  // Fonction pour mettre à jour le nom du jeu
  window.updateGameName = function() {
    const nameInput = document.getElementById('ai-game-name-edit');
    if (nameInput && currentAiSuggestions) {
      currentAiSuggestions.name = nameInput.value.trim();
      currentAiSuggestions.type = nameInput.value.trim(); // Mettre à jour aussi le type
      
      // Animation de confirmation
      nameInput.classList.add('ring-2', 'ring-green-500');
      setTimeout(() => {
        nameInput.classList.remove('ring-2', 'ring-green-500');
      }, 1000);
      
      alert('✅ Nom du jeu mis à jour : ' + currentAiSuggestions.name);
    }
  };

  // Fonction pour rechercher un jeu par ROM ID
  window.lookupRomId = async function() {
    const romIdInput = document.getElementById('ai-rom-id-edit');
    const nameEditInput = document.getElementById('ai-game-name-edit');
    
    if (!romIdInput) return;
    
    const romId = romIdInput.value.trim().toUpperCase();
    if (!romId) {
      alert('⚠️ Veuillez entrer un ROM ID');
      return;
    }
    
    // Normaliser le ROM ID (espaces → tirets)
    const normalizedRomId = romId.replace(/\s+/g, '-');
    romIdInput.value = normalizedRomId;
    
    console.log('🔍 Recherche ROM ID:', normalizedRomId);
    
    try {
      // Animation de recherche
      romIdInput.classList.add('animate-pulse', 'bg-blue-50');
      
      const url = `{{ url('/admin/ajax/lookup-rom-id') }}/${encodeURIComponent(normalizedRomId)}`;
      console.log('📡 URL:', url);
      
      const response = await fetch(url, {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });
      
      console.log('📥 Response status:', response.status);
      console.log('📥 Response headers:', [...response.headers.entries()]);
      
      if (!response.ok) {
        const errorText = await response.text();
        console.error('❌ Erreur HTTP:', errorText);
        throw new Error(`HTTP ${response.status}: ${response.statusText}`);
      }
      
      const contentType = response.headers.get('content-type');
      console.log('📦 Content-Type:', contentType);
      
      if (!contentType || !contentType.includes('application/json')) {
        const text = await response.text();
        console.error('❌ Réponse non-JSON:', text);
        throw new Error('Le serveur a renvoyé du HTML au lieu de JSON');
      }
      
      const data = await response.json();
      console.log('✅ Data reçue:', data);
      
      romIdInput.classList.remove('animate-pulse', 'bg-blue-50');
      
      if (data.success && data.game) {
        // Mettre à jour le champ ROM ID de l'article
        const romIdField = document.getElementById('rom_id');
        if (romIdField) {
          romIdField.value = normalizedRomId;
        }
        
        // Mettre à jour les suggestions
        if (currentAiSuggestions) {
          currentAiSuggestions.rom_id = normalizedRomId;
          currentAiSuggestions.name = data.game.name;
          currentAiSuggestions.type = data.game.name;
          currentAiSuggestions.type_to_create = !data.type_exists;
          if (data.game.publisher) {
            currentAiSuggestions.publisher = data.game.publisher;
          }
          updatePublisherDisplay(currentAiSuggestions.publisher || '');
          
          // Mettre à jour la sous-catégorie si détectée
          if (data.sub_category) {
            currentAiSuggestions.sub_category = data.sub_category;
          }
          
          // Mettre à jour la région si détectée
          if (data.region) {
            currentAiSuggestions.region = data.region;
          }
          
          // Mettre à jour l'année si détectée
          if (data.game.year) {
            currentAiSuggestions.year = data.game.year;
          }
        }
        
        // Mettre à jour le champ nom si présent
        if (nameEditInput) {
          nameEditInput.value = data.game.name;
          nameEditInput.classList.add('ring-2', 'ring-green-500');
          setTimeout(() => {
            nameEditInput.classList.remove('ring-2', 'ring-green-500');
          }, 1500);
        }
        
        // Confirmation visuelle
        romIdInput.classList.add('ring-2', 'ring-green-500');
        setTimeout(() => {
          romIdInput.classList.remove('ring-2', 'ring-green-500');
        }, 1500);
        
        alert(`✅ Jeu trouvé !\n\nNom: ${data.game.name}\nROM ID: ${normalizedRomId}`);
      } else {
        // Jeu non trouvé, mais on peut quand même utiliser le ROM ID
        if (currentAiSuggestions) {
          currentAiSuggestions.rom_id = normalizedRomId;
          
          // Déterminer la sous-catégorie selon le préfixe
          if (normalizedRomId.startsWith('DMG-')) {
            currentAiSuggestions.sub_category = 'Game Boy';
          } else if (normalizedRomId.startsWith('CGB-')) {
            currentAiSuggestions.sub_category = 'Game Boy Color';
          } else if (normalizedRomId.startsWith('AGB-')) {
            currentAiSuggestions.sub_category = 'Game Boy Advance';
          }
        }
        
        romIdInput.classList.add('ring-2', 'ring-yellow-500');
        setTimeout(() => {
          romIdInput.classList.remove('ring-2', 'ring-yellow-500');
        }, 1500);
        
        const gameName = prompt(`⚠️ ROM ID "${normalizedRomId}" non trouvé dans la base.\n\nVoulez-vous entrer le nom du jeu manuellement ?`, '');
        
        if (gameName && gameName.trim()) {
          if (currentAiSuggestions) {
            currentAiSuggestions.name = gameName.trim();
            currentAiSuggestions.type = gameName.trim();
            currentAiSuggestions.type_to_create = true;
            const manualPublisher = prompt('Quel est l\'éditeur de ce jeu ?', currentAiSuggestions.publisher || '');
            if (manualPublisher && manualPublisher.trim()) {
              currentAiSuggestions.publisher = manualPublisher.trim();
            }
            updatePublisherDisplay(currentAiSuggestions.publisher || '');
          }
          
          if (nameEditInput) {
            nameEditInput.value = gameName.trim();
            nameEditInput.classList.add('ring-2', 'ring-green-500');
            setTimeout(() => {
              nameEditInput.classList.remove('ring-2', 'ring-green-500');
            }, 1500);
          }
          
          alert(`✅ ROM ID mis à jour !\n\nROM ID: ${normalizedRomId}\nNom: ${gameName.trim()}\n\n💡 Le type sera créé automatiquement lors de l'application des suggestions.`);
        }
      }
    } catch (error) {
      romIdInput.classList.remove('animate-pulse', 'bg-blue-50');
      romIdInput.classList.add('ring-2', 'ring-red-500');
      setTimeout(() => {
        romIdInput.classList.remove('ring-2', 'ring-red-500');
      }, 1500);
      
      console.error('❌ Erreur complète:', error);
      console.error('❌ Stack trace:', error.stack);
      alert(`❌ Erreur lors de la recherche du jeu\n\n${error.message}\n\nVoir la console (F12) pour plus de détails`);
    }
  };

  // ========================================
  // SAISIE MANUELLE DU ROM ID
  // ========================================
  const manualRomInput = document.getElementById('manual-rom-id');
  const manualRomButton = document.getElementById('search-manual-rom');
  const romAutocompleteSuggestions = document.getElementById('rom-autocomplete-suggestions');

  if (manualRomInput && manualRomButton) {
    const toggleManualRomButton = () => {
      manualRomButton.disabled = manualRomInput.value.trim().length < 5;
    };

    toggleManualRomButton();

    // ========================================
    // AUTOCOMPLETE - Suggestions en temps réel
    // ========================================
    let autocompleteDebounceTimer;

    manualRomInput.addEventListener('input', function() {
      const value = this.value.trim().toUpperCase();
      toggleManualRomButton();

      // Clear previous timer
      clearTimeout(autocompleteDebounceTimer);

      // Hide suggestions if input is too short
      if (value.length < 2) {
        if (romAutocompleteSuggestions) {
          romAutocompleteSuggestions.classList.add('hidden');
          romAutocompleteSuggestions.innerHTML = '';
        }
        return;
      }

      // Debounce API call (300ms)
      autocompleteDebounceTimer = setTimeout(async () => {
        try {
          const response = await fetch('{{ route("admin.product-sheets.autocomplete-rom") }}?q=' + encodeURIComponent(value));
          const suggestions = await response.json();

          if (suggestions.length > 0 && romAutocompleteSuggestions) {
            romAutocompleteSuggestions.innerHTML = suggestions.map(s => {
              const imageHtml = s.image_url 
                ? '<img src="' + s.image_url + '" class="w-12 h-12 object-cover rounded" alt="' + s.name + '">'
                : '<div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">📀</div>';
              
              return '<div class="px-4 py-2 hover:bg-blue-50 cursor-pointer border-b border-gray-100 last:border-0 flex items-center gap-3"' +
                     ' data-rom-id="' + s.rom_id + '"' +
                     ' data-name="' + s.name + '"' +
                     ' data-year="' + (s.year || '') + '">' +
                     imageHtml +
                     '<div class="flex-1">' +
                     '<div class="font-medium text-sm text-gray-900 font-mono">' + s.rom_id + '</div>' +
                     '<div class="text-xs text-gray-600">' + s.name + '</div>' +
                     (s.year ? '<div class="text-xs text-gray-500">📅 ' + s.year + '</div>' : '') +
                     '</div>' +
                     '</div>';
            }).join('');
            romAutocompleteSuggestions.classList.remove('hidden');

            // Add click handlers to suggestions
            romAutocompleteSuggestions.querySelectorAll('[data-rom-id]').forEach(item => {
              item.addEventListener('click', function() {
                manualRomInput.value = this.dataset.romId;
                romAutocompleteSuggestions.classList.add('hidden');
                romAutocompleteSuggestions.innerHTML = '';
                toggleManualRomButton();
                manualRomButton.click(); // Auto-trigger lookup
              });
            });
          } else if (romAutocompleteSuggestions) {
            romAutocompleteSuggestions.classList.add('hidden');
            romAutocompleteSuggestions.innerHTML = '';
          }
        } catch (error) {
          console.error('Autocomplete error:', error);
        }
      }, 300);
    });

    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
      if (romAutocompleteSuggestions && !manualRomInput.contains(e.target) && !romAutocompleteSuggestions.contains(e.target)) {
        romAutocompleteSuggestions.classList.add('hidden');
      }
    });

    manualRomInput.addEventListener('keydown', (event) => {
      if (event.key === 'Enter') {
        event.preventDefault();
        if (romAutocompleteSuggestions) {
          romAutocompleteSuggestions.classList.add('hidden');
        }
        searchManualRomId();
      } else if (event.key === 'Escape') {
        if (romAutocompleteSuggestions) {
          romAutocompleteSuggestions.classList.add('hidden');
        }
      }
    });

    manualRomButton.addEventListener('click', (event) => {
      event.preventDefault();
      searchManualRomId();
    });
  }

  function guessSubCategoryFromRomId(romId) {
    if (!romId) return null;
    if (romId.startsWith('DMG-')) return 'Game Boy';
    if (romId.startsWith('CGB-')) return 'Game Boy Color';
    if (romId.startsWith('AGB-')) return 'Game Boy Advance';
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
    if (romId.startsWith('DMG-') || romId.startsWith('CGB-') || romId.startsWith('AGB-')) {
      return 'Nintendo';
    }
    return null;
  }

  async function searchManualRomId() {
    if (!manualRomInput || !manualRomButton) return;

    const romId = manualRomInput.value.trim().toUpperCase();
    if (!romId) {
      alert('⚠️ Veuillez saisir un ROM ID.');
      manualRomInput.focus();
      return;
    }

    const normalizedRomId = romId.replace(/\s+/g, '-');
    manualRomInput.value = normalizedRomId;

    const originalButtonHtml = manualRomButton.innerHTML;
    manualRomButton.disabled = true;
    manualRomButton.innerHTML = '<svg class="w-4 h-4 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span> Recherche...</span>';
    manualRomInput.classList.add('animate-pulse', 'bg-blue-50');

    try {
      const url = `{{ url('/admin/ajax/lookup-rom-id') }}/${encodeURIComponent(normalizedRomId)}`;
      const response = await fetch(url, {
        method: 'GET',
        headers: {
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        }
      });

      if (!response.ok) {
        const errorText = await response.text();
        throw new Error(errorText || `HTTP ${response.status}`);
      }

      const data = await response.json();

      const inferredBrand = guessBrandFromRomId(normalizedRomId) || 'Nintendo';

      let suggestions = {
        category: 'Jeux vidéo',
        brand: inferredBrand,
        rom_id: normalizedRomId,
        sub_category: data.sub_category || guessSubCategoryFromRomId(normalizedRomId),
        region: data.region || guessRegionFromRomId(normalizedRomId),
        completeness: 'Loose',
        publisher: (data.game && data.game.publisher)
          ? data.game.publisher
          : inferredBrand,
      };

      if (data.success && data.game) {
        suggestions = {
          ...suggestions,
          name: data.game.name,
          type: data.game.name,
          type_to_create: !data.type_exists,
          publisher: data.game.publisher || suggestions.publisher,
          brand: inferredBrand || suggestions.brand,
          region: data.region || suggestions.region,
          year: data.game.year || null,
        };
      } else {
        const manualName = prompt(`ROM ID "${normalizedRomId}" non trouvé. Souhaitez-vous saisir le nom du jeu ?`, '');
        if (manualName && manualName.trim()) {
          suggestions.name = manualName.trim();
          suggestions.type = manualName.trim();
          suggestions.type_to_create = true;
          const manualPublisher = prompt('Quel est l\'éditeur de ce jeu ?', suggestions.publisher || '');
          if (manualPublisher && manualPublisher.trim()) {
            suggestions.publisher = manualPublisher.trim();
          }
          const manualBrand = prompt('Sur quelle console/marque se joue ce titre ?', suggestions.brand || inferredBrand || 'Nintendo');
          if (manualBrand && manualBrand.trim()) {
            suggestions.brand = manualBrand.trim();
          }
        }
      }

      currentAiSuggestions = suggestions;

      // Afficher le publisher dans l'UI
      updatePublisherDisplay(suggestions.publisher || '');

      const manualPayload = {
        success: true,
        suggestions,
        texts: [normalizedRomId],
        text: [normalizedRomId],
        raw_text: [`Saisi manuellement: ${normalizedRomId}`],
        labels: (data.success && data.game && data.game.name)
          ? [{ description: data.game.name, score: 0.99 }]
          : [],
        source: 'manual-rom'
      };

      displayAIResultsTop(manualPayload);
      aiResultTop.classList.remove('hidden');
      aiResultTop.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    } catch (error) {
      console.error('Erreur recherche ROM manuel:', error);
      alert(`❌ Erreur lors de la recherche du ROM ID:\n${error.message}`);
    } finally {
      manualRomInput.classList.remove('animate-pulse', 'bg-blue-50');
      manualRomButton.disabled = false;
      manualRomButton.innerHTML = originalButtonHtml;
    }
  }

  // ========================================
  // WEBCAM
  // ========================================
  const webcamBtn = document.getElementById('webcam-btn');
  const webcamModal = document.getElementById('webcam-modal');
  const closeWebcamBtn = document.getElementById('close-webcam');
  const webcamVideo = document.getElementById('webcam-video');
  const webcamCanvas = document.getElementById('webcam-canvas');
  const captureBtn = document.getElementById('capture-btn');
  const retakeBtn = document.getElementById('retake-btn');
  const useWebcamPhotoBtn = document.getElementById('use-webcam-photo');
  const webcamCaptured = document.getElementById('webcam-captured');
  const webcamCapturedImg = document.getElementById('webcam-captured-img');

  let webcamStream = null;
  let capturedBlob = null;

  // Ouvrir la webcam
  webcamBtn.addEventListener('click', async () => {
    try {
      webcamStream = await navigator.mediaDevices.getUserMedia({ 
        video: { 
          width: { ideal: 1280 },
          height: { ideal: 720 },
          facingMode: 'environment' // Caméra arrière sur mobile
        } 
      });
      
      webcamVideo.srcObject = webcamStream;
      webcamModal.classList.remove('hidden');
      
      // Reset l'état
      webcamCaptured.classList.add('hidden');
      captureBtn.classList.remove('hidden');
      retakeBtn.classList.add('hidden');
      useWebcamPhotoBtn.classList.add('hidden');
      webcamVideo.classList.remove('hidden');
      
    } catch (error) {
      console.error('Erreur webcam:', error);
      if (error.name === 'NotAllowedError') {
        alert('❌ Accès à la webcam refusé. Veuillez autoriser l\'accès à la caméra dans les paramètres de votre navigateur.');
      } else if (error.name === 'NotFoundError') {
        alert('❌ Aucune webcam détectée sur cet appareil.');
      } else {
        alert('❌ Erreur lors de l\'accès à la webcam: ' + error.message);
      }
    }
  });

  // Fermer la webcam
  closeWebcamBtn.addEventListener('click', () => {
    stopWebcam();
    webcamModal.classList.add('hidden');
  });

  // Fermer en cliquant en dehors
  webcamModal.addEventListener('click', (e) => {
    if (e.target === webcamModal) {
      stopWebcam();
      webcamModal.classList.add('hidden');
    }
  });

  // Capturer la photo
  captureBtn.addEventListener('click', () => {
    // Configurer le canvas aux dimensions de la vidéo
    webcamCanvas.width = webcamVideo.videoWidth;
    webcamCanvas.height = webcamVideo.videoHeight;
    
    // Dessiner l'image de la vidéo sur le canvas
    const ctx = webcamCanvas.getContext('2d');
    ctx.drawImage(webcamVideo, 0, 0);
    
    // Convertir en blob
    webcamCanvas.toBlob((blob) => {
      capturedBlob = blob;
      
      // Afficher la prévisualisation
      const url = URL.createObjectURL(blob);
      webcamCapturedImg.src = url;
      
      // Afficher les bons éléments
      webcamCaptured.classList.remove('hidden');
      webcamVideo.classList.add('hidden');
      captureBtn.classList.add('hidden');
      retakeBtn.classList.remove('hidden');
      useWebcamPhotoBtn.classList.remove('hidden');
    }, 'image/jpeg', 0.95);
  });

  // Reprendre une photo
  retakeBtn.addEventListener('click', () => {
    webcamCaptured.classList.add('hidden');
    webcamVideo.classList.remove('hidden');
    captureBtn.classList.remove('hidden');
    retakeBtn.classList.add('hidden');
    useWebcamPhotoBtn.classList.add('hidden');
    capturedBlob = null;
  });

  // Utiliser la photo capturée
  useWebcamPhotoBtn.addEventListener('click', () => {
    if (capturedBlob) {
      // Créer un fichier à partir du blob
      const file = new File([capturedBlob], 'webcam-capture.jpg', { type: 'image/jpeg' });
      handleAIImageUpload(file);
      
      // Fermer la modal
      stopWebcam();
      webcamModal.classList.add('hidden');
    }
  });

  // Arrêter la webcam
  function stopWebcam() {
    if (webcamStream) {
      webcamStream.getTracks().forEach(track => track.stop());
      webcamStream = null;
    }
  }

  // Click sur la zone de drop
  aiDropZone.addEventListener('click', () => {
    aiFileInput.click();
  });

  // Drag & drop
  aiDropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    aiDropZone.classList.add('border-purple-500', 'bg-purple-100');
  });

  aiDropZone.addEventListener('dragleave', () => {
    aiDropZone.classList.remove('border-purple-500', 'bg-purple-100');
  });

  aiDropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    aiDropZone.classList.remove('border-purple-500', 'bg-purple-100');
    
    const files = e.dataTransfer.files;
    if (files.length > 0) {
      handleAIImageUpload(files[0]);
    }
  });

  // Sélection de fichier
  aiFileInput.addEventListener('change', () => {
    if (aiFileInput.files.length > 0) {
      handleAIImageUpload(aiFileInput.files[0]);
    }
  });

  // Gérer l'upload de l'image pour l'IA
  function handleAIImageUpload(file) {
    uploadedImageForAI = file;
    
    // Prévisualiser l'image
    const reader = new FileReader();
    reader.onload = (e) => {
      aiPreviewImg.src = e.target.result;
      aiPreview.classList.remove('hidden');
    };
    reader.readAsDataURL(file);
    
    // Activer le bouton d'analyse
    aiAnalyzeBtnTop.disabled = false;
    aiResultTop.classList.add('hidden');
  }

  // Bouton d'analyse IA
  aiAnalyzeBtnTop.addEventListener('click', async () => {
    if (!uploadedImageForAI) {
      alert('Veuillez d\'abord ajouter une image');
      return;
    }

    aiAnalyzeBtnTop.disabled = true;
    aiAnalyzeBtnTop.innerHTML = '<svg class="w-6 h-6 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span>Analyse en cours...</span>';
    aiResultTop.classList.add('hidden');

    try {
      // Convertir l'image en base64
      const reader = new FileReader();
      const base64Promise = new Promise((resolve, reject) => {
        reader.onload = () => resolve(reader.result);
        reader.onerror = reject;
        reader.readAsDataURL(uploadedImageForAI);
      });

      const base64Image = await base64Promise;

      const response = await fetch('{{ route('admin.articles.analyze-image') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          image_base64: base64Image
        })
      });

      // Vérifier si la réponse est OK
      if (!response.ok) {
        const errorText = await response.text();
        console.error('Response error:', errorText);
        throw new Error(`Erreur HTTP ${response.status}: ${response.statusText}`);
      }

      // Vérifier le content-type
      const contentType = response.headers.get('content-type');
      if (!contentType || !contentType.includes('application/json')) {
        const htmlText = await response.text();
        console.error('Response HTML:', htmlText);
        throw new Error('Le serveur a renvoyé du HTML au lieu de JSON. Vérifiez les logs Laravel.');
      }

      const data = await response.json();

      if (data.success) {
        currentAiSuggestions = data.suggestions;
        displayAIResultsTop(data);
        aiResultTop.classList.remove('hidden');
        
        // Scroll vers les résultats
        aiResultTop.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
      } else {
        alert('❌ Erreur: ' + (data.message || 'Erreur inconnue'));
      }
    } catch (error) {
      console.error('Erreur analyse IA:', error);
      alert('❌ Erreur lors de l\'analyse: ' + error.message);
    } finally {
      aiAnalyzeBtnTop.disabled = false;
      aiAnalyzeBtnTop.innerHTML = '<svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg><span>Analyser avec l\'IA</span>';
    }
  });

  // Afficher les résultats de l'IA (version top)
  function displayAIResultsTop(data) {
    const detectedText = Array.isArray(data.text)
      ? data.text
      : Array.isArray(data.texts)
        ? data.texts
        : Array.isArray(data.raw_text)
          ? data.raw_text
          : [];

    let html = '<div class="space-y-3">';

    // Suggestions principales
    if (data.suggestions) {
      const sugg = data.suggestions;
      
      html += '<div class="grid grid-cols-1 md:grid-cols-2 gap-3 mb-4">';
      
      if (sugg.category) {
        html += `<div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-3 rounded-lg border border-blue-200">
          <div class="text-xs text-blue-600 font-semibold mb-1">📦 CATÉGORIE</div>
          <div class="text-lg font-bold text-blue-900">${sugg.category}</div>
        </div>`;
      }
      if (sugg.brand) {
        html += `<div class="bg-gradient-to-r from-purple-50 to-pink-50 p-3 rounded-lg border border-purple-200">
          <div class="text-xs text-purple-600 font-semibold mb-1">🏷️ MARQUE</div>
          <div class="text-lg font-bold text-purple-900">${sugg.brand}</div>
        </div>`;
      }
      const publisherValue = sugg.publisher ? sugg.publisher : '';
      html += `<div id="ai-publisher-card" class="bg-gradient-to-r from-pink-50 to-rose-50 p-3 rounded-lg border border-pink-200 ${publisherValue ? '' : 'hidden'}">
        <div class="text-xs text-pink-600 font-semibold mb-1">📚 ÉDITEUR</div>
        <div id="ai-publisher-display" class="text-lg font-bold text-pink-900">${publisherValue}</div>
      </div>`;
      if (sugg.sub_category) {
        html += `<div class="bg-gradient-to-r from-green-50 to-teal-50 p-3 rounded-lg border border-green-200">
          <div class="text-xs text-green-600 font-semibold mb-1">📂 SOUS-CATÉGORIE</div>
          <div class="text-lg font-bold text-green-900">${sugg.sub_category}</div>
        </div>`;
      }
      if (sugg.type) {
        html += `<div class="bg-gradient-to-r from-yellow-50 to-orange-50 p-3 rounded-lg border border-yellow-200">
          <div class="text-xs text-yellow-600 font-semibold mb-1">🎮 TYPE</div>
          <div class="text-lg font-bold text-yellow-900">${sugg.type}</div>
          ${sugg.type_to_create ? '<div class="text-xs text-orange-600 mt-1">⚠️ Type non trouvé - sera créé automatiquement</div>' : ''}
        </div>`;
      }
      if (sugg.name) {
        html += `<div class="bg-gradient-to-r from-emerald-50 to-green-50 p-3 rounded-lg border border-emerald-200">
          <div class="text-xs text-emerald-600 font-semibold mb-1">📝 NOM DU JEU</div>
          <div class="flex items-center gap-2">
            <input type="text" id="ai-game-name-edit" value="${sugg.name}" 
                   class="flex-1 px-3 py-1.5 text-sm font-semibold text-emerald-900 bg-white border border-emerald-300 rounded focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500">
            <button type="button" onclick="updateGameName()" 
                    class="px-3 py-1.5 bg-emerald-600 text-white text-xs rounded hover:bg-emerald-700">
              ✏️ Modifier
            </button>
          </div>
          <div class="text-xs text-emerald-600 mt-1">💡 Modifiez le nom si nécessaire avant d'appliquer</div>
        </div>`;
      }
      if (sugg.rom_id) {
        html += `<div class="bg-gradient-to-r from-gray-50 to-slate-50 p-3 rounded-lg border border-gray-200">
          <div class="text-xs text-gray-600 font-semibold mb-1">💾 ROM ID</div>
          <div class="flex items-center gap-2">
            <input type="text" id="ai-rom-id-edit" value="${sugg.rom_id}" 
                   class="flex-1 px-3 py-1.5 text-sm font-bold text-gray-900 font-mono bg-white border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            <button type="button" onclick="lookupRomId()" 
                    class="px-3 py-1.5 bg-blue-600 text-white text-xs rounded hover:bg-blue-700 flex items-center gap-1">
              🔍 Rechercher
            </button>
          </div>
          <div class="text-xs text-gray-600 mt-1">💡 Modifiez le ROM ID si l'OCR s'est trompé, puis recherchez</div>
        </div>`;
      }
      if (sugg.region) {
        html += `<div class="bg-gradient-to-r from-red-50 to-rose-50 p-3 rounded-lg border border-red-200">
          <div class="text-xs text-red-600 font-semibold mb-1">🌍 RÉGION</div>
          <div class="text-lg font-bold text-red-900">${sugg.region}</div>
        </div>`;
      }
      if (sugg.year) {
        html += `<div class="bg-gradient-to-r from-amber-50 to-yellow-50 p-3 rounded-lg border border-amber-200">
          <div class="text-xs text-amber-600 font-semibold mb-1">📅 ANNÉE</div>
          <div class="text-lg font-bold text-amber-900">${sugg.year}</div>
        </div>`;
      }
      if (sugg.completeness) {
        html += `<div class="bg-gradient-to-r from-cyan-50 to-blue-50 p-3 rounded-lg border border-cyan-200">
          <div class="text-xs text-cyan-600 font-semibold mb-1">📦 COMPLÉTUDE</div>
          <div class="text-lg font-bold text-cyan-900">${sugg.completeness}</div>
        </div>`;
      }
      
      html += '</div>';
    }

    // Détails techniques (collapsible)
    html += '<details class="mt-4"><summary class="cursor-pointer text-sm font-semibold text-gray-700 hover:text-gray-900">🔍 Détails de l\'analyse</summary><div class="mt-3 space-y-2">';

    // Labels détectés
    if (data.labels && data.labels.length > 0) {
      html += '<div><p class="text-xs font-semibold text-gray-700 mb-1">🏷️ Labels détectés:</p><div class="flex flex-wrap gap-1">';
      data.labels.slice(0, 10).forEach(label => {
        html += `<span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">${label.description} (${label.confidence}%)</span>`;
      });
      html += '</div></div>';
    }

    // Logos détectés
    if (data.logos && data.logos.length > 0) {
      html += '<div><p class="text-xs font-semibold text-gray-700 mb-1">🎨 Logos détectés:</p><div class="flex flex-wrap gap-1">';
      data.logos.forEach(logo => {
        html += `<span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">${logo.description} (${logo.confidence}%)</span>`;
      });
      html += '</div></div>';
    }

    // Texte détecté (OCR)
    if (detectedText.length > 0) {
      html += '<div><p class="text-xs font-semibold text-gray-700 mb-1">📝 Texte lu (OCR):</p><div class="bg-gray-100 p-2 rounded text-xs max-h-32 overflow-y-auto">';
      html += detectedText.slice(0, 10).join(' • ');
      html += '</div></div>';
    }

    html += '</div></details>';
    html += '</div>';
    
    aiResultContentTop.innerHTML = html;
  }

  // Appliquer les suggestions de l'IA
  applyAiSuggestionsTop.addEventListener('click', async () => {
    if (!currentAiSuggestions) return;

    const sugg = currentAiSuggestions;

    console.log('🎯 Application des suggestions:', sugg);

    // Trouver et sélectionner la catégorie
    if (sugg.category) {
      const catSelect = document.getElementById('article_category_id');
      const catOption = Array.from(catSelect.options).find(opt => 
        opt.text.toLowerCase().includes(sugg.category.toLowerCase())
      );
      if (catOption) {
        catSelect.value = catOption.value;
        catSelect.dispatchEvent(new Event('change'));
        console.log('✅ Catégorie sélectionnée:', catOption.text);
      }
    }

    // Fonction utilitaire pour attendre que les options d'un select soient chargées
    const waitForOptions = (selectElement, minOptions = 2, timeoutMs = 5000) => {
      return new Promise((resolve) => {
        const start = Date.now();
        const checkOptions = () => {
          if (!selectElement) {
            resolve();
            return;
          }
          const hasEnoughOptions = selectElement.options.length >= minOptions;
          const timedOut = Date.now() - start >= timeoutMs;
          if (hasEnoughOptions || timedOut) {
            resolve();
          } else {
            setTimeout(checkOptions, 100);
          }
        };
        checkOptions();
      });
    };

    // Attendre que les cascades AJAX se chargent, puis remplir les autres champs
    setTimeout(async () => {
      // Marque (Brand) - Attendre que les options soient chargées
      if (sugg.brand) {
        const brandSelect = document.getElementById('article_brand_id');
        
        // Attendre que les marques soient chargées (via AJAX cascade)
        await waitForOptions(brandSelect, 2);
        
        console.log('🔍 Recherche marque:', sugg.brand, 'dans', brandSelect.options.length, 'options');
        
        const brandOption = Array.from(brandSelect.options).find(opt => 
          opt.text.toLowerCase().includes(sugg.brand.toLowerCase()) ||
          opt.text.toLowerCase() === sugg.brand.toLowerCase()
        );
        
        if (brandOption) {
          brandSelect.value = brandOption.value;
          brandSelect.dispatchEvent(new Event('change'));
          console.log('✅ Marque sélectionnée:', brandOption.text);
        } else {
          console.warn('⚠️ Marque non trouvée:', sugg.brand, 'Options disponibles:', 
            Array.from(brandSelect.options).map(o => o.text));
        }
      }

      // Sous-catégorie (après chargement de la marque)
      setTimeout(async () => {
        if (sugg.sub_category) {
          const subSelect = document.getElementById('article_sub_category_id');
          
          // Attendre que les sous-catégories soient chargées
          await waitForOptions(subSelect, 2);
          
          console.log('🔍 Recherche sous-catégorie:', sugg.sub_category);
          
          const subOption = Array.from(subSelect.options).find(opt => 
            opt.text.toLowerCase().includes(sugg.sub_category.toLowerCase())
          );
          if (subOption) {
            subSelect.value = subOption.value;
            subSelect.dispatchEvent(new Event('change'));
            console.log('✅ Sous-catégorie sélectionnée:', subOption.text);
          } else {
            console.warn('⚠️ Sous-catégorie non trouvée:', sugg.sub_category);
          }
        }

        // Type (après chargement de la sous-catégorie)
        setTimeout(async () => {
          if (sugg.type) {
            const typeSelect = document.getElementById('article_type_id');
            
            // Si le type doit être créé
            if (sugg.type_to_create && sugg.sub_category) {
              const subSelect = document.getElementById('article_sub_category_id');
              const subCategoryId = subSelect?.value;
              
              if (subCategoryId) {
                try {
                  // Créer automatiquement le type
                  const response = await fetch('{{ url('/admin/taxonomy/type/auto-create') }}', {
                    method: 'POST',
                    headers: {
                      'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                      'Content-Type': 'application/json',
                      'Accept': 'application/json'
                    },
                    body: JSON.stringify({
                      article_sub_category_id: subCategoryId,
                      name: sugg.name || sugg.type,
                      publisher: sugg.brand || 'Nintendo'
                    })
                  });
                  
                  const result = await response.json();
                  
                  if (result.success) {
                    // Recharger les types
                    subSelect.dispatchEvent(new Event('change'));
                    
                    // Attendre le rechargement et sélectionner le nouveau type
                    setTimeout(() => {
                      if (typeSelect) {
                        const newTypeOption = Array.from(typeSelect.options).find(opt => 
                          opt.value == result.type.id
                        );
                        if (newTypeOption) {
                          typeSelect.value = newTypeOption.value;
                          typeSelect.dispatchEvent(new Event('change'));
                          console.log('✅ Type créé et sélectionné:', result.type.name);
                        }
                      }
                    }, 800);
                  }
                } catch (error) {
                  console.error('Erreur création type:', error);
                }
              }
            } else {
              // Type existe déjà, le sélectionner
              if (typeSelect && typeSelect.options.length > 1) {
                const typeOption = Array.from(typeSelect.options).find(opt => 
                  opt.text.toLowerCase().includes(sugg.type.toLowerCase()) ||
                  opt.value == sugg.type_id
                );
                if (typeOption) {
                  typeSelect.value = typeOption.value;
                  typeSelect.dispatchEvent(new Event('change'));
                }
              }
            }
          }

          // Nom du jeu
          if (sugg.name) {
            const nameInput = document.querySelector('input[name="name"]');
            if (nameInput) nameInput.value = sugg.name;
          }

          // ROM ID
          if (sugg.rom_id) {
            const romIdInput = document.querySelector('input[name="rom_id"]');
            if (romIdInput) {
              romIdInput.value = sugg.rom_id;
              console.log('✅ ROM ID rempli:', sugg.rom_id);
            }
          }

          // Année
          if (sugg.year) {
            const yearInput = document.querySelector('input[name="year"]');
            if (yearInput) {
              yearInput.value = sugg.year;
              console.log('✅ Année remplie:', sugg.year);
            }
          }
        }, 500);
      }, 500);

      // Région
      if (sugg.region) {
        const regionSelect = document.querySelector('select[name="region"]');
        if (regionSelect) {
          const regionOption = Array.from(regionSelect.options).find(opt => 
            opt.value === sugg.region
          );
          if (regionOption) regionSelect.value = sugg.region;
        }
      }

      // Complétude
      if (sugg.completeness) {
        const completenessSelects = document.querySelectorAll('select[name="completeness"]');
        completenessSelects.forEach(select => {
          if (select.style.display !== 'none') {
            const option = Array.from(select.options).find(opt => {
              const optValue = opt.value.toLowerCase();
              const optText = opt.text.toLowerCase();
              const suggValue = sugg.completeness.toLowerCase();
              
              // Correspondances exactes
              if (optValue === suggValue) return true;
              
              // Correspondances partielles
              if (optValue.includes(suggValue) || optText.includes(suggValue)) return true;
              
              // Alias spéciaux
              if (suggValue === 'loose' && (optValue === 'loose' || optText.includes('loose'))) return true;
              if (suggValue.includes('boîte') && optText.includes('boîte')) return true;
              if (suggValue.includes('console seule') && optValue === 'console seule') return true;
              
              return false;
            });
            
            if (option) {
              select.value = option.value;
              console.log('✅ Complétude sélectionnée:', option.text, '(valeur:', option.value + ')');
            } else {
              console.warn('⚠️ Complétude non trouvée:', sugg.completeness, '| Options:', 
                Array.from(select.options).map(o => `${o.value} (${o.text})`));
            }
          }
        });
      }

      // Éditeur (Publisher)
      if (sugg.publisher) {
        const publisherSelect = document.querySelector('select[name="publisher"]');
        if (publisherSelect) {
          const publisherOption = Array.from(publisherSelect.options).find(opt => 
            opt.value.toLowerCase() === sugg.publisher.toLowerCase() ||
            opt.text.toLowerCase().includes(sugg.publisher.toLowerCase())
          );
          if (publisherOption) {
            publisherSelect.value = publisherOption.value;
            console.log('✅ Éditeur sélectionné:', publisherOption.text);
          } else {
            console.warn('⚠️ Éditeur non trouvé:', sugg.publisher);
          }
        }
      }
    }, 300);

    // Scroll vers le formulaire
    document.querySelector('form').scrollIntoView({ behavior: 'smooth' });
    
    // Animation de confirmation
    const form = document.querySelector('.bg-white.shadow');
    form.classList.add('ring-4', 'ring-green-400');
    setTimeout(() => {
      form.classList.remove('ring-4', 'ring-green-400');
    }, 2000);
    
  });

  // ========================================
  // ANALYSE IA (SECTION IMAGES - LEGACY)
  // ========================================
  const aiAnalyzeBtn = document.getElementById('ai-analyze-btn');
  const aiResult = document.getElementById('ai-result');
  const aiResultContent = document.getElementById('ai-result-content');
  const applyAiSuggestionsBtn = document.getElementById('apply-ai-suggestions');

  // Activer le bouton d'analyse quand une image est ajoutée
  fileInput.addEventListener('change', () => {
    if (fileInput.files.length > 0) {
      aiAnalyzeBtn.disabled = false;
      uploadedImageForAI = fileInput.files[0];
    }
  });

  // Bouton d'analyse IA
  if (aiAnalyzeBtn) {
    aiAnalyzeBtn.addEventListener('click', async () => {
      if (!uploadedImageForAI && !currentArticleTypeId) {
        alert('Veuillez d\'abord ajouter une image');
        return;
      }

      // Utiliser la première image des previews si disponible
      const firstPreview = previewContainer.querySelector('img');
      if (!uploadedImageForAI && !firstPreview) {
        alert('Aucune image disponible pour l\'analyse');
        return;
      }

      aiAnalyzeBtn.disabled = true;
      aiAnalyzeBtn.innerHTML = '<svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg><span>Analyse en cours...</span>';
      aiResult.classList.add('hidden');

      try {
        let base64Image;

        if (uploadedImageForAI) {
          // Convertir le fichier en base64
          const reader = new FileReader();
          base64Image = await new Promise((resolve, reject) => {
            reader.onload = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(uploadedImageForAI);
          });
        } else {
          // Convertir l'image existante en base64
          const imageUrl = firstPreview.src;
          const imageBlob = await fetch(imageUrl).then(r => r.blob());
          const reader = new FileReader();
          base64Image = await new Promise((resolve, reject) => {
            reader.onload = () => resolve(reader.result);
            reader.onerror = reject;
            reader.readAsDataURL(imageBlob);
          });
        }

        const response = await fetch('{{ route('admin.articles.analyze-image') }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({
            image_base64: base64Image
          })
        });

        // Vérifier si la réponse est OK
        if (!response.ok) {
          const errorText = await response.text();
          console.error('Response error:', errorText);
          throw new Error(`Erreur HTTP ${response.status}: ${response.statusText}`);
        }

        // Vérifier le content-type
        const contentType = response.headers.get('content-type');
        if (!contentType || !contentType.includes('application/json')) {
          const htmlText = await response.text();
          console.error('Response HTML:', htmlText);
          throw new Error('Le serveur a renvoyé du HTML au lieu de JSON. Vérifiez les logs Laravel.');
        }

        const data = await response.json();

        if (data.success) {
          currentAiSuggestions = data.suggestions;
          displayAIResults(data);
          aiResult.classList.remove('hidden');
        } else {
          alert('❌ Erreur: ' + (data.message || 'Erreur inconnue'));
        }
      } catch (error) {
        console.error('Erreur analyse IA:', error);
        alert('❌ Erreur lors de l\'analyse: ' + error.message);
      } finally {
        aiAnalyzeBtn.disabled = false;
        aiAnalyzeBtn.innerHTML = '<svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path></svg><span>🤖 Analyser avec l\'IA (Google Vision)</span>';
      }
    });
  }

  // Afficher les résultats de l'IA
  function displayAIResults(data) {
    let html = '<div class="space-y-3">';

    // Suggestions principales
    if (data.suggestions) {
      const sugg = data.suggestions;
      
      if (sugg.category) {
        html += `<div class="flex items-center gap-2 text-sm"><span class="font-semibold">📦 Catégorie:</span><span class="text-blue-700">${sugg.category}</span></div>`;
      }
      if (sugg.brand) {
        html += `<div class="flex items-center gap-2 text-sm"><span class="font-semibold">🏷️ Marque:</span><span class="text-blue-700">${sugg.brand}</span></div>`;
      }
      if (sugg.publisher) {
        html += `<div class="flex items-center gap-2 text-sm"><span class="font-semibold">📚 Éditeur:</span><span class="text-blue-700">${sugg.publisher}</span></div>`;
      }
      if (sugg.sub_category) {
        html += `<div class="flex items-center gap-2 text-sm"><span class="font-semibold">📂 Sous-catégorie:</span><span class="text-blue-700">${sugg.sub_category}</span></div>`;
      }
      if (sugg.type) {
        html += `<div class="flex items-center gap-2 text-sm"><span class="font-semibold">🎮 Type:</span><span class="text-blue-700">${sugg.type}</span></div>`;
      }
      if (sugg.rom_id) {
        html += `<div class="flex items-center gap-2 text-sm"><span class="font-semibold">💾 ROM ID:</span><span class="text-blue-700 font-mono">${sugg.rom_id}</span></div>`;
      }
      if (sugg.region) {
        html += `<div class="flex items-center gap-2 text-sm"><span class="font-semibold">🌍 Région:</span><span class="text-blue-700">${sugg.region}</span></div>`;
      }
      if (sugg.completeness) {
        html += `<div class="flex items-center gap-2 text-sm"><span class="font-semibold">📦 Complétude:</span><span class="text-blue-700">${sugg.completeness}</span></div>`;
      }
    }

    // Labels détectés
    if (data.labels && data.labels.length > 0) {
      html += '<div class="mt-3 pt-3 border-t border-blue-200"><p class="text-xs font-semibold text-blue-900 mb-1">🏷️ Labels détectés:</p><div class="flex flex-wrap gap-1">';
      data.labels.slice(0, 8).forEach(label => {
        html += `<span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs rounded">${label.description} (${label.confidence}%)</span>`;
      });
      html += '</div></div>';
    }

    // Logos détectés
    if (data.logos && data.logos.length > 0) {
      html += '<div class="mt-2"><p class="text-xs font-semibold text-blue-900 mb-1">🎨 Logos détectés:</p><div class="flex flex-wrap gap-1">';
      data.logos.forEach(logo => {
        html += `<span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs rounded">${logo.description} (${logo.confidence}%)</span>`;
      });
      html += '</div></div>';
    }

    // Texte détecté (OCR)
    if (data.text && data.text.length > 1) {
      html += '<div class="mt-2"><p class="text-xs font-semibold text-blue-900 mb-1">📝 Texte lu (OCR):</p><div class="bg-gray-100 p-2 rounded text-xs max-h-24 overflow-y-auto">';
      html += data.text.slice(0, 5).join(' • ');
      html += '</div></div>';
    }

    html += '</div>';
    aiResultContent.innerHTML = html;
  }

  // Appliquer les suggestions de l'IA
  if (applyAiSuggestionsBtn) {
    applyAiSuggestionsBtn.addEventListener('click', () => {
      if (!currentAiSuggestions) return;

      const sugg = currentAiSuggestions;

      // Trouver et sélectionner la catégorie
      if (sugg.category) {
        const catSelect = document.getElementById('article_category_id');
        const catOption = Array.from(catSelect.options).find(opt => 
          opt.text.toLowerCase().includes(sugg.category.toLowerCase())
        );
        if (catOption) {
          catSelect.value = catOption.value;
          catSelect.dispatchEvent(new Event('change'));
        }
      }

      // Région
      if (sugg.region) {
        const regionSelect = document.querySelector('select[name="region"]');
        if (regionSelect) {
          const regionOption = Array.from(regionSelect.options).find(opt => 
            opt.value === sugg.region
          );
          if (regionOption) regionSelect.value = sugg.region;
        }
      }

      // Complétude
      if (sugg.completeness) {
        const completenessSelects = document.querySelectorAll('select[name="completeness"]');
        completenessSelects.forEach(select => {
          if (select.style.display !== 'none') {
            const option = Array.from(select.options).find(opt => 
              opt.text.toLowerCase().includes(sugg.completeness.toLowerCase())
            );
            if (option) select.value = option.value;
          }
        });
      }

      aiResult.classList.add('hidden');
    });
  }
})();
</script>
@endsection
