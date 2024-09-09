<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IteeExamCategory extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];

}
