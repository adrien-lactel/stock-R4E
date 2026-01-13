<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsoleStorePrice extends Model
{
    use HasFactory;

    protected $fillable = [
        'console_id',
        'store_id',
        'sale_price',
    ];

    /* ===================== */
    /*      RELATIONS        */
    /* ===================== */

    public function console()
    {
        return $this->belongsTo(Console::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    /* ===================== */
    /*      HELPERS          */
    /* ===================== */

    public function isVisible(): bool
    {
        return !is_null($this->sale_price);
    }
}
