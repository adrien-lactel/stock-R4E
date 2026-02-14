@extends('layouts.app')

@section('content')
{{-- Inclure le gestionnaire d'images réutilisable --}}
<script src="{{ asset('js/article-images-manager.js') }}"></script>

<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            {{ $sheet->exists ? '✏️ Éditer la fiche produit' : '➕ Créer une fiche produit' }}
        </h1>
        <div class="flex items-center gap-2">
            @if($sheet->exists)
                <a href="{{ route('admin.product-sheets.show', $sheet) }}" 
                   class="px-4 py-2 rounded bg-gray-600 text-white hover:bg-gray-700">
                    👁️ Voir la fiche
                </a>
                @if(isset($associatedConsole))
                    <a href="{{ route('admin.articles.edit_full', $associatedConsole) }}" 
                       class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                        📝 Éditer l'article #{{ $associatedConsole->id }}
                    </a>
                @endif
            @endif
            <a href="{{ route('admin.product-sheets.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour</a>
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
        <form method="POST" action="{{ $sheet->exists ? route('admin.product-sheets.update', $sheet) : route('admin.product-sheets.store') }}">
            @csrf
            @if($sheet->exists)
                @method('PUT')
            @endif

            {{-- Champ hidden pour article_type_id --}}
            @if(isset($selectedType) && $selectedType)
                <input type="hidden" name="article_type_id" value="{{ $selectedType->id }}">
            @endif

            {{-- PRÉVISUALISATION DE LA FICHE EN TEMPS RÉEL --}}
            @if(isset($selectedType) && $selectedType)
                <div class="mb-8">
                    <h2 class="text-lg font-semibold text-gray-800 mb-4">Prévisualisation de la fiche</h2>
                    
                    <div id="product-sheet-preview" class="bg-white rounded-lg p-6">
                        <div class="flex flex-wrap justify-center w-fit lg:w-full mx-auto" style="border: 3px solid #1f2937; border-radius: 12px; padding: 12px;">
                            
                            {{-- COLONNE 1: Slideshow images de l'article + Prix R4E (GAUCHE - ADAPTATIF) --}}
                            <div class="flex flex-col items-center justify-between shrink-0 order-1">
                                {{-- TAXONOMIE BREADCRUMB (en haut) --}}
                                <div style="background: #e5e7eb; padding: 10px 12px; margin-bottom: 8px; border-radius: 6px; width: 100%; height: 76px; box-sizing: border-box; display: flex; align-items: center; justify-content: center;">
                                    <div style="font-size: 16px; color: #111827; font-weight: 700; text-align: center;">
                                        {{ $selectedSubCategory?->brand?->category?->name ?? 'Catégorie' }} › {{ $selectedSubCategory?->brand?->name ?? 'Marque' }} › {{ $selectedSubCategory?->name ?? 'Sous-catégorie' }}
                                    </div>
                                </div>
                                
                                {{-- Slideshow centré verticalement --}}
                                <div class="flex-1 flex items-center justify-center">

                                @php
                                    // Pour les fiches existantes, utiliser $sheet->images
                                    // Pour les nouvelles fiches, utiliser $prefilledData['images'] (depuis la console)
                                    $articleImages = $sheet->images ?? ($prefilledData['images'] ?? []);
                                    if (is_string($articleImages)) {
                                        $articleImages = json_decode($articleImages, true) ?? [];
                                    }
                                    // Normaliser les images: extraire les URLs des objets {url, is_generic} et filtrer
                                    $articleImages = array_values(array_filter(array_map(function($img) {
                                        if (is_string($img) && str_starts_with($img, 'http')) return $img;
                                        if (is_array($img) && isset($img['url']) && str_starts_with($img['url'], 'http')) return $img['url'];
                                        return null;
                                    }, $articleImages)));
                                @endphp
                                
                                @if(count($articleImages) > 0)
                                    <div x-data="{
                                        currentIndex: 0,
                                        images: @js($articleImages),
                                        get currentImage() { return this.images[this.currentIndex]; },
                                        next() {
                                            this.currentIndex = (this.currentIndex + 1) % this.images.length;
                                        },
                                        prev() {
                                            this.currentIndex = (this.currentIndex - 1 + this.images.length) % this.images.length;
                                        }
                                    }">
                                        <div class="relative group">
                                            <img :src="currentImage" 
                                                 alt="Image article" 
                                                 class="max-h-64 w-auto object-contain rounded-lg cursor-zoom-in"
                                                 @click="openZoomModal(currentImage)">
                                            
                                            {{-- MODS ICONS en surbrillance sur l'image --}}
                                            @php
                                                $displayMods = $sheet->featured_mods ?? [];
                                            @endphp
                                            @if(count($displayMods) > 0)
                                                <div id="mods-icons-display" class="absolute top-2 right-2 flex flex-wrap gap-1 bg-black/60 rounded-lg p-1.5 max-w-[60%] justify-end">
                                                    @foreach($displayMods as $mod)
                                                        @if(isset($mod['icon']) && str_starts_with($mod['icon'], 'data:image/'))
                                                            <img src="{{ $mod['icon'] }}" alt="{{ $mod['name'] ?? 'Mod' }}" class="w-6 h-6 drop-shadow-lg" style="image-rendering: pixelated;" title="{{ $mod['name'] ?? 'Mod' }}">
                                                        @else
                                                            <span class="text-lg drop-shadow-lg" title="{{ $mod['name'] ?? 'Mod' }}">{{ $mod['icon'] ?? '🔧' }}</span>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            @else
                                                <div id="mods-icons-display" class="hidden absolute top-2 right-2 flex flex-wrap gap-1 bg-black/60 rounded-lg p-1.5 max-w-[60%] justify-end"></div>
                                            @endif
                                            
                                            {{-- Boutons de navigation --}}
                                            <button @click="prev()" type="button" class="absolute left-0 top-1/2 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                </svg>
                                            </button>
                                            <button @click="next()" type="button" class="absolute right-0 top-1/2 -translate-y-1/2 bg-black/50 text-white p-2 rounded-full hover:bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                                </svg>
                                            </button>
                                            
                                            {{-- Indicateur de position --}}
                                            <div class="absolute bottom-2 left-1/2 -translate-x-1/2 bg-black/50 text-white text-xs px-2 py-1 rounded-full">
                                                <span x-text="(currentIndex + 1) + '/' + images.length"></span>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="h-64 w-48 flex flex-col items-center justify-center text-gray-400 bg-gray-100 rounded-lg">
                                        <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                        </svg>
                                    </div>
                                @endif
                                </div>

                                {{-- Prix R4E (en bas) = valorisation --}}
                                @php
                                    $prixR4E = isset($associatedConsole) ? ($associatedConsole->valorisation ?? $associatedConsole->prix_achat ?? null) : null;
                                @endphp
                                @if($prixR4E)
                                    <div class="w-full mt-3 bg-gradient-to-r from-green-500 to-emerald-600 rounded-lg p-3 text-center">
                                        <div class="text-xs text-white/80 uppercase font-medium mb-1">Valorisation R4E</div>
                                        <div class="text-2xl font-bold text-white">
                                            {{ number_format($prixR4E, 2) }} €
                                        </div>
                                    </div>
                                @else
                                    <div class="w-full mt-3 bg-gradient-to-r from-gray-400 to-gray-500 rounded-lg p-3 text-center">
                                        <div class="text-xs text-white/80 uppercase font-medium mb-1">Valorisation R4E</div>
                                        <div class="text-2xl font-bold text-white">—</div>
                                    </div>
                                @endif
                            </div>

                            {{-- Séparateur vertical 1 --}}
                            <div class="hidden lg:block w-px bg-gray-800 mx-4 self-stretch order-2"></div>

                            {{-- COLONNE 2: Logo du jeu + Informations (MILIEU - FLEXIBLE) --}}
                            <div class="flex-1 order-4 lg:order-3" style="min-width: 256px;">
                                {{-- Logo du jeu (image-logo) dans conteneur aligné --}}
                                <div style="background: #e5e7eb; padding: 10px 12px; margin-bottom: 8px; border-radius: 6px; display: flex; align-items: center; justify-content: center; height: 76px; box-sizing: border-box;">
                                    @php
                                        $logoImage = $selectedType->logo_url ?? null;
                                    @endphp
                                    
                                    @if($logoImage)
                                        <img src="{{ $logoImage }}" 
                                             alt="Logo" 
                                             style="max-height: 40px; object-fit: contain;">
                                    @else
                                        <span style="font-size: 12px; color: #6b7280;">&nbsp;</span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-2 mb-2">
                                    @if($sheet->exists)
                                        <span class="text-xs font-mono bg-gray-200 text-gray-700 px-2 py-0.5 rounded">Fiche #{{ $sheet->id }}</span>
                                    @endif
                                    <h2 id="preview-name" class="text-2xl font-bold text-gray-800">{{ $sheet->name ?? $selectedType->name }}</h2>
                                </div>
                                
                                {{-- Informations supplémentaires --}}
                                @if(isset($associatedConsole))
                                    <div class="space-y-1.5">
                                        {{-- Numéro d'article --}}
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm font-semibold text-gray-700">N° Article:</span>
                                            <span class="text-sm font-mono bg-indigo-100 text-indigo-800 px-2 py-0.5 rounded">#{{ $associatedConsole->id }}</span>
                                        </div>
                                        
                                        @if($associatedConsole->rom_id)
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-semibold text-gray-700">ROM ID:</span>
                                                <span class="text-sm text-gray-600">{{ $associatedConsole->rom_id }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($associatedConsole->year)
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-semibold text-gray-700">Année:</span>
                                                <span class="text-sm text-gray-600">{{ $associatedConsole->year }}</span>
                                            </div>
                                        @endif
                                        
                                        @if($associatedConsole->region)
                                            <div class="flex items-center gap-2">
                                                <span class="text-sm font-semibold text-gray-700">Région:</span>
                                                <span class="text-sm text-gray-600">{{ $associatedConsole->region }}</span>
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

                                {{-- CRITÈRES DE COLLECTION (affichage des sélectionnés) --}}
                                @php
                                    $criteria = $sheet->condition_criteria ?? [];
                                    $criteriaLabels = $sheet->condition_criteria_labels ?? [
                                        'box_condition' => 'Boîte',
                                        'manual_condition' => 'Manuel',
                                        'media_condition' => 'Support',
                                        'completeness' => 'Complétude',
                                        'rarity' => 'Rareté',
                                        'overall_condition' => 'État général'
                                    ];
                                @endphp
                                <div id="criteria-display-container" class="mt-4 pt-4 border-t border-gray-200">
                                    <h3 class="text-sm font-semibold text-gray-700 mb-3">⭐ Critères</h3>
                                    <div id="criteria-display-list" class="space-y-2">
                                        @php
                                            $allCriteriaKeys = ['box_condition', 'manual_condition', 'media_condition', 'completeness', 'rarity', 'overall_condition'];
                                            $defaultLabelsDisplay = [
                                                'box_condition' => 'Boîte',
                                                'manual_condition' => 'Manuel',
                                                'media_condition' => 'Support',
                                                'completeness' => 'Complétude',
                                                'rarity' => 'Rareté',
                                                'overall_condition' => 'État général'
                                            ];
                                        @endphp
                                        @foreach($allCriteriaKeys as $key)
                                            @php
                                                $value = $criteria[$key] ?? 0;
                                                $isVisible = isset($criteria[$key]) && $criteria[$key] > 0;
                                            @endphp
                                            <div data-display-criterion="{{ $key }}" class="flex items-center justify-between {{ $isVisible ? '' : 'hidden' }}">
                                                <span class="criterion-label text-sm text-gray-600">{{ $criteriaLabels[$key] ?? $defaultLabelsDisplay[$key] }}</span>
                                                <div class="criterion-stars flex gap-0.5">
                                                    @for($i = 1; $i <= 5; $i++)
                                                        <span class="text-lg {{ $value >= $i ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                                    @endfor
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>

                                {{-- SECTIONS SÉLECTIONNÉES (affichage dynamique) --}}
                                <div id="display-sections-container">
                                    <div data-section="marketing_description" class="mt-4 pt-4 border-t border-gray-200 {{ in_array('marketing_description', $sheet->display_sections ?? []) ? '' : 'hidden' }}">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-2">💬 Avis de l'équipe R4E</h3>
                                        <p class="text-sm text-gray-600 leading-relaxed section-content">{{ $sheet->marketing_description }}</p>
                                    </div>

                                    <div data-section="description" class="mt-4 pt-4 border-t border-gray-200 {{ in_array('description', $sheet->display_sections ?? []) ? '' : 'hidden' }}">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-2">📝 Description</h3>
                                        <p class="text-sm text-gray-600 leading-relaxed section-content">{{ $sheet->description }}</p>
                                    </div>

                                    <div data-section="technical_specs" class="mt-4 pt-4 border-t border-gray-200 {{ in_array('technical_specs', $sheet->display_sections ?? []) ? '' : 'hidden' }}">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-2">⚙️ Caractéristiques techniques</h3>
                                        <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line section-content">{{ $sheet->technical_specs }}</p>
                                    </div>

                                    <div data-section="included_items" class="mt-4 pt-4 border-t border-gray-200 {{ in_array('included_items', $sheet->display_sections ?? []) ? '' : 'hidden' }}">
                                        <h3 class="text-sm font-semibold text-gray-700 mb-2">📦 Accessoires inclus</h3>
                                        <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line section-content">{{ $sheet->included_items }}</p>
                                    </div>
                                </div>
                            </div>

                            {{-- Séparateur vertical 2 --}}
                            <div class="hidden lg:block w-px bg-gray-800 mx-4 self-stretch order-4"></div>

                            {{-- COLONNE 3: Cover/Artwork/Gameplay + Logo Éditeur (DROITE - FIXE) --}}
                            <div class="flex flex-col w-64 shrink-0 order-3 lg:order-5 justify-between">
                                {{-- Conteneur pour info images (en haut, même taille que taxonomie) --}}
                                <div style="background: #e5e7eb; padding: 10px 12px; margin-bottom: 8px; border-radius: 6px; height: 76px; box-sizing: border-box; display: flex; align-items: center; justify-content: center;">
                                    <div style="font-size: 14px; color: #111827; font-weight: 700; text-align: center;">
                                        Images gameplay, cover et artwork
                                    </div>
                                </div>
                                
                                {{-- Slideshow centré verticalement --}}
                                <div class="flex-1 flex items-center justify-center">

                                {{-- Image Cover/Artwork/Gameplay (depuis la taxonomie) avec navigation --}}
                                <div x-data="{
                                    imageType: 'cover',
                                    images: {
                                        cover: {{ $selectedType->cover_image_url ? "'" . $selectedType->cover_image_url . "'" : 'null' }},
                                        artwork: {{ $selectedType->screenshot2_url ? "'" . $selectedType->screenshot2_url . "'" : 'null' }},
                                        gameplay: {{ $selectedType->screenshot1_url ? "'" . $selectedType->screenshot1_url . "'" : 'null' }}
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
                                }">
                                    <div class="relative group inline-block">
                                        <template x-if="currentImage">
                                            <img :src="currentImage" 
                                                 :alt="currentLabel" 
                                                 class="w-64 h-64 object-cover rounded-lg cursor-zoom-in"
                                                 @click="openZoomModal(currentImage)">
                                        </template>
                                        <template x-if="!currentImage">
                                            <div class="w-64 h-64 flex flex-col items-center justify-center text-gray-400 bg-gray-100 rounded-lg">
                                                <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                </svg>
                                            </div>
                                        </template>
                                        
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
                                    </div>
                                </div>
                                </div>

                                {{-- Logo Éditeur (en bas) - Cliquable pour modifier --}}
                                <div class="w-64 cursor-pointer" onclick="openPublisherLogoModal()">
                                    @if($selectedType->publisher_logo_url)
                                        <img src="{{ $selectedType->publisher_logo_url }}" 
                                             alt="Logo éditeur" 
                                             id="preview-publisher-logo"
                                             class="w-full h-16 object-contain rounded-lg hover:opacity-80 transition border-2 border-transparent hover:border-purple-400">
                                    @else
                                        <div class="w-full h-16 flex items-center justify-center bg-gray-100 rounded-lg border-2 border-dashed border-gray-300 hover:border-purple-400 transition">
                                            <span class="text-xs text-gray-500">+ Ajouter logo</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            {{-- INFORMATIONS PRODUIT --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Informations produit</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium mb-1">Nom de la fiche *</label>
                        <input type="text" name="name"
                               value="{{ old('name', $sheet->name) }}"
                               oninput="document.getElementById('preview-name').textContent = this.value || '{{ $selectedType->name ?? 'Nom du produit' }}'"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               required>
                    </div>

                    @php
                        $displaySections = $sheet->display_sections ?? [];
                    @endphp

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <input type="checkbox" name="display_sections[]" value="marketing_description" 
                                   id="show_marketing" class="rounded border-gray-300 text-blue-600 section-checkbox"
                                   onchange="toggleSectionDisplay('marketing_description', this.checked)"
                                   {{ in_array('marketing_description', $displaySections) ? 'checked' : '' }}>
                            <label for="show_marketing" class="text-sm font-medium cursor-pointer">Avis R4E</label>
                            <span class="text-xs text-gray-400">(afficher dans la fiche)</span>
                        </div>
                        <textarea name="marketing_description" rows="3"
                                  oninput="updateSectionContent('marketing_description', this.value)"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('marketing_description', $sheet->marketing_description) }}</textarea>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <input type="checkbox" name="display_sections[]" value="description" 
                                   id="show_description" class="rounded border-gray-300 text-blue-600 section-checkbox"
                                   onchange="toggleSectionDisplay('description', this.checked)"
                                   {{ in_array('description', $displaySections) ? 'checked' : '' }}>
                            <label for="show_description" class="text-sm font-medium cursor-pointer">Description du produit</label>
                            <span class="text-xs text-gray-400">(afficher dans la fiche)</span>
                        </div>
                        <textarea name="description" rows="4"
                                  oninput="updateSectionContent('description', this.value)"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $sheet->description) }}</textarea>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <input type="checkbox" name="display_sections[]" value="technical_specs" 
                                   id="show_technical" class="rounded border-gray-300 text-blue-600 section-checkbox"
                                   onchange="toggleSectionDisplay('technical_specs', this.checked)"
                                   {{ in_array('technical_specs', $displaySections) ? 'checked' : '' }}>
                            <label for="show_technical" class="text-sm font-medium cursor-pointer">Caractéristiques techniques</label>
                            <span class="text-xs text-gray-400">(afficher dans la fiche)</span>
                        </div>
                        <textarea name="technical_specs" rows="4"
                                  oninput="updateSectionContent('technical_specs', this.value)"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('technical_specs', $sheet->technical_specs) }}</textarea>
                    </div>

                    <div>
                        <div class="flex items-center gap-2 mb-1">
                            <input type="checkbox" name="display_sections[]" value="included_items" 
                                   id="show_included" class="rounded border-gray-300 text-blue-600 section-checkbox"
                                   onchange="toggleSectionDisplay('included_items', this.checked)"
                                   {{ in_array('included_items', $displaySections) ? 'checked' : '' }}>
                            <label for="show_included" class="text-sm font-medium cursor-pointer">Accessoires inclus</label>
                            <span class="text-xs text-gray-400">(afficher dans la fiche)</span>
                        </div>
                        <textarea name="included_items" rows="3"
                                  oninput="updateSectionContent('included_items', this.value)"
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('included_items', $sheet->included_items) }}</textarea>
                    </div>
                </div>
            </div>

            <script>
                // Fonctions globales pour la gestion des sections
                function toggleSectionDisplay(sectionName, isVisible) {
                    var sectionDiv = document.querySelector('[data-section="' + sectionName + '"]');
                    if (sectionDiv) {
                        if (isVisible) {
                            sectionDiv.classList.remove('hidden');
                            // Mettre à jour le contenu depuis le textarea
                            var textarea = document.querySelector('textarea[name="' + sectionName + '"]');
                            var contentP = sectionDiv.querySelector('.section-content');
                            if (textarea && contentP) {
                                contentP.textContent = textarea.value || '(Aucun contenu)';
                            }
                        } else {
                            sectionDiv.classList.add('hidden');
                        }
                    }
                }

                function updateSectionContent(sectionName, content) {
                    var checkbox = document.querySelector('input[value="' + sectionName + '"].section-checkbox');
                    if (checkbox && checkbox.checked) {
                        var sectionDiv = document.querySelector('[data-section="' + sectionName + '"]');
                        if (sectionDiv) {
                            var contentP = sectionDiv.querySelector('.section-content');
                            if (contentP) {
                                contentP.textContent = content || '(Aucun contenu)';
                            }
                        }
                    }
                }
            </script>

            {{-- CRITÈRES DE COLLECTION --}}
            <script>
                // Variable globale pour les critères
                var conditionCriteria = @json($sheet->condition_criteria ?? []);
                
                // Fonction globale pour les étoiles (appelée par onclick)
                function setRating(criterion, rating) {
                    conditionCriteria[criterion] = rating;
                    
                    // Mettre à jour l'affichage des étoiles dans le formulaire
                    var container = document.querySelector('[data-criterion="' + criterion + '"]');
                    if (container) {
                        var stars = container.querySelectorAll('.star-btn');
                        
                        stars.forEach(function(star, index) {
                            if (index < rating) {
                                star.classList.remove('text-gray-300');
                                star.classList.add('text-yellow-400');
                            } else {
                                star.classList.remove('text-yellow-400');
                                star.classList.add('text-gray-300');
                            }
                        });
                    }

                    // Mettre à jour le champ hidden
                    var hiddenInput = document.getElementById('condition_criteria_input');
                    if (hiddenInput) {
                        hiddenInput.value = JSON.stringify(conditionCriteria);
                    }
                    
                    // Mettre à jour l'affichage des étoiles dans la colonne du milieu
                    updateCriterionStarsDisplay(criterion, rating);
                    
                    // Afficher le critère s'il a une note > 0
                    if (rating > 0) {
                        var displayDiv = document.querySelector('[data-display-criterion="' + criterion + '"]');
                        if (displayDiv) {
                            displayDiv.classList.remove('hidden');
                        }
                        // Cocher la checkbox
                        var formDiv = document.querySelector('[data-form-criterion="' + criterion + '"]');
                        if (formDiv) {
                            var checkbox = formDiv.querySelector('input[type="checkbox"]');
                            if (checkbox) checkbox.checked = true;
                        }
                    }
                }
                
                // Mettre à jour l'affichage des étoiles dans le preview
                function updateCriterionStarsDisplay(criterion, rating) {
                    var displayDiv = document.querySelector('[data-display-criterion="' + criterion + '"]');
                    if (displayDiv) {
                        var starsContainer = displayDiv.querySelector('.criterion-stars');
                        if (starsContainer) {
                            var starsHtml = '';
                            for (var i = 1; i <= 5; i++) {
                                starsHtml += '<span class="text-lg ' + (rating >= i ? 'text-yellow-400' : 'text-gray-300') + '">★</span>';
                            }
                            starsContainer.innerHTML = starsHtml;
                        }
                    }
                }
                
                // Afficher/masquer un critère dans le preview
                function updateCriterionDisplay(criterion) {
                    var formDiv = document.querySelector('[data-form-criterion="' + criterion + '"]');
                    var displayDiv = document.querySelector('[data-display-criterion="' + criterion + '"]');
                    
                    if (formDiv && displayDiv) {
                        var checkbox = formDiv.querySelector('input[type="checkbox"]');
                        if (checkbox && checkbox.checked) {
                            displayDiv.classList.remove('hidden');
                            // Mettre une note par défaut si pas de note
                            if (!conditionCriteria[criterion] || conditionCriteria[criterion] === 0) {
                                setRating(criterion, 3);
                            }
                        } else {
                            displayDiv.classList.add('hidden');
                            // Réinitialiser la note
                            conditionCriteria[criterion] = 0;
                            var hiddenInput = document.getElementById('condition_criteria_input');
                            if (hiddenInput) {
                                hiddenInput.value = JSON.stringify(conditionCriteria);
                            }
                        }
                    }
                }
                
                // Mettre à jour le label d'un critère dans le preview
                function updateCriterionLabel(criterion, newLabel) {
                    var displayDiv = document.querySelector('[data-display-criterion="' + criterion + '"]');
                    if (displayDiv) {
                        var labelSpan = displayDiv.querySelector('.criterion-label');
                        if (labelSpan) {
                            labelSpan.textContent = newLabel || criterion;
                        }
                    }
                }
            </script>
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">⭐ Critères de collection</h2>
                <p class="text-sm text-gray-600 mb-4">Sélectionnez les critères à afficher et personnalisez leur nom</p>

                @php
                    $criteria = $sheet->condition_criteria ?? [];
                    $criteriaLabels = $sheet->condition_criteria_labels ?? [];
                    $defaultLabels = [
                        'box_condition' => 'Boîte',
                        'manual_condition' => 'Manuel',
                        'media_condition' => 'Support',
                        'completeness' => 'Complétude',
                        'rarity' => 'Rareté',
                        'overall_condition' => 'État général'
                    ];
                @endphp

                <div class="space-y-3">
                    {{-- Boîte --}}
                    <div class="flex items-center gap-4 p-3 rounded-lg border {{ isset($criteria['box_condition']) ? 'bg-yellow-50 border-yellow-200' : 'bg-gray-50 border-gray-200' }}" data-form-criterion="box_condition">
                        <input type="checkbox" class="criterion-toggle rounded" value="box_condition" {{ isset($criteria['box_condition']) ? 'checked' : '' }} onchange="updateCriterionDisplay('box_condition')">
                        <input type="text" name="condition_criteria_labels[box_condition]" 
                               value="{{ $criteriaLabels['box_condition'] ?? $defaultLabels['box_condition'] }}"
                               class="flex-1 text-sm rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Nom du critère"
                               oninput="updateCriterionLabel('box_condition', this.value)">
                        <div class="flex gap-0.5" data-criterion="box_condition">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('box_condition', {{ $i }})" 
                                        class="star-btn text-2xl {{ isset($criteria['box_condition']) && $criteria['box_condition'] >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>

                    {{-- Manuel --}}
                    <div class="flex items-center gap-4 p-3 rounded-lg border {{ isset($criteria['manual_condition']) ? 'bg-yellow-50 border-yellow-200' : 'bg-gray-50 border-gray-200' }}" data-form-criterion="manual_condition">
                        <input type="checkbox" class="criterion-toggle rounded" value="manual_condition" {{ isset($criteria['manual_condition']) ? 'checked' : '' }} onchange="updateCriterionDisplay('manual_condition')">
                        <input type="text" name="condition_criteria_labels[manual_condition]" 
                               value="{{ $criteriaLabels['manual_condition'] ?? $defaultLabels['manual_condition'] }}"
                               class="flex-1 text-sm rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Nom du critère"
                               oninput="updateCriterionLabel('manual_condition', this.value)">
                        <div class="flex gap-0.5" data-criterion="manual_condition">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('manual_condition', {{ $i }})" 
                                        class="star-btn text-2xl {{ isset($criteria['manual_condition']) && $criteria['manual_condition'] >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>

                    {{-- Support --}}
                    <div class="flex items-center gap-4 p-3 rounded-lg border {{ isset($criteria['media_condition']) ? 'bg-yellow-50 border-yellow-200' : 'bg-gray-50 border-gray-200' }}" data-form-criterion="media_condition">
                        <input type="checkbox" class="criterion-toggle rounded" value="media_condition" {{ isset($criteria['media_condition']) ? 'checked' : '' }} onchange="updateCriterionDisplay('media_condition')">
                        <input type="text" name="condition_criteria_labels[media_condition]" 
                               value="{{ $criteriaLabels['media_condition'] ?? $defaultLabels['media_condition'] }}"
                               class="flex-1 text-sm rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Nom du critère"
                               oninput="updateCriterionLabel('media_condition', this.value)">
                        <div class="flex gap-0.5" data-criterion="media_condition">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('media_condition', {{ $i }})" 
                                        class="star-btn text-2xl {{ isset($criteria['media_condition']) && $criteria['media_condition'] >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>

                    {{-- Complétude --}}
                    <div class="flex items-center gap-4 p-3 rounded-lg border {{ isset($criteria['completeness']) ? 'bg-yellow-50 border-yellow-200' : 'bg-gray-50 border-gray-200' }}" data-form-criterion="completeness">
                        <input type="checkbox" class="criterion-toggle rounded" value="completeness" {{ isset($criteria['completeness']) ? 'checked' : '' }} onchange="updateCriterionDisplay('completeness')">
                        <input type="text" name="condition_criteria_labels[completeness]" 
                               value="{{ $criteriaLabels['completeness'] ?? $defaultLabels['completeness'] }}"
                               class="flex-1 text-sm rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Nom du critère"
                               oninput="updateCriterionLabel('completeness', this.value)">
                        <div class="flex gap-0.5" data-criterion="completeness">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('completeness', {{ $i }})" 
                                        class="star-btn text-2xl {{ isset($criteria['completeness']) && $criteria['completeness'] >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>

                    {{-- Rareté --}}
                    <div class="flex items-center gap-4 p-3 rounded-lg border {{ isset($criteria['rarity']) ? 'bg-yellow-50 border-yellow-200' : 'bg-gray-50 border-gray-200' }}" data-form-criterion="rarity">
                        <input type="checkbox" class="criterion-toggle rounded" value="rarity" {{ isset($criteria['rarity']) ? 'checked' : '' }} onchange="updateCriterionDisplay('rarity')">
                        <input type="text" name="condition_criteria_labels[rarity]" 
                               value="{{ $criteriaLabels['rarity'] ?? $defaultLabels['rarity'] }}"
                               class="flex-1 text-sm rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Nom du critère"
                               oninput="updateCriterionLabel('rarity', this.value)">
                        <div class="flex gap-0.5" data-criterion="rarity">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('rarity', {{ $i }})" 
                                        class="star-btn text-2xl {{ isset($criteria['rarity']) && $criteria['rarity'] >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>

                    {{-- État général --}}
                    <div class="flex items-center gap-4 p-3 rounded-lg border {{ isset($criteria['overall_condition']) ? 'bg-yellow-50 border-yellow-200' : 'bg-gray-50 border-gray-200' }}" data-form-criterion="overall_condition">
                        <input type="checkbox" class="criterion-toggle rounded" value="overall_condition" {{ isset($criteria['overall_condition']) ? 'checked' : '' }} onchange="updateCriterionDisplay('overall_condition')">
                        <input type="text" name="condition_criteria_labels[overall_condition]" 
                               value="{{ $criteriaLabels['overall_condition'] ?? $defaultLabels['overall_condition'] }}"
                               class="flex-1 text-sm rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Nom du critère"
                               oninput="updateCriterionLabel('overall_condition', this.value)">
                        <div class="flex gap-0.5" data-criterion="overall_condition">
                            @for($i = 1; $i <= 5; $i++)
                                <button type="button" onclick="setRating('overall_condition', {{ $i }})" 
                                        class="star-btn text-2xl {{ isset($criteria['overall_condition']) && $criteria['overall_condition'] >= $i ? 'text-yellow-400' : 'text-gray-300' }} hover:text-yellow-400 transition"
                                        data-star="{{ $i }}">★</button>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>

            {{-- Champ caché pour les critères de collection --}}
            <input type="hidden" name="condition_criteria" id="condition_criteria_input" value="{{ json_encode($sheet->condition_criteria ?? []) }}">

            {{-- MODS DISPONIBLES --}}
            <div class="mb-8">
                <div class="mb-4">
                    <h2 class="text-lg font-semibold text-gray-800">🔧 Mods / Accessoires / Opérations</h2>
                    <p class="text-sm text-gray-600 mt-1">Cochez les mods que vous souhaitez afficher sur la miniature de cette fiche</p>
                </div>

                @php
                    $selectedMods = $sheet->featured_mods ?? [];
                    $selectedModIds = collect($selectedMods)->pluck('id')->toArray();
                @endphp

                @if($mods->count() > 0)
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-3 mb-4">
                        @foreach($mods as $mod)
                            <label class="flex items-start border rounded-lg p-3 hover:bg-gray-50 cursor-pointer">
                                <input type="checkbox" class="mod-checkbox rounded mt-1 mr-2" 
                                       value="{{ $mod->id }}" 
                                       data-name="{{ $mod->name }}"
                                       data-icon="{{ $mod->icon ?? '🔧' }}"
                                       {{ in_array($mod->id, $selectedModIds) ? 'checked' : '' }}>
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

                <input type="hidden" name="featured_mods" id="featured_mods_input" value="{{ json_encode($selectedMods) }}">
            </div>

            {{-- GESTION DES IMAGES --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">📷 Images</h2>

                {{-- IMAGES DE TAXONOMIE (JEUX VIDÉO) --}}
                @if(isset($selectedType) && $selectedType)
                    <div class="mb-6 p-4 bg-blue-50 rounded-lg border border-blue-200">
                        <h3 class="text-sm font-semibold text-blue-900 mb-3">
                            🎮 Images du jeu (taxonomie)
                        </h3>
                        <p class="text-xs text-blue-700 mb-3">Images partagées pour tous les exemplaires de ce jeu</p>
                        
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                            {{-- Cover --}}
                            <div class="bg-white rounded-lg p-3 border border-blue-200">
                                <div class="aspect-square bg-gray-100 rounded mb-2 flex items-center justify-center overflow-hidden">
                                    @if($selectedType->cover_image_url)
                                        <img src="{{ $selectedType->cover_image_url }}" class="w-full h-full object-cover cursor-pointer" alt="Cover" onclick="openZoomModal('{{ $selectedType->cover_image_url }}')">
                                    @else
                                        <span class="text-gray-400 text-xs">Aucune image</span>
                                    @endif
                                </div>
                                <p class="text-xs text-center font-medium text-gray-600 mb-1">Cover</p>
                                @if($selectedType->cover_image_url)
                                    <button type="button" onclick="useTaxonomyImageAsPrimary('{{ $selectedType->cover_image_url }}')" 
                                            class="w-full text-xs bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded font-medium">
                                        ⭐ Utiliser
                                    </button>
                                @endif
                            </div>

                            {{-- Logo --}}
                            <div class="bg-white rounded-lg p-3 border border-blue-200">
                                <div class="aspect-square bg-gray-100 rounded mb-2 flex items-center justify-center overflow-hidden">
                                    @if($selectedType->logo_url)
                                        <img src="{{ $selectedType->logo_url }}" class="w-full h-full object-contain p-2 cursor-pointer" alt="Logo" onclick="openZoomModal('{{ $selectedType->logo_url }}')">
                                    @else
                                        <span class="text-gray-400 text-xs">Aucune image</span>
                                    @endif
                                </div>
                                <p class="text-xs text-center font-medium text-gray-600 mb-1">Logo</p>
                                @if($selectedType->logo_url)
                                    <button type="button" onclick="useTaxonomyImageAsPrimary('{{ $selectedType->logo_url }}')" 
                                            class="w-full text-xs bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded font-medium">
                                        ⭐ Utiliser
                                    </button>
                                @endif
                            </div>

                            {{-- Screenshot 1 --}}
                            <div class="bg-white rounded-lg p-3 border border-blue-200">
                                <div class="aspect-square bg-gray-100 rounded mb-2 flex items-center justify-center overflow-hidden">
                                    @if($selectedType->screenshot1_url)
                                        <img src="{{ $selectedType->screenshot1_url }}" class="w-full h-full object-cover cursor-pointer" alt="Screenshot 1" onclick="openZoomModal('{{ $selectedType->screenshot1_url }}')">
                                    @else
                                        <span class="text-gray-400 text-xs">Aucune image</span>
                                    @endif
                                </div>
                                <p class="text-xs text-center font-medium text-gray-600 mb-1">Screenshot 1</p>
                                @if($selectedType->screenshot1_url)
                                    <button type="button" onclick="useTaxonomyImageAsPrimary('{{ $selectedType->screenshot1_url }}')" 
                                            class="w-full text-xs bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded font-medium">
                                        ⭐ Utiliser
                                    </button>
                                @endif
                            </div>

                            {{-- Screenshot 2 --}}
                            <div class="bg-white rounded-lg p-3 border border-blue-200">
                                <div class="aspect-square bg-gray-100 rounded mb-2 flex items-center justify-center overflow-hidden">
                                    @if($selectedType->screenshot2_url)
                                        <img src="{{ $selectedType->screenshot2_url }}" class="w-full h-full object-cover cursor-pointer" alt="Screenshot 2" onclick="openZoomModal('{{ $selectedType->screenshot2_url }}')">
                                    @else
                                        <span class="text-gray-400 text-xs">Aucune image</span>
                                    @endif
                                </div>
                                <p class="text-xs text-center font-medium text-gray-600 mb-1">Screenshot 2</p>
                                @if($selectedType->screenshot2_url)
                                    <button type="button" onclick="useTaxonomyImageAsPrimary('{{ $selectedType->screenshot2_url }}')" 
                                            class="w-full text-xs bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded font-medium">
                                        ⭐ Utiliser
                                    </button>
                                @endif
                            </div>
                        </div>
                        
                        <div class="mt-3 flex items-center justify-between">
                            <p class="text-xs text-blue-600">
                                💡 Ces images sont partagées entre tous les exemplaires de ce type
                            </p>
                            <button type="button" 
                                    onclick="openTaxonomyImageEditorModal()"
                                    class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm font-medium flex items-center gap-2 transition-colors">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                                ✏️ Modifier les images
                            </button>
                        </div>
                    </div>

                    {{-- LOGO ÉDITEUR --}}
                    <div class="mb-6 p-4 bg-purple-50 rounded-lg border border-purple-200">
                        <h3 class="text-sm font-semibold text-purple-900 mb-3">
                            🏢 Logo de l'éditeur
                        </h3>
                        <div class="flex items-center gap-4">
                            <button type="button" 
                                    onclick="openPublisherLogoModal()"
                                    class="w-40 h-20 bg-white rounded-lg border-2 border-dashed border-purple-300 flex items-center justify-center overflow-hidden p-2 cursor-pointer hover:border-purple-500 transition-colors">
                                @if($selectedType->publisher_logo_url)
                                    <img src="{{ $selectedType->publisher_logo_url }}" 
                                         alt="Logo {{ $selectedType->publisher ?? 'éditeur' }}" 
                                         id="form-publisher-logo"
                                         class="max-w-full max-h-full object-contain">
                                @else
                                    <span class="text-gray-400 text-xs text-center">+ Ajouter logo</span>
                                @endif
                            </button>
                            <div class="text-sm text-purple-800">
                                <p class="font-medium">{{ $selectedType->publisher ?? 'Non défini' }}</p>
                                <p class="text-xs text-purple-600 mt-1">
                                    👉 Cliquez pour modifier le logo
                                </p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- =====================
                     IMAGES DE L'ARTICLE - COMPOSANT RÉUTILISABLE
                ===================== --}}
                <x-article-images-manager 
                    :article-type-id="$selectedType?->id ?? null"
                    :article-type-name="$selectedType?->name ?? null"
                    :rom-id="null"
                    :uploaded-images="$sheet->images ?? []"
                    :primary-image="$sheet->main_image ?? ''"
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
            </div>

            {{-- TAGS --}}
            <div class="mb-8">
                <h2 class="text-lg font-semibold text-gray-800 mb-4">Tags</h2>
                <input type="text" id="tags_input"
                       value="{{ $sheet->tags ? implode(', ', $sheet->tags) : '' }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="gaming, console, sony">
                <input type="hidden" name="tags" id="tags_hidden" value="{{ json_encode($sheet->tags ?? []) }}">
            </div>

            {{-- STATUT --}}
            <div class="mb-8">
                <label class="flex items-center">
                    <input type="checkbox" name="is_active" value="1" 
                           {{ old('is_active', $sheet->is_active) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                    <span class="ml-2 text-sm">Fiche active</span>
                </label>
            </div>

            {{-- Hidden fields pour conserver les images --}}
            <input type="hidden" name="images" id="images_input" value="{{ json_encode($sheet->images ?? []) }}">
            <input type="hidden" name="main_image" id="main_image_input" value="{{ $sheet->main_image }}">

            {{-- ACTIONS --}}
            <div class="flex items-center justify-end gap-3">
                <a href="{{ route('admin.product-sheets.index') }}" 
                   class="px-4 py-2 rounded border hover:bg-gray-50">
                    Annuler
                </a>
                <button type="submit" 
                        class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    💾 {{ $sheet->exists ? 'Mettre à jour' : 'Créer' }}
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Script inline pour les fonctions appelées par onclick --}}
<script>
console.log('🚀 Script de gestion d\'images chargé - début');

// Données PHP injectées pour éviter les problèmes de parsing
@php
    $taxonomyImagesData = [
        'cover' => isset($selectedType) && $selectedType->cover_image_url ? $selectedType->cover_image_url : null,
        'artwork' => isset($selectedType) && $selectedType->screenshot2_url ? $selectedType->screenshot2_url : null,
        'gameplay' => isset($selectedType) && $selectedType->screenshot1_url ? $selectedType->screenshot1_url : null,
        'logo' => isset($selectedType) && $selectedType->logo_url ? $selectedType->logo_url : null,
        'publisher_logo' => isset($selectedType) && $selectedType->publisher_logo_url ? $selectedType->publisher_logo_url : null,
    ];
@endphp
const TAXONOMY_IMAGES = {!! json_encode($taxonomyImagesData) !!};
const SELECTED_TYPE_NAME = {!! isset($selectedType) && $selectedType ? json_encode($selectedType->name) : '""' !!};

// Routes adaptées pour Product Sheets
window.UPLOAD_ROUTE = '{{ route("admin.product-sheets.upload-image") }}';
window.DELETE_IMAGE_ROUTE = '{{ route("admin.articles.delete-image") }}'; // Route partagée
window.AJAX_ARTICLE_IMAGES_ROUTE = '{{ url("admin/ajax/articles-images-by-type") }}';

// Variables globales pour la gestion des images d'articles (sans let, directement sur window)
@php
    // Pour les fiches existantes, utiliser $sheet->images - sinon utiliser $prefilledData['images']
    $jsImages = $sheet->images ?? ($prefilledData['images'] ?? []);
    if (is_string($jsImages)) {
        $jsImages = json_decode($jsImages, true) ?? [];
    }
    // Normaliser: extraire les URLs des objets {url, is_generic}
    $jsImages = array_values(array_filter(array_map(function($img) {
        if (is_string($img) && str_starts_with($img, 'http')) return $img;
        if (is_array($img) && isset($img['url']) && str_starts_with($img['url'], 'http')) return $img['url'];
        return null;
    }, $jsImages)));
    
    $jsPrimaryImage = $sheet->main_image ?? ($prefilledData['main_image'] ?? '');
@endphp
window.uploadedGameImages = {!! json_encode($jsImages) !!};
window.primaryImageUrl = '{{ $jsPrimaryImage }}';
window.currentArticleTypeId = {{ isset($selectedType) && $selectedType ? $selectedType->id : 'null' }};
window.genericArticleImages = [];

// Variables globales pour les mods
let featuredMods = {!! json_encode($sheet->featured_mods ?? []) !!};

console.log('📦 Variables globales initialisées:', {
    uploadedGameImages: window.uploadedGameImages.length,
    primaryImageUrl: window.primaryImageUrl,
    currentArticleTypeId: window.currentArticleTypeId,
    featuredMods: featuredMods.length
});

// Fonction pour utiliser une image de taxonomie comme image principale
window.useTaxonomyImageAsPrimary = function(imageUrl) {
    if (!imageUrl) return;
    
    console.log('⭐ Sélection image taxonomie comme principale:', imageUrl);
    
    // Vérifier si l'image est déjà dans la liste
    const existingIndex = window.uploadedGameImages.findIndex(img => {
        if (typeof img === 'string') return img === imageUrl;
        if (typeof img === 'object' && img !== null) return img.url === imageUrl;
        return false;
    });
    
    if (existingIndex > -1) {
        // L'image existe déjà, la déplacer en première position
        const [existingImg] = window.uploadedGameImages.splice(existingIndex, 1);
        window.uploadedGameImages.unshift(existingImg);
        console.log('🔄 Image déplacée en première position');
    } else {
        // Ajouter l'image en première position (avec marqueur is_generic: true car c'est une image taxonomie)
        window.uploadedGameImages.unshift({
            url: imageUrl,
            is_generic: true
        });
        console.log('➕ Image ajoutée en première position');
    }
    
    // Définir comme image principale
    window.primaryImageUrl = imageUrl;
    
    // Rafraîchir l'affichage
    if (typeof window.refreshArticleImagesPreview === 'function') {
        window.refreshArticleImagesPreview();
    }
    
    // Feedback visuel
    alert('✅ Image définie comme image principale !');
};

// Fonction pour ouvrir les images de la taxonomie
// ========================================
// GESTION DES IMAGES SPÉCIFIQUES AUX ARTICLES (MODAL COMPLÈTE)
// Adapté de form.blade.php pour product-sheets
// ========================================

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
          <h4 class="font-semibold text-gray-700">📚 Photos d'autres articles du même type</h4>
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
          let width = img.width;
          let height = img.height;
          
          if (width > maxWidth) {
            height = (height * maxWidth) / width;
            width = maxWidth;
          }
          
          const canvas = document.createElement('canvas');
          canvas.width = width;
          canvas.height = height;
          
          const ctx = canvas.getContext('2d');
          ctx.drawImage(img, 0, 0, width, height);
          
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
    for (const file of Array.from(files)) {
      if (!file.type.startsWith('image/')) {
        console.warn('Fichier ignoré (pas une image):', file.name);
        continue;
      }
      
      const originalSize = (file.size / 1024 / 1024).toFixed(2);
      console.log(`📁 Fichier original: ${file.name} (${originalSize}MB)`);
      
      let processedFile = file;
      if (file.size > 2 * 1024 * 1024) {
        console.log('🔄 Compression en cours...');
        processedFile = await compressImage(file);
      } else {
        console.log('✓ Pas besoin de compression (< 2MB)');
      }
      
      const reader = new FileReader();
      reader.onload = (e) => {
        addArticleImageCard(e.target.result, file.name, 'uploading');
      };
      reader.readAsDataURL(processedFile);
      
      uploadArticleImage(processedFile, file.name);
    }
  }

  // Upload une image vers le serveur
  async function uploadArticleImage(file, originalFileName = null) {
    const fileName = originalFileName || file.name;
    const fileSize = (file.size / 1024 / 1024).toFixed(2);
    
    console.log(`📤 Upload image: ${fileName} (${fileSize}MB)`);
    
    if (!window.currentArticleTypeId) {
      alert('Veuillez d\'abord sélectionner un type d\'article');
      return;
    }

    if (file.size > 50 * 1024 * 1024) {
      alert(`❌ Fichier trop volumineux: ${fileSize}MB (limite: 50MB)`);
      removeArticleImageCard(fileName);
      return;
    }

    const formData = new FormData();
    formData.append('image', file);
    formData.append('article_type_id', window.currentArticleTypeId);

    try {
      const response = await fetch(UPLOAD_ROUTE, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
        },
        body: formData
      });

      if (!response.ok) {
        const errorText = await response.text();
        console.error('❌ Erreur HTTP:', response.status, errorText);
        
        if (response.status === 413) {
          alert(`❌ Image trop volumineuse (${fileSize}MB)`);
        } else if (response.status === 500) {
          alert(`❌ Erreur serveur lors de l'upload`);
        } else {
          alert(`❌ Erreur upload: ${response.status}`);
        }
        removeArticleImageCard(fileName);
        return;
      }

      const data = await response.json();

      if (data.success) {
        console.log('✅ Image uploadée:', data.url);
        
        updateArticleImageCard(fileName, data.url);
        window.uploadedGameImages.push(data.url);
        
        if (!window.primaryImageUrl && window.uploadedGameImages.length === 1) {
          window.primaryImageUrl = data.url;
          console.log('⭐ Première image définie comme principale automatiquement');
        }
        
        refreshArticleImagesPreview();
      } else {
        console.error('Erreur upload:', data.message);
        alert(`❌ Erreur: ${data.message}`);
        removeArticleImageCard(fileName);
      }
    } catch (e) {
      console.error('❌ Exception upload:', e);
      alert(`❌ Erreur lors de l'upload`);
      removeArticleImageCard(fileName);
    }
  }

  // Ajouter une carte d'image dans la modal (avec état uploading/uploaded)
  function addArticleImageCard(imageUrl, fileName, state = 'uploaded') {
    const grid = document.getElementById('article-images-grid');
    
    // Supprimer le message "aucune photo"
    const emptyMsg = grid.querySelector('.col-span-full');
    if (emptyMsg) emptyMsg.remove();
    
    const card = document.createElement('div');
    card.className = 'relative group rounded-lg overflow-hidden border-2 border-gray-200 hover:border-indigo-400 transition-all';
    card.dataset.fileName = fileName;
    card.dataset.imageUrl = imageUrl;
    
    const isUploading = state === 'uploading';
    const isPrimary = (imageUrl === window.primaryImageUrl);
    const isGeneric = window.uploadedGameImages.some(img => typeof img === 'object' && img.url === imageUrl && img.is_generic);
    
    card.innerHTML = `
      <div class="aspect-square relative bg-gray-100">
        <img src="${imageUrl}" alt="${fileName}" 
             class="w-full h-full object-cover ${isUploading ? 'opacity-50' : ''}">
        
        ${isUploading ? `
          <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-30">
            <div class="animate-spin rounded-full h-10 w-10 border-4 border-white border-t-transparent"></div>
          </div>
        ` : ''}
        
        ${isPrimary ? `
          <span class="absolute top-2 left-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-bold shadow-lg flex items-center gap-1">
            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
            Principale
          </span>
        ` : ''}
        
        ${isGeneric ? `
          <span class="absolute top-2 left-2 bg-purple-500 text-white text-xs px-2 py-1 rounded-full font-bold shadow-lg">
            🔗 Partagée
          </span>
        ` : ''}
        
        ${!isUploading ? `
          <div class="absolute top-2 right-2 flex gap-1 opacity-0 group-hover:opacity-100 transition-opacity">
            ${!isPrimary ? `
              <button type="button" 
                      onclick="setPrimaryImage('${imageUrl}')" 
                      class="bg-yellow-500 hover:bg-yellow-600 text-white p-1.5 rounded-full shadow-lg transition-colors"
                      title="Définir comme image principale">
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              </button>
            ` : ''}
            <button type="button" 
                    onclick="deleteArticleImage('${imageUrl}')" 
                    class="bg-red-500 hover:bg-red-600 text-white p-1.5 rounded-full shadow-lg transition-colors"
                    title="Supprimer">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
              </svg>
            </button>
          </div>
        ` : ''}
      </div>
      
      ${!isUploading ? `
        <div class="p-2 bg-white">
          <input type="text" 
                 placeholder="Légende (optionnel)" 
                 value=""
                 onchange="updateArticleImageCaption('${imageUrl}', this.value)"
                 class="w-full text-xs border border-gray-200 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-indigo-500">
        </div>
      ` : `
        <div class="p-2 bg-gray-50">
          <div class="text-xs text-gray-500 truncate">⏳ Upload en cours...</div>
        </div>
      `}
    `;
    
    grid.appendChild(card);
    updateArticleImagesCount();
  }

  // Mettre à jour une carte après upload réussi
  function updateArticleImageCard(fileName, uploadedUrl) {
    const card = document.querySelector(`[data-file-name="${fileName}"]`);
    if (card) {
      card.dataset.imageUrl = uploadedUrl;
      card.querySelector('img').src = uploadedUrl;
      card.classList.remove('opacity-50');
      
      const spinner = card.querySelector('.animate-spin');
      if (spinner) spinner.parentElement.remove();
      
      card.querySelector('.bg-gray-50').innerHTML = `
        <input type="text" 
               placeholder="Légende (optionnel)" 
               value=""
               onchange="updateArticleImageCaption('${uploadedUrl}', this.value)"
               class="w-full text-xs border border-gray-200 rounded px-2 py-1 focus:outline-none focus:ring-1 focus:ring-indigo-500">
      `;
      card.querySelector('.bg-gray-50').className = 'p-2 bg-white';
    }
  }

  // Supprimer une carte en cas d'erreur
  function removeArticleImageCard(fileName) {
    const card = document.querySelector(`[data-file-name="${fileName}"]`);
    if (card) {
      card.remove();
      updateArticleImagesCount();
    }
  }

  // Définir une image comme principale
  function setPrimaryImage(imageUrl) {
    window.primaryImageUrl = imageUrl;
    console.log('⭐ Image principale définie:', imageUrl);
    
    // Mettre à jour TOUTES les cartes dans la grille
    const allCards = document.querySelectorAll('#article-images-grid > div[data-image-url]');
    allCards.forEach(card => {
      const cardUrl = card.dataset.imageUrl;
      const isPrimary = (cardUrl === imageUrl);
      
      // Supprimer tous les anciens badges "Principale"
      const oldBadge = card.querySelector('.bg-yellow-500');
      if (oldBadge && oldBadge.textContent.includes('Principale')) {
        oldBadge.remove();
      }
      
      // Supprimer tous les anciens boutons étoile
      const oldStarBtn = card.querySelector('button[onclick*="setPrimaryImage"]');
      if (oldStarBtn) oldStarBtn.remove();
      
      if (isPrimary) {
        // Ajouter le badge "Principale"
        const imgContainer = card.querySelector('.aspect-square');
        const badge = document.createElement('span');
        badge.className = 'absolute top-2 left-2 bg-yellow-500 text-white text-xs px-2 py-1 rounded-full font-bold shadow-lg flex items-center gap-1';
        badge.innerHTML = `
          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
          </svg>
          Principale
        `;
        
        // Insérer après le badge partagé s'il existe, sinon en premier
        const sharedBadge = imgContainer.querySelector('.bg-purple-500');
        if (sharedBadge) {
          sharedBadge.after(badge);
        } else {
          imgContainer.insertBefore(badge, imgContainer.firstChild.nextSibling);
        }
      } else {
        // Ajouter le bouton étoile pour les autres images
        const btnContainer = card.querySelector('.absolute.top-2.right-2');
        if (btnContainer) {
          const starBtn = document.createElement('button');
          starBtn.type = 'button';
          starBtn.onclick = () => setPrimaryImage(cardUrl);
          starBtn.className = 'bg-yellow-500 hover:bg-yellow-600 text-white p-1.5 rounded-full shadow-lg transition-colors';
          starBtn.title = 'Définir comme image principale';
          starBtn.innerHTML = `
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
              <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
            </svg>
          `;
          btnContainer.insertBefore(starBtn, btnContainer.firstChild);
        }
      }
    });
    
    refreshArticleImagesPreview();
  }

  // Mettre à jour le compteur d'images
  function updateArticleImagesCount() {
    const count = document.getElementById('article-images-count');
    if (count) {
      count.textContent = window.uploadedGameImages.length;
    }
  }

  // Mettre à jour la légende d'une image
  function updateArticleImageCaption(imageUrl, caption) {
    console.log(`📝 Légende mise à jour pour ${imageUrl}:`, caption);
    // TODO: Implémenter la sauvegarde des légendes si nécessaire
  }

  // Charger les images existantes de cet article dans la modal
  function loadArticleImages() {
    const grid = document.getElementById('article-images-grid');
    if (!grid) return;
    
    // Effacer la grille
    grid.innerHTML = '';
    
    if (window.uploadedGameImages.length === 0) {
      grid.innerHTML = '<div class="col-span-full text-center text-gray-500 py-8">📭 Aucune photo pour le moment</div>';
      return;
    }
    
    window.uploadedGameImages.forEach(img => {
      // Extraction robuste de l'URL
      let imageUrl;
      if (typeof img === 'string') {
        imageUrl = img;
      } else if (typeof img === 'object' && img !== null && typeof img.url === 'string') {
        imageUrl = img.url;
      } else {
        console.warn('⚠️ Image invalide ignorée:', img);
        return;
      }
      
      // Validation finale
      if (!imageUrl || !imageUrl.startsWith('http')) {
        console.warn('⚠️ URL image invalide ignorée:', imageUrl);
        return;
      }
      
      addArticleImageCard(imageUrl, imageUrl.split('/').pop(), 'uploaded');
    });
    
    updateArticleImagesCount();
  }

  // Charger les photos génériques (autres articles du même type)
  async function loadGenericArticleImages() {
    const grid = document.getElementById('generic-images-grid');
    if (!grid || !window.currentArticleTypeId) {
      if (grid) {
        grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-4">⚠️ Aucun type d\'article sélectionné</div>';
      }
      return;
    }
    
    grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6"><div class="animate-pulse">⏳ Chargement des photos...</div></div>';
    
    try {
      const response = await fetch(`${AJAX_ARTICLE_IMAGES_ROUTE}/${window.currentArticleTypeId}`);
      const data = await response.json();
      
      if (data.success && data.images && data.images.length > 0) {
        window.genericArticleImages = data.images;
        
        grid.innerHTML = '';
        data.images.forEach((imageUrl, index) => {
          const isAlreadyAdded = window.uploadedGameImages.some(img => {
            const url = typeof img === 'object' ? img.url : img;
            return url === imageUrl;
          });
          
          const card = document.createElement('div');
          card.className = `relative group rounded-lg overflow-hidden border-2 transition-all cursor-pointer ${
            isAlreadyAdded ? 'border-purple-500 bg-purple-50' : 'border-gray-200 hover:border-indigo-400'
          }`;
          card.dataset.genericImage = imageUrl;
          
          card.innerHTML = `
            <div class="aspect-square relative bg-gray-100">
              <img src="${imageUrl}" alt="Photo générique ${index + 1}" class="w-full h-full object-cover">
              
              ${isAlreadyAdded ? `
                <div class="absolute inset-0 bg-purple-500 bg-opacity-20 flex items-center justify-center">
                  <span class="bg-purple-600 text-white px-3 py-1.5 rounded-full font-bold text-sm shadow-lg">
                    ✓ Ajoutée
                  </span>
                </div>
              ` : `
                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all flex items-center justify-center">
                  <button type="button" 
                          onclick="addGenericImageToArticle('${imageUrl}')"
                          class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium opacity-0 group-hover:opacity-100 transition-opacity transform group-hover:scale-105">
                    ➕ Ajouter
                  </button>
                </div>
              `}
            </div>
          `;
          
          grid.appendChild(card);
        });
        
        document.getElementById('generic-images-count').textContent = `${data.images.length} photo(s) disponible(s)`;
      } else {
        grid.innerHTML = '<div class="col-span-full text-center text-gray-400 py-6">📭 Aucune autre photo trouvée pour ce type</div>';
        document.getElementById('generic-images-count').textContent = '0 photo';
      }
    } catch (error) {
      console.error('❌ Erreur lors du chargement des photos génériques:', error);
      grid.innerHTML = '<div class="col-span-full text-center text-red-400 py-6">❌ Erreur de chargement</div>';
    }
  }

  // Ajouter une photo générique à cet article
  window.addGenericImageToArticle = function(imageUrl) {
    // Vérifier si déjà présente
    const alreadyExists = window.uploadedGameImages.some(img => {
      const url = typeof img === 'object' ? img.url : img;
      return url === imageUrl;
    });
    
    if (alreadyExists) {
      console.log('⚠️ Cette image est déjà ajoutée');
      return;
    }
    
    // Ajouter avec flag is_generic
    window.uploadedGameImages.push({
      url: imageUrl,
      is_generic: true
    });
    
    console.log('✅ Photo générique ajoutée:', imageUrl);
    
    // Recharger les deux grilles
    loadArticleImages();
    loadGenericArticleImages();
    refreshArticleImagesPreview();
  };

  // Retirer une photo générique de cet article
  window.deselectGenericImage = function(imageUrl) {
    window.uploadedGameImages = window.uploadedGameImages.filter(img => {
      const url = typeof img === 'object' ? img.url : img;
      return url !== imageUrl;
    });
    
    // Si c'était l'image principale, choisir une autre
    if (window.primaryImageUrl === imageUrl) {
      if (window.uploadedGameImages.length > 0) {
        const firstImg = window.uploadedGameImages[0];
        window.primaryImageUrl = typeof firstImg === 'object' ? firstImg.url : firstImg;
      } else {
        window.primaryImageUrl = '';
      }
    }
    
    console.log('➖ Photo générique retirée:', imageUrl);
    
    loadArticleImages();
    loadGenericArticleImages();
    refreshArticleImagesPreview();
  };

  // Supprimer une image (avec confirmation spéciale pour les génériques)
  window.deleteArticleImage = async function(imageUrl) {
    const imageObj = window.uploadedGameImages.find(img => {
      const url = typeof img === 'object' ? img.url : img;
      return url === imageUrl;
    });
    
    const isGeneric = typeof imageObj === 'object' && imageObj.is_generic;
    
    let confirmMessage = 'Supprimer cette image ?';
    if (isGeneric) {
      confirmMessage = '⚠️ Cette image est partagée avec d\'autres articles.\n\nElle sera seulement retirée de CET article (pas des autres).\n\nContinuer ?';
    }
    
    if (!confirm(confirmMessage)) return;
    
    if (isGeneric) {
      // Pour les images génériques, juste retirer de la liste
      deselectGenericImage(imageUrl);
      return;
    }
    
    // Pour les images propres à cet article, supprimer du serveur
    try {
      const response = await fetch(DELETE_IMAGE_ROUTE, {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ image_url: imageUrl })
      });
      
      const data = await response.json();
      
      if (data.success) {
        window.uploadedGameImages = window.uploadedGameImages.filter(img => {
          const url = typeof img === 'object' ? img.url : img;
          return url !== imageUrl;
        });
        
        if (window.primaryImageUrl === imageUrl) {
          if (window.uploadedGameImages.length > 0) {
            const firstImg = window.uploadedGameImages[0];
            window.primaryImageUrl = typeof firstImg === 'object' ? firstImg.url : firstImg;
          } else {
            window.primaryImageUrl = '';
          }
        }
        
        console.log('✅ Image supprimée:', imageUrl);
        loadArticleImages();
        refreshArticleImagesPreview();
      } else {
        alert('❌ Erreur lors de la suppression: ' + data.message);
      }
    } catch (error) {
      console.error('❌ Erreur suppression:', error);
      alert('❌ Erreur lors de la suppression');
    }
  };

