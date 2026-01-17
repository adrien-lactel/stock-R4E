@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <div>
            <a href="{{ route('admin.repairers.index') }}" class="text-indigo-600 hover:underline text-sm mb-2 inline-block">
                ← Retour à la liste
            </a>
            <h1 class="text-3xl font-bold flex items-center gap-3">
                🔧 {{ $repairer->name }}
                @if($repairer->is_active)
                    <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full font-medium">Actif</span>
                @else
                    <span class="px-2 py-1 bg-gray-100 text-gray-600 text-xs rounded-full font-medium">Inactif</span>
                @endif
            </h1>
        </div>
        <a href="{{ route('admin.repairers.edit', $repairer) }}" 
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            ✏️ Modifier
        </a>
    </div>

    {{-- Infos réparateur --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Contact</h3>
                @if($repairer->email)
                    <p class="text-gray-900">✉️ {{ $repairer->email }}</p>
                @endif
                @if($repairer->phone)
                    <p class="text-gray-900">📞 {{ $repairer->phone }}</p>
                @endif
                @if(!$repairer->email && !$repairer->phone)
                    <p class="text-gray-400 italic">Non renseigné</p>
                @endif
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Adresse</h3>
                @if($repairer->city || $repairer->address)
                    <p class="text-gray-900">📍 {{ $repairer->address }}</p>
                    <p class="text-gray-900">{{ $repairer->city }}</p>
                @else
                    <p class="text-gray-400 italic">Non renseignée</p>
                @endif
            </div>
            <div>
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Infos</h3>
                @if($repairer->delay_days_default)
                    <p class="text-gray-700">⏱️ Délai moyen: {{ $repairer->delay_days_default }} jours</p>
                @endif
                @if($repairer->shipping_method)
                    <p class="text-gray-700">📦 {{ $repairer->shipping_method }}</p>
                @endif
                @if($repairer->siret)
                    <p class="text-gray-500 text-sm">SIRET: {{ $repairer->siret }}</p>
                @endif
            </div>
        </div>
        @if($repairer->notes)
            <div class="mt-4 pt-4 border-t border-gray-100">
                <h3 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Notes</h3>
                <p class="text-gray-700">{{ $repairer->notes }}</p>
            </div>
        @endif
    </div>

    {{-- Stats --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-5 text-center">
            <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
            <p class="text-sm text-gray-500 mt-1">Consoles affectées</p>
        </div>
        <div class="bg-orange-50 rounded-xl border border-orange-100 p-5 text-center">
            <p class="text-3xl font-bold text-orange-600">{{ $stats['repair'] }}</p>
            <p class="text-sm text-orange-600 mt-1">En réparation</p>
        </div>
        <div class="bg-green-50 rounded-xl border border-green-100 p-5 text-center">
            <p class="text-3xl font-bold text-green-600">{{ $stats['stock'] }}</p>
            <p class="text-sm text-green-600 mt-1">Réparées (stock)</p>
        </div>
        <div class="bg-red-50 rounded-xl border border-red-100 p-5 text-center">
            <p class="text-3xl font-bold text-red-600">{{ $stats['defective'] }}</p>
            <p class="text-sm text-red-600 mt-1">Défectueuses</p>
        </div>
    </div>

    {{-- Mods disponibles chez ce réparateur --}}
    @if($repairer->mods->count() > 0)
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-8">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">🧰 Mods en stock chez ce réparateur</h2>
        <div class="flex flex-wrap gap-2">
            @foreach($repairer->mods as $mod)
                <span class="px-3 py-1 bg-indigo-50 text-indigo-700 rounded-full text-sm">
                    {{ $mod->name }} 
                    <span class="font-bold">({{ $mod->pivot->quantity }})</span>
                </span>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Liste des consoles --}}
    <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="px-6 py-4 border-b border-gray-100">
            <h2 class="text-lg font-semibold text-gray-800">📦 Consoles affectées</h2>
        </div>

        @if($consoles->count() > 0)
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">ID</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">Type</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">Statut</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">Magasin</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">Commentaire</th>
                            <th class="px-4 py-3 text-left font-medium text-gray-600">Date</th>
                            <th class="px-4 py-3 text-right font-medium text-gray-600">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($consoles as $console)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 font-mono text-gray-900">#{{ $console->id }}</td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $console->articleType->name ?? '—' }}</div>
                                    <div class="text-xs text-gray-500">{{ $console->articleCategory->name ?? '' }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    @php
                                        $statusColors = [
                                            'stock' => 'bg-green-100 text-green-800',
                                            'repair' => 'bg-orange-100 text-orange-800',
                                            'defective' => 'bg-red-100 text-red-800',
                                            'disabled' => 'bg-gray-100 text-gray-600',
                                        ];
                                        $statusLabels = [
                                            'stock' => 'Stock',
                                            'repair' => 'Réparation',
                                            'defective' => 'Défectueuse',
                                            'disabled' => 'Désactivée',
                                        ];
                                    @endphp
                                    <span class="px-2 py-1 rounded-full text-xs font-medium {{ $statusColors[$console->status] ?? 'bg-gray-100 text-gray-600' }}">
                                        {{ $statusLabels[$console->status] ?? $console->status }}
                                    </span>
                                </td>
                                <td class="px-4 py-3 text-gray-600">
                                    {{ $console->store->name ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-gray-600 max-w-xs truncate" title="{{ $console->commentaire_reparateur }}">
                                    {{ Str::limit($console->commentaire_reparateur, 40) ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-gray-500 text-xs">
                                    {{ $console->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-right">
                                    <a href="{{ route('admin.articles.edit', $console) }}" 
                                       class="text-indigo-600 hover:text-indigo-800 text-sm">
                                        Éditer →
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if($consoles->hasPages())
                <div class="px-6 py-4 border-t border-gray-100">
                    {{ $consoles->links() }}
                </div>
            @endif
        @else
            <div class="px-6 py-12 text-center text-gray-500">
                Aucune console affectée à ce réparateur.
            </div>
        @endif
    </div>

</div>
@endsection
