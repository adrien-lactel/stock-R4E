<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\Console;
use App\Models\User;
use App\Models\Repairer;

class ConsolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        // Admins peuvent tout voir
        if ($user->role === 'admin') {
            return true;
        }
        
        // Stores peuvent voir leur stock
        if ($user->role === 'store') {
            return true;
        }
        
        // Réparateurs peuvent voir leurs consoles assignées
        if ($user->role === 'repairer') {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Console $console): bool
    {
        // Admins peuvent tout voir
        if ($user->role === 'admin') {
            return true;
        }
        
        // Stores peuvent voir les consoles de leur magasin
        if ($user->role === 'store' && $console->store_id === $user->store_id) {
            return true;
        }
        
        // Réparateurs peuvent voir leurs consoles assignées
        if ($user->role === 'repairer') {
            $repairer = Repairer::where('email', $user->email)->first();
            return $repairer && $console->repairer_id === $repairer->id;
        }
        
        return false;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        // Admins peuvent toujours créer
        if ($user->role === 'admin') {
            return true;
        }
        
        // Réparateurs avec permission explicite
        if ($user->role === 'repairer') {
            $repairer = Repairer::where('email', $user->email)->first();
            return $repairer && $repairer->canCreateArticles();
        }
        
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Console $console): bool
    {
        // Admins peuvent tout modifier
        if ($user->role === 'admin') {
            return true;
        }
        
        // Réparateurs peuvent modifier leurs consoles assignées
        if ($user->role === 'repairer') {
            $repairer = Repairer::where('email', $user->email)->first();
            return $repairer && $console->repairer_id === $repairer->id;
        }
        
        // Stores peuvent modifier certains aspects de leur stock
        if ($user->role === 'store' && $console->store_id === $user->store_id) {
            return true;
        }
        
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Console $console): bool
    {
        // Seuls les admins peuvent supprimer
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Console $console): bool
    {
        return $user->role === 'admin';
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Console $console): bool
    {
        return $user->role === 'admin';
    }
}
