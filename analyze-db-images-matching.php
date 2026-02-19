<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║          ANALYSE COMPLÈTE: BASES DE DONNÉES ↔ FICHIERS IMAGES               ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

// Configuration des plateformes
$platforms = [
    'gameboy' => [
        'table' => 'game_boy_games',
        'folder' => 'public/images/taxonomy/gameboy',
        'identifier_field' => 'rom_id', // Champ qui doit correspondre au nom de fichier
    ],
    'snes' => [
        'table' => 'snes_games',
        'folder' => 'public/images/taxonomy/snes',
        'identifier_field' => 'rom_id',
    ],
    'wonderswan' => [
        'table' => 'wonderswan_games',
        'folder' => 'public/images/taxonomy/wonderswan',
        'identifier_field' => 'rom_id',
    ],
    'megadrive' => [
        'table' => 'mega_drive_games',
        'folder' => 'public/images/taxonomy/megadrive',
        'identifier_field' => 'rom_id',
    ],
    'gamegear' => [
        'table' => 'game_gear_games',
        'folder' => 'public/images/taxonomy/gamegear',
        'identifier_field' => 'rom_id',
    ],
    'nes' => [
        'table' => 'nes_games',
        'folder' => 'public/images/taxonomy/nes',
        'identifier_field' => 'rom_id',
    ],
    'n64' => [
        'table' => 'n64_games',
        'folder' => 'public/images/taxonomy/n64',
        'identifier_field' => 'rom_id',
    ],
];

$totalIssues = 0;
$sqlUpdates = [];

