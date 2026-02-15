<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-8">
        {{-- Breadcrumb --}}
        <div class="mb-6 text-sm text-gray-600">
            <a href="{{ route('store.dashboard', $store->id) }}" class="hover:text-indigo-600">← Retour au stock</a>
        </div>

        @php
            // Utiliser ProductSheet en priorité, sinon ArticleType
            $sheet = $console->productSheet;
            $type = $console->articleType;
            
            // Images : priorité ProductSheet
            $mainImage = $sheet?->main_image ?? null;
            $images = $sheet?->images ?? [];
            
            // Textes : priorité ProductSheet
            $title = $sheet?->name ?? $type?->name ?? 'Article #'.$console->id;
            $description = $sheet?->description ?? $type?->description ?? null;
            $marketingDesc = $sheet?->marketing_description ?? null;
        @endphp

        <div class="grid md:grid-cols-2 gap-8">
            {{-- COLONNE GAUCHE - IMAGES --}}
            <div class="space-y-4">
                {{-- Image principale --}}
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    @if($mainImage)
                        <img src="{{ $mainImage }}" 
                             alt="{{ $title }}" 
                             class="w-full h-auto object-cover">
                    @elseif($type?->cover_image)
                        <img src="{{ $type->cover_image }}" 
                             alt="{{ $title }}" 
                             class="w-full h-auto object-cover">
                    @else
                        <div class="w-full h-96 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                            <span class="text-gray-400 text-lg">📦 Aucune image disponible</span>
                        </div>
                    @endif
                </div>

                {{-- Images supplémentaires de la fiche --}}
                @if($images && count($images) > 0)
                    @foreach($images as $image)
                        <div class="bg-white rounded-lg shadow overflow-hidden">
                            <img src="{{ $image }}" 
                                 alt="{{ $title }}" 
                                 class="w-full h-auto object-cover">
                        </div>
                    @endforeach
                @elseif($type?->gameplay_image)
                    <div class="bg-white rounded-lg shadow overflow-hidden">
                        <img src="{{ $type->gameplay_image }}" 
                             alt="Gameplay" 
                             class="w-full h-auto object-cover">
                    </div>
                @endif
            </div>

            {{-- COLONNE DROITE - INFORMATIONS --}}
            <div class="space-y-6">
                {{-- En-tête produit --}}
                <div class="bg-white rounded-lg shadow-lg p-6">
                    {{-- Numéro de fiche produit --}}
                    @if($sheet)
                        <div class="mb-3 inline-flex items-center px-3 py-1.5 rounded-lg text-sm font-semibold bg-blue-100 text-blue-800 border-2 border-blue-300">
                            📄 Fiche produit #{{ $sheet->id }}
                        </div>
                    @endif

                    <div class="mb-2 text-sm text-gray-500">
                        {{ $console->articleCategory?->name }} › 
                        {{ $console->articleSubCategory?->name }}
                    </div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-4">
                        {{ $title }}
                    </h1>

                    {{-- Prix --}}
                    <div class="flex items-baseline gap-4 mb-6">
                        <div class="text-4xl font-bold text-indigo-600">
                            {{ $offer?->sale_price ?? $console->pivot?->sale_price ?? 'N/A' }} €
                        </div>
                        @if($type?->average_market_price)
                            <div class="text-sm text-gray-500">
                                Prix moyen constaté : {{ $type->average_market_price }} €
                            </div>
                        @endif
                    </div>

                    {{-- Statut --}}
                    <div class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                        {{ $console->status === 'stock' ? 'bg-green-100 text-green-800' : 'bg-gray-100 text-gray-800' }}">
                        @if($console->status === 'stock')
                            ✅ En stock
                        @else
                            {{ ucfirst($console->status) }}
                        @endif
                    </div>
                </div>

                {{-- Description marketing --}}
                @if($marketingDesc)
                    <div class="bg-gradient-to-br from-indigo-50 to-purple-50 rounded-lg shadow p-6 border-2 border-indigo-200">
                        <h2 class="text-xl font-semibold mb-3 text-indigo-900">✨ Pourquoi ce produit ?</h2>
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($marketingDesc)) !!}
                        </div>
                    </div>
                @endif

                {{-- Description --}}
                @if($description)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-3 text-gray-900">📝 Description</h2>
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($description)) !!}
                        </div>
                    </div>
                @endif

                {{-- Spécifications techniques --}}
                @if($sheet?->technical_specs)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-3 text-gray-900">⚙️ Spécifications techniques</h2>
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($sheet->technical_specs)) !!}
                        </div>
                    </div>
                @endif

                {{-- Contenu de la boîte --}}
                @if($sheet?->included_items)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-3 text-gray-900">📦 Contenu de la boîte</h2>
                        <div class="text-gray-700 leading-relaxed">
                            {!! nl2br(e($sheet->included_items)) !!}
                        </div>
                    </div>
                @endif

                {{-- Points forts (si pas de fiche) --}}
                @if(!$sheet && $type?->key_features)
                    <div class="bg-white rounded-lg shadow p-6">
                        <h2 class="text-xl font-semibold mb-3 text-gray-900">⭐ Points forts</h2>
                        <ul class="space-y-2">
                            @foreach(explode("\n", $type->key_features) as $feature)
                                @if(trim($feature))
                                    <li class="flex items-start gap-2">
                                        <span class="text-green-500 mt-1">✓</span>
                                        <span class="text-gray-700">{{ trim($feature) }}</span>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Informations complémentaires --}}
                <div class="bg-white rounded-lg shadow p-6">
                    <h2 class="text-xl font-semibold mb-3 text-gray-900">ℹ️ Informations</h2>
                    <dl class="space-y-2 text-sm">
                        @if($console->serial_number)
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Numéro de série :</dt>
                                <dd class="font-mono text-gray-900">{{ $console->serial_number }}</dd>
                            </div>
                        @endif
                        <div class="flex justify-between">
                            <dt class="text-gray-600">Référence :</dt>
                            <dd class="font-mono text-gray-900">#{{ $console->id }}</dd>
                        </div>
                        @if($console->real_value)
                            <div class="flex justify-between">
                                <dt class="text-gray-600">Valeur réelle :</dt>
                                <dd class="text-gray-900">{{ $console->real_value }} €</dd>
                            </div>
                        @endif
                        @if($console->mods && $console->mods->count() > 0)
                            <div class="pt-2 border-t">
                                <dt class="text-gray-600 mb-2">Modifications :</dt>
                                <dd class="space-y-1">
                                    @foreach($console->mods as $mod)
                                        <div class="text-gray-900 text-xs bg-gray-50 px-2 py-1 rounded">
                                            {{ $mod->name }}
                                        </div>
                                    @endforeach
                                </dd>
                            </div>
                        @endif
                    </dl>
                </div>

                {{-- Actions --}}
                @if($console->status === 'stock')
                    <div class="bg-white rounded-lg shadow p-6">
                        <form method="POST" action="{{ route('store.console.sell', $console->id) }}" 
                              onsubmit="return confirm('Confirmer la vente de cet article ?');">
                            @csrf
                            <button type="submit" 
                                    class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg transition">
                                💰 Vendre cet article
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
