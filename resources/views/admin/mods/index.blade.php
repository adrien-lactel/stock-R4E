@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">🔧 Catalogue des Mods</h1>
        <div class="space-x-2">
            <a href="{{ route('admin.mods.distribute') }}" 
               class="bg-purple-600 text-white px-4 py-2 rounded hover:bg-purple-700">
                📤 Distribuer aux réparateurs
            </a>
            <a href="{{ route('admin.mods.create') }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                ➕ Nouveau Mod
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-pink-50 shadow rounded-lg overflow-hidden border border-pink-100">
        <table class="w-full border-collapse">
            <thead class="bg-pink-100">
                <tr>
                    <th class="p-3 text-left">Icône</th>
                    <th class="p-3 text-left">Nom</th>
                    <th class="p-3 text-left">Description</th>
                    <th class="p-3 text-left">Type</th>
                    <th class="p-3 text-left">Prix Achat</th>
                    <th class="p-3 text-left">Stock Disponible</th>
                    <th class="p-3 text-left">Compatibilité</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($mods as $mod)
                    <tr class="border-t border-pink-100 bg-white">
                        <td class="p-3 text-center bg-gray-50">
                            @if($mod->icon && str_starts_with($mod->icon, 'data:image'))
                                <div class="relative inline-block">
                                    <img src="{{ $mod->icon }}" alt="{{ $mod->name }}" class="w-8 h-8 mx-auto" style="image-rendering: pixelated;">
                                    <span class="absolute -top-1 -right-1 bg-gradient-to-r from-pink-500 to-purple-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center" title="Mod R4E personnalisé">✨</span>
                                </div>
                            @else
                                <span class="text-2xl">{{ $mod->icon ?? '🔧' }}</span>
                            @endif
                        </td>
                        <td class="p-3 font-semibold bg-blue-50">{{ $mod->name }}</td>
                        <td class="p-3 text-sm text-gray-700 bg-purple-50">{{ Str::limit($mod->description, 60) }}</td>
                        <td class="p-3 bg-green-50">
                            @if($mod->is_accessory)
                                <span class="px-2 py-1 bg-purple-100 text-purple-800 rounded text-xs border border-purple-200">
                                    📦 Accessoire
                                </span>
                            @else
                                <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs border border-blue-200">
                                    🔧 Modification
                                </span>
                            @endif
                        </td>
                        <td class="p-3 bg-yellow-50">{{ number_format($mod->purchase_price, 2, ',', ' ') }} €</td>
                        <td class="p-3 bg-pink-50">
                            @if($mod->quantity == 0)
                                <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-sm font-semibold border border-red-200">
                                    ⚠️ Rupture (0)
                                </span>
                            @elseif($mod->quantity < 5)
                                <span class="px-2 py-1 bg-orange-100 text-orange-800 rounded text-sm font-semibold border border-orange-200">
                                    ⚡ Stock bas ({{ $mod->quantity }})
                                </span>
                            @else
                                <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-sm font-semibold border border-green-200">
                                    ✅ {{ $mod->quantity }}
                                </span>
                            @endif
                        </td>
                        <td class="p-3 text-xs bg-blue-50">
                            @if($mod->compatibleCategories->count() > 0)
                                <div class="mb-1">
                                    <span class="font-semibold">Catégories:</span>
                                    {{ $mod->compatibleCategories->pluck('name')->join(', ') }}
                                </div>
                            @endif
                            @if($mod->compatibleSubCategories->count() > 0)
                                <div class="mb-1">
                                    <span class="font-semibold">Sous-cat:</span>
                                    {{ $mod->compatibleSubCategories->pluck('name')->join(', ') }}
                                </div>
                            @endif
                            @if($mod->compatibleTypes->count() > 0)
                                <div>
                                    <span class="font-semibold">Types:</span>
                                    {{ $mod->compatibleTypes->pluck('name')->join(', ') }}
                                </div>
                            @endif
                            @if($mod->compatibleCategories->count() == 0 && $mod->compatibleSubCategories->count() == 0 && $mod->compatibleTypes->count() == 0)
                                <span class="text-gray-400 italic">Universel</span>
                            @endif
                        </td>
                        <td class="p-3 bg-pink-50">
                            <div class="flex flex-col gap-2">
                                {{-- Recevoir stock --}}
                                <button type="button" 
                                        onclick="document.getElementById('receive-stock-{{ $mod->id }}').classList.toggle('hidden')"
                                        class="flex items-center justify-center gap-1 bg-green-100 text-green-800 border border-green-200 px-3 py-1.5 rounded text-sm hover:bg-green-200 w-full font-semibold">
                                    <span>📥</span>
                                    <span>Recevoir</span>
                                </button>
                                
                                {{-- Éditer --}}
                                <a href="{{ route('admin.mods.edit', $mod) }}" 
                                   class="flex items-center justify-center gap-1 bg-indigo-100 text-indigo-800 border border-indigo-200 px-3 py-1.5 rounded text-sm hover:bg-indigo-200 w-full font-semibold">
                                    <span>✏️</span>
                                    <span>Éditer</span>
                                </a>
                                
                                {{-- Supprimer --}}
                                <form method="POST" action="{{ route('admin.mods.destroy', $mod) }}" class="w-full">
                                    @csrf
                                    @method('DELETE')
                                    <button onclick="return confirm('Supprimer ce mod ?')"
                                            class="flex items-center justify-center gap-1 bg-red-100 text-red-800 border border-red-200 px-3 py-1.5 rounded text-sm hover:bg-red-200 w-full font-semibold">
                                        <span>🗑️</span>
                                        <span>Supprimer</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    {{-- Formulaire caché de réception de stock --}}
                    <tr id="receive-stock-{{ $mod->id }}" class="hidden bg-green-50">
                        <td colspan="7" class="p-4">
                            <form method="POST" action="{{ route('admin.mods.receive-stock', $mod) }}" class="flex gap-3 items-end">
                                @csrf
                                <div>
                                    <label class="block text-sm font-medium mb-1">Quantité à recevoir</label>
                                    <input type="number" name="quantity" min="1" required
                                           class="border border-green-200 rounded px-3 py-2 w-24 bg-green-50">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Commentaire (optionnel)</label>
                                    <input type="text" name="notes" 
                                           placeholder="Ex: Facture #123, Fournisseur A"
                                           class="border border-blue-200 rounded px-3 py-2 w-40 bg-blue-50">
                                </div>
                                <button type="submit" class="bg-green-100 text-green-800 border border-green-200 px-4 py-2 rounded hover:bg-green-200 font-semibold">
                                    ✅ Valider la réception
                                </button>
                                <button type="button"
                                        onclick="document.getElementById('receive-stock-{{ $mod->id }}').classList.add('hidden')"
                                        class="bg-gray-100 text-gray-600 border border-gray-200 px-4 py-2 rounded hover:bg-gray-200 font-semibold">
                                    Annuler
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="p-6 text-center text-gray-500">
                            Aucun mod enregistré. Créez-en un pour commencer.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-6">
        {{ $mods->links() }}
    </div>

</div>

@endsection
