<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ImageProxyController extends Controller
{
    /**
     * Proxy pour servir les images R2 avec CORS headers
     * Stream l'image depuis R2 pour éviter les problèmes CORS avec les requêtes HEAD
     */
    public function proxyTaxonomyImage($folder, $filename)
    {
        // Vérifier que le dossier est valide
        $allowedFolders = ['gameboy', 'game boy color', 'game boy advance', 'n64', 'snes', 'nes', 'gamegear', 'wonderswan', 'wonderswan color', 'segasaturn', 'megadrive', 'editeurs'];
        if (!in_array($folder, $allowedFolders)) {
            abort(404);
        }

        // En local, servir depuis public/
        $path = "images/taxonomy/{$folder}/{$filename}";
        if (file_exists(public_path($path))) {
            return response()->file(public_path($path), [
                'Content-Type' => 'image/png',
                'Cache-Control' => 'public, max-age=31536000',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, HEAD, OPTIONS',
            ]);
        }

        // Si l'image n'existe pas localement, la récupérer depuis R2 et la streamer
        // (au lieu de redirect pour éviter les problèmes CORS avec HEAD requests)
        $r2ImageUrl = "https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/{$folder}/{$filename}";
        
        try {
            // Faire une requête vers R2
            $response = Http::timeout(10)->get($r2ImageUrl);
            
            // Si l'image n'existe pas sur R2
            if (!$response->successful()) {
                abort(404);
            }
            
            // Streamer l'image avec les headers CORS
            return response($response->body())
                ->header('Content-Type', $response->header('Content-Type') ?? 'image/png')
                ->header('Cache-Control', 'public, max-age=31536000')
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, HEAD, OPTIONS');
                
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
