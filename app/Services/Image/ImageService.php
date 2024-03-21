<?php


namespace App\Services\Image;


class ImageService extends ImageServiceTools
{

    // for save image in to public directory
    public function save($image)
    {
        $this->setImage($image);
        $this->provider();
        $result = $image->move(public_path($this->getFinalImgDirectory()), $this->getFinalImgName());
        return $result ? $this->getImageAddress() : false;
    }

    // for save image in to storage directory
    public function moveToStorage($image)
    {
        $this->setImage($image);
        $this->provider();
        // $result = $file->move(storage_path( self::STORAGE . $this->getFinalFileDirectory()), $this->getFinalFileName());
        $result = $image->storeAs($this->getFinalImgDirectory(),$this->getFinalImgName(),'public');
        return $result ? $this->getImageAddress() : false;
    }

    // for delete image
    public function deleteImage($filePath)
    {
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    // for delete directory & file
    public function deleteDirectoryAndImages($directory)
    {

        if (!is_dir($directory)) {
            return false;
        }

        $files = glob($directory . DIRECTORY_SEPARATOR . '*',GLOB_MARK);
        foreach ($files as $file)
        {
            if (is_dir($file))
            {
                $this->deleteDirectoryAndImages($file);
            } else {
                unlink($file);
            }
        }

        return rmdir($directory);
    }
}
