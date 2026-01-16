<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Mod;
use App\Models\Repairer;
use App\Models\ConsoleReturn;
use App\Models\StoreLotRequest;

class DashboardController extends Controller
{
    public function index()
    {
        $mods = Mod::with([
                'compatibleCategories:id,name',
                'compatibleSubCategories:id,name',
                'compatibleTypes:id,name',
            ])
            ->orderBy('quantity', 'asc')
            ->limit(10)
            ->get();
        $repairers = Repairer::withCount('consoles')
            ->orderBy('consoles_count', 'desc')
            ->limit(10)
            ->get();
        $lotRequests = StoreLotRequest::with([
                'store:id,name,city',
                'consoleOffer.console.articleType'
            ])
            ->where('status', 'pending')
            ->latest()
            ->limit(5)
            ->get();

        $savPendingCount = ConsoleReturn::whereIn('status', ['pending', 'accepted', 'sent_to_repairer'])
            ->where('acknowledged', false)
            ->count();

        $quickLinks = [
            [
                'title' => 'Créer un article',
                'subtitle' => 'Catalogue',
                'description' => 'Saisie initiale d\'une console, accessoire ou article annexe.',
                'icon' => '➕',
                'route' => 'admin.articles.create',
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
                'title' => 'Inventaire consoles',
                'subtitle' => 'Stock',
                'description' => 'Consulter toutes les consoles, leurs statuts et affectations.',
                'icon' => '🎮',
                'route' => 'admin.consoles.index',
            ],
            [
                'title' => 'Réparateurs',
                'subtitle' => 'Réseau',
                'description' => 'Piloter les partenaires SAV et suivre leur charge.',
                'icon' => '🔧',
                'route' => 'admin.repairers.index',
            ],
            [
                'title' => 'Ajouter un réparateur',
                'subtitle' => 'Réseau',
                'description' => 'Créer un nouveau partenaire SAV et définir ses capacités.',
                'icon' => '🧑‍🔧',
                'route' => 'admin.repairers.create',
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
        
        return view('admin.dashboard', compact('mods', 'repairers', 'quickLinks', 'savPendingCount', 'lotRequests'));
    }
}
