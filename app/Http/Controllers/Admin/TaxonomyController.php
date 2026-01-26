<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ArticleCategory;
use App\Models\ArticleBrand;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;
use App\Models\GameBoyGame;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TaxonomyController extends Controller
{
    /* =====================================================
     | INDEX — interface d’administration des taxonomies
     ===================================================== */
    public function index()
    {
        return view('admin.taxonomy.index', [
            'categories' => ArticleCategory::with(['brands.subCategories.types'])->get(),
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
            'article_brand_id' => 'required|exists:article_brands,id',
            'name' => 'required|string|max:255',
        ]);

        // Récupérer la catégorie à partir de la marque
        $brand = ArticleBrand::findOrFail($request->article_brand_id);

        ArticleSubCategory::firstOrCreate([
            'article_category_id' => $brand->article_category_id,
            'article_brand_id' => $request->article_brand_id,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Sous-catégorie ajoutée');
    }

    /* =====================================================
     | STORE BRAND
     ===================================================== */
    public function storeBrand(Request $request)
    {
        $request->validate([
            'article_category_id' => 'required|exists:article_categories,id',
            'name' => 'required|string|max:255',
        ]);

        ArticleBrand::firstOrCreate([
            'article_category_id' => $request->article_category_id,
            'name' => $request->name,
        ]);

        return back()->with('success', 'Marque ajoutée');
    }

    /* =====================================================
     | STORE TYPE
     ===================================================== */
    public function storeType(Request $request)
    {
        $request->validate([
            'article_sub_category_id' => 'required|exists:article_sub_categories,id',
            'name' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
        ]);

        ArticleType::firstOrCreate([
            'article_sub_category_id' => $request->article_sub_category_id,
            'name' => $request->name,
        ], [
            'publisher' => $request->publisher,
        ]);

        return back()->with('success', 'Type ajouté');
    }

    /**
     * Créer automatiquement un type de jeu (pour l'IA)
     */
    public function autoCreateType(Request $request)
    {
        $request->validate([
            'article_sub_category_id' => 'required|exists:article_sub_categories,id',
            'name' => 'required|string|max:255',
            'publisher' => 'nullable|string|max:255',
        ]);

        $type = ArticleType::firstOrCreate([
            'article_sub_category_id' => $request->article_sub_category_id,
            'name' => $request->name,
        ], [
            'publisher' => $request->publisher,
        ]);

        return response()->json([
            'success' => true,
            'type' => [
                'id' => $type->id,
                'name' => $type->name,
            ]
        ]);
    }

    /**
     * Rechercher un jeu Game Boy par ROM ID (AJAX pour l'IA)
     */
    public function lookupRomId($romId)
    {
        try {
            $romId = strtoupper(trim($romId));
            
            // Chercher le jeu dans la base GameBoyGame
            $game = GameBoyGame::where('rom_id', $romId)->first();
            
            // Si non trouvé et ROM ID se termine par un code région (JPN, EUR, USA, etc.)
            // essayer de remplacer par -0, -1, -2, -3 (format utilisé dans la base)
            if (!$game && preg_match('/-(JPN|EUR|USA|FRA|GER|ITA|SPA)$/i', $romId)) {
                Log::info("ROM ID $romId non trouvé, essai avec variantes -0, -1, -2, -3");
                
                for ($i = 0; $i <= 3; $i++) {
                    $alternateRomId = preg_replace('/-(JPN|EUR|USA|FRA|GER|ITA|SPA)$/i', "-$i", $romId);
                    $game = GameBoyGame::where('rom_id', $alternateRomId)->first();
                    if ($game) {
                        Log::info("Jeu trouvé avec ROM ID alternatif: $alternateRomId");
                        break;
                    }
                }
            }
            
            if (!$game) {
                return response()->json([
                    'success' => false,
                    'message' => 'Jeu non trouvé'
                ]);
            }
            
            // Déterminer la sous-catégorie selon le préfixe du ROM ID
            $subCategory = null;
            if (str_starts_with($romId, 'DMG-')) {
                $subCategory = 'Game Boy';
            } elseif (str_starts_with($romId, 'CGB-')) {
                $subCategory = 'Game Boy Color';
            } elseif (str_starts_with($romId, 'AGB-')) {
                $subCategory = 'Game Boy Advance';
            }
            
            // Déterminer la région selon le suffixe du ROM ID
            $region = null;
            if (preg_match('/-(JPN|JAP)$/i', $romId) || preg_match('/-[0-9]$/i', $romId)) {
                $region = 'NTSC-J';
            } elseif (preg_match('/-(USA|CAN)$/i', $romId)) {
                $region = 'NTSC-U';
            } elseif (preg_match('/-(EUR|PAL|FRA|GER|ITA|SPA|UK)$/i', $romId)) {
                $region = 'PAL';
            }
            
            // Vérifier si un type existe déjà pour ce jeu
            $existingType = ArticleType::where('name', 'LIKE', '%' . $game->name . '%')
                ->orWhere('name', $game->name)
                ->first();
            
            return response()->json([
                'success' => true,
                'game' => [
                    'name' => $game->name,
                    'rom_id' => $game->rom_id,
                    'year' => $game->year,
                    'publisher' => $game->publisher,
                ],
                'sub_category' => $subCategory,
                'region' => $region,
                'type_exists' => $existingType ? true : false,
                'type_id' => $existingType ? $existingType->id : null,
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur lookupRomId: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la recherche: ' . $e->getMessage()
            ], 500);
        }
    }

    /* =====================================================
     | AJAX — marques par catégorie
     ===================================================== */
    public function ajaxBrands($categoryId)
    {
        $brands = ArticleBrand::where('article_category_id', $categoryId)
            ->orderBy('name')
            ->get(['id', 'name']);

        if (request()->wantsJson() || request()->header('Accept') === 'application/json') {
            return response()->json($brands);
        }

        $html = '<option value="">-- Sélectionner --</option>';
        foreach ($brands as $brand) {
            $html .= '<option value="' . $brand->id . '">' . e($brand->name) . '</option>';
        }

        return response($html);
    }

    /* =====================================================
     | AJAX — sous-catégories par marque
     ===================================================== */
    public function ajaxSubCategories($brandId)
    {
        $subCategories = ArticleSubCategory::where('article_brand_id', $brandId)
            ->orderBy('name')
            ->get(['id', 'name']);

        if (request()->wantsJson() || request()->header('Accept') === 'application/json') {
            return response()->json($subCategories);
        }

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

        // Si la requête demande du JSON, retourner du JSON
        if (request()->wantsJson() || request()->header('Accept') === 'application/json') {
            return response()->json($types);
        }

        // Sinon, retourner du HTML (pour compatibilité)
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
        'article_brand_id' => 'nullable|exists:article_brands,id',
    ]);

    $subCategory->update($data);

    return back()->with('success', 'Sous-catégorie mise à jour.');
}

public function updateBrand(Request $request, ArticleBrand $brand)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'article_category_id' => 'required|exists:article_categories,id',
    ]);

    $brand->update($data);

    return back()->with('success', 'Marque mise à jour.');
}

public function updateType(Request $request, ArticleType $type)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'article_sub_category_id' => 'required|exists:article_sub_categories,id',
        'publisher' => 'nullable|string|max:255',
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
    if ($category->brands()->exists() || $category->subCategories()->exists()) {
        return back()->with('error', 'Suppression impossible : la catégorie contient des marques ou sous-catégories.');
    }

    $category->delete();

    return back()->with('success', 'Catégorie supprimée.');
}

public function destroyBrand(ArticleBrand $brand)
{
    if ($brand->subCategories()->exists()) {
        return back()->with('error', 'Suppression impossible : la marque contient des sous-catégories.');
    }

    $brand->delete();

    return back()->with('success', 'Marque supprimée.');
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

    /* =====================================================
     | AJAX — description du type
     ===================================================== */
    public function ajaxTypeDescription(ArticleType $type)
    {
        return response()->json([
            'description' => $type->description ?? '',
            'publisher' => $type->publisher ?? '',
            'images' => $type->images ?? [],
            'cover_image' => $type->cover_image ?? null,
            'gameplay_image' => $type->gameplay_image ?? null,
        ]);
    }
    
}
