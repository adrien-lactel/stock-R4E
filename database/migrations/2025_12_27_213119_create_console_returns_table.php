<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('console_returns', function (Blueprint $table) {
            $table->id();

            $table->foreignId('console_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('store_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->text('comment'); // commentaire du magasin

            $table->enum('status', [
                'pending',   // HS déclaré par le magasin
                'approved',  // validé par admin
                'rejected'   // refusé (optionnel)
            ])->default('pending');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('console_returns');
    }
};
