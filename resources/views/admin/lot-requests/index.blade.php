@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-6">
        📦 Demandes de lots
    </h1>

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

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="w-full border-collapse">
            <thead class="bg-gray-100 text-left">
                <tr>
                    <th class="p-3">Console</th>
                    <th class="p-3">Type</th>
                    <th class="p-3">Magasin demandeur</th>
                    <th class="p-3">Quantité</th>
                    <th class="p-3">Prix unitaire</th>
                    <th class="p-3 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
            @forelse($requests as $request)
                @php
                    $console = $request->consoleOffer->console;
                    $offer = $request->consoleOffer;
                @endphp

                <tr class="border-t align-top">

                    {{-- Console --}}
                    <td class="p-3 font-mono">
                        #{{ $console->id }} - {{ $console->serial_number }}
                    </td>

                    {{-- Type --}}
                    <td class="p-3">
                        {{ $console->articleType?->name ?? 'N/A' }}
                    </td>

                    {{-- Magasin --}}
                    <td class="p-3">
                        <span class="font-semibold">{{ $request->store->name }}</span>
                    </td>

                    {{-- Quantité --}}
                    <td class="p-3">
                        <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded">
                            {{ $request->quantity }}
                        </span>
                    </td>

                    {{-- Prix unitaire --}}
                    <td class="p-3">
                        {{ number_format($offer->sale_price, 2, ',', ' ') }} €
                    </td>

                    {{-- Actions --}}
                    <td class="p-3 text-center space-y-2">

                        {{-- Valider --}}
                        <form method="POST" action="{{ route('admin.lot-requests.validate', $request) }}">
                            @csrf
                            <button class="w-full bg-green-600 text-white px-3 py-1 rounded hover:bg-green-700">
                                ✅ Valider
                            </button>
                        </form>

                        {{-- Rejeter --}}
                        <button
                            class="w-full bg-red-200 text-red-800 px-3 py-1 rounded hover:bg-red-300"
                            onclick="document.getElementById('reject-form-{{ $request->id }}').classList.toggle('hidden')">
                            ❌ Rejeter
                        </button>

                        <form
                            method="POST"
                            action="{{ route('admin.lot-requests.reject', $request) }}"
                            id="reject-form-{{ $request->id }}"
                            class="hidden space-y-2 bg-red-50 p-2 rounded">
                            @csrf

                            <textarea
                                name="admin_comment"
                                required
                                rows="2"
                                class="w-full border rounded p-2 text-sm"
                                placeholder="Motif du refus…"></textarea>

                            <button class="w-full bg-red-600 text-white px-2 py-1 rounded hover:bg-red-700 text-sm">
                                Confirmer refus
                            </button>
                        </form>

                    </td>

                </tr>

            @empty
                <tr>
                    <td colspan="6" class="p-6 text-center text-gray-500">
                        Aucune demande en attente
                    </td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>

</div>
@endsection
