<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\ConsoleOffer;
use App\Models\Invoice;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FinancialDashboardController extends Controller
{
    /**
     * Afficher le bilan financier
     */
    public function index(Request $request)
    {
        // Période sélectionnée (par défaut : 12 derniers mois)
        $months = $request->input('months', 12);
        $startDate = Carbon::now()->subMonths($months);

        // =====================
        // 📊 KPIs GLOBAUX
        // =====================
        
        // Total des ventes (consoles vendues)
        $totalSales = Console::where('status', 'vendue')
            ->whereNotNull('sold_at')
            ->where('sold_at', '>=', $startDate)
            ->count();

        // Chiffre d'affaires total (consoles vendues directes)
        $directRevenue = Console::where('status', 'vendue')
            ->whereNotNull('sold_at')
            ->where('sold_at', '>=', $startDate)
            ->sum('valorisation');

        // Ventes via offres (dépôt-vente & achetés)
        $offerRevenue = ConsoleOffer::whereNotNull('sold_at')
            ->where('sold_at', '>=', $startDate)
            ->sum('sale_price');

        $totalRevenue = $directRevenue + $offerRevenue;

        // Factures à encaisser (ventes dépôt-vente non confirmées)
        $pendingPayments = ConsoleOffer::where('payment_requested', true)
            ->where('payment_confirmed', false)
            ->sum('payment_request_amount');

        // Factures encaissées (confirmées)
        $confirmedPayments = ConsoleOffer::where('payment_confirmed', true)
            ->where('sold_at', '>=', $startDate)
            ->sum('payment_request_amount');

        // =====================
        // 📈 VENTES PAR MOIS ET PAR MAGASIN
        // =====================
        
        $stores = Store::orderBy('name')->get();
        
        // Initialiser les données par mois
        $chartData = [];
        $monthLabels = [];
        
        for ($i = $months - 1; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $monthLabels[] = $date->format('M Y');
            
            foreach ($stores as $store) {
                if (!isset($chartData[$store->id])) {
                    $chartData[$store->id] = [
                        'name' => $store->name,
                        'data' => [],
                        'color' => $this->generateColorForStore($store->id),
                    ];
                }
                
                // Ventes directes du magasin
                $directSales = Console::where('store_id', $store->id)
                    ->where('status', 'vendue')
                    ->whereNotNull('sold_at')
                    ->whereYear('sold_at', $date->year)
                    ->whereMonth('sold_at', $date->month)
                    ->sum('valorisation');
                
                // Ventes via offres
                $offerSales = ConsoleOffer::where('store_id', $store->id)
                    ->whereNotNull('sold_at')
                    ->whereYear('sold_at', $date->year)
                    ->whereMonth('sold_at', $date->month)
                    ->sum('sale_price');
                
                $chartData[$store->id]['data'][] = $directSales + $offerSales;
            }
        }

        // =====================
        // 💰 FACTURES RÉCENTES
        // =====================
        
        $recentInvoices = Invoice::with(['store', 'console'])
            ->orderBy('invoice_date', 'desc')
            ->limit(10)
            ->get();

        // =====================
        // 📋 STATISTIQUES PAR MAGASIN
        // =====================
        
        $storeStats = Store::withCount([
            'consoles as total_sales' => function ($query) use ($startDate) {
                $query->where('status', 'vendue')
                    ->whereNotNull('sold_at')
                    ->where('sold_at', '>=', $startDate);
            }
        ])->get()->map(function ($store) use ($startDate) {
            // Revenus directs
            $directRevenue = Console::where('store_id', $store->id)
                ->where('status', 'vendue')
                ->whereNotNull('sold_at')
                ->where('sold_at', '>=', $startDate)
                ->sum('valorisation');
            
            // Revenus offres
            $offerRevenue = ConsoleOffer::where('store_id', $store->id)
                ->whereNotNull('sold_at')
                ->where('sold_at', '>=', $startDate)
                ->sum('sale_price');
            
            // Paiements en attente
            $pendingPayments = ConsoleOffer::where('store_id', $store->id)
                ->where('payment_requested', true)
                ->where('payment_confirmed', false)
                ->sum('payment_request_amount');
            
            return [
                'id' => $store->id,
                'name' => $store->name,
                'total_sales' => $store->total_sales,
                'revenue' => $directRevenue + $offerRevenue,
                'pending_payments' => $pendingPayments,
            ];
        })->sortByDesc('revenue');

        return view('admin.financial.index', compact(
            'totalSales',
            'totalRevenue',
            'pendingPayments',
            'confirmedPayments',
            'chartData',
            'monthLabels',
            'stores',
            'recentInvoices',
            'storeStats',
            'months'
        ));
    }

    /**
     * Créer une facture manuelle
     */
    public function storeInvoice(Request $request)
    {
        $validated = $request->validate([
            'store_id' => ['required', 'exists:stores,id'],
            'console_id' => ['nullable', 'exists:consoles,id'],
            'amount' => ['required', 'numeric', 'min:0'],
            'status' => ['required', 'in:paid,unpaid'],
            'invoice_date' => ['required', 'date'],
            'description' => ['nullable', 'string', 'max:500'],
        ]);

        Invoice::create([
            'store_id' => $validated['store_id'],
            'console_id' => $validated['console_id'],
            'amount' => $validated['amount'],
            'status' => $validated['status'],
            'invoice_date' => $validated['invoice_date'],
            'issued_at' => now(),
        ]);

        return back()->with('success', 'Facture créée avec succès.');
    }

    /**
     * Générer une couleur pour un magasin
     */
    private function generateColorForStore($storeId)
    {
        $colors = [
            '#3B82F6', // Blue
            '#10B981', // Green
            '#F59E0B', // Amber
            '#EF4444', // Red
            '#8B5CF6', // Purple
            '#EC4899', // Pink
            '#14B8A6', // Teal
            '#F97316', // Orange
            '#6366F1', // Indigo
            '#84CC16', // Lime
        ];
        
        return $colors[$storeId % count($colors)];
    }
}
