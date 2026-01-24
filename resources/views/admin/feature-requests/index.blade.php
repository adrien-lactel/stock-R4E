@extends('layouts.app')

@section('header')
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        🐛 Bugs & Demandes d'évolution
    </h2>
@endsection

@section('content')
    <div class="py-12 bg-gray-900 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            {{-- Stats --}}
            <div class="grid grid-cols-2 md:grid-cols-6 gap-4">
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-blue-400">{{ $stats['total'] }}</div>
                    <div class="text-sm text-gray-400">Total</div>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-yellow-400">{{ $stats['pending'] }}</div>
                    <div class="text-sm text-gray-400">En attente</div>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-indigo-400">{{ $stats['in_progress'] }}</div>
                    <div class="text-sm text-gray-400">En cours</div>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-green-400">{{ $stats['completed'] }}</div>
                    <div class="text-sm text-gray-400">Terminées</div>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-red-400">{{ $stats['bugs'] }}</div>
                    <div class="text-sm text-gray-400">Bugs</div>
                </div>
                <div class="bg-gray-800 border border-gray-700 rounded-lg p-4 text-center">
                    <div class="text-2xl font-bold text-purple-400">{{ $stats['features'] }}</div>
                    <div class="text-sm text-gray-400">Évolutions</div>
                </div>
            </div>

            {{-- Formulaire de création --}}
            <div class="bg-gray-800 border border-gray-700 rounded-lg p-6">
                <h3 class="text-lg font-semibold text-gray-200 mb-4">➕ Nouvelle demande</h3>
                
                <form method="POST" action="{{ route('admin.feature-requests.store') }}" class="space-y-4">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Type</label>
                            <select name="type" required class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200">
                                <option value="bug">🐛 Bug</option>
                                <option value="feature">✨ Évolution</option>
                            </select>
                        </div>
                        
                        <div>
                            <label class="block text-sm font-medium text-gray-300 mb-1">Priorité</label>
                            <select name="priority" required class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200">
                                <option value="low">🟢 Basse</option>
                                <option value="medium" selected>🟡 Moyenne</option>
                                <option value="high">🔴 Haute</option>
                            </select>
                        </div>
                        
                        <div class="flex items-end">
                            <button type="submit" class="w-full px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md font-medium">
                                Créer la demande
                            </button>
                        </div>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Titre</label>
                        <input type="text" name="title" required maxlength="255" 
                               class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200"
                               placeholder="Ex: Erreur lors de l'ajout d'un mod">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-300 mb-1">Description</label>
                        <textarea name="description" required rows="3" 
                                  class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200"
                                  placeholder="Décrivez le bug ou la fonctionnalité demandée..."></textarea>
                    </div>
                </form>
            </div>

            {{-- Liste des demandes --}}
            <div class="bg-gray-800 border border-gray-700 rounded-lg overflow-hidden">
                <table class="min-w-full divide-y divide-gray-700">
                    <thead class="bg-gray-900">
                        <tr>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Type</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Titre</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Description</th>
                            <th class="px-4 py-3 text-left text-xs font-medium text-gray-400 uppercase">Réponse Admin</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Priorité</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Statut</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Créé par</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Date</th>
                            <th class="px-4 py-3 text-center text-xs font-medium text-gray-400 uppercase">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @forelse($requests as $req)
                            <tr class="hover:bg-gray-750 transition">
                                <td class="px-4 py-3 text-center">
                                    @if($req->type === 'bug')
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-red-100 text-red-800">
                                            🐛 Bug
                                        </span>
                                    @else
                                        <span class="inline-flex items-center px-2 py-1 rounded text-xs font-semibold bg-purple-100 text-purple-800">
                                            ✨ Évolution
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm font-medium text-gray-200">{{ $req->title }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    <div class="text-sm text-gray-400 max-w-md truncate">{{ $req->description }}</div>
                                </td>
                                <td class="px-4 py-3">
                                    @if($req->admin_response)
                                        <div class="text-sm text-green-400">
                                            <div class="font-medium">💬 {{ Str::limit($req->admin_response, 80) }}</div>
                                            <div class="text-xs text-gray-500 mt-1">{{ $req->responded_at?->diffForHumans() }}</div>
                                        </div>
                                    @else
                                        <button onclick="openResponseModal({{ $req->id }}, '{{ addslashes($req->title) }}')" 
                                                class="text-xs text-blue-400 hover:text-blue-300">
                                            ➕ Répondre
                                        </button>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    @if($req->priority === 'high')
                                        <span class="text-red-400">🔴 Haute</span>
                                    @elseif($req->priority === 'medium')
                                        <span class="text-yellow-400">🟡 Moyenne</span>
                                    @else
                                        <span class="text-green-400">🟢 Basse</span>
                                    @endif
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form method="POST" action="{{ route('admin.feature-requests.update-status', $req) }}" class="inline">
                                        @csrf
                                        @method('PATCH')
                                        <select name="status" onchange="this.form.submit()" 
                                                class="rounded text-xs border-0 
                                                @if($req->status === 'pending') bg-yellow-100 text-yellow-800
                                                @elseif($req->status === 'in_progress') bg-indigo-100 text-indigo-800
                                                @else bg-green-100 text-green-800 @endif">
                                            <option value="pending" @selected($req->status === 'pending')>⏳ En attente</option>
                                            <option value="in_progress" @selected($req->status === 'in_progress')>🔄 En cours</option>
                                            <option value="completed" @selected($req->status === 'completed')>✅ Terminé</option>
                                        </select>
                                    </form>
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-400">
                                    {{ $req->creator->name ?? 'N/A' }}
                                </td>
                                <td class="px-4 py-3 text-center text-sm text-gray-400">
                                    {{ $req->created_at->format('d/m/Y') }}
                                </td>
                                <td class="px-4 py-3 text-center">
                                    <form method="POST" action="{{ route('admin.feature-requests.destroy', $req) }}" 
                                          onsubmit="return confirm('Supprimer cette demande ?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-400 hover:text-red-300">
                                            🗑️
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="px-4 py-8 text-center text-gray-500">
                                    Aucune demande pour le moment
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Modal de réponse --}}
    <div id="responseModal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-gray-800 border border-gray-700 rounded-lg p-6 max-w-lg w-full mx-4">
            <h3 class="text-lg font-semibold text-gray-200 mb-4">💬 Répondre à la demande</h3>
            <div class="text-sm text-gray-400 mb-4" id="responseModalTitle"></div>
            
            <form id="responseForm" method="POST">
                @csrf
                <textarea name="admin_response" rows="4" required
                          class="w-full rounded-md bg-gray-700 border-gray-600 text-gray-200 mb-4"
                          placeholder="Votre réponse..."></textarea>
                
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeResponseModal()" 
                            class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-md">
                        Annuler
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-md">
                        Envoyer la réponse
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openResponseModal(requestId, title) {
            document.getElementById('responseModalTitle').textContent = title;
            document.getElementById('responseForm').action = `{{ url('admin/feature-requests') }}/${requestId}/response`;
            document.getElementById('responseModal').classList.remove('hidden');
        }

        function closeResponseModal() {
            document.getElementById('responseModal').classList.add('hidden');
        }

        // Fermer avec Escape
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeResponseModal();
        });
    </script>
@endsection
