<?php
/**
 * Script temporaire pour importer wonderswan_games sur Railway
 * URL: https://web-production-f3333.up.railway.app/import-wonderswan.php
 * ⚠️ SUPPRIMER CE FICHIER APRÈS UTILISATION!
 */

// Charger Laravel
require __DIR__.'/../vendor/autoload.php';
$app = require_once __DIR__.'/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

header('Content-Type: text/html; charset=utf-8');

echo "<!DOCTYPE html><html><head><meta charset='utf-8'><title>Import WonderSwan Games</title></head><body>";
echo "<h1>🎮 Import WonderSwan Color Games</h1>";
echo "<pre style='background:#f5f5f5; padding:20px; border-radius:8px;'>";

try {
    // Vérifier si la table existe déjà
    $tableExists = DB::select("SHOW TABLES LIKE 'wonderswan_games'");
    
    if (!empty($tableExists)) {
        $count = DB::table('wonderswan_games')->count();
        echo "✅ Table wonderswan_games existe déjà avec $count jeux\n\n";
        
        // Afficher quelques exemples
        $samples = DB::table('wonderswan_games')
            ->select('id', 'name', 'publisher', 'year')
            ->orderBy('name')
            ->limit(10)
            ->get();
        
        echo "📋 Exemples de jeux:\n";
        foreach ($samples as $game) {
            echo sprintf("  - %s (%s, %s)\n", 
                $game->name, 
                $game->publisher ?? 'N/A', 
                $game->year ?? 'N/A'
            );
        }
        
        echo "\n✨ Import déjà effectué! Vous pouvez supprimer ce fichier.\n";
        
    } else {
        // Lire le fichier SQL
        $sqlFile = __DIR__.'/../wonderswan_games_clean.sql';
        
        if (!file_exists($sqlFile)) {
            throw new Exception("❌ Fichier wonderswan_games_clean.sql introuvable!");
        }
        
        echo "📁 Lecture du fichier SQL...\n";
        $sql = File::get($sqlFile);
        $fileSize = round(strlen($sql) / 1024, 2);
        echo "   Taille: {$fileSize} KB\n\n";
        
        echo "⚙️  Création de la table...\n";
        
        // Exécuter le SQL
        DB::unprepared($sql);
        
        // Vérifier le résultat
        $count = DB::table('wonderswan_games')->count();
        
        echo "✅ Table créée avec succès!\n";
        echo "📊 Nombre de jeux importés: $count\n\n";
        
        // Afficher quelques exemples
        $samples = DB::table('wonderswan_games')
            ->select('name', 'publisher', 'year')
            ->orderBy('name')
            ->limit(5)
            ->get();
        
        echo "📋 Exemples de jeux:\n";
        foreach ($samples as $game) {
            echo sprintf("  - %s (%s, %s)\n", 
                $game->name, 
                $game->publisher ?? 'N/A', 
                $game->year ?? 'N/A'
            );
        }
        
        echo "\n✨ Import terminé avec succès!\n";
        echo "⚠️  N'oubliez pas de supprimer ce fichier (import-wonderswan.php)\n";
    }
    
} catch (Exception $e) {
    echo "❌ ERREUR:\n";
    echo $e->getMessage() . "\n\n";
    echo "Stack trace:\n";
    echo $e->getTraceAsString();
}

echo "</pre></body></html>";
