<?php

use App\Http\Controllers\Front\Auth\LoginController;
use App\Http\Controllers\Front\Auth\ProfileController;
use App\Http\Controllers\Front\Auth\RegisterController;
use App\Http\Controllers\HomeController;
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

});



// logged in route
Route::group(['middleware'=>'web'],function (){

    Route::get('/profile',[ProfileController::class,'profile'])->name('profile');
    Route::get('/log-out',[LoginController::class,'logOut'])->name('log.out');

});
