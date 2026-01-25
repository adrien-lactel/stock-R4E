<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\ArticleType;
use App\Models\ArticleSubCategory;

// Créer un test de mise à jour directe
$type = ArticleType::whereHas('subCategory', function($q) {
    $q->where('name', 'Game Boy Color');
})->first();

if ($type) {
    echo "🔍 Test de mise à jour de description\n";
    echo "=====================================\n\n";
    echo "Type: {$type->name} (ID: {$type->id})\n";
    echo "Sous-catégorie: {$type->subCategory->name}\n\n";
    
    echo "Description actuelle:\n";
    echo substr($type->description, 0, 100) . "...\n\n";
    
    // Test de mise à jour
    $nouvellDescription = "TEST - " . date('Y-m-d H:i:s') . " - Game Boy couleur (1998). Écran TFT 160×144px 56 couleurs.";
    
    echo "Tentative de mise à jour...\n";
    $result = ArticleType::where('id', $type->id)->update(['description' => $nouvellDescription]);
    
    echo "Résultat update(): " . ($result ? "SUCCESS (1 ligne modifiée)" : "FAILED (0 ligne)") . "\n\n";
    
    // Recharger depuis la DB
    $type->refresh();
    
    echo "Description après update:\n";
    echo substr($type->description, 0, 150) . "...\n";
    
    if (strpos($type->description, 'TEST') !== false) {
        echo "\n✅ La mise à jour fonctionne correctement!\n";
    } else {
        echo "\n❌ La mise à jour n'a pas fonctionné!\n";
    }
} else {
    echo "❌ Type Game Boy Color non trouvé\n";
}
