<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\ConsoleOffer;
use App\Models\StoreLotRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoreOfferController extends Controller
{
    /**
     * Voir les offres disponibles
     * GET /store/{store}/offers
     */
    public function index()
    {
        $storeId = Auth::user()->store_id;

        $offers = ConsoleOffer::with([
            'console.articleType',
            'console.articleCategory',
            'console.articleSubCategory',
            'console.mods', // Pour afficher les mods/opérations
            'console.productSheet', // Fiche produit
        ])
            ->where('store_id', $storeId)
            ->where('status', 'proposed')
            ->orderBy('created_at', 'desc')
            ->get();

        return view('store.offers.index', compact('offers'));
    }

    /**
     * Demander un lot (ajouter à la commande)
     * POST /store/offers/{offer}/request
     */
    public function request(Request $request, ConsoleOffer $offer)
    {
        $storeId = Auth::user()->store_id;

        if ($offer->store_id !== $storeId) {
            abort(403);
        }

        $validated = $request->validate([
            'quantity' => ['required', 'integer', 'min:1'],
        ]);

        // Vérifier si une demande est déjà en attente
        $existing = StoreLotRequest::where('console_offer_id', $offer->id)
            ->where('store_id', $storeId)
            ->where('status', 'pending')
            ->first();

        if ($existing) {
            return back()->with('error', 'Demande déjà en attente pour cet article.');
        }

        StoreLotRequest::create([
            'store_id' => $storeId,
            'console_offer_id' => $offer->id,
            'quantity' => $validated['quantity'],
            'status' => 'pending',
        ]);

        return back()->with('success', 'Demande de lot envoyée !');
    }

    /**
     * Accepter une offre
     * POST /store/offers/{offer}/accept
     */
    public function accept(ConsoleOffer $offer)
    {
        $storeId = Auth::user()->store_id;

        if ($offer->store_id !== $storeId) {
            abort(403);
        }

        // Marquer l'offre comme acceptée
        $offer->update(['status' => 'accepted']);

        // Attacher la console au magasin avec le prix de vente
        $console = $offer->console;
        
        // Si la console n'est pas déjà liée au magasin, l'attacher
        if (!$console->stores()->where('stores.id', $storeId)->exists()) {
            $console->stores()->attach($storeId, [
                'sale_price' => $offer->sale_price,
            ]);
        }

        // Mettre à jour le store_id de la console
        $console->update(['store_id' => $storeId]);

        return back()->with('success', 'Offre acceptée ! L\'article a été ajouté à votre stock.');
    }

    /**
     * Refuser une offre
     * POST /store/offers/{offer}/reject
     */
    public function reject(ConsoleOffer $offer)
    {
        $storeId = Auth::user()->store_id;

        if ($offer->store_id !== $storeId) {
            abort(403);
        }

        // Marquer l'offre comme refusée
        $offer->update(['status' => 'rejected']);

        return back()->with('success', 'Offre refusée.');
    }
}
