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
        Schema::dropIfExists('itee_exam_results');
        Schema::create('itee_exam_results', function (Blueprint $table) {
            $table->id();
            $table->string('passer_id');
            $table->string('examine_id');
            $table->text('name');
            $table->date('dob');
            $table->boolean('morning_passer')->nullable();
            $table->boolean('afternoon_passer')->nullable();
            $table->string('passing_session');
            $table->string('exam_type');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itee_exam_results', function (Blueprint $table) {
            Schema::dropIfExists('itee_exam_results');
        });
    }
};