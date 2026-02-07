<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class ImageProxyController extends Controller
{
    /**
     * Proxy pour servir les images de taxonomie
     * Sert d'abord depuis local, puis fallback hardcodé vers R2
     */
    public function proxyTaxonomyImage($folder, $filename)
    {
        // Vérifier que le dossier est valide
        $allowedFolders = ['gameboy', 'game boy color', 'game boy advance', 'n64', 'snes', 'nes', 'gamegear', 'wonderswan', 'wonderswan color', 'segasaturn', 'megadrive', 'editeurs'];
        if (!in_array($folder, $allowedFolders)) {
            abort(404);
        }

        // TOUJOURS essayer de servir depuis local en priorité
        $path = "images/taxonomy/{$folder}/{$filename}";
        if (file_exists(public_path($path))) {
            return response()->file(public_path($path), [
                'Content-Type' => 'image/png',
                'Cache-Control' => 'public, max-age=31536000',
                'Access-Control-Allow-Origin' => '*',
                'Access-Control-Allow-Methods' => 'GET, HEAD, OPTIONS',
            ]);
        }

        // Si pas en local, retourner 404
        // (R2 uploads à faire séparément via script d'upload)
        abort(404);
    }
}
