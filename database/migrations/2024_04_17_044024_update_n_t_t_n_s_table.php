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
        Schema::table('n_t_t_n_s', function (Blueprint $table) {
            $table->text('pop_location')->nullable()->change();
            $table->text('pop_location_type')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('n_t_t_n_s', function (Blueprint $table) {
            $table->text('pop_location')->change();
            $table->text('pop_location_type')->change();
        });
    }
};