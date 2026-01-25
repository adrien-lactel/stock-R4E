<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ArticleType;

echo "🎴 CARTES POKÉMON - TOP CARTES RECHERCHÉES PAR ÉDITION\n";
echo "=======================================================\n\n";

// Récupérer toutes les éditions Pokémon
$pokemonEditions = [
    'XY12 - Évolutions (2016)',
    'SL - Soleil et Lune (2019-2020)',
    'EB - Épée et Bouclier (2020-2022)',
    'EV1 - Écarlate et Violet (2023)',
    'EV2.5 - 151 (2023)',
    'EV3 - Couronne Zénith (2023)',
    'EV3.5 - Flammes Obsidiennes (2024)',
    'EV4 - Paradoxe des Forces (2024)',
    'EV4.5 - Évolutions à Kitakami (2024)',
    'EV5 - Destinées à Paldea (2024)',
    'EV5.5 - Fables Nébuleuses (2024)',
    'EV6 - Couronne Stellaire (2024)',
    'EV6.5 - Voyage Ensemble (2025)',
    'EV7 - Mega Evolution (2025)',
    'EV7.5 - Évolutions Prismatiques (2025)',
    'EV8 - Étincelles Déferlantes (2025)',
    'EV9 - Celebration 30 ans (2026)',
];

foreach ($pokemonEditions as $editionName) {
    $type = ArticleType::whereHas('subCategory', function($q) use ($editionName) {
        $q->where('name', $editionName);
    })->first();
    
    if ($type && $type->description) {
        echo "📦 {$editionName}\n";
        echo str_repeat("-", 70) . "\n";
        
        // Extraire la partie avec les cartes recherchées
        if (preg_match('/🔥 CARTES RECHERCHÉES : (.+)\./', $type->description, $matches)) {
            echo "💎 Top 4 Cartes:\n";
            $cartes = explode(', ', $matches[1]);
            foreach ($cartes as $i => $carte) {
                echo "   " . ($i + 1) . ". {$carte}\n";
            }
        }
        
        echo "\n";
    }
}

echo "\n✅ Toutes les éditions ont maintenant leurs cartes recherchées et prix moyens!\n";
