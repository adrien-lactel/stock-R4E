<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mods', function (Blueprint $table) {
            $table->id();
            $table->foreignId('console_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->text('description');
            $table->integer('price');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mods');
    }
};
