<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NTTN extends Model
{
    use HasFactory;

    protected $fillable = [
        'union_id',
        'phone',
        'pop_location',
        'pop_location_type',
        'nttn_providerId'
    ];

    public function union()
    {
        return $this->belongsTo(Union::class);
    }

    public function provider()
    {
        return $this->belongsTo(NttnProvider::class, 'nttn_providerId');
    }
}
