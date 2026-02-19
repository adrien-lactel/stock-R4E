<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║         CORRECTION FINALE WONDERSWAN - & vs _ ET DOUBLONS                 ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Corrections à faire
$corrections = [
    ['old' => 'Gomoku Narabe & Reversi - Touryuumon', 'new' => 'Gomoku Narabe _ Reversi - Touryuumon'],
    ['old' => 'Rockman & Forte - Mirai Kara no Chousensha', 'new' => 'Rockman _ Forte - Mirai Kara no Chousensha'],
];

echo "📝 Corrections de noms:\n\n";

DB::beginTransaction();

try {
    foreach ($corrections as $correction) {
        // Vérifier si l'ancien nom existe
        $game = DB::table('wonderswan_games')
            ->where('name', $correction['old'])
            ->first();
        
        if ($game) {
            DB::table('wonderswan_games')
                ->where('id', $game->id)
                ->update(['name' => $correction['new']]);
            
            echo "  ✓ ID {$game->id}: '{$correction['old']}' → '{$correction['new']}'\n";
        } else {
            echo "  ⚠️  '{$correction['old']}' non trouvé\n";
        }
    }
    
    // Supprimer les doublons qui viennent d'être créés
    echo "\n🔍 Recherche de doublons...\n\n";
    
    $duplicates = DB::select("
        SELECT name, COUNT(*) as count, GROUP_CONCAT(id) as ids
        FROM wonderswan_games
        WHERE name IN (
            'Digimon Adventure - Anode Tamer (Japan)',
            'Digimon Adventure 02 - Tag Tamers (Japan)', 
            'Super Robot Taisen Compact (Japan)'
        )
        GROUP BY name
        HAVING count > 1
    ");
    
    foreach ($duplicates as $dup) {
        $ids = explode(',', $dup->ids);
        // Garder le premier, supprimer les autres
        $keepId = $ids[0];
        $deleteIds = array_slice($ids, 1);
        
        echo "  Doublon: '{$dup->name}'\n";
        echo "    Garder ID {$keepId}\n";
        
        foreach ($deleteIds as $deleteId) {
            DB::table('wonderswan_games')->where('id', $deleteId)->delete();
            echo "    Supprimer ID {$deleteId}\n";
        }
        echo "\n";
    }
    
    DB::commit();
    
    $total = DB::table('wonderswan_games')->count();
    
    echo "══════════════════════════════════════════════════════════════════════════════\n";
    echo "✅ CORRECTIONS APPLIQUÉES\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    echo "📊 Total en base: {$total}\n\n";
    
    echo "💡 VÉRIFICATION FINALE:\n";
    echo "   php verify-all-platforms-images.php\n\n";
    
} catch (\Exception $e) {
    DB::rollBack();
    
    echo "\n❌ ERREUR: " . $e->getMessage() . "\n\n";
    exit(1);
}
