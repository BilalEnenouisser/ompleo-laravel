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
        // Check if the recruiter_profiles table exists, if not, skip this migration
        if (!Schema::hasTable('recruiter_profiles')) {
            return;
        }

        Schema::table('recruiter_profiles', function (Blueprint $table) {
            // Only add columns if they don't already exist
            if (!Schema::hasColumn('recruiter_profiles', 'city')) {
                $table->string('city')->nullable();
            }
            if (!Schema::hasColumn('recruiter_profiles', 'status')) {
                $table->enum('status', ['active', 'suspended', 'pending'])->default('active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('recruiter_profiles', function (Blueprint $table) {
            $table->dropColumn(['city', 'status']);
        });
    }
};
