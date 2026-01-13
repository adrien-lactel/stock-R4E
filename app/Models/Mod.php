<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Mod extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'purchase_price',
        'quantity',
        'is_accessory'
    ];

    protected $casts = [
        'purchase_price' => 'decimal:2',
        'quantity' => 'integer',
        'is_accessory' => 'boolean',
    ];

    /**
     * Compatibilité avec les catégories d'articles
     */
    public function compatibleCategories(): BelongsToMany
    {
        return $this->belongsToMany(ArticleCategory::class, 'mod_compatibilities');
    }

    /**
     * Compatibilité avec les sous-catégories d'articles
     */
    public function compatibleSubCategories(): BelongsToMany
    {
        return $this->belongsToMany(ArticleSubCategory::class, 'mod_compatibilities');
    }

    /**
     * Compatibilité avec les types d'articles
     */
    public function compatibleTypes(): BelongsToMany
    {
        return $this->belongsToMany(ArticleType::class, 'mod_compatibilities');
    }

    /**
     * Consoles ayant ce mod appliqué
     */
    public function appliedConsoles(): BelongsToMany
    {
        return $this->belongsToMany(Console::class, 'console_mod')
            ->withPivot(['repairer_id', 'price_applied', 'notes'])
            ->withTimestamps();
    }

    /**
     * Réparateurs disposant de ce mod
     */
    public function repairers(): BelongsToMany
    {
        return $this->belongsToMany(Repairer::class, 'mod_repairer')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}