window.refreshArticleImagesPreview = function() {
    const previewContainer = document.getElementById('game-images-preview');
    
    if (!previewContainer) return;
    
    if (window.uploadedGameImages.length === 0) {
      previewContainer.innerHTML = '<div class="col-span-4 text-center text-gray-400 py-6 border-2 border-dashed border-gray-300 rounded-lg">📭 Aucune photo pour le moment</div>';
      return;
    }
    
    // Gérer les deux formats: string ou {url, is_generic} avec validation
    const sortedImages = window.uploadedGameImages
      .map(img => {
        if (typeof img === 'string') return img;
        if (typeof img === 'object' && img !== null && typeof img.url === 'string') return img.url;
        return null;
      })
      .filter(url => url && typeof url === 'string' && url.startsWith('http'));
    
    if (sortedImages.length === 0) {
      previewContainer.innerHTML = '<div class="col-span-4 text-center text-gray-400 py-6 border-2 border-dashed border-gray-300 rounded-lg">📭 Aucune photo valide</div>';
      return;
    }
    
    // Trier pour mettre l'image principale en premier
    if (window.primaryImageUrl) {
      sortedImages.sort((a, b) => {
        if (a === window.primaryImageUrl) return -1;
        if (b === window.primaryImageUrl) return 1;
        return 0;
      });
    }
    
    previewContainer.innerHTML = sortedImages.slice(0, 4).map((url) => {
      const isPrimary = (url === window.primaryImageUrl);
      return `
        <div class="relative group">
          <img src="${url}" class="w-full aspect-square object-cover rounded border-2 ${isPrimary ? 'border-indigo-600' : 'border-gray-300'}">
          ${isPrimary ? '<span class="absolute top-1 left-1 bg-indigo-600 text-white text-xs px-2 py-1 rounded font-bold shadow-lg">⭐ Principale</span>' : ''}
        </div>
      `;
    }).join('');
    
    if (sortedImages.length > 4) {
      const more = document.createElement('div');
      more.className = 'flex items-center justify-center bg-gray-100 rounded border-2 border-gray-300 aspect-square text-gray-500 font-medium';
      more.textContent = `+${sortedImages.length - 4}`;
      previewContainer.appendChild(more);
    }

    // Mettre à jour les champs cachés du formulaire
    // Pour images_input: garder le format {url, is_generic} si présent, sinon juste l'URL
    document.getElementById('images_input').value = JSON.stringify(window.uploadedGameImages);
    document.getElementById('main_image_input').value = window.primaryImageUrl || '';
};

