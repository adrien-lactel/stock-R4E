<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use App\Models\Console;
use App\Models\ArticleCategory;
use App\Models\ArticleSubCategory;
use App\Models\ArticleType;
use App\Models\Repairer;
use App\Models\Mod;
use Illuminate\Support\Str;

class DemoFullSeeder extends Seeder
{
    public function run(): void
    {
        // Catégories, sous-catégories, types
        $cat = ArticleCategory::firstOrCreate(['name' => 'Console']);
        $sub = ArticleSubCategory::firstOrCreate([
            'name' => 'Portable',
            'article_category_id' => $cat->id
        ]);
        $type = ArticleType::firstOrCreate([
            'name' => 'Switch',
            'article_sub_category_id' => $sub->id
        ]);

        // Magasins
        $store1 = Store::factory()->create(['name' => 'Paris']);
        $store2 = Store::factory()->create(['name' => 'Lyon']);

        // Réparateurs
        $repairer1 = Repairer::factory()->create(['name' => 'Réparateur A']);
        $repairer2 = Repairer::factory()->create(['name' => 'Réparateur B']);

        // Mods
        $mod1 = Mod::factory()->create(['name' => 'Mod Chip']);
        $mod2 = Mod::factory()->create(['name' => 'Batterie']);

        // Utilisateurs
        User::updateOrCreate(
            ['email' => 'admin@stock-r4e.com'],
            [
                'name' => 'Ahmed Terry',
                'role' => 'admin',
                'password' => bcrypt('password'), // ou le hash souhaité
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );
        User::updateOrCreate(
            ['email' => 'store-paris@stock-r4e.com'],
            [
                'name' => 'Store Paris',
                'role' => 'store',
                'store_id' => $store1->id,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );
        User::updateOrCreate(
            ['email' => 'store-lyon@stock-r4e.com'],
            [
                'name' => 'Store Lyon',
                'role' => 'store',
                'store_id' => $store2->id,
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
            ]
        );

        // Consoles
        foreach (range(1, 10) as $i) {
            $console = Console::factory()->create([
                'article_category_id' => $cat->id,
                'article_sub_category_id' => $sub->id,
                'article_type_id' => $type->id,
                'store_id' => $i % 2 ? $store1->id : $store2->id,
                'repairer_id' => $i % 2 ? $repairer1->id : $repairer2->id,
                'status' => 'stock',
            ]);
            // Attacher mods avec price_applied obligatoire
            $console->mods()->attach([
                $mod1->id => ['price_applied' => 0],
                $mod2->id => ['price_applied' => 0],
            ]);
        }
    }
}
