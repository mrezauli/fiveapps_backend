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
        Schema::table('ndc_appointments', function (Blueprint $table) {
            $table->dropColumn('appoint_mentor');
            $table->bigInteger('user_id')->nullable()->change();
            $table->string('sector')->after('entry_by');
            $table->string('guest_name')->after('entry_time')->nullable();
            $table->string('guest_identification')->after('entry_time')->nullable();
            $table->string('guest_organization')->after('entry_time')->nullable();
            $table->string('guest_designation')->after('entry_time')->nullable();
            $table->string('guest_phone')->after('entry_time')->nullable();
            $table->string('guest_email')->after('entry_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ndc_appointments', function (Blueprint $table) {
            $table->bigInteger('user_id')->change();
            $table->string('appoint_mentor');
            $table->dropColumn('sector');
            $table->dropColumn('guest_name');
            $table->dropColumn('guest_identification');
            $table->dropColumn('guest_organization');
            $table->dropColumn('guest_designation');
            $table->dropColumn('guest_phone');
            $table->dropColumn('guest_email');
        });
    }
};