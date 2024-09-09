<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IteeAdmitCardData extends Model
{
    use HasFactory;

    protected $fillable = [
        'examine_id',
        'pin',
        'name',
        'sex',
        'dob',
        'area',
        'area_id',
        'site',
        'room_no',
        'post_code',
        'address',
        'phone',
        'email',
        'exempt'
    ];

    public function e_area()
    {
        return $this->belongsTo(IteeVenue::class, 'area_id');
    }
}