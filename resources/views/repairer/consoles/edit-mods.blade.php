@extends('layouts.app')

@section('header')
    <div class="flex items-center justify-between">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Mods & Accessoires — Console #{{ $console->id }}
        </h2>
        <a href="{{ route('repairer.consoles.index') }}"
           class="text-sm text-indigo-600 hover:text-indigo-800">
            ← Retour à la liste
        </a>
    </div>
@endsection

@section('content')
<div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

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

    {{-- Infos console --}}
    <div class="bg-white shadow rounded-lg p-6 mb-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informations de l'article</h3>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-sm">
            <div>
                <span class="text-gray-500">Catégorie:</span>
                <div class="font-medium">{{ $console->articleCategory?->name ?? '—' }}</div>
            </div>
            <div>
                <span class="text-gray-500">Sous-catégorie:</span>
                <div class="font-medium">{{ $console->articleSubCategory?->name ?? '—' }}</div>
            </div>
            <div>
                <span class="text-gray-500">Type:</span>
                <div class="font-medium">{{ $console->articleType?->name ?? '—' }}</div>
            </div>
            <div>
                <span class="text-gray-500">N° Série:</span>
                <div class="font-medium">{{ $console->serial_number ?? '—' }}</div>
            </div>
            <div>
                <span class="text-gray-500">Statut:</span>
                <div class="font-medium">
                    @php
                        $statusColors = [
                            'stock' => 'text-green-600',
                            'repair' => 'text-orange-600',
                            'defective' => 'text-red-600',
                            'vendue' => 'text-blue-600',
                        ];
                    @endphp
                    <span class="{{ $statusColors[$console->status] ?? 'text-gray-600' }}">
                        {{ ucfirst($console->status) }}
                    </span>
                </div>
            </div>
            <div>
                <span class="text-gray-500">Prix d'achat:</span>
                <div class="font-medium">{{ number_format($console->prix_achat ?? 0, 2) }} €</div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

        {{-- Mods actuellement associés --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Mods, Accessoires & Opérations</h3>

            @if ($console->mods->count())
                <div class="space-y-3">
                    @foreach ($console->mods as $mod)
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg">
                            <div>
                                <div class="flex items-center gap-2">
                                    <span class="font-medium text-gray-900">{{ $mod->name }}</span>
                                    @if ($mod->is_operation)
                                        <span class="px-2 py-0.5 text-xs bg-orange-100 text-orange-800 rounded">🔧 Opération</span>
                                    @elseif ($mod->is_accessory)
                                        <span class="px-2 py-0.5 text-xs bg-purple-100 text-purple-800 rounded">📦 Accessoire</span>
                                    @else
                                        <span class="px-2 py-0.5 text-xs bg-blue-100 text-blue-800 rounded">🔩 Mod</span>
                                    @endif
                                </div>
                                <div class="text-sm text-gray-500 mt-1">
                                    @if (!$mod->is_operation)
                                        Prix: {{ number_format($mod->pivot->price_applied ?? 0, 2) }} €
                                    @endif
                                    @if ($mod->pivot->work_time_minutes)
                                        {{ !$mod->is_operation ? '—' : '' }} Temps: {{ $mod->pivot->work_time_minutes }} min
                                    @endif
                                </div>
                                @if ($mod->pivot->notes)
                                    <div class="text-sm text-gray-600 italic mt-1">{{ $mod->pivot->notes }}</div>
                                @endif
                            </div>
                            <form action="{{ route('repairer.consoles.remove-mod', [$console, $mod]) }}" method="POST"
                                  onsubmit="return confirm('Retirer ce mod ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 p-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>

                {{-- Total temps de travail --}}
                @php
                    $totalMinutes = $console->mods->sum('pivot.work_time_minutes');
                    $hours = floor($totalMinutes / 60);
                    $minutes = $totalMinutes % 60;
                @endphp
                <div class="mt-4 pt-4 border-t border-gray-200">
                    <div class="flex justify-between text-sm">
                        <span class="text-gray-600">Temps de travail total:</span>
                        <span class="font-semibold text-gray-900">
                            @if ($hours > 0)
                                {{ $hours }}h {{ $minutes }}min
                            @else
                                {{ $minutes }} min
                            @endif
                        </span>
                    </div>
                    <div class="flex justify-between text-sm mt-1">
                        <span class="text-gray-600">Total mods/accessoires:</span>
                        <span class="font-semibold text-gray-900">
                            {{ number_format($console->mods->sum('pivot.price_applied'), 2) }} €
                        </span>
                    </div>
                </div>
            @else
                <p class="text-gray-500 text-center py-8">Aucun mod ou accessoire associé.</p>
            @endif
        </div>

        {{-- Ajouter un mod --}}
        <div class="bg-white shadow rounded-lg p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Ajouter un Mod / Accessoire</h3>

            <form action="{{ route('repairer.consoles.add-mod', $console) }}" method="POST" class="space-y-4">
                @csrf

                <div>
                    <label for="mod_id" class="block text-sm font-medium text-gray-700 mb-1">
                        Mod / Accessoire / Opération *
                    </label>
                    <select name="mod_id" id="mod_id" required
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                        <option value="">— Sélectionner —</option>
                        
                        @if ($repairerMods->count())
                            <optgroup label="📦 Mon stock">
                                @foreach ($repairerMods as $mod)
                                    @unless ($console->mods->contains($mod->id))
                                        <option value="{{ $mod->id }}" data-price="{{ $mod->purchase_price }}" data-operation="{{ $mod->is_operation ? '1' : '0' }}">
                                            {{ $mod->name }} 
                                            ({{ $mod->is_operation ? 'Op.' : ($mod->is_accessory ? 'Acc.' : 'Mod') }})
                                            @if(!$mod->is_operation)— {{ number_format($mod->purchase_price, 2) }} €@endif
                                            — Stock: {{ $mod->pivot->quantity }}
                                        </option>
                                    @endunless
                                @endforeach
                            </optgroup>
                        @endif

                        @if ($operations->count())
                            <optgroup label="🔧 Opérations (mes compétences)">
                                @foreach ($operations as $mod)
                                    @unless ($console->mods->contains($mod->id))
                                        <option value="{{ $mod->id }}" data-price="0" data-operation="1">
                                            {{ $mod->name }}
                                        </option>
                                    @endunless
                                @endforeach
                            </optgroup>
                        @else
                            <optgroup label="🔧 Opérations" disabled>
                                <option disabled>Aucune compétence assignée</option>
                            </optgroup>
                        @endif
                        
                        @if ($mods->count())
                            <optgroup label="🔩 Mods (pièces)">
                                @foreach ($mods as $mod)
                                    @unless ($console->mods->contains($mod->id) || $repairerMods->contains($mod->id))
                                        <option value="{{ $mod->id }}" data-price="{{ $mod->purchase_price }}" data-operation="0">
                                            {{ $mod->name }}
                                            — {{ number_format($mod->purchase_price, 2) }} €
                                        </option>
                                    @endunless
                                @endforeach
                            </optgroup>
                        @endif

                        @if ($accessories->count())
                            <optgroup label="📦 Accessoires">
                                @foreach ($accessories as $mod)
                                    @unless ($console->mods->contains($mod->id) || $repairerMods->contains($mod->id))
                                        <option value="{{ $mod->id }}" data-price="{{ $mod->purchase_price }}" data-operation="0">
                                            {{ $mod->name }}
                                            — {{ number_format($mod->purchase_price, 2) }} €
                                        </option>
                                    @endunless
                                @endforeach
                            </optgroup>
                        @endif
                    </select>
                    
                    @if ($operations->isEmpty())
                        <p class="text-xs text-amber-600 mt-1">⚠️ Vous n'avez pas de compétences opérationnelles assignées. Contactez l'administrateur.</p>
                    @endif
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="price_applied" class="block text-sm font-medium text-gray-700 mb-1">
                            Prix appliqué (€)
                        </label>
                        <input type="number" step="0.01" min="0" name="price_applied" id="price_applied"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="Auto">
                        <p class="text-xs text-gray-500 mt-1">Laisser vide = prix par défaut (0 pour opérations)</p>
                    </div>

                    <div>
                        <label for="work_time_minutes" class="block text-sm font-medium text-gray-700 mb-1">
                            Temps de travail (min)
                        </label>
                        <input type="number" min="0" name="work_time_minutes" id="work_time_minutes"
                               class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                               placeholder="0">
                    </div>
                </div>

                <div>
                    <label for="notes" class="block text-sm font-medium text-gray-700 mb-1">
                        Notes
                    </label>
                    <textarea name="notes" id="notes" rows="2"
                              class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                              placeholder="Notes sur l'installation..."></textarea>
                </div>

                <button type="submit"
                        class="w-full py-2 px-4 bg-indigo-600 text-white font-medium rounded-md hover:bg-indigo-700 transition">
                    Ajouter
                </button>
            </form>
        </div>
    </div>

    {{-- Commentaire réparateur --}}
    <div class="bg-white shadow rounded-lg p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-900 mb-4">Commentaire Réparateur</h3>

        <form action="{{ route('repairer.consoles.update-mods', $console) }}" method="POST">
            @csrf
            @method('PUT')

            {{-- Garder les mods existants --}}
            @foreach ($console->mods as $mod)
                <input type="hidden" name="mods[{{ $loop->index }}][mod_id]" value="{{ $mod->id }}">
                <input type="hidden" name="mods[{{ $loop->index }}][price_applied]" value="{{ $mod->pivot->price_applied }}">
                <input type="hidden" name="mods[{{ $loop->index }}][notes]" value="{{ $mod->pivot->notes }}">
                <input type="hidden" name="mods[{{ $loop->index }}][work_time_minutes]" value="{{ $mod->pivot->work_time_minutes }}">
            @endforeach

            <div>
                <textarea name="commentaire_reparateur" rows="4"
                          class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                          placeholder="Remarques, observations, état de l'article...">{{ old('commentaire_reparateur', $console->commentaire_reparateur) }}</textarea>
            </div>

            <div class="mt-4">
                <button type="submit"
                        class="py-2 px-4 bg-green-600 text-white font-medium rounded-md hover:bg-green-700 transition">
                    Enregistrer le commentaire
                </button>
            </div>
        </form>
    </div>

</div>
@endsection

@push('scripts')
<script>
    // Auto-fill price when selecting a mod
    document.getElementById('mod_id').addEventListener('change', function() {
        const selected = this.options[this.selectedIndex];
        const price = selected.dataset.price;
        if (price) {
            document.getElementById('price_applied').placeholder = price + ' €';
        }
    });
</script>
@endpush
