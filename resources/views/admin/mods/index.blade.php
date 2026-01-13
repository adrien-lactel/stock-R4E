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

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100">
                <tr>
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
                    <tr class="border-t">
                        <td class="p-3 font-semibold">{{ $mod->name }}</td>
                        <td class="p-3 text-sm text-gray-700">{{ Str::limit($mod->description, 60) }}</td>
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
                        <td class="p-3 text-xs">
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
                        <td class="p-3 text-center space-x-2">
                            <button type="button" 
                                    onclick="document.getElementById('receive-stock-{{ $mod->id }}').classList.toggle('hidden')"
                                    class="inline-block bg-green-600 text-white px-3 py-1 rounded text-sm hover:bg-green-700">
                                📥 Recevoir stock
                            </button>
                            <a href="{{ route('admin.mods.edit', $mod) }}" 
                               class="inline-block bg-yellow-500 text-white px-3 py-1 rounded text-sm hover:bg-yellow-600">
                                ✏️ Éditer
                            </a>
                            <form method="POST" action="{{ route('admin.mods.destroy', $mod) }}" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Supprimer ce mod ?')"
                                        class="bg-red-600 text-white px-3 py-1 rounded text-sm hover:bg-red-700">
                                    🗑️ Supprimer
                                </button>
                            </form>
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
                                           class="border rounded px-3 py-2 w-24">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium mb-1">Commentaire (optionnel)</label>
                                    <input type="text" name="notes" 
                                           placeholder="Ex: Facture #123, Fournisseur A"
                                           class="border rounded px-3 py-2 w-40">
                                </div>
                                <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    ✅ Valider la réception
                                </button>
                                <button type="button"
                                        onclick="document.getElementById('receive-stock-{{ $mod->id }}').classList.add('hidden')"
                                        class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
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
