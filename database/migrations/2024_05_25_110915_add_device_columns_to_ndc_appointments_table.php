<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('ndc_appointments', function (Blueprint $table) {
            $table->string('device_model')->nullable()->after('entry_by');
            $table->string('device_serial')->nullable()->after('device_model');
            $table->longText('device_description')->nullable()->after('device_serial');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ndc_appointments', function (Blueprint $table) {
            $table->dropColumn(['device_model', 'device_serial', 'device_description']);
        });
    }
};
