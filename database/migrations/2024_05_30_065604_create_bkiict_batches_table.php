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
        Schema::create('bkiict_batches', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('number');
            $table->timestamp('deadline');
            $table->timestamp('class_start');
            $table->date('course_end');
            $table->foreignId('bkiict_course_id')->constrained()->onDelete('cascade');
            $table->boolean('complete')->default(false);
            $table->boolean('status')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bkiict_batches');
    }
};
