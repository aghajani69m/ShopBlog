<?php

use App\Http\Controllers\Auth\AuthTokenController;
use App\Http\Controllers\Auth\GoogleAuthController;
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
Route::get('/secret' , function() {
    return 'secret';
})->middleware(['auth' , 'password.confirm']);

Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');

Route::get('/auth/google' ,[GoogleAuthController::class,'redirect'])->name('auth.google');
Route::get('/auth/google/callback' ,[GoogleAuthController::class,'callback']);

Route::get('/auth/token' ,[AuthTokenController::class,'getToken'])->name('2fa.token');
Route::post('/auth/token' ,[AuthTokenController::class,'postToken']);

Route::prefix('profile')->namespace('Profile')->middleware('auth')->group(function() {
    Route::get('/' , [IndexController::class,'index'])->name('profile');
    Route::get('twofactor' , [TwoFactorAuthController::class,'manageTwoFactor'])->name('profile.2fa.manage');
    Route::post('twofactor' , [TwoFactorAuthController::class,'postManageTwoFactor']);

    Route::get('twofacto/phone' , [TokenAuthController::class,'getPhoneVerify'])->name('profile.2fa.phone');
    Route::post('twofacto/phone' , [TokenAuthController::class,'postPhoneVerify']);
});
