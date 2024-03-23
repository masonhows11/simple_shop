<?php


namespace App\Services\File\Uploader;


use Illuminate\Http\Request;

class Uploader
{

    private Request $request;
    private StorageManager $manager;
    private $file;
    public function __construct(Request $request,StorageManager $manager)
    {
        $this->request = $request;
        $this->manager = $manager;
        $this->file = $request->file;
    }



    public function upload()
    {
        $this->putFileInStorage();
    }

    private function putFileInStorage(){

        //// this how to determine store is private or public
        /// for choose method private or public
        $method = $this->request->has('is_private') ? 'storeFileAsPrivate' : 'storeFileAsPublic';
        $this->manager->$method($this->file->getClientOriginalName(),$this->file,$this->getType());
    }


    private function getType()
    {
        //// return type of file
        return ['image/jpeg' => 'image','video/mp4' => 'video','application/x-zip-compressed' =>'archive'][$this->file->getClientMimeType()];
    }
}
