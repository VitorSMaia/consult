<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Auditable as Audit;
use Illuminate\Database\Eloquent\Relations\HasMany;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Permission;

class GroupPermission extends Model implements Auditable
{
    use HasFactory, Audit;

    protected $table = 'group_permissions';

    protected $fillable = ['name'];

    public function permission(): HasMany
    {
        return $this->hasMany(Permission::class);
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
