// Test rapide pour vérifier le problème SHVC-YI
// Copier/coller ce code dans la console du navigateur sur la page /admin/articles/create

console.clear();
console.log('🧪 TEST SHVC-YI - DIAGNOSTIC COMPLET');
console.log('=' .repeat(60));

// Simuler un objet game comme retourné par la recherche
const testGames = [
    {
        id: 1,
        name: "SHVC-YI - Super Mario World 2: Yoshi's Island",
        rom_id: null,
        slug: null,
        platform: 'snes'
    },
    {
        id: 2,
        name: "Super Mario World 2: Yoshi's Island",
        rom_id: 'SHVC-YI',
        slug: null,
        platform: 'snes'
    },
    {
        id: 3,
        name: "SHVC-YI - Yoshi's Island",
        rom_id: 'SHVC-YI',
        slug: null,
        platform: 'snes'
    }
];

function extractRomIdFromName(name) {
    if (!name) return null;
    const match = name.match(/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i);
    if (match) {
        return match[1].toUpperCase();
    }
    return null;
}

testGames.forEach(game => {
    console.log(`\n📦 Test Game ID ${game.id}:`);
    console.log(`   name: "${game.name}"`);
    console.log(`   rom_id (champ): ${game.rom_id || 'null'}`);
    
    // Simuler la logique de getLocalGameImage
    let identifier = game.rom_id;
    if (!identifier && game.name) {
        identifier = extractRomIdFromName(game.name);
        console.log(`   ➡️ ROM ID extrait du nom: ${identifier}`);
    }
    if (!identifier) {
        identifier = game.slug;
        console.log(`   ➡️ Fallback sur slug: ${identifier || 'null'}`);
    }
    
    console.log(`   ✅ Identifier final: ${identifier || 'null'}`);
    
    if (identifier) {
        const folder = 'snes';
        const isProduction = window.location.hostname !== 'localhost';
        const r2Url = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev';
        const baseUrl = isProduction ? r2Url + '/taxonomy' : '/proxy/images/taxonomy';
        
        const coverUrl = `${baseUrl}/${folder}/${identifier}-cover.png`;
        console.log(`   🖼️ URL cover: ${coverUrl}`);
        
        // Tester l'image
        const img = new Image();
        img.onload = () => console.log(`   ✅ Cover EXISTE sur R2`);
        img.onerror = () => console.log(`   ❌ Cover N'EXISTE PAS sur R2`);
        img.src = coverUrl;
    } else {
        console.log(`   ❌ Impossible de générer l'URL - pas d'identifier`);
    }
});

console.log('\n' + '='.repeat(60));
console.log('💡 Pour tester avec votre jeu réel:');
console.log('1. Recherchez "Yoshi" ou "SHVC-YI" dans le formulaire');
console.log('2. Ouvrez la console réseau (F12 > Network)');
console.log('3. Vérifiez les requêtes vers R2');
console.log('4. Regardez les 404 pour voir quelle URL est appelée');
