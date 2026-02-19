<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║              NETTOYAGE FINAL - SUPPRESSION DOUBLONS                       ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

// Supprimer le doublon Harobots
DB::table('wonderswan_games')->where('id', 359)->delete();
echo "✓ Supprimé: Harobots (Japan) ID 359 (doublon)\n";

// Vérifier qu'il n'y a plus de doublons
$duplicates = DB::select("
    SELECT name, COUNT(*) as count, GROUP_CONCAT(id ORDER BY id) as ids
    FROM wonderswan_games
    GROUP BY name
    HAVING count > 1
");

if (count($duplicates) > 0) {
    echo "\n⚠️  Doublons restants:\n\n";
    foreach ($duplicates as $dup) {
        echo "  '{$dup->name}' : IDs {$dup->ids}\n";
    }
} else {
    echo "\n✅ Aucun doublon restant!\n";
}

$total = DB::table('wonderswan_games')->count();
echo "\n📊 Total de jeux en base: {$total}\n\n";

echo "💡 VÉRIFICATION FINALE:\n";
echo "   php verify-all-platforms-images.php\n\n";
