<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'driver_with_car_id',
        'name',
        'designation',
        'department',
        'purpose',
        'phone',
        'destination_from',
        'destination_to',
        'date',
        'start_time',
        'end_time',
        'approx_distance',
        'trip_category',
        'type',
        'start_trip',
        'stop_trip',
        'attachment_file',
        'status',
    ];
    
    public function driverWithCar():BelongsTo
    {
        return $this->belongsTo(DriverWithCar::class);
    }
}
