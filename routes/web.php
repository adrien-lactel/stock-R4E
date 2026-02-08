<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| Controllers
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\ConsoleAdminController;
// use App\Http\Controllers\Admin\ConsolePriceController; // DÉSACTIVÉ - Vue prix console retirée
use App\Http\Controllers\Admin\StoreAdminController;
use App\Http\Controllers\Admin\StoreStockController;
use App\Http\Controllers\Admin\ConsoleReturnController;
use App\Http\Controllers\Admin\RepairQuoteAdminController;
use App\Http\Controllers\Admin\TaxonomyController;
use App\Http\Controllers\Admin\ConsoleOfferController;
use App\Http\Controllers\Admin\ProductSheetController;
use App\Http\Controllers\Store\DashboardController as StoreDashboardController;
use App\Http\Controllers\Store\StoreOfferController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Admin\RepairerAdminController;
use App\Http\Controllers\Admin\FeatureRequestController;
use App\Http\Controllers\ImageProxyController;




/*
|--------------------------------------------------------------------------
| Public
|--------------------------------------------------------------------------
*/
Route::get('/', function() {
    return auth()->check() ? redirect('/dashboard') : redirect('/login');
});

/*
|--------------------------------------------------------------------------
| Image Proxy (CORS fix for R2)
|--------------------------------------------------------------------------
*/
Route::get('/proxy/images/taxonomy/{folder}/{filename}', [ImageProxyController::class, 'proxyTaxonomyImage'])
    ->name('proxy.taxonomy-image')
    ->where('folder', '[a-z0-9 ]+')
    ->where('filename', '.+');

