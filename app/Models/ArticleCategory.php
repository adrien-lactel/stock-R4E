<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ArticleCategory extends Model
{
    protected $fillable = ['name'];

    public function subCategories()
    {
        return $this->hasMany(ArticleSubCategory::class);
    }


}