@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6" x-data="{
    selected: [],
    offers: @js($offers->map(function($offer) {
        return [
            'id' => $offer->id,
            'console_id' => $offer->console->id,
            'sale_price' => $offer->sale_price,
            'consignment_price' => $offer->consignment_price ?? 0,
        ];
    })),
    get totalAchat() {
        return this.selected.reduce((sum, id) => {
            const offer = this.offers.find(o => o.id === id);
            return sum + (offer ? parseFloat(offer.sale_price) : 0);
        }, 0);
    },
    get totalDepot() {
        return this.selected.reduce((sum, id) => {
            const offer = this.offers.find(o => o.id === id);
            return sum + (offer ? parseFloat(offer.consignment_price) : 0);
        }, 0);
    },
    toggleOffer(offerId) {
        const index = this.selected.indexOf(offerId);
        if (index > -1) {
            this.selected.splice(index, 1);
        } else {
            this.selected.push(offerId);
        }
    }
}">

    {{-- HEADER AVEC TOTAUX --}}
    <div class="mb-6 flex items-center justify-between gap-4">
        <h1 class="text-3xl font-bold">📦 Offres disponibles</h1>
        
        <div class="flex gap-4">
            <div class="bg-blue-100 border-2 border-blue-300 rounded-lg px-6 py-3 text-center min-w-[180px]">
                <div class="text-xs font-semibold text-blue-700 uppercase mb-1">Total Achat</div>
                <div class="text-2xl font-bold text-blue-900" x-text="totalAchat.toFixed(2) + ' €'"></div>
                <div class="text-xs text-blue-600 mt-1" x-text="selected.length + ' article(s)'"></div>
            </div>
            
            <div class="bg-green-100 border-2 border-green-300 rounded-lg px-6 py-3 text-center min-w-[180px]">
                <div class="text-xs font-semibold text-green-700 uppercase mb-1">Total Dépôt</div>
                <div class="text-2xl font-bold text-green-900" x-text="totalDepot.toFixed(2) + ' €'"></div>
                <div class="text-xs text-green-600 mt-1" x-text="selected.length + ' article(s)'"></div>
            </div>
        </div>
    </div>

    {{-- BOUTONS D'ACTION --}}
    <div class="mb-6 flex gap-3 justify-center" x-show="selected.length > 0" x-cloak>
        <form method="POST" action="{{ route('store.offers.bulk-buy') }}" @submit="if(!confirm('Acheter ' + selected.length + ' article(s) pour un total de ' + totalAchat.toFixed(2) + ' € ?')) { $event.preventDefault(); }">
            @csrf
            <input type="hidden" name="offer_ids" :value="JSON.stringify(selected)">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-3 rounded-lg shadow-lg transition-all">
                🛒 Acheter les articles sélectionnés
            </button>
        </form>
        
        <form method="POST" action="{{ route('store.offers.bulk-consignment') }}" @submit="if(!confirm('Prendre en dépôt-vente ' + selected.length + ' article(s) pour un total de ' + totalDepot.toFixed(2) + ' € ?')) { $event.preventDefault(); }">
            @csrf
            <input type="hidden" name="offer_ids" :value="JSON.stringify(selected)">
            <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold px-8 py-3 rounded-lg shadow-lg transition-all">
                📦 Prendre en dépôt-vente
            </button>
        </form>
        
        <form method="POST" action="{{ route('store.offers.bulk-reject') }}" @submit="if(!confirm('Refuser ' + selected.length + ' article(s) ?')) { $event.preventDefault(); }">
            @csrf
            <input type="hidden" name="offer_ids" :value="JSON.stringify(selected)">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold px-8 py-3 rounded-lg shadow-lg transition-all">
                ❌ Refuser les articles
            </button>
        </form>
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

    {{-- SECTION OFFRES VALIDÉES (en attente d'expédition) --}}
    @if($validatedOffers->isNotEmpty())
        <div class="mb-8 p-6 bg-amber-50 border-2 border-amber-300 rounded-lg">
            <h2 class="text-2xl font-bold text-amber-900 mb-4">
                📮 Articles validés en attente d'expédition ({{ $validatedOffers->count() }})
            </h2>
            
            <div class="mb-4 p-4 bg-white rounded-lg border border-amber-200">
                <h3 class="font-semibold text-amber-900 mb-2">📍 Adresse d'expédition :</h3>
                <div class="text-gray-700">
                    <p class="font-bold">{{ $store->name }}</p>
                    <p>{{ $store->address }}</p>
                    <p>{{ $store->postal_code }} {{ $store->city }}</p>
                    @if($store->phone)
                        <p class="mt-2">📞 {{ $store->phone }}</p>
                    @endif
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach($validatedOffers as $offer)
                    @php
                        $console = $offer->console;
                        $sheet = $console->productSheet ?? null;
                        $mainImage = $sheet?->main_image ?? null;
                        
                        $statusLabel = $offer->status === 'validated_buy' ? 'ACHAT' : 'DÉPÔT-VENTE';
                        $statusColor = $offer->status === 'validated_buy' ? 'blue' : 'green';
                        $price = $offer->status === 'validated_buy' ? $offer->sale_price : ($offer->consignment_price ?? $offer->sale_price);
                    @endphp
                    
                    <div class="bg-white rounded-lg border-2 border-{{ $statusColor }}-400 p-3">
                        @if($mainImage)
                            <img src="{{ $mainImage }}" alt="Article" class="w-full h-32 object-contain mb-2 rounded">
                        @else
                            <div class="w-full h-32 bg-gray-100 flex items-center justify-center mb-2 rounded">
                                <span class="text-gray-400 text-xs">Pas d'image</span>
                            </div>
                        @endif
                        
                        <div class="mb-2">
                            <span class="inline-block px-2 py-1 text-xs font-bold bg-{{ $statusColor }}-100 text-{{ $statusColor }}-800 rounded">
                                ✓ {{ $statusLabel }}
                            </span>
                        </div>
                        
                        <h4 class="text-sm font-bold text-gray-900 mb-1 line-clamp-2">
                            {{ $console->articleType?->name ?? 'N/A' }}
                        </h4>
                        
                        <div class="text-lg font-bold text-{{ $statusColor }}-600">
                            {{ number_format($price, 2, ',', ' ') }} €
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- SECTION OFFRES À VALIDER --}}
    <div class="mb-4">
        <h2 class="text-2xl font-bold text-gray-900">
            📋 Nouvelles offres à valider
            @if($offers->isNotEmpty())
                <span class="text-lg text-gray-600">({{ $offers->count() }})</span>
            @endif
        </h2>
    </div>

    @if($offers->isEmpty())
        <div class="p-8 text-center text-gray-500 bg-pink-50 border border-pink-100 rounded-lg">
            <p class="text-xl">Aucune nouvelle offre disponible pour le moment.</p>
        </div>
    @else
        {{-- Grille de mini fiches (4 par ligne) --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($offers as $offer)
                @php
                    $console = $offer->console;
                    $hasMods = $console->mods && $console->mods->count() > 0;
                    $valorisation = $console->valorisation;
                    $prixVente = $offer->sale_price;
                    $prixDepot = $offer->consignment_price ?? 0;
                    
                    // Récupérer les images de la ProductSheet
                    $sheet = $console->productSheet ?? null;
                    $isFavorite = $sheet && isset($sheet->is_favorite) && $sheet->is_favorite;
                    
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
                    
                    // Mods featured
                    $displayMods = $sheet && isset($sheet->featured_mods) ? $sheet->featured_mods : [];
                @endphp

                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border-2"
                     :class="selected.includes({{ $offer->id }}) ? 'border-blue-500 ring-2 ring-blue-300' : '{{ $hasMods ? 'border-amber-400' : 'border-gray-200' }}'">
                    
                    {{-- CHECKBOX DE SÉLECTION --}}
                    <div class="p-2 bg-gray-50 border-b flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" 
                                   :checked="selected.includes({{ $offer->id }})"
                                   @change="toggleOffer({{ $offer->id }})"
                                   class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500">
                            <span class="text-xs font-medium text-gray-700">Sélectionner</span>
                        </label>
                        
                        {{-- Badge modé --}}
                        @if($hasMods)
                            <span class="text-xs font-semibold text-amber-900 bg-amber-100 px-2 py-0.5 rounded">
                                🔧 MODÉE
                            </span>
                        @endif
                    </div>

                    {{-- Coup de cœur --}}
                    @if($isFavorite)
                        <div class="px-3 py-1.5 bg-red-50 border-b border-red-100 flex items-center gap-2">
                            <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                            </svg>
                            <span class="text-xs font-semibold text-red-700">Coup de cœur R4E</span>
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
                            
                            {{-- MODS OVERLAY (texte à gauche, logo à droite, centré verticalement à droite) --}}
                            @if(count($displayMods) > 0)
                                <div class="absolute top-0 right-0 bottom-0 flex flex-col justify-center items-end pr-2 gap-1 pointer-events-none">
                                    @foreach($displayMods as $mod)
                                        <div class="flex items-center gap-2 bg-black/70 backdrop-blur-sm rounded-lg px-2 py-1 max-w-[90%]">
                                            <span class="text-white text-xs font-medium truncate">{{ $mod['name'] ?? 'Mod' }}</span>
                                            @if(isset($mod['icon']))
                                                @if(str_starts_with($mod['icon'], 'data:image/'))
                                                    <img src="{{ $mod['icon'] }}" alt="{{ $mod['name'] ?? 'Mod' }}" class="w-5 h-5 flex-shrink-0" style="image-rendering: pixelated;">
                                                @else
                                                    <span class="text-lg flex-shrink-0">{{ $mod['icon'] }}</span>
                                                @endif
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                            
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

                        {{-- Badges région, complétude --}}
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

                        {{-- PRIX : R4E / VENTE / DÉPÔT --}}
                        <div class="space-y-2">
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Prix R4E:</span>
                                <span class="font-bold text-gray-800">{{ number_format($valorisation ?? 0, 2, ',', ' ') }} €</span>
                            </div>
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Prix vente:</span>
                                <span class="text-lg font-bold text-green-600">{{ number_format($prixVente, 2, ',', ' ') }} €</span>
                            </div>
                            <div class="flex items-center justify-between text-xs">
                                <span class="text-gray-600">Prix dépôt:</span>
                                <span class="font-bold text-blue-600">{{ number_format($prixDepot, 2, ',', ' ') }} €</span>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
