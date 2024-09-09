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
        Schema::create('itee_books', function (Blueprint $table) {
            $table->id();
            $table->text('book_name');
            $table->float('book_price');
            $table->boolean('status')->default(false)->comment('1=Active, 0=Inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itee_books');
    }
};