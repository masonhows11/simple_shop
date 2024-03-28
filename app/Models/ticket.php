<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ticket extends Model
{
    use HasFactory;
    protected $table ='tickets';

    protected $attributes = [
        'status' => 0,
    ];
    protected $fillable = [
        'title',
        'user_id',
        'message',
        'priority',
        'status',
        'file_path',
        'department'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
