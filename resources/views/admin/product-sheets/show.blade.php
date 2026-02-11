@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    {{-- HEADER --}}
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🖼️ Fiche Produit</h1>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.product-sheets.edit', $sheet) }}" 
               class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                ✏️ Éditer
            </a>
            <a href="{{ route('admin.product-sheets.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">← Retour</a>
        </div>
    </div>

    @php
        $selectedType = $sheet->articleType;
        $selectedSubCategory = $selectedType?->subCategory;
    @endphp

    @if($selectedType)
        {{-- FICHE PRODUIT VISUELLE --}}
        <div class="bg-white rounded-lg p-6 mb-6">
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
                        $articleImages = $sheet->images ?? [];
                        if (is_string($articleImages)) {
                            $articleImages = json_decode($articleImages, true) ?? [];
                        }
                        // Normaliser les images: extraire les URLs des objets {url, is_generic}
                        $articleImages = array_filter(array_map(function($img) {
                            if (is_string($img) && str_starts_with($img, 'http')) return $img;
                            if (is_array($img) && isset($img['url']) && str_starts_with($img['url'], 'http')) return $img['url'];
                            return null;
                        }, $articleImages));
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
                                    <div class="absolute top-2 right-2 flex flex-wrap gap-1 bg-black/60 rounded-lg p-1.5 max-w-[60%] justify-end">
                                        @foreach($displayMods as $mod)
                                            @if(isset($mod['icon']) && str_starts_with($mod['icon'], 'data:image/'))
                                                <img src="{{ $mod['icon'] }}" alt="{{ $mod['name'] ?? 'Mod' }}" class="w-6 h-6 drop-shadow-lg" style="image-rendering: pixelated;" title="{{ $mod['name'] ?? 'Mod' }}">
                                            @else
                                                <span class="text-lg drop-shadow-lg" title="{{ $mod['name'] ?? 'Mod' }}">{{ $mod['icon'] ?? '🔧' }}</span>
                                            @endif
                                        @endforeach
                                    </div>
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

                    <h2 class="text-2xl font-bold text-gray-800 mb-2">{{ $selectedType->name }}</h2>
                    
                    {{-- Informations supplémentaires --}}
                    @if(isset($associatedConsole))
                        <div class="space-y-1.5">
                            @if($associatedConsole->rom_id)
                                <div class="flex items-center gap-2">
                                    <span class="text-sm font-semibold text-gray-700">ID:</span>
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

                    {{-- CRITÈRES DE COLLECTION --}}
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
                    
                    @php
                        $hasVisibleCriteria = false;
                        foreach($allCriteriaKeys as $key) {
                            if (isset($criteria[$key]) && $criteria[$key] > 0) {
                                $hasVisibleCriteria = true;
                                break;
                            }
                        }
                    @endphp
                    
                    @if($hasVisibleCriteria)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-700 mb-3">⭐ Critères</h3>
                            <div class="space-y-2">
                                @foreach($allCriteriaKeys as $key)
                                    @php
                                        $value = $criteria[$key] ?? 0;
                                    @endphp
                                    @if($value > 0)
                                        <div class="flex items-center justify-between">
                                            <span class="text-sm text-gray-600">{{ $criteriaLabels[$key] ?? $defaultLabelsDisplay[$key] }}</span>
                                            <div class="flex gap-0.5">
                                                @for($i = 1; $i <= 5; $i++)
                                                    <span class="text-lg {{ $value >= $i ? 'text-yellow-400' : 'text-gray-300' }}">★</span>
                                                @endfor
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- SECTIONS TEXTUELLES --}}
                    @if(in_array('marketing_description', $sheet->display_sections ?? []) && $sheet->marketing_description)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2">💬 Avis de l'équipe R4E</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $sheet->marketing_description }}</p>
                        </div>
                    @endif

                    @if(in_array('description', $sheet->display_sections ?? []) && $sheet->description)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2">📝 Description</h3>
                            <p class="text-sm text-gray-600 leading-relaxed">{{ $sheet->description }}</p>
                        </div>
                    @endif

                    @if(in_array('technical_specs', $sheet->display_sections ?? []) && $sheet->technical_specs)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2">⚙️ Caractéristiques techniques</h3>
                            <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $sheet->technical_specs }}</p>
                        </div>
                    @endif

                    @if(in_array('included_items', $sheet->display_sections ?? []) && $sheet->included_items)
                        <div class="mt-4 pt-4 border-t border-gray-200">
                            <h3 class="text-sm font-semibold text-gray-700 mb-2">📦 Accessoires inclus</h3>
                            <p class="text-sm text-gray-600 leading-relaxed whitespace-pre-line">{{ $sheet->included_items }}</p>
                        </div>
                    @endif
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

                    {{-- Logo Éditeur (en bas) --}}
                    <div class="w-64">
                        @if($selectedType->publisher_logo_url)
                            <img src="{{ $selectedType->publisher_logo_url }}" 
                                 alt="Logo éditeur" 
                                 class="w-full h-16 object-contain rounded-lg">
                        @else
                            <div class="w-full h-16 flex items-center justify-center bg-gray-100 rounded-lg">
                                <span class="text-xs text-gray-400">Pas de logo éditeur</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="bg-white rounded-lg p-6 text-center text-gray-500">
            <p>Aucun type d'article associé à cette fiche.</p>
        </div>
    @endif
