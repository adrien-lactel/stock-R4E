@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    {{-- =====================================================
         TITRE
    ===================================================== --}}
    <h1 class="text-3xl font-bold mb-6">
        🏪 Stock du magasin : {{ $store->name }}
    </h1>

    {{-- =====================================================
         MESSAGE SUCCÈS
    ===================================================== --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- =====================================================
         MESSAGE ERREUR
    ===================================================== --}}
    @if(session('error'))
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded border border-red-300">
            {{ session('error') }}
        </div>
    @endif

    {{-- =====================================================
         ERREURS DE VALIDATION
    ===================================================== --}}
    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded border border-red-300">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- =====================================================
         SECTION 1 — STOCK VENDABLE
    ===================================================== --}}
    <h2 class="text-2xl font-semibold mb-4">
        📦 Articles disponibles
    </h2>

    <div class="bg-white shadow rounded-lg overflow-hidden mb-10">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">ID</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Valeur réelle</th>
                    <th class="p-3">Prix de vente</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse($consoles as $console)
                <tr class="border-t align-top">
                    <td class="p-3 font-mono text-sm">#{{ $console->id }}</td>
                    <td class="p-3">{{ $console->articleType?->name ?? 'N/A' }}</td>
                    <td class="p-3">{{ $console->real_value }} €</td>
                    <td class="p-3 font-semibold text-indigo-600">
                        {{ $console->pivot->sale_price }} €
                    </td>

                    <td class="p-3">
                        <div class="flex flex-col gap-3">

                            {{-- VENTE --}}
                            <form method="POST" action="{{ route('store.console.sell', $console) }}">
                                @csrf
                                <button class="w-full bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    ✔ Article vendu
                                </button>
                            </form>

                            {{-- DÉCLARER PROBLÈME --}}
                            <button
                                type="button"
                                id="sav-btn-{{ $console->id }}"
                                onclick="toggleSavForm({{ $console->id }})"
                                class="w-full bg-amber-500 text-white px-3 py-1 rounded hover:bg-amber-600">
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
                                    <button type="submit" class="flex-1 bg-amber-600 text-white px-3 py-1 rounded">
                                        Envoyer
                                    </button>
                                    <button type="button"
                                            onclick="cancelSavForm({{ $console->id }})"
                                            class="flex-1 bg-gray-300 text-gray-700 px-3 py-1 rounded">
                                        Annuler
                                    </button>
                                </div>
                            </form>

                        </div>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="p-6 text-center text-gray-500">
                        Aucune console disponible
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

    {{-- =====================================================
         SECTION 2 — SAV & RÉPARATIONS EN COURS
    ===================================================== --}}
    <h2 class="text-2xl font-semibold mb-4">
        🛠️ SAV & réparations en cours
    </h2>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Console</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Devis accepté</th>
                    <th class="p-3">Statut</th>
                </tr>
            </thead>

            <tbody>
