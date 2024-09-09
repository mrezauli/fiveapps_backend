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
        Schema::table('itee_exam_fees', function (Blueprint $table) {
            $table->dateTime('exam_start')->default(now())->change();
            $table->dateTime('exam_end')->default(now())->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itee_exam_fees', function (Blueprint $table) {
            $table->date('exam_start')->default(now())->change();
            $table->date('exam_end')->default(now())->change();
        });
    }
};
