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
        Schema::table('loan_documents', function (Blueprint $table) {
            $table->foreignId('uploaded_by_id')->nullable()->after('loan_application_id')->constrained('users')->nullOnDelete();
            $table->string('previous_path')->nullable()->after('path');
            $table->timestamp('uploaded_at')->nullable()->after('verified_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('loan_documents', function (Blueprint $table) {
            $table->dropConstrainedForeignId('uploaded_by_id');
            $table->dropColumn(['previous_path', 'uploaded_at']);
        });
    }
};
