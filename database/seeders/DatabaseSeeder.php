<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Store;
use App\Models\ConsoleType;
use App\Models\Console;
use App\Models\Article;
use App\Models\Mod;
use App\Models\Invoice;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer un utilisateur admin
        $this->call(CreateAdminUser::class);

        // Créer la taxonomie des consoles
        $this->call(ConsoleTaxonomySeeder::class);

        // 1. Créer quelques magasins
        Store::factory()->count(5)->create();

        // 2. Créer des types de consoles
        ConsoleType::factory()->count(5)->create();

        // 3. Créer des consoles pour chaque magasin
        Console::factory()
            ->count(50) // nombre total de consoles
            ->create();

        // 4. Créer des articles pour les magasins
        Store::all()->each(function ($store) {
            Article::factory()->count(10)->create([
                'store_id' => $store->id,
            ]);
        });

        // 5. Créer des mods pour les consoles
        Console::all()->each(function ($console) {
            Mod::factory()->count(2)->create([
                'console_id' => $console->id,
            ]);
        });

        // 6. Les factures sont automatiquement créées via ConsoleFactory après création d'une console vendue
        // donc pas besoin de créer séparément ici.

        // 7. Game Boy games: lancer manuellement via `php artisan db:seed --class=GameBoyGameSeeder`
    }
}
