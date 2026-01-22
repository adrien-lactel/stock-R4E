<?php

namespace App\Console\Commands;

use App\Models\GameBoyGame;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class ScrapeGameBoyDatabase extends Command
{
    protected $signature = 'gameboy:scrape';
    protected $description = 'Scrape Game Boy games from gbhwdb.gekkio.fi and full-set.net';

    public function handle()
    {
        $this->info('🎮 Starting Game Boy database scraping...');
        
        // Étape 1: Scraper gbhwdb.gekkio.fi pour ROM IDs et années
        $this->info('📡 Fetching data from gbhwdb.gekkio.fi...');
        $gbhwdbData = $this->scrapeGbhwdb();
        
        // Étape 2: Scraper full-set.net pour images et prix
        $this->info('📡 Fetching data from full-set.net...');
        $fullsetData = $this->scrapeFullset();
        
        // Étape 3: Merger les données
        $this->info('🔗 Merging data...');
        $merged = $this->mergeData($gbhwdbData, $fullsetData);
        
        // Étape 4: Sauvegarder en base
        $this->info('💾 Saving to database...');
        $bar = $this->output->createProgressBar(count($merged));
        
        foreach ($merged as $game) {
            // Utiliser name comme clé unique si rom_id est null
            $uniqueKey = !empty($game['rom_id']) 
                ? ['rom_id' => $game['rom_id']] 
                : ['name' => $game['name'], 'rom_id' => null];
            
            GameBoyGame::updateOrCreate($uniqueKey, $game);
            $bar->advance();
        }
        
        $bar->finish();
        $this->newLine();
        
        // Statistiques finales
        $totalGames = GameBoyGame::count();
        $gamesWithImages = GameBoyGame::whereNotNull('image_url')->count();
        $gamesWithYear = GameBoyGame::whereNotNull('year')->count();
        
        $this->info("✅ Scraping terminé !");
        $this->info("📊 Statistiques :");
        $this->info("   • Total de jeux : {$totalGames}");
        $this->info("   • Jeux avec image : {$gamesWithImages} ({$this->percentage($gamesWithImages, $totalGames)}%)");
        $this->info("   • Jeux avec année : {$gamesWithYear} ({$this->percentage($gamesWithYear, $totalGames)}%)");
        
        return Command::SUCCESS;
    }
    
    protected function percentage(int $part, int $total): int
    {
        return $total > 0 ? round(($part / $total) * 100) : 0;
    }

    protected function scrapeGbhwdb(): array
    {
        $response = Http::timeout(60)->get('https://gbhwdb.gekkio.fi/cartridges/gb.html');
        $html = $response->body();
        
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        libxml_clear_errors();
        
        $xpath = new \DOMXPath($dom);
        $rows = $xpath->query('//table//tr');
        
        $games = [];
        foreach ($rows as $row) {
            $cells = $xpath->query('.//td', $row);
            
            if ($cells->length < 3) {
                continue;
            }
            
            $name = trim($cells->item(0)->textContent);
            $romId = trim($cells->item(1)->textContent);
            $year = trim($cells->item(2)->textContent);
            
            // Ignorer les headers
            if (empty($name) || $name === 'Game Name' || empty($romId) || $romId === 'ROM ID') {
                continue;
            }
            
            $games[] = [
                'name' => $name,
                'rom_id' => $romId,
                'year' => $year ?: null,
                'source' => 'gbhwdb',
            ];
        }
        
        $this->info("  → Found " . count($games) . " games from gbhwdb");
        return $games;
    }

    protected function scrapeFullset(): array
    {
        $response = Http::timeout(60)->get('https://full-set.net/collection/gameboy.html');
        $html = $response->body();
        
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHTML($html);
        libxml_clear_errors();
        
        $xpath = new \DOMXPath($dom);
        $rows = $xpath->query('//table//tr');
        
        $games = [];
        foreach ($rows as $row) {
            $cells = $xpath->query('.//td', $row);
            
            if ($cells->length < 4) {
                continue;
            }
            
            $name = trim($cells->item(1)->textContent);
            
            // Récupérer l'URL de l'image
            $imgNodes = $xpath->query('.//img', $cells->item(2));
            $imageUrl = null;
            if ($imgNodes->length > 0) {
                $src = $imgNodes->item(0)->getAttribute('src');
                $imageUrl = Str::startsWith($src, 'http') ? $src : 'https://full-set.net' . $src;
            }
            
            $price = trim($cells->item(3)->textContent);
            
            if (empty($name) || is_numeric($name)) {
                continue;
            }
            
            $games[] = [
                'name' => $name,
                'image_url' => $imageUrl,
                'price' => $price ?: null,
                'source' => 'fullset',
            ];
        }
        
        $gamesWithImages = collect($games)->filter(fn($g) => !empty($g['image_url']))->count();
        $this->info("  → Found " . count($games) . " games from full-set.net");
        $this->info("  → Images found: {$gamesWithImages} / " . count($games));
        
        return $games;
    }

    protected function mergeData(array $gbhwdbData, array $fullsetData): array
    {
        $merged = [];
        
        foreach ($gbhwdbData as $gbGame) {
            $match = null;
            
            // Recherche d'une correspondance par nom
            foreach ($fullsetData as $fsGame) {
                if ($this->namesMatch($gbGame['name'], $fsGame['name'])) {
                    $match = $fsGame;
                    break;
                }
            }
            
            $merged[] = array_merge($gbGame, $match ?? [], [
                'source' => $match ? 'merged' : 'gbhwdb',
            ]);
        }
        
        // Ajouter les jeux uniquement présents sur full-set.net
        foreach ($fullsetData as $fsGame) {
            $found = false;
            foreach ($merged as $mergedGame) {
                if ($this->namesMatch($fsGame['name'], $mergedGame['name'])) {
                    $found = true;
                    break;
                }
            }
            
            if (!$found) {
                $merged[] = array_merge($fsGame, ['source' => 'fullset']);
            }
        }
        
        return $merged;
    }

    protected function namesMatch(string $name1, string $name2): bool
    {
        $normalize = fn($str) => strtolower(preg_replace('/[^a-z0-9]/i', '', $str));
        
        $n1 = $normalize($name1);
        $n2 = $normalize($name2);
        
        // Correspondance exacte
        if ($n1 === $n2) {
            return true;
        }
        
        // Correspondance partielle (70% de similarité)
        similar_text($n1, $n2, $percent);
        return $percent >= 70;
    }
}
