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

    {{-- Informations de l'article avec mods/opérations --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h2 class="text-lg font-semibold text-gray-800 mb-4">📦 Informations de l'article</h2>
        
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm mb-4">
            <div>
                <span class="text-gray-500">Catégorie :</span>
                <div class="font-medium">{{ $console->articleCategory?->name ?? '—' }}</div>
            </div>
            <div>
                <span class="text-gray-500">Sous-catégorie :</span>
                <div class="font-medium">{{ $console->articleSubCategory?->name ?? '—' }}</div>
            </div>
            <div>
                <span class="text-gray-500">Type :</span>
                <div class="font-medium">{{ $console->articleType?->name ?? '—' }}</div>
            </div>
            <div>
                <span class="text-gray-500">Statut :</span>
                <div class="font-medium">
                    <span class="px-2 py-1 rounded text-white text-xs
                        @if($console->status === 'stock') bg-green-600
                        @elseif($console->status === 'defective') bg-orange-600
                        @elseif($console->status === 'repair') bg-indigo-600
                        @else bg-gray-600
                        @endif">
                        {{ ucfirst($console->status) }}
                    </span>
                </div>
            </div>
        </div>

        {{-- Coûts --}}
        @php
            // Calculer la quote-part des consoles disabled
            $disabledQuotePart = 0;
            if ($console->article_type_id && !in_array($console->status, ['disabled', 'parted_out'])) {
                // Consoles disabled : coût complet
                $disabledTotalCost = \App\Models\Console::where('article_type_id', $console->article_type_id)
                    ->where('status', 'disabled')
                    ->sum('prix_achat');
                
                // Consoles parted_out : prix_achat - valorisation
                $partedOutConsoles = \App\Models\Console::where('article_type_id', $console->article_type_id)
                    ->where('status', 'parted_out')
                    ->get();
                
                foreach ($partedOutConsoles as $partedOut) {
                    $netCost = ($partedOut->prix_achat ?? 0) - ($partedOut->valorisation ?? 0);
                    $disabledTotalCost += max(0, $netCost);
                }
                
                $sellableCount = \App\Models\Console::where('article_type_id', $console->article_type_id)
                    ->whereIn('status', ['stock', 'defective', 'repair', 'vendue'])
                    ->count();
                
                if ($sellableCount > 0 && $disabledTotalCost > 0) {
                    $disabledQuotePart = $disabledTotalCost / $sellableCount;
                }
            }
        @endphp
        
        <div class="grid grid-cols-2 md:grid-cols-5 gap-4 text-sm border-t pt-4 mb-4">
            <div>
                <span class="text-gray-500">Prix d'achat :</span>
                <div class="font-medium">{{ number_format($console->prix_achat ?? 0, 2, ',', ' ') }} €</div>
            </div>
            <div>
                <span class="text-gray-500">Coût mods :</span>
                <div class="font-medium text-blue-600">{{ number_format($console->mods_cost ?? 0, 2, ',', ' ') }} €</div>
            </div>
            <div>
                <span class="text-gray-500">Main d'œuvre :</span>
                <div class="font-medium text-orange-600">{{ number_format($console->labor_cost ?? 0, 2, ',', ' ') }} €</div>
            </div>
            <div>
                <span class="text-gray-500">Quote-part HS :</span>
                <div class="font-medium text-red-600">{{ number_format($disabledQuotePart, 2, ',', ' ') }} €</div>
                @if($disabledQuotePart > 0)
                    <div class="text-xs text-gray-500 mt-1">
                        Consoles disabled réparties
                    </div>
                @endif
            </div>
            <div>
                <span class="text-gray-500">Prix de revient :</span>
                <div class="font-semibold text-gray-900 text-lg">{{ number_format($console->total_cost ?? 0, 2, ',', ' ') }} €</div>
            </div>
        </div>

        {{-- Prix R4E --}}
        <div class="border-t pt-4 mb-4">
            <div class="flex items-start gap-4">
                <div class="flex-1">
                    <span class="text-gray-500 text-sm">Prix R4E :</span>
                    <form method="POST" action="{{ route('admin.consoles.update-valorisation', $console) }}" class="flex items-center gap-2 mt-1">
                        @csrf
                        @method('PATCH')
                        <input type="number" 
                               step="0.01" 
                               min="0" 
                               name="valorisation" 
                               value="{{ old('valorisation', $console->valorisation) }}" 
                               class="w-40 border rounded px-3 py-2 text-sm"
                               placeholder="Prix R4E">
                        <button type="submit" class="px-3 py-2 bg-indigo-600 text-white rounded hover:bg-indigo-700 text-sm">
                            💾 Enregistrer
                        </button>
                    </form>
                    @if($console->valorisation)
                        <div class="text-xs text-gray-500 mt-1">Actuel : {{ number_format($console->valorisation, 2, ',', ' ') }} €</div>
                        @php
                            $totalCost = $console->total_cost ?? 0;
                            $margin = ($console->valorisation ?? 0) - $totalCost;
                            $marginPercent = $totalCost > 0 ? ($margin / $totalCost * 100) : 0;
                        @endphp
                        <div class="text-xs mt-1 font-medium
                            @if($margin > 0) text-green-600
                            @elseif($margin < 0) text-red-600
                            @else text-gray-500
                            @endif">
                            @if($margin > 0)
                                ✓ Marge : +{{ number_format($margin, 2, ',', ' ') }} € (+{{ number_format($marginPercent, 1) }}%)
                            @elseif($margin < 0)
                                ✗ Perte : {{ number_format($margin, 2, ',', ' ') }} € ({{ number_format($marginPercent, 1) }}%)
                            @else
                                = Prix de revient
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        {{-- Liste des mods et opérations --}}
        @if($console->mods->count() > 0)
        <div class="border-t pt-4">
            <h3 class="font-medium text-gray-700 mb-3">🔧 Mods & Opérations appliqués</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
                @foreach($console->mods as $mod)
                    <div class="flex items-center gap-2 p-2 rounded border
                        @if($mod->is_operation) bg-orange-50 border-orange-200
                        @elseif($mod->is_accessory) bg-purple-50 border-purple-200
                        @else bg-blue-50 border-blue-200
                        @endif">
                        @if($mod->is_operation)
                            <span class="text-orange-500">⚙️</span>
                        @elseif($mod->is_accessory)
                            <span class="text-purple-500">📦</span>
                        @else
                            <span class="text-blue-500">🔩</span>
                        @endif
                        <div class="flex-1">
                            <div class="font-medium text-sm">{{ $mod->name }}</div>
                            <div class="text-xs text-gray-500">
                                @if(!$mod->is_operation)
                                    {{ number_format($mod->pivot->price_applied ?? 0, 2) }} €
                                @endif
                                @if($mod->pivot->work_time_minutes)
                                    @if(!$mod->is_operation) — @endif
                                    {{ $mod->pivot->work_time_minutes }} min
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            {{-- Temps total --}}
            @php
                $totalMinutes = $console->mods->sum('pivot.work_time_minutes');
                $hours = floor($totalMinutes / 60);
                $minutes = $totalMinutes % 60;
            @endphp
            @if($totalMinutes > 0)
            <div class="mt-3 text-sm text-gray-600">
                ⏱️ Temps de travail total : 
                <span class="font-medium">
                    @if($hours > 0){{ $hours }}h @endif{{ $minutes }}min
                </span>
            </div>
            @endif
        </div>
        @else
        <div class="border-t pt-4 text-center text-gray-500 text-sm">
            Aucun mod ou opération appliqué à cet article.
        </div>
        @endif
    </div>

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Magasin</th>
                    <th class="px-4 py-3 text-center">Prix vente (€)</th>
                    <th class="px-4 py-3 text-center">Prix dépôt (€)</th>
                    <th class="px-4 py-3 text-center">Action</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-100">
                @foreach($stores as $store)
                    @php
                        // Récupérer l'offre pour ce magasin
                        $offer = $console->offers->firstWhere('store_id', $store->id);
                        $salePrice = $offer?->sale_price;
                        $consignmentPrice = $offer?->consignment_price;
                        $r4ePrice = $console->valorisation ?? 0;
                        $totalCost = $console->total_cost ?? 0;
                        
                        // Calculer les réductions par rapport au prix R4E
                        $saleDiscount = $salePrice && $r4ePrice > 0 ? $r4ePrice - $salePrice : null;
                        $saleDiscountPercent = $salePrice && $r4ePrice > 0 ? (($r4ePrice - $salePrice) / $r4ePrice * 100) : null;
                        
                        $consignmentDiscount = $consignmentPrice && $r4ePrice > 0 ? $r4ePrice - $consignmentPrice : null;
                        $consignmentDiscountPercent = $consignmentPrice && $r4ePrice > 0 ? (($r4ePrice - $consignmentPrice) / $r4ePrice * 100) : null;
                        
                        // Calculer les marges par rapport au prix de revient
                        $saleMargin = $salePrice && $totalCost > 0 ? $salePrice - $totalCost : null;
                        $saleMarginPercent = $salePrice && $totalCost > 0 ? ($saleMargin / $totalCost * 100) : null;
                        
                        $consignmentMargin = $consignmentPrice && $totalCost > 0 ? $consignmentPrice - $totalCost : null;
                        $consignmentMarginPercent = $consignmentPrice && $totalCost > 0 ? ($consignmentMargin / $totalCost * 100) : null;
                    @endphp

                    <tr>
                        <td class="px-4 py-3">
                            <div class="font-medium text-gray-800">{{ $store->name }}</div>
                        </td>

                        <form method="POST"
                              action="{{ route('admin.consoles.prices.store', $console) }}"
                              class="contents">
                            @csrf
                            <input type="hidden" name="store_id" value="{{ $store->id }}">

                            <td class="px-4 py-3 text-center">
                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="sale_price"
                                       value="{{ old('sale_price', $salePrice) }}"
                                       placeholder="Prix vente"
                                       class="w-32 border rounded px-3 py-2 text-sm text-center"
                                       @if($console->status !== 'stock') disabled @endif>
                                @if(!is_null($salePrice))
                                    <div class="text-xs text-gray-500 mt-1">
                                        Actuel : {{ number_format($salePrice, 2, ',', ' ') }} €
                                    </div>
                                    @if($saleDiscount !== null && $r4ePrice > 0)
                                        <div class="text-xs mt-1 
                                            @if($saleDiscount > 0) text-red-600 
                                            @elseif($saleDiscount < 0) text-green-600
                                            @else text-gray-500
                                            @endif">
                                            @if($saleDiscount > 0)
                                                ↓ Réduction : {{ number_format($saleDiscount, 2, ',', ' ') }} € ({{ number_format($saleDiscountPercent, 1) }}%)
                                            @elseif($saleDiscount < 0)
                                                ↑ Majoration : {{ number_format(abs($saleDiscount), 2, ',', ' ') }} € (+{{ number_format(abs($saleDiscountPercent), 1) }}%)
                                            @else
                                                = Prix R4E
                                            @endif
                                        </div>
                                    @endif
                                    @if($saleMargin !== null && $totalCost > 0)
                                        <div class="text-xs mt-1 font-medium
                                            @if($saleMargin > 0) text-green-600
                                            @elseif($saleMargin < 0) text-red-600
                                            @else text-gray-500
                                            @endif">
                                            @if($saleMargin > 0)
                                                ✓ Marge : +{{ number_format($saleMargin, 2, ',', ' ') }} € (+{{ number_format($saleMarginPercent, 1) }}%)
                                            @elseif($saleMargin < 0)
                                                ✗ Perte : {{ number_format($saleMargin, 2, ',', ' ') }} € ({{ number_format($saleMarginPercent, 1) }}%)
                                            @else
                                                = Prix de revient
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                <input type="number"
                                       step="0.01"
                                       min="0"
                                       name="consignment_price"
                                       value="{{ old('consignment_price', $consignmentPrice) }}"
                                       placeholder="Prix dépôt"
                                       class="w-32 border rounded px-3 py-2 text-sm text-center"
                                       @if($console->status !== 'stock') disabled @endif>
                                @if(!is_null($consignmentPrice))
                                    <div class="text-xs text-gray-500 mt-1">
                                        Actuel : {{ number_format($consignmentPrice, 2, ',', ' ') }} €
                                    </div>
                                    @if($consignmentDiscount !== null && $r4ePrice > 0)
                                        <div class="text-xs mt-1 
                                            @if($consignmentDiscount > 0) text-red-600 
                                            @elseif($consignmentDiscount < 0) text-green-600
                                            @else text-gray-500
                                            @endif">
                                            @if($consignmentDiscount > 0)
                                                ↓ Réduction : {{ number_format($consignmentDiscount, 2, ',', ' ') }} € ({{ number_format($consignmentDiscountPercent, 1) }}%)
                                            @elseif($consignmentDiscount < 0)
                                                ↑ Majoration : {{ number_format(abs($consignmentDiscount), 2, ',', ' ') }} € (+{{ number_format(abs($consignmentDiscountPercent), 1) }}%)
                                            @else
                                                = Prix R4E
                                            @endif
                                        </div>
                                    @endif
                                    @if($consignmentMargin !== null && $totalCost > 0)
                                        <div class="text-xs mt-1 font-medium
                                            @if($consignmentMargin > 0) text-green-600
                                            @elseif($consignmentMargin < 0) text-red-600
                                            @else text-gray-500
                                            @endif">
                                            @if($consignmentMargin > 0)
                                                ✓ Marge : +{{ number_format($consignmentMargin, 2, ',', ' ') }} € (+{{ number_format($consignmentMarginPercent, 1) }}%)
                                            @elseif($consignmentMargin < 0)
                                                ✗ Perte : {{ number_format($consignmentMargin, 2, ',', ' ') }} € ({{ number_format($consignmentMarginPercent, 1) }}%)
                                            @else
                                                = Prix de revient
                                            @endif
                                        </div>
                                    @endif
                                @endif
                            </td>

                            <td class="px-4 py-3 text-center">
                                <button
                                    class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700
                                           disabled:opacity-50 disabled:cursor-not-allowed"
                                    @if($console->status !== 'stock') disabled @endif
                                >
                                    💾 Enregistrer
                                </button>
                            </td>
                        </form>
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