</div>

{{-- MODAL ZOOM --}}
<div id="zoomModal" class="hidden fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4" onclick="closeZoomModal()">
    <button type="button" onclick="closeZoomModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 transition-colors z-50">
        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>
    <div class="relative max-w-full max-h-full overflow-hidden" onclick="event.stopPropagation()">
        <img id="zoomImage" src="" alt="Zoom" class="max-w-[90vw] max-h-[90vh] object-contain transition-transform duration-200" style="transform-origin: center center;">
    </div>
    <div class="absolute bottom-4 left-1/2 -translate-x-1/2 text-white/70 text-sm">
        Molette pour zoomer • Clic extérieur ou Échap pour fermer
    </div>
</div>

<script>
let currentScale = 1;
const minScale = 1;
const maxScale = 5;

function openZoomModal(imageUrl) {
    currentScale = 1;
    const modal = document.getElementById('zoomModal');
    const img = document.getElementById('zoomImage');
    img.src = imageUrl;
    img.style.transform = 'scale(1)';
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeZoomModal() {
    const modal = document.getElementById('zoomModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
    currentScale = 1;
}

// Zoom avec molette
document.getElementById('zoomModal')?.addEventListener('wheel', function(e) {
    e.preventDefault();
    const img = document.getElementById('zoomImage');
    const delta = e.deltaY > 0 ? -0.2 : 0.2;
    currentScale = Math.min(maxScale, Math.max(minScale, currentScale + delta));
    img.style.transform = `scale(${currentScale})`;
});

// Fermer avec Escape
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeZoomModal();
    }
});

// Zoom tactile (pinch-to-zoom)
let initialDistance = 0;
let initialScale = 1;

document.getElementById('zoomModal')?.addEventListener('touchstart', function(e) {
    if (e.touches.length === 2) {
        e.preventDefault();
        initialDistance = Math.hypot(
            e.touches[0].pageX - e.touches[1].pageX,
            e.touches[0].pageY - e.touches[1].pageY
        );
        initialScale = currentScale;
    }
});

document.getElementById('zoomModal')?.addEventListener('touchmove', function(e) {
    if (e.touches.length === 2) {
        e.preventDefault();
        const currentDistance = Math.hypot(
            e.touches[0].pageX - e.touches[1].pageX,
            e.touches[0].pageY - e.touches[1].pageY
        );
        const scale = (currentDistance / initialDistance) * initialScale;
        currentScale = Math.min(maxScale, Math.max(minScale, scale));
        const img = document.getElementById('zoomImage');
        img.style.transform = `scale(${currentScale})`;
    }
});
</script>
@endsection
