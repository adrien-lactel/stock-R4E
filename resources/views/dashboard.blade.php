@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-10 px-6">

    <h1 class="text-3xl font-bold mb-8">
        Tableau de bord
    </h1>

    {{-- ===================== --}}
    {{-- ADMIN DASHBOARD       --}}
    {{-- ===================== --}}
    @if(auth()->user()->role === 'admin')

        <p class="text-gray-600 mb-10">
            Interface administrateur
        </p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <!-- Créer un magasin -->
            <a href="{{ route('admin.stores.create') }}"
               class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition border-l-4 border-blue-500">
                <h2 class="text-xl font-semibold mb-2">Créer un magasin</h2>
                <p class="text-gray-600">
                    Ajouter un magasin partenaire et créer son compte.
                </p>
            </a>

            {{-- DÉSACTIVÉ - Vue prix console retirée --}}
            {{-- <a href="{{ route('admin.prices.index') }}"
               class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition border-l-4 border-green-500">
                <h2 class="text-xl font-semibold mb-2">Prix des consoles</h2>
                <p class="text-gray-600">
                    Définir les prix de vente par magasin.
                </p>
            </a> --}}

            <!-- Dashboard admin -->
            <a href="{{ route('admin.dashboard') }}"
               class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition border-l-4 border-purple-500">
                <h2 class="text-xl font-semibold mb-2">Vue globale</h2>
                <p class="text-gray-600">
                    Stocks, factures et statistiques.
                </p>
            </a>

        </div>

    {{-- ===================== --}}
    {{-- STORE DASHBOARD       --}}
    {{-- ===================== --}}
    @elseif(auth()->user()->role === 'store')

        @php
            $storeId = auth()->user()->store_id;
        @endphp

        <p class="text-gray-600 mb-10">
            Interface magasin – gestion de votre stock
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <!-- Stock magasin -->
            @if($storeId)
                <a href="{{ route('store.dashboard', $storeId) }}"
                   class="bg-white shadow rounded-lg p-6 hover:shadow-lg transition border-l-4 border-indigo-500">
                    <h2 class="text-xl font-semibold mb-2">Mon stock</h2>
                    <p class="text-gray-600">
                        Consoles disponibles, vendues ou HS.
                    </p>
                </a>
            @else
                <div class="bg-white shadow rounded-lg p-6 border-l-4 border-yellow-500">
                    <h2 class="text-xl font-semibold mb-2">Mon stock</h2>
                    <p class="text-gray-600">
                        Associez d'abord ce compte à un magasin pour accéder au tableau de bord.
                    </p>
                </div>
            @endif

            <!-- Factures -->
            <div class="bg-white shadow rounded-lg p-6 border-l-4 border-gray-400">
                <h2 class="text-xl font-semibold mb-2">Factures</h2>
                <p class="text-gray-600">
                    Historique des ventes (à venir).
                </p>
            </div>

        </div>

    @endif

</div>
@endsection
