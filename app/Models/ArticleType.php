<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'article_sub_category_id',
        'cover_image',
        'gameplay_image',
        'description',
        'key_features',
        'average_market_price',
    ];

    public function subCategory()
    {
        return $this->belongsTo(ArticleSubCategory::class, 'article_sub_category_id');
    }
}