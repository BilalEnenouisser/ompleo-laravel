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
        Schema::create('subscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('recruiter_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('company_id')->nullable()->constrained('companies')->onDelete('cascade');
            $table->date('start_date');
            $table->date('end_date');
            $table->enum('status', ['active', 'expired', 'pending', 'cancelled'])->default('pending');
            $table->string('payment_method')->nullable(); // 'banque', 'CCP', etc.
            $table->decimal('amount', 10, 2);
            $table->string('transaction_id')->nullable()->unique();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['recruiter_id', 'status']);
            $table->index(['company_id', 'status']);
            $table->index('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('subscriptions');
    }
};
