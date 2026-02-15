@extends('layouts.app')

@section('content')
{{-- Inclure le gestionnaire d'images réutilisable --}}
<script src="{{ asset('js/article-images-manager.js') }}"></script>

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div style="background: red; color: white; padding: 20px; font-size: 30px; text-align: center; margin-bottom: 20px;">
        🔴 CREATE.BLADE.PHP - FICHIER MODIFIÉ 🔴
    </div>

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            @if(isset($sheet) && $sheet->exists)
                ✏️ Modifier la fiche produit
            @else
                🖼️ Créer une fiche produit
            @endif
        </h1>
        <a href="{{ route('admin.product-sheets.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour</a>
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

    {{-- BANNIÈRE CONSOLE PRÉ-CHARGÉE --}}
    @if(isset($console) && $console)
        <div class="mb-6 p-4 bg-blue-50 text-blue-800 rounded-lg border border-blue-200 flex items-start gap-3">
            <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <div class="flex-1">
                <h3 class="font-semibold text-blue-900 mb-1">📋 Fiche pré-remplie avec les données de l'article</h3>
                <p class="text-sm text-blue-700">
                    <strong>Article #{{ $console->id }}</strong> - {{ $console->articleType?->name ?? 'Sans type' }}
                    @if($console->rom_id)
                        <span class="ml-2">• ROM ID: {{ $console->rom_id }}</span>
                    @endif
                </p>
                <p class="text-xs text-blue-600 mt-2">
                    ✓ Taxonomie chargée • 
                    @if(count($prefilledData['images'] ?? []) > 0)
                        ✓ {{ count($prefilledData['images']) }} image(s) importée(s) • 
                    @endif
                    ✓ Nom et description générés automatiquement
                </p>
            </div>
            <div class="flex flex-col gap-2">
                <a href="/admin/articles/{{ $console->id }}/edit-full" 
                   class="flex-shrink-0 px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors font-medium text-sm flex items-center gap-2 justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                    </svg>
                    Éditer l'article complet
                </a>
                <a href="{{ route('admin.consoles.edit', $console->id) }}" 
                   class="flex-shrink-0 px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors font-medium text-sm flex items-center gap-2 justify-center">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Gérer les prix
                </a>
            </div>
        </div>
    @endif

    {{-- MODAL LIGHTBOX POUR AFFICHER LES IMAGES EN GRAND --}}
    <div id="image-lightbox" class="hidden fixed inset-0 bg-black bg-opacity-90 z-50" onclick="closeImageLightbox()">
        <button type="button" onclick="closeImageLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-10">
            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
            </svg>
        </button>
        
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
        <form method="POST" action="{{ isset($sheet) && $sheet->exists ? route('admin.product-sheets.update', $sheet) : route('admin.product-sheets.store') }}" id="productSheetForm">
            @csrf
            @if(isset($sheet) && $sheet->exists)
                @method('PUT')
            @endif

            {{-- Champ hidden pour le console_id si fourni --}}
            @if(isset($console) && $console)
                <input type="hidden" name="console_id" value="{{ $console->id }}">
            @endif

            {{-- Champ hidden pour article_type_id --}}
            @if(isset($selectedType) && $selectedType)
                <input type="hidden" name="article_type_id" value="{{ $selectedType->id }}">
            @endif

            {{-- AFFICHAGE PREVIEW DE LA FICHE PRODUIT (STYLE DR. MARIO) --}}
            @if(isset($selectedType) && $selectedType)
                <div class="mb-8">
                    {{-- SECTION PREVIEW --}}
                    <div class="bg-white rounded-lg p-6 mb-6">
                        <div class="flex flex-nowrap w-full" style="border: 4px solid red;">
                            
                            {{-- COLONNE 1: Image Cover + Logo éditeur (GAUCHE - FIXE) --}}
                            <div class="flex flex-col w-64 shrink-0" style="border: 4px solid green;">
                                {{-- Image Cover/Artwork/Gameplay (depuis la taxonomie) avec navigation --}}
                                <div x-data="{
                                    imageType: 'cover',
                                    images: {
                                        cover: @json($selectedType->cover_image_url),
                                        artwork: @json($selectedType->screenshot2_url),
                                        gameplay: @json($selectedType->screenshot1_url)
                                    },
                                    get currentImage() { return this.images[this.imageType]; },
                                    get currentLabel() {
                                        const labels = { cover: 'Cover', artwork: 'Artwork', gameplay: 'Gameplay' };
                                        return labels[this.imageType];
                                    },
                                    nextImage() {
                                        const types = ['cover', 'artwork', 'gameplay'];
                                        const currentIndex = types.indexOf(this.imageType);
                                        this.imageType = types[(currentIndex + 1) % types.length];
                                    },
                                    prevImage() {
                                        const types = ['cover', 'artwork', 'gameplay'];
                                        const currentIndex = types.indexOf(this.imageType);
                                        this.imageType = types[(currentIndex - 1 + types.length) % types.length];
                                    }
                                }" class="flex justify-center" style="border: 2px solid purple;">
                                    <div class="relative group inline-block" style="border: 2px solid yellow;">
                                        <template x-if="currentImage">
                                            <img :src="currentImage" 
                                                 :alt="currentLabel" 
                                                 class="w-64 h-64 object-cover cursor-pointer hover:opacity-80 transition rounded-lg"
                                                 @click="openImageLightbox(currentImage)">
                                        </template>
                                        <template x-if="!currentImage">
                                            <div class="w-64 h-64 flex items-center justify-center text-gray-400 bg-gray-100 rounded-lg">
                                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        </template>
                                        
                                        {{-- Boutons de navigation --}}
                                        <button @click="prevImage()" type="button" class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity" style="border: 2px solid cyan;">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                            </svg>
                                        </button>
                                        <button @click="nextImage()" type="button" class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </button>
                                        
                                        {{-- Bouton d'édition des images de taxonomie --}}
                                        <button type="button" 
                                                onclick="openTaxonomyImageEditorModal()"
                                                class="absolute top-2 right-2 bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full shadow-lg z-10"
                                                title="Gérer les images de la taxonomie">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>

                                {{-- Logo de l'éditeur --}}
                                @php
                                    $publisherLogo = null;
                                    $publisherName = null;
                                    
                                    // Vérifier si on a un Publisher lié
                                    if (isset($selectedType->publisherModel) && $selectedType->publisherModel) {
                                        $publisherLogo = $selectedType->publisherModel->logo_url;
                                        $publisherName = $selectedType->publisherModel->name;
                                    } elseif ($selectedType->publisher) {
                                        $publisherName = $selectedType->publisher;
                                    }
                                @endphp
                                
                                @if($publisherLogo)
                                    <div class="mt-3 flex justify-center">
                                        <img src="{{ $publisherLogo }}" 
                                             alt="Logo {{ $publisherName }}" 
                                             class="h-10 max-w-[200px] object-contain cursor-pointer hover:opacity-80 transition"
                                             onclick="openImageLightbox('{{ $publisherLogo }}')">
                                    </div>
                                @else
                                    @if($publisherName)
                                        <div class="mt-3 flex justify-center">
                                            <div class="h-10 w-32 flex items-center justify-center text-gray-300 bg-gray-50 rounded">
                                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                                </svg>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>

                            {{-- COLONNE 2: Logo du jeu + Informations (MILIEU - FLEXIBLE) --}}
                            <div class="flex-1 min-w-0" style="border: 4px solid cyan;">
                                {{-- Logo du jeu --}}
                                @php
                                    // Priorité 1: Logo de la taxonomie (ArticleType)
                                    $logoImage = $selectedType->logo_url ?? null;
                                    
                                    // Priorité 2: Images de l'article (console)
                                    if (!$logoImage && isset($prefilledData['images_full']) && is_array($prefilledData['images_full'])) {
                                        foreach ($prefilledData['images_full'] as $img) {
                                            if (isset($img['type']) && $img['type'] === 'logo') {
                                                $logoImage = $img['url'] ?? $img['path'] ?? null;
                                                break;
                                            }
                                        }
                                    }
                                @endphp
                                
                                @if($logoImage)
                                    <img src="{{ $logoImage }}" 
                                         alt="Logo" 
                                         title="{{ $prefilledData['description'] ?? $selectedType->name }}"
                                         class="w-full h-12 object-contain cursor-pointer hover:opacity-80 transition mb-3"
                                         onclick="openImageLightbox('{{ $logoImage }}')">
                                @endif

                                <h2 class="text-xl font-bold text-gray-800 mb-2">{{ $selectedType->name }}</h2>
                                
                                {{-- Informations depuis la console --}}
                                @if(isset($console))
                                    <div class="space-y-1 mb-3">
                                        @if($console->rom_id)
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-semibold text-gray-700">ID:</span>
                                                <span class="text-sm text-gray-600">{{ $console->rom_id }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($console->year)
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-semibold text-gray-700">Année:</span>
                                                <span class="text-sm text-gray-600">{{ $console->year }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($console->region)
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-semibold text-gray-700">Région:</span>
                                                <span class="text-sm text-gray-600">{{ $console->region }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($selectedType->publisher)
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-semibold text-gray-700">Éditeur:</span>
                                                <span class="text-sm text-gray-600">{{ $selectedType->publisher }}</span>
                                            </div>
                                        @endif
                                    </div>
                                @endif

                                {{-- POINTS FORTS (Preview - affichage uniquement des critères remplis) --}}
                                @php
                                    $criteriaDefaults = [
                                        'box_condition' => 'Boîte',
                                        'manual_condition' => 'Manuel',
                                        'media_condition' => 'Support',
                                        'completeness' => 'Complétude',
                                        'rarity' => 'Rareté',
                                        'overall_condition' => 'État général'
                                    ];
                                    $criteriaLabels = $prefilledData['condition_criteria_labels'] ?? $criteriaDefaults;
                                    
                                    // Vérifier s'il y a des critères pré-remplis
                                    $prefilledCriteria = $prefilledData['condition_criteria'] ?? [];
                                    $hasPrefilledCriteria = false;
                                    foreach(['box_condition', 'manual_condition', 'media_condition', 'completeness', 'rarity', 'overall_condition'] as $key) {
                                        if (isset($prefilledCriteria[$key]) && $prefilledCriteria[$key] > 0) {
                                            $hasPrefilledCriteria = true;
                                            break;
                                        }
                                    }
                                @endphp
                                <div class="mt-3 pt-3 border-t border-gray-200 {{ $hasPrefilledCriteria ? '' : 'hidden' }}" id="criteria-preview">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-2">⭐ Points forts</h3>
                                    <div class="space-y-2" id="criteria-preview-list">
                                        @foreach(['box_condition', 'manual_condition', 'media_condition', 'completeness', 'rarity', 'overall_condition'] as $criterionKey)
                                            <div data-preview-criterion="{{ $criterionKey }}" class="hidden">
                                                <div class="flex items-center justify-between">
                                                    <label class="text-xs text-gray-600" data-preview-label="{{ $criterionKey }}">{{ $criteriaLabels[$criterionKey] ?? $criteriaDefaults[$criterionKey] }}</label>
                                                    <div class="flex gap-0.5" data-preview-stars="{{ $criterionKey }}">
                                                        @for($i = 1; $i <= 5; $i++)
                                                            <span class="text-xl text-gray-300" data-star="{{ $i }}">★</span>
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            {{-- COLONNE 3: Photos de l'article + Prix (DROITE - FIXE) --}}
                            <div class="flex flex-col w-64 shrink-0" style="border: 4px solid green;">
                                {{-- Chemin taxonomique --}}
                                <div class="text-sm font-bold text-gray-700 mb-3">
                                    <span>{{ $selectedCategory?->name }}</span>
                                    <span class="mx-1">›</span>
                                    <span>{{ $selectedBrand?->name }}</span>
                                    <span class="mx-1">›</span>
                                    <span>{{ $selectedSubCategory?->name }}</span>
                                </div>
                                
                                @php
                                    // Priorité 1: Images uploadées spécifiques de l'article
                                    $articleImages = $prefilledData['images'] ?? [];
                                    
                                    // Normaliser: extraire les URLs des objets {url, is_generic}
                                    $articleImages = array_values(array_filter(array_map(function($img) {
                                        if (is_string($img) && str_starts_with($img, 'http')) return $img;
                                        if (is_array($img) && isset($img['url']) && str_starts_with($img['url'], 'http')) return $img['url'];
                                        return null;
                                    }, $articleImages)));
                                    
                                    // Priorité 2 (fallback): Images de la taxonomie si aucune image d'article
                                    if (empty($articleImages) && isset($selectedType)) {
                                        $taxonomyImages = [];
                                        if (!empty($selectedType->images) && is_array($selectedType->images)) {
                                            // Normaliser aussi les images de taxonomie
                                            $taxonomyImages = array_values(array_filter(array_map(function($img) {
                                                if (is_string($img) && str_starts_with($img, 'http')) return $img;
                                                if (is_array($img) && isset($img['url']) && str_starts_with($img['url'], 'http')) return $img['url'];
                                                return null;
                                            }, $selectedType->images)));
                                        }
                                        
                                        if (!empty($taxonomyImages)) {
                                            $articleImages = $taxonomyImages;
                                        }
                                    }
                                @endphp
                                
                                @if(!empty($articleImages))
                                        <div x-data="{
                                            currentIndex: 0,
                                            images: {{ json_encode(array_values($articleImages)) }},
                                            get currentImage() { return this.images[this.currentIndex]; },
                                            nextImage() { this.currentIndex = (this.currentIndex + 1) % this.images.length; },
                                            prevImage() { this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length; }
                                        }" class="relative group inline-block">
                                            <img :src="currentImage" 
                                                 alt="Photo article" 
                                                 class="w-64 h-64 object-cover cursor-pointer hover:opacity-80 transition rounded-lg"
                                                 @click="window.openImageLightbox(currentImage)">
                                            
                                            @if(count($articleImages) > 1)
                                                {{-- Boutons de navigation --}}
                                                <button @click="prevImage()" type="button" class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                    </svg>
                                                </button>
                                                <button @click="nextImage()" type="button" class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                    </svg>
                                                </button>
                                                
                                                {{-- Indicateur --}}
                                                <div class="absolute bottom-2 left-1/2 -translate-x-1/2 bg-black/50 text-white px-3 py-1 rounded-full text-xs">
                                                    <span x-text="currentIndex + 1"></span>/<span x-text="images.length"></span>
                                                </div>
                                            @endif
                                        </div>
                                    @else
                                        <div class="w-64 h-64 flex items-center justify-center text-gray-400 bg-gray-100 rounded-lg">
                                            <div class="text-center">
                                                <svg class="w-16 h-16 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                                <p class="text-sm">Aucune photo</p>
                                            </div>
                                        </div>
                                    @endif
                                    </div>
                                    
                                    {{-- Informations de prix --}}
                                    @if(isset($console))
                                        <div class="flex flex-col justify-center space-y-2 mt-3" style="border: 4px solid lime;">
                                            @php
                                                // Prix R4E = valorisation ou prix d'achat
                                                $prixR4E = $console->valorisation ?? $console->prix_achat ?? 0;
                                            @endphp

                                            {{-- Prix R4E (prix de base) --}}
                                            @if($prixR4E > 0)
                                                <div class="bg-blue-50 border border-blue-200 rounded px-3 py-2">
                                                    <div class="text-xs text-blue-600 font-medium">Prix R4E</div>
                                                    <div class="text-lg font-bold text-blue-700">{{ number_format($prixR4E, 2) }} €</div>
                                                </div>
                                            @endif
                                        </div>
                                    @endif
                                </div>

                                {{-- Prix par magasin (déplacé hors du conteneur bleu) --}}
                                @if(isset($console))
                                    <div class="flex flex-col justify-center space-y-2 w-[110px] flex-shrink-0">
                                        @php
                                            $prixR4E = $console->valorisation ?? $console->prix_achat ?? 0;
                                        @endphp

                                        {{-- Prix par magasin --}}
                                        @if($console->stores && $console->stores->count() > 0)
                                            @foreach($console->stores as $store)
                                                @php
                                                    $prixVente = $store->pivot->sale_price ?? 0;
                                                    $prixDepot = $store->pivot->consignment_price ?? 0;
                                                    $reduction = 0;
                                                    
                                                    if ($prixR4E > 0 && $prixVente > 0 && $prixVente < $prixR4E) {
                                                        $reduction = round((($prixR4E - $prixVente) / $prixR4E) * 100);
                                                    }
                                                @endphp

                                                <div class="border-t pt-2 mt-2">
                                                    <div class="text-xs font-semibold text-gray-600 mb-1">{{ $store->name }}</div>
                                                    
                                                    {{-- Prix Vente --}}
                                                    @if($prixVente > 0)
                                                        <div class="bg-green-50 border border-green-200 rounded px-2 py-1 mb-1">
                                                            <div class="text-xs text-green-600">Prix Vente</div>
                                                            <div class="text-base font-bold text-green-700">{{ number_format($prixVente, 2) }} €</div>
                                                            @if($reduction > 0)
                                                                <div class="text-xs font-semibold text-red-600">-{{ $reduction }}%</div>
                                                            @endif
                                                        </div>
                                                    @endif

                                                    {{-- Prix Dépôt --}}
                                                    @if($prixDepot > 0)
                                                        <div class="bg-orange-50 border border-orange-200 rounded px-2 py-1">
                                                            <div class="text-xs text-orange-600">Prix Dépôt</div>
                                                            <div class="text-base font-bold text-orange-700">{{ number_format($prixDepot, 2) }} €</div>
                                                        </div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- INFORMATIONS PRODUIT --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informations produit</h2>

                <div class="grid grid-cols-1 gap-4 mb-6">
                    {{-- Nom de la fiche --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Nom de la fiche produit *</label>
                        <input type="text" name="name" id="product_name"
                               value="{{ old('name', $prefilledData['name'] ?? '') }}"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Ex: Game Boy Advance - Pokémon Emeraude 🇪🇺 PAL"
                               required>
                        <p class="text-xs text-gray-500 mt-1">Nom affiché sur la fiche produit (généré automatiquement si console sélectionnée)</p>
                    </div>

                    {{-- Description --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Description</label>
                        <textarea name="description" id="product_description" rows="6"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Décrivez le produit, ses caractéristiques, son état...">{{ old('description', $prefilledData['description'] ?? '') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Description détaillée du produit (générée automatiquement si console sélectionnée)</p>
                    </div>

                    {{-- Caractéristiques techniques --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Caractéristiques techniques</label>
                        <textarea name="technical_specs" rows="4"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="RAM, processeur, résolution écran, etc.">{{ old('technical_specs', $prefilledData['technical_specs'] ?? '') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Spécifications techniques du produit</p>
                    </div>

                    {{-- Accessoires inclus --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Accessoires inclus</label>
                        <textarea name="included_items" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Câbles, boîte, manuel, etc.">{{ old('included_items', $prefilledData['included_items'] ?? '') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Liste des accessoires fournis avec le produit</p>
                    </div>

                    {{-- Description marketing --}}
                    <div>
                        <label class="block text-sm font-medium mb-1">Description marketing</label>
                        <textarea name="marketing_description" rows="3"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                                  placeholder="Texte promotionnel pour la mise en vente...">{{ old('marketing_description', $prefilledData['marketing_description'] ?? '') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Description destinée à la mise en vente du produit</p>
                    </div>
                </div>

                {{-- =====================
                     IMAGES DE L'ARTICLE - COMPOSANT RÉUTILISABLE
                ===================== --}}
                <x-article-images-manager 
                    :article-type-id="$selectedType->id ?? null"
                    :article-type-name="$selectedType->name ?? null"
                    :rom-id="isset($console) ? $console->rom_id : null"
                    :uploaded-images="$prefilledData['images'] ?? []"
                    :primary-image="$prefilledData['main_image'] ?? ''"
                />
                
                {{-- Masquer le bouton des photos génériques pour les fiches produits --}}
                <style>
                    button[onclick="openTaxonomyImagesModal()"] {
                        display: none !important;
                    }
                </style>
                
                {{-- Configuration des routes pour le gestionnaire d'images --}}
                <script>
                window.configureArticleImagesRoutes({
                    upload: '{{ route("admin.product-sheets.upload-image") }}',
                    delete: '{{ route("admin.articles.delete-image") }}',
                    ajaxImages: '{{ url("admin/ajax/articles-images-by-type") }}'
                });
                </script>
                
                {{-- Inputs hidden pour la soumission du formulaire --}}
                <input type="hidden" id="article_images_input" name="images" value="">
                <input type="hidden" id="primary_image_url_input" name="main_image" value="">
                <input type="hidden" id="image_captions_input" name="image_captions" value="">

                {{-- LOGO DE L'ÉDITEUR --}}
                @if(isset($selectedType) && $selectedType)
                    <div class="mb-8">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">🏢 Logo de l'éditeur</h3>
                        
                        <button type="button" 
                                onclick="openPublisherLogoModal()"
                                class="w-full border-2 border-dashed border-purple-300 rounded-lg p-8 text-center cursor-pointer hover:border-purple-500 transition-colors bg-purple-50 mb-4">
                            <div class="mb-3">
                                <svg class="w-12 h-12 text-purple-400 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <p class="text-lg font-semibold text-purple-600 mb-1">
                                🏢 Gérer le logo de l'éditeur
                            </p>
                            <p class="text-sm text-gray-600">
                                @if($selectedType->publisher)
                                    Éditeur : {{ $selectedType->publisher }}
                                @else
                                    Cliquez pour ajouter/modifier le logo
                                @endif
                            </p>
                        </button>
                        
                        {{-- Prévisualisation du logo éditeur --}}
                        @if($selectedType->publisher_logo_url)
                            <div class="flex items-center justify-center p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <img src="{{ $selectedType->publisher_logo_url }}" 
                                     alt="Logo éditeur" 
                                     class="h-20 object-contain cursor-pointer hover:opacity-80 transition"
                                     onclick="openImageLightbox('{{ $selectedType->publisher_logo_url }}')">
                            </div>
                        @else
                            <div class="flex items-center justify-center p-8 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-sm text-gray-500 italic">Aucun logo d'éditeur disponible</p>
                            </div>
                        @endif
                        
                        <p class="text-xs text-gray-500 italic mt-2">
                            💡 Le logo de l'éditeur est partagé entre tous les jeux du même éditeur.
                        </p>
                    </div>
                @endif
            </div>

            {{-- POINTS FORTS --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">⭐ Points forts</h2>
                <p class="text-sm text-gray-600 mb-4">Configurez les points forts que vous souhaitez afficher sur cette fiche produit. Vous pouvez personnaliser le nom de chaque point.</p>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @php
                        $criteriaDefaults = [
                            'box_condition' => 'État de la boîte',
                            'manual_condition' => 'État du manuel',
                            'media_condition' => 'État du support',
                            'completeness' => 'Complétude',
                            'rarity' => 'Rareté',
                            'overall_condition' => 'État général'
                        ];
                        $criteriaLabels = $prefilledData['condition_criteria_labels'] ?? $criteriaDefaults;
                    @endphp

                    @foreach(['box_condition' => 'État de la boîte', 'manual_condition' => 'État du manuel', 'media_condition' => 'État du support', 'completeness' => 'Complétude', 'rarity' => 'Rareté', 'overall_condition' => 'État général'] as $criterionKey => $defaultLabel)
                        <div class="border rounded-lg p-4" data-criterion-editor="{{ $criterionKey }}">
                            <div class="mb-3">
                                <label class="flex items-center mb-2">
                                    <input type="checkbox" class="criterion-toggle rounded" value="{{ $criterionKey }}" {{ isset($prefilledData['condition_criteria'][$criterionKey]) ? 'checked' : '' }}>
                                    <span class="ml-2 text-sm font-semibold text-gray-700">Activer ce critère</span>
                                </label>
                                <input type="text" 
                                       class="criterion-label-input w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm"
                                       data-criterion-label="{{ $criterionKey }}"
                                       value="{{ $criteriaLabels[$criterionKey] ?? $defaultLabel }}"
                                       placeholder="{{ $defaultLabel }}">
                            </div>
                            <div class="flex gap-1" data-criterion="{{ $criterionKey }}">
                                @for($i = 1; $i <= 5; $i++)
                                    <button type="button" onclick="setRating('{{ $criterionKey }}', {{ $i }})" 
                                            class="star-btn text-3xl text-gray-300 hover:text-yellow-400 transition"
                                            data-star="{{ $i }}">★</button>
                                @endfor
                            </div>
                        </div>
                    @endforeach
                </div>

                <input type="hidden" name="condition_criteria" id="condition_criteria_input" value='{{ json_encode($prefilledData["condition_criteria"] ?? []) }}'>
                <input type="hidden" name="condition_criteria_labels" id="condition_criteria_labels_input" value='{{ json_encode($prefilledData["condition_criteria_labels"] ?? $criteriaDefaults) }}'>
                <script>
                    // Synchroniser le champ caché à chaque changement
                    document.addEventListener('DOMContentLoaded', function() {
                        document.querySelectorAll('.criterion-toggle, .star-btn, input[name^="condition_criteria_labels"]').forEach(function(el) {
                            el.addEventListener('change', function() {
                                if (typeof conditionCriteria !== 'undefined') {
                                    document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
                                }
                            });
                            el.addEventListener('click', function() {
                                if (typeof conditionCriteria !== 'undefined') {
                                    setTimeout(function() {
                                        document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
                                    }, 100);
                                }
                            });
                        });
                    });
                </script>
            </div>

            {{-- MODS DISPONIBLES --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">🔧 Mods / Accessoires / Opérations</h2>
                <p class="text-sm text-gray-600 mb-4">Cochez les mods que vous souhaitez afficher sur la miniature de cette fiche</p>

                @if($mods->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-4">
                        @foreach($mods as $mod)
                            <label class="flex items-start border rounded-lg p-3 hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="mod-checkbox rounded mt-1 mr-2" value="{{ $mod->id }}" data-name="{{ $mod->name }}" data-icon="{{ $mod->icon ?? '🔧' }}">
                                <div class="flex-1">
                                    <div class="font-medium text-sm flex items-center gap-2">
                                        @if($mod->icon && str_starts_with($mod->icon, 'data:image/'))
                                            <img src="{{ $mod->icon }}" alt="{{ $mod->name }}" class="w-5 h-5" style="image-rendering: pixelated;">
                                        @else
                                            <span class="text-lg">{{ $mod->icon ?? '🔧' }}</span>
                                        @endif
                                        <span>{{ $mod->name }}</span>
                                    </div>
                                    <div class="text-xs text-gray-500">{{ $mod->type }}</div>
                                </div>
                            </label>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-gray-500 italic">Aucun mod disponible. <a href="{{ route('admin.mods.create') }}" class="text-indigo-600 hover:underline">Créer un mod</a></p>
                @endif

                <input type="hidden" name="featured_mods" id="featured_mods_input" value='{{ json_encode($prefilledData["featured_mods"] ?? []) }}'>
            </div>

            {{-- TAGS --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Tags (optionnel)</h2>
                <input type="text" id="tags_input"
                       value="{{ old('tags') ? (is_array(old('tags')) ? implode(', ', old('tags')) : old('tags')) : (isset($prefilledData['tags']) && is_array($prefilledData['tags']) ? implode(', ', $prefilledData['tags']) : '') }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="Ex: gaming, console, sony (séparés par des virgules)">
                <input type="hidden" name="tags" id="tags_hidden" value="{{ json_encode($prefilledData['tags'] ?? []) }}">
            </div>

            {{-- STATUT --}}
            <div class="mb-8">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                           {{ old('is_active', $prefilledData['is_active'] ?? true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm">Fiche active</span>
                </label>
            </div>

            {{-- ACTIONS --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.product-sheets.index') }}" 
                   class="px-4 py-2 rounded border hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    @if(isset($sheet) && $sheet->exists)
                        ✏️ Modifier
                    @else
                        💾 Enregistrer
                    @endif
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
// Définir la base dynamique pour les images Game Boy AVANT DOMContentLoaded
window.gameboyImageBaseUrl = '{{ asset('images/taxonomy/gameboy') }}';

// ========================================
// FONCTION UTILITAIRE GLOBALE - Récupérer article_type_id
// ========================================
window.getCurrentArticleTypeId = function() {
    console.log('🔍 getCurrentArticleTypeId() appelée');
    
    // 1. Vérifier window.currentArticleTypeId
    if (window.currentArticleTypeId) {
        console.log('📌 Type ID depuis window.currentArticleTypeId:', window.currentArticleTypeId);
        return window.currentArticleTypeId;
    }
    
    // 2. Vérifier le champ hidden
    const hiddenInput = document.querySelector('input[name="article_type_id"]');
    console.log('🔍 Champ hidden trouvé:', !!hiddenInput, 'Valeur:', hiddenInput?.value);
    if (hiddenInput && hiddenInput.value) {
        console.log('📌 Type ID depuis champ hidden:', hiddenInput.value);
        window.currentArticleTypeId = hiddenInput.value;
        return hiddenInput.value;
    }
    
    // 3. Vérifier prefilledData
    const prefilledTypeId = @json($prefilledData['article_type_id'] ?? null);
    console.log('🔍 prefilledData:', prefilledTypeId);
    if (prefilledTypeId) {
        console.log('📌 Type ID depuis prefilledData:', prefilledTypeId);
        window.currentArticleTypeId = prefilledTypeId;
        return prefilledTypeId;
    }
    
    // 4. Vérifier selectedType PHP
    const selectedTypeId = @json($selectedType->id ?? null);
    console.log('🔍 $selectedType:', selectedTypeId);
    if (selectedTypeId) {
        console.log('📌 Type ID depuis $selectedType:', selectedTypeId);
        window.currentArticleTypeId = selectedTypeId;
        return selectedTypeId;
    }
    
    console.error('❌ Aucun article_type_id disponible nulle part!');
    console.log('📊 Résumé recherche:', {
        'window.currentArticleTypeId': window.currentArticleTypeId,
        'champ hidden existe': !!hiddenInput,
        'champ hidden value': hiddenInput?.value,
        'prefilledData': prefilledTypeId,
        'selectedType': selectedTypeId
    });
    return null;
};

// Variables globales pour les critères de collection (doivent être accessibles partout)
let conditionCriteria = {};
let conditionCriteriaLabels = {};

document.addEventListener('DOMContentLoaded', function() {
    // Gestion des étoiles pour critères de collection
    const loadedCriteria = {!! json_encode($prefilledData['condition_criteria'] ?? []) !!};
    const loadedLabels = {!! json_encode($prefilledData['condition_criteria_labels'] ?? []) !!};
    
    // Forcer la conversion en objet si c'est un tableau vide
    conditionCriteria = (Array.isArray(loadedCriteria) && loadedCriteria.length === 0) ? {} : loadedCriteria;
    conditionCriteriaLabels = (Array.isArray(loadedLabels) && loadedLabels.length === 0) ? {} : loadedLabels;
    
    console.log('🔍 Points forts initiaux (create):', conditionCriteria, 'Type:', Array.isArray(conditionCriteria) ? 'Array' : 'Object');
    
    // S'assurer que conditionCriteriaLabels est un objet
    if (Array.isArray(conditionCriteriaLabels)) {
        conditionCriteriaLabels = {};
    }
    
    // Initialiser les labels depuis les inputs
    document.querySelectorAll('.criterion-label-input').forEach(input => {
        const criterion = input.dataset.criterionLabel;
        if (input.value) {
            conditionCriteriaLabels[criterion] = input.value;
        }
    });

    // Initialiser les étoiles et preview des critères pré-remplis
    setTimeout(() => {
        Object.keys(conditionCriteria).forEach(criterion => {
            const rating = conditionCriteria[criterion];
            const container = document.querySelector(`[data-criterion="${criterion}"]`);
            if (container) {
                const stars = container.querySelectorAll('.star-btn');
                stars.forEach((star, index) => {
                    if (index < rating) {
                        star.classList.remove('text-gray-300');
                        star.classList.add('text-yellow-400');
                    }
                });
            }
            
            const checkbox = document.querySelector(`.criterion-toggle[value="${criterion}"]`);
            if (checkbox && !checkbox.checked) {
                checkbox.checked = true;
            }
        });
        
        document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
        document.getElementById('condition_criteria_labels_input').value = JSON.stringify(conditionCriteriaLabels);
        updatePreview();
    }, 100);

    // Fonction pour mettre à jour la preview
    function updatePreview() {
        let hasAnyCriteria = false;

        Object.keys(conditionCriteria).forEach(criterion => {
            const rating = conditionCriteria[criterion];
            const previewElement = document.querySelector(`[data-preview-criterion="${criterion}"]`);
            const labelElement = document.querySelector(`[data-preview-label="${criterion}"]`);
            const starsContainer = document.querySelector(`[data-preview-stars="${criterion}"]`);
            
            if (rating > 0 && previewElement) {
                previewElement.classList.remove('hidden');
                hasAnyCriteria = true;
                
                const customLabel = conditionCriteriaLabels[criterion];
                if (customLabel && labelElement) {
                    labelElement.textContent = customLabel;
                }
                
                if (starsContainer) {
                    const stars = starsContainer.querySelectorAll('[data-star]');
                    stars.forEach((star, index) => {
                        if (index < rating) {
                            star.classList.remove('text-gray-300');
                            star.classList.add('text-yellow-400');
                        } else {
                            star.classList.remove('text-yellow-400');
                            star.classList.add('text-gray-300');
                        }
                    });
                }
            } else if (previewElement) {
                previewElement.classList.add('hidden');
            }
        });

        const previewSection = document.getElementById('criteria-preview');
        if (previewSection) {
            if (hasAnyCriteria) {
                previewSection.classList.remove('hidden');
            } else {
                previewSection.classList.add('hidden');
            }
        }
    }

    window.setRating = function(criterion, rating) {
        conditionCriteria[criterion] = rating;
        console.log('⭐ Critère mis à jour (create):', criterion, '=', rating, '| Tous:', conditionCriteria);
        
        // Activer automatiquement la checkbox du critère
        const checkbox = document.querySelector(`.criterion-toggle[value="${criterion}"]`);
        if (checkbox && !checkbox.checked) {
            checkbox.checked = true;
        }
        
        // Mettre à jour l'affichage des étoiles dans l'éditeur
        const container = document.querySelector('[data-criterion="' + criterion + '"]');
        const stars = container.querySelectorAll('.star-btn');
        
        stars.forEach((star, index) => {
            if (index < rating) {
                star.classList.remove('text-gray-300');
                star.classList.add('text-yellow-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-300');
            }
        });

        // Mettre à jour le champ hidden
        const criteriaJson = JSON.stringify(conditionCriteria);
        document.getElementById('condition_criteria_input').value = criteriaJson;
        console.log('💾 Champ caché mis à jour (create):', criteriaJson);
        
        // Mettre à jour la preview
        updatePreview();
    };

    // Gestion des checkboxes pour activer/désactiver les critères
    document.querySelectorAll('.criterion-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const criterion = this.value;
            
            if (!this.checked) {
                // Désactiver le critère
                delete conditionCriteria[criterion];
                
                // Réinitialiser les étoiles
                const container = document.querySelector(`[data-criterion="${criterion}"]`);
                if (container) {
                    const stars = container.querySelectorAll('.star-btn');
                    stars.forEach(star => {
                        star.classList.remove('text-yellow-400');
                        star.classList.add('text-gray-300');
                    });
                }
                
                // Mettre à jour le champ hidden
                document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
                
                // Mettre à jour la preview
                updatePreview();
            }
        });
    });

    // Gestion des labels personnalisés
    document.querySelectorAll('.criterion-label-input').forEach(input => {
        input.addEventListener('input', function() {
            const criterion = this.dataset.criterionLabel;
            conditionCriteriaLabels[criterion] = this.value;
            document.getElementById('condition_criteria_labels_input').value = JSON.stringify(conditionCriteriaLabels);
            
            // Mettre à jour la preview
            updatePreview();
        });
    });

    // Gestion des mods sélectionnés
    let featuredMods = {!! json_encode($prefilledData['featured_mods'] ?? []) !!};
    
    // Initialiser les checkboxes des mods pré-sélectionnés
    setTimeout(() => {
        featuredMods.forEach(mod => {
            const checkbox = document.querySelector(`.mod-checkbox[value="${mod.id}"]`);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
        // Mettre à jour le champ hidden
        if (document.getElementById('featured_mods_input')) {
            document.getElementById('featured_mods_input').value = JSON.stringify(featuredMods);
        }
    }, 100);
    
    document.querySelectorAll('.mod-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                featuredMods.push({
                    id: parseInt(this.value),
                    name: this.dataset.name,
                    icon: this.dataset.icon || '🔧'
                });
            } else {
                featuredMods = featuredMods.filter(m => m.id !== parseInt(this.value));
            }
            document.getElementById('featured_mods_input').value = JSON.stringify(featuredMods);
        });
    });

    // Mettre à jour les champs hidden avant la soumission du formulaire
    document.querySelector('form').addEventListener('submit', function(e) {
        // Mettre à jour condition_criteria
        // Mettre à jour condition_criteria (Points forts)
        document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
        
        // Mettre à jour condition_criteria_labels
        document.querySelectorAll('.criterion-label-input').forEach(input => {
            const criterion = input.dataset.criterionLabel;
            if (input.value) {
                conditionCriteriaLabels[criterion] = input.value;
            }
        });
        document.getElementById('condition_criteria_labels_input').value = JSON.stringify(conditionCriteriaLabels);
        
        // Mettre à jour tags
        const tagsInput = document.getElementById('tags_input').value;
        const tagsArray = tagsInput.split(',').map(tag => tag.trim()).filter(tag => tag);
        document.getElementById('tags_hidden').value = JSON.stringify(tagsArray);
    });

    // Tags
    const tagsInput = document.getElementById('tags_input');
    if (tagsInput) {
        tagsInput.addEventListener('input', function() {
            const tags = this.value.split(',').map(t => t.trim()).filter(t => t);
            document.getElementById('tags_hidden').value = JSON.stringify(tags);
        });
    }

    // ========================================
    // ROM ID LOOKUP (Game Boy)
    // ========================================
    const romIdInput = document.getElementById('rom_id_input');
    const lookupBtn = document.getElementById('lookup_rom_btn');
    const lookupResult = document.getElementById('rom_lookup_result');
    const lookupMessage = document.getElementById('rom_lookup_message');
    const suggestionsDiv = document.getElementById('rom_suggestions');

    if (romIdInput) {
        let debounceTimer;

        // ========================================
        // AUTOCOMPLETE - Suggestions en temps réel
        // ========================================
        romIdInput.addEventListener('input', function() {
            const value = this.value.trim().toUpperCase();
            lookupBtn.disabled = value.length === 0;

            // Clear previous timer
            clearTimeout(debounceTimer);

            // Hide suggestions if input is too short
            if (value.length < 2) {
                suggestionsDiv.classList.add('hidden');
                suggestionsDiv.innerHTML = '';
                return;
            }

            // Debounce API call (300ms)
            debounceTimer = setTimeout(async () => {
                try {
                    const response = await fetch('{{ route("admin.product-sheets.autocomplete-rom") }}?q=' + encodeURIComponent(value));
                    const suggestions = await response.json();

                    if (suggestions.length > 0) {
                        suggestionsDiv.innerHTML = suggestions.map(s => {
                            const imageHtml = s.image_url 
                                ? '<img src="' + s.image_url + '" class="w-12 h-12 object-cover rounded" alt="' + s.name + '">'
                                : '<div class="w-12 h-12 bg-gray-200 rounded flex items-center justify-center text-gray-400 text-xs">No img</div>';
                            
                            return '<div class="px-4 py-2 hover:bg-gray-100 cursor-pointer border-b border-gray-100 last:border-0 flex items-center gap-3"' +
                                   ' data-rom-id="' + s.rom_id + '"' +
                                   ' data-name="' + s.name + '"' +
                                   ' data-year="' + (s.year || '') + '"' +
                                   ' data-image="' + (s.image_url || '') + '">' +
                                   imageHtml +
                                   '<div class="flex-1">' +
                                   '<div class="font-medium text-sm text-gray-900">' + s.rom_id + '</div>' +
                                   '<div class="text-xs text-gray-600">' + s.name + '</div>' +
                                   (s.year ? '<div class="text-xs text-gray-500">📅 ' + s.year + '</div>' : '') +
                                   '</div>' +
                                   '</div>';
                        }).join('');
                        suggestionsDiv.classList.remove('hidden');

                        // Add click handlers to suggestions
                        suggestionsDiv.querySelectorAll('[data-rom-id]').forEach(item => {
                            item.addEventListener('click', function() {
                                romIdInput.value = this.dataset.romId;
                                suggestionsDiv.classList.add('hidden');
                                suggestionsDiv.innerHTML = '';
                                lookupBtn.disabled = false;
                                lookupBtn.click(); // Auto-trigger lookup
                            });
                        });
                    } else {
                        suggestionsDiv.classList.add('hidden');
                        suggestionsDiv.innerHTML = '';
                    }
                } catch (error) {
                    console.error('Autocomplete error:', error);
                }
            }, 300);
        });

        // Close suggestions when clicking outside
        document.addEventListener('click', function(e) {
            if (!romIdInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                suggestionsDiv.classList.add('hidden');
            }
        });

        // Enable/disable button based on input
        romIdInput.addEventListener('change', function() {
            const value = this.value.trim();
            lookupBtn.disabled = value.length === 0;
        });

        // ========================================
        // LOOKUP - Recherche complète
        // ========================================
        // Trigger lookup on Enter key or button click
        romIdInput.addEventListener('keydown', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                suggestionsDiv.classList.add('hidden');
                lookupBtn.click();
            } else if (e.key === 'Escape') {
                suggestionsDiv.classList.add('hidden');
            }
        });

        lookupBtn.addEventListener('click', async function() {
            const romId = romIdInput.value.trim().toUpperCase();
            
            if (!romId) return;

            // Show loading state
            lookupBtn.disabled = true;
            lookupBtn.textContent = 'Recherche...';
            lookupResult.classList.add('hidden');

            try {
                const response = await fetch('{{ url("admin/product-sheets/lookup-rom") }}/' + encodeURIComponent(romId));
                const result = await response.json();

                if (result.success) {
                    const data = result.data;

                    // Auto-fill name and year
                    document.getElementById('product_name').value = data.name;
                    if (data.year) {
                        document.getElementById('product_year').value = data.year;
                    }

                    // Download and add image if available
                    if (data.image_url) {
                        console.log('📥 Téléchargement image depuis:', data.image_url);
                        console.log('🎮 ROM ID:', data.rom_id);
                        console.log('💾 Déjà sur Cloudinary?', data.has_cloudinary);
                        
                        try {
                            const imgResponse = await fetch('{{ route("admin.product-sheets.upload-from-url") }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                                },
                                body: JSON.stringify({ 
                                    url: data.image_url,
                                    rom_id: data.rom_id
                                })
                            });

                            const imgData = await imgResponse.json();
                            console.log('📦 Réponse upload:', imgData);
                            
                            if (imgData.success) {
                                console.log('✅ Image uploadée avec succès:', imgData.url);
                                if (imgData.cached) {
                                    console.log('⚡ Image déjà en cache Cloudinary (pas de re-téléchargement)');
                                }
                                
                                // Ajouter à la liste des images uploadées (nouveau système)
                                window.uploadedGameImages.push(imgData.url);
                                
                                if (!window.primaryImageUrl) {
                                    window.primaryImageUrl = imgData.url;
                                }
                                
                                console.log('📊 window.uploadedGameImages après ajout:', window.uploadedGameImages);
                                console.log('🖼️ window.primaryImageUrl:', window.primaryImageUrl);
                                refreshArticleImagesPreview();
                            } else {
                                console.error('❌ Échec upload image:', imgData.message);
                            }
                        } catch (imgError) {
                            console.error('❌ Image download failed:', imgError);
                        }
                    } else {
                        console.log('ℹ️ Pas d\'image disponible pour ce ROM');
                    }

                    // Show success message
                    lookupMessage.innerHTML = '✅ <strong>' + data.name + '</strong> trouvé !<br><span class="text-xs">Année: ' + (data.year || 'N/A') + ' | Prix moyen: ' + (data.price || 'N/A') + '</span>';
                    lookupMessage.className = 'text-sm text-green-700';
                    lookupResult.classList.remove('hidden');
                } else {
                    lookupMessage.textContent = '❌ ' + (result.message || 'Jeu non trouvé');
                    lookupMessage.className = 'text-sm text-red-700';
                    lookupResult.classList.remove('hidden');
                }
            } catch (error) {
                console.error('ROM lookup error:', error);
                lookupMessage.textContent = '❌ Erreur lors de la recherche';
                lookupMessage.className = 'text-sm text-red-700';
                lookupResult.classList.remove('hidden');
            } finally {
                lookupBtn.disabled = false;
                lookupBtn.textContent = 'Rechercher';
            }
        });
    }

    // ========================================
    // INITIALISATION DU GESTIONNAIRE D'IMAGES
    // ========================================
    
    // Variables globales pour les images (compatibilité avec le composant)
    if (typeof window.uploadedGameImages === 'undefined') {
        let rawImages = @json($prefilledData['images'] ?? []);
        // Normaliser: extraire les URLs des objets {url, is_generic}
        window.uploadedGameImages = rawImages
            .map(img => {
                if (typeof img === 'string' && img.startsWith('http')) return img;
                if (typeof img === 'object' && img !== null && typeof img.url === 'string' && img.url.startsWith('http')) return img.url;
                return null;
            })
            .filter(Boolean);
    }
    if (typeof window.primaryImageUrl === 'undefined') {
        window.primaryImageUrl = @json($prefilledData['main_image'] ?? null);
    }
    if (typeof window.currentArticleTypeId === 'undefined') {
        window.currentArticleTypeId = window.getCurrentArticleTypeId();
    }
    
    console.log('🔧 Initialisation gestionnaire images:', {
        uploadedGameImages: window.uploadedGameImages.length,
        primaryImageUrl: window.primaryImageUrl,
        currentArticleTypeId: window.currentArticleTypeId
    });

    // Lightbox functions
    let currentZoom = 1;
    let isDragging = false;
    let startX = 0;
    let startY = 0;
    let translateX = 0;
    let translateY = 0;

    window.openImageLightbox = function(imageSrc) {
        const lightbox = document.getElementById('image-lightbox');
        const lightboxImage = document.getElementById('lightbox-image');
        
        if (lightbox && lightboxImage) {
            lightboxImage.src = imageSrc;
            lightbox.classList.remove('hidden');
            currentZoom = 1;
            translateX = 0;
            translateY = 0;
            updateImageTransform();
        }
    };

    window.closeImageLightbox = function() {
        const lightbox = document.getElementById('image-lightbox');
        if (lightbox) {
            lightbox.classList.add('hidden');
        }
    };

    window.zoomIn = function() {
        currentZoom = Math.min(currentZoom + 0.25, 3);
        updateImageTransform();
    };

    window.zoomOut = function() {
        currentZoom = Math.max(currentZoom - 0.25, 0.5);
        updateImageTransform();
    };

    window.resetZoom = function() {
        currentZoom = 1;
        translateX = 0;
        translateY = 0;
        updateImageTransform();
    };

    function updateImageTransform() {
        const lightboxImage = document.getElementById('lightbox-image');
        if (lightboxImage) {
            lightboxImage.style.transform = `scale(${currentZoom}) translate(${translateX}px, ${translateY}px)`;
        }
    }

    // =====================================================
    // MODAL D'ÉDITION DES IMAGES DE TAXONOMIE
    // =====================================================
    
    // Variables pour l'édition des images taxonomie
    let taxonomyModalIdentifier = null;
    let taxonomyModalFolder = null;
    let taxonomyModalPlatform = null;
    
    window.openTaxonomyImageEditorModal = function() {
        console.log('🖼️ Ouverture modal édition images taxonomie');
        
        // Récupérer les infos depuis PHP
        const romId = @json($console->rom_id ?? null);
        const articleTypeName = @json($selectedType->name ?? 'Article');
        const subCategoryName = @json($selectedSubCategory->name ?? '');
        const categoryName = @json($selectedCategory->name ?? '');
        const categoryId = @json($selectedCategory->id ?? null);
        
        // Déterminer si c'est une catégorie avec images de taxonomie R2 (consoles/cartes/accessoires)
        const isTaxonomyCategory = [1, 12, 13].includes(categoryId); // 1=Consoles, 12=Cartes, 13=Accessoires
        
        // Déterminer le folder basé sur la catégorie/sous-catégorie
        let folder = 'other';
        if (subCategoryName) {
            folder = subCategoryName.toLowerCase().replace(/\s+/g, '');
        } else if (categoryName) {
            folder = categoryName.toLowerCase().replace(/\s+/g, '');
        }
        
        // Identifier = ROM ID ou nom du jeu extrait
        let identifier;
        if (romId) {
            // Priorité 1: ROM ID (Game Boy, SNES, etc.)
            identifier = romId;
        } else if (articleTypeName.includes(' - ')) {
            // Priorité 2: Nom complet du jeu (partie après " - ")
            // Ex: "sonic-blast-world - Sonic Blast (World)" → "Sonic Blast (World)"
            const parts = articleTypeName.split(' - ');
            identifier = parts.slice(1).join(' - ').trim();
        } else {
            // Fallback: slugifier le nom entier
            identifier = articleTypeName.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
        }
        
        const platform = subCategoryName || categoryName || 'Generic';
        
        // Stocker pour les fonctions ultérieures
        taxonomyModalIdentifier = identifier;
        taxonomyModalFolder = folder;
        taxonomyModalPlatform = platform;
        
        console.log('📂 Données modal taxonomie:', { identifier, folder, platform, romId });
        
        // Créer la modal
        const modal = document.createElement('div');
        modal.id = 'taxonomy-image-editor-modal';
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto';
        
        const modalContent = document.createElement('div');
        modalContent.className = 'bg-white rounded-lg shadow-xl max-w-4xl w-full my-8';
        modalContent.style.maxHeight = '90vh';
        modalContent.style.overflowY = 'auto';
        
        // Header
        const header = document.createElement('div');
        header.className = 'bg-gradient-to-r from-blue-600 to-blue-700 text-white px-6 py-4 rounded-t-lg flex justify-between items-center sticky top-0 z-10';
        header.innerHTML = `
            <h3 class="text-xl font-bold">🖼️ Gestion des images - ${articleTypeName}</h3>
            <button onclick="closeTaxonomyImageEditorModal()" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
        `;
        
        // Body
        const body = document.createElement('div');
        body.className = 'p-6 space-y-6';
        
        // Info bar
        const infoBar = document.createElement('div');
        infoBar.className = 'bg-blue-50 border border-blue-200 rounded-lg p-4';
        infoBar.innerHTML = `
            <div class="text-sm text-gray-700">
                <strong>Identifiant:</strong> ${identifier} | 
                <strong>Plateforme:</strong> ${platform} | 
                <strong>Dossier:</strong> ${folder}
            </div>
        `;
        
        // Section Upload
        const uploadSection = document.createElement('div');
        uploadSection.id = 'taxonomy-upload-section';
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
                    <select id="taxonomy-upload-type-select" class="border border-gray-300 rounded px-3 py-2 text-sm font-medium">
                        ${isTaxonomyCategory ? `
                            <option value="logo">🏷️ Logo</option>
                            <option value="display1">📸 Photo 1</option>
                            <option value="display2">📸 Photo 2</option>
                            <option value="display3">📸 Photo 3</option>
                        ` : `
                            <option value="cover">📖 Cover</option>
                            <option value="logo">🏷️ Logo</option>
                            <option value="artwork">🎨 Artwork</option>
                            <option value="gameplay">🎮 Gameplay</option>
                        `}
                    </select>
                </div>
                
                <input type="file" id="taxonomy-image-file-input" accept="image/*" multiple class="hidden">
                <button type="button" onclick="document.getElementById('taxonomy-image-file-input').click()" 
                        class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-medium">
                    📂 Parcourir
                </button>
            </div>
        `;
        
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
                closeTaxonomyImageEditorModal();
            }
        };
        
        document.body.appendChild(modal);
        
        // Setup drag & drop
        setupTaxonomyUploadDragDrop();
        
        // Setup file input
        document.getElementById('taxonomy-image-file-input').onchange = (e) => {
            const selectedType = document.getElementById('taxonomy-upload-type-select')?.value || 'cover';
            handleTaxonomyImageUpload(e.target.files, taxonomyModalIdentifier, taxonomyModalFolder, taxonomyModalPlatform, selectedType);
        };
        
        // Charger les images
        loadTaxonomyImagesGrid(identifier, folder);
    };
    
    function setupTaxonomyUploadDragDrop() {
        const uploadSection = document.getElementById('taxonomy-upload-section');
        if (!uploadSection) return;
        
        uploadSection.ondragover = (e) => {
            e.preventDefault();
            e.stopPropagation();
            uploadSection.classList.remove('bg-gray-50', 'border-gray-300');
            uploadSection.classList.add('border-blue-500', 'bg-blue-100', 'border-4');
        };
        
        uploadSection.ondragleave = (e) => {
            e.preventDefault();
            e.stopPropagation();
            if (e.target === uploadSection) {
                uploadSection.classList.remove('border-blue-500', 'bg-blue-100', 'border-4');
                uploadSection.classList.add('bg-gray-50', 'border-gray-300');
            }
        };
        
        uploadSection.ondrop = (e) => {
            e.preventDefault();
            e.stopPropagation();
            uploadSection.classList.remove('border-blue-500', 'bg-blue-100', 'border-4');
            uploadSection.classList.add('bg-gray-50', 'border-gray-300');
            
            const files = e.dataTransfer.files;
            const selectedType = document.getElementById('taxonomy-upload-type-select')?.value || 'cover';
            
            if (files.length > 0) {
                handleTaxonomyImageUpload(files, taxonomyModalIdentifier, taxonomyModalFolder, taxonomyModalPlatform, selectedType);
            }
        };
        
        uploadSection.onclick = (e) => {
            if (e.target.tagName !== 'SELECT' && e.target.tagName !== 'OPTION' && e.target.tagName !== 'BUTTON') {
                document.getElementById('taxonomy-image-file-input').click();
            }
        };
    }
    
    window.closeTaxonomyImageEditorModal = function() {
        const modal = document.getElementById('taxonomy-image-editor-modal');
        if (modal) {
            modal.remove();
            // Recharger la page pour afficher les nouvelles images
            window.location.reload();
        }
    };
    
    // Charger les images de taxonomie dans la grille
    async function loadTaxonomyImagesGrid(identifier, folder) {
        const gridContainer = document.getElementById('taxonomy-images-grid');
        if (!gridContainer) return;
        
        try {
            const apiUrl = `{{ route("admin.taxonomy.get-images") }}?identifier=${encodeURIComponent(identifier)}&folder=${encodeURIComponent(folder)}`;
            console.log('📡 Chargement images depuis:', apiUrl);
            
            const response = await fetch(apiUrl);
            const data = await response.json();
            
            console.log('📦 Réponse API:', data);
            
            if (data.success && data.images.length > 0) {
                gridContainer.innerHTML = '';
                
                const timestamp = Date.now();
                
                data.images.forEach((image, index) => {
                    console.log(`🖼️ Image ${index + 1}:`, image);
                    
                    const imageCard = document.createElement('div');
                    imageCard.className = 'border-2 border-gray-200 rounded-lg p-3 bg-white hover:border-blue-400 transition-colors';
                    
                    const img = document.createElement('img');
                    const imageUrl = `${image.url}?t=${timestamp}`;
                    console.log(`  → URL finale: ${imageUrl}`);
                    
                    img.src = imageUrl;
                    img.className = 'w-full h-40 object-cover rounded mb-2 cursor-pointer';
                    img.onclick = () => window.openImageLightbox(image.url);
                    img.onerror = function() {
                        console.error(`❌ Erreur chargement image: ${imageUrl}`);
                        this.src = 'data:image/svg+xml,%3Csvg xmlns="http://www.w3.org/2000/svg" width="200" height="200"%3E%3Crect fill="%23f0f0f0" width="200" height="200"/%3E%3Ctext x="50%25" y="50%25" font-size="16" fill="%23999" text-anchor="middle" dy=".3em"%3EErreur%3C/text%3E%3C/svg%3E';
                    };
                    img.onload = function() {
                        console.log(`✅ Image chargée: ${image.filename}`);
                    };
                    
                    // Label avec dropdown de changement de catégorie
                    const labelRow = document.createElement('div');
                    labelRow.className = 'flex items-center justify-between mb-2';
                    
                    const select = document.createElement('select');
                    select.className = 'text-sm border border-gray-300 rounded px-2 py-1 font-medium flex-1';
                    
                    // Adapter les options selon la catégorie
                    if (isTaxonomyCategory) {
                        select.innerHTML = `
                            <option value="logo" ${image.type === 'logo' ? 'selected' : ''}>🏷️ Logo</option>
                            <option value="display1" ${image.type === 'display1' ? 'selected' : ''}>📸 Photo 1</option>
                            <option value="display2" ${image.type === 'display2' ? 'selected' : ''}>📸 Photo 2</option>
                            <option value="display3" ${image.type === 'display3' ? 'selected' : ''}>📸 Photo 3</option>
                        `;
                    } else {
                        select.innerHTML = `
                            <option value="cover" ${image.type === 'cover' ? 'selected' : ''}>📖 Cover</option>
                            <option value="logo" ${image.type === 'logo' ? 'selected' : ''}>🏷️ Logo</option>
                            <option value="artwork" ${image.type === 'artwork' ? 'selected' : ''}>🎨 Artwork</option>
                            <option value="gameplay" ${image.type === 'gameplay' ? 'selected' : ''}>🎮 Gameplay</option>
                        `;
                    }
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
                    
                    // Assembler
                    imageCard.appendChild(img);
                    imageCard.appendChild(labelRow);
                    
                    // Bouton "Définir comme principale" pour les images indexées
                    if (image.index > 1) {
                        const setPrimaryBtn = document.createElement('button');
                        setPrimaryBtn.type = 'button';
                        setPrimaryBtn.className = 'w-full text-xs bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded font-medium flex items-center justify-center gap-1 mt-2';
                        setPrimaryBtn.innerHTML = '⭐ Définir comme principale';
                        setPrimaryBtn.onclick = () => setAsPrimaryImage(identifier, folder, image.full_type, image.type);
                        imageCard.appendChild(setPrimaryBtn);
                    }
                    
                    imageCard.appendChild(sizeInfo);
                    gridContainer.appendChild(imageCard);
                });
                
                // Compteur
                const countInfo = document.createElement('div');
                countInfo.className = 'col-span-2 sm:col-span-4 text-center text-sm text-gray-600 mt-2 pt-2 border-t';
                countInfo.textContent = `Total : ${data.total} image${data.total > 1 ? 's' : ''}`;
                gridContainer.appendChild(countInfo);
                
            } else {
                gridContainer.innerHTML = `
                    <div class="col-span-2 sm:col-span-4 text-center text-gray-400 py-8">
                        <div class="text-4xl mb-2">📭</div>
                        <div>Aucune image trouvée pour ce type</div>
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
    
    // Upload d'images de taxonomie
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
        formData.append('type', selectedType);
        
        try {
            const response = await fetch('{{ route("admin.taxonomy.upload-image") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Accept': 'application/json'
                },
                body: formData
            });
            
            const contentType = response.headers.get('content-type');
            if (!contentType || !contentType.includes('application/json')) {
                const text = await response.text();
                console.error('❌ Réponse HTML au lieu de JSON:', text.substring(0, 500));
                throw new Error('Le serveur a retourné une erreur. Vérifiez la console pour plus de détails.');
            }
            
            const data = await response.json();
            
            if (data.success) {
                showToast('✅ ' + data.message, 'success');
                loadTaxonomyImagesGrid(identifier, folder);
                document.getElementById('taxonomy-image-file-input').value = '';
            } else {
                showToast('❌ Erreur: ' + data.message, 'error');
            }
        } catch (e) {
            console.error('Erreur upload:', e);
            showToast('❌ Erreur lors de l\'upload', 'error');
        }
    }
    
    // Renommer une image de taxonomie
    async function renameTaxonomyImage(identifier, folder, oldType, newType) {
        if (oldType === newType) return;
        
        if (!confirm(`Renommer l'image de "${oldType}" vers "${newType}" ?`)) return;
        
        try {
            const response = await fetch('{{ route("admin.taxonomy.rename-image") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
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
                showToast('✅ ' + data.message, 'success');
                loadTaxonomyImagesGrid(identifier, folder);
            } else {
                showToast('❌ Erreur: ' + data.message, 'error');
            }
        } catch (e) {
            console.error('Erreur renommage:', e);
            showToast('❌ Erreur lors du renommage', 'error');
        }
    }
    
    // Supprimer une image de taxonomie
    async function deleteTaxonomyImage(identifier, folder, type) {
        if (!confirm(`Supprimer définitivement l'image "${type}" ?`)) return;
        
        try {
            const response = await fetch('{{ route("admin.taxonomy.delete-image") }}', {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({
                    identifier: identifier,
                    folder: folder,
                    type: type
                })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showToast('✅ ' + data.message, 'success');
                loadTaxonomyImagesGrid(identifier, folder);
            } else {
                showToast('❌ Erreur: ' + data.message, 'error');
            }
        } catch (e) {
            console.error('Erreur suppression:', e);
            showToast('❌ Erreur lors de la suppression', 'error');
        }
    }
    
    // Définir une image comme principale
    async function setAsPrimaryImage(identifier, folder, currentFullType, baseType) {
        if (!confirm(`Définir "${currentFullType}" comme image principale "${baseType}" ?`)) return;
        
        try {
            const response = await fetch('{{ route("admin.taxonomy.set-primary-image") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
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
                showToast('✅ ' + data.message, 'success');
                loadTaxonomyImagesGrid(identifier, folder);
            } else {
                showToast('❌ ' + data.message, 'error');
            }
        } catch (e) {
            console.error('Erreur:', e);
            showToast('❌ Erreur lors de l\'opération', 'error');
        }
    }

    // Ouvrir le modal de gestion du logo éditeur
    window.openPublisherLogoModal = function() {
        const articleTypeId = window.getCurrentArticleTypeId();
        
        if (!articleTypeId) {
            alert('Aucun type d\'article sélectionné');
            return;
        }

        const modal = document.createElement('div');
        modal.id = 'publisher-logo-modal';
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
        
        const modalContent = document.createElement('div');
        modalContent.className = 'bg-white rounded-lg shadow-xl max-w-2xl w-full';
        
        // Header
        const header = document.createElement('div');
        header.className = 'bg-gradient-to-r from-purple-600 to-purple-700 text-white px-6 py-4 rounded-t-lg flex justify-between items-center';
        header.innerHTML = `
          <h3 class="text-xl font-bold">🏢 Logo de l'éditeur</h3>
          <button onclick="closePublisherLogoModal()" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
        `;
        
        // Body
        const body = document.createElement('div');
        body.className = 'p-6 space-y-6';
        
        // Section Upload
        const uploadSection = document.createElement('div');
        uploadSection.className = 'border-2 border-dashed border-purple-300 rounded-lg p-6 bg-purple-50';
        uploadSection.innerHTML = `
          <div class="text-center">
            <div class="text-4xl mb-2">🏢</div>
            <h4 class="font-semibold text-gray-700 mb-2">Uploader le logo de l'éditeur</h4>
            <p class="text-sm text-gray-500 mb-4">Sélectionnez une image pour le logo de l'éditeur</p>
            
            <input type="file" id="publisher-logo-file" accept="image/*" class="hidden">
            
            <button type="button" onclick="document.getElementById('publisher-logo-file').click()" 
                    class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2 mx-auto">
              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
              </svg>
              📁 Choisir une image
            </button>
          </div>
        `;
        
        // Prévisualisation
        const previewSection = document.createElement('div');
        previewSection.id = 'publisher-logo-preview';
        previewSection.className = 'flex items-center justify-center p-8 bg-gray-50 rounded-lg border border-gray-200 min-h-[200px]';
        previewSection.innerHTML = '<p class="text-gray-400">Aucune image sélectionnée</p>';
        
        body.appendChild(uploadSection);
        body.appendChild(previewSection);
        
        // Footer
        const footer = document.createElement('div');
        footer.className = 'bg-gray-50 px-6 py-4 rounded-b-lg flex justify-end gap-3';
        footer.innerHTML = `
          <button type="button" onclick="closePublisherLogoModal()" 
                  class="px-4 py-2 rounded border hover:bg-gray-100">Annuler</button>
          <button type="button" id="save-publisher-logo-btn" disabled
                  class="px-4 py-2 rounded bg-purple-600 text-white hover:bg-purple-700 disabled:opacity-50 disabled:cursor-not-allowed">
            Enregistrer
          </button>
        `;
        
        modalContent.appendChild(header);
        modalContent.appendChild(body);
        modalContent.appendChild(footer);
        modal.appendChild(modalContent);
        document.body.appendChild(modal);
        
        // Gérer l'upload de fichier
        let selectedFile = null;
        document.getElementById('publisher-logo-file').addEventListener('change', async (e) => {
            const file = e.target.files[0];
            if (!file) return;
            
            selectedFile = file;
            
            // Prévisualisation
            const reader = new FileReader();
            reader.onload = (e) => {
                const preview = document.getElementById('publisher-logo-preview');
                preview.innerHTML = `<img src="${e.target.result}" class="max-h-48 object-contain rounded-lg">`;
                document.getElementById('save-publisher-logo-btn').disabled = false;
            };
            reader.readAsDataURL(file);
        });
        
        // Enregistrer
        document.getElementById('save-publisher-logo-btn').addEventListener('click', async () => {
            if (!selectedFile) return;
            
            const articleTypeId = window.getCurrentArticleTypeId();
            if (!articleTypeId) {
                alert('Impossible de récupérer l\'article_type_id');
                return;
            }
            
            const formData = new FormData();
            formData.append('logo', selectedFile);
            formData.append('article_type_id', articleTypeId);
            
            try {
                document.getElementById('save-publisher-logo-btn').disabled = true;
                document.getElementById('save-publisher-logo-btn').textContent = 'Enregistrement...';
                
                const response = await fetch('/admin/article-types/' + articleTypeId + '/publisher-logo', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                        'Accept': 'application/json'
                    }
                });
                
                // Vérifier que la réponse est du JSON
                const contentType = response.headers.get('content-type');
                if (!contentType || !contentType.includes('application/json')) {
                    const text = await response.text();
                    console.error('Réponse non-JSON reçue:', text.substring(0, 200));
                    throw new Error('Le serveur a retourné une réponse inattendue. Veuillez réessayer.');
                }
                
                const data = await response.json();
                
                if (!response.ok && data.errors) {
                    const errorMessages = Object.values(data.errors).flat().join('\n');
                    throw new Error(errorMessages);
                }
                
                if (data.success) {
                    showToast('Logo de l\'éditeur enregistré avec succès', 'success');
                    closePublisherLogoModal();
                    // Recharger la page pour afficher le nouveau logo
                    window.location.reload();
                } else {
                    showToast(data.message || 'Erreur lors de l\'enregistrement', 'error');
                    document.getElementById('save-publisher-logo-btn').disabled = false;
                    document.getElementById('save-publisher-logo-btn').textContent = 'Enregistrer';
                }
            } catch (error) {
                console.error('Erreur:', error);
                showToast('Erreur lors de l\'enregistrement du logo', 'error');
                document.getElementById('save-publisher-logo-btn').disabled = false;
                document.getElementById('save-publisher-logo-btn').textContent = 'Enregistrer';
            }
        });
    };

    // Fermer le modal du logo éditeur
    window.closePublisherLogoModal = function() {
        const modal = document.getElementById('publisher-logo-modal');
        if (modal) {
            modal.remove();
        }
    };

    // Afficher une notification toast
    window.showToast = function(message, type = 'success') {
        const container = document.getElementById('toast-container');
        if (!container) return;

        const toast = document.createElement('div');
        toast.className = `transform transition-all duration-300 ease-in-out p-4 rounded-lg shadow-lg text-white ${
            type === 'success' ? 'bg-green-600' : 
            type === 'error' ? 'bg-red-600' : 
            type === 'warning' ? 'bg-yellow-600' : 
            'bg-blue-600'
        }`;
        
        toast.innerHTML = `
            <div class="flex items-center gap-3">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    ${type === 'success' ? 
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>' :
                        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>'
                    }
                </svg>
                <span>${message}</span>
            </div>
        `;

        container.appendChild(toast);

        // Animation d'entrée
        setTimeout(() => {
            toast.style.opacity = '1';
            toast.style.transform = 'translateX(0)';
        }, 10);

        // Retirer après 3 secondes
        setTimeout(() => {
            toast.style.opacity = '0';
            toast.style.transform = 'translateX(100%)';
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    };

    // Soumission du formulaire
    document.querySelector('form').addEventListener('submit', function(e) {
        // Normaliser : extraire seulement les URLs (strings)
        const imageUrls = window.uploadedGameImages.map(img => {
            return typeof img === 'object' ? img.url : img;
        });
        
        document.getElementById('article_images_input').value = JSON.stringify(imageUrls);
        document.getElementById('primary_image_url_input').value = window.primaryImageUrl || '';
        
        console.log('📤 Images envoyées au serveur:', imageUrls);
    });
});
</script>
@endpush
@endsection
