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
        Schema::table('itee_exam_registrations', function (Blueprint $table) {
            $table->bigInteger('exam_fees_id')->after('exam_fees');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itee_exam_registrations', function (Blueprint $table) {
            $table->dropColumn('exam_fees_id');
        });
    }
};
