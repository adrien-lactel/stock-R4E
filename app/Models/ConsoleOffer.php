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
