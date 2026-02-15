@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-6">
        📦 Offres disponibles
    </h1>

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

    @if($offers->isEmpty())
        <div class="p-8 text-center text-gray-500 bg-pink-50 border border-pink-100 rounded-lg">
            <p class="text-xl">Aucune offre disponible pour le moment.</p>
        </div>
    @else
        {{-- Grille de mini fiches (4 par ligne) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($offers as $offer)
                @php
                    $console = $offer->console;
                    $hasMods = $console->mods && $console->mods->count() > 0;
                    $valorisation = $console->valorisation;
                    $prixPropose = $offer->sale_price;
                    $remise = 0;
                    if ($valorisation && $valorisation > 0) {
                        $remise = (($valorisation - $prixPropose) / $valorisation) * 100;
                    }
                    
                    // Récupérer les images de la ProductSheet
                    $sheet = $console->productSheet ?? null;
                    $articleImages = $sheet && isset($sheet->images) ? $sheet->images : [];
                    if (is_string($articleImages)) {
                        $articleImages = json_decode($articleImages, true) ?? [];
                    }
                    // Normaliser les images: extraire les URLs
                    $articleImages = array_filter(array_map(function($img) {
                        if (is_string($img) && str_starts_with($img, 'http')) return $img;
                        if (is_array($img) && isset($img['url']) && str_starts_with($img['url'], 'http')) return $img['url'];
                        return null;
                    }, $articleImages));
                    
                    // Si pas d'images dans ProductSheet, ajouter main_image
                    if (count($articleImages) === 0 && $sheet && $sheet->main_image) {
                        $articleImages = [$sheet->main_image];
                    }
                @endphp

                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border-2 {{ $hasMods ? 'border-amber-400' : 'border-gray-200' }}">
                    {{-- En-tête avec badge modé --}}
                    @if($hasMods)
                        <div class="bg-amber-400 text-amber-900 px-3 py-1 text-xs font-semibold text-center">
                            🔧 CONSOLE MODÉE
                        </div>
                    @endif

                    {{-- Slideshow des images --}}
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
                        }" class="relative group bg-gray-100">
                            <img :src="currentImage" 
                                 alt="Image article" 
                                 class="w-full h-48 object-contain">
                            
                            {{-- Boutons de navigation --}}
                            @if(count($articleImages) > 1)
                                <button @click.stop="prev()" type="button" class="absolute left-1 top-1/2 -translate-y-1/2 bg-black/50 text-white p-1.5 rounded-full hover:bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                    </svg>
                                </button>
                                <button @click.stop="next()" type="button" class="absolute right-1 top-1/2 -translate-y-1/2 bg-black/50 text-white p-1.5 rounded-full hover:bg-black/70 opacity-0 group-hover:opacity-100 transition-opacity">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                </button>
                                
                                {{-- Indicateur de position --}}
                                <div class="absolute bottom-2 right-2 bg-black/50 text-white text-xs px-2 py-0.5 rounded-full">
                                    <span x-text="(currentIndex + 1) + '/' + images.length"></span>
                                </div>
                            @endif
                        </div>
                    @else
                        {{-- Placeholder si pas d'image --}}
                        <div class="w-full h-48 flex flex-col items-center justify-center text-gray-400 bg-gray-100">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <span class="text-xs mt-2">Aucune image</span>
                        </div>
                    @endif

                    {{-- Zone cliquable pour voir la fiche --}}
                    <a href="{{ route('store.product-sheet', ['store' => auth()->user()->store_id, 'console' => $console->id]) }}" 
                       class="block p-4 hover:bg-gray-50 transition-colors">
                        
                        {{-- Numéro de fiche produit --}}
                        @if($console->productSheet)
                            <div class="mb-2 inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-blue-100 text-blue-800 border border-blue-200">
                                📄 Fiche #{{ $console->productSheet->id }}
                            </div>
                        @endif

                        {{-- Type de console --}}
                        <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 min-h-[3.5rem]">
                            {{ $console->articleType?->name ?? 'N/A' }}
                        </h3>

                        {{-- Classification --}}
                        <div class="text-xs text-gray-600 mb-3 space-y-1">
                            <div class="flex items-center gap-1">
                                <span class="font-semibold">{{ $console->articleCategory?->name }}</span>
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="text-blue-600">{{ $console->articleSubCategory?->brand?->name }}</span>
                            </div>
                        </div>

                        {{-- Badges région, complétude, langue --}}
                        <div class="flex flex-wrap gap-1 mb-3">
                            @if($console->region)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-indigo-100 text-indigo-800">
                                    @if($console->region === 'PAL') 🇪🇺
                                    @elseif($console->region === 'NTSC-U') 🇺🇸
                                    @elseif($console->region === 'NTSC-J') 🇯🇵
                                    @else 🌍
                                    @endif
                                    {{ $console->region }}
                                </span>
                            @endif
                            @if($console->completeness)
                                <span class="inline-flex items-center px-2 py-0.5 rounded text-xs bg-emerald-100 text-emerald-800">
                                    @if($console->completeness === 'Console seule') 📦
                                    @elseif($console->completeness === 'Avec boîte') 📦📄
                                    @else 📦📄🎮
                                    @endif
                                </span>
                            @endif
                        </div>

                        {{-- Mods --}}
                        @if($hasMods)
                            <div class="mb-3 pb-3 border-b border-gray-200">
                                <div class="flex flex-wrap gap-1">
                                    @foreach($console->mods as $mod)
                                        <span class="inline-flex items-center px-1.5 py-0.5 rounded text-xs border
                                            @if($mod->is_operation) bg-orange-50 text-orange-700 border-orange-200
                                            @elseif($mod->is_accessory) bg-purple-50 text-purple-700 border-purple-200
                                            @else bg-blue-50 text-blue-700 border-blue-200
                                            @endif">
                                            {{ Str::limit($mod->name, 15) }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        {{-- Prix --}}
                        <div class="mb-3">
                            <div class="text-2xl font-bold text-green-600 mb-1">
                                {{ number_format($prixPropose, 2, ',', ' ') }} €
                            </div>
                            @if($valorisation && $valorisation > 0)
                                <div class="text-xs text-gray-500 line-through">
                                    {{ number_format($valorisation, 2, ',', ' ') }} €
                                </div>
                                @if($remise > 0)
                                    <span class="inline-block mt-1 px-2 py-0.5 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        -{{ number_format($remise, 1) }}% 🎉
                                    </span>
                                @endif
                            @endif
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
