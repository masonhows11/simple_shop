<?php

namespace App\Models;

use App\Services\Permission\Traits\HasPermission;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory,HasPermission;

    protected $fillable = [
        'name','persian_name'
    ];
}
