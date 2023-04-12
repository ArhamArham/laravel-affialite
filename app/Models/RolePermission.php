<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RolePermission extends Model
{
    use HasFactory;

    protected $table = 'tbl_role_permissions';

    protected $casts = [
        'permissions' => 'array'
    ];

    public function module(): BelongsTo
    {
        return $this->belongsTo(Module::class);
    }

}
