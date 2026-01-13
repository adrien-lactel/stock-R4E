<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('console_returns', function (Blueprint $table) {
            $table->boolean('acknowledged')->default(false)->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('console_returns', function (Blueprint $table) {
            $table->dropColumn('acknowledged');
        });
    }
};
