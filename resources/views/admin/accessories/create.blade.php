@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">➕ Nouvel accessoire</h1>
        <a href="{{ route('admin.accessories.index') }}" class="px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour à la liste
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 text-red-800 rounded border border-red-200">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('admin.accessories.store') }}" class="space-y-5">
            @csrf

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Nom de l'accessoire *
                </label>
                <input type="text" name="name" id="name" required
                       value="{{ old('name') }}"
                       placeholder="Ex: Boîte originale, Câble HDMI, Manette..."
                       class="w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-1">
                    Prix d'achat (€) *
                </label>
                <input type="number" step="0.01" min="0" name="purchase_price" id="purchase_price" required
                       value="{{ old('purchase_price', '0') }}"
                       class="w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
                <p class="text-xs text-gray-500 mt-1">Prix moyen d'achat de cet accessoire</p>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea name="description" id="description" rows="3"
                          placeholder="Description optionnelle..."
                          class="w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description') }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    💾 Créer l'accessoire
                </button>
                <a href="{{ route('admin.accessories.index') }}" class="px-6 py-2 rounded border hover:bg-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
