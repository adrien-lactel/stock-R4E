<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║     ANALYSE COMPLÈTE: IMAGES vs BASES DE DONNÉES - TOUTES PLATEFORMES       ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

// Configuration de toutes les plateformes
$platforms = [
    'Game Boy' => [
        'table' => 'game_boy_games',
        'folder' => 'public/images/taxonomy/gameboy',
        'use_rom_id' => true,
        'identifier_field' => 'rom_id',
        'rom_prefix' => 'DMG-' // Filtrer uniquement les ROM ID commençant par DMG-
    ],
    'Game Boy Color' => [
        'table' => 'game_boy_games',
        'folder' => 'public/images/taxonomy/game boy color',
        'use_rom_id' => true,
        'identifier_field' => 'rom_id',
        'rom_prefix' => 'CGB-' // Filtrer uniquement les ROM ID commençant par CGB-
    ],
    'Game Boy Advance' => [
        'table' => 'game_boy_games',
        'folder' => 'public/images/taxonomy/game boy advance',
        'use_rom_id' => true,
        'identifier_field' => 'rom_id',
        'rom_prefix' => 'AGB-' // Filtrer uniquement les ROM ID commençant par AGB-
    ],
    'SNES' => [
        'table' => 'snes_games',
        'folder' => 'public/images/taxonomy/snes',
        'use_rom_id' => true,
        'identifier_field' => 'rom_id'
    ],
    'NES' => [
        'table' => 'nes_games',
        'folder' => 'public/images/taxonomy/nes',
        'use_rom_id' => true,
        'identifier_field' => 'rom_id'
    ],
    'Nintendo 64' => [
        'table' => 'n64_games',
        'folder' => 'public/images/taxonomy/n64',
        'use_rom_id' => true,
        'identifier_field' => 'rom_id'
    ],
    'WonderSwan' => [
        'table' => 'wonderswan_games',
        'folder' => 'public/images/taxonomy/wonderswan',
        'use_rom_id' => false,
        'identifier_field' => 'name'
    ],
    'Game Gear' => [
        'table' => 'game_gear_games',
        'folder' => 'public/images/taxonomy/gamegear',
        'use_rom_id' => false,
        'identifier_field' => 'name'
    ],
    'Mega Drive' => [
        'table' => 'mega_drive_games',
        'folder' => 'public/images/taxonomy/megadrive',
        'use_rom_id' => false,
        'identifier_field' => 'name'
    ],
    'Saturn' => [
        'table' => 'saturn_games',
        'folder' => 'public/images/taxonomy/saturn',
        'use_rom_id' => false,
        'identifier_field' => 'name'
    ]
];

$allModifications = [];

