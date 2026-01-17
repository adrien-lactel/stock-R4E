@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">✏️ Modifier l'accessoire</h1>
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
        <form method="POST" action="{{ route('admin.accessories.update', $accessory) }}" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Nom de l'accessoire *
                </label>
                <input type="text" name="name" id="name" required
                       value="{{ old('name', $accessory->name) }}"
                       class="w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="purchase_price" class="block text-sm font-medium text-gray-700 mb-1">
                    Prix d'achat (€) *
                </label>
                <input type="number" step="0.01" min="0" name="purchase_price" id="purchase_price" required
                       value="{{ old('purchase_price', $accessory->purchase_price) }}"
                       class="w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea name="description" id="description" rows="3"
                          class="w-full rounded border-gray-300 focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $accessory->description) }}</textarea>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                    💾 Mettre à jour
                </button>
                <a href="{{ route('admin.accessories.index') }}" class="px-6 py-2 rounded border hover:bg-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>

    {{-- Stats --}}
    <div class="mt-6 bg-gray-50 rounded-lg p-4">
        <h3 class="font-semibold text-gray-800 mb-2">Statistiques</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div>
                <span class="text-gray-600">Articles avec cet accessoire :</span>
                <span class="font-medium ml-2">{{ $accessory->appliedConsoles()->count() }}</span>
            </div>
            <div>
                <span class="text-gray-600">Réparateurs avec stock :</span>
                <span class="font-medium ml-2">{{ $accessory->repairers()->count() }}</span>
            </div>
        </div>
    </div>
</div>
@endsection
