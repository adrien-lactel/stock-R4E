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
use Illuminate\Support\Facades\Storage;

class TaxonomyController extends Controller
{
    /* =====================================================
     | INDEX — interface d’administration des taxonomies
     ===================================================== */
    public function index()
    {
        // Version avec édition complète et chargement progressif
        return view('admin.taxonomy.index-v3', [
            'categories' => ArticleCategory::withCount('subCategories')
                ->with(['brands' => function($query) {
                    $query->withCount('subCategories');
                }])
                ->get(),
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

        $type = ArticleType::firstOrCreate([
            'article_sub_category_id' => $request->article_sub_category_id,
            'name' => $request->name,
        ], [
            'publisher' => $request->publisher,
        ]);

        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Type ajouté',
                'type' => [
                    'id' => $type->id,
                    'name' => $type->name,
                    'consoles_count' => 0
                ]
            ]);
        }

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
     * Créer automatiquement une marque (AJAX pour taxonomie automatique)
     */
    public function autoCreateBrand(Request $request)
    {
        $request->validate([
            'article_category_id' => 'required|exists:article_categories,id',
            'name' => 'required|string|max:255',
        ]);

        $brand = ArticleBrand::firstOrCreate([
            'article_category_id' => $request->article_category_id,
            'name' => $request->name,
        ]);

        return response()->json([
            'success' => true,
            'brand' => [
                'id' => $brand->id,
                'name' => $brand->name,
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
            
            // Déterminer la région selon la lettre du code du jeu (avant le suffixe final)
            // Format ROM ID: DMG-XXXL-N où L = lettre de région, N = numéro de version
            $region = null;
            
            // Extraire la partie du code jeu (entre DMG- et le suffixe final)
            if (preg_match('/^[A-Z]+-([A-Z0-9]+)-([\w]+)$/i', $romId, $matches)) {
                $gameCode = $matches[1]; // Ex: "A1J", "OBE", "A2BE"
                $suffix = $matches[2];    // Ex: "0", "USA", "JPN"
                
                // Cas spéciaux avec suffixe explicite
                if (in_array(strtoupper($suffix), ['USA', 'CAN'])) {
                    $region = 'NTSC-U';
                } elseif (in_array(strtoupper($suffix), ['JPN', 'JAP'])) {
                    $region = 'NTSC-J';
                } elseif (in_array(strtoupper($suffix), ['EUR', 'PAL', 'FRA', 'GER', 'ITA', 'SPA', 'UK', 'NOE'])) {
                    $region = 'PAL';
                }
                // Sinon, détecter par la lettre du code du jeu
                else {
                    $lastLetter = strtoupper(substr($gameCode, -1));
                    
                    if ($lastLetter === 'J') {
                        $region = 'NTSC-J'; // Japon
                    } elseif ($lastLetter === 'E') {
                        $region = 'PAL'; // Europe
                    } elseif ($lastLetter === 'P') {
                        $region = 'PAL'; // PAL/Europe
                    } elseif ($lastLetter === 'U' || $lastLetter === 'A') {
                        $region = 'NTSC-U'; // USA
                    }
                    // Vérifier aussi l'avant-dernière lettre si la dernière est un chiffre
                    elseif (is_numeric($lastLetter) && strlen($gameCode) >= 2) {
                        $secondLastLetter = strtoupper(substr($gameCode, -2, 1));
                        if ($secondLastLetter === 'J') {
                            $region = 'NTSC-J';
                        } elseif ($secondLastLetter === 'E') {
                            $region = 'PAL';
                        } elseif ($secondLastLetter === 'P') {
                            $region = 'PAL';
                        } elseif ($secondLastLetter === 'U' || $secondLastLetter === 'A') {
                            $region = 'NTSC-U';
                        }
                    }
                }
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
            ->withCount('subCategories')
            ->orderBy('name')
            ->get();

        if (request()->wantsJson() || request()->header('Accept') === 'application/json') {
            return response()->json([
                'brands' => $brands->map(function($brand) {
                    return [
                        'id' => $brand->id,
                        'name' => $brand->name,
                        'sub_categories_count' => $brand->sub_categories_count ?? 0
                    ];
                })
            ]);
        }

        // Support ancien format HTML (autocomplete)
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
            ->withCount('types')
            ->orderBy('name')
            ->get();

        if (request()->wantsJson() || request()->header('Accept') === 'application/json') {
            return response()->json([
                'subcategories' => $subCategories->map(function($sub) {
                    return [
                        'id' => $sub->id,
                        'name' => $sub->name,
                        'types_count' => $sub->types_count ?? 0
                    ];
                })
            ]);
        }

        // Support ancien format HTML (autocomplete)
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
            ->withCount('consoles')
            ->orderBy('name')
            ->get();

        // Si la requête demande du JSON, retourner du JSON
        if (request()->wantsJson() || request()->header('Accept') === 'application/json') {
            return response()->json($types->map(function($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name,
                    'consoles_count' => $type->consoles_count ?? 0
                ];
            }));
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

    if (request()->wantsJson() || request()->ajax()) {
        return response()->json(['success' => true, 'message' => 'Sous-catégorie mise à jour.']);
    }

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

    if (request()->wantsJson() || request()->ajax()) {
        return response()->json(['success' => true, 'message' => 'Type mis à jour.']);
    }

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
    // Vérifier si des consoles utilisent ce type
    if ($type->consoles()->count() > 0) {
        if (request()->wantsJson() || request()->ajax()) {
            return response()->json([
                'error' => 'Impossible de supprimer ce type car il est utilisé par ' . $type->consoles()->count() . ' article(s).'
            ], 422);
        }
        return back()->with('error', 'Impossible de supprimer ce type car il est utilisé par ' . $type->consoles()->count() . ' article(s).');
    }

    $type->delete();

    if (request()->wantsJson() || request()->ajax()) {
        return response()->json(['success' => true, 'message' => 'Type supprimé.']);
    }

    return back()->with('success', 'Type supprimé.');
}

    /* =====================================================
     | AJAX — description du type
     ===================================================== */
    public function ajaxTypeDescription(ArticleType $type)
    {
        // Convertir les chemins relatifs en URLs R2 complètes
        $r2Url = config('filesystems.disks.r2.url');
        
        $coverImage = $type->cover_image;
        $artworkImage = $type->artwork_image;
        $gameplayImage = $type->gameplay_image;
        $logoImage = $type->logo_image ?? null;
        
        // Si les images commencent par /images/, les convertir en URLs R2
        if ($coverImage && str_starts_with($coverImage, '/images/')) {
            $coverImage = $r2Url . '/' . ltrim($coverImage, '/');
        }
        if ($artworkImage && str_starts_with($artworkImage, '/images/')) {
            $artworkImage = $r2Url . '/' . ltrim($artworkImage, '/');
        }
        if ($gameplayImage && str_starts_with($gameplayImage, '/images/')) {
            $gameplayImage = $r2Url . '/' . ltrim($gameplayImage, '/');
        }
        if ($logoImage && str_starts_with($logoImage, '/images/')) {
            $logoImage = $r2Url . '/' . ltrim($logoImage, '/');
        }
        
        return response()->json([
            'description' => $type->description ?? '',
            'publisher' => $type->publisher ?? '',
            'cover_image' => $coverImage,
            'artwork_image' => $artworkImage,
            'gameplay_image' => $gameplayImage,
            'logo_image' => $logoImage,
        ]);
    }

    /* =====================================================
     | AJAX — Images des articles du même type
     ===================================================== */
    public function getArticleTypeImages($typeId)
    {
        try {
            // Récupérer le type d'article
            $articleType = \App\Models\ArticleType::find($typeId);
            
            if (!$articleType) {
                return response()->json([
                    'success' => false,
                    'images' => [],
                    'count' => 0,
                    'message' => 'Type d\'article introuvable'
                ]);
            }

            $allImages = [];

            // Ajouter cover_image si elle existe
            if (!empty($articleType->cover_image)) {
                $allImages[] = $articleType->cover_image;
            }

            // Ajouter artwork_image si elle existe
            if (!empty($articleType->artwork_image)) {
                $allImages[] = $articleType->artwork_image;
            }

            // Ajouter gameplay_image si elle existe
            if (!empty($articleType->gameplay_image)) {
                $allImages[] = $articleType->gameplay_image;
            }

            // Ajouter les images du tableau JSON si elles existent
            if (!empty($articleType->images)) {
                $images = is_string($articleType->images) 
                    ? json_decode($articleType->images, true) 
                    : $articleType->images;

                if (is_array($images)) {
                    foreach ($images as $imageUrl) {
                        // Éviter les doublons
                        if (!in_array($imageUrl, $allImages)) {
                            $allImages[] = $imageUrl;
                        }
                    }
                }
            }

            \Log::info('Images du type d\'article récupérées', [
                'type_id' => $typeId,
                'count' => count($allImages)
            ]);

            return response()->json([
                'success' => true,
                'images' => $allImages,
                'count' => count($allImages)
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur getArticleTypeImages: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'images' => [],
                'count' => 0,
                'message' => 'Erreur lors de la récupération des images'
            ], 500);
        }
    }

    /* =====================================================
     | GET TAXONOMY IMAGES - Récupère toutes les images d'un jeu
     | COMPATIBLE LOCAL + CLOUDINARY (Railway)
     ===================================================== */
    public function getTaxonomyImages(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'folder' => 'required|string',
        ]);

        $identifier = $request->identifier;
        $folder = $request->folder;
        $basePath = public_path("images/taxonomy/{$folder}");
        $r2Url = config('filesystems.disks.r2.url');

        $images = [];
        $seenFilenames = []; // Éviter les doublons

        // Mode LOCAL : lire depuis public/images/taxonomy/
        if (file_exists($basePath)) {
            $pattern = "{$basePath}/{$identifier}-*.png";
            $files = glob($pattern);
            
            foreach ($files as $file) {
                $filename = basename($file);
                $fileSize = filesize($file);
                
                // Ignorer les fichiers vides/corrompus (< 100 octets)
                if ($fileSize < 100) {
                    continue;
                }
                
                // Extraire le type depuis le nom de fichier (ex: SNS-MK-cover.png -> cover)
                if (preg_match('/^' . preg_quote($identifier, '/') . '-(.+)\.png$/i', $filename, $matches)) {
                    $fullType = $matches[1]; // Ex: "cover", "cover-2", "artwork-3", etc.
                    
                    // Séparer le type de base et l'index
                    if (preg_match('/^(cover|artwork|gameplay|logo)(-\d+)?$/i', $fullType, $typeMatches)) {
                        $baseType = $typeMatches[1];
                        $index = isset($typeMatches[2]) ? (int)str_replace('-', '', $typeMatches[2]) : 1;
                        
                        // En production: URL R2 directe, sinon proxy
                        if (app()->environment('production')) {
                            $r2PublicUrl = config('filesystems.disks.r2.url');
                            $imageUrl = $r2PublicUrl . "/taxonomy/{$folder}/{$filename}";
                        } else {
                            $imageUrl = route('proxy.taxonomy-image', [
                                'folder' => $folder,
                                'filename' => $filename
                            ]);
                        }
                        
                        $images[] = [
                            'filename' => $filename,
                            'path' => "images/taxonomy/{$folder}/{$filename}",
                            'url' => $imageUrl,
                            'type' => $baseType,
                            'full_type' => $fullType,
                            'index' => $index,
                            'size' => $fileSize,
                            'source' => 'local'
                        ];
                        
                        $seenFilenames[$filename] = true;
                    }
                }
            }
        }
        
        // Mode R2 (Production/Railway) : lister directement depuis R2
        if (empty($images) || app()->environment('production')) {
            try {
                $r2Path = "taxonomy/{$folder}/";
                $files = \Storage::disk('r2')->files($r2Path);
                
                foreach ($files as $filePath) {
                    $filename = basename($filePath);
                    
                    // Vérifier si correspond à l'identifier
                    if (preg_match('/^' . preg_quote($identifier, '/') . '-(.+)\.(png|jpg|jpeg)$/i', $filename, $matches)) {
                        // Éviter les doublons si déjà dans les images locales
                        if (isset($seenFilenames[$filename])) {
                            continue;
                        }
                        
                        $fullType = $matches[1];
                        
                        if (preg_match('/^(cover|artwork|gameplay|logo)(-\d+)?$/i', $fullType, $typeMatches)) {
                            $baseType = $typeMatches[1];
                            $index = isset($typeMatches[2]) ? (int)str_replace('-', '', $typeMatches[2]) : 1;
                            
                            // En production: URL R2 directe, sinon proxy
                            if (app()->environment('production')) {
                                $r2PublicUrl = config('filesystems.disks.r2.url');
                                $imageUrl = $r2PublicUrl . "/taxonomy/{$folder}/{$filename}";
                            } else {
                                $imageUrl = route('proxy.taxonomy-image', [
                                    'folder' => $folder,
                                    'filename' => $filename
                                ]);
                            }
                            
                            // Essayer de récupérer la taille
                            $fileSize = 0;
                            try {
                                $fileSize = \Storage::disk('r2')->size($filePath);
                            } catch (\Exception $e) {
                                // Taille non disponible
                            }
                            
                            $images[] = [
                                'filename' => $filename,
                                'path' => $filePath,
                                'url' => $imageUrl,
                                'type' => $baseType,
                                'full_type' => $fullType,
                                'index' => $index,
                                'size' => $fileSize,
                                'source' => 'r2'
                            ];
                            
                            $seenFilenames[$filename] = true;
                        }
                    }
                }
            } catch (\Exception $e) {
                \Log::error("Erreur lecture R2: " . $e->getMessage());
            }
        }

        // Trier par type puis par index
        usort($images, function($a, $b) {
            $typeOrder = ['cover' => 1, 'logo' => 2, 'artwork' => 3, 'gameplay' => 4];
            $typeCompare = ($typeOrder[$a['type']] ?? 99) - ($typeOrder[$b['type']] ?? 99);
            if ($typeCompare !== 0) return $typeCompare;
            return $a['index'] - $b['index'];
        });

        return response()->json([
            'success' => true,
            'images' => $images,
            'total' => count($images)
        ]);
    }

    /* =====================================================
     | UPLOAD IMAGE DE TAXONOMIE
     | COMPATIBLE LOCAL + CLOUDINARY
     ===================================================== */
    public function uploadTaxonomyImage(Request $request)
    {
        $request->validate([
            'images.*' => 'required|image|max:10240', // 10MB max
            'identifier' => 'required|string',
            'folder' => 'required|string',
            'platform' => 'required|string',
            'type' => 'required|string|in:cover,logo,artwork,gameplay', // Type choisi par l'utilisateur
        ]);

        $identifier = $request->identifier;
        $folder = $request->folder;
        $type = $request->type;
        
        $uploadedCount = 0;
        $uploadedUrls = [];

        // Toujours uploader en double : local + R2
        foreach ($request->file('images') as $file) {
            try {
                // 1. Upload LOCAL (pour développement)
                $basePath = public_path("images/taxonomy/{$folder}");
                
                if (!file_exists($basePath)) {
                    mkdir($basePath, 0755, true);
                }
                
                $filename = "{$identifier}-{$type}.png";
                $targetPath = "{$basePath}/{$filename}";
                
                // Si fichier existe, incrémenter
                if (file_exists($targetPath)) {
                    $counter = 2;
                    while (file_exists("{$basePath}/{$identifier}-{$type}-{$counter}.png")) {
                        $counter++;
                    }
                    $filename = "{$identifier}-{$type}-{$counter}.png";
                    $targetPath = "{$basePath}/{$filename}";
                }

                $file->move($basePath, $filename);
                
                // 2. Upload R2 (pour production Railway)
                try {
                    $r2Path = "taxonomy/{$folder}/{$filename}";
                    \Storage::disk('r2')->put(
                        $r2Path,
                        file_get_contents($targetPath),
                        'public'
                    );
                    $uploadedUrls[] = config('filesystems.disks.r2.url') . '/' . $r2Path;
                } catch (\Exception $e) {
                    \Log::warning("Erreur upload R2 (image locale sauvegardée): " . $e->getMessage());
                }
                
                $uploadedCount++;
            } catch (\Exception $e) {
                \Log::error("Erreur upload image: " . $e->getMessage());
            }
        }

        return response()->json([
            'success' => true,
            'message' => "{$uploadedCount} image(s) {$type} uploadée(s) avec succès",
            'urls' => $uploadedUrls,
            'mode' => 'dual' // Local + R2
        ]);
    }

    /* =====================================================
     | RENAME IMAGE DE TAXONOMIE
     ===================================================== */
    public function renameTaxonomyImage(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'folder' => 'required|string',
            'old_type' => 'required|string',
            'new_type' => 'required|string',
        ]);

        $identifier = $request->identifier;
        $folder = $request->folder;
        $oldType = $request->old_type;
        $newType = $request->new_type;

        // Chemins R2
        $r2OldPath = "taxonomy/{$folder}/{$identifier}-{$oldType}.png";
        $r2NewPath = "taxonomy/{$folder}/{$identifier}-{$newType}.png";

        // Chemins locaux
        $basePath = public_path("images/taxonomy/{$folder}");
        $oldPath = "{$basePath}/{$identifier}-{$oldType}.png";
        $newPath = "{$basePath}/{$identifier}-{$newType}.png";

        // Vérifier l'existence sur R2 en priorité, sinon local
        $existsOnR2 = \Storage::disk('r2')->exists($r2OldPath);
        $existsLocally = file_exists($oldPath);

        if (!$existsOnR2 && !$existsLocally) {
            return response()->json([
                'success' => false,
                'message' => "L'image source n'existe pas"
            ], 404);
        }

        // Si la cible existe déjà sur R2, créer un backup avec index
        $finalNewType = $newType;
        if ($existsOnR2 && \Storage::disk('r2')->exists($r2NewPath)) {
            $counter = 2;
            while (\Storage::disk('r2')->exists("taxonomy/{$folder}/{$identifier}-{$newType}-{$counter}.png")) {
                $counter++;
            }
            $finalNewType = "{$newType}-{$counter}";
            $r2NewPath = "taxonomy/{$folder}/{$identifier}-{$finalNewType}.png";
        }

        // Renommer sur R2 (copier puis supprimer l'ancien)
        if ($existsOnR2) {
            try {
                \Storage::disk('r2')->copy($r2OldPath, $r2NewPath);
                \Storage::disk('r2')->delete($r2OldPath);
            } catch (\Exception $e) {
                \Log::error("Erreur renommage R2: " . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => "Erreur lors du renommage sur R2: " . $e->getMessage()
                ], 500);
            }
        }

