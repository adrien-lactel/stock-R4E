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
            'logo' => 'nullable|url',
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
            'logo' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $publisher->update($validated);

        return redirect()->route('admin.publishers.index')
            ->with('success', 'Éditeur mis à jour avec succès');
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();

        return redirect()->route('admin.publishers.index')
            ->with('success', 'Éditeur supprimé avec succès');
    }
}
