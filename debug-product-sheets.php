<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Diagnostic Fiches Produits ===\n\n";

// Récupérer quelques fiches produits pour tester
$sheets = \App\Models\ProductSheet::with('articleType')->limit(5)->get();

if ($sheets->count() === 0) {
    echo "Aucune fiche produit trouvée en base de données.\n";
    exit;
}

foreach ($sheets as $sheet) {
    echo "--- Fiche #{$sheet->id}: {$sheet->name} ---\n";
    echo "Type: " . ($sheet->articleType ? $sheet->articleType->name : 'N/A') . "\n";
    echo "article_type_id: {$sheet->article_type_id}\n";
    
    echo "Images de la fiche (ProductSheet.images):\n";
    if (is_array($sheet->images) && !empty($sheet->images)) {
        echo "  Nombre: " . count($sheet->images) . "\n";
        foreach ($sheet->images as $idx => $img) {
            $shortUrl = is_string($img) ? substr($img, -60) : 'non-string';
            $folder = '';
            if (is_string($img)) {
                if (str_contains($img, '/taxonomie/')) $folder = '[TAXONOMIE]';
                elseif (str_contains($img, '/articles/')) $folder = '[ARTICLES]';
                elseif (str_contains($img, '/products/')) $folder = '[PRODUCTS]';
            }
            echo "  [$idx] $folder $shortUrl\n";
        }
    } else {
        echo "  ✗ Aucune image\n";
    }
    
    echo "Image principale: " . ($sheet->main_image ? substr($sheet->main_image, -60) : 'null') . "\n";
    echo "\n";
}

echo "=== Résumé ===\n";
echo "Total fiches analysées: " . $sheets->count() . "\n";
echo "\nDans la page d'édition, la section 'Photos de cet article' affichera\n";
echo "uniquement les images contenues dans ProductSheet.images\n";
echo "(qui doivent être dans le dossier /articles/ ou /products/ de R2)\n";
