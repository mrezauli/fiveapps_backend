<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Interfaces\MustVerifyMobile as IMustVerifyMobile;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Traits\MustVerifyMobile;

class User extends Authenticatable implements IMustVerifyMobile//, MustVerifyEmail
{
    use HasFactory, Notifiable, HasApiTokens, HasRoles, MustVerifyMobile;

    use MustVerifyMobile;

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
        'identification_number',
        'mobile_number',
        'mobile_verify_code',
        'mobile_attempts_left',
        'mobile_last_attempt_date',
        'mobile_verify_code_sent_at',
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
        'mobile_verify_code',
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
            'number_verified_at' => 'datetime',
            'mobile_verify_code_sent_at' => 'datetime',
            'mobile_last_attempt_date' => 'datetime'
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

    public function routeNotificationForVonage($notification)
    {
        return $this->mobile_number;
    }

}
