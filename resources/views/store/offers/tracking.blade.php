@extends('layouts.store')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold text-gray-900">📦 Suivi des envois</h1>
        <a href="{{ route('store.dashboard', $store) }}" class="px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700">
            ← Retour au tableau de bord
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
            {{ session('error') }}
        </div>
    @endif

    @if($shipments->isEmpty())
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 text-center">
            <p class="text-xl text-gray-600">Aucun envoi en cours</p>
        </div>
    @else
        @php
            $shippedShipments = $shipments->where('status', 'shipped');
            $receivedShipments = $shipments->where('status', 'received');
        @endphp

        {{-- EN TRANSIT --}}
        @if($shippedShipments->isNotEmpty())
            <div class="mb-8 bg-white rounded-lg shadow-md border-2 border-blue-300 overflow-hidden"
                 x-data="{
                     selected: @js($shippedShipments->pluck('id')->toArray())
                 }">
                <div class="bg-blue-500 text-white p-4">
                    <h2 class="text-2xl font-bold">🚚 En transit ({{ $shippedShipments->count() }} articles)</h2>
                </div>

                <div class="p-6">
                    @foreach($shippedShipments->groupBy('tracking_number') as $trackingNumber => $group)
                        @php
                            $firstShipment = $group->first();
                        @endphp
                        <div class="mb-6 p-4 bg-blue-50 border-2 border-blue-200 rounded-lg">
                            <div class="flex items-center justify-between mb-4">
                                <div>
                                    <div class="text-lg font-bold text-blue-900">
                                        @if($trackingNumber && $trackingNumber !== '')
                                            📦 {{ $trackingNumber }}
                                        @else
                                            Colis sans numéro de suivi
                                        @endif
                                    </div>
                                    @if($firstShipment->carrier)
                                        <div class="text-sm text-gray-600">Transporteur : {{ $firstShipment->carrier }}</div>
                                    @endif
                                    <div class="text-sm text-gray-600">
                                        Envoyé le {{ $firstShipment->shipped_at?->format('d/m/Y à H:i') }}
                                    </div>
                                </div>
                            </div>

                            {{-- Articles dans ce colis --}}
                            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-3 mb-4">
                                @foreach($group as $shipment)
                                    @php
                                        $console = $shipment->console;
                                        $sheet = $console->productSheet;
                                        $mainImage = $sheet?->main_image ?? null;
                                    @endphp
                                    <div class="bg-white rounded-lg border-2 border-blue-300 overflow-hidden">
                                        @if($mainImage)
                                            <img src="{{ $mainImage }}" alt="Article" class="w-full h-24 object-contain bg-gray-50">
                                        @else
                                            <div class="w-full h-24 bg-gray-100 flex items-center justify-center">
                                                <span class="text-gray-400 text-xs">Pas d'image</span>
                                            </div>
                                        @endif
                                        <div class="p-2">
                                            <div class="font-bold text-blue-700 text-center">#{{ $console->id }}</div>
                                            <div class="text-xs text-gray-600 truncate text-center">
                                                {{ $sheet?->name ?? $console->articleType?->name ?? 'N/A' }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Bouton pour confirmer réception --}}
                            <form method="POST" action="{{ route('store.offers.confirm-reception') }}"
                                  @submit="if(!confirm('Confirmer la réception de ces {{ $group->count() }} article(s) ?')) { event.preventDefault(); }">
                                @csrf
                                @foreach($group as $shipment)
                                    <input type="hidden" name="offer_ids[]" value="{{ $shipment->id }}">
                                @endforeach
                                <button type="submit" class="w-full px-6 py-3 bg-green-600 text-white text-lg font-bold rounded-lg hover:bg-green-700 transition-colors">
                                    ✓ Confirmer la réception ({{ $group->count() }} articles)
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        {{-- REÇUS --}}
        @if($receivedShipments->isNotEmpty())
            <div class="bg-white rounded-lg shadow-md border-2 border-green-300 overflow-hidden">
                <div class="bg-green-500 text-white p-4">
                    <h2 class="text-2xl font-bold">✅ Réceptionnés ({{ $receivedShipments->count() }} articles)</h2>
                </div>

                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-6 gap-3">
                        @foreach($receivedShipments as $shipment)
                            @php
                                $console = $shipment->console;
                                $sheet = $console->productSheet;
                                $mainImage = $sheet?->main_image ?? null;
                            @endphp
                            <div class="bg-white rounded-lg border-2 border-green-300 overflow-hidden">
                                @if($mainImage)
                                    <img src="{{ $mainImage }}" alt="Article" class="w-full h-24 object-contain bg-gray-50">
                                @else
                                    <div class="w-full h-24 bg-gray-100 flex items-center justify-center">
                                        <span class="text-gray-400 text-xs">Pas d'image</span>
                                    </div>
                                @endif
                                <div class="p-2">
                                    <div class="font-bold text-green-700 text-center">#{{ $console->id }}</div>
                                    <div class="text-xs text-gray-600 truncate text-center">
                                        {{ $sheet?->name ?? $console->articleType?->name ?? 'N/A' }}
                                    </div>
                                    <div class="text-xs text-green-600 text-center mt-1">
                                        {{ $shipment->received_at?->format('d/m H:i') }}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    @endif
</div>
@endsection
