@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    {{-- Titre --}}
    <h1 class="text-3xl font-bold mb-8">
        Tableau de bord administrateur
    </h1>

    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Bienvenue sur Stock R4E</h2>
        <p class="text-gray-600 mb-4">
            Vous êtes connecté en tant qu'administrateur.
        </p>

        @if(!empty($quickLinks))
        <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-5 mt-8">
            @foreach($quickLinks as $link)
                <a href="{{ route($link['route'], $link['params'] ?? []) }}" class="relative group bg-white border border-gray-100 rounded-2xl p-5 shadow-sm hover:shadow-lg transition duration-200">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-xs font-semibold uppercase tracking-wide text-gray-400">{{ $link['subtitle'] ?? 'Administration' }}</p>
                            <p class="text-xl font-semibold text-gray-900 mt-1">{{ $link['title'] }}</p>
                        </div>
                        <span class="text-3xl" aria-hidden="true">{{ $link['icon'] }}</span>
                    </div>
                    <p class="text-sm text-gray-500 mt-4 leading-relaxed">{{ $link['description'] }}</p>
                    <div class="mt-5 flex items-center text-indigo-600 font-semibold text-sm">
                        <span>Accéder</span>
                        <svg class="w-4 h-4 ms-1 transition transform group-hover:translate-x-1" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                    @if(!empty($link['badge']))
                        <span class="absolute top-4 right-4 text-[10px] font-semibold px-2 py-0.5 rounded-full {{ $link['badge_style'] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $link['badge'] }}
                        </span>
                    @endif
                </a>
            @endforeach
        </div>
        @endif
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
            <div class="bg-blue-50 p-6 rounded-lg border-l-4 border-blue-500">
                <h3 class="font-semibold text-blue-900 text-lg">📦 Mods & Accessoires</h3>
                <p class="text-blue-700 mt-3 text-2xl font-bold">{{ $mods->count() }}</p>
                <p class="text-blue-600 text-sm mt-2">Articles en stock</p>
            </div>
            <div class="bg-green-50 p-6 rounded-lg border-l-4 border-green-500">
                <h3 class="font-semibold text-green-900 text-lg">🔧 Réparateurs</h3>
                <p class="text-green-700 mt-3 text-2xl font-bold">{{ $repairers->count() }}</p>
                <p class="text-green-600 text-sm mt-2">Réparateurs actifs</p>
            </div>
        </div>
    </div>

    {{-- Stock Mods --}}
    <div class="mt-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">📦 Stock Mods/Accessoires</h2>
            <a href="{{ route('admin.mods.index') }}" class="text-blue-600 hover:underline">
                Voir tout le catalogue →
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Nom</th>
                        <th class="p-3 text-left">Type</th>
                        <th class="p-3 text-left">Prix achat</th>
                        <th class="p-3 text-left">Stock</th>
                        <th class="p-3 text-left">Compatibilité</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($mods as $mod)
                        <tr class="border-t">
                            <td class="p-3 font-semibold">{{ $mod->name }}</td>
                            <td class="p-3">
                                @if($mod->is_accessory)
                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs">📦 Accessoire</span>
                                @else
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">🔧 Modification</span>
                                @endif
                            </td>
                            <td class="p-3">
                                @if(!is_null($mod->purchase_price))
                                    {{ number_format($mod->purchase_price, 2, ',', ' ') }} €
                                @else
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="p-3">
                                @if($mod->quantity == 0)
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm font-semibold">⚠️ Rupture</span>
                                @elseif($mod->quantity < 5)
                                    <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-sm font-semibold">⚡ Stock bas ({{ $mod->quantity }})</span>
                                @else
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm font-semibold">✅ {{ $mod->quantity }}</span>
                                @endif
                            </td>
                            <td class="p-3 text-xs text-gray-600">
                                @php
                                    $compatibilities = $mod->compatibleTypes->pluck('name');
                                @endphp
                                @if($compatibilities->isNotEmpty())
                                    {{ $compatibilities->take(2)->join(', ') }}
                                    @if($compatibilities->count() > 2)
                                        <span class="text-gray-400">+{{ $compatibilities->count() - 2 }}</span>
                                    @endif
                                @else
                                    <span class="text-gray-400 italic">Universel</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Aucun mod enregistré. <a href="{{ route('admin.mods.create') }}" class="text-blue-600 hover:underline">Créez-en un</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Réparateurs --}}
    <div class="mt-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">🔧 Réparateurs actifs</h2>
            <a href="{{ route('admin.repairers.index') }}" class="text-blue-600 hover:underline">
                Voir tous les réparateurs →
            </a>
        </div>

        <div class="bg-white shadow rounded-lg overflow-hidden">
            <table class="w-full border-collapse">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Nom</th>
                        <th class="p-3 text-left">Ville</th>
                        <th class="p-3 text-left">Contact</th>
                        <th class="p-3 text-center">Consoles en cours</th>
                        <th class="p-3 text-center">Actif</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($repairers as $repairer)
                        <tr class="border-t">
                            <td class="p-3 font-semibold">{{ $repairer->name }}</td>
                            <td class="p-3">{{ $repairer->city ?? '—' }}</td>
                            <td class="p-3 text-sm text-gray-600">
                                @if($repairer->phone)
                                    <div>☎ {{ $repairer->phone }}</div>
                                @endif
                                @if($repairer->email)
                                    <div class="text-xs">✉ {{ $repairer->email }}</div>
                                @endif
                                @if(!$repairer->phone && !$repairer->email)
                                    <span class="text-gray-400">—</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                @if($repairer->consoles_count > 0)
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded font-semibold">{{ $repairer->consoles_count }}</span>
                                @else
                                    <span class="text-gray-400">0</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                @if($repairer->is_active)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">✅ Oui</span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">❌ Non</span>
                                @endif
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="p-6 text-center text-gray-500">
                                Aucun réparateur enregistré. <a href="{{ route('admin.repairers.create') }}" class="text-blue-600 hover:underline">Créez-en un</a>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection



