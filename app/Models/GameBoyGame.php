<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameBoyGame extends Model
{
    protected $fillable = [
        'rom_id',
        'name',
        'year',
        'image_url',
        'cloudinary_url',
        'price',
        'source',
    ];

    /**
     * Recherche par ROM ID
     */
    public static function findByRomId(string $romId): ?self
    {
        return self::where('rom_id', $romId)->first();
    }

    /**
     * Recherche par nom (fuzzy matching)
     */
    public static function findByName(string $name): ?self
    {
        // Recherche exacte d'abord
        $exact = self::where('name', $name)->first();
        if ($exact) {
            return $exact;
        }

        // Recherche LIKE si pas de correspondance exacte
        return self::where('name', 'like', '%' . $name . '%')->first();
    }
}
