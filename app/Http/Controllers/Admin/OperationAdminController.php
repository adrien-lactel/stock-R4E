<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mod;
use Illuminate\Http\Request;

class OperationAdminController extends Controller
{
    /**
     * Liste des opérations (mods de type opération)
     */
    public function index()
    {
        $operations = Mod::where('is_operation', true)
            ->orderBy('name')
            ->get();

        return view('admin.operations.index', compact('operations'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        return view('admin.operations.create', [
            'operation' => new Mod(['is_operation' => true]),
        ]);
    }

    /**
     * Enregistrer une nouvelle opération
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:mods,name'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        Mod::create([
            'name' => $validated['name'],
            'description' => $validated['description'] ?? null,
            'purchase_price' => 0,
            'quantity' => 999,
            'is_accessory' => false,
            'is_operation' => true,
        ]);

        return redirect()
            ->route('admin.operations.index')
            ->with('success', "Opération \"{$validated['name']}\" créée.");
    }

    /**
     * Formulaire d'édition
     */
    public function edit(Mod $operation)
    {
        if (!$operation->is_operation) {
            abort(404, 'Ce mod n\'est pas une opération.');
        }

        return view('admin.operations.edit', compact('operation'));
    }

    /**
     * Mettre à jour une opération
     */
    public function update(Request $request, Mod $operation)
    {
        if (!$operation->is_operation) {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:mods,name,' . $operation->id],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $operation->update($validated);

        return redirect()
            ->route('admin.operations.index')
            ->with('success', 'Opération mise à jour.');
    }

    /**
     * Supprimer une opération
     */
    public function destroy(Mod $operation)
    {
        if (!$operation->is_operation) {
            abort(404);
        }

        $name = $operation->name;
        $operation->delete();

        return redirect()
            ->route('admin.operations.index')
            ->with('success', "Opération \"{$name}\" supprimée.");
    }
}
