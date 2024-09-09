<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IteeProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'image',
        'description',
        'status',
    ];
}