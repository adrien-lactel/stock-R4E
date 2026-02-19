<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║           VÉRIFICATION DÉTAILLÉE - NORMALISATION ROM IDs                     ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

// Charger le fichier SQL
$sqlFile = 'normalize-game-databases.sql';
if (!file_exists($sqlFile)) {
    echo "❌ Fichier '{$sqlFile}' introuvable!\n";
    exit(1);
}

$sqlContent = file_get_contents($sqlFile);
preg_match_all('/UPDATE (\w+) SET rom_id = \'([^\']+)\' WHERE id = (\d+);/i', $sqlContent, $matches, PREG_SET_ORDER);

echo "📊 Total de modifications détectées: " . count($matches) . "\n\n";

// Grouper par table
$updatesByTable = [];
foreach ($matches as $match) {
    $table = $match[1];
    $romId = $match[2];
    $id = $match[3];
    
    if (!isset($updatesByTable[$table])) {
        $updatesByTable[$table] = [];
    }
    
    $updatesByTable[$table][] = [
        'id' => $id,
        'new_rom_id' => $romId
    ];
}

// Vérifier chaque table
$platforms = [
    'wonderswan_games' => 'WonderSwan',
    'game_gear_games' => 'Game Gear',
    'mega_drive_games' => 'Mega Drive'
];

$totalIssues = 0;
$conflicts = [];
$duplicates = [];

foreach ($platforms as $table => $platformName) {
    if (!isset($updatesByTable[$table])) {
        continue;
    }
    
    echo str_repeat('═', 80) . "\n";
    echo "🎮 {$platformName} ({$table})\n";
    echo str_repeat('═', 80) . "\n\n";
    
    $updates = $updatesByTable[$table];
    echo "Modifications prévues: " . count($updates) . "\n\n";
    
    // Récupérer les jeux actuels
    try {
        $games = DB::table($table)
            ->select('id', 'rom_id', 'name')
            ->get()
            ->keyBy('id');
    } catch (\Exception $e) {
        echo "⚠️ Table introuvable: {$table}\n\n";
        continue;
    }
    
    // Vérifier les doublons de ROM ID après mise à jour
    $futureRomIds = [];
    
    foreach ($updates as $update) {
        $id = $update['id'];
        $newRomId = $update['new_rom_id'];
        
        // Ajouter les ROM IDs futurs
        if (!isset($futureRomIds[$newRomId])) {
            $futureRomIds[$newRomId] = [];
        }
        $futureRomIds[$newRomId][] = $id;
    }
    
    // Détecter les doublons
    $hasDuplicates = false;
    foreach ($futureRomIds as $romId => $ids) {
        if (count($ids) > 1) {
            $hasDuplicates = true;
            $duplicates[] = [
                'table' => $table,
                'rom_id' => $romId,
                'game_ids' => $ids
            ];
        }
    }
    
    if ($hasDuplicates) {
        echo "⚠️  ATTENTION: ROM IDs en doublon détectés!\n\n";
        
        $platformDuplicates = array_filter($duplicates, function($d) use ($table) {
            return $d['table'] === $table;
        });
        
        foreach (array_slice($platformDuplicates, 0, 10) as $dup) {
            echo "   ROM ID: {$dup['rom_id']}\n";
            echo "   Jeux concernés:\n";
            
            foreach ($dup['game_ids'] as $gameId) {
                $game = $games->get($gameId);
                if ($game) {
                    echo "     • ID {$gameId}: {$game->name}\n";
                }
            }
            echo "\n";
        }
        
        $totalIssues += count($platformDuplicates);
    }
    
    // Exemples de modifications (10 premiers)
    echo "📋 EXEMPLES DE MODIFICATIONS (10 premiers):\n\n";
    
    foreach (array_slice($updates, 0, 10) as $update) {
        $game = $games->get($update['id']);
        if ($game) {
            $oldRomId = $game->rom_id ?: 'NULL';
            $newRomId = $update['new_rom_id'];
            
            echo "   Jeu: {$game->name}\n";
            echo "   Ancien ROM ID: {$oldRomId}\n";
            echo "   Nouveau ROM ID: {$newRomId}\n";
            
            // Vérifier si le nouveau ROM ID correspond bien au nom
            $similarity = 0;
            similar_text(strtolower($game->name), strtolower(str_replace('-', ' ', $newRomId)), $similarity);
            
            if ($similarity < 70) {
                echo "   ⚠️  Faible similarité détectée: " . round($similarity, 2) . "%\n";
                $conflicts[] = [
                    'table' => $table,
                    'id' => $update['id'],
                    'name' => $game->name,
                    'new_rom_id' => $newRomId,
                    'similarity' => round($similarity, 2)
                ];
                $totalIssues++;
            } else {
                echo "   ✅ Similarité: " . round($similarity, 2) . "%\n";
            }
            echo "\n";
        }
    }
    
    echo "\n";
}

