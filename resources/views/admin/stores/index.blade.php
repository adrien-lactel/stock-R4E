@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-6">

    {{-- Header --}}
    <div class="flex items-center justify-between mb-8">
        <h1 class="text-3xl font-bold">🏬 Magasins du réseau</h1>
        <a href="{{ route('admin.stores.create') }}" 
           class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700">
            ➕ Créer un magasin
        </a>
    </div>

    {{-- Messages --}}
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-50 text-green-800 rounded-lg border border-green-200">
            {{ session('success') }}
        </div>
    @endif

    {{-- Grille des magasins --}}
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-6">
        @forelse($stores as $store)
            <div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden hover:shadow-md transition">
                {{-- Header magasin --}}
                <div class="p-5 border-b border-gray-100">
                    <div class="flex items-start justify-between">
                        <div>
                            <h2 class="text-xl font-bold text-gray-900">{{ $store->name }}</h2>
                            <p class="text-sm text-gray-500 mt-1">📍 {{ $store->city ?? 'Ville non définie' }}</p>
                        </div>
                        <span class="text-3xl">🏪</span>
                    </div>
                </div>

                {{-- Stats --}}
                <div class="p-5 bg-gray-50">
                    <div class="grid grid-cols-2 gap-4 text-center">
                        <div>
                            <p class="text-2xl font-bold text-indigo-600">{{ $store->consoles_count ?? 0 }}</p>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Articles en stock</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-green-600">{{ $store->invoices_count ?? 0 }}</p>
                            <p class="text-xs text-gray-500 uppercase tracking-wide">Factures</p>
                        </div>
                    </div>
                </div>

                {{-- Contact --}}
                <div class="px-5 py-3 border-t border-gray-100 text-sm text-gray-600">
                    @if($store->email)
                        <p>✉️ {{ $store->email }}</p>
                    @endif
                    @if($store->user)
                        <p class="text-xs text-gray-400 mt-1">Compte: {{ $store->user->email }}</p>
                    @endif
                </div>

                {{-- Actions --}}
                <div class="px-5 py-4 bg-white border-t border-gray-100 flex items-center justify-between">
                    <a href="{{ route('store.dashboard', $store) }}" 
                       class="text-indigo-600 hover:text-indigo-800 font-medium text-sm flex items-center gap-1">
                        👁️ Voir le dashboard
                    </a>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.stores.stock', $store) }}" 
                           class="text-gray-600 hover:text-gray-900 text-sm">
                            📦 Stock
                        </a>
                        <a href="{{ route('admin.stores.edit', $store) }}" 
                           class="text-gray-600 hover:text-gray-900 text-sm">
                            ✏️ Éditer
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center py-12 bg-white rounded-lg shadow">
                <p class="text-gray-500 text-lg">Aucun magasin enregistré</p>
                <a href="{{ route('admin.stores.create') }}" class="text-indigo-600 hover:underline mt-2 inline-block">
                    Créer le premier magasin →
                </a>
            </div>
        @endforelse
    </div>

</div>
@endsection
