@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">💰 Prix par magasin</h1>
        <a href="{{ route('admin.consoles.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour stock
        </a>
    </div>

    {{-- Messages --}}
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-100 border border-green-300 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="mb-4 p-4 bg-red-100 border border-red-300 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Filtres (optionnels) --}}
    <form method="GET" class="mb-6 flex flex-wrap gap-3 items-end">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
            <input type="text" name="q" value="{{ request('q') }}"
                   class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                   placeholder="Serial, provenance, stockage…">
        </div>

        @isset($types)
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
            <select name="type" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Tous</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" @selected((string)request('type') === (string)$type->id)>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>
        </div>
        @endisset

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Statut</label>
            <select name="status" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Tous</option>
                <option value="stock" @selected(request('status')==='stock')>stock</option>
                <option value="defective" @selected(request('status')==='defective')>defective</option>
                <option value="repair" @selected(request('status')==='repair')>repair</option>
                <option value="disabled" @selected(request('status')==='disabled')>disabled</option>
            </select>
        </div>

        <div class="flex gap-2">
            <button class="px-4 py-2 rounded bg-blue-600 text-white hover:bg-blue-700">
                Filtrer
            </button>
            <a href="{{ route('admin.prices.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">
                Reset
            </a>
        </div>
    </form>

    {{-- Liste des articles --}}
    @forelse($consoles as $console)
        <div class="bg-white shadow rounded-lg mb-8 overflow-hidden">

            {{-- En-tête article --}}
            <div class="px-6 py-4 border-b bg-gray-50">
                <div class="flex flex-wrap items-center justify-between gap-2">
                    <h3 class="text-lg font-semibold text-gray-800">
                        🧾 Article #{{ $console->id }}
                        — {{ $console->articleType?->name ?? 'Type non défini' }}
                    </h3>

                    <span class="text-xs px-2 py-1 rounded text-white
                        @if($console->status === 'stock') bg-green-600
                        @elseif($console->status === 'defective') bg-orange-600
                        @elseif($console->status === 'repair') bg-indigo-600
                        @elseif($console->status === 'disabled') bg-red-700
                        @else bg-gray-600
                        @endif
                    ">
                        {{ $console->status ? ucfirst($console->status) : '—' }}
                    </span>
                </div>

                <p class="text-sm text-gray-600 mt-1">
                    Prix d’achat :
                    <span class="font-semibold text-gray-800">
                        {{ !is_null($console->prix_achat) ? number_format($console->prix_achat, 2, ',', ' ') . ' €' : '—' }}
                    </span>
                    • Valorisation :
                    <span class="font-semibold text-indigo-700">
                        {{ !is_null($console->valorisation) ? number_format($console->valorisation, 2, ',', ' ') . ' €' : '—' }}
                    </span>
                </p>

                @if($console->status !== 'stock')
                    <p class="mt-2 text-sm text-red-700">
                        ⚠️ Les prix ne sont modifiables que si l’article est en statut <b>stock</b>.
                    </p>
                @endif
            </div>

            {{-- Formulaire prix --}}
            <form method="POST" action="{{ route('admin.prices.store', $console) }}">
                @csrf

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200 text-sm">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-3 text-left font-medium text-gray-700">Magasin</th>
                                <th class="px-4 py-3 text-center font-medium text-gray-700">Offre proposée (€)</th>
                                <th class="px-4 py-3 text-center font-medium text-gray-700">Statut</th>
                            </tr>
                        </thead>

                        <tbody class="divide-y divide-gray-100">
                            @foreach($stores as $store)
                                @php
                                    $offer = $console->offers->firstWhere('store_id', $store->id);
                                    $salePrice = $offer?->sale_price;
                                @endphp
                                <tr>
                                    <td class="px-4 py-3">
                                        {{ $store->name }}
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        <input
                                            type="number"
                                            step="0.01"
                                            min="0"
                                            name="prices[{{ $store->id }}]"
                                            value="{{ old("prices.$store->id", $salePrice) }}"
                                            class="w-36 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500
                                                @if($console->status !== 'stock') bg-gray-100 cursor-not-allowed @endif"
                                            @if($console->status !== 'stock') disabled @endif
                                            placeholder="0.00"
                                        >
                                    </td>

                                    <td class="px-4 py-3 text-center">
                                        @if($offer)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                                @if($offer->status === 'proposed') bg-blue-100 text-blue-800
                                                @elseif($offer->status === 'sent') bg-green-100 text-green-800
                                                @else bg-gray-100 text-gray-800
                                                @endif
                                            ">
                                                {{ ucfirst($offer->status) }}
                                            </span>
                                        @else
                                            <span class="text-gray-400 text-sm">—</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                {{-- Actions --}}
                <div class="px-6 py-4 bg-gray-50 flex justify-end">
                    <button
                        type="submit"
                        class="inline-flex items-center px-6 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-white hover:bg-indigo-700
                               disabled:opacity-50 disabled:cursor-not-allowed"
                        @if($console->status !== 'stock') disabled @endif
                    >
                        💾 Enregistrer les prix
                    </button>
                </div>
            </form>
        </div>
    @empty
        <div class="bg-white shadow rounded-lg p-6 text-center text-gray-500">
            Aucun article trouvé.
        </div>
    @endforelse

    {{-- Pagination --}}
    @if (method_exists($consoles, 'links'))
        <div class="mt-4">
            {{ $consoles->links() }}
        </div>
    @endif

</div>
@endsection
