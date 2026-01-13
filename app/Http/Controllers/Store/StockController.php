<?php

namespace App\Http\Controllers\Store;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\Invoice;
use Illuminate\Http\Request;

class StockController extends Controller
{
    public function index(Request $request)
    {
        $store = auth()->user()->store;

        $consoles = Console::where('store_id', $store->id)
            ->where('status', 'stock')
            ->whereHas('stores', function ($q) use ($store) {
                $q->where('store_id', $store->id)
                  ->whereNotNull('sale_price');
            })
            ->with(['type', 'stores'])
            ->get();

        return view('store.stock.index', compact('consoles', 'store'));
    }

    public function sell(Console $console)
    {
        $store = auth()->user()->store;

        $price = $console->stores()
            ->where('store_id', $store->id)
            ->first()
            ->pivot
            ->sale_price;

        $console->update(['status' => 'vendue']);

        Invoice::create([
            'store_id' => $store->id,
            'console_id' => $console->id,
            'amount' => $price,
            'status' => 'paid',
            'issued_at' => now(),
            'invoice_date' => now(),
        ]);

        return back()->with('success', 'Console vendue, facture générée');
    }

    public function defective(Console $console)
    {
        $console->update(['status' => 'defectueuse']);

        return back()->with('success', 'Console marquée HS');
    }
}
