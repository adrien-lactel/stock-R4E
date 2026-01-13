@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    {{-- =====================
         TITRE
    ===================== --}}
    <h1 class="text-3xl font-bold mb-6">
        🛠️ Demandes SAV
    </h1>

    {{-- =====================
         MESSAGES
    ===================== --}}
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
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Console</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Magasin</th>
                    <th class="p-3">Commentaire magasin</th>
                    <th class="p-3">Statut</th>
                    <th class="p-3 text-center">Actions admin</th>
                </tr>
            </thead>

            <tbody>
            @forelse($returns as $return)
                <tr class="border-t align-top">

                    {{-- Console --}}
                    <td class="p-3 font-mono">
                        @if($return->is_external)
                            <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs font-semibold">
                                EXTERNE
                            </span>
                        @else
                            #{{ $return->console->id }}
                        @endif
                    </td>

                    {{-- Type --}}
                    <td class="p-3">
                        @if($return->is_external)
                            <div class="font-semibold text-purple-900">{{ $return->external_item_name }}</div>
                            <div class="text-xs text-gray-600 mt-1">{{ Str::limit($return->external_item_description, 60) }}</div>
                        @else
                            {{ $return->console->articleType?->name ?? 'N/A' }}
                        @endif
                    </td>

                    {{-- Magasin --}}
                    <td class="p-3">
                        {{ $return->store->name }}
                    </td>

                    {{-- Commentaire magasin --}}
                    <td class="p-3 italic text-gray-700">
                        “{{ $return->comment }}”
                    </td>

                    {{-- =====================
                         STATUT
                    ===================== --}}
                    <td class="p-3">
                        @if($return->status === 'pending')
                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded">
                                🕒 En attente
                            </span>

                        @elseif($return->status === 'accepted')
                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded">
                                ✅ SAV accepté — attente envoi magasin
                            </span>

                            @if($return->repairer)
                                <div class="mt-2 p-2 bg-indigo-50 border border-indigo-200 rounded text-sm text-indigo-900">
                                    <div class="font-semibold">📦 Expédier à</div>
                                    <div>{{ $return->repairer->name }}</div>
                                    <div>{{ $return->repairer->address }}</div>
                                    <div>{{ $return->repairer->city }}</div>
                                    @if($return->repairer->phone)
                                        <div class="text-xs text-gray-700 mt-1">☎ {{ $return->repairer->phone }}</div>
                                    @endif
                                </div>
                            @endif

                        @elseif($return->status === 'sent_to_repairer')
                            <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded">
                                🚚 Article SAV envoyé réparateur
                            </span>

                            @if($return->repairer)
                                <div class="mt-2 p-2 bg-indigo-50 border border-indigo-200 rounded text-sm text-indigo-900">
                                    <div class="font-semibold">Destinataire</div>
                                    <div>{{ $return->repairer->name }}</div>
                                    <div>{{ $return->repairer->address }}</div>
                                    <div>{{ $return->repairer->city }}</div>
                                    @if($return->repairer->phone)
                                        <div class="text-xs text-gray-700 mt-1">☎ {{ $return->repairer->phone }}</div>
                                    @endif
                                </div>
                            @endif

                        @elseif($return->status === 'rejected')
                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded">
                                ❌ SAV refusé
                            </span>

                            <p class="text-sm mt-2 italic text-red-700">
                                Motif : “{{ $return->admin_comment }}”
                            </p>
                        @endif
                    </td>

                    {{-- =====================
                         ACTIONS ADMIN
                    ===================== --}}
                    <td class="p-3 text-center space-y-3">

                            {{-- =====================
                                SAV EN ATTENTE
                            ===================== --}}
                            @if($return->status === 'pending')

                            {{-- ===== DEMANDE EXTERNE → DEVIS OBLIGATOIRE ===== --}}
                            @if($return->is_external)
                                <div class="bg-purple-50 border border-purple-200 rounded p-3 text-left">
                                    <div class="text-sm font-semibold text-purple-900 mb-2">
                                        Article externe - Devis requis
                                    </div>

                                    <form method="POST"
                                          action="{{ route('admin.returns.propose-quote', $return) }}">
                                        @csrf

                                        <label class="block text-xs font-medium mb-1">
                                            Montant du devis (€) *
                                        </label>
                                        <input
                                            type="number"
                                            step="0.01"
                                            name="amount"
                                            required
                                            class="w-full border rounded p-1.5 mb-2 text-sm"
                                        >

                                        <label class="block text-xs font-medium mb-1">
                                            Détail de la réparation
                                        </label>
                                        <textarea
                                            name="admin_comment"
                                            rows="2"
                                            class="w-full border rounded p-1.5 text-xs mb-2"
                                        ></textarea>

                                        <label class="block text-xs font-medium mb-1">
                                            Réparateur *
                                        </label>
                                        <select name="repairer_id" required class="w-full border rounded p-1.5 text-sm mb-2">
                                            <option value="">-- Choisir un réparateur --</option>
                                            @foreach($repairers as $repairer)
                                                <option value="{{ $repairer->id }}">
                                                    {{ $repairer->name }} @if($repairer->city) — {{ $repairer->city }} @endif
                                                </option>
                                            @endforeach
                                        </select>

                                        <button
                                            class="w-full bg-indigo-600 text-white px-3 py-1.5 rounded text-sm hover:bg-indigo-700">
                                            🧾 Proposer un devis
                                        </button>
                                    </form>

                                    <form method="POST"
                                          action="{{ route('admin.returns.reject', $return) }}"
                                          class="mt-2">
                                        @csrf
                                        <textarea
                                            name="admin_comment"
                                            required
                                            rows="2"
                                            class="w-full border rounded p-1.5 text-xs"
                                            placeholder="Motif du refus...">
                                        </textarea>
                                        <button
                                            class="w-full mt-1 bg-red-600 text-white px-3 py-1 rounded text-xs hover:bg-red-700">
                                            ❌ Refuser
                                        </button>
                                    </form>
                                </div>

                            @else
                            {{-- ===== SAV STOCK CLASSIQUE → ACCEPTER/REFUSER ===== --}}

                            {{-- ACCEPTER --}}
                            <form method="POST"
                                  action="{{ route('admin.returns.approve', $return) }}"
                                  class="space-y-2 text-left">
                                @csrf

                                <label class="block text-sm font-medium text-gray-700">
                                    Sélectionner un réparateur
                                </label>
                                <select name="repairer_id" required class="w-full border rounded p-2 text-sm">
                                    <option value="">-- Choisir --</option>
                                    @foreach($repairers as $repairer)
                                        <option value="{{ $repairer->id }}">
                                            {{ $repairer->name }} @if($repairer->city) — {{ $repairer->city }} @endif
                                        </option>
                                    @endforeach
                                </select>

                                <button
                                    class="w-full bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                    ✅ Valider le SAV
                                </button>
                            </form>

                            {{-- REFUSER --}}
                            <form method="POST"
                                  action="{{ route('admin.returns.reject', $return) }}">
                                @csrf

                                <textarea
                                    name="admin_comment"
                                    required
                                    rows="2"
                                    class="w-full border rounded p-2 text-sm"
                                    placeholder="Motif du refus (ex : dommage non couvert…)">
                                </textarea>

                                <button
                                    class="w-full mt-2 bg-red-600 text-white px-3 py-1 rounded hover:bg-red-700">
                                    ❌ Refuser le SAV
                                </button>
                            </form>
                            @endif

                        {{-- =====================
                             SAV REFUSÉ → DEVIS
                        ===================== --}}
                        @elseif($return->status === 'rejected')

                            @if(!$return->repairQuote)

                                <form method="POST"
                                      action="{{ route('admin.returns.propose-quote', $return) }}"
                                      class="bg-indigo-50 border border-indigo-200 p-3 rounded text-left">
                                    @csrf

                                    <label class="block text-sm font-medium mb-1">
                                        Montant du devis (€)
                                    </label>
                                    <input
                                        type="number"
                                        step="0.01"
                                        name="amount"
                                        required
                                        class="w-full border rounded p-2 mb-2"
                                    >

                                    <label class="block text-sm font-medium mb-1">
                                        Détail de la réparation
                                    </label>
                                    <textarea
                                        name="admin_comment"
                                        rows="2"
                                        class="w-full border rounded p-2 text-sm"
                                    ></textarea>

                                    <button
                                        class="w-full mt-3 bg-indigo-600 text-white px-3 py-1 rounded hover:bg-indigo-700">
                                        🧾 Proposer un devis
                                    </button>
                                </form>

                            @else
                                <div class="text-sm text-gray-600 italic">
                                    🧾 Devis déjà proposé
                                </div>
                            @endif

                        @elseif($return->status === 'sent_to_repairer')
                            <div class="text-sm text-gray-600 italic">
                                En transit vers le réparateur.
                            </div>

                            <form method="POST" action="{{ route('admin.returns.acknowledge', $return) }}">
                                @csrf
                                <button class="w-full mt-2 bg-gray-200 text-gray-800 px-3 py-1 rounded hover:bg-gray-300">
                                    ✔ Pris en compte
                                </button>
                            </form>

                        @elseif($return->status === 'accepted')
                            {{-- =====================
                                 DEVIS ACCEPTÉ → ASSIGNER RÉPARATEUR
                            ===================== --}}
                            @if($return->repairQuote && $return->repairQuote->status === 'accepted')
                                <div class="bg-indigo-50 border border-indigo-200 rounded p-3">
                                    <div class="text-sm font-semibold text-indigo-900 mb-2">
                                        🔧 Devis accepté par le magasin
                                    </div>

                                    @if($return->repairer)
                                        <div class="text-xs text-gray-700 mb-2">
                                            Réparateur : <span class="font-medium">{{ $return->repairer->name }}</span>
                                        </div>
                                        <form method="POST" action="{{ route('admin.returns.assign-repairer', $return) }}" class="text-left">
                                            @csrf
                                            <label class="block text-xs font-medium mb-1">Modifier le réparateur</label>
                                            <select name="repairer_id" required class="w-full border rounded p-1.5 text-xs mb-2">
                                                @foreach($repairers as $repairer)
                                                    <option value="{{ $repairer->id }}" @selected($return->repairer_id == $repairer->id)>
                                                        {{ $repairer->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button class="w-full bg-indigo-600 text-white px-3 py-1.5 rounded text-xs hover:bg-indigo-700">
                                                Mettre à jour
                                            </button>
                                        </form>
                                    @else
                                        <form method="POST" action="{{ route('admin.returns.assign-repairer', $return) }}" class="text-left">
                                            @csrf
                                            <label class="block text-xs font-medium mb-1">Assigner un réparateur</label>
                                            <select name="repairer_id" required class="w-full border rounded p-1.5 text-xs mb-2">
                                                <option value="">-- Choisir --</option>
                                                @foreach($repairers as $repairer)
                                                    <option value="{{ $repairer->id }}">
                                                        {{ $repairer->name }} @if($repairer->city)— {{ $repairer->city }}@endif
                                                    </option>
                                                @endforeach
                                            </select>
                                            <button class="w-full bg-green-600 text-white px-3 py-1.5 rounded text-xs hover:bg-green-700">
                                                ✅ Assigner
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <form method="POST" action="{{ route('admin.returns.acknowledge', $return) }}" class="space-y-2">
                                    @csrf
                                    <button class="w-full bg-gray-200 text-gray-800 px-3 py-1 rounded hover:bg-gray-300">
                                        ✔ Pris en compte
                                    </button>
                                </form>
                            @endif

                        @elseif(in_array($return->status, ['pending']))
                            <form method="POST" action="{{ route('admin.returns.acknowledge', $return) }}" class="space-y-2">
                                @csrf
                                <button class="w-full bg-gray-200 text-gray-800 px-3 py-1 rounded hover:bg-gray-300">
                                    ✔ Pris en compte
                                </button>
                            </form>

                        @else
                            —
                        @endif

                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">
                        Aucune demande SAV
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
