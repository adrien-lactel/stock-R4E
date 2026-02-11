<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

echo "=== Test de l'API getArticlesImagesByType ===\n\n";

$typeId = 880;

// Simuler un appel au controller
$controller = new \App\Http\Controllers\Admin\TaxonomyController();
$response = $controller->getArticlesImagesByType($typeId);

$content = $response->getContent();
$data = json_decode($content, true);

echo "Type ID: $typeId\n";
echo "Succès: " . ($data['success'] ? 'Oui' : 'Non') . "\n";
echo "Nombre d'images: " . $data['count'] . "\n\n";

if ($data['count'] > 0) {
    echo "❌ PROBLEME : Des images sont retournées alors qu'elles devraient être exclues !\n\n";
    foreach ($data['images'] as $idx => $img) {
        echo "  [$idx] " . substr($img, -60) . "\n";
    }
} else {
    echo "✅ CORRECT : Aucune image n'est retournée (les images de taxonomie sont bien exclues)\n";
}
