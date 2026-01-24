<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleSubCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'article_category_id', 'article_brand_id'];


    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'article_category_id');
    }

    public function brand()
    {
        return $this->belongsTo(ArticleBrand::class, 'article_brand_id');
    }

    public function types()
    {
        return $this->hasMany(ArticleType::class, 'article_sub_category_id');
    }

}
