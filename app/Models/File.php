<?php

namespace App\Models;

use App\Services\File\Uploader\StorageManager;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'size',
        'time',
        'type',
        'is_private',
        'path'
    ];
    //// determine file is media or not
    public function isMedia(){
        return $this->type == 'video';
    }

    //// for get path of (media) file
    public function absolutePath()
    {
        return
            resolve(StorageManager::class)->getAbsolutePathOf($this->name,$this->type,$this->is_private);
    }
}
