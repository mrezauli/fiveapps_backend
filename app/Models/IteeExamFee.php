<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IteeExamFee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'itee_exam_type_id',
        'itee_exam_category_id',
        'fee',
        'details',
        'exam_start',
        'exam_end',
    ];

    public function exam_type()
    {
        return $this->belongsTo(IteeExamType::class, 'itee_exam_type_id');
    }

    public function exam_category()
    {
        return $this->belongsTo(IteeExamCategory::class, 'itee_exam_category_id');
    }
}
