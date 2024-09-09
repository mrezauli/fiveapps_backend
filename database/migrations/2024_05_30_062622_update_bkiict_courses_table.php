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
        Schema::table('bkiict_courses', function (Blueprint $table) {
            $table->dropColumn(['deadline', 'class_start']);
            $table->json('instructor')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bkiict_courses', function (Blueprint $table) {
            $table->timestamp('deadline')->nullable();
            $table->timestamp('class_start')->nullable();
            $table->string('instructor')->nullable()->change();
        });
    }
};
