<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ImageProxyController extends Controller
{
    /**
     * Proxy pour servir les images de taxonomie depuis R2
     * En local: sert depuis public/ si existe, sinon R2
     * En prod (Railway): toujours depuis R2
     */
    public function proxyTaxonomyImage($folder, $filename)
    {
        // Vérifier que le dossier est valide
        $allowedFolders = ['gameboy', 'game boy color', 'game boy advance', 'n64', 'snes', 'nes', 'gamegear', 'wonderswan', 'wonderswan color', 'segasaturn', 'megadrive', 'editeurs'];
        if (!in_array($folder, $allowedFolders)) {
            abort(404);
        }

        // En développement local, essayer de servir depuis public/ d'abord
        $path = "images/taxonomy/{$folder}/{$filename}";
        if (app()->environment('local') && file_exists(public_path($path))) {
            return response()->file(public_path($path), [
                'Content-Type' => 'image/png',
                'Cache-Control' => 'public, max-age=31536000',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, HEAD, OPTIONS',
            ]);
        }

        // Sinon, streamer depuis R2
        // IMPORTANT: Encoder les espaces et caractères spéciaux pour l'URL R2
        $encodedFolder = rawurlencode($folder);
        $encodedFilename = rawurlencode($filename);
        $r2ImageUrl = "https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/{$encodedFolder}/{$encodedFilename}";
        
        try {
            // Requête vers R2
            $response = Http::timeout(10)->get($r2ImageUrl);
            
            // Vérifier si on a reçu du contenu (même si status = 404)
            $body = $response->body();
            if (empty($body) || strlen($body) < 100) {
                abort(404);
            }
            
            // Streamer l'image avec headers CORS
            return response($body)
                ->header('Content-Type', $response->header('Content-Type') ?? 'image/png')
                ->header('Cache-Control', 'public, max-age=31536000')
                ->header('Access-Control-Allow-Origin', '*')
                ->header('Access-Control-Allow-Methods', 'GET, HEAD, OPTIONS');
                
        } catch (\Exception $e) {
            abort(404);
        }
    }
}
