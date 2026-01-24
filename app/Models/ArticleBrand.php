<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleBrand extends Model
{
    use HasFactory;

    protected $fillable = ['article_category_id', 'name'];

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function subCategories()
    {
        return $this->hasMany(ArticleSubCategory::class, 'article_brand_id');
    }
}
