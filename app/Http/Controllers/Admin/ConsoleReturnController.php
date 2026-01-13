<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsoleReturn;
use App\Models\Repairer;
use Illuminate\Http\Request;          // ✅ CORRECTION CRITIQUE
use Illuminate\Support\Facades\Auth;

class ConsoleReturnController extends Controller
{
    /**
     * Liste des demandes SAV
     */
    public function index()
    {
        // =====================
        // Sécurité admin
        // =====================
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $returns = ConsoleReturn::with([
                'console.articleType',
                'console.articleCategory',
                'console.articleSubCategory',
                'store',
                'repairer',
                'repairQuote',
            ])
            ->orderBy('created_at', 'desc')
            ->get();

        $repairers = Repairer::orderBy('name')->get();

        return view('admin.returns.index', compact('returns', 'repairers'));
    }

    /**
     * Validation d'une demande SAV
     */
    public function approve(Request $request, ConsoleReturn $return)
    {
        // =====================
        // Sécurité admin
        // =====================
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'repairer_id' => 'required|exists:repairers,id',
        ]);

        // =====================
        // Marquer comme accepté
        // =====================
        $return->update([
            'status' => 'accepted',
            'repairer_id' => $request->repairer_id,
            'acknowledged' => false,
        ]);

        return back()->with('success', 'Demande SAV validée');
    }

    /**
     * Marquer une demande comme prise en compte (stop clignotement nav)
     */
    public function acknowledge(ConsoleReturn $return)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        if (!in_array($return->status, ['pending', 'accepted', 'sent_to_repairer'])) {
            return back()->with('error', 'Cette demande n\'a pas besoin d\'être prise en compte.');
        }

        $return->update([
            'acknowledged' => true,
        ]);

        return back()->with('success', 'Demande prise en compte.');
    }

    /**
     * Refuser une demande SAV avec motif
     */
    public function reject(Request $request, ConsoleReturn $return)
    {
        // =====================
        // Sécurité : admin uniquement
        // =====================
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        // =====================
        // Validation du motif
        // =====================
        $request->validate([
            'admin_comment' => 'required|string|min:5',
        ]);

        // =====================
        // Mise à jour SAV
        // =====================
        $return->update([
            'status'        => 'rejected',
            'admin_comment' => $request->admin_comment,
        ]);

        return back()->with('success', 'Demande SAV refusée avec motif');
    }

    /**
     * Assigner un réparateur à un SAV (après acceptation du devis)
     */
    public function assignRepairer(Request $request, ConsoleReturn $return)
    {
        if (Auth::user()->role !== 'admin') {
            abort(403);
        }

        $request->validate([
            'repairer_id' => 'required|exists:repairers,id',
        ]);

        $return->update([
            'repairer_id' => $request->repairer_id,
        ]);

        return back()->with('success', 'Réparateur assigné. L\'adresse est maintenant visible côté magasin.');
    }
}
