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

    <div class="bg-white shadow rounded-lg overflow-hidden">
        @forelse($offers as $offer)
            <div class="border-b p-6 hover:bg-gray-50">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    {{-- Console Info --}}
                    <div>
                        <h3 class="text-lg font-semibold mb-2">
                            {{ $offer->console->articleType?->name ?? 'N/A' }}
                        </h3>
                        <p class="text-sm text-gray-600">
                            <span class="font-mono">Serial: {{ $offer->console->serial_number }}</span>
                        </p>
                        <p class="text-xs text-gray-500 mt-1">
                            {{ $offer->console->provenance_article }}
                        </p>
                    </div>

                    {{-- Prix --}}
                    <div class="flex items-center">
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
                            <p class="text-2xl font-bold text-green-600">
                                {{ number_format($offer->sale_price, 2, ',', ' ') }} €
                            </p>

                            @if($valorisation && $valorisation > 0)
                                <div class="mt-2 flex items-center gap-2">
                                    <span class="text-xs text-gray-500 line-through">
                                        Valorisation : {{ number_format($valorisation, 2, ',', ' ') }} €
                                    </span>
                                </div>
                                <div class="mt-1">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                        @if($remise > 0) bg-green-100 text-green-800
                                        @elseif($remise < 0) bg-red-100 text-red-800
                                        @else bg-gray-100 text-gray-800
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
                    <div>
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
                                class="w-full border rounded p-2 mb-2"
                            >

                            <button
                                class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 font-medium">
                                ✅ Ajouter au lot
                            </button>
                        </form>
                    </div>
                </div>
            </div>

        @empty
            <div class="p-6 text-center text-gray-500">
                Aucune offre disponible pour le moment.
            </div>
        @endforelse
    </div>

</div>
@endsection
