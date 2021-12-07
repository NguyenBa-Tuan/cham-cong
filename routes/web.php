<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TimeKeepingController;

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

Route::get('/password/{id}', [UserController::class, 'editPassword'])->name('userEditPassword');
Route::post('/password/{id}', [UserController::class, 'updatePassword'])->name('userUpdatePassword');

/*user*/
Route::middleware('checkLogin')->group(function () {
    Route::middleware('checkUser')->group(function () {
        Route::get('/user', [\App\Http\Controllers\UserController::class, 'index'])->name('user_index');
        Route::get('/user/edit', [\App\Http\Controllers\UserController::class, 'edit'])->name('user_edit');
        Route::post('/user/edit', [\App\Http\Controllers\UserController::class, 'update'])->name('user_update');

    });

    Route::middleware('checkAdmin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin_index');
        Route::get('/admin/users', [UserController::class, 'index'])->name('adminUserIndex');
        Route::get('/admin/users/create', [UserController::class, 'create'])->name('adminUserCreate');
        Route::post('/admin/users/create', [UserController::class, 'store'])->name('adminUserStore');
    });
});

/*login*/
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login_check');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/timekeeping', [TimeKeepingController::class, 'index'])->name('time_keeping');
//Route::get('/timekeeping/export', [TimeKeepingController::class, 'export'])->name('time_keeping_export');
Route::post('/timekeeping/', [TimeKeepingController::class, 'import'])->name('time_keeping_import');
