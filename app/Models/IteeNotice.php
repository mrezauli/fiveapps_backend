<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IteeNotice extends Model
{
    use HasFactory;

    protected $fillable = ['notice', 'status'];
}
