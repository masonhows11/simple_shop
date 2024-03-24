<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Services\File\Uploader\Uploader;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    private Uploader $uploader;

    public function __construct(Uploader $uploader)
    {
        $this->uploader = $uploader;
    }


    public function profile()
    {
        return view('front_user.profile.profile');
    }

    public function validateFile($request): void
    {
        //// 'file' => ['required', 'file', 'mimes:jpeg,mp4,zip,rar']
        $request->validate([
            'file' => ['required', 'file', 'mimetypes:image/jpeg,video/mp4,application/zip']
        ]);
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
