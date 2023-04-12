<?php

namespace App\Models;

use App\Traits\HasApiWhere;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory, HasApiWhere;

    protected $table = 'tbl_networks';
}
