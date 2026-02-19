<?php

require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

// Test 1: Vérifier connexion R2
echo "=== TEST 1: Connexion R2 ===\n";
try {
    $r2Url = config('filesystems.disks.r2.url');
    echo "R2 URL: {$r2Url}\n";
    echo "R2 public URL: " . config('filesystems.disks.r2.public_url') . "\n";
} catch (Exception $e) {
    echo "ERREUR config: " . $e->getMessage() . "\n";
}

// Test 2: Lister fichiers dans products/games/gameboy
echo "\n=== TEST 2: Fichiers dans products/games/gameboy ===\n";
try {
    $files = Storage::disk('r2')->files('products/games/gameboy');
    echo "Total fichiers: " . count($files) . "\n";
    
    // Afficher les 10 premiers
    echo "\nPremiers fichiers:\n";
    foreach (array_slice($files, 0, 10) as $file) {
        echo "  - " . basename($file) . "\n";
    }
    
    // Chercher spécifiquement DMG-TRA
    echo "\n=== Fichiers DMG-TRA ===\n";
    $dmgTraFiles = array_filter($files, function($f) {
        return str_contains(basename($f), 'DMG-TRA');
    });
    foreach ($dmgTraFiles as $file) {
        echo "  - " . basename($file) . " => " . Storage::disk('r2')->url($file) . "\n";
    }
    
} catch (Exception $e) {
    echo "ERREUR liste: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}

// Test 3: Vérifier le dossier taxonomy (ancien système)
echo "\n=== TEST 3: Fichiers dans taxonomy/gameboy (legacy) ===\n";
try {
    $files = Storage::disk('r2')->files('taxonomy/gameboy');
    echo "Total fichiers: " . count($files) . "\n";
    
    // Chercher DMG-TRA
    $dmgTraFiles = array_filter($files, function($f) {
        return str_contains(basename($f), 'DMG-TRA');
    });
    echo "\nFichiers DMG-TRA trouvés:\n";
    foreach ($dmgTraFiles as $file) {
        echo "  - " . basename($file) . "\n";
    }
} catch (Exception $e) {
    echo "ERREUR taxonomy: " . $e->getMessage() . "\n";
}

// Test 4: Tester la méthode getGameImageUrl
echo "\n=== TEST 4: Test getGameImageUrl() ===\n";
$controller = new \App\Http\Controllers\Admin\ConsoleAdminController();
$game = (object)[
    'rom_id' => 'DMG-TRA',
    'name' => 'Tetris',
];

// Utiliser reflection pour accéder à la méthode privée
$reflection = new ReflectionClass($controller);
$method = $reflection->getMethod('getGameImageUrl');
$method->setAccessible(true);

try {
    $imageUrl = $method->invoke($controller, $game, 'gameboy');
    echo "Image URL retournée: " . ($imageUrl ?? 'NULL') . "\n";
} catch (Exception $e) {
    echo "ERREUR méthode: " . $e->getMessage() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}
