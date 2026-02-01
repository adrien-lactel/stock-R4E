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
        $allowedFolders = ['gameboy', 'game boy color', 'game boy advance', 'n64', 'snes', 'nes', 'gamegear', 'wonderswan', 'segasaturn', 'megadrive'];
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

        // En production, rediriger vers R2 ou servir avec proxy
        $r2Url = config('filesystems.disks.r2.url');
        if ($r2Url) {
            // Construire l'URL R2
            $imageUrl = "{$r2Url}/{$path}";
            
            // Faire un proxy de l'image avec les bons headers CORS
            try {
                $imageContent = file_get_contents($imageUrl);
                
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
