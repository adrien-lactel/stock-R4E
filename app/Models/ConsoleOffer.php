<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class ConsoleOffer extends Model
{
    protected $fillable = [
        'console_id',
        'store_id',
        'sale_price',
        'consignment_price',
        'status',
        'payment_received',
        'payment_date',
        'shipped_at',
        'tracking_number',
        'carrier',
        'received_at',
    ];

    protected $casts = [
        'payment_received' => 'boolean',
        'payment_date' => 'date',
        'shipped_at' => 'datetime',
        'received_at' => 'datetime',
    ];

    public function console(): BelongsTo
    {
        return $this->belongsTo(Console::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function lotRequests(): HasMany
    {
        return $this->hasMany(StoreLotRequest::class);
    }
}
