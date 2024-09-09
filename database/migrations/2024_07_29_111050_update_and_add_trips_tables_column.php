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
        Schema::table('trips', function (Blueprint $table) {
            $table->renameColumn('time', 'start_time');
        });
        Schema::table('trips', function (Blueprint $table) {
            $table->string('end_time')->after('start_time');
            $table->string('approx_distance')->after('end_time');
            $table->string('trip_category')->after('approx_distance');
            $table->string('attachment_file')->after('status')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->renameColumn('start_time', 'time');
        });
        Schema::table('trips', function (Blueprint $table) {
            $table->dropColumn('end_time');
            $table->dropColumn('approx_distance');
            $table->dropColumn('trip_category');
            $table->dropColumn('attachment_file');
        });
    }
};
