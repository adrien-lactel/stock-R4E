<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Analyse des ROM IDs ===\n\n";

// Compter combien de consoles ont un rom_id
$consolesWithRomId = App\Models\Console::whereNotNull('rom_id')->count();
echo "Consoles avec ROM ID: $consolesWithRomId\n";

// Exemple de console avec rom_id
$console = App\Models\Console::whereNotNull('rom_id')->first();
if ($console) {
    echo "\nExemple de console:\n";
    echo "  ID: {$console->id}\n";
    echo "  ROM ID: {$console->rom_id}\n";
    echo "  Article Type ID: {$console->article_type_id}\n";
    
    if ($console->articleType) {
        echo "  ArticleType: {$console->articleType->name}\n";
        echo "  ArticleType ROM ID: " . ($console->articleType->rom_id ?? 'NULL') . "\n";
    }
}

echo "\n=== Solution proposée ===\n";
echo "Copier les ROM IDs des consoles vers leurs ArticleTypes respectifs\n";
echo "Cela permettra d'afficher les images de taxonomie depuis R2\n";
