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
        Schema::create('itee_orders', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->default(null);
            $table->string('email', 30)->default(null);
            $table->string('phone', 20)->default(null);
            $table->double('amount')->default(null);
            $table->text('address');
            $table->string('status', 10)->default(null);
            $table->string('transaction_id', 255)->default(null);
            $table->string('currency', 20)->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
