<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IteeBook extends Model
{
    use HasFactory;

    protected $fillable = [
        'book_name',
        'book_price',
        'status',
    ];
}
