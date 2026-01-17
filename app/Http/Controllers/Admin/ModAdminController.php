<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Mod;
use App\Models\ArticleCategory;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;
use App\Models\Repairer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ModAdminController extends Controller
{
    /**
     * Liste des mods
     */
    public function index()
    {
        $mods = Mod::with(['compatibleCategories', 'compatibleSubCategories', 'compatibleTypes'])
            ->orderBy('name')
            ->paginate(20);

        return view('admin.mods.index', compact('mods'));
    }

    /**
     * Formulaire de création
     */
    public function create()
    {
        $categories = ArticleCategory::orderBy('name')->get();
        $subCategories = ArticleSubCategory::orderBy('name')->get();
        $types = ArticleType::orderBy('name')->get();

        return view('admin.mods.create', compact('categories', 'subCategories', 'types'));
    }

    /**
     * Enregistrement
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'is_accessory' => 'boolean',
            'compatible_categories' => 'nullable|array',
            'compatible_categories.*' => 'exists:article_categories,id',
            'compatible_sub_categories' => 'nullable|array',
            'compatible_sub_categories.*' => 'exists:article_sub_categories,id',
            'compatible_types' => 'nullable|array',
            'compatible_types.*' => 'exists:article_types,id',
        ]);

        $mod = Mod::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'purchase_price' => $validated['purchase_price'],
            'quantity' => $validated['quantity'],
            'is_accessory' => $request->has('is_accessory'),
        ]);

        // Associer les compatibilités
        if (!empty($validated['compatible_categories'])) {
            $mod->compatibleCategories()->attach($validated['compatible_categories']);
        }
        if (!empty($validated['compatible_sub_categories'])) {
            $mod->compatibleSubCategories()->attach($validated['compatible_sub_categories']);
        }
        if (!empty($validated['compatible_types'])) {
            $mod->compatibleTypes()->attach($validated['compatible_types']);
        }

        return redirect()->route('admin.mods.index')
            ->with('success', 'Mod créé avec succès');
    }

    /**
     * Formulaire d'édition
     */
    public function edit(Mod $mod)
    {
        $mod->load(['compatibleCategories', 'compatibleSubCategories', 'compatibleTypes']);
        
        $categories = ArticleCategory::orderBy('name')->get();
        $subCategories = ArticleSubCategory::orderBy('name')->get();
        $types = ArticleType::orderBy('name')->get();

        return view('admin.mods.edit', compact('mod', 'categories', 'subCategories', 'types'));
    }

    /**
     * Mise à jour
     */
    public function update(Request $request, Mod $mod)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'purchase_price' => 'required|numeric|min:0',
            'quantity' => 'required|integer|min:0',
            'is_accessory' => 'boolean',
            'compatible_categories' => 'nullable|array',
            'compatible_categories.*' => 'exists:article_categories,id',
            'compatible_sub_categories' => 'nullable|array',
            'compatible_sub_categories.*' => 'exists:article_types,id',
            'compatible_types' => 'nullable|array',
            'compatible_types.*' => 'exists:article_types,id',
        ]);

        $mod->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'purchase_price' => $validated['purchase_price'],
            'quantity' => $validated['quantity'],
            'is_accessory' => $request->has('is_accessory'),
        ]);

        // Synchroniser les compatibilités
        $mod->compatibleCategories()->sync($validated['compatible_categories'] ?? []);
        $mod->compatibleSubCategories()->sync($validated['compatible_sub_categories'] ?? []);
        $mod->compatibleTypes()->sync($validated['compatible_types'] ?? []);

        return redirect()->route('admin.mods.index')
            ->with('success', 'Mod mis à jour avec succès');
    }

    /**
     * Supprimer un mod
     */
    public function destroy(Mod $mod)
    {
        // Détacher toutes les relations avant suppression
        $mod->compatibleCategories()->detach();
        $mod->compatibleSubCategories()->detach();
        $mod->compatibleTypes()->detach();
        $mod->repairers()->detach();

        $name = $mod->name;
        $mod->delete();

        return redirect()->route('admin.mods.index')
            ->with('success', "Mod \"{$name}\" supprimé avec succès");
    }

    /**
     * Augmenter le stock (achat/réception)
     */
    public function receiveStock(Request $request, Mod $mod)
    {
        $validated = $request->validate([
            'quantity' => 'required|integer|min:1',
            'notes' => 'nullable|string',
        ]);

        $mod->update([
            'quantity' => $mod->quantity + $validated['quantity'],
        ]);

        return redirect()->route('admin.mods.index')
            ->with('success', "Stock augmenté de {$validated['quantity']} unité(s) pour {$mod->name}");
    }

    /**
     * Afficher la page de distribution des mods aux réparateurs
     */
    public function distribute()
    {
        $mods = Mod::with('repairers')->orderBy('name')->get();
        $repairers = Repairer::orderBy('name')->get();

        return view('admin.mods.distribute', compact('mods', 'repairers'));
    }

    /**
     * Distribuer un mod à un réparateur
     */
    public function sendToRepairer(Request $request, Mod $mod)
    {
        $validated = $request->validate([
            'repairer_id' => 'required|exists:repairers,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Vérifier que on a assez de stock
        if ($mod->quantity < $validated['quantity']) {
            return back()->with('error', "Stock insuffisant. Disponible: {$mod->quantity}");
        }

        // Diminuer le stock central
        $mod->update([
            'quantity' => $mod->quantity - $validated['quantity'],
        ]);

        // Ajouter/augmenter le stock chez le réparateur
        $mod->repairers()->updateExistingPivot($validated['repairer_id'], [
            'quantity' => DB::raw("quantity + {$validated['quantity']}"),
        ], false);

        // Si la relation n'existait pas, la créer
        if (!$mod->repairers()->where('repairer_id', $validated['repairer_id'])->exists()) {
            $mod->repairers()->attach($validated['repairer_id'], [
                'quantity' => $validated['quantity'],
            ]);
        }

        return back()->with('success', "{$validated['quantity']} unité(s) de {$mod->name} envoyée(s) à " . 
            Repairer::find($validated['repairer_id'])->name);
    }
}
