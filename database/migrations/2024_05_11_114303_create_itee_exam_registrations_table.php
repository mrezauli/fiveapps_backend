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
        Schema::create('itee_exam_registrations', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->bigInteger('itee_venue_id');
            $table->bigInteger('itee_exam_category_id');
            $table->bigInteger('itee_exam_type_id');
            $table->string('exam_fees');
            $table->bigInteger('itee_book_id');
            $table->string('itee_book_fees');
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('dob');
            $table->string('gender');
            $table->text('address');
            $table->string('post_code');
            $table->string('occupation');
            $table->string('photo');
            $table->string('education_qualification');
            $table->string('subject_name');
            $table->integer('passing_year');
            $table->string('institute_name');
            $table->string('result');
            $table->string('previous_passing_id')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('payment')->default('Unpaid');
            $table->tinyInteger('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itee_exam_registrations');
    }
};
