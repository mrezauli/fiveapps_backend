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
            $table->string('name')->nullable()->after('entry_by');
            $table->string('identification')->nullable()->after('entry_by');
            $table->string('organization')->nullable()->after('entry_by');
            $table->string('designation')->nullable()->after('entry_by');
            $table->string('phone')->nullable()->after('entry_by');
            $table->string('email')->nullable()->after('entry_by');
            $table->string('name_of_personnel')->nullable()->after('entry_by');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('ndc_appointments', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('identification');
            $table->dropColumn('organization');
            $table->dropColumn('designation');
            $table->dropColumn('phone');
            $table->dropColumn('email');
            $table->dropColumn('name_of_personnel');
        });
    }
};
