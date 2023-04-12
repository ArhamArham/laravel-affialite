<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Coupon extends Model
{
    use HasFactory;

    protected $table = 'tbl_coupons';

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
