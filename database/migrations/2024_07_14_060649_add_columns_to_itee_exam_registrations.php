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
        Schema::table('itee_exam_registrations', function (Blueprint $table) {
            $table->string('examine_id')->nullable()->after('id');
            $table->string('exam_center')->nullable()->after('itee_exam_type_id');

            // -----------

            $table->bigInteger('user_id')->nullable()->change();
            $table->bigInteger('itee_venue_id')->nullable()->change();
            $table->bigInteger('itee_exam_category_id')->nullable()->change();
            $table->bigInteger('itee_exam_type_id')->nullable()->change();
            $table->string('exam_fees')->nullable()->change();
            $table->bigInteger('itee_book_id')->nullable()->change();
            $table->string('itee_book_fees')->nullable()->change();
            $table->string('full_name')->nullable()->change();
            $table->string('email')->nullable()->change();
            $table->string('phone')->nullable()->change();
            $table->string('dob')->nullable()->change();
            $table->string('gender')->nullable()->change();
            $table->text('address')->nullable()->change();
            $table->string('post_code')->nullable()->change();
            $table->string('occupation')->nullable()->change();
            $table->string('photo')->nullable()->change();
            $table->string('education_qualification')->nullable()->change();
            $table->string('subject_name')->nullable()->change();
            $table->integer('passing_year')->nullable()->change();
            $table->string('institute_name')->nullable()->change();
            $table->string('result')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('itee_exam_registrations', function (Blueprint $table) {
            $table->dropColumn(['examine_id', 'exam_center']);
            // -------
            $table->bigInteger('user_id')->change();
            $table->bigInteger('itee_venue_id')->change();
            $table->bigInteger('itee_exam_category_id')->change();
            $table->bigInteger('itee_exam_type_id')->change();
            $table->string('exam_fees')->change();
            $table->bigInteger('itee_book_id')->change();
            $table->string('itee_book_fees')->change();
            $table->string('full_name')->change();
            $table->string('email')->change();
            $table->string('phone')->change();
            $table->string('dob')->change();
            $table->string('gender')->change();
            $table->text('address')->change();
            $table->string('post_code')->change();
            $table->string('occupation')->change();
            $table->string('photo')->change();
            $table->string('education_qualification')->change();
            $table->string('subject_name')->change();
            $table->integer('passing_year')->change();
            $table->string('institute_name')->change();
            $table->string('result')->change();
        });
    }
};