<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageProxyController extends Controller
{
    /**
     * Proxy pour servir les images R2 avec CORS headers
     * Redirige directement vers R2 pour de meilleures performances
     */
    public function proxyTaxonomyImage($folder, $filename)
    {
        // Vérifier que le dossier est valide
        $allowedFolders = ['gameboy', 'game boy color', 'game boy advance', 'n64', 'snes', 'nes', 'gamegear', 'wonderswan', 'segasaturn', 'megadrive', 'editeurs'];
        if (!in_array($folder, $allowedFolders)) {
            abort(404);
        }

        // En local, servir depuis public/
        $path = "images/taxonomy/{$folder}/{$filename}";
        if (file_exists(public_path($path))) {
            return response()->file(public_path($path), [
                'Content-Type' => 'image/png',
                'Cache-Control' => 'public, max-age=31536000',
            ]);
        }

        // En production, rediriger directement vers R2 (beaucoup plus rapide)
        $r2PublicUrl = env('R2_PUBLIC_URL');
        if ($r2PublicUrl) {
            // Construire l'URL R2 : https://pub-xxx.r2.dev/taxonomy/{folder}/{filename}
            $r2ImageUrl = "{$r2PublicUrl}/taxonomy/{$folder}/{$filename}";
            
            // Redirection permanente vers R2 (très rapide, pas de téléchargement)
            return redirect($r2ImageUrl, 301);
        }

        abort(404);
    }
}
