<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\AdminValidateController;
use App\Http\Controllers\Front\Auth\ForgotPasswordController;
use App\Http\Controllers\Front\Auth\LoginController;
use App\Http\Controllers\Front\Auth\ProfileController;
use App\Http\Controllers\Front\Auth\RegisterController;
use App\Http\Controllers\Front\Auth\SocialController;
use App\Http\Controllers\Front\Auth\ValidateEmailController;
use App\Http\Controllers\Front\BasketController;
use App\Http\Controllers\Front\CouponsController;
use App\Http\Controllers\Front\InvoiceController;
use App\Http\Controllers\Front\OrderController;
use App\Http\Controllers\Front\PaymentController;
use App\Http\Controllers\Front\ProductsController;
use App\Http\Controllers\HomeController;
use App\Services\Storage\Contracts\StorageInterface;
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

Route::get('/notFound',[HomeController::class,'notFound'])->name('not.found');

Route::get('/', [HomeController::class, 'home'])->name('home');


// admin panel routes

Route::group(['prefix' => 'admin'], function () {

    Route::get('/login', [AdminLoginController::class, 'loginForm'])->name('admin.login.form');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login');

    Route::get('/validate', [AdminValidateController::class, 'validateEmailForm'])->name('admin.validate.email.form');
    Route::post('/validate', [AdminValidateController::class, 'validateEmail'])->name('admin.validate.email');

});

// middleware(['roleAccess:admin']) its important
// with gate middleware(can:show_panel) its very important
Route::prefix('admin')->name('admin.')->middleware('can:show_panel')->group(function () {

    Route::get('index', [AdminController::class, 'index'])->name('index');

    Route::get('/users/index', [\App\Http\Controllers\Admin\AdminUserController::class, 'index'])->name('users.index');

    Route::get('/user/edit/{user}', [\App\Http\Controllers\Admin\AdminUserController::class, 'edit'])->name('user.edit');
    Route::post('/user/update', [\App\Http\Controllers\Admin\AdminUserController::class, 'update'])->name('user.update');


    Route::get('/roles/index', [\App\Http\Controllers\Admin\AdminRoleController::class, 'index'])->name('roles.index');
    Route::post('/role/store', [\App\Http\Controllers\Admin\AdminRoleController::class, 'store'])->name('roles.store');

    Route::get('/role/edit/{role}', [\App\Http\Controllers\Admin\AdminRoleController::class, 'edit'])->name('roles.edit');
    Route::post('/role/update/{role}', [\App\Http\Controllers\Admin\AdminRoleController::class, 'update'])->name('roles.update');

    Route::get('/role/delete/{role}', [\App\Http\Controllers\Admin\AdminRoleController::class, 'destroy'])->name('roles.delete');

});

// auth routes
Route::prefix('auth')->name('auth.')->group(function () {

    Route::get('/login', [LoginController::class, 'loginForm'])->name('login.form');
    Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('throttle:auth-login-limiter');

    Route::get('/register', [RegisterController::class, 'registerForm'])->name('register.form');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'resetPasswordForm'])->name('forgot.password.form');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetPassword'])->name('send.forgot.password.link');

    Route::get('/password-reset-form', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('password.reset.form');
    Route::post('/password/reset', [ForgotPasswordController::class, 'resetPassword'])->name('password.reset');

    Route::get('redirect/{provider}', [SocialController::class, 'loginSocial'])->name('login.social');
    Route::get('{provider}/callback', [SocialController::class, 'loginSocialCallback'])->name('login.social.callback');

});

/////// for verified user email ///////

//// The Email Verification Notice
Route::get('/email/verify/notice', [ValidateEmailController::class, 'emailVerificationNotice'])
    ->middleware('auth')->name('verification.notice');

//// The Email Verification Handler
Route::get('/email/verify', [ValidateEmailController::class, 'verifyEmailVerification'])
    ->middleware(['auth', 'signed'])->name('verification.verify');

//// Resending the Verification Email
Route::get('/email/verification-notification', [ValidateEmailController::class, 'resendEmailVerification'])
    ->middleware(['auth', 'throttle:6,1'])->name('verification.send');


// logged in route
Route::prefix('profile')->middleware(['auth', 'web'])->group(function () {

    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile')->middleware(['verified']);

    Route::post('/avatar/store',[ProductsController::class, 'storeAvatar'])->name('profile.avatar.store');

    Route::get('/log-out', [LoginController::class, 'logOut'])->name('log.out');

});

Route::controller(CouponsController::class)->middleware(['auth', 'web'])->group(function () {

    Route::post('/coupon/store','store')->name('coupon.store');
    Route::get('/coupon/delete','delete')->name('coupon.delete');

});

Route::controller(BasketController::class)->prefix('payment')->middleware(['auth', 'web'])->group(function () {

    Route::get('/cart/add-to-cart/{product}','add')->name('cart.add-to-cart');
    Route::get('/cart','cart')->name('cart');
    Route::post('/cart/update/{product}', 'update')->name('cart.update');
    Route::get('/cart/checkout', 'checkOutForm')->name('cart.check-out.form');   // lv.1
    //    Route::post('verify/{gateway}/callback', [PaymentController::class, 'verify'])->name('payment.verify');
});
Route::controller(BasketController::class)->prefix('payment')->middleware(['auth', 'web'])->group(function () {

    Route::post('/cart/pay', [PaymentController::class, 'pay'])->name('cart.pay');    //  lv.2

});
Route::controller(OrderController::class)->middleware(['auth', 'web'])->group(function () {

    Route::get('/orders','index')->name('orders.index');
});

Route::controller(InvoiceController::class)->group(function (){

    Route::get('/invoice/{order}','invoice')->name('invoice');
    Route::get('/invoice/pay/{order}','pay')->name('invoice.pay');
});



Route::controller(PaymentController::class)->prefix('payment')->group(function () {

    Route::post('/verify/{gateway}/callback','verify')->name('payment.verify');
    Route::get('/failed/result','failedPaymentResult')->name('payment.failed.result');

});


Route::get('/products', [ProductsController::class, 'index'])->name('products');

Route::get('basket/clear', function () {
    // this clear session with bind method in appServiceProvider
    resolve(StorageInterface::class)->clearAll();
})->name('clear.basket');
