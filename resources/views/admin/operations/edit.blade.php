@extends('layouts.app')

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            ✏️ Modifier : {{ $operation->name }}
        </h2>
        <a href="{{ route('admin.operations.index') }}" class="text-sm text-indigo-600 hover:text-indigo-800">
            ← Retour à la liste
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-50 text-red-800 rounded border border-red-200">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('admin.operations.update', $operation) }}">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                    Nom de l'opération *
                </label>
                <input type="text" name="name" id="name" required
                       value="{{ old('name', $operation->name) }}"
                       class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
            </div>

            <div class="mb-6">
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">
                    Description
                </label>
                <textarea name="description" id="description" rows="3"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $operation->description) }}</textarea>
            </div>

            <div class="flex gap-3">
                <button type="submit"
                        class="px-6 py-2 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition">
                    Enregistrer
                </button>
                <a href="{{ route('admin.operations.index') }}"
                   class="px-6 py-2 border border-gray-300 rounded-md hover:bg-gray-50 transition">
                    Annuler
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