@forelse($savConsoles as $console)
    @php
        $return = $console->returnRequest;
        $quote  = $return?->repairQuote;
    @endphp

    <tr class="border-t align-top">
        <td class="p-3 font-mono">#{{ $console->id }}</td>
        <td class="p-3">{{ $console->articleType?->name ?? 'N/A' }}</td>

        {{-- STATUT SAV --}}
        <td class="p-3">
            @if($return)
                @if($return->status === 'pending')
                    <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">
                        🕒 En attente validation admin
                    </span>
                @elseif($return->status === 'accepted')
                    @if($quote)
                        <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-sm">
                            📋 Devis: {{ number_format($quote->amount, 2, ',', ' ') }} €
                        </span>
                    @else
                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">
                            ✅ SAV validé — en attente envoi magasin
                        </span>
                    @endif
                @elseif($return->status === 'sent_to_repairer')
                    <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded text-sm">
                        📦 Article SAV envoyé réparateur
                    </span>
                @elseif($return->status === 'rejected')
                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm">
                        ❌ SAV refusé
                    </span>
                    @if($return->admin_comment)
                        <p class="text-xs text-red-700 mt-1 italic">{{ $return->admin_comment }}</p>
                    @endif
                @endif
            @else
                <span class="text-gray-400">—</span>
            @endif
        </td>

        {{-- STATUT / ACTIONS --}}
        <td class="p-3 space-y-2">

            @if($return && in_array($return->status, ['accepted','sent_to_repairer']) && $return->repairer)
                <div class="bg-blue-50 border border-blue-200 rounded p-3 text-blue-900 text-sm">
                    <div class="font-semibold">📦 Adresse réparateur</div>
                    <div>{{ $return->repairer->name }}</div>
                    <div>{{ $return->repairer->address }}</div>
                    <div>{{ $return->repairer->city }}</div>
                    @if($return->repairer->phone)
                        <div class="text-xs text-gray-700 mt-1">☎ {{ $return->repairer->phone }}</div>
                    @endif
                </div>
            @endif

            {{-- ===== DEVIS PROPOSÉ ===== --}}
            @if($quote && $quote->status === 'proposed')
    <div class="bg-amber-50 border border-amber-200 rounded p-3 text-amber-900">
        <div class="font-semibold text-lg mb-1">
            🧾 Devis proposé : 
            <span class="text-indigo-700">
                {{ number_format($quote->amount, 2, ',', ' ') }} €
            </span>
        </div>

        @if($quote->admin_comment)
            <p class="italic text-sm mb-2">
                “{{ $quote->admin_comment }}”
            </p>
        @endif

        <div class="flex gap-2 mt-2">
            <form method="POST"
                  action="{{ route('store.repair.quote.accept', $quote) }}"
                  class="flex-1">
                @csrf
                <button
                    class="w-full bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                    ✅ Accepter ce devis
                </button>
            </form>

            <form method="POST"
                  action="{{ route('store.repair.quote.reject', $quote) }}"
                  class="flex-1">
                @csrf
                <button
                    class="w-full bg-gray-300 text-gray-800 px-3 py-1 rounded hover:bg-gray-400">
                    ❌ Refuser
                </button>
            </form>
        </div>
    </div>

            @elseif($quote && $quote->status === 'accepted')
                {{-- ===== DEVIS ACCEPTÉ → ENVOI RÉPARATEUR ===== --}}
                <div class="space-y-2">
                    <div class="bg-green-50 border border-green-200 rounded p-3">
                        <div class="font-semibold text-green-900 mb-1">
                            ✅ Devis accepté : {{ number_format($quote->amount, 2, ',', ' ') }} €
                        </div>
                        <p class="text-xs text-green-700">
                            Réparation confirmée
                        </p>
                    </div>

                    @if($return->repairer)
                        <div class="bg-indigo-50 border border-indigo-200 rounded p-3 text-indigo-900 text-sm">
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
                                <button class="w-full bg-indigo-600 text-white px-3 py-1.5 rounded hover:bg-indigo-700 font-medium">
                                    📦 Article envoyé au réparateur
                                </button>
                            </form>
                        @else
                            <div class="bg-indigo-100 border border-indigo-300 rounded p-2 text-indigo-800 text-center text-sm">
                                ✅ Article expédié au réparateur
                            </div>
                        @endif
                    @else
                        <div class="bg-amber-50 border border-amber-200 rounded p-2 text-amber-800 text-xs text-center">
                            ⏳ En attente que l'admin assigne un réparateur
                        </div>
                    @endif
                </div>
            @elseif($return && $return->status === 'accepted' && !$quote)
                <div class="space-y-2">
                    <span class="block px-2 py-1 bg-blue-100 text-blue-800 rounded text-center text-sm">
                        ⏳ En attente de devis admin / Envoi magasin
                    </span>
                    <form method="POST" action="{{ route('store.console.return.send', $console) }}">
                        @csrf
                        <button class="w-full bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
                            📦 Article envoyé
                        </button>
                    </form>
                </div>
            @elseif($return && $return->status === 'sent_to_repairer')
                <span class="block px-2 py-1 bg-indigo-100 text-indigo-800 rounded text-center text-sm">
                    🚚 Article en transit vers réparateur
                </span>

            @elseif($return && $return->status === 'rejected')
                <div class="bg-red-50 border border-red-200 rounded p-2 text-red-800 text-sm">
                    <div class="font-semibold">❌ SAV refusé</div>
                    @if($return->admin_comment)
                        <p class="mt-1 italic text-xs">{{ $return->admin_comment }}</p>
                    @endif
                </div>

            @elseif($return && $return->status === 'pending')
                <span class="block px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-center text-sm">
                    🕒 En attente validation
                </span>

            @else
                <span class="text-gray-400">—</span>
            @endif

            </td>
        </tr>
