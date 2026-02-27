<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Add composite and individual indexes to the users table
 * for improved query performance on frequently-filtered columns.
 */
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Index on activated column: used heavily for filtering active vs unverified users
            if (! $this->indexExists('users', 'users_activated_index')) {
                $table->index('activated', 'users_activated_index');
            }

            // Index on deleted_at for soft delete queries
            if (! $this->indexExists('users', 'users_deleted_at_index')) {
                $table->index('deleted_at', 'users_deleted_at_index');
            }

            // Composite index for activated + deleted_at — most common combined filter
            if (! $this->indexExists('users', 'users_activated_deleted_at_index')) {
                $table->index(['activated', 'deleted_at'], 'users_activated_deleted_at_index');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndexIfExists('users_activated_index');
            $table->dropIndexIfExists('users_deleted_at_index');
            $table->dropIndexIfExists('users_activated_deleted_at_index');
        });
    }

    /**
     * Check whether a given index already exists on the table.
     *
     * @param  string  $table
     * @param  string  $indexName
     * @return bool
     */
    private function indexExists(string $table, string $indexName): bool
    {
        $conn    = Schema::getConnection();
        $dbName  = $conn->getDatabaseName();
        $indexes = $conn->select(
            "SELECT INDEX_NAME FROM information_schema.STATISTICS
             WHERE TABLE_SCHEMA = ? AND TABLE_NAME = ? AND INDEX_NAME = ?",
            [$dbName, $table, $indexName]
        );

        return count($indexes) > 0;
    }
};
