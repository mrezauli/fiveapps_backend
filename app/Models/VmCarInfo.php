<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VmCarInfo extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'model_number',
        'vehicle_number',
        'status'
    ];
}
