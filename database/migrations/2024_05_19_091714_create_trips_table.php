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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('driver_with_car_id')->nullable();
            $table->string('name');
            $table->string('designation');
            $table->string('department');
            $table->string('purpose');
            $table->string('phone');
            $table->string('destination_from');
            $table->string('destination_to');
            $table->string('date');
            $table->string('time');
            $table->string('type');
            $table->timestamp('start_trip')->nullable();
            $table->timestamp('stop_trip')->nullable();
            $table->enum('status', ['Pending', 'Accepted', 'Rejected', 'Finished']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
