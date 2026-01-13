@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    {{-- Titre --}}
    <h1 class="text-3xl font-bold mb-8">
        Tableau de bord administrateur
    </h1>

    {{-- Grille --}}
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

        {{-- Créer un magasin --}}
        <a href="{{ route('admin.stores.create') }}"
           class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 border-l-4 border-blue-500">
            <h2 class="text-xl font-semibold mb-2">Créer un magasin</h2>
            <p class="text-gray-600">
                Ajouter un nouveau magasin et créer son compte de connexion.
            </p>
        </a>

        {{-- Saisie initiale article --}}
        <a href="{{ route('admin.articles.create') }}"
        class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 border-l-4 border-indigo-500">
            <h2 class="text-xl font-semibold mb-2">➕ Saisie initiale article</h2>
            <p class="text-gray-600">
                Ajouter un nouvel article (console, jeu, accessoire, autre).
            </p>
        </a>
        
        {{-- Gérer les consoles --}}
        <a href="{{ route('admin.consoles.index') }}"
           class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 border-l-4 border-green-500">
            <h2 class="text-xl font-semibold mb-2">liste stock</h2>
            <p class="text-gray-600">
                Voir toutes les consoles, leur état et leurs informations.
            </p>
        </a>

        <a href="{{ route('admin.articles.recent') }}" class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 border-l-4 border-yellow-500">
            <h2 class="text-xl font-semibold mb-2">Derniers articles</h2>
            <p class="text-gray-600">Voir les 40 derniers articles et filtrer par taxonomie pour édition complète.</p>
        </a>



        {{-- Stocks magasins --}}
        <div class="bg-white rounded-lg shadow p-6 border-l-4 border-purple-500">
            <h2 class="text-xl font-semibold mb-2">Stocks magasins</h2>
            <p class="text-gray-600 mb-4">
                Accéder aux stocks de chaque magasin.
            </p>
            <p class="text-sm text-gray-500 italic">
                (via la page magasins)
            </p>
        </div>

        <a href="{{ route('admin.repairers.create') }}"
         class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 border-l-4 border-cyan-500">
        <h2 class="text-xl font-semibold mb-2">Créer un réparateur</h2>
        <p class="text-gray-600">Ajouter un réparateur (coordonnées, notes, délais…)</p>
        </a>

        {{-- Gestion SAV --}}
        <a href="{{ route('admin.returns.index') }}"
           class="bg-white rounded-lg shadow hover:shadow-lg transition p-6 border-l-4 border-red-500">
            <h2 class="text-xl font-semibold mb-2">🔧 Gestion SAV</h2>
            <p class="text-gray-600">
                Consulter et gérer les demandes de retour/réparation.
            </p>
        </a>

    </div>

    {{-- =====================
         STOCK MODS DISPONIBLES
    ===================== --}}
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
                        <th class="p-3 text-left">Prix Achat</th>
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
                                    <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs">
                                        📦 Accessoire
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">
                                        🔧 Modification
                                    </span>
                                @endif
                            </td>
                            <td class="p-3">{{ number_format($mod->purchase_price, 2, ',', ' ') }} €</td>
                            <td class="p-3">
                                @if($mod->quantity == 0)
                                    <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm font-semibold">
                                        ⚠️ Rupture (0)
                                    </span>
                                @elseif($mod->quantity < 5)
                                    <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-sm font-semibold">
                                        ⚡ Stock bas ({{ $mod->quantity }})
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm font-semibold">
                                        ✅ {{ $mod->quantity }}
                                    </span>
                                @endif
                            </td>
                            <td class="p-3 text-xs text-gray-600">
                                @if($mod->compatibleCategories->count() > 0 || $mod->compatibleSubCategories->count() > 0 || $mod->compatibleTypes->count() > 0)
                                    {{ $mod->compatibleTypes->pluck('name')->take(2)->join(', ') }}
                                    @if($mod->compatibleTypes->count() > 2)
                                        <span class="text-gray-400">+{{ $mod->compatibleTypes->count() - 2 }}</span>
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

    {{-- =====================
         RÉPARATEURS
    ===================== --}}
    <div class="mt-10">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-2xl font-bold">🔧 Réparateurs actifs</h2>
            <a href="{{ route('admin.repairers.create') }}" class="text-blue-600 hover:underline">
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
                                    <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded font-semibold">
                                        {{ $repairer->consoles_count }}
                                    </span>
                                @else
                                    <span class="text-gray-400">0</span>
                                @endif
                            </td>
                            <td class="p-3 text-center">
                                @if($repairer->is_active)
                                    <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">
                                        ✅ Oui
                                    </span>
                                @else
                                    <span class="px-2 py-1 bg-gray-100 text-gray-600 rounded text-xs">
                                        ❌ Non
                                    </span>
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



