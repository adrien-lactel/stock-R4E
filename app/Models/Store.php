<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use App\Models\ConsoleStorePrice;
use App\Models\User;

/**
 * @property-read User|null $user
 * @property-read \Illuminate\Database\Eloquent\Collection<Article> $articles
 * @property-read \Illuminate\Database\Eloquent\Collection<Invoice> $invoices
 * @property-read \Illuminate\Database\Eloquent\Collection<Console> $consoles
 * @method \Illuminate\Database\Eloquent\Relations\HasOne user()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany articles()
 * @method \Illuminate\Database\Eloquent\Relations\HasMany invoices()
 * @method \Illuminate\Database\Eloquent\Relations\BelongsToMany consoles()
 */
class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'city',
        'phone',
        'address',
        'postal_code',
        'notes',
        'is_active',
        'siret',
        'vat_number',
        'manager_name',
        'opening_hours',
    ];

    /* ===================== */
    /*     RELATIONS         */
    /* ===================== */

    /**
     * Compte utilisateur du magasin
     */
    public function user(): HasOne
    {
        return $this->hasOne(User::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function invoices(): HasMany
    {
        return $this->hasMany(Invoice::class);
    }

    // Table pivot dédiée prix console / magasin
    public function consolePrices(): HasMany
    {
        return $this->hasMany(ConsoleStorePrice::class);
    }

    // Consoles visibles par le magasin avec prix
    public function consoles(): BelongsToMany
    {
         return $this->belongsToMany(Console::class, 'console_store_prices')
        ->withPivot('sale_price')
        ->withTimestamps();
    }

    // Alias (facultatif mais OK)
    public function consolesWithPrices()
    {
        return $this->belongsToMany(Console::class, 'console_store_prices')
            ->withPivot('sale_price')
            ->withTimestamps();
    }

    /* ===================== */
    /*        SCOPES         */
    /* ===================== */

    public function scopeInCity($query, $city)
    {
        return $query->where('city', $city);
    }

    public function scopeWithRevenue($query)
    {
        return $query->withSum('invoices as revenue', 'amount');
    }

    public function scopeWithSoldConsoles($query)
    {
        return $query->whereHas('consoles', function ($q) {
            $q->sold();
        });
    }
    public function consoleReturns()
    {
        return $this->hasMany(ConsoleReturn::class);
    }

    public function lotRequests()
    {
        return $this->hasMany(StoreLotRequest::class);
    }
}
