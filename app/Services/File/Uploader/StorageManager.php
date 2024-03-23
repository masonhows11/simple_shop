<?php


namespace App\Services\File\Uploader;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageManager
{

    public function storeFileAsPrivate(string $name, UploadedFile $file, string $type)
    {
        return Storage::disk('private')->putFileAs($type, $file, $name);
    }

    public function storeFileAsPublic(string $name, UploadedFile $file, string $type)
    {
        return Storage::disk('public')->putFileAs($type, $file, $name);
    }

    //// return absolute path of file
    public function getAbsolutePathOf(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->path($type . DIRECTORY_SEPARATOR . $name);
    }

    private function disk(bool $isPrivate)
    {
        return $isPrivate ? Storage::disk('private') : Storage::disk('public');
    }


}
