// Autocomplétion jeux (ROM ID + nom)
let gameDebounceTimer = null;
let currentGameSuggestionIndex = -1;

window.onGameInput = function() {
  clearTimeout(gameDebounceTimer);
  const input = document.getElementById('game-search');
  if (!input) return;
  
  const value = input.value.trim();
  
  if (value.length < 2) {
    clearGameSuggestions();
    return;
  }
  
  gameDebounceTimer = setTimeout(() => {
    fetchGameSuggestions(value);
  }, 300);
};

async function fetchGameSuggestions(query) {
  const platform = document.getElementById('game-platform')?.value || 'gameboy';
  
  // Construire l'URL avec fallback si non définie
  const baseUrl = window.ajaxSearchGameUrl || (window.location.origin + '/admin/ajax/search-game');
  
  try {
    const url = baseUrl + `?platform=${platform}&query=${encodeURIComponent(query)}`;
    const response = await fetch(url);
    const data = await response.json();
    
    if (data.success && data.games && data.games.length > 0) {
      displayGameSuggestions(data.games);
    } else {
      clearGameSuggestions();
    }
  } catch (error) {
    console.error('Erreur suggestions jeux:', error);
  }
}

function displayGameSuggestions(games) {
  const suggestionsDiv = document.getElementById('game-suggestions');
  if (!suggestionsDiv) return;
  
  const platform = document.getElementById('game-platform')?.value || 'gameboy';
  currentGameSuggestionIndex = -1;
  
  suggestionsDiv.innerHTML = '';
  
  games.forEach((game, index) => {
    const div = document.createElement('div');
    div.className = 'suggestion-item flex items-center gap-3 px-3 py-2 hover:bg-blue-50 cursor-pointer border-b last:border-b-0';
    div.setAttribute('data-index', index);
    div.setAttribute('data-game-json', btoa(encodeURIComponent(JSON.stringify(game))));
    div.onclick = function() { selectGameSuggestionFromData(this); };
    
    // Miniature d'image
    if (game.image_url) {
      const imgWrapper = document.createElement('div');
      imgWrapper.className = 'flex-shrink-0 w-12 h-12 bg-gray-100 rounded overflow-hidden';
      
      const img = document.createElement('img');
      img.src = game.image_url;
      img.alt = game.name;
      img.className = 'w-full h-full object-cover';
      img.onerror = function() {
        // Si l'image ne charge pas, afficher un placeholder
        this.parentElement.innerHTML = '<div class="w-full h-full flex items-center justify-center text-gray-400 text-xs">🎮</div>';
      };
      
      imgWrapper.appendChild(img);
      div.appendChild(imgWrapper);
    }
    
    const contentDiv = document.createElement('div');
    contentDiv.className = 'flex-1 min-w-0';
    
    const gameName = document.createElement('div');
    gameName.className = 'font-semibold text-sm text-gray-900 truncate';
    gameName.textContent = game.name;
    
    const gameMetadata = document.createElement('div');
    gameMetadata.className = 'flex items-center gap-2 text-xs text-gray-500 mt-0.5';
    
    // ROM ID avec badge
    if (game.rom_id) {
      const romIdBadge = document.createElement('span');
      romIdBadge.className = 'inline-flex items-center px-2 py-0.5 rounded bg-blue-100 text-blue-800 font-mono text-xs';
      romIdBadge.textContent = game.rom_id;
      gameMetadata.appendChild(romIdBadge);
    }
    
    // Région si disponible
    if (game.region) {
      const regionBadge = document.createElement('span');
      regionBadge.className = 'inline-flex items-center px-2 py-0.5 rounded bg-gray-100 text-gray-600 text-xs';
      const regionEmoji = game.region === 'Japan' ? '🇯🇵' : game.region === 'USA' ? '🇺🇸' : game.region === 'Europe' ? '🇪🇺' : '🌍';
      regionBadge.textContent = `${regionEmoji} ${game.region}`;
      gameMetadata.appendChild(regionBadge);
    }
    
    contentDiv.appendChild(gameName);
    contentDiv.appendChild(gameMetadata);
    div.appendChild(contentDiv);
    suggestionsDiv.appendChild(div);
  });
  
  suggestionsDiv.classList.remove('hidden');
  suggestionsDiv.style.display = 'block';
}

window.selectGameSuggestionFromData = function(element) {
  const gameJson = element.getAttribute('data-game-json');
  const game = JSON.parse(decodeURIComponent(atob(gameJson)));
  const identifier = game.rom_id || game.slug || game.name || '';
  document.getElementById('game-search').value = identifier;
  clearGameSuggestions();
  
  if (window.displayGameResult) {
    const platform = document.getElementById('game-platform')?.value || 'gameboy';
    window.displayGameResult(game, platform);
  }
};

window.clearGameSuggestions = function() {
  const suggestionsDiv = document.getElementById('game-suggestions');
  if (!suggestionsDiv) return;
  suggestionsDiv.innerHTML = '';
  suggestionsDiv.classList.add('hidden');
  currentGameSuggestionIndex = -1;
};

window.onGameKeydown = function(e) {
  const suggestions = document.querySelectorAll('#game-suggestions .suggestion-item');
  
  if (e.key === 'Enter') {
    e.preventDefault();
    if (currentGameSuggestionIndex >= 0 && suggestions.length > 0) {
      suggestions[currentGameSuggestionIndex].click();
    }
    return;
  }
  
  if (suggestions.length === 0) return;
  
  if (e.key === 'ArrowDown') {
    e.preventDefault();
    currentGameSuggestionIndex = Math.min(currentGameSuggestionIndex + 1, suggestions.length - 1);
    highlightGameSuggestion();
  } else if (e.key === 'ArrowUp') {
    e.preventDefault();
    currentGameSuggestionIndex = Math.max(currentGameSuggestionIndex - 1, 0);
    highlightGameSuggestion();
  } else if (e.key === 'Escape') {
    clearGameSuggestions();
  }
};

function highlightGameSuggestion() {
  const suggestions = document.querySelectorAll('#game-suggestions .suggestion-item');
  suggestions.forEach((el, idx) => {
    if (idx === currentGameSuggestionIndex) {
      el.classList.add('bg-blue-100');
      el.scrollIntoView({ block: 'nearest' });
    } else {
      el.classList.remove('bg-blue-100');
    }
  });
}

// Fermer les suggestions en cliquant ailleurs
document.addEventListener('click', function(e) {
  if (!e.target.closest('#game-search') && !e.target.closest('#game-suggestions')) {
    clearGameSuggestions();
  }
});
