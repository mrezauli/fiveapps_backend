<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkiictExamRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'center_id',
        'type',
        'course_id',
        'batch_id',
        'course_fee',
        'full_name',
        'email',
        'phone',
        'dob',
        'gender',
        'photo',
        'education_qualification',
        'subject_name',
        'discipline',
        'passing_year',
        'institute_name',
        'result',
        'certificate_photo',
        'transaction_id',
        'payment',
        'status',
    ];
}