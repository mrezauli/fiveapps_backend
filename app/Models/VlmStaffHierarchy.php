<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VlmStaffHierarchy extends Model
{
    use HasFactory;

    protected $fillable = [
        'seniorStaffId',
        'juniorStaffs'
    ];

}
