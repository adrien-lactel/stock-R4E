<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ImportGameBoyGames extends Command
{
    protected $signature = 'gameboy:import';
    protected $description = 'Import Game Boy games from local data to Railway';

    public function handle()
    {
        // Essayer les deux fichiers
        $jsonPath = base_path('game_boy_games_clean.json');
        if (!file_exists($jsonPath)) {
            $jsonPath = base_path('game_boy_export.json');
        }
        
        if (!file_exists($jsonPath)) {
            $this->error('No JSON file found!');
            return 1;
        }

        $this->info('Reading: ' . basename($jsonPath));
        $games = json_decode(file_get_contents($jsonPath), true);
        
        if (!$games) {
            $this->error('Invalid JSON data! Error: ' . json_last_error_msg());
            return 1;
        }

        $this->info('Found ' . count($games) . ' games to import');
        
        // Truncate table
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('game_boy_games')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $this->info('Table cleared');
        
        // Import in chunks
        $bar = $this->output->createProgressBar(count($games));
        $bar->start();
        
        foreach (array_chunk($games, 100) as $chunk) {
            DB::table('game_boy_games')->insert($chunk);
            $bar->advance(count($chunk));
        }
        
        $bar->finish();
        $this->newLine();
        $this->info('✅ Successfully imported ' . count($games) . ' Game Boy games!');
        
        return 0;
    }
}
