<?php

use App\Http\Controllers\Front\Auth\LoginController;
use App\Http\Controllers\Front\Auth\ProfileController;
use App\Http\Controllers\Front\Auth\RegisterController;
use App\Http\Controllers\HomeController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', [HomeController::class,'home'])->name('home');


// auth routes
Route::prefix('auth')->name('auth.')->group(function (){

    Route::get('/login',[LoginController::class,'loginForm'])->name('login.form');
    Route::post('/login',[LoginController::class,'login'])->name('login')->middleware('throttle:auth-login-limiter');

    Route::get('/register',[RegisterController::class,'registerForm'])->name('register.form');
    Route::post('/register',[RegisterController::class,'register'])->name('register');


    /////// for verified user email ///////

    //// The Email Verification Notice
    Route::get('/email/verify', function () {
        return view('auth.verify-email');
    })->middleware('auth')->name('verification.notice');
    
    //// The Email Verification Handler
    Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
        $request->fulfill();

        return redirect('/home');
    })->middleware(['auth', 'signed'])->name('verification.verify');

    //// Resending the Verification Email
    Route::post('/email/verification-notification', function (Request $request) {
        $request->user()->sendEmailVerificationNotification();

        return back()->with('message', 'Verification link sent!');
    })->middleware(['auth', 'throttle:6,1'])->name('verification.send');

});



// logged in route
Route::group(['middleware'=>'web'],function (){

    Route::get('/profile',[ProfileController::class,'profile'])->name('profile')->middleware(['verified']);
    Route::get('/log-out',[LoginController::class,'logOut'])->name('log.out');

});
