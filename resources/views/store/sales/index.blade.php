@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">
            💰 Historique des ventes
        </h1>
        <a href="{{ route('store.dashboard', $store) }}" class="px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour stock
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- SECTION 1: VENTES VIA OFFRES (Dépôt-vente & Achetés) --}}
    @if($offerSales->isNotEmpty())
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4 text-indigo-900">
                📦 Ventes d'articles (dépôt-vente & achetés) — {{ $offerSales->count() }}
            </h2>
            
            <div class="bg-white shadow rounded-lg overflow-hidden border-2 border-indigo-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-indigo-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">#ID</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Article</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Prix de vente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Type</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Date de vente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase">Paiement R4E</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-700 uppercase">Fiche</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($offerSales as $offer)
                            @php
                                $console = $offer->console;
                                $sheet = $console->productSheet;
                                $soldDate = \Carbon\Carbon::parse($offer->sold_at);
                                $isConsignment = !$offer->payment_received;
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                    #{{ $console->id }}
                                </td>
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $sheet?->name ?? $console->articleType?->name ?? 'N/A' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $console->articleCategory?->name ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-bold text-green-600">
                                        {{ number_format($offer->sale_price ?? 0, 2) }} €
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($isConsignment)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            📦 Dépôt-vente
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            💳 Acheté
                                        </span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $soldDate->format('d/m/Y H:i') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        il y a {{ $soldDate->diffForHumans(null, true) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($isConsignment)
                                        @if($offer->payment_confirmed)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                ✅ Confirmé ({{ number_format($offer->payment_request_amount, 2) }} €)
                                            </span>
                                        @elseif($offer->payment_requested)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                                ⏳ En attente ({{ number_format($offer->payment_request_amount, 2) }} €)
                                            </span>
                                        @else
                                            <span class="text-xs text-gray-400">Non demandé</span>
                                        @endif
                                    @else
                                        <span class="text-xs text-gray-400">N/A (achat direct)</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center">
                                    <a href="{{ route('store.product-sheet', ['store' => $store->id, 'console' => $console->id]) }}"
                                       class="inline-flex items-center px-3 py-1.5 border border-indigo-600 text-xs font-medium rounded-md text-indigo-600 hover:bg-indigo-50">
                                        📄 Voir fiche
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- SECTION 2: VENTES DIRECTES DU STOCK --}}
    @if($directSales->isNotEmpty())
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4 text-gray-900">
                🏪 Ventes directes du stock magasin — {{ $directSales->count() }}
            </h2>
            
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Article</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Serial</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date de vente</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">SAV</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Facture</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($directSales as $sale)
                            @php
                                $soldDate = \Carbon\Carbon::parse($sale->sold_at);
                                $daysSinceSale = $soldDate->diffInDays(now());
                                $savPeriod = 365; // 1 an
                                $inSavPeriod = $daysSinceSale <= $savPeriod;
                                $hasSavRequest = $sale->returnRequest !== null;
                            @endphp
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">
                                        {{ $sale->productSheet?->name ?? $sale->articleType?->name ?? 'N/A' }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        {{ $sale->articleCategory?->name ?? '-' }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-mono text-gray-700">
                                    {{ $sale->serial_number ?: '—' }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">
                                        {{ $soldDate->format('d/m/Y') }}
                                    </div>
                                    <div class="text-xs text-gray-500">
                                        il y a {{ $soldDate->diffForHumans(null, true) }}
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($inSavPeriod)
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            ✅ Sous garantie ({{ $savPeriod - $daysSinceSale }}j restants)
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-600">
                                            ❌ Hors garantie
                                        </span>
                                    @endif

                                    @if($hasSavRequest)
                                        <div class="mt-1">
                                            <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-orange-100 text-orange-800">
                                                SAV en cours
                                            </span>
                                        </div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($sale->invoice_id)
                                        <a href="#" class="text-indigo-600 hover:text-indigo-900 text-sm font-medium">
                                            📄 Télécharger
                                        </a>
                                    @else
                                        <span class="text-xs text-gray-400">Aucune facture</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                    @if($inSavPeriod && !$hasSavRequest)
                                        <button
                                            type="button"
                                            onclick="toggleSavForm{{ $sale->id }}()"
                                            class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-red-600 hover:bg-red-700">
                                            🔧 Demande SAV
                                        </button>

                                        <form id="sav-form-{{ $sale->id }}"
                                              method="POST"
                                              action="{{ route('store.console.defective', $sale) }}"
                                              class="hidden mt-3 bg-red-50 border border-red-200 rounded p-3">
                                            @csrf

                                            <label class="block text-xs font-medium text-gray-700 mb-1">
                                                Motif du retour SAV
                                            </label>
                                            <textarea name="comment" required rows="2"
                                                      class="w-full border rounded p-2 text-sm mb-2"
                                                      placeholder="Décrivez le problème..."></textarea>

                                            <div class="flex gap-2">
                                                <button type="submit" class="flex-1 bg-red-600 text-white px-3 py-1.5 rounded text-xs hover:bg-red-700">
                                                    Envoyer
                                                </button>
                                                <button type="button" onclick="toggleSavForm{{ $sale->id }}()" class="flex-1 border px-3 py-1.5 rounded text-xs hover:bg-gray-50">
                                                    Annuler
                                                </button>
                                            </div>
                                        </form>

                                        <script>
                                        function toggleSavForm{{ $sale->id }}() {
                                            const form = document.getElementById('sav-form-{{ $sale->id }}');
                                            form.classList.toggle('hidden');
                                        }
                                        </script>
                                    @else
                                        <span class="text-xs text-gray-400">—</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif

    {{-- MESSAGE SI AUCUNE VENTE --}}
    @if($offerSales->isEmpty() && $directSales->isEmpty())
        <div class="bg-white shadow rounded-lg p-12 text-center">
            <div class="text-6xl mb-4">📭</div>
            <h3 class="text-xl font-semibold text-gray-700 mb-2">Aucune vente enregistrée</h3>
            <p class="text-gray-500">Les ventes apparaîtront ici une fois les articles vendus</p>
        </div>
    @endif

</div>
@endsection
