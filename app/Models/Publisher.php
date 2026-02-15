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
     * Boot du modèle - génération automatique du slug
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($publisher) {
            if (empty($publisher->slug) && !empty($publisher->name)) {
                $publisher->slug = Str::slug($publisher->name);
            }
        });

        static::updating(function ($publisher) {
            if (empty($publisher->slug) && !empty($publisher->name)) {
                $publisher->slug = Str::slug($publisher->name);
            }
        });
    }

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

        // Si c'est déjà une URL complète, la retourner telle quelle
        if (str_starts_with($this->logo, 'http')) {
            return $this->logo;
        }

        // Extraire juste le nom de fichier (gérer tous les formats de path)
        $filename = basename($this->logo);

        return "{$r2Url}/{$filename}";
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
