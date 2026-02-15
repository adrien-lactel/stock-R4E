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
        $store = \App\Models\Store::findOrFail($storeId);

        // Offres à valider
        $offers = ConsoleOffer::with([
            'console.articleType',
            'console.articleCategory',
            'console.articleSubCategory',
            'console.mods',
            'console.productSheet',
        ])
            ->where('store_id', $storeId)
            ->where('status', 'proposed')
            ->orderBy('created_at', 'desc')
            ->get();

        // Offres validées (en attente d'expédition)
        $validatedOffers = ConsoleOffer::with([
            'console.articleType',
            'console.articleCategory',
            'console.articleSubCategory',
            'console.mods',
            'console.productSheet',
        ])
            ->where('store_id', $storeId)
            ->whereIn('status', ['validated_buy', 'validated_consignment'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('store.offers.index', compact('offers', 'validatedOffers', 'store'));
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

    /**
     * Acheter en masse les offres sélectionnées
     * POST /store/offers/bulk-buy
     */
    public function bulkBuy(Request $request)
    {
        $storeId = Auth::user()->store_id;
        
        $validated = $request->validate([
            'offer_ids' => ['required', 'json'],
        ]);
        
        $offerIds = json_decode($validated['offer_ids'], true);
        
        if (empty($offerIds)) {
            return back()->with('error', 'Aucun article sélectionné.');
        }
        
        $offers = ConsoleOffer::whereIn('id', $offerIds)
            ->where('store_id', $storeId)
            ->where('status', 'proposed')
            ->get();
        
        if ($offers->isEmpty()) {
            return back()->with('error', 'Aucune offre valide à traiter.');
        }
        
        $count = 0;
        $total = 0;
        
        foreach ($offers as $offer) {
            // Marquer comme validé pour achat (en attente d'expédition)
            $offer->update(['status' => 'validated_buy']);
            
            $count++;
            $total += $offer->sale_price ?? 0;
        }
        
        return back()->with('success', "$count article(s) validé(s) pour achat (Total: " . number_format($total, 2) . " €). Les articles seront expédiés à votre adresse.");
    }

    /**
     * Prendre en dépôt-vente les offres sélectionnées
     * POST /store/offers/bulk-consignment
     */
    public function bulkConsignment(Request $request)
    {
        $storeId = Auth::user()->store_id;
        
        $validated = $request->validate([
            'offer_ids' => ['required', 'json'],
        ]);
        
        $offerIds = json_decode($validated['offer_ids'], true);
        
        if (empty($offerIds)) {
            return back()->with('error', 'Aucun article sélectionné.');
        }
        
        $offers = ConsoleOffer::whereIn('id', $offerIds)
            ->where('store_id', $storeId)
            ->where('status', 'proposed')
            ->get();
        
        if ($offers->isEmpty()) {
            return back()->with('error', 'Aucune offre valide à traiter.');
        }
        
        $count = 0;
        $total = 0;
        
        foreach ($offers as $offer) {
            // Marquer comme validé pour dépôt-vente (en attente d'expédition)
            $offer->update(['status' => 'validated_consignment']);
            
            $count++;
            $total += $offer->consignment_price ?? $offer->sale_price ?? 0;
        }
        
        return back()->with('success', "$count article(s) validé(s) pour dépôt-vente (Total: " . number_format($total, 2) . " €). Les articles seront expédiés à votre adresse.");
    }

    /**
     * Refuser en masse les offres sélectionnées
     * POST /store/offers/bulk-reject
     */
    public function bulkReject(Request $request)
    {
        $storeId = Auth::user()->store_id;
        
        $validated = $request->validate([
            'offer_ids' => ['required', 'json'],
        ]);
        
        $offerIds = json_decode($validated['offer_ids'], true);
        
        if (empty($offerIds)) {
            return back()->with('error', 'Aucun article sélectionné.');
        }
        
        $count = ConsoleOffer::whereIn('id', $offerIds)
            ->where('store_id', $storeId)
            ->where('status', 'proposed')
            ->update(['status' => 'rejected']);
        
        return back()->with('success', "$count article(s) refusé(s).");
    }

    /**
     * Afficher le suivi des envois côté magasin
     */
    public function tracking()
    {
        $storeId = Auth::user()->store_id;
        $store = \App\Models\Store::findOrFail($storeId);

        // Récupérer tous les envois (shipped et received)
        $shipments = ConsoleOffer::with([
            'console.articleType',
            'console.productSheet',
        ])
            ->where('store_id', $storeId)
            ->whereIn('status', ['shipped', 'received'])
            ->orderBy('shipped_at', 'desc')
            ->get();

        return view('store.offers.tracking', compact('shipments', 'store'));
    }

    /**
     * Confirmer la réception d'un envoi
     */
    public function confirmReception(Request $request)
    {
        $storeId = Auth::user()->store_id;
        
        $validated = $request->validate([
            'offer_ids' => ['required', 'array'],
            'offer_ids.*' => ['exists:console_offers,id'],
        ]);
        
        $offerIds = $validated['offer_ids'];
        
        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            // Récupérer les offres
            $offers = ConsoleOffer::whereIn('id', $offerIds)
                ->where('store_id', $storeId)
                ->where('status', 'shipped')
                ->with('console')
                ->get();

            foreach ($offers as $offer) {
                // Marquer comme reçu
                $offer->update([
                    'status' => 'received',
                    'received_at' => now(),
                ]);

                // Attacher la console au magasin si ce n'est pas déjà fait
                $console = $offer->console;
                if (!$console->stores()->where('stores.id', $storeId)->exists()) {
                    $console->stores()->attach($storeId, [
                        'sale_price' => $offer->sale_price,
                    ]);
                }

                // Déterminer le bon statut selon le type d'offre
                // L'offre a le statut original dans un autre champ ou on peut le déduire
                // Pour simplifier, on vérifie si c'était un achat (payment_received = true) ou dépôt
                if ($offer->payment_received) {
                    $console->update(['status' => 'stock']);
                } else {
                    $console->update(['status' => 'stock']); // ou 'consignment' selon votre logique
                }
            }

            \Illuminate\Support\Facades\DB::commit();
            return back()->with('success', count($offers) . " article(s) réceptionné(s) avec succès.");
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->with('error', 'Erreur lors de la réception : ' . $e->getMessage());
        }
    }
}
