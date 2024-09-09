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
        Schema::create('vlm_staff_hierarchies', function (Blueprint $table) {
            $table->id();
            $table->integer('seniorStaffId')->unsigned();
            $table->json('juniorStaffs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vlm_staff_hierarchies');
    }
};
