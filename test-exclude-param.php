<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$typeId = 880;

echo "=== Test API avec/sans exclude_taxonomy ===\n\n";

// Simuler un appel SANS exclude_taxonomy (pour /admin/articles/create)
echo "--- SANS exclude_taxonomy (page création article) ---\n";
$controller = new \App\Http\Controllers\Admin\TaxonomyController();
$response = $controller->getArticlesImagesByType($typeId);
$data = json_decode($response->getContent(), true);
echo "Images retournées: " . $data['count'] . "\n";
if ($data['count'] > 0) {
    foreach ($data['images'] as $idx => $img) {
        echo "  [$idx] " . substr($img, -60) . "\n";
    }
} else {
    echo "  (aucune image)\n";
}

echo "\n--- AVEC exclude_taxonomy=1 (page création fiche produit) ---\n";
// Simuler un appel AVEC exclude_taxonomy
$_GET['exclude_taxonomy'] = '1';
$response2 = $controller->getArticlesImagesByType($typeId);
$data2 = json_decode($response2->getContent(), true);
echo "Images retournées: " . $data2['count'] . "\n";
if ($data2['count'] > 0) {
    foreach ($data2['images'] as $idx => $img) {
        echo "  [$idx] " . substr($img, -60) . "\n";
    }
} else {
    echo "  (aucune image - normal, taxonomie exclue)\n";
}

echo "\n=== RESULTAT ===\n";
echo "✓ Sans exclude_taxonomy: " . $data['count'] . " image(s) - pour page articles\n";
echo "✓ Avec exclude_taxonomy: " . $data2['count'] . " image(s) - pour page fiches produits\n";
