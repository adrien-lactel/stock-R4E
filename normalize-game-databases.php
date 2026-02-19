<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║              NORMALISATION DES BASES DE DONNÉES - ROM ID                     ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

echo "🎯 OBJECTIF: Ajouter des ROM IDs cohérents dans toutes les bases de jeux\n";
echo "   pour permettre une recherche d'images uniforme.\n\n";

// Plateformes à normaliser (celles sans ROM ID fiable)
$platformsToNormalize = [
    'wonderswan' => [
        'table' => 'wonderswan_games',
        'folder' => 'public/images/taxonomy/wonderswan',
        'name_field' => 'name',
    ],
    'gamegear' => [
        'table' => 'game_gear_games',
        'folder' => 'public/images/taxonomy/gamegear',
        'name_field' => 'name',
    ],
    'megadrive' => [
        'table' => 'mega_drive_games',
        'folder' => 'public/images/taxonomy/megadrive',
        'name_field' => 'name',
    ],
];

$sqlUpdates = [];
$totalUpdates = 0;

foreach ($platformsToNormalize as $platform => $config) {
    echo "\n" . str_repeat('═', 80) . "\n";
    echo "🎮 PLATEFORME: " . strtoupper($platform) . "\n";
    echo str_repeat('═', 80) . "\n\n";
    
    // 1. Vérifier si la table existe
    try {
        $games = DB::table($config['table'])
            ->select('id', 'rom_id', 'name')
            ->get();
        
        echo "📊 Jeux en base: " . count($games) . "\n";
    } catch (\Exception $e) {
        echo "⚠️ Table '{$config['table']}' introuvable, ignorée.\n";
        continue;
    }
    
    // 2. Lister les fichiers d'images pour extraire les identifiants
    $imagePath = $config['folder'];
    if (!file_exists($imagePath)) {
        echo "⚠️ Dossier d'images '{$imagePath}' introuvable\n";
        continue;
    }
    
    $allImages = glob($imagePath . '/*.png');
    echo "📁 Fichiers images trouvés: " . count($allImages) . "\n\n";
    
    // 3. Extraire les identifiants depuis les noms de fichiers
    $fileIdentifiers = [];
    
    foreach ($allImages as $imagePath) {
        $filename = basename($imagePath);
        
        // Retirer les suffixes de type d'image
        $cleanName = preg_replace('/-(cover|logo|artwork|gameplay|display\d+)\.png$/i', '', $filename);
        $cleanName = preg_replace('/\s*\(cover|logo|artwork|gameplay\)\.png$/i', '', $cleanName);
        
        // Normaliser: retirer parenthèses de région, espaces multiples
        $identifier = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo)[^\)]*\)\s*/i', '', $cleanName);
        $identifier = preg_replace('/\s+/', ' ', $identifier);
        $identifier = trim($identifier);
        
        // Slugifier pour créer un ROM ID propre
        $romId = strtolower($identifier);
        $romId = preg_replace('/[^a-z0-9]+/', '-', $romId);
        $romId = trim($romId, '-');
        
        if (!isset($fileIdentifiers[$identifier])) {
            $fileIdentifiers[$identifier] = [
                'rom_id' => $romId,
                'display_name' => $identifier,
                'files' => []
            ];
        }
        
        $fileIdentifiers[$identifier]['files'][] = basename($imagePath);
    }
    
    echo "📋 Identifiants uniques extraits des fichiers: " . count($fileIdentifiers) . "\n\n";
    
    // 4. Matcher avec la base de données
    echo "🔍 MATCHING AVEC LA BASE DE DONNÉES:\n\n";
    
    $matched = 0;
    $notMatched = 0;
    $needsUpdate = 0;
    
    foreach ($games as $game) {
        $gameName = $game->name;
        $currentRomId = $game->rom_id;
        
        // Chercher une correspondance dans les identifiants extraits
        $bestMatch = null;
        $bestScore = 0;
        
        foreach ($fileIdentifiers as $identifier => $data) {
            // Calculer la similarité
            similar_text(strtolower($gameName), strtolower($identifier), $similarity);
            
            if ($similarity > $bestScore) {
                $bestScore = $similarity;
                $bestMatch = $data;
            }
        }
        
        // Si correspondance trouvée avec score > 80%
        if ($bestMatch && $bestScore > 80) {
            $matched++;
            
            // Si le jeu n'a pas de rom_id ou s'il est différent
            if (empty($currentRomId) || $currentRomId !== $bestMatch['rom_id']) {
                $needsUpdate++;
                
                $sqlUpdates[] = [
                    'platform' => $platform,
                    'table' => $config['table'],
                    'game_id' => $game->id,
                    'game_name' => $gameName,
                    'old_rom_id' => $currentRomId,
                    'new_rom_id' => $bestMatch['rom_id'],
                    'display_name' => $bestMatch['display_name'],
                    'similarity' => round($bestScore, 2)
                ];
            }
        } else {
            $notMatched++;
        }
    }
    
    echo "   ✅ Jeux matchés: {$matched}\n";
    echo "   🔄 Jeux nécessitant une mise à jour: {$needsUpdate}\n";
    echo "   ❌ Jeux non matchés: {$notMatched}\n\n";
    
    $totalUpdates += $needsUpdate;
}

