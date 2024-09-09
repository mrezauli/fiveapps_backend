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
            $table->string('phone')->nullable()->after('union_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('n_t_t_n_s', function (Blueprint $table) {
            $table->dropColumn('phone');
        });
    }
};