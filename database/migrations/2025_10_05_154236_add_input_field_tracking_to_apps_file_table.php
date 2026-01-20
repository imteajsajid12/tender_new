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
        Schema::table('apps_file', function (Blueprint $table) {
            // Add columns to track which input field was used for upload
            $table->string('input_field_name')->nullable()->after('file_name')->comment('The HTML input field name/key used for upload');
            $table->text('input_field_label')->nullable()->after('input_field_name')->comment('The Hebrew label/title of the input field');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('apps_file', function (Blueprint $table) {
            $table->dropColumn(['input_field_name', 'input_field_label']);
        });
    }
};
