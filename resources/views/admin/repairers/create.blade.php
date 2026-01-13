@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold text-gray-800">
            🛠️ Réparateurs — {{ $repairer->exists ? "Éditer #{$repairer->id}" : "Créer" }}
        </h1>

        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded border hover:bg-gray-50">
            ← Retour dashboard
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

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 text-red-800 rounded border border-red-200">
            <ul class="list-disc pl-5 space-y-1 text-sm">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- FORMULAIRE --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                {{ $repairer->exists ? "✏️ Modifier le réparateur" : "➕ Créer un réparateur" }}
            </h2>

            <form method="POST"
                  action="{{ $repairer->exists ? route('admin.repairers.update', $repairer) : route('admin.repairers.store') }}"
                  class="space-y-5">
                @csrf
                @if($repairer->exists)
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nom / Société *</label>
                        <input name="name" required
                               value="{{ old('name', $repairer->name) }}"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div class="flex items-center gap-3 mt-6 md:mt-0">
                        <input id="is_active" type="checkbox" name="is_active" value="1"
                               class="rounded border-gray-300"
                               @checked(old('is_active', $repairer->exists ? $repairer->is_active : true))>
                        <label for="is_active" class="text-sm text-gray-700">Actif</label>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input name="email"
                               value="{{ old('email', $repairer->email) }}"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Téléphone</label>
                        <input name="phone"
                               value="{{ old('phone', $repairer->phone) }}"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Ville</label>
                        <input name="city"
                               value="{{ old('city', $repairer->city) }}"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Adresse</label>
                        <input name="address"
                               value="{{ old('address', $repairer->address) }}"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Délai moyen (jours)</label>
                        <input type="number" min="0" max="365" name="delay_days_default"
                               value="{{ old('delay_days_default', $repairer->delay_days_default) }}"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Transport préféré</label>
                        <input name="shipping_method"
                               value="{{ old('shipping_method', $repairer->shipping_method) }}"
                               placeholder="Colissimo, Chronopost, DHL…"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">TVA</label>
                        <input name="vat_number"
                               value="{{ old('vat_number', $repairer->vat_number) }}"
                               class="w-full rounded border-gray-300" />
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">SIRET</label>
                        <input name="siret"
                               value="{{ old('siret', $repairer->siret) }}"
                               class="w-full rounded border-gray-300" />
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Notes</label>
                    <textarea name="notes" rows="4"
                              class="w-full rounded border-gray-300"
                              placeholder="Spécialités, conditions, procédures…">{{ old('notes', $repairer->notes) }}</textarea>
                </div>

                {{-- Mods disponibles chez ce réparateur --}}
                @if($repairer->exists)
                <div class="border-t pt-4">
                    <h3 class="text-lg font-semibold mb-3">🔧 Mods/Accessoires disponibles</h3>
                    <p class="text-sm text-gray-600 mb-3">Indiquez les quantités des mods que ce réparateur a en stock</p>
                    
                    <div class="grid grid-cols-2 gap-3 max-h-60 overflow-y-auto border rounded p-3 bg-gray-50">
                        @foreach($mods as $mod)
                            @php
                                $currentQuantity = $repairer->mods->where('id', $mod->id)->first()?->pivot->quantity ?? 0;
                            @endphp
                            <div class="flex items-center justify-between bg-white p-2 rounded border">
                                <label class="text-sm font-medium flex-1">
                                    {{ $mod->name }}
                                    @if($mod->is_accessory)
                                        <span class="text-xs text-purple-600">📦</span>
                                    @else
                                        <span class="text-xs text-blue-600">🔧</span>
                                    @endif
                                </label>
                                <input type="number" 
                                       name="mods[{{ $mod->id }}]" 
                                       value="{{ old('mods.'.$mod->id, $currentQuantity) }}"
                                       min="0"
                                       class="w-20 border rounded px-2 py-1 text-sm"
                                       placeholder="0">
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <div class="flex gap-2">
                    <button class="px-6 py-2 rounded bg-indigo-600 text-white hover:bg-indigo-700">
                        {{ $repairer->exists ? '💾 Mettre à jour' : '💾 Créer' }}
                    </button>

                    @if($repairer->exists)
                        <a href="{{ route('admin.repairers.create', ($activeOnly ?? false) ? ['active' => 1] : []) }}"
                           class="px-6 py-2 rounded border hover:bg-gray-50">
                            + Nouveau
                        </a>
                    @endif
                </div>
            </form>
        </div>

        {{-- LISTE --}}
        <div class="bg-white shadow rounded-lg p-6">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h2 class="text-lg font-semibold text-gray-800">📋 Tous les réparateurs</h2>
                    <p class="text-sm text-gray-500">
                        {{ $repairers->count() }} affiché(s){{ ($activeOnly ?? false) ? ' (actifs uniquement)' : '' }}
                    </p>
                </div>

                <div class="flex gap-2">
                    @if(!($activeOnly ?? false))
                        <a href="{{ route('admin.repairers.create', ['active' => 1]) }}"
                           class="px-3 py-2 rounded bg-gray-900 text-white text-sm hover:bg-black">
                            Actifs uniquement
                        </a>
                    @else
                        <a href="{{ route('admin.repairers.create') }}"
                           class="px-3 py-2 rounded border text-sm hover:bg-gray-50">
                            Afficher tous
                        </a>
                    @endif
                </div>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-sm">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-3 py-2 text-left">Nom</th>
                            <th class="px-3 py-2 text-left">Ville</th>
                            <th class="px-3 py-2 text-center">Actif</th>
                            <th class="px-3 py-2 text-center">Mods</th>
                            <th class="px-3 py-2 text-center">Consoles</th>
                            <th class="px-3 py-2 text-center">Éditer</th>
                            <th class="px-3 py-2 text-center">Supprimer</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($repairers as $r)
                            <tr>
                                <td class="px-3 py-2 font-medium">{{ $r->name }}</td>
                                <td class="px-3 py-2">{{ $r->city ?? '—' }}</td>

                                <td class="px-3 py-2 text-center">
                                    <span class="px-2 py-1 rounded text-white text-xs {{ $r->is_active ? 'bg-green-600' : 'bg-gray-500' }}">
                                        {{ $r->is_active ? 'Oui' : 'Non' }}
                                    </span>
                                </td>

                                <td class="px-3 py-2 text-center">
                                    @php
                                        $modsCount = $r->mods()->count();
                                    @endphp
                                    @if($modsCount > 0)
                                        <span class="px-2 py-1 rounded bg-blue-100 text-blue-800 text-xs font-semibold">
                                            {{ $modsCount }}
                                        </span>
                                    @else
                                        <span class="text-gray-400">—</span>
                                    @endif
                                </td>

                                <td class="px-3 py-2 text-center">
                                    {{ $r->consoles_count ?? 0 }}
                                </td>

                                <td class="px-3 py-2 text-center">
                                    <a href="{{ route('admin.repairers.edit', $r) }}{{ ($activeOnly ?? false) ? '?active=1' : '' }}"
                                       class="text-indigo-600 hover:underline font-medium">
                                        ✏️
                                    </a>
                                </td>

                                <td class="px-3 py-2 text-center">
                                    @if(($r->consoles_count ?? 0) > 0)
                                        <span class="text-gray-400 cursor-not-allowed"
                                              title="Suppression impossible : consoles associées">
                                            🗑️
                                        </span>
                                    @else
                                        <form method="POST"
                                              action="{{ route('admin.repairers.destroy', $r) }}"
                                              onsubmit="return confirm('Supprimer ce réparateur ?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="text-red-600 hover:underline font-medium">
                                                🗑️
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-3 py-6 text-center text-gray-500">
                                    Aucun réparateur
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <p class="text-xs text-gray-500 mt-4">
                ℹ️ La suppression est désactivée si un réparateur a des consoles associées.
            </p>
        </div>

    </div>
</div>
@endsection
