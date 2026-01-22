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
        
        return view('admin.gameboy.import', compact('gamesCount'));
    }

    public function import(Request $request)
    {
        try {
            // Lancer le scraping en arrière-plan
            set_time_limit(300); // 5 minutes max
            
            Artisan::call('gameboy:scrape');
            $output = Artisan::output();
            
            $gamesCount = GameBoyGame::count();
            
            return redirect()
                ->route('admin.gameboy.import')
                ->with('success', "Scraping terminé avec succès ! {$gamesCount} jeux importés.");
                
        } catch (\Exception $e) {
            return redirect()
                ->route('admin.gameboy.import')
                ->with('error', 'Erreur lors du scraping : ' . $e->getMessage());
        }
    }
}
