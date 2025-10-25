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
        // Check if the jobs table exists, if not, skip this migration
        if (!Schema::hasTable('jobs')) {
            return;
        }

        Schema::table('jobs', function (Blueprint $table) {
            // Only add columns if they don't already exist
            if (!Schema::hasColumn('jobs', 'company_id')) {
                $table->foreignId('company_id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('jobs', 'recruiter_id')) {
                $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade');
            }
            if (!Schema::hasColumn('jobs', 'slug')) {
                $table->string('slug')->unique();
            }
            if (!Schema::hasColumn('jobs', 'description')) {
                $table->text('description');
            }
            if (!Schema::hasColumn('jobs', 'requirements')) {
                $table->json('requirements')->nullable();
            }
            if (!Schema::hasColumn('jobs', 'benefits')) {
                $table->json('benefits')->nullable();
            }
            if (!Schema::hasColumn('jobs', 'salary_min')) {
                $table->decimal('salary_min', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('jobs', 'salary_max')) {
                $table->decimal('salary_max', 10, 2)->nullable();
            }
            if (!Schema::hasColumn('jobs', 'location')) {
                $table->string('location');
            }
            if (!Schema::hasColumn('jobs', 'type')) {
                $table->enum('type', ['CDI', 'CDD', 'Freelance', 'Stage'])->default('CDI');
            }
            if (!Schema::hasColumn('jobs', 'experience_level')) {
                $table->string('experience_level')->nullable();
            }
            if (!Schema::hasColumn('jobs', 'tags')) {
                $table->json('tags')->nullable();
            }
            if (!Schema::hasColumn('jobs', 'status')) {
                $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            }
            if (!Schema::hasColumn('jobs', 'application_deadline')) {
                $table->date('application_deadline')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jobs', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropForeign(['recruiter_id']);
            $table->dropColumn([
                'company_id', 'recruiter_id', 'slug', 'description', 
                'requirements', 'benefits', 'salary_min', 'salary_max',
                'location', 'type', 'experience_level', 'tags', 'status', 'application_deadline'
            ]);
        });
    }
};
