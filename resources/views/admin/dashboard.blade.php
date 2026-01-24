@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-gray-800 to-gray-900">
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    {{-- Header compact --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-white">Dashboard Admin</h1>
        <p class="text-sm text-gray-400 mt-1">Stock R4E - Vue d'ensemble</p>
    </div>

    {{-- Stats compactes --}}
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 mb-6">
        <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4 hover:bg-gray-800/70 hover:border-gray-600 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 uppercase">Nombre total articles</p>
                    <p class="text-2xl font-bold text-white">{{ $totalArticles }}</p>
                </div>
                <span class="text-2xl">📊</span>
            </div>
        </div>
        <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4 hover:bg-gray-800/70 hover:border-gray-600 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 uppercase">État stock</p>
                    <p class="text-2xl font-bold text-white">{{ $articlesStock }}</p>
                </div>
                <span class="text-2xl">✅</span>
            </div>
        </div>
        <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4 hover:bg-gray-800/70 hover:border-gray-600 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 uppercase">Défectueux</p>
                    <p class="text-2xl font-bold text-white">{{ $articlesDefectueux }}</p>
                </div>
                <span class="text-2xl">🔴</span>
            </div>
        </div>
        <div class="bg-gray-800/50 backdrop-blur border border-gray-700/50 rounded-lg p-4 hover:bg-gray-800/70 hover:border-gray-600 transition">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-xs text-gray-400 uppercase">Modés</p>
                    <p class="text-2xl font-bold text-white">{{ $articlesModes }}</p>
                </div>
                <span class="text-2xl">⚙️</span>
            </div>
        </div>
    </div>

    {{-- Navigation par sections - VERSION COMPACTE DARK --}}
    @if(!empty($sections))
    <div class="space-y-6">
        @foreach($sections as $section)
            <div class="bg-gray-800/30 backdrop-blur border border-gray-700/50 rounded-lg p-4">
                <h2 class="text-sm font-semibold text-gray-300 uppercase tracking-wide mb-3">{{ $section['title'] }}</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-6 gap-2">
                    @foreach($section['cards'] as $card)
                        @php
                            $isDisabled = !empty($card['disabled']) || empty($card['route']);
                        @endphp
                        @if($isDisabled)
                            <div class="relative group bg-gray-900/40 border border-gray-700/30 rounded-lg p-3 opacity-40 cursor-not-allowed">
                        @else
                            <a href="{{ route($card['route'], $card['params'] ?? []) }}" 
                               class="relative group bg-gray-800/40 border border-gray-700/50 hover:border-indigo-500/50 hover:bg-gray-700/50 hover:shadow-lg hover:shadow-indigo-500/10 rounded-lg p-3 transition duration-150 block"
                               title="{{ $card['description'] ?? '' }}">
                        @endif
                                <div class="flex flex-col items-center text-center">
                                    <span class="text-4xl mb-2">{{ $card['icon'] ?? '📌' }}</span>
                                    <p class="text-base font-semibold text-gray-100 leading-tight">{{ $card['title'] }}</p>
                                    @if(!empty($card['subtitle']))
                                        <p class="text-sm text-gray-500 mt-1">{{ $card['subtitle'] }}</p>
                                    @endif
                                </div>
                                @if(!empty($card['badge']))
                                    <span class="absolute -top-1 -right-1 text-[9px] font-bold px-1.5 py-0.5 rounded-full {{ $card['badge_style'] ?? 'bg-red-500 text-white' }}">
                                        {{ $card['badge'] }}
                                    </span>
                                @endif
                        @if($isDisabled)
                            </div>
                        @else
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
    @endif

{{-- Tables compactes DARK --}}
    <div class="mt-6 grid grid-cols-1 gap-6">
        
        {{-- Stock Mods --}}
        <div class="bg-gray-800/30 backdrop-blur border border-gray-700/50 rounded-lg overflow-hidden">
            <div class="flex items-center justify-between p-4 border-b border-gray-700/50 bg-gray-800/50">
                <h3 class="text-sm font-semibold text-gray-200">📦 Stock Mods ({{ $mods->count() }})</h3>
                <a href="{{ route('admin.mods.index') }}" class="text-xs text-indigo-400 hover:text-indigo-300">
                    Voir tout →
                </a>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-xs">
                    <thead class="bg-gray-900/50">
                        <tr class="text-gray-400">
                            <th class="px-3 py-2 text-left font-medium">Nom</th>
                            <th class="px-3 py-2 text-left font-medium">Type</th>
                            <th class="px-3 py-2 text-center font-medium">Stock</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700/30">
                        @forelse($mods as $mod)
                            <tr class="hover:bg-gray-700/30 transition">
                                <td class="px-3 py-2 font-medium text-gray-200">
                                    @if($mod->icon && str_starts_with($mod->icon, 'data:image/'))
                                        <img src="{{ $mod->icon }}" alt="" class="inline w-4 h-4 mr-1" style="image-rendering: pixelated;">
                                    @else
                                        <span class="mr-1">{{ $mod->icon ?? '🔧' }}</span>
                                    @endif
                                    {{ Str::limit($mod->name, 25) }}
                                </td>
                                <td class="px-3 py-2 text-gray-400">
                                    @if($mod->is_accessory)
                                        <span class="px-1.5 py-0.5 bg-purple-900/50 text-purple-300 rounded text-[10px]">📦</span>
                                    @else
                                        <span class="px-1.5 py-0.5 bg-blue-900/50 text-blue-300 rounded text-[10px]">🔧</span>
                                    @endif
                                </td>
                                <td class="px-3 py-2 text-center">
                                    @if($mod->quantity == 0)
                                        <span class="px-2 py-0.5 bg-red-900/50 text-red-300 rounded text-[10px] font-semibold">0</span>
                                    @elseif($mod->quantity < 5)
                                        <span class="px-2 py-0.5 bg-orange-900/50 text-orange-300 rounded text-[10px] font-semibold">{{ $mod->quantity }}</span>
                                    @else
                                        <span class="px-2 py-0.5 bg-green-900/50 text-green-300 rounded text-[10px] font-semibold">{{ $mod->quantity }}</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-3 py-4 text-center text-gray-500">
                                    Aucun mod. <a href="{{ route('admin.mods.create') }}" class="text-indigo-400 hover:underline">Créer</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

</div>
</div>
@endsection



