<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This table stores OTP codes for two-factor authentication.
     * Designed to be reusable across different Laravel projects.
     */
    public function up(): void
    {
        Schema::create('otp_codes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('email', 191);
            $table->string('otp_code', 10);
            $table->string('purpose', 50)->default('login'); // login, password_reset, email_verify, etc.
            $table->boolean('is_verified')->default(false);
            $table->timestamp('expires_at');
            $table->integer('attempts')->default(0); // Track failed verification attempts
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            // Indexes for performance
            $table->index(['user_id', 'purpose']);
            $table->index(['email', 'otp_code']);
            $table->index('expires_at');

            // Foreign key constraint (only add if users table exists)
            // Uncomment the lines below if you want to enforce the foreign key constraint
            // $table->foreign('user_id')
            //       ->references('id')
            //       ->on('users')
            //       ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('otp_codes');
    }
};