/*
|--------------------------------------------------------------------------
| Debug endpoint (temporary - remove in production)
|--------------------------------------------------------------------------
*/
Route::get('/debug/publishers', function() {
    try {
        $query = request()->input('q', '');
        $publishers = \App\Models\Publisher::where('name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get(['id', 'name', 'slug']);
        return response()->json([
            'success' => true,
            'count' => $publishers->count(),
            'publishers' => $publishers
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString()
        ], 200);
    }
});

Route::get('/debug/r2-config', function() {
    return response()->json([
        'R2_ACCESS_KEY_ID' => config('filesystems.disks.r2.key') ? 'SET' : 'NOT SET',
        'R2_SECRET_ACCESS_KEY' => config('filesystems.disks.r2.secret') ? 'SET' : 'NOT SET',
        'R2_BUCKET' => config('filesystems.disks.r2.bucket'),
        'R2_ENDPOINT' => config('filesystems.disks.r2.endpoint'),
        'R2_URL' => config('filesystems.disks.r2.url'),
        'R2_PUBLIC_URL' => env('R2_PUBLIC_URL'),
    ]);
});

Route::get('/debug/taxonomy', function() {
    $categories = DB::table('article_categories')->get(['id', 'name']);
    $brands = DB::table('article_brands')->limit(10)->get(['id', 'name']);
    $subCategories = DB::table('article_sub_categories')->limit(10)->get(['id', 'name', 'article_brand_id']);
    
    return response()->json([
        'categories_count' => $categories->count(),
        'brands_count' => DB::table('article_brands')->count(),
        'sub_categories_count' => DB::table('article_sub_categories')->count(),
        'types_count' => DB::table('article_types')->count(),
        'sample_categories' => $categories,
        'sample_brands' => $brands,
        'sample_sub_categories' => $subCategories,
    ]);
});

/*
|--------------------------------------------------------------------------
| Auth dashboard fallback
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif (auth()->user()->role === 'store') {
        $storeId = auth()->user()->store_id;
        if ($storeId) {
            return redirect()->route('store.dashboard', $storeId);
        }
        // If no store attached yet, fallback to generic dashboard view
        return view('dashboard');
    } elseif (auth()->user()->role === 'repairer') {
        return redirect()->route('repairer.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| =========================
| ADMIN ROUTES
| =========================
*/
use App\Http\Controllers\Admin\OperationAdminController;
use App\Http\Controllers\Admin\AccessoryAdminController;

Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        /* =====================
        | OPÉRATIONS
        ===================== */
        Route::get('/operations', [OperationAdminController::class, 'index'])->name('operations.index');
        Route::get('/operations/create', [OperationAdminController::class, 'create'])->name('operations.create');
        Route::post('/operations', [OperationAdminController::class, 'store'])->name('operations.store');
        Route::get('/operations/{operation}/edit', [OperationAdminController::class, 'edit'])->name('operations.edit');
        Route::put('/operations/{operation}', [OperationAdminController::class, 'update'])->name('operations.update');
        Route::delete('/operations/{operation}', [OperationAdminController::class, 'destroy'])->name('operations.destroy');

        /* =====================
        | ACCESSOIRES
        ===================== */
        Route::get('/accessories', [AccessoryAdminController::class, 'index'])->name('accessories.index');
        Route::get('/accessories/create', [AccessoryAdminController::class, 'create'])->name('accessories.create');
        Route::post('/accessories', [AccessoryAdminController::class, 'store'])->name('accessories.store');
        Route::get('/accessories/report', [AccessoryAdminController::class, 'report'])->name('accessories.report');
        Route::get('/accessories/{accessory}/edit', [AccessoryAdminController::class, 'edit'])->name('accessories.edit');
        Route::put('/accessories/{accessory}', [AccessoryAdminController::class, 'update'])->name('accessories.update');
        Route::patch('/accessories/{accessory}/valorisation', [AccessoryAdminController::class, 'updateValorisation'])->name('accessories.update-valorisation');
        Route::delete('/accessories/{accessory}', [AccessoryAdminController::class, 'destroy'])->name('accessories.destroy');

        /* =====================
        | GOOGLE VISION SETUP GUIDE
        ===================== */
        Route::get('/google-vision-setup', function () {
            return view('admin.google-vision-setup');
        })->name('google-vision-setup');

        /* =====================
        | ÉDITEURS
        ===================== */
        Route::get('/publishers', [App\Http\Controllers\Admin\PublisherAdminController::class, 'index'])->name('publishers.index');
        Route::get('/publishers/create', [App\Http\Controllers\Admin\PublisherAdminController::class, 'create'])->name('publishers.create');
        Route::post('/publishers', [App\Http\Controllers\Admin\PublisherAdminController::class, 'store'])->name('publishers.store');
        Route::post('/publishers/upload-logo', [App\Http\Controllers\Admin\PublisherAdminController::class, 'uploadLogo'])->name('publishers.upload-logo');
        Route::get('/publishers/{publisher}/edit', [App\Http\Controllers\Admin\PublisherAdminController::class, 'edit'])->name('publishers.edit');
        Route::put('/publishers/{publisher}', [App\Http\Controllers\Admin\PublisherAdminController::class, 'update'])->name('publishers.update');
        Route::delete('/publishers/{publisher}', [App\Http\Controllers\Admin\PublisherAdminController::class, 'destroy'])->name('publishers.destroy');

        /* =====================
        | RÉPARATEURS
        ===================== */
        Route::get('/repairers', [RepairerAdminController::class, 'index'])->name('repairers.index');

        Route::get('/repairers/create', [RepairerAdminController::class, 'create'])->name('repairers.create');
        Route::post('/repairers', [RepairerAdminController::class, 'store'])->name('repairers.store');

        Route::get('/repairers/{repairer}', [RepairerAdminController::class, 'show'])->name('repairers.show');
        Route::get('/repairers/{repairer}/edit', [RepairerAdminController::class, 'edit'])->name('repairers.edit');
        Route::put('/repairers/{repairer}', [RepairerAdminController::class, 'update'])->name('repairers.update');
        Route::delete('/repairers/{repairer}', [RepairerAdminController::class, 'destroy'])->name('repairers.destroy');
        Route::post('/repairers/{repairer}/operations', [RepairerAdminController::class, 'updateOperations'])->name('repairers.operations.update');

        /* =====================
        | TAXONOMIE
        ===================== */
        Route::get('/taxonomy', [TaxonomyController::class, 'index'])
            ->name('taxonomy.index');

        /* =====================
        | GAME BOY IMPORT
        ===================== */
        Route::get('/gameboy/import', [\App\Http\Controllers\Admin\GameBoyImportController::class, 'index'])
            ->name('gameboy.import');
        
        Route::post('/gameboy/import', [\App\Http\Controllers\Admin\GameBoyImportController::class, 'import'])
            ->name('gameboy.import.run');

        Route::get('/test-autocomplete', function() {
            return view('admin.test-autocomplete-debug');
        })->name('test-autocomplete');

        Route::post('/taxonomy/category', [TaxonomyController::class, 'storeCategory'])
            ->name('taxonomy.category.store');

        Route::post('/taxonomy/sub-category', [TaxonomyController::class, 'storeSubCategory'])
            ->name('taxonomy.sub-category.store');

        Route::post('/taxonomy/brand', [TaxonomyController::class, 'storeBrand'])
            ->name('taxonomy.brand.store');

        Route::post('/taxonomy/type', [TaxonomyController::class, 'storeType'])
            ->name('taxonomy.type.store');
        
        // UPDATE
        Route::put('/taxonomy/category/{category}', [TaxonomyController::class, 'updateCategory'])
            ->name('taxonomy.category.update');

        Route::put('/taxonomy/brand/{brand}', [TaxonomyController::class, 'updateBrand'])
            ->name('taxonomy.brand.update');

        Route::put('/taxonomy/sub-category/{subCategory}', [TaxonomyController::class, 'updateSubCategory'])
            ->name('taxonomy.sub-category.update');

        Route::put('/taxonomy/type/{type}', [TaxonomyController::class, 'updateType'])
            ->name('taxonomy.type.update');

        // DELETE (optionnel mais utile)
        Route::delete('/taxonomy/category/{category}', [TaxonomyController::class, 'destroyCategory'])
            ->name('taxonomy.category.destroy');

        Route::delete('/taxonomy/brand/{brand}', [TaxonomyController::class, 'destroyBrand'])
            ->name('taxonomy.brand.destroy');

        Route::delete('/taxonomy/sub-category/{subCategory}', [TaxonomyController::class, 'destroySubCategory'])
            ->name('taxonomy.sub-category.destroy');

        Route::delete('/taxonomy/type/{type}', [TaxonomyController::class, 'destroyType'])
            ->name('taxonomy.type.destroy');

        /* =====================
        | AJAX TAXONOMIE (🔥 IMPORTANT)
        ===================== */
        Route::post('/taxonomy/type/auto-create', [TaxonomyController::class, 'autoCreateType'])
            ->name('taxonomy.type.auto-create');
        
        Route::post('/taxonomy/brand/auto-create', [TaxonomyController::class, 'autoCreateBrand'])
            ->name('taxonomy.brand.auto-create');
        
        // Gestion des images de taxonomie
        Route::get('/taxonomy/get-images', [TaxonomyController::class, 'getTaxonomyImages'])
            ->name('taxonomy.get-images');
        
        Route::post('/taxonomy/upload-image', [TaxonomyController::class, 'uploadTaxonomyImage'])
            ->name('taxonomy.upload-image');
        
        Route::post('/taxonomy/rename-image', [TaxonomyController::class, 'renameTaxonomyImage'])
            ->name('taxonomy.rename-image');
        
        Route::post('/taxonomy/set-primary-image', [TaxonomyController::class, 'setPrimaryImage'])
            ->name('taxonomy.set-primary-image');
        
        Route::delete('/taxonomy/delete-image', [TaxonomyController::class, 'deleteTaxonomyImage'])
            ->name('taxonomy.delete-image');
        
        Route::get('/ajax/brands/{category}', [TaxonomyController::class, 'ajaxBrands'])
            ->name('ajax.brands');

        Route::get('/ajax/sub-categories/{brand}', [TaxonomyController::class, 'ajaxSubCategories'])
            ->name('ajax.sub-categories');

        Route::get('/ajax/types/{subCategory}', [TaxonomyController::class, 'ajaxTypes'])
            ->name('ajax.types');

        Route::get('/ajax/type-description/{type}', [TaxonomyController::class, 'ajaxTypeDescription'])
            ->name('ajax.type-description');
        
        Route::get('/ajax/article-type-images/{typeId}', [TaxonomyController::class, 'getArticleTypeImages'])
            ->name('ajax.article-type-images');
        
        Route::get('/ajax/lookup-rom-id/{romId}', [TaxonomyController::class, 'lookupRomId'])
            ->name('ajax.lookup-rom-id');

        /* =====================
        | AJAX RECHERCHE JEUX
        ===================== */
        Route::get('/ajax/search-game', [ConsoleAdminController::class, 'searchGame'])
            ->name('ajax.search-game');
        
        Route::get('/ajax/search-game-romid', [ConsoleAdminController::class, 'searchGameByRomId'])
            ->name('ajax.search-game-romid');

        Route::get('/ajax/search-game-name', [ConsoleAdminController::class, 'searchGameByName'])
            ->name('ajax.search-game-name');
        
        Route::post('/ajax/update-game-field', [ConsoleAdminController::class, 'updateGameField'])
            ->name('ajax.update-game-field');

        Route::get('/ajax/search-publishers', [ConsoleAdminController::class, 'searchPublishers'])
            ->name('ajax.search-publishers');
        
        Route::post('/ajax/create-publisher', [ConsoleAdminController::class, 'createPublisher'])
            ->name('ajax.create-publisher');

        /* =====================
        | DASHBOARD
        ===================== */
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        /* =====================
        | BUGS & DEMANDES D'ÉVOLUTION
        ===================== */
        Route::get('/feature-requests', [FeatureRequestController::class, 'index'])
            ->name('feature-requests.index');
        
        Route::post('/feature-requests', [FeatureRequestController::class, 'store'])
            ->name('feature-requests.store');
        
        Route::patch('/feature-requests/{featureRequest}', [FeatureRequestController::class, 'update'])
            ->name('feature-requests.update');
        
        Route::patch('/feature-requests/{featureRequest}/status', [FeatureRequestController::class, 'updateStatus'])
            ->name('feature-requests.update-status');
        
        Route::post('/feature-requests/{featureRequest}/response', [FeatureRequestController::class, 'addResponse'])
            ->name('feature-requests.add-response');
        
        Route::delete('/feature-requests/{featureRequest}', [FeatureRequestController::class, 'destroy'])
            ->name('feature-requests.destroy');

        /* =====================
        | FICHES PRODUITS
        ===================== */
        Route::get('/product-sheets', [ProductSheetController::class, 'index'])
            ->name('product-sheets.index');

        Route::get('/product-sheets/images-manager', [ProductSheetController::class, 'imagesManager'])
            ->name('product-sheets.images-manager');

        Route::post('/product-sheets/images-manager/upload', [ProductSheetController::class, 'uploadTaxonomyImage'])
            ->name('product-sheets.images-manager.upload');

        Route::delete('/product-sheets/images-manager/delete', [ProductSheetController::class, 'deleteTaxonomyImage'])
            ->name('product-sheets.images-manager.delete');

        Route::get('/product-sheets/create', [ProductSheetController::class, 'create'])
            ->name('product-sheets.create');

        Route::post('/product-sheets', [ProductSheetController::class, 'store'])
            ->name('product-sheets.store');

        Route::get('/product-sheets/{productSheet}/edit', [ProductSheetController::class, 'edit'])
            ->name('product-sheets.edit');

        Route::put('/product-sheets/{productSheet}', [ProductSheetController::class, 'update'])
            ->name('product-sheets.update');

        Route::delete('/product-sheets/{productSheet}', [ProductSheetController::class, 'destroy'])
            ->name('product-sheets.destroy');

        // Upload et suppression d'images
        Route::post('/product-sheets/upload-image', [ProductSheetController::class, 'uploadImage'])
            ->name('product-sheets.upload-image');

        Route::post('/product-sheets/upload-from-url', [ProductSheetController::class, 'uploadFromUrl'])
            ->name('product-sheets.upload-from-url');

        Route::delete('/product-sheets/delete-image', [ProductSheetController::class, 'deleteImage'])
            ->name('product-sheets.delete-image');

        // Lookup Game Boy ROM ID
        Route::get('/product-sheets/autocomplete-rom', [ProductSheetController::class, 'autocompleteRomId'])
            ->name('product-sheets.autocomplete-rom');
        
        Route::get('/product-sheets/lookup-rom/{romId}', [ProductSheetController::class, 'lookupRomId'])
            ->name('product-sheets.lookup-rom');

        // Galerie d'images de taxonomie
        Route::get('/product-sheets/taxonomy-images', [ProductSheetController::class, 'getTaxonomyImages'])
            ->name('product-sheets.taxonomy-images');

        // Duplication de fiche
        Route::post('/product-sheets/{productSheet}/duplicate', [ProductSheetController::class, 'duplicate'])
            ->name('product-sheets.duplicate');

        /* =====================
        | ARTICLES
        ===================== */
        Route::get('/articles/create', [ConsoleAdminController::class, 'createArticle'])
            ->name('articles.create');

        Route::post('/articles', [ConsoleAdminController::class, 'storeArticle'])
            ->name('articles.store');

        Route::get('/articles/{console}/edit', [ConsoleAdminController::class, 'editArticle'])
            ->name('articles.edit');

        // Full editor (separate route to open the complete edit form)
        Route::get('/articles/{console}/edit-full', [ConsoleAdminController::class, 'editArticleFull'])
            ->name('articles.edit_full');

        // Recent articles list (40 latest) with taxonomy filters
        Route::get('/articles/recent', [ConsoleAdminController::class, 'recentArticles'])
            ->name('articles.recent');

        Route::put('/articles/{console}', [ConsoleAdminController::class, 'updateArticle'])
            ->name('articles.update');
        // Alias pour compatibilité avec admin namespace (formulaires inclus dans admin)
        Route::put('/articles/{console}', [ConsoleAdminController::class, 'updateArticle'])
            ->name('articles.update');

        Route::delete('/articles/{console}', [ConsoleAdminController::class, 'destroyArticle'])
            ->name('articles.destroy');

        // Upload et suppression d'images d'articles
        Route::post('/articles/upload-image', [ConsoleAdminController::class, 'uploadArticleImage'])
            ->name('articles.upload-image');

        Route::post('/articles/delete-image', [ConsoleAdminController::class, 'deleteArticleImage'])
            ->name('articles.delete-image');

        Route::post('/articles/hide-local-image', [ConsoleAdminController::class, 'hideLocalImage'])
            ->name('articles.hide-local-image');

        // Analyse IA d'une image
        Route::post('/articles/analyze-image', [ConsoleAdminController::class, 'analyzeImageAI'])
            ->name('articles.analyze-image');

        /* =====================
        | CONSOLES
        ===================== */
        Route::get('/consoles', [ConsoleAdminController::class, 'index'])
            ->name('consoles.index');

        Route::get('/consoles/disabled', [ConsoleAdminController::class, 'disabled'])
            ->name('consoles.disabled');

        Route::get('/consoles/{console}/valorize', [ConsoleAdminController::class, 'valorize'])
            ->name('consoles.valorize');

        Route::post('/consoles/{console}/valorize', [ConsoleAdminController::class, 'storeValorization'])
            ->name('consoles.valorize.store');

        Route::get('/consoles/{console}/edit', [ConsoleAdminController::class, 'edit'])
            ->name('consoles.edit');

        Route::post('/consoles/{console}/prices', [ConsoleAdminController::class, 'storePrice'])
            ->name('consoles.prices.store');

        Route::post('/consoles/{console}/status', [ConsoleAdminController::class, 'updateStatus'])
            ->name('consoles.status.update');

        Route::patch('/consoles/{console}/status', [ConsoleAdminController::class, 'updateStatus'])
            ->name('consoles.update-status');

        Route::patch('/consoles/{console}/valorisation', [ConsoleAdminController::class, 'updateValorisation'])
            ->name('consoles.update-valorisation');

        Route::delete('/consoles/{console}/mods/{mod}', [ConsoleAdminController::class, 'removeMod'])
            ->name('consoles.remove-mod');

        /* =====================
        | PRIX / MAGASINS - DÉSACTIVÉ
        ===================== */
        // Route::get('/prices', [ConsolePriceController::class, 'index'])
        //     ->name('prices.index');

        // Route::post('/prices/{console}', [ConsolePriceController::class, 'store'])
        //     ->name('prices.store');

        /* =====================
        | MAGASINS
        ===================== */
        Route::get('/stores', [StoreAdminController::class, 'index'])
            ->name('stores.index');

        Route::get('/stores/create', [StoreAdminController::class, 'create'])
            ->name('stores.create');

        Route::post('/stores', [StoreAdminController::class, 'store'])
            ->name('stores.store');

        // edition & suppression (like for réparateurs)
        Route::get('/stores/{store}/edit', [StoreAdminController::class, 'edit'])
            ->name('stores.edit');
        Route::put('/stores/{store}', [StoreAdminController::class, 'update'])
            ->name('stores.update');
        Route::delete('/stores/{store}', [StoreAdminController::class, 'destroy'])
            ->name('stores.destroy');

        Route::get('/stores/{store}/stock', [StoreStockController::class, 'index'])
            ->name('stores.stock');

        /* =====================
        | RETOURS SAV
        ===================== */
        Route::get('/returns', [ConsoleReturnController::class, 'index'])
            ->name('returns.index');

        Route::post('/returns/{return}/approve', [ConsoleReturnController::class, 'approve'])
            ->name('returns.approve');

        Route::post('/returns/{return}/reject', [ConsoleReturnController::class, 'reject'])
            ->name('returns.reject');

        Route::post('/returns/{return}/acknowledge', [ConsoleReturnController::class, 'acknowledge'])
            ->name('returns.acknowledge');

        Route::post('/returns/{return}/propose-quote', [RepairQuoteAdminController::class, 'propose'])
            ->name('returns.propose-quote');

        Route::post('/returns/{return}/assign-repairer', [ConsoleReturnController::class, 'assignRepairer'])
            ->name('returns.assign-repairer');

        /* =====================
        | MODS
        ===================== */
        Route::resource('mods', \App\Http\Controllers\Admin\ModAdminController::class);
        Route::post('/mods/{mod}/receive-stock', [\App\Http\Controllers\Admin\ModAdminController::class, 'receiveStock'])
            ->name('mods.receive-stock');
        Route::get('/mods-distribution', [\App\Http\Controllers\Admin\ModAdminController::class, 'distribute'])
            ->name('mods.distribute');
        Route::post('/mods/{mod}/send-to-repairer', [\App\Http\Controllers\Admin\ModAdminController::class, 'sendToRepairer'])
            ->name('mods.send-to-repairer');
        Route::post('/mods/{mod}/delete-icon', [\App\Http\Controllers\Admin\ModAdminController::class, 'deleteIcon'])
            ->name('mods.delete-icon');

        /* =====================
        | OFFRES DE CONSOLES
        ===================== */
        Route::post('/consoles/{console}/offers', [ConsoleOfferController::class, 'store'])
            ->name('consoles.offers.store');

        Route::get('/lot-requests', [ConsoleOfferController::class, 'requests'])
            ->name('lot-requests.index');

        Route::post('/lot-requests/{request}/validate', [ConsoleOfferController::class, 'validateRequest'])
            ->name('lot-requests.validate');

        Route::post('/lot-requests/{request}/reject', [ConsoleOfferController::class, 'rejectRequest'])
            ->name('lot-requests.reject');
    });

