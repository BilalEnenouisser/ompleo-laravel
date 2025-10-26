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
        Schema::create('interviews', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('candidate_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('job_id')->constrained('job_postings')->onDelete('cascade');
            $table->foreignId('application_id')->nullable()->constrained('applications')->onDelete('cascade');
            
            // Interview details
            $table->date('interview_date');
            $table->time('start_time');
            $table->integer('duration_minutes')->default(60); // Duration in minutes
            $table->enum('type', ['visioconference', 'presentiel', 'telephonique'])->default('visioconference');
            $table->string('location')->nullable(); // For presentiel: "Bureau Chéraga", for telephonique: phone number, for visioconference: platform name
            $table->text('notes')->nullable();
            
            // Status management
            $table->enum('status', ['programme', 'confirme', 'en_attente', 'annule', 'termine'])->default('programme');
            
            // Meeting details for visioconference
            $table->string('meeting_link')->nullable();
            $table->string('meeting_id')->nullable();
            $table->string('meeting_password')->nullable();
            
            $table->timestamps();
            
            // Indexes for better performance
            $table->index(['recruiter_id', 'interview_date']);
            $table->index(['candidate_id', 'interview_date']);
            $table->index(['status', 'interview_date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('interviews');
    }
};
