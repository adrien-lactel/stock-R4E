<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FeatureRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'title',
        'description',
        'admin_response',
        'status',
        'priority',
        'created_by',
        'completed_at',
        'responded_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
        'responded_at' => 'datetime',
    ];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeCompleted($query)
    {
        return $query->where('status', 'completed');
    }

    public function scopeBugs($query)
    {
        return $query->where('type', 'bug');
    }

    public function scopeFeatures($query)
    {
        return $query->where('type', 'feature');
    }
}
