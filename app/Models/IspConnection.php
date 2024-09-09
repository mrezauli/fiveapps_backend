<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class IspConnection extends Model
{
    use HasFactory;

    protected $table = "isp_connections";

    protected $fillable = [
        'user_id',
        'request_type',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'nttn_provider',
        'link_capacity',
        'remark',
        'status',
    ];
    public static $status = ['Pending', 'Accepted', 'Rejected'];

    public function division(): BelongsTo
    {
        return $this->BelongsTo(Division::class);
    }

    public function district(): BelongsTo
    {
        return $this->BelongsTo(District::class);
    }

    public function upazila(): BelongsTo
    {
        return $this->BelongsTo(Upazila::class);
    }

    public function union(): BelongsTo
    {
        return $this->BelongsTo(Union::class);
    }

    public function nttnProvider(): BelongsTo
    {
        return $this->BelongsTo(NTTN::class, 'nttn_provider', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->BelongsTo(User::class, 'user_id', 'id');
    }
}
