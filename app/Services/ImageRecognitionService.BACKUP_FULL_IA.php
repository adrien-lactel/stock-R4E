<?php

namespace App\Services;

use Google\Cloud\Vision\V1\Client\ImageAnnotatorClient;
use Google\Cloud\Vision\V1\Image;
use Google\Cloud\Vision\V1\Feature;
use Google\Cloud\Vision\V1\Feature\Type;
use Google\Cloud\Vision\V1\AnnotateImageRequest;
use Google\Cloud\Vision\V1\BatchAnnotateImagesRequest;
use Illuminate\Support\Facades\Log;

class ImageRecognitionService
{
    protected $client;

    public function __construct()
    {
        try {
            // Initialiser le client Google Cloud Vision
            $this->client = new ImageAnnotatorClient([
                'credentials' => config('services.google_vision.credentials')
            ]);
        } catch (\Exception $e) {
            Log::error('Erreur initialisation Google Vision: ' . $e->getMessage());
            $this->client = null;
        }
    }

    /**
     * Analyser une image pour reconnaître un article de gaming
     * 
     * @param string $imagePath Chemin local de l'image ou URL
     * @return array Données extraites
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
            if (filter_var($imagePath, FILTER_VALIDATE_URL)) {
                $imageContent = file_get_contents($imagePath);
            } else {
                $imageContent = file_get_contents($imagePath);
            }

            $image = new Image();
            $image->setContent($imageContent);

            // MODE OCR SIMPLE - Uniquement détection de texte (rapide et économique)
            // MÉMORISÉ: Features IA complètes disponibles si besoin:
            // - Type::LABEL_DETECTION (labels/catégories)
            // - Type::LOGO_DETECTION (reconnaissance logos)
            // - Type::OBJECT_LOCALIZATION (détection objets)
            $features = [
                (new Feature())->setType(Type::TEXT_DETECTION),
            ];

            // Créer la requête d'annotation
            $request = new AnnotateImageRequest();
            $request->setImage($image);
            $request->setFeatures($features);

            // Créer la requête batch
            $batchRequest = new BatchAnnotateImagesRequest();
            $batchRequest->setRequests([$request]);

            // Effectuer l'analyse
            $response = $this->client->batchAnnotateImages($batchRequest);
            $imageResponse = $response->getResponses()[0];

            // Extraire les données (MODE OCR SIMPLE)
            $result = [
                'success' => true,
                'text' => $this->extractText($imageResponse->getTextAnnotations()),
                // MÉMORISÉ: Autres extractions IA disponibles si réactivées:
                // 'labels' => $this->extractLabels($imageResponse->getLabelAnnotations()),
                // 'logos' => $this->extractLogos($imageResponse->getLogoAnnotations()),
                // 'objects' => $this->extractObjects($imageResponse->getLocalizedObjectAnnotations()),
                'suggestions' => []
            ];

            // Analyser les résultats pour faire des suggestions
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
     * Extraire les labels de l'image
     */
    protected function extractLabels($annotations)
    {
        $labels = [];
        foreach ($annotations as $label) {
            $labels[] = [
                'description' => $label->getDescription(),
                'score' => $label->getScore(),
                'confidence' => round($label->getScore() * 100, 2)
            ];
        }
        return $labels;
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
            
            // Ajouter aussi une version nettoyée pour ROM IDs
            $cleaned = $this->cleanTextForRomId($rawText);
            if ($cleaned !== $rawText) {
                $texts[] = $cleaned;
            }
        }
        return $texts;
    }
    
    /**
     * Nettoyer le texte pour améliorer la détection des ROM IDs
     * Corrige les erreurs OCR courantes
     */
    protected function cleanTextForRomId($text)
    {
        // Convertir en majuscules
        $text = strtoupper($text);
        
        // Corrections OCR courantes SEULEMENT pour les préfixes en début de mot
        $corrections = [
            // Corrections de préfixes mal reconnus (DÉBUT DE MOT uniquement)
            '/\b0MG\b/i' => 'DMG',   // 0MG → DMG
            '/\bOMG\b/i' => 'DMG',   // OMG → DMG
            '/\bD[Il1]G\b/i' => 'DMG', // DlG, DIG → DMG
            
            '/\bCG[B8]\b/i' => 'CGB', // CG8 → CGB
            '/\bC[CG][B8]\b/i' => 'CGB', // CCB → CGB
            
            '/\bA[CG][B8]\b/i' => 'AGB', // ACB, AG8 → AGB
            '/\bAGR\b/i' => 'AGB',        // AGR → AGB
            
            // Nettoyer espaces multiples
            '/\s{2,}/' => ' ',
            
            // Gérer "DMG - APBJ - JPN" (espaces autour des tirets) → "DMG-APBJ-JPN"
            '/\b(DMG|CGB|AGB)[\s]*-[\s]*([A-Z0-9]{3,4})[\s]*-?[\s]*([A-Z0-9]{1,3})\b/i' => '$1-$2-$3',
        ];
        
        foreach ($corrections as $pattern => $replacement) {
            $text = preg_replace($pattern, $replacement, $text);
        }
        
        return $text;
    }

    /**
     * Extraire les logos détectés
     */
    protected function extractLogos($annotations)
    {
        $logos = [];
        foreach ($annotations as $logo) {
            $logos[] = [
                'description' => $logo->getDescription(),
                'score' => $logo->getScore(),
                'confidence' => round($logo->getScore() * 100, 2)
            ];
        }
        return $logos;
    }

    /**
     * Extraire les objets détectés
     */
    protected function extractObjects($annotations)
    {
        $objects = [];
        foreach ($annotations as $object) {
            $objects[] = [
                'name' => $object->getName(),
                'score' => $object->getScore(),
                'confidence' => round($object->getScore() * 100, 2)
            ];
        }
        return $objects;
    }

    /**
     * Générer des suggestions basées sur l'analyse OCR
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

        // MODE OCR SIMPLE: On se base uniquement sur le texte détecté
        // MÉMORISÉ: Code de détection par labels/logos/objets disponible si réactivé
        // (voir historique Git pour restaurer la détection de cartouche par objets/labels)

        // ===== PRIORITÉ 1 : DÉTECTER ROM ID EN PREMIER =====
        // Si un ROM ID est présent, c'est forcément un jeu vidéo, pas une console
        $fullText = implode(' ', $analysisResult['text']);
        
        Log::info('🔍 Texte complet détecté par OCR', [
            'length' => strlen($fullText),
            'preview' => substr($fullText, 0, 200)
        ]);
        
        // Patterns de ROM ID Game Boy (TRÈS FLEXIBLE pour gérer les erreurs OCR)
        // Accepte : tirets, espaces, absence de séparateurs, caractères mal reconnus (O vs 0, I vs 1, etc.)
        $patterns = [
            // Format avec révision numérique (DMG-APAJ-0, DMG-APSJ-1, etc.)
            '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([0-3])\b/i',
            
            // Format standard avec code région (DMG-APSJ-JPN, etc.)
            '/\b(DMG|CGB|AGB)[\s\-]?([A-Z0-9]{3,4})[\s\-]?([A-Z]{3})\b/i',
            
            // Format sans séparateurs (DMG APSJ JPN ou DMGAPSJJPN)
            '/\b(DMG|CGB|AGB)([A-Z0-9]{3,4})([0-9A-Z]{3})\b/i',
            
            // Format générique pour autres consoles (XXX-XXXX-XXX)
            '/\b([A-Z]{3})[\s\-]?([A-Z0-9]{3,4})[\s\-]?([A-Z0-9]{3})\b/i',
        ];
        
        $romIdDetected = false;
        $gameFound = null;
        
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $fullText, $matches)) {
                // Reconstruire le ROM ID normalisé au format standard DMG-XXXX-XXX
                // $matches[1] = préfixe (DMG/CGB/AGB), $matches[2] = code jeu, $matches[3] = région
                $prefix = strtoupper($matches[1] ?? '');
                $gameCode = strtoupper($matches[2] ?? '');
                $region = strtoupper($matches[3] ?? '');
                
                // Normaliser : toujours format DMG-XXXX-XXX avec tirets
                $romId = "$prefix-$gameCode-$region";
                
                $suggestions['rom_id'] = $romId;
                $romIdDetected = true;
                $isCartridge = true; // ROM ID = toujours une cartouche !
                
                // FORCER la catégorie Jeux vidéo
                $suggestions['category'] = 'Jeux vidéo';
                
                Log::info('🎮 ROM ID DÉTECTÉ (cartouche de jeu)', [
                    'texte_brut' => $matches[0],
                    'rom_id_normalized' => $romId,
                    'prefix' => $prefix,
                    'game_code' => $gameCode,
                    'region_code' => $region
                ]);
                
                // Chercher dans la base de données GameBoyGame
                $gameFound = \App\Models\GameBoyGame::where('rom_id', $romId)->first();
                
                // Si non trouvé et ROM ID se termine par un code région (JPN, EUR, USA, etc.)
                // essayer de remplacer par -0, -1, -2, -3 (format utilisé dans la base)
                if (!$gameFound && preg_match('/-(JPN|EUR|USA|FRA|GER|ITA|SPA|UK|KOR|CHN)$/i', $romId)) {
                    Log::info("ROM ID $romId non trouvé, essai avec variantes -0, -1, -2, -3");
                    
                    for ($i = 0; $i <= 3; $i++) {
                        $alternateRomId = preg_replace('/-(JPN|EUR|USA|FRA|GER|ITA|SPA|UK|KOR|CHN)$/i', "-$i", $romId);
                        $gameFound = \App\Models\GameBoyGame::where('rom_id', $alternateRomId)->first();
                        if ($gameFound) {
                            Log::info("Jeu trouvé avec ROM ID alternatif: $alternateRomId");
                            // Mettre à jour le ROM ID détecté avec celui trouvé
                            $suggestions['rom_id'] = $alternateRomId;
                            $romId = $alternateRomId;
                            break;
                        }
                    }
                }
                
                if ($gameFound) {
                    $suggestions['name'] = $gameFound->name;
                    $suggestions['brand'] = 'Nintendo';
                    $suggestions['publisher'] = 'Nintendo'; // Nintendo publie ses propres jeux Game Boy
                    
                    // Déterminer la sous-catégorie selon le préfixe
                    if (str_starts_with($romId, 'DMG-')) {
                        $suggestions['sub_category'] = 'Game Boy';
                    } elseif (str_starts_with($romId, 'CGB-')) {
                        $suggestions['sub_category'] = 'Game Boy Color';
                    } elseif (str_starts_with($romId, 'AGB-')) {
                        $suggestions['sub_category'] = 'Game Boy Advance';
                    }
                    
                    // ===== RECHERCHE DU TYPE PAR NOM DU JEU =====
                    // Chercher si un type existe déjà avec ce nom de jeu
                    $gameType = \App\Models\ArticleType::where('name', 'LIKE', '%' . $gameFound->name . '%')
                        ->orWhere('name', $gameFound->name)
                        ->first();
                    
                    if ($gameType) {
                        $suggestions['type'] = $gameType->name;
                        $suggestions['type_id'] = $gameType->id;
                        $suggestions['type_exists'] = true;
                        
                        Log::info('Type trouvé pour le jeu', [
                            'game' => $gameFound->name,
                            'type' => $gameType->name,
                            'type_id' => $gameType->id
                        ]);
                    } else {
                        // Type n'existe pas, proposer de le créer
                        $suggestions['type'] = $gameFound->name;
                        $suggestions['type_exists'] = false;
                        $suggestions['type_to_create'] = true;
                        
                        Log::info('Type non trouvé, création suggérée', [
                            'game' => $gameFound->name,
                            'suggested_type_name' => $gameFound->name
                        ]);
                    }
                    
                    Log::info('ROM ID trouvé dans la base', [
                        'rom_id' => $romId,
                        'game' => $gameFound->name
                    ]);
                } else {
                    // ROM ID détecté mais pas en base, déterminer quand même la sous-catégorie
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
                    
                    Log::info('ROM ID détecté mais non trouvé en base', [
                        'rom_id' => $romId
                    ]);
                }
                
                break; // ROM ID trouvé, sortir
            }
        }
        
        // ===== PRIORITÉ 1.5 : RECHERCHE PAR IMAGE/TEXTE SI PAS DE ROM ID OU ROM ID NON TROUVÉ =====
        // Analyser le texte et les labels pour chercher le nom du jeu
        if (!$gameFound) {
            // Combiner tous les textes détectés
            $detectedTexts = $analysisResult['text'];
            
            // Filtrer les textes courts et non pertinants
            $relevantTexts = array_filter($detectedTexts, function($text) {
                $text = trim($text);
                // Ignorer les textes trop courts, mais accepter les caractères japonais
                if (strlen($text) < 2) return false;
                // Accepter si contient des lettres latines OU des caractères japonais/asiatiques
                return preg_match('/[a-zA-Z]/', $text) || preg_match('/[\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{4E00}-\x{9FFF}]/u', $text);
            });
            
            // Rechercher dans la base de données par similarité de nom
            foreach ($relevantTexts as $text) {
                $text = trim($text);
                
                // Ignorer les textes qui ressemblent à des ROM IDs ou codes
                if (preg_match('/^[A-Z]{3}-[A-Z0-9]+-[0-9A-Z]+$/i', $text)) {
                    continue;
                }
                
                // Nettoyer le texte pour la recherche
                $searchText = str_replace(['™', '®', '©', ':', '-', '_'], ' ', $text);
                $searchText = trim($searchText);
                
                if (strlen($searchText) < 2) continue;
                
                // Recherche exacte d'abord (avec LIKE pour plus de flexibilité)
                $game = \App\Models\GameBoyGame::where('name', 'LIKE', '%' . $searchText . '%')
                    ->orWhere('name', 'LIKE', '%' . $text . '%')
                    ->first();
                
                if ($game) {
                    $suggestions['name'] = $game->name;
                    $suggestions['rom_id'] = $game->rom_id;
                    $suggestions['category'] = 'Jeux vidéo';
                    $suggestions['brand'] = 'Nintendo';
                    
                    // Déterminer la sous-catégorie selon le ROM ID
                    if (str_starts_with($game->rom_id, 'DMG-')) {
                        $suggestions['sub_category'] = 'Game Boy';
                    } elseif (str_starts_with($game->rom_id, 'CGB-')) {
                        $suggestions['sub_category'] = 'Game Boy Color';
                    } elseif (str_starts_with($game->rom_id, 'AGB-')) {
                        $suggestions['sub_category'] = 'Game Boy Advance';
                    }
                    
                    Log::info('Jeu trouvé par reconnaissance de texte', [
                        'text_detected' => $text,
                        'search_text' => $searchText,
                        'game' => $game->name,
                        'rom_id' => $game->rom_id,
                        'has_japanese' => preg_match('/[\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{4E00}-\x{9FFF}]/u', $text) ? 'yes' : 'no'
                    ]);
                    
                    $gameFound = $game;
                    break;
                }
            }
            
            // ===== PRIORITÉ 2 : RECHERCHE PAR LOGOS DÉTECTÉS (artwork de la cartouche) =====
            if (!$gameFound && !empty($analysisResult['logos'])) {
                foreach ($analysisResult['logos'] as $logo) {
                    $logoName = trim($logo['description']);
                    
                    if (strlen($logoName) < 2) continue;
                    
                    // Les logos sont souvent très précis (ex: "Pokémon", "Mario", "Zelda")
                    $game = \App\Models\GameBoyGame::where('name', 'LIKE', '%' . $logoName . '%')->first();
                    
                    if ($game) {
                        $suggestions['name'] = $game->name;
                        $suggestions['rom_id'] = $game->rom_id;
                        $suggestions['category'] = 'Jeux vidéo';
                        $suggestions['brand'] = 'Nintendo';
                        
                        if (str_starts_with($game->rom_id, 'DMG-')) {
                            $suggestions['sub_category'] = 'Game Boy';
                        } elseif (str_starts_with($game->rom_id, 'CGB-')) {
                            $suggestions['sub_category'] = 'Game Boy Color';
                        } elseif (str_starts_with($game->rom_id, 'AGB-')) {
                            $suggestions['sub_category'] = 'Game Boy Advance';
                        }
                        
                        Log::info('Jeu trouvé par reconnaissance de LOGO (artwork)', [
                            'logo_detected' => $logoName,
                            'confidence' => $logo['confidence'],
                            'game' => $game->name,
                            'rom_id' => $game->rom_id
                        ]);
                        
                        $gameFound = $game;
                        break;
                    }
                }
            }
            
            // ===== PRIORITÉ 3 : RECHERCHE PAR OBJETS DÉTECTÉS (personnages, éléments visuels) =====
            if (!$gameFound && !empty($analysisResult['objects'])) {
                foreach ($analysisResult['objects'] as $object) {
                    $objectName = trim($object['name']);
                    
                    if (strlen($objectName) < 3) continue;
                    
                    // Rechercher par nom d'objet (ex: "Pikachu", "Link", "Yoshi")
                    $game = \App\Models\GameBoyGame::where('name', 'LIKE', '%' . $objectName . '%')->first();
                    
                    if ($game) {
                        $suggestions['name'] = $game->name;
                        $suggestions['rom_id'] = $game->rom_id;
                        $suggestions['category'] = 'Jeux vidéo';
                        $suggestions['brand'] = 'Nintendo';
                        
                        if (str_starts_with($game->rom_id, 'DMG-')) {
                            $suggestions['sub_category'] = 'Game Boy';
                        } elseif (str_starts_with($game->rom_id, 'CGB-')) {
                            $suggestions['sub_category'] = 'Game Boy Color';
                        } elseif (str_starts_with($game->rom_id, 'AGB-')) {
                            $suggestions['sub_category'] = 'Game Boy Advance';
                        }
                        
                        Log::info('Jeu trouvé par reconnaissance d\'OBJET (personnage/élément)', [
                            'object_detected' => $objectName,
                            'confidence' => $object['confidence'],
                            'game' => $game->name,
                            'rom_id' => $game->rom_id
                        ]);
                        
                        $gameFound = $game;
                        break;
                    }
                }
            }
            
            // ===== PRIORITÉ 4 : RECHERCHE PAR LABELS (détection générale de l'artwork) =====
            if (!$gameFound) {
                // Trier les labels par score de confiance (les plus pertinents en premier)
                $sortedLabels = $analysisResult['labels'];
                usort($sortedLabels, function($a, $b) {
                    return $b['score'] <=> $a['score'];
                });
                
                foreach ($sortedLabels as $labelData) {
                    $label = trim($labelData['description']);
                    
                    // Ignorer les labels trop génériques ou courts
                    if (strlen($label) < 3) continue;
                    
                    // Ignorer les labels génériques courants
                    $genericLabels = ['Game', 'Cartridge', 'Console', 'Gaming', 'Video game', 'Electronics', 
                                     'Gadget', 'Technology', 'Font', 'Rectangle', 'Square', 'Logo'];
                    if (in_array($label, $genericLabels)) continue;
                    
                    // Ne chercher que si le score de confiance est suffisant (>40%)
                    if ($labelData['confidence'] < 40) continue;
                    
                    $game = \App\Models\GameBoyGame::where('name', 'LIKE', '%' . $label . '%')->first();
                    
                    if ($game) {
                        $suggestions['name'] = $game->name;
                        $suggestions['rom_id'] = $game->rom_id;
                        $suggestions['category'] = 'Jeux vidéo';
                        $suggestions['brand'] = 'Nintendo';
                        
                        if (str_starts_with($game->rom_id, 'DMG-')) {
                            $suggestions['sub_category'] = 'Game Boy';
                        } elseif (str_starts_with($game->rom_id, 'CGB-')) {
                            $suggestions['sub_category'] = 'Game Boy Color';
                        } elseif (str_starts_with($game->rom_id, 'AGB-')) {
                            $suggestions['sub_category'] = 'Game Boy Advance';
                        }
                        
                        Log::info('Jeu trouvé par reconnaissance de LABEL (artwork général)', [
                            'label_detected' => $label,
                            'confidence' => $labelData['confidence'],
                            'game' => $game->name,
                            'rom_id' => $game->rom_id
                        ]);
                        
                        $gameFound = $game;
                        break;
                    }
                }
            }
        }

        // ===== PRIORITÉ 2 : MARQUE (si pas déjà définie) =====
        if (!$suggestions['brand']) {
            $brandMapping = [
                'Nintendo' => ['nintendo', 'game boy', 'gameboy', 'nes', 'snes', 'n64', 'gamecube', 'wii'],
                'Sony' => ['sony', 'playstation', 'ps1', 'ps2', 'ps3', 'ps4', 'ps5', 'psp'],
                'Sega' => ['sega', 'genesis', 'mega drive', 'dreamcast', 'saturn'],
                'Microsoft' => ['microsoft', 'xbox'],
                'Atari' => ['atari'],
            ];

            foreach ($brandMapping as $brand => $keywords) {
                foreach ($allLabels as $label) {
                    foreach ($keywords as $keyword) {
                        if (stripos($label, $keyword) !== false) {
                            $suggestions['brand'] = $brand;
                            break 3;
                        }
                    }
                }
            }
        }

        // ===== PRIORITÉ 3 : CATÉGORIE (SI PAS DÉJÀ DÉFINIE PAR ROM ID OU CARTOUCHE) =====
        if (!$romIdDetected && !$isCartridge) {
            $consoleKeywords = ['game console', 'gaming console', 'video game console', 'handheld console'];
            $gameKeywords = ['video game', 'game disc'];
            $accessoryKeywords = ['controller', 'gamepad', 'joystick', 'cable', 'adapter'];

            foreach ($allLabels as $label) {
                $lowerLabel = strtolower($label);
                
                // Détecter les jeux vidéo (mais pas si c'est juste le logo Nintendo Game Boy qui indique la console)
                foreach ($gameKeywords as $keyword) {
                    if (stripos($lowerLabel, $keyword) !== false) {
                        $suggestions['category'] = 'Jeux vidéo';
                        break 2;
                    }
                }
            }
            
            // Déterminer la sous-catégorie si c'est une cartouche Game Boy
            if ($isCartridge) {
                // Chercher d'abord dans le texte détecté pour plus de précision
                $fullText = implode(' ', $analysisResult['text']);
                $lowerText = strtolower($fullText);
                
                if (str_contains($lowerText, 'game boy advance') || str_contains($lowerText, 'gameboy advance')) {
                    $suggestions['sub_category'] = 'Game Boy Advance';
                    $suggestions['brand'] = 'Nintendo';
                } elseif (str_contains($lowerText, 'game boy color') || str_contains($lowerText, 'gameboy color')) {
                    $suggestions['sub_category'] = 'Game Boy Color';
                    $suggestions['brand'] = 'Nintendo';
                } elseif (str_contains($lowerText, 'game boy') || str_contains($lowerText, 'gameboy')) {
                    $suggestions['sub_category'] = 'Game Boy';
                    $suggestions['brand'] = 'Nintendo';
                }
                
                // Si pas trouvé dans le texte, chercher dans les labels
                if (!$suggestions['sub_category']) {
                    foreach ($allLabels as $label) {
                        $lowerLabel = strtolower($label);
                        
                        if (str_contains($lowerLabel, 'game boy') || str_contains($lowerLabel, 'gameboy')) {
                            if (str_contains($lowerLabel, 'color') || str_contains($lowerLabel, 'colour')) {
                                $suggestions['sub_category'] = 'Game Boy Color';
                            } elseif (str_contains($lowerLabel, 'advance')) {
                                $suggestions['sub_category'] = 'Game Boy Advance';
                            } else {
                                $suggestions['sub_category'] = 'Game Boy';
                            }
                            $suggestions['brand'] = 'Nintendo';
                            break;
                        }
                    }
                }
            }
            
            // Détecter les consoles (uniquement si PAS cartouche)
            if (!$isCartridge) {
                foreach ($allLabels as $label) {
                    $lowerLabel = strtolower($label);
                    
                    foreach ($consoleKeywords as $keyword) {
                        if (stripos($lowerLabel, $keyword) !== false) {
                            $suggestions['category'] = 'Console portable';
                            break 2;
                        }
                    }
                }
                
                // Détecter les accessoires
                foreach ($allLabels as $label) {
                    $lowerLabel = strtolower($label);
                    
                    if (str_contains($lowerLabel, 'game boy') || str_contains($lowerLabel, 'gameboy')) {
                        $suggestions['category'] = 'Consoles portables';
                        if (str_contains($lowerLabel, 'color') || str_contains($lowerLabel, 'colour')) {
                            $suggestions['sub_category'] = 'Game Boy Color';
                        } elseif (str_contains($lowerLabel, 'advance')) {
                            $suggestions['sub_category'] = 'Game Boy Advance';
                        } else {
                            $suggestions['sub_category'] = 'Game Boy';
                        }
                        break;
                    }
                }
            }

            // Autres catégories
            foreach ($allLabels as $label) {
                $lowerLabel = strtolower($label);

                foreach ($consoleKeywords as $keyword) {
                    if (stripos($lowerLabel, $keyword) !== false) {
                        $suggestions['category'] = $suggestions['category'] ?? 'Consoles de salon';
                    }
                }

                foreach ($gameKeywords as $keyword) {
                    if (stripos($lowerLabel, $keyword) !== false && !$suggestions['category']) {
                        $suggestions['category'] = 'Jeux vidéo';
                    }
                }

                foreach ($accessoryKeywords as $keyword) {
                    if (stripos($lowerLabel, $keyword) !== false && !$suggestions['category']) {
                        $suggestions['category'] = 'Accessoires';
                    }
                }
            }
        }

        // Détecter la complétude
        if (in_array('box', array_map('strtolower', $allLabels)) || 
            in_array('packaging', array_map('strtolower', $allLabels))) {
            $suggestions['completeness'] = 'Avec boîte';
        } else {
            // Adapter selon la catégorie
            if ($suggestions['category'] === 'Jeux vidéo' || $isCartridge || $romIdDetected) {
                $suggestions['completeness'] = 'Loose';
            } else {
                $suggestions['completeness'] = 'Console seule';
            }
        }

        // ===== DÉTECTION DE LA RÉGION =====
        // Détecter la région PAL/NTSC/NTSC-J via plusieurs méthodes
        
        // Méthode 1 : Analyse du ROM ID (suffixe pays)
        if ($romIdDetected && isset($suggestions['rom_id'])) {
            $romId = $suggestions['rom_id'];
            
            // Suffixes de région connus
            if (preg_match('/(EUR|FRA|FAH|FRG|UKV|NOE|ESP|ITA|HOL|SCN|GPS)/i', $romId)) {
                $suggestions['region'] = 'PAL';
                Log::info('Région détectée via ROM ID (Europe)', ['rom_id' => $romId]);
            } elseif (preg_match('/(USA|CAN)/i', $romId)) {
                $suggestions['region'] = 'NTSC-U';
                Log::info('Région détectée via ROM ID (USA/Canada)', ['rom_id' => $romId]);
            } elseif (preg_match('/(JPN|JAP)/i', $romId)) {
                $suggestions['region'] = 'NTSC-J';
                Log::info('Région détectée via ROM ID (Japon)', ['rom_id' => $romId]);
            }
        }
        
        // Méthode 2 : Analyse du texte détecté
        $fullText = implode(' ', $analysisResult['text']);
        $lowerText = strtolower($fullText);
        
        if (!$suggestions['region']) {
            // Détection explicite PAL/NTSC
            if (stripos($fullText, 'PAL') !== false) {
                $suggestions['region'] = 'PAL';
                Log::info('Région PAL détectée dans le texte');
            } elseif (stripos($fullText, 'NTSC') !== false) {
                $suggestions['region'] = 'NTSC-U';
                Log::info('Région NTSC détectée dans le texte');
            }
            
            // Détection via "Made in..."
            elseif (preg_match('/made\s+in\s+(japan|jpn)/i', $fullText)) {
                $suggestions['region'] = 'NTSC-J';
                Log::info('Région NTSC-J détectée via "Made in Japan"');
            } elseif (preg_match('/made\s+in\s+(usa|america|china|mexico)/i', $fullText)) {
                $suggestions['region'] = 'NTSC-U';
                Log::info('Région NTSC-U détectée via "Made in USA/China/Mexico"');
            } elseif (preg_match('/made\s+in\s+(france|europe|spain|italy|uk|germany)/i', $fullText)) {
                $suggestions['region'] = 'PAL';
                Log::info('Région PAL détectée via "Made in Europe"');
            }
            
            // Détection de texte japonais (Katakana, Hiragana, Kanji)
            elseif (preg_match('/[\x{3040}-\x{309F}\x{30A0}-\x{30FF}\x{4E00}-\x{9FFF}]/u', $fullText)) {
                $suggestions['region'] = 'NTSC-J';
                Log::info('Région NTSC-J détectée via texte japonais');
            }
            
            // Codes pays européens
            elseif (preg_match('/\b(EUR|FRA|ESP|ITA|UKV|NOE)\b/i', $fullText)) {
                $suggestions['region'] = 'PAL';
                Log::info('Région PAL détectée via code pays européen');
            }
        }
        
        // Méthode 3 : Analyse des labels (dernier recours)
        if (!$suggestions['region']) {
            foreach ($allLabels as $label) {
                $lowerLabel = strtolower($label);
                
                if (str_contains($lowerLabel, 'japan') || str_contains($lowerLabel, 'japanese')) {
                    $suggestions['region'] = 'NTSC-J';
                    Log::info('Région NTSC-J détectée via label', ['label' => $label]);
                    break;
                } elseif (str_contains($lowerLabel, 'europe') || str_contains($lowerLabel, 'european')) {
                    $suggestions['region'] = 'PAL';
                    Log::info('Région PAL détectée via label', ['label' => $label]);
                    break;
                }
            }
        }

        return $suggestions;
    }

    public function __destruct()
    {
        if ($this->client) {
            $this->client->close();
        }
    }
}