foreach ($platforms as $platform => $config) {
    echo "\n" . str_repeat('═', 80) . "\n";
    echo "🎮 PLATEFORME: " . strtoupper($platform) . "\n";
    echo str_repeat('═', 80) . "\n\n";
    
    // 1. Vérifier si la table existe
    try {
        $gameCount = DB::table($config['table'])->count();
    } catch (\Exception $e) {
        echo "⚠️ Table '{$config['table']}' introuvable, ignorée.\n";
        continue;
    }
    
    echo "📊 Jeux en base: {$gameCount}\n";
    
    // 2. Lister les fichiers d'images
    $imagePath = $config['folder'];
    if (!file_exists($imagePath)) {
        echo "⚠️ Dossier d'images '{$imagePath}' introuvable\n";
        continue;
    }
    
    $allImages = glob($imagePath . '/*.png');
    echo "📁 Fichiers images: " . count($allImages) . "\n\n";
    
    // 3. Analyser les noms de fichiers
    $imagePatterns = [];
    $invalidFiles = [];
    
    foreach ($allImages as $imagePath) {
        $filename = basename($imagePath);
        
        // Pattern 1: ROM-ID-type.png (standard)
        if (preg_match('/^([A-Z0-9\-]+)-(cover|logo|artwork|gameplay|display\d+)\.png$/i', $filename, $matches)) {
            $identifier = $matches[1];
            $type = strtolower($matches[2]);
            
            if (!isset($imagePatterns[$identifier])) {
                $imagePatterns[$identifier] = [
                    'format' => 'standard',
                    'identifier' => $identifier,
                    'types' => []
                ];
            }
            $imagePatterns[$identifier]['types'][] = $type;
        }
        // Pattern 2: ROM-ID - Nom Du Jeu-type.png (étendu)
        elseif (preg_match('/^([A-Z0-9\-]+)\s+-\s+(.+?)-(cover|logo|artwork|gameplay|display\d+)\.png$/i', $filename, $matches)) {
            $identifier = $matches[1];
            $gameName = $matches[2];
            $type = strtolower($matches[3]);
            
            if (!isset($imagePatterns[$identifier])) {
                $imagePatterns[$identifier] = [
                    'format' => 'extended',
                    'identifier' => $identifier,
                    'game_name' => $gameName,
                    'types' => []
                ];
            }
            $imagePatterns[$identifier]['types'][] = $type;
        }
        else {
            $invalidFiles[] = $filename;
        }
    }
    
    echo "📋 RÉSUMÉ FICHIERS:\n";
    echo "   ✅ Identifiants uniques: " . count($imagePatterns) . "\n";
    echo "   ❌ Fichiers mal nommés: " . count($invalidFiles) . "\n\n";
    
    if (count($invalidFiles) > 0) {
        echo "   Exemples de fichiers invalides (5 premiers):\n";
        foreach (array_slice($invalidFiles, 0, 5) as $file) {
            $short = strlen($file) > 70 ? substr($file, 0, 70) . '...' : $file;
            echo "     • {$short}\n";
        }
        echo "\n";
    }
    
    // 4. Récupérer les jeux de la base
    $games = DB::table($config['table'])
        ->select('id', 'rom_id', 'name')
        ->whereNotNull('rom_id')
        ->where('rom_id', '!=', '')
        ->get();
    
    echo "🔍 ANALYSE DE CORRESPONDANCE:\n\n";
    
    // 5. Trouver les correspondances et incohérences
    $perfectMatches = [];
    $dbWithoutImages = [];
    $imagesWithoutDb = [];
    $namesMismatch = [];
    
    // Créer un index rapide par rom_id
    $gamesById = [];
    foreach ($games as $game) {
        $gamesById[$game->rom_id] = $game;
    }
    
    // Vérifier chaque identifiant dans les images
    foreach ($imagePatterns as $identifier => $imageData) {
        if (isset($gamesById[$identifier])) {
            // Correspondance trouvée!
            $game = $gamesById[$identifier];
            
            // Si le fichier contient le nom du jeu, vérifier la cohérence
            if ($imageData['format'] === 'extended') {
                $fileGameName = $imageData['game_name'];
                $dbGameName = $game->name;
                
                if ($fileGameName !== $dbGameName) {
                    $namesMismatch[] = [
                        'identifier' => $identifier,
                        'db_name' => $dbGameName,
                        'file_name' => $fileGameName,
                        'game_id' => $game->id
                    ];
                }
            }
            
            $perfectMatches[] = $identifier;
        } else {
            $imagesWithoutDb[] = [
                'identifier' => $identifier,
                'format' => $imageData['format'],
                'game_name' => $imageData['game_name'] ?? null,
                'types' => $imageData['types']
            ];
        }
    }
    
    // Jeux en DB sans images
    foreach ($games as $game) {
        if (!isset($imagePatterns[$game->rom_id])) {
            $dbWithoutImages[] = [
                'rom_id' => $game->rom_id,
                'name' => $game->name,
                'id' => $game->id
            ];
        }
    }
    
    // 6. Afficher les résultats
    echo "   ✅ Correspondances parfaites: " . count($perfectMatches) . "\n";
    echo "   ⚠️  Noms incohérents (DB ≠ fichier): " . count($namesMismatch) . "\n";
    echo "   📷 Images sans entrée en DB: " . count($imagesWithoutDb) . "\n";
    echo "   🗃️  Jeux en DB sans images: " . count($dbWithoutImages) . "\n\n";
    
    $totalIssues += count($namesMismatch) + count($imagesWithoutDb) + count($dbWithoutImages);
    
    // 7. Détails des incohérences de noms
    if (count($namesMismatch) > 0) {
        echo "   🔧 NOMS INCOHÉRENTS (10 premiers):\n";
        foreach (array_slice($namesMismatch, 0, 10) as $mismatch) {
            echo "      • ROM ID: {$mismatch['identifier']}\n";
            echo "        Base:    \"{$mismatch['db_name']}\"\n";
            echo "        Fichier: \"{$mismatch['file_name']}\"\n";
            
            // Proposer une requête SQL pour corriger
            $sqlUpdates[] = [
                'platform' => $platform,
                'table' => $config['table'],
                'query' => "UPDATE {$config['table']} SET name = " . DB::connection()->getPdo()->quote($mismatch['file_name']) . " WHERE id = {$mismatch['game_id']};",
                'description' => "Corriger le nom du jeu {$mismatch['identifier']}"
            ];
            echo "\n";
        }
    }
    
    // 8. Images sans entrée DB
    if (count($imagesWithoutDb) > 0) {
        echo "   📷 IMAGES SANS ENTRÉE DB (10 premiers):\n";
        foreach (array_slice($imagesWithoutDb, 0, 10) as $orphan) {
            $gameName = $orphan['game_name'] ?? 'Nom inconnu';
            echo "      • ROM ID: {$orphan['identifier']}\n";
            echo "        Nom (fichier): {$gameName}\n";
            echo "        Types: " . implode(', ', $orphan['types']) . "\n";
            
            // Proposer une insertion
            if ($orphan['format'] === 'extended' && $orphan['game_name']) {
                $sqlUpdates[] = [
                    'platform' => $platform,
                    'table' => $config['table'],
                    'query' => "INSERT INTO {$config['table']} (rom_id, name) VALUES (" . 
                              DB::connection()->getPdo()->quote($orphan['identifier']) . ", " .
                              DB::connection()->getPdo()->quote($orphan['game_name']) . ");",
                    'description' => "Ajouter le jeu {$orphan['identifier']}"
                ];
            }
            echo "\n";
        }
    }
    
    // 9. Jeux sans images
    if (count($dbWithoutImages) > 0) {
        echo "   🗃️  JEUX SANS IMAGES (10 premiers):\n";
        foreach (array_slice($dbWithoutImages, 0, 10) as $missing) {
            echo "      • ROM ID: {$missing['rom_id']}\n";
            echo "        Nom: {$missing['name']}\n";
            echo "        💡 Fichiers attendus: {$missing['rom_id']}-cover.png, -logo.png, etc.\n\n";
        }
    }
}

