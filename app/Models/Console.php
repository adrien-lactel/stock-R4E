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

        // MODIFICATIONS
        'mod_1',
        'mod_2',
        'mod_3',
        'mod_4',

        // LOGISTIQUE / RÉPARATION
        'lieu_stockage',
        'commentaire_reparateur',
    ];

    protected $casts = [
        'sold_at' => 'datetime',
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
            ->withPivot(['repairer_id', 'price_applied', 'notes'])
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

    /**
     * Valeur réelle utilisée pour facturation/valorisation
     * - retourne valorisation si présente, sinon prix_achat, sinon 0
     */
    public function getRealValueAttribute()
    {
        return (float) ($this->valorisation ?? $this->prix_achat ?? 0);
    }
}

