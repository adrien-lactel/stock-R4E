@extends('layouts.app')

@section('content')
{{-- Inclure le gestionnaire d'images réutilisable --}}
<script src="{{ asset('js/article-images-manager.js') }}"></script>

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
        
        {{-- Titre et actions contextuelles --}}
        <div id="lightbox-header" class="absolute top-4 left-4 flex items-center gap-3 z-10">
            <div id="lightbox-filename" class="bg-black bg-opacity-50 text-white px-4 py-2 rounded-lg text-sm font-medium"></div>
            <div id="lightbox-actions" class="flex gap-2"></div>
        </div>
        
        {{-- Contrôles d'édition (gauche) --}}
        <div class="absolute top-1/2 left-2 md:left-4 transform -translate-y-1/2 flex flex-col gap-2 z-10">
            <button type="button" onclick="toggleCropMode(); event.stopPropagation();" 
                    id="crop-toggle-btn"
                    class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-2 md:p-3 rounded-lg transition-colors group"
                    title="Recadrer">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </button>
            <button type="button" onclick="rotateLeft(); event.stopPropagation();" 
                    class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-2 md:p-3 rounded-lg transition-colors group"
                    title="Rotation 90° gauche">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h10a8 8 0 018 8v2M3 10l6 6m-6-6l6-6"></path>
                </svg>
            </button>
            <button type="button" onclick="rotateRight(); event.stopPropagation();" 
                    class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-2 md:p-3 rounded-lg transition-colors group"
                    title="Rotation 90° droite">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 10H11a8 8 0 00-8 8v2m18-10l-6 6m6-6l-6-6"></path>
                </svg>
            </button>
            <button type="button" onclick="downloadLightboxImage(); event.stopPropagation();" 
                    class="bg-white bg-opacity-20 hover:bg-opacity-30 text-white p-2 md:p-3 rounded-lg transition-colors group"
                    title="Télécharger">
                <svg class="w-5 h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
            </button>
        </div>
        
        {{-- Zone de recadrage (cachée par défaut) --}}
        <div id="crop-overlay" class="hidden absolute inset-0 z-20">
            <div class="absolute inset-0 bg-black bg-opacity-80" onclick="event.stopPropagation()">
                <canvas id="crop-canvas" class="absolute inset-0 m-auto" style="touch-action: none;"></canvas>
                
                {{-- Contrôles de recadrage --}}
                <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 flex gap-3">
                    <button type="button" onclick="cancelCrop(); event.stopPropagation();" 
                            class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium">
                        Annuler
                    </button>
                    <button type="button" onclick="applyCrop(); event.stopPropagation();" 
                            class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-lg font-medium">
                        ✓ Valider le recadrage
                    </button>
                </div>
                
                <div class="absolute top-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-70 text-white px-4 py-2 rounded-lg text-sm">
                    📐 Glissez pour recadrer • Pincez pour zoomer
                </div>
            </div>
        </div>
        
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

    {{-- MODAL UPLOAD IMAGES CONSOLE (logo + display1-3) --}}
    <div id="console-logo-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4 overflow-y-auto">
        <div class="bg-white rounded-xl shadow-2xl max-w-4xl w-full p-6 my-8" onclick="event.stopPropagation()">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-bold text-gray-800">📷 Images de la console</h3>
                <button type="button" onclick="closeConsoleLogoModal()" class="text-gray-400 hover:text-gray-600">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
            
            <p class="text-sm text-gray-600 mb-2">
                Ajoutez les images pour cet article. Elles seront sauvegardées dans la taxonomie R2.
            </p>
            
            <div id="console-logo-name" class="text-center font-medium text-indigo-600 mb-4"></div>
            
            {{-- Grille des 4 zones d'upload --}}
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                {{-- Logo --}}
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2 text-center">🏷️ Logo</label>
                    <div id="console-img-dropzone-logo" data-type="logo"
                         class="console-img-dropzone border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-colors aspect-square flex flex-col items-center justify-center">
                        <div class="console-img-preview hidden w-full h-full">
                            <img src="" class="w-full h-full object-contain rounded">
                        </div>
                        <div class="console-img-placeholder flex flex-col items-center">
                            <svg class="w-8 h-8 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-xs text-gray-500">Logo du nom</p>
                        </div>
                        <input type="file" class="console-img-input hidden" accept="image/*" data-type="logo">
                    </div>
                    <div class="console-img-status text-xs text-center mt-1 text-gray-400" data-type="logo"></div>
                </div>
                
                {{-- Display 1 --}}
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2 text-center">📸 Display 1</label>
                    <div id="console-img-dropzone-display1" data-type="display1"
                         class="console-img-dropzone border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-colors aspect-square flex flex-col items-center justify-center">
                        <div class="console-img-preview hidden w-full h-full">
                            <img src="" class="w-full h-full object-contain rounded">
                        </div>
                        <div class="console-img-placeholder flex flex-col items-center">
                            <svg class="w-8 h-8 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-xs text-gray-500">Photo 1</p>
                        </div>
                        <input type="file" class="console-img-input hidden" accept="image/*" data-type="display1">
                    </div>
                    <div class="console-img-status text-xs text-center mt-1 text-gray-400" data-type="display1"></div>
                </div>
                
                {{-- Display 2 --}}
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2 text-center">📸 Display 2</label>
                    <div id="console-img-dropzone-display2" data-type="display2"
                         class="console-img-dropzone border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-colors aspect-square flex flex-col items-center justify-center">
                        <div class="console-img-preview hidden w-full h-full">
                            <img src="" class="w-full h-full object-contain rounded">
                        </div>
                        <div class="console-img-placeholder flex flex-col items-center">
                            <svg class="w-8 h-8 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-xs text-gray-500">Photo 2</p>
                        </div>
                        <input type="file" class="console-img-input hidden" accept="image/*" data-type="display2">
                    </div>
                    <div class="console-img-status text-xs text-center mt-1 text-gray-400" data-type="display2"></div>
                </div>
                
                {{-- Display 3 --}}
                <div class="flex flex-col">
                    <label class="text-sm font-medium text-gray-700 mb-2 text-center">📸 Display 3</label>
                    <div id="console-img-dropzone-display3" data-type="display3"
                         class="console-img-dropzone border-2 border-dashed border-gray-300 rounded-lg p-4 text-center cursor-pointer hover:border-indigo-400 hover:bg-indigo-50 transition-colors aspect-square flex flex-col items-center justify-center">
                        <div class="console-img-preview hidden w-full h-full">
                            <img src="" class="w-full h-full object-contain rounded">
                        </div>
                        <div class="console-img-placeholder flex flex-col items-center">
                            <svg class="w-8 h-8 text-gray-400 mb-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <p class="text-xs text-gray-500">Photo 3</p>
                        </div>
                        <input type="file" class="console-img-input hidden" accept="image/*" data-type="display3">
                    </div>
                    <div class="console-img-status text-xs text-center mt-1 text-gray-400" data-type="display3"></div>
                </div>
            </div>
            
            <p class="text-xs text-gray-400 mt-4 text-center">PNG, JPG (max 5 MB par image) • Les images existantes seront remplacées</p>
            
            {{-- Boutons --}}
            <div class="flex justify-end gap-3 mt-6">
                <button type="button" onclick="closeConsoleLogoModal()" class="px-4 py-2 text-gray-600 hover:text-gray-800">
                    Fermer
                </button>
                <button type="button" id="console-logo-upload-btn" onclick="uploadConsoleImages()" 
                        class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 disabled:opacity-50 disabled:cursor-not-allowed" disabled>
                    📤 Enregistrer les images
                </button>
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
                       placeholder="Recherche par ROM ID (ex: SHVC-23, DMG-A1J) ou nom de jeu"
                       class="w-full rounded border-gray-300"
                       oninput="window.onGameInput()"
                       onkeydown="window.onGameKeydown(event)"
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
            <label id="brand_label" class="block text-sm font-medium">Marque</label>

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
                autocomplete="off">
            <option value="">— Choisir —</option>
        </select>
    </div>

    {{-- =====================
         SOUS-CATÉGORIE
    ===================== --}}
    <div>
        <div class="flex items-center justify-between mb-1">
            <label class="block text-sm font-medium">Sous-catégorie *</label>

            <button type="button"
                    onclick="openAddSubCategoryModal()"
                    class="text-indigo-600 hover:underline text-sm font-bold"
                    title="Ajouter une sous-catégorie">
                + Nouvelle sous-catégorie
            </button>
        </div>

        <select id="article_sub_category_id"
                name="article_sub_category_id"
                class="w-full rounded border-gray-300"
                autocomplete="off"
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

            <button type="button"
                    onclick="openAddTypeModal()"
                    class="text-indigo-600 hover:underline text-sm font-bold"
                    title="Ajouter un type">
                + Nouveau type
            </button>
        </div>

        <select id="article_type_id"
                name="article_type_id"
                class="w-full rounded border-gray-300"
                autocomplete="off"
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
        </select>
        <p class="text-xs text-gray-500 mt-1">Important pour N64, SNES, GameCube, etc.</p>
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
        
        {{-- Section images de la console (visible seulement pour catégorie Consoles) --}}
        <div id="console-logo-section" class="mt-4 hidden">
            <div class="flex items-center gap-3 p-4 bg-indigo-50 rounded-lg border border-indigo-200">
                <div id="console-logo-thumb" class="w-16 h-16 bg-white rounded-lg border-2 border-dashed border-gray-300 flex items-center justify-center overflow-hidden">
                    <span id="console-logo-icon" class="text-gray-400 text-2xl">🎮</span>
                </div>
                <div class="flex-1">
                    <p id="console-logo-title" class="text-sm font-medium text-gray-700">📷 Images</p>
                    <p class="text-xs text-gray-500">Logo du nom + 3 photos pour la fiche produit</p>
                </div>
                <button type="button" onclick="openConsoleLogoModal()" 
                        class="px-4 py-2 bg-indigo-600 text-white text-sm rounded-lg hover:bg-indigo-700 flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                    </svg>
                    Ajouter / Modifier
                </button>
            </div>
        </div>
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
                        
                        <!-- Pour les cartes à collectionner -->
                        <select name="completeness" id="completeness_cards" class="w-full rounded border-gray-300" style="display: none;">
                            <option value="">— Non spécifié —</option>
                            <option value="Neuf scellé" @selected(old('completeness', $console->completeness) === 'Neuf scellé')>🎁 Neuf scellé</option>
                            <option value="Carte à l'unité" @selected(old('completeness', $console->completeness) === 'Carte à l\'unité')>🃏 Carte à l'unité</option>
                            <option value="Carte gradée" @selected(old('completeness', $console->completeness) === 'Carte gradée')>⭐ Carte gradée</option>
                            <option value="Case scellée" @selected(old('completeness', $console->completeness) === 'Case scellée')>📦 Case scellée</option>
                        </select>
                        
                        <p class="text-xs text-gray-500 mt-1" id="completeness_hint_console">Console seule, avec sa boîte, ou complète avec accessoires</p>
                        <p class="text-xs text-gray-500 mt-1" id="completeness_hint_game" style="display: none;">Jeu seul (loose), avec boîte, ou complet avec notice</p>
                        <p class="text-xs text-gray-500 mt-1" id="completeness_hint_cards" style="display: none;">Neuf scellé, carte individuelle, carte gradée PSA/CGC, ou case complète</p>
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
                 IMAGES DE L'ARTICLE - COMPOSANT RÉUTILISABLE
            ===================== --}}
            <div class="mt-6">
                <x-article-images-manager 
                    :article-type-id="$console->article_type_id ?? null"
                    :article-type-name="$console->articleType->name ?? null"
                    :rom-id="$console->rom_id ?? null"
                    :uploaded-images="$console->article_images ?? []"
                    :primary-image="$console->primary_image_url ?? ''"
                />
                
                {{-- Masquer le bouton des photos génériques --}}
                <style>
                    button[onclick="openTaxonomyImagesModal()"] {
                        display: none !important;
                    }
                </style>
                
                {{-- Configuration des routes pour le gestionnaire d'images --}}
                <script>
                window.configureArticleImagesRoutes({
                    upload: '{{ route("admin.articles.upload-image") }}',
                    delete: '{{ route("admin.articles.delete-image") }}',
                    ajaxImages: '{{ url("admin/ajax/articles-images-by-type") }}'
                });
                </script>
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
// ✅ Configuration globale - Défini EN PREMIER pour être disponible partout
window.gameboyImageBaseUrl = '{{ asset('images/taxonomy/gameboy') }}';
window.laravelAssetBase = '{{ asset('') }}';
window.ajaxSearchGameUrl = '{{ url("admin/ajax/search-game") }}';

console.log('🔧 Configuration globale chargée:', {  
  ajaxSearchGameUrl: window.ajaxSearchGameUrl,
  gameboyImageBaseUrl: window.gameboyImageBaseUrl,
  laravelAssetBase: window.laravelAssetBase
});


// ✅ Lightbox avec zoom et pan
let currentZoom = 1;
let currentX = 0;
let currentY = 0;
let currentRotation = 0;
let isDragging = false;
let startX = 0;
let startY = 0;
let isCropMode = false;
let cropData = { x: 0, y: 0, width: 0, height: 0 };
let touchStartDistance = 0;
let cropScale = 1;
let cropOffsetX = 0;
let cropOffsetY = 0;
let lightboxContext = {};

// Variables globales pour la gestion des images d'articles
// Utiliser window.* pour éviter les conflits avec article-images-manager.js
if (typeof window.currentArticleTypeId === 'undefined') {
    window.currentArticleTypeId = null;
}
if (typeof window.uploadedGameImages === 'undefined') {
    window.uploadedGameImages = [];
}
if (typeof window.primaryImageUrl === 'undefined') {
    window.primaryImageUrl = null;
}
if (typeof window.genericArticleImages === 'undefined') {
    window.genericArticleImages = [];
}

window.openImageLightbox = function(imageUrl, context = {}) {
  const lightbox = document.getElementById('image-lightbox');
  const lightboxImage = document.getElementById('lightbox-image');
  if (lightbox && lightboxImage) {
    lightboxImage.src = imageUrl;
    lightboxImage.dataset.originalUrl = imageUrl;
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
    resetZoom();
    initZoomControls();
    
    // Stocker le contexte pour utilisation ultérieure (recadrage, etc.)
    lightboxContext = context;
    
    // Mettre à jour le nom du fichier
    const filenameEl = document.getElementById('lightbox-filename');
    if (filenameEl) {
      const filename = imageUrl.split('/').pop().split('?')[0];
      filenameEl.textContent = filename;
    }
    
    // Actions contextuelles pour les photos d'articles
    const actionsEl = document.getElementById('lightbox-actions');
    if (actionsEl) {
      actionsEl.innerHTML = '';
      
      if (context.isArticleImage) {
        // Bouton définir comme principale
        if (!context.isPrimary) {
          const setPrimaryBtn = document.createElement('button');
          setPrimaryBtn.type = 'button';
          setPrimaryBtn.className = 'bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors';
          setPrimaryBtn.innerHTML = '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg> Définir comme principale';
          setPrimaryBtn.onclick = (e) => {
            e.stopPropagation();
            setPrimaryImage(imageUrl);
            closeImageLightbox();
          };
          actionsEl.appendChild(setPrimaryBtn);
        }
        
        // Bouton supprimer
        const deleteBtn = document.createElement('button');
        deleteBtn.type = 'button';
        deleteBtn.className = 'bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors';
        deleteBtn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg> Supprimer';
        deleteBtn.onclick = (e) => {
          e.stopPropagation();
          deleteArticleImage(imageUrl);
          closeImageLightbox();
        };
        actionsEl.appendChild(deleteBtn);
      }
    }
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
    currentRotation = 0;
    updateTransform();
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

window.rotateLeft = function() {
  currentRotation = (currentRotation - 90) % 360;
  updateTransform();
};

window.rotateRight = function() {
  currentRotation = (currentRotation + 90) % 360;
  updateTransform();
};

window.downloadLightboxImage = function() {
  const img = document.getElementById('lightbox-image');
  if (!img || !img.dataset.originalUrl) return;
  
  const url = img.dataset.originalUrl;
  const filename = url.split('/').pop().split('?')[0];
  
  // Créer un lien de téléchargement
  const a = document.createElement('a');
  a.href = url;
  a.download = filename;
  a.target = '_blank';
  document.body.appendChild(a);
  a.click();
  document.body.removeChild(a);
  
  console.log('💾 Téléchargement:', filename);
};

// Mode recadrage
window.toggleCropMode = function() {
  isCropMode = !isCropMode;
  const overlay = document.getElementById('crop-overlay');
  const toggleBtn = document.getElementById('crop-toggle-btn');
  
  if (isCropMode) {
    overlay.classList.remove('hidden');
    toggleBtn.classList.add('bg-green-600');
    initCropCanvas();
  } else {
    overlay.classList.add('hidden');
    toggleBtn.classList.remove('bg-green-600');
  }
};

function initCropCanvas() {
  const img = document.getElementById('lightbox-image');
  const canvas = document.getElementById('crop-canvas');
  if (!img || !canvas) return;
  
  const ctx = canvas.getContext('2d');
  
  // Charger l'image dans le canvas
  const tempImg = new Image();
  tempImg.crossOrigin = 'anonymous';
  tempImg.onload = function() {
    // Adapter au viewport
    const maxWidth = window.innerWidth - 100;
    const maxHeight = window.innerHeight - 200;
    let width = tempImg.width;
    let height = tempImg.height;
    
    if (width > maxWidth || height > maxHeight) {
      const ratio = Math.min(maxWidth / width, maxHeight / height);
      width *= ratio;
      height *= ratio;
    }
    
    canvas.width = width;
    canvas.height = height;
    
    // Dessiner l'image
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.save();
    ctx.translate(canvas.width / 2, canvas.height / 2);
    ctx.rotate(currentRotation * Math.PI / 180);
    ctx.scale(cropScale, cropScale);
    ctx.translate(-canvas.width / 2, -canvas.height / 2);
    ctx.drawImage(tempImg, cropOffsetX, cropOffsetY, canvas.width, canvas.height);
    ctx.restore();
    
    // Zone de recadrage initiale (80% au centre)
    cropData.width = width * 0.8;
    cropData.height = height * 0.8;
    cropData.x = (width - cropData.width) / 2;
    cropData.y = (height - cropData.height) / 2;
    
    drawCropOverlay();
    initCropControls();
  };
  tempImg.src = img.dataset.originalUrl;
}

function drawCropOverlay() {
  const canvas = document.getElementById('crop-canvas');
  if (!canvas) return;
  
  const ctx = canvas.getContext('2d');
  
  // Redessiner l'image
  const img = document.getElementById('lightbox-image');
  const tempImg = new Image();
  tempImg.crossOrigin = 'anonymous';
  tempImg.onload = function() {
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    ctx.save();
    ctx.translate(canvas.width / 2, canvas.height / 2);
    ctx.rotate(currentRotation * Math.PI / 180);
    ctx.scale(cropScale, cropScale);
    ctx.translate(-canvas.width / 2, -canvas.height / 2);
    ctx.drawImage(tempImg, cropOffsetX, cropOffsetY, canvas.width, canvas.height);
    ctx.restore();
    
    // Assombrir les zones hors recadrage
    ctx.fillStyle = 'rgba(0, 0, 0, 0.5)';
    ctx.fillRect(0, 0, canvas.width, cropData.y);
    ctx.fillRect(0, cropData.y, cropData.x, cropData.height);
    ctx.fillRect(cropData.x + cropData.width, cropData.y, canvas.width - cropData.x - cropData.width, cropData.height);
    ctx.fillRect(0, cropData.y + cropData.height, canvas.width, canvas.height - cropData.y - cropData.height);
    
    // Bordure de sélection
    ctx.strokeStyle = '#fff';
    ctx.lineWidth = 2;
    ctx.strokeRect(cropData.x, cropData.y, cropData.width, cropData.height);
    
    // Poignées de redimensionnement
    const handleSize = 20;
    ctx.fillStyle = '#fff';
    // Coins
    ctx.fillRect(cropData.x - handleSize/2, cropData.y - handleSize/2, handleSize, handleSize);
    ctx.fillRect(cropData.x + cropData.width - handleSize/2, cropData.y - handleSize/2, handleSize, handleSize);
    ctx.fillRect(cropData.x - handleSize/2, cropData.y + cropData.height - handleSize/2, handleSize, handleSize);
    ctx.fillRect(cropData.x + cropData.width - handleSize/2, cropData.y + cropData.height - handleSize/2, handleSize, handleSize);
  };
  tempImg.src = img.dataset.originalUrl;
}

function initCropControls() {
  const canvas = document.getElementById('crop-canvas');
  if (!canvas) return;
  
  let dragging = false;
  let resizing = null;
  let startMouseX = 0;
  let startMouseY = 0;
  let startCropX = 0;
  let startCropY = 0;
  let startCropWidth = 0;
  let startCropHeight = 0;
  
  const getMousePos = (e) => {
    const rect = canvas.getBoundingClientRect();
    const touch = e.touches ? e.touches[0] : e;
    return {
      x: touch.clientX - rect.left,
      y: touch.clientY - rect.top
    };
  };
  
  const onStart = (e) => {
    e.preventDefault();
    const pos = getMousePos(e);
    startMouseX = pos.x;
    startMouseY = pos.y;
    startCropX = cropData.x;
    startCropY = cropData.y;
    startCropWidth = cropData.width;
    startCropHeight = cropData.height;
    
    const handleSize = 20;
    // Vérifier si on clique sur une poignée
    if (Math.abs(pos.x - cropData.x) < handleSize && Math.abs(pos.y - cropData.y) < handleSize) {
      resizing = 'tl';
    } else if (Math.abs(pos.x - (cropData.x + cropData.width)) < handleSize && Math.abs(pos.y - cropData.y) < handleSize) {
      resizing = 'tr';
    } else if (Math.abs(pos.x - cropData.x) < handleSize && Math.abs(pos.y - (cropData.y + cropData.height)) < handleSize) {
      resizing = 'bl';
    } else if (Math.abs(pos.x - (cropData.x + cropData.width)) < handleSize && Math.abs(pos.y - (cropData.y + cropData.height)) < handleSize) {
      resizing = 'br';
    } else if (pos.x > cropData.x && pos.x < cropData.x + cropData.width &&
               pos.y > cropData.y && pos.y < cropData.y + cropData.height) {
      dragging = true;
    }
  };
  
  const onMove = (e) => {
    if (!dragging && !resizing) return;
    e.preventDefault();
    
    const pos = getMousePos(e);
    const dx = pos.x - startMouseX;
    const dy = pos.y - startMouseY;
    
    if (dragging) {
      cropData.x = Math.max(0, Math.min(canvas.width - cropData.width, startCropX + dx));
      cropData.y = Math.max(0, Math.min(canvas.height - cropData.height, startCropY + dy));
    } else if (resizing) {
      if (resizing === 'br') {
        cropData.width = Math.max(50, Math.min(canvas.width - cropData.x, startCropWidth + dx));
        cropData.height = Math.max(50, Math.min(canvas.height - cropData.y, startCropHeight + dy));
      } else if (resizing === 'tl') {
        const newX = Math.max(0, startCropX + dx);
        const newY = Math.max(0, startCropY + dy);
        cropData.width = startCropWidth + (cropData.x - newX);
        cropData.height = startCropHeight + (cropData.y - newY);
        cropData.x = newX;
        cropData.y = newY;
      } else if (resizing === 'tr') {
        cropData.width = Math.max(50, Math.min(canvas.width - cropData.x, startCropWidth + dx));
        const newY = Math.max(0, startCropY + dy);
        cropData.height = startCropHeight + (cropData.y - newY);
        cropData.y = newY;
      } else if (resizing === 'bl') {
        const newX = Math.max(0, startCropX + dx);
        cropData.width = startCropWidth + (cropData.x - newX);
        cropData.x = newX;
        cropData.height = Math.max(50, Math.min(canvas.height - cropData.y, startCropHeight + dy));
      }
    }
    
    drawCropOverlay();
  };
  
  const onEnd = () => {
    dragging = false;
    resizing = null;
  };
  
  canvas.onmousedown = onStart;
  canvas.onmousemove = onMove;
  canvas.onmouseup = onEnd;
  canvas.ontouchstart = onStart;
  canvas.ontouchmove = onMove;
  canvas.ontouchend = onEnd;
}

window.cancelCrop = function() {
  isCropMode = false;
  const overlay = document.getElementById('crop-overlay');
  const toggleBtn = document.getElementById('crop-toggle-btn');
  overlay.classList.add('hidden');
  toggleBtn.classList.remove('bg-green-600');
};

window.applyCrop = async function() {
  const canvas = document.getElementById('crop-canvas');
  const img = document.getElementById('lightbox-image');
  if (!canvas || !img) return;
  
  // Créer un canvas pour l'image recadrée
  const cropCanvas = document.createElement('canvas');
  cropCanvas.width = cropData.width;
  cropCanvas.height = cropData.height;
  const ctx = cropCanvas.getContext('2d');
  
  // Récupérer l'image source
  const tempImg = new Image();
  tempImg.crossOrigin = 'anonymous';
  tempImg.onload = async function() {
    // Calculer le ratio entre l'image originale et le canvas d'affichage
    const scaleX = tempImg.width / canvas.width;
    const scaleY = tempImg.height / canvas.height;
    
    // Extraire la zone recadrée à partir de l'image originale
    ctx.drawImage(
      tempImg,
      cropData.x * scaleX,
      cropData.y * scaleY,
      cropData.width * scaleX,
      cropData.height * scaleY,
      0,
      0,
      cropData.width,
      cropData.height
    );
    
    // Convertir en blob
    cropCanvas.toBlob(async (blob) => {
      const file = new File([blob], 'cropped-image.jpg', { type: 'image/jpeg' });
      
      // Upload l'image recadrée
      const formData = new FormData();
      formData.append('image', file);
      
      // Récupérer article_type_id depuis le contexte ou la variable globale
      const articleTypeId = lightboxContext.article_type_id || window.currentArticleTypeId;
      console.log('🔧 applyCrop - articleTypeId:', articleTypeId);
      console.log('🔧 applyCrop - lightboxContext:', lightboxContext);
      console.log('🔧 applyCrop - window.currentArticleTypeId (global):', window.currentArticleTypeId);
      
      if (!articleTypeId) {
        alert('❌ Type d\'article non défini. Veuillez sélectionner un type d\'article.');
        return;
      }
      formData.append('article_type_id', articleTypeId);
      
      try {
        console.log('📤 Envoi du recadrage vers serveur...', {
          articleTypeId: articleTypeId,
          fileSize: (file.size / 1024).toFixed(2) + ' KB'
        });
        
        const response = await fetch('{{ route('admin.articles.upload-image') }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
          },
          body: formData
        });
        
        console.log('📡 Réponse serveur recadrage:', {
          status: response.status,
          ok: response.ok
        });
        
        if (!response.ok) {
          const errorText = await response.text();
          console.error('❌ Erreur serveur:', errorText);
          alert(`❌ Erreur serveur (${response.status}):\n${errorText.substring(0, 200)}`);
          return;
        }
        
        const data = await response.json();
        console.log('📦 Data serveur:', data);
        
        if (data.success) {
          console.log('✅ Image recadrée uploadée:', data.url);
          
          // Ajouter à la liste
          window.uploadedGameImages.push(data.url);
          if (!window.primaryImageUrl) {
            window.primaryImageUrl = data.url;
          }
          
          // Ajouter la carte
          const fileName = 'recadrage-' + Date.now() + '.jpg';
          addArticleImageCard(data.url, fileName, 'uploaded');
          refreshArticleImagesPreview();
          
          // Fermer le mode recadrage et le lightbox
          cancelCrop();
          closeImageLightbox();
          
          alert('✓ Image recadrée et ajoutée!');
        } else {
          console.error('❌ Upload échoué:', data.message);
          alert(`❌ Erreur:\n${data.message || 'Upload échoué'}`);
        }
      } catch (e) {
        console.error('❌ Erreur upload recadrage:', e);
        alert(`Erreur lors de l\'upload de l\'image recadrée:\n${e.message}`);
      }
    }, 'image/jpeg', 0.9);
  };
  tempImg.src = img.dataset.originalUrl;
};

function updateTransform() {
  const img = document.getElementById('lightbox-image');
  if (img) {
    img.style.transform = `translate(${currentX}px, ${currentY}px) scale(${currentZoom}) rotate(${currentRotation}deg)`;
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

  // Support tactile (mobile)
  let touchStartX = 0;
  let touchStartY = 0;
  let lastTouchDistance = 0;

  container.ontouchstart = function(e) {
    if (e.touches.length === 1) {
      // Pan avec un doigt
      touchStartX = e.touches[0].clientX - currentX;
      touchStartY = e.touches[0].clientY - currentY;
    } else if (e.touches.length === 2) {
      // Zoom avec deux doigts (pinch)
      const dx = e.touches[0].clientX - e.touches[1].clientX;
      const dy = e.touches[0].clientY - e.touches[1].clientY;
      lastTouchDistance = Math.sqrt(dx * dx + dy * dy);
    }
  };

  container.ontouchmove = function(e) {
    e.preventDefault();
    
    if (e.touches.length === 1 && currentZoom > 1) {
      // Pan
      currentX = e.touches[0].clientX - touchStartX;
      currentY = e.touches[0].clientY - touchStartY;
      updateTransform();
    } else if (e.touches.length === 2) {
      // Pinch zoom
      const dx = e.touches[0].clientX - e.touches[1].clientX;
      const dy = e.touches[0].clientY - e.touches[1].clientY;
      const distance = Math.sqrt(dx * dx + dy * dy);
      
      if (lastTouchDistance > 0) {
        const delta = distance - lastTouchDistance;
        if (delta > 5) {
          zoomIn();
          lastTouchDistance = distance;
        } else if (delta < -5) {
          zoomOut();
          lastTouchDistance = distance;
        }
      }
    }
  };

  container.ontouchend = function() {
    lastTouchDistance = 0;
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

// ✅ Extraire le ROM ID du nom du jeu (format: "ROM_ID - Nom du jeu")
// Compatible avec SHVC-, SNS-, DMG-, CGB-, AGB-, HVC-, NES-, etc.
function extractRomIdFromName(name) {
  if (!name) return null;
  
  // Pattern pour extraire le ROM ID au début du nom (ex: "SHVC-MW - Super Mario World" -> "SHVC-MW")
  const match = name.match(/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i);
  if (match) {
    return match[1].toUpperCase();
  }
  
  return null;
}

// ========================================
// RECHERCHE DE JEUX
// ========================================

// Construire l'URL de l'image locale depuis le ROM ID ou slug
function getLocalGameImage(game, platform) {
  if (!game) return null;
  
  // En production: servir directement depuis R2 (plus rapide)
  // En local: utiliser le proxy (sert depuis public/)
  const isProduction = '{{ config("app.env") }}' === 'production';
  const r2Url = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev';
  const baseUrl = isProduction ? r2Url + '/taxonomy' : '/proxy/images/taxonomy';
  
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
    // ⚠️ CORRECTION SNES: Utiliser ROM ID, sinon extraire du nom, sinon fallback sur slug
    identifier = game.rom_id;
    if (!identifier && game.name) {
      identifier = extractRomIdFromName(game.name);
    }
    if (!identifier) {
      identifier = game.slug;
    }
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
      'wonderswan': 'wonderswan color',
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
  // En production: servir directement depuis R2 (plus rapide)
  // En local: utiliser le proxy (sert depuis public/)
  const isProduction = '{{ config("app.env") }}' === 'production';
  const r2Url = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev';
  const baseUrl = isProduction ? r2Url + '/taxonomy' : '/proxy/images/taxonomy';
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
    // ⚠️ CORRECTION SNES: Utiliser ROM ID, sinon extraire du nom, sinon fallback sur slug
    identifier = game.rom_id;
    if (!identifier && game.name) {
      identifier = extractRomIdFromName(game.name);
    }
    if (!identifier) {
      identifier = game.slug;
    }
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
      'wonderswan': 'wonderswan color',
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
  // Stocker les informations de l'éditeur pour rafraîchir à la fermeture
  modal.dataset.publisherId = publisherId;
  modal.dataset.publisherName = publisherName;
  
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
    // Récupérer le nom de l'éditeur avant de fermer le modal
    const publisherName = modal.dataset.publisherName;
    
    if (publisherName) {
      console.log('🔄 Rafraîchissement des logos de l\'éditeur lors de la fermeture:', publisherName);
      
      // Rafraîchir tous les logos d'éditeur affichés avec ce nom
      document.querySelectorAll('[id^="publisher-logo-display-"]').forEach(container => {
        const gameId = container.id.replace('publisher-logo-display-', '');
        // Vérifier si ce container affiche cet éditeur
        const gameCard = container.closest('.border');
        if (gameCard) {
          const publisherText = gameCard.querySelector('.text-gray-600');
          if (publisherText && publisherText.textContent.includes(publisherName)) {
            console.log('🔄 Rafraîchissement logo pour game ID:', gameId);
            loadPublisherLogoDisplay(publisherName, gameId);
          }
        }
      });
    }
    
    modal.remove();
  }
};

// Écouter les messages de l'iframe (upload de logo éditeur)
window.addEventListener('message', function(event) {
  if (event.data.type === 'publisher-logo-updated') {
    console.log('📨 Message reçu: logo éditeur mis à jour', event.data);
    const { publisherName } = event.data;
    
    // Rafraîchir tous les logos d'éditeur affichés avec ce nom
    document.querySelectorAll('[id^="publisher-logo-display-"]').forEach(container => {
      const gameId = container.id.replace('publisher-logo-display-', '');
      // Vérifier si ce container affiche cet éditeur (on cherche dans le texte du jeu)
      const gameCard = container.closest('.border');
      if (gameCard) {
        const publisherText = gameCard.querySelector('.text-gray-600');
        if (publisherText && publisherText.textContent.includes(publisherName)) {
          console.log('🔄 Rafraîchissement logo pour game ID:', gameId);
          loadPublisherLogoDisplay(publisherName, gameId);
        }
      }
    });
  }
});

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
  
  // Déterminer l'identifier de la même manière que dans displayGameResult
  const nameBasedPlatforms = ['wonderswan', 'megadrive', 'segasaturn', 'gamegear'];
  let identifier;
  
  if (nameBasedPlatforms.includes(platform)) {
    // Pour ces plateformes, utiliser le nom (sans extension)
    identifier = game.name
      .replace(/\.ws$/i, '')
      .replace(/\.md$/i, '')
      .replace(/\.gg$/i, '')
      .replace(/\.bin$/i, '')
      .trim();
  } else {
    // ⚠️ CORRECTION SNES: Pour Game Boy et autres, utiliser ROM ID, sinon extraire du nom, sinon slug
    identifier = game.rom_id;
    if (!identifier && game.name) {
      identifier = extractRomIdFromName(game.name);
    }
    if (!identifier) {
      identifier = game.slug;
    }
    
    // Nettoyer les extensions selon la plateforme
    if (identifier && platform === 'gameboy') {
      identifier = identifier
        .replace(/\.gb$/i, '')
        .replace(/\.gbc$/i, '')
        .replace(/\.gba$/i, '')
        .trim();
    } else if (identifier && platform === 'n64') {
      identifier = identifier
        .replace(/\.n64$/i, '')
        .replace(/\.z64$/i, '')
        .replace(/\.v64$/i, '')
        .trim();
    } else if (identifier && platform === 'nes') {
      identifier = identifier
        .replace(/\.nes$/i, '')
        .trim();
    } else if (identifier && platform === 'snes') {
      identifier = identifier
        .replace(/\.sfc$/i, '')
        .replace(/\.smc$/i, '')
        .trim();
    }
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
      'wonderswan': 'wonderswan color',
      'segasaturn': 'segasaturn',
      'megadrive': 'megadrive'
    };
    folder = platformFolders[platform] || platform;
  }
  
  // En production: servir directement depuis R2 (plus rapide)
  // En local: utiliser le proxy
  const isProduction = '{{ config("app.env") }}' === 'production';
  const r2Url = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev';
  const baseUrl = isProduction ? r2Url + '/taxonomy' : '/proxy/images/taxonomy';
  const logoFilename = `${identifier}-logo.png`;
  const fullPath = `${baseUrl}/${folder}/${logoFilename}`;
  const logoUrl = encodeURI(fullPath);
  
  // Ajouter timestamp pour forcer le rechargement (comme pour cover)
  const timestamp = Date.now();
  const logoUrlWithTimestamp = logoUrl.includes('?') ? `${logoUrl}&t=${timestamp}` : `${logoUrl}?t=${timestamp}`;
  
  console.log('🖼️ Chargement logo:', { identifier, folder, logoFilename, logoUrl, logoUrlWithTimestamp });
  
  // Méthode simple comme pour cover/artwork/gameplay
  const img = document.createElement('img');
  img.src = logoUrlWithTimestamp;
  img.alt = game.name + ' logo';
  img.className = 'w-full h-auto max-w-full object-contain';
  
  img.onerror = function() {
    console.error('❌ img.onerror déclenché pour:', logoUrlWithTimestamp);
    logoContainer.innerHTML = '<span class="text-gray-300 text-4xl">✕</span>';
  };
  
  img.onload = function() {
    console.log('✅ Logo chargé!', { width: img.naturalWidth, height: img.naturalHeight });
  };
  
  logoContainer.innerHTML = '';
  logoContainer.appendChild(img);
}

// =====================================================
// FONCTION APPLIQUER LA TAXONOMIE DU JEU AU FORMULAIRE
// =====================================================
let applyTaxonomyTimeout = null;
const gamesCache = new Map(); // Cache pour stocker les objets game et leurs modifications

window.applyGameTaxonomy = function(game, platform) {
  // Debounce pour éviter les doubles exécutions
  if (applyTaxonomyTimeout) {
    console.log('⏸️ Exécution annulée (debounce)');
    clearTimeout(applyTaxonomyTimeout);
  }
  
  applyTaxonomyTimeout = setTimeout(() => {
    // Récupérer la version à jour du jeu depuis le cache si elle existe
    const cachedGame = gamesCache.get(game.id);
    const gameToUse = cachedGame || game;
    console.log('✓ Application taxonomie (v2026-02-08-16h30):', { gameToUse, platform, cached: !!cachedGame });
    
    // Mapping plateforme → marque et sous-catégorie
    const platformMapping = {
      'gameboy': { brand: 'Nintendo', subCategory: 'Game Boy' },
      'n64': { brand: 'Nintendo', subCategory: 'Nintendo 64' },
      'nes': { brand: 'Nintendo', subCategory: 'NES' },
      'snes': { brand: 'Nintendo', subCategory: 'SNES' },
      'megadrive': { brand: 'SEGA', subCategory: 'Mega Drive' },
      'gamegear': { brand: 'SEGA', subCategory: 'Game Gear' },
      'wonderswan': { brand: 'Bandai', subCategory: 'WonderSwan' },
      'wonderswancolor': { brand: 'Bandai', subCategory: 'WonderSwan Color' },
      'segasaturn': { brand: 'SEGA', subCategory: 'Sega Saturn' }
    };
    
    const mapping = platformMapping[platform];
    
    if (!mapping) {
      console.error('⚠️ Plateforme non reconnue pour la taxonomie automatique:', platform);
      return;
    }
    
    // 0. Remplir ROM ID et année de sortie (UNIQUEMENT si vides)
    const romIdField = document.getElementById('rom_id_field');
    const romIdInput = document.getElementById('rom_id');
    if (romIdField && romIdInput) {
      romIdField.style.display = 'block';
      if (!romIdInput.value || romIdInput.value.trim() === '') {
        if (gameToUse.rom_id) {
          romIdInput.value = gameToUse.rom_id;
          console.log('✓ ROM ID rempli:', game.rom_id);
        }
      } else {
        console.log('⏭️ ROM ID déjà rempli, conservation:', romIdInput.value);
      }
    }
    
    const yearField = document.getElementById('year_field');
    const yearInput = document.getElementById('year');
    console.log('🗓️ ANNÉE - yearField:', yearField, 'yearInput:', yearInput, 'gameToUse.year:', gameToUse.year);
    
    if (yearField && yearInput) {
      yearField.style.display = 'block';
      // Toujours remplir l'année depuis gameToUse (permet de corriger les erreurs)
      const year = gameToUse.year || gameToUse.release_year || gameToUse.release_date?.substring(0, 4) || '';
      console.log('🗓️ ANNÉE extraite:', year);
      if (year) {
        const oldValue = yearInput.value;
        yearInput.value = year;
        if (oldValue && oldValue !== year) {
          console.log('🔄 Année mise à jour:', oldValue, '→', year);
        } else {
          console.log('✓ Année remplie:', year);
        }
      } else {
        console.log('📅 Pas d\'année dans la BDD pour ce jeu');
      }
    } else {
      console.error('❌ Champs année introuvables!', { yearField, yearInput });
    }
    
    // Remplir région (UNIQUEMENT si vide)
    const regionField = document.getElementById('region_field');
    const regionSelect = document.getElementById('region');
    if (regionField && regionSelect) {
      regionField.style.display = 'block';
      if (!regionSelect.value || regionSelect.value.trim() === '') {
        if (gameToUse.region) {
          regionSelect.value = gameToUse.region;
          console.log('✓ Région remplie:', game.region);
        } else {
          console.warn('⚠️ Pas de région dans les données du jeu');
        }
      } else {
        console.log('⏭️ Région déjà remplie, conservation:', regionSelect.value);
      }
    }
    
    // Remplir éditeur (UNIQUEMENT si vide)
    const publisherField = document.getElementById('publisher_field');
    const publisherSelect = document.getElementById('publisher');
    if (publisherField && publisherSelect) {
      publisherField.style.display = 'block';
      if ((!publisherSelect.value || publisherSelect.value.trim() === '') && gameToUse.publisher) {
        // Vérifier si l'option existe
        const publisherOption = Array.from(publisherSelect.options).find(opt => 
          opt.value.toLowerCase() === gameToUse.publisher.toLowerCase()
        );
        
        if (publisherOption) {
          // L'option existe, la sélectionner
          publisherSelect.value = publisherOption.value;
          console.log('✓ Éditeur rempli:', gameToUse.publisher);
        } else {
          // L'option n'existe pas, la créer
          const newOption = new Option(gameToUse.publisher, gameToUse.publisher, true, true);
          // Insérer dans le groupe "Autres"
          const autresGroup = Array.from(publisherSelect.querySelectorAll('optgroup')).find(g => 
            g.label.includes('Autres')
          );
          if (autresGroup) {
            autresGroup.appendChild(newOption);
          } else {
            publisherSelect.add(newOption);
          }
          console.log('✓ Éditeur créé et rempli:', gameToUse.publisher);
        }
      } else if (publisherSelect.value && publisherSelect.value.trim() !== '') {
        console.log('⏭️ Éditeur déjà rempli, conservation:', publisherSelect.value);
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
    
    // Attendre que les marques se chargent (polling avec retry)
    const waitForBrands = (attempts = 0) => {
      const brandSelect = document.getElementById('article_brand_id');
      if (!brandSelect) return;
      
      // DÉFINIR TOUTES LES FONCTIONS IMBRIQUÉES D'ABORD
      const waitForSubCategories = (attempts = 0) => {
        const subCategorySelect = document.getElementById('article_sub_category_id');
        if (!subCategorySelect) return;
        
        if (subCategorySelect.options.length > 1) {
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
          
          // Attendre que les types se chargent (polling)
          waitForTypes();
        } else if (attempts < 10) {
          setTimeout(() => waitForSubCategories(attempts + 1), 200);
        }
      };
      
      const waitForTypes = (attempts = 0) => {
        const typeSelect = document.getElementById('article_type_id');
        if (!typeSelect) {
          console.error('❌ Select des types introuvable');
          return;
        }
        
        // Vérifier si les types sont chargés (plus qu'une option "Sélectionner")
        if (typeSelect.options.length > 1 || attempts >= 10) {
          console.log('✓ Select des types chargé, options:', typeSelect.options.length);
          
          // 4. Créer automatiquement le type (ROM-ID + nom)
          const romId = gameToUse.rom_id || gameToUse.slug || '';
          const typeName = romId ? `${romId} - ${gameToUse.name}` : gameToUse.name;
          
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
                publisher: gameToUse.publisher || null
              })
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                console.log('✓ Type créé ou trouvé:', data.type);
                
                // Polling pour attendre que le select soit prêt à recevoir la nouvelle option
                const selectTypeOption = (retryCount = 0) => {
                  const typeSelect = document.getElementById('article_type_id');
                  if (!typeSelect) {
                    console.error('❌ Select des types introuvable lors de la sélection');
                    return;
                  }
                  
                  // Vérifier si l'option existe déjà
                  let typeOption = Array.from(typeSelect.options).find(opt => opt.value == data.type.id);
                  
                  if (!typeOption && retryCount < 5) {
                    // L'option n'existe pas encore et on n'a pas dépassé le nombre de tentatives
                    console.log(`⏳ Tentative ${retryCount + 1}/5 : ajout de l'option type`);
                    const newOption = new Option(data.type.name, data.type.id, true, true);
                    typeSelect.add(newOption);
                    
                    // Vérifier si l'option a bien été ajoutée
                    setTimeout(() => {
                      const verifyOption = Array.from(typeSelect.options).find(opt => opt.value == data.type.id);
                      if (verifyOption) {
                        typeSelect.value = data.type.id;
                        
                        // Mettre à jour immédiatement window.currentArticleTypeId
                        window.currentArticleTypeId = data.type.id;
                        console.log('🔧 window.currentArticleTypeId mis à jour:', window.currentArticleTypeId);
                        
                        typeSelect.dispatchEvent(new Event('change'));
                        console.log('✓ Type sélectionné:', data.type.name);
                      } else {
                        selectTypeOption(retryCount + 1);
                      }
                    }, 200);
                  } else if (typeOption) {
                    // L'option existe déjà, la sélectionner
                    typeSelect.value = data.type.id;
                    
                    // Mettre à jour immédiatement window.currentArticleTypeId
                    window.currentArticleTypeId = data.type.id;
                    console.log('🔧 window.currentArticleTypeId mis à jour:', window.currentArticleTypeId);
                    
                    typeSelect.dispatchEvent(new Event('change'));
                    console.log('✓ Type sélectionné (existant):', data.type.name);
                  } else {
                    console.error('❌ Impossible d\'ajouter/sélectionner le type après 5 tentatives');
                  }
                };
                
                selectTypeOption();
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
        } else {
          // Les types ne sont pas encore chargés, réessayer
          console.log(`⏳ Attente chargement types (tentative ${attempts + 1}/10)`);
          setTimeout(() => waitForTypes(attempts + 1), 200);
        }
      };
      
      // MAINTENANT UTILISER LES FONCTIONS
      // Vérifier si les marques sont chargées (plus qu'une option "Sélectionner")
      if (brandSelect.options.length > 1) {
        const brandOption = Array.from(brandSelect.options).find(opt => 
          opt.text.toLowerCase().includes(mapping.brand.toLowerCase())
        );
        
        if (brandOption) {
          // La marque existe, la sélectionner
          brandSelect.value = brandOption.value;
          brandSelect.dispatchEvent(new Event('change'));
          console.log('✓ Marque sélectionnée:', brandOption.text);
          
          // Continuer avec les sous-catégories
          waitForSubCategories();
        } else {
          // La marque n'existe pas, la créer automatiquement
          console.log('🔨 Création de la marque:', mapping.brand);
          
          const categorySelect = document.getElementById('article_category_id');
          const categoryId = categorySelect ? categorySelect.value : null;
          
          if (categoryId) {
            fetch('{{ route("admin.taxonomy.brand.auto-create") }}', {
              method: 'POST',
              headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                'Content-Type': 'application/json'
              },
              body: JSON.stringify({
                article_category_id: categoryId,
                name: mapping.brand
              })
            })
            .then(response => response.json())
            .then(data => {
              if (data.success) {
                console.log('✓ Marque créée:', data.brand);
                
                // Ajouter l'option au select
                const newOption = new Option(data.brand.name, data.brand.id, true, true);
                brandSelect.add(newOption);
                brandSelect.dispatchEvent(new Event('change'));
                
                // Continuer avec les sous-catégories
                waitForSubCategories();
              } else {
                console.error('⚠️ Marque non créée:', data.message || 'Erreur inconnue');
              }
            })
            .catch(error => {
              console.error('Erreur création marque:', error);
            });
          } else {
            console.error('❌ Impossible de créer la marque: catégorie non sélectionnée');
          }
        }
      } else if (attempts < 10) {
        setTimeout(() => waitForBrands(attempts + 1), 200);
      }
    };
    waitForBrands();
    
    applyTaxonomyTimeout = null;
  }, 100); // Debounce de 100ms
};

// =====================================================
// OUVRIR LE MODAL DE TAXONOMIE POUR L'ARTICLE EN COURS
// =====================================================
window.openTaxonomyImagesForArticle = function() {
  const romId = @json($console->rom_id ?? null);
  const articleTypeId = @json($console->article_type_id ?? null);
  const articleTypeName = @json($console->articleType->name ?? null);
  const subCategoryName = @json($console->articleSubCategory->name ?? null);
  const categoryName = @json($console->articleCategory->name ?? null);
  
  // ⚠️ CORRECTION SNES: Extraire le ROM ID du nom si la colonne rom_id est vide
  let identifier = romId;
  if (!identifier && articleTypeName) {
    // Essayer d'extraire le ROM ID du nom (format: "SHVC-MW - Super Mario World")
    identifier = extractRomIdFromName(articleTypeName);
  }
  // Fallback sur le nom complet si aucun ROM ID trouvé
  if (!identifier) {
    identifier = articleTypeName;
  }
  
  if (!identifier) {
    alert('❌ Pas d\'identifiant défini pour cet article (ROM ID ou Type requis)');
    return;
  }
  
  // ⚠️ CORRECTION: Mapping correct des sous-catégories vers les dossiers R2
  let folder = '';
  
  if (categoryName && categoryName.includes('Jeux vidéo')) {
    // Pour les jeux : mapper la sous-catégorie vers le dossier R2 correct
    const subCatLower = (subCategoryName || '').toLowerCase();
    const platformMapping = {
      'game boy advance': 'game boy advance',
      'gba': 'game boy advance',
      'game boy color': 'game boy color',
      'gbc': 'game boy color',
      'game boy': 'gameboy',
      'gameboy': 'gameboy',
      'super nintendo': 'snes',
      'snes': 'snes',
      'super famicom': 'snes',
      'nintendo 64': 'n64',
      'n64': 'n64',
      'nes': 'nes',
      'famicom': 'nes',
      'wonder swan': 'wonderswan',
      'wonderswan': 'wonderswan',
      'wonder swan color': 'wonderswan color',
      'wonderswan color': 'wonderswan color',
      'mega drive': 'megadrive',
      'megadrive': 'megadrive',
      'genesis': 'megadrive',
      'game gear': 'gamegear',
      'gamegear': 'gamegear',
      'sega saturn': 'segasaturn',
      'saturn': 'segasaturn',
    };
    
    // Chercher une correspondance exacte ou partielle
    folder = platformMapping[subCatLower] || null;
    if (!folder) {
      // Fallback: chercher une correspondance partielle
      for (const [key, value] of Object.entries(platformMapping)) {
        if (subCatLower.includes(key)) {
          folder = value;
          break;
        }
      }
    }
    folder = folder || 'gameboy'; // Fallback par défaut
  } else if (categoryName) {
    // Pour autres catégories : utiliser la catégorie (consoles, accessoires)
    folder = categoryName.toLowerCase().replace(/\s+/g, '');
  } else {
    folder = 'other';
  }
  
  // Construire l'objet pour le modal
  const item = {
    rom_id: identifier,
    name: articleTypeName || 'Article',
    platform: subCategoryName || categoryName || 'Generic',
    slug: identifier.toLowerCase().replace(/\s+/g, '-')
  };
  
  console.log('📂 Ouverture modal taxonomie pour article:', { item, folder, identifier, isGame: !!romId });
  
  // Ouvrir le modal avec les données de l'article
  openImageEditorModal(item, item.platform, identifier, folder, 'cover');
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
  uploadSection.className = 'border-2 border-dashed border-gray-300 rounded-lg p-6 bg-gray-50 hover:bg-gray-100 transition-colors cursor-pointer';
  uploadSection.innerHTML = `
    <div class="text-center">
      <div class="text-4xl mb-2">📤</div>
      <h4 class="font-semibold text-gray-700 mb-2">Ajouter des images</h4>
      <p class="text-sm text-gray-500 mb-3">
        <span class="font-semibold">Glissez-déposez vos images ici</span> ou sélectionnez-les
      </p>
      
      <div class="flex items-center justify-center gap-3 mb-4">
        <label class="text-sm font-medium text-gray-700">Type d'image :</label>
        <select id="taxonomy-upload-type" class="border border-gray-300 rounded px-3 py-2 text-sm font-medium">
          <option value="cover">📖 Cover</option>
          <option value="logo">🏷️ Logo</option>
          <option value="artwork">🎨 Artwork</option>
          <option value="gameplay">🎮 Gameplay</option>
        </select>
      </div>
      
      <input type="file" id="taxonomy-image-upload" accept="image/*" multiple class="hidden">
      <button onclick="document.getElementById('taxonomy-image-upload').click()" 
              class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
        📂 Parcourir
      </button>
    </div>
  `;
  
  // Drag & Drop handlers
  uploadSection.ondragover = (e) => {
    e.preventDefault();
    e.stopPropagation();
    uploadSection.classList.remove('bg-gray-50', 'border-gray-300');
    uploadSection.classList.add('border-blue-500', 'bg-blue-100', 'border-4', 'scale-105');
  };
  
  uploadSection.ondragenter = (e) => {
    e.preventDefault();
    e.stopPropagation();
  };
  
  uploadSection.ondragleave = (e) => {
    e.preventDefault();
    e.stopPropagation();
    // Vérifier qu'on quitte vraiment la zone (pas juste un enfant)
    if (e.target === uploadSection) {
      uploadSection.classList.remove('border-blue-500', 'bg-blue-100', 'border-4', 'scale-105');
      uploadSection.classList.add('bg-gray-50', 'border-gray-300');
    }
  };
  
  uploadSection.ondrop = (e) => {
    e.preventDefault();
    e.stopPropagation();
    uploadSection.classList.remove('border-blue-500', 'bg-blue-100', 'border-4', 'scale-105');
    uploadSection.classList.add('bg-gray-50', 'border-gray-300');
    
    const files = e.dataTransfer.files;
    const selectedType = document.getElementById('taxonomy-upload-type')?.value || 'cover';
    
    if (files.length > 0) {
      // Feedback visuel
      uploadSection.classList.add('animate-pulse');
      setTimeout(() => uploadSection.classList.remove('animate-pulse'), 500);
      
      handleTaxonomyImageUpload(files, identifier, folder, platform, selectedType);
    }
  };
  
  // Clic sur toute la zone pour ouvrir le sélecteur
  uploadSection.onclick = (e) => {
    // Ne pas déclencher si on clique sur le select ou le bouton
    if (e.target.tagName !== 'SELECT' && e.target.tagName !== 'OPTION' && e.target.tagName !== 'BUTTON') {
      document.getElementById('taxonomy-image-upload').click();
    }
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
    <div id="taxonomy-images-grid" class="grid grid-cols-2 sm:grid-cols-4 gap-4">
      <div class="col-span-2 sm:col-span-4 text-center text-gray-500">
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
          <option value="logo" ${image.type === 'logo' ? 'selected' : ''}>🏷️ Logo</option>
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
        deleteBtn.type = 'button';
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
          setPrimaryBtn.type = 'button';
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
      countInfo.className = 'col-span-2 sm:col-span-4 text-center text-sm text-gray-600 mt-2 pt-2 border-t';
      countInfo.textContent = `Total : ${data.total} image${data.total > 1 ? 's' : ''}`;
      gridContainer.appendChild(countInfo);
      
    } else {
      gridContainer.innerHTML = `
        <div class="col-span-2 sm:col-span-4 text-center text-gray-400 py-8">
          <div class="text-4xl mb-2">📭</div>
          <div>Aucune image trouvée pour ce jeu</div>
        </div>
      `;
    }
  } catch (e) {
    console.error('Erreur chargement images:', e);
    gridContainer.innerHTML = `
      <div class="col-span-2 sm:col-span-4 text-center text-red-500 py-8">
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
  console.log('🔄 refreshGameImages appelé:', { game, platform, identifier, folder });
  
  // Trouver la grille d'images existante
  const contentDiv = document.getElementById('game-results-content');
  if (!contentDiv) return;
  
  // Rafraîchir la cover principale
  const coverImg = document.getElementById('game-cover-' + game.id);
  if (coverImg) {
    const timestamp = Date.now();
    const currentSrc = coverImg.src.split('?')[0]; // Retirer l'ancien timestamp
    coverImg.src = `${currentSrc}?t=${timestamp}`;
    console.log('✅ Cover rafraîchie');
  }
  
  // Rafraîchir le logo du jeu
  loadGameLogo(game, platform);
  console.log('✅ Logo du jeu rafraîchi');
  
  // Trouver la grille d'images par ID
  const imagesGrid = document.getElementById('game-images-preview-grid');
  if (!imagesGrid) {
    console.warn('⚠️ Grille d\'images non trouvée');
    return;
  }
  
  // Vider la grille
  imagesGrid.innerHTML = '';
  
  const imageTypes = [
    { type: 'cover', label: '📖 Cover', icon: '📖' },
    { type: 'logo', label: '🏷️ Logo', icon: '🏷️' },
    { type: 'artwork', label: '🎨 Artwork', icon: '🎨' },
    { type: 'gameplay', label: '🎮 Gameplay', icon: '🎮' }
  ];
  
  // Recréer les images avec cache-busting
  const timestamp = Date.now();
  const isProduction = '{{ config("app.env") }}' === 'production';
  const r2Url = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev';
  const baseUrl = isProduction ? r2Url + '/taxonomy' : '/proxy/images/taxonomy';
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
  
  console.log('✅ Grille d\'images 4x rechargée');
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
    
    // Vérifier si la réponse est bien du JSON
    const contentType = response.headers.get('content-type');
    if (!contentType || !contentType.includes('application/json')) {
      const text = await response.text();
      console.error('❌ Réponse HTML au lieu de JSON:', text.substring(0, 500));
      throw new Error('Le serveur a retourné une erreur. Vérifiez la console pour plus de détails.');
    }
    
    const data = await response.json();
    
    if (data.success) {
      alert('✅ ' + data.message);
      // Recharger les images dans la modal au lieu de fermer
      loadTaxonomyImages(identifier, folder);
      
      // Si c'est un logo, rafraîchir aussi le logo dans la vue principale
      if (selectedType === 'logo') {
        const modal = document.getElementById('image-editor-modal');
        if (modal && modal.dataset.game) {
          try {
            const game = JSON.parse(modal.dataset.game);
            const platform = modal.dataset.platform;
            
            // Rafraîchir le logo du jeu dans la vue principale
            setTimeout(() => {
              loadGameLogo(game, platform);
            }, 500); // Petit délai pour que l'image soit bien uploadée
          } catch (e) {
            console.error('Erreur lors du rafraîchissement du logo:', e);
          }
        }
      }
      
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
      
      // Si on a renommé vers un logo, rafraîchir le logo dans la vue principale
      if (newType.startsWith('logo')) {
        const modal = document.getElementById('image-editor-modal');
        if (modal && modal.dataset.game) {
          try {
            const game = JSON.parse(modal.dataset.game);
            const platform = modal.dataset.platform;
            
            setTimeout(() => {
              loadGameLogo(game, platform);
            }, 500);
          } catch (e) {
            console.error('Erreur lors du rafraîchissement du logo:', e);
          }
        }
      }
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
      // Recharger les images dans la modal
      loadTaxonomyImages(identifier, folder);
      
      // Rafraîchir aussi les images dans l'affichage principal
      const modal = document.getElementById('image-editor-modal');
      if (modal && modal.dataset.game) {
        try {
          const game = JSON.parse(modal.dataset.game);
          const platform = modal.dataset.platform;
          console.log('🔄 Rafraîchissement après suppression:', { game, platform, identifier, folder });
          refreshGameImages(game, platform, identifier, folder);
        } catch (e) {
          console.error('Erreur rafraîchissement après suppression:', e);
        }
      }
    } else {
      alert('❌ Erreur: ' + data.message);
    }
  } catch (e) {
    console.error('Erreur suppression:', e);
    alert('❌ Erreur lors de la suppression');
  }
}

// Afficher le résultat de la recherche avec l'image (v2.1 - Structure mise à jour)
window.displayGameResult = async function(game, platform) {
  console.log('🎮 displayGameResult v2.1 - Début', { game, platform });
  
  // Stocker l'objet game dans le cache pour pouvoir le mettre à jour
  gamesCache.set(game.id, game);
  
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
  resultContainer.className = 'flex flex-col sm:flex-row gap-4';
  
  // Colonne gauche: Image cover + Logo du jeu côte-à-côte
  const leftColumn = document.createElement('div');
  leftColumn.className = 'flex-shrink-0 flex flex-col gap-2';
  
  // Container pour cover et logo du jeu (côte-à-côte)
  const coverAndLogoRow = document.createElement('div');
  coverAndLogoRow.className = 'flex gap-2';
  
  // Image cover (avec fallback logo/artwork)
  const imageUrl = await getGameImageWithFallback(game, platform);
  const imageContainer = document.createElement('div');
  imageContainer.className = 'w-32';
  imageContainer.id = 'game-cover-container-' + game.id;
  
  if (imageUrl) {
    const img = document.createElement('img');
    // Ajouter timestamp pour forcer le rechargement
    const timestamp = Date.now();
    img.src = imageUrl.includes('?') ? `${imageUrl}&t=${timestamp}` : `${imageUrl}?t=${timestamp}`;
    img.alt = game.name;
    img.id = 'game-cover-' + game.id;
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
  
  // Logo du jeu à droite de la cover
  const gameLogo = document.createElement('div');
  gameLogo.className = 'w-32 h-32 flex items-center justify-center';
  gameLogo.id = 'game-logo-' + game.id;
  gameLogo.innerHTML = '<span class="text-gray-300 text-4xl">✕</span>';
  
  coverAndLogoRow.appendChild(imageContainer);
  coverAndLogoRow.appendChild(gameLogo);
  
  // Logo éditeur sous la cover
  const publisherLogoContainer = document.createElement('div');
  publisherLogoContainer.id = 'publisher-logo-display-' + game.id;
  publisherLogoContainer.className = 'w-32 h-16 flex items-center justify-center';
  publisherLogoContainer.innerHTML = '<span class="text-xl text-gray-300">📚</span>';
  
  leftColumn.appendChild(coverAndLogoRow);
  leftColumn.appendChild(publisherLogoContainer);
  
  // Container principal pour infos uniquement
  const mainInfoContainer = document.createElement('div');
  mainInfoContainer.className = 'flex-1';
  
  // Informations de base uniquement
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
  
  // Assembler le container d'infos
  mainInfoContainer.appendChild(basicInfoColumn);
  
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
  nameInput.onkeydown = (e) => {
    if (e.key === 'Enter') {
      e.preventDefault();
      nameInput.blur(); // Déclenche onchange
    }
  };
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
  yearInput.onkeydown = (e) => {
    if (e.key === 'Enter') {
      e.preventDefault();
      yearInput.blur(); // Déclenche onchange
    }
  };
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
      // Sauvegarder si la valeur a changé
      if (publisherInput.value !== (game.publisher || '')) {
        updateGameField(game.id, platform, 'publisher', publisherInput.value);
      }
    }, 300);
  };
  
  publisherInput.onkeydown = (e) => {
    if (e.key === 'Enter') {
      e.preventDefault();
      // Si des suggestions sont ouvertes, ne rien faire (elles seront gérées par leur propre onclick)
      const suggestionsVisible = !publisherSuggestions.classList.contains('hidden');
      if (!suggestionsVisible) {
        publisherInput.blur(); // Déclenche onblur qui sauvegarde
      }
    }
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
    // ⚠️ CORRECTION SNES: Utiliser ROM ID, sinon extraire du nom, sinon fallback sur slug
    identifier = game.rom_id;
    if (!identifier && game.name) {
      identifier = extractRomIdFromName(game.name);
    }
    if (!identifier) {
      identifier = game.slug;
    }
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
      'wonderswan': 'wonderswan color',
      'segasaturn': 'segasaturn',
      'megadrive': 'megadrive'
    };
    folder = platformFolders[platform] || platform;
  }
  
  // Section des images
  const imagesSection = document.createElement('div');
  imagesSection.className = 'mt-6 border-t pt-4';
  
  const imagesTitle = document.createElement('h5');
  imagesTitle.className = 'font-semibold text-sm text-gray-700 mb-3';
  imagesTitle.textContent = 'Images disponibles';
  
  imagesSection.appendChild(imagesTitle);
  
  const imagesGrid = document.createElement('div');
  imagesGrid.className = 'grid grid-cols-2 sm:grid-cols-4 gap-3';
  imagesGrid.id = 'game-images-preview-grid';
  
  // Types d'images à afficher
  const imageTypes = [
    { type: 'cover', label: 'Cover' },
    { type: 'logo', label: 'Logo' },
    { type: 'artwork', label: 'Artwork' },
    { type: 'gameplay', label: 'Gameplay' }
  ];
  
  const isProduction = '{{ config("app.env") }}' === 'production';
  const r2Url = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev';
  const baseUrl = isProduction ? r2Url + '/taxonomy' : '/proxy/images/taxonomy';
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
  
  // Boutons en dessous de la grille d'images
  const buttonsContainer = document.createElement('div');
  buttonsContainer.className = 'flex items-center justify-center gap-3 mt-4';
  
  // Bouton "Appliquer au formulaire"
  const applyToFormButton = document.createElement('button');
  applyToFormButton.type = 'button';
  applyToFormButton.className = 'bg-green-600 hover:bg-green-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 shadow-lg hover:shadow-xl transition-all';
  applyToFormButton.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Appliquer ces modifications au formulaire';
  applyToFormButton.title = 'Remplir automatiquement la taxonomie de l\'article';
  applyToFormButton.onclick = (e) => {
    e.preventDefault();
    e.stopPropagation();
    applyGameTaxonomy(game, platform);
  };
  
  // Bouton d'édition global pour toutes les images
  const globalEditButton = document.createElement('button');
  globalEditButton.type = 'button';
  globalEditButton.className = 'bg-blue-600 hover:bg-blue-700 text-white px-6 py-2.5 rounded-lg text-sm font-medium flex items-center gap-2 shadow-lg hover:shadow-xl transition-all';
  globalEditButton.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg> Gérer les images';
  globalEditButton.onclick = (e) => {
    e.preventDefault();
    e.stopPropagation();
    openImageEditorModal(game, platform, identifier, folder, 'cover');
  };
  
  buttonsContainer.appendChild(applyToFormButton);
  buttonsContainer.appendChild(globalEditButton);
  
  imagesSection.appendChild(buttonsContainer);
  
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

// Autocomplétion jeux - voir public/js/game-autocomplete.js

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
      // Mettre à jour le cache avec la nouvelle valeur
      const cachedGame = gamesCache.get(gameId);
      if (cachedGame) {
        cachedGame[field] = value;
        console.log(`📝 Cache mis à jour pour game ${gameId}, ${field} = ${value}`);
      }
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

// ========================================
// TAXONOMIE CASCADE
// ========================================
console.log('📦 TAXONOMIE: Script atteint ligne 3463');

document.addEventListener('DOMContentLoaded', function() {
  console.log('📦 TAXONOMIE: DOMContentLoaded déclenché');
  
  const cat = document.getElementById('article_category_id');
  const brand = document.getElementById('article_brand_id');
  const sub = document.getElementById('article_sub_category_id');
  const type = document.getElementById('article_type_id');

  console.log('📦 TAXONOMIE: Éléments trouvés:', { cat: !!cat, brand: !!brand, sub: !!sub, type: !!type });

  if (!cat || !brand || !sub || !type) {
    console.error('❌ Éléments de taxonomie manquants:', { cat, brand, sub, type });
    return;
  }

  const oldBrand = @json(old('article_brand_id', $console->article_brand_id ?? null));
  const oldSub = @json(old('article_sub_category_id', $console->article_sub_category_id ?? null));
  const oldType = @json(old('article_type_id', $console->article_type_id ?? null));

  console.log('🔍 Valeurs mode édition:', { 
    catValue: cat.value, 
    oldBrand, 
    oldSub, 
    oldType,
    consoleBrandId: @json($console->article_brand_id),
    consoleSubCatId: @json($console->article_sub_category_id),
    consoleTypeId: @json($console->article_type_id),
    brandViaRelation: @json($console->articleSubCategory->brand->id ?? null)
  });

  function clear(sel, placeholder = '— Choisir —') {
    sel.innerHTML = `<option value="">${placeholder}</option>`;
  }

  async function loadBrands(catId) {
    console.log('🔄 loadBrands() appelé avec catId:', catId);
    
    try {
      clear(brand); clear(sub); clear(type);
      console.log('✅ Selects cleared');
      
      if (!catId) {
        console.log('❌ Pas de catId, arrêt');
        return;
      }
      
      // Vérifier que catId est un nombre valide
      if (isNaN(parseInt(catId)) || String(catId).includes('@')) {
        console.error('❌ loadBrands: ID invalide:', catId);
        return;
      }
      
      // Afficher/masquer les champs selon la catégorie
      const languageField = document.getElementById('language_field');
      const regionField = document.getElementById('region_field');
      const publisherField = document.getElementById('publisher_field');
      const articleImagesField = document.getElementById('article_images_field');
      const completenessConsole = document.getElementById('completeness_console');
      const completenessGame = document.getElementById('completeness_game');
      const completenessCards = document.getElementById('completeness_cards');
      const completenessHintConsole = document.getElementById('completeness_hint_console');
      const completenessHintGame = document.getElementById('completeness_hint_game');
      const completenessHintCards = document.getElementById('completeness_hint_cards');
      const brandLabel = document.getElementById('brand_label');
      
      const selectedOption = cat.options[cat.selectedIndex];
      if (!selectedOption) {
        console.error('❌ Pas d\'option sélectionnée dans category select');
        return;
      }
      
      const selectedCategory = selectedOption.text;
      console.log('📁 Catégorie sélectionnée:', selectedCategory);
    
    if (selectedCategory.includes('Cartes à collectionner')) {
      if (languageField) languageField.style.display = 'block';
      if (regionField) regionField.style.display = 'none';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'none';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessCards) completenessCards.style.display = 'block';
      if (completenessHintConsole) completenessHintConsole.style.display = 'none';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (completenessHintCards) completenessHintCards.style.display = 'block';
      if (brandLabel) brandLabel.textContent = 'Marque';
    } else if (selectedCategory.includes('Accessoires')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessCards) completenessCards.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (completenessHintCards) completenessHintCards.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Compatibilité *';
    } else if (selectedCategory.includes('Jeux vidéo')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      // Le champ images sera affiché par le listener du type
      if (completenessConsole) completenessConsole.style.display = 'none';
      if (completenessGame) completenessGame.style.display = 'block';
      if (completenessCards) completenessCards.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'none';
      if (completenessHintGame) completenessHintGame.style.display = 'block';
      if (completenessHintCards) completenessHintCards.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque';
    } else {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      // Le champ images sera affiché par le listener du type
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessCards) completenessCards.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque';
    }
    
      console.log('✅ UI fields updated');
      console.log('🌐 Fetching brands from URL:', `{{ url('admin/ajax/brands') }}/${catId}`);
      
      const url = `{{ url('admin/ajax/brands') }}/${catId}`;
      const response = await fetch(url, {
        credentials: 'same-origin',
        headers: {
          'X-Requested-With': 'XMLHttpRequest',
          'Accept': 'text/html'
        }
      });
      
      console.log('📡 Response status:', response.status);
      console.log('📡 Response headers:', Object.fromEntries(response.headers.entries()));
      
      const html = await response.text();
      console.log('📝 HTML received, length:', html.length, 'chars');
      console.log('📝 HTML preview:', html.substring(0, 200));
      
      // Vérifier si c'est une page HTML complète (login redirect)
      if (html.includes('<!DOCTYPE html>') || html.includes('<html')) {
        console.error('❌ ERREUR: Reçu une page HTML complète au lieu des options!');
        console.error('⚠️  Probablement redirigé vers login - vérifier authentification');
        brand.innerHTML = '<option value="">❌ Erreur: Non authentifié</option>';
        return;
      }
      
      brand.innerHTML = html;
      console.log('✅ Brand select innerHTML updated, options:', brand.options.length);
      
      if (oldBrand) { 
        console.log('🔄 Restoration oldBrand:', oldBrand);
        brand.value = oldBrand; 
        loadSubs(oldBrand); 
      }
    } catch (e) {
      console.error('❌ Erreur dans loadBrands():', e);
      console.error('Stack trace:', e.stack);
    }
  }

  async function loadSubs(brandId) {
    clear(sub); clear(type);
    if (!brandId) return;
    // Vérifier que brandId est un nombre valide
    if (isNaN(parseInt(brandId)) || String(brandId).includes('@')) {
      console.error('❌ loadSubs: ID invalide:', brandId);
      return;
    }
    try {
      const url = `{{ url('admin/ajax/sub-categories') }}/${brandId}`;
      const response = await fetch(url, { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' } });
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
    // Vérifier que subId est un nombre valide (pas un email ou autre texte)
    if (isNaN(parseInt(subId)) || String(subId).includes('@')) {
      console.error('❌ loadTypes: ID invalide:', subId);
      return;
    }
    try {
      const url = `{{ url('admin/ajax/types') }}/${subId}`;
      const response = await fetch(url, { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest' } });
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
      const response = await fetch(`{{ url('admin/ajax/type-description') }}/${typeId}`, { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
      const data = await response.json();
      descTextarea.value = data.description || '';
      descField.style.display = 'block';
    } catch (e) {
      console.error('Erreur chargement description:', e);
      descField.style.display = 'block';
    }
  }

  cat.addEventListener('change', e => {
    console.log('📦 TAXONOMIE: category change event, value:', e.target.value);
    loadBrands(e.target.value);
  });
  brand.addEventListener('change', e => loadSubs(e.target.value));
  sub.addEventListener('change', e => loadTypes(e.target.value));
  type.addEventListener('change', e => loadTypeDescription(e.target.value));

  console.log('📦 TAXONOMIE: Event listeners attachés');
  console.log('📦 TAXONOMIE: cat.value actuel:', cat.value);

  if (cat.value) loadBrands(cat.value);
  
  // ✅ Charger la description si un type est déjà sélectionné (mode édition)
  if (type.value) {
    loadTypeDescription(type.value);
  }
  
  // Afficher/masquer les champs selon la catégorie en mode édition
  window.addEventListener('DOMContentLoaded', () => {
    const languageField = document.getElementById('language_field');
    const regionField = document.getElementById('region_field');
    const completenessConsole = document.getElementById('completeness_console');
    const completenessGame = document.getElementById('completeness_game');
    const completenessCards = document.getElementById('completeness_cards');
    const completenessHintConsole = document.getElementById('completeness_hint_console');
    const completenessHintGame = document.getElementById('completeness_hint_game');
    const completenessHintCards = document.getElementById('completeness_hint_cards');
    const brandLabel = document.getElementById('brand_label');
    const selectedCategory = cat.options[cat.selectedIndex]?.text || '';
    
    if (selectedCategory.includes('Cartes à collectionner')) {
      if (languageField) languageField.style.display = 'block';
      if (regionField) regionField.style.display = 'none';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'none';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessCards) completenessCards.style.display = 'block';
      if (completenessHintConsole) completenessHintConsole.style.display = 'none';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (completenessHintCards) completenessHintCards.style.display = 'block';
      if (brandLabel) brandLabel.textContent = 'Marque';
    } else if (selectedCategory.includes('Accessoires')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (publisherField) publisherField.style.display = 'none';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessCards) completenessCards.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (completenessHintCards) completenessHintCards.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Compatibilité *';
    } else if (selectedCategory.includes('Jeux vidéo')) {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (completenessConsole) completenessConsole.style.display = 'none';
      if (completenessGame) completenessGame.style.display = 'block';
      if (completenessCards) completenessCards.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'none';
      if (completenessHintGame) completenessHintGame.style.display = 'block';
      if (completenessHintCards) completenessHintCards.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque';
    } else {
      if (languageField) languageField.style.display = 'none';
      if (regionField) regionField.style.display = 'block';
      if (completenessConsole) completenessConsole.style.display = 'block';
      if (completenessGame) completenessGame.style.display = 'none';
      if (completenessCards) completenessCards.style.display = 'none';
      if (completenessHintConsole) completenessHintConsole.style.display = 'block';
      if (completenessHintGame) completenessHintGame.style.display = 'none';
      if (completenessHintCards) completenessHintCards.style.display = 'none';
      if (brandLabel) brandLabel.textContent = 'Marque';
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

  // Détecter le type d'article sélectionné pour associer les images
  if (typeSelect) {
    typeSelect.addEventListener('change', function() {
      window.currentArticleTypeId = this.value;
      if (window.currentArticleTypeId) {
        loadExistingImages(window.currentArticleTypeId);
      } else {
        previewContainer.innerHTML = '';
      }
    });

    // Charger les images si un type est déjà sélectionné (mode édition)
    if (typeSelect.value) {
      window.currentArticleTypeId = typeSelect.value;
      loadExistingImages(window.currentArticleTypeId);
    }
  }

  // Charger les images existantes de l'article_type
  async function loadExistingImages(typeId) {
    try {
      const response = await fetch(`{{ url('admin/ajax/type-description') }}/${typeId}`, { credentials: 'same-origin', headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' } });
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
    console.log('📁 handleFiles appelé');
    console.log('🔍 window.currentArticleTypeId actuel:', window.currentArticleTypeId);
    
    // Vérifier si window.currentArticleTypeId existe, sinon récupérer depuis le select
    if (!window.currentArticleTypeId) {
      const typeSelect = document.getElementById('article_type_id');
      if (typeSelect && typeSelect.value) {
        window.currentArticleTypeId = typeSelect.value;
        console.log('✅ article_type_id récupéré depuis le select:', window.currentArticleTypeId);
      } else {
        console.error('❌ Aucun article_type_id disponible');
        alert('Veuillez d\'abord sélectionner un type d\'article');
        return;
      }
    }

    for (let file of files) {
      if (!file.type.startsWith('image/')) continue;

      const formData = new FormData();
      formData.append('image', file);
      formData.append('article_type_id', window.currentArticleTypeId);

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
          addImagePreview(data.url, window.currentArticleTypeId, false);
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

  // ✅ Charger les images existantes en mode édition (initialiser les variables globales)
  window.uploadedGameImages = @json($console->article_images ?? []);
  window.primaryImageUrl = @json($console->primary_image_url ?? null);
  window.genericArticleImages = []; // Images provenant d'autres articles du même type

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
          <button type="button" onclick="document.getElementById('article-image-camera').click()" 
                  class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
            </svg>
            📱 Appareil photo
          </button>
          <button type="button" onclick="document.getElementById('article-image-file').click()" 
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
      <div class="flex items-center justify-between">
        <h4 class="font-semibold text-gray-700">Photos de cet article (<span id="article-images-count">0</span>)</h4>
        <button type="button" onclick="document.getElementById('article-image-camera').click()" 
                class="text-sm bg-indigo-100 hover:bg-indigo-200 text-indigo-700 px-3 py-1.5 rounded-lg font-medium flex items-center gap-1 transition-colors">
          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
          </svg>
          Ajouter
        </button>
      </div>
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
    
    cameraInput.onchange = async (e) => {
      await handleArticleImagesUpload(e.target.files);
      e.target.value = ''; // Réinitialiser pour permettre de reprendre une photo
    };
    
    fileInput.onchange = async (e) => {
      await handleArticleImagesUpload(e.target.files);
      e.target.value = ''; // Réinitialiser
    };
    
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

  // Compresser une image avant l'upload
  async function compressImage(file, maxWidth = 1920, quality = 0.85) {
    return new Promise((resolve) => {
      const reader = new FileReader();
      reader.onload = (e) => {
        const img = new Image();
        img.onload = () => {
          // Calculer les nouvelles dimensions
          let width = img.width;
          let height = img.height;
          
          if (width > maxWidth) {
            height = (height * maxWidth) / width;
            width = maxWidth;
          }
          
          // Créer un canvas pour la compression
          const canvas = document.createElement('canvas');
          canvas.width = width;
          canvas.height = height;
          
          const ctx = canvas.getContext('2d');
          ctx.drawImage(img, 0, 0, width, height);
          
          // Convertir en blob compressé
          canvas.toBlob((blob) => {
            const compressedFile = new File([blob], file.name, {
              type: 'image/jpeg',
              lastModified: Date.now()
            });
            
            const originalSize = (file.size / 1024 / 1024).toFixed(2);
            const compressedSize = (compressedFile.size / 1024 / 1024).toFixed(2);
            console.log(`🗜️ Compression: ${originalSize}MB → ${compressedSize}MB (${((1 - compressedFile.size / file.size) * 100).toFixed(0)}% réduction)`);
            
            resolve(compressedFile);
          }, 'image/jpeg', quality);
        };
        img.src = e.target.result;
      };
      reader.readAsDataURL(file);
    });
  }

  // Gérer l'upload des images d'article
  async function handleArticleImagesUpload(files) {
    const gridContainer = document.getElementById('article-images-grid');
    
    for (const file of Array.from(files)) {
      if (!file.type.startsWith('image/')) {
        console.warn('Fichier ignoré (pas une image):', file.name);
        continue;
      }
      
      const originalSize = (file.size / 1024 / 1024).toFixed(2);
      console.log(`📁 Fichier original: ${file.name} (${originalSize}MB)`);
      
      // Compresser l'image si elle dépasse 2MB
      let processedFile = file;
      if (file.size > 2 * 1024 * 1024) {
        console.log('🔄 Compression en cours...');
        processedFile = await compressImage(file);
      } else {
        console.log('✓ Pas besoin de compression (< 2MB)');
      }
      
      // Créer une prévisualisation immédiate avec légende
      const reader = new FileReader();
      reader.onload = (e) => {
        addArticleImageCard(e.target.result, file.name, 'uploading');
      };
      reader.readAsDataURL(processedFile);
      
      // Upload vers le serveur
      uploadArticleImage(processedFile, file.name);
    }
  }

  // Upload une image vers le serveur
  async function uploadArticleImage(file, originalFileName = null) {
    const fileName = originalFileName || file.name;
    const fileSize = (file.size / 1024 / 1024).toFixed(2);
    
    console.log(`📤 Upload image: ${fileName} (${fileSize}MB)`);
    console.log('🎯 window.currentArticleTypeId:', window.currentArticleTypeId);
    
    if (!window.currentArticleTypeId) {
      alert('Veuillez d\'abord sélectionner un type d\'article');
      return;
    }

    // Vérifier la taille (limite à 50MB)
    if (file.size > 50 * 1024 * 1024) {
      alert(`❌ Fichier trop volumineux: ${fileSize}MB (limite: 50MB)\n\nLa photo a été automatiquement compressée mais reste trop grande.`);
      removeArticleImageCard(fileName);
      return;
    }

    const formData = new FormData();
    formData.append('image', file);
    formData.append('article_type_id', window.currentArticleTypeId);

    try {
      const response = await fetch('{{ route('admin.articles.upload-image') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
      });

      if (!response.ok) {
        const errorText = await response.text();
        console.error('❌ Erreur HTTP:', response.status, errorText);
        
        // Messages d'erreur plus explicites
        if (response.status === 413) {
          alert(`❌ Image trop volumineuse (${fileSize}MB)\n\nLimite serveur dépassée. Veuillez utiliser une image plus petite.`);
        } else if (response.status === 500) {
          alert(`❌ Erreur serveur lors de l'upload\n\nTaille: ${fileSize}MB\nCode: ${response.status}`);
        } else {
          alert(`❌ Erreur upload: ${response.status}\n\nVeuillez réessayer.`);
        }
        removeArticleImageCard(fileName);
        return;
      }

      const data = await response.json();
      console.log('📡 Réponse serveur:', data);

      if (data.success) {
        console.log('✅ Image uploadée:', data.url);
        console.log('📦 Avant push, window.uploadedGameImages:', window.uploadedGameImages);
        
        // Mettre à jour la carte avec l'URL finale
        updateArticleImageCard(fileName, data.url);
        window.uploadedGameImages.push(data.url);
        
        // Si c'est la première image, la définir comme principale automatiquement
        if (!window.primaryImageUrl && window.uploadedGameImages.length === 1) {
          window.primaryImageUrl = data.url;
          console.log('⭐ Première image définie comme principale automatiquement');
        }
        
        console.log('📦 Après push, window.uploadedGameImages:', window.uploadedGameImages);
        
        // Rafraîchir l'aperçu dans le formulaire immédiatement
        refreshArticleImagesPreview();
      } else {
        console.error('Erreur upload:', data.message);
        alert(`❌ Erreur: ${data.message}`);
        removeArticleImageCard(fileName);
      }
    } catch (e) {
      console.error('❌ Exception upload:', e);
      alert(`❌ Erreur lors de l'upload\n\nTaille du fichier: ${fileSize}MB\nErreur: ${e.message}`);
      removeArticleImageCard(fileName);
    }
  }

  // Ajouter une carte d'image dans la modal (fonction globale)
  window.addArticleImageCard = function(imageSrc, fileName, status = 'uploaded', isGeneric = false) {
    const gridContainer = document.getElementById('article-images-grid');
    
    // Si la modal n'est pas ouverte, ne rien faire
    if (!gridContainer) {
      console.log('⚠️ Modal non ouverte, carte non ajoutée visuellement (image ajoutée à la liste)');
      return;
    }
    
    // Retirer le message "Aucune photo"
    if (gridContainer.querySelector('.col-span-full')) {
      gridContainer.innerHTML = '';
    }
    
    const card = document.createElement('div');
    card.className = 'border-2 border-gray-200 rounded-lg p-3 bg-white hover:border-indigo-400 transition-colors';
    card.dataset.fileName = fileName;
    card.dataset.imageUrl = imageSrc;
    if (isGeneric) {
      card.dataset.isGeneric = 'true';
    }
    
    const isPrimary = (window.primaryImageUrl === imageSrc);
    
    card.innerHTML = `
      <div class="relative group">
        <img src="${imageSrc}" class="w-full aspect-square object-cover rounded cursor-pointer hover:opacity-90" 
             onclick="event.stopPropagation(); window.openImageLightbox('${imageSrc}', {isArticleImage: true, isPrimary: ${isPrimary}, article_type_id: window.currentArticleTypeId})">
        
        <div class="absolute top-2 left-2 flex flex-col gap-1">
          ${isPrimary ? `
            <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white text-xs px-3 py-1.5 rounded-full font-bold shadow-lg flex items-center gap-1">
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
              </svg>
              Photo principale
            </div>
          ` : ''}
          ${isGeneric ? `
            <div class="bg-purple-600 bg-opacity-90 text-white text-xs px-2 py-1 rounded font-medium shadow">
              🔗 Partagée
            </div>
          ` : ''}
        </div>
        
        <div class="absolute top-2 right-2 flex gap-1">
          ${status === 'uploading' ? `
            <div class="bg-yellow-500 text-white text-xs px-2 py-1 rounded">⏳</div>
          ` : `
            <button type="button" onclick="setPrimaryImage('${imageSrc}', this)" 
                    class="${isPrimary ? 'bg-indigo-600 ring-2 ring-white' : 'bg-white/80 hover:bg-white'} ${isPrimary ? 'text-white' : 'text-gray-700'} px-2 py-1 rounded text-xs font-medium opacity-0 group-hover:opacity-100 transition-all shadow-md"
                    title="Définir comme photo principale">
              ${isPrimary ? '✓ Principale' : 'Définir principale'}
            </button>
            ${isGeneric ? `
              <button type="button" onclick="deselectGenericImage('${imageSrc}', this)" 
                      class="bg-orange-500 hover:bg-orange-600 text-white p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition-opacity shadow-md"
                      title="Désélectionner (remettre dans les photos partagées)">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2M3 12l6.414 6.414a2 2 0 001.414.586H19a2 2 0 002-2V7a2 2 0 00-2-2h-8.172a2 2 0 00-1.414.586L3 12z"></path>
                </svg>
              </button>
            ` : `
              <button type="button" onclick="deleteArticleImage('${imageSrc}', this)" 
                      class="bg-red-500 text-white p-1.5 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-600 shadow-md"
                      title="Supprimer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
              </button>
            `}
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

  // Retirer une carte d'image (en cas d'erreur d'upload)
  function removeArticleImageCard(fileName) {
    const card = Array.from(document.querySelectorAll('[data-file-name]')).find(
      el => el.dataset.fileName === fileName
    );
    
    if (card) {
      card.remove();
      updateArticleImagesCount();
      
      // S'il ne reste plus aucune image, afficher le message
      const gridContainer = document.getElementById('article-images-grid');
      if (gridContainer && gridContainer.children.length === 0) {
        gridContainer.innerHTML = `
          <div class="col-span-full text-center text-gray-500 py-8">
            📭 Aucune photo pour le moment
          </div>
        `;
      }
    }
  }

  // Définir une image comme principale
  window.setPrimaryImage = function(imageUrl, buttonElement) {
    window.primaryImageUrl = imageUrl;
    console.log('⭐ Image principale définie:', imageUrl);

    // Rafraîchir toutes les cartes pour mettre à jour les badges
    const gridContainer = document.getElementById('article-images-grid');
    if (gridContainer) {
      const cards = gridContainer.querySelectorAll('[data-file-name]');
      cards.forEach(card => {
        const img = card.querySelector('img');
        if (img) {
          const cardImageUrl = img.src.split('?')[0]; // Retirer le cache-busting
          const isPrimary = (cardImageUrl === imageUrl || img.src === imageUrl);
          
          // Mettre à jour le badge principal
          const existingBadge = card.querySelector('.absolute.top-2.left-2');
          if (existingBadge) {
            existingBadge.remove();
          }
          
          if (isPrimary) {
            const badge = document.createElement('div');
            badge.className = 'absolute top-2 left-2 bg-gradient-to-r from-indigo-600 to-indigo-700 text-white text-xs px-3 py-1.5 rounded-full font-bold shadow-lg flex items-center gap-1';
            badge.innerHTML = `
              <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/>
              </svg>
              Photo principale
            `;
            const imgContainer = card.querySelector('.relative.group');
            if (imgContainer) {
              imgContainer.insertBefore(badge, imgContainer.firstChild.nextSibling);
            }
          }
          
          // Mettre à jour le bouton
          const setPrimaryBtn = card.querySelector('[onclick*="setPrimaryImage"]');
          if (setPrimaryBtn) {
            if (isPrimary) {
              setPrimaryBtn.className = 'bg-indigo-600 ring-2 ring-white text-white px-2 py-1 rounded text-xs font-medium opacity-0 group-hover:opacity-100 transition-all shadow-md';
              setPrimaryBtn.textContent = '✓ Principale';
            } else {
              setPrimaryBtn.className = 'bg-white/80 hover:bg-white text-gray-700 px-2 py-1 rounded text-xs font-medium opacity-0 group-hover:opacity-100 transition-all shadow-md';
              setPrimaryBtn.textContent = 'Définir principale';
            }
          }
        }
      });
    }

    refreshArticleImagesPreview();
  };

  // Mettre à jour le compteur d'images
  function updateArticleImagesCount() {
    const countEl = document.getElementById('article-images-count');
    if (countEl) {
      countEl.textContent = window.uploadedGameImages.length;
    }
  }

  // Mettre à jour la légende d'une image
  window.updateArticleImageCaption = function(imageUrl, caption) {
    console.log('📝 Légende mise à jour:', imageUrl, caption);
    // TODO: Sauvegarder la légende en base de données si nécessaire
    // Pour l'instant, juste l'enregistrer en mémoire
  };

  // Charger les images existantes
  async function loadArticleImages() {
    // Charger les images de l'article avec détection des images génériques
    window.uploadedGameImages.forEach((url, index) => {
      const isGeneric = window.genericArticleImages.includes(url);
      addArticleImageCard(url, `Image ${index + 1}`, 'uploaded', isGeneric);
    });
  }

  // Charger les photos génériques du même type d'article
  async function loadGenericArticleImages() {
    if (!window.currentArticleTypeId) {
      const grid = document.getElementById('generic-images-grid');
      if (grid) {
        grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6">Sélectionnez d\'abord un type d\'article</div>';
      }
      return;
    }

    try {
      const response = await fetch(`{{ url('admin/ajax/article-type-images') }}/${window.currentArticleTypeId}`);
      const data = await response.json();
      
      const grid = document.getElementById('generic-images-grid');
      const countEl = document.getElementById('generic-images-count');
      
      if (!grid) return;
      
      grid.innerHTML = '';
      
      if (data.success && data.images && data.images.length > 0) {
        // Recharger les cartes avec le flag isGeneric correct (seulement celles déjà marquées)
        const gridContainer = document.getElementById('article-images-grid');
        if (gridContainer && gridContainer.children.length > 0 && window.genericArticleImages.length > 0) {
          // Supprimer toutes les cartes et les recréer avec le bon flag
          gridContainer.innerHTML = '';
          window.uploadedGameImages.forEach((url, index) => {
            const isGeneric = window.genericArticleImages.includes(url);
            addArticleImageCard(url, `Image ${index + 1}`, 'uploaded', isGeneric);
          });
        }
        
        // Filtrer les images déjà utilisées dans cet article
        const availableImages = data.images.filter(url => !window.uploadedGameImages.includes(url));
        
        if (countEl) {
          countEl.textContent = `${availableImages.length} photo${availableImages.length > 1 ? 's' : ''} disponible${availableImages.length > 1 ? 's' : ''}`;
        }
        
        if (availableImages.length === 0) {
          grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6">Toutes les photos d\'autres articles sont déjà ajoutées</div>';
          return;
        }
        
        // Limiter l'affichage initial à 30 images pour performances
        const imagesToShow = availableImages.slice(0, 30);
        const hasMore = availableImages.length > 30;
        
        // Stocker toutes les images pour "Charger plus"
        if (!window.allGenericImages) window.allGenericImages = [];
        window.allGenericImages = availableImages;
        window.currentGenericOffset = 30;
        
        imagesToShow.forEach(url => {
          const card = document.createElement('div');
          card.className = 'relative group cursor-pointer border-2 border-gray-200 rounded-lg overflow-hidden hover:border-indigo-500 transition-all hover:shadow-lg';
          card.onclick = () => addGenericImageToArticle(url);
          
          card.innerHTML = `
            <div class="aspect-square bg-gray-100">
              <img loading="lazy" src="${url}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='<div class=\\'w-full h-full flex items-center justify-center text-gray-400\\'>❌ Image introuvable</div>'">
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
        
        // Bouton "Charger plus" si plus de 30 images
        if (hasMore) {
          const loadMoreBtn = document.createElement('div');
          loadMoreBtn.id = 'load-more-generic-btn';
          loadMoreBtn.className = 'col-span-full text-center py-4';
          loadMoreBtn.innerHTML = `
            <button type="button" onclick="loadMoreGenericImages()" 
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium shadow-md hover:shadow-lg transition-all">
              📥 Charger ${availableImages.length - 30} photos supplémentaires
            </button>
          `;
          grid.appendChild(loadMoreBtn);
        }
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
  // Charger plus d'images génériques (pagination)
  window.loadMoreGenericImages = function() {
    const grid = document.getElementById('generic-images-grid');
    const loadMoreBtn = document.getElementById('load-more-generic-btn');
    
    if (!grid || !window.allGenericImages) return;
    
    const nextBatch = window.allGenericImages.slice(window.currentGenericOffset, window.currentGenericOffset + 30);
    const remaining = window.allGenericImages.length - window.currentGenericOffset - 30;
    
    // Retirer le bouton "Charger plus"
    if (loadMoreBtn) loadMoreBtn.remove();
    
    // Ajouter les nouvelles images
    nextBatch.forEach(url => {
      const card = document.createElement('div');
      card.className = 'relative group cursor-pointer border-2 border-gray-200 rounded-lg overflow-hidden hover:border-indigo-500 transition-all hover:shadow-lg';
      card.onclick = () => addGenericImageToArticle(url);
      
      card.innerHTML = `
        <div class="aspect-square bg-gray-100">
          <img loading="lazy" src="${url}" class="w-full h-full object-cover" onerror="this.parentElement.innerHTML='<div class=\\'w-full h-full flex items-center justify-center text-gray-400\\'>❌ Image introuvable</div>'">
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
    
    window.currentGenericOffset += 30;
    
    // Rajouter le bouton s'il reste encore des images
    if (remaining > 0) {
      const newLoadMoreBtn = document.createElement('div');
      newLoadMoreBtn.id = 'load-more-generic-btn';
      newLoadMoreBtn.className = 'col-span-full text-center py-4';
      newLoadMoreBtn.innerHTML = `
        <button type="button" onclick="loadMoreGenericImages()" 
                class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium shadow-md hover:shadow-lg transition-all">
          📥 Charger ${remaining} photos supplémentaires
        </button>
      `;
      grid.appendChild(newLoadMoreBtn);
    }
  };

  async function addGenericImageToArticle(imageUrl) {
    if (window.uploadedGameImages.includes(imageUrl)) {
      alert('Cette photo est déjà ajoutée');
      return;
    }
    
    console.log('➕ Ajout photo générique:', imageUrl);
    
    // Ajouter à la liste des images uploadées
    window.uploadedGameImages.push(imageUrl);
    
    // Marquer comme image générique
    if (!window.genericArticleImages.includes(imageUrl)) {
      window.genericArticleImages.push(imageUrl);
    }
    
    // Si c'est la première image, la définir comme principale
    if (!window.primaryImageUrl) {
      window.primaryImageUrl = imageUrl;
      console.log('⭐ Photo générique définie comme principale automatiquement');
    }
    
    // Ajouter la carte dans la section "Photos de cet article" avec le flag isGeneric
    const fileName = imageUrl.split('/').pop();
    addArticleImageCard(imageUrl, fileName, 'uploaded', true);
    
    // Rafraîchir l'aperçu
    refreshArticleImagesPreview();
    
    // Recharger les photos génériques pour retirer celle qui vient d'être ajoutée
    loadGenericArticleImages();
    
    console.log('✅ Photo générique ajoutée');
  }

  // Désélectionner une image générique
  window.deselectGenericImage = async function(imageUrl, buttonElement) {
    console.log('🔙 Désélection photo générique:', imageUrl);
    
    // Retirer de la liste des images uploadées
    const index = window.uploadedGameImages.indexOf(imageUrl);
    if (index > -1) {
      window.uploadedGameImages.splice(index, 1);
    }
    
    // Si c'était l'image principale, réinitialiser
    if (window.primaryImageUrl === imageUrl) {
      window.primaryImageUrl = window.uploadedGameImages.length > 0 ? window.uploadedGameImages[0] : null;
    }
    
    // Retirer la carte visuellement
    const card = buttonElement.closest('[data-file-name]');
    if (card) {
      card.remove();
    }
    
    updateArticleImagesCount();
    refreshArticleImagesPreview();
    
    // Recharger les photos génériques pour la remettre dans la liste
    loadGenericArticleImages();
    
    // S'il ne reste plus aucune image, afficher le message
    const gridContainer = document.getElementById('article-images-grid');
    if (gridContainer && gridContainer.children.length === 0) {
      gridContainer.innerHTML = `
        <div class="col-span-full text-center text-gray-500 py-8">
          📭 Aucune photo pour le moment
        </div>
      `;
    }
    
    console.log('✅ Photo générique désélectionnée');
  };

  // Supprimer une image
  window.deleteArticleImage = async function(imageUrl, buttonElement) {
    // Vérifier si c'est une image générique partagée
    const isGeneric = window.genericArticleImages.includes(imageUrl);
    
    let confirmMessage = 'Supprimer cette photo ?';
    if (isGeneric) {
      confirmMessage = '⚠️ ATTENTION: Cette photo est partagée avec d\'autres articles du même type.\n\nElle sera supprimée pour TOUS les articles utilisant cette image.\n\nVoulez-vous vraiment la supprimer définitivement ?';
    }
    
    if (!confirm(confirmMessage)) return;
    
    try {
      const response = await fetch('{{ route('admin.articles.delete-image') }}', {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({
          article_type_id: window.currentArticleTypeId,
          image_url: imageUrl
        })
      });

      const data = await response.json();

      if (data.success) {
        const card = buttonElement.closest('.border-2');
        if (card) card.remove();
        
        window.uploadedGameImages = window.uploadedGameImages.filter(url => url !== imageUrl);
        
        // Si on supprime l'image principale, redéfinir une autre comme principale
        if (window.primaryImageUrl === imageUrl) {
          window.primaryImageUrl = window.uploadedGameImages.length > 0 ? window.uploadedGameImages[0] : null;
          console.log('🔄 Nouvelle image principale:', window.primaryImageUrl);
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

  // Rafraîchir la prévisualisation dans le formulaire
  // Rafraîchir l'aperçu des images d'article (fonction globale)
  window.refreshArticleImagesPreview = function() {
    console.log('🔄 refreshArticleImagesPreview appelé');
    console.log('📦 window.uploadedGameImages:', window.uploadedGameImages);
    
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
    const sortedImages = [...window.uploadedGameImages];
    if (window.primaryImageUrl && sortedImages.includes(window.primaryImageUrl)) {
      sortedImages.sort((a, b) => {
        if (a === window.primaryImageUrl) return -1;
        if (b === window.primaryImageUrl) return 1;
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
      if (url === window.primaryImageUrl) {
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
    
    if (window.uploadedGameImages.length > 4) {
      const more = document.createElement('div');
      more.className = 'flex items-center justify-center bg-gray-100 rounded border-2 border-gray-300 aspect-square text-gray-500 font-medium';
      more.textContent = `+${window.uploadedGameImages.length - 4}`;
      previewContainer.appendChild(more);
    }
    
    console.log('✅ Preview rafraîchi, total images:', window.uploadedGameImages.length);
  }

  // Basculer entre les sections d'images selon la catégorie
  if (typeSelect) {
    const updateImageSectionsVisibility = function() {
      const selectedCategory = document.getElementById('article_category_id');
      const categoryText = selectedCategory?.options[selectedCategory.selectedIndex]?.text || '';
      const romIdField = document.getElementById('rom_id_field');
      const yearField = document.getElementById('year_field');
      
      console.log('🔄 Mise à jour visibilité sections, catégorie:', categoryText);
      
      // Toujours afficher la section game_images (avec gestion avancée des photos)
      gameImagesSection.style.display = 'block';
      genericImagesSection.style.display = 'none';
      
      // Afficher rom_id et year uniquement pour les jeux vidéo
      if (categoryText.includes('Jeux vidéo')) {
        console.log('✅ Catégorie jeux vidéo - champs ROM ID et Year visibles');
        if (romIdField) romIdField.style.display = 'block';
        if (yearField) yearField.style.display = 'block';
      } else {
        console.log('✅ Autre catégorie - champs ROM ID et Year masqués');
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
      window.uploadedGameImages.forEach(url => {
        const card = document.querySelector(`[data-image-url="${url}"]`);
        if (card) {
          const captionInput = card.querySelector('input[placeholder*="légende"]');
          if (captionInput && captionInput.value.trim()) {
            captions[url] = captionInput.value.trim();
          }
        }
      });
      
      // Normaliser : extraire seulement les URLs (strings)
      const imageUrls = window.uploadedGameImages.map(img => {
        return typeof img === 'object' ? img.url : img;
      });
      
      // Remplir les champs cachés
      document.getElementById('article_images_input').value = JSON.stringify(imageUrls);
      document.getElementById('primary_image_url_input').value = window.primaryImageUrl || '';
      document.getElementById('image_captions_input').value = JSON.stringify(captions);
      
      console.log('✅ Champs cachés remplis:', {
        images: imageUrls.length,
        primary: window.primaryImageUrl,
        captions: Object.keys(captions).length
      });
    });
  }

})();

// =====================================================
// MODAL IMAGES CONSOLE (logo + display1-3)
// Script séparé pour éviter le return précoce de l'IIFE
// =====================================================
(function() {
  console.log('🎮 Initialisation section images console...');
  
  let consoleImageFiles = { logo: null, display1: null, display2: null, display3: null };
  let consoleLogoName = '';
  let currentCategoryId = null;
  let currentCategoryConfig = null;
  
  // Configuration des catégories supportant les images
  const CATEGORY_CONFIGS = {
    1: { id: 1, name: 'Consoles', folder: 'consoles', icon: '🎮', label: 'console' },
    12: { id: 12, name: 'Cartes à collectionner', folder: 'cartes', icon: '🃏', label: 'carte' },
    13: { id: 13, name: 'Accessoires', folder: 'accessoires', icon: '🎯', label: 'accessoire' }
  };
  
  // Afficher/masquer la section logo selon la catégorie
  function updateConsoleLogoSection() {
    const cat = document.getElementById('article_category_id');
    const logoSection = document.getElementById('console-logo-section');
    const type = document.getElementById('article_type_id');
    
    console.log('🎮 updateConsoleLogoSection appelée:', {
      cat: cat?.value,
      logoSection: !!logoSection,
      type: type?.value,
      typeIndex: type?.selectedIndex
    });
    
    if (!cat || !logoSection) {
      console.log('❌ Éléments manquants:', { cat: !!cat, logoSection: !!logoSection });
      return;
    }
    
    const categoryId = parseInt(cat.value);
    const categoryConfig = CATEGORY_CONFIGS[categoryId];
    const hasType = type && type.value && type.selectedIndex > 0;
    
    console.log('🎮 Conditions:', { categoryId, hasConfig: !!categoryConfig, hasType, catValue: cat.value });
    
    if (categoryConfig && hasType) {
      currentCategoryId = categoryId;
      currentCategoryConfig = categoryConfig;
      logoSection.classList.remove('hidden');
      console.log(`✅ Section images ${categoryConfig.label} affichée`);
      
      // Mettre à jour l'icône et le titre de la section
      const iconElement = document.getElementById('console-logo-icon');
      const titleElement = document.getElementById('console-logo-title');
      if (iconElement) iconElement.textContent = categoryConfig.icon;
      if (titleElement) {
        titleElement.textContent = `📷 Images ${categoryConfig.label === 'console' ? 'de la console' : categoryConfig.label === 'carte' ? 'de la carte' : 'de l\'accessoire'}`;
      }
      
      // Mettre à jour le nom de l'élément
      const typeName = type.options[type.selectedIndex].text;
      consoleLogoName = typeName.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
    } else {
      currentCategoryId = null;
      currentCategoryConfig = null;
      logoSection.classList.add('hidden');
      console.log('🔒 Section images masquée');
    }
  }
  
  // Écouter les changements de catégorie et type
  document.getElementById('article_category_id')?.addEventListener('change', updateConsoleLogoSection);
  document.getElementById('article_type_id')?.addEventListener('change', updateConsoleLogoSection);
  
  // Appel initial pour afficher la section si déjà en mode édition
  updateConsoleLogoSection();
  console.log('📦 Console images section initialized');
  
  // Ouvrir le modal
  window.openConsoleLogoModal = async function() {
    const modal = document.getElementById('console-logo-modal');
    const type = document.getElementById('article_type_id');
    const nameDisplay = document.getElementById('console-logo-name');
    
    if (!modal || !type || !currentCategoryConfig) return;
    
    const typeName = type.options[type.selectedIndex]?.text || currentCategoryConfig.label;
    consoleLogoName = typeName.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
    
    // Mettre à jour le titre du modal avec l'icône de la catégorie
    const modalTitle = modal.querySelector('h3');
    if (modalTitle) {
      modalTitle.textContent = `📷 Images ${currentCategoryConfig.label === 'console' ? 'de la console' : currentCategoryConfig.label === 'carte' ? 'de la carte' : 'de l\'accessoire'}`;
    }
    
    nameDisplay.textContent = `${currentCategoryConfig.icon} ${typeName}`;
    
    // Reset toutes les dropzones
    consoleImageFiles = { logo: null, display1: null, display2: null, display3: null };
    document.querySelectorAll('.console-img-dropzone').forEach(dropzone => {
      const preview = dropzone.querySelector('.console-img-preview');
      const placeholder = dropzone.querySelector('.console-img-placeholder');
      const imgType = dropzone.dataset.type;
      const status = document.querySelector(`.console-img-status[data-type="${imgType}"]`);
      
      if (preview) {
        preview.classList.add('hidden');
        preview.querySelector('img').src = '';
      }
      if (placeholder) placeholder.classList.remove('hidden');
      if (status) {
        status.textContent = '';
        status.classList.remove('text-green-600', 'text-red-600', 'text-yellow-600');
        status.classList.add('text-gray-400');
      }
    });
    document.getElementById('console-logo-upload-btn').disabled = true;
    
    modal.classList.remove('hidden');
    
    // Charger les images existantes depuis R2
    try {
      const response = await fetch(`{{ route('admin.taxonomy.console-images') }}?identifier=${encodeURIComponent(consoleLogoName)}&folder=${encodeURIComponent(currentCategoryConfig.folder)}`, {
        credentials: 'same-origin',
        headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
      });
      const data = await response.json();
      
      if (data.success && data.images) {
        for (const [imgType, imgData] of Object.entries(data.images)) {
          const dropzone = document.getElementById(`console-img-dropzone-${imgType}`);
          if (!dropzone) continue;
          
          const preview = dropzone.querySelector('.console-img-preview');
          const placeholder = dropzone.querySelector('.console-img-placeholder');
          const status = document.querySelector(`.console-img-status[data-type="${imgType}"]`);
          
          if (preview && imgData.url) {
            preview.querySelector('img').src = imgData.url + '?t=' + Date.now(); // Cache buster
            preview.classList.remove('hidden');
            placeholder?.classList.add('hidden');
            if (status) {
              status.textContent = imgData.filename;
              status.classList.remove('text-gray-400');
              status.classList.add('text-blue-600');
            }
          }
        }
        console.log('✅ Images existantes chargées:', Object.keys(data.images));
      }
    } catch (e) {
      console.warn('Impossible de charger les images existantes:', e);
    }
  };
  
  // Fermer le modal
  window.closeConsoleLogoModal = function() {
    document.getElementById('console-logo-modal').classList.add('hidden');
    // Reset les fichiers en attente
    consoleImageFiles = { logo: null, display1: null, display2: null, display3: null };
  };
  
  // Initialiser les dropzones
  document.querySelectorAll('.console-img-dropzone').forEach(dropzone => {
    const imgType = dropzone.dataset.type;
    const input = dropzone.querySelector('.console-img-input');
    
    if (!input) return;
    
    dropzone.addEventListener('click', () => input.click());
    
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
      if (files.length > 0 && files[0].type.startsWith('image/')) {
        handleConsoleImageFile(files[0], imgType, dropzone);
      }
    });
    
    input.addEventListener('change', () => {
      if (input.files.length > 0) {
        handleConsoleImageFile(input.files[0], imgType, dropzone);
      }
    });
  });
  
  function handleConsoleImageFile(file, imgType, dropzone) {
    if (file.size > 5 * 1024 * 1024) {
      alert('❌ L\'image dépasse 5 MB');
      return;
    }
    
    // Lire le fichier comme ArrayBuffer pour éviter ERR_UPLOAD_FILE_CHANGED
    const reader = new FileReader();
    reader.onload = (e) => {
      // Stocker comme Blob avec le nom original
      const blob = new Blob([e.target.result], { type: file.type });
      blob.name = file.name;
      consoleImageFiles[imgType] = { blob, name: file.name, type: file.type };
      
      // Afficher la preview
      const previewReader = new FileReader();
      previewReader.onload = (pe) => {
        const preview = dropzone.querySelector('.console-img-preview');
        const placeholder = dropzone.querySelector('.console-img-placeholder');
        const status = document.querySelector(`.console-img-status[data-type="${imgType}"]`);
        
        preview.querySelector('img').src = pe.target.result;
        preview.classList.remove('hidden');
        placeholder.classList.add('hidden');
        if (status) status.textContent = '✓ Prêt';
        status?.classList.remove('text-gray-400');
        status?.classList.add('text-green-600');
        
        updateUploadButton();
      };
      previewReader.readAsDataURL(blob);
    };
    reader.readAsArrayBuffer(file);
  }
  
  function updateUploadButton() {
    const btn = document.getElementById('console-logo-upload-btn');
    const hasAnyFile = Object.values(consoleImageFiles).some(f => f !== null);
    btn.disabled = !hasAnyFile;
  }
  
  // Upload de toutes les images
  window.uploadConsoleImages = async function() {
    const filesToUpload = Object.entries(consoleImageFiles).filter(([k, v]) => v !== null);
    
    if (filesToUpload.length === 0 || !consoleLogoName) {
      alert('❌ Aucun fichier sélectionné');
      return;
    }
    
    const btn = document.getElementById('console-logo-upload-btn');
    btn.disabled = true;
    btn.textContent = '⏳ Envoi...';
    
    let successCount = 0;
    let errorCount = 0;
    
    for (const [imgType, fileData] of filesToUpload) {
      const status = document.querySelector(`.console-img-status[data-type="${imgType}"]`);
      if (status) {
        status.textContent = '⏳ Envoi...';
        status.classList.remove('text-green-600');
        status.classList.add('text-yellow-600');
      }
      
      const formData = new FormData();
      // Utiliser le blob stocké avec son nom de fichier
      formData.append('images[]', fileData.blob, fileData.name);
      formData.append('identifier', consoleLogoName);
      formData.append('folder', currentCategoryConfig.folder);
      formData.append('platform', currentCategoryConfig.name);
      formData.append('type', imgType);
      
      try {
        const response = await fetch('{{ route("admin.taxonomy.upload-image") }}', {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'X-Requested-With': 'XMLHttpRequest'
          },
          credentials: 'same-origin',
          body: formData
        });
        
        const data = await response.json();
        
        if (data.success) {
          successCount++;
          if (status) {
            status.textContent = '✅ OK';
            status.classList.remove('text-yellow-600');
            status.classList.add('text-green-600');
          }
          // Mettre à jour la thumbnail si c'est le logo
          if (imgType === 'logo') {
            const thumb = document.getElementById('console-logo-thumb');
            if (thumb && data.urls && data.urls[0]) {
              thumb.innerHTML = `<img src="${data.urls[0]}" class="w-full h-full object-contain">`;
            }
          }
        } else {
          throw new Error(data.message || 'Erreur');
        }
      } catch (error) {
        errorCount++;
        console.error(`Erreur upload ${imgType}:`, error);
        if (status) {
          status.textContent = '❌ Erreur';
          status.classList.remove('text-yellow-600');
          status.classList.add('text-red-600');
        }
      }
    }
    
    btn.disabled = false;
    btn.textContent = '📤 Enregistrer les images';
    
    if (errorCount === 0) {
      alert(`✅ ${successCount} image(s) enregistrée(s) !`);
      closeConsoleLogoModal();
    } else {
      alert(`⚠️ ${successCount} réussie(s), ${errorCount} erreur(s)`);
    }
  };
  
  // Fermer modal au clic extérieur
  document.getElementById('console-logo-modal')?.addEventListener('click', (e) => {
    if (e.target.id === 'console-logo-modal') {
      closeConsoleLogoModal();
    }
  });

})();

</script>

{{-- MODAL: Ajouter une sous-catégorie --}}
<div id="addSubCategoryModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ajouter une sous-catégorie</h3>
        
        <form id="addSubCategoryForm" onsubmit="handleAddSubCategory(event)">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nom de la sous-catégorie *</label>
                <input type="text" id="newSubCategoryName" name="name" required
                       class="w-full rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="Ex: Game Boy Color">
            </div>
            
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeAddSubCategoryModal()"
                        class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-50">
                    Annuler
                </button>
                <button type="submit"
                        class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL: Ajouter un type --}}
<div id="addTypeModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
    <div class="bg-white rounded-lg p-6 max-w-md w-full mx-4">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Ajouter un type</h3>
        
        <form id="addTypeForm" onsubmit="handleAddType(event)">
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Nom du type *</label>
                <input type="text" id="newTypeName" name="name" required
                       class="w-full rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="Ex: Tetris">
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Éditeur (optionnel)</label>
                <input type="text" id="newTypePublisher" name="publisher"
                       class="w-full rounded border-gray-300 focus:ring-indigo-500 focus:border-indigo-500"
                       placeholder="Ex: Nintendo">
            </div>
            
            <div class="flex justify-end gap-2">
                <button type="button" onclick="closeAddTypeModal()"
                        class="px-4 py-2 rounded border border-gray-300 hover:bg-gray-50">
                    Annuler
                </button>
                <button type="submit"
                        class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// Gestion modal sous-catégorie
function openAddSubCategoryModal() {
    const brandId = document.getElementById('article_brand_id').value;
    if (!brandId) {
        alert('Veuillez d\'abord sélectionner une marque');
        return;
    }
    document.getElementById('addSubCategoryModal').classList.remove('hidden');
    document.getElementById('newSubCategoryName').focus();
}

function closeAddSubCategoryModal() {
    document.getElementById('addSubCategoryModal').classList.add('hidden');
    document.getElementById('addSubCategoryForm').reset();
}

async function handleAddSubCategory(event) {
    event.preventDefault();
    const brandId = document.getElementById('article_brand_id').value;
    const name = document.getElementById('newSubCategoryName').value;
    
    try {
        const response = await fetch('{{ route('admin.taxonomy.sub-category.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                article_brand_id: brandId,
                name: name
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Ajouter la nouvelle sous-catégorie au select
            const select = document.getElementById('article_sub_category_id');
            const option = document.createElement('option');
            option.value = data.subCategory.id;
            option.textContent = data.subCategory.name;
            select.appendChild(option);
            select.value = data.subCategory.id;
            
            // Déclencher l'événement de changement pour rafraîchir les types
            select.dispatchEvent(new Event('change'));
            
            closeAddSubCategoryModal();
            alert('Sous-catégorie ajoutée avec succès !');
        } else {
            alert('Erreur lors de l\'ajout de la sous-catégorie');
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de l\'ajout de la sous-catégorie');
    }
}

// Gestion modal type
function openAddTypeModal() {
    const subCategoryId = document.getElementById('article_sub_category_id').value;
    if (!subCategoryId) {
        alert('Veuillez d\'abord sélectionner une sous-catégorie');
        return;
    }
    document.getElementById('addTypeModal').classList.remove('hidden');
    document.getElementById('newTypeName').focus();
}

function closeAddTypeModal() {
    document.getElementById('addTypeModal').classList.add('hidden');
    document.getElementById('addTypeForm').reset();
}

async function handleAddType(event) {
    event.preventDefault();
    const subCategoryId = document.getElementById('article_sub_category_id').value;
    const name = document.getElementById('newTypeName').value;
    const publisher = document.getElementById('newTypePublisher').value;
    
    try {
        const response = await fetch('{{ route('admin.taxonomy.type.store') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                article_sub_category_id: subCategoryId,
                name: name,
                publisher: publisher
            })
        });
        
        const data = await response.json();
        
        if (data.success) {
            // Ajouter le nouveau type au select
            const select = document.getElementById('article_type_id');
            const option = document.createElement('option');
            option.value = data.type.id;
            option.textContent = data.type.name;
            select.appendChild(option);
            select.value = data.type.id;
            
            // Déclencher l'événement de changement
            select.dispatchEvent(new Event('change'));
            
            closeAddTypeModal();
            alert('Type ajouté avec succès !');
        } else {
            alert('Erreur lors de l\'ajout du type');
        }
    } catch (error) {
        console.error('Erreur:', error);
        alert('Erreur lors de l\'ajout du type');
    }
}

// Fermer les modals au clic extérieur
document.getElementById('addSubCategoryModal')?.addEventListener('click', (e) => {
    if (e.target.id === 'addSubCategoryModal') {
        closeAddSubCategoryModal();
    }
});

document.getElementById('addTypeModal')?.addEventListener('click', (e) => {
    if (e.target.id === 'addTypeModal') {
        closeAddTypeModal();
    }
});
</script>

{{-- Script externe pour l'autocomplétion des jeux --}}
<script src="{{ asset('js/game-autocomplete.js') }}"></script>

@endsection
