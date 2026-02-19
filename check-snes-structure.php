<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== ANALYSE STRUCTURE SNES ===\n\n";

// Vérifier si certains jeux ont des ROM IDs dans le nom
$snesWithPattern = DB::table('snes_games')
    ->whereRaw("name REGEXP '^[A-Z]{3,5}-[A-Z0-9]{2,4}'")
    ->limit(10)
    ->get(['id', 'rom_id', 'name']);

echo "Jeux SNES avec pattern ROM ID dans le nom (SHVC-XX, etc.):\n";
echo "Trouvés: " . $snesWithPattern->count() . " jeux\n\n";
foreach ($snesWithPattern as $game) {
    echo "ID: {$game->id}\n";
    echo "  rom_id: " . ($game->rom_id ?? 'NULL') . "\n";
    echo "  name: {$game->name}\n";
    
    // Essayer d'extraire le ROM ID
    if (preg_match('/^([A-Z]{3,5}-[A-Z0-9]{2,4})/', $game->name, $matches)) {
        echo "  → ROM ID extrait: {$matches[1]}\n";
    }
    echo "\n";
}

// Comparer avec les fichiers existants
echo "\n=== FICHIERS SNES SUR DISQUE ===\n";
$snesFiles = glob('public/images/taxonomy/snes/*-cover.png');
echo "Total: " . count($snesFiles) . " fichiers\n\n";

echo "Premiers 20 fichiers:\n";
foreach (array_slice($snesFiles, 0, 20) as $file) {
    $filename = basename($file);
    $identifier = str_replace('-cover.png', '', $filename);
    echo "  - $identifier\n";
}

echo "\n=== VÉRIFICATION: Jeux dans BDD matchent-ils les fichiers? ===\n";
// Prendre quelques fichiers et chercher dans la BDD
$testFiles = array_slice($snesFiles, 0, 10);
foreach ($testFiles as $file) {
    $filename = basename($file);
    $romId = str_replace('-cover.png', '', $filename);
    
    // Chercher dans la BDD
    $game = DB::table('snes_games')
        ->whereRaw("name LIKE ?", ["%$romId%"])
        ->first(['id', 'rom_id', 'name']);
    
    if ($game) {
        echo "✓ Fichier: $filename\n";
        echo "  Trouvé en BDD: {$game->name}\n";
    } else {
        echo "✗ Fichier: $filename\n";
        echo "  INTROUVABLE en BDD\n";
    }
    echo "\n";
}
