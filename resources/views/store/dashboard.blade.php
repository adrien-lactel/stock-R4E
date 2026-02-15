@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    {{-- TITRE + NAVIGATION --}}
    <div class="mb-6">
        <h1 class="text-2xl sm:text-3xl font-bold mb-4">
            🏪 Stock du magasin : {{ $store->name }}
        </h1>
        
        {{-- BOUTONS DE NAVIGATION --}}
        <div class="flex flex-wrap gap-2 sm:gap-3">
            <a href="{{ route('store.offers.index') }}" 
               class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors text-sm sm:text-base font-medium shadow-sm">
                📦 Offres disponibles
            </a>
            
            <a href="{{ route('store.offers.tracking') }}" 
               class="inline-flex items-center px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors text-sm sm:text-base font-medium shadow-sm">
                🚚 Suivi des envois
            </a>
            
            <a href="{{ route('store.external-repair.create', $store) }}" 
               class="inline-flex items-center px-4 py-2 bg-orange-600 text-white rounded-lg hover:bg-orange-700 transition-colors text-sm sm:text-base font-medium shadow-sm">
                🔧 Demande réparation externe
            </a>
            
            <a href="{{ route('store.sales', $store) }}" 
               class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors text-sm sm:text-base font-medium shadow-sm">
                💰 Historique ventes
            </a>
        </div>
    </div>

    {{-- MESSAGES --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded-lg border border-green-300 shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg border border-red-300 shadow-sm">
            {{ session('error') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded-lg border border-red-300 shadow-sm">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- COMPTEUR FACTURES À PAYER --}}
    @if($totalOwed > 0)
        <div class="mb-6 p-6 bg-gradient-to-r from-amber-50 to-orange-50 border-2 border-amber-400 rounded-lg shadow-lg">
            <div class="flex items-center justify-between">
                <div>
                    <div class="text-sm font-medium text-amber-800 mb-1">💳 Factures à payer (dépôt-vente vendus)</div>
                    <div class="text-3xl font-bold text-amber-900">{{ number_format($totalOwed, 2) }} €</div>
                    <div class="text-xs text-amber-700 mt-1">Montant dû à R4E pour les ventes en dépôt-vente</div>
                </div>
                <div class="hidden sm:block">
                    <svg class="w-16 h-16 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                    </svg>
                </div>
            </div>
        </div>
    @endif

    {{-- SECTION 1 — ARTICLES EN DÉPÔT-VENTE --}}
    <h2 class="text-xl sm:text-2xl font-semibold mb-4">
        📦 Articles en dépôt-vente ({{ $consignmentOffers->count() }})
    </h2>

    @if($consignmentOffers->isEmpty())
        <div class="bg-white shadow-md rounded-lg p-8 text-center text-gray-500 mb-10">
            Aucun article en dépôt-vente
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
            @foreach($consignmentOffers as $offer)
                @php
                    $console = $offer->console;
                    $sheet = $console->productSheet;
                @endphp
                <div class="bg-white shadow-md rounded-lg overflow-hidden border-2 border-green-200 hover:shadow-lg transition-shadow">
                    {{-- En-tête de la carte --}}
                    <div class="bg-green-50 border-b border-green-200 px-4 py-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-mono text-gray-600">#{{ $console->id }}</span>
                            <div class="text-right">
                                <div class="text-xs text-green-700 font-semibold">DÉPÔT-VENTE</div>
                                <div class="text-lg font-bold text-green-600">
                                    {{ $offer->consignment_price ?? $offer->sale_price }} €
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Corps de la carte --}}
                    <div class="p-4">
                        <div class="mb-4">
                            <div class="font-semibold text-gray-900 text-sm">{{ $sheet?->name ?? $console->articleType?->name ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-600">{{ $console->articleCategory?->name ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $console->articleSubCategory?->name ?? '-' }}</div>
                        </div>
                        
                        {{-- Actions --}}
                        <div class="space-y-2">
                            <a href="{{ route('store.product-sheet', ['store' => $store->id, 'console' => $console->id]) }}" 
                               class="block w-full bg-indigo-600 text-white px-3 py-2 rounded hover:bg-indigo-700 text-center text-sm font-medium transition-colors">
                                📄 Fiche produit
                            </a>
                            
                            <button type="button"
                                    id="sell-btn-{{ $offer->id }}"
                                    onclick="toggleSellForm({{ $offer->id }})"
                                    class="w-full bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 text-sm font-medium transition-colors">
                                💰 Article vendu (génère facture)
                            </button>
                            
                            <form id="sell-form-{{ $offer->id }}"
                                  method="POST"
                                  action="{{ route('store.offers.sell-consignment') }}"
                                  class="hidden bg-green-50 border border-green-200 rounded p-3">
                                @csrf
                                <input type="hidden" name="offer_id" value="{{ $offer->id }}">
                                
                                <label class="block text-sm font-medium text-gray-700 mb-1">Prix de vente (€)</label>
                                <input type="number" 
                                       name="sale_price" 
                                       step="0.01" 
                                       min="0" 
                                       required
                                       value="{{ $offer->consignment_price ?? $offer->sale_price }}"
                                       class="w-full border rounded p-2 text-sm mb-2">
                                
                                <div class="text-xs text-gray-600 mb-3">
                                    Commission magasin (30%) : <span class="font-semibold">~{{ number_format(($offer->consignment_price ?? $offer->sale_price) * 0.30, 2) }} €</span><br>
                                    Montant R4E (70%) : <span class="font-semibold">~{{ number_format(($offer->consignment_price ?? $offer->sale_price) * 0.70, 2) }} €</span>
                                </div>
                                
                                <div class="flex gap-2">
                                    <button type="submit" class="flex-1 bg-green-600 text-white px-3 py-1 rounded text-sm">
                                        Confirmer vente
                                    </button>
                                    <button type="button"
                                            onclick="cancelSellForm({{ $offer->id }})"
                                            class="flex-1 bg-gray-300 text-gray-700 px-3 py-1 rounded text-sm">
                                        Annuler
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- SECTION 2 — ARTICLES ACHETÉS --}}
    <h2 class="text-xl sm:text-2xl font-semibold mb-4">
        🛒 Articles achetés ({{ $purchasedOffers->count() }})
    </h2>

    @if($purchasedOffers->isEmpty())
        <div class="bg-white shadow-md rounded-lg p-8 text-center text-gray-500 mb-10">
            Aucun article acheté
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mb-10">
            @foreach($purchasedOffers as $offer)
                @php
                    $console = $offer->console;
                    $sheet = $console->productSheet;
                @endphp
                <div class="bg-white shadow-md rounded-lg overflow-hidden border-2 border-blue-200 hover:shadow-lg transition-shadow">
                    {{-- En-tête de la carte --}}
                    <div class="bg-blue-50 border-b border-blue-200 px-4 py-3">
                        <div class="flex items-center justify-between">
                            <span class="text-xs font-mono text-gray-600">#{{ $console->id }}</span>
                            <div class="text-right">
                                <div class="text-xs text-blue-700 font-semibold">ACHETÉ</div>
                                <div class="text-lg font-bold text-blue-600">
                                    {{ $offer->sale_price }} €
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    {{-- Corps de la carte --}}
                    <div class="p-4">
                        <div class="mb-4">
                            <div class="font-semibold text-gray-900 text-sm">{{ $sheet?->name ?? $console->articleType?->name ?? 'N/A' }}</div>
                            <div class="text-xs text-gray-600">{{ $console->articleCategory?->name ?? '-' }}</div>
                            <div class="text-xs text-gray-500">{{ $console->articleSubCategory?->name ?? '-' }}</div>
                        </div>
                        
                        {{-- Actions --}}
                        <div class="space-y-2">
                            <a href="{{ route('store.product-sheet', ['store' => $store->id, 'console' => $console->id]) }}" 
                               class="block w-full bg-indigo-600 text-white px-3 py-2 rounded hover:bg-indigo-700 text-center text-sm font-medium transition-colors">
                                📄 Fiche produit
                            </a>
                            
                            <form method="POST" action="{{ route('store.console.sell', $console) }}">
                                @csrf
                                <button class="w-full bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 text-sm font-medium transition-colors">
                                    ✔ Article vendu
                                </button>
                            </form>
                            
                            <button
                                type="button"
                                id="sav-btn-{{ $console->id }}"
                                onclick="toggleSavForm({{ $console->id }})"
                                class="w-full bg-amber-500 text-white px-3 py-2 rounded hover:bg-amber-600 text-sm font-medium transition-colors">
                                🛠️ Déclarer un problème
                            </button>
                            
                            <form id="sav-form-{{ $console->id }}"
                                  method="POST"
                                  action="{{ route('store.console.defective', $console) }}"
                                  class="hidden bg-amber-50 border border-amber-200 rounded p-3">
                                @csrf
                                
                                <textarea name="comment" required rows="2"
                                          class="w-full border rounded p-2 text-sm"
                                          placeholder="Ex : écran HS, lecteur défectueux…"></textarea>
                                
                                <div class="flex gap-2 mt-3">
                                    <button type="submit" class="flex-1 bg-amber-600 text-white px-3 py-1 rounded text-sm">
                                        Envoyer
                                    </button>
                                    <button type="button"
                                            onclick="cancelSavForm({{ $console->id }})"
                                            class="flex-1 bg-gray-300 text-gray-700 px-3 py-1 rounded text-sm">
                                        Annuler
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- SECTION 3 — SAV & RÉPARATIONS EN COURS --}}
    <h2 class="text-xl sm:text-2xl font-semibold mb-4">
        🛠️ SAV & réparations en cours ({{ $savConsoles->count() }})
    </h2>

    @if($savConsoles->isEmpty())
        <div class="bg-white shadow-md rounded-lg p-8 text-center text-gray-500 mb-10">
            Aucun SAV en cours
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-10">
            @foreach($savConsoles as $console)
                @php
                    $return = $console->returnRequest;
                    $quote  = $return?->repairQuote;
                @endphp
                
                <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                    <div class="bg-amber-50 border-b border-amber-200 px-4 py-3">
                        <div class="flex items-center justify-between flex-wrap gap-2">
                            <div>
                                <span class="text-xs font-mono text-gray-600">#{{ $console->id }}</span>
                                <div class="font-semibold text-gray-900 text-sm mt-1">
                                    {{ $console->articleType?->name ?? 'N/A' }}
                                </div>
                            </div>
                            
                            @if($return)
                                @if($return->status === 'pending')
                                    <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">
                                        🕒 En attente
                                    </span>
                                @elseif($return->status === 'accepted')
                                    <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">
                                        ✅ Validé
                                    </span>
                                @elseif($return->status === 'sent_to_repairer')
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-medium">
                                        📦 En transit
                                    </span>
                                @elseif($return->status === 'rejected')
                                    <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">
                                        ❌ Refusé
                                    </span>
                                @endif
                            @endif
                        </div>
                    </div>
                    
                    <div class="p-4 space-y-3">
                        @if($return && in_array($return->status, ['accepted','sent_to_repairer']) && $return->repairer)
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-3 text-blue-900 text-sm">
                                <div class="font-semibold mb-1">📦 Réparateur assigné</div>
                                <div>{{ $return->repairer->name }}</div>
                                <div>{{ $return->repairer->address }}</div>
                                <div>{{ $return->repairer->city }}</div>
                                @if($return->repairer->phone)
                                    <div class="text-xs mt-1">☎ {{ $return->repairer->phone }}</div>
                                @endif
                            </div>
                        @endif
                        
                        @if($quote && $quote->status === 'proposed')
                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-3">
                                <div class="font-semibold text-amber-900 text-base sm:text-lg mb-1">
                                    🧾 Devis : 
                                    <span class="text-indigo-700">{{ number_format($quote->amount, 2, ',', ' ') }} €</span>
                                </div>

                                @if($quote->admin_comment)
                                    <p class="italic text-sm mb-2 text-amber-800">
                                        "{{ $quote->admin_comment }}"
                                    </p>
                                @endif

                                <div class="flex gap-2 mt-2">
                                    <form method="POST" action="{{ route('store.repair.quote.accept', $quote) }}" class="flex-1">
                                        @csrf
                                        <button class="w-full bg-green-600 text-white px-3 py-2 rounded hover:bg-green-700 text-sm font-medium transition-colors">
                                            ✅ Accepter
                                        </button>
                                    </form>

                                    <form method="POST" action="{{ route('store.repair.quote.reject', $quote) }}" class="flex-1">
                                        @csrf
                                        <button class="w-full bg-gray-300 text-gray-800 px-3 py-2 rounded hover:bg-gray-400 text-sm font-medium transition-colors">
                                            ❌ Refuser
                                        </button>
                                    </form>
                                </div>
                            </div>
                        
                        @elseif($quote && $quote->status === 'accepted')
                            <div class="space-y-2">
                                <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                    <div class="font-semibold text-green-900 mb-1">
                                        ✅ Devis accepté : {{ number_format($quote->amount, 2, ',', ' ') }} €
                                    </div>
                                    <p class="text-xs text-green-700">Réparation confirmée</p>
                                </div>

                                @if($return->repairer)
                                    <div class="bg-indigo-50 border border-indigo-200 rounded-lg p-3 text-indigo-900 text-sm">
                                        <div class="font-semibold mb-1">📦 Expédier à :</div>
                                        <div>{{ $return->repairer->name }}</div>
                                        <div>{{ $return->repairer->address }}</div>
                                        <div>{{ $return->repairer->city }}</div>
                                        @if($return->repairer->phone)
                                            <div class="text-xs mt-1">☎ {{ $return->repairer->phone }}</div>
                                        @endif
                                    </div>

                                    @if($return->status !== 'sent_to_repairer')
                                        <form method="POST" action="{{ route('store.console.return.send', $console) }}">
                                            @csrf
                                            <button class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 font-medium transition-colors">
                                                📦 Article envoyé au réparateur
                                            </button>
                                        </form>
                                    @else
                                        <div class="bg-indigo-100 border border-indigo-300 rounded-lg p-2 text-indigo-800 text-center text-sm">
                                            ✅ Article expédié au réparateur
                                        </div>
                                    @endif
                                @else
                                    <div class="bg-amber-50 border border-amber-200 rounded-lg p-2 text-amber-800 text-xs text-center">
                                        ⏳ En attente que l'admin assigne un réparateur
                                    </div>
                                @endif
                            </div>
                        
                        @elseif($return && $return->status === 'accepted' && !$quote)
                            <div class="space-y-2">
                                <div class="bg-blue-100 border border-blue-300 rounded-lg p-2 text-blue-800 text-center text-sm">
                                    ⏳ En attente de devis admin / Envoi magasin
                                </div>
                                <form method="POST" action="{{ route('store.console.return.send', $console) }}">
                                    @csrf
                                    <button class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700 font-medium transition-colors">
                                        📦 Article envoyé
                                    </button>
                                </form>
                            </div>
                        
                        @elseif($return && $return->status === 'sent_to_repairer')
                            <div class="bg-indigo-100 border border-indigo-300 rounded-lg p-3 text-indigo-800 text-center text-sm">
                                🚚 Article en transit vers réparateur
                            </div>

                        @elseif($return && $return->status === 'rejected')
                            <div class="bg-red-50 border border-red-200 rounded-lg p-3 text-red-800">
                                <div class="font-semibold mb-1">❌ SAV refusé</div>
                                @if($return->admin_comment)
                                    <p class="mt-1 italic text-sm">{{ $return->admin_comment }}</p>
                                @endif
                            </div>

                        @elseif($return && $return->status === 'pending')
                            <div class="bg-yellow-100 border border-yellow-300 rounded-lg p-2 text-yellow-800 text-center text-sm">
                                🕒 En attente validation admin
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    {{-- SECTION 3 — RÉPARATIONS EXTERNES --}}
    @if($externalRepairs->isNotEmpty())
    <h2 class="text-xl sm:text-2xl font-semibold mb-4">
        🔧 Réparations externes ({{ $externalRepairs->count() }})
    </h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4 mb-10">
        @foreach($externalRepairs as $repair)
            @php
                $quote = $repair->repairQuote;
            @endphp
            
            <div class="bg-white shadow-md rounded-lg overflow-hidden border border-gray-200">
                <div class="bg-purple-50 border-b border-purple-200 px-4 py-3">
                    <div class="flex items-center justify-between flex-wrap gap-2">
                        <div>
                            <div class="font-semibold text-purple-900 text-sm">{{ $repair->external_item_name }}</div>
                            <span class="px-2 py-0.5 bg-purple-100 text-purple-800 rounded-full text-xs font-medium">Externe</span>
                        </div>
                        
                        @if($repair->status === 'pending')
                            <span class="px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-medium">🕒 En attente</span>
                        @elseif($repair->status === 'accepted')
                            <span class="px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-medium">✅ Accepté</span>
                        @elseif($repair->status === 'rejected')
                            <span class="px-3 py-1 bg-red-100 text-red-800 rounded-full text-xs font-medium">❌ Refusé</span>
                        @elseif($repair->status === 'sent_to_repairer')
                            <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-medium">🚚 En transit</span>
                        @endif
                    </div>
                </div>
                
                <div class="p-4 space-y-3">
                    <div class="text-sm text-gray-700 bg-gray-50 rounded-lg p-3">
                        {{ Str::limit($repair->external_item_description, 150) }}
                    </div>

                    @if($repair->admin_comment && $repair->status === 'rejected')
                        <div class="bg-red-50 border border-red-200 rounded-lg p-2">
                            <p class="text-xs text-red-700 italic">{{ $repair->admin_comment }}</p>
                        </div>
                    @endif
                    
                    @if($quote && $quote->status === 'proposed')
                        <div class="bg-amber-50 border border-amber-200 rounded-lg p-3">
                            <div class="font-semibold text-amber-900 mb-2">
                                💰 Devis : {{ number_format($quote->amount, 2, ',', ' ') }} €
                            </div>
                            <div class="flex gap-2">
                                <form method="POST" action="{{ route('store.repair.quote.accept', $quote) }}" class="flex-1">
                                    @csrf
                                    <button class="w-full bg-green-600 text-white px-3 py-2 rounded text-sm hover:bg-green-700 font-medium transition-colors">
                                        ✅ Accepter
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('store.repair.quote.reject', $quote) }}" class="flex-1">
                                    @csrf
                                    <button class="w-full bg-gray-300 text-gray-800 px-3 py-2 rounded text-sm hover:bg-gray-400 font-medium transition-colors">
                                        ❌ Refuser
                                    </button>
                                </form>
                            </div>
                        </div>
                    @elseif($quote && $quote->status === 'accepted')
                        @if($repair->repairer_id)
                            <div class="bg-green-50 border border-green-200 rounded-lg p-3">
                                <div class="font-semibold text-green-900 text-sm mb-1">
                                    ✅ Réparateur : {{ $repair->repairer->name }}
                                </div>
                                <div class="text-xs text-green-800 mb-2">
                                    📍 {{ $repair->repairer->address }}
                                </div>
                                @if($repair->status !== 'sent_to_repairer')
                                    <form method="POST" action="{{ route('store.console.return.send.external', $repair) }}">
                                        @csrf
                                        <button class="w-full bg-indigo-600 text-white px-3 py-2 rounded text-sm hover:bg-indigo-700 font-medium transition-colors">
                                            📦 Article envoyé au réparateur
                                        </button>
                                    </form>
                                @else
                                    <div class="bg-indigo-100 border border-indigo-300 rounded-lg p-2 text-indigo-800 text-center text-sm mt-2">
                                        ✅ Article expédié
                                    </div>
                                @endif
                            </div>
                        @else
                            <div class="bg-amber-50 border border-amber-200 rounded-lg p-2 text-amber-800 text-xs text-center">
                                ⏳ En attente que l'admin assigne un réparateur
                            </div>
                        @endif
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    @endif

</div>

<script>
function toggleSavForm(consoleId) {
    const form = document.getElementById('sav-form-' + consoleId);
    const btn = document.getElementById('sav-btn-' + consoleId);
    
    if (form && btn) {
        form.classList.remove('hidden');
        btn.classList.add('hidden');
    }
}

function cancelSavForm(consoleId) {
    const form = document.getElementById('sav-form-' + consoleId);
    const btn = document.getElementById('sav-btn-' + consoleId);
    
    if (form && btn) {
        form.classList.add('hidden');
        btn.classList.remove('hidden');
    }
}

function toggleSellForm(offerId) {
    const form = document.getElementById('sell-form-' + offerId);
    const btn = document.getElementById('sell-btn-' + offerId);
    
    if (form && btn) {
        form.classList.remove('hidden');
        btn.classList.add('hidden');
    }
}

function cancelSellForm(offerId) {
    const form = document.getElementById('sell-form-' + offerId);
    const btn = document.getElementById('sell-btn-' + offerId);
    
    if (form && btn) {
        form.classList.add('hidden');
        btn.classList.remove('hidden');
    }
}
</script>
@endsection
