<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Store;

class DeleteAllStores extends Command
{
    protected $signature = 'stores:delete-all {--force : Force la suppression sans confirmation}';
    protected $description = 'Supprimer tous les magasins de la base de données';

    public function handle()
    {
        $count = Store::count();
        
        if ($count === 0) {
            $this->info('Aucun magasin à supprimer.');
            return 0;
        }

        $force = $this->option('force');

        if ($force || $this->confirm("⚠️  Êtes-vous sûr de vouloir supprimer les {$count} magasin(s) ?", false)) {
            Store::query()->delete();
            $this->info("✅ {$count} magasin(s) supprimé(s) avec succès.");
            return 0;
        }

        $this->info('❌ Opération annulée.');
        return 1;
    }
}
