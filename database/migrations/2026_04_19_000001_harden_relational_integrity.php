<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('candidate_profiles')) {
            if (!$this->indexExists('candidate_profiles', 'candidate_profiles_user_id_unique')) {
                Schema::table('candidate_profiles', function (Blueprint $table) {
                    $table->unique('user_id');
                });
            }
        }

        if (Schema::hasTable('recruiter_profiles')) {
            if (!$this->indexExists('recruiter_profiles', 'recruiter_profiles_user_id_unique')) {
                Schema::table('recruiter_profiles', function (Blueprint $table) {
                    $table->unique('user_id');
                });
            }

            Schema::table('recruiter_profiles', function (Blueprint $table) {
                try {
                    $table->dropForeign(['user_id']);
                } catch (\Throwable $e) {
                }
                try {
                    $table->dropForeign(['company_id']);
                } catch (\Throwable $e) {
                }
            });

            Schema::table('recruiter_profiles', function (Blueprint $table) {
                try {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                } catch (\Throwable $e) {
                }
                try {
                    $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
                } catch (\Throwable $e) {
                }
            });
        }

        if (Schema::hasTable('applications')) {
            if (!$this->indexExists('applications', 'applications_job_id_candidate_id_unique')) {
                Schema::table('applications', function (Blueprint $table) {
                    $table->unique(['job_id', 'candidate_id']);
                });
            }

            Schema::table('applications', function (Blueprint $table) {
                try {
                    $table->dropForeign(['job_id']);
                } catch (\Throwable $e) {
                }
                try {
                    $table->dropForeign(['candidate_id']);
                } catch (\Throwable $e) {
                }
            });

            Schema::table('applications', function (Blueprint $table) {
                try {
                    $table->foreign('job_id')->references('id')->on('job_postings')->onDelete('cascade');
                } catch (\Throwable $e) {
                }
                try {
                    $table->foreign('candidate_id')->references('id')->on('users')->onDelete('cascade');
                } catch (\Throwable $e) {
                }
            });
        }

        if (Schema::hasTable('candidate_profiles')) {
            Schema::table('candidate_profiles', function (Blueprint $table) {
                try {
                    $table->dropForeign(['user_id']);
                } catch (\Throwable $e) {
                }
            });

            Schema::table('candidate_profiles', function (Blueprint $table) {
                try {
                    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
                } catch (\Throwable $e) {
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasTable('applications')) {
            if ($this->indexExists('applications', 'applications_job_id_candidate_id_unique')) {
                Schema::table('applications', function (Blueprint $table) {
                    $table->dropUnique(['job_id', 'candidate_id']);
                });
            }
        }

        if (Schema::hasTable('candidate_profiles')) {
            if ($this->indexExists('candidate_profiles', 'candidate_profiles_user_id_unique')) {
                Schema::table('candidate_profiles', function (Blueprint $table) {
                    $table->dropUnique(['user_id']);
                });
            }
        }

        if (Schema::hasTable('recruiter_profiles')) {
            if ($this->indexExists('recruiter_profiles', 'recruiter_profiles_user_id_unique')) {
                Schema::table('recruiter_profiles', function (Blueprint $table) {
                    $table->dropUnique(['user_id']);
                });
            }
        }
    }

    /**
     * Determine if a given index exists on the table.
     */
private function indexExists(string $table, string $indexName): bool
{
    if (DB::getDriverName() !== 'mysql') {
        return false;
    }

    $database = DB::getDatabaseName();

    return DB::table('information_schema.STATISTICS')
        ->where('TABLE_SCHEMA', $database)
        ->where('TABLE_NAME', $table)
        ->where('INDEX_NAME', $indexName)
        ->exists();
}
};
