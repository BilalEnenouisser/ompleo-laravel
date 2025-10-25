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
        // Update the target_type enum to include 'specific'
        DB::statement("ALTER TABLE notifications MODIFY COLUMN target_type ENUM('all', 'candidates', 'recruiters', 'specific') NOT NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert the target_type enum to original values
        DB::statement("ALTER TABLE notifications MODIFY COLUMN target_type ENUM('all', 'candidates', 'recruiters') NOT NULL");
    }
};
