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
     * Note: Les dossiers R2 utilisent des noms avec espaces (ex: "game boy advance")
     */
    public function getPlatformFolder()
    {
        // Mapping des préfixes ROM ID vers les dossiers R2 (noms avec espaces)
        $romIdPrefixMapping = [
            'DMG' => 'gameboy',           // Game Boy original
            'CGB' => 'game boy color',    // Game Boy Color
            'AGB' => 'game boy advance',  // Game Boy Advance
            'SNS' => 'snes',              // Super Nintendo
            'NES' => 'nes',               // NES
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
            'game boy advance' => 'game boy advance',
            'gba' => 'game boy advance',
            'game boy color' => 'game boy color',
            'gbc' => 'game boy color',
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
            'wonder swan' => 'wonderswan',
            'wonderswan' => 'wonderswan',
            'wonder swan color' => 'wonderswan color',
            'wonderswan color' => 'wonderswan color',
            'mega drive' => 'megadrive',
            'megadrive' => 'megadrive',
            'genesis' => 'megadrive',
            'game gear' => 'gamegear',
            'gamegear' => 'gamegear',
            'sega saturn' => 'segasaturn',
            'saturn' => 'segasaturn',
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
        
        // URL-encoder le dossier s'il contient des espaces
        $folderEncoded = rawurlencode($folder);
        
        // En production : URL directe R2 (avec fallback hardcodé si config manquante)
        if (app()->environment('production')) {
            $r2PublicUrl = config('filesystems.disks.r2.url') ?: 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev';
            return $r2PublicUrl . "/taxonomy/{$folderEncoded}/{$filename}";
        } else {
            return route('proxy.taxonomy-image', [
                'folder' => $folder,
                'filename' => $filename
            ]);
        }
    }

    /**
     * Accessor pour l'URL de la cover image
     * Priorité: colonne directe > URL R2 générée > console display1
     */
    public function getCoverImageUrlAttribute()
    {
        // D'abord vérifier si une URL est stockée directement
        if (!empty($this->cover_image) && str_starts_with($this->cover_image, 'http')) {
            return $this->cover_image;
        }
        
        // Pour les jeux: utiliser R2 avec ROM ID
        $gameUrl = $this->getR2ImageUrl('cover');
        if ($gameUrl) {
            return $gameUrl;
        }
        
        // Pour les consoles, cartes, accessoires: utiliser display1 comme cover
        if ($this->isConsoleCategory() || $this->isCardsCategory() || $this->isAccessoryCategory()) {
            return $this->getTaxonomyImageUrl('display1');
        }
        
        return null;
    }

    /**
     * Accessor pour l'URL du logo
     * Pour les jeux: ROM ID-logo.png
     * Pour les consoles/cartes/accessoires: slug-logo.png
     */
    public function getLogoUrlAttribute()
    {
        // Pour les jeux
        $gameUrl = $this->getR2ImageUrl('logo');
        if ($gameUrl) {
            return $gameUrl;
        }
        
        // Pour les consoles, cartes, accessoires
        if ($this->isConsoleCategory() || $this->isCardsCategory() || $this->isAccessoryCategory()) {
            return $this->getTaxonomyImageUrl('logo');
        }
        
        return null;
    }

    /**
     * Accessor pour l'URL du screenshot 1 (gameplay)
     * Priorité: colonne directe > URL R2 générée > taxonomie display2
     */
    public function getScreenshot1UrlAttribute()
    {
        // D'abord vérifier si une URL est stockée directement
        if (!empty($this->gameplay_image) && str_starts_with($this->gameplay_image, 'http')) {
            return $this->gameplay_image;
        }
        
        // Pour les jeux
        $gameUrl = $this->getR2ImageUrl('gameplay');
        if ($gameUrl) {
            return $gameUrl;
        }
        
        // Pour les consoles, cartes, accessoires: utiliser display2 comme gameplay
        if ($this->isConsoleCategory() || $this->isCardsCategory() || $this->isAccessoryCategory()) {
            return $this->getTaxonomyImageUrl('display2');
        }
        
        return null;
    }

    /**
     * Accessor pour l'URL du screenshot 2 (artwork)
     * Priorité: colonne directe > URL R2 générée > taxonomie display3
     */
    public function getScreenshot2UrlAttribute()
    {
        // D'abord vérifier si une URL est stockée directement
        if (!empty($this->artwork_image) && str_starts_with($this->artwork_image, 'http')) {
            return $this->artwork_image;
        }
        
        // Pour les jeux
        $gameUrl = $this->getR2ImageUrl('artwork');
        if ($gameUrl) {
            return $gameUrl;
        }
        
        // Pour les consoles, cartes, accessoires: utiliser display3 comme artwork
        if ($this->isConsoleCategory() || $this->isCardsCategory() || $this->isAccessoryCategory()) {
            return $this->getTaxonomyImageUrl('display3');
        }
        
        return null;
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

    /**
     * Vérifie si ce type appartient à la catégorie Consoles (ID = 1)
     */
    public function isConsoleCategory(): bool
    {
        // Charger la sous-catégorie si nécessaire
        $subCategory = $this->relationLoaded('subCategory') 
            ? $this->subCategory 
            : $this->subCategory()->first();
        
        if (!$subCategory) {
            return false;
        }

        // Charger la marque et sa catégorie
        $brand = $subCategory->relationLoaded('brand')
            ? $subCategory->brand
            : $subCategory->brand()->first();
        
        if (!$brand) {
            return false;
        }

        $category = $brand->relationLoaded('category')
            ? $brand->category
            : $brand->category()->first();
        
        // ID 1 = Catégorie "Consoles"
        return $category && $category->id === 1;
    }

    /**
     * Vérifie si ce type appartient à la catégorie Cartes à collectionner (ID = 12)
     */
    public function isCardsCategory(): bool
    {
        $subCategory = $this->relationLoaded('subCategory') 
            ? $this->subCategory 
            : $this->subCategory()->first();
        
        if (!$subCategory) {
            return false;
        }

        $brand = $subCategory->relationLoaded('brand')
            ? $subCategory->brand
            : $subCategory->brand()->first();
        
        if (!$brand) {
            return false;
        }

        $category = $brand->relationLoaded('category')
            ? $brand->category
            : $brand->category()->first();
        
        return $category && $category->id === 12;
    }

    /**
     * Vérifie si ce type appartient à la catégorie Accessoires (ID = 13)
     */
    public function isAccessoryCategory(): bool
    {
        $subCategory = $this->relationLoaded('subCategory') 
            ? $this->subCategory 
            : $this->subCategory()->first();
        
        if (!$subCategory) {
            return false;
        }

        $brand = $subCategory->relationLoaded('brand')
            ? $subCategory->brand
            : $subCategory->brand()->first();
        
        if (!$brand) {
            return false;
        }

        $category = $brand->relationLoaded('category')
            ? $brand->category
            : $brand->category()->first();
        
        return $category && $category->id === 13;
    }

    /**
     * Récupérer le dossier de taxonomie selon la catégorie
     */
    public function getTaxonomyFolder(): ?string
    {
        if ($this->isConsoleCategory()) {
            return 'consoles';
        } elseif ($this->isCardsCategory()) {
            return 'cartes';
        } elseif ($this->isAccessoryCategory()) {
            return 'accessoires';
        }
        return null;
    }

    /**
     * Générer le slug/identifier pour les images de taxonomie
     * DOIT correspondre à la logique JavaScript du formulaire:
     * typeName.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/-+/g, '-').replace(/^-|-$/g, '')
     */
    public function getTaxonomySlug(): string
    {
        // Convertir en minuscules
        $slug = strtolower($this->name);
        // Remplacer tout ce qui n'est pas a-z0-9 par un tiret
        $slug = preg_replace('/[^a-z0-9]+/', '-', $slug);
        // Remplacer les tirets multiples par un seul
        $slug = preg_replace('/-+/', '-', $slug);
        // Supprimer les tirets au début et à la fin
        $slug = trim($slug, '-');
        return $slug;
    }

    /**
     * Récupérer l'URL d'une image de taxonomie depuis R2
     * Dossier: taxonomy/{folder}/{slug}-{type}.png
     * Fonctionne pour consoles, cartes, accessoires
     * Retourne null si le fichier n'existe pas sur R2
     */
    private function getTaxonomyImageUrl($type): ?string
    {
        $folder = $this->getTaxonomyFolder();
        if (!$folder) {
            return null;
        }

        $slug = $this->getTaxonomySlug();
        if (!$slug) {
            return null;
        }

        $filename = "{$slug}-{$type}.png";
        $r2Path = "taxonomy/{$folder}/{$filename}";
        
        // Vérifier l'existence du fichier sur R2
        try {
            if (!\Storage::disk('r2')->exists($r2Path)) {
                return null;
            }
        } catch (\Exception $e) {
            \Log::warning("Erreur vérification image taxonomie R2 {$r2Path}: " . $e->getMessage());
            return null;
        }
        
        // En production : URL directe R2
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
     * @deprecated Utilisez getTaxonomyImageUrl() à la place
     * Conservé pour compatibilité
     */
    private function getConsoleImageUrl($type)
    {
        return $this->getTaxonomyImageUrl($type);
    }

    /**
     * Accessor pour les images de taxonomie
     * (logo et display1-3 mappés vers cover/artwork/gameplay)
     * Fonctionne pour consoles, cartes, accessoires
     */
    public function getConsoleLogoUrlAttribute()
    {
        if (!$this->isConsoleCategory() && !$this->isCardsCategory() && !$this->isAccessoryCategory()) {
            return null;
        }
        return $this->getTaxonomyImageUrl('logo');
    }

    public function getConsoleDisplay1UrlAttribute()
    {
        if (!$this->isConsoleCategory() && !$this->isCardsCategory() && !$this->isAccessoryCategory()) {
            return null;
        }
        return $this->getTaxonomyImageUrl('display1');
    }

    public function getConsoleDisplay2UrlAttribute()
    {
        if (!$this->isConsoleCategory() && !$this->isCardsCategory() && !$this->isAccessoryCategory()) {
            return null;
        }
        return $this->getTaxonomyImageUrl('display2');
    }

    public function getConsoleDisplay3UrlAttribute()
    {
        if (!$this->isConsoleCategory() && !$this->isCardsCategory() && !$this->isAccessoryCategory()) {
            return null;
        }
        return $this->getTaxonomyImageUrl('display3');
    }
}