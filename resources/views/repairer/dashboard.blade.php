@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-800">🛠️ Dashboard Réparateur</h1>
        <p class="text-gray-600 mt-1">Bienvenue, {{ $repairer->name }}</p>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    {{-- Statistiques --}}
    <div class="grid grid-cols-1 md:grid-cols-7 gap-4 mb-6">
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
                    <p class="text-sm font-medium text-gray-500">En attente</p>
                    <p class="text-3xl font-bold text-yellow-600">{{ $stats['pending'] }}</p>
                </div>
                <div class="text-4xl">⏳</div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">À réceptionner</p>
                    <p class="text-3xl font-bold text-blue-600">{{ $stats['accepted'] }}</p>
                </div>
                <div class="text-4xl">📬</div>
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
                    <p class="text-sm font-medium text-gray-500">À expédier</p>
                    <p class="text-3xl font-bold text-purple-600">{{ $stats['to_ship'] }}</p>
                </div>
                <div class="text-4xl">📮</div>
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

    {{-- Compétences (Opérations) --}}
    <div class="mb-6">
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">🎯 Mes compétences</h2>
            <form method="POST" action="{{ route('repairer.skills.update') }}">
                @csrf
                <p class="text-sm text-gray-600 mb-3">Cochez les opérations que vous êtes capable d'effectuer</p>
                
                @if($allOperations->count() > 0)
                    <div class="space-y-2 max-h-64 overflow-y-auto">
                        @foreach($allOperations as $operation)
                            <label class="flex items-center p-2 hover:bg-gray-50 rounded cursor-pointer">
                                <input type="checkbox" 
                                       name="operations[]" 
                                       value="{{ $operation->id }}"
                                       @checked($repairer->operations->contains($operation->id))
                                       class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                <span class="ml-3 text-sm font-medium text-gray-700">
                                    {{ $operation->name }}
                                </span>
                            </label>
                        @endforeach
                    </div>
                    <button type="submit" class="mt-4 w-full px-4 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700">
                        💾 Enregistrer mes compétences
                    </button>
                @else
                    <p class="text-sm text-gray-500 italic">Aucune opération disponible</p>
                @endif
            </form>
        </div>
    </div>

    {{-- Mods et Accessoires disponibles --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-6">
        {{-- Mods (pièces) --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">🔩 Mods en stock</h2>
            @php
                $mods = $repairer->mods->where('is_accessory', false)->where('is_operation', false);
            @endphp
            
            @if($mods->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                <th class="px-3 py-2 text-center text-xs font-medium text-gray-500 uppercase">Stock</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($mods as $mod)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-2 font-medium text-gray-900">{{ $mod->name }}</td>
                                    <td class="px-3 py-2 text-center">
                                        <span class="font-semibold {{ $mod->pivot->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $mod->pivot->quantity }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-sm text-gray-500 italic text-center py-4">Aucun mod en stock</p>
            @endif
        </div>

        {{-- Accessoires --}}
        <div class="bg-white rounded-lg shadow p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">📦 Accessoires en stock</h2>
            @php
                $accessories = $repairer->mods->where('is_accessory', true);
            @endphp
            
            @if($accessories->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full text-sm">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-medium text-gray-500 uppercase">Nom</th>
                                <th class="px-3 py-2 text-center text-xs font-medium text-gray-500 uppercase">Stock</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200">
                            @foreach($accessories as $accessory)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-3 py-2 font-medium text-gray-900">{{ $accessory->name }}</td>
                                    <td class="px-3 py-2 text-center">
                                        <span class="font-semibold {{ $accessory->pivot->quantity > 0 ? 'text-green-600' : 'text-red-600' }}">
                                            {{ $accessory->pivot->quantity }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-sm text-gray-500 italic text-center py-4">Aucun accessoire en stock</p>
            @endif
        </div>
    </div>

    {{-- Consoles récentes --}}
    <div class="bg-white rounded-lg shadow p-6 mb-6">
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
                                    @if($console->assignment_status === 'pending_acceptance')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-yellow-100 text-yellow-800">
                                            ⏳ En attente
                                        </span>
                                    @elseif($console->assignment_status === 'accepted')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                            📬 À réceptionner
                                        </span>
                                    @elseif($console->assignment_status === 'to_ship')
                                        <span class="px-2 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-800">
                                            📮 À expédier
                                        </span>
                                    @elseif($console->status === 'repair')
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
                                    <div class="flex items-center justify-center gap-2">
                                        @if($console->assignment_status === 'pending_acceptance')
                                            <form action="{{ route('repairer.consoles.accept-assignment', $console) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Accepter cette affectation ?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="text-green-600 hover:text-green-800 font-medium">
                                                    ✓ Accepter
                                                </button>
                                            </form>
                                        @elseif($console->assignment_status === 'accepted')
                                            <form action="{{ route('repairer.consoles.confirm-receipt', $console) }}" 
                                                  method="POST" 
                                                  class="inline"
                                                  onsubmit="return confirm('Confirmer la réception physique ?')">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" 
                                                        class="text-blue-600 hover:text-blue-800 font-medium">
                                                    📬 Réceptionner
                                                </button>
                                            </form>
                                        @elseif($console->assignment_status === 'to_ship')
                                            @if($console->destinationStore)
                                                <div class="text-sm bg-purple-50 p-3 rounded-lg">
                                                    <div class="font-semibold text-purple-900 mb-1">📮 Expédier vers:</div>
                                                    <div class="font-bold text-gray-900">{{ $console->destinationStore->name }}</div>
                                                    @if($console->destinationStore->address)
                                                        <div class="text-gray-700">{{ $console->destinationStore->address }}</div>
                                                    @endif
                                                    @if($console->destinationStore->postal_code || $console->destinationStore->city)
                                                        <div class="text-gray-700">
                                                            {{ $console->destinationStore->postal_code }} {{ $console->destinationStore->city }}
                                                        </div>
                                                    @endif
                                                    @if($console->destinationStore->phone)
                                                        <div class="text-gray-600 text-xs mt-1">☎️ {{ $console->destinationStore->phone }}</div>
                                                    @endif
                                                </div>
                                                <form action="{{ route('repairer.consoles.confirm-shipment', $console) }}" 
                                                      method="POST" 
                                                      class="inline mt-2"
                                                      onsubmit="return confirm('Confirmer l\'expédition vers {{ $console->destinationStore->name }} ?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="px-3 py-1.5 bg-green-600 text-white rounded hover:bg-green-700 font-medium text-sm">
                                                        ✅ Confirmer expédition
                                                    </button>
                                                </form>
                                            @endif
                                        @else
                                            <a href="{{ route('repairer.consoles.edit-mods', $console) }}" 
                                               class="text-indigo-600 hover:text-indigo-900 font-medium">
                                                ✏️ Gérer
                                            </a>
                                            @if(in_array($console->status, ['repair', 'defective']) && $console->assignment_status === 'received')
                                                <form action="{{ route('repairer.consoles.mark-functional', $console) }}" 
                                                      method="POST" 
                                                      class="inline"
                                                      onsubmit="return confirm('Confirmer que cette console est fonctionnelle ?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="text-green-600 hover:text-green-800 font-medium">
                                                        ✅ Stock
                                                    </button>
                                                </form>
                                            @endif
                                            @if($console->status === 'stock' && $console->assignment_status === 'received')
                                                <form action="{{ route('repairer.consoles.mark-for-repair', $console) }}" 
                                                      method="POST" 
                                                      class="inline"
                                                      onsubmit="return confirm('Repasser en réparation ?')">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" 
                                                            class="text-orange-600 hover:text-orange-800 font-medium">
                                                        🔧 Réparer
                                                    </button>
                                                </form>
                                            @endif
                                        @endif
                                    </div>
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