        // Renommer localement si le fichier existe
        if ($existsLocally) {
            $localNewPath = "{$basePath}/{$identifier}-{$finalNewType}.png";
            
            if (!file_exists($basePath)) {
                mkdir($basePath, 0755, true);
            }
            
            if (file_exists($localNewPath)) {
                $counter = 2;
                while (file_exists("{$basePath}/{$identifier}-{$finalNewType}-{$counter}.png")) {
                    $counter++;
                }
                $localNewPath = "{$basePath}/{$identifier}-{$finalNewType}-{$counter}.png";
            }
            
            rename($oldPath, $localNewPath);
        }

        return response()->json([
            'success' => true,
            'message' => "Image renommée de '{$oldType}' vers '{$finalNewType}'"
        ]);
    }

    /* =====================================================
     | SET PRIMARY IMAGE (DÉFINIR COMME PRINCIPALE)
     ===================================================== */
    public function setPrimaryImage(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'folder' => 'required|string',
            'current_type' => 'required|string', // Ex: "cover-2"
            'base_type' => 'required|string',    // Ex: "cover"
        ]);

        $identifier = $request->identifier;
        $folder = $request->folder;
        $currentType = $request->current_type; // Ex: "cover-2"
        $baseType = $request->base_type;       // Ex: "cover"

        // Chemins R2
        $r2CurrentPath = "taxonomy/{$folder}/{$identifier}-{$currentType}.png";
        $r2PrimaryPath = "taxonomy/{$folder}/{$identifier}-{$baseType}.png";

        // Chemins locaux
        $basePath = public_path("images/taxonomy/{$folder}");
        $currentPath = "{$basePath}/{$identifier}-{$currentType}.png";
        $primaryPath = "{$basePath}/{$identifier}-{$baseType}.png";

        // Vérifier que l'image source existe
        $existsOnR2 = \Storage::disk('r2')->exists($r2CurrentPath);
        $existsLocally = file_exists($currentPath);

        if (!$existsOnR2 && !$existsLocally) {
            return response()->json([
                'success' => false,
                'message' => "L'image '{$currentType}' n'existe pas"
            ], 404);
        }

        // Opérations sur R2
        if ($existsOnR2) {
            try {
                // Si l'image principale existe déjà sur R2, la renommer en -2, -3, etc.
                if (\Storage::disk('r2')->exists($r2PrimaryPath)) {
                    $counter = 2;
                    while (\Storage::disk('r2')->exists("taxonomy/{$folder}/{$identifier}-{$baseType}-{$counter}.png")) {
                        $counter++;
                    }
                    $r2OldPrimaryNewPath = "taxonomy/{$folder}/{$identifier}-{$baseType}-{$counter}.png";
                    \Storage::disk('r2')->copy($r2PrimaryPath, $r2OldPrimaryNewPath);
                    \Storage::disk('r2')->delete($r2PrimaryPath);
                }

                // Renommer l'image sélectionnée comme principale
                \Storage::disk('r2')->copy($r2CurrentPath, $r2PrimaryPath);
                \Storage::disk('r2')->delete($r2CurrentPath);
            } catch (\Exception $e) {
                \Log::error("Erreur setPrimaryImage R2: " . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => "Erreur lors du changement d'image principale sur R2: " . $e->getMessage()
                ], 500);
            }
        }

        // Opérations locales
        if ($existsLocally) {
            if (!file_exists($basePath)) {
                mkdir($basePath, 0755, true);
            }

            // Si l'image principale existe déjà, la renommer en -2, -3, etc.
            if (file_exists($primaryPath)) {
                $counter = 2;
                while (file_exists("{$basePath}/{$identifier}-{$baseType}-{$counter}.png")) {
                    $counter++;
                }
                $oldPrimaryNewPath = "{$basePath}/{$identifier}-{$baseType}-{$counter}.png";
                rename($primaryPath, $oldPrimaryNewPath);
            }

            // Renommer l'image sélectionnée comme principale
            rename($currentPath, $primaryPath);
        }

        return response()->json([
            'success' => true,
            'message' => "'{$currentType}' est maintenant l'image principale '{$baseType}'"
        ]);
    }

    /* =====================================================
     | DELETE IMAGE DE TAXONOMIE
     | COMPATIBLE LOCAL + CLOUDINARY
     ===================================================== */
    public function deleteTaxonomyImage(Request $request)
    {
        $request->validate([
            'identifier' => 'required|string',
            'folder' => 'required|string',
            'type' => 'required|string',
        ]);

        $identifier = $request->identifier;
        $folder = $request->folder;
        $type = $request->type;

        // Chemins R2 et local
        $r2Path = "taxonomy/{$folder}/{$identifier}-{$type}.png";
        $basePath = public_path("images/taxonomy/{$folder}");
        $localPath = "{$basePath}/{$identifier}-{$type}.png";

        // Vérifier l'existence sur R2 et en local
        $existsOnR2 = Storage::disk('r2')->exists($r2Path);
        $existsLocally = file_exists($localPath);

        if (!$existsOnR2 && !$existsLocally) {
            return response()->json([
                'success' => false,
                'message' => "L'image n'existe pas"
            ], 404);
        }

        // Supprimer de R2 si présent
        if ($existsOnR2) {
            try {
                Storage::disk('r2')->delete($r2Path);
            } catch (\Exception $e) {
                \Log::error("Erreur suppression R2: " . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => "Erreur lors de la suppression sur R2: " . $e->getMessage()
                ], 500);
            }
        }

        // Supprimer en local si présent
        if ($existsLocally) {
            unlink($localPath);
        }

        return response()->json([
            'success' => true,
            'message' => "Image '{$type}' supprimée avec succès"
        ]);
    }

    /* =====================================================
     | AJAX — Chargement paginé de TOUS les types (nouvelle interface)
     ===================================================== */
    public function ajaxAllTypes(Request $request)
    {
        $perPage = $request->input('per_page', 50);
        $search = $request->input('search', '');

        $query = ArticleType::with('subCategory:id,name');

        if ($search) {
            $query->where('name', 'like', "%{$search}%");
        }

        $types = $query->orderBy('name')->paginate($perPage);

        return response()->json([
            'types' => $types->map(function($type) {
                return [
                    'id' => $type->id,
                    'name' => $type->name,
                    'sub_category_name' => $type->subCategory->name ?? ''
                ];
            }),
            'current_page' => $types->currentPage(),
            'last_page' => $types->lastPage(),
            'from' => $types->firstItem(),
            'to' => $types->lastItem(),
            'total' => $types->total()
        ]);
    }
    
}
