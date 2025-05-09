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
        Schema::table('users', function (Blueprint $table) {
            $table->string('user_type')->nullable();
            $table->string('phone')->nullable();
            $table->timestamp('mobile_verified_at')->nullable();
            $table->string('mobile_verify_code')->nullable();
            $table->tinyInteger('mobile_attempts_left')->default(0);
            $table->timestamp('mobile_last_attempt_date')->nullable();
            $table->timestamp('mobile_verify_code_sent_at')->nullable();
            $table->string('isp_user_type')->nullable();
            $table->string('organization')->nullable();
            $table->string('designation')->nullable();
            $table->string('license_number')->nullable();
            $table->string('photo')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('user_type');
            $table->dropColumn('phone');
            $table->dropColumn('isp_user_type');
            $table->dropColumn('organization');
            $table->dropColumn('designation');
            $table->dropColumn('license_number');
            $table->dropColumn('photo');
        });
    }
};
