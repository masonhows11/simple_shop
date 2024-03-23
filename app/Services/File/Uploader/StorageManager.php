<?php


namespace App\Services\File\Uploader;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageManager
{

    public function storeFileAsPrivate(string $name,UploadedFile $file,string $type)
    {
        return Storage::disk('private')->putFileAs($type,$file,$name);
    }

    public function storeFileAsPublic(string $name,UploadedFile $file,string $type)
    {
        return Storage::disk('public')->putFileAs($type,$file,$name);
    }

}
