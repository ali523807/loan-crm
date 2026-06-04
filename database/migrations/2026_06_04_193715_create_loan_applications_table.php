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
        Schema::create('loan_applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->cascadeOnDelete();
            $table->foreignId('assigned_to_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('application_number')->unique();
            $table->string('status')->default('new_lead')->index();
            $table->string('loan_type');
            $table->unsignedBigInteger('loan_amount');
            $table->string('loan_tenure')->nullable();
            $table->string('loan_purpose')->nullable();
            $table->string('employment_type')->nullable();
            $table->string('company_name')->nullable();
            $table->unsignedBigInteger('monthly_income')->nullable();
            $table->unsignedBigInteger('existing_emi')->nullable();
            $table->string('work_experience')->nullable();
            $table->string('contact_time')->nullable();
            $table->timestamp('submitted_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('loan_applications');
    }
};
