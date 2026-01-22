<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use App\Models\GameBoyGame;

class GameBoyGameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ne scraper que si la table est vide
        if (GameBoyGame::count() === 0) {
            $this->command->info('Table game_boy_games vide, lancement du scraping...');
            Artisan::call('gameboy:scrape');
            $this->command->info('Scraping terminé : ' . GameBoyGame::count() . ' jeux importés.');
        } else {
            $this->command->info('Table game_boy_games déjà remplie (' . GameBoyGame::count() . ' jeux), scraping ignoré.');
        }
    }
}
