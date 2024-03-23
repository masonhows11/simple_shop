<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function profile()
    {
        return view('front_user.profile.profile');
    }

    public function validateFile($request): void
    {
        $request->validate([
            'file' => ['required', 'file', 'mimetypes:image/jpeg,video/mp4,application/zip']
        ]);
        dd($request->file);
    }


    public function storeAvatar(Request $request)
    {
        $this->validateFile($request);
    }
}
