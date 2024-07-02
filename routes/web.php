<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CompanyController;
use App\Models\Company;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware('admin_auth')->group(function(){
    Route::redirect('/', '/user/dashboard');
    Route::get('/register',[AuthController::class,'register'])->name("register");
    Route::get('/login',[AuthController::class,'login'])->name("login");
});


Route::middleware(['auth:sanctum',config('jetstream.auth_session'),'verified',])->group(function () {
    Route::get('/dashboard',[AuthController::class,'dashboard']);
    Route::middleware(['admin_auth'])->group(function(){
        Route::get('admin/dashboard',[AdminController::class,'index'])->name('admin.dashboard');

        // company
        Route::resource('company',CompanyController::class);
        Route::get('ssd/company',[CompanyController::class,'ssd']);

        //
        Route::resource('car',CarController::class);
        Route::get('ssd/car',[CarController::class,'ssd']);
    });
    Route::middleware(['user_auth'])->group(function(){
        Route::get('carlist/{id}',[CarController::class,'carlistdetail'])->name('carlist');
    });
});


// public
Route::get('user/dashboard',[UserController::class,'index'])->name('user.dashboard');



