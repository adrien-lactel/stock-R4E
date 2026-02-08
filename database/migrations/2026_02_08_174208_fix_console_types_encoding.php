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
        // Correction encodage types de consoles - Retirer le symbole Ⓢ mal encodé
        $types = DB::table('article_types')->select('id', 'name')->get();
        
        foreach ($types as $type) {
            $cleanedName = $type->name;
            
            // Retirer le symbole Ⓢ au début
            $cleanedName = preg_replace('/^Ⓢ\s*/', '', $cleanedName);
            $cleanedName = preg_replace('/^ÔÆ©\s*/', '', $cleanedName);
            
            // Nettoyer autres caractères mal encodés
            $replacements = [
                'Ⓢ' => '',
                'ÔÆ©' => '',
                'Ⓒ' => '',
                '├«' => 'ë',
                '├®' => 'é',
                '├¢' => 'â',
                '├┤' => 'ô',
                '├╗' => 'û',
                '├»' => 'ï',
                '├¿' => 'î',
            ];
            
            foreach ($replacements as $bad => $good) {
                $cleanedName = str_replace($bad, $good, $cleanedName);
            }
            
            // Nettoyer espaces multiples
            $cleanedName = preg_replace('/\s+/', ' ', $cleanedName);
            $cleanedName = trim($cleanedName);
            
            if ($cleanedName !== $type->name) {
                DB::table('article_types')
                    ->where('id', $type->id)
                    ->update(['name' => $cleanedName]);
            }
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
