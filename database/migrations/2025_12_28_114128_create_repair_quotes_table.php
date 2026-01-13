<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('repair_quotes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('console_id')->constrained()->cascadeOnDelete();
            $table->foreignId('store_id')->constrained()->cascadeOnDelete();
            $table->foreignId('console_return_id')->constrained()->cascadeOnDelete();

            $table->text('problem_description');
            $table->decimal('amount', 8, 2);

            $table->text('admin_comment')->nullable();

            // proposed | accepted | rejected
            $table->string('status')->default('proposed');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('repair_quotes');
    }
};
