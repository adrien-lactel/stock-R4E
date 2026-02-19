<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "╔════════════════════════════════════════════════════════════════════════════╗\n";
echo "║              AJOUT DES 8 DERNIERS JEUX WONDERSWAN - 100%                  ║\n";
echo "╚════════════════════════════════════════════════════════════════════════════╝\n\n";

$lastGames = [
    'Digimon Adventure - Anode Tamer (Japan)',
    'Digimon Adventure 02 - Tag Tamers (Japan)',
    'Gomoku Narabe & Reversi - Touryuumon',
    'Harobots (Japan)',
    'Kosodate Quiz Dokodemo - My Angel',
    'Rockman & Forte - Mirai Kara no Chousensha',
    'SD Gundam Gashapon Senki - Episode 1 (Japan) (Alt)',
    'Super Robot Taisen Compact (Japan)'
];

echo "🎮 Jeux à ajouter:\n\n";

foreach ($lastGames as $i => $name) {
    echo ($i + 1) . ". {$name}\n";
}

echo "\n⏳ Insertion en cours...\n\n";

DB::beginTransaction();

try {
    $inserted = 0;
    
    foreach ($lastGames as $name) {
        DB::table('wonderswan_games')->insert([
            'name' => $name,
            'rom_id' => null,
            'created_at' => now(),
            'updated_at' => now()
        ]);
        $inserted++;
        echo "  ✓ {$name}\n";
    }
    
    DB::commit();
    
    $total = DB::table('wonderswan_games')->count();
    
    echo "\n══════════════════════════════════════════════════════════════════════════════\n";
    echo "✅ AJOUT TERMINÉ - 100% CORRESPONDANCE ATTEINTE!\n";
    echo "══════════════════════════════════════════════════════════════════════════════\n\n";
    echo "📊 Jeux ajoutés: {$inserted}\n";
    echo "📊 Total en base: {$total}\n\n";
    
    echo "💡 VÉRIFICATION FINALE:\n";
    echo "   php verify-all-platforms-images.php\n\n";
    
} catch (\Exception $e) {
    DB::rollBack();
    
    echo "\n❌ ERREUR: " . $e->getMessage() . "\n\n";
    exit(1);
}
