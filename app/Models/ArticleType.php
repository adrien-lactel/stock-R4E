<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'publisher',
        'article_sub_category_id',
        'cover_image',
        'artwork_image',
        'gameplay_image',
        'description',
        'key_features',
        'average_market_price',
        'images',
        'rom_id',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    /**
     * Déterminer le dossier de la plateforme pour R2
     * Priorité: ROM ID prefix > SubCategory name
     */
    private function getPlatformFolder()
    {
        // Mapping des préfixes ROM ID vers les dossiers (plus précis)
        $romIdPrefixMapping = [
            'DMG' => 'gameboy',  // Game Boy original
            'CGB' => 'gbc',      // Game Boy Color
            'AGB' => 'gba',      // Game Boy Advance
            'SNS' => 'snes',     // Super Nintendo
            'NES' => 'nes',      // NES
        ];

        // Priorité 1: détecter depuis le préfixe du ROM ID (plus précis)
        $romId = $this->getEffectiveRomId();
        if ($romId && preg_match('/^([A-Z]{3})-/', $romId, $matches)) {
            $prefix = $matches[1];
            if (isset($romIdPrefixMapping[$prefix])) {
                return $romIdPrefixMapping[$prefix];
            }
        }

        // Priorité 2: mapping depuis la sous-catégorie
        $platformMapping = [
            'game boy advance' => 'gba',  // Plus spécifique d'abord
            'gba' => 'gba',
            'game boy color' => 'gbc',
            'gbc' => 'gbc',
            'game boy' => 'gameboy',
            'gameboy' => 'gameboy',
            'super nintendo' => 'snes',
            'snes' => 'snes',
            'super famicom' => 'snes',
            'nintendo 64' => 'n64',
            'n64' => 'n64',
            'nes' => 'nes',
            'famicom' => 'nes',
            'nintendo entertainment system' => 'nes',
        ];

        // Lazy-load subCategory if not loaded
        $subCategory = $this->relationLoaded('subCategory') 
            ? $this->subCategory 
            : $this->subCategory()->first();

        if ($subCategory) {
            $subCategoryName = strtolower($subCategory->name);
            
            foreach ($platformMapping as $key => $folder) {
                if (str_contains($subCategoryName, $key)) {
                    return $folder;
                }
            }
        }

        return null;
    }

    /**
     * Extraire le rom_id du nom si le champ rom_id est vide
     * Format attendu: "ROM_ID - Nom du jeu" ex: "DMG-VUA - Dr. Mario"
     */
    public function getEffectiveRomId()
    {
        // Si rom_id existe, l'utiliser
        if ($this->rom_id) {
            return $this->rom_id;
        }
        
        // Sinon, essayer d'extraire du nom (format "ROM_ID - Nom")
        if ($this->name && preg_match('/^([A-Z0-9]{2,4}-[A-Z0-9]+)\s*-/i', $this->name, $matches)) {
            return strtoupper($matches[1]);
        }
        
        return null;
    }

    /**
     * Récupérer l'URL d'une image depuis R2
     */
    private function getR2ImageUrl($type)
    {
        $romId = $this->getEffectiveRomId();
        if (!$romId) {
            return null;
        }

        $folder = $this->getPlatformFolder();
        if (!$folder) {
            return null;
        }

        // Générer l'URL de l'image (on assume qu'elle existe en .png)
        // Si elle n'existe pas, elle retournera 404 mais c'est géré par le frontend
        $filename = "{$romId}-{$type}.png";
        
        // En production : URL directe R2 (avec fallback hardcodé si config manquante)
        if (app()->environment('production')) {
            $r2PublicUrl = config('filesystems.disks.r2.url') ?: 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev';
            return $r2PublicUrl . "/taxonomy/{$folder}/{$filename}";
        } else {
            return route('proxy.taxonomy-image', [
                'folder' => $folder,
                'filename' => $filename
            ]);
        }
    }

    /**
     * Accessor pour l'URL de la cover image
     * Priorité: colonne directe > URL R2 générée
     */
    public function getCoverImageUrlAttribute()
    {
        // D'abord vérifier si une URL est stockée directement
        if (!empty($this->cover_image) && str_starts_with($this->cover_image, 'http')) {
            return $this->cover_image;
        }
        return $this->getR2ImageUrl('cover');
    }

    /**
     * Accessor pour l'URL du logo
     */
    public function getLogoUrlAttribute()
    {
        return $this->getR2ImageUrl('logo');
    }

    /**
     * Accessor pour l'URL du screenshot 1 (gameplay)
     * Priorité: colonne directe > URL R2 générée
     */
    public function getScreenshot1UrlAttribute()
    {
        // D'abord vérifier si une URL est stockée directement
        if (!empty($this->gameplay_image) && str_starts_with($this->gameplay_image, 'http')) {
            return $this->gameplay_image;
        }
        return $this->getR2ImageUrl('gameplay');
    }

    /**
     * Accessor pour l'URL du screenshot 2 (artwork)
     * Priorité: colonne directe > URL R2 générée
     */
    public function getScreenshot2UrlAttribute()
    {
        // D'abord vérifier si une URL est stockée directement
        if (!empty($this->artwork_image) && str_starts_with($this->artwork_image, 'http')) {
            return $this->artwork_image;
        }
        return $this->getR2ImageUrl('artwork');
    }

    /**
     * Accessor pour l'URL du logo de l'éditeur
     */
    public function getPublisherLogoUrlAttribute()
    {
        if (!$this->publisher) {
            return null;
        }

        $publisher = Publisher::where('name', $this->publisher)->first();
        
        return $publisher?->logo_url;
    }

    public function subCategory()
    {
        return $this->belongsTo(ArticleSubCategory::class, 'article_sub_category_id');
    }

    public function consoles()
    {
        return $this->hasMany(Console::class, 'article_type_id');
    }
}