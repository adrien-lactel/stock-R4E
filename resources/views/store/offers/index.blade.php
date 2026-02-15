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
                @endphp

                <div class="bg-white rounded-lg shadow-md hover:shadow-xl transition-shadow duration-300 overflow-hidden border-2 {{ $hasMods ? 'border-amber-400' : 'border-gray-200' }}">
                    {{-- En-tête avec badge modé --}}
                    @if($hasMods)
                        <div class="bg-amber-400 text-amber-900 px-3 py-1 text-xs font-semibold text-center">
                            🔧 CONSOLE MODÉE
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

                    {{-- Formulaire d'ajout au panier (non cliquable pour la fiche) --}}
                    <div class="px-4 pb-4">
                        <form method="POST" action="{{ route('store.offers.request', $offer) }}" 
                              onclick="event.stopPropagation();">
                            @csrf
                            <div class="flex gap-2 items-center mb-2">
                                <label class="text-xs font-medium text-gray-700 whitespace-nowrap">Qté :</label>
                                <input
                                    type="number"
                                    name="quantity"
                                    min="1"
                                    value="1"
                                    required
                                    class="flex-1 border border-gray-300 rounded px-2 py-1 text-sm"
                                >
                            </div>
                            <button
                                type="submit"
                                class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 font-medium text-sm transition-colors">
                                🛒 Ajouter au panier
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>
@endsection
