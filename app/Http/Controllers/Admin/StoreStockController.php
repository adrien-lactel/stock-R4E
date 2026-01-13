<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\Console;
use App\Models\Invoice;
use Illuminate\Http\Request;

class StoreStockController extends Controller
{
    public function index(Store $store)
    {
        $consoles = Console::where('store_id', $store->id)
            ->where('status', 'stock')
            ->whereHas('stores', function ($q) use ($store) {
                $q->where('store_id', $store->id)
                  ->whereNotNull('sale_price');
            })
            ->with('type')
            ->get();

        return view('admin.stores.stock', compact('store', 'consoles'));
    }

    public function sell(Console $console)
    {
        $console->update(['status' => 'vendue']);

        Invoice::create([
            'store_id'   => $console->store_id,
            'console_id' => $console->id,
            'amount'     => $console->real_value,
            'status'     => 'paid',
            'issued_at'  => now(),
        ]);

        return back()->with('success', 'Console vendue et facture générée');
    }

    public function defective(Console $console)
    {
        $console->update(['status' => 'defectueuse']);

        return back()->with('success', 'Console marquée HS');
    }
}
