<?php
require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "Vérification des images WonderSwan manquantes\n";
echo "=============================================\n\n";

$games = DB::table('wonderswan_games')->get();
$taxonomyPath = public_path('images/taxonomy/wonderswan color');

$missing = [];
$found = 0;

foreach ($games as $game) {
    $cleanName = preg_replace('/\.ws$/i', '', $game->name);
    $cleanName = trim($cleanName);
    
    $hasCover = file_exists("{$taxonomyPath}/{$cleanName}-cover.png");
    $hasLogo = file_exists("{$taxonomyPath}/{$cleanName}-logo.png");
    $hasArtwork = file_exists("{$taxonomyPath}/{$cleanName}-artwork.png");
    
    if (!$hasCover && !$hasLogo && !$hasArtwork) {
        $missing[] = $game->name;
    } else {
        $found++;
    }
}

echo "📊 Statistiques:\n";
echo "   Total jeux: " . $games->count() . "\n";
echo "   Avec images: {$found}\n";
echo "   Sans images: " . count($missing) . "\n\n";

if (count($missing) > 0 && count($missing) <= 20) {
    echo "❌ Jeux sans images:\n";
    foreach ($missing as $name) {
        echo "   - {$name}\n";
    }
} elseif (count($missing) > 20) {
    echo "❌ Premiers 20 jeux sans images:\n";
    for ($i = 0; $i < 20; $i++) {
        echo "   - {$missing[$i]}\n";
    }
    echo "   ... et " . (count($missing) - 20) . " autres\n";
}
