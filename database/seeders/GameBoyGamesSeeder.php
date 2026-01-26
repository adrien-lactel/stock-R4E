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
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('game_boy_games')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Données hardcodées (extrait du fichier JSON pour Railway)
        $gamesData = $this->getGamesData();
        
        $this->command->info('Import de ' . count($gamesData) . ' jeux Game Boy...');

        // Insérer par batch de 100 pour optimiser
        $chunks = array_chunk($gamesData, 100);
        
        foreach ($chunks as $i => $chunk) {
            DB::table('game_boy_games')->insert($chunk);
            if ($i % 5 == 0) {
                $this->command->info('Importé ' . (($i + 1) * 100) . ' jeux...');
            }
        }

        $this->command->info('✅ ' . count($gamesData) . ' jeux importés avec succès !');
    }

    private function getGamesData(): array
    {
        $jsonPath = base_path('game_boy_export.json');
        
        if (file_exists($jsonPath)) {
            $games = json_decode(file_get_contents($jsonPath), true);
            if ($games) {
                return $games;
            }
        }

        // Fallback: retourner au moins quelques jeux pour l'autocomplétion
        $this->command->warn('Fichier JSON non trouvé, import partiel uniquement');
        return $this->getSampleData();
    }

    private function getSampleData(): array
    {
        // Sample de quelques jeux populaires pour tester
        return [
            ["rom_id" => "DMG-MLA-0", "name" => "Super Mario Land", "year" => "1989", "image_url" => null, "cloudinary_url" => null, "price" => null, "source" => "manual", "publisher" => "Nintendo"],
            ["rom_id" => "DMG-MQE-0", "name" => "Super Mario Land 2: 6 Golden Coins", "year" => "1992", "image_url" => null, "cloudinary_url" => null, "price" => null, "source" => "manual", "publisher" => "Nintendo"],
            ["rom_id" => "DMG-TRA-0", "name" => "Tetris", "year" => "1989", "image_url" => null, "cloudinary_url" => null, "price" => null, "source" => "manual", "publisher" => "Nintendo"],
            ["rom_id" => "DMG-A1J-0", "name" => "Aretha", "year" => null, "image_url" => null, "cloudinary_url" => null, "price" => null, "source" => "manual", "publisher" => null],
        ];
    }
}
