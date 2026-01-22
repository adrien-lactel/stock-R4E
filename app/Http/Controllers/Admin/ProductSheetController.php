<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSheet;
use App\Models\ArticleType;
use App\Models\ArticleCategory;
use App\Models\GameBoyGame;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductSheetController extends Controller
{
    /* =====================================================
     | INDEX — Liste des fiches produits
     ===================================================== */
    public function index()
    {
        $sheets = ProductSheet::with('articleType.subCategory.category')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.product-sheets.index', compact('sheets'));
    }

    /* =====================================================
     | CREATE — Formulaire de création
     ===================================================== */
    public function create(Request $request)
    {
        $categories = ArticleCategory::with('subCategories.types')->orderBy('name')->get();
        $selectedType = null;
        $selectedSubCategory = null;
        $selectedCategory = null;

        // Si un article_type_id est fourni, charger toute la taxonomie
        if ($request->has('article_type_id')) {
            $selectedType = ArticleType::with(['subCategory.category'])
                ->find($request->article_type_id);
            
            if ($selectedType) {
                $selectedSubCategory = $selectedType->subCategory()->with('types')->first();
                $selectedCategory = $selectedSubCategory?->category()->with('subCategories')->first();
            }
        }

        return view('admin.product-sheets.create', [
            'sheet' => new ProductSheet(),
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'selectedSubCategory' => $selectedSubCategory,
            'selectedType' => $selectedType,
        ]);
    }

    /* =====================================================
     | UPLOAD IMAGE — Upload d'une image
     ===================================================== */
    public function uploadImage(Request $request)
    {
        \Log::info('uploadImage appelée', [
            'has_file' => $request->hasFile('image'),
            'all_files' => $request->allFiles(),
            'content_type' => $request->header('Content-Type'),
        ]);

        try {
            $request->validate([
                'image' => 'required|file|mimes:jpeg,png,jpg,gif,webp,avif|max:5120', // Max 5MB
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            \Log::error('Validation échouée', ['errors' => $e->validator->errors()->all()]);
            return response()->json([
                'success' => false,
                'message' => 'Validation échouée: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        }

        try {
            $file = $request->file('image');
            
            if (!$file) {
                \Log::error('Aucun fichier reçu');
                return response()->json([
                    'success' => false,
                    'message' => 'Aucun fichier reçu'
                ], 400);
            }
            
            \Log::info('Fichier reçu', [
                'name' => $file->getClientOriginalName(),
                'size' => $file->getSize(),
                'mime' => $file->getMimeType(),
            ]);
            
            // Vérifier la configuration Cloudinary complète
            \Log::info('Cloudinary config détaillée', [
                'cloud_name' => config('cloudinary.cloud_name'),
                'api_key' => config('cloudinary.api_key'),
                'api_secret_exists' => !empty(config('cloudinary.api_secret')),
                'all_config' => config('cloudinary'),
            ]);
            
            // Upload vers Cloudinary
            $result = Cloudinary::upload($file->getRealPath(), [
                'folder' => 'product-sheets',
            ]);
            
            \Log::info('Cloudinary upload result', [
                'result_type' => gettype($result),
                'result_class' => is_object($result) ? get_class($result) : null,
            ]);
            
            if (!$result) {
                throw new \Exception('Cloudinary upload returned null');
            }
            
            $uploadedFileUrl = $result->getSecurePath();

            \Log::info('Fichier uploadé vers Cloudinary avec succès', ['url' => $uploadedFileUrl]);

            return response()->json([
                'success' => true,
                'url' => $uploadedFileUrl,
                'path' => $uploadedFileUrl,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur upload', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'upload: ' . $e->getMessage()
            ], 500);
        }
    }

    /* =====================================================
     | UPLOAD FROM URL — Télécharger une image depuis une URL
     ===================================================== */
    public function uploadFromUrl(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
        ]);

        try {
            $imageUrl = $request->input('url');
            
            // Upload direct vers Cloudinary depuis l'URL
            $result = Cloudinary::upload($imageUrl, [
                'folder' => 'product-sheets',
            ]);
            
            $uploadedFileUrl = $result->getSecurePath();

            return response()->json([
                'success' => true,
                'url' => $uploadedFileUrl,
                'path' => $uploadedFileUrl,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors du téléchargement: ' . $e->getMessage()
            ], 500);
        }
    }

    /* =====================================================
     | DELETE IMAGE — Supprimer une image uploadée
     ===================================================== */
    public function deleteImage(Request $request)
    {
        $request->validate([
            'path' => 'required|string',
        ]);

        try {
            if (Storage::disk('public')->exists($request->path)) {
                Storage::disk('public')->delete($request->path);
                return response()->json(['success' => true]);
            }

            return response()->json([
                'success' => false,
                'message' => 'Fichier non trouvé'
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression: ' . $e->getMessage()
            ], 500);
        }
    }

    /* =====================================================
     | STORE — Enregistrer la fiche produit
     ===================================================== */
    public function store(Request $request)
    {
        // Décoder les champs JSON si nécessaire
        $images = $request->input('images');
        if (is_string($images)) {
            $request->merge(['images' => json_decode($images, true) ?: []]);
        }

        $tags = $request->input('tags');
        if (is_string($tags)) {
            $request->merge(['tags' => json_decode($tags, true) ?: []]);
        }

        $data = $request->validate([
            'article_type_id' => 'required|exists:article_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'technical_specs' => 'nullable|string',
            'included_items' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'url',
            'main_image' => 'nullable|url',
            'marketing_description' => 'nullable|string',
            'tags' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $sheet = ProductSheet::create($data);

        return redirect()
            ->route('admin.product-sheets.index')
            ->with('success', "Fiche produit \"{$sheet->name}\" créée avec succès");
    }

    /* =====================================================
     | EDIT — Éditer une fiche produit
     ===================================================== */
    public function edit(ProductSheet $productSheet)
    {
        $categories = ArticleCategory::with('subCategories.types')->orderBy('name')->get();
        $selectedType = null;
        $selectedSubCategory = null;
        $selectedCategory = null;

        if ($productSheet->article_type_id) {
            $selectedType = ArticleType::with(['subCategory.category'])
                ->find($productSheet->article_type_id);
            
            if ($selectedType) {
                $selectedSubCategory = $selectedType->subCategory()->with('types')->first();
                $selectedCategory = $selectedSubCategory?->category()->with('subCategories')->first();
            }
        }

        return view('admin.product-sheets.edit', [
            'sheet' => $productSheet,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
            'selectedSubCategory' => $selectedSubCategory,
            'selectedType' => $selectedType,
        ]);
    }

    /* =====================================================
     | UPDATE — Mettre à jour une fiche produit
     ===================================================== */
    public function update(Request $request, ProductSheet $productSheet)
    {
        // Décoder les champs JSON si nécessaire
        $images = $request->input('images');
        if (is_string($images)) {
            $request->merge(['images' => json_decode($images, true) ?: []]);
        }

        $tags = $request->input('tags');
        if (is_string($tags)) {
            $request->merge(['tags' => json_decode($tags, true) ?: []]);
        }

        $conditionCriteria = $request->input('condition_criteria');
        if (is_string($conditionCriteria)) {
            $request->merge(['condition_criteria' => json_decode($conditionCriteria, true) ?: []]);
        }

        $data = $request->validate([
            'article_type_id' => 'required|exists:article_types,id',
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'technical_specs' => 'nullable|string',
            'included_items' => 'nullable|string',
            'images' => 'nullable|array',
            'images.*' => 'url',
            'main_image' => 'nullable|url',
            'marketing_description' => 'nullable|string',
            'tags' => 'nullable|array',
            'condition_criteria' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $productSheet->update($data);

        return redirect()
            ->route('admin.product-sheets.index')
            ->with('success', "Fiche produit \"{$productSheet->name}\" mise à jour");
    }

    /* =====================================================
     | DESTROY — Supprimer une fiche produit
     ===================================================== */
    public function destroy(ProductSheet $productSheet)
    {
        $name = $productSheet->name;
        $productSheet->delete();

        return redirect()
            ->route('admin.product-sheets.index')
            ->with('success', "Fiche produit \"{$name}\" supprimée");
    }

    /* =====================================================
     | LOOKUP ROM ID — Recherche Game Boy par ROM ID (AJAX)
     ===================================================== */
    public function lookupRomId(string $romId)
    {
        $game = GameBoyGame::findByRomId($romId);

        if (!$game) {
            return response()->json([
                'success' => false,
                'message' => "Aucun jeu trouvé pour le ROM ID: {$romId}",
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => [
                'name' => $game->name,
                'year' => $game->year,
                'image_url' => $game->image_url,
                'price' => $game->price,
                'rom_id' => $game->rom_id,
            ],
        ]);
    }

    /* =====================================================
     | AUTOCOMPLETE ROM ID — Suggestions de ROM IDs (AJAX)
     ===================================================== */
    public function autocompleteRomId(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([]);
        }

        $suggestions = GameBoyGame::where('rom_id', 'like', strtoupper($query) . '%')
            ->whereNotNull('rom_id')
            ->orderBy('rom_id')
            ->limit(10)
            ->get(['rom_id', 'name', 'year'])
            ->map(function($game) {
                return [
                    'rom_id' => $game->rom_id,
                    'label' => $game->rom_id . ' - ' . $game->name,
                    'name' => $game->name,
                    'year' => $game->year,
                ];
            });

        return response()->json($suggestions);
    }
}
