<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use Illuminate\Support\Facades\DB;

echo "╔" . str_repeat("═", 78) . "╗\n";
echo "║" . str_pad("ANALYSE FORMATS D'IMAGES - GAME GEAR", 78, " ", STR_PAD_BOTH) . "║\n";
echo "╚" . str_repeat("═", 78) . "╝\n\n";

$imageFolder = 'public/images/taxonomy/gamegear';
$allImages = glob($imageFolder . '/*.{png,jpg,jpeg}', GLOB_BRACE);

$formatClassique = 0; // Commence par majuscule: Aladdin (Japan)-cover.png
$formatKebab = 0;     // Commence par minuscule: aladdin-Japan-cover.png

$examplesClassique = [];
$examplesKebab = [];

foreach ($allImages as $imagePath) {
    $filename = basename($imagePath);
    
    // Vérifier si commence par minuscule
    if (preg_match('/^[a-z]/', $filename)) {
        $formatKebab++;
        if (count($examplesKebab) < 10) {
            $examplesKebab[] = $filename;
        }
    } else {
        $formatClassique++;
        if (count($examplesClassique) < 10) {
            $examplesClassique[] = $filename;
        }
    }
}

echo "📊 RÉPARTITION DES FORMATS\n";
echo str_repeat("─", 80) . "\n\n";

echo "Total images: " . count($allImages) . "\n\n";

echo "📁 Format Classique (Title Case avec espaces):\n";
echo "   Nombre: {$formatClassique} images (" . round($formatClassique / count($allImages) * 100, 1) . "%)\n";
echo "   Exemples:\n";
foreach ($examplesClassique as $example) {
    echo "      • {$example}\n";
}

echo "\n📁 Format Kebab-case (minuscules avec tirets):\n";
echo "   Nombre: {$formatKebab} images (" . round($formatKebab / count($allImages) * 100, 1) . "%)\n";
echo "   Exemples:\n";
foreach ($examplesKebab as $example) {
    echo "      • {$example}\n";
}

echo "\n" . str_repeat("═", 80) . "\n";
echo "🔍 ANALYSE DES JEUX EN BASE\n";
echo str_repeat("─", 80) . "\n\n";

// Récupérer quelques jeux de la base pour voir le format
$gamesInDb = DB::table('game_gear_games')
    ->select('name')
    ->limit(20)
    ->get();

echo "Exemples de noms en base de données:\n";
foreach ($gamesInDb as $game) {
    echo "   • {$game->name}\n";
}

echo "\n" . str_repeat("═", 80) . "\n";
echo "💡 CONCLUSION\n";
echo str_repeat("─", 80) . "\n\n";

if ($formatKebab > 0) {
    echo "⚠️  PROBLÈME DÉTECTÉ:\n";
    echo "   Il y a deux formats d'images mélangés:\n";
    echo "   • {$formatClassique} images en format classique\n";
    echo "   • {$formatKebab} images en format kebab-case\n\n";
    
    echo "💡 SOLUTIONS:\n";
    echo "   1. Renommer les {$formatKebab} images kebab en format classique\n";
    echo "   2. Les {$formatKebab} images kebab correspondent probablement\n";
    echo "      aux jeux déjà en base, juste format différent\n\n";
} else {
    echo "✅ Format cohérent: toutes les images sont en format classique\n";
}

echo str_repeat("═", 80) . "\n";
