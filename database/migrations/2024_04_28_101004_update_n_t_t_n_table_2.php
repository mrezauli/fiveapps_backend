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
            $table->dropColumn('nttn');
            $table->unsignedBigInteger('nttn_providerId')->nullable()->after('pop_location_type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('n_t_t_n_s', function (Blueprint $table) {
            $table->dropColumn('nttn_providerId');
            $table->enum('nttn', ['SecureNet Bangladesh Limited', 'Advanced Digital Solution Limited'])->after('pop_location_type');
        });
    }
};