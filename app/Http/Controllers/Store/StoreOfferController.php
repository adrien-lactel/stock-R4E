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
}
