<?php

use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\User\PermissionController as PerController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
});
Route::resource('users',UserController::class);
Route::get('/users/{user}/permissions',[PerController::class,'create'])->name('users.permissions');
Route::post('/users/{user}/permissions',[PerController::class,'store'])->name('users.permissions.store');
Route::resource('permissions', PermissionController::class);
Route::resource('roles', RoleController::class);
