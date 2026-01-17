@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">🛠️ Réparateurs</h1>
        <a href="{{ route('admin.repairers.create') }}" class="px-4 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
            ➕ Nouveau réparateur
        </a>
    </div>

    @if(session('success'))
        <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-white shadow rounded-lg overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200 text-sm">
            <thead class="bg-gray-100">
                <tr>
                    <th class="px-4 py-3 text-left">Nom</th>
                    <th class="px-4 py-3 text-left">Contact</th>
                    <th class="px-4 py-3 text-left">Ville</th>
                    <th class="px-4 py-3 text-center">Consoles</th>
                    <th class="px-4 py-3 text-center">Actif</th>
                    <th class="px-4 py-3 text-center">Délai</th>
                    <th class="px-4 py-3 text-right">Actions</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($repairers as $r)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 font-medium">
                            <a href="{{ route('admin.repairers.show', $r) }}" class="text-indigo-600 hover:underline">
                                {{ $r->name }}
                            </a>
                        </td>
                        <td class="px-4 py-3">
                            <div>{{ $r->email ?? '—' }}</div>
                            <div class="text-gray-500">{{ $r->phone ?? '' }}</div>
                        </td>
                        <td class="px-4 py-3">{{ $r->city ?? '—' }}</td>
                        <td class="px-4 py-3 text-center">
                            @if($r->consoles_count > 0)
                                <span class="px-2 py-1 bg-indigo-100 text-indigo-800 rounded-full text-xs font-semibold">
                                    {{ $r->consoles_count }}
                                </span>
                            @else
                                <span class="text-gray-400">0</span>
                            @endif
                        </td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 rounded text-white text-xs {{ $r->is_active ? 'bg-green-600' : 'bg-gray-500' }}">
                                {{ $r->is_active ? 'Oui' : 'Non' }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">{{ $r->delay_days_default ?? '—' }} j</td>
                        <td class="px-4 py-3 text-right space-x-2">
                            <a href="{{ route('admin.repairers.show', $r) }}" class="text-indigo-600 hover:underline text-sm">
                                Voir
                            </a>
                            <a href="{{ route('admin.repairers.edit', $r) }}" class="text-gray-600 hover:underline text-sm">
                                Éditer
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="px-4 py-8 text-center text-gray-500">
                            Aucun réparateur.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $repairers->links() }}
    </div>

</div>
@endsection
