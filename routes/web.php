<?php

use App\Models\Company;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\Admin\AdminInquiryController;
use Illuminate\Support\Facades\Log;

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
        Route::get('/count',[AdminController::class,'overallcount'])->name('overallcount');

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


        // most interest
        Route::get('most',[CarController::class,'most'])->name('most');
        Route::get('ssd/most',[CarController::class,'mostssd']);

        // best
        Route::get('best',[CarController::class,'best'])->name('best');
        Route::get('ssd/best',[CarController::class,'bestssd']);

        Route::get('admin/about',[AboutController::class,'index'])->name('admin.about');
        Route::get('about/{id}',[AboutController::class,'update'])->name('admin.about.update');

        Route::get('admin/contact',[ContactController::class,'index'])->name('admin.contact');
        Route::get('contact/{id}',[ContactController::class,'update'])->name('admin.contact.update');

        // password
        Route::prefix('adminpassword')->group(function(){
            Route::get('changepage',[AdminController::class,'changepasswordpage'])->name('adminpassword#changepage');
            Route::post('change',[AdminController::class,'changepassword'])->name('adminpassword#change');
        });

        // inquiries
        Route::get('admin/inquiries', [AdminInquiryController::class, 'index'])->name('admin.inquiries.index');
        Route::get('inquiries/ssd',[AdminInquiryController::class,'ssd']);

        // invoice
        Route::get('admin/invoices', [AdminController::class, 'invoice'])->name('admin.invoices.index');
        Route::get('invoices/ssd', [AdminController::class, 'ssdInvoices']);

        //process
        Route::get('admin/process', [AdminController::class, 'process'])->name('admin.process.index');
        Route::get('process/ssd', [AdminController::class, 'ssdProcess']);

        Route::post('confirm', [AdminController::class, 'confirm']);

        Route::post('/inquiries/{id}/reply', [AdminInquiryController::class, 'reply'])->name('admin.inquiries.reply');

    });
    Route::middleware(['user_auth'])->group(function(){
        Route::post('book',[BookController::class,'userorder'])->name("user.order");
        Route::get('fav',[UserController::class,'fav'])->name('fav');
        Route::get('/favdelete/{id}',[UserController::class,"favremove"]);
        Route::get('/addfav/{id}',[UserController::class,"addfav"]);
        Route::get('user_book',[UserController::class,'book'])->name('booking');

        Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/create/{car}', [InquiryController::class, 'create'])->name('inquiries.create');
        Route::post('/inquiries', [InquiryController::class, 'store'])->name('inquiries.store');

        Route::get("user/invoices/{id}",[UserController::class,'vouchersDetail'])->name('user.invoices.detail');
        Route::get("user/invoices",[UserController::class,'voucher'])->name('user.invoices');

         // password
         Route::prefix('password')->group(function(){
            Route::get('changepage',[UserController::class,'changepasswordpage'])->name('userpassword#changepage');
            Route::post('change',[UserController::class,'changepassword'])->name('userpassword#change');
        });
    });
});

// public
Route::get('user/dashboard',[UserController::class,'index'])->name('user.dashboard');
Route::get('search',[CompanyController::class,'search']);
Route::get('about',[UserController::class,'about'])->name('about');
Route::get('contact',[UserController::class,'contact'])->name('contact');
Route::get('mostinterest',[CarController::class,'mostinterest'])->name('car.interest');
Route::get('usercarlist',[CarController::class,'usercarlist'])->name('user.carlist');
Route::get('findcar',[CarController::class,'search']);
Route::get('/carsearch',[CarController::class,'carsearch']);
Route::get('bestsellcar/{name}',[CarController::class,'bestsellcar'])->name('car.bestsellcar');
Route::get('carlist/{id}',[CarController::class,'carlistdetail'])->name('carlist');
Route::get('cardetail/{id}',[CarController::class,'detail'])->name('car.detail');

Route::get('/locale-switch/{locale}', function ($locale) {
    if (in_array($locale, ['en', 'my'])) {
        Session::put('locale', $locale);
        App::setLocale($locale);
    }
    return redirect()->back();
})->name('locale.switch');








