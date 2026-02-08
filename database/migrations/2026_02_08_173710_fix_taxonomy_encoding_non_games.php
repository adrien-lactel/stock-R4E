<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Corrections d'encodage pour les types non-jeux vidéo
        // Nettoyer les parenthèses vides laissées par le symbole Ⓒ
        
        $updates = [
            582 => 'Manette GameCube Orange Spice',
            575 => 'Manette N64 Donkey Kong 64',
            576 => 'Manette N64 Funtastic Clear Blue',
            572 => 'Manette N64 Gold',
            573 => 'Manette N64 Pikachu',
            574 => 'Manette N64 Pokémon Snap',
            606 => '20th Anniversary Controller',
            596 => 'DualShock 2 Ceramic White',
            595 => 'DualShock 2 Ocean Blue',
            605 => 'DualShock 4 Crystal',
            615 => 'Manette Xbox Duke',
        ];
        
        foreach ($updates as $id => $name) {
            DB::table('article_types')
                ->where('id', $id)
                ->update(['name' => $name]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Pas de rollback - les noms originaux étaient corrompus
    }
};
