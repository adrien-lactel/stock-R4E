<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RepairQuote extends Model
{
    use HasFactory;

    protected $fillable = [
        'console_id',
        'store_id',
        'console_return_id',
        'problem_description',
        'amount',
        'admin_comment',
        'status',
    ];

    /* =====================
     | RELATIONS
     ===================== */

    public function console()
    {
        return $this->belongsTo(Console::class);
    }

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function consoleReturn()
    {
        return $this->belongsTo(ConsoleReturn::class);
    }
}