/*
|--------------------------------------------------------------------------
| =========================
| STORE ROUTES
| =========================
*/
Route::middleware(['auth'])
    ->prefix('store')
    ->name('store.')
    ->group(function () {
        Route::get('/dashboard/{store}', [StoreDashboardController::class, 'index'])
            ->name('dashboard');

        Route::get('/product/{store}/{console}', [StoreDashboardController::class, 'productSheet'])
            ->name('product-sheet');

        Route::post('/console/{console}/sell', [StoreDashboardController::class, 'sell'])
            ->name('console.sell');

        Route::post('/console/{console}/defective', [StoreDashboardController::class, 'defective'])
            ->name('console.defective');

        Route::delete('/console/{console}/return/cancel', [StoreDashboardController::class, 'cancelReturn'])
            ->name('console.return.cancel');

        Route::post('/console/{console}/repair-quote', [StoreDashboardController::class, 'requestRepairQuote'])
            ->name('console.repair.quote');

        Route::post('/console/{console}/return/send', [StoreDashboardController::class, 'sendToRepairer'])
            ->name('console.return.send');

        Route::post('/external-repair/{consoleReturn}/send', [StoreDashboardController::class, 'sendToRepairerExternal'])
            ->name('console.return.send.external');

        Route::post('/repair-quotes/{quote}/accept', [StoreDashboardController::class, 'acceptRepairQuote'])
            ->name('repair.quote.accept');

        Route::post('/repair-quotes/{quote}/reject', [StoreDashboardController::class, 'rejectRepairQuote'])
            ->name('repair.quote.reject');

        /* =====================
        | OFFRES DE CONSOLES
        ===================== */
        Route::get('/offers', [StoreOfferController::class, 'index'])
            ->name('offers.index');

        Route::post('/offers/{offer}/request', [StoreOfferController::class, 'request'])
            ->name('offers.request');

        /* =====================
        | HISTORIQUE DES VENTES
        ===================== */
        Route::get('/{store}/sales', [StoreDashboardController::class, 'sales'])
            ->name('sales');

        /* =====================
        | RÉPARATION EXTERNE
        ===================== */
        Route::get('/{store}/external-repair/create', [StoreDashboardController::class, 'createExternalRepair'])
            ->name('external-repair.create');

        Route::post('/{store}/external-repair', [StoreDashboardController::class, 'storeExternalRepair'])
            ->name('external-repair.store');
    });