// RAPPORT FINAL
echo "\n" . str_repeat('═', 80) . "\n";
echo "📊 RAPPORT FINAL\n";
echo str_repeat('═', 80) . "\n\n";

echo "Total d'incohérences détectées: {$totalIssues}\n";
echo "Requêtes SQL générées: " . count($sqlUpdates) . "\n\n";

if (count($sqlUpdates) > 0) {
    $sqlFile = 'fix-database-images-matching.sql';
    echo "💾 Génération du fichier SQL: {$sqlFile}\n\n";
    
    $sqlContent = "-- Script de correction automatique\n";
    $sqlContent .= "-- Généré le " . date('Y-m-d H:i:s') . "\n";
    $sqlContent .= "-- Total de " . count($sqlUpdates) . " modifications\n\n";
    
    foreach ($platforms as $platform => $config) {
        $platformUpdates = array_filter($sqlUpdates, function($u) use ($platform) {
            return $u['platform'] === $platform;
        });
        
        if (count($platformUpdates) > 0) {
            $sqlContent .= "\n-- " . strtoupper($platform) . " (" . count($platformUpdates) . " modifications)\n";
            $sqlContent .= str_repeat('-', 80) . "\n\n";
            
            foreach ($platformUpdates as $update) {
                $sqlContent .= "-- {$update['description']}\n";
                $sqlContent .= $update['query'] . "\n\n";
            }
        }
    }
    
    file_put_contents($sqlFile, $sqlContent);
    echo "✅ Fichier SQL créé avec succès!\n\n";
    
    echo "📝 INSTRUCTIONS:\n";
    echo "   1. Vérifiez le contenu de '{$sqlFile}'\n";
    echo "   2. Exécutez les requêtes dans votre base de données:\n";
    echo "      php artisan db:sql < {$sqlFile}\n";
    echo "   3. Relancez ce script pour vérifier\n\n";
}

echo "✨ Analyse terminée!\n";
