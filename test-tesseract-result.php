<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

$service = app(\App\Services\TesseractOcrService::class);
$result = $service->analyzeGamingProduct('public/images/test-cartridge.jpg');

echo "=== RÉSULTAT TESSERACT OCR ===\n\n";

echo "ROM ID détecté: " . ($result['suggestions']['rom_id'] ?? 'Non détecté') . "\n";
echo "Nom du jeu: " . ($result['suggestions']['name'] ?? 'Non détecté') . "\n";
echo "Catégorie: " . ($result['suggestions']['category'] ?? 'Non détecté') . "\n\n";

echo "Textes détectés:\n";
foreach ($result['text'] as $i => $text) {
    echo sprintf("%2d. %s\n", $i + 1, $text);
}
