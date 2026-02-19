<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║            ANALYSE: COLONNES OBSOLÈTES DES TABLES DE JEUX                   ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

$tables = [
    'game_boy_games',
    'snes_games',
    'nes_games',
    'wonderswan_games',
    'game_gear_games',
    'mega_drive_games',
    'n64_games',
    'sega_saturn_games',
];

echo "🔍 COLONNES À ANALYSER:\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

$obsoleteColumns = ['slug', 'image_url', 'match_type', 'match_score'];
$totalGames = 0;

foreach ($obsoleteColumns as $col) {
    echo "📋 Colonne: {$col}\n";
    echo str_repeat("─", 80) . "\n";
    
    $totalUsed = 0;
    $totalRows = 0;
    
    foreach ($tables as $table) {
        $count = DB::table($table)->count();
        $used = DB::table($table)->whereNotNull($col)->where($col, '!=', '')->count();
        
        $totalRows += $count;
        $totalUsed += $used;
        
        $percentage = $count > 0 ? round(($used / $count) * 100, 1) : 0;
        $status = $used > 0 ? '⚠️' : '✅';
        
        echo sprintf("  %s %-25s: %5d/%5d utilisés (%5.1f%%)\n", 
            $status, $table, $used, $count, $percentage);
    }
    
    $totalPercentage = $totalRows > 0 ? round(($totalUsed / $totalRows) * 100, 1) : 0;
    
    echo str_repeat("─", 80) . "\n";
    echo sprintf("  📊 TOTAL: %d/%d jeux utilisent cette colonne (%.1f%%)\n\n", 
        $totalUsed, $totalRows, $totalPercentage);
    
    $totalGames = $totalRows;
}

echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "💡 RECOMMANDATIONS SIMPLIFICATION\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

// Analyser l'utilisation de slug vs rom_id
echo "1️⃣ SLUG vs ROM_ID:\n";
echo "   Vérifier si slug est utilisé comme fallback...\n\n";

foreach ($tables as $table) {
    $emptyRomId = DB::table($table)->where(function($q) {
        $q->whereNull('rom_id')->orWhere('rom_id', '=', '');
    })->count();
    
    $hasSlugNoRomId = DB::table($table)
        ->where(function($q) {
            $q->whereNull('rom_id')->orWhere('rom_id', '=', '');
        })
        ->whereNotNull('slug')
        ->where('slug', '!=', '')
        ->count();
    
    if ($emptyRomId > 0) {
        echo sprintf("  %-25s: %4d jeux sans rom_id, %4d avec slug\n", 
            $table, $emptyRomId, $hasSlugNoRomId);
    }
}

echo "\n2️⃣ IMAGE_URL vs IMAGE_PATH:\n";
echo "   Analyser quelle colonne est utilisée...\n\n";

foreach ($tables as $table) {
    $hasImageUrl = DB::table($table)->whereNotNull('image_url')->where('image_url', '!=', '')->count();
    $hasImagePath = DB::table($table)->whereNotNull('image_path')->where('image_path', '!=', '')->count();
    $hasBoth = DB::table($table)
        ->whereNotNull('image_url')->where('image_url', '!=', '')
        ->whereNotNull('image_path')->where('image_path', '!=', '')
        ->count();
    
    echo sprintf("  %-25s: image_url=%4d, image_path=%4d, les deux=%4d\n", 
        $table, $hasImageUrl, $hasImagePath, $hasBoth);
}

echo "\n3️⃣ MATCH_TYPE & MATCH_SCORE:\n";
echo "   Vérifier les valeurs utilisées...\n\n";

foreach ($tables as $table) {
    $matchTypes = DB::table($table)
        ->select('match_type', DB::raw('COUNT(*) as count'))
        ->whereNotNull('match_type')
        ->where('match_type', '!=', '')
        ->groupBy('match_type')
        ->get();
    
    if ($matchTypes->count() > 0) {
        echo "  {$table}:\n";
        foreach ($matchTypes as $type) {
            echo "    - {$type->match_type}: {$type->count} jeux\n";
        }
    }
}

echo "\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "🎯 SCHÉMA PROPOSÉ APRÈS NETTOYAGE\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

echo "Colonnes à SUPPRIMER (4):\n";
echo "  ❌ slug           - Dupliqué dans rom_id\n";
echo "  ❌ image_url      - URLs externes non utilisées\n";
echo "  ❌ match_type     - Tous en 'exact' maintenant\n";
echo "  ❌ match_score    - Non pertinent si matching exact\n\n";

