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

    protected $appends = ['logo_url'];

    /**
     * Get the full logo URL - direct R2 for speed
     */
    public function getLogoUrlAttribute()
    {
        if (!$this->logo) {
            return null;
        }

        // URL R2 directe pour un chargement rapide
        $r2Url = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/editeurs';

        // Si le logo commence par "images/taxonomy/editeurs/"
        if (str_starts_with($this->logo, 'images/taxonomy/editeurs/')) {
            $filename = basename($this->logo);
            return "{$r2Url}/{$filename}";
        }

        // Si c'est juste un nom de fichier
        if (!str_starts_with($this->logo, 'http')) {
            return "{$r2Url}/{$this->logo}";
        }

        return $this->logo;
    }

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
