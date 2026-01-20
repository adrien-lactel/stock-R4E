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
        Schema::table('consoles', function (Blueprint $table) {
            $table->enum('assignment_status', ['unassigned', 'pending_acceptance', 'accepted', 'received'])
                ->default('unassigned')
                ->after('repairer_id');
            $table->timestamp('assignment_accepted_at')->nullable()->after('assignment_status');
            $table->timestamp('assignment_received_at')->nullable()->after('assignment_accepted_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            $table->dropColumn(['assignment_status', 'assignment_accepted_at', 'assignment_received_at']);
        });
    }
};
