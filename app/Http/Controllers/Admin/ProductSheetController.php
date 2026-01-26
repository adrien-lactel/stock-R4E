<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductSheet;
use App\Models\GameBoyGame;
use App\Models\ArticleCategory;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;
use App\Models\Mod;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

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
        $mods = Mod::orderBy('name')->get();
        $selectedType = null;
        $selectedSubCategory = null;
        $selectedBrand = null;
        $selectedCategory = null;

        // Si un article_type_id est fourni, charger toute la taxonomie
        if ($request->has('article_type_id')) {
            $selectedType = ArticleType::with(['subCategory.brand.category'])
                ->find($request->article_type_id);
            
            if ($selectedType) {
                $selectedSubCategory = $selectedType->subCategory()->with('types')->first();
                $selectedBrand = $selectedSubCategory?->brand()->with('subCategories')->first();
                $selectedCategory = $selectedBrand?->category()->with('brands')->first();
            }
        }

        return view('admin.product-sheets.create', [
            'sheet' => new ProductSheet(),
            'categories' => $categories,
            'mods' => $mods,
            'selectedCategory' => $selectedCategory,
            'selectedBrand' => $selectedBrand,
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
                'image' => 'required|file|mimes:jpeg,png,jpg,gif,webp,avif|max:10240', // Max 10MB
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
                'size_mb' => round($file->getSize() / 1024 / 1024, 2),
                'mime' => $file->getMimeType(),
            ]);
            
            // Vérifier la taille (10MB max)
            if ($file->getSize() > 10 * 1024 * 1024) {
                return response()->json([
                    'success' => false,
                    'message' => 'Le fichier est trop volumineux (' . round($file->getSize() / 1024 / 1024, 2) . ' MB). Maximum autorisé : 10 MB.'
                ], 413);
            }
            
            // Upload vers Cloudinary via Storage disk dans R4E/products/images
            $path = Storage::disk('cloudinary')->putFileAs(
                'R4E/products/images',
                $file,
                Str::random(40) . '.' . $file->getClientOriginalExtension(),
                'public'
            );
            
            // Récupérer l'URL complète
            $uploadedFileUrl = Storage::disk('cloudinary')->url($path);

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
        \Log::info('uploadFromUrl appelée', ['url' => $request->input('url')]);
        
        $request->validate([
            'url' => 'required|url',
            'rom_id' => 'nullable|string',
        ]);

        try {
            $imageUrl = $request->input('url');
            $romId = $request->input('rom_id');
            
            // Si c'est une URL Cloudinary, la retourner directement
            if (str_contains($imageUrl, 'cloudinary.com')) {
                return response()->json([
                    'success' => true,
                    'url' => $imageUrl,
                    'path' => $imageUrl,
                    'cached' => true,
                ]);
            }
            
            \Log::info('Téléchargement image depuis URL', ['url' => $imageUrl, 'rom_id' => $romId]);
            
            // Ajouter un délai aléatoire pour éviter le rate limiting (1-3 secondes)
            usleep(rand(1000000, 3000000)); // 1-3 secondes
            
            // Utiliser cURL avec des headers pour éviter le blocage anti-scraping
            $ch = curl_init($imageUrl);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36');
            curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Accept: image/avif,image/webp,image/apng,image/svg+xml,image/*,*/*;q=0.8',
                'Accept-Language: fr-FR,fr;q=0.9,en-US;q=0.8,en;q=0.7',
                'Referer: https://full-set.net/',
                'Cache-Control: no-cache',
            ]);
            curl_setopt($ch, CURLOPT_TIMEOUT, 30);
            
            $imageContent = curl_exec($ch);
            $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $error = curl_error($ch);
            curl_close($ch);
            
            if ($error) {
                throw new \Exception('Erreur cURL: ' . $error);
            }
            
            if ($httpCode === 429) {
                throw new \Exception('Rate limit atteint sur full-set.net. Veuillez réessayer dans quelques secondes.');
            }
            
            if ($httpCode !== 200) {
                throw new \Exception('HTTP ' . $httpCode . ' lors du téléchargement de l\'image');
            }
            
            if (!$imageContent || strlen($imageContent) < 100) {
                throw new \Exception('Image vide ou invalide (taille: ' . strlen($imageContent) . ' bytes)');
            }
            
            \Log::info('Image téléchargée', ['size' => strlen($imageContent), 'http_code' => $httpCode]);
            
            // Créer un fichier temporaire
            $tempFile = tempnam(sys_get_temp_dir(), 'rom_image_');
            file_put_contents($tempFile, $imageContent);
            
            $filename = Str::random(40) . '.jpg';
            
            // Upload vers Cloudinary
            $path = Storage::disk('cloudinary')->putFileAs(
                'R4E/products/images',
                new \Illuminate\Http\File($tempFile),
                $filename
            );
            
            // Supprimer le fichier temporaire
            @unlink($tempFile);
            
            $uploadedFileUrl = Storage::disk('cloudinary')->url($path);

            \Log::info('Image uploadée vers Cloudinary', ['url' => $uploadedFileUrl]);

            // Sauvegarder l'URL Cloudinary dans la BDD pour réutilisation (si la colonne existe)
            if ($romId) {
                try {
                    $game = GameBoyGame::where('rom_id', $romId)->first();
                    if ($game && Schema::hasColumn('game_boy_games', 'cloudinary_url')) {
                        $game->cloudinary_url = $uploadedFileUrl;
                        $game->save();
                        \Log::info('URL Cloudinary sauvegardée pour ROM', ['rom_id' => $romId]);
                    }
                } catch (\Exception $e) {
                    // Si la colonne n'existe pas, on ignore l'erreur et on continue
                    \Log::warning('Impossible de sauvegarder cloudinary_url', [
                        'rom_id' => $romId,
                        'error' => $e->getMessage()
                    ]);
                }
            }

            return response()->json([
                'success' => true,
                'url' => $uploadedFileUrl,
                'path' => $uploadedFileUrl,
            ]);
        } catch (\Exception $e) {
            \Log::error('Erreur uploadFromUrl', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
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

        $conditionCriteria = $request->input('condition_criteria');
        if (is_string($conditionCriteria)) {
            $request->merge(['condition_criteria' => json_decode($conditionCriteria, true) ?: []]);
        }

        $featuredMods = $request->input('featured_mods');
        if (is_string($featuredMods)) {
            $request->merge(['featured_mods' => json_decode($featuredMods, true) ?: []]);
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
            'featured_mods' => 'nullable|array',
            'is_active' => 'boolean',
        ]);

        $sheet = ProductSheet::create($data);

        // Si un console_id est fourni, lier la fiche à l'article
        if ($request->has('console_id')) {
            $console = \App\Models\Console::find($request->console_id);
            if ($console) {
                $console->product_sheet_id = $sheet->id;
                $console->save();
            }
        }

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

        // Vérifier si une console est associée à cette fiche
        $associatedConsole = \App\Models\Console::where('product_sheet_id', $productSheet->id)->first();
        
        // Si une console est associée, utiliser uniquement ses mods
        if ($associatedConsole) {
            $mods = $associatedConsole->mods()->orderBy('name')->get();
            $consoleMods = $mods->map(function($mod) {
                return [
                    'id' => $mod->id,
                    'name' => $mod->name,
                    'icon' => $mod->icon ?? '🔧'
                ];
            })->toArray();
            $productSheet->featured_mods = $consoleMods;
        } else {
            // Sinon, afficher tous les mods disponibles
            $mods = Mod::orderBy('name')->get();
        }

        return view('admin.product-sheets.edit', [
            'sheet' => $productSheet,
            'categories' => $categories,
            'mods' => $mods,
            'selectedCategory' => $selectedCategory,
            'selectedSubCategory' => $selectedSubCategory,
            'selectedType' => $selectedType,
            'associatedConsole' => $associatedConsole ?? null,
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

        $featuredMods = $request->input('featured_mods');
        if (is_string($featuredMods)) {
            $request->merge(['featured_mods' => json_decode($featuredMods, true) ?: []]);
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
            'featured_mods' => 'nullable|array',
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

        // Utiliser cloudinary_url si disponible, sinon image_url
        $imageUrl = $game->cloudinary_url ?: $game->image_url;

        return response()->json([
            'success' => true,
            'data' => [
                'name' => $game->name,
                'year' => $game->year,
                'image_url' => $imageUrl,
                'price' => $game->price,
                'rom_id' => $game->rom_id,
                'has_cloudinary' => !empty($game->cloudinary_url),
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
            ->get(['rom_id', 'name', 'year', 'image_url'])
            ->map(function($game) {
                return [
                    'rom_id' => $game->rom_id,
                    'label' => $game->rom_id . ' - ' . $game->name,
                    'name' => $game->name,
                    'year' => $game->year,
                    'image_url' => $game->image_url,
                ];
            });

        return response()->json($suggestions);
    }

    /* =====================================================
     | GET TAXONOMY IMAGES — Récupérer images existantes pour une taxonomie
     ===================================================== */
    public function getTaxonomyImages(Request $request)
    {
        $typeId = $request->get('article_type_id');
        
        if (!$typeId) {
            return response()->json([]);
        }
        
        // Récupérer toutes les fiches avec le même type
        $sheets = ProductSheet::where('article_type_id', $typeId)
            ->whereNotNull('images')
            ->get();
        
        $allImages = [];
        
        foreach ($sheets as $sheet) {
            $images = is_string($sheet->images) ? json_decode($sheet->images, true) : $sheet->images;
            if (is_array($images)) {
                foreach ($images as $img) {
                    $allImages[] = [
                        'url' => $img,
                        'sheet_id' => $sheet->id,
                        'sheet_name' => $sheet->name,
                    ];
                }
            }
        }
        
        return response()->json($allImages);
    }

    /* =====================================================
     | DUPLICATE — Dupliquer une fiche produit
     ===================================================== */
    public function duplicate(Request $request, $id)
    {
        $original = ProductSheet::findOrFail($id);
        
        // Créer une copie
        $duplicate = $original->replicate();
        $duplicate->name = $original->name . ' (Copie)';
        
        // Réinitialiser les champs propres à un article spécifique
        $duplicate->featured_mods = null;
        
        $duplicate->save();
        
        // Si un console_id est fourni, lier la fiche à l'article
        if ($request->has('console_id')) {
            $console = \App\Models\Console::find($request->console_id);
            if ($console) {
                $console->product_sheet_id = $duplicate->id;
                $console->save();
            }
        }
        
        return redirect()
            ->route('admin.product-sheets.edit', $duplicate->id)
            ->with('success', 'Fiche dupliquée avec succès ! Vous pouvez maintenant la modifier.');
    }

    /* =====================================================
     | IMAGES MANAGER — Gestion centralisée des images par taxonomie
     ===================================================== */
    public function imagesManager(Request $request)
    {
        $categories = ArticleCategory::with('subCategories.types')->orderBy('name')->get();
        
        $images = [];
        $selectedType = null;
        $showAll = $request->has('show_all') && $request->show_all == '1';
        
        if ($showAll) {
            // Afficher toutes les images de toutes les taxonomies (ProductSheet + ArticleType)
            
            // 1. Images des ProductSheets
            $sheets = ProductSheet::with(['articleType.subCategory.category'])->whereNotNull('images')->get();
            
            foreach ($sheets as $sheet) {
                $sheetImages = is_string($sheet->images) ? json_decode($sheet->images, true) : $sheet->images;
                if (is_array($sheetImages)) {
                    foreach ($sheetImages as $img) {
                        $images[] = [
                            'url' => $img,
                            'sheet_id' => $sheet->id,
                            'sheet_name' => $sheet->name,
                            'type_name' => $sheet->articleType->name ?? 'N/A',
                            'sub_category_name' => $sheet->articleType->subCategory->name ?? 'N/A',
                            'category_name' => $sheet->articleType->subCategory->category->name ?? 'N/A',
                            'source' => 'product_sheet',
                        ];
                    }
                }
            }
            
            // 2. Images des ArticleTypes
            $types = ArticleType::with(['subCategory.category'])->get();
            
            foreach ($types as $type) {
                // Images cover et gameplay
                if ($type->cover_image) {
                    $images[] = [
                        'url' => $type->cover_image,
                        'type_id' => $type->id,
                        'type_name' => $type->name,
                        'sub_category_name' => $type->subCategory->name ?? 'N/A',
                        'category_name' => $type->subCategory->category->name ?? 'N/A',
                        'source' => 'article_type_cover',
                        'label' => '🎮 Photo du jeu',
                    ];
                }
                if ($type->gameplay_image) {
                    $images[] = [
                        'url' => $type->gameplay_image,
                        'type_id' => $type->id,
                        'type_name' => $type->name,
                        'sub_category_name' => $type->subCategory->name ?? 'N/A',
                        'category_name' => $type->subCategory->category->name ?? 'N/A',
                        'source' => 'article_type_gameplay',
                        'label' => '🕹️ Gameplay',
                    ];
                }
                
                // Images génériques (array JSON)
                $typeImages = is_array($type->images) ? $type->images : [];
                foreach ($typeImages as $img) {
                    $images[] = [
                        'url' => $img,
                        'type_id' => $type->id,
                        'type_name' => $type->name,
                        'sub_category_name' => $type->subCategory->name ?? 'N/A',
                        'category_name' => $type->subCategory->category->name ?? 'N/A',
                        'source' => 'article_type',
                    ];
                }
            }
        } elseif ($request->has('article_type_id')) {
            $selectedType = ArticleType::with(['subCategory.category'])->find($request->article_type_id);
            
            // 1. Récupérer les images de l'ArticleType lui-même
            if ($selectedType) {
                // Images cover et gameplay (images spécifiques jeux vidéo)
                if ($selectedType->cover_image) {
                    $images[] = [
                        'url' => $selectedType->cover_image,
                        'type_id' => $selectedType->id,
                        'type_name' => $selectedType->name,
                        'source' => 'article_type_cover',
                        'label' => '🎮 Photo du jeu',
                    ];
                }
                if ($selectedType->gameplay_image) {
                    $images[] = [
                        'url' => $selectedType->gameplay_image,
                        'type_id' => $selectedType->id,
                        'type_name' => $selectedType->name,
                        'source' => 'article_type_gameplay',
                        'label' => '🕹️ Gameplay',
                    ];
                }
                
                // Images génériques (array JSON)
                if ($selectedType->images) {
                    $typeImages = is_array($selectedType->images) ? $selectedType->images : [];
                    foreach ($typeImages as $img) {
                        $images[] = [
                            'url' => $img,
                            'type_id' => $selectedType->id,
                            'type_name' => $selectedType->name,
                            'source' => 'article_type',
                        ];
                    }
                }
            }
            
            // 2. Récupérer toutes les images des ProductSheets de cette taxonomie
            $sheets = ProductSheet::where('article_type_id', $request->article_type_id)
                ->whereNotNull('images')
                ->get();
            
            foreach ($sheets as $sheet) {
                $sheetImages = is_string($sheet->images) ? json_decode($sheet->images, true) : $sheet->images;
                if (is_array($sheetImages)) {
                    foreach ($sheetImages as $img) {
                        $images[] = [
                            'url' => $img,
                            'sheet_id' => $sheet->id,
                            'sheet_name' => $sheet->name,
                            'source' => 'product_sheet',
                        ];
                    }
                }
            }
        }
        
        return view('admin.product-sheets.images-manager', compact('categories', 'images', 'selectedType', 'showAll'));
    }

    public function uploadTaxonomyImage(Request $request)
    {
        $request->validate([
            'article_type_id' => 'required|exists:article_types,id',
            'image' => 'required|file|mimes:jpeg,png,jpg,gif,webp,avif|max:10240',
        ]);

        try {
            $file = $request->file('image');
            $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
            
            $path = Storage::disk('cloudinary')->putFileAs(
                'R4E/products/images',
                $file,
                $filename
            );

            $url = Storage::disk('cloudinary')->url($path);

            // Créer ou mettre à jour une fiche "Template" pour cette taxonomie
            $type = ArticleType::find($request->article_type_id);
            $templateSheet = ProductSheet::firstOrCreate(
                [
                    'article_type_id' => $request->article_type_id,
                    'name' => 'Template - ' . $type->name,
                ],
                [
                    'description' => 'Fiche template pour la gestion centralisée des images',
                    'images' => [],
                    'is_active' => false, // Invisible pour les utilisateurs
                ]
            );

            // Ajouter l'image au template
            $images = $templateSheet->images ?? [];
            $images[] = $url;
            $templateSheet->images = $images;
            $templateSheet->save();

            return response()->json([
                'success' => true,
                'url' => $url,
                'message' => 'Image uploadée avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de l\'upload : ' . $e->getMessage()
            ], 500);
        }
    }

    public function deleteTaxonomyImage(Request $request)
    {
        $request->validate([
            'url' => 'required|url',
            'sheet_id' => 'required|exists:product_sheets,id',
        ]);

        try {
            $sheet = ProductSheet::find($request->sheet_id);
            $images = $sheet->images ?? [];
            
            // Retirer l'image
            $images = array_values(array_filter($images, function($img) use ($request) {
                return $img !== $request->url;
            }));
            
            $sheet->images = $images;
            $sheet->save();

            return response()->json([
                'success' => true,
                'message' => 'Image supprimée avec succès'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Erreur lors de la suppression : ' . $e->getMessage()
            ], 500);
        }
    }
}
