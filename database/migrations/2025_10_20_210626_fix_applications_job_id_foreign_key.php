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
        if (!Schema::hasTable('applications') || !Schema::hasColumn('applications', 'job_id')) {
            return;
        }

        if (!Schema::hasTable('job_postings')) {
            return;
        }

        Schema::table('applications', function (Blueprint $table) {
            // Drop existing foreign key constraint if present.
            try {
                $table->dropForeign(['job_id']);
            } catch (\Throwable $e) {
            }
        });

        Schema::table('applications', function (Blueprint $table) {
            // Keep canonical foreign key to job_postings table.
            try {
                $table->foreign('job_id')->references('id')->on('job_postings')->onDelete('cascade');
            } catch (\Throwable $e) {
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
