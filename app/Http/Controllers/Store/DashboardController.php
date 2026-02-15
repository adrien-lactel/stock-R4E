<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Console;
use App\Models\ConsoleReturn;
use App\Models\RepairQuote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * =========================
     * DASHBOARD MAGASIN
     * =========================
     */
    public function index(Store $store)
{
    // =====================
    // Sécurité magasin
    // Autoriser les admins à voir tous les dashboards
    // =====================
    $user = Auth::user();
    if ($user->role !== 'admin' && $user->store_id !== $store->id) {
        abort(403, 'Accès non autorisé à ce magasin');
    }

    // =====================
    // STOCK VENDABLE
    // =====================
    $consoles = $store->consoles()
        ->with(['articleType', 'articleCategory', 'articleSubCategory', 'repairer'])
        ->where('status', 'stock')
        ->get();

    // =====================
    // 🛠️ SAV & RÉPARATIONS EN COURS
    // =====================
    $savConsoles = ConsoleReturn::with([
            'console.articleType',
            'console.articleCategory',
            'console.articleSubCategory',
            'repairQuote',
            'repairer',
        ])
        ->where('store_id', $store->id)
        ->where('is_external', false)
        ->orderBy('created_at', 'desc')
        ->get();

    // =====================
    // 🛠️ SAV EXTERNES (sans console)
    // =====================
    $externalRepairs = ConsoleReturn::with(['repairQuote', 'repairer'])
        ->where('store_id', $store->id)
        ->where('is_external', true)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('store.dashboard', compact(
        'store',
        'consoles',
        'savConsoles',
        'externalRepairs'
    ));
}



    /**
     * =====================
     * FICHE PRODUIT
     * =====================
     */
    public function productSheet(Store $store, Console $console)
    {
        // Vérifier que le magasin a accès à cette console
        $user = Auth::user();
        if ($user->role !== 'admin' && $user->store_id !== $store->id) {
            abort(403, 'Accès non autorisé');
        }

        // Initialiser $offer à null
        $offer = null;

        // Charger la console avec ses relations
        // Si la console n'est pas dans le stock, vérifier s'il y a une offre
        $consoleInStock = $store->consoles()
            ->with([
                'articleType', 
                'articleCategory', 
                'articleSubCategory.brand', 
                'mods', 
                'productSheet'
            ])
            ->find($console->id);

        if ($consoleInStock) {
            $console = $consoleInStock;
        } else {
            // Vérifier si une offre existe pour ce magasin
            $offer = \App\Models\ConsoleOffer::where('console_id', $console->id)
                ->where('store_id', $store->id)
                ->where('status', 'proposed')
                ->first();

            if (!$offer && $user->role !== 'admin') {
                abort(404, 'Console non disponible pour ce magasin');
            }

            // Charger la console avec ses relations
            $console->load([
                'articleType', 
                'articleCategory', 
                'articleSubCategory.brand', 
                'mods', 
                'productSheet'
            ]);
        }

        return view('store.product-sheet', compact('store', 'console', 'offer'));
    }

    /**
     * =====================
     * VENTE
     * =====================
     */
    public function sell(Console $console)
    {
        $storeId = Auth::user()->store_id;

        if (!$console->stores()->where('stores.id', $storeId)->exists()) {
            abort(403);
        }

        $console->update([
            'status' => 'vendue',
            'sold_at' => now(),
        ]);

        return back()->with('success', 'Console vendue avec succès');
    }

    /**
     * =====================
     * DÉCLARATION PROBLÈME (SAV)
     * =====================
     */
   public function defective(Request $request, Console $console)
{
    $storeId = Auth::user()->store_id;

    // Sécurité pivot
    if (!$console->stores()->where('stores.id', $storeId)->exists()) {
        abort(403);
    }

    // 🚫 BLOQUER SI UN SAV EXISTE DÉJÀ
    if ($console->returnRequest) {
        return back()->with('error', 'Une demande SAV existe déjà pour cette console.');
    }

    $request->validate([
        'comment' => 'required|string|min:5',
    ]);

    ConsoleReturn::create([
        'console_id' => $console->id,
        'store_id'   => $storeId,
        'comment'    => $request->comment,
        'status'     => 'pending',
    ]);

    return back()->with('success', 'Demande SAV envoyée.');
}


    /**
     * =====================
     * ANNULATION DEMANDE SAV
     * =====================
     */
    public function cancelReturn(Console $console)
    {
        $storeId = Auth::user()->store_id;

        if (!$console->stores()->where('stores.id', $storeId)->exists()) {
            abort(403);
        }

        $return = $console->returnRequest;

        if (!$return || $return->status !== 'pending') {
            return back()->with('error', 'Aucune demande SAV annulable.');
        }

        $return->delete();

        return back()->with('success', 'Demande SAV annulée.');
    }

    /**
     * =====================
     * DEMANDE DE DEVIS (placeholder)
     * =====================
     */
    public function requestRepairQuote(Console $console)
    {
        $storeId = Auth::user()->store_id;

        if (!$console->stores()->where('stores.id', $storeId)->exists()) {
            abort(403);
        }

        if (
            !$console->returnRequest ||
            $console->returnRequest->status !== 'rejected'
        ) {
            return back()->with('error', 'Aucune demande de devis possible.');
        }

        return back()->with(
            'success',
            'Demande de devis enregistrée (en attente de l’administrateur).'
        );
    }

    /**
     * =====================
     * MARQUER ARTICLE ENVOYÉ AU RÉPARATEUR
     * =====================
     */
    public function sendToRepairer(Console $console)
    {
        $storeId = Auth::user()->store_id;

        // Sécurité pivot
        if (!$console->stores()->where('stores.id', $storeId)->exists()) {
            abort(403);
        }

        $return = $console->returnRequest;

        if (!$return || $return->status !== 'accepted') {
            return back()->with('error', 'Ce SAV n\'est pas en attente d\'envoi.');
        }

        $return->update([
            'status' => 'sent_to_repairer',
        ]);

        return back()->with('success', 'Article marqué comme envoyé au réparateur.');
    }

    /**
     * =====================
     * MARQUER ARTICLE EXTERNE ENVOYÉ AU RÉPARATEUR
     * =====================
     */
    public function sendToRepairerExternal(ConsoleReturn $consoleReturn)
    {
        // Sécurité : vérifier que c'est bien une réparation externe du magasin
        if ($consoleReturn->store_id !== Auth::user()->store_id) {
            abort(403);
        }

        if (!$consoleReturn->is_external) {
            return back()->with('error', 'Cette méthode est réservée aux réparations externes.');
        }

        if ($consoleReturn->status !== 'accepted') {
            return back()->with('error', 'Ce SAV n\'est pas en attente d\'envoi.');
        }

        $consoleReturn->update([
            'status' => 'sent_to_repairer',
        ]);

        return back()->with('success', 'Article externe marqué comme envoyé au réparateur.');
    }

    /**
     * =====================
     * ACCEPTATION DEVIS
     * =====================
     */
    public function acceptRepairQuote(RepairQuote $quote)
    {
        if ($quote->store_id !== Auth::user()->store_id) {
            abort(403);
        }

        if ($quote->status !== 'proposed') {
            return back()->with('error', 'Ce devis ne peut plus être accepté.');
        }

        $quote->update([
            'status' => 'accepted',
        ]);

        // Mettre à jour la console uniquement si ce n'est pas une réparation externe
        if ($quote->console) {
            $quote->console->update([
                'status' => 'repair',
            ]);
        }

        // Mettre à jour le ConsoleReturn associé
        if ($quote->consoleReturn) {
            $quote->consoleReturn->update([
                'status' => 'accepted',
            ]);
        }

        return back()->with('success', 'Devis accepté. Réparation en cours.');
    }

    /**
     * =====================
     * REFUS DEVIS
     * =====================
     */
    public function rejectRepairQuote(RepairQuote $quote)
{
    $storeId = Auth::user()->store_id;

    // =====================
    // Sécurité magasin
    // =====================
    if ($quote->store_id !== $storeId) {
        abort(403);
    }

    // =====================
    // Vérifier statut
    // =====================
    if ($quote->status !== 'proposed') {
        return back()->with('error', 'Ce devis ne peut plus être refusé.');
    }

    // =====================
    // 1️⃣ Refuser le devis
    // =====================
    $quote->update([
        'status' => 'rejected',
    ]);

    // =====================
    // 2️⃣ Supprimer la demande SAV
    // =====================
    if ($quote->consoleReturn) {
        $quote->consoleReturn->delete();
    }

    // =====================
    // 3️⃣ Remettre la console vendable (seulement si ce n'est pas externe)
    // =====================
    if ($quote->console) {
        $quote->console->update([
            'status' => 'stock',
        ]);
        return back()->with('success', 'Devis refusé. La console est de nouveau disponible à la vente.');
    }

    return back()->with('success', 'Devis refusé.');
}

    /**
     * =====================
     * HISTORIQUE DES VENTES
     * =====================
     */
    public function sales(Store $store)
    {
        if (Auth::user()->store_id !== $store->id) {
            abort(403);
        }

        $sales = Console::with([
            'articleType',
            'articleCategory',
            'articleSubCategory',
            'returnRequest',
        ])
            ->where('store_id', $store->id)
            ->where('status', 'vendue')
            ->whereNotNull('sold_at')
            ->orderBy('sold_at', 'desc')
            ->get();

        return view('store.sales.index', compact('store', 'sales'));
    }

    /**
     * =====================
     * DEMANDE RÉPARATION EXTERNE
     * =====================
     */
    public function createExternalRepair(Store $store)
    {
        if (Auth::user()->store_id !== $store->id) {
            abort(403);
        }

        return view('store.external-repair.create', compact('store'));
    }

    public function storeExternalRepair(Request $request, Store $store)
    {
        if (Auth::user()->store_id !== $store->id) {
            abort(403);
        }

        $validated = $request->validate([
            'external_item_name' => ['required', 'string', 'max:255'],
            'external_item_description' => ['required', 'string'],
            'comment' => ['nullable', 'string'],
        ]);

        ConsoleReturn::create([
            'store_id' => $store->id,
            'is_external' => true,
            'external_item_name' => $validated['external_item_name'],
            'external_item_description' => $validated['external_item_description'],
            'comment' => $validated['comment'] ?? null,
            'status' => 'pending',
            'acknowledged' => false,
        ]);

        return redirect()
            ->route('store.dashboard', $store)
            ->with('success', 'Demande de réparation externe envoyée. L\'admin vous proposera un devis.');
    }

}

