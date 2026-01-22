<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use App\Models\GameBoyGame;

class GameBoyImportController extends Controller
{
    public function index()
    {
        $gamesCount = GameBoyGame::count();
        $gamesWithImages = GameBoyGame::whereNotNull('image_url')->count();
        $gamesWithYear = GameBoyGame::whereNotNull('year')->count();
        
        return view('admin.gameboy.import', compact('gamesCount', 'gamesWithImages', 'gamesWithYear'));
    }

    public function import(Request $request)
    {
        try {
            // Lancer le scraping en arrière-plan
            set_time_limit(300); // 5 minutes max
            
            Artisan::call('gameboy:scrape');
            $output = Artisan::output();
            
            $totalGames = GameBoyGame::count();
            $gamesWithImages = GameBoyGame::whereNotNull('image_url')->count();
            $gamesWithYear = GameBoyGame::whereNotNull('year')->count();
            
            $successMessage = "Scraping terminé avec succès !\n\n" .
                "📊 Statistiques :\n" .
                "• Total : {$totalGames} jeux\n" .
                "• Avec image : {$gamesWithImages}\n" .
                "• Avec année : {$gamesWithYear}";
            
            return redirect()
                ->route('admin.gameboy.import')
                ->with('success', $successMessage);
                
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.gameboy.import')
                ->with('error', 'Erreur lors du scraping : ' . $e->getMessage());
        }
    }
}
