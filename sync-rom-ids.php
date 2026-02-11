<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "🔄 Synchronisation des ROM IDs: Console → ArticleType\n\n";

$updated = 0;
$skipped = 0;

// Récupérer toutes les consoles avec un rom_id
$consoles = App\Models\Console::whereNotNull('rom_id')
    ->whereNotNull('article_type_id')
    ->with('articleType')
    ->get();

echo "Consoles à traiter: {$consoles->count()}\n\n";

foreach ($consoles as $console) {
    if (!$console->articleType) {
        echo "⚠️  Console {$console->id}: pas d'ArticleType\n";
        $skipped++;
        continue;
    }
    
    // Si l'ArticleType n'a pas déjà un rom_id, on le copie
    if (!$console->articleType->rom_id) {
        $console->articleType->rom_id = $console->rom_id;
        $console->articleType->save();
        
        echo "✅ ArticleType {$console->articleType->id} ({$console->articleType->name}): ROM ID = {$console->rom_id}\n";
        $updated++;
    } else {
        echo "⏭️  ArticleType {$console->articleType->id}: ROM ID déjà défini ({$console->articleType->rom_id})\n";
        $skipped++;
    }
}

echo "\n";
echo "═══════════════════════════\n";
echo "✅ Mis à jour: $updated\n";
echo "⏭️  Ignorés: $skipped\n";
echo "═══════════════════════════\n";
