<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('address')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('address');
            $table->text('notes')->nullable()->after('postal_code');
            $table->boolean('is_active')->default(true)->after('notes');
            $table->string('siret')->nullable()->after('is_active');
            $table->string('vat_number')->nullable()->after('siret');
            $table->string('manager_name')->nullable()->after('vat_number');
            $table->text('opening_hours')->nullable()->after('manager_name');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stores', function (Blueprint $table) {
            $table->dropColumn([
                'phone',
                'address',
                'postal_code',
                'notes',
                'is_active',
                'siret',
                'vat_number',
                'manager_name',
                'opening_hours',
            ]);
        });
    }
};
