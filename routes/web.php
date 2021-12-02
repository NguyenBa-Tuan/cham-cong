<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;


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

Route::get('/admin/users', [UserController::class, 'index'])->name('adminUserIndex');
//Route::get('/admin/{id}', [UserController::class, 'show']);

Route::get('/admin/users/create',[UserController::class, 'create'])->name('adminUserCreate');
Route::post('/admin/users/create', [UserController::class, 'store'])->name('adminUserStore');

Route::get('/password/{id}', [UserController::class, 'editPassword'])->name('userEditPassword');
Route::post('/password/{id}', [UserController::class, 'updatePassword'])->name('userUpdatePassword');
