<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserManagementController extends Controller
{
    /**
     * Afficher tous les utilisateurs
     */
    public function index()
    {
        $users = User::with(['store', 'repairer'])
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($user) {
                // Déterminer le type d'utilisateur
                if ($user->store) {
                    $type = 'Magasin';
                    $affiliation = $user->store->name;
                } elseif ($user->repairer) {
                    $type = 'Réparateur';
                    $affiliation = $user->repairer->name;
                } elseif ($user->role === 'admin') {
                    $type = 'Administrateur';
                    $affiliation = 'R4E';
                } else {
                    $type = 'Utilisateur';
                    $affiliation = '-';
                }

                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'type' => $type,
                    'affiliation' => $affiliation,
                    'role' => $user->role,
                    'created_at' => $user->created_at,
                ];
            });

        return view('admin.users.index', compact('users'));
    }

    /**
     * Réinitialiser le mot de passe d'un utilisateur
     */
    public function resetPassword(Request $request, User $user)
    {
        $request->validate([
            'new_password' => 'nullable|string|min:8',
        ]);

        // Générer un mot de passe aléatoire si non fourni
        $newPassword = $request->new_password ?? Str::random(12);

        // Mettre à jour le mot de passe
        $user->password = Hash::make($newPassword);
        $user->save();

        return response()->json([
            'success' => true,
            'message' => 'Mot de passe réinitialisé avec succès.',
            'new_password' => $newPassword,
            'user' => $user->name,
        ]);
    }
}
