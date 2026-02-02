<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageProxyController extends Controller
{
    /**
     * Proxy pour servir les images R2 avec CORS headers
     */
    public function proxyTaxonomyImage($folder, $filename)
    {
        // Vérifier que le dossier est valide
        $allowedFolders = ['gameboy', 'game boy color', 'game boy advance', 'n64', 'snes', 'nes', 'gamegear', 'wonderswan', 'segasaturn', 'megadrive', 'editeurs'];
        if (!in_array($folder, $allowedFolders)) {
            abort(404);
        }

        // Construire le chemin vers l'image
        $path = "images/taxonomy/{$folder}/{$filename}";

        // En local, servir depuis public/
        if (file_exists(public_path($path))) {
            return response()->file(public_path($path), [
                'Content-Type' => 'image/png',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, HEAD',
                'Access-Control-Allow-Headers' => 'Content-Type',
            ]);
        }

        // En production, utiliser le mapping R2
        $r2Url = config('filesystems.disks.r2.url');
        if ($r2Url) {
            // Vérifier d'abord dans le mapping R2
            $mappingFile = storage_path('app/taxonomy-r2-mapping.json');
            if (file_exists($mappingFile)) {
                $mapping = json_decode(file_get_contents($mappingFile), true);
                
                // Vérifier si l'image existe dans le mapping
                if (isset($mapping[$folder][$filename])) {
                    $imageUrl = $mapping[$folder][$filename];
                    
                    // Faire un proxy de l'image avec les bons headers CORS
                    try {
                        $context = stream_context_create([
                            'http' => [
                                'timeout' => 10,
                                'ignore_errors' => true
                            ]
                        ]);
                        
                        $imageContent = file_get_contents($imageUrl, false, $context);
                        
                        if ($imageContent === false) {
                            abort(404);
                        }
                        
                        return response($imageContent, 200, [
                            'Content-Type' => 'image/png',
                            'Access-Control-Allow-Origin' => '*',
                            'Access-Control-Allow-Methods' => 'GET, HEAD',
                            'Access-Control-Allow-Headers' => 'Content-Type',
                            'Cache-Control' => 'public, max-age=31536000',
                        ]);
                    } catch (\Exception $e) {
                        abort(404);
                    }
                }
            }
            
            // Fallback: essayer l'URL directe
            $imageUrl = "{$r2Url}/{$path}";
            try {
                $context = stream_context_create([
                    'http' => [
                        'timeout' => 10,
                        'ignore_errors' => true
                    ]
                ]);
                
                $imageContent = @file_get_contents($imageUrl, false, $context);
                
                if ($imageContent === false) {
                    abort(404);
                }
                
                return response($imageContent, 200, [
                    'Content-Type' => 'image/png',
                    'Access-Control-Allow-Origin' => '*',
                    'Access-Control-Allow-Methods' => 'GET, HEAD',
                    'Access-Control-Allow-Headers' => 'Content-Type',
                    'Cache-Control' => 'public, max-age=31536000',
                ]);
            } catch (\Exception $e) {
                abort(404);
            }
        }

        abort(404);
    }
}
