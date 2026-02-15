<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== ANALYSE DE LA STRUCTURE SNES_GAMES ===\n\n";

// 1. Vérifier la structure de la table
echo "1️⃣ Structure de la table snes_games:\n";
try {
    $columns = DB::select("SHOW COLUMNS FROM snes_games");
    
    echo "\n  Colonnes:\n";
    foreach ($columns as $column) {
        echo "    - {$column->Field} ({$column->Type})\n";
    }
} catch (Exception $e) {
    echo "  ❌ Erreur: " . $e->getMessage() . "\n";
}

// 2. Analyser quelques exemples de données
echo "\n2️⃣ Exemples de données (10 premiers jeux):\n\n";
try {
    $games = DB::table('snes_games')
        ->select('id', 'rom_id', 'name')
        ->limit(10)
        ->get();
    
    foreach ($games as $game) {
        echo "  ID {$game->id}:\n";
        echo "    rom_id: " . ($game->rom_id ?? 'NULL') . "\n";
        echo "    name: " . ($game->name ?? 'NULL') . "\n";
        
        // Vérifier si le nom contient le ROM ID
        if ($game->name && $game->rom_id) {
            $nameContainsRomId = stripos($game->name, $game->rom_id) !== false;
            echo "    ⚠️ Nom contient ROM ID: " . ($nameContainsRomId ? 'OUI' : 'NON') . "\n";
        } elseif ($game->name && !$game->rom_id) {
            // Le ROM ID est peut-être dans le nom
            preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $game->name, $matches);
            if ($matches) {
                echo "    ⚠️ ROM ID détecté dans le nom: {$matches[1]}\n";
                echo "    ⚠️ Vrai nom du jeu: {$matches[2]}\n";
            }
        }
        echo "\n";
    }
} catch (Exception $e) {
    echo "  ❌ Erreur: " . $e->getMessage() . "\n";
}

// 3. Statistiques
echo "3️⃣ Statistiques:\n\n";
try {
    $total = DB::table('snes_games')->count();
    $withRomId = DB::table('snes_games')->whereNotNull('rom_id')->count();
    $withoutRomId = DB::table('snes_games')->whereNull('rom_id')->count();
    
    echo "  Total de jeux: {$total}\n";
    echo "  Avec rom_id: {$withRomId} (" . round(($withRomId / $total) * 100, 2) . "%)\n";
    echo "  Sans rom_id: {$withoutRomId} (" . round(($withoutRomId / $total) * 100, 2) . "%)\n\n";
    
    // Analyser le format des noms
    echo "4️⃣ Analyse du format des noms:\n\n";
    
    $namesWithPattern = 0;
    $namesWithoutPattern = 0;
    
    $allGames = DB::table('snes_games')->select('name', 'rom_id')->get();
    
    foreach ($allGames as $game) {
        if ($game->name) {
            preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $game->name, $matches);
            if ($matches) {
                $namesWithPattern++;
            } else {
                $namesWithoutPattern++;
            }
        }
    }
    
    echo "  Noms avec pattern 'ROM_ID - Nom': {$namesWithPattern} (" . round(($namesWithPattern / $total) * 100, 2) . "%)\n";
    echo "  Noms sans pattern: {$namesWithoutPattern} (" . round(($namesWithoutPattern / $total) * 100, 2) . "%)\n\n";
    
    // Exemples de chaque catégorie
    echo "5️⃣ Exemples par catégorie:\n\n";
    
    echo "  A) Jeux avec ROM ID séparé + nom propre:\n";
    $cleanGames = DB::table('snes_games')
        ->whereNotNull('rom_id')
        ->whereRaw("name NOT LIKE CONCAT('%', rom_id, '%')")
        ->limit(3)
        ->get(['rom_id', 'name']);
    
    if ($cleanGames->count() > 0) {
        foreach ($cleanGames as $game) {
            echo "    ✅ rom_id: {$game->rom_id}, name: {$game->name}\n";
        }
    } else {
        echo "    ❌ Aucun jeu trouvé dans cette catégorie\n";
    }
    
    echo "\n  B) Jeux avec ROM ID dans le nom (format 'ROM_ID - Nom'):\n";
    $mixedGames = DB::table('snes_games')
        ->where('name', 'LIKE', '%-%')
        ->limit(3)
        ->get(['rom_id', 'name']);
    
    foreach ($mixedGames as $game) {
        preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9\-]+?)\s*-\s*(.+)$/i', $game->name, $matches);
        if ($matches) {
            echo "    ⚠️ rom_id (colonne): " . ($game->rom_id ?? 'NULL') . "\n";
            echo "       rom_id (dans nom): {$matches[1]}\n";
            echo "       nom du jeu: {$matches[2]}\n\n";
        }
    }
    
    echo "\n  C) Jeux sans ROM ID du tout:\n";
    $noRomIdGames = DB::table('snes_games')
        ->whereNull('rom_id')
        ->limit(3)
        ->get(['name']);
    
    if ($noRomIdGames->count() > 0) {
        foreach ($noRomIdGames as $game) {
            echo "    ⚠️ name: {$game->name}\n";
        }
    } else {
        echo "    ✅ Tous les jeux ont un ROM ID\n";
    }
    
} catch (Exception $e) {
    echo "  ❌ Erreur: " . $e->getMessage() . "\n";
}

echo "\n" . str_repeat('=', 60) . "\n";
echo "💡 RECOMMANDATIONS:\n";
echo str_repeat('=', 60) . "\n\n";

echo "Si les ROM IDs sont dans les noms (format 'SHVC-XX - Game Name'):\n";
echo "  1. Créer une migration pour nettoyer les données\n";
echo "  2. Extraire le ROM ID du nom vers la colonne rom_id\n";
echo "  3. Ne garder que le nom du jeu dans la colonne name\n\n";

echo "Voulez-vous que je génère un script de nettoyage? (y/n)\n";
