<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Module extends Model
{
    use HasFactory;

    protected $table = 'tbl_modules';

    protected $casts = [
        'permissions' => 'json'
    ];

    public function children(): HasMany
    {
        return $this->hasMany(static::class, 'parent_id');
    }
}
