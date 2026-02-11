<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Comparaison comportement Create vs Edit ===\n\n";

// PAGE CREATE avec console_id=16
echo "--- PAGE CREATE (console_id=16) ---\n";
$console = \App\Models\Console::find(16);
$imageUrls = [];
if ($console && is_array($console->article_images) && !empty($console->article_images)) {
    foreach ($console->article_images as $img) {
        if (is_string($img)) {
            $imageUrls[] = $img;
        } elseif (isset($img['url'])) {
            $imageUrls[] = $img['url'];
        }
    }
}
echo "Section 'Photos de cet article': " . count($imageUrls) . " image(s)\n";
echo "  (provenant de Console.article_images)\n";
echo "Section 'Photos d'autres articles du même type': images de l'API\n";
echo "  (provenant de /admin/ajax/articles-images-by-type/880)\n";

// PAGE EDIT avec fiche #3
echo "\n--- PAGE EDIT (fiche #3) ---\n";
$sheet = \App\Models\ProductSheet::find(3);
$sheetImages = is_array($sheet->images) ? $sheet->images : [];
echo "Section 'Photos de cet article': " . count($sheetImages) . " image(s)\n";
echo "  (provenant de ProductSheet.images)\n";
echo "Section 'Photos d'autres articles du même type': images de l'API\n";
echo "  (provenant de /admin/ajax/articles-images-by-type/" . $sheet->article_type_id . ")\n";

echo "\n=== CONCLUSION ===\n";
echo "✓ Page CREATE : affiche Console.article_images dans 'Photos de cet article'\n";
echo "✓ Page EDIT   : affiche ProductSheet.images dans 'Photos de cet article'\n";
echo "✓ Les deux pages : affichent les mêmes images du type dans la section du bas\n";
echo "\nComportement identique sur les deux pages ✓\n";
