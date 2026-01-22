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
        Schema::table('app_decisions', function (Blueprint $table) {
            // Ensure the email column can hold encrypted strings
            if (Schema::hasColumn('app_decisions', 'email')) {
                try {
                    $table->text('email')->nullable()->change();
                } catch (\Exception $e) {
                    // If the doctrine/dbal package is not available or change() fails,
                    // fallback to raw SQL where possible (MySQL/MariaDB)
                    try {
                        \DB::statement("ALTER TABLE `app_decisions` MODIFY `email` TEXT NULL");
                    } catch (\Exception $ex) {
                        // Log and continue; migration may need manual intervention
                        \Log::error('Failed to alter app_decisions.email: ' . $ex->getMessage());
                    }
                }
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('app_decisions', function (Blueprint $table) {
            if (Schema::hasColumn('app_decisions', 'email')) {
                try {
                    $table->string('email', 191)->nullable()->change();
                } catch (\Exception $e) {
                    try {
                        \DB::statement("ALTER TABLE `app_decisions` MODIFY `email` VARCHAR(191) NULL");
                    } catch (\Exception $ex) {
                        \Log::error('Failed to revert app_decisions.email: ' . $ex->getMessage());
                    }
                }
            }
        });
    }
};
