<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IteeExamType extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'category_id', 'image', 'status'];

    public function category()
    {
        return $this->belongsTo(IteeExamCategory::class);
    }

}
