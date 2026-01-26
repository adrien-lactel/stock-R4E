<?php

namespace App\Services;

use thiagoalessio\TesseractOCR\TesseractOCR;
use Illuminate\Support\Facades\Log;

/**
 * Service OCR gratuit avec Tesseract (offline, 100% gratuit)
 * 
 * INSTALLATION REQUISE:
 * 1. Télécharger Tesseract: https://github.com/UB-Mannheim/tesseract/wiki
 * 2. Installer dans C:\Program Files\Tesseract-OCR (ou autre chemin)
 * 3. Configurer le chemin dans .env: TESSERACT_PATH="C:\Program Files\Tesseract-OCR\tesseract.exe"
 * 
 * COMPARAISON:
 * - Tesseract: Gratuit, offline, moins précis
 * - Google Vision: Payant après 1000/mois, très précis
 */
class TesseractOcrService
{
    protected $tesseractPath;

    public function __construct()
    {
        // Chemins par défaut selon l'OS
        $defaultPaths = [
            'C:\\Program Files\\Tesseract-OCR\\tesseract.exe', // Windows
            '/usr/bin/tesseract', // Linux/Mac
            '/usr/local/bin/tesseract', // Mac Homebrew
        ];

        $this->tesseractPath = env('TESSERACT_PATH');
        
        // Si pas défini, chercher dans les chemins par défaut
        if (!$this->tesseractPath) {
            foreach ($defaultPaths as $path) {
                if (file_exists($path)) {
                    $this->tesseractPath = $path;
                    break;
                }
            }
        }

        if (!$this->tesseractPath || !file_exists($this->tesseractPath)) {
            Log::warning('Tesseract non trouvé. Installez-le depuis: https://github.com/UB-Mannheim/tesseract/wiki');
        }
    }

    /**
     * Analyser une image pour reconnaître un article de gaming
     */
    public function analyzeGamingProduct($imagePath)
    {
        if (!$this->tesseractPath || !file_exists($this->tesseractPath)) {
            return [
                'success' => false,
                'message' => 'Tesseract OCR n\'est pas installé. Téléchargez-le depuis: https://github.com/UB-Mannheim/tesseract/wiki'
            ];
        }

        try {
            // Exécuter OCR avec Tesseract
            $ocr = new TesseractOCR($imagePath);
            $ocr->executable($this->tesseractPath);
            
            // Configurer pour meilleure précision sur texte imprimé (ROM IDs)
            $ocr->psm(11); // Sparse text - better for cartridge labels
            $ocr->lang('eng', 'jpn'); // Anglais + Japonais
            
            $fullText = $ocr->run();
            
            Log::info('🔍 Tesseract OCR détecté', [
                'length' => strlen($fullText),
                'preview' => substr($fullText, 0, 200)
            ]);

            $result = [
                'success' => true,
                'text' => $this->parseTextToArray($fullText),
                'suggestions' => []
            ];

            $result['suggestions'] = $this->generateSuggestions($result);

            return $result;

        } catch (\Exception $e) {
            Log::error('Erreur Tesseract OCR: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Erreur OCR: ' . $e->getMessage()
            ];
        }
    }

    /**
     * Convertir texte OCR en tableau (compatible avec le format attendu)
     */
    protected function parseTextToArray($text)
    {
        $lines = explode("\n", $text);
        $texts = [];
        
        // PRIORITÉ 1: Version nettoyée du texte complet (pour meilleure détection)
        $cleaned = $this->cleanTextForRomId($text);
        if ($cleaned !== $text) {
            $texts[] = $cleaned;
        }
        
        // PRIORITÉ 2: Texte complet brut
        $texts[] = trim($text);
        
        // PRIORITÉ 3: Lignes et mots avec corrections
        foreach ($lines as $line) {
            $line = trim($line);
            if (!empty($line)) {
                // Version nettoyée de la ligne en premier
                $cleanedLine = $this->cleanTextForRomId($line);
                if ($cleanedLine !== $line) {
                    $texts[] = $cleanedLine;
                }
                
                $texts[] = $line;
                
                // Mots individuels
                $words = preg_split('/\s+/', $line);
                foreach ($words as $word) {
                    if (strlen(trim($word)) > 0) {
                        // Version nettoyée du mot en premier
                        $cleanedWord = $this->cleanTextForRomId(trim($word));
                        if ($cleanedWord !== trim($word)) {
                            $texts[] = $cleanedWord;
                        }
                        $texts[] = trim($word);
                    }
                }
            }
        }
        
        return array_unique($texts);
    }

