<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This migration adds an encryption_key_slot column to track which APP_KEY
     * was used to encrypt the name and email fields.
     * It also increases the size of name and email columns to accommodate encrypted data.
     */
    public function up(): void
    {
        // First, drop the unique index on email (if exists)
        Schema::table('users', function (Blueprint $table) {
            // Try to drop unique index - may have different names
            try {
                $table->dropUnique(['email']);
            } catch (\Exception $e) {
                // Index might not exist or have different name
            }
        });

        // Use raw SQL to modify columns and drop index if needed
        try {
            DB::statement('ALTER TABLE users DROP INDEX users_email_unique');
        } catch (\Exception $e) {
            // Index might not exist
        }

        // Add encryption key slot column
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'encryption_key_slot')) {
                $table->string('encryption_key_slot', 10)->nullable()->after('status');
            }
        });

        // Change name and email columns to TEXT to accommodate encrypted data
        DB::statement('ALTER TABLE users MODIFY name TEXT NOT NULL');
        DB::statement('ALTER TABLE users MODIFY email TEXT NOT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert columns back to varchar (only if data is decrypted first!)
        DB::statement('ALTER TABLE users MODIFY name VARCHAR(191) NOT NULL');
        DB::statement('ALTER TABLE users MODIFY email VARCHAR(191) NOT NULL');

        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('encryption_key_slot');
            // Re-add unique index on email
            $table->unique('email');
        });
    }
};
