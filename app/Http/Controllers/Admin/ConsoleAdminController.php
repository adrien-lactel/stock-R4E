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
use App\Models\Mod;

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
                'articleSubCategory.brand',
                'store',
                'repairer',
                'mods', // Pour calculer le coût de réparation
                'productSheet', // Fiche produit liée
            ])
            ->withCount(['stores', 'mods'])
            ->where('status', '!=', 'disabled') // Exclure les consoles disabled
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

        if ($request->filled('brand')) {
            $query->whereHas('articleSubCategory', function($q) use ($request) {
                $q->where('article_brand_id', $request->brand);
            });
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

        if ($request->filled('region')) {
            $query->where('region', $request->region);
        }

        if ($request->filled('completeness')) {
            $query->where('completeness', $request->completeness);
        }

        if ($request->filled('language')) {
            $query->where('language', $request->language);
        }

        if ($request->filled('store_id')) {
            $query->where('store_id', $request->store_id);
        }

        // paginate for safety and preserve query string
        $consoles = $query->paginate(25)->withQueryString();

        $types = \App\Models\ArticleType::orderBy('name')->get();
        $categories = \App\Models\ArticleCategory::orderBy('name')->get();
        $brands = \App\Models\ArticleBrand::orderBy('name')->get();
        $stores = Store::orderBy('name')->get();

        // Charger les fiches produits pour chaque taxonomie présente
        $productSheets = \App\Models\ProductSheet::whereIn('article_type_id', $consoles->pluck('article_type_id')->filter()->unique())
            ->select('id', 'name', 'article_type_id')
            ->get()
            ->groupBy('article_type_id');

        return view('admin.consoles.index', compact('consoles', 'types', 'categories', 'brands', 'stores', 'productSheets'));
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
            'offers', // Charger les offres avec sale_price et consignment_price
            'repairer',
            'mods' // Pour afficher les mods/opérations et calculer les coûts
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
            'store_id'          => 'required|exists:stores,id',
            'sale_price'        => 'nullable|numeric|min:0',
            'consignment_price' => 'nullable|numeric|min:0',
        ]);

        // Créer une offre avec les deux types de prix
        ConsoleOffer::updateOrCreate(
            [
                'console_id' => $console->id,
                'store_id'   => $request->store_id,
            ],
            [
                'sale_price'        => $request->sale_price,
                'consignment_price' => $request->consignment_price,
                'status'            => 'proposed',
            ]
        );

        return redirect()
            ->route('admin.consoles.edit', $console)
            ->with('success', 'Offre créée avec les prix de vente et de dépôt. Le magasin pourra la consulter et demander un lot.');
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
        $console->load(['repairer', 'mods', 'articleCategory', 'articleSubCategory', 'articleType']);

        return view('admin.consoles.edit_full', [
            'console' => $console,
            'articleCategories' => ArticleCategory::with('subCategories.types')->orderBy('name')->get(),
            'repairers' => Repairer::where('is_active', true)->orderBy('name')->get(),
            'provenances' => Console::whereNotNull('provenance_article')->distinct()->pluck('provenance_article'),
            'allMods' => Mod::orderBy('is_accessory')->orderBy('name')->get(),
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

            // ✅ quantité pour création en lot
            'quantity'                 => 'nullable|integer|min:1|max:100',
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

        // ✅ Si un réparateur est sélectionné, passer l'assignment_status à pending_acceptance
        if (!empty($data['repairer_id'])) {
            $data['assignment_status'] = 'pending_acceptance';
        }

        // ✅ Création en lot
        $quantity = (int) ($data['quantity'] ?? 1);
        unset($data['quantity']); // Ne pas insérer quantity dans la table consoles

        $createdIds = [];
        for ($i = 0; $i < $quantity; $i++) {
            $console = Console::create($data);
            $createdIds[] = $console->id;
        }

        session()->forget('_old_input');

        if ($quantity === 1) {
            $message = "Article #{$createdIds[0]} créé avec succès";
        } else {
            $message = "{$quantity} articles créés avec succès (IDs: " . implode(', ', $createdIds) . ")";
        }

        return redirect()
            ->route('admin.articles.create')
            ->with('success', $message);
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

            // ✅ Mods via table pivot
            'console_mods'             => 'nullable|array|max:4',
            'console_mods.*.mod_id'    => 'nullable|exists:mods,id',
            'console_mods.*.price_applied' => 'nullable|numeric|min:0',
            'console_mods.*.work_time_minutes' => 'nullable|integer|min:0',
            'console_mods.*.notes'     => 'nullable|string|max:500',
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

        // Extraire console_mods avant merge
        $consoleMods = $data['console_mods'] ?? [];
        unset($data['console_mods']);

        $data = array_merge($data, $extra);

        // ✅ règle métier: réparateur obligatoire si repair
        if (($data['status'] ?? null) === 'repair' && empty($data['repairer_id'])) {
            return back()
                ->withErrors(['repairer_id' => 'Un réparateur est obligatoire si le statut est "repair".'])
                ->withInput();
        }

        // ✅ Si réparateur changé, repasser à pending_acceptance
        if (isset($data['repairer_id']) && $data['repairer_id'] != $console->repairer_id) {
            $data['assignment_status'] = 'pending_acceptance';
            $data['assignment_accepted_at'] = null;
            $data['assignment_received_at'] = null;
        }

        $console->update($data);

        // ✅ Ajouter les nouveaux mods (sans supprimer les existants)
        foreach ($consoleMods as $modData) {
            if (empty($modData['mod_id'])) {
                continue;
            }

            $mod = Mod::find($modData['mod_id']);
            if (!$mod) {
                continue;
            }

            // Vérifier si ce mod n'est pas déjà associé
            if ($console->mods()->where('mod_id', $mod->id)->exists()) {
                continue;
            }

            $console->mods()->attach($mod->id, [
                'repairer_id' => $console->repairer_id,
                'price_applied' => $modData['price_applied'] ?? $mod->purchase_price,
                'work_time_minutes' => $modData['work_time_minutes'] ?? null,
                'notes' => $modData['notes'] ?? null,
            ]);
        }

        return redirect()->route('admin.consoles.index')->with('success', 'Article mis à jour');
    }

    /* =====================================================
     | UPDATE STATUS (EXISTANT)
     ===================================================== */
    public function updateStatus(Request $request, Console $console)
    {
        /** @var \App\Models\User $user */
        $user = $request->user();
        
        if (!$user || $user->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'status' => 'required|in:stock,defective,repair,disabled,parted_out',
            'admin_comment' => 'nullable|string|max:1000',
        ]);

        $console->update([
            'status' => $request->status,
            'admin_comment' => $request->admin_comment,
        ]);

        return back()->with('success', 'Statut de la console mis à jour.');
    }

    /* =====================================================
     | UPDATE VALORISATION (Prix R4E)
     ===================================================== */
    public function updateValorisation(Request $request, Console $console)
    {
        $request->validate([
            'valorisation' => 'required|numeric|min:0',
        ]);

        $console->update([
            'valorisation' => $request->valorisation,
        ]);

        return back()->with('success', 'Prix R4E mis à jour avec succès.');
    }

    /* =====================================================
     | CONSOLES DISABLED (HS - Pièces détachées)
     ===================================================== */
    public function disabled(Request $request)
    {
        $tab = $request->get('tab', 'disabled'); // disabled ou parted_out
        
        $query = Console::with([
                'articleType',
                'articleCategory',
                'articleSubCategory',
            ])
            ->where('status', $tab === 'parted_out' ? 'parted_out' : 'disabled')
            ->orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($s) use ($q) {
                $s->where('serial_number', 'like', "%{$q}%")
                  ->orWhere('provenance_article', 'like', "%{$q}%")
                  ->orWhere('product_comment', 'like', "%{$q}%");
            });
        }

        if ($request->filled('category')) {
            $query->where('article_category_id', $request->category);
        }

        if ($request->filled('type')) {
            $query->where('article_type_id', $request->type);
        }

        $consoles = $query->paginate(25)->withQueryString();
        $categories = \App\Models\ArticleCategory::orderBy('name')->get();
        $types = \App\Models\ArticleType::orderBy('name')->get();

        return view('admin.consoles.disabled', compact('consoles', 'categories', 'types', 'tab'));
    }

    /* =====================================================
     | VALORISER EN PIÈCES DÉTACHÉES
     ===================================================== */
    public function valorize(Console $console)
    {
        // Vérifier que c'est bien une console disabled
        if ($console->status !== 'disabled') {
            return redirect()->route('admin.consoles.disabled')
                ->with('error', 'Seules les consoles HS peuvent être valorisées en pièces détachées.');
        }

        // Récupérer les accessoires depuis la table mods
        $accessories = Mod::where('is_accessory', true)
            ->orderBy('name')
            ->get();

        return view('admin.consoles.valorize', compact('console', 'accessories'));
    }

    /* =====================================================
     | ENREGISTRER LA VALORISATION EN PIÈCES
     ===================================================== */
    public function storeValorization(Request $request, Console $console)
    {
        if ($console->status !== 'disabled') {
            return redirect()->route('admin.consoles.disabled')
                ->with('error', 'Opération invalide.');
        }

        $validated = $request->validate([
            'accessories' => 'required|array|min:1',
            'accessories.*.mod_id' => 'required|exists:mods,id',
            'accessories.*.quantity' => 'required|integer|min:1',
            'accessories.*.product_comment' => 'nullable|string|max:500',
            'valorisation' => 'required|numeric|min:0|max:' . ($console->prix_achat ?? 999999),
        ]);

        // Créer les articles accessoires en augmentant le stock des mods
        $totalCreated = 0;
        foreach ($validated['accessories'] as $accessory) {
            $mod = Mod::find($accessory['mod_id']);
            if (!$mod) {
                continue;
            }

            // Augmenter la quantité en stock du mod
            $mod->increment('quantity', $accessory['quantity']);
            $totalCreated += $accessory['quantity'];
        }

        // Changer le statut de la console en "valorisé"
        $console->update([
            'status' => 'parted_out',
            'valorisation' => $validated['valorisation'],
            'admin_comment' => 'Valorisé en pièces détachées le ' . now()->format('d/m/Y à H:i') . " - {$totalCreated} pièce(s) ajoutée(s) au stock - Valorisation: " . number_format($validated['valorisation'], 2, ',', ' ') . '€',
        ]);

        return redirect()->route('admin.consoles.disabled')
            ->with('success', "Console #{$console->id} valorisée avec succès. {$totalCreated} accessoire(s) / pièce(s) détachée(s) ajouté(es) au stock.");
    }

    /* =====================================================
     | RETIRER UN MOD D'UNE CONSOLE
     ===================================================== */
    public function removeMod(Console $console, Mod $mod)
    {
        // Vérifier que le mod est bien attaché à la console
        if (!$console->mods->contains($mod->id)) {
            return back()->with('error', 'Ce mod n\'est pas associé à cet article.');
        }

        // Détacher le mod de la console (supprime l'entrée de la table pivot)
        $console->mods()->detach($mod->id);

        return back()->with('success', "Mod \"{$mod->name}\" retiré de l'article #{$console->id}.");
    }

    /**
     * Supprimer un article (console).
     */
    public function destroyArticle(Console $console)
    {
        $articleId = $console->id;
        
        // Soft delete si configuré, sinon suppression complète
        $console->delete();

        return redirect()->route('admin.articles.recent')
            ->with('success', "Article #{$articleId} supprimé avec succès.");
    }
}
