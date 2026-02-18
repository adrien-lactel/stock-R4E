<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔════════════════════════════════════════════════════════════════════╗\n";
echo "║       FIX N64 - MIGRATION code → cartridge_id                      ║\n";
echo "╚════════════════════════════════════════════════════════════════════╝\n\n";

echo "🔄 Étape 1: Copie code → cartridge_id...\n";

try {
    DB::statement("UPDATE n64_games SET cartridge_id = code WHERE cartridge_id IS NULL OR cartridge_id = ''");
    $affected = DB::table('n64_games')->whereNotNull('cartridge_id')->where('cartridge_id', '!=', '')->count();
    echo "   ✅ {$affected}/818 jeux ont maintenant un cartridge_id\n\n";
} catch (\Exception $e) {
    echo "   ❌ ERREUR: " . $e->getMessage() . "\n\n";
    exit(1);
}

echo "🗑️  Étape 2: Suppression de la colonne 'code'...\n";

try {
    DB::statement("ALTER TABLE n64_games DROP COLUMN `code`");
    echo "   ✅ Colonne 'code' supprimée\n\n";
} catch (\Exception $e) {
    echo "   ❌ ERREUR: " . $e->getMessage() . "\n\n";
    exit(1);
}

// Vérification finale
echo "═══════════════════════════════════════════════════════════════════════\n";
echo "🔍 VÉRIFICATION FINALE\n";
echo "═══════════════════════════════════════════════════════════════════════\n\n";

$columns = DB::select("SHOW COLUMNS FROM n64_games");
$columnCount = count($columns);
$totalGames = DB::table('n64_games')->count();
$cartridgeIdCount = DB::table('n64_games')->whereNotNull('cartridge_id')->where('cartridge_id', '!=', '')->count();

echo "📊 n64_games:\n";
echo "   Colonnes: {$columnCount}/21\n";
echo "   Total jeux: {$totalGames}\n";
echo "   cartridge_id remplis: {$cartridgeIdCount}/{$totalGames}\n\n";

if ($columnCount === 21) {
    echo "✅ SUCCÈS: n64_games a maintenant 21 colonnes!\n";
} else {
    echo "⚠️  ATTENTION: n64_games a {$columnCount} colonnes (attendu: 21)\n";
}

echo "\n═══════════════════════════════════════════════════════════════════════\n";
