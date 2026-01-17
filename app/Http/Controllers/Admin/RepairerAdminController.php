<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Repairer;
use App\Models\Mod;
use Illuminate\Http\Request;

class RepairerAdminController extends Controller
{
    /**
     * Optionnel: si tu gardes une page index séparée.
     * Sinon tu peux supprimer cette méthode et la route.
     */
    public function index(Request $request)
    {
        $query = Repairer::query()
            ->withCount('consoles')
            ->orderBy('name');

        if ($request->boolean('active')) {
            $query->where('is_active', true);
        }

        $repairers = $query->paginate(50)->withQueryString();

        return view('admin.repairers.index', [
            'repairers'  => $repairers,
            'activeOnly' => $request->boolean('active'),
        ]);
    }

    /**
     * Voir le détail d'un réparateur avec ses consoles affectées
     */
    public function show(Repairer $repairer)
    {
        $repairer->load(['mods']);
        
        // Consoles affectées à ce réparateur
        $consoles = \App\Models\Console::with(['articleCategory', 'articleSubCategory', 'articleType', 'store'])
            ->where('repairer_id', $repairer->id)
            ->orderBy('created_at', 'desc')
            ->paginate(30);

        // Stats
        $stats = [
            'total' => \App\Models\Console::where('repairer_id', $repairer->id)->count(),
            'repair' => \App\Models\Console::where('repairer_id', $repairer->id)->where('status', 'repair')->count(),
            'stock' => \App\Models\Console::where('repairer_id', $repairer->id)->where('status', 'stock')->count(),
            'defective' => \App\Models\Console::where('repairer_id', $repairer->id)->where('status', 'defective')->count(),
        ];

        return view('admin.repairers.show', compact('repairer', 'consoles', 'stats'));
    }

    /**
     * Page principale: formulaire + liste réparateurs
     */
    public function create(Request $request)
    {
        $query = Repairer::query()
            ->withCount('consoles')
            ->orderBy('name');

        if ($request->boolean('active')) {
            $query->where('is_active', true);
        }

        $mods = Mod::orderBy('name')->get();

        return view('admin.repairers.create', [
            'repairer'   => new Repairer(),
            'repairers'  => $query->get(),
            'activeOnly' => $request->boolean('active'),
            'mods'       => $mods,
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validated($request);

        Repairer::create($data);

        return redirect()
            ->route('admin.repairers.create')
            ->with('success', 'Réparateur créé.');
    }

    /**
     * On réutilise la même vue "create" en mode édition.
     */
    public function edit(Request $request, Repairer $repairer)
    {
        $repairer->load('mods');
        
        $query = Repairer::query()
            ->withCount('consoles')
            ->orderBy('name');

        if ($request->boolean('active')) {
            $query->where('is_active', true);
        }

        $mods = Mod::orderBy('name')->get();

        return view('admin.repairers.create', [
            'repairer'   => $repairer,
            'repairers'  => $query->get(),
            'activeOnly' => $request->boolean('active'),
            'mods'       => $mods,
        ]);
    }

    public function update(Request $request, Repairer $repairer)
    {
        $data = $this->validated($request);

        $repairer->update($data);

        // Synchroniser les mods avec quantités
        if ($request->has('mods')) {
            $syncData = [];
            foreach ($request->input('mods', []) as $modId => $quantity) {
                if ($quantity > 0) {
                    $syncData[$modId] = ['quantity' => $quantity];
                }
            }
            $repairer->mods()->sync($syncData);
        } else {
            $repairer->mods()->detach();
        }

        // on conserve le filtre actif si présent
        $redirectParams = [];
        if ($request->boolean('active')) {
            $redirectParams['active'] = 1;
        }

        return redirect()
            ->route('admin.repairers.create', $redirectParams)
            ->with('success', 'Réparateur mis à jour.');
    }

    public function destroy(Request $request, Repairer $repairer)
    {
        // 🔒 Interdiction si consoles associées
        if ($repairer->consoles()->exists()) {
            return back()->with('error', 'Suppression impossible : ce réparateur a des consoles associées.');
        }

        $repairer->delete(); // soft delete si SoftDeletes est activé, sinon delete classique

        // on conserve le filtre actif si présent
        $redirectParams = [];
        if ($request->boolean('active')) {
            $redirectParams['active'] = 1;
        }

        return redirect()
            ->route('admin.repairers.create', $redirectParams)
            ->with('success', 'Réparateur supprimé.');
    }

    private function validated(Request $request): array
    {
        $data = $request->validate([
            'name'  => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],

            'city'    => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],

            'notes' => ['nullable', 'string'],

            // checkbox
            'is_active' => ['nullable', 'boolean'],

            'delay_days_default' => ['nullable', 'integer', 'min:0', 'max:365'],
            'shipping_method'    => ['nullable', 'string', 'max:255'],

            'vat_number' => ['nullable', 'string', 'max:100'],
            'siret'      => ['nullable', 'string', 'max:100'],
        ]);

        // ✅ si checkbox absente => false
        $data['is_active'] = (bool)($data['is_active'] ?? false);

        return $data;
    }
}
