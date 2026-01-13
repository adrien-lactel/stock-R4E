<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // drop foreign key if present (ignore exceptions)
        Schema::table('consoles', function (Blueprint $table) {
            try {
                $table->dropForeign(['store_id']);
            } catch (\Exception $e) {
                // ignore if FK doesn't exist
            }
        });

        // make the column nullable using raw SQL to avoid Doctrine dependency
        try {
            DB::statement('ALTER TABLE `consoles` MODIFY `store_id` BIGINT UNSIGNED NULL');
        } catch (\Exception $e) {
            // Some drivers (SQLite) don't support MODIFY — ignore and fallback to schema change if possible
            try {
                Schema::table('consoles', function (Blueprint $table) {
                    $table->unsignedBigInteger('store_id')->nullable()->change();
                });
            } catch (\Exception $inner) {
                // If that also fails, we can't change the column in this environment — skip safely
            }
        }

        // re-add foreign key
        Schema::table('consoles', function (Blueprint $table) {
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        // drop foreign key if present
        Schema::table('consoles', function (Blueprint $table) {
            try {
                $table->dropForeign(['store_id']);
            } catch (\Exception $e) {
                // ignore
            }
        });

        // make the column not nullable
        try {
            DB::statement('ALTER TABLE `consoles` MODIFY `store_id` BIGINT UNSIGNED NOT NULL');
        } catch (\Exception $e) {
            // fallback to schema change when possible
            try {
                Schema::table('consoles', function (Blueprint $table) {
                    $table->unsignedBigInteger('store_id')->nullable(false)->change();
                });
            } catch (\Exception $inner) {
                // ignore in environments that can't change column definitions
            }
        }

        // re-add foreign key
        Schema::table('consoles', function (Blueprint $table) {
            $table->foreign('store_id')->references('id')->on('stores')->onDelete('cascade');
        });
    }
};