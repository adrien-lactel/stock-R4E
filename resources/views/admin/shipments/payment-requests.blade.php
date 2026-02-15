@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-900 mb-6">💰 Demandes de paiement - Articles en dépôt-vente</h1>

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

    {{-- SECTION DEMANDES EN ATTENTE --}}
    @if($pending->isNotEmpty())
        <div class="mb-8 bg-white rounded-lg shadow-md border-2 border-amber-300 overflow-hidden"
             x-data="{
                 selected: [],
                 get totalAmount() {
                     return this.selected.reduce((sum, id) => {
                         const offer = @js($pending->map(fn($o) => ['id' => $o->id, 'amount' => (float)$o->payment_request_amount])->toArray());
                         const found = offer.find(o => o.id === id);
                         return sum + (found ? found.amount : 0);
                     }, 0);
                 },
                 toggleOffer(offerId) {
                     const index = this.selected.indexOf(offerId);
                     if (index > -1) {
                         this.selected.splice(index, 1);
                     } else {
                         this.selected.push(offerId);
                     }
                 },
                 selectAll() {
                     this.selected = @js($pending->pluck('id')->toArray());
                 },
                 deselectAll() {
                     this.selected = [];
                 }
             }">
            <div class="bg-amber-500 text-white p-6">
                <h2 class="text-2xl font-bold">⏳ En attente de paiement ({{ $pending->count() }})</h2>
                <div class="text-sm opacity-90 mt-1">
                    Total à régler : {{ number_format($pending->sum('payment_request_amount'), 2) }} €
                </div>
            </div>

            <div class="p-6">
                {{-- Boutons de sélection --}}
                <div class="mb-4 flex gap-2">
                    <button @click="selectAll()" 
                            class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600 text-sm">
                        ✓ Tout sélectionner
                    </button>
                    <button @click="deselectAll()" 
                            class="px-4 py-2 bg-gray-400 text-white rounded hover:bg-gray-500 text-sm">
                        ✗ Tout désélectionner
                    </button>
                    <div class="ml-auto flex items-center gap-3">
                        <span class="text-gray-700 font-semibold" x-show="selected.length > 0">
                            Sélection : <span x-text="selected.length"></span> article(s) - 
                            <span x-text="totalAmount.toFixed(2)"></span> €
                        </span>
                    </div>
                </div>

                {{-- Formulaire de confirmation groupée --}}
                <form method="POST" action="{{ route('admin.shipments.confirm-payment') }}" 
                      class="mb-6 p-4 bg-green-50 border-2 border-green-300 rounded-lg"
                      @submit="if(!confirm('Confirmer le paiement de ' + totalAmount.toFixed(2) + ' € pour ' + selected.length + ' article(s) ?')) { event.preventDefault(); }">
                    @csrf
                    <input type="hidden" name="offer_ids" :value="JSON.stringify(selected)">
                    <button type="submit" 
                            class="w-full px-6 py-3 bg-green-600 text-white text-lg font-bold rounded-lg hover:bg-green-700 transition-colors"
                            :disabled="selected.length === 0">
                        ✓ Confirmer paiement sélection
                    </button>
                </form>

                {{-- Liste des demandes --}}
                <div class="grid grid-cols-1 gap-4">
                    @foreach($pending->groupBy('store_id') as $storeId => $storeOffers)
                        @php
                            $store = $storeOffers->first()->store;
                            $storeTotal = $storeOffers->sum('payment_request_amount');
                        @endphp
                        
                        <div class="border-2 border-gray-200 rounded-lg overflow-hidden">
                            {{-- En-tête magasin --}}
                            <div class="bg-gray-100 border-b-2 border-gray-200 p-4">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <h3 class="text-lg font-bold text-gray-900">{{ $store->name }}</h3>
                                        <div class="text-sm text-gray-600">{{ $storeOffers->count() }} article(s) vendus</div>
                                    </div>
                                    <div class="text-right">
                                        <div class="text-2xl font-bold text-amber-600">{{ number_format($storeTotal, 2) }} €</div>
                                        <div class="text-xs text-gray-600">À régler</div>
                                    </div>
                                </div>
                            </div>

                            {{-- Articles --}}
                            <div class="p-4 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-3">
                                @foreach($storeOffers as $offer)
                                    @php
                                        $console = $offer->console;
                                        $sheet = $console->productSheet;
                                    @endphp
                                    <div class="border rounded-lg overflow-hidden"
                                         :class="selected.includes({{ $offer->id }}) ? 'border-blue-500 ring-2 ring-blue-300' : 'border-gray-200'">
                                        <div class="p-3 cursor-pointer" @click="toggleOffer({{ $offer->id }})">
                                            <div class="flex items-center gap-2 mb-2">
                                                <input type="checkbox" 
                                                       :checked="selected.includes({{ $offer->id }})"
                                                       class="w-4 h-4 text-blue-600 rounded">
                                                <span class="text-xs font-mono text-gray-600">#{{ $console->id }}</span>
                                            </div>
                                            
                                            <div class="font-semibold text-sm text-gray-900 mb-1 line-clamp-2">
                                                {{ $sheet?->name ?? $console->articleType?->name ?? 'N/A' }}
                                            </div>
                                            
                                            <div class="flex items-center justify-between text-sm">
                                                <div class="text-gray-600">
                                                    Vendu le {{ $offer->sold_at->format('d/m/Y') }}
                                                </div>
                                            </div>
                                            
                                            <div class="mt-2 pt-2 border-t border-gray-200">
                                                <div class="text-lg font-bold text-green-600">
                                                    {{ number_format($offer->payment_request_amount, 2) }} €
                                                </div>
                                                <div class="text-xs text-gray-500">Part R4E (70%)</div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="bg-white shadow-md rounded-lg p-8 text-center text-gray-500 mb-8">
            Aucune demande de paiement en attente
        </div>
    @endif

    {{-- SECTION PAIEMENTS CONFIRMÉS --}}
    @if($confirmed->isNotEmpty())
        <div class="bg-white rounded-lg shadow-md border-2 border-green-300 overflow-hidden">
            <div class="bg-green-500 text-white p-6">
                <h2 class="text-2xl font-bold">✅ Paiements confirmés ({{ $confirmed->count() }})</h2>
                <div class="text-sm opacity-90 mt-1">
                    Total réglé : {{ number_format($confirmed->sum('payment_request_amount'), 2) }} €
                </div>
            </div>

            <div class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-3">
                    @foreach($confirmed as $offer)
                        @php
                            $console = $offer->console;
                            $sheet = $console->productSheet;
                        @endphp
                        <div class="border-2 border-green-200 rounded-lg p-3 bg-green-50">
                            <div class="text-xs text-gray-600 mb-1">
                                {{ $offer->store->name }} • #{{ $console->id }}
                            </div>
                            <div class="font-semibold text-sm text-gray-900 mb-2 line-clamp-2">
                                {{ $sheet?->name ?? $console->articleType?->name ?? 'N/A' }}
                            </div>
                            <div class="text-lg font-bold text-green-600">
                                {{ number_format($offer->payment_request_amount, 2) }} €
                            </div>
                            <div class="text-xs text-green-700 mt-1">
                                Payé le {{ $offer->payment_confirmed_at?->format('d/m/Y') }}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
