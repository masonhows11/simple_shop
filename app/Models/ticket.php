<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
    protected $table ='tickets';
    protected $fillable = [
        'title',
        'user_id',
        'message',
        'priority',
        'status',
        'file_path',
        'department'
    ];
}
