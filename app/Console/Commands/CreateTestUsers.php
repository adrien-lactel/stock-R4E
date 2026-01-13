<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Store;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateTestUsers extends Command
{
    protected $signature = 'create:test-users';
    protected $description = 'Crée des utilisateurs de test (1 admin + 2 magasins)';

    public function handle()
    {
        $this->info('Création des utilisateurs de test...');

        // Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@test.fr'],
            [
                'name' => 'Admin Test',
                'password' => Hash::make('StockR4E@Admin2024!Secure'),
                'role' => 'admin',
            ]
        );
        $this->line("✅ Admin créé : admin@test.fr / StockR4E@Admin2024!Secure");

        // Magasin 1
        $store1 = Store::firstOrCreate(
            ['name' => 'Magasin Test Paris'],
            [
                'city' => 'Paris',
                'address' => '123 Rue de Test, 75001 Paris',
            ]
        );

        $user1 = User::updateOrCreate(
            ['email' => 'magasin1@test.fr'],
            [
                'name' => 'Magasin Paris',
                'password' => Hash::make('MagasinParis@2024!Secure'),
                'role' => 'store',
                'store_id' => $store1->id,
            ]
        );
        $this->line("✅ Magasin 1 créé : magasin1@test.fr / MagasinParis@2024!Secure (Paris)");

        // Magasin 2
        $store2 = Store::firstOrCreate(
            ['name' => 'Magasin Test Lyon'],
            [
                'city' => 'Lyon',
                'address' => '456 Avenue de Test, 69001 Lyon',
            ]
        );

        $user2 = User::updateOrCreate(
            ['email' => 'magasin2@test.fr'],
            [
                'name' => 'Magasin Lyon',
                'password' => Hash::make('MagasinLyon@2024!Secure'),
                'role' => 'store',
                'store_id' => $store2->id,
            ]
        );
        $this->line("✅ Magasin 2 créé : magasin2@test.fr / MagasinLyon@2024!Secure (Lyon)");

        $this->info("\n📋 Identifiants de test :");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->info("ADMIN");
        $this->info("  Email : admin@test.fr");
        $this->info("  Mot de passe : StockR4E@Admin2024!Secure");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->info("MAGASIN PARIS");
        $this->info("  Email : magasin1@test.fr");
        $this->info("  Mot de passe : MagasinParis@2024!Secure");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
        $this->info("MAGASIN LYON");
        $this->info("  Email : magasin2@test.fr");
        $this->info("  Mot de passe : MagasinLyon@2024!Secure");
        $this->info("━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━━");
    }
}
