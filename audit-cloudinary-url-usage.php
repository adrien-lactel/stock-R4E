<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔══════════════════════════════════════════════════════════════════════════════╗\n";
echo "║            AUDIT: UTILISATION DE LA COLONNE cloudinary_url (col 14)         ║\n";
echo "╚══════════════════════════════════════════════════════════════════════════════╝\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "📊 ÉTAT DES DONNÉES DANS LES 8 TABLES\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

$tables = [
    'game_boy_games' => 'Game Boy / Color / Advance',
    'snes_games' => 'Super Nintendo',
    'nes_games' => 'NES',
    'wonderswan_games' => 'WonderSwan',
    'game_gear_games' => 'Game Gear',
    'mega_drive_games' => 'Mega Drive / Genesis',
    'n64_games' => 'Nintendo 64',
    'sega_saturn_games' => 'Sega Saturn',
];

$totalGames = 0;
$totalWithCloudinary = 0;

foreach ($tables as $table => $platform) {
    $total = DB::table($table)->count();
    $withCloudinary = DB::table($table)
        ->whereNotNull('cloudinary_url')
        ->where('cloudinary_url', '!=', '')
        ->count();
    
    $percentage = $total > 0 ? round(($withCloudinary / $total) * 100, 1) : 0;
    
    echo sprintf("%-30s : %5d jeux, cloudinary_url rempli: %5d (%4.1f%%)\n", 
        $platform, $total, $withCloudinary, $percentage);
    
    $totalGames += $total;
    $totalWithCloudinary += $withCloudinary;
}

echo "\n" . str_repeat("─", 80) . "\n";
echo sprintf("TOTAL: %d jeux, cloudinary_url utilisé: %d (%0.1f%%)\n", 
    $totalGames, $totalWithCloudinary, 
    $totalGames > 0 ? round(($totalWithCloudinary / $totalGames) * 100, 1) : 0);

echo "\n═══════════════════════════════════════════════════════════════════════════════\n";
echo "🔍 UTILISATION DANS LE CODE\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

echo "1️⃣  CONFIGURATION (config/filesystems.php):\n";
echo "   ✓ Disk 'cloudinary' configuré (ANCIEN SYSTÈME)\n";
echo "   ✓ Disk 'r2' configuré (NOUVEAU SYSTÈME - Cloudflare R2)\n\n";

echo "2️⃣  CODE MODERNE (utilise R2):\n";
echo "   ✓ TaxonomyController: Storage::disk('r2') (22 occurrences)\n";
echo "   ✓ ConsoleAdminController: Storage::disk('r2') (5 occurrences)\n";
echo "   ✓ ProductSheetController: Storage::disk('r2') (3 occurrences)\n";
echo "   ✓ PublisherAdminController: Storage::disk('r2') (1 occurrence)\n\n";

echo "3️⃣  CODE LEGACY (utilise encore Cloudinary):\n";
echo "   ⚠️  ProductSheetController::uploadFromUrl() (lignes 524, 533)\n";
echo "       → Upload d'images externes vers Cloudinary\n";
echo "       → Sauvegarde dans cloudinary_url (ligne 542)\n";
echo "   ⚠️  ProductSheetController::uploadTaxonomyImage() (lignes 1430, 1436)\n";
echo "       → Upload d'images de taxonomie vers Cloudinary\n\n";

echo "4️⃣  LECTURE DE cloudinary_url:\n";
echo "   ✓ ProductSheetController::matchGameImage() (ligne 966):\n";
echo "       → \$imageUrl = \$game->cloudinary_url ?: \$game->image_url;\n";
echo "   ✓ Utilisé comme fallback si image_url n'existe pas\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "💡 RECOMMANDATIONS\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";

if ($totalWithCloudinary === 0) {
    echo "✅ RECOMMANDATION: SUPPRIMER LA COLONNE cloudinary_url\n\n";
    echo "Raisons:\n";
    echo "   • Aucune donnée n'utilise cette colonne (" . number_format($totalGames) . " jeux analysés)\n";
    echo "   • Vous utilisez maintenant Cloudflare R2 pour le stockage\n";
    echo "   • Le code moderne n'écrit plus dans cette colonne\n";
    echo "   • Code legacy à migrer: 2 méthodes seulement\n\n";
    
    echo "📋 PLAN D'ACTION:\n";
    echo "   1. Migrer uploadFromUrl() pour utiliser R2 au lieu de Cloudinary\n";
    echo "   2. Migrer uploadTaxonomyImage() pour utiliser R2 au lieu de Cloudinary\n";
    echo "   3. Supprimer les références à cloudinary_url dans ProductSheetController\n";
    echo "   4. Générer une migration pour DROP COLUMN cloudinary_url sur les 8 tables\n";
    echo "   5. (Optionnel) Supprimer le disk 'cloudinary' de config/filesystems.php\n\n";
    
    echo "💾 ÉCONOMIE D'ESPACE:\n";
    echo "   • Suppression de 8 colonnes (une par table)\n";
    echo "   • Simplification du schéma: 21 → 20 colonnes\n";
    echo "   • Réduction de la complexité du code\n\n";
    
} else {
    echo "⚠️  ATTENTION: cloudinary_url CONTIENT DES DONNÉES\n\n";
    echo "Avant de supprimer:\n";
    echo "   • Analyser les {$totalWithCloudinary} jeux utilisant cloudinary_url\n";
    echo "   • Migrer ces URLs vers R2 si possible\n";
    echo "   • Ou garder image_url comme source principale\n\n";
}

echo "═══════════════════════════════════════════════════════════════════════════════\n";
echo "📝 NOTES\n";
echo "═══════════════════════════════════════════════════════════════════════════════\n\n";
echo "• Cloudflare R2 est compatible S3 et moins cher que Cloudinary\n";
echo "• R2 est déjà configuré et utilisé dans 90% du code\n";
echo "• La migration complète permettrait de désactiver Cloudinary\n";
echo "• Les URLs R2 sont stockées dans 'image_path' ou retournées directement\n\n";

echo "═══════════════════════════════════════════════════════════════════════════════\n";
