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
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            if (!Schema::hasColumn('password_reset_tokens', 'email')) {
                $table->string('email')->index()->after('id');
            }

            if (!Schema::hasColumn('password_reset_tokens', 'token')) {
                $table->string('token')->after('email');
            }

            if (!Schema::hasColumn('password_reset_tokens', 'created_at')) {
                $table->timestamp('created_at')->nullable()->after('token');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('password_reset_tokens', function (Blueprint $table) {
            if (Schema::hasColumn('password_reset_tokens', 'token')) {
                $table->dropColumn('token');
            }

            if (Schema::hasColumn('password_reset_tokens', 'email')) {
                // drop index safely if exists
                $connection = Schema::getConnection();
                $sm = $connection->getDoctrineSchemaManager();
                $indexes = array_map(fn($i) => $i->getName(), $sm->listTableIndexes('password_reset_tokens'));
                if (in_array('email', $indexes)) {
                    $table->dropIndex('email');
                } elseif (in_array('password_reset_tokens_email_index', $indexes)) {
                    $table->dropIndex('password_reset_tokens_email_index');
                }

                $table->dropColumn('email');
            }

            if (Schema::hasColumn('password_reset_tokens', 'created_at')) {
                // only drop created_at if it was added by the migration and not a full timestamps() column
                // If your app expects updated_at too, avoid dropping it blindly.
                // We check for updated_at presence and drop created_at only if updated_at does not exist.
                if (!Schema::hasColumn('password_reset_tokens', 'updated_at')) {
                    $table->dropColumn('created_at');
                }
            }
        });
    }
};
