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
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ConsoleAdminController extends Controller
{
    /**
     * Extraire le public_id d'une URL Cloudinary pour suppression
     */
    private function extractCloudinaryPublicId($url)
    {
        // URL Cloudinary format: https://res.cloudinary.com/{cloud_name}/image/upload/v{version}/{public_id}.{ext}
        if (preg_match('/\/upload\/(?:v\d+\/)?(.+)\.\w+$/', $url, $matches)) {
            return $matches[1]; // Retourne le public_id sans l'extension
        }
        return null;
    }

    /**
     * Détecter la région depuis un ROM ID Game Boy, SNES, NES, etc.
     */
    private function detectRegionFromRomId($romId)
    {
        if (!$romId) return null;
        
        $romId = strtoupper(trim($romId));
        $region = null;
        
        // Format avec suffixe: DMG-AFX-USA, SHVC-MK-NOE
        if (preg_match('/^[A-Z]+-([A-Z0-9]+)-([\w]+)$/i', $romId, $matches)) {
            $gameCode = $matches[1]; // Ex: "AFX", "MK"
            $suffix = $matches[2];    // Ex: "USA", "JPN", "NOE"
            
            // Cas spéciaux avec suffixe explicite
            if (in_array($suffix, ['USA', 'CAN'])) {
                $region = 'NTSC-U';
            } elseif (in_array($suffix, ['JPN', 'JAP'])) {
                $region = 'NTSC-J';
            } elseif (in_array($suffix, ['EUR', 'PAL', 'FRA', 'GER', 'ITA', 'SPA', 'UK', 'NOE', 'FRG', 'HOL', 'SCN'])) {
                $region = 'PAL';
            }
            // Sinon, détecter par la dernière lettre du code du jeu
            else {
                $lastLetter = substr($gameCode, -1);
                
                if ($lastLetter === 'J') {
                    $region = 'NTSC-J'; // Japon
                } elseif ($lastLetter === 'E') {
                    $region = 'PAL'; // Europe
                } elseif ($lastLetter === 'P') {
                    $region = 'PAL'; // PAL/Europe
                } elseif ($lastLetter === 'U' || $lastLetter === 'A') {
                    $region = 'NTSC-U'; // USA
                }
            }
        }
        // Format simple sans suffixe: DMG-AFX, SHVC-MK, SNS-MW
        elseif (preg_match('/^([A-Z]+)-([A-Z0-9]+)$/i', $romId, $matches)) {
            $prefix = $matches[1];    // Ex: "DMG", "SHVC", "SNS"
            $gameCode = $matches[2];  // Ex: "AFX", "MK"
            
            $lastLetter = substr($gameCode, -1);
            
            // Détection par dernière lettre du code
            if ($lastLetter === 'J') {
                $region = 'NTSC-J'; // Japon
            } elseif ($lastLetter === 'E') {
                $region = 'PAL'; // Europe
            } elseif ($lastLetter === 'P') {
                $region = 'PAL'; // PAL/Europe
            } elseif ($lastLetter === 'U' || $lastLetter === 'A') {
                $region = 'NTSC-U'; // USA
            }
            // Si pas de lettre de région claire, détecter par préfixe
            else {
                // SHVC- = Super Famicom (Japon), SNS- = SNES (USA), SNSP- = SNES (PAL)
                if (in_array($prefix, ['SHVC', 'HVC'])) {
                    $region = 'NTSC-J';
                } elseif (in_array($prefix, ['SNS', 'NUS', 'DMG', 'CGB', 'AGB'])) {
                    // Par défaut USA pour ces préfixes si pas de lettre claire
                    $region = 'NTSC-U';
                } elseif (in_array($prefix, ['SNSP'])) {
                    $region = 'PAL';
                }
            }
        }
        
        return $region;
    }
    
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

            // ✅ Description partagée au niveau du type
            'article_type_description' => 'nullable|string',
            
            // ✅ Champs Game Boy
            'rom_id'                   => 'nullable|string|max:50',
            'region'                   => 'nullable|string|in:NTSC-J,NTSC-U,PAL',
            'year'                     => 'nullable|integer|min:1980|max:' . (date('Y') + 1),
            
            // ✅ Images spécifiques à l'article
            'article_images'           => 'nullable|array',
            'article_images.*'         => 'nullable|string|url',
            'primary_image_url'        => 'nullable|string|url',
            'image_captions'           => 'nullable|array',
        ]);
        
        // ✅ Vérification de cohérence ROM ID / Région
        if (!empty($data['rom_id'])) {
            $detectedRegion = $this->detectRegionFromRomId($data['rom_id']);
            
            if ($detectedRegion) {
                // Si aucune région n'est fournie, utiliser celle détectée
                if (empty($data['region'])) {
                    $data['region'] = $detectedRegion;
                    \Log::info("Région auto-détectée pour ROM ID {$data['rom_id']}: {$detectedRegion}");
                }
                // Si une région est fournie, vérifier la cohérence
                elseif ($data['region'] !== $detectedRegion) {
                    return back()
                        ->withErrors(['region' => "La région sélectionnée ({$data['region']}) ne correspond pas au ROM ID ({$data['rom_id']} → {$detectedRegion})."])
                        ->withInput();
                }
            }
        }

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

        // ✅ Mettre à jour la description du type d'article si fournie
        if ($request->filled('article_type_description')) {
            \App\Models\ArticleType::where('id', $data['article_type_id'])
                ->update(['description' => $request->article_type_description]);
        }

        // ✅ Traiter les images spécifiques à l'article
        if ($request->filled('article_images')) {
            $data['article_images'] = json_decode($request->article_images, true) ?? [];
        }
        if ($request->filled('primary_image_url')) {
            $data['primary_image_url'] = $request->primary_image_url;
        }
        if ($request->filled('image_captions')) {
            $data['image_captions'] = json_decode($request->image_captions, true) ?? [];
        }

        // ✅ Création en lot
        $quantity = (int) ($data['quantity'] ?? 1);
        unset($data['quantity']); // Ne pas insérer quantity dans la table consoles
        unset($data['article_type_description']); // Ne pas insérer dans consoles (c'est au niveau du type)

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

            // ✅ Description partagée au niveau du type
            'article_type_description' => 'nullable|string',

            // ✅ Validation ROM ID, région et année
            'rom_id'                   => 'nullable|string|max:50',
            'region'                   => 'nullable|string|in:NTSC-J,NTSC-U,PAL',
            'year'                     => 'nullable|integer|min:1980|max:' . (date('Y') + 1),
            
            // ✅ Images spécifiques à l'article
            'article_images'           => 'nullable|array',
            'article_images.*'         => 'nullable|string|url',
            'primary_image_url'        => 'nullable|string|url',
            'image_captions'           => 'nullable|array',
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

        // ✅ Vérifier la cohérence ROM ID / Région
        if (!empty($data['rom_id'])) {
            $detectedRegion = $this->detectRegionFromRomId($data['rom_id']);
            
            if ($detectedRegion) {
                // Si aucune région fournie, on complète automatiquement
                if (empty($data['region'])) {
                    $data['region'] = $detectedRegion;
                    \Log::info("Région auto-détectée pour ROM ID {$data['rom_id']}: {$detectedRegion}");
                }
                // Si une région est fournie mais ne correspond pas, on retourne une erreur
                elseif ($data['region'] !== $detectedRegion) {
                    return back()
                        ->withErrors([
                            'region' => "La région sélectionnée ({$data['region']}) ne correspond pas au ROM ID ({$data['rom_id']} → {$detectedRegion})"
                        ])
                        ->withInput();
                }
            }
        }

        // ✅ Mettre à jour la description du type d'article si fournie
        if ($request->filled('article_type_description')) {
            \App\Models\ArticleType::where('id', $data['article_type_id'])
                ->update(['description' => $request->article_type_description]);
        }
        unset($data['article_type_description']); // Ne pas insérer dans consoles

        // ✅ Traiter les images spécifiques à l'article
        if ($request->filled('article_images')) {
            $data['article_images'] = json_decode($request->article_images, true) ?? [];
        }
        if ($request->filled('primary_image_url')) {
            $data['primary_image_url'] = $request->primary_image_url;
        }
        if ($request->filled('image_captions')) {
            $data['image_captions'] = json_decode($request->image_captions, true) ?? [];
        }

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

    /**
     * Upload d'une image d'article vers Cloudinary (associée à un article_type).
     */
    public function uploadArticleImage(Request $request)
    {
        \Log::info('uploadArticleImage appelée', [
            'has_file' => $request->hasFile('image'),
            'article_type_id' => $request->input('article_type_id'),
            'image_type' => $request->input('image_type'),
        ]);

        try {
            $request->validate([
                'image' => 'required|file|mimes:jpeg,png,jpg,gif,webp,avif|max:10240', // Max 10MB
                'article_type_id' => 'required|exists:article_types,id',
                'image_type' => 'nullable|in:cover,artwork,gameplay', // Type d'image pour les jeux
            ]);

            $file = $request->file('image');
            $typeId = $request->input('article_type_id');
            $imageType = $request->input('image_type'); // 'cover', 'artwork', 'gameplay', ou null
            
            if (!$file) {
                return response()->json([
                    'success' => false,
                    'message' => 'Aucun fichier reçu'
                ], 400);
            }
            
            // Vérifier la taille (10MB max)
            if ($file->getSize() > 10 * 1024 * 1024) {
                return response()->json([
                    'success' => false,
                    'message' => 'Le fichier est trop volumineux (' . round($file->getSize() / 1024 / 1024, 2) . ' MB). Maximum autorisé : 10 MB.'
                ], 413);
            }
            
            // Upload vers Cloudflare R2
            $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
            $path = 'articles/images/' . $fileName;
            
            Storage::disk('r2')->put($path, file_get_contents($file), 'public');
            
            // URL publique R2
            $uploadedFileUrl = Storage::disk('r2')->url($path);

            // Mettre à jour l'article_type
            $articleType = ArticleType::findOrFail($typeId);
            
            if ($imageType === 'cover') {
                // Image de la cartouche/boîte - Conserver l'ancienne si elle existe
                if (empty($articleType->cover_image)) {
                    $articleType->cover_image = $uploadedFileUrl;
                } else {
                    // Si une image existe déjà, l'ajouter au tableau générique
                    $images = $articleType->images ?? [];
                    $images[] = $uploadedFileUrl;
                    $articleType->images = $images;
                    \Log::info('Cover image ajoutée au tableau (cover_image déjà défini)', ['url' => $uploadedFileUrl]);
                }
                $articleType->save();
                \Log::info('Cover image enregistrée', ['url' => $uploadedFileUrl, 'type_id' => $typeId]);
            } elseif ($imageType === 'artwork') {
                // Artwork officiel - Conserver l'ancienne si elle existe
                if (empty($articleType->artwork_image)) {
                    $articleType->artwork_image = $uploadedFileUrl;
                } else {
                    // Si une image existe déjà, l'ajouter au tableau générique
                    $images = $articleType->images ?? [];
                    $images[] = $uploadedFileUrl;
                    $articleType->images = $images;
                    \Log::info('Artwork image ajoutée au tableau (artwork_image déjà défini)', ['url' => $uploadedFileUrl]);
                }
                $articleType->save();
                \Log::info('Artwork image enregistrée', ['url' => $uploadedFileUrl, 'type_id' => $typeId]);
            } elseif ($imageType === 'gameplay') {
                // Screenshot du gameplay - Conserver l'ancienne si elle existe
                if (empty($articleType->gameplay_image)) {
                    $articleType->gameplay_image = $uploadedFileUrl;
                } else {
                    // Si une image existe déjà, l'ajouter au tableau générique
                    $images = $articleType->images ?? [];
                    $images[] = $uploadedFileUrl;
                    $articleType->images = $images;
                    \Log::info('Gameplay image ajoutée au tableau (gameplay_image déjà défini)', ['url' => $uploadedFileUrl]);
                }
                $articleType->save();
                \Log::info('Gameplay image enregistrée', ['url' => $uploadedFileUrl, 'type_id' => $typeId]);
            } else {
                // Images génériques (tableau images)
                $images = $articleType->images ?? [];
                $images[] = $uploadedFileUrl;
                $articleType->images = $images;
                $articleType->save();
                \Log::info('Image générique ajoutée', ['url' => $uploadedFileUrl, 'type_id' => $typeId, 'total_images' => count($images)]);
            }

            return response()->json([
                'success' => true,
                'url' => $uploadedFileUrl,
                'path' => $uploadedFileUrl,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur upload image article', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'upload: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Supprimer une image d'un article_type.
     */
    public function deleteArticleImage(Request $request)
    {
        try {
            $request->validate([
                'article_type_id' => 'required|exists:article_types,id',
                'image_url' => 'nullable|string',
                'image_type' => 'nullable|in:cover,artwork,gameplay',
            ]);

            $typeId = $request->input('article_type_id');
            $imageUrl = $request->input('image_url');
            $imageType = $request->input('image_type');

            $articleType = ArticleType::findOrFail($typeId);
            
            if ($imageType === 'cover') {
                // Supprimer le fichier de R2 s'il existe
                if ($articleType->cover_image) {
                    try {
                        // Extraire le chemin depuis l'URL R2
                        $path = str_replace(config('filesystems.disks.r2.url') . '/', '', $articleType->cover_image);
                        Storage::disk('r2')->delete($path);
                        \Log::info('Fichier R2 supprimé', ['path' => $path]);
                    } catch (\Exception $e) {
                        \Log::warning('Impossible de supprimer le fichier R2', ['error' => $e->getMessage()]);
                    }
                }
                
                // Supprimer l'image cover de la base
                $articleType->cover_image = null;
                $articleType->save();
                \Log::info('Cover image supprimée', ['type_id' => $typeId]);
            } elseif ($imageType === 'artwork') {
                // Supprimer le fichier de R2 s'il existe
                if ($articleType->artwork_image) {
                    try {
                        $path = str_replace(config('filesystems.disks.r2.url') . '/', '', $articleType->artwork_image);
                        Storage::disk('r2')->delete($path);
                        \Log::info('Fichier R2 supprimé', ['path' => $path]);
                    } catch (\Exception $e) {
                        \Log::warning('Impossible de supprimer le fichier R2', ['error' => $e->getMessage()]);
                    }
                }
                
                // Supprimer l'image artwork de la base
                $articleType->artwork_image = null;
                $articleType->save();
                \Log::info('Artwork image supprimée', ['type_id' => $typeId]);
            } elseif ($imageType === 'gameplay') {
                // Supprimer le fichier de R2 s'il existe
                if ($articleType->gameplay_image) {
                    try {
                        $path = str_replace(config('filesystems.disks.r2.url') . '/', '', $articleType->gameplay_image);
                        Storage::disk('r2')->delete($path);
                        \Log::info('Fichier R2 supprimé', ['path' => $path]);
                    } catch (\Exception $e) {
                        \Log::warning('Impossible de supprimer le fichier R2', ['error' => $e->getMessage()]);
                    }
                }
                
                // Supprimer l'image gameplay de la base
                $articleType->gameplay_image = null;
                $articleType->save();
                \Log::info('Gameplay image supprimée', ['type_id' => $typeId]);
            } else {
                // Supprimer une image générique du tableau
                if ($imageUrl) {
                    try {
                        $path = str_replace(config('filesystems.disks.r2.url') . '/', '', $imageUrl);
                        Storage::disk('r2')->delete($path);
                        \Log::info('Fichier R2 générique supprimé', ['path' => $path]);
                    } catch (\Exception $e) {
                        \Log::warning('Impossible de supprimer le fichier R2', ['error' => $e->getMessage()]);
                    }
                }
                
                $images = $articleType->images ?? [];
                $images = array_values(array_filter($images, fn($url) => $url !== $imageUrl));
                $articleType->images = $images;
                $articleType->save();
                \Log::info('Image générique supprimée', ['url' => $imageUrl, 'type_id' => $typeId, 'remaining_images' => count($images)]);
            }

            return response()->json([
                'success' => true,
                'message' => 'Image supprimée avec succès.',
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur suppression image article', [
                'message' => $e->getMessage(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Masquer une image locale Game Boy en la renommant avec .hidden
     */
    public function hideLocalImage(Request $request)
    {
        try {
            $request->validate([
                'image_url' => 'required|string',
            ]);

            $imageUrl = $request->input('image_url');
            
            // Vérifier que c'est bien une image locale (pas Cloudinary)
            if (str_contains($imageUrl, 'cloudinary')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Cette action est réservée aux images locales.'
                ], 400);
            }
            
            // Extraire le chemin relatif de l'image
            // URL format: http://localhost/images/taxonomy/gameboy/dmg-a3bp-0-artwork.jpg
            if (preg_match('/images\/taxonomy\/gameboy\/(.+)$/', $imageUrl, $matches)) {
                $fileName = $matches[1];
                $filePath = public_path('images/taxonomy/gameboy/' . $fileName);
                
                // Vérifier que le fichier existe
                if (!file_exists($filePath)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Fichier introuvable: ' . $fileName
                    ], 404);
                }
                
                // Renommer le fichier en ajoutant .hidden
                $newFilePath = $filePath . '.hidden';
                
                if (rename($filePath, $newFilePath)) {
                    \Log::info('Image locale masquée', [
                        'original' => $fileName,
                        'renamed' => basename($newFilePath)
                    ]);
                    
                    return response()->json([
                        'success' => true,
                        'message' => 'Image masquée avec succès.',
                        'original_file' => $fileName,
                        'hidden_file' => basename($newFilePath)
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'Impossible de renommer le fichier.'
                    ], 500);
                }
            }
            
            return response()->json([
                'success' => false,
                'message' => 'Format d\'URL invalide.'
            ], 400);
            
        } catch (\Exception $e) {
            \Log::error('Erreur masquage image locale', [
                'message' => $e->getMessage(),
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du masquage: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Analyser une image avec Tesseract OCR (gratuit, offline) pour reconnaître un article.
     */
    public function analyzeImageAI(Request $request)
    {
        try {
            // Utiliser Tesseract OCR (100% gratuit, offline)
            // MÉMORISÉ: Version Google Vision disponible dans ImageRecognitionService si besoin

            // Gérer base64 OU fichier uploadé
            $imageData = null;
            $tempPath = null;
            $fullPath = null;

            if ($request->has('image_base64')) {
                // Image en base64 (depuis webcam ou canvas)
                $base64Image = $request->input('image_base64');
                
                // Extraire les données base64 (enlever le préfixe data:image/...)
                if (preg_match('/^data:image\/(\w+);base64,/', $base64Image, $type)) {
                    $base64Image = substr($base64Image, strpos($base64Image, ',') + 1);
                    $type = strtolower($type[1]); // jpg, png, gif
                    
                    $imageData = base64_decode($base64Image);
                    
                    if ($imageData === false) {
                        throw new \Exception('Impossible de décoder l\'image base64');
                    }
                    
                    // Créer le chemin complet du fichier temporaire
                    $fileName = 'ai-analyze-' . time() . '.' . $type;
                    $fullPath = storage_path('app/temp/' . $fileName);
                    
                    // Sauvegarder directement avec file_put_contents
                    $written = file_put_contents($fullPath, $imageData);
                    
                    if ($written === false || !file_exists($fullPath)) {
                        throw new \Exception('Échec de la création du fichier temporaire');
                    }
                    
                    // Stocker juste le nom relatif pour le nettoyage
                    $tempPath = 'temp/' . $fileName;
                    
                    \Log::info('Fichier temporaire créé', [
                        'path' => $fullPath, 
                        'size' => filesize($fullPath),
                        'exists' => file_exists($fullPath)
                    ]);
                } else {
                    throw new \Exception('Format base64 invalide');
                }
                
            } elseif ($request->hasFile('image')) {
                // Image uploadée normalement
                $request->validate([
                    'image' => 'required|image|max:10240', // Max 10MB
                ]);
                
                $tempPath = $request->file('image')->store('temp', 'local');
                $fullPath = storage_path('app/' . $tempPath);
                
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'Aucune image fournie'
                ], 400);
            }

            // Récupérer le service OCR Tesseract (gratuit, offline)
            $recognitionService = app(\App\Services\TesseractOcrService::class);

            // Analyser l'image
            $analysis = $recognitionService->analyzeGamingProduct($fullPath);

            // Nettoyer le fichier temporaire
            if ($tempPath) {
                \Storage::disk('local')->delete($tempPath);
            }

            \Log::info('Analyse Tesseract OCR', [
                'success' => $analysis['success'] ?? false,
                'suggestions' => $analysis['suggestions'] ?? null,
            ]);

            return response()->json($analysis);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation échouée: ' . implode(', ', $e->errors()['image'] ?? ['Erreur de validation'])
            ], 422);

        } catch (\Exception $e) {
            \Log::error('Erreur analyse IA image', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'analyse: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Recherche de jeu par ROM ID
     */
    /**
     * Recherche unifiée de jeux par ROM ID ou nom
     */
    public function searchGame(Request $request)
    {
        $platform = $request->input('platform');
        $query = $request->input('query');

        if (!$platform || !$query) {
            return response()->json([
                'success' => false,
                'message' => 'Paramètres manquants'
            ]);
        }

        $tableName = $this->getGameTableName($platform);
        if (!$tableName) {
            return response()->json([
                'success' => false,
                'message' => 'Plateforme non reconnue'
            ]);
        }

        // Découper la requête en mots pour recherche intelligente
        $words = array_filter(explode(' ', $query));
        
        $games = \DB::table($tableName)
            ->where(function($q) use ($query, $words, $tableName) {
                // Recherche exacte par ROM ID/slug
                if (\Schema::hasColumn($tableName, 'rom_id')) {
                    $q->where('rom_id', 'LIKE', '%' . $query . '%');
                }
                if (\Schema::hasColumn($tableName, 'slug')) {
                    $q->orWhere('slug', 'LIKE', '%' . $query . '%');
                }
                
                // Recherche par nom (exact)
                $q->orWhere('name', 'LIKE', '%' . $query . '%');
                
                // Si plusieurs mots, recherche chaque mot séparément (plus flexible)
                if (count($words) > 1) {
                    $q->orWhere(function($subQ) use ($words) {
                        foreach ($words as $word) {
                            $subQ->where('name', 'LIKE', '%' . $word . '%');
                        }
                    });
                }
            })
            ->limit(15)
            ->get();

        if ($games->count() > 0) {
            // Ajouter la région détectée depuis le ROM ID
            $gamesWithRegion = $games->map(function($game) {
                $romId = $game->rom_id ?? $game->slug ?? '';
                $game->region = $this->detectRegionFromRomId($romId);
                return $game;
            });
            
            return response()->json([
                'success' => true,
                'games' => $gamesWithRegion
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Aucun jeu trouvé'
        ]);
    }

    /**
     * Recherche de jeux par ROM ID
     */
    public function searchGameByRomId(Request $request)
    {
        $platform = $request->input('platform');
        $romId = $request->input('romid');
        $suggestions = $request->input('suggestions', false);

        if (!$platform || !$romId) {
            return response()->json([
                'success' => false,
                'message' => 'Paramètres manquants'
            ]);
        }

        $tableName = $this->getGameTableName($platform);
        if (!$tableName) {
            return response()->json([
                'success' => false,
                'message' => 'Plateforme non reconnue'
            ]);
        }

        if ($suggestions) {
            // Mode suggestions : retourner plusieurs résultats
            $query = \DB::table($tableName);
            
            // Certaines tables (ex: Game Gear) utilisent 'slug' au lieu de 'rom_id'
            if (\Schema::hasColumn($tableName, 'rom_id')) {
                $query->where(function($q) use ($romId, $tableName) {
                    $q->where('rom_id', 'LIKE', '%' . $romId . '%');
                    // Si la table a aussi un slug, chercher dedans aussi
                    if (\Schema::hasColumn($tableName, 'slug')) {
                        $q->orWhere('slug', 'LIKE', '%' . $romId . '%');
                    }
                });
            } else if (\Schema::hasColumn($tableName, 'slug')) {
                $query->where('slug', 'LIKE', '%' . $romId . '%');
            }
            
            // Trier par ROM ID et région pour grouper les versions ensemble
            if (\Schema::hasColumn($tableName, 'region')) {
                $query->orderBy('rom_id')->orderBy('region');
            }
            
            $games = $query->limit(20)->get();
            
            // Utiliser la région de la BDD si disponible, sinon détecter
            $gamesWithRegion = $games->map(function($game) {
                $romIdValue = $game->rom_id ?? $game->slug ?? '';
                
                // Prioriser la région de la BDD si elle existe et n'est pas vide
                if (isset($game->region) && $game->region && $game->region !== 'N/A') {
                    $game->region_display = $game->region;
                } else {
                    // Sinon détecter depuis le ROM ID
                    $detectedRegion = $this->detectRegionFromRomId($romIdValue);
                    $game->region_display = $detectedRegion ?? $game->region ?? '';
                }
                
                return $game;
            });

            return response()->json([
                'success' => $games->count() > 0,
                'games' => $gamesWithRegion
            ]);
        }

        // Mode recherche exacte : un seul résultat
        $query = \DB::table($tableName);
        
        if (\Schema::hasColumn($tableName, 'rom_id')) {
            $query->where(function($q) use ($romId, $tableName) {
                $q->where('rom_id', 'LIKE', '%' . $romId . '%');
                if (\Schema::hasColumn($tableName, 'slug')) {
                    $q->orWhere('slug', 'LIKE', '%' . $romId . '%');
                }
            });
        } else if (\Schema::hasColumn($tableName, 'slug')) {
            $query->where('slug', 'LIKE', '%' . $romId . '%');
        }
        
        $game = $query->first();

        if ($game) {
            // Ajouter la région détectée
            $romId = $game->rom_id ?? $game->slug ?? '';
            $game->region = $this->detectRegionFromRomId($romId);
            
            return response()->json([
                'success' => true,
                'game' => $game
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Jeu non trouvé'
        ]);
    }

    /**
     * Recherche de jeux par nom
     */
    public function searchGameByName(Request $request)
    {
        $platform = $request->input('platform');
        $name = $request->input('name');
        $suggestions = $request->input('suggestions', false);

        if (!$platform || !$name) {
            return response()->json([
                'success' => false,
                'message' => 'Paramètres manquants'
            ]);
        }

        $tableName = $this->getGameTableName($platform);
        if (!$tableName) {
            return response()->json([
                'success' => false,
                'message' => 'Plateforme non reconnue'
            ]);
        }

        $limit = $suggestions ? 10 : 20;

        $games = \DB::table($tableName)
            ->where('name', 'LIKE', '%' . $name . '%')
            ->limit($limit)
            ->get();

        if ($games->count() > 0) {
            // Ajouter la région détectée
            $gamesWithRegion = $games->map(function($game) {
                $romId = $game->rom_id ?? $game->slug ?? '';
                $game->region = $this->detectRegionFromRomId($romId);
                return $game;
            });
            
            return response()->json([
                'success' => true,
                'games' => $gamesWithRegion
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Aucun jeu trouvé'
        ]);
    }

    /**
     * Obtenir le nom de la table pour une plateforme donnée
     */
    private function getGameTableName($platform)
    {
        $tables = [
            'gameboy' => 'game_boy_games',
            'n64' => 'n64_games',
            'nes' => 'nes_games',
            'snes' => 'snes_games',
            'gamegear' => 'game_gear_games',
            'wonderswan' => 'wonderswan_games',
            'segasaturn' => 'sega_saturn_games',
            'megadrive' => 'mega_drive_games'
        ];

        return $tables[$platform] ?? null;
    }

    /**
     * Mettre à jour un champ de jeu
     */
    public function updateGameField(Request $request)
    {
        $validated = $request->validate([
            'game_id' => 'required|integer',
            'platform' => 'required|string',
            'field' => 'required|string|in:rom_id,name,year,publisher,developer,region,alternate_names',
            'value' => 'nullable|string'
        ]);

        $tableName = $this->getGameTableName($validated['platform']);
        if (!$tableName) {
            return response()->json([
                'success' => false,
                'message' => 'Plateforme non reconnue'
            ]);
        }

        // Vérifier que la colonne existe
        if (!\Schema::hasColumn($tableName, $validated['field'])) {
            return response()->json([
                'success' => false,
                'message' => 'Champ non valide pour cette plateforme'
            ]);
        }

        // Mettre à jour le champ
        \DB::table($tableName)
            ->where('id', $validated['game_id'])
            ->update([
                $validated['field'] => $validated['value'],
                'updated_at' => now()
            ]);

        return response()->json([
            'success' => true,
            'message' => 'Champ mis à jour avec succès'
        ]);
    }

    /**
     * Recherche d'éditeurs pour autocomplete
     */
    public function searchPublishers(Request $request)
    {
        $query = $request->input('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        
        $publishers = \App\Models\Publisher::search($query, 20);
        
        return response()->json([
            'publishers' => $publishers->map(function($publisher) {
                return [
                    'id' => $publisher->id,
                    'name' => $publisher->name,
                    'slug' => $publisher->slug,
                    'logo' => $publisher->logo,
                ];
            })
        ]);
    }

    /**
     * Créer un nouvel éditeur
     */
    public function createPublisher(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            $publisher = \App\Models\Publisher::findOrCreateByName($validated['name']);
            
            return response()->json([
                'success' => true,
                'publisher' => [
                    'id' => $publisher->id,
                    'name' => $publisher->name,
                    'slug' => $publisher->slug,
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
