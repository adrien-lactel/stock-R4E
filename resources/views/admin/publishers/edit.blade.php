<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer {{ $publisher->name }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 p-6">
    <div class="max-w-2xl mx-auto bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Éditer : {{ $publisher->name }}</h1>
        
        <form action="{{ route('admin.publishers.update', $publisher) }}" method="POST" class="space-y-4">
            @csrf
            @method('PUT')
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Nom</label>
                <input type="text" name="name" value="{{ $publisher->name }}" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Logo (URL)</label>
                <input type="text" name="logo" value="{{ $publisher->logo }}" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500"
                    placeholder="images/taxonomy/editeurs/konami.svg">
                @if($publisher->logo)
                <div class="mt-2">
                    <img src="{{ $publisher->logo_url }}" alt="{{ $publisher->name }}" class="h-16">
                </div>
                @endif
            </div>
            
            <div>
                <label class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                <textarea name="description" rows="3" 
                    class="w-full border border-gray-300 rounded px-3 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">{{ $publisher->description }}</textarea>
            </div>
            
            <div class="flex gap-2 pt-4">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-colors">
                    💾 Enregistrer
                </button>
                <button type="button" onclick="window.parent.closePublisherEditModal()" 
                    class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400 transition-colors">
                    ✖️ Annuler
                </button>
            </div>
        </form>
    </div>
    
    @if(session('success'))
    <script>
        alert('✅ {{ session('success') }}');
        if (window.parent && window.parent.closePublisherEditModal) {
            window.parent.closePublisherEditModal();
            window.parent.location.reload();
        }
    </script>
    @endif
</body>
</html>
