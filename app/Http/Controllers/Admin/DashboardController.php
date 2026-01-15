<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Console;
use App\Models\Mod;
use App\Models\Repairer;
use App\Models\ConsoleReturn;

class DashboardController extends Controller
{
    public function index()
    {
        $mods = Mod::orderBy('quantity', 'asc')->limit(10)->get();
        $repairers = Repairer::withCount('consoles')
            ->orderBy('consoles_count', 'desc')
            ->limit(10)
            ->get();

        $savPendingCount = ConsoleReturn::whereIn('status', ['pending', 'accepted', 'sent_to_repairer'])
            ->where('acknowledged', false)
            ->count();

        $quickLinks = [
            [
                'title' => 'Nouveau magasin',
                'subtitle' => 'Onboarding',
                'description' => 'Créer un accès boutique et lui attribuer son stock initial.',
                'icon' => '🏪',
                'route' => 'admin.stores.create',
            ],
            [
                'title' => 'Prix consoles',
                'subtitle' => 'Tarifs',
                'description' => 'Synchroniser les prix par magasin et par console.',
                'icon' => '💰',
                'route' => 'admin.prices.index',
            ],
            [
                'title' => 'Catalogue Mods',
                'subtitle' => 'Stock',
                'description' => 'Gérer accessoires, quantités et affectations réparateurs.',
                'icon' => '🧰',
                'route' => 'admin.mods.index',
            ],
            [
                'title' => 'SAV & retours',
                'subtitle' => 'Support',
                'description' => 'Valider les dossiers SAV et assigner un réparateur.',
                'icon' => '🛠️',
                'route' => 'admin.returns.index',
                'badge' => $savPendingCount > 0 ? $savPendingCount . ' en attente' : null,
                'badge_style' => 'bg-red-100 text-red-700',
            ],
            [
                'title' => 'Demandes de lots',
                'subtitle' => 'Logistique',
                'description' => 'Répondre aux besoins des magasins en consoles.',
                'icon' => '📦',
                'route' => 'admin.lot-requests.index',
            ],
            [
                'title' => 'Réparateurs',
                'subtitle' => 'Réseau',
                'description' => 'Piloter les partenaires SAV et suivre leur charge.',
                'icon' => '🔧',
                'route' => 'admin.repairers.index',
            ],
            [
                'title' => 'Taxonomie articles',
                'subtitle' => 'Catalogue',
                'description' => 'Maintenir catégories, sous-catégories et types.',
                'icon' => '🗂️',
                'route' => 'admin.taxonomy.index',
            ],
            [
                'title' => 'Articles récents',
                'subtitle' => 'Production',
                'description' => 'Consulter les 40 dernières fiches créées.',
                'icon' => '📰',
                'route' => 'admin.articles.recent',
            ],
        ];
        
        return view('admin.dashboard', compact('mods', 'repairers', 'quickLinks', 'savPendingCount'));
    }
}
