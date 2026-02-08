<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'publisher',
        'article_sub_category_id',
        'cover_image',
        'artwork_image',
        'gameplay_image',
        'description',
        'key_features',
        'average_market_price',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
    ];

    public function subCategory()
    {
        return $this->belongsTo(ArticleSubCategory::class, 'article_sub_category_id');
    }

    public function consoles()
    {
        return $this->hasMany(Console::class, 'article_type_id');
    }
}