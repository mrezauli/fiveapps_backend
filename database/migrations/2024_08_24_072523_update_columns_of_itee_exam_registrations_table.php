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
        Schema::table('itee_exam_registrations', function (Blueprint $table) {
            //$table->json('itee_book_id')->change();
            DB::statement('ALTER TABLE itee_exam_registrations ALTER COLUMN itee_book_id TYPE json USING itee_book_id::json');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itee_exam_registrations', function (Blueprint $table) {
            //$table->bigInteger('itee_book_id')->change();
            DB::statement('ALTER TABLE itee_exam_registrations ALTER COLUMN itee_book_id TYPE text USING itee_book_id::text');
        });
    }
};