<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\Store;
use App\Models\ConsoleStorePrice;
use App\Models\ConsoleOffer;
use Illuminate\Http\Request;
use App\Models\ArticleCategory;
use App\Models\Repairer;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;

class ConsoleAdminController extends Controller
{
    /* =====================================================
     | INDEX — liste des consoles
     ===================================================== */
    public function index(Request $request)
    {
        $query = Console::with([
                'articleType',
                'articleCategory',
                'articleSubCategory',
                'store',
                'repairer', // ✅ ajout
            ])
            ->withCount('stores')
            ->orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($s) use ($q) {
                $s->where('serial_number', 'like', "%{$q}%")
                  ->orWhere('provenance_article', 'like', "%{$q}%")
                  ->orWhere('lieu_stockage', 'like', "%{$q}%")
                  ->orWhere('product_comment', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('article_category_id', $request->category);
        }

        if ($request->filled('sub_category')) {
            $query->where('article_sub_category_id', $request->sub_category);
        }

        if ($request->filled('type')) {
            $query->where('article_type_id', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('store_id')) {
            $query->where('store_id', $request->store_id);
        }

        // paginate for safety and preserve query string
        $consoles = $query->paginate(25)->withQueryString();

        $types = \App\Models\ArticleType::orderBy('name')->get();
        $categories = \App\Models\ArticleCategory::orderBy('name')->get();
        $stores = Store::orderBy('name')->get();

        return view('admin.consoles.index', compact('consoles', 'types', 'categories', 'stores'));
    }

    /* =====================================================
     | EDIT PRIX (EXISTANT — NE PAS TOUCHER)
     ===================================================== */
    public function edit(Console $console)
    {
        $console->load(
            'articleType',
            'articleCategory',
            'articleSubCategory',
            'stores',
            'repairer' // ✅ ajout
        );

        $stores = Store::all();

        return view('admin.consoles.edit', compact('console', 'stores'));
    }

    /* =====================================================
     | STORE PRICE — Créer une offre (ConsoleOffer)
     ===================================================== */
    public function storePrice(Request $request, Console $console)
    {
        $request->validate([
            'store_id'   => 'required|exists:stores,id',
            'sale_price' => 'required|numeric|min:0',
        ]);

        // Créer une offre au lieu d'ajouter directement au stock
        ConsoleOffer::updateOrCreate(
            [
                'console_id' => $console->id,
                'store_id'   => $request->store_id,
            ],
            [
                'sale_price' => $request->sale_price,
                'status'     => 'proposed',
            ]
        );

        return redirect()
            ->route('admin.consoles.edit', $console)
            ->with('success', 'Offre créée. Le magasin pourra la consulter et demander un lot.');
    }

    /* =====================================================
     | 🆕 FORMULAIRE CRÉATION ARTICLE
     ===================================================== */
    public function createArticle()
    {
        return view('admin.consoles.form', [
            'console' => new Console(),

            'articleCategories' => ArticleCategory::orderBy('name')->get(),

            // ✅ liste réparateurs actifs (pour select repairer_id)
            'repairers' => Repairer::where('is_active', true)->orderBy('name')->get(),

            'provenances' => Console::whereNotNull('provenance_article')->distinct()->pluck('provenance_article'),
            'mods'        => Console::whereNotNull('mod_1')->distinct()->pluck('mod_1'),
            'lieux'       => Console::whereNotNull('lieu_stockage')->distinct()->pluck('lieu_stockage'),

            // list of stores for store_id select
            'stores' => Store::orderBy('name')->get(),

            // ✅ 15 dernières entrées + relations pour affichage sans N+1
            'lastConsoles'=> Console::with(['articleCategory','articleSubCategory','articleType','repairer'])
                ->latest()
                ->take(15)
                ->get(),
        ]);
    }

    /* =====================================================
     | ÉDITION COMPLÈTE ARTICLE (nouvelle route)
     ===================================================== */
    public function editArticleFull(Console $console)
    {
        $console->load('repairer');

        return view('admin.consoles.edit_full', [
            'console' => $console,
            'articleCategories' => ArticleCategory::orderBy('name')->get(),
            'repairers' => Repairer::where('is_active', true)->orderBy('name')->get(),
            'provenances' => Console::whereNotNull('provenance_article')->distinct()->pluck('provenance_article'),
            'mods' => Console::whereNotNull('mod_1')->distinct()->pluck('mod_1'),
            'lieux' => Console::whereNotNull('lieu_stockage')->distinct()->pluck('lieu_stockage'),
            'stores' => Store::orderBy('name')->get(),
            'lastConsoles'=> Console::with(['articleCategory','articleSubCategory','articleType','repairer'])->latest()->take(15)->get(),
        ]);
    }

    /* =====================================================
     | RECENT ARTICLES — filtre taxonomie + recherche
     ===================================================== */
    public function recentArticles(Request $request)
    {
        $query = Console::with(['articleCategory','articleSubCategory','articleType','store','repairer'])
            ->orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($s) use ($q) {
                $s->where('serial_number', 'like', "%{$q}%")
                  ->orWhere('provenance_article', 'like', "%{$q}%")
                  ->orWhere('lieu_stockage', 'like', "%{$q}%")
                  ->orWhere('product_comment', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('article_category_id', $request->category);
        }

        if ($request->filled('sub_category')) {
            $query->where('article_sub_category_id', $request->sub_category);
        }

        if ($request->filled('type')) {
            $query->where('article_type_id', $request->type);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('store_id')) {
            $query->where('store_id', $request->store_id);
        }

        $consoles = $query->take(40)->get();

        $categories = ArticleCategory::orderBy('name')->get();
        $stores = Store::orderBy('name')->get();

        return view('admin.consoles.recent', compact('consoles','categories','stores'));
    }

    /* =====================================================
     | ENREGISTREMENT ARTICLE
     ===================================================== */
    public function storeArticle(Request $request)
    {
        $data = $request->validate([
            'article_category_id'      => 'required|exists:article_categories,id',
            'article_sub_category_id'  => 'required|exists:article_sub_categories,id',
            'article_type_id'          => 'required|exists:article_types,id',

            'status'                   => 'required|in:stock,defective,repair,disabled',

            // ✅ nouveau champ relation
            'repairer_id'              => 'nullable|exists:repairers,id',

            'prix_achat'               => 'nullable|numeric|min:0',
            'valorisation'             => 'nullable|numeric|min:0',
            'lieu_stockage'            => 'nullable|string|max:255',

            'product_comment'          => 'nullable|string',
            'commentaire_reparateur'   => 'nullable|string',
        ]);

        // Accept additional optional fields present on the Console model
        $extra = $request->validate([
            'sub_category'          => 'nullable|string|max:255',
            'initial_status'        => 'nullable|string|max:255',
            'store_id'              => 'nullable|exists:stores,id',
            'admin_comment'         => 'nullable|string',
            'serial_number'         => 'nullable|string|max:255',
            'category'              => 'nullable|string|max:255',
            'provenance_article'    => 'nullable|string|max:255',
            'product_page_url'      => 'nullable|url|max:255',
            'mod_1'                 => 'nullable|string|max:255',
            'mod_2'                 => 'nullable|string|max:255',
            'mod_3'                 => 'nullable|string|max:255',
            'mod_4'                 => 'nullable|string|max:255',
        ]);

        $data = array_merge($data, $extra);

        // ✅ règle métier: réparateur obligatoire si repair
        if (($data['status'] ?? null) === 'repair' && empty($data['repairer_id'])) {
            return back()
                ->withErrors(['repairer_id' => 'Un réparateur est obligatoire si le statut est "repair".'])
                ->withInput();
        }

        $console = Console::create($data);

        session()->forget('_old_input');

        return redirect()
            ->route('admin.articles.create')
            ->with('success', "Article #{$console->id} créé avec succès");
    }

    /* =====================================================
     | ÉDITION ARTICLE
     ===================================================== */
    public function editArticle(Console $console)
    {
        $console->load('repairer'); // ✅ pour affichage

        return view('admin.consoles.form', [
            'console' => $console,

            'articleCategories' => ArticleCategory::orderBy('name')->get(),

            // ✅ liste réparateurs actifs
            'repairers' => Repairer::where('is_active', true)->orderBy('name')->get(),

            'provenances' => Console::whereNotNull('provenance_article')->distinct()->pluck('provenance_article'),
            'mods'        => Console::whereNotNull('mod_1')->distinct()->pluck('mod_1'),
            'lieux'       => Console::whereNotNull('lieu_stockage')->distinct()->pluck('lieu_stockage'),

            // list of stores for store_id select
            'stores' => Store::orderBy('name')->get(),

            'lastConsoles'=> Console::with(['articleCategory','articleSubCategory','articleType','repairer'])
                ->latest()
                ->take(15)
                ->get(),
        ]);
    }

    /* =====================================================
     | UPDATE ARTICLE
     ===================================================== */
    public function updateArticle(Request $request, Console $console)
    {
        $data = $request->validate([
            'article_category_id'      => 'required|exists:article_categories,id',
            'article_sub_category_id'  => 'required|exists:article_sub_categories,id',
            'article_type_id'          => 'required|exists:article_types,id',

            'status'                   => 'required|in:stock,defective,repair,disabled',

            // ✅ nouveau champ relation
            'repairer_id'              => 'nullable|exists:repairers,id',

            'prix_achat'               => 'nullable|numeric|min:0',
            'valorisation'             => 'nullable|numeric|min:0',
            'lieu_stockage'            => 'nullable|string|max:255',

            'product_comment'          => 'nullable|string',
            'commentaire_reparateur'   => 'nullable|string',
        ]);

        // Accept additional optional fields present on the Console model
        $extra = $request->validate([
            'sub_category'          => 'nullable|string|max:255',
            'initial_status'        => 'nullable|string|max:255',
            'store_id'              => 'nullable|exists:stores,id',
            'admin_comment'         => 'nullable|string',
            'serial_number'         => 'nullable|string|max:255',
            'category'              => 'nullable|string|max:255',
            'provenance_article'    => 'nullable|string|max:255',
            'product_page_url'      => 'nullable|url|max:255',
            'mod_1'                 => 'nullable|string|max:255',
            'mod_2'                 => 'nullable|string|max:255',
            'mod_3'                 => 'nullable|string|max:255',
            'mod_4'                 => 'nullable|string|max:255',
        ]);

        $data = array_merge($data, $extra);

        // ✅ règle métier: réparateur obligatoire si repair
        if (($data['status'] ?? null) === 'repair' && empty($data['repairer_id'])) {
            return back()
                ->withErrors(['repairer_id' => 'Un réparateur est obligatoire si le statut est "repair".'])
                ->withInput();
        }

        $console->update($data);

        return back()->with('success', 'Article mis à jour');
    }

    /* =====================================================
     | UPDATE STATUS (EXISTANT)
     ===================================================== */
    public function updateStatus(Request $request, Console $console)
    {
        if (auth()->user()->role !== 'admin') abort(403);

        $request->validate([
            'status' => 'required|in:stock,defective,repair,disabled',
            'admin_comment' => 'nullable|string|max:1000',
        ]);

        $console->update([
            'status' => $request->status,
            'admin_comment' => $request->admin_comment,
        ]);

        return back()->with('success', 'Statut de la console mis à jour.');
    }
}
