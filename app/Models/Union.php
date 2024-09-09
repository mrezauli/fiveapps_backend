<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Union extends Model
{
    use HasFactory;

    protected $fillable = [
        'upazila_id',
        'name',
        'bn_name',
        'url',
    ];

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function nttns()
    {
        return $this->hasMany(NTTN::class);
    }
}