<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Publisher;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PublisherAdminController extends Controller
{
    public function index()
    {
        $publishers = Publisher::orderBy('name')->paginate(50);
        return view('admin.publishers.index', compact('publishers'));
    }

    public function create()
    {
        return view('admin.publishers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        Publisher::create($validated);

        return redirect()->route('admin.publishers.index')
            ->with('success', 'Éditeur créé avec succès');
    }

    public function edit(Publisher $publisher)
    {
        return view('admin.publishers.edit', compact('publisher'));
    }

    public function update(Request $request, Publisher $publisher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|string',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $publisher->update($validated);

        return redirect()->back()
            ->with('success', 'Éditeur mis à jour avec succès');
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();

        return redirect()->route('admin.publishers.index')
            ->with('success', 'Éditeur supprimé avec succès');
    }

    /**
     * Upload du logo d'éditeur
     */
    public function uploadLogo(Request $request)
    {
        $request->validate([
            'image' => 'required|image|max:2048', // 2MB max
            'publisher_id' => 'required|exists:publishers,id',
        ]);

        try {
            $file = $request->file('image');
            $publisher = Publisher::findOrFail($request->publisher_id);
            
            // Générer un nom de fichier
            $extension = $file->getClientOriginalExtension();
            $filename = Str::slug($publisher->name) . '.' . $extension;
            
            // Sauvegarder sur R2 si configuré
            if (config('filesystems.disks.r2.key')) {
                \Storage::disk('r2')->putFileAs(
                    'taxonomy/editeurs',
                    $file,
                    $filename,
                    'public'
                );
            }
            
            // Sauvegarder aussi en local pour compatibilité
            $file->move(public_path('images/taxonomy/editeurs'), $filename);
            
            // Mettre à jour le Publisher avec juste le nom du fichier
            $publisher->update(['logo' => $filename]);
            
            // URL R2 directe pour un chargement rapide
            $r2Url = 'https://pub-ab739e57f0754a92b660c450ab8b019e.r2.dev/taxonomy/editeurs';
            
            return response()->json([
                'success' => true,
                'logo_path' => $filename,
                'logo_url' => "{$r2Url}/{$filename}"
            ]);
            
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
