<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Upazila extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'district_id',
        'bn_name',
        'url'
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function unions()
    {
        return $this->hasMany(Union::class);
    }

}