<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Console extends Model
{
    use HasFactory;

    protected $fillable = [
        // EXISTANT
        'article_category_id',
        'article_sub_category_id',
        'article_type_id',
        'rom_id',
        'year',
        'region',
        'completeness',
        'language',
        'publisher',
        'sub_category',
        'initial_status',
        'store_id',
        'status',
        'sold_at',
        'admin_comment',

        // IDENTITÉ ARTICLE
        'serial_number',
        'category',
        'provenance_article',

        // FINANCES
        'prix_achat',
        'valorisation',

        // PRODUIT
        'product_comment',
        'product_page_url',
        
        // IMAGES SPÉCIFIQUES À L'ARTICLE
        'article_images',
        'primary_image_url',
        'image_captions',

        // MODIFICATIONS
        'mod_1',
        'mod_2',
        'mod_3',
        'mod_4',

        // LOGISTIQUE / RÉPARATION
        'lieu_stockage',
        'commentaire_reparateur',
        'repairer_id',
        'destination_store_id',
        'assignment_status',
        'assignment_accepted_at',
        'assignment_received_at',
        'shipped_at',
    ];

    protected $casts = [
        'sold_at' => 'datetime',
        'assignment_accepted_at' => 'datetime',
        'assignment_received_at' => 'datetime',
        'shipped_at' => 'datetime',
        'article_images' => 'array',
        'image_captions' => 'array',
    ];

    /* ===================== */
    /*      RELATIONS        */
    /* ===================== */
    public function repairer()
    {
    return $this->belongsTo(\App\Models\Repairer::class);
    }

    public function invoice()
    {
        return $this->hasOne(\App\Models\Invoice::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function destinationStore()
    {
        return $this->belongsTo(Store::class, 'destination_store_id');
    }

    public function stores()
    {
        return $this->belongsToMany(Store::class, 'console_store_prices')
            ->withPivot('sale_price')
            ->withTimestamps();
    }

    public function returns()
    {
        return $this->hasMany(ConsoleReturn::class);
    }

    public function returnRequest()
    {
        return $this->hasOne(ConsoleReturn::class);
    }

    public function repairQuotes()
    {
        return $this->hasMany(RepairQuote::class);
    }

    public function offers()
    {
        return $this->hasMany(ConsoleOffer::class);
    }

    public function mods()
    {
        return $this->belongsToMany(Mod::class, 'console_mod')
            ->withPivot(['repairer_id', 'price_applied', 'notes', 'work_time_minutes'])
            ->withTimestamps();
    }

    /* ===================== */
    /*        SCOPES         */
    /* ===================== */

    public function scopeStock($query)
    {
        return $query->where('status', 'stock');
    }

    public function scopeDefective($query)
    {
        return $query->where('status', 'defective');
    }

    public function scopeSold($query)
    {
        return $query->where('status', 'vendue');
    }
    public function articleCategory() { return $this->belongsTo(\App\Models\ArticleCategory::class); }
public function articleSubCategory() { return $this->belongsTo(\App\Models\ArticleSubCategory::class); }
public function articleType() { return $this->belongsTo(\App\Models\ArticleType::class); }
public function productSheet() { return $this->belongsTo(\App\Models\ProductSheet::class); }

    /**
     * Valeur réelle utilisée pour facturation/valorisation
     * - retourne valorisation si présente, sinon prix_achat, sinon 0
     */
    public function getRealValueAttribute()
    {
        return (float) ($this->valorisation ?? $this->prix_achat ?? 0);
    }

    /**
     * Coût des mods (prix des pièces)
     */
    public function getModsCostAttribute(): float
    {
        return (float) $this->mods->sum('pivot.price_applied');
    }

    /**
     * Temps de travail total en minutes
     */
    public function getWorkTimeMinutesAttribute(): int
    {
        return (int) $this->mods->sum('pivot.work_time_minutes');
    }

    /**
     * Coût de main d'œuvre (20€/heure)
     */
    public function getLaborCostAttribute(): float
    {
        return ($this->work_time_minutes / 60) * 20;
    }

    /**
     * Coût total de réparation (mods + main d'œuvre)
     */
    public function getRepairCostAttribute(): float
    {
        return $this->mods_cost + $this->labor_cost;
    }

    /**
     * Coût de revient total (prix d'achat + coût de réparation + quote-part consoles disabled)
     */
    public function getTotalCostAttribute(): float
    {
        $baseCost = (float) ($this->prix_achat ?? 0) + $this->repair_cost;
        
        // Ajouter la quote-part des consoles disabled du même type
        if ($this->article_type_id && !in_array($this->status, ['disabled', 'parted_out'])) {
            // Total du prix d'achat des consoles disabled ET parted_out de ce type
            // MOINS la valorisation récupérée sur les consoles parted_out
            $disabledTotalCost = static::where('article_type_id', $this->article_type_id)
                ->where('status', 'disabled')
                ->sum('prix_achat');
            
            // Pour les consoles parted_out : prix_achat - valorisation
            $partedOutConsoles = static::where('article_type_id', $this->article_type_id)
                ->where('status', 'parted_out')
                ->get();
            
            foreach ($partedOutConsoles as $partedOut) {
                $netCost = ($partedOut->prix_achat ?? 0) - ($partedOut->valorisation ?? 0);
                $disabledTotalCost += max(0, $netCost); // Ne pas avoir de coût négatif
            }
            
            // Nombre de consoles non-disabled de ce type (vendables)
            $sellableCount = static::where('article_type_id', $this->article_type_id)
                ->whereIn('status', ['stock', 'defective', 'repair', 'vendue'])
                ->count();
            
            // Répartir le coût des disabled sur les vendables
            if ($sellableCount > 0 && $disabledTotalCost > 0) {
                $baseCost += ($disabledTotalCost / $sellableCount);
            }
        }
        
        return $baseCost;
    }
}
