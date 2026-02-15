@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">📦 Suivi des envois et réceptions</h1>

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

    @if($offersByStore->isEmpty())
        <div class="bg-gray-50 border border-gray-200 rounded-lg p-8 text-center">
            <p class="text-xl text-gray-600">Aucun envoi en cours</p>
        </div>
    @else
        @foreach($offersByStore as $storeId => $offers)
            @php
                $store = $offers->first()->store;
                $buyOffers = $offers->where('status', 'validated_buy');
                $consignmentOffers = $offers->where('status', 'validated_consignment');
                $shippedOffers = $offers->where('status', 'shipped');
                $receivedOffers = $offers->where('status', 'received');
                
                $totalBuy = $buyOffers->sum('sale_price');
                $totalConsignment = $consignmentOffers->sum(fn($o) => $o->consignment_price ?? $o->sale_price);
            @endphp

            <div class="mb-8 bg-white rounded-lg shadow-md border-2 border-gray-200 overflow-hidden">
                {{-- En-tête magasin --}}
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 text-white p-6">
                    <h2 class="text-2xl font-bold mb-2">{{ $store->name }}</h2>
                    <div class="text-sm opacity-90">
                        <p>{{ $store->address }}</p>
                        <p>{{ $store->postal_code }} {{ $store->city }}</p>
                        @if($store->phone)
                            <p>📞 {{ $store->phone }}</p>
                        @endif
                    </div>
                </div>

                <div class="p-6">
                    {{-- ARTICLES À PRÉPARER (validated_buy / validated_consignment) --}}
                    @if($buyOffers->isNotEmpty() || $consignmentOffers->isNotEmpty())
                        <div class="mb-6 p-4 bg-amber-50 border-2 border-amber-300 rounded-lg"
                             x-data="{
                                 selectedBuy: @js($buyOffers->pluck('id')->toArray()),
                                 selectedConsignment: @js($consignmentOffers->pluck('id')->toArray()),
                                 get allSelected() { return [...this.selectedBuy, ...this.selectedConsignment]; }
                             }">
                            <h3 class="text-xl font-bold text-amber-900 mb-4">📋 À préparer pour expédition</h3>

                            {{-- Totaux --}}
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                @if($buyOffers->isNotEmpty())
                                    <div class="p-4 bg-blue-50 border-2 border-blue-300 rounded-lg">
                                        <h4 class="text-sm font-bold text-blue-900 mb-2">🛒 Achetés ({{ $buyOffers->count() }} articles)</h4>
                                        <div class="text-3xl font-bold text-blue-700 mb-3">{{ number_format($totalBuy, 2, ',', ' ') }} €</div>
                                        
                                        {{-- Formulaire paiement reçu --}}
                                        <form method="POST" action="{{ route('admin.shipments.payment-received') }}" class="space-y-2">
                                            @csrf
                                            <input type="hidden" name="offer_ids" :value="JSON.stringify(selectedBuy)">
                                            <input type="date" name="payment_date" value="{{ date('Y-m-d') }}" 
                                                   class="w-full px-3 py-2 border border-blue-300 rounded text-sm">
                                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 text-white font-semibold rounded hover:bg-blue-700 transition-colors">
                                                ✓ Marquer paiement reçu
                                            </button>
                                        </form>
                                    </div>
                                @endif

                                @if($consignmentOffers->isNotEmpty())
                                    <div class="p-4 bg-green-50 border-2 border-green-300 rounded-lg">
                                        <h4 class="text-sm font-bold text-green-900 mb-2">📦 Dépôt-vente ({{ $consignmentOffers->count() }} articles)</h4>
                                        <div class="text-3xl font-bold text-green-700">{{ number_format($totalConsignment, 2, ',', ' ') }} €</div>
                                    </div>
                                @endif
                            </div>

                            {{-- Liste des articles --}}
                            <div class="mb-4 p-3 bg-white rounded border border-amber-200">
                                <h4 class="font-semibold text-gray-900 mb-2">Articles dans ce lot :</h4>
                                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2 text-sm">
                                    @foreach($buyOffers->concat($consignmentOffers) as $offer)
                                        @php
                                            $console = $offer->console;
                                            $sheet = $console->productSheet;
                                            $statusColor = $offer->status === 'validated_buy' ? 'blue' : 'green';
                                        @endphp
                                        <div class="p-2 bg-{{ $statusColor }}-50 border border-{{ $statusColor }}-200 rounded text-center">
                                            <div class="font-bold text-{{ $statusColor }}-700">#{{ $console->id }}</div>
                                            <div class="text-xs text-gray-600 truncate">{{ $sheet?->name ?? $console->articleType?->name ?? 'N/A' }}</div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            {{-- Formulaire d'expédition --}}
                            <form method="POST" action="{{ route('admin.shipments.mark-shipped') }}" 
                                  class="p-4 bg-white rounded border-2 border-amber-400"
                                  @submit="if(!confirm('Marquer ces ' + allSelected.length + ' article(s) comme envoyés ?')) { event.preventDefault(); }">
                                @csrf
                                <input type="hidden" name="offer_ids" :value="JSON.stringify(allSelected)">
                                
                                <h4 class="font-bold text-gray-900 mb-3">📮 Informations d'expédition</h4>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Numéro de suivi</label>
                                        <input type="text" name="tracking_number" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                                               placeholder="Ex: 1234567890">
                                    </div>
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-1">Transporteur</label>
                                        <input type="text" name="carrier" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded focus:ring-2 focus:ring-blue-500"
                                               placeholder="Ex: Colissimo, Chronopost...">
                                    </div>
                                </div>
                                <button type="submit" class="mt-3 w-full px-6 py-3 bg-amber-600 text-white text-lg font-bold rounded-lg hover:bg-amber-700 transition-colors">
                                    🚚 Marquer comme envoyé
                                </button>
                            </form>
                        </div>
                    @endif

                    {{-- ARTICLES ENVOYÉS (en transit) --}}
                    @if($shippedOffers->isNotEmpty())
                        <div class="mb-6 p-4 bg-blue-50 border-2 border-blue-300 rounded-lg">
                            <h3 class="text-xl font-bold text-blue-900 mb-4">🚚 En transit ({{ $shippedOffers->count() }} articles)</h3>
                            
                            @foreach($shippedOffers->groupBy(fn($o) => $o->tracking_number ?? 'no-tracking') as $trackingKey => $trackingGroup)
                                @php
                                    $firstOffer = $trackingGroup->first();
                                @endphp
                                <div class="mb-3 p-3 bg-white rounded border border-blue-200">
                                    <div class="flex items-center justify-between mb-2">
                                        <div>
                                            @if($firstOffer->tracking_number)
                                                <div class="font-bold text-blue-700">📦 {{ $firstOffer->tracking_number }}</div>
                                                @if($firstOffer->carrier)
                                                    <div class="text-sm text-gray-600">{{ $firstOffer->carrier }}</div>
                                                @endif
                                            @else
                                                <div class="font-bold text-gray-600">Pas de numéro de suivi</div>
                                            @endif
                                        </div>
                                        <div class="text-sm text-gray-600">
                                            Envoyé le {{ $firstOffer->shipped_at?->format('d/m/Y à H:i') }}
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2 text-sm">
                                        @foreach($trackingGroup as $offer)
                                            @php
                                                $console = $offer->console;
                                                $sheet = $console->productSheet;
                                            @endphp
                                            <div class="p-2 bg-blue-50 border border-blue-200 rounded text-center">
                                                <div class="font-bold text-blue-700">#{{ $console->id }}</div>
                                                <div class="text-xs text-gray-600 truncate">{{ $sheet?->name ?? $console->articleType?->name ?? 'N/A' }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                            
                            <p class="text-sm text-gray-600 mt-3">
                                ℹ️ En attente de confirmation de réception par le magasin
                            </p>
                        </div>
                    @endif

                    {{-- ARTICLES REÇUS --}}
                    @if($receivedOffers->isNotEmpty())
                        <div class="p-4 bg-green-50 border-2 border-green-300 rounded-lg">
                            <h3 class="text-xl font-bold text-green-900 mb-3">✅ Réceptionnés ({{ $receivedOffers->count() }} articles)</h3>
                            
                            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2 text-sm">
                                @foreach($receivedOffers as $offer)
                                    @php
                                        $console = $offer->console;
                                        $sheet = $console->productSheet;
                                    @endphp
                                    <div class="p-2 bg-green-100 border border-green-300 rounded text-center">
                                        <div class="font-bold text-green-700">#{{ $console->id }}</div>
                                        <div class="text-xs text-gray-600 truncate">{{ $sheet?->name ?? $console->articleType?->name ?? 'N/A' }}</div>
                                        <div class="text-xs text-green-600 mt-1">{{ $offer->received_at?->format('d/m H:i') }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
