<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;

class ArticleMetaAjaxController extends Controller
{
    public function subCategories($categoryId)
    {
        return ArticleSubCategory::where('article_category_id', $categoryId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }

    public function types($subCategoryId)
    {
        return ArticleType::where('article_sub_category_id', $subCategoryId)
            ->orderBy('name')
            ->get(['id', 'name']);
    }
}