echo "Colonnes à CONSERVER (16):\n";
echo "  ✅ id, rom_id, cartridge_id, name, name_jp, alternate_names\n";
echo "  ✅ year, publisher, developer, region\n";
echo "  ✅ image_path, libretro_name, source, price\n";
echo "  ✅ created_at, updated_at\n\n";

echo "🚀 SCHÉMA OPTIMISÉ: 20 → 16 colonnes (-20%)\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "📸 PROPOSITION: GESTION MULTI-IMAGES\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

echo "OPTION 1: Pattern de nommage R2 (RECOMMANDÉ)\n";
echo "─────────────────────────────────────────────\n";
echo "Stockage: products/games/{platform}/{rom_id}-{type}-{index}.jpg\n";
echo "Exemples:\n";
echo "  • products/games/gameboy/DMG-TRA-0-cover-1.jpg\n";
echo "  • products/games/gameboy/DMG-TRA-0-artwork-1.jpg\n";
echo "  • products/games/gameboy/DMG-TRA-0-gameplay-1.jpg\n";
echo "  • products/games/gameboy/DMG-TRA-0-logo-1.jpg\n";
echo "  • products/games/gameboy/DMG-TRA-0-logo-2.jpg\n\n";
echo "Avantages:\n";
echo "  ✅ Aucune colonne supplémentaire nécessaire\n";
echo "  ✅ Recherche simple: Storage::disk('r2')->files('products/games/gameboy/DMG-TRA-0-*')\n";
echo "  ✅ Flexibilité: N images de chaque type sans limite\n";
echo "  ✅ Mise à jour: Upload avec index auto-incrémenté\n";
echo "  ✅ Suppression: Facile par pattern\n\n";

echo "OPTION 2: Colonne JSON unique\n";
echo "─────────────────────────────\n";
echo "Colonne: image_paths JSON\n";
echo "Exemple:\n";
echo '  {"cover":["path1.jpg"], "artwork":["path2.jpg"], "logo":["path3.jpg","path4.jpg"]}' . "\n\n";
echo "Avantages:\n";
echo "  ✅ 1 seule colonne\n";
echo "  ✅ Flexibilité pour arrays\n";
echo "  ⚠️  Requêtes JSON un peu complexes\n";
echo "  ⚠️  Index difficile\n\n";

echo "OPTION 3: Table pivot game_images\n";
echo "──────────────────────────────────\n";
echo "Structure: id, game_id, platform, type, path, order, created_at\n";
echo "Avantages:\n";
echo "  ✅ Flexibilité maximale\n";
echo "  ✅ Facile à requêter\n";
echo "  ❌ Requiert jointures\n";
echo "  ❌ 8 tables de jeux = complexité\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "💡 RECOMMANDATION FINALE\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

echo "✅ SUPPRIMER: slug, image_url, match_type, match_score (4 colonnes)\n";
echo "✅ REMPLACER image_path par pattern de nommage R2\n";
echo "✅ SCHÉMA FINAL: 15 colonnes (au lieu de 20)\n\n";

echo "Code de gestion images:\n";
echo "─────────────────────────\n";
echo <<<'PHP'
// Helper dans ProductSheetController
private function getGameImages(string $platform, string $romId, ?string $type = null): array
{
    $pattern = "products/games/{$platform}/{$romId}-" . ($type ?? '*');
    $files = Storage::disk('r2')->files($pattern);
    
    $images = [];
    foreach ($files as $file) {
        // Parse: DMG-TRA-0-cover-1.jpg
        if (preg_match('/-(\w+)-(\d+)\.(jpg|png)$/', $file, $m)) {
            $images[$m[1]][] = Storage::disk('r2')->url($file);
        }
    }
    return $images;
}

// Usage
$tetrisImages = $this->getGameImages('gameboy', 'DMG-TRA-0');
// ['cover' => ['url1'], 'artwork' => ['url2'], 'logo' => ['url3', 'url4']]

// Upload nouvelle image
public function uploadGameImage(Request $request, string $platform, string $romId, string $type)
{
    $files = Storage::disk('r2')->files("products/games/{$platform}/{$romId}-{$type}-*");
    $nextIndex = count($files) + 1;
    
    $filename = "{$romId}-{$type}-{$nextIndex}.jpg";
    $path = "products/games/{$platform}/{$filename}";
    
    Storage::disk('r2')->put($path, $request->file('image')->get(), 'public');
    return Storage::disk('r2')->url($path);
}

PHP;

echo "\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n";
