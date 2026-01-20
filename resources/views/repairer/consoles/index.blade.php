@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Mes Consoles Assignées
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Stats --}}
    <div class="mb-6 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-blue-600">{{ $consoles->total() }}</div>
            <div class="text-gray-600 text-sm">Total assignées</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-orange-600">{{ $consoles->where('status', 'repair')->count() }}</div>
            <div class="text-gray-600 text-sm">En réparation</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-green-600">{{ $consoles->where('status', 'stock')->count() }}</div>
            <div class="text-gray-600 text-sm">En stock</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-red-600">{{ $consoles->where('status', 'defective')->count() }}</div>
            <div class="text-gray-600 text-sm">Défectueuses</div>
        </div>
    </div>

    {{-- Liste des consoles --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Article</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mods</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commentaire</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($consoles as $console)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-900">#{{ $console->id }}</td>
                        <td class="px-4 py-3">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $console->articleCategory?->name ?? '—' }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $console->articleSubCategory?->name ?? '' }}
                                {{ $console->articleType?->name ? '/ ' . $console->articleType->name : '' }}
                            </div>
                            @if ($console->serial_number)
                                <div class="text-xs text-gray-400">S/N: {{ $console->serial_number }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @php
                                // Afficher en priorité le statut d'affectation
                                if ($console->assignment_status === 'pending_acceptance') {
                                    $statusClass = 'bg-yellow-100 text-yellow-800';
                                    $statusLabel = '⏳ En attente';
                                } elseif ($console->assignment_status === 'accepted') {
                                    $statusClass = 'bg-blue-100 text-blue-800';
                                    $statusLabel = '📬 À réceptionner';
                                } elseif ($console->assignment_status === 'to_ship') {
                                    $statusClass = 'bg-purple-100 text-purple-800';
                                    $statusLabel = '📮 À expédier';
                                } else {
                                    $statusColors = [
                                        'stock' => 'bg-green-100 text-green-800',
                                        'repair' => 'bg-orange-100 text-orange-800',
                                        'defective' => 'bg-red-100 text-red-800',
                                        'vendue' => 'bg-blue-100 text-blue-800',
                                    ];
                                    $statusClass = $statusColors[$console->status] ?? 'bg-gray-100 text-gray-800';
                                    $statusLabel = ucfirst($console->status);
                                }
                            @endphp
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if ($console->mods->count())
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($console->mods as $mod)
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs rounded {{ $mod->is_accessory ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $mod->name }}
                                            @if ($mod->pivot->work_time_minutes)
                                                <span class="ml-1 text-gray-500">({{ $mod->pivot->work_time_minutes }}min)</span>
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400">Aucun</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 max-w-xs truncate" title="{{ $console->commentaire_reparateur }}">
                            {{ Str::limit($console->commentaire_reparateur, 40) ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <div class="flex items-center justify-center gap-2">
                                @if($console->assignment_status === 'pending_acceptance')
                                    <form action="{{ route('repairer.consoles.accept-assignment', $console) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Accepter cette affectation ?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="px-3 py-1.5 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700">
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
                                                class="px-3 py-1.5 bg-blue-600 text-white text-sm font-medium rounded hover:bg-blue-700">
                                            📬 Réceptionner
                                        </button>
                                    </form>
                                @elseif($console->assignment_status === 'to_ship' && $console->destinationStore)
                                    <div class="text-xs bg-purple-50 p-2 rounded">
                                        <div class="font-semibold text-purple-900">📮 Vers: {{ $console->destinationStore->name }}</div>
                                    </div>
                                    <form action="{{ route('repairer.consoles.confirm-shipment', $console) }}" 
                                          method="POST" 
                                          class="inline"
                                          onsubmit="return confirm('Confirmer l\'expédition ?')">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" 
                                                class="px-3 py-1.5 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700">
                                            ✅ Expédier
                                        </button>
                                    </form>
                                @else
                                    <a href="{{ route('repairer.consoles.edit-mods', $console) }}"
                                       class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-700 transition">
                                        ✏️ Gérer
                                    </a>
                                    
                                    @if(in_array($console->status, ['repair', 'defective']) && $console->assignment_status === 'received')
                                        <form action="{{ route('repairer.consoles.mark-functional', $console) }}" 
                                              method="POST" 
                                              class="inline"
                                              onsubmit="return confirm('Déclarer fonctionnelle ?')">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" 
                                                    class="px-3 py-1.5 bg-green-600 text-white text-sm font-medium rounded hover:bg-green-700">
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
                                                    class="px-3 py-1.5 bg-orange-600 text-white text-sm font-medium rounded hover:bg-orange-700">
                                                🔧 Réparer
                                            </button>
                                        </form>
                                    @endif
                                @endif
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            Aucune console assignée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $consoles->links() }}
    </div>
</div>
@endsection
