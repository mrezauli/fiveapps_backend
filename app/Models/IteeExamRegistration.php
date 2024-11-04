<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IteeExamRegistration extends Model
{
    use HasFactory;

    protected $casts = [
        'itee_book_id' => 'array',
    ];

    protected $fillable = [
        'examine_id',
        'user_id',
        'itee_venue_id',
        'itee_exam_category_id',
        'itee_exam_type_id',
        'exam_center',
        'exam_fees',
        'exam_fees_id',
        'itee_book_id',
        'itee_book_fees',
        'full_name',
        'email',
        'phone',
        'dob',
        'gender',
        'address',
        'post_code',
        'occupation',
        'linkedin',
        'photo',
        'education_qualification',
        'subject_name',
        'passing_year',
        'institute_name',
        'result',
        'previous_passing_id',
        'transaction_id',
        'payment',
        'status',
    ];

    protected static function booting()
    {
        static::creating(function ($IteeExamRegistration) {
            $IteeExamRegistration->user_id = auth()->id(); // or Auth::id();
        });
    }

    public function venue()
    {
        return $this->belongsTo(IteeVenue::class, 'itee_venue_id');
    }

    public function category()
    {
        return $this->belongsTo(IteeExamCategory::class, 'itee_exam_category_id');
    }

    public function examType()
    {
        return $this->belongsTo(IteeExamType::class, 'itee_exam_type_id');
    }

    public function book()
    {
        return $this->belongsTo(IteeBook::class, 'itee_book_id');
    }

    public function fee()
    {
        return $this->belongsTo(IteeExamFee::class, 'exam_fees_id');
    }


    public function result()
    {
        return $this->hasOne(IteeExamResult::class, 'examine_id', 'examine_id');
    }

    public function getBooks()
    {
        $bookIds = $this->itee_book_id;

        return IteeBook::whereIn('id', $bookIds)->get();
    }
}
