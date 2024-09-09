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
        Schema::create('ndc_appointments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('approved_by')->nullable();
            $table->bigInteger('entry_by')->nullable();
            $table->string('appoint_mentor');
            $table->text('purpose');
            $table->text('belong');
            $table->string('date');
            $table->string('time');
            $table->string('entry_time')->nullable();
            $table->string('status')->default('Pending')->comment('Pending, Accepted, Rejected');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ndc_appointments');
    }
};
