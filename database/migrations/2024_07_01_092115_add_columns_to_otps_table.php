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
        Schema::table('otps', function (Blueprint $table) {
            $table->timestamp('valid_until')->nullable()->after('otp');
            $table->string('type')->nullable()->after('valid_until');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('otps', function (Blueprint $table) {
            $table->dropColumn(['valid_until', 'type']);
        });
    }
};