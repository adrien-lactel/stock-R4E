<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_id',
        'console_id',
        'amount',
        'status',
        'issued_at',
        'invoice_date',
    ];

    protected $casts = [
        'issued_at' => 'datetime',
        'invoice_date' => 'date',
    ];

    /* ===================== */
    /*      RELATIONS        */
    /* ===================== */

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function console()
    {
        return $this->belongsTo(Console::class);
    }

    /* ===================== */
    /*        SCOPES         */
    /* ===================== */

    public function scopePaid($query)
    {
        return $query->where('status', 'paid');
    }

    public function scopeUnpaid($query)
    {
        return $query->where('status', 'unpaid');
    }

    public function scopeForStore($query, $storeId)
    {
        return $query->where('store_id', $storeId);
    }

    public function scopeThisMonth($query)
    {
        return $query
            ->whereMonth('invoice_date', now()->month)
            ->whereYear('invoice_date', now()->year);
    }
}
