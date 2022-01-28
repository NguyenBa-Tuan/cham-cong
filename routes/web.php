<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\TimeKeepingController;
use App\Http\Controllers\User\UserTimeKeepingController;
use App\Http\Controllers\User\UserOverTimeController;
use App\Http\Controllers\Admin\OvertimeController;
use App\Http\Controllers\Admin\PayrollController;
use App\Http\Controllers\Admin\RuleController;
use Illuminate\Support\Facades\Artisan;

use App\Http\Controllers\User\PasswordFirstChangeController;
use App\Http\Controllers\User\RuleController as UserRuleController;

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
    return redirect()->route('login');
});

/*login*/
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login_check');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

// Route::get('/password/{id}', [UserController::class, 'editPassword'])->name('userEditPassword');
// Route::post('/password/{id}', [UserController::class, 'updatePassword'])->name('userUpdatePassword');


/*06/01/2022 send user password with url lifetime*/
Route::get('/reset/{token}', [PasswordFirstChangeController::class, 'index'])->name('reset_password_index');
Route::post('/reset/{token}', [PasswordFirstChangeController::class, 'update'])->name('reset_password_update');

Route::middleware('checkLogin')->group(function () {
    /*user*/
    Route::middleware('checkUser')->prefix('user')->group(function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'edit'])->name('user_edit');
        Route::put('/', [\App\Http\Controllers\UserController::class, 'update'])->name('user_update');

        Route::get('/timesheet', [UserTimeKeepingController::class, 'index'])->name('user_timesheet');

        Route::prefix('overtime')->group(function () {
            Route::get('/', [UserOverTimeController::class, 'index'])->name('user_overtime');
            Route::get('/create', [UserOverTimeController::class, 'create'])->name('user_overtime_create');
            Route::post('/create', [UserOverTimeController::class, 'store'])->name('user_overtime_store');
            Route::post('/history', [UserOverTimeController::class, 'history'])->name('user.overtime.history');
        });

        Route::get('/rules', [UserRuleController::class, 'index'])->name('user.rule.index');
    });

    /*admin*/
    Route::middleware('checkAdmin')->prefix('admin')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('admin_index');

        Route::prefix('users')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('adminUserIndex');
            Route::post('/create', [UserController::class, 'store'])->name('adminUserStore');
            Route::get('/{user}/edit', [UserController::class, 'edit'])->name('admin.user.edit');
            Route::put('/{user}/edit', [UserController::class, 'update'])->name('admin.user.update');
            Route::delete('/{user}', [UserController::class, 'destroy'])->name('admin.user.destroy');
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
            Route::post('/update-permission', [OvertimeController::class, 'updatePermission'])->name('admin.overtime.update_permission');
            Route::post('/history', [OvertimeController::class, 'history'])->name('admin.overtime.history');
        });

        Route::get('/rules', [RuleController::class, 'index'])->name('admin.rule.index');
        Route::post('/rules', [RuleController::class, 'store'])->name('admin.rule.store');
        Route::delete('/rules/{file}', [RuleController::class, 'destroy'])->name('admin.rule.destroy');
        Route::get('/rules/download/{file}', [RuleController::class, 'downloadFile'])->name('admin.rule.download');
        //=== level==
        Route::get('/level', [LevelController::class, 'index'])->name('admin.level.index');
        Route::post('/level', [LevelController::class, 'store'])->name('admin.level.store');
        Route::get('/level/{level}', [LevelController::class, 'edit'])->name('admin.level.edit');
        Route::put('/level/{level}', [LevelController::class, 'update'])->name('admin.level.update');
        //==payroll==
        Route::resource('payroll', PayrollController::class);
    });
});

Route::get('config/migration', function () {
    Artisan::call('migrate');
    Artisan::call('db:seed');
});
