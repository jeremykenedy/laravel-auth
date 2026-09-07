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
            if (! Schema::hasIndex('users', 'users_activated_index')) {
                $table->index('activated', 'users_activated_index');
            }

            // Index on deleted_at for soft delete queries
            if (! Schema::hasIndex('users', 'users_deleted_at_index')) {
                $table->index('deleted_at', 'users_deleted_at_index');
            }

            // Composite index for activated + deleted_at - most common combined filter
            if (! Schema::hasIndex('users', 'users_activated_deleted_at_index')) {
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
            foreach ([
                'users_activated_index',
                'users_deleted_at_index',
                'users_activated_deleted_at_index',
            ] as $index) {
                if (Schema::hasIndex('users', $index)) {
                    $table->dropIndex($index);
                }
            }
        });
    }
};
