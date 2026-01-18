@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">💎 Valoriser en pièces détachées</h1>
            <p class="text-sm text-gray-600 mt-1">Console HS #{{ $console->id }} - {{ $console->articleType?->name ?? 'Type non défini' }}</p>
        </div>

        <a href="{{ route('admin.consoles.disabled') }}"
           class="inline-flex items-center px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour aux consoles HS
        </a>
    </div>

    {{-- Infos console --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">Informations de la console HS</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div>
                <span class="text-gray-500">Type :</span>
                <div class="font-medium">{{ $console->articleType?->name ?? '—' }}</div>
            </div>
            <div>
                <span class="text-gray-500">Serial :</span>
                <div class="font-medium">{{ $console->serial_number ?? '—' }}</div>
            </div>
            <div>
                <span class="text-gray-500">Provenance :</span>
                <div class="font-medium">{{ $console->provenance_article ?? '—' }}</div>
            </div>
            <div>
                <span class="text-gray-500">Prix d'achat :</span>
                <div class="font-medium text-red-600">{{ number_format($console->prix_achat ?? 0, 2, ',', ' ') }} €</div>
            </div>
        </div>
    </div>

    {{-- Formulaire valorisation --}}
    <form method="POST" action="{{ route('admin.consoles.valorize.store', $console) }}" class="bg-white shadow rounded-lg p-6">
        @csrf

        <h2 class="text-lg font-semibold text-gray-800 mb-4">Créer des accessoires / pièces détachées</h2>
        <p class="text-sm text-gray-600 mb-6">
            Définissez les accessoires/pièces détachées que vous souhaitez créer. Ces articles seront ajoutés au stock et la console sera marquée comme "valorisée".
        </p>

        <div id="accessories-container">
            <div class="accessory-item border rounded-lg p-4 mb-4">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-medium text-gray-700">Accessoire / Pièce #1</h3>
                    <button type="button" onclick="removeAccessory(this)" class="text-red-600 hover:text-red-800 text-sm hidden">
                        🗑️ Supprimer
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Type d'accessoire / pièce *</label>
                        <select name="accessories[0][mod_id]" required 
                                class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Sélectionner un accessoire</option>
                            @foreach($accessories as $accessory)
                                <option value="{{ $accessory->id }}">{{ $accessory->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Quantité *</label>
                        <input type="number" name="accessories[0][quantity]" min="1" value="1" required
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Commentaire</label>
                        <input type="text" name="accessories[0][product_comment]" maxlength="500"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="État, particularités...">
                    </div>
                </div>
            </div>
        </div>

        <button type="button" onclick="addAccessory()" 
                class="mb-6 px-4 py-2 bg-green-100 text-green-700 rounded hover:bg-green-200 text-sm font-medium">
            ➕ Ajouter un autre accessoire / pièce
        </button>

        {{-- Valorisation totale --}}
        <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
            <label class="block text-sm font-medium text-gray-700 mb-2">
                💰 Valorisation totale estimée des pièces détachées (€) *
            </label>
            <p class="text-xs text-gray-600 mb-3">
                Montant total récupéré par la valorisation de cette console. Cette somme sera déduite de la quote-part HS répartie sur les autres consoles.
            </p>
            <input type="number" 
                   name="valorisation" 
                   step="0.01" 
                   min="0" 
                   max="{{ $console->prix_achat ?? 999999 }}" 
                   value="0" 
                   required
                   class="w-full md:w-64 rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            <p class="text-xs text-gray-500 mt-1">
                Prix d'achat de la console : <strong>{{ number_format($console->prix_achat ?? 0, 2, ',', ' ') }} €</strong>
            </p>
        </div>

        <div class="flex items-center gap-4 pt-6 border-t">
            <button type="submit" class="px-6 py-3 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 font-medium">
                💾 Valoriser et créer les accessoires / pièces
            </button>
            <a href="{{ route('admin.consoles.disabled') }}" class="px-6 py-3 border rounded-lg hover:bg-gray-50">
                Annuler
            </a>
        </div>
    </form>

</div>

<script>
let accessoryIndex = 1;

function addAccessory() {
    const container = document.getElementById('accessories-container');
    const newItem = document.createElement('div');
    newItem.className = 'accessory-item border rounded-lg p-4 mb-4';
    newItem.innerHTML = `
        <div class="flex items-center justify-between mb-4">
            <h3 class="font-medium text-gray-700">Accessoire / Pièce #${accessoryIndex + 1}</h3>
            <button type="button" onclick="removeAccessory(this)" class="text-red-600 hover:text-red-800 text-sm">
                🗑️ Supprimer
            </button>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Type d'accessoire / pièce *</label>
                <select name="accessories[${accessoryIndex}][mod_id]" required 
                        class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                    <option value="">Sélectionner un accessoire</option>
                    @foreach($accessories as $accessory)
                        <option value="{{ $accessory->id }}">{{ $accessory->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Quantité *</label>
                <input type="number" name="accessories[${accessoryIndex}][quantity]" min="1" value="1" required
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-medium text-gray-700 mb-1">Commentaire</label>
                <input type="text" name="accessories[${accessoryIndex}][product_comment]" maxlength="500"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                       placeholder="État, particularités...">
            </div>
        </div>
    `;
    container.appendChild(newItem);
    accessoryIndex++;
}

function removeAccessory(button) {
    button.closest('.accessory-item').remove();
}
</script>
@endsection
