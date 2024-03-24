<?php


namespace App\Services\File\Uploader;


use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageManager
{

    //// store as private access
    public function storeFileAsPrivate(string $name, UploadedFile $file, string $type)
    {
        return Storage::disk('private')->putFileAs($type, $file, $name);
    }
    //// store as public access
    public function storeFileAsPublic(string $name, UploadedFile $file, string $type)
    {
        return Storage::disk('public')->putFileAs($type, $file, $name);
    }

    //// return absolute path of file
    public function getAbsolutePathOf(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->path($this->directoryPrefix($type,$name));
    }
    //// check file is exists or not
    public function isFileExists(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->exists($this->directoryPrefix($type,$name));
    }
    //// extract method
    private function directoryPrefix($type,$name){
        return $type . DIRECTORY_SEPARATOR . $name;
    }

    //// download file based on path & file name
    public function downloadFile(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->download($this->directoryPrefix($type,$name));
    }

    //// download file based on path & file name
    public function deleteFile(string $name, string $type, bool $isPrivate)
    {
        return $this->disk($isPrivate)->delete($this->directoryPrefix($type,$name));
    }

    private function disk(bool $isPrivate)
    {
        return $isPrivate ? Storage::disk('private') : Storage::disk('public');
    }




}
