<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\TimeKeepingController;
use App\Http\Controllers\User\UserTimeKeepingController;
use App\Http\Controllers\User\UserOverTimeController;
use App\Http\Controllers\Admin\OvertimeController;

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

        Route::get('/user/timesheet', [UserTimeKeepingController::class, 'index'])->name('user_timesheet');
        Route::get('/user/timesheet/show/{id}', [UserTimeKeepingController::class, 'show'])->name('user_timesheet_show');

        Route::get('/user/overtime', [UserOverTimeController::class, 'index'])->name('user_overtime');
        Route::get('/user/overtime/show/{id}', [UserOverTimeController::class, 'show'])->name('user_overtime_show');
        Route::get('/user/overtime/create', [UserOverTimeController::class, 'create'])->name('user_overtime_create');
        Route::post('/user/overtime/create', [UserOverTimeController::class, 'store'])->name('user_overtime_store');
    });

    Route::middleware('checkAdmin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin_index');
        Route::get('/admin/users', [UserController::class, 'index'])->name('adminUserIndex');
        Route::get('/admin/users/create', [UserController::class, 'create'])->name('adminUserCreate');
        Route::post('/admin/users/create', [UserController::class, 'store'])->name('adminUserStore');

        Route::get('/timekeeping', [TimeKeepingController::class, 'index'])->name('time_keeping_index');
        Route::get('/timekeeping/show/{id}', [TimeKeepingController::class, 'show'])->name('time_keeping_show');
        Route::get('/timekeeping/import', [TimeKeepingController::class, 'import'])->name('time_keeping_create');
        Route::post('/timekeeping/import', [TimeKeepingController::class, 'upload'])->name('time_keeping_import');

        Route::get('/admin/overtime', [OvertimeController::class, 'index'])->name('overtime_index');
        Route::get('/admin/overtime/edit/{id}', [OvertimeController::class, 'edit'])->name('overtime_index_edit');
        Route::post('/admin/overtime/edit/{id}', [OvertimeController::class, 'update'])->name('overtime_index_update');

        Route::get('/admin/overtime/collect', [OvertimeController::class, 'mount'])->name('overtime_index_mount');
        //Route::get('/timekeeping/export', [TimeKeepingController::class, 'export'])->name('time_keeping_export');
    });
});

/*login*/
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login_check');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
