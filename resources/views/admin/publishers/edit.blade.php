<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éditer {{ $publisher->name }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                
                <!-- Zone de drag & drop -->
                <div id="dropzone" class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-500 transition-colors cursor-pointer">
                    <div id="drop-preview">
                        @if($publisher->logo)
                        <img id="logo-preview" src="{{ $publisher->logo_url }}" alt="{{ $publisher->name }}" class="h-32 mx-auto mb-3">
                        @else
                        <svg class="mx-auto h-12 w-12 text-gray-400 mb-3" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        <img id="logo-preview" src="" alt="" class="hidden h-32 mx-auto mb-3">
                        @endif
                        <p class="text-sm text-gray-600">Glissez une image ici ou cliquez pour parcourir</p>
                        <p class="text-xs text-gray-500 mt-1">PNG, SVG, JPG (max 2MB)</p>
                    </div>
                    <input type="file" id="file-input" accept="image/*" class="hidden">
                </div>
                
                <input type="hidden" name="logo" id="logo-path" value="{{ $publisher->logo }}">
                
                <div id="upload-progress" class="hidden mt-2">
                    <div class="bg-blue-100 rounded-full h-2">
                        <div id="progress-bar" class="bg-blue-600 h-2 rounded-full transition-all" style="width: 0%"></div>
                    </div>
                    <p class="text-xs text-gray-600 mt-1">Upload en cours...</p>
                </div>
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
        }
    </script>
    @endif
    
    <script>
    // Drag & Drop pour le logo
    const dropzone = document.getElementById('dropzone');
    const fileInput = document.getElementById('file-input');
    const logoPreview = document.getElementById('logo-preview');
    const logoPath = document.getElementById('logo-path');
    const uploadProgress = document.getElementById('upload-progress');
    const progressBar = document.getElementById('progress-bar');
    
    // Clic pour ouvrir le sélecteur de fichier
    dropzone.addEventListener('click', () => fileInput.click());
    
    // Empêcher le comportement par défaut
    ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, preventDefaults, false);
    });
    
    function preventDefaults(e) {
        e.preventDefault();
        e.stopPropagation();
    }
    
    // Highlight au survol
    ['dragenter', 'dragover'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => {
            dropzone.classList.add('border-blue-500', 'bg-blue-50');
        });
    });
    
    ['dragleave', 'drop'].forEach(eventName => {
        dropzone.addEventListener(eventName, () => {
            dropzone.classList.remove('border-blue-500', 'bg-blue-50');
        });
    });
    
    // Gérer le drop
    dropzone.addEventListener('drop', (e) => {
        const files = e.dataTransfer.files;
        if (files.length) handleFile(files[0]);
    });
    
    // Gérer la sélection de fichier
    fileInput.addEventListener('change', (e) => {
        if (e.target.files.length) handleFile(e.target.files[0]);
    });
    
    function handleFile(file) {
        // Vérifier le type
        if (!file.type.startsWith('image/')) {
            alert('❌ Veuillez sélectionner une image');
            return;
        }
        
        // Vérifier la taille (2MB)
        if (file.size > 2 * 1024 * 1024) {
            alert('❌ L\'image est trop lourde (max 2MB)');
            return;
        }
        
        // Prévisualiser
        const reader = new FileReader();
        reader.onload = (e) => {
            logoPreview.src = e.target.result;
            logoPreview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
        
        // Uploader
        uploadFile(file);
    }
    
    function uploadFile(file) {
        const formData = new FormData();
        formData.append('image', file);
        formData.append('publisher_id', '{{ $publisher->id }}');
        formData.append('_token', '{{ csrf_token() }}');
        
        uploadProgress.classList.remove('hidden');
        
        fetch('{{ route('admin.publishers.upload-logo') }}', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                logoPath.value = data.logo_path;
                progressBar.style.width = '100%';
                setTimeout(() => {
                    uploadProgress.classList.add('hidden');
                    progressBar.style.width = '0%';
                }, 500);
                
                // Notifier le parent (formulaire principal) que le logo a été mis à jour
                if (window.parent !== window) {
                    window.parent.postMessage({
                        type: 'publisher-logo-updated',
                        publisherId: '{{ $publisher->id }}',
                        publisherName: '{{ $publisher->name }}',
                        logoPath: data.logo_path
                    }, '*');
                }
            } else {
                alert('❌ Erreur: ' + (data.error || 'Upload échoué'));
                uploadProgress.classList.add('hidden');
            }
        })
        .catch(error => {
            alert('❌ Erreur lors de l\'upload');
            console.error(error);
            uploadProgress.classList.add('hidden');
        });
    }
    </script>
</body>
</html>
