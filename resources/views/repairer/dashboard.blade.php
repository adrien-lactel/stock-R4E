@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🛠️ Dashboard Réparateur</h1>
        <p class="text-gray-600 mt-1">Bienvenue, {{ $repairer->name }}</p>
    </div>

    {{-- Statistiques --}}
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total consoles</p>
                    <p class="text-3xl font-bold text-gray-900">{{ $stats['total'] }}</p>
                </div>
                <div class="text-4xl">📦</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">En réparation</p>
                    <p class="text-3xl font-bold text-orange-600">{{ $stats['repair'] }}</p>
                </div>
                <div class="text-4xl">🔧</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Réparées (stock)</p>
                    <p class="text-3xl font-bold text-green-600">{{ $stats['stock'] }}</p>
                </div>
                <div class="text-4xl">✅</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Défectueuses</p>
                    <p class="text-3xl font-bold text-red-600">{{ $stats['defective'] }}</p>
                </div>
                <div class="text-4xl">⚠️</div>
            </div>
        </div>
    </div>

    {{-- Informations du réparateur --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">📋 Vos informations</h2>
            <dl class="space-y-2 text-sm">
                <div>
                    <dt class="text-gray-500">Nom</dt>
                    <dd class="font-medium text-gray-900">{{ $repairer->name }}</dd>
                </div>
                @if($repairer->email)
                <div>
                    <dt class="text-gray-500">Email</dt>
                    <dd class="font-medium text-gray-900">{{ $repairer->email }}</dd>
                </div>
                @endif
                @if($repairer->phone)
                <div>
                    <dt class="text-gray-500">Téléphone</dt>
                    <dd class="font-medium text-gray-900">{{ $repairer->phone }}</dd>
                </div>
                @endif
                @if($repairer->city)
                <div>
                    <dt class="text-gray-500">Ville</dt>
                    <dd class="font-medium text-gray-900">{{ $repairer->city }}</dd>
                </div>
                @endif
            </dl>
        </div>

        <div class="lg:col-span-2 bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-lg font-semibold text-gray-800">📦 Consoles récentes</h2>
                <a href="{{ route('repairer.consoles.index') }}" class="text-indigo-600 hover:text-indigo-800 text-sm font-medium">
                    Voir toutes →
                </a>
            </div>

            @if($recentConsoles->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Type</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                                <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Date</th>
                                <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($recentConsoles as $console)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-sm font-medium text-gray-900">#{{ $console->id }}</td>
                                <td class="px-4 py-3 text-sm text-gray-900">
                                    {{ $console->articleType?->name ?? '—' }}
                                </td>
                                <td class="px-4 py-3 text-sm">
                                    @if($console->status === 'repair')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-orange-100 text-orange-800">
                                            🔧 Réparation
                                        </span>
                                    @elseif($console->status === 'stock')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">
                                            ✅ Stock
                                        </span>
                                    @elseif($console->status === 'defective')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">
                                            ⚠️ Défectueux
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                            {{ $console->status }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-sm text-gray-500">
                                    {{ $console->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-center text-sm">
                                    <a href="{{ route('repairer.consoles.edit-mods', $console) }}" 
                                       class="text-indigo-600 hover:text-indigo-900 font-medium">
                                        ✏️ Gérer
                                    </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="text-center py-8 text-gray-500">
                    <p class="text-lg">📭 Aucune console assignée</p>
                    <p class="text-sm mt-1">Les consoles vous seront assignées par l'administrateur</p>
                </div>
            @endif
        </div>
    </div>

    {{-- Actions rapides --}}
    <div class="bg-white rounded-lg shadow p-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">⚡ Actions rapides</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <a href="{{ route('repairer.consoles.index') }}" 
               class="flex items-center p-4 border rounded-lg hover:bg-gray-50 transition">
                <div class="text-3xl mr-4">📦</div>
                <div>
                    <h3 class="font-medium text-gray-900">Mes consoles</h3>
                    <p class="text-sm text-gray-500">Gérer toutes les consoles assignées</p>
                </div>
            </a>

            <a href="{{ route('profile.edit') }}" 
               class="flex items-center p-4 border rounded-lg hover:bg-gray-50 transition">
                <div class="text-3xl mr-4">👤</div>
                <div>
                    <h3 class="font-medium text-gray-900">Mon profil</h3>
                    <p class="text-sm text-gray-500">Modifier mes informations</p>
                </div>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="w-full flex items-center p-4 border rounded-lg hover:bg-red-50 transition text-left">
                    <div class="text-3xl mr-4">🚪</div>
                    <div>
                        <h3 class="font-medium text-gray-900">Déconnexion</h3>
                        <p class="text-sm text-gray-500">Se déconnecter du système</p>
                    </div>
                </button>
            </form>
        </div>
    </div>

</div>
@endsection
