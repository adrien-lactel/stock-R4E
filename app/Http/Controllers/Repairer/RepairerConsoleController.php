<?php

namespace App\Http\Controllers\Repairer;

use App\Http\Controllers\Controller;
use App\Models\Console;
use App\Models\Mod;
use App\Models\Repairer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairerConsoleController extends Controller
{
    /**
     * Afficher la liste des consoles assignées au réparateur connecté
     */
    public function index()
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer) {
            abort(403, 'Aucun réparateur associé à ce compte.');
        }

        $consoles = Console::with(['articleCategory', 'articleSubCategory', 'articleType', 'mods'])
            ->where('repairer_id', $repairer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        return view('repairer.consoles.index', compact('consoles', 'repairer'));
    }

    /**
     * Formulaire pour associer des mods/accessoires à une console
     */
    public function editMods(Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || $console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette console.');
        }

        // Charger les mods actuels de la console et les opérations du réparateur
        $console->load('mods');
        $repairer->load('operations');

        // Opérations que le réparateur peut effectuer (ses compétences)
        $repairerOperationIds = $repairer->operations->pluck('id')->toArray();
        
        // Opérations disponibles = uniquement celles dans les compétences du réparateur
        $operations = Mod::where('is_operation', true)
            ->whereIn('id', $repairerOperationIds)
            ->orderBy('name')
            ->get();
        
        // Mods (pas opération, pas accessoire)
        $mods = Mod::where('is_operation', false)
            ->where('is_accessory', false)
            ->orderBy('name')
            ->get();
        
        // Accessoires
        $accessories = Mod::where('is_operation', false)
            ->where('is_accessory', true)
            ->orderBy('name')
            ->get();
        
        // Mods disponibles chez le réparateur (avec stock)
        $repairerMods = $repairer->mods()->wherePivot('quantity', '>', 0)->get();

        return view('repairer.consoles.edit-mods', compact(
            'console', 
            'operations',
            'mods',
            'accessories',
            'repairerMods', 
            'repairer'
        ));
    }

    /**
     * Enregistrer les mods/accessoires associés à une console
     */
    public function updateMods(Request $request, Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || $console->repairer_id !== $repairer->id) {
            abort(403, 'Vous n\'êtes pas autorisé à modifier cette console.');
        }

        $validated = $request->validate([
            'mods' => ['nullable', 'array'],
            'mods.*.mod_id' => ['required', 'exists:mods,id'],
            'mods.*.price_applied' => ['nullable', 'numeric', 'min:0'],
            'mods.*.notes' => ['nullable', 'string', 'max:500'],
            'mods.*.work_time_minutes' => ['nullable', 'integer', 'min:0'],
            'commentaire_reparateur' => ['nullable', 'string', 'max:2000'],
        ]);

        // Synchroniser les mods
        $syncData = [];
        foreach ($validated['mods'] ?? [] as $modData) {
            $mod = Mod::find($modData['mod_id']);
            if (!$mod) continue;

            $syncData[$modData['mod_id']] = [
                'repairer_id' => $repairer->id,
                'price_applied' => $modData['price_applied'] ?? $mod->purchase_price,
                'notes' => $modData['notes'] ?? null,
                'work_time_minutes' => $modData['work_time_minutes'] ?? null,
            ];
        }

        $console->mods()->sync($syncData);

        // Mettre à jour le commentaire réparateur
        if (isset($validated['commentaire_reparateur'])) {
            $console->update([
                'commentaire_reparateur' => $validated['commentaire_reparateur'],
            ]);
        }

        return redirect()
            ->route('repairer.consoles.edit-mods', $console)
            ->with('success', 'Modifications enregistrées.');
    }

    /**
     * Ajouter un mod rapidement à une console
     */
    public function addMod(Request $request, Console $console)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || $console->repairer_id !== $repairer->id) {
            abort(403);
        }

        $validated = $request->validate([
            'mod_id' => ['required', 'exists:mods,id'],
            'price_applied' => ['nullable', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:500'],
            'work_time_minutes' => ['nullable', 'integer', 'min:0'],
        ]);

        $mod = Mod::findOrFail($validated['mod_id']);

        // Vérifier si le mod n'est pas déjà associé
        if ($console->mods()->where('mod_id', $mod->id)->exists()) {
            return back()->with('error', 'Ce mod est déjà associé à cette console.');
        }

        $console->mods()->attach($mod->id, [
            'repairer_id' => $repairer->id,
            'price_applied' => $validated['price_applied'] ?? $mod->purchase_price,
            'notes' => $validated['notes'] ?? null,
            'work_time_minutes' => $validated['work_time_minutes'] ?? null,
        ]);

        return back()->with('success', "Mod \"{$mod->name}\" ajouté.");
    }

    /**
     * Retirer un mod d'une console
     */
    public function removeMod(Console $console, Mod $mod)
    {
        $repairer = $this->getCurrentRepairer();
        
        if (!$repairer || $console->repairer_id !== $repairer->id) {
            abort(403);
        }

        $console->mods()->detach($mod->id);

        return back()->with('success', "Mod \"{$mod->name}\" retiré.");
    }

    /**
     * Récupérer le réparateur associé à l'utilisateur connecté
     */
    protected function getCurrentRepairer(): ?Repairer
    {
        $user = Auth::user();
        
        // Si l'utilisateur a un repairer_id direct
        if ($user->repairer_id ?? null) {
            return Repairer::find($user->repairer_id);
        }

        // Sinon chercher par email
        return Repairer::where('email', $user->email)->first();
    }
}
