<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('console_types', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('average_purchase_price');
            $table->integer('average_loss_percent');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('console_types');
    }
};