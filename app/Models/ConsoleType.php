<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConsoleType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'average_purchase_price', 'average_loss_percent'];

    public function consoles() { return $this->hasMany(Console::class); }
}