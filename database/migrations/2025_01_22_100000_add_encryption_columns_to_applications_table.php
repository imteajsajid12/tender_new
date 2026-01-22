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
     * was used to encrypt the email field in the applications table.
     */
    public function up(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (!Schema::hasColumn('applications', 'encryption_key_slot')) {
                $table->string('encryption_key_slot', 255)->nullable()->after('tenderval');
            }
        });

        // Ensure email column can accommodate encrypted data (TEXT is already used)
        // The email column is already TEXT type, so no modification needed
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('applications', function (Blueprint $table) {
            if (Schema::hasColumn('applications', 'encryption_key_slot')) {
                $table->dropColumn('encryption_key_slot');
            }
        });
    }
};