// 5. Générer le fichier SQL
if (count($sqlUpdates) > 0) {
    echo "\n" . str_repeat('═', 80) . "\n";
    echo "📊 GÉNÉRATION DU SCRIPT SQL\n";
    echo str_repeat('═', 80) . "\n\n";
    
    echo "Total de mises à jour: {$totalUpdates}\n\n";
    
    // Afficher les 20 premières mises à jour pour validation
    echo "📋 APERÇU DES MODIFICATIONS (20 premières):\n\n";
    
    foreach (array_slice($sqlUpdates, 0, 20) as $update) {
        echo "   Jeu: {$update['game_name']}\n";
        echo "   ROM ID actuel: " . ($update['old_rom_id'] ?: 'NULL') . "\n";
        echo "   Nouveau ROM ID: {$update['new_rom_id']}\n";
        echo "   Similarité: {$update['similarity']}%\n\n";
    }
    
    // Créer le fichier SQL
    $sqlFile = 'normalize-game-databases.sql';
    $sqlContent = "-- Script de normalisation des ROM IDs\n";
    $sqlContent .= "-- Généré le " . date('Y-m-d H:i:s') . "\n";
    $sqlContent .= "-- Total: {$totalUpdates} mises à jour\n\n";
    $sqlContent .= "-- ATTENTION: Vérifiez les modifications avant d'exécuter!\n\n";
    
    foreach ($platformsToNormalize as $platform => $config) {
        $platformUpdates = array_filter($sqlUpdates, function($u) use ($platform) {
            return $u['platform'] === $platform;
        });
        
        if (count($platformUpdates) > 0) {
            $sqlContent .= "\n-- " . strtoupper($platform) . " (" . count($platformUpdates) . " modifications)\n";
            $sqlContent .= str_repeat('-', 80) . "\n\n";
            
            foreach ($platformUpdates as $update) {
                $sqlContent .= "-- {$update['game_name']} (similarité: {$update['similarity']}%)\n";
                $sqlContent .= "UPDATE {$update['table']} SET rom_id = " . 
                              DB::connection()->getPdo()->quote($update['new_rom_id']) . 
                              " WHERE id = {$update['game_id']};\n\n";
            }
        }
    }
    
    file_put_contents($sqlFile, $sqlContent);
    echo "✅ Fichier SQL créé: {$sqlFile}\n\n";
    
    echo "📝 PROCHAINES ÉTAPES:\n";
    echo "   1. Vérifiez le fichier '{$sqlFile}'\n";
    echo "   2. Testez sur une copie de votre base\n";
    echo "   3. Si OK, exécutez: php artisan db:seed --class=NormalizeDatabaseSeeder\n";
    echo "      Ou via MySQL: mysql -u root -p stock-R4E < {$sqlFile}\n\n";
    
} else {
    echo "\n✅ Toutes les bases sont déjà normalisées!\n";
}

echo "✨ Analyse terminée!\n";
