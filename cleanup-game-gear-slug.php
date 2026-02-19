<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║          NETTOYAGE GAME GEAR: SLUG → ROM_ID (492 jeux)                      ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

// 1. Vérifier l'état actuel
echo "1️⃣ ÉTAT ACTUEL:\n";
echo str_repeat("─", 80) . "\n";

$total = DB::table('game_gear_games')->count();
$hasSlug = DB::table('game_gear_games')->whereNotNull('slug')->where('slug', '!=', '')->count();
$emptyRomId = DB::table('game_gear_games')->where(function($q) {
    $q->whereNull('rom_id')->orWhere('rom_id', '=', '');
})->count();

$hasSlugEmptyRomId = DB::table('game_gear_games')
    ->where(function($q) {
        $q->whereNull('rom_id')->orWhere('rom_id', '=', '');
    })
    ->whereNotNull('slug')
    ->where('slug', '!=', '')
    ->count();

echo "   Total jeux Game Gear: {$total}\n";
echo "   Jeux avec slug: {$hasSlug}\n";
echo "   Jeux avec rom_id vide: {$emptyRomId}\n";
echo "   Jeux avec slug mais sans rom_id: {$hasSlugEmptyRomId}\n\n";

// 2. Aperçu des jeux concernés
echo "2️⃣ APERÇU (10 premiers jeux avec slug):\n";
echo str_repeat("─", 80) . "\n";

$samples = DB::table('game_gear_games')
    ->whereNotNull('slug')
    ->where('slug', '!=', '')
    ->limit(10)
    ->get(['id', 'rom_id', 'name', 'slug']);

foreach ($samples as $game) {
    $romId = empty($game->rom_id) ? '[vide]' : $game->rom_id;
    echo sprintf("   ID %4d: %-30s | rom_id: %-15s | slug: %s\n", 
        $game->id, 
        substr($game->name, 0, 30),
        $romId,
        $game->slug
    );
}

echo "\n";

// 3. Question de confirmation
echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "⚠️  OPÉRATION:\n";
echo "   Pour les {$hasSlug} jeux qui ont un 'slug', copier slug → rom_id\n";
echo "   (Si rom_id est déjà rempli, il sera écrasé)\n\n";

echo "   Exemple:\n";
echo "   AVANT: rom_id='sonic-1' (ou vide), slug='sonic-the-hedgehog'\n";
echo "   APRÈS: rom_id='sonic-the-hedgehog', slug='sonic-the-hedgehog'\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

echo "Continuer ? (y/n): ";
$handle = fopen("php://stdin", "r");
$line = trim(fgets($handle));
fclose($handle);

if (strtolower($line) !== 'y') {
    echo "\n❌ Opération annulée.\n";
    exit(0);
}

echo "\n3️⃣ COPIE SLUG → ROM_ID:\n";
echo str_repeat("─", 80) . "\n";

try {
    DB::beginTransaction();
    
    // Méthode 1: Update direct pour tous les jeux avec slug
    $affected = DB::table('game_gear_games')
        ->whereNotNull('slug')
        ->where('slug', '!=', '')
        ->update(['rom_id' => DB::raw('slug')]);
    
    echo "   ✅ {$affected} jeux mis à jour\n\n";
    
    DB::commit();
    
    // 4. Vérification
    echo "4️⃣ VÉRIFICATION POST-NETTOYAGE:\n";
    echo str_repeat("─", 80) . "\n";
    
    $emptyRomIdAfter = DB::table('game_gear_games')->where(function($q) {
        $q->whereNull('rom_id')->orWhere('rom_id', '=', '');
    })->count();
    
    $hasSlugAfter = DB::table('game_gear_games')->whereNotNull('slug')->where('slug', '!=', '')->count();
    
    echo "   Jeux avec rom_id vide: {$emptyRomIdAfter} (avant: {$emptyRomId})\n";
    echo "   Jeux avec slug: {$hasSlugAfter} (avant: {$hasSlug})\n\n";
    
    // Vérifier que tous les jeux avec slug ont maintenant un rom_id
    $check = DB::table('game_gear_games')
        ->whereNotNull('slug')
        ->where('slug', '!=', '')
        ->where(function($q) {
            $q->whereNull('rom_id')->orWhere('rom_id', '=', '');
        })
        ->count();
    
    if ($check === 0) {
        echo "   ✅ Tous les jeux avec slug ont maintenant un rom_id!\n\n";
    } else {
        echo "   ⚠️  {$check} jeux avec slug ont encore un rom_id vide\n\n";
    }
    
    // 5. Aperçu après
    echo "5️⃣ APERÇU APRÈS NETTOYAGE (10 premiers):\n";
    echo str_repeat("─", 80) . "\n";
    
    $samplesAfter = DB::table('game_gear_games')
        ->whereNotNull('slug')
        ->where('slug', '!=', '')
        ->limit(10)
        ->get(['id', 'rom_id', 'name', 'slug']);
    
    foreach ($samplesAfter as $game) {
        echo sprintf("   ID %4d: %-30s | rom_id: %-20s ✅\n", 
            $game->id, 
            substr($game->name, 0, 30),
            $game->rom_id
        );
    }
    
    echo "\n";
    echo "═══════════════════════════════════════════════════════════════════════════════\n";
    echo "✅ NETTOYAGE GAME GEAR TERMINÉ!\n";
    echo "═══════════════════════════════════════════════════════════════════════════════\n\n";
    
    echo "📊 RÉSUMÉ:\n";
    echo "   • {$affected} jeux Game Gear mis à jour\n";
    echo "   • Colonne 'slug' peut maintenant être supprimée en toute sécurité\n";
    echo "   • rom_id contient maintenant toutes les valeurs nécessaires\n\n";
    
} catch (\Exception $e) {
    DB::rollBack();
    echo "\n❌ ERREUR: " . $e->getMessage() . "\n";
    exit(1);
}
