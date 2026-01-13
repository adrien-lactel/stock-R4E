<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;

class ArticleTaxonomyController extends Controller
{
    public function index()
    {
        return view('admin.taxonomy.index', [
            'categories' => ArticleCategory::with('subCategories.types')->get()
        ]);
    }

    public function storeCategory(Request $request)
    {
        ArticleCategory::create(
            $request->validate(['name' => 'required|unique:article_categories'])
        );

        return back()->with('success', 'Catégorie ajoutée');
    }

    public function storeSubCategory(Request $request)
    {
        ArticleSubCategory::create(
            $request->validate([
                'article_category_id' => 'required|exists:article_categories,id',
                'name' => 'required'
            ])
        );

        return back()->with('success', 'Sous-catégorie ajoutée');
    }

    public function storeType(Request $request)
    {
        ArticleType::create(
            $request->validate([
                'article_sub_category_id' => 'required|exists:article_sub_categories,id',
                'name' => 'required'
            ])
        );

        return back()->with('success', 'Type ajouté');
    }
}
