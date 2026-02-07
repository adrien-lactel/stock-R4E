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
            ]);
        }

        // Si l'image n'existe pas localement, toujours rediriger vers R2 (prod ou dev)
        // URL R2 publique hardcodée (les images sont publiques)
        $r2ImageUrl = "https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/{$folder}/{$filename}";
        
        // Redirection permanente vers R2 (très rapide, pas de téléchargement)
        return redirect($r2ImageUrl, 301);
    }
}
