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
        Schema::table('bkiict_batches', function (Blueprint $table) {
            $table->date('class_start')->default(now())->change();
            $table->date('deadline')->default(now())->change();
            $table->enum('status', ['ongoing', 'upcoming', 'deactive'])->default('ongoing')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bkiict_batches', function (Blueprint $table) {
            $table->boolean('status')->default(true)->change();
            $table->timestamp('class_start')->change();
            $table->timestamp('deadline')->change();
        });
    }
};