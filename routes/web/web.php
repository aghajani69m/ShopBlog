<?php

use App\Http\Controllers\Auth\AuthTokenController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Profile\IndexController;
use App\Http\Controllers\Profile\TokenAuthController;
use App\Http\Controllers\Profile\TwoFactorAuthController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');

Route::get('/auth/google' ,[GoogleAuthController::class,'redirect'])->name('auth.google');
Route::get('/auth/google/callback' ,[GoogleAuthController::class,'callback']);

Route::get('/auth/token' ,[AuthTokenController::class,'getToken'])->name('2fa.token');
Route::post('/auth/token' ,[AuthTokenController::class,'postToken']);

Route::middleware('auth')->group(function() {
    Route::prefix('profile')->namespace('Profile')->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('profile');
        Route::get('twofactor', [TwoFactorAuthController::class, 'manageTwoFactor'])->name('profile.2fa.manage');
        Route::post('twofactor', [TwoFactorAuthController::class, 'postManageTwoFactor']);

        Route::get('twofacto/phone', [TokenAuthController::class, 'getPhoneVerify'])->name('profile.2fa.phone');
        Route::post('twofacto/phone', [TokenAuthController::class, 'postPhoneVerify']);
    });
    Route::post('comments' ,[HomeController::class,'comment'])->name('send.comment');
    Route::post('payment' ,[PaymentController::class,'payment'])->name('cart.payment');
    Route::get('payment/callback' ,[PaymentController::class,'callback'])->name('payment.callback');

});

Route::get('products' ,[ProductController::class,'index']);
Route::get('products/{product}' ,[ProductController::class,'single']);



Route::post('cart/add/{product}' , [CartController::class,'addToCart'])->name('cart.add');
Route::patch('cart/quantity/change' , [CartController::class,'quantityChange'])->name('quantity.change');
Route::delete('cart/delete/{cart}' , [CartController::class,'deleteFromCart'])->name('cart.destroy');
Route::get('cart' , [CartController::class,'cart']);
