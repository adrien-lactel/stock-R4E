@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">🔴 Consoles HS (Pièces détachées)</h1>
            <p class="text-sm text-gray-600 mt-1">Consoles désactivées et valorisées - Quote-part répartie sur les consoles vendables</p>
        </div>

        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour au dashboard
        </a>
    </div>

    {{-- ONGLETS --}}
    <div class="mb-6 border-b border-gray-200">
        <nav class="-mb-px flex space-x-8">
            <a href="{{ route('admin.consoles.disabled', ['tab' => 'disabled'] + request()->except('tab')) }}"
               class="{{ $tab === 'disabled' ? 'border-indigo-500 text-indigo-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                🔴 Consoles HS ({{ \App\Models\Console::where('status', 'disabled')->count() }})
            </a>
            <a href="{{ route('admin.consoles.disabled', ['tab' => 'parted_out'] + request()->except('tab')) }}"
               class="{{ $tab === 'parted_out' ? 'border-green-500 text-green-600' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300' }} whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                💎 Consoles valorisées ({{ \App\Models\Console::where('status', 'parted_out')->count() }})
            </a>
        </nav>
    </div>

    {{-- FILTRES --}}
    <form method="GET" class="mb-6 flex flex-wrap gap-3 items-end">
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Recherche</label>
            <input type="text" name="q" value="{{ request('q') }}"
                   placeholder="Serial, provenance…"
                   class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Catégorie</label>
            <select name="category" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Toutes</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>{{ $cat->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium text-gray-700 mb-1">Type</label>
            <select name="type" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                <option value="">Tous</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" @selected(request('type') == $type->id)>{{ $type->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
            Filtrer
        </button>

        @if(request()->hasAny(['q', 'category', 'type']))
            <a href="{{ route('admin.consoles.disabled') }}" class="px-4 py-2 border rounded hover:bg-gray-50">
                Réinitialiser
            </a>
        @endif
    </form>

    {{-- STATISTIQUES --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">{{ $tab === 'parted_out' ? 'Consoles valorisées' : 'Total consoles HS' }}</div>
            <div class="text-2xl font-bold {{ $tab === 'parted_out' ? 'text-green-600' : 'text-red-600' }}">{{ $consoles->total() }}</div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Coût total {{ $tab === 'parted_out' ? 'valorisé' : 'immobilisé' }}</div>
            <div class="text-2xl font-bold text-gray-900">
                {{ number_format(\App\Models\Console::where('status', $tab === 'parted_out' ? 'parted_out' : 'disabled')->sum('prix_achat'), 2, ',', ' ') }} €
            </div>
        </div>
        <div class="bg-white rounded-lg shadow p-4">
            <div class="text-sm text-gray-500">Types concernés</div>
            <div class="text-2xl font-bold text-indigo-600">
                {{ \App\Models\Console::where('status', $tab === 'parted_out' ? 'parted_out' : 'disabled')->distinct('article_type_id')->count('article_type_id') }}
            </div>
        </div>
    </div>

    {{-- TABLE --}}
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Serial</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Provenance</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Prix d'achat</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Quote-part</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Ajouté le</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                @forelse($consoles as $console)
                    @php
                        // Calculer la quote-part répartie sur les autres consoles du même type
                        $sellableCount = \App\Models\Console::where('article_type_id', $console->article_type_id)
                            ->whereIn('status', ['stock', 'defective', 'repair', 'vendue'])
                            ->count();
                        $quotePart = $sellableCount > 0 ? ($console->prix_achat ?? 0) / $sellableCount : 0;
                    @endphp
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            #{{ $console->id }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div class="font-medium">{{ $console->articleType?->name ?? '—' }}</div>
                            <div class="text-xs text-gray-500">{{ $console->articleCategory?->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $console->serial_number ?? '—' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $console->provenance_article ?? '—' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="text-sm font-medium text-gray-900">{{ number_format($console->prix_achat ?? 0, 2, ',', ' ') }} €</span>
                            @if($tab === 'parted_out' && $console->valorisation)
                                <div class="text-xs text-green-600 font-medium">- {{ number_format($console->valorisation, 2, ',', ' ') }} € (valorisation)</div>
                                <div class="text-xs text-orange-600 font-semibold">= {{ number_format(($console->prix_achat ?? 0) - $console->valorisation, 2, ',', ' ') }} € (quote-part nette)</div>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($console->article_type_id)
                                @php
                                    // Recalculer la quote-part nette pour l'affichage
                                    $netCost = ($console->prix_achat ?? 0) - ($console->valorisation ?? 0);
                                    $displayQuotePart = $sellableCount > 0 ? max(0, $netCost) / $sellableCount : 0;
                                @endphp
                                <span class="text-sm text-red-600">{{ number_format($displayQuotePart, 2, ',', ' ') }} € / console</span>
                                <div class="text-xs text-gray-500">{{ $sellableCount }} vendables</div>
                            @else
                                <span class="text-xs text-gray-400">Type non défini</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $console->created_at->format('d/m/Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            @if($tab === 'disabled')
                                <a href="{{ route('admin.consoles.valorize', $console) }}" 
                                   class="inline-flex items-center px-3 py-1.5 bg-green-600 text-white rounded hover:bg-green-700 text-xs font-medium">
                                    💎 Valoriser
                                </a>
                            @else
                                <span class="text-xs text-gray-500">Déjà valorisée</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                            Aucune console HS trouvée
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- PAGINATION --}}
    @if($consoles->hasPages())
        <div class="mt-6">
            {{ $consoles->links() }}
        </div>
    @endif

</div>
@endsection
