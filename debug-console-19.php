<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

$consoleId = 19;
$console = \App\Models\Console::find($consoleId);

if (!$console) {
    echo "Console #$consoleId non trouvée\n";
    exit;
}

echo "=== Console #$consoleId ===\n\n";
echo "ROM ID: {$console->rom_id}\n";
echo "Type: " . ($console->articleType ? $console->articleType->name : 'N/A') . "\n";
echo "article_type_id: {$console->article_type_id}\n\n";

echo "--- article_images (images spécifiques de l'article) ---\n";
$articleImages = $console->article_images;
echo "Type: " . gettype($articleImages) . "\n";
echo "Vide: " . (empty($articleImages) ? 'Oui' : 'Non') . "\n";

if (is_array($articleImages) && !empty($articleImages)) {
    echo "Nombre: " . count($articleImages) . "\n";
    foreach ($articleImages as $idx => $img) {
        if (is_string($img)) {
            echo "  [$idx] (string) " . $img . "\n";
        } elseif (is_array($img)) {
            $url = $img['url'] ?? $img['path'] ?? json_encode($img);
            echo "  [$idx] (array) " . $url . "\n";
        } else {
            echo "  [$idx] (autre type) " . gettype($img) . "\n";
        }
    }
} else {
    echo "  → Aucune image uploadée pour cet article\n";
}

echo "\n--- primary_image_url ---\n";
echo $console->primary_image_url ? $console->primary_image_url : '✗ null';
echo "\n\n";

echo "--- ArticleType (taxonomie) ---\n";
$type = $console->articleType;
if ($type && !empty($type->images) && is_array($type->images)) {
    echo "Type a " . count($type->images) . " image(s) de taxonomie\n";
    foreach (array_slice($type->images, 0, 3) as $idx => $img) {
        echo "  [$idx] " . substr($img, -60) . "\n";
    }
    if (count($type->images) > 3) {
        echo "  ... et " . (count($type->images) - 3) . " autres\n";
    }
} else {
    echo "Aucune image de taxonomie\n";
}

echo "\n=== RESULTAT ===\n";
echo "Dans la page de création de fiche :\n";
echo "- Colonne 3 'Photos de l'article' : ";
if (is_array($articleImages) && !empty($articleImages)) {
    echo count($articleImages) . " image(s) affichée(s)\n";
} else {
    echo "Placeholder 'Aucune photo d'article'\n";
}
echo "\n- Modal 'Photos d'autres articles du même type' : ";
if ($type && !empty($type->images)) {
    echo count($type->images) . " image(s) de taxonomie disponibles\n";
} else {
    echo "Aucune image\n";
}
echo "\nPour ajouter des images :\n";
echo "1. Cliquer sur '📸 Gérer les photos de l'article'\n";
echo "2. Ajouter les images de la section du bas (taxonomie)\n";
echo "3. Ou uploader de nouvelles images\n";
