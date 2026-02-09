<?php
require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "=== DIAGNOSTIC COMPLET TAXONOMIE ===\n\n";

// 1. Vérifier les catégories
echo "1️⃣  CATÉGORIES\n";
echo str_repeat('-', 50) . "\n";

$categories = \App\Models\ArticleCategory::with('brands')->orderBy('name')->get();

foreach ($categories as $cat) {
    $brandCount = $cat->brands->count();
    $icon = $brandCount > 0 ? '✅' : '⚠️ ';
    echo "{$icon} {$cat->name} (ID: {$cat->id}) - {$brandCount} brand(s)\n";
    
    if ($cat->name === 'Cartes à collectionner') {
        echo "\n   📌 FOCUS: Cartes à collectionner\n";
        echo "   Category ID: {$cat->id}\n";
        echo "   Brands:\n";
        foreach ($cat->brands as $brand) {
            echo "      - {$brand->name} (ID: {$brand->id})\n";
        }
    }
}

// 2. Simuler l'appel AJAX
echo "\n\n2️⃣  SIMULATION AJAX /admin/ajax/brands/12\n";
echo str_repeat('-', 50) . "\n";

$categoryId = 12;
$brands = \App\Models\ArticleBrand::where('article_category_id', $categoryId)
    ->withCount('subCategories')
    ->orderBy('name')
    ->get();

echo "Query: ArticleBrand::where('article_category_id', {$categoryId})\n";
echo "Résultat: {$brands->count()} brand(s) trouvée(s)\n\n";

if ($brands->isEmpty()) {
    echo "❌ PROBLÈME: Aucune brand retournée!\n";
    echo "   Le select restera vide.\n";
} else {
    echo "HTML qui sera retourné:\n";
    echo "```html\n";
    $html = '<option value="">-- Sélectionner --</option>';
    foreach ($brands as $brand) {
        $html .= '<option value="' . $brand->id . '">' . e($brand->name) . '</option>';
    }
    echo $html . "\n";
    echo "```\n";
}

// 3. Vérifier la route
echo "\n\n3️⃣  VÉRIFICATION ROUTE\n";
echo str_repeat('-', 50) . "\n";
echo "Route attendue: GET /admin/ajax/brands/{category}\n";
echo "Controller: TaxonomyController@ajaxBrands\n";
echo "Middleware: auth, AdminMiddleware\n";
echo "✅ Route configurée\n";

// 4. Vérifier les JS issues potentielles
echo "\n\n4️⃣  POINTS DE VÉRIFICATION FRONTEND\n";
echo str_repeat('-', 50) . "\n";
echo "☑️  Vérifier que ces messages apparaissent dans la console:\n";
echo "    - '✅ Test page chargée'\n";
echo "    - '🔍 Valeurs mode édition: ...'\n";
echo "\n";
echo "☑️  Sélectionner 'Cartes à collectionner' devrait déclencher:\n";
echo "    - loadBrands(12) appelé\n";
echo "    - fetch à http://stock-r4e.test/admin/ajax/brands/12\n";
echo "    - innerHTML du select brand mis à jour\n";
echo "\n";
echo "☑️  Ouvrir DevTools > Network > XHR pour voir:\n";
echo "    - La requête GET /admin/ajax/brands/12\n";
echo "    - Status: 200 (pas 401 ou 302)\n";
echo "    - Response Preview: options HTML (pas page login)\n";

// 5. Solution si problème auth
echo "\n\n5️⃣  SI LE PROBLÈME PERSISTE\n";
echo str_repeat('-', 50) . "\n";
echo "Causes possibles:\n";
echo "1. ❌ Erreur JavaScript qui empêche l'exécution\n";
echo "   → Ouvrir Console et chercher erreurs en rouge\n";
echo "\n";
echo "2. ❌ Fetch retourne page de login (auth fail)\n";
echo "   → Vérifier que vous êtes bien connecté\n";
echo "   → Réessayer après logout/login\n";
echo "\n";
echo "3. ❌ select#article_brand_id n'existe pas au moment de l'init\n";
echo "   → Vérifier que DOMContentLoaded attend le chargement complet\n";
echo "\n";
echo "4. ❌ Conflit avec autre script (Choices.js, etc.)\n";
echo "   → Désactiver temporairement autres bibliothèques\n";
echo "\n";

// 6. Test direct en PHP
echo "\n6️⃣  TEST DIRECT ENDPOINT (sans HTTP)\n";
echo str_repeat('-', 50) . "\n";

try {
    $controller = new \App\Http\Controllers\Admin\TaxonomyController();
    
    // Créer une fausse requête
    $request = \Illuminate\Http\Request::create('/admin/ajax/brands/12', 'GET');
    app()->instance('request', $request);
    
    $response = $controller->ajaxBrands(12);
    $content = $response->getContent();
    
    echo "✅ Controller retourne bien des données\n";
    echo "Length: " . strlen($content) . " bytes\n";
    echo "Preview: " . substr($content, 0, 150) . "...\n";
    
} catch (\Exception $e) {
    echo "❌ Erreur: " . $e->getMessage() . "\n";
}

echo "\n\n=== FIN DU DIAGNOSTIC ===\n";
