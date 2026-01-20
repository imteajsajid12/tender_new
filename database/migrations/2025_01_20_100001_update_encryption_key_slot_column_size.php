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
     * This migration increases the size of encryption_key_slot column
     * to store the full APP_KEY instead of just a hash.
     */
    public function up(): void
    {
        // Change encryption_key_slot to VARCHAR(100) to store full APP_KEY
        DB::statement('ALTER TABLE users MODIFY encryption_key_slot VARCHAR(100) NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Revert to smaller size (will truncate data!)
        DB::statement('ALTER TABLE users MODIFY encryption_key_slot VARCHAR(10) NULL');
    }
};
