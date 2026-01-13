<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ConsoleStorePrice;
use App\Models\User;

class Store extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'city'];

    /* ===================== */
    /*     RELATIONS         */
    /* ===================== */

    // 🔹 COMPTE UTILISATEUR DU MAGASIN (NOUVEAU – SÛR)
    public function user()
    {
        return $this->hasOne(User::class);
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    // Table pivot dédiée prix console / magasin
    public function consolePrices()
    {
        return $this->hasMany(ConsoleStorePrice::class);
    }

    // Consoles visibles par le magasin avec prix
    public function consoles()
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
