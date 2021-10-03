<?php

use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\User\PermissionController as PerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});
Route::resource('users',UserController::class);
Route::get('/users/{user}/permissions',[PerController::class,'create'])->name('users.permissions')->middleware('can:staff-user-permissions');
Route::post('/users/{user}/permissions',[PerController::class,'store'])->name('users.permissions.store')->middleware('can:staff-user-permissions');
Route::resource('permissions', PermissionController::class)->except('show');
Route::resource('roles', RoleController::class)->except('show');
Route::post('attribute/values' , [AttributeController::class,'getValues']);

Route::resource('products', ProductController::class)->except('show');

Route::get('comments/unapproved', [CommentController::class,'unapproved'])->name('comments.unapproved');
Route::resource('comments' , CommentController::class)->only(['index' , 'update' , 'destroy']);

Route::resource('categories', CategoryController::class)->except('show');