console.log('✅ Toutes les fonctions de gestion d\'images sont chargées:', {
    openTaxonomyImagesForProductSheet: typeof window.openTaxonomyImagesForProductSheet,
    openArticleImagesModal: typeof window.openArticleImagesModal,
    closeArticleImagesModal: typeof window.closeArticleImagesModal,
    setPrimaryImage: typeof window.setPrimaryImage,
    deleteArticleImage: typeof window.deleteArticleImage,
    refreshArticleImagesPreview: typeof window.refreshArticleImagesPreview
});

document.addEventListener('DOMContentLoaded', function() {
    // Initialiser le champ hidden avec les critères existants
    var hiddenInput = document.getElementById('condition_criteria_input');
    if (hiddenInput && typeof conditionCriteria !== 'undefined') {
        hiddenInput.value = JSON.stringify(conditionCriteria);
    }

    // Charger les images d'article existantes dans la grille
    if (typeof refreshArticleImagesPreview === 'function') {
        refreshArticleImagesPreview();
    }

    // ========================================
    // GESTION DYNAMIQUE DES SECTIONS À AFFICHER
    // ========================================
    const sectionCheckboxes = document.querySelectorAll('input[name="display_sections[]"]');
    const sectionTextareas = {
        'marketing_description': document.querySelector('textarea[name="marketing_description"]'),
        'description': document.querySelector('textarea[name="description"]'),
        'technical_specs': document.querySelector('textarea[name="technical_specs"]'),
        'included_items': document.querySelector('textarea[name="included_items"]')
    };

    function updateSectionDisplay(sectionName, isVisible) {
        const sectionDiv = document.querySelector('[data-section="' + sectionName + '"]');
        const textarea = sectionTextareas[sectionName];
        const content = textarea ? textarea.value : '';
        
        if (sectionDiv) {
            if (isVisible) {
                sectionDiv.classList.remove('hidden');
                const contentP = sectionDiv.querySelector('.section-content');
                if (contentP) {
                    contentP.textContent = content || '(Aucun contenu)';
                }
            } else {
                sectionDiv.classList.add('hidden');
            }
        }
    }

    // Écouter les changements sur les checkboxes
    sectionCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSectionDisplay(this.value, this.checked);
        });
    });

    // Écouter les changements sur les textareas pour mise à jour en temps réel
    Object.keys(sectionTextareas).forEach(sectionName => {
        const textarea = sectionTextareas[sectionName];
        if (textarea) {
            textarea.addEventListener('input', function() {
                const checkbox = document.querySelector('input[name="display_sections[]"][value="' + sectionName + '"]');
                if (checkbox && checkbox.checked) {
                    updateSectionDisplay(sectionName, true);
                }
            });
        }
    });

    // Gestion de l'activation/désactivation des critères
    document.querySelectorAll('.criterion-toggle').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const criterion = this.value;
            const row = this.closest('.flex.items-center.gap-4');
            const starsContainer = row.querySelector('[data-criterion="' + criterion + '"]');
            
            if (this.checked) {
                // Activer le critère avec 1 étoile par défaut
                row.classList.remove('bg-gray-50', 'border-gray-200');
                row.classList.add('bg-yellow-50', 'border-yellow-200');
                if (!conditionCriteria[criterion]) {
                    conditionCriteria[criterion] = 1;
                    // Mettre à jour la première étoile
                    const stars = starsContainer.querySelectorAll('.star-btn');
                    stars[0].classList.remove('text-gray-300');
                    stars[0].classList.add('text-yellow-400');
                }
            } else {
                // Désactiver le critère
                row.classList.remove('bg-yellow-50', 'border-yellow-200');
                row.classList.add('bg-gray-50', 'border-gray-200');
                delete conditionCriteria[criterion];
                // Réinitialiser les étoiles
                const stars = starsContainer.querySelectorAll('.star-btn');
                stars.forEach(star => {
                    star.classList.remove('text-yellow-400');
                    star.classList.add('text-gray-300');
                });
            }
            // Mettre à jour le champ hidden
            document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
        });
    });

    // Initialiser l'input featured_mods
    document.getElementById('featured_mods_input').value = JSON.stringify(featuredMods);
    
    // Fonction pour mettre à jour l'affichage des icônes des mods (globale) - overlay sur image
    window.updateModsIconsDisplay = function() {
        const container = document.getElementById('mods-icons-display');
        if (!container) return;
        
        if (featuredMods.length === 0) {
            container.classList.add('hidden');
            container.innerHTML = '';
        } else {
            container.classList.remove('hidden');
            container.innerHTML = featuredMods.map(mod => {
                if (mod.icon && mod.icon.startsWith('data:image/')) {
                    return `<img src="${mod.icon}" alt="${mod.name || 'Mod'}" class="w-6 h-6 drop-shadow-lg" style="image-rendering: pixelated;" title="${mod.name || 'Mod'}">`;
                } else {
                    return `<span class="text-lg drop-shadow-lg" title="${mod.name || 'Mod'}">${mod.icon || '🔧'}</span>`;
                }
            }).join('');
        }
    }
    
    document.querySelectorAll('.mod-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (this.checked) {
                if (!featuredMods.find(m => m.id === parseInt(this.value))) {
                    featuredMods.push({
                        id: parseInt(this.value),
                        name: this.dataset.name,
                        icon: this.dataset.icon || '🔧'
                    });
                }
            } else {
                featuredMods = featuredMods.filter(m => m.id !== parseInt(this.value));
            }
            document.getElementById('featured_mods_input').value = JSON.stringify(featuredMods);
            updateModsIconsDisplay();
        });
    });

    // Mettre à jour les champs hidden avant la soumission du formulaire
    document.querySelector('form').addEventListener('submit', function(e) {
        // Mettre à jour condition_criteria
        document.getElementById('condition_criteria_input').value = JSON.stringify(conditionCriteria);
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

    // Upload d'images - utiliser les images déjà normalisées
    let existingImages = {!! json_encode($jsImages ?? []) !!};
    let mainImage = '{{ $jsPrimaryImage ?? '' }}';
    let newImages = [];

    const imageUpload = document.getElementById('image_upload');
    if (imageUpload) {
        imageUpload.addEventListener('change', async function(e) {
            const files = Array.from(e.target.files);
            if (files.length === 0) return;

            const progressDiv = document.getElementById('upload_progress');
            const progressBar = document.getElementById('progress_bar');
            const uploadStatus = document.getElementById('upload_status');

            progressDiv.classList.remove('hidden');
            
            let uploaded = 0;
            const total = files.length;

            for (const file of files) {
                try {
                    const formData = new FormData();
                    formData.append('image', file);

                    const response = await fetch('{{ route("admin.product-sheets.upload-image") }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });

                    const data = await response.json();

                    if (data.success) {
                        newImages.push({
                            url: data.url,
                            path: data.path
                        });
                        
                        if (!mainImage) {
                            mainImage = data.url;
                        }
                    }
                } catch (error) {
                    console.error('Erreur upload:', error);
                }

                uploaded++;
                const percent = (uploaded / total) * 100;
                progressBar.style.width = percent + '%';
                uploadStatus.textContent = `Upload ${uploaded}/${total} images...`;
            }

            setTimeout(() => {
                progressDiv.classList.add('hidden');
                progressBar.style.width = '0%';
            }, 1000);

            updateNewImages();
            e.target.value = '';
        });
    }

    function updateNewImages() {
        const newDiv = document.getElementById('newImages');
        const listDiv = document.getElementById('newImagesList');

        if (newImages.length === 0) {
            newDiv.classList.add('hidden');
            return;
        }

        newDiv.classList.remove('hidden');
        listDiv.innerHTML = newImages.map((img, index) => `
            <div class="relative group">
                <img src="${img.url}" class="w-full h-20 object-cover rounded border ${img.url === mainImage ? 'ring-2 ring-indigo-600' : ''}">
                <button type="button" onclick="removeNewImage(${index})" 
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                ${img.url === mainImage ? '<span class="absolute bottom-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded">Principale</span>' : `<button type="button" onclick="setNewMainImage(${index})" class="absolute bottom-1 left-1 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Définir principale</button>`}
            </div>
        `).join('');

        updateHiddenFields();
    }

    function updateHiddenFields() {
        // Utiliser window.uploadedGameImages (depuis la modal) au lieu de existingImages/newImages
        const rawImages = window.uploadedGameImages && window.uploadedGameImages.length > 0 
            ? window.uploadedGameImages 
            : [...existingImages, ...newImages.map(img => img.url)];
        
        // Normaliser : extraire seulement les URLs (strings)
        const imagesToSave = rawImages.map(img => typeof img === 'object' ? img.url : img);
        
        document.getElementById('images_input').value = JSON.stringify(imagesToSave);
        const mainImageValue = window.primaryImageUrl || mainImage || '';
        document.getElementById('main_image_input').value = mainImageValue;
        
        console.log('📤 Images à sauvegarder:', imagesToSave);
    }

    window.removeExistingImage = async function(imageUrl) {
        existingImages = existingImages.filter(img => img !== imageUrl);
        if (mainImage === imageUrl) {
            mainImage = existingImages.length > 0 ? existingImages[0] : (newImages.length > 0 ? newImages[0].url : '');
        }
        updateCurrentImages();
        updateHiddenFields();
    }

    window.setExistingMainImage = function(imageUrl) {
        mainImage = imageUrl;
        updateCurrentImages();
        updateHiddenFields();
    }

    window.removeNewImage = async function(index) {
        const img = newImages[index];
        
        try {
            await fetch('{{ route("admin.product-sheets.delete-image") }}', {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: JSON.stringify({ path: img.path })
            });
        } catch (error) {
            console.error('Erreur suppression:', error);
        }

        newImages.splice(index, 1);
        
        if (mainImage === img.url) {
            mainImage = existingImages.length > 0 ? existingImages[0] : (newImages.length > 0 ? newImages[0].url : '');
        }
        
        updateNewImages();
        updateHiddenFields();
    }

    window.setNewMainImage = function(index) {
        mainImage = newImages[index].url;
        updateNewImages();
        updateCurrentImages();
        updateHiddenFields();
    }

    function updateCurrentImages() {
        const currentDiv = document.getElementById('currentImages');
        if (!currentDiv) return;

        currentDiv.innerHTML = existingImages
            .filter(img => typeof img === 'string' && img.startsWith('http'))
            .map(img => `
            <div class="relative group" data-image-url="${img}">
                <img src="${img}" class="w-full h-20 object-cover rounded border ${img === mainImage ? 'ring-2 ring-indigo-600' : ''}">
                <button type="button" onclick="removeExistingImage('${img}')" 
                        class="absolute top-1 right-1 bg-red-500 text-white rounded-full p-1 opacity-0 group-hover:opacity-100 transition">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
                ${img === mainImage ? '<span class="absolute bottom-1 left-1 bg-indigo-600 text-white text-xs px-1 rounded">Principale</span>' : `<button type="button" onclick="setExistingMainImage('${img}')" class="absolute bottom-1 left-1 bg-gray-800 text-white text-xs px-2 py-1 rounded opacity-0 group-hover:opacity-100 transition">Définir principale</button>`}
            </div>
        `).join('');
    }
});
</script>

{{-- Modal pour édition des images de taxonomie --}}
<script>
    // Variables pour l'édition des images taxonomie
    let taxonomyModalIdentifier = null;
    let taxonomyModalFolder = null;
    let taxonomyModalPlatform = null;
    
    window.openTaxonomyImageEditorModal = function() {
        console.log('🖼️ Ouverture modal édition images taxonomie');
        
        // Récupérer les infos depuis PHP
        const romId = @json(isset($associatedConsole) ? $associatedConsole->rom_id : null);
        const articleTypeName = @json($selectedType->name ?? 'Article');
        const subCategoryName = @json($selectedSubCategory->name ?? '');
        const categoryName = @json($selectedCategory->name ?? '');
        
        // Images déjà connues depuis PHP (pour affichage immédiat)
        const knownImages = {
            cover: @json($selectedType->cover_image_url ?? null),
            logo: @json($selectedType->logo_url ?? null),
            artwork: @json($selectedType->screenshot2_url ?? null),
            gameplay: @json($selectedType->screenshot1_url ?? null)
        };
        
        // Déterminer le folder basé sur la catégorie/sous-catégorie
        let folder = 'other';
        if (subCategoryName) {
            folder = subCategoryName.toLowerCase().replace(/\s+/g, '');
        } else if (categoryName) {
            folder = categoryName.toLowerCase().replace(/\s+/g, '');
        }
        
        // Identifier = ROM ID ou nom du type slugifié
        const identifier = romId || articleTypeName.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '');
        const platform = subCategoryName || categoryName || 'Generic';
        
        // Stocker pour les fonctions ultérieures
        taxonomyModalIdentifier = identifier;
        taxonomyModalFolder = folder;
        taxonomyModalPlatform = platform;
        
        console.log('📂 Données modal taxonomie:', { identifier, folder, platform, romId, knownImages });
        
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
                        <option value="cover">📖 Cover</option>
                        <option value="logo">🏷️ Logo</option>
                        <option value="artwork">🎨 Artwork</option>
                        <option value="gameplay">🎮 Gameplay</option>
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
    
    window.closeTaxonomyImageEditorModal = function(skipReload = false) {
        const modal = document.getElementById('taxonomy-image-editor-modal');
        if (modal) {
            modal.remove();
            // Recharger la page pour afficher les nouvelles images (sauf si skipReload)
            if (!skipReload) {
                window.location.reload();
            }
        }
    };
    
    // Images connues depuis PHP (pour affichage immédiat)
    const knownTaxonomyImages = {
        cover: @json($selectedType->cover_image_url ?? null),
        logo: @json($selectedType->logo_url ?? null),
        artwork: @json($selectedType->screenshot2_url ?? null),
        gameplay: @json($selectedType->screenshot1_url ?? null)
    };
    
    // Images uploadées pendant cette session (pour les afficher même si R2 est lent)
    let sessionUploadedImages = [];
    
    // Charger les images de taxonomie dans la grille
    async function loadTaxonomyImagesGrid(identifier, folder) {
        const gridContainer = document.getElementById('taxonomy-images-grid');
        if (!gridContainer) return;
        
        // Afficher le chargement
        gridContainer.innerHTML = `
            <div class="col-span-2 sm:col-span-4 text-center text-gray-500 py-4">
                <div class="animate-pulse">⏳ Chargement des images...</div>
            </div>
        `;
        
        // 1. Collecter les images PHP connues (toujours les inclure)
        const allImages = [];
        const seenUrls = new Set();
        
        Object.entries(knownTaxonomyImages).forEach(([type, url]) => {
            if (url && !seenUrls.has(url)) {
                allImages.push({
                    url: url,
                    type: type,
                    full_type: type,
                    index: 1,
                    size: 0,
                    source: 'php'
                });
                seenUrls.add(url);
            }
        });
        
        // 2. Ajouter les images uploadées pendant cette session
        sessionUploadedImages.forEach(img => {
            if (!seenUrls.has(img.url)) {
                allImages.push(img);
                seenUrls.add(img.url);
            }
        });
        
        // 3. Charger les images R2 et les fusionner
        try {
            const response = await fetch(`{{ route("admin.taxonomy.get-images") }}?identifier=${encodeURIComponent(identifier)}&folder=${encodeURIComponent(folder)}`, {
                headers: {
                    'Accept': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const contentType = response.headers.get('content-type');
            if (contentType && contentType.includes('application/json')) {
                const data = await response.json();
                
                if (data.success && data.images.length > 0) {
                    // Ajouter les images R2 qui ne sont pas déjà dans la liste
                    data.images.forEach(img => {
                        if (!seenUrls.has(img.url)) {
                            allImages.push(img);
                            seenUrls.add(img.url);
                        }
                    });
                }
            }
        } catch (e) {
            console.warn('⚠️ Erreur chargement R2:', e);
        }
        
        // 4. Afficher toutes les images
        if (allImages.length > 0) {
            renderTaxonomyImagesGrid(gridContainer, allImages, identifier, folder);
        } else {
            gridContainer.innerHTML = `
                <div class="col-span-2 sm:col-span-4 text-center text-gray-400 py-8">
                    <div class="text-4xl mb-2">📭</div>
                    <div>Aucune image trouvée pour ce type</div>
                    <div class="text-sm mt-2">Utilisez le formulaire ci-dessus pour ajouter des images</div>
                </div>
            `;
        }
    }
    
    // Fonction de rendu des images
    function renderTaxonomyImagesGrid(gridContainer, images, identifier, folder) {
        gridContainer.innerHTML = '';
        
        const timestamp = Date.now();
        
        images.forEach(image => {
            const imageCard = document.createElement('div');
            imageCard.className = 'border-2 border-gray-200 rounded-lg p-3 bg-white hover:border-blue-400 transition-colors';
            
            const img = document.createElement('img');
            img.src = `${image.url}?t=${timestamp}`;
            img.className = 'w-full h-40 object-cover rounded mb-2 cursor-pointer';
            img.onclick = () => window.openZoomModal ? window.openZoomModal(image.url) : window.open(image.url, '_blank');
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
            // Désactiver le select pour les images PHP (pas renommables directement)
            if (image.source === 'php') {
                select.disabled = true;
                select.className += ' bg-gray-100 cursor-not-allowed';
            } else {
                select.onchange = () => renameTaxonomyImageEdit(identifier, folder, image.full_type, select.value);
            }
            
            labelRow.appendChild(select);
            
            // Badge d'index si > 1
            if (image.index > 1) {
                const badge = document.createElement('span');
                badge.className = 'text-xs bg-blue-100 text-blue-700 px-2 py-1 rounded font-semibold ml-2';
                badge.textContent = '#' + image.index;
                labelRow.appendChild(badge);
            }
            
            // Bouton suppression (seulement pour images R2, pas PHP)
            if (image.source !== 'php') {
                const deleteBtn = document.createElement('button');
                deleteBtn.type = 'button';
                deleteBtn.className = 'text-red-600 hover:text-red-800 text-xl leading-none ml-2';
                deleteBtn.innerHTML = '🗑️';
                deleteBtn.title = 'Supprimer cette image';
                deleteBtn.onclick = () => deleteTaxonomyImageEdit(identifier, folder, image.full_type);
                labelRow.appendChild(deleteBtn);
            }
            
            // Assembler
            imageCard.appendChild(img);
            imageCard.appendChild(labelRow);
            
            // Bouton "Utiliser pour cette fiche" - toujours visible
            const useForSheetBtn = document.createElement('button');
            useForSheetBtn.type = 'button';
            useForSheetBtn.className = 'w-full text-xs bg-indigo-600 hover:bg-indigo-700 text-white px-2 py-1 rounded font-medium flex items-center justify-center gap-1 mt-2';
            useForSheetBtn.innerHTML = '⭐ Utiliser pour cette fiche';
            useForSheetBtn.title = 'Définir comme image principale de cette fiche produit';
            useForSheetBtn.onclick = () => {
                window.useTaxonomyImageAsPrimary(image.url);
                closeTaxonomyImageEditorModal(true); // Ne pas recharger la page
            };
            imageCard.appendChild(useForSheetBtn);
            
            // Bouton "Définir comme principale" pour les images indexées (seulement R2)
            if (image.index > 1 && image.source !== 'php') {
                const setPrimaryBtn = document.createElement('button');
                setPrimaryBtn.type = 'button';
                setPrimaryBtn.className = 'w-full text-xs bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded font-medium flex items-center justify-center gap-1 mt-2';
                setPrimaryBtn.innerHTML = '🔄 Définir comme principale (R2)';
                setPrimaryBtn.title = 'Remplacer l\'image principale de ce type sur R2';
                setPrimaryBtn.onclick = () => setAsPrimaryImageEdit(identifier, folder, image.full_type, image.type);
                imageCard.appendChild(setPrimaryBtn);
            }
            
            // Afficher la taille si disponible
            if (image.size > 0) {
                const sizeInfo = document.createElement('div');
                sizeInfo.className = 'text-xs text-gray-500 text-center mt-1';
                const sizeKb = (image.size / 1024).toFixed(1);
                sizeInfo.textContent = `${sizeKb} Ko`;
                imageCard.appendChild(sizeInfo);
            }
            
            gridContainer.appendChild(imageCard);
        });
        
        // Compteur
        const countInfo = document.createElement('div');
        countInfo.className = 'col-span-2 sm:col-span-4 text-center text-sm text-gray-600 mt-2 pt-2 border-t';
        countInfo.textContent = `Total : ${images.length} image${images.length > 1 ? 's' : ''}`;
        gridContainer.appendChild(countInfo);
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
                // Ajouter les URLs retournées à la session pour affichage immédiat
                if (data.urls && data.urls.length > 0) {
                    data.urls.forEach(url => {
                        sessionUploadedImages.push({
                            url: url,
                            type: selectedType,
                            full_type: selectedType,
                            index: sessionUploadedImages.filter(i => i.type === selectedType).length + 2,
                            size: 0,
                            source: 'upload'
                        });
                    });
                }
                
                alert('✅ ' + data.message);
                loadTaxonomyImagesGrid(identifier, folder);
                document.getElementById('taxonomy-image-file-input').value = '';
            } else {
                alert('❌ Erreur: ' + data.message);
            }
        } catch (e) {
            console.error('Erreur upload:', e);
            alert('❌ Erreur lors de l\'upload');
        }
    }
    
    // Renommer une image de taxonomie
    async function renameTaxonomyImageEdit(identifier, folder, oldType, newType) {
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
                alert('✅ ' + data.message);
                loadTaxonomyImagesGrid(identifier, folder);
            } else {
                alert('❌ Erreur: ' + data.message);
            }
        } catch (e) {
            console.error('Erreur renommage:', e);
            alert('❌ Erreur lors du renommage');
        }
    }
    
    // Supprimer une image de taxonomie
    async function deleteTaxonomyImageEdit(identifier, folder, type) {
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
                alert('✅ ' + data.message);
                loadTaxonomyImagesGrid(identifier, folder);
            } else {
                alert('❌ Erreur: ' + data.message);
            }
        } catch (e) {
            console.error('Erreur suppression:', e);
            alert('❌ Erreur lors de la suppression');
        }
    }
    
    // Définir une image comme principale
    async function setAsPrimaryImageEdit(identifier, folder, currentFullType, baseType) {
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
                alert('✅ ' + data.message);
                loadTaxonomyImagesGrid(identifier, folder);
            } else {
                alert('❌ ' + data.message);
            }
        } catch (e) {
            console.error('Erreur:', e);
            alert('❌ Erreur lors de l\'opération');
        }
    }
</script>

{{-- Modal pour logo éditeur --}}
<script>
    // Variables globales pour le modal éditeur
    let selectedPublisherId = null;
    let selectedPublisherName = '{{ $selectedType?->publisher ?? '' }}';
    let selectedLogoFile = null;
    
    // Ouvrir le modal de gestion de l'éditeur
    window.openPublisherLogoModal = function() {
        const articleTypeId = {{ isset($selectedType) && $selectedType ? $selectedType->id : 'null' }};
        
        if (!articleTypeId) {
            alert('Aucun type d\'article sélectionné');
            return;
        }

        const modal = document.createElement('div');
        modal.id = 'publisher-logo-modal';
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4';
        
        const modalContent = document.createElement('div');
        modalContent.className = 'bg-white rounded-lg shadow-xl max-w-2xl w-full max-h-[90vh] overflow-y-auto';
        
        // Header
        const header = document.createElement('div');
        header.className = 'bg-gradient-to-r from-purple-600 to-purple-700 text-white px-6 py-4 rounded-t-lg flex justify-between items-center sticky top-0';
        header.innerHTML = `
          <h3 class="text-xl font-bold">🏢 Gérer l'éditeur</h3>
          <button onclick="closePublisherLogoModal()" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
        `;
        
        // Body
        const body = document.createElement('div');
        body.className = 'p-6 space-y-6';
        
        // Section Sélection d'éditeur
        const publisherSection = document.createElement('div');
        publisherSection.className = 'space-y-4';
        publisherSection.innerHTML = `
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Éditeur actuel</label>
            <div class="relative">
              <input type="text" id="publisher-search" 
                     value="${selectedPublisherName || ''}"
                     placeholder="Rechercher ou ajouter un éditeur..."
                     class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-purple-500"
                     autocomplete="off">
              <div id="publisher-suggestions" 
                   class="absolute z-10 w-full bg-white border border-gray-300 rounded-lg mt-1 shadow-lg hidden max-h-60 overflow-y-auto">
              </div>
            </div>
            <p class="text-xs text-gray-500 mt-1">Tapez pour rechercher parmi les éditeurs existants ou créez-en un nouveau</p>
          </div>
          
          <div id="selected-publisher-info" class="bg-purple-50 p-4 rounded-lg border border-purple-200 ${selectedPublisherName ? '' : 'hidden'}">
            <div class="flex items-center justify-between">
              <div>
                <span class="text-sm text-gray-500">Éditeur sélectionné:</span>
                <p id="selected-publisher-name" class="font-semibold text-purple-800">${selectedPublisherName || ''}</p>
              </div>
              <button type="button" onclick="clearSelectedPublisher()" class="text-red-500 hover:text-red-700 text-sm">
                ✕ Retirer
              </button>
            </div>
          </div>
        `;
        
        // Section Upload Logo
        const uploadSection = document.createElement('div');
        uploadSection.id = 'publisher-logo-dropzone';
        uploadSection.className = 'border-2 border-dashed border-purple-300 rounded-lg p-6 bg-purple-50 transition-all cursor-pointer';
        uploadSection.innerHTML = `
          <div class="text-center">
            <h4 class="font-semibold text-gray-700 mb-2">📷 Logo de l'éditeur</h4>
            <p class="text-sm text-gray-500 mb-4">Glissez-déposez une image ou cliquez pour sélectionner</p>
            
            <input type="file" id="publisher-logo-file" accept="image/*" class="hidden">
            
            <div class="flex flex-col items-center gap-3">
              <div class="w-16 h-16 rounded-full bg-purple-100 flex items-center justify-center">
                <svg class="w-8 h-8 text-purple-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                </svg>
              </div>
              <button type="button" onclick="document.getElementById('publisher-logo-file').click()" 
                      class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium flex items-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                📁 Choisir une image
              </button>
            </div>
          </div>
        `;
        
        // Prévisualisation
        const previewSection = document.createElement('div');
        previewSection.id = 'publisher-logo-preview';
        previewSection.className = 'flex items-center justify-center p-8 bg-gray-50 rounded-lg border border-gray-200 min-h-[150px]';
        @if(isset($selectedType) && $selectedType?->publisher_logo_url)
            previewSection.innerHTML = '<img src="{{ $selectedType->publisher_logo_url }}" class="max-h-32 object-contain rounded-lg">';
        @else
            previewSection.innerHTML = '<p class="text-gray-400">Aucun logo disponible</p>';
        @endif
        
        body.appendChild(publisherSection);
        body.appendChild(uploadSection);
        body.appendChild(previewSection);
        
        // Footer
        const footer = document.createElement('div');
        footer.className = 'bg-gray-50 px-6 py-4 rounded-b-lg flex justify-end gap-3 sticky bottom-0';
        footer.innerHTML = `
          <button type="button" onclick="closePublisherLogoModal()" 
                  class="px-4 py-2 rounded border hover:bg-gray-100">Annuler</button>
          <button type="button" id="save-publisher-btn"
                  class="px-4 py-2 rounded bg-purple-600 text-white hover:bg-purple-700">
            Enregistrer
          </button>
        `;
        
        modalContent.appendChild(header);
        modalContent.appendChild(body);
        modalContent.appendChild(footer);
        modal.appendChild(modalContent);
        document.body.appendChild(modal);
        
        // Event listeners
        setupPublisherSearch();
        setupLogoUpload();
        setupSaveButton(articleTypeId);
    };
    
    // Configurer la recherche d'éditeurs
    function setupPublisherSearch() {
        const searchInput = document.getElementById('publisher-search');
        const suggestionsDiv = document.getElementById('publisher-suggestions');
        let debounceTimer;
        
        searchInput.addEventListener('input', (e) => {
            clearTimeout(debounceTimer);
            const query = e.target.value.trim();
            
            if (query.length < 2) {
                suggestionsDiv.classList.add('hidden');
                return;
            }
            
            debounceTimer = setTimeout(async () => {
                try {
                    const response = await fetch('/admin/ajax/search-publishers?q=' + encodeURIComponent(query));
                    const data = await response.json();
                    
                    suggestionsDiv.innerHTML = '';
                    
                    if (data.publishers && data.publishers.length > 0) {
                        data.publishers.forEach(pub => {
                            const option = document.createElement('div');
                            option.className = 'px-4 py-3 hover:bg-purple-50 cursor-pointer flex items-center gap-3 border-b last:border-0';
                            option.innerHTML = `
                                <div class="w-10 h-10 bg-gray-100 rounded flex items-center justify-center overflow-hidden">
                                    ${pub.logo ? '<img src="' + pub.logo + '" class="w-full h-full object-contain">' : '<span class="text-gray-400">🏢</span>'}
                                </div>
                                <span class="font-medium">${pub.name}</span>
                            `;
                            option.onclick = () => selectPublisher(pub.id, pub.name, pub.logo);
                            suggestionsDiv.appendChild(option);
                        });
                    }
                    
                    // Option pour créer un nouvel éditeur
                    const createOption = document.createElement('div');
                    createOption.className = 'px-4 py-3 hover:bg-green-50 cursor-pointer flex items-center gap-3 bg-green-50/50 border-t-2 border-green-200';
                    createOption.innerHTML = `
                        <div class="w-10 h-10 bg-green-100 rounded flex items-center justify-center">
                            <span class="text-green-600 text-xl">+</span>
                        </div>
                        <span class="font-medium text-green-700">Créer "${query}"</span>
                    `;
                    createOption.onclick = () => createNewPublisher(query);
                    suggestionsDiv.appendChild(createOption);
                    
                    suggestionsDiv.classList.remove('hidden');
                } catch (error) {
                    console.error('Erreur recherche éditeurs:', error);
                }
            }, 300);
        });
        
        // Fermer suggestions quand on clique ailleurs
        document.addEventListener('click', (e) => {
            if (!searchInput.contains(e.target) && !suggestionsDiv.contains(e.target)) {
                suggestionsDiv.classList.add('hidden');
            }
        });
    }
    
    // Sélectionner un éditeur existant
    function selectPublisher(id, name, logoUrl) {
        selectedPublisherId = id;
        selectedPublisherName = name;
        
        document.getElementById('publisher-search').value = name;
        document.getElementById('publisher-suggestions').classList.add('hidden');
        
        const infoDiv = document.getElementById('selected-publisher-info');
        infoDiv.classList.remove('hidden');
        document.getElementById('selected-publisher-name').textContent = name;
        
        // Mettre à jour la prévisualisation du logo
        const preview = document.getElementById('publisher-logo-preview');
        if (logoUrl) {
            preview.innerHTML = '<img src="' + logoUrl + '" class="max-h-32 object-contain rounded-lg">';
        } else {
            preview.innerHTML = '<p class="text-gray-400">Aucun logo disponible</p>';
        }
    }
    
    // Créer un nouvel éditeur
    function createNewPublisher(name) {
        selectedPublisherId = null;
        selectedPublisherName = name;
        
        document.getElementById('publisher-search').value = name;
        document.getElementById('publisher-suggestions').classList.add('hidden');
        
        const infoDiv = document.getElementById('selected-publisher-info');
        infoDiv.classList.remove('hidden');
        document.getElementById('selected-publisher-name').textContent = name + ' (nouveau)';
        
        const preview = document.getElementById('publisher-logo-preview');
        preview.innerHTML = '<p class="text-gray-400">Ajoutez un logo pour ce nouvel éditeur</p>';
    }
    
    // Effacer l'éditeur sélectionné
    window.clearSelectedPublisher = function() {
        selectedPublisherId = null;
        selectedPublisherName = '';
        
        document.getElementById('publisher-search').value = '';
        document.getElementById('selected-publisher-info').classList.add('hidden');
        document.getElementById('publisher-logo-preview').innerHTML = '<p class="text-gray-400">Aucun logo disponible</p>';
    };
    
    // Configurer l'upload de logo (avec drag & drop)
    function setupLogoUpload() {
        const dropzone = document.getElementById('publisher-logo-dropzone');
        const fileInput = document.getElementById('publisher-logo-file');
        
        // Handler pour traiter le fichier
        function handleFile(file) {
            if (!file || !file.type.startsWith('image/')) {
                alert('Veuillez sélectionner une image valide');
                return;
            }
            
            selectedLogoFile = file;
            
            const reader = new FileReader();
            reader.onload = (e) => {
                document.getElementById('publisher-logo-preview').innerHTML = 
                    '<img src="' + e.target.result + '" class="max-h-32 object-contain rounded-lg">';
            };
            reader.readAsDataURL(file);
        }
        
        // Événement change classique
        fileInput.addEventListener('change', (e) => {
            handleFile(e.target.files[0]);
        });
        
        // Drag & Drop events
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.add('border-purple-500', 'bg-purple-100');
            dropzone.classList.remove('border-purple-300', 'bg-purple-50');
        });
        
        dropzone.addEventListener('dragleave', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('border-purple-500', 'bg-purple-100');
            dropzone.classList.add('border-purple-300', 'bg-purple-50');
        });
        
        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            e.stopPropagation();
            dropzone.classList.remove('border-purple-500', 'bg-purple-100');
            dropzone.classList.add('border-purple-300', 'bg-purple-50');
            
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                handleFile(files[0]);
            }
        });
        
        // Permettre le clic sur toute la zone
        dropzone.addEventListener('click', (e) => {
            if (e.target.tagName !== 'BUTTON' && !e.target.closest('button')) {
                fileInput.click();
            }
        });
    }
    
    // Configurer le bouton Enregistrer
    function setupSaveButton(articleTypeId) {
        document.getElementById('save-publisher-btn').addEventListener('click', async () => {
            const publisherName = document.getElementById('publisher-search').value.trim();
            
            if (!publisherName) {
                alert('Veuillez sélectionner ou saisir un nom d\'éditeur');
                return;
            }
            
            const btn = document.getElementById('save-publisher-btn');
            btn.disabled = true;
            btn.textContent = 'Enregistrement...';
            
            try {
                const formData = new FormData();
                formData.append('publisher_name', publisherName);
                if (selectedPublisherId) {
                    formData.append('publisher_id', selectedPublisherId);
                }
                if (selectedLogoFile) {
                    formData.append('logo', selectedLogoFile);
                }
                
                const response = await fetch('/admin/article-types/' + articleTypeId + '/publisher', {
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
                
                if (!response.ok) {
                    // Gérer les erreurs de validation
                    if (data.errors) {
                        const errorMessages = Object.values(data.errors).flat().join('\n');
                        throw new Error(errorMessages);
                    }
                    throw new Error(data.message || 'Erreur serveur');
                }
                
                if (data.success) {
                    // Mettre à jour les éléments visuels
                    if (data.logo_url) {
                        const previewLogo = document.getElementById('preview-publisher-logo');
                        const formLogo = document.getElementById('form-publisher-logo');
                        if (previewLogo) previewLogo.src = data.logo_url;
                        if (formLogo) formLogo.src = data.logo_url;
                    }
                    
                    closePublisherLogoModal();
                    alert('Éditeur mis à jour avec succès!');
                    window.location.reload(); // Recharger pour mettre à jour toutes les références
                } else {
                    throw new Error(data.message || 'Erreur inconnue');
                }
            } catch (error) {
                console.error('Erreur:', error);
                alert('Erreur: ' + error.message);
                btn.disabled = false;
                btn.textContent = 'Enregistrer';
            }
        });
    }

    // Fermer le modal
    window.closePublisherLogoModal = function() {
        const modal = document.getElementById('publisher-logo-modal');
        if (modal) {
            modal.remove();
        }
        selectedLogoFile = null;
    };

    // ========================================
    // MODAL ZOOM IMAGE (style article images)
    // ========================================
    window.openZoomModal = function(imageSrc) {
        if (!imageSrc) return;
        
        const modal = document.createElement('div');
        modal.id = 'zoom-modal';
        modal.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4 overflow-y-auto';
        
        modal.innerHTML = `
            <div class="bg-white rounded-lg shadow-xl max-w-4xl w-full my-8" style="max-height: 90vh; overflow-y: auto;">
                <!-- Header style article images -->
                <div class="bg-gradient-to-r from-indigo-600 to-indigo-700 text-white px-6 py-4 rounded-t-lg flex justify-between items-center sticky top-0 z-10">
                    <h3 class="text-xl font-bold flex items-center gap-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                        Aperçu de l'image
                    </h3>
                    <button onclick="closeZoomModal()" class="text-white hover:text-gray-200 text-2xl leading-none">&times;</button>
                </div>
                
                <!-- Contrôles de zoom -->
                <div class="bg-gray-100 px-6 py-3 flex items-center justify-center gap-4 border-b">
                    <button onclick="zoomImage(-0.25)" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM13 10H7"></path>
                        </svg>
                        Réduire
                    </button>
                    <span id="zoom-level" class="text-lg font-semibold text-gray-700 min-w-[60px] text-center">100%</span>
                    <button onclick="zoomImage(0.25)" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                        </svg>
                        Agrandir
                    </button>
                    <button onclick="resetZoom()" class="bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg font-medium flex items-center gap-2 transition-colors ml-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                        </svg>
                        Reset
                    </button>
                </div>
                
                <!-- Container image avec scroll -->
                <div class="p-6 overflow-auto bg-gray-50" style="max-height: 65vh;">
                    <div class="flex items-center justify-center min-h-[300px]">
                        <img id="zoomed-image" src="${imageSrc}" alt="Aperçu" 
                             class="transition-transform duration-200 rounded-lg shadow-lg" 
                             style="transform-origin: center; max-width: 100%;">
                    </div>
                </div>
                
                <!-- Footer avec instructions -->
                <div class="bg-gray-100 px-6 py-3 rounded-b-lg text-center text-sm text-gray-500">
                    🖱️ Molette souris pour zoomer • 📱 Pincer pour zoomer sur tactile • Cliquez en dehors pour fermer
                </div>
            </div>
        `;
        
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeZoomModal();
        });
        
        // Zoom avec la molette de souris
        modal.addEventListener('wheel', function(e) {
            e.preventDefault();
            const delta = e.deltaY > 0 ? -0.1 : 0.1;
            zoomImage(delta);
        }, { passive: false });
        
        // Support tactile (pinch-to-zoom)
        let initialDistance = 0;
        let initialZoom = 1;
        
        modal.addEventListener('touchstart', function(e) {
            if (e.touches.length === 2) {
                initialDistance = Math.hypot(
                    e.touches[0].pageX - e.touches[1].pageX,
                    e.touches[0].pageY - e.touches[1].pageY
                );
                initialZoom = window.currentZoom;
            }
        }, { passive: true });
        
        modal.addEventListener('touchmove', function(e) {
            if (e.touches.length === 2) {
                e.preventDefault();
                const currentDistance = Math.hypot(
                    e.touches[0].pageX - e.touches[1].pageX,
                    e.touches[0].pageY - e.touches[1].pageY
                );
                const scale = currentDistance / initialDistance;
                window.currentZoom = Math.max(0.25, Math.min(3, initialZoom * scale));
                const img = document.getElementById('zoomed-image');
                const label = document.getElementById('zoom-level');
                if (img) img.style.transform = `scale(${window.currentZoom})`;
                if (label) label.textContent = Math.round(window.currentZoom * 100) + '%';
            }
        }, { passive: false });
        
        document.body.appendChild(modal);
        document.body.style.overflow = 'hidden';
        window.currentZoom = 1;
    };
    
    window.zoomImage = function(delta) {
        window.currentZoom = Math.max(0.25, Math.min(3, window.currentZoom + delta));
        const img = document.getElementById('zoomed-image');
        const label = document.getElementById('zoom-level');
        if (img) img.style.transform = `scale(${window.currentZoom})`;
        if (label) label.textContent = Math.round(window.currentZoom * 100) + '%';
    };
    
    window.resetZoom = function() {
        window.currentZoom = 1;
        const img = document.getElementById('zoomed-image');
        const label = document.getElementById('zoom-level');
        if (img) img.style.transform = 'scale(1)';
        if (label) label.textContent = '100%';
    };
    
    window.closeZoomModal = function() {
        const modal = document.getElementById('zoom-modal');
        if (modal) modal.remove();
        document.body.style.overflow = '';
    };
    
    // Fermer avec Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeZoomModal();
    });
</script>
@endsection
