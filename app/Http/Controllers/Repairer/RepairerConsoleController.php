<?php

namespace App\Http\Controllers\Repairer;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\Mod;
use App\Models\Repairer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairerConsoleController extends Controller
{
    /**
     * Dashboard du réparateur
     */
    public function dashboard()
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer) {
            abort(403, 'Aucun réparateur associé à ce compte.');
        }

        // Charger les relations
        $repairer->load(['mods', 'operations']);

        // Statistiques
        $stats = [
            'total' => Console::where('repairer_id', $repairer->id)->count(),
            'pending' => Console::where('repairer_id', $repairer->id)->where('assignment_status', 'pending_acceptance')->count(),
            'accepted' => Console::where('repairer_id', $repairer->id)->where('assignment_status', 'accepted')->count(),
            'to_ship' => Console::where('repairer_id', $repairer->id)->where('assignment_status', 'to_ship')->count(),
            'repair' => Console::where('repairer_id', $repairer->id)->where('status', 'repair')->count(),
            'stock' => Console::where('repairer_id', $repairer->id)->where('status', 'stock')->count(),
            'defective' => Console::where('repairer_id', $repairer->id)->where('status', 'defective')->count(),
        ];

        // Consoles récentes
        $recentConsoles = Console::with(['articleCategory', 'articleSubCategory', 'articleType', 'destinationStore'])
            ->where('repairer_id', $repairer->id)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();

        // Toutes les opérations disponibles pour la gestion des compétences
        $allOperations = Mod::where('is_operation', true)
            ->orderBy('name')
            ->get();

        return view('repairer.dashboard', compact('repairer', 'stats', 'recentConsoles', 'allOperations'));
    }

    /**
     * Afficher la liste des consoles assignées au réparateur connecté
     */
    public function index()
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer) {
            abort(403, 'Aucun réparateur associé à ce compte.');
        }

        $consoles = Console::with(['articleCategory', 'articleSubCategory', 'articleType', 'mods', 'destinationStore'])
            ->where('repairer_id', $repairer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('repairer.consoles.index', compact('consoles', 'repairer'));
    }

    /**
     * Formulaire pour associer des mods/accessoires à une console
     */
    public function editMods(Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || $console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette console.');
        }

        // Charger les mods actuels de la console et les opérations du réparateur
        $console->load('mods');
        $repairer->load('operations');

        // Opérations que le réparateur peut effectuer (ses compétences)
        $repairerOperationIds = $repairer->operations->pluck('id')->toArray();
        
        // Opérations disponibles = uniquement celles dans les compétences du réparateur
        $operations = Mod::where('is_operation', true)
            ->whereIn('id', $repairerOperationIds)
            ->orderBy('name')
            ->get();
        
        // Mods (pas opération, pas accessoire)
        $mods = Mod::where('is_operation', false)
            ->where('is_accessory', false)
            ->orderBy('name')
            ->get();
        
        // Accessoires
        $accessories = Mod::where('is_operation', false)
            ->where('is_accessory', true)
            ->orderBy('name')
            ->get();
        
        // Mods disponibles chez le réparateur (avec stock)
        $repairerMods = $repairer->mods()->wherePivot('quantity', '>', 0)->get();

        return view('repairer.consoles.edit-mods', compact(
            'console', 
            'operations',
            'mods',
            'accessories',
            'repairerMods', 
            'repairer'
        ));
    }

    /**
     * Enregistrer les mods/accessoires associés à une console
     */
    public function updateMods(Request $request, Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || $console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette console.');
        }

        $validated = $request->validate([
            'mods' => ['nullable', 'array'],
            'mods.*.mod_id' => ['required', 'exists:mods,id'],
            'mods.*.price_applied' => ['nullable', 'numeric', 'min:0'],
            'mods.*.notes' => ['nullable', 'string', 'max:500'],
            'mods.*.work_time_minutes' => ['nullable', 'integer', 'min:0'],
            'commentaire_reparateur' => ['nullable', 'string', 'max:2000'],
        ]);

        // Synchroniser les mods
        $syncData = [];
        foreach ($validated['mods'] ?? [] as $modData) {
            $mod = Mod::find($modData['mod_id']);
            if (!$mod) continue;

            $syncData[$modData['mod_id']] = [
                'repairer_id' => $repairer->id,
                'price_applied' => $modData['price_applied'] ?? $mod->purchase_price,
                'notes' => $modData['notes'] ?? null,
                'work_time_minutes' => $modData['work_time_minutes'] ?? null,
            ];
        }

        $console->mods()->sync($syncData);

        // Mettre à jour le commentaire réparateur
        if (isset($validated['commentaire_reparateur'])) {
            $console->update([
                'commentaire_reparateur' => $validated['commentaire_reparateur'],
            ]);
        }

        return redirect()
            ->route('repairer.consoles.edit-mods', $console)
            ->with('success', 'Modifications enregistrées.');
    }

    /**
     * Ajouter un mod rapidement à une console
     */
    public function addMod(Request $request, Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || $console->repairer_id !== $repairer->id) {
            abort(403);
        }

        $validated = $request->validate([
            'mod_id' => ['required', 'exists:mods,id'],
            'price_applied' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:500'],
            'work_time_minutes' => ['nullable', 'integer', 'min:0'],
        ]);

        $mod = Mod::findOrFail($validated['mod_id']);

        // Vérifier si le mod n'est pas déjà associé
        if ($console->mods()->where('mod_id', $mod->id)->exists()) {
            return back()->with('error', 'Ce mod est déjà associé à cette console.');
        }

        $console->mods()->attach($mod->id, [
            'repairer_id' => $repairer->id,
            'price_applied' => $validated['price_applied'] ?? $mod->purchase_price,
            'notes' => $validated['notes'] ?? null,
            'work_time_minutes' => $validated['work_time_minutes'] ?? null,
        ]);

        return back()->with('success', "Mod \"{$mod->name}\" ajouté.");
    }

    /**
     * Retirer un mod d'une console
     */
    public function removeMod(Console $console, Mod $mod)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || $console->repairer_id !== $repairer->id) {
            abort(403);
        }

        $console->mods()->detach($mod->id);

        return back()->with('success', "Mod \"{$mod->name}\" retiré.");
    }

    /**
     * Récupérer le réparateur associé à l'utilisateur connecté
     */
    protected function getCurrentRepairer(): ?Repairer
    {
        $user = Auth::user();
        
        // Si l'utilisateur a un repairer_id direct
        if ($user->repairer_id ?? null) {
            return Repairer::find($user->repairer_id);
        }

        // Sinon chercher par email
        return Repairer::where('email', $user->email)->first();
    }

    /**
     * Mettre à jour les compétences (opérations) du réparateur
     */
    public function updateSkills(Request $request)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer) {
            abort(403, 'Aucun réparateur associé à ce compte.');
        }

        $validated = $request->validate([
            'operations' => ['nullable', 'array'],
            'operations.*' => ['exists:mods,id'],
        ]);

        // Synchroniser les opérations sélectionnées
        $repairer->operations()->sync($validated['operations'] ?? []);

        return back()->with('success', 'Vos compétences ont été mises à jour avec succès.');
    }

    /**
     * Marquer une console comme fonctionnelle (statut stock)
     */
    public function markFunctional(Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if ($console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette console.');
        }

        if (!in_array($console->status, ['repair', 'defective'])) {
            return back()->with('error', 'Seules les consoles en réparation ou défectueuses peuvent être déclarées fonctionnelles.');
        }

        $console->update(['status' => 'stock']);

        return back()->with('success', 'Console déclarée fonctionnelle et passée en stock.');
    }
    /**
     * Accepter l'affectation d'une console
     */
    public function acceptAssignment(Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if ($console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'\u00eates pas autoris\u00e9 \u00e0 accepter cette affectation.');
        }

        if ($console->assignment_status !== 'pending_acceptance') {
            return back()->with('error', 'Cette console n\'est pas en attente d\'acceptation.');
        }

        $console->update([
            'assignment_status' => 'accepted',
            'assignment_accepted_at' => now(),
        ]);

        return back()->with('success', 'Affectation accept\u00e9e. Vous pouvez maintenant confirmer la r\u00e9ception.');
    }

    /**
     * Confirmer la r\u00e9ception physique d'une console
     */
    public function confirmReceipt(Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if ($console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'\u00eates pas autoris\u00e9 \u00e0 confirmer la r\u00e9ception.');
        }

        if ($console->assignment_status !== 'accepted') {
            return back()->with('error', 'Vous devez d\'abord accepter l\'affectation.');
        }

        $console->update([
            'assignment_status' => 'received',
            'assignment_received_at' => now(),
        ]);

        return back()->with('success', 'R\u00e9ception confirm\u00e9e. Vous pouvez maintenant travailler sur cette console.');
    }

    /**
     * Confirmer l'expédition d'une console vers le magasin
     */
    public function confirmShipment(Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if ($console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette console.');
        }

        if ($console->assignment_status !== 'to_ship') {
            return back()->with('error', 'Cette console n\'est pas marquée comme devant être expédiée.');
        }

        if (!$console->destination_store_id) {
            return back()->with('error', 'Aucun magasin de destination défini.');
        }

        $console->update([
            'assignment_status' => 'unassigned',
            'shipped_at' => now(),
            'repairer_id' => null, // Libérer le réparateur
        ]);

        return back()->with('success', 'Expédition confirmée vers ' . $console->destinationStore->name . '.');
    }

    /**
     * Repasser une console en réparation (défaillance découverte)
     */
    public function markForRepair(Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if ($console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette console.');
        }

        if ($console->assignment_status !== 'received') {
            return back()->with('error', 'Seules les consoles réceptionnées peuvent être repassées en réparation.');
        }

        $console->update(['status' => 'repair']);

        return back()->with('success', 'Console repassée en réparation.');
    }

    /**
     * Formulaire de création d'article (pour réparateurs autorisés)
     */
    public function createArticle()
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || !$repairer->canCreateArticles()) {
            abort(403, 'Vous n\'êtes pas autorisé à créer des articles.');
        }

        // Ré-utiliser le formulaire admin mais avec des données limitées
        $articleCategories = \App\Models\ArticleCategory::orderBy('name')->get();
        $repairers = \App\Models\Repairer::where('id', $repairer->id)->get();
        $stores = \App\Models\Store::orderBy('name')->get();
        $console = new Console();
        
        // Pré-remplir le réparateur
        $console->repairer_id = $repairer->id;
        $console->lieu_stockage = $repairer->address . ', ' . $repairer->city;

        $provenances = Console::whereNotNull('provenance_article')->distinct()->pluck('provenance_article');
        $mods = Console::whereNotNull('mod_1')->distinct()->pluck('mod_1');
        $lieux = Console::whereNotNull('lieu_stockage')->distinct()->pluck('lieu_stockage');
        $lastConsoles = Console::with(['articleCategory','articleSubCategory','articleType','repairer'])
            ->where('repairer_id', $repairer->id)
            ->latest()
            ->take(15)
            ->get();

        return view('admin.consoles.form', compact(
            'console', 
            'articleCategories', 
            'repairers', 
            'stores', 
            'provenances', 
            'mods', 
            'lieux',
            'lastConsoles'
        ));
    }

    /**
     * Enregistrer un nouvel article créé par un réparateur
     */
    public function storeArticle(Request $request)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || !$repairer->canCreateArticles()) {
            abort(403, 'Vous n\'êtes pas autorisé à créer des articles.');
        }

        // Forcer le repairer_id
        $data = $request->all();
        $data['repairer_id'] = $repairer->id;
        
        // Déléguer au controller admin
        $adminController = app(\App\Http\Controllers\Admin\ConsoleAdminController::class);
        $console = $adminController->storeArticle($request);
        
        return redirect()->route('repairer.dashboard')
            ->with('success', 'Article créé avec succès !');
    }

    /**
     * Formulaire d'édition d'article assigné au réparateur
     */
    public function editArticle(Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || $console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette console.');
        }

        $articleCategories = \App\Models\ArticleCategory::orderBy('name')->get();
        $repairers = \App\Models\Repairer::where('id', $repairer->id)->get();
        $stores = \App\Models\Store::orderBy('name')->get();

        $provenances = Console::whereNotNull('provenance_article')->distinct()->pluck('provenance_article');
        $mods = Console::whereNotNull('mod_1')->distinct()->pluck('mod_1');
        $lieux = Console::whereNotNull('lieu_stockage')->distinct()->pluck('lieu_stockage');
        $lastConsoles = Console::with(['articleCategory','articleSubCategory','articleType','repairer'])
            ->where('repairer_id', $repairer->id)
            ->latest()
            ->take(15)
            ->get();

        return view('admin.consoles.form', compact(
            'console', 
            'articleCategories', 
            'repairers', 
            'stores', 
            'provenances', 
            'mods', 
            'lieux',
            'lastConsoles'
        ));
    }

    /**
     * Mettre à jour un article assigné au réparateur
     */
    public function updateArticle(Request $request, Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || $console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette console.');
        }

        // Empêcher de changer le repairer_id
        $data = $request->except('repairer_id');
        
        // Déléguer au controller admin
        $adminController = app(\App\Http\Controllers\Admin\ConsoleAdminController::class);
        $result = $adminController->updateArticle($request, $console);
        
        return redirect()->route('repairer.dashboard')
            ->with('success', 'Article mis à jour avec succès !');
    }
}