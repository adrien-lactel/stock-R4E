#!/usr/bin/env php
<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\GameBoyGame;

echo "\n🔍 Test du lookup ROM ID avec variantes\n";
echo "=" . str_repeat("=", 50) . "\n\n";

$romId = 'DMG-APSJ-JPN';
echo "ROM ID original: $romId\n\n";

// Test direct
$game = GameBoyGame::where('rom_id', $romId)->first();
echo "Recherche directe: " . ($game ? "✅ Trouvé: {$game->name}" : "❌ Non trouvé") . "\n\n";

// Test avec variantes
if (!$game && preg_match('/-(JPN|EUR|USA|FRA|GER|ITA|SPA)$/i', $romId)) {
    echo "ROM ID se termine par un code région, essai avec variantes...\n";
    
    for ($i = 0; $i <= 3; $i++) {
        $alternateRomId = preg_replace('/-(JPN|EUR|USA|FRA|GER|ITA|SPA)$/i', "-$i", $romId);
        echo "  - Essai avec: $alternateRomId ... ";
        
        $game = GameBoyGame::where('rom_id', $alternateRomId)->first();
        if ($game) {
            echo "✅ TROUVÉ!\n";
            echo "    Nom: {$game->name}\n";
            echo "    ROM ID: {$game->rom_id}\n";
            echo "    Année: {$game->year}\n";
            break;
        } else {
            echo "❌\n";
        }
    }
}

if (!$game) {
    echo "\n❌ Aucune variante trouvée\n";
}

echo "\n";
