<?php


namespace App\Services\File\Uploader;


use App\Exceptions\FileHasExistsException;
use App\Models\File;
use Illuminate\Http\Request;

class Uploader
{

    private Request $request;
    private StorageManager $manager;
    private FFMPegService $ffmpeg;
    private $file;
    public function __construct(Request $request,StorageManager $manager,FFMPegService $FFMPegService)
    {
        $this->request = $request;
        $this->manager = $manager;
        $this->file = $request->file;
        $this->ffmpeg = $FFMPegService;
    }



    public function upload()
    {

        //// first check file is exists
        if($this->isFileExists()) throw new FileHasExistsException(__('messages.the_file_has_already_been_uploaded'));
        $this->putFileInStorage();
        return $this->saveFileInDatabase();
    }

    private function saveFileInDatabase()
    {

        $file = new File([
            'name' => $this->file->getClientOriginalName(),
            'size' => $this->file->getSize(),
            'type' => $this->getType(),
            'is_private' => $this->isPrivate(),
        ]);

        //// get time of file
        $file->time = $this->getTime($file);
        $file->save();
        return redirect()->back()->with('success', __('messages.upload_file_done'));



    }

    private function getTime(File $file){

        if(!$file->isMedia()) return null;
        return $this->ffmpeg->durationOf($file->absolutePath());

    }

    private function putFileInStorage(){

        //// this how to determine store is private or public
        /// for choose method private or public
        $method = $this->request->has('is_private') ? 'storeFileAsPrivate' : 'storeFileAsPublic';
        $this->manager->$method($this->file->getClientOriginalName(),$this->file,$this->getType());
    }

    private function isFileExists(){
       return $this->manager->isFileExists($this->file->getClientOriginalName(),$this->getType(),$this->isPrivate());
    }


    private function getType()
    {
        //// return type of file
        return ['image/jpeg' => 'image','video/mp4' => 'video','application/x-zip-compressed' =>'archive'][$this->file->getClientMimeType()];
    }

    public function isPrivate()
    {
        return $this->request->has('is_private');
    }
}
