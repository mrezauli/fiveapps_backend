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
        Schema::create('itee_admit_card_data', function (Blueprint $table) {
            $table->id();
            $table->string('examine_id');
            $table->string('pin');
            $table->text('name');
            $table->string('sex');
            $table->date('dob');
            $table->string('area');
            $table->string('site');
            $table->string('room_no');
            $table->string('post_code');
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->string('exempt');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itee_admit_card_data');
    }
};
