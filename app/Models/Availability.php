<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as Audit;
use OwenIt\Auditing\Contracts\Auditable;

class Availability extends Model implements Auditable
{
    use HasFactory, Audit;

    protected $fillable = [
        'company_id',
        'meeting_room_id',
        'day_week',
        'start_time',
        'end_time',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
