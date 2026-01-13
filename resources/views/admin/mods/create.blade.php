@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">

    <div class="mb-6">
        <a href="{{ route('admin.mods.index') }}" class="text-blue-600 hover:underline">
            ← Retour à la liste
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-6">➕ Créer un Mod</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('admin.mods.store') }}">
            @csrf

            {{-- Nom --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Nom du Mod *</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}"
                       required
                       class="w-full border rounded p-2 @error('name') border-red-500 @enderror"
                       placeholder="Ex: Changement ventilateur, Câble HDMI, etc.">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Description *</label>
                <textarea name="description" 
                          rows="3"
                          required
                          class="w-full border rounded p-2 @error('description') border-red-500 @enderror"
                          placeholder="Description détaillée du mod ou accessoire">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Prix et quantité --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Prix d'achat (€) *</label>
                    <input type="number" 
                           step="0.01" 
                           name="purchase_price" 
                           value="{{ old('purchase_price') }}"
                           required
                           class="w-full border rounded p-2 @error('purchase_price') border-red-500 @enderror">
                    @error('purchase_price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Quantité en stock *</label>
                    <input type="number" 
                           name="quantity" 
                           value="{{ old('quantity', 0) }}"
                           required
                           min="0"
                           class="w-full border rounded p-2 @error('quantity') border-red-500 @enderror">
                    @error('quantity')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Type --}}
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_accessory" 
                           value="1"
                           {{ old('is_accessory') ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm font-medium">📦 Ceci est un accessoire (câble, boîte, etc.)</span>
                </label>
            </div>

            {{-- Compatibilité --}}
            <div class="mb-6 border-t pt-4">
                <h3 class="text-lg font-semibold mb-3">🎯 Compatibilité</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Sélectionnez les catégories/types compatibles. Laissez vide pour un mod universel.
                </p>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Catégories compatibles</label>
                    <select name="compatible_categories[]" 
                            multiple
                            class="w-full border rounded p-2"
                            size="5">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    {{ in_array($category->id, old('compatible_categories', [])) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Maintenez Ctrl/Cmd pour sélectionner plusieurs</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Sous-catégories compatibles</label>
                    <select name="compatible_sub_categories[]" 
                            multiple
                            class="w-full border rounded p-2"
                            size="5">
                        @foreach($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}"
                                    {{ in_array($subCategory->id, old('compatible_sub_categories', [])) ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Types compatibles</label>
                    <select name="compatible_types[]" 
                            multiple
                            class="w-full border rounded p-2"
                            size="5">
                        @foreach($types as $type)
                            <option value="{{ $type->id }}"
                                    {{ in_array($type->id, old('compatible_types', [])) ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Boutons --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.mods.index') }}" 
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    Annuler
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    ✅ Créer le Mod
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