foreach ($platforms as $platformName => $config) {
    echo "\n" . str_repeat('═', 80) . "\n";
    echo "🎮 PLATEFORME: {$platformName}\n";
    echo str_repeat('═', 80) . "\n\n";
    
    // Vérifier si la table existe
    try {
        $query = DB::table($config['table'])
            ->select('id', 'rom_id', 'name');
        
        // Appliquer un filtre de préfixe ROM ID si défini
        if (isset($config['rom_prefix'])) {
            $query->where('rom_id', 'LIKE', $config['rom_prefix'] . '%');
        }
        
        $gamesInDb = $query->get();
        
        echo "📊 Jeux en base: " . count($gamesInDb) . "\n";
    } catch (\Exception $e) {
        echo "⚠️ Table '{$config['table']}' introuvable, ignorée.\n";
        continue;
    }
    
    // Vérifier le dossier d'images
    if (!file_exists($config['folder'])) {
        echo "⚠️ Dossier d'images '{$config['folder']}' introuvable\n";
        echo "💡 Aucune modification nécessaire pour cette plateforme\n";
        continue;
    }
    
    $allImages = glob($config['folder'] . '/*.{png,jpg,jpeg}', GLOB_BRACE);
    echo "📁 Fichiers images: " . count($allImages) . "\n\n";
    
    // Extraire les identifiants des fichiers
    $imageIdentifiers = [];
    
    foreach ($allImages as $imagePath) {
        $filename = basename($imagePath);
        
        // Extraire l'identifiant selon le type de plateforme
        if ($config['use_rom_id']) {
            // Format: ROM-ID-type.png (ex: DMG-AFX-cover.png)
            if (preg_match('/^([A-Z0-9\-]+)-(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
                $identifier = $matches[1];
                $type = strtolower($matches[2]);
                
                // Si un préfixe ROM est défini, vérifier que l'identifiant correspond
                if (isset($config['rom_prefix']) && !str_starts_with($identifier, $config['rom_prefix'])) {
                    continue; // Ignorer les images qui ne correspondent pas au préfixe de cette plateforme
                }
                
                if (!isset($imageIdentifiers[$identifier])) {
                    $imageIdentifiers[$identifier] = [
                        'types' => [],
                        'files' => []
                    ];
                }
                $imageIdentifiers[$identifier]['types'][] = $type;
                $imageIdentifiers[$identifier]['files'][] = $filename;
            }
        } else {
            // Format: Nom Du Jeu (Region)-type.png ou Nom Du Jeu-type.png
            // Pattern 1: avec tiret
            if (preg_match('/^(.+?)-(cover|logo|artwork|gameplay|display\d+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
                $identifier = trim($matches[1]);
                $type = strtolower($matches[2]);
                
                // Nettoyer l'identifiant des infos de région (EN BOUCLE pour enlever plusieurs tags)
                do {
                    $before = $identifier;
                    $identifier = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $identifier);
                    $identifier = trim($identifier);
                } while ($before !== $identifier);
                
                if (!isset($imageIdentifiers[$identifier])) {
                    $imageIdentifiers[$identifier] = [
                        'types' => [],
                        'files' => []
                    ];
                }
                $imageIdentifiers[$identifier]['types'][] = $type;
                $imageIdentifiers[$identifier]['files'][] = $filename;
            }
            // Pattern 2: avec espace et parenthèse
            elseif (preg_match('/^(.+?)\s+\((cover|logo|artwork|gameplay)\)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
                $identifier = trim($matches[1]);
                $type = strtolower($matches[2]);
                
                // Nettoyer l'identifiant des infos de région (EN BOUCLE pour enlever plusieurs tags)
                do {
                    $before = $identifier;
                    $identifier = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $identifier);
                    $identifier = trim($identifier);
                } while ($before !== $identifier);
                
                if (!isset($imageIdentifiers[$identifier])) {
                    $imageIdentifiers[$identifier] = [
                        'types' => [],
                        'files' => []
                    ];
                }
                $imageIdentifiers[$identifier]['types'][] = $type;
                $imageIdentifiers[$identifier]['files'][] = $filename;
            }
        }
    }
    
    echo "🔍 Identifiants uniques trouvés dans les images: " . count($imageIdentifiers) . "\n\n";
    
    // Créer un index des jeux en base
    $dbIndex = [];
    foreach ($gamesInDb as $game) {
        if ($config['use_rom_id']) {
            if (!empty($game->rom_id)) {
                $dbIndex[$game->rom_id] = $game;
            }
        } else {
            // Pour les plateformes sans ROM ID, indexer par nom nettoyé
            // Nettoyer EN BOUCLE pour enlever plusieurs tags
            $cleanName = $game->name;
            do {
                $before = $cleanName;
                $cleanName = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $cleanName);
                $cleanName = trim($cleanName);
            } while ($before !== $cleanName);
            
            $dbIndex[$cleanName] = $game;
        }
    }
    
    // Analyser les correspondances
    $imagesWithoutDb = [];
    $dbWithoutImages = [];
    $matched = 0;
    
    // Images sans entrée en base
    foreach ($imageIdentifiers as $identifier => $data) {
        if (!isset($dbIndex[$identifier])) {
            $imagesWithoutDb[] = [
                'identifier' => $identifier,
                'types' => array_unique($data['types']),
                'files' => $data['files']
            ];
        } else {
            $matched++;
        }
    }
    
    // Jeux en base sans images
    foreach ($dbIndex as $identifier => $game) {
        if (!isset($imageIdentifiers[$identifier])) {
            $dbWithoutImages[] = [
                'identifier' => $identifier,
                'game' => $game
            ];
        }
    }
    
    echo "✅ Correspondances parfaites: {$matched}\n";
    echo "📷 Images sans entrée en base: " . count($imagesWithoutDb) . "\n";
    echo "🗃️  Jeux en base sans images: " . count($dbWithoutImages) . "\n\n";
    
    // Préparer les modifications
    $modifications = [];
    
    // 1. Jeux à AJOUTER en base (car ils ont des images mais pas d'entrée)
    if (count($imagesWithoutDb) > 0) {
        echo "📝 JEUX À AJOUTER EN BASE (" . count($imagesWithoutDb) . "):\n\n";
        
        foreach (array_slice($imagesWithoutDb, 0, 20) as $item) {
            $identifier = $item['identifier'];
            $types = implode(', ', $item['types']);
            
            echo "   • Identifiant: {$identifier}\n";
            echo "     Types d'images: {$types}\n";
            echo "     Fichiers: " . count($item['files']) . "\n";
            
            if ($config['use_rom_id']) {
                $modifications[] = [
                    'action' => 'INSERT',
                    'table' => $config['table'],
                    'data' => [
                        'rom_id' => $identifier,
                        'name' => $identifier // Nom par défaut = ROM ID
                    ],
                    'reason' => "Images disponibles mais pas d'entrée en base"
                ];
                echo "     💡 Action: INSERT INTO {$config['table']} (rom_id, name) VALUES ('{$identifier}', '{$identifier}')\n\n";
            } else {
                $modifications[] = [
                    'action' => 'INSERT',
                    'table' => $config['table'],
                    'data' => [
                        'name' => $identifier,
                        'rom_id' => strtolower(preg_replace('/[^a-z0-9]+/', '-', strtolower($identifier)))
                    ],
                    'reason' => "Images disponibles mais pas d'entrée en base"
                ];
                echo "     💡 Action: INSERT INTO {$config['table']} (name, rom_id) VALUES ('{$identifier}', ...)\n\n";
            }
        }
        
        if (count($imagesWithoutDb) > 20) {
            echo "   ... et " . (count($imagesWithoutDb) - 20) . " autres\n\n";
        }
    }
    
    // 2. Jeux en base à CORRIGER (nom ou ROM ID ne correspond pas aux images)
    if (count($dbWithoutImages) > 0) {
        echo "⚠️  JEUX EN BASE SANS IMAGES CORRESPONDANTES (" . count($dbWithoutImages) . "):\n\n";
        echo "   Ces jeux existent en base mais aucune image ne correspond.\n";
        echo "   Vérifiez si les noms/ROM IDs sont corrects.\n\n";
        
        foreach (array_slice($dbWithoutImages, 0, 15) as $item) {
            $game = $item['game'];
            
            if ($config['use_rom_id']) {
                echo "   • ROM ID en base: {$game->rom_id}\n";
                echo "     Nom: {$game->name}\n";
                echo "     💡 Images attendues: {$game->rom_id}-cover.png, -logo.png, etc.\n\n";
            } else {
                echo "   • Nom en base: {$game->name}\n";
                if ($game->rom_id) {
                    echo "     ROM ID: {$game->rom_id}\n";
                }
                echo "     💡 Images attendues: {$item['identifier']}-cover.png, etc.\n\n";
            }
        }
        
        if (count($dbWithoutImages) > 15) {
            echo "   ... et " . (count($dbWithoutImages) - 15) . " autres\n\n";
        }
    }
    
    // Sauvegarder les modifications pour cette plateforme
    if (count($modifications) > 0) {
        $allModifications[$platformName] = [
            'config' => $config,
            'modifications' => $modifications,
            'stats' => [
                'matched' => $matched,
                'to_add' => count($imagesWithoutDb),
                'without_images' => count($dbWithoutImages)
            ]
        ];
    }
    
    echo str_repeat('-', 80) . "\n";
}

// Résumé final
echo "\n" . str_repeat('═', 80) . "\n";
echo "📊 RÉSUMÉ GLOBAL\n";
echo str_repeat('═', 80) . "\n\n";

$totalModifications = 0;
foreach ($allModifications as $platform => $data) {
    $totalModifications += count($data['modifications']);
    echo "🎮 {$platform}:\n";
    echo "   Correspondances: {$data['stats']['matched']}\n";
    echo "   À ajouter: {$data['stats']['to_add']}\n";
    echo "   Sans images: {$data['stats']['without_images']}\n\n";
}

echo "Total de modifications proposées: {$totalModifications}\n\n";

if ($totalModifications > 0) {
    echo "📝 PROCHAINES ÉTAPES:\n";
    echo "   1. Vérifiez les modifications ci-dessus\n";
    echo "   2. Pour chaque plateforme, décidez quoi faire:\n";
    echo "      - Ajouter les jeux manquants en base\n";
    echo "      - Corriger les ROM IDs/noms incorrects\n";
    echo "      - Renommer les fichiers images\n";
    echo "   3. Je génèrerai le script SQL selon vos choix\n\n";
} else {
    echo "✅ Toutes les plateformes sont cohérentes!\n";
}

echo "✨ Analyse terminée!\n";
