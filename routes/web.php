<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\UserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CompanyNameController;
use App\Http\Controllers\Admin\AdminEmployeeController;




Route::get('/', function () {
    return view('login');
});


Route::post('login/', [LoginController::class, 'loginVerify']);
Route::get('login/otp/{id}', [LoginController::class, 'loginOtp']);
Route::post('login/otp/verify/{id}', [LoginController::class, 'verifyOtp']);
Route::get('login/otp/resendotp/{id}', [LoginController::class, 'resendotp']);


Route::prefix('admin')->name('admin.')->middleware([AdminMiddleware::class])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('employees', AdminEmployeeController::class);
    Route::resource('user', UserController::class);
    Route::resource('company-names', CompanyNameController::class);
});

Route::post('/logout',[LoginController::class, 'logout'])->name('logout');
