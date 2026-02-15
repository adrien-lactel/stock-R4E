<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Analyse rapide fichiers R2 ===" . PHP_EOL . PHP_EOL;

$platforms = [
    'gameboy' => 'Game Boy',
    'snes' => 'SNES',
    'nes' => 'NES',
    'wonderswan' => 'WonderSwan',
    'megadrive' => 'Mega Drive',
];

foreach ($platforms as $folder => $name) {
    echo "=== {$name} ===" . PHP_EOL;
    
    try {
        $files = \Storage::disk('r2')->files("taxonomy/{$folder}");
        
        if (empty($files)) {
            echo "  Vide" . PHP_EOL . PHP_EOL;
            continue;
        }
        
        // Prendre 5 exemples au hasard
        $samples = array_slice($files, 0, 5);
        
        foreach ($samples as $file) {
            echo "  " . basename($file) . PHP_EOL;
        }
        
        echo PHP_EOL;
    } catch (\Exception $e) {
        echo "  Erreur: " . $e->getMessage() . PHP_EOL . PHP_EOL;
    }
}
