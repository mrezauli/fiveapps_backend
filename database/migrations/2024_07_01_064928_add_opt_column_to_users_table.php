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
        Schema::table('users', function (Blueprint $table) {
            // $table->string('opt')->nullable()->after('active');
            // $table->timestamp('valid_until')->nullable()->after('opt');
            $table->string('occupation')->nullable()->after('designation');
            $table->string('linkedin')->nullable()->after('occupation');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([/* 'opt', 'valid_until',  */ 'occupation', 'linkedin']);
        });
    }
};