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
            'offer_ids' => 'required|array',
            'offer_ids.*' => 'exists:console_offers,id',
            'payment_date' => 'required|date',
        ]);

        $offerIds = $request->input('offer_ids');
        $paymentDate = $request->input('payment_date');

        $updated = ConsoleOffer::whereIn('id', $offerIds)
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
            'offer_ids' => 'required|array',
            'offer_ids.*' => 'exists:console_offers,id',
            'tracking_number' => 'nullable|string|max:255',
            'carrier' => 'nullable|string|max:255',
        ]);

        $offerIds = $request->input('offer_ids');
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
            'offer_ids' => 'required|array',
            'offer_ids.*' => 'exists:console_offers,id',
        ]);

        $offerIds = $request->input('offer_ids');

        DB::beginTransaction();
        try {
            // Récupérer les offres
            $offers = ConsoleOffer::whereIn('id', $offerIds)
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
}
