<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\LevelController;
use App\Http\Controllers\Admin\TimeKeepingController;
use App\Http\Controllers\User\UserTimeKeepingController;
use App\Http\Controllers\Admin\PayrollController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\Admin\OverridePayRollController;
use App\Http\Controllers\User\UserPayrollController;

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

Route::middleware('checkLogin')->group(function () {
    /*user*/
    Route::middleware('checkUser')->prefix('user')->group(function () {
        Route::get('/', [\App\Http\Controllers\UserController::class, 'edit'])->name('user_edit');
        Route::put('/', [\App\Http\Controllers\UserController::class, 'update'])->name('user_update');

        Route::get('/timesheet', [UserTimeKeepingController::class, 'index'])->name('user_timesheet');

        /*payroll*/
        Route::get('/payroll', [UserPayrollController::class, 'index'])->name('user.payroll');
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

        //=== level==
        Route::get('/level', [LevelController::class, 'index'])->name('admin.level.index');
        Route::post('/level', [LevelController::class, 'store'])->name('admin.level.store');
        Route::get('/level/{level}', [LevelController::class, 'edit'])->name('admin.level.edit');
        Route::put('/level/{level}', [LevelController::class, 'update'])->name('admin.level.update');
        //==payroll==
        Route::resource('payroll', PayrollController::class);
        // Route::get('/payroll/check-override', [OverridePayRollController::class, 'checkOverride'])->name('check-override-get');
        Route::post('/payroll/check-override', [OverridePayRollController::class, 'checkOverride'])->name('check-override');
        Route::post('/payroll/override', [OverridePayRollController::class, 'override'])->name('override-payroll');
    });
});

Route::get('config/migration', function () {
    Artisan::call('migrate');
    //Artisan::call('db:seed');
});

Route::get('/config-cache', function () {
    Artisan::call('config:cache');
    dd("Config cache!");
});
Route::get('/cache-clear', function () {
    Artisan::call('cache:clear');
    dd("Cache clear!");
});
