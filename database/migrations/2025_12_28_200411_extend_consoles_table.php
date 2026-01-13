<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('consoles', function (Blueprint $table) {

            /* =====================
             | IDENTITÉ ARTICLE
             ===================== */

            if (!Schema::hasColumn('consoles', 'category')) {
                $table->string('category')->default('console');
            }

            if (!Schema::hasColumn('consoles', 'sub_category')) {
                $table->string('sub_category')->nullable();
            }

            if (!Schema::hasColumn('consoles', 'initial_status')) {
                $table->string('initial_status')->nullable();
            }

            if (!Schema::hasColumn('consoles', 'serial_number')) {
                $table->string('serial_number')->nullable();
            }

            if (!Schema::hasColumn('consoles', 'provenance_article')) {
                $table->string('provenance_article')->nullable();
            }

            /* =====================
             | FINANCES
             ===================== */

            if (!Schema::hasColumn('consoles', 'prix_achat')) {
                $table->decimal('prix_achat', 10, 2)->nullable();
            }

            if (!Schema::hasColumn('consoles', 'valorisation')) {
                $table->decimal('valorisation', 10, 2)->nullable();
            }

            /* =====================
             | PRODUIT
             ===================== */

            if (!Schema::hasColumn('consoles', 'product_comment')) {
                $table->text('product_comment')->nullable();
            }

            if (!Schema::hasColumn('consoles', 'product_page_url')) {
                $table->string('product_page_url')->nullable();
            }

            /* =====================
             | MODIFICATIONS
             ===================== */

            foreach (['mod_1', 'mod_2', 'mod_3', 'mod_4'] as $mod) {
                if (!Schema::hasColumn('consoles', $mod)) {
                    $table->string($mod)->nullable();
                }
            }

            /* =====================
             | LOGISTIQUE / RÉPARATION
             ===================== */

            if (!Schema::hasColumn('consoles', 'lieu_stockage')) {
                $table->string('lieu_stockage')->nullable();
            }

            if (!Schema::hasColumn('consoles', 'identite_reparateur')) {
                $table->string('identite_reparateur')->nullable();
            }

            if (!Schema::hasColumn('consoles', 'commentaire_reparateur')) {
                $table->text('commentaire_reparateur')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            $table->dropColumn([
                'category',
                'sub_category',
                'initial_status',
                'serial_number',
                'provenance_article',
                'prix_achat',
                'valorisation',
                'product_comment',
                'product_page_url',
                'mod_1',
                'mod_2',
                'mod_3',
                'mod_4',
                'lieu_stockage',
                'identite_reparateur',
                'commentaire_reparateur',
            ]);
        });
    }
};
