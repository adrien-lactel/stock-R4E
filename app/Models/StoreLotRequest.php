<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreLotRequest extends Model
{
    protected $fillable = [
        'store_id',
        'console_offer_id',
        'quantity',
        'status',
        'admin_comment',
    ];

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function consoleOffer(): BelongsTo
    {
        return $this->belongsTo(ConsoleOffer::class);
    }
}
