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
        Schema::table('console_offers', function (Blueprint $table) {
            $table->boolean('payment_received')->default(false)->after('status');
            $table->date('payment_date')->nullable()->after('payment_received');
            $table->datetime('shipped_at')->nullable()->after('payment_date');
            $table->string('tracking_number')->nullable()->after('shipped_at');
            $table->string('carrier')->nullable()->after('tracking_number');
            $table->datetime('received_at')->nullable()->after('carrier');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('console_offers', function (Blueprint $table) {
            $table->dropColumn([
                'payment_received',
                'payment_date',
                'shipped_at',
                'tracking_number',
                'carrier',
                'received_at'
            ]);
        });
    }
};
