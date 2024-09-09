<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DriverWithCar extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'vm_car_info_id',
    ];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function car():BelongsTo
    {
        return $this->belongsTo(VmCarInfo::class, 'vm_car_info_id');
    }

    public function trip():BelongsTo
    {
        return $this->belongsTo(Trip::class, 'vm_car_info_id');
    }
}
