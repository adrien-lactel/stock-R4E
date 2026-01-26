<?php

namespace App\Services;

use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Image;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Illuminate\Support\Facades\Log;

/**
 * Service de reconnaissance d'image simplifié - MODE OCR SIMPLE
 * 
 * MÉMORISÉ: Version complète avec IA (logos, objets, labels) sauvegardée dans:
 * app/Services/ImageRecognitionService.BACKUP_FULL_IA.php
 * 
 * Pour restaurer l'IA complète:
 * 1. Copier BACKUP_FULL_IA.php vers ImageRecognitionService.php
 * 2. Réactiver les features: LABEL_DETECTION, LOGO_DETECTION, OBJECT_LOCALIZATION
 */
class ImageRecognitionService
{
    protected $client;

    public function __construct()
    {
        try {
            $this->client = new ImageAnnotatorClient([
                'credentials' => config('services.google_vision.credentials')
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur initialisation Google Vision: ' . $e->getMessage());
            $this->client = null;
        }
    }

    /**
     * Analyser une image pour reconnaître un article de gaming (MODE OCR SIMPLE)
     */
    public function analyzeGamingProduct($imagePath)
    {
        if (!$this->client) {
            return [
                'success' => false,
                'message' => 'Service Google Vision non disponible'
            ];
        }

        try {
            // Charger l'image
            $imageContent = file_get_contents($imagePath);
            $image = new Image();
            $image->setContent($imageContent);

            // MODE OCR SIMPLE - Uniquement détection de texte
            $features = [(new Feature())->setType(Type::TEXT_DETECTION)];

            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeatures($features);

            $batchRequest = new BatchAnnotateImagesRequest();
            $batchRequest->setRequests([$request]);

            $response = $this->client->batchAnnotateImages($batchRequest);
            $imageResponse = $response->getResponses()[0];

            $result = [
                'success' => true,
                'text' => $this->extractText($imageResponse->getTextAnnotations()),
                'suggestions' => []
            ];

            $result['suggestions'] = $this->generateSuggestions($result);

            return $result;

        } catch (\Exception $e) {
            Log::error('Erreur analyse image: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Erreur lors de l\'analyse: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Extraire le texte de l'image (OCR)
     */
    protected function extractText($annotations)
    {
        $texts = [];
        foreach ($annotations as $text) {
            $rawText = $text->getDescription();
            $texts[] = $rawText;
            
            // Ajouter version nettoyée pour améliorer détection ROM IDs
            $cleaned = $this->cleanTextForRomId($rawText);
            if ($cleaned !== $rawText) {
                $texts[] = $cleaned;
            }
        }
        return $texts;
    }

    /**
     * Nettoyer le texte pour améliorer la détection des ROM IDs
     */
    protected function cleanTextForRomId($text)
    {
        $text = strtoupper($text);
        
        $corrections = [
            '/\b0MG\b/i' => 'DMG',
            '/\bOMG\b/i' => 'DMG',
            '/\bD[Il1]G\b/i' => 'DMG',
            '/\bCG[B8]\b/i' => 'CGB',
            '/\bC[CG][B8]\b/i' => 'CGB',
            '/\bA[CG][B8]\b/i' => 'AGB',
            '/\bAGR\b/i' => 'AGB',
            '/\s{2,}/' => ' ',
            '/\b(DMG|CGB|AGB)[\s]*-[\s]*([A-Z0-9]{3,4})[\s]*-?[\s]*([A-Z0-9]{1,3})\b/i' => '$1-$2-$3',
        ];
        
        foreach ($corrections as $pattern => $replacement) {
            $text = preg_replace($pattern, $replacement, $text);
        }
        
        return $text;
    }

    /**
     * Générer des suggestions basées sur l'OCR
     */
    protected function generateSuggestions($analysisResult)
    {
        $suggestions = [
            'category' => null,
            'brand' => null,
            'sub_category' => null,
            'type' => null,
            'region' => null,
            'completeness' => null,
            'rom_id' => null,
            'name' => null,
            'publisher' => null,
        ];

        $fullText = implode(' ', $analysisResult['text']);
        
        Log::info('🔍 Texte OCR détecté', [
            'length' => strlen($fullText),
            'preview' => substr($fullText, 0, 200)
        ]);
        
        // Patterns ROM ID flexibles
        $patterns = [
            '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([0-3])\b/i',
            '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([A-Z]{3})\b/i',
            '/\b(DMG|CGB|AGB)([A-Z0-9]{3,4})([0-9A-Z]{3})\b/i',
            '/\b([A-Z]{3})[\s\-]?([A-Z0-9]{3,4})[\s\-]?([A-Z0-9]{3})\b/i',
        ];
        
        $romIdDetected = false;
        $gameFound = null;
        
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $fullText, $matches)) {
                $prefix = strtoupper($matches[1] ?? '');
                $gameCode = strtoupper($matches[2] ?? '');
                $region = strtoupper($matches[3] ?? '');
                $romId = "$prefix-$gameCode-$region";
                
                $suggestions['rom_id'] = $romId;
                $romIdDetected = true;
                $suggestions['category'] = 'Jeux vidéo';
                
                Log::info('🎮 ROM ID détecté', [
                    'texte_brut' => $matches[0],
                    'rom_id' => $romId
                ]);
                
                // Recherche dans la base
                $gameFound = \App\Models\GameBoyGame::where('rom_id', $romId)->first();
                
                // Fallback: essayer variantes numériques
                if (!$gameFound && preg_match('/-(JPN|EUR|USA|FRA|GER|ITA|SPA|UK|KOR|CHN)$/i', $romId)) {
                    for ($i = 0; $i <= 3; $i++) {
                        $altRomId = preg_replace('/-(JPN|EUR|USA|FRA|GER|ITA|SPA|UK|KOR|CHN)$/i', "-$i", $romId);
                        $gameFound = \App\Models\GameBoyGame::where('rom_id', $altRomId)->first();
                        if ($gameFound) {
                            $suggestions['rom_id'] = $altRomId;
                            $romId = $altRomId;
                            Log::info("✅ Jeu trouvé avec ROM ID alternatif: $altRomId");
                            break;
                        }
                    }
                }
                
                if ($gameFound) {
                    $suggestions['name'] = $gameFound->name;
                    $suggestions['brand'] = 'Nintendo';
                    $suggestions['publisher'] = 'Nintendo';
                    
                    if (str_starts_with($romId, 'DMG-')) {
                        $suggestions['sub_category'] = 'Game Boy';
                    } elseif (str_starts_with($romId, 'CGB-')) {
                        $suggestions['sub_category'] = 'Game Boy Color';
                    } elseif (str_starts_with($romId, 'AGB-')) {
                        $suggestions['sub_category'] = 'Game Boy Advance';
                    }
                    
                    // Chercher type existant
                    $gameType = \App\Models\ArticleType::where('name', 'LIKE', '%' . $gameFound->name . '%')
                        ->orWhere('name', $gameFound->name)
                        ->first();
                    
                    if ($gameType) {
                        $suggestions['type'] = $gameType->name;
                        $suggestions['type_id'] = $gameType->id;
                        $suggestions['type_exists'] = true;
                    } else {
                        $suggestions['type'] = $gameFound->name;
                        $suggestions['type_exists'] = false;
                        $suggestions['type_to_create'] = true;
                    }
                } else {
                    // ROM ID détecté mais pas en base
                    if (str_starts_with($romId, 'DMG-')) {
                        $suggestions['sub_category'] = 'Game Boy';
                        $suggestions['brand'] = 'Nintendo';
                        $suggestions['publisher'] = 'Nintendo';
                    } elseif (str_starts_with($romId, 'CGB-')) {
                        $suggestions['sub_category'] = 'Game Boy Color';
                        $suggestions['brand'] = 'Nintendo';
                        $suggestions['publisher'] = 'Nintendo';
                    } elseif (str_starts_with($romId, 'AGB-')) {
                        $suggestions['sub_category'] = 'Game Boy Advance';
                        $suggestions['brand'] = 'Nintendo';
                        $suggestions['publisher'] = 'Nintendo';
                    }
                }
                
                break;
            }
        }

        // Détection de région (multi-méthode)
        if ($romIdDetected) {
            $suggestions['region'] = $this->detectRegion($suggestions['rom_id'] ?? '', $fullText);
        }

        // Complétude
        if ($suggestions['category'] === 'Jeux vidéo' || $romIdDetected) {
            $suggestions['completeness'] = 'Loose';
        }

        return $suggestions;
    }

    /**
     * Détecter la région du jeu
     */
    protected function detectRegion($romId, $fullText)
    {
        // Méthode 1: ROM ID suffix
        if (preg_match('/-(EUR|PAL|FRA|GER|ITA|SPA|UK)/i', $romId)) {
            return 'PAL';
        }
        if (preg_match('/-(USA|CAN)/i', $romId)) {
            return 'NTSC-U';
        }
        if (preg_match('/-(JPN|JAP)/i', $romId)) {
            return 'NTSC-J';
        }

        // Méthode 2: Texte détecté
        $lowerText = strtolower($fullText);
        if (str_contains($lowerText, 'made in japan') || 
            preg_match('/[\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{4E00}-\x{9FFF}]/u', $fullText)) {
            return 'NTSC-J';
        }
        if (str_contains($lowerText, 'pal') || str_contains($lowerText, 'europe')) {
            return 'PAL';
        }
        if (str_contains($lowerText, 'ntsc')) {
            return 'NTSC-U';
        }

        return null;
    }
}
