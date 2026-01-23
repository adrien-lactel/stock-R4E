@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-6">

    <div class="mb-6">
        <a href="{{ route('admin.mods.index') }}" class="text-blue-600 hover:underline">
            ← Retour à la liste
        </a>
    </div>

    <h1 class="text-3xl font-bold mb-6">➕ Créer un Mod</h1>

    <div class="bg-white shadow rounded-lg p-6">
        <form method="POST" action="{{ route('admin.mods.store') }}">
            @csrf

            {{-- Nom --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Nom du Mod *</label>
                <input type="text" 
                       name="name" 
                       value="{{ old('name') }}"
                       required
                       class="w-full border rounded p-2 @error('name') border-red-500 @enderror"
                       placeholder="Ex: Changement ventilateur, Câble HDMI, etc.">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Icône --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Icône personnalisée</label>
                
                {{-- Champ caché pour stocker le base64 --}}
                <input type="hidden" name="icon" id="icon_input" value="{{ old('icon') }}">
                
                {{-- Upload de fichier image (caché) --}}
                <input type="file" id="icon_upload" accept="image/png,image/jpeg,image/gif" class="hidden">
                
                {{-- Icônes rapides (emojis) --}}
                <div class="mb-4">
                    <p class="text-sm font-medium mb-2">Icônes rapides :</p>
                    <div class="grid grid-cols-10 gap-2">
                        @php
                            $icons = ['🔧', '⚙️', '🔌', '🔋', '📦', '🎮', '💾', '📀', '🖥️', '⌨️', 
                                      '🖱️', '🎧', '🔊', '📱', '📺', '🎨', '🖼️', '✨', '⭐', '💡',
                                      '🔴', '🟢', '🔵', '🟡', '🟣', '🟠', '⚫', '⚪', '🟤', '📍'];
                        @endphp
                        @foreach($icons as $emoji)
                            <button type="button" 
                                    onclick="selectEmoji('{{ $emoji }}')"
                                    class="text-2xl hover:bg-gray-100 rounded p-2 transition"
                                    title="{{ $emoji }}">
                                {{ $emoji }}
                            </button>
                        @endforeach
                    </div>
                </div>
                
                {{-- Galerie des icônes R4E déjà créées --}}
                @if($r4eIcons->count() > 0)
                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-2">
                            <p class="text-sm font-medium">✨ Icônes R4E déjà créées ({{ $r4eIcons->count() }}) :</p>
                            <button type="button" 
                                    onclick="document.getElementById('r4e_gallery').classList.toggle('hidden')"
                                    class="text-xs px-3 py-1 bg-purple-100 text-purple-700 rounded hover:bg-purple-200">
                                Afficher/Masquer
                            </button>
                        </div>
                        <div id="r4e_gallery" class="hidden bg-gradient-to-br from-purple-50 to-pink-50 border-2 border-purple-200 rounded-lg p-4">
                            <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-3">
                                @foreach($r4eIcons as $existingMod)
                                    <button type="button"
                                            onclick="selectR4EIcon('{{ addslashes($existingMod->icon) }}', '{{ addslashes($existingMod->name) }}')"
                                            class="group relative bg-white rounded-lg border-2 border-purple-200 p-2 hover:border-purple-500 hover:shadow-lg transition"
                                            title="Réutiliser l'icône de {{ $existingMod->name }}">
                                        <div class="relative">
                                            <img src="{{ $existingMod->icon }}" 
                                                 alt="{{ $existingMod->name }}" 
                                                 class="w-12 h-12 mx-auto" 
                                                 style="image-rendering: pixelated;">
                                            <span class="absolute -top-1 -right-1 bg-gradient-to-r from-pink-500 to-purple-500 text-white text-xs rounded-full w-4 h-4 flex items-center justify-center">✨</span>
                                        </div>
                                        <p class="text-xs text-center text-gray-600 mt-1 truncate group-hover:text-purple-700">
                                            {{ Str::limit($existingMod->name, 12) }}
                                        </p>
                                    </button>
                                @endforeach
                            </div>
                            <p class="text-xs text-gray-500 mt-3 text-center">
                                💡 Cliquez sur une icône pour la réutiliser
                            </p>
                        </div>
                    </div>
                @endif
                
                <div class="border rounded-lg p-4 bg-gray-50">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        {{-- Canvas --}}
                        <div>
                            <p class="text-sm font-medium mb-2">Éditeur (32×32 pixels)</p>
                            <canvas id="pixel_canvas" 
                                    width="320" 
                                    height="320" 
                                    class="border-2 border-gray-300 cursor-crosshair bg-white"
                                    style="image-rendering: pixelated;"></canvas>
                            
                            <div class="mt-2 flex gap-2 flex-wrap">
                                <button type="button" 
                                        onclick="document.getElementById('icon_upload').click()"
                                        class="px-3 py-1 bg-green-500 text-white text-sm rounded hover:bg-green-600">
                                    📁 Charger image
                                </button>
                                <button type="button" 
                                        onclick="clearCanvas()"
                                        class="px-3 py-1 bg-red-500 text-white text-sm rounded hover:bg-red-600">
                                    🗑️ Effacer
                                </button>
                                <button type="button" 
                                        onclick="toggleTool()"
                                        id="tool_btn"
                                        class="px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600">
                                    ✏️ Pinceau
                                </button>
                            </div>
                        </div>
                        
                        {{-- Palette et prévisualisation --}}
                        <div>
                            <p class="text-sm font-medium mb-2">Palette de couleurs</p>
                            <div class="grid grid-cols-8 gap-1 mb-4">
                                @php
                                    $colors = ['#000000', '#FFFFFF', '#FF0000', '#00FF00', '#0000FF', '#FFFF00', '#FF00FF', '#00FFFF',
                                               '#800000', '#808080', '#008000', '#000080', '#808000', '#800080', '#008080', '#C0C0C0',
                                               '#FFA500', '#A52A2A', '#DEB887', '#5F9EA0', '#7FFF00', '#D2691E', '#FF7F50', '#6495ED'];
                                @endphp
                                @foreach($colors as $color)
                                    <button type="button" 
                                            onclick="selectColor('{{ $color }}')"
                                            class="w-8 h-8 border-2 border-gray-400 rounded hover:scale-110 transition"
                                            style="background-color: {{ $color }}"
                                            title="{{ $color }}"></button>
                                @endforeach
                            </div>
                            
                            <p class="text-sm font-medium mb-2">Prévisualisation</p>
                            
                            {{-- Zone d'affichage emoji --}}
                            <div id="emoji_preview" class="hidden mb-4 p-4 bg-gradient-to-r from-yellow-50 to-orange-50 border-2 border-yellow-300 rounded-lg text-center">
                                <p class="text-xs text-gray-600 mb-2">😀 Emoji sélectionné</p>
                                <div class="text-6xl" id="emoji_display"></div>
                            </div>
                            
                            <div id="image_preview" class="flex items-center gap-4">
                                <div class="bg-white border-2 border-gray-300 rounded p-2">
                                    <img id="preview_small" src="" alt="Prévisualisation" class="w-8 h-8" style="image-rendering: pixelated;">
                                </div>
                                <div class="bg-white border-2 border-gray-300 rounded p-2">
                                    <img id="preview_large" src="" alt="Prévisualisation" class="w-16 h-16" style="image-rendering: pixelated;">
                                </div>
                            </div>
                            
                            <p class="text-xs text-gray-600 mt-4">
                                💡 Cliquez sur le canvas pour dessiner. Utilisez la palette pour changer de couleur.
                            </p>
                        </div>
                    </div>
                </div>
                
                @error('icon')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Description *</label>
                <textarea name="description" 
                          rows="3"
                          required
                          class="w-full border rounded p-2 @error('description') border-red-500 @enderror"
                          placeholder="Description détaillée du mod ou accessoire">{{ old('description') }}</textarea>
                @error('description')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Prix et quantité --}}
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Prix d'achat (€) *</label>
                    <input type="number" 
                           step="0.01" 
                           name="purchase_price" 
                           value="{{ old('purchase_price') }}"
                           required
                           class="w-full border rounded p-2 @error('purchase_price') border-red-500 @enderror">
                    @error('purchase_price')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label class="block text-sm font-medium mb-2">Quantité en stock *</label>
                    <input type="number" 
                           name="quantity" 
                           value="{{ old('quantity', 0) }}"
                           required
                           min="0"
                           class="w-full border rounded p-2 @error('quantity') border-red-500 @enderror">
                    @error('quantity')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            {{-- Type --}}
            <div class="mb-6">
                <label class="flex items-center">
                    <input type="checkbox" 
                           name="is_accessory" 
                           value="1"
                           {{ old('is_accessory') ? 'checked' : '' }}
                           class="mr-2">
                    <span class="text-sm font-medium">📦 Ceci est un accessoire (câble, boîte, etc.)</span>
                </label>
            </div>

            {{-- Compatibilité --}}
            <div class="mb-6 border-t pt-4">
                <h3 class="text-lg font-semibold mb-3">🎯 Compatibilité</h3>
                <p class="text-sm text-gray-600 mb-4">
                    Sélectionnez les catégories/types compatibles. Laissez vide pour un mod universel.
                </p>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Catégories compatibles</label>
                    <select name="compatible_categories[]" 
                            multiple
                            class="w-full border rounded p-2"
                            size="5">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}"
                                    {{ in_array($category->id, old('compatible_categories', [])) ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <p class="text-xs text-gray-500 mt-1">Maintenez Ctrl/Cmd pour sélectionner plusieurs</p>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Sous-catégories compatibles</label>
                    <select name="compatible_sub_categories[]" 
                            multiple
                            class="w-full border rounded p-2"
                            size="5">
                        @foreach($subCategories as $subCategory)
                            <option value="{{ $subCategory->id }}"
                                    {{ in_array($subCategory->id, old('compatible_sub_categories', [])) ? 'selected' : '' }}>
                                {{ $subCategory->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium mb-2">Types compatibles</label>
                    <select name="compatible_types[]" 
                            multiple
                            class="w-full border rounded p-2"
                            size="5">
                        @foreach($types as $type)
                            <option value="{{ $type->id }}"
                                    {{ in_array($type->id, old('compatible_types', [])) ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            {{-- Boutons --}}
            <div class="flex justify-end space-x-3">
                <a href="{{ route('admin.mods.index') }}" 
                   class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400">
                    Annuler
                </a>
                <button type="submit" 
                        class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                    ✅ Créer le Mod
                </button>
            </div>
        </form>
    </div>

</div>

<script>
// Configuration de l'éditeur
const GRID_SIZE = 32;
const PIXEL_SIZE = 10; // 320px / 32 = 10px par pixel
let canvas, ctx;
let pixels = []; // Grille de pixels
let currentColor = '#000000';
let isDrawing = false;
let currentTool = 'brush'; // 'brush' ou 'eraser'

// Initialisation
document.addEventListener('DOMContentLoaded', function() {
    canvas = document.getElementById('pixel_canvas');
    ctx = canvas.getContext('2d');
    
    // Initialiser la grille vide (transparent)
    for (let i = 0; i < GRID_SIZE * GRID_SIZE; i++) {
        pixels[i] = null;
    }
    
    // Dessiner la grille initiale
    drawGrid();
    
    // Event listeners pour le dessin
    canvas.addEventListener('mousedown', startDrawing);
    canvas.addEventListener('mousemove', draw);
    canvas.addEventListener('mouseup', stopDrawing);
    canvas.addEventListener('mouseleave', stopDrawing);
    
    // Charger l'icône existante si présente
    const existingIcon = document.getElementById('icon_input').value;
    if (existingIcon && existingIcon.startsWith('data:image')) {
        loadImageFromBase64(existingIcon);
    }
    
    // Listener pour l'upload d'image
    document.getElementById('icon_upload').addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(event) {
                loadImageFromBase64(event.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
});

function drawGrid() {
    // Effacer le canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);
    
    // Dessiner les pixels
    for (let y = 0; y < GRID_SIZE; y++) {
        for (let x = 0; x < GRID_SIZE; x++) {
            const index = y * GRID_SIZE + x;
            const color = pixels[index];
            
            if (color) {
                ctx.fillStyle = color;
                ctx.fillRect(x * PIXEL_SIZE, y * PIXEL_SIZE, PIXEL_SIZE, PIXEL_SIZE);
            }
        }
    }
    
    // Grille de séparation (optionnel, légère)
    ctx.strokeStyle = '#e5e7eb';
    ctx.lineWidth = 0.5;
    for (let i = 0; i <= GRID_SIZE; i++) {
        ctx.beginPath();
        ctx.moveTo(i * PIXEL_SIZE, 0);
        ctx.lineTo(i * PIXEL_SIZE, canvas.height);
        ctx.stroke();
        
        ctx.beginPath();
        ctx.moveTo(0, i * PIXEL_SIZE);
        ctx.lineTo(canvas.width, i * PIXEL_SIZE);
        ctx.stroke();
    }
    
    updatePreview();
}

function getPixelCoords(event) {
    const rect = canvas.getBoundingClientRect();
    const x = Math.floor((event.clientX - rect.left) / PIXEL_SIZE);
    const y = Math.floor((event.clientY - rect.top) / PIXEL_SIZE);
    return { x, y };
}

function startDrawing(event) {
    isDrawing = true;
    draw(event);
}

function draw(event) {
    if (!isDrawing) return;
    
    const { x, y } = getPixelCoords(event);
    if (x >= 0 && x < GRID_SIZE && y >= 0 && y < GRID_SIZE) {
        const index = y * GRID_SIZE + x;
        
        if (currentTool === 'brush') {
            pixels[index] = currentColor;
        } else {
            pixels[index] = null; // Effacer
        }
        
        drawGrid();
    }
}

function stopDrawing() {
    isDrawing = false;
}

function selectColor(color) {
    currentColor = color;
    currentTool = 'brush'; // Revenir au pinceau automatiquement
    updateToolButton();
}

function selectEmoji(emoji) {
    // Stocker directement l'emoji (pas de conversion en base64)
    document.getElementById('icon_input').value = emoji;
    
    // Effacer le canvas pour éviter la confusion
    for (let i = 0; i < pixels.length; i++) {
        pixels[i] = null;
    }
    drawGrid();
    
    // Afficher l'emoji dans la zone de prévisualisation
    document.getElementById('emoji_display').textContent = emoji;
    document.getElementById('emoji_preview').classList.remove('hidden');
    document.getElementById('image_preview').classList.add('hidden');
}

function selectR4EIcon(iconBase64, modName) {
    // Charger l'icône R4E sélectionnée
    loadImageFromBase64(iconBase64);
    
    // Notification visuelle
    const gallery = document.getElementById('r4e_gallery');
    if (gallery) {
        const originalBg = gallery.className;
        gallery.className = gallery.className.replace('from-purple-50', 'from-green-50').replace('to-pink-50', 'to-green-100');
        
        setTimeout(() => {
            gallery.className = originalBg;
        }, 500);
    }
}

function toggleTool() {
    currentTool = currentTool === 'brush' ? 'eraser' : 'brush';
    updateToolButton();
}

function updateToolButton() {
    const btn = document.getElementById('tool_btn');
    if (currentTool === 'brush') {
        btn.textContent = '✏️ Pinceau';
        btn.className = 'px-3 py-1 bg-blue-500 text-white text-sm rounded hover:bg-blue-600';
    } else {
        btn.textContent = '🧹 Gomme';
        btn.className = 'px-3 py-1 bg-gray-500 text-white text-sm rounded hover:bg-gray-600';
    }
}

function clearCanvas() {
    if (confirm('Voulez-vous vraiment effacer toute l\'icône ?')) {
        for (let i = 0; i < pixels.length; i++) {
            pixels[i] = null;
        }
        drawGrid();
    }
}

function updatePreview() {
    // Masquer l'emoji et afficher l'image
    document.getElementById('emoji_preview').classList.add('hidden');
    document.getElementById('image_preview').classList.remove('hidden');
    
    // Créer un canvas temporaire pour l'export
    const tempCanvas = document.createElement('canvas');
    tempCanvas.width = GRID_SIZE;
    tempCanvas.height = GRID_SIZE;
    const tempCtx = tempCanvas.getContext('2d');
    
    // Dessiner uniquement les pixels (sans grille)
    for (let y = 0; y < GRID_SIZE; y++) {
        for (let x = 0; x < GRID_SIZE; x++) {
            const index = y * GRID_SIZE + x;
            const color = pixels[index];
            
            if (color) {
                tempCtx.fillStyle = color;
                tempCtx.fillRect(x, y, 1, 1);
            }
        }
    }
    
    // Exporter en base64
    const base64 = tempCanvas.toDataURL('image/png');
    
    // Mettre à jour le champ caché
    document.getElementById('icon_input').value = base64;
    
    // Mettre à jour les prévisualisations
    document.getElementById('preview_small').src = base64;
    document.getElementById('preview_large').src = base64;
}

function loadImageFromBase64(base64) {
    const img = new Image();
    img.onload = function() {
        const tempCanvas = document.createElement('canvas');
        tempCanvas.width = GRID_SIZE;
        tempCanvas.height = GRID_SIZE;
        const tempCtx = tempCanvas.getContext('2d');
        
        // Redimensionner l'image à 32x32
        tempCtx.drawImage(img, 0, 0, GRID_SIZE, GRID_SIZE);
        
        // Extraire les pixels
        const imageData = tempCtx.getImageData(0, 0, GRID_SIZE, GRID_SIZE);
        for (let i = 0; i < GRID_SIZE * GRID_SIZE; i++) {
            const r = imageData.data[i * 4];
            const g = imageData.data[i * 4 + 1];
            const b = imageData.data[i * 4 + 2];
            const a = imageData.data[i * 4 + 3];
            
            if (a > 0) {
                pixels[i] = `rgb(${r}, ${g}, ${b})`;
            } else {
                pixels[i] = null;
            }
        }
        
        drawGrid();
        
        // Mettre à jour les prévisualisations immédiatement
        document.getElementById('preview_small').src = base64;
        document.getElementById('preview_large').src = base64;
        document.getElementById('icon_input').value = base64;
    };
    img.src = base64;
}
</script>
@endsection
