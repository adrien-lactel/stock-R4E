@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Mes Consoles Assignées
    </h2>
@endsection

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

    {{-- Flash messages --}}
    @if (session('success'))
        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mb-4 p-4 bg-red-100 text-red-800 rounded">
            {{ session('error') }}
        </div>
    @endif

    {{-- Stats --}}
    <div class="mb-6 grid grid-cols-2 md:grid-cols-4 gap-4">
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-blue-600">{{ $consoles->total() }}</div>
            <div class="text-gray-600 text-sm">Total assignées</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-orange-600">{{ $consoles->where('status', 'repair')->count() }}</div>
            <div class="text-gray-600 text-sm">En réparation</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-green-600">{{ $consoles->where('status', 'stock')->count() }}</div>
            <div class="text-gray-600 text-sm">En stock</div>
        </div>
        <div class="bg-white p-4 rounded-lg shadow">
            <div class="text-2xl font-bold text-red-600">{{ $consoles->where('status', 'defective')->count() }}</div>
            <div class="text-gray-600 text-sm">Défectueuses</div>
        </div>
    </div>

    {{-- Liste des consoles --}}
    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">ID</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Article</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Statut</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Mods</th>
                    <th class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase">Commentaire</th>
                    <th class="px-4 py-3 text-center text-xs font-medium text-gray-500 uppercase">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse ($consoles as $console)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 text-sm text-gray-900">#{{ $console->id }}</td>
                        <td class="px-4 py-3">
                            <div class="text-sm font-medium text-gray-900">
                                {{ $console->articleCategory?->name ?? '—' }}
                            </div>
                            <div class="text-xs text-gray-500">
                                {{ $console->articleSubCategory?->name ?? '' }}
                                {{ $console->articleType?->name ? '/ ' . $console->articleType->name : '' }}
                            </div>
                            @if ($console->serial_number)
                                <div class="text-xs text-gray-400">S/N: {{ $console->serial_number }}</div>
                            @endif
                        </td>
                        <td class="px-4 py-3">
                            @php
                                $statusColors = [
                                    'stock' => 'bg-green-100 text-green-800',
                                    'repair' => 'bg-orange-100 text-orange-800',
                                    'defective' => 'bg-red-100 text-red-800',
                                    'vendue' => 'bg-blue-100 text-blue-800',
                                ];
                            @endphp
                            <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $statusColors[$console->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($console->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-sm">
                            @if ($console->mods->count())
                                <div class="flex flex-wrap gap-1">
                                    @foreach ($console->mods as $mod)
                                        <span class="inline-flex items-center px-2 py-0.5 text-xs rounded {{ $mod->is_accessory ? 'bg-purple-100 text-purple-800' : 'bg-blue-100 text-blue-800' }}">
                                            {{ $mod->name }}
                                            @if ($mod->pivot->work_time_minutes)
                                                <span class="ml-1 text-gray-500">({{ $mod->pivot->work_time_minutes }}min)</span>
                                            @endif
                                        </span>
                                    @endforeach
                                </div>
                            @else
                                <span class="text-gray-400">Aucun</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-sm text-gray-600 max-w-xs truncate" title="{{ $console->commentaire_reparateur }}">
                            {{ Str::limit($console->commentaire_reparateur, 40) ?? '—' }}
                        </td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('repairer.consoles.edit-mods', $console) }}"
                               class="inline-flex items-center px-3 py-1.5 bg-indigo-600 text-white text-sm font-medium rounded hover:bg-indigo-700 transition">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                </svg>
                                Mods
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-4 py-8 text-center text-gray-500">
                            Aucune console assignée.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $consoles->links() }}
    </div>
</div>
@endsection
