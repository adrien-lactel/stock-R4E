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
use App\Http\Controllers\Admin\ConsolePriceController;
use App\Http\Controllers\Admin\StoreAdminController;
use App\Http\Controllers\Admin\StoreStockController;
use App\Http\Controllers\Admin\ConsoleReturnController;
use App\Http\Controllers\Admin\RepairQuoteAdminController;
use App\Http\Controllers\Admin\TaxonomyController;
use App\Http\Controllers\Admin\ConsoleOfferController;
use App\Http\Controllers\Store\DashboardController as StoreDashboardController;
use App\Http\Controllers\Store\StoreOfferController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Admin\RepairerAdminController;




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
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {




        Route::get('/repairers', [RepairerAdminController::class, 'index'])->name('repairers.index');

        Route::get('/repairers/create', [RepairerAdminController::class, 'create'])->name('repairers.create');
        Route::post('/repairers', [RepairerAdminController::class, 'store'])->name('repairers.store');

        Route::get('/repairers/{repairer}/edit', [RepairerAdminController::class, 'edit'])->name('repairers.edit');
        Route::put('/repairers/{repairer}', [RepairerAdminController::class, 'update'])->name('repairers.update');
        Route::delete('/repairers/{repairer}', [RepairerAdminController::class, 'destroy'])->name('repairers.destroy');

        /* =====================
        | TAXONOMIE
        ===================== */
        Route::get('/taxonomy', [TaxonomyController::class, 'index'])
            ->name('taxonomy.index');

        Route::post('/taxonomy/category', [TaxonomyController::class, 'storeCategory'])
            ->name('taxonomy.category.store');

        Route::post('/taxonomy/sub-category', [TaxonomyController::class, 'storeSubCategory'])
            ->name('taxonomy.sub-category.store');

        Route::post('/taxonomy/type', [TaxonomyController::class, 'storeType'])
            ->name('taxonomy.type.store');
        
        // UPDATE
        Route::put('/taxonomy/category/{category}', [TaxonomyController::class, 'updateCategory'])
            ->name('taxonomy.category.update');

        Route::put('/taxonomy/sub-category/{subCategory}', [TaxonomyController::class, 'updateSubCategory'])
            ->name('taxonomy.sub-category.update');

        Route::put('/taxonomy/type/{type}', [TaxonomyController::class, 'updateType'])
            ->name('taxonomy.type.update');

        // DELETE (optionnel mais utile)
        Route::delete('/taxonomy/category/{category}', [TaxonomyController::class, 'destroyCategory'])
            ->name('taxonomy.category.destroy');

        Route::delete('/taxonomy/sub-category/{subCategory}', [TaxonomyController::class, 'destroySubCategory'])
            ->name('taxonomy.sub-category.destroy');

        Route::delete('/taxonomy/type/{type}', [TaxonomyController::class, 'destroyType'])
            ->name('taxonomy.type.destroy');

        /* =====================
        | AJAX TAXONOMIE (🔥 IMPORTANT)
        ===================== */
        Route::get('/ajax/sub-categories/{category}', [TaxonomyController::class, 'ajaxSubCategories'])
            ->name('ajax.sub-categories');

        Route::get('/ajax/types/{subCategory}', [TaxonomyController::class, 'ajaxTypes'])
            ->name('ajax.types');

        /* =====================
        | DASHBOARD
        ===================== */
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

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

        /* =====================
        | CONSOLES
        ===================== */
        Route::get('/consoles', [ConsoleAdminController::class, 'index'])
            ->name('consoles.index');

        Route::get('/consoles/{console}/edit', [ConsoleAdminController::class, 'edit'])
            ->name('consoles.edit');

        Route::post('/consoles/{console}/prices', [ConsoleAdminController::class, 'storePrice'])
            ->name('consoles.prices.store');

        Route::post('/consoles/{console}/status', [ConsoleAdminController::class, 'updateStatus'])
            ->name('consoles.status.update');

        Route::patch('/consoles/{console}/status', [ConsoleAdminController::class, 'updateStatus'])
            ->name('consoles.update-status');

        /* =====================
        | PRIX / MAGASINS
        ===================== */
        Route::get('/prices', [ConsolePriceController::class, 'index'])
            ->name('prices.index');

        Route::post('/prices/{console}', [ConsolePriceController::class, 'store'])
            ->name('prices.store');

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
