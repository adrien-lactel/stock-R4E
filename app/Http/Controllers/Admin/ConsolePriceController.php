<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\Store;
use App\Models\ArticleType;
use App\Models\ConsoleOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConsolePriceController extends Controller
{
    /**
     * Page: /admin/prices
     * Affiche les articles (consoles) + les magasins + les prix pivot.
     */
    public function index(Request $request)
    {
        $query = Console::query()
            ->with(['articleType', 'store', 'offers']); // offers remplace stores pour les ConsoleOffers

        // Filtre type (article_type_id)
        if ($request->filled('type')) {
            $query->where('article_type_id', $request->type);
        }

        // Filtre statut
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filtre magasin "d'origine" (store_id)
        if ($request->filled('store_id')) {
            $query->where('store_id', $request->store_id);
        }

        // Recherche simple
        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($sub) use ($q) {
                $sub->where('serial_number', 'like', "%{$q}%")
                    ->orWhere('provenance_article', 'like', "%{$q}%")
                    ->orWhere('lieu_stockage', 'like', "%{$q}%");
            });
        }

        $consoles = $query->latest()->paginate(20)->withQueryString();

        $stores = Store::orderBy('name')->get();
        $types  = ArticleType::orderBy('name')->get();

        return view('admin.prices.index', compact('consoles', 'stores', 'types'));
    }

    /**
     * POST: /admin/prices/{console}
     * Enregistre les prix pour plusieurs magasins via pivot console_store_prices.
     *
     * Règle métier : prix éditables uniquement si status = stock
     */
    public function store(Request $request, Console $console)
    {
        // Règle métier
        if ($console->status !== 'stock') {
            return back()->with('error', 'Impossible de définir des prix : l’article n’est pas en état STOCK.');
        }

        // Validation
        $validated = $request->validate([
            'prices'   => ['required', 'array'],
            'prices.*' => ['nullable', 'numeric', 'min:0'],
        ]);

        $prices = $validated['prices'];

        /**
         * Deux comportements possibles :
         * A) Si un champ est vide => on supprime le prix (detach)
         * B) Si un champ est vide => on ignore (ne change rien)
         *
         * Ici je choisis A) detach, plus logique côté admin.
         */
        foreach ($prices as $storeId => $price) {

            if (!Store::whereKey($storeId)->exists()) {
                continue;
            }

            if ($price === null || $price === '') {
                ConsoleOffer::where('console_id', $console->id)
                    ->where('store_id', $storeId)
                    ->delete();
                continue;
            }

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

        return back()->with('success', 'Offres enregistrées. Les magasins peuvent maintenant les consulter.');
    }
}
