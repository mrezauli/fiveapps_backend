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
        Schema::create('n_t_t_n_s', function (Blueprint $table) {
            $table->id();
            $table->foreignId('union_id')->constrained()->onDelete('cascade');
            $table->text('pop_location');
            $table->text('pop_location_type');
            $table->enum('nttn', ['SecureNet Bangladesh Limited', 'Advanced Digital Solution Limited']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('n_t_t_n_s');
    }
};
