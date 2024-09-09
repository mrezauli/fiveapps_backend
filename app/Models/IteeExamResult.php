<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IteeExamResult extends Model
{
    use HasFactory;

    protected $fillable = [
        'passer_id',
        'examine_id',
        'name',
        'dob',
        'morning_passer',
        'afternoon_passer',
        'passing_session',
        'exam_type',
        'status',
    ];
}
