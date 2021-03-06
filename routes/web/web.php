<?php

use App\Http\Controllers\Auth\AuthTokenController;
use App\Http\Controllers\Auth\GoogleAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Profile\IndexController;
use App\Http\Controllers\Profile\OrderController;
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
    $products = \App\Models\Product::latest()->paginate(9);
    $cart = \App\Helpers\Cart\Cart::instance();
    return view('welcome',compact('products','cart'));
});
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/specials', [App\Http\Controllers\HomeController::class, 'specials'])->name('specials');
Route::get('/categoriesproducts/{category}', [App\Http\Controllers\HomeController::class, 'catPro'])->name('product.category');

Route::get('/auth/google' ,[GoogleAuthController::class,'redirect'])->name('auth.google');
Route::get('/auth/google/callback' ,[GoogleAuthController::class,'callback']);

Route::get('/auth/token' ,[AuthTokenController::class,'getToken'])->name('2fa.token');
Route::post('/auth/token' ,[AuthTokenController::class,'postToken']);

Route::middleware('auth')->group(function() {
    Route::prefix('profile')->namespace('Profile')->group(function () {
        Route::get('/', [IndexController::class, 'index'])->name('profile');
        Route::get('/upload', [IndexController::class, 'uploadImage'])->name('profile.upload.image');
        Route::post('/upload', [IndexController::class, 'uploadImagePost'])->name('profile.upload.image');
        Route::get('twofactor', [TwoFactorAuthController::class, 'manageTwoFactor'])->name('profile.2fa.manage');
        Route::post('twofactor', [TwoFactorAuthController::class, 'postManageTwoFactor']);

        Route::get('twofacto/phone', [TokenAuthController::class, 'getPhoneVerify'])->name('profile.2fa.phone');
        Route::post('twofacto/phone', [TokenAuthController::class, 'postPhoneVerify']);

        Route::get('orders', [OrderController::class, 'index'])->name('profile.orders');
        Route::get('orders/{order}', [OrderController::class, 'showDetails'])->name('profile.orders.detail');
        Route::get('orders/{order}/payment', [OrderController::class, 'payment'])->name('profile.orders.payment');


    });
    Route::post('comments' ,[HomeController::class,'comment'])->name('send.comment');
    Route::post('payment' ,[PaymentController::class,'payment'])->name('cart.payment');
    Route::post('payment/callback' ,[PaymentController::class,'callback'])->name('payment.confirm');
    Route::get('payment/callback/confirm' ,[PaymentController::class,'callbackConfirm']);

});

Route::get('products' ,[ProductController::class,'index']);
Route::get('products/{product}' ,[ProductController::class,'singleView']);
Route::get('products/{product}/edit' ,[ProductController::class,'edit'])->name('products.edit');
Route::patch('products/{product}' ,[ProductController::class,'update'])->name('products.update');
Route::delete('products/{product}' ,[ProductController::class,'delete'])->name('products.destroy');



Route::post('cart/add/{product}' , [CartController::class,'addToCart'])->name('cart.add');
Route::patch('cart/quantity/change' , [CartController::class,'quantityChange'])->name('quantity.change');
Route::delete('cart/delete/{cart}' , [CartController::class,'deleteFromCart'])->name('cart.destroy');
Route::get('cart' , [CartController::class,'cart']);

Route::post('discount/check' , [DiscountController::class, 'check'])->name('cart.discount.check');
Route::delete('discount/delete' ,[DiscountController::class, 'destroy'])->name('discount.delete');
