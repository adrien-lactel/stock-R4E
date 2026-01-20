<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;
use Illuminate\Http\Request;

class TaxonomyController extends Controller
{
    /* =====================================================
     | INDEX — interface d’administration des taxonomies
     ===================================================== */
    public function index()
    {
        return view('admin.taxonomy.index', [
            'categories' => ArticleCategory::with('subCategories.types')->get(),
        ]);
    }

    /* =====================================================
     | STORE CATEGORY
     ===================================================== */
    public function storeCategory(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ArticleCategory::firstOrCreate([
            'name' => $request->name,
        ]);

        return back()->with('success', 'Catégorie ajoutée');
    }

    /* =====================================================
     | STORE SUB-CATEGORY
     ===================================================== */
    public function storeSubCategory(Request $request)
    {
        $request->validate([
            'article_category_id' => 'required|exists:article_categories,id',
            'name' => 'required|string|max:255',
        ]);

        ArticleSubCategory::firstOrCreate([
            'article_category_id' => $request->article_category_id,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Sous-catégorie ajoutée');
    }

    /* =====================================================
     | STORE TYPE
     ===================================================== */
    public function storeType(Request $request)
    {
        $request->validate([
            'article_sub_category_id' => 'required|exists:article_sub_categories,id',
            'name' => 'required|string|max:255',
        ]);

        ArticleType::firstOrCreate([
            'article_sub_category_id' => $request->article_sub_category_id,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Type ajouté');
    }

    /* =====================================================
     | AJAX — sous-catégories par catégorie
     ===================================================== */
    public function ajaxSubCategories($categoryId)
    {
        $subCategories = ArticleSubCategory::where('article_category_id', $categoryId)
            ->orderBy('name')
            ->get(['id', 'name']);

        $html = '<option value="">-- Sélectionner --</option>';
        foreach ($subCategories as $sub) {
            $html .= '<option value="' . $sub->id . '">' . e($sub->name) . '</option>';
        }

        return response($html);
    }

    /* =====================================================
     | AJAX — types par sous-catégorie
     ===================================================== */
    public function ajaxTypes($subCategoryId)
    {
        $types = ArticleType::where('article_sub_category_id', $subCategoryId)
            ->select('id', 'name')
            ->orderBy('name')
            ->get();

        $html = '<option value="">-- Sélectionner --</option>';
        foreach ($types as $type) {
            $html .= '<option value="' . $type->id . '">' . e($type->name) . '</option>';
        }

        return response($html);
    }


// --------------------
// UPDATE
// --------------------
public function updateCategory(Request $request, ArticleCategory $category)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
    ]);

    $category->update($data);

    return back()->with('success', 'Catégorie mise à jour.');
}

public function updateSubCategory(Request $request, ArticleSubCategory $subCategory)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'article_category_id' => 'required|exists:article_categories,id',
    ]);

    $subCategory->update($data);

    return back()->with('success', 'Sous-catégorie mise à jour.');
}

public function updateType(Request $request, ArticleType $type)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'article_sub_category_id' => 'required|exists:article_sub_categories,id',
    ]);

    $type->update($data);

    return back()->with('success', 'Type mis à jour.');
}

// --------------------
// DELETE (optionnel)
// --------------------
public function destroyCategory(ArticleCategory $category)
{
    // sécurité: empêche suppression si enfants
    if ($category->subCategories()->exists()) {
        return back()->with('error', 'Suppression impossible : la catégorie contient des sous-catégories.');
    }

    $category->delete();

    return back()->with('success', 'Catégorie supprimée.');
}

public function destroySubCategory(ArticleSubCategory $subCategory)
{
    if ($subCategory->types()->exists()) {
        return back()->with('error', 'Suppression impossible : la sous-catégorie contient des types.');
    }

    $subCategory->delete();

    return back()->with('success', 'Sous-catégorie supprimée.');
}

public function destroyType(ArticleType $type)
{
    $type->delete();

    return back()->with('success', 'Type supprimé.');
}

    
}
