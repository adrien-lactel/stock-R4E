<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsoleOffer;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShipmentController extends Controller
{
    /**
     * Afficher le suivi des envois et réceptions
     */
    public function index()
    {
        // Récupérer toutes les offres validées groupées par magasin
        $validatedOffers = ConsoleOffer::whereIn('status', ['validated_buy', 'validated_consignment', 'shipped', 'received'])
            ->with(['console.productSheet', 'console.articleType', 'store'])
            ->orderBy('store_id')
            ->orderBy('status')
            ->get();

        // Grouper par magasin
        $offersByStore = $validatedOffers->groupBy('store_id');

        return view('admin.shipments.index', compact('offersByStore'));
    }

    /**
     * Marquer le paiement comme reçu
     */
    public function markPaymentReceived(Request $request)
    {
        $request->validate([
            'offer_ids' => 'required|string',
            'payment_date' => 'required|date',
        ]);

        // Décoder le JSON envoyé par Alpine.js
        $offerIds = json_decode($request->input('offer_ids'), true);
        
        if (!is_array($offerIds) || empty($offerIds)) {
            return back()->with('error', 'Aucune offre sélectionnée.');
        }
        
        // Valider que chaque ID existe et est de type validated_buy
        $validOfferIds = ConsoleOffer::whereIn('id', $offerIds)
            ->where('status', 'validated_buy')
            ->pluck('id')
            ->toArray();
        
        if (empty($validOfferIds)) {
            return back()->with('error', 'Aucune offre d\'achat valide trouvée.');
        }

        $paymentDate = $request->input('payment_date');

        $updated = ConsoleOffer::whereIn('id', $validOfferIds)
            ->where('status', 'validated_buy')
            ->update([
                'payment_received' => true,
                'payment_date' => $paymentDate,
            ]);

        return back()->with('success', "{$updated} paiement(s) enregistré(s) pour le {$paymentDate}.");
    }

    /**
     * Marquer un lot comme envoyé
     */
    public function markAsShipped(Request $request)
    {
        $request->validate([
            'offer_ids' => 'required|string',
            'tracking_number' => 'nullable|string|max:255',
            'carrier' => 'nullable|string|max:255',
        ]);

        // Décoder le JSON envoyé par Alpine.js
        $offerIds = json_decode($request->input('offer_ids'), true);
        
        if (!is_array($offerIds) || empty($offerIds)) {
            return back()->with('error', 'Aucune offre sélectionnée.');
        }
        
        // Valider que chaque ID existe
        $validOfferIds = ConsoleOffer::whereIn('id', $offerIds)
            ->whereIn('status', ['validated_buy', 'validated_consignment'])
            ->pluck('id')
            ->toArray();
        
        if (empty($validOfferIds)) {
            return back()->with('error', 'Aucune offre valide trouvée.');
        }

        $trackingNumber = $request->input('tracking_number');
        $carrier = $request->input('carrier');

        $updated = ConsoleOffer::whereIn('id', $offerIds)
            ->whereIn('status', ['validated_buy', 'validated_consignment'])
            ->update([
                'status' => 'shipped',
                'shipped_at' => now(),
                'tracking_number' => $trackingNumber,
                'carrier' => $carrier,
            ]);

        return back()->with('success', "{$updated} article(s) marqué(s) comme envoyé(s).");
    }

    /**
     * Marquer un lot comme reçu (côté magasin)
     */
    public function markAsReceived(Request $request)
    {
        $request->validate([
            'offer_ids' => 'required|string',
        ]);

        // Décoder le JSON envoyé par Alpine.js
        $offerIds = json_decode($request->input('offer_ids'), true);
        
        if (!is_array($offerIds) || empty($offerIds)) {
            return back()->with('error', 'Aucune offre sélectionnée.');
        }
        
        // Valider que chaque ID existe et est envoyé
        $validOfferIds = ConsoleOffer::whereIn('id', $offerIds)
            ->where('status', 'shipped')
            ->pluck('id')
            ->toArray();
        
        if (empty($validOfferIds)) {
            return back()->with('error', 'Aucune offre expédiée valide trouvée.');
        }

        DB::beginTransaction();
        try {
            // Récupérer les offres
            $offers = ConsoleOffer::whereIn('id', $validOfferIds)
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
                if (!$console->stores()->where('stores.id', $offer->store_id)->exists()) {
                    $console->stores()->attach($offer->store_id, [
                        'sale_price' => $offer->sale_price,
                    ]);
                }

                // Mettre à jour le statut de la console selon le type d'offre
                // Si payment_received est true, c'était un achat, sinon c'était un dépôt
                if ($offer->payment_received) {
                    $console->update(['status' => 'stock']);
                } else {
                    $console->update(['status' => 'stock']); // TODO: ajouter statut 'consignment' si nécessaire
                }
            }

            DB::commit();
            return back()->with('success', count($offers) . " article(s) réceptionné(s) avec succès.");
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Erreur lors de la réception : ' . $e->getMessage());
        }
    }

    /**
     * Afficher les demandes de paiement pour articles en dépôt-vente vendus
     */
    public function paymentRequests()
    {
        // Récupérer toutes les offres vendues avec demande de paiement
        $paymentRequests = ConsoleOffer::with([
            'console.productSheet',
            'console.articleType',
            'store',
        ])
            ->where('payment_requested', true)
            ->orderBy('payment_confirmed')
            ->orderBy('sold_at', 'desc')
            ->get();

        // Grouper par statut
        $pending = $paymentRequests->where('payment_confirmed', false);
        $confirmed = $paymentRequests->where('payment_confirmed', true);

        return view('admin.shipments.payment-requests', compact('pending', 'confirmed'));
    }

    /**
     * Confirmer le paiement d'une ou plusieurs demandes
     */
    public function confirmPayment(Request $request)
    {
        $request->validate([
            'offer_ids' => 'required|string',
        ]);

        // Décoder le JSON envoyé par Alpine.js
        $offerIds = json_decode($request->input('offer_ids'), true);
        
        if (!is_array($offerIds) || empty($offerIds)) {
            return back()->with('error', 'Aucune demande de paiement sélectionnée.');
        }
        
        // Valider que chaque ID existe et a une demande de paiement
        $validOfferIds = ConsoleOffer::whereIn('id', $offerIds)
            ->where('payment_requested', true)
            ->where('payment_confirmed', false)
            ->pluck('id')
            ->toArray();
        
        if (empty($validOfferIds)) {
            return back()->with('error', 'Aucune demande de paiement valide trouvée.');
        }

        $updated = ConsoleOffer::whereIn('id', $validOfferIds)
            ->where('payment_requested', true)
            ->where('payment_confirmed', false)
            ->update([
                'payment_confirmed' => true,
                'payment_confirmed_at' => now(),
            ]);

        $totalAmount = ConsoleOffer::whereIn('id', $validOfferIds)->sum('payment_request_amount');

        return back()->with('success', 
            "{$updated} paiement(s) confirmé(s) pour un total de " . 
            number_format($totalAmount, 2) . " €."
        );
    }
}
