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
        // Canonical table is job_postings; legacy jobs patch should no-op.
        if (Schema::hasTable('job_postings')) {
            return;
        }

        // Check if the jobs table exists, if not, skip this migration
        if (!Schema::hasTable('jobs')) {
            return;
        }

        Schema::table('jobs', function (Blueprint $table) {
            // Only add timestamps if they don't already exist
            if (!Schema::hasColumn('jobs', 'created_at') && !Schema::hasColumn('jobs', 'updated_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Legacy compatibility migration: never rollback schema changes.
        return;
    }
};