/*
|--------------------------------------------------------------------------
| =========================
| REPAIRER ROUTES
| =========================
*/
use App\Http\Controllers\Repairer\RepairerConsoleController;

Route::middleware(['auth', 'repairer'])
    ->prefix('repairer')
    ->name('repairer.')
    ->group(function () {
        // Dashboard réparateur
        Route::get('/dashboard', [RepairerConsoleController::class, 'dashboard'])
            ->name('dashboard');

        // Mettre à jour les compétences
        Route::post('/skills', [RepairerConsoleController::class, 'updateSkills'])
            ->name('skills.update');

        // Liste des consoles assignées au réparateur
        Route::get('/consoles', [RepairerConsoleController::class, 'index'])
            ->name('consoles.index');

        // Éditer les mods/accessoires d'une console
        Route::get('/consoles/{console}/mods', [RepairerConsoleController::class, 'editMods'])
            ->name('consoles.edit-mods');

        Route::put('/consoles/{console}/mods', [RepairerConsoleController::class, 'updateMods'])
            ->name('consoles.update-mods');

        // Ajouter/retirer un mod rapidement
        Route::post('/consoles/{console}/mods', [RepairerConsoleController::class, 'addMod'])
            ->name('consoles.add-mod');

        Route::delete('/consoles/{console}/mods/{mod}', [RepairerConsoleController::class, 'removeMod'])
            ->name('consoles.remove-mod');

        // Marquer une console comme fonctionnelle
        Route::patch('/consoles/{console}/mark-functional', [RepairerConsoleController::class, 'markFunctional'])
            ->name('consoles.mark-functional');

        // Accepter l'affectation d'une console
        Route::patch('/consoles/{console}/accept-assignment', [RepairerConsoleController::class, 'acceptAssignment'])
            ->name('consoles.accept-assignment');

        // Confirmer la réception d'une console
        Route::patch('/consoles/{console}/confirm-receipt', [RepairerConsoleController::class, 'confirmReceipt'])
            ->name('consoles.confirm-receipt');

        // Confirmer l'expédition d'une console
        Route::patch('/consoles/{console}/confirm-shipment', [RepairerConsoleController::class, 'confirmShipment'])
            ->name('consoles.confirm-shipment');

        // Repasser une console en réparation
        Route::patch('/consoles/{console}/mark-for-repair', [RepairerConsoleController::class, 'markForRepair'])
            ->name('consoles.mark-for-repair');
    });

/*
|--------------------------------------------------------------------------
| Legacy stock routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    Route::get('/stock', [StockController::class, 'index'])
        ->name('store.stock');

    Route::post('/stock/{console}/sell', [StockController::class, 'sell'])
        ->name('store.stock.sell');

    Route::post('/stock/{console}/defective', [StockController::class, 'defective'])
        ->name('store.stock.defective');
});

/*
|--------------------------------------------------------------------------
| Auth routes
|--------------------------------------------------------------------------
*/
require __DIR__ . '/auth.php';
