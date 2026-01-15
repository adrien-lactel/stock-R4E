<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'article_sub_category_id'];

    public function subCategory()
    {
        return $this->belongsTo(ArticleSubCategory::class);
    }
}