<?php

namespace App\Models;

use App\Models\Repairer;
use App\Models\RepairQuote;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Model;

class ConsoleReturn extends Model
{
    protected $fillable = [
        'console_id',
        'store_id',
        'repairer_id',
        'comment',
        'admin_comment', 
        'status',
        'acknowledged',
        'is_external',
        'external_item_name',
        'external_item_description',
    ];

    protected $casts = [
        'acknowledged' => 'boolean',
        'is_external' => 'boolean',
    ];

    public function console(): BelongsTo
    {
        return $this->belongsTo(Console::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function repairer(): BelongsTo
    {
        return $this->belongsTo(Repairer::class);
    }
    public function repairQuote(): HasOne
    {
        return $this->hasOne(RepairQuote::class);
    }
}
