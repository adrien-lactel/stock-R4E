<?php

require __DIR__ . '/vendor/autoload.php';
$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(Illuminate\Contracts\Console\Kernel::class)->bootstrap();

echo "🔍 Vérification Nintendo et Game Boy\n\n";

// Vérifier la marque Nintendo
echo "📋 Recherche marque 'Nintendo':\n";
$brands = DB::table('article_brands')
    ->where('name', 'LIKE', '%Nintendo%')
    ->orWhere('name', 'LIKE', '%nintendo%')
    ->get(['id', 'name']);

if ($brands->count() > 0) {
    foreach ($brands as $brand) {
        echo "  ✅ {$brand->name} (ID: {$brand->id})\n";
    }
} else {
    echo "  ❌ Aucune marque 'Nintendo' trouvée\n";
    echo "  Marques disponibles:\n";
    $allBrands = DB::table('article_brands')->orderBy('name')->get(['id', 'name']);
    foreach ($allBrands as $b) {
        echo "    - {$b->name} (ID: {$b->id})\n";
    }
}

echo "\n📋 Recherche sous-catégorie 'Game Boy':\n";
$subCats = DB::table('article_sub_categories')
    ->where('name', 'LIKE', '%Game Boy%')
    ->orWhere('name', 'LIKE', '%game boy%')
    ->orWhere('name', 'LIKE', '%GameBoy%')
    ->get(['id', 'name', 'article_brand_id']);

if ($subCats->count() > 0) {
    foreach ($subCats as $sub) {
        $brand = DB::table('article_brands')->where('id', $sub->article_brand_id)->first();
        echo "  ✅ {$sub->name} (ID: {$sub->id}, Marque ID: {$sub->article_brand_id} = " . ($brand ? $brand->name : 'N/A') . ")\n";
    }
} else {
    echo "  ❌ Aucune sous-catégorie 'Game Boy' trouvée\n";
    echo "  Premières sous-catégories disponibles:\n";
    $allSubs = DB::table('article_sub_categories')->orderBy('name')->limit(20)->get(['id', 'name', 'article_brand_id']);
    foreach ($allSubs as $s) {
        echo "    - {$s->name} (ID: {$s->id})\n";
    }
}
