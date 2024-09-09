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
        Schema::table('itee_admit_card_data', function (Blueprint $table) {
            $table->bigInteger('area_id')->after('area');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itee_admit_card_data', function (Blueprint $table) {
            $table->dropColumn('area_id');
        });
    }
};
