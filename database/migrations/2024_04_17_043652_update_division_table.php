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
        Schema::table('divisions', function (Blueprint $table) {
            $table->string('bn_name')->nullable()->change();
            $table->string('url')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('divisions', function (Blueprint $table) {
            $table->string('bn_name')->change();
            $table->string('url')->change();
        });
    }
};
