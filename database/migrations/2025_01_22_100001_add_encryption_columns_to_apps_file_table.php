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
     * was used to encrypt the url and file_name fields in the apps_file table.
     */
    public function up(): void
    {
        Schema::table('apps_file', function (Blueprint $table) {
            if (!Schema::hasColumn('apps_file', 'encryption_key_slot')) {
                $table->string('encryption_key_slot', 255)->nullable()->after('input_field_label');
            }
        });

        // Ensure url and file_name columns can accommodate encrypted data (TEXT is already used)
        // These columns are already TEXT type, so no modification needed
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apps_file', function (Blueprint $table) {
            if (Schema::hasColumn('apps_file', 'encryption_key_slot')) {
                $table->dropColumn('encryption_key_slot');
            }
        });
    }
};
