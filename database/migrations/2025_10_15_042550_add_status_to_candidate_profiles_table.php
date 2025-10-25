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
        // Check if the candidate_profiles table exists, if not, skip this migration
        if (!Schema::hasTable('candidate_profiles')) {
            return;
        }

        Schema::table('candidate_profiles', function (Blueprint $table) {
            // Only add column if it doesn't already exist
            if (!Schema::hasColumn('candidate_profiles', 'status')) {
                $table->enum('status', ['active', 'suspended', 'pending'])->default('active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_profiles', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
};
