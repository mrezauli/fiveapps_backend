<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'phone',
        'email',
        'app_name',
        'password',
        'active',
        'user_type',
        'isp_user_type',
        'organization',
        'designation',
        'occupation',
        'linkedin',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'license_number',
        'photo',
        'ndc_admin_sector',
        'identification_number'
    ];

    /**
     * An associative array where keys are the internal names of the apps
     * and values are the human-readable names.
     *
     * @var array
     */
    public $apps = [
        'bcc_connect' => 'BCC Connect',
        'bkiict' => 'BKIICT',
        'ndc' => 'NDC',
        'itee' => 'ITEE',
        'vehicle_management' => 'Vehicle Management'
    ];

    /**
     * this is status array. here 0 mean inactive and 1 mean active
     *
     *
     * @var array
     */
    public static $statusArray = [0, 1];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function upazila()
    {
        return $this->belongsTo(Upazila::class);
    }

    public function union()
    {
        return $this->belongsTo(Union::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class, 'division_id', 'division_id');
    }


    public function upazilas()
    {
        return $this->hasMany(Upazila::class, 'district_id', 'district_id');
    }


    public function unions()
    {
        return $this->hasMany(Union::class, 'upazila_id', 'upazila_id');
    }

}
