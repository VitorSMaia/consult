<?php

namespace App\Models;

use App\BelongsToCompany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as Audit;
use OwenIt\Auditing\Contracts\Auditable;

class MeetingRooms extends Model implements Auditable
{
    use HasFactory, Audit;

    protected $fillable = [
        'company_id',
        'name',
        'description',
        'slug',
        'status',
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
