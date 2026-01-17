<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'store_id',
        'repairer_id',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /* ===================== */
    /*      RELATIONS        */
    /* ===================== */

    public function store()
    {
        return $this->belongsTo(Store::class);
    }

    public function repairer()
    {
        return $this->belongsTo(Repairer::class);
    }

    /* ===================== */
    /*        HELPERS        */
    /* ===================== */

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function isStore(): bool
    {
        return $this->role === 'store';
    }

    public function isRepairer(): bool
    {
        return $this->role === 'repairer';
    }
}