@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="mb-6">
        <a href="{{ route('admin.mods.index') }}" class="text-blue-600 hover:underline">
            ← Retour au catalogue
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-6">📤 Distribuer les Mods aux Réparateurs</h1>

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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        
        {{-- Liste des mods --}}
        <div class="lg:col-span-2">
            <div class="bg-white shadow rounded-lg overflow-hidden">
                <table class="w-full border-collapse">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="p-3 text-left">Mod</th>
                            <th class="p-3 text-left">Type</th>
                            <th class="p-3 text-center">Stock Central</th>
                            <th class="p-3 text-center">Action</th>
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
                                <td class="p-3 text-center">
                                    @if($mod->quantity == 0)
                                        <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-semibold">
                                            Rupture (0)
                                        </span>
                                    @elseif($mod->quantity < 5)
                                        <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-xs font-semibold">
                                            Stock bas ({{ $mod->quantity }})
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-semibold">
                                            ✅ {{ $mod->quantity }}
                                        </span>
                                    @endif
                                </td>
                                <td class="p-3 text-center">
                                    @if($mod->quantity > 0)
                                        <button type="button" 
                                                onclick="document.getElementById('form-{{ $mod->id }}').classList.toggle('hidden')"
                                                class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                            Envoyer
                                        </button>
                                    @else
                                        <span class="text-gray-400 text-sm">Stock épuisé</span>
                                    @endif
                                </td>
                            </tr>
                            {{-- Formulaire d'envoi caché --}}
                            <tr id="form-{{ $mod->id }}" class="hidden bg-blue-50">
                                <td colspan="4" class="p-4">
                                    <form method="POST" action="{{ route('admin.mods.send-to-repairer', $mod) }}" class="space-y-3">
                                        @csrf
                                        
                                        <div class="grid grid-cols-2 gap-3">
                                            <div>
                                                <label class="block text-sm font-medium mb-1">Réparateur *</label>
                                                <select name="repairer_id" required class="w-full border rounded p-2">
                                                    <option value="">-- Choisir un réparateur --</option>
                                                    @foreach($repairers as $repairer)
                                                        <option value="{{ $repairer->id }}">
                                                            {{ $repairer->name }} 
                                                            @if($repairer->city) ({{ $repairer->city }}) @endif
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div>
                                                <label class="block text-sm font-medium mb-1">
                                                    Quantité * (Max: {{ $mod->quantity }})
                                                </label>
                                                <input type="number" 
                                                       name="quantity" 
                                                       min="1"
                                                       max="{{ $mod->quantity }}"
                                                       required
                                                       class="w-full border rounded p-2">
                                            </div>
                                        </div>

                                        <div class="flex gap-2">
                                            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                                ✅ Envoyer
                                            </button>
                                            <button type="button"
                                                    onclick="document.getElementById('form-{{ $mod->id }}').classList.add('hidden')"
                                                    class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                                                Annuler
                                            </button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="p-6 text-center text-gray-500">
                                    Aucun mod enregistré.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Résumé des distributions --}}
        <div>
            <div class="bg-white shadow rounded-lg p-6">
                <h2 class="text-lg font-semibold mb-4">📊 Stock par Réparateur</h2>
                
                @forelse($repairers as $repairer)
                    @php
                        $totalMods = $repairer->mods()->sum('mod_repairer.quantity');
                    @endphp
                    <div class="mb-4 p-3 border rounded bg-gray-50">
                        <div class="font-semibold text-sm">{{ $repairer->name }}</div>
                        <div class="text-xs text-gray-600 mb-2">{{ $repairer->city ?? '—' }}</div>
                        
                        @if($totalMods > 0)
                            <div class="text-sm">
                                <span class="font-semibold text-blue-600">{{ $totalMods }}</span> mod(s)
                            </div>
                            <div class="mt-2 text-xs space-y-1">
                                @foreach($repairer->mods()->get() as $mod)
                                    <div class="flex justify-between">
                                        <span class="truncate">{{ $mod->name }}</span>
                                        <span class="font-semibold">×{{ $mod->pivot->quantity }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-xs text-gray-400 italic">
                                Aucun mod fourni
                            </div>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500">Aucun réparateur enregistré.</p>
                @endforelse
            </div>
        </div>

    </div>

</div>
@endsection
