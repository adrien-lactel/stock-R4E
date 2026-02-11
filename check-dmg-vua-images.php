<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "=== Vérification des images DMG-VUA ===" . PHP_EOL . PHP_EOL;

$type = \App\Models\ArticleType::where('name', 'like', '%DMG-VUA%')->first();

if (!$type) {
    echo "❌ Type DMG-VUA non trouvé" . PHP_EOL;
    exit;
}

echo "✅ Type trouvé: {$type->name} (ID: {$type->id})" . PHP_EOL . PHP_EOL;

$consoles = \App\Models\Console::where('article_type_id', $type->id)->get();

echo "📦 Nombre total de consoles avec ce type: {$consoles->count()}" . PHP_EOL . PHP_EOL;

$consolesWithImages = $consoles->filter(function($c) {
    return !empty($c->article_images) && is_array($c->article_images) && count($c->article_images) > 0;
});

echo "🖼️  Consoles avec images: {$consolesWithImages->count()}" . PHP_EOL . PHP_EOL;

if ($consolesWithImages->count() > 0) {
    foreach ($consolesWithImages as $console) {
        echo "Console #{$console->id}:" . PHP_EOL;
        echo "  Nombre d'images: " . count($console->article_images) . PHP_EOL;
        foreach ($console->article_images as $idx => $url) {
            echo "    [{$idx}] {$url}" . PHP_EOL;
        }
        echo PHP_EOL;
    }
} else {
    echo "⚠️  Aucune console avec images trouvée pour ce type" . PHP_EOL;
}

// Test de la méthode du controller
echo "=== Test de l'endpoint API ===" . PHP_EOL;
$controller = new \App\Http\Controllers\Admin\TaxonomyController();
$response = $controller->getArticlesImagesByType($type->id);
$data = json_decode($response->getContent(), true);

echo "Success: " . ($data['success'] ? 'OUI' : 'NON') . PHP_EOL;
echo "Nombre d'images retournées: " . $data['count'] . PHP_EOL;

if ($data['count'] > 0) {
    echo "Images:" . PHP_EOL;
    foreach ($data['images'] as $idx => $url) {
        echo "  [{$idx}] {$url}" . PHP_EOL;
    }
}
