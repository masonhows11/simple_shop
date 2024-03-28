<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ticket extends Model
{
    use HasFactory;

    protected $table = 'tickets';

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

    public function getPriorityAttribute($value)
    {
        return ['پایین', 'متوسط', 'زیاد'][$value];
    }

    public function getStatusNameAttribute()
    {
        return ['باز', 'پاسخ داده شده', 'بسته'][$this->status];
    }

    public function getDepartmentAttribute($value)
    {
        return ['پشتیبانی', 'فنی', 'مالی'][$value];
    }

    public function hasFile()
    {
        return !is_null($this->file_path);
    }


    public function get_file_path()
    {
        return $this->hasFile() ? Storage::url($this->file_path) : null;
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function isCreated()
    {
        return $this->status === 0;
    }

    public function replied()
    {

        $this->status = 1;
        $this->save();
    }
}