    /**
     * Nettoyer le texte pour améliorer détection ROM IDs
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
            // Corrections spécifiques détectées avec Tesseract PSM 11
            '/\bAPR[sS]\b/i' => 'APBJ',  // "Rs" mal détecté au lieu de "BJ"
            '/\bAPR[0O]\b/i' => 'APBJ',
            '/\bAP[B8][J1Il]\b/i' => 'APBJ',
            '/\bting\b/i' => 'JPN',  // "ting" mal détecté au lieu de "JPN"
            '/\bt[il1]ng\b/i' => 'JPN',
            // Rejoindre les mots séparés (ex: "DMG APRS" → "DMG-APBJ")
            '/\b(DMG|CGB|AGB)\s+([A-Z][A-Za-z0-9]{2,3})\b/i' => '$1-$2',
            // Supprimer tiret interne incorrect: DMG-APB-J → DMG-APBJ
            '/\b(DMG|CGB|AGB)-([A-Z0-9]{3})-([A-Z0-9])\b/i' => '$1-$2$3',
            '/\s{2,}/' => ' ',
            '/\b(DMG|CGB|AGB)[\s]*-[\s]*([A-Z0-9]{3,4})[\s]*-?[\s]*([A-Z0-9]{1,3})\b/i' => '$1-$2-$3',
        ];
        
        foreach ($corrections as $pattern => $replacement) {
            $text = preg_replace($pattern, $replacement, $text);
        }
        
        return $text;
    }

    /**
     * Générer suggestions basées sur OCR (identique à ImageRecognitionService)
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
        
        // Patterns ROM ID Game Boy (format: DMG-XXXX-Y où XXXX=4 lettres, Y=région ou chiffre)
        $patterns = [
            // Standard avec région textuelle: DMG-APBJ-JPN
            '/\b(DMG|CGB|AGB)[\s\-]+([A-Z0-9]{4})[\s\-]+(JPN|EUR|USA|FRA|GER|ITA|SPA|UK|PAL|NTSC)\b/i',
            // Standard avec tirets: DMG-APBJ-0
            '/\b(DMG|CGB|AGB)[\s\-]+([A-Z0-9]{4})[\s\-]+([0-3])\b/i',
            // Sans tiret final: DMG-APBJ
            '/\b(DMG|CGB|AGB)[\s\-]+([A-Z0-9]{4})\b/i',
            // Tout attaché: DMGAPBJ0
            '/\b(DMG|CGB|AGB)([A-Z0-9]{4})([0-3])\b/i',
            // Tout attaché sans région: DMGAPBJ
            '/\b(DMG|CGB|AGB)([A-Z0-9]{4})\b/i',
        ];
        
        $romIdDetected = false;
        $gameFound = null;
        
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $fullText, $matches)) {
                $prefix = strtoupper($matches[1] ?? '');
                $gameCode = strtoupper($matches[2] ?? '');
                $region = strtoupper($matches[3] ?? '');
                
                // Si pas de région détectée, essayer de la deviner
                if (empty($region) || $region === '-') {
                    $romId = "$prefix-$gameCode";
                    $detectedRegion = $this->detectRegion($romId, $fullText);
                    // Utiliser la région détectée si disponible
                    $region = $detectedRegion ?: '';
                }
                
                // Construire le ROM ID avec la région (textuelle ou numérique)
                $romId = "$prefix-$gameCode" . ($region ? "-$region" : '');
                
                $suggestions['rom_id'] = $romId;
                $romIdDetected = true;
                $suggestions['category'] = 'Jeux vidéo';
                
                Log::info('🎮 ROM ID détecté (Tesseract)', [
                    'texte_brut' => $matches[0],
                    'rom_id' => $romId,
                    'region' => $region
                ]);
                
                // Recherche dans la base avec le ROM ID exact
                $gameFound = \App\Models\GameBoyGame::where('rom_id', $romId)->first();
                
                // Si pas trouvé et région textuelle (JPN/EUR/USA), essayer version numérique
                if (!$gameFound && preg_match('/-(JPN|EUR|USA|FRA|GER|ITA|SPA|UK|KOR|CHN|PAL|NTSC)$/i', $romId)) {
                    Log::info("🔍 Jeu non trouvé avec région textuelle, essai avec variantes numériques");
                    for ($i = 0; $i <= 3; $i++) {
                        $altRomId = preg_replace('/-(JPN|EUR|USA|FRA|GER|ITA|SPA|UK|KOR|CHN|PAL|NTSC)$/i', "-$i", $romId);
                        $gameFound = \App\Models\GameBoyGame::where('rom_id', $altRomId)->first();
                        if ($gameFound) {
                            // Conserver le ROM ID avec région textuelle détectée
                            // mais utiliser les infos du jeu trouvé
                            Log::info("✅ Jeu trouvé avec variante: $altRomId");
                            break;
                        }
                    }
                }
                
                // Si toujours pas trouvé, essayer avec juste prefix + code
                if (!$gameFound && $prefix && $gameCode) {
                    Log::info("🔍 Essai avec prefix-code uniquement");
                    for ($i = 0; $i <= 3; $i++) {
                        $altRomId = "$prefix-$gameCode-$i";
                        $gameFound = \App\Models\GameBoyGame::where('rom_id', $altRomId)->first();
                        if ($gameFound) {
                            Log::info("✅ Jeu trouvé (fallback numérique): $altRomId");
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

        if ($romIdDetected) {
            $suggestions['region'] = $this->detectRegion($suggestions['rom_id'] ?? '', $fullText);
        }

        if ($suggestions['category'] === 'Jeux vidéo' || $romIdDetected) {
            $suggestions['completeness'] = 'Loose';
        }

        return $suggestions;
    }

    /**
     * Détecter région
     */
    protected function detectRegion($romId, $fullText)
    {
        if (preg_match('/-(EUR|PAL|FRA|GER|ITA|SPA|UK)/i', $romId)) {
            return 'PAL';
        }
        if (preg_match('/-(USA|CAN)/i', $romId)) {
            return 'NTSC-U';
        }
        if (preg_match('/-(JPN|JAP)/i', $romId)) {
            return 'NTSC-J';
        }

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
