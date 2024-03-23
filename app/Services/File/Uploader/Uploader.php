<?php


namespace App\Services\File\Uploader;


use Illuminate\Http\Request;

class Uploader
{

    private Request $request;
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function upload()
    {
        
    }
}
