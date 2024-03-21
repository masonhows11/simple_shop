<?php


namespace App\Services\File;


class FileService extends FileToolsService
{


     const STORAGE = 'public/';

    // for save file in to public directory
    public function moveToPublic($file)
    {

        $this->setFile($file);
        $this->provider();
        $result = $file->move(public_path($this->getFinalFileDirectory()), $this->getFinalFileName());
        return $result ? $this->getFileAddress() : false;

    }


    // for save file in to storage directory
    public function moveToStorage($file)
    {
        $this->setFile($file);
        $this->provider();
       // $result = $file->move(storage_path( self::STORAGE . $this->getFinalFileDirectory()), $this->getFinalFileName());
        $result = $file->storeAs($this->getFinalFileDirectory(),$this->getFinalFileName(),'public');
        return $result ? $this->getFileAddress() : false;
    }


    // for delete file
    public function deleteFile($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // for delete directory & file
    public function deleteDirectoryAndFiles($directory)
    {

        if (!is_dir($directory)) {
            return false;
        }

        $files = glob($directory . DIRECTORY_SEPARATOR . '*',GLOB_MARK);
        foreach ($files as $file)
        {
            if (is_dir($file))
            {
                $this->deleteDirectoryAndFiles($file);
            } else {
                unlink($file);
            }
        }

        return rmdir($directory);
    }

}
