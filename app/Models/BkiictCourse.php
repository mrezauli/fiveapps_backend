<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class BkiictCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'instructor',
        'cordinator',
        'overview',
        'requirements',
        'project',
        'tools',
        'outline',
        'duration',
        'hours',
        'fee',
        'shift',
        // 'deadline',
        'classes',
        'center_id',
        // 'class_start',
        'type',
        'status',
    ];

    public function center()
    {
        return $this->belongsTo(BkiictCenter::class);
    }

    public function ins_cordinator()
    {
        return $this->belongsTo(BkiictTeacher::class, 'cordinator');
    }

    // public function instructors()
    // {
    //     return BkiictTeacher::whereIn('id', json_decode($this->instructor))->get();
    // }

    public function batches(): HasMany
    {
        return $this->hasMany(BkiictBatch::class);
    }
}