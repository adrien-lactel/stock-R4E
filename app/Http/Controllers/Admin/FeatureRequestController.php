<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FeatureRequest;
use Illuminate\Http\Request;

class FeatureRequestController extends Controller
{
    public function index()
    {
        $requests = FeatureRequest::with('creator')
            ->orderBy('status', 'asc')
            ->orderBy('priority', 'desc')
            ->orderBy('created_at', 'desc')
            ->get();

        $stats = [
            'total' => $requests->count(),
            'pending' => $requests->where('status', 'pending')->count(),
            'in_progress' => $requests->where('status', 'in_progress')->count(),
            'completed' => $requests->where('status', 'completed')->count(),
            'bugs' => $requests->where('type', 'bug')->count(),
            'features' => $requests->where('type', 'feature')->count(),
        ];

        return view('admin.feature-requests.index', compact('requests', 'stats'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:bug,feature',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $validated['created_by'] = auth()->id();

        FeatureRequest::create($validated);

        return redirect()->route('admin.feature-requests.index')
            ->with('success', 'Demande créée avec succès !');
    }

    public function updateStatus(FeatureRequest $featureRequest)
    {
        $newStatus = request('status');

        $featureRequest->update([
            'status' => $newStatus,
            'completed_at' => $newStatus === 'completed' ? now() : null,
        ]);

        return back()->with('success', 'Statut mis à jour !');
    }

    public function update(FeatureRequest $featureRequest, Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:bug,feature',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'priority' => 'required|in:low,medium,high',
        ]);

        $featureRequest->update($validated);

        return back()->with('success', 'Demande mise à jour !');
    }

    public function addResponse(FeatureRequest $featureRequest)
    {
        $validated = request()->validate([
            'admin_response' => 'required|string',
        ]);

        $featureRequest->update([
            'admin_response' => $validated['admin_response'],
            'responded_at' => now(),
        ]);

        return back()->with('success', 'Réponse ajoutée !');
    }

    public function destroy(FeatureRequest $featureRequest)
    {
        $featureRequest->delete();

        return back()->with('success', 'Demande supprimée.');
    }
}
