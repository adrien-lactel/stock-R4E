<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GameBoyGame;
use Illuminate\Support\Facades\DB;

class GameBoyGamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Vider la table d'abord
        DB::table('game_boy_games')->truncate();

        // Charger les données depuis le fichier JSON
        $jsonPath = base_path('game_boy_export.json');
        
        if (!file_exists($jsonPath)) {
            $this->command->error('Fichier game_boy_export.json introuvable !');
            return;
        }

        $games = json_decode(file_get_contents($jsonPath), true);
        
        if (!$games) {
            $this->command->error('Erreur lors de la lecture du fichier JSON !');
            return;
        }

        $this->command->info('Import de ' . count($games) . ' jeux Game Boy...');

        // Insérer par batch de 100 pour optimiser
        $chunks = array_chunk($games, 100);
        
        foreach ($chunks as $chunk) {
            DB::table('game_boy_games')->insert($chunk);
        }

        $this->command->info('✅ ' . count($games) . ' jeux importés avec succès !');
    }
}
