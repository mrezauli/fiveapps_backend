<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class NdcAppointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'purpose',
        'belong',
        'date',
        'time',
        'entry_time',
        'status',
        'user_id',
        'approved_by',
        'entry_by',
        'sector',
        'guest_name',
        'guest_identification',
        'guest_organization',
        'guest_designation',
        'guest_phone',
        'guest_email',
        'document_file',
        'name',
        'identification',
        'organization',
        'designation',
        'phone',
        'email',
        'name_of_personnel',
        'device_model',
        'device_serial',
        'device_description',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
