<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== GAME BOY GAMES (5 examples) ===\n";
$gameboy = DB::table('game_boy_games')->select('id', 'rom_id', 'name')->limit(5)->get();
foreach ($gameboy as $game) {
    echo sprintf("ID: %s | rom_id: %s | name: %s\n", 
        $game->id, 
        $game->rom_id ?? 'NULL', 
        $game->name ?? 'NULL'
    );
}

echo "\n=== WONDERSWAN GAMES (5 examples) ===\n";
$wonderswan = DB::table('wonderswan_games')->select('id', 'rom_id', 'name')->limit(5)->get();
foreach ($wonderswan as $game) {
    echo sprintf("ID: %s | rom_id: %s | name: %s\n", 
        $game->id, 
        $game->rom_id ?? 'NULL',
        $game->name ?? 'NULL'
    );
}

echo "\n=== SNES GAMES (5 examples) ===\n";
$snes = DB::table('snes_games')->select('id', 'rom_id', 'name')->limit(5)->get();
foreach ($snes as $game) {
    echo sprintf("ID: %s | rom_id: %s | name: %s\n", 
        $game->id, 
        $game->rom_id ?? 'NULL', 
        $game->name ?? 'NULL'
    );
}

echo "\n=== Fichiers images correspondants sur disque ===\n";
$gbFiles = glob('public/images/taxonomy/gameboy/*-cover.png');
echo "Game Boy covers: " . count($gbFiles) . " fichiers\n";
if (count($gbFiles) > 0) {
    echo "Exemples de noms de fichiers: \n";
    foreach (array_slice($gbFiles, 0, 5) as $file) {
        $filename = basename($file);
        $identifier = str_replace('-cover.png', '', $filename);
        echo "  - Fichier: $filename → Identifiant: $identifier\n";
    }
}

$wsFiles = glob('public/images/taxonomy/wonderswan/*-cover.png');
echo "\nWonderSwan covers: " . count($wsFiles) . " fichiers\n";
if (count($wsFiles) > 0) {
    echo "Exemples de noms de fichiers: \n";
    foreach (array_slice($wsFiles, 0, 5) as $file) {
        $filename = basename($file);
        $identifier = str_replace('-cover.png', '', $filename);
        echo "  - Fichier: $filename → Identifiant: $identifier\n";
    }
}

$snesFiles = glob('public/images/taxonomy/snes/*-cover.png');
echo "\nSNES covers: " . count($snesFiles) . " fichiers\n";
if (count($snesFiles) > 0) {
    echo "Exemples de noms de fichiers: \n";
    foreach (array_slice($snesFiles, 0, 5) as $file) {
        $filename = basename($file);
        $identifier = str_replace('-cover.png', '', $filename);
        echo "  - Fichier: $filename → Identifiant: $identifier\n";
    }
}
