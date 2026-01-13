@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">⚙️ Gérer les prix</h1>
            <p class="text-sm text-gray-600 mt-1">
                Article #{{ $console->id }}
                — {{ $console->articleType?->name ?? 'Type non défini' }}
            </p>
        </div>

        <a href="{{ route('admin.consoles.index') }}"
           class="px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour au stock
        </a>
    </div>

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
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Magasin</th>
                    <th class="px-4 py-3 text-center">Prix de vente (€)</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach($stores as $store)
                    @php
                        $attached  = $console->stores->firstWhere('id', $store->id);
                        $salePrice = $attached?->pivot?->sale_price;
                    @endphp

                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800">{{ $store->name }}</div>
                        </td>

                        <td class="px-4 py-3 text-center">
                            <form method="POST"
                                  action="{{ route('admin.consoles.prices.store', $console) }}"
                                  class="flex items-center justify-center gap-2">
                                @csrf
                                <input type="hidden" name="store_id" value="{{ $store->id }}">

                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="sale_price"
                                       value="{{ old('sale_price', $salePrice) }}"
                                       class="w-32 border rounded px-3 py-2 text-sm text-center"
                                       @if($console->status !== 'stock') disabled @endif>
                        </td>

                        <td class="px-4 py-3 text-center">
                                <button
                                    class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700
                                           disabled:opacity-50 disabled:cursor-not-allowed"
                                    @if($console->status !== 'stock') disabled @endif
                                >
                                    💾 Enregistrer
                                </button>
                            </form>

                            @if(!is_null($salePrice))
                                <div class="text-xs text-gray-500 mt-2">
                                    Actuel : {{ number_format($salePrice, 2, ',', ' ') }} €
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if($console->status !== 'stock')
            <div class="p-4 bg-yellow-50 text-yellow-800 text-sm">
                ⚠️ Les prix ne peuvent être modifiés que si l’article est en statut <b>stock</b>.
            </div>
        @endif
    </div>

</div>
@endsection
