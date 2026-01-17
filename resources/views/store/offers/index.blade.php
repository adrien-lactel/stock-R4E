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

    <div class="bg-pink-50 shadow rounded-lg overflow-hidden border border-pink-100">
        @forelse($offers as $offer)
            @php
                $hasMods = $offer->console->mods && $offer->console->mods->count() > 0;
            @endphp
            <div class="border-b p-6 hover:bg-yellow-50 {{ $hasMods ? 'bg-amber-100 border-l-4 border-l-amber-300' : 'bg-white' }}">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Console Info --}}
                    <div>
                        <h3 class="text-lg font-semibold mb-2 bg-blue-50 px-2 py-1 rounded">
                            {{ $offer->console->articleType?->name ?? 'N/A' }}
                            @if($hasMods)
                                <span class="ml-2 px-2 py-0.5 text-xs bg-amber-200 text-amber-800 rounded">modé</span>
                            @endif
                        </h3>
                        <p class="text-sm text-gray-600 bg-purple-50 px-2 py-1 rounded">
                            <span class="font-mono">Serial: {{ $offer->console->serial_number }}</span>
                        </p>
                        <p class="text-xs text-gray-500 mt-1 bg-green-50 px-2 py-1 rounded">
                            {{ $offer->console->provenance_article }}
                        </p>
                        
                        {{-- Liste des mods/opérations (sans les prix) --}}
                        @if($hasMods)
                            <div class="mt-3 pt-3 border-t border-amber-200">
                                <p class="text-xs font-medium text-gray-600 mb-2">🔧 Mods & Opérations :</p>
                                <div class="flex flex-wrap gap-1">
                                    @foreach($offer->console->mods as $mod)
                                        <span class="inline-flex items-center gap-1 px-2 py-1 rounded text-xs border
                                            @if($mod->is_operation) bg-orange-100 text-orange-700 border-orange-200
                                            @elseif($mod->is_accessory) bg-purple-100 text-purple-700 border-purple-200
                                            @else bg-blue-100 text-blue-700 border-blue-200
                                            @endif">
                                            @if($mod->is_operation)
                                                ⚙️
                                            @elseif($mod->is_accessory)
                                                📦
                                            @else
                                                🔩
                                            @endif
                                            {{ $mod->name }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- Prix --}}
                    <div class="flex items-center bg-pink-50 px-2 py-4 rounded">
                        <div>
                            @php
                                $valorisation = $offer->console->valorisation;
                                $prixPropose = $offer->sale_price;
                                $remise = 0;
                                if ($valorisation && $valorisation > 0) {
                                    $remise = (($valorisation - $prixPropose) / $valorisation) * 100;
                                }
                            @endphp

                            <p class="text-sm text-gray-600">Prix proposé</p>
                            <p class="text-2xl font-bold text-green-600 bg-green-100 px-2 py-1 rounded">
                                {{ number_format($offer->sale_price, 2, ',', ' ') }} €
                            </p>

                            @if($valorisation && $valorisation > 0)
                                <div class="mt-2 flex items-center gap-2">
                                    <span class="text-xs text-gray-500 line-through">
                                        Valorisation : {{ number_format($valorisation, 2, ',', ' ') }} €
                                    </span>
                                </div>
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold border
                                        @if($remise > 0) bg-green-100 text-green-800 border-green-200
                                        @elseif($remise < 0) bg-red-100 text-red-800 border-red-200
                                        @else bg-gray-100 text-gray-800 border-gray-200
                                        @endif
                                    ">
                                        @if($remise > 0)
                                            -{{ number_format($remise, 1) }}% 🎉
                                        @elseif($remise < 0)
                                            +{{ number_format(abs($remise), 1) }}%
                                        @else
                                            Prix égal
                                        @endif
                                    </span>
                                </div>
                            @endif
                        </div>
                    </div>

                    {{-- Action --}}
                    <div class="bg-blue-50 px-4 py-4 rounded">
                        <form method="POST" action="{{ route('store.offers.request', $offer) }}" class="space-y-2">
                            @csrf

                            <label class="block text-sm font-medium text-gray-700">
                                Quantité
                            </label>
                            <input
                                type="number"
                                name="quantity"
                                min="1"
                                value="1"
                                required
                                class="w-full border border-blue-200 rounded p-2 mb-2 bg-blue-50"
                            >

                            <button
                                class="w-full bg-indigo-100 text-indigo-800 border border-indigo-200 px-4 py-2 rounded hover:bg-indigo-200 font-medium">
                                ✅ Ajouter au lot
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            <div class="p-6 text-center text-gray-500 bg-pink-50 border border-pink-100 rounded-lg">
                Aucune offre disponible pour le moment.
            </div>
        @endforelse
    </div>

</div>
@endsection
