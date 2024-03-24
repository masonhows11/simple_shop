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
    public function isMedia()
    {
        return $this->type == 'video';
    }

    //// for get path of (media) file
    public function absolutePath()
    {
        return
            resolve(StorageManager::class)->getAbsolutePathOf($this->name, $this->type, $this->is_private);
    }

    //// for download file based on path & file name
    public function download()
    {
        //// clear instance from  StorageManager and call downloadFile() function with parameters
        /// then download file in downloadFile() function
        return
            resolve(StorageManager::class)->downloadFile($this->name, $this->type, $this->is_private);
    }

    public function delete(){
        //// this delete file from storage
        resolve(StorageManager::class)->deleteFile($this->name, $this->type, $this->is_private);
        //// this delete current record from database
        parent::delete();
    }
}
