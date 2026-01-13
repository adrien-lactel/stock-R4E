<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repairer extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'city',
        'address',
        'notes',
        'is_active',
        'delay_days_default',
        'shipping_method',
        'vat_number',
        'siret',
    ];

    public function consoles()
    {
        return $this->hasMany(\App\Models\Console::class);
    }

    public function mods()
    {
        return $this->belongsToMany(Mod::class, 'mod_repairer')
            ->withPivot('quantity')
            ->withTimestamps();
    }
}