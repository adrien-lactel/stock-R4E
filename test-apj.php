#!/usr/bin/env php
<?php

$text = 'DMG-APJ-JPN';

$patterns = [
    // Format avec révision numérique (DMG-APAJ-0, DMG-APSJ-1, etc.)
    '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([0-3])\b/i',
    
    // Format standard avec code région (DMG-APSJ-JPN, etc.)
    '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([A-Z]{3})\b/i',
    
    // Format sans séparateurs (DMG APSJ JPN ou DMGAPSJJPN)
    '/\b(DMG|CGB|AGB)([A-Z0-9]{3,4})([0-9A-Z]{3})\b/i',
];

echo "Test de: $text\n\n";

foreach ($patterns as $i => $pattern) {
    echo "Pattern #" . ($i + 1) . ": $pattern\n";
    if (preg_match($pattern, $text, $matches)) {
        echo "  ✅ MATCH!\n";
        echo "  Texte complet: {$matches[0]}\n";
        echo "  Préfixe: {$matches[1]}\n";
        echo "  Code jeu: {$matches[2]}\n";
        echo "  Région: {$matches[3]}\n";
        
        $romId = strtoupper($matches[1]) . '-' . strtoupper($matches[2]) . '-' . strtoupper($matches[3]);
        echo "  ROM ID normalisé: $romId\n";
        break;
    } else {
        echo "  ❌ Pas de match\n";
    }
    echo "\n";
}

// Vérifier si ce ROM ID existe dans la base
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\GameBoyGame;

echo "\n🔍 Recherche dans la base de données...\n";
echo "Recherche directe: DMG-APJ-JPN\n";
$game = GameBoyGame::where('rom_id', 'DMG-APJ-JPN')->first();
if ($game) {
    echo "✅ Trouvé: {$game->name}\n";
} else {
    echo "❌ Non trouvé avec DMG-APJ-JPN\n";
    
    // Chercher des variantes
    echo "\nRecherche de variantes avec 'APJ'...\n";
    $games = GameBoyGame::where('rom_id', 'LIKE', '%APJ%')->get();
    if ($games->count() > 0) {
        foreach ($games as $g) {
            echo "  - {$g->rom_id}: {$g->name}\n";
        }
    } else {
        echo "  Aucune variante trouvée\n";
    }
}
