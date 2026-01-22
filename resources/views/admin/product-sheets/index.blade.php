@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🖼️ Fiches produits</h1>
        <div class="flex gap-2">
            <a href="{{ route('admin.product-sheets.images-manager') }}"
               class="inline-flex items-center px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                📸 Gérer les images
            </a>
            <a href="{{ route('admin.product-sheets.create') }}"
               class="inline-flex items-center px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                ➕ Créer une fiche produit
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        @if($sheets->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-4">
                @foreach($sheets as $sheet)
                    <div class="border rounded-lg overflow-hidden hover:shadow-lg transition">
                        {{-- Image principale --}}
                        @php
                            $displayImage = $sheet->main_image ?: ($sheet->images[0] ?? null);
                        @endphp
                        @if($displayImage)
                            <img src="{{ $displayImage }}" alt="{{ $sheet->name }}" 
                                 class="w-full h-48 object-cover">
                        @else
                            <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                                Aucune image
                            </div>
                        @endif

                        {{-- Contenu --}}
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-2">
                                <h3 class="font-semibold text-gray-800">{{ $sheet->name }}</h3>
                                @if($sheet->is_active)
                                    <span class="text-xs bg-green-100 text-green-800 px-2 py-1 rounded">Actif</span>
                                @else
                                    <span class="text-xs bg-gray-100 text-gray-600 px-2 py-1 rounded">Inactif</span>
                                @endif
                            </div>

                            {{-- Taxonomie complète --}}
                            @if($sheet->articleType)
                                <div class="text-xs text-gray-600 mb-2">
                                    <span class="font-medium">
                                        {{ $sheet->articleType->subCategory?->category?->name ?? '—' }}
                                    </span>
                                    <span class="text-gray-400"> / </span>
                                    <span>
                                        {{ $sheet->articleType->subCategory?->name ?? '—' }}
                                    </span>
                                    <span class="text-gray-400"> / </span>
                                    <span class="text-indigo-600 font-medium">
                                        {{ $sheet->articleType->name }}
                                    </span>
                                </div>
                            @endif

                            @if($sheet->description)
                                <p class="text-sm text-gray-600 line-clamp-2 mb-3">{{ Str::limit($sheet->description, 100) }}</p>
                            @endif

                            {{-- Images count --}}
                            @if($sheet->images && count($sheet->images) > 0)
                                <p class="text-xs text-gray-500 mb-3">
                                    🖼️ {{ count($sheet->images) }} image(s)
                                </p>
                            @endif

                            {{-- Actions --}}
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.product-sheets.edit', $sheet) }}"
                                   class="flex-1 text-center px-3 py-2 rounded bg-indigo-600 text-white text-sm hover:bg-indigo-700">
                                    ✏️ Éditer
                                </a>
                                
                                <form method="POST" action="{{ route('admin.product-sheets.duplicate', $sheet) }}"
                                      class="flex-shrink-0">
                                    @csrf
                                    <button type="submit" 
                                            class="px-3 py-2 rounded bg-blue-600 text-white text-sm hover:bg-blue-700"
                                            title="Dupliquer cette fiche">
                                        📋
                                    </button>
                                </form>
                                
                                <form method="POST" action="{{ route('admin.product-sheets.destroy', $sheet) }}"
                                      onsubmit="return confirm('Supprimer cette fiche produit ?')"
                                      class="flex-shrink-0">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="px-3 py-2 rounded bg-red-600 text-white text-sm hover:bg-red-700">
                                        🗑️
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="p-4 border-t">
                {{ $sheets->links() }}
            </div>
        @else
            <div class="p-8 text-center text-gray-500">
                <p class="mb-4">Aucune fiche produit créée</p>
                <a href="{{ route('admin.product-sheets.create') }}"
                   class="inline-flex items-center px-4 py-2 rounded bg-emerald-600 text-white hover:bg-emerald-700">
                    ➕ Créer la première fiche produit
                </a>
            </div>
        @endif
    </div>
</div>
@endsection
