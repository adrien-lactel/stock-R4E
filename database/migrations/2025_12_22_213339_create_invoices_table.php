<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained()->onDelete('cascade');
            $table->foreignId('console_id')->constrained()->onDelete('cascade');
            $table->integer('amount');
            $table->string('status');
            $table->date('issued_at');
            $table->date('invoice_date');
            $table->timestamps();
                    });
    }

    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
