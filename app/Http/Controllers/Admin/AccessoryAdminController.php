<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mod;
use Illuminate\Http\Request;

class AccessoryAdminController extends Controller
{
    /**
     * Liste des accessoires (mods de type accessoire)
     */
    public function index()
    {
        $accessories = Mod::where('is_accessory', true)
            ->where('is_operation', false)
            ->orderBy('name')
            ->get();

        return view('admin.accessories.index', compact('accessories'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return view('admin.accessories.create', [
            'accessory' => new Mod(['is_accessory' => true]),
        ]);
    }

    /**
     * Enregistrer un nouvel accessoire
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:mods,name'],
            'description' => ['nullable', 'string', 'max:1000'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
        ]);

        Mod::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'purchase_price' => $validated['purchase_price'],
            'quantity' => 0,
            'is_accessory' => true,
            'is_operation' => false,
        ]);

        return redirect()
            ->route('admin.accessories.index')
            ->with('success', "Accessoire \"{$validated['name']}\" créé.");
    }

    /**
     * Formulaire d'édition
     */
    public function edit(Mod $accessory)
    {
        if (!$accessory->is_accessory) {
            abort(404, 'Ce mod n\'est pas un accessoire.');
        }

        return view('admin.accessories.edit', compact('accessory'));
    }

    /**
     * Mettre à jour un accessoire
     */
    public function update(Request $request, Mod $accessory)
    {
        if (!$accessory->is_accessory) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:mods,name,' . $accessory->id],
            'description' => ['nullable', 'string', 'max:1000'],
            'purchase_price' => ['required', 'numeric', 'min:0'],
        ]);

        $accessory->update($validated);

        return redirect()
            ->route('admin.accessories.index')
            ->with('success', 'Accessoire mis à jour.');
    }

    /**
     * Supprimer un accessoire
     */
    public function destroy(Mod $accessory)
    {
        if (!$accessory->is_accessory) {
            abort(404);
        }

        // Vérifier si l'accessoire est utilisé sur des consoles
        if ($accessory->appliedConsoles()->exists()) {
            return back()->with('error', 'Cet accessoire est utilisé sur des articles et ne peut pas être supprimé.');
        }

        $name = $accessory->name;
        $accessory->delete();

        return redirect()
            ->route('admin.accessories.index')
            ->with('success', "Accessoire \"{$name}\" supprimé.");
    }

    /**
     * Bilan des accessoires
     */
    public function report()
    {
        $accessories = Mod::where('is_accessory', true)
            ->where('is_operation', false)
            ->orderBy('quantity', 'desc')
            ->get();

        $stats = [
            'total_items' => $accessories->count(),
            'total_quantity' => $accessories->sum('quantity'),
            'total_value' => $accessories->sum(function($acc) {
                return $acc->quantity * $acc->purchase_price;
            }),
            'out_of_stock' => $accessories->where('quantity', '<=', 0)->count(),
            'low_stock' => $accessories->where('quantity', '>', 0)->where('quantity', '<=', 5)->count(),
        ];

        return view('admin.accessories.report', compact('accessories', 'stats'));
    }

    /**
     * Mettre à jour la valorisation d'un accessoire
     */
    public function updateValorisation(Request $request, Mod $accessory)
    {
        $validated = $request->validate([
            'valorisation' => 'required|numeric|min:0',
        ]);

        $accessory->update([
            'valorisation' => $validated['valorisation'],
        ]);

        return redirect()->route('admin.accessories.report')
            ->with('success', "Valorisation de '{$accessory->name}' mise à jour avec succès.");
    }
}
