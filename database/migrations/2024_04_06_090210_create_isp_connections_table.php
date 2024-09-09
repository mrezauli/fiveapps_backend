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
        Schema::create('isp_connections', function (Blueprint $table) {
            $table->id();
            $table->string('request_type');
            $table->unsignedBigInteger('division_id');
            $table->unsignedBigInteger('district_id');
            $table->unsignedBigInteger('upazila_id');
            $table->unsignedBigInteger('union_id');
            $table->string('nttn_provider');
            $table->string('link_capacity');
            $table->text('remark');
            $table->string('status')->default('Pending')->comment('Pending, Accepted');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isp_connections');
    }
};
