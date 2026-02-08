<?php
/**
 * Script pour uploader les images WonderSwan, Mega Drive et Sega Saturn vers R2
 * 
 * Usage: php upload-consoles-images-r2.php
 */

require __DIR__ . '/vendor/autoload.php';

use Illuminate\Support\Facades\Storage;

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Upload des images vers R2\n";
echo "=========================\n\n";

$platforms = [
    'wonderswan color' => 'wonderswan_games',
    'megadrive' => 'mega_drive_games',
    'segasaturn' => 'sega_saturn_games',
    'gamegear' => 'game_gear_games'
];

$totalUploaded = 0;
$totalSkipped = 0;
$totalErrors = 0;

foreach ($platforms as $folder => $table) {
    echo "📦 Plateforme: {$folder}\n";
    
    // Récupérer tous les jeux
    $games = DB::table($table)->get();
    echo "   {$games->count()} jeux trouvés\n";
    
    if ($games->isEmpty()) {
        echo "   ⏭️  Aucun jeu\n\n";
        continue;
    }
    
    $uploaded = 0;
    $skipped = 0;
    $errors = 0;
    
    foreach ($games as $game) {
        // Nom du fichier basé sur le nom du jeu (retirer extensions)
        $cleanName = $game->name;
        $cleanName = preg_replace('/\.(ws|md|bin|gg)$/i', '', $cleanName);
        $cleanName = trim($cleanName);
        
        $imageTypes = ['cover', 'logo', 'artwork'];
        
        foreach ($imageTypes as $type) {
            $imageFileName = "{$cleanName}-{$type}.png";
            $r2Path = "taxonomy/{$folder}/{$imageFileName}";
            
            // Vérifier si l'image existe déjà sur R2
            if (Storage::disk('r2')->exists($r2Path)) {
                $skipped++;
                continue;
            }
            
            // Chercher l'image en local
            $localPath = public_path("images/taxonomy/{$folder}/{$imageFileName}");
            
            if (file_exists($localPath)) {
                try {
                    // Upload vers R2
                    $contents = file_get_contents($localPath);
                    Storage::disk('r2')->put($r2Path, $contents, 'public');
                    
                    echo "   ✅ {$imageFileName}\n";
                    $uploaded++;
                } catch (\Exception $e) {
                    echo "   ❌ Erreur {$imageFileName}: {$e->getMessage()}\n";
                    $errors++;
                }
            }
        }
    }
    
    $totalUploaded += $uploaded;
    $totalSkipped += $skipped;
    $totalErrors += $errors;
    
    echo "   📊 Uploadées: {$uploaded}, Ignorées: {$skipped}, Erreurs: {$errors}\n\n";
}

echo "✅ Terminé!\n";
echo "   Total uploadées: {$totalUploaded}\n";
echo "   Total ignorées: {$totalSkipped}\n";
echo "   Total erreurs: {$totalErrors}\n";
