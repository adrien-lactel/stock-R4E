<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductSheet extends Model
{
    use HasFactory;

    protected $fillable = [
        'article_type_id',
        'name',
        'description',
        'technical_specs',
        'included_items',
        'images',
        'main_image',
        'marketing_description',
        'tags',
        'condition_criteria',
        'featured_mods',
        'is_active',
    ];

    protected $casts = [
        'images' => 'array',
        'tags' => 'array',
        'condition_criteria' => 'array',
        'featured_mods' => 'array',
        'is_active' => 'boolean',
    ];

    /* =====================================================
     | RELATIONS
     ===================================================== */
    public function articleType()
    {
        return $this->belongsTo(ArticleType::class);
    }

    public function consoles()
    {
        return $this->hasMany(Console::class);
    }
}
