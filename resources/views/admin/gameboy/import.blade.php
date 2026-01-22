<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Import Game Boy Games</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <div class="mb-6">
                <a href="{{ route('admin.dashboard') }}" class="text-blue-600 hover:text-blue-800">
                    ← Retour au dashboard
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow rounded-lg">
                <div class="px-6 py-8">
                    
                    <h1 class="text-3xl font-bold text-gray-900 mb-6">
                        Import Game Boy Games
                    </h1>
                    
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            ✅ {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            ❌ {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-8 p-4 bg-blue-50 rounded-lg">
                        <h3 class="text-lg font-semibold mb-2">📊 Statut de la base de données</h3>
                        <p class="text-gray-700">
                            Jeux Game Boy actuellement en base : 
                            <span class="text-2xl font-bold text-blue-600">{{ $gamesCount }}</span>
                        </p>
                    </div>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-8">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-6 w-6 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>⚠️ Attention :</strong> Le scraping peut prendre jusqu'à 30 secondes. 
                                    Ne fermez pas cette page pendant l'import.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="mb-8">
                        <h3 class="text-lg font-semibold mb-3">📚 Sources de données</h3>
                        <ul class="list-disc list-inside text-gray-600 space-y-2 ml-4">
                            <li>Game Boy Database Hardware (gbhwdb.gekkio.fi)</li>
                            <li>Full-set Game Boy ROM list</li>
                        </ul>
                    </div>

                    <form method="POST" action="{{ route('admin.gameboy.import.run') }}" 
                          onsubmit="return confirm('🎮 Lancer le scraping des jeux Game Boy ?\n\n⏱️ Cela peut prendre 30 secondes.\n\n✅ Cliquez sur OK pour continuer.');">
                        @csrf
                        <button type="submit" 
                                class="inline-flex items-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white text-lg font-semibold rounded-lg shadow-lg transition duration-150 ease-in-out transform hover:scale-105">
                            <svg class="w-6 h-6 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                            </svg>
                            🎮 Lancer l'import Game Boy
                        </button>
                    </form>

                    @if($gamesCount > 0)
                        <p class="text-sm text-gray-500 mt-6 p-4 bg-gray-50 rounded">
                            💡 <strong>Note :</strong> L'import va compléter ou mettre à jour la base existante. Les doublons seront automatiquement ignorés.
                        </p>
                    @endif

                </div>
            </div>
        </div>
    </div>
</body>
</html>
