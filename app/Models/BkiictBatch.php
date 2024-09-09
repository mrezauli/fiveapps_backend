<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BkiictBatch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'deadline',
        'class_start',
        'course_end',
        'bkiict_course_id',
        'complete',
        'status',
    ];

    public function course()
    {
        return $this->belongsTo(BkiictCourse::class, 'bkiict_course_id');
    }
}
