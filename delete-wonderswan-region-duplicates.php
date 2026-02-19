<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("SUPPRESSION DES DOUBLONS SANS RÉGION", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

// Les IDs des doublons SANS région à supprimer
$duplicatesToDelete = [
    [
        'id' => 43,
        'name' => 'Digimon Adventure - Anode Tamer',
        'keep_id' => 42,
        'keep_name' => 'Digimon Adventure - Anode Tamer (Japan)'
    ],
    [
        'id' => 46,
        'name' => 'Digimon Adventure 02 - Tag Tamers',
        'keep_id' => 45,
        'keep_name' => 'Digimon Adventure 02 - Tag Tamers (Japan)'
    ],
    [
        'id' => 71,
        'name' => 'Harobots',
        'keep_id' => 70,
        'keep_name' => 'Harobots (Japan)'
    ],
    [
        'id' => 172,
        'name' => 'Super Robot Taisen Compact',
        'keep_id' => 171,
        'keep_name' => 'Super Robot Taisen Compact (Japan)'
    ]
];

DB::beginTransaction();

try {
    echo "📋 DOUBLONS À SUPPRIMER:\n";
    echo str_repeat("─", 80) . "\n";
    
    foreach ($duplicatesToDelete as $duplicate) {
        // Vérifier que les deux entrées existent
        $toDelete = DB::table('wonderswan_games')->where('id', $duplicate['id'])->first();
        $toKeep = DB::table('wonderswan_games')->where('id', $duplicate['keep_id'])->first();
        
        if ($toDelete && $toKeep) {
            echo "✅ Trouvé doublon:\n";
            echo "   ❌ ID {$duplicate['id']}: '{$toDelete->name}' (à supprimer)\n";
            echo "   ✅ ID {$duplicate['keep_id']}: '{$toKeep->name}' (à garder)\n\n";
            
            // Supprimer le doublon
            DB::table('wonderswan_games')->where('id', $duplicate['id'])->delete();
        } else {
            if (!$toDelete) {
                echo "⚠️  ID {$duplicate['id']} n'existe pas (déjà supprimé?)\n";
            }
            if (!$toKeep) {
                echo "⚠️  ID {$duplicate['keep_id']} n'existe pas!\n";
            }
            echo "\n";
        }
    }
    
    // Vérifier le nombre final
    $finalCount = DB::table('wonderswan_games')->count();
    echo str_repeat("─", 80) . "\n";
    echo "📊 Total final: {$finalCount} jeux en base\n\n";
    
    // Vérifier qu'il n'y a plus de doublons
    echo "🔍 Vérification des doublons restants...\n";
    $allGames = DB::table('wonderswan_games')->select('id', 'name')->get();
    $cleanNames = [];
    $foundDuplicates = false;
    
    foreach ($allGames as $game) {
        $cleanName = preg_replace('/\s*\((USA|Europe|Japan|World|En|Fr|De|Es|It|Brazil|Asia|Korea|Rev \d+|Proto|Beta|Sample|Demo|Alt \d+)[^\)]*\)\s*$/i', '', $game->name);
        $cleanName = trim($cleanName);
        
        if (isset($cleanNames[$cleanName])) {
            echo "   ⚠️  Doublon trouvé: '{$cleanName}'\n";
            echo "      - ID {$cleanNames[$cleanName]}: '{$allGames->where('id', $cleanNames[$cleanName])->first()->name}'\n";
            echo "      - ID {$game->id}: '{$game->name}'\n";
            $foundDuplicates = true;
        } else {
            $cleanNames[$cleanName] = $game->id;
        }
    }
    
    if (!$foundDuplicates) {
        echo "   ✅ Aucun doublon restant!\n";
    }
    
    DB::commit();
    
    echo "\n✅ SUPPRESSION TERMINÉE AVEC SUCCÈS!\n";
    
} catch (\Exception $e) {
    DB::rollBack();
    echo "\n❌ ERREUR: " . $e->getMessage() . "\n";
    echo "Transaction annulée.\n";
}

echo "\n" . str_repeat("═", 80) . "\n";
