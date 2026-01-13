<?php

namespace App\Http\Controllers;

use App\Models\Console;
use Illuminate\Http\Request;

class StockController extends Controller
{
    /**
     * Page stock du magasin connecté
     */
    public function index()
    {
        $store = auth()->user()->store;

        $consoles = Console::where('store_id', $store->id)
            ->with('type')
            ->get();

        return view('store.stock', compact('store', 'consoles'));
    }

    /**
     * Marquer une console comme vendue
     */
    public function sell(Console $console)
    {
        $this->authorizeConsole($console);

        $console->update([
            'status' => 'vendue',
        ]);

        return back()->with('success', 'Console vendue avec succès');
    }

    /**
     * Marquer une console comme HS
     */
    public function defective(Console $console)
    {
        $this->authorizeConsole($console);

        $console->update([
            'status' => 'defectueuse',
        ]);

        return back()->with('success', 'Console marquée comme défectueuse');
    }

    /**
     * Sécurité : vérifier que la console appartient bien au magasin
     */
    private function authorizeConsole(Console $console)
    {
        $store = auth()->user()->store;

        abort_if($console->store_id !== $store->id, 403);
    }
}
