<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
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

        //car
        Route::resource('car',CarController::class);
        Route::get('ssd/car',[CarController::class,'ssd']);


        // book
        Route::get('book',[BookController::class,'index'])->name('admin.book');
        Route::get('ssd/book',[BookController::class,'ssd']);
        Route::post('book/{id}/status', [BookController::class, 'updateStatus']);

        //userlist
        Route::get('userlist',[UserController::class,'userlist'])->name('userlist');
        Route::get('ssd/userlist',[UserController::class,'ssd']);
        Route::post('/userdelete/{id}',[UserController::class,"delete"]);



        // password
        Route::prefix('adminpassword')->group(function(){
            Route::get('changepage',[AdminController::class,'changepasswordpage'])->name('adminpassword#changepage');
            Route::post('change',[AdminController::class,'changepassword'])->name('adminpassword#change');
        });

    });
    Route::middleware(['user_auth'])->group(function(){
        Route::get('carlist/{id}',[CarController::class,'carlistdetail'])->name('carlist');
        Route::get('cardetail/{id}',[CarController::class,'detail'])->name('car.detail');
        Route::post('book',[BookController::class,'userorder'])->name("user.order");
    });
});


// public
Route::get('user/dashboard',[UserController::class,'index'])->name('user.dashboard');
Route::get('search',[CompanyController::class,'search']);
Route::get('about',[UserController::class,'about'])->name('about');
Route::get('contact',[UserController::class,'contact'])->name('contact');





