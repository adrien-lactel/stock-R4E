@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto py-10 px-6">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-3xl font-bold">
            🔧 Demande de réparation (article externe)
        </h1>
        <a href="{{ route('store.dashboard', $store) }}" class="px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="mb-6 p-4 bg-red-100 text-red-800 rounded border border-red-300">
            <ul class="list-disc pl-5">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="bg-white shadow rounded-lg p-6">
        <p class="text-gray-600 mb-6">
            Utilisez ce formulaire pour demander une réparation d'un article qui n'est pas dans votre stock actuel.
        </p>

        <form method="POST" action="{{ route('store.external-repair.store', $store) }}" class="space-y-4">
            @csrf

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Nom de l'article *
                </label>
                <input
                    type="text"
                    name="external_item_name"
                    value="{{ old('external_item_name') }}"
                    required
                    class="w-full border rounded p-2"
                    placeholder="Ex: PlayStation 5 Digital, Xbox Series X, etc."
                >
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Description de l'article et du problème *
                </label>
                <textarea
                    name="external_item_description"
                    rows="4"
                    required
                    class="w-full border rounded p-2"
                    placeholder="Décrivez l'article, son état, et le problème rencontré..."
                >{{ old('external_item_description') }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">
                    Commentaires additionnels
                </label>
                <textarea
                    name="comment"
                    rows="3"
                    class="w-full border rounded p-2"
                    placeholder="Informations supplémentaires, urgence, etc."
                >{{ old('comment') }}</textarea>
            </div>

            <div class="flex gap-3 pt-4">
                <button type="submit" class="flex-1 bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700 font-medium">
                    📤 Envoyer la demande
                </button>
                <a href="{{ route('store.dashboard', $store) }}" class="flex-1 text-center border px-6 py-3 rounded hover:bg-gray-50">
                    Annuler
                </a>
            </div>
        </form>
    </div>

</div>
@endsection
