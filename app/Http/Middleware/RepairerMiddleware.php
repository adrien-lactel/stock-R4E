<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RepairerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        if (!$user || $user->role !== 'repairer') {
            abort(403, 'Accès réservé aux réparateurs.');
        }

        // Vérifier que le réparateur a bien un repairer_id associé
        if (!$user->repairer_id) {
            abort(403, 'Aucun réparateur associé à ce compte.');
        }

        return $next($request);
    }
}
