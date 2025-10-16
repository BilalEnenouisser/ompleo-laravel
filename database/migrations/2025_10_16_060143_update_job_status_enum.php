<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update the status enum to include all status values
        DB::statement("ALTER TABLE job_postings MODIFY COLUMN status ENUM('published', 'draft', 'pending', 'expired', 'closed', 'suspended') DEFAULT 'draft'");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert back to original enum values
        DB::statement("ALTER TABLE job_postings MODIFY COLUMN status ENUM('draft', 'published', 'closed') DEFAULT 'draft'");
    }
};