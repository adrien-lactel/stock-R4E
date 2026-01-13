<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ConsoleReturn;
use App\Models\RepairQuote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RepairQuoteAdminController extends Controller
{
    /**
     * =========================
     * PROPOSER UN DEVIS
     * =========================
     */
    public function propose(Request $request, ConsoleReturn $return)
{
    // =====================
    // Sécurité admin
    // =====================
    if (Auth::user()->role !== 'admin') {
        abort(403);
    }

    // =====================
    // Validation
    // =====================
    $request->validate([
        'amount' => 'required|numeric|min:0',
        'admin_comment' => 'nullable|string',
        'repairer_id' => 'nullable|exists:repairers,id',
    ]);

    // =====================
    // Empêcher double devis
    // =====================
    if ($return->repairQuote) {
        return back()->with('error', 'Un devis a déjà été proposé pour ce SAV.');
    }

    /* =====================
     | CRÉATION DU DEVIS
     ===================== */
    RepairQuote::create([
        'console_id'           => $return->console_id,
        'store_id'             => $return->store_id,
        'console_return_id'    => $return->id,

        // ✅ CORRECTION ICI
        'problem_description'  => $return->comment,

        'amount'               => $request->amount,
        'admin_comment'        => $request->admin_comment,
        'status'               => 'proposed',
    ]);

    // ✅ Remettre le SAV en "accepted" si c'était "rejected"
    if ($return->status === 'rejected') {
        $return->update(['status' => 'accepted']);
    }

    // ✅ Assigner le réparateur si fourni (pour réparations externes)
    if ($request->repairer_id) {
        $return->update(['repairer_id' => $request->repairer_id]);
    }

    return back()->with('success', 'Devis de réparation envoyé au magasin.');
}
}
