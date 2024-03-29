<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Models\File;
use App\Services\File\Uploader\Uploader;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    private  $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }


    public function profile()
    {
        $files = File::all();

        // $test = app()->make('test');
        // echo $test;

        return view('front_user.profile.profile', ['files' => $files]);
    }

    public function validateFile($request): void
    {
        //// 'file' => ['required', 'file', 'mimes:jpeg,mp4,zip,rar']
        $request->validate([
            'file' => ['required', 'file', 'mimetypes:image/jpeg,video/mp4,application/zip']
        ]);
    }

    public function getFile(File $file)
    {
        //// this download() is function in File model
        return $file->download();
    }

    public function deleteFile(File $file)
    {

        try {
            $file->delete();
            session()->flash('success', __('messages.The_deletion_was_successful'));
            return redirect()->back();

        } catch (\Exception $ex) {
            return redirect()->back()->withErrors('error', __('messages.An_error_occurred'));
        }

    }


    public function storeAvatar(Request $request)
    {
        try {
            $this->validateFile($request);
            $this->uploader->upload();
            return redirect()->back()->with('success', __('messages.upload_file_done'));
        } catch (\Exception $ex) {
            return redirect()->back()->withErrors($ex->getMessage());
        }

    }
}
