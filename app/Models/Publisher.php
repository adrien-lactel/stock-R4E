<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Publisher extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'logo',
        'description',
    ];

    /**
     * Créer ou récupérer un éditeur par son nom
     */
    public static function findOrCreateByName(string $name): ?self
    {
        if (empty(trim($name))) {
            return null;
        }

        $slug = Str::slug($name);
        
        return static::firstOrCreate(
            ['slug' => $slug],
            ['name' => $name]
        );
    }

    /**
     * Obtenir tous les éditeurs triés par nom
     */
    public static function getAllSorted()
    {
        return static::orderBy('name')->get();
    }

    /**
     * Rechercher des éditeurs par nom (pour autocomplete)
     */
    public static function search(string $query, int $limit = 15)
    {
        return static::where('name', 'LIKE', "%{$query}%")
            ->orderBy('name')
            ->limit($limit)
            ->get();
    }
}
