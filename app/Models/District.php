<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'division_id',
        'bn_name',
        'lat',
        'lon',
        'url'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function upazilas()
    {
        return $this->hasMany(Upazila::class);
    }
}