// Résumé final
echo str_repeat('═', 80) . "\n";
echo "📊 RÉSUMÉ DE LA VÉRIFICATION\n";
echo str_repeat('═', 80) . "\n\n";

if ($totalIssues === 0) {
    echo "✅ Aucun problème détecté!\n\n";
    echo "Les modifications peuvent être appliquées en toute sécurité:\n";
    echo "   mysql -u root -p stock-R4E < {$sqlFile}\n\n";
    echo "Ou via PHP:\n";
    echo "   php artisan db:seed --class=ApplyNormalization\n\n";
} else {
    echo "⚠️  {$totalIssues} problèmes détectés!\n\n";
    
    if (count($duplicates) > 0) {
        echo "🔴 DOUBLONS DE ROM ID:\n";
        echo "   " . count($duplicates) . " ROM IDs seront partagés par plusieurs jeux\n";
        echo "   Ceci peut causer des problèmes d'affichage d'images\n\n";
        
        echo "   Solutions possibles:\n";
        echo "   1. Ajouter un suffixe au rom_id (-1, -2, etc.)\n";
        echo "   2. Utiliser un identifiant différent\n";
        echo "   3. Merger les entrées si ce sont des doublons réels\n\n";
    }
    
    if (count($conflicts) > 0) {
        echo "🟡 FAIBLES SIMILARITÉS:\n";
        echo "   " . count($conflicts) . " jeux ont une faible correspondance nom/rom_id\n";
        echo "   Vérifiez manuellement ces entrées\n\n";
        
        echo "   Exemples (5 premiers):\n";
        foreach (array_slice($conflicts, 0, 5) as $conflict) {
            echo "     • {$conflict['name']} → {$conflict['new_rom_id']} ({$conflict['similarity']}%)\n";
        }
        echo "\n";
    }
    
    echo "💡 RECOMMANDATION:\n";
    echo "   Corrigez les problèmes avant d'exécuter le script SQL\n";
    echo "   ou lancez avec --force pour ignorer les avertissements\n\n";
}

// Statistiques détaillées
echo "📈 STATISTIQUES PAR PLATEFORME:\n\n";

foreach ($platforms as $table => $platformName) {
    if (!isset($updatesByTable[$table])) {
        continue;
    }
    
    $count = count($updatesByTable[$table]);
    
    // Compter les jeux de cette table
    try {
        $total = DB::table($table)->count();
        $percentage = round(($count / $total) * 100, 1);
        
        echo "   {$platformName}:\n";
        echo "     • Jeux en base: {$total}\n";
        echo "     • ROM IDs ajoutés: {$count} ({$percentage}%)\n";
        echo "     • Jeux restants sans ROM ID: " . ($total - $count) . "\n\n";
    } catch (\Exception $e) {
        echo "   {$platformName}: Erreur de lecture\n\n";
    }
}

echo "✨ Vérification terminée!\n";
