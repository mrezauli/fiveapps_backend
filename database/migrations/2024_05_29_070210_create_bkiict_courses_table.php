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
        Schema::create('bkiict_courses', function (Blueprint $table) {
            $table->id();
            $table->longText('name');
            $table->string('instructor')->nullable();
            $table->string('cordinator')->nullable();
            $table->longText('overview')->nullable();
            $table->longText('requirements')->nullable();
            $table->longText('project')->nullable();
            $table->longText('tools')->nullable();
            $table->longText('outline')->nullable();
            $table->string('duration')->nullable();
            $table->string('hours')->nullable();
            $table->string('fee')->nullable();
            $table->string('shift')->nullable();
            $table->string('classes')->nullable();
            $table->unsignedInteger('center_id')->nullable();
            $table->timestamp('deadline')->nullable();
            $table->timestamp('class_start')->nullable();
            $table->enum('type', ['short', 'long', 'customized'])->default('short');
            $table->enum('status', ['ongoing', 'upcoming', 'deactive'])->default('ongoing');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkiict_courses');
    }
};
