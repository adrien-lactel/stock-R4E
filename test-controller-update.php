<?php

require 'vendor/autoload.php';
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\Console;
use App\Models\ArticleType;

echo "🧪 SIMULATION MISE À JOUR DESCRIPTION\n";
echo "=====================================\n\n";

// 1. Trouver un article
$console = Console::whereHas('articleType', function($q) {
    $q->whereHas('subCategory', function($q2) {
        $q2->where('name', 'Game Boy Color');
    });
})->first();

if (!$console) {
    echo "❌ Aucun article Game Boy Color trouvé\n";
    exit;
}

$type = $console->articleType;

echo "📦 Article sélectionné:\n";
echo "   ID: {$console->id}\n";
echo "   Type: {$type->name} (ID: {$type->id})\n";
echo "   Sous-catégorie: {$type->subCategory->name}\n\n";

echo "📄 Description actuelle:\n";
echo "   " . substr($type->description, 0, 100) . "...\n\n";

// 2. Simuler la mise à jour comme le fait le contrôleur
$nouvellDescription = "[MODIFIÉ " . date('H:i:s') . "] Game Boy couleur (1998). Écran TFT 160×144px 56 couleurs, processeur 8MHz. Compatible GB/GBC. Jeux phares : Pokémon Or/Argent/Cristal, Zelda Oracle, Mario Tennis.";

echo "🔄 Simulation de la mise à jour...\n";
echo "   Code exécuté: ArticleType::where('id', {$type->id})->update(['description' => ...])\n\n";

$result = ArticleType::where('id', $type->id)->update(['description' => $nouvellDescription]);

echo "   Résultat: " . ($result ? "✅ {$result} ligne(s) modifiée(s)" : "❌ Aucune modification") . "\n\n";

// 3. Recharger et vérifier
$type->refresh();

echo "✅ Vérification après update:\n";
echo "   Description: " . substr($type->description, 0, 120) . "...\n\n";

if (strpos($type->description, '[MODIFIÉ') !== false) {
    echo "🎉 SUCCESS! La description a bien été mise à jour dans la base de données.\n";
    echo "\n💡 Si la modification ne s'enregistre pas depuis le formulaire, vérifiez:\n";
    echo "   1. Que le champ 'article_type_description' est bien dans le formulaire\n";
    echo "   2. Que le JavaScript charge la description au chargement de la page\n";
    echo "   3. Que le contrôleur reçoit bien la valeur (vérifier les logs)\n";
} else {
    echo "❌ ÉCHEC! La description n'a pas été modifiée.\n";
}
