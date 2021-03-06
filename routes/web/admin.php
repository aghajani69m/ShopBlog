<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductGalleryController;
use App\Http\Controllers\Admin\User\PermissionController as PerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $user = auth()->user();
    return view('admin.index',compact('user'));
});
Route::resource('users',UserController::class);
Route::get('/users/{user}/permissions',[PerController::class,'create'])->name('users.permissions')->middleware('can:staff-user-permissions');
Route::post('/users/{user}/permissions',[PerController::class,'store'])->name('users.permissions.store')->middleware('can:staff-user-permissions');
Route::resource('permissions', PermissionController::class)->except('show');
Route::resource('roles', RoleController::class)->except('show');
Route::post('attribute/values' , [AttributeController::class,'getValues'])->name('attribute.values');

Route::resource('products', ProductController::class)->except('show');
Route::get('products/userproducts', [ProductController::class,'userShow'])->name('products.userShow');


Route::resource('orders', OrderController::class)->except('create' , 'store');
Route::get('orders/{order}/payments',[OrderController::class,'payments'])->name('orders.payments');

Route::resource('products.gallery' , ProductGalleryController::class);


Route::get('comments/unapproved', [CommentController::class,'unapproved'])->name('comments.unapproved');
Route::get('comments/usercomments', [CommentController::class,'userShow'])->name('comments.userShow');
Route::resource('comments' , CommentController::class)->only(['index' , 'update' , 'destroy']);

Route::resource('categories', CategoryController::class)->except('show');

Route::resource('discount', DiscountController::class)->except('show');

