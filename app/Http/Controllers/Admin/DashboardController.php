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

        $sections = [
            [
                'title' => 'Articles et stock',
                'cards' => [
                    [
                        'title' => 'Créer un article',
                        'subtitle' => 'Catalogue',
                        'description' => 'Saisir une nouvelle console, accessoire ou article annexe.',
                        'icon' => '➕',
                        'route' => 'admin.articles.create',
                    ],
                    [
                        'title' => 'Articles récents',
                        'subtitle' => 'Production',
                        'description' => 'Consulter les 40 dernières fiches créées.',
                        'icon' => '📰',
                        'route' => 'admin.articles.recent',
                    ],
                    [
                        'title' => 'Inventaire articles',
                        'subtitle' => 'Stock global',
                        'description' => 'Piloter l’ensemble des articles, statuts et affectations.',
                        'icon' => '📚',
                        'route' => 'admin.consoles.index',
                    ],                    [
                        'title' => 'Consoles HS',
                        'subtitle' => 'Pièces détachées',
                        'description' => 'Consoles désactivées utilisées comme donneurs de pièces.',
                        'icon' => '🔴',
                        'route' => 'admin.consoles.disabled',
                    ],                ],
            ],
            [
                'title' => 'Gestion réparateurs',
                'cards' => [
                    [
                        'title' => 'Réparateurs',
                        'subtitle' => 'Réseau',
                        'description' => 'Suivre les partenaires SAV et leurs charges.',
                        'icon' => '🔧',
                        'route' => 'admin.repairers.index',
                    ],
                    [
                        'title' => 'Ajouter un réparateur',
                        'subtitle' => 'Onboarding',
                        'description' => 'Créer un nouveau partenaire et définir ses capacités.',
                        'icon' => '🧑‍🔧',
                        'route' => 'admin.repairers.create',
                    ],
                ],
            ],
            [
                'title' => 'Réseau de vente',
                'cards' => [
                    [
                        'title' => 'Vues magasins',
                        'subtitle' => 'Réseau',
                        'description' => 'Vue d\'ensemble des magasins et accès à leurs dashboards.',
                        'icon' => '🏬',
                        'route' => 'admin.stores.index',
                    ],
                    [
                        'title' => 'Demandes de lots',
                        'subtitle' => 'Logistique',
                        'description' => 'Valider les besoins des magasins en consoles.',
                        'icon' => '📦',
                        'route' => 'admin.lot-requests.index',
                    ],
                    [
                        'title' => 'Prix consoles',
                        'subtitle' => 'Tarifs',
                        'description' => 'Synchroniser les prix par magasin et par article.',
                        'icon' => '💰',
                        'route' => 'admin.prices.index',
                    ],
                ],
            ],
            [
                'title' => 'SAV & devis',
                'cards' => [
                    [
                        'title' => 'SAV & retours',
                        'subtitle' => 'Support',
                        'description' => 'Valider dossiers SAV, devis et affectations réparateurs.',
                        'icon' => '🛠️',
                        'route' => 'admin.returns.index',
                        'badge' => $savPendingCount > 0 ? $savPendingCount . ' en attente' : null,
                        'badge_style' => 'bg-red-100 text-red-700',
                    ],
                ],
            ],
            [
                'title' => 'Administration R4E',
                'cards' => [
                    [
                        'title' => 'Taxonomie articles',
                        'subtitle' => 'Catalogue',
                        'description' => 'Maintenir catégories, sous-catégories et types.',
                        'icon' => '🗂️',
                        'route' => 'admin.taxonomy.index',
                    ],
                    [
                        'title' => 'Créer un magasin',
                        'subtitle' => 'Onboarding',
                        'description' => 'Ajouter une boutique et configurer son accès.',
                        'icon' => '🏪',
                        'route' => 'admin.stores.create',
                    ],
                    [
                        'title' => 'Créer un réparateur',
                        'subtitle' => 'Réseau',
                        'description' => 'Onboarder un partenaire SAV supplémentaire.',
                        'icon' => '🧑‍🏭',
                        'route' => 'admin.repairers.create',
                    ],
                    [
                        'title' => 'Catalogue Mods',
                        'subtitle' => 'Stock',
                        'description' => 'Gérer accessoires, quantités et affectations.',
                        'icon' => '🧰',
                        'route' => 'admin.mods.index',
                    ],
                    [
                        'title' => 'Bilan accessoires',
                        'subtitle' => 'Inventaire',
                        'description' => 'Vue d\'ensemble des stocks et valorisation accessoires.',
                        'icon' => '📦',
                        'route' => 'admin.accessories.report',
                    ],
                ],
            ],
            [
                'title' => 'Suivi financier & ventes',
                'cards' => [
                    [
                        'title' => 'Bilan financier',
                        'subtitle' => 'À venir',
                        'description' => 'Vue consolidée des marges et ventes réseau.',
                        'icon' => '📊',
                        'route' => null,
                        'disabled' => true,
                        'tag' => 'À venir',
                    ],
                ],
            ],
        ];

        return view('admin.dashboard', compact('mods', 'repairers', 'savPendingCount', 'lotRequests', 'sections'));
    }
}
