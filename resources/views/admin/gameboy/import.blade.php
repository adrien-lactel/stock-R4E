<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Import Game Boy Games') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded">
                            {{ session('error') }}
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-lg font-semibold mb-2">Statut de la base de données</h3>
                        <p class="text-gray-600">
                            Jeux Game Boy actuellement en base : 
                            <span class="font-bold text-blue-600">{{ $gamesCount }}</span>
                        </p>
                    </div>

                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    <strong>Attention :</strong> Le scraping peut prendre jusqu'à 30 secondes. 
                                    Ne fermez pas cette page pendant l'import.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-semibold mb-2">Sources de données</h3>
                            <ul class="list-disc list-inside text-gray-600 space-y-1">
                                <li>Game Boy Database Hardware (gbhwdb.gekkio.fi)</li>
                                <li>Full-set Game Boy ROM list</li>
                            </ul>
                        </div>

                        <form method="POST" action="{{ route('admin.gameboy.import.run') }}" 
                              onsubmit="return confirm('Lancer le scraping des jeux Game Boy ? Cela peut prendre 30 secondes.');">
                            @csrf
                            <button type="submit" 
                                    class="inline-flex items-center px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-semibold rounded-lg transition duration-150 ease-in-out">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Lancer l'import Game Boy
                            </button>
                        </form>

                        @if($gamesCount > 0)
                            <p class="text-sm text-gray-500 mt-4">
                                💡 L'import va compléter ou mettre à jour la base existante. Les doublons seront ignorés.
                            </p>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
