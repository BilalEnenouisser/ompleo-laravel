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
        Schema::table('candidate_profiles', function (Blueprint $table) {
            if (!Schema::hasColumn('candidate_profiles', 'experience_years')) {
                $table->string('experience_years')->nullable()->after('experience');
            }
            if (!Schema::hasColumn('candidate_profiles', 'availability')) {
                $table->string('availability')->nullable()->after('experience_years');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('candidate_profiles', function (Blueprint $table) {
            if (Schema::hasColumn('candidate_profiles', 'experience_years')) {
                $table->dropColumn('experience_years');
            }
            if (Schema::hasColumn('candidate_profiles', 'availability')) {
                $table->dropColumn('availability');
            }
        });
    }
};
