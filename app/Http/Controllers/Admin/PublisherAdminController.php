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
        return response()->json($publishers);
    }

    public function create()
    {
        return response()->json(['message' => 'Use POST /admin/publishers to create']);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|url',
            'description' => 'nullable|string',
        ]);

        $validated['slug'] = Str::slug($validated['name']);

        $publisher = Publisher::create($validated);

        return response()->json($publisher, 201);
    }

    public function edit(Publisher $publisher)
    {
        return response()->json($publisher);
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

        return response()->json($publisher);
    }

    public function destroy(Publisher $publisher)
    {
        $publisher->delete();

        return response()->json(['message' => 'Publisher deleted successfully']);
    }
}
