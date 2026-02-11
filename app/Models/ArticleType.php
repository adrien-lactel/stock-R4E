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
     */
    private function getPlatformFolder()
    {
        $platformMapping = [
            'game boy' => 'gameboy',
            'gameboy' => 'gameboy',
            'game boy advance' => 'gba',
            'gba' => 'gba',
            'game boy color' => 'gbc',
            'gbc' => 'gbc',
            'super nintendo' => 'snes',
            'snes' => 'snes',
            'super famicom' => 'snes',
            'nintendo 64' => 'n64',
            'n64' => 'n64',
            'nes' => 'nes',
            'famicom' => 'nes',
            'nintendo entertainment system' => 'nes',
        ];

        if ($this->subCategory) {
            $subCategoryName = strtolower($this->subCategory->name);
            
            foreach ($platformMapping as $key => $folder) {
                if (str_contains($subCategoryName, $key)) {
                    return $folder;
                }
            }
        }

        return null;
    }

    /**
     * Récupérer l'URL d'une image depuis R2
     */
    private function getR2ImageUrl($type)
    {
        if (!$this->rom_id) {
            return null;
        }

        $folder = $this->getPlatformFolder();
        if (!$folder) {
            return null;
        }

        // Générer l'URL de l'image (on assume qu'elle existe en .png)
        // Si elle n'existe pas, elle retournera 404 mais c'est géré par le frontend
        $filename = "{$this->rom_id}-{$type}.png";
        
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
     */
    public function getCoverImageUrlAttribute()
    {
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
     * Accessor pour l'URL du screenshot 1
     */
    public function getScreenshot1UrlAttribute()
    {
        return $this->getR2ImageUrl('gameplay');
    }

    /**
     * Accessor pour l'URL du screenshot 2
     */
    public function getScreenshot2UrlAttribute()
    {
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