<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoreAdminController extends Controller
{
    /**
     * Liste des magasins (vue d'ensemble)
     */
    public function index()
    {
        $stores = Store::query()
            ->with('user')
            ->withCount('consoles', 'invoices')
            ->orderBy('name')
            ->get();

        return view('admin.stores.index', compact('stores'));
    }

    /**
     * Formulaire création magasin (et liste)
     */
    public function create(Request $request)
    {
        $stores = Store::query()
            ->withCount('consoles', 'invoices')
            ->orderBy('name')
            ->get();

        return view('admin.stores.create', [
            'store' => new Store(),
            'stores' => $stores,
        ]);
    }

    /**
     * Création magasin + compte utilisateur
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'siret' => 'nullable|string|max:14',
            'vat_number' => 'nullable|string|max:20',
            'manager_name' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string',
        ]);

        // =====================
        // 1️⃣ Création du magasin
        // =====================
        $store = Store::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'city' => $data['city'],
            'phone' => $data['phone'] ?? null,
            'address' => $data['address'] ?? null,
            'postal_code' => $data['postal_code'] ?? null,
            'notes' => $data['notes'] ?? null,
            'is_active' => $data['is_active'] ?? true,
            'siret' => $data['siret'] ?? null,
            'vat_number' => $data['vat_number'] ?? null,
            'manager_name' => $data['manager_name'] ?? null,
            'opening_hours' => $data['opening_hours'] ?? null,
        ]);

        // =====================
        // 2️⃣ Création du compte utilisateur magasin
        // =====================
        User::create([
            'name' => $store->name,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 'store',
            'store_id' => $store->id,
        ]);

        // =====================
        // 3️⃣ Redirection admin
        // =====================
        return redirect()
            ->route('admin.stores.create')
            ->with('success', 'Magasin et compte utilisateur créés avec succès');
    }

    public function edit(Store $store)
    {
        $stores = Store::query()
            ->withCount('consoles', 'invoices')
            ->orderBy('name')
            ->get();

        return view('admin.stores.create', [
            'store' => $store,
            'stores' => $stores,
        ]);
    }

    public function update(Request $request, Store $store)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'email' => ['required','email','max:255'],
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'postal_code' => 'nullable|string|max:20',
            'notes' => 'nullable|string',
            'is_active' => 'nullable|boolean',
            'siret' => 'nullable|string|max:14',
            'vat_number' => 'nullable|string|max:20',
            'manager_name' => 'nullable|string|max:255',
            'opening_hours' => 'nullable|string',
        ]);

        // if email changed, ensure uniqueness on users table
        if (isset($data['email']) && $data['email'] !== $store->email) {
            $request->validate([
                'email' => 'unique:users,email',
            ]);
        }

        $store->update($data);

        // sync user account email/name if exists
        if ($store->user) {
            $store->user->update([
                'email' => $data['email'],
                'name' => $data['name'],
            ]);
        }

        return redirect()
            ->route('admin.stores.create')
            ->with('success', 'Magasin mis à jour.');
    }

    public function destroy(Request $request, Store $store)
    {
        // ✔️ only admins can delete stores
        if (! auth()->user() || auth()->user()->role !== 'admin') {
            abort(403);
        }

        // Prevent deletion if there are associated records
        if ($store->consoles()->exists() || $store->invoices()->exists() || $store->articles()->exists()) {
            return back()->with('error', 'Suppression impossible : ce magasin a des données associées.');
        }

        // delete associated user account if present
        if ($store->user) {
            $store->user->delete();
        }

        $store->delete();

        return redirect()
            ->route('admin.stores.create')
            ->with('success', 'Magasin supprimé.');
    }
}