@empty
    <tr>
        <td colspan="4" class="p-6 text-center text-gray-500">
            Aucun SAV en cours
        </td>
    </tr>
@endforelse
</tbody>

        </table>
    </div>

    {{-- =====================================================
         SECTION 3 — RÉPARATIONS EXTERNES
    ===================================================== --}}
    @if($externalRepairs->isNotEmpty())
    <h2 class="text-2xl font-semibold mb-4 mt-10">
        🔧 Réparations externes (hors stock)
    </h2>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Article</th>
                    <th class="p-3">Description</th>
                    <th class="p-3">Statut</th>
                    <th class="p-3">Devis/Actions</th>
                </tr>
            </thead>
            <tbody>
            @foreach($externalRepairs as $repair)
                @php
                    $quote = $repair->repairQuote;
                @endphp
                <tr class="border-t align-top">
                    <td class="p-3">
                        <div class="font-semibold text-purple-900">{{ $repair->external_item_name }}</div>
                        <span class="px-2 py-0.5 bg-purple-100 text-purple-800 rounded text-xs">Externe</span>
                    </td>
                    <td class="p-3 text-sm text-gray-700">
                        {{ Str::limit($repair->external_item_description, 100) }}
                    </td>
                    <td class="p-3">
                        @if($repair->status === 'pending')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded text-sm">🕒 En attente</span>
                        @elseif($repair->status === 'accepted')
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm">✅ Accepté</span>
                        @elseif($repair->status === 'rejected')
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm">❌ Refusé</span>
                        @elseif($repair->status === 'sent_to_repairer')
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded text-sm">🚚 En transit</span>
                        @endif

                        @if($repair->admin_comment && $repair->status === 'rejected')
                            <p class="text-xs text-red-700 mt-1 italic">{{ $repair->admin_comment }}</p>
                        @endif
                    </td>
                    <td class="p-3">
                        @if($quote && $quote->status === 'proposed')
                            <div class="bg-amber-50 border border-amber-200 rounded p-2">
                                <div class="font-semibold text-amber-900">
                                    Devis : {{ number_format($quote->amount, 2, ',', ' ') }} €
                                </div>
                                <div class="flex gap-2 mt-2">
                                    <form method="POST" action="{{ route('store.repair.quote.accept', $quote) }}">
                                        @csrf
                                        <button class="bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                            ✅ Accepter
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('store.repair.quote.reject', $quote) }}">
                                        @csrf
                                        <button class="bg-gray-300 text-gray-800 px-3 py-1 rounded text-sm hover:bg-gray-400">
                                            ❌ Refuser
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @elseif($quote && $quote->status === 'accepted')
                            <div class="space-y-2">
                                @if($repair->repairer_id)
                                    <div class="bg-green-50 border border-green-200 rounded p-2">
                                        <div class="font-semibold text-green-900 text-sm mb-1">
                                            ✅ Réparateur assigné : {{ $repair->repairer->name }}
                                        </div>
                                        <div class="text-xs text-green-800">
                                            📍 {{ $repair->repairer->address }}
                                        </div>
                                        @if($repair->status !== 'sent_to_repairer')
                                            <form method="POST" action="{{ route('store.console.return.send.external', $repair) }}" class="mt-2">
                                                @csrf
                                                <button class="w-full bg-indigo-600 text-white px-3 py-1 rounded text-sm hover:bg-indigo-700">
                                                    📦 Article envoyé au réparateur
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                @else
                                    <div class="bg-amber-50 border border-amber-200 rounded p-2 text-amber-800 text-xs text-center">
                                        ⏳ En attente que l'admin assigne un réparateur
                                    </div>
                                @endif
                            </div>
                        @else
                            <span class="text-sm text-gray-400">—</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
</script>
@endsection
