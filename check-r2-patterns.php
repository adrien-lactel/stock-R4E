<?php

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== Tous les jeux Game Gear ===" . PHP_EOL . PHP_EOL;

$allGameGear = \App\Models\ArticleType::whereHas('subCategory', function($q) {
    $q->where('name', 'LIKE', '%Game Gear%');
})->get(['id', 'name', 'rom_id']);

echo "Total Game Gear: " . $allGameGear->count() . PHP_EOL;

$withSlugName = 0;
$consoles = 0;

foreach ($allGameGear as $game) {
    if (str_contains($game->name, ' - ') && preg_match('/\([A-Za-z, ]+\)/', $game->name)) {
        $withSlugName++;
    } else {
        $consoles++;
    }
}

echo "  Jeux (slug - nom): {$withSlugName}" . PHP_EOL;
echo "  Consoles: {$consoles}" . PHP_EOL;
echo PHP_EOL;

// Exemples de jeux
echo "Exemples de jeux Game Gear:" . PHP_EOL;
$gameExamples = \App\Models\ArticleType::whereHas('subCategory', function($q) {
    $q->where('name', 'LIKE', '%Game Gear%');
})
->where('name', 'LIKE', '% - %')
->where('name', 'LIKE', '%(%')
->take(5)
->get(['name']);

foreach ($gameExamples as $ex) {
    echo "  {$ex->name}" . PHP_EOL;
}

echo PHP_EOL . "=== Vérification fichiers R2 autres plateformes ===" . PHP_EOL . PHP_EOL;

$platformFolders = [
    'gameboy' => 'Game Boy',
    'game boy color' => 'Game Boy Color',
    'game boy advance' => 'Game Boy Advance',
    'snes' => 'SNES',
    'nes' => 'NES',
    'wonderswan' => 'WonderSwan',
    'megadrive' => 'Mega Drive',
];

foreach ($platformFolders as $folder => $name) {
    try {
        $files = \Storage::disk('r2')->files("taxonomy/{$folder}");
        
        if (empty($files)) {
            echo "{$name}: Dossier vide" . PHP_EOL;
            continue;
        }
        
        echo "=== {$name} ({$folder}) ===" . PHP_EOL;
        echo "  Total fichiers: " . count($files) . PHP_EOL;
        
        // Analyser les 10 premiers fichiers
        $examples = array_slice($files, 0, 10);
        
        $romIdPattern = 0;
        $namePattern = 0;
        
        foreach ($examples as $file) {
            $filename = basename($file);
            
            // Pattern ROM ID: XXX-YYY-type.png
            if (preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9]+)-(cover|artwork|gameplay|logo)\.png$/i', $filename)) {
                $romIdPattern++;
            }
            // Pattern nom: Name (Region)-type.png
            elseif (preg_match('/^.+\([A-Za-z, ]+\)-(cover|artwork|gameplay|logo)\.png$/i', $filename)) {
                $namePattern++;
            }
        }
        
        echo "  Pattern ROM ID: {$romIdPattern}/10" . PHP_EOL;
        echo "  Pattern Nom: {$namePattern}/10" . PHP_EOL;
        echo "  Exemples:" . PHP_EOL;
        
        foreach (array_slice($examples, 0, 3) as $file) {
            echo "    " . basename($file) . PHP_EOL;
        }
        
        echo PHP_EOL;
    } catch (\Exception $e) {
        echo "{$name}: Erreur - " . $e->getMessage() . PHP_EOL . PHP_EOL;
    }
}
