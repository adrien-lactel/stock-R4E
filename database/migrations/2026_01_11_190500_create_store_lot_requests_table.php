<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('store_lot_requests', function (Blueprint $table) {
            $table->id();

            $table->foreignId('store_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->foreignId('console_offer_id')
                ->constrained()
                ->cascadeOnDelete();

            $table->integer('quantity')->default(1);

            $table->enum('status', ['pending', 'validated', 'rejected'])
                ->default('pending');

            $table->text('admin_comment')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('store_lot_requests');
    }
};
