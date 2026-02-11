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
            if (!Schema::hasColumn('consoles', 'primary_image_url')) {
                $table->string('primary_image_url')->nullable()->after('article_images');
            }
            if (!Schema::hasColumn('consoles', 'image_captions')) {
                $table->json('image_captions')->nullable()->after('primary_image_url');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('consoles', function (Blueprint $table) {
            if (Schema::hasColumn('consoles', 'primary_image_url')) {
                $table->dropColumn('primary_image_url');
            }
            if (Schema::hasColumn('consoles', 'image_captions')) {
                $table->dropColumn('image_captions');
            }
        });
    }
};
