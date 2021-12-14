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

/*login*/
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login_check');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/password/{id}', [UserController::class, 'editPassword'])->name('userEditPassword');
Route::post('/password/{id}', [UserController::class, 'updatePassword'])->name('userUpdatePassword');

Route::middleware('checkLogin')->group(function () {
    /*user*/
    Route::middleware('checkUser')->prefix('user')->group(function () {
//        Route::get('/', [\App\Http\Controllers\UserController::class, 'index'])->name('user_index');
        Route::get('/', [\App\Http\Controllers\UserController::class, 'edit'])->name('user_edit');
        Route::post('/', [\App\Http\Controllers\UserController::class, 'update'])->name('user_update');

        Route::prefix('timesheet')->group(function () {
            Route::get('/', [UserTimeKeepingController::class, 'index'])->name('user_timesheet');
            Route::get('/show/{id}', [UserTimeKeepingController::class, 'show'])->name('user_timesheet_show');
        });
        Route::prefix('overtime')->group(function () {
            Route::get('/', [UserOverTimeController::class, 'index'])->name('user_overtime');
            Route::get('/create', [UserOverTimeController::class, 'create'])->name('user_overtime_create');
            Route::post('/create', [UserOverTimeController::class, 'store'])->name('user_overtime_store');
//            Route::get('/{month}', [UserOverTimeController::class, 'mount'])->name('user_overtime_show');
        });
    });

    /*admin*/
    Route::middleware('checkAdmin')->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin_index');

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('adminUserIndex');
            Route::get('/create', [UserController::class, 'create'])->name('adminUserCreate');
            Route::post('/create', [UserController::class, 'store'])->name('adminUserStore');
        });

        Route::prefix('timekeeping')->group(function () {
            Route::get('/', [TimeKeepingController::class, 'index'])->name('time_keeping_index');
            Route::get('/show/{id}', [TimeKeepingController::class, 'show'])->name('time_keeping_show');
            Route::get('/import', [TimeKeepingController::class, 'import'])->name('time_keeping_create');
            Route::post('/import', [TimeKeepingController::class, 'upload'])->name('time_keeping_import');
        });

        Route::prefix('overtime')->group(function () {
            Route::get('', [OvertimeController::class, 'index'])->name('overtime_index');
            Route::get('/edit/{id}', [OvertimeController::class, 'edit'])->name('overtime_index_edit');
            Route::post('/edit/{id}', [OvertimeController::class, 'update'])->name('overtime_index_update');
            Route::get('/{month}', [OvertimeController::class, 'mount'])->name('overtime_index_mount');
        });
    });
});

