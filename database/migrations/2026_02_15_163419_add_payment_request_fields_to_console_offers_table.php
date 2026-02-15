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
            $table->datetime('sold_at')->nullable()->after('received_at');
            $table->boolean('payment_requested')->default(false)->after('sold_at');
            $table->decimal('payment_request_amount', 10, 2)->nullable()->after('payment_requested');
            $table->boolean('payment_confirmed')->default(false)->after('payment_request_amount');
            $table->datetime('payment_confirmed_at')->nullable()->after('payment_confirmed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('console_offers', function (Blueprint $table) {
            $table->dropColumn([
                'sold_at',
                'payment_requested',
                'payment_request_amount',
                'payment_confirmed',
                'payment_confirmed_at'
            ]);
        });
    }
};
