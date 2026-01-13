<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\Store;
use App\Models\ConsoleOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsoleOfferController extends Controller
{
    /**
     * Enregistrer les offres proposées par magasin
     * POST /admin/consoles/{console}/offers
     */
    public function store(Request $request, Console $console)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        if ($console->status !== 'stock') {
            return back()->with('error', 'Impossible de proposer : article non en stock.');
        }

        $validated = $request->validate([
            'offers'   => ['required', 'array'],
            'offers.*' => ['nullable', 'numeric', 'min:0'],
        ]);

        foreach ($validated['offers'] as $storeId => $price) {
            if (!Store::whereKey($storeId)->exists()) {
                continue;
            }

            // Si vide => on supprime l'offre existante
            if ($price === null || $price === '') {
                ConsoleOffer::where('console_id', $console->id)
                    ->where('store_id', $storeId)
                    ->delete();
                continue;
            }

            // Sinon on crée/met à jour l'offre
            ConsoleOffer::updateOrCreate(
                [
                    'console_id' => $console->id,
                    'store_id' => $storeId,
                ],
                [
                    'sale_price' => $price,
                    'status' => 'proposed',
                ]
            );
        }

        return back()->with('success', 'Offres mises à jour.');
    }

    /**
     * Liste des demandes de lots (Admin Dashboard)
     * GET /admin/lot-requests
     */
    public function requests()
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $requests = \App\Models\StoreLotRequest::with([
            'store',
            'consoleOffer.console.articleType',
        ])
            ->where('status', 'pending')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.lot-requests.index', compact('requests'));
    }

    /**
     * Valider une demande de lot
     * POST /admin/lot-requests/{request}/validate
     */
    public function validateRequest(\App\Models\StoreLotRequest $request)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        if ($request->status !== 'pending') {
            return back()->with('error', 'Demande déjà traitée.');
        }

        $offer = $request->consoleOffer;
        $console = $offer->console;
        $store = $request->store;

        // Créer autant de consoles que demandé
        for ($i = 0; $i < $request->quantity; $i++) {
            // Cloner la console si quantity > 1
            if ($i > 0) {
                $newConsole = $console->replicate();
                $newConsole->save();
                $console = $newConsole;
            }

            // Transférer au magasin
            $console->update([
                'store_id' => $store->id,
                'status' => 'stock',
            ]);

            // Ajouter à son prix de vente
            $store->consoles()->syncWithoutDetaching([
                $console->id => ['sale_price' => $offer->sale_price]
            ]);
        }

        // Marquer la demande comme validée
        $request->update(['status' => 'validated']);
        $offer->update(['status' => 'sent']);

        return back()->with('success', "{$request->quantity} article(s) transféré(s) à {$store->name}.");
    }

    /**
     * Rejeter une demande de lot
     * POST /admin/lot-requests/{request}/reject
     */
    public function rejectRequest(Request $request, \App\Models\StoreLotRequest $lotRequest)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $validated = $request->validate([
            'admin_comment' => 'required|string|min:5',
        ]);

        if ($lotRequest->status !== 'pending') {
            return back()->with('error', 'Demande déjà traitée.');
        }

        $lotRequest->update([
            'status' => 'rejected',
            'admin_comment' => $validated['admin_comment'],
        ]);

        return back()->with('success', 'Demande rejetée.');
    }
